/////////////////////////////////////////////
// Cockpit COntas a pagar                ///
// FIN_CONTAS_PAGAR                                     ///   
// Desenvolvido por Matheus Jaschke     ///
// Março de 2016                        ///
// VPI GESTAO                          ///
/////////////////////////////////////////
var totalLinhas = 0;
var totalEditar = 0;

$(document).ready(function() {
  
 
  carregarEmpresa();
  carregarFilial();
  carregarFornecedor();
  carregarCentroCusto();
  carregarCondicaoPagamento();
  carregarContaContabil();
  carregarContaCorrente();
  carregarEmpresaFiltro();
  carregarFilialFiltro();
  
 
  
  
   
  $('#periodoIni').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
  $('#periodoFim').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
  
  $('#dataEmissaoModal').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
   
  $('#dataEmissaoModalBaixa').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR"
  });  

});

function salvar(){
     
 
    var idEmpresa         =   $('#idEmpresa').val();             
    var idFilial          =   $('#idFilial').val();
    var idBanco           =   $('#idBanco').val();             
    var agencia           =   $('#agencia').val();
    var conta             =   $('#conta').val();
    var observacao        =   $('#observacao').val();
   
       
       
    var controleDePreenchimento = 'S';
 
    if(idBanco == 0){
        controleDePreenchimento = 'N';
    }
    if(agencia == ""){
        controleDePreenchimento = 'N';
    }
    if(observacao == ""){
        controleDePreenchimento = 'N';
    }
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == 0){
        controleDePreenchimento = 'N';
    }
        
    if(controleDePreenchimento ==  'S'){
                    
        document.getElementById("idEmpresa").readOnly     = true;
        document.getElementById("idFilial").readOnly      = true;
        document.getElementById("idBanco").readOnly       = true;
        document.getElementById("agencia").readOnly       = true;
        document.getElementById("conta").readOnly         = true;
        document.getElementById("observacao").readOnly    = true;


        $.ajax({
            url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=salvar',
            data: {
                idEmpresa: idEmpresa,
                idFilial:  idFilial,
                idBanco:  idBanco,
                agencia: agencia,
                conta: conta,
                observacao: observacao
                
            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    $('#basicModal').modal('hide');
                    atualizar();
                }
                else {
                    mensagem('Atenção', 'Erro ao salvar', 'error');
                    atualizar();
                }
            },
            error: function(e) {
                mensagem('Atenção', 'Erro ao salvar', 'error');

            }
        }); 
              
       
        
    }
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
         
          
    }
    
}

function excluirModal(){
    
    var idTituloModal   =   $('#idTituloModal').val();
    
     
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=excluirModal',
        data: {
            idTituloModal: idTituloModal
                                  
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                atualizarModal();
            }
            else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                atualizarModal();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            atualizarModal();
            

        }
    }); 
     
}


function pesquisar() {
    
   
    $('#pesquisarModal').modal('show');
    
   
    
     
}

function filtro(){
  
    
    var tipoData         =   $('#tipoData').val();      
    var periodoIni         =   $('#periodoIni').val();      
    var periodoFim         =   $('#periodoFim').val();    
 


    if(tipoData == '0' || periodoIni == " " || periodoFim == " "){
        
       
        mensagem('Atenção', 'Os campos Data, Período Inicial e Final são de preenchimento obrigatório.', 'error'); 
        
    }
    else{
        
        if(periodoIni == "" || periodoFim == ""){
                mensagem('Atenção', 'Os campos  Período Inicial e Final são de preenchimento obrigatório.', 'error'); 
        }
        else{
            getGrid();
        }
    }
     
}
function pesquisarBaixa(idParcela) {
    
   
    document.getElementById('dataEmissaoModalBaixa').value         = ""  
    document.getElementById("documentoModalBaixa").value           = " ";
    document.getElementById("tipoCobrancaModalBaixa").value        = 0;
    document.getElementById("documetoPagamentoModalBaixa").value  = "";
    document.getElementById("saldoDevedorModalBaixa").value        = "";
    document.getElementById("multaJurosModalBaixa").value          = "";
    document.getElementById("descontoModalBaixa").value            =  "";
    document.getElementById("valorPagarModalBaixa").value          = "";
    document.getElementById("pagamentoModalBaixa").value           = "";
    document.getElementById("observacaoModalBaixa").value          = "";
    document.getElementById("idContaCorrenteModalBaixa").value     = 0;
  
    
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarBaixaModal',
        data: {
            idParcela: idParcela
          

        },
        type: 'POST',
        dataType: 'json',
        async: true,
       success: function(r) {
                        
            document.getElementById("dataEmissaoModalBaixa").value        = r[0];
            document.getElementById("documentoModalBaixa").value          = r[1];
            document.getElementById("tipoCobrancaModalBaixa").value       = r[2];
            document.getElementById("saldoDevedorModalBaixa").value       = r[3];   
            document.getElementById("valorPagarModalBaixa").value         = r[4];   
            document.getElementById("pagamentoModalBaixa").value          = r[5];
            document.getElementById("observacaoModalBaixa").value         = r[6]; 
            document.getElementById("idModalBaixa").value = idParcela;   
                    
                     
        },
        error: function() {

        }
    });    
   
    $('#baixarModal').modal('show');
   
   
}

function editarModal(){
       
    document.getElementById("idEmpresaModal").readOnly            = false;
    document.getElementById("idFilialModal").readOnly             = false;
    document.getElementById("idFornecedorModal").readOnly         = false;
    document.getElementById("dataEmissaoModal").readOnly          = false;
    document.getElementById("documentoModal").readOnly            = false;
    document.getElementById("valorTituloModal").readOnly          = false;
    document.getElementById("tipoCobrancaModal").readOnly         = false;
    document.getElementById("centroCustoModal").readOnly          = false;
    document.getElementById("contaContabilModal").readOnly        = false;
    document.getElementById("historicoModal").readOnly            = false;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = false;

    for (var i = 1; i <= totalEditar; i++) {

        var idParcela        = i;
        var idDataVencimento = i + '_' + i;
        var idDataProposta   = i + '_' + i + '_' + i;
        var idValor          = i + '_' + i + '_' + i;
        document.getElementById(idParcela).readOnly = false;
        document.getElementById(idDataVencimento).readOnly = false;
        document.getElementById(idDataProposta).readOnly = false; 
        document.getElementById(idValor).readOnly = false;     
    }
      
}



function pesquisaFiltro(){
    
    var idInicial   = document.getElementById("idPesquisarInicio").value;
    var idFinal     = document.getElementById("idPesquisarFim").value;
    var nomeInicial = document.getElementById("nomePesquisarInicio").value;
    var nomeFim     = document.getElementById("nomePesquisarFim").value;
      
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("idEmpresa").value     = r[0];
            document.getElementById("idFilial").value      = r[1];
            document.getElementById("idBanco").value       = r[2];
            document.getElementById("agencia").value       = r[3];
            document.getElementById("conta").value         = r[4];   
            document.getElementById("observacao").value    = r[5];   
                               
            $('#pesquisarModal').modal('hide');          
     
                     
        },
        error: function(e) {

        }
    }); 
           
    
}
function getGrid() {
    
    var objFiltro = new Object();
         
    objFiltro.periodoIni        = $("#periodoIni").val();
    objFiltro.periodoFim        = $("#periodoFim").val();
    objFiltro.situacao          = $("#situacao").val();
    objFiltro.tipoData          = $("#tipoData").val();
    objFiltro.idEmpresa         = $("#idEmpresaFiltro").val();
    objFiltro.idFilial          = $("#idFilialFiltro").val();
               
    $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=getGrid",
            "data": objFiltro,
            "type": "POST",
        },
        language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        
        "columns": [
           {"data": "STATUS"},
            {"data": "SITUACAO"},
            {"data": "DOCUMENTO"},
            {"data": "VENCIMENTO"},
            {"data": "EMISSAO"},
            {"data": "FORNECEDOR"},
            {"data": "HISTORICO"},
            {"data": "TIPO"},
            {"data": "ORIGEM"},
            {"data": "PARCELA"},
            {"data": "VALOR_PARCELA"},
            {"data": "VALOR_TOTAL"},
            {"data": "BAIXAR"},
            {"data": "EXCLUIR"},
         
        ],
        searching: false
    });

    $('#grid')
        .removeClass('display')
        .addClass('table table-hover table-striped table-bordered');
   
   getHtmlFiltro();
     
        
}

function getHtmlFiltro(){
    
  
         
   var periodoIni        = $("#periodoIni").val();
   var periodoFim        = $("#periodoFim").val();
   var situacao          = $("#situacao").val();
   var tipoData          = $("#tipoData").val();
   var idEmpresa         = $("#idEmpresaFiltro").val();
   var idFilial          = $("#idFilialFiltro").val();
    
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=getHtmlFiltro',
        data: {
            periodoIni: periodoIni,
            periodoFim: periodoFim,
            situacao: situacao,
            tipoData: tipoData,
            idEmpresa: idEmpresa,
            idFilial: idFilial
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById('total').innerHTML         = r;   
              
                     
        },
        error: function(e) {

        }
    });   
    
    
}


 
 function selecionaGrid(idBanco){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idEmpresa").readOnly     = true;
    document.getElementById("idFilial").readOnly      = true;
    document.getElementById("idBanco").readOnly       = true;
    document.getElementById("agencia").readOnly       = true;
    document.getElementById("conta").readOnly         = true;
    document.getElementById("observacao").readOnly    = true;
    
   
    
    
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=selecionaGrid',
        data: {
            idBanco: idBanco
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                      
            document.getElementById("idEmpresa").value     = r[0];
            document.getElementById("idFilial").value      = r[1];
            document.getElementById("idBanco").value       = r[2];
            document.getElementById("agencia").value       = r[3];
            document.getElementById("conta").value         = r[4];   
            document.getElementById("observacao").value    = r[5];     
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizarModal(){
    
     
    document.getElementById("idEmpresaModal").readOnly            = true;
    document.getElementById("idFilialModal").readOnly             = true;
    document.getElementById("idFornecedorModal").readOnly         = true;
    document.getElementById("dataEmissaoModal").readOnly          = true;
    document.getElementById("documentoModal").readOnly            = true;
    document.getElementById("valorTituloModal").readOnly          = true;
    document.getElementById("tipoCobrancaModal").readOnly         = true;
    document.getElementById("centroCustoModal").readOnly          = true;
    document.getElementById("contaContabilModal").readOnly        = true;
    document.getElementById("historicoModal").readOnly            = true;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = true;
    
    document.getElementById('idTituloModal').value             = ""  
    document.getElementById("idEmpresaModal").value            = 0;
    document.getElementById("idFilialModal").value             = 0;
    document.getElementById("idFornecedorModal").value         = 0;
    document.getElementById("dataEmissaoModal").value          = "";
    document.getElementById("documentoModal").value            = "";
    document.getElementById("valorTituloModal").value          = "";
    document.getElementById("tipoCobrancaModal").value         = 0;
    document.getElementById("centroCustoModal").value          = 0;
    document.getElementById("contaContabilModal").value        = 0;
    document.getElementById("historicoModal").value            = "";
    document.getElementById("idCondicaoPagamentoModal").value  = 0;
    document.getElementById('tabelaParcela').innerHTML         = "";
        
}
function atualizar(){
    
    getGrid();
            
    document.getElementById('periodoIni').value = ""  
    document.getElementById("periodoFim").value = "";
    document.getElementById("situacao").value   = 0;
    document.getElementById("tipoData").value   = 0;
            
    
}


function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idEmpresaModal').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}


function carregarFilial(){
    
    var idEmpresa = document.getElementById("idEmpresaModal").value;
    
              
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarFilial',
        data: {
            idEmpresa: idEmpresa
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idFilialModal').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Filial', 'error'); 
               
            }

        },
        error: function() {
          
        }
    });
}

function carregarEmpresaFiltro(){
    
           
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idEmpresaFiltro').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}


function carregarFilialFiltro(){
    
    var idEmpresa = document.getElementById("idEmpresaFiltro").value;
    
              
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarFilial',
        data: {
            idEmpresa: idEmpresa
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idFilialFiltro').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Filial', 'error'); 
               
            }

        },
        error: function() {
          
        }
    });
}
function carregarDataAtual(){
    
   
     $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarDataAtual',
        data: {
                        
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            document.getElementById('periodoIni').value = data;
            document.getElementById('periodoFim').value = data;
               
          

        },
        error: function() {
          
        }
    });
   
    
}


function carregarFornecedor(){
   
           
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarFornecedor',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idFornecedorModal').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}
function carregarCentroCusto(){
              
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarCentroCusto',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('centroCustoModal').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}

function carregarCondicaoPagamento(){   
           
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarCondicaoPagamento',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
                
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idCondicaoPagamentoModal').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}

function carregarContaContabil(){
              
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarContaContabil',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('contaContabilModal').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}

function carregarContaCorrente(){
              
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarContaCorrente',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idContaCorrenteModalBaixa').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}





function carregarParcelaHtml(){
    
    
    var codParcela =  document.getElementById('idCondicaoPagamentoModal').value;
    var valorTitulo = document.getElementById('valorTituloModal').value;
    
    
    valorTitulo = valorTitulo.replace("." , "");
    valorTitulo = valorTitulo.replace("." , "");
    valorTitulo = valorTitulo.replace("," , ".");
        
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=carregarParcelaHtml',
        data: {
            codParcela: codParcela,
            valorTitulo: valorTitulo
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(data) {

            if (data != false) {
                document.getElementById('tabelaParcela').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error');

            }

        },
        error: function() {

        }
    });
    
}


//////////////////////////////////////////////////////////////
//         FUNÇÕES EPECÍFICAS PARA O MODAL                //         
/////////////////////////////////////////////////////////////


function novoModal(){
    
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=novoModal',
        data: {
          
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(data) {

            if (data != false) {
                document.getElementById('idTituloModal').value = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Fornecedor', 'error');

            }

        },
        error: function() {

        }
    });
    
       
    
    document.getElementById("idEmpresaModal").readOnly            = false;
    document.getElementById("idFilialModal").readOnly             = false;
    document.getElementById("idFornecedorModal").readOnly         = false;
    document.getElementById("dataEmissaoModal").readOnly          = false;
    document.getElementById("documentoModal").readOnly            = false;
    document.getElementById("valorTituloModal").readOnly          = false;
    document.getElementById("tipoCobrancaModal").readOnly         = false;
    document.getElementById("centroCustoModal").readOnly          = false;
    document.getElementById("contaContabilModal").readOnly        = false;
    document.getElementById("historicoModal").readOnly            = false;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = false;
    
      
    document.getElementById("idEmpresaModal").value            = 0;
    document.getElementById("idFilialModal").value             = 0;
    document.getElementById("idFornecedorModal").value         = 0;
    document.getElementById("dataEmissaoModal").value          = "";
    document.getElementById("documentoModal").value            = "";
    document.getElementById("valorTituloModal").value          = "";
    document.getElementById("tipoCobrancaModal").value         = 0;
    document.getElementById("centroCustoModal").value          = 0;
    document.getElementById("contaContabilModal").value        = 0;
    document.getElementById("historicoModal").value            = "";
    document.getElementById("idCondicaoPagamentoModal").value  = 0;
    document.getElementById('tabelaParcela').innerHTML = "";
}

function salvarModal(){
        
       
    var numeroDeLinhas = getNumeroLinhas();

    document.getElementById("idEmpresaModal").readOnly            = true;
    document.getElementById("idFilialModal").readOnly             = true;
    document.getElementById("idFornecedorModal").readOnly         = true;
    document.getElementById("dataEmissaoModal").readOnly          = true;
    document.getElementById("documentoModal").readOnly            = true;
    document.getElementById("valorTituloModal").readOnly          = true;
    document.getElementById("tipoCobrancaModal").readOnly         = true;
    document.getElementById("centroCustoModal").readOnly          = true;
    document.getElementById("contaContabilModal").readOnly        = true;
    document.getElementById("historicoModal").readOnly            = true;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = true;

    var idTituloModal            = document.getElementById('idTituloModal').value 
    var idEmpresaModal           = document.getElementById("idEmpresaModal").value;
    var idFilialModal            = document.getElementById("idFilialModal").value;
    var idFornecedorModal        = document.getElementById("idFornecedorModal").value;
    var dataEmissaoModal         = document.getElementById("dataEmissaoModal").value;
    var documentoModal           = document.getElementById("documentoModal").value;
    var valorTituloModal         = document.getElementById("valorTituloModal").value;
    var tipoCobrancaModal        = document.getElementById("tipoCobrancaModal").value;
    var centroCustoModal         = document.getElementById("centroCustoModal").value;
    var contaContabilModal       = document.getElementById("contaContabilModal").value;
    var historicoModal           = document.getElementById("historicoModal").value;
    var idCondicaoPagamentoModal = document.getElementById("idCondicaoPagamentoModal").value;  
   
    
    for(var i = 1; i <= numeroDeLinhas; i++){

        var aux1 = i;
        var aux2 = i + "_" + i;
        var aux3 = i + "_" + i + "_" + i;
        var aux4 = i + "_" + i + "_" + i + "_" + i;

        document.getElementById(aux1).readOnly = true;
        document.getElementById(aux2).readOnly = true;
        document.getElementById(aux3).readOnly = true;
        document.getElementById(aux4).readOnly = true;
        
        var numeroParcela = document.getElementById(aux1).value;
        var dataVencimento = document.getElementById(aux2).value;
        var dataProposta = document.getElementById(aux3).value;
        var valor = document.getElementById(aux4).value;
              
              
        $.ajax({
            url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=salvarParcela',
            data: {
                idTituloModal: idTituloModal,
                numeroParcela: numeroParcela,
                dataVencimento: dataVencimento,
                dataProposta: dataProposta,
                valor: valor,
                idEmpresaModal: idEmpresaModal,
                idFilialModal: idFilialModal
             
            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {

                if (data != false) {
                                        
                    document.getElementById("idEmpresaModal").value           = 0;
                    document.getElementById("idFilialModal").value            = 0;
                    document.getElementById("idFornecedorModal").value        = 0;
                    document.getElementById("dataEmissaoModal").value         = "";
                    document.getElementById("documentoModal").value           = "";
                    document.getElementById("valorTituloModal").value         = "";
                    document.getElementById("tipoCobrancaModal").value        = 0;
                    document.getElementById("centroCustoModal").value         = 0;
                    document.getElementById("contaContabilModal").value       = 0;
                    document.getElementById("historicoModal").value           = "";
                    document.getElementById("idCondicaoPagamentoModal").value = 0;
                    document.getElementById('tabelaParcela').innerHTML        = "";
                    

                } else {
                    mensagem('Atenção', 'Erro ao salvar parcial', 'error');

                }

            },
            error: function() {

            }
        });
    }  
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=salvarModal',
        data: {
            idTituloModal: idTituloModal,
            idEmpresaModal: idEmpresaModal,
            idFilialModal: idFilialModal,
            idFornecedorModal: idFornecedorModal,
            dataEmissaoModal: dataEmissaoModal,
            documentoModal: documentoModal,
            valorTituloModal: valorTituloModal,
            tipoCobrancaModal: tipoCobrancaModal,
            centroCustoModal: centroCustoModal,
            contaContabilModal: contaContabilModal,
            historicoModal: historicoModal,
            idCondicaoPagamentoModal: idCondicaoPagamentoModal
           

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(data) {

            if (data != false) {
                               
                mensagem('Sucesso', 'Salvo  com Sucesso', 'success');
                $('#pesquisarModal').modal('hide');
              
            } else {
                mensagem('Atenção', 'Erro ao salvar parcial', 'error');

            }

        },
        error: function() {

        }
    });
    
    
    
    
    
    
}
function getNumeroLinhas(str){
    
       
    
    var codParcela =  document.getElementById('idCondicaoPagamentoModal').value;
    var retorno;
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=getNumeroLinhas',
        data: {
            codParcela: codParcela,
           
        },
        type: 'POST',
        dataType: 'json',
         
        async: false, //falso eu consigo pegar a variavel do retono
        success: function(data) {

            if (data != false) {
                 retorno = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar o número de linhas', 'error');

            }

        },
        error: function() {

        }
    });
    return retorno;
    
    
    
}


function buscaPrimeiroRegistroModal(){
    
    document.getElementById("idEmpresaModal").readOnly            = true;
    document.getElementById("idFilialModal").readOnly             = true;
    document.getElementById("idFornecedorModal").readOnly         = true;
    document.getElementById("dataEmissaoModal").readOnly          = true;
    document.getElementById("documentoModal").readOnly            = true;
    document.getElementById("valorTituloModal").readOnly          = true;
    document.getElementById("tipoCobrancaModal").readOnly         = true;
    document.getElementById("centroCustoModal").readOnly          = true;
    document.getElementById("contaContabilModal").readOnly        = true;
    document.getElementById("historicoModal").readOnly            = true;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = true;
      
   
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=buscaPrimeiroRegistroModal',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("idTituloModal").value            = r[0];
            document.getElementById("idEmpresaModal").value           = r[1];
            document.getElementById("idFilialModal").value            = r[2];
            document.getElementById("idFornecedorModal").value         = r[3];
            document.getElementById("dataEmissaoModal").value         = r[4];
            document.getElementById("documentoModal").value           = r[5];   
            document.getElementById("valorTituloModal").value         = r[6];
            document.getElementById("tipoCobrancaModal").value        = r[7];
            document.getElementById("centroCustoModal").value         = r[8];
            document.getElementById("contaContabilModal").value       = r[9];   
            document.getElementById("historicoModal").value           = r[10];
            document.getElementById("idCondicaoPagamentoModal").value = r[11];
            var total = r[12];
            totalEditar = total;
            addLinhas(total);
             
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnteriorModal(){
    
    document.getElementById("idEmpresaModal").readOnly            = true;
    document.getElementById("idFilialModal").readOnly             = true;
    document.getElementById("idFornecedorModal").readOnly         = true;
    document.getElementById("dataEmissaoModal").readOnly          = true;
    document.getElementById("documentoModal").readOnly            = true;
    document.getElementById("valorTituloModal").readOnly          = true;
    document.getElementById("tipoCobrancaModal").readOnly         = true;
    document.getElementById("centroCustoModal").readOnly          = true;
    document.getElementById("contaContabilModal").readOnly        = true;
    document.getElementById("historicoModal").readOnly            = true;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = true;
    
    
    var idTituloModal   =   $('#idTituloModal').val();
  
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=buscaRegistroAnteriorModal',
        data: {
            idTituloModal: idTituloModal,
          
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("idTituloModal").value            = r[0];
                document.getElementById("idEmpresaModal").value           = r[1];
                document.getElementById("idFilialModal").value            = r[2];
                document.getElementById("idFornecedorModal").value         = r[3];
                document.getElementById("dataEmissaoModal").value         = r[4];
                document.getElementById("documentoModal").value           = r[5];   
                document.getElementById("valorTituloModal").value         = r[6];
                document.getElementById("tipoCobrancaModal").value        = r[7];
                document.getElementById("centroCustoModal").value         = r[8];
                document.getElementById("contaContabilModal").value       = r[9];   
                document.getElementById("historicoModal").value           = r[10];
                document.getElementById("idCondicaoPagamentoModal").value = r[11];   
                
                var total = r[12];
                totalEditar = total;
                addLinhas(total);
             
                
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximoModal(){
    
    document.getElementById("idEmpresaModal").readOnly            = true;
    document.getElementById("idFilialModal").readOnly             = true;
    document.getElementById("idFornecedorModal").readOnly         = true;
    document.getElementById("dataEmissaoModal").readOnly          = true;
    document.getElementById("documentoModal").readOnly            = true;
    document.getElementById("valorTituloModal").readOnly          = true;
    document.getElementById("tipoCobrancaModal").readOnly         = true;
    document.getElementById("centroCustoModal").readOnly          = true;
    document.getElementById("contaContabilModal").readOnly        = true;
    document.getElementById("historicoModal").readOnly            = true;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = true;
    
       
    var idTituloModal   =   $('#idTituloModal').val();
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=buscaRegistroProximoModal',
        data: {
            idTituloModal: idTituloModal
           
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idTituloModal").value            = r[0];
                document.getElementById("idEmpresaModal").value           = r[1];
                document.getElementById("idFilialModal").value            = r[2];
                document.getElementById("idFornecedorModal").value         = r[3];
                document.getElementById("dataEmissaoModal").value         = r[4];
                document.getElementById("documentoModal").value           = r[5];   
                document.getElementById("valorTituloModal").value         = r[6];
                document.getElementById("tipoCobrancaModal").value        = r[7];
                document.getElementById("centroCustoModal").value         = r[8];
                document.getElementById("contaContabilModal").value       = r[9];   
                document.getElementById("historicoModal").value           = r[10];
                document.getElementById("idCondicaoPagamentoModal").value = r[11];  
                var total = r[12];
                totalEditar = total;
                addLinhas(total);
                   
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistroModal(){
    
    document.getElementById("idEmpresaModal").readOnly            = true;
    document.getElementById("idFilialModal").readOnly             = true;
    document.getElementById("idFornecedorModal").readOnly         = true;
    document.getElementById("dataEmissaoModal").readOnly          = true;
    document.getElementById("documentoModal").readOnly            = true;
    document.getElementById("valorTituloModal").readOnly          = true;
    document.getElementById("tipoCobrancaModal").readOnly         = true;
    document.getElementById("centroCustoModal").readOnly          = true;
    document.getElementById("contaContabilModal").readOnly        = true;
    document.getElementById("historicoModal").readOnly            = true;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = true;
    
       
    var idTituloModal   =   $('#idTituloModal').val();
    
      
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=buscaUltimoRegistroModal',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idTituloModal").value            = r[0];
            document.getElementById("idEmpresaModal").value           = r[1];
            document.getElementById("idFilialModal").value            = r[2];
            document.getElementById("idFornecedorModal").value         = r[3];
            document.getElementById("dataEmissaoModal").value         = r[4];
            document.getElementById("documentoModal").value           = r[5];
            document.getElementById("valorTituloModal").value         = r[6];
            document.getElementById("tipoCobrancaModal").value        = r[7];
            document.getElementById("centroCustoModal").value         = r[8];
            document.getElementById("contaContabilModal").value       = r[9];
            document.getElementById("historicoModal").value           = r[10];
            document.getElementById("idCondicaoPagamentoModal").value = r[11];
            var total = r[12];
            totalEditar = total;
            addLinhas(total);
             
           
        },
        error: function(e) {

        }
    }); 

}
function addLinhas(total){
           
    var idTituloModal   =   $('#idTituloModal').val();      
        
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=addLinhas',
        data: {
            total: total,
            idTituloModal: idTituloModal

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(html) {
                    
           document.getElementById('tabelaParcela').innerHTML = html;



        },
        error: function() {

        }
    });
    
    
}

function calcularValorfinalPagamentoDesconto(){
    
    var desconto   =   $('#descontoModalBaixa').val(); 
    var valorTotal   =   $('#pagamentoModalBaixa').val();
    
    desconto = desconto.replace("." , "");
    desconto = desconto.replace("." , "");
    desconto = desconto.replace("," , ".");
    valorTotal = valorTotal.replace("." , "");
    valorTotal = valorTotal.replace("." , "");
    valorTotal = valorTotal.replace("," , ".");
    
    
    if(desconto >= 0 && valorTotal >= 0){
        var novoValor = valorTotal - desconto;
        
         novoValor = numeroParaMoeda(novoValor);
    
        document.getElementById('pagamentoModalBaixa').value = novoValor;
        document.getElementById('valorPagarModalBaixa').value = novoValor;
        
    }
             
    
}
function calcularValorfinalPagamentoJuro(){
    
    var juros      =   $('#multaJurosModalBaixa').val(); 
    var valorTotal =   $('#pagamentoModalBaixa').val(); 
    
    juros = juros.replace("." , "");
    juros = juros.replace("." , "");
    juros = juros.replace("," , ".");
    valorTotal = valorTotal.replace("." , "");
    valorTotal = valorTotal.replace("." , "");
    valorTotal = valorTotal.replace("," , ".");
    
    
    if(juros >= 0 && valorTotal >= 0){
        
        var novoValor = parseInt(valorTotal) + parseInt(juros); 
        
        novoValor = numeroParaMoeda(novoValor);
       
        document.getElementById('pagamentoModalBaixa').value = novoValor;
        document.getElementById('valorPagarModalBaixa').value = novoValor;
    }
    
     
}

function calcularTotal(){
    

 
        var quantidade = document.getElementById("quantidade").value;
        
        
        
        
	var valorUnitario = document.getElementById("valorUnitario").value;	
	       
       
        quantidade = quantidade.replace("." , "");
        quantidade = quantidade.replace("." , "");
        quantidade = quantidade.replace("," , ".");
         
         
        
        valorUnitario = valorUnitario.replace("." , "");
        valorUnitario = valorUnitario.replace("." , "");
        valorUnitario = valorUnitario.replace("," , ".");
      
       
	                
        var calcularTotal = (valorUnitario * quantidade);
        
        
        calcularTotal = numeroParaMoeda(calcularTotal);
        document.getElementById("valorTotal").value = calcularTotal;

        
    }     
    
    
function numeroParaMoeda(n, c, d, t){
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}



/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mvalor(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares
	
    v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return v;
}

function salvarModalBaixa(){           
  

    var idModalBaixa                  = document.getElementById('idModalBaixa').value 
    var dataEmissaoModalBaixa         = document.getElementById("dataEmissaoModalBaixa").value;
    var documentoModalBaixa           = document.getElementById("documentoModalBaixa").value;
    var tipoCobrancaModalBaixa        = document.getElementById("tipoCobrancaModalBaixa").value;
    var documentoPagamentoModalBaixa  = document.getElementById("documetoPagamentoModalBaixa").value;
    var saldoDevedorModalBaixa        = document.getElementById("saldoDevedorModalBaixa").value;
    var multaJurosModalBaixa          = document.getElementById("multaJurosModalBaixa").value;
    var descontosModalBaixa           = document.getElementById("descontoModalBaixa").value;
    var valorPagarModalBaixa          = document.getElementById("valorPagarModalBaixa").value;
    var pagamentoModalBaixa           = document.getElementById("pagamentoModalBaixa").value;
    var idContaCorrenteModalBaixa     = document.getElementById("idContaCorrenteModalBaixa").value;
    var observacaoModalBaixa          = document.getElementById("observacaoModalBaixa").value;  
  
    var controleDePreenchimento = 'S';
 
    if(documentoPagamentoModalBaixa == ""){
        controleDePreenchimento = 'N';
    }
    if(idContaCorrenteModalBaixa == 0){
        controleDePreenchimento = 'N';
    }
       
    if(descontosModalBaixa == " "){
        descontosModalBaixa = 0;
    }
    if(multaJurosModalBaixa == " "){
        valorPagarModalBaixa = 0;
    }
       
        
    if(controleDePreenchimento ==  'S'){
 
        $.ajax({
            url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=salvarModalBaixa',
            data: {
                idModalBaixa: idModalBaixa,
                dataEmissaoModalBaixa: dataEmissaoModalBaixa,
                documentoModalBaixa: documentoModalBaixa,
                tipoCobrancaModalBaixa: tipoCobrancaModalBaixa,
                documentoPagamentoModalBaixa: documentoPagamentoModalBaixa,
                saldoDevedorModalBaixa: saldoDevedorModalBaixa,
                multaJurosModalBaixa: multaJurosModalBaixa,
                descontosModalBaixa: descontosModalBaixa,
                valorPagarModalBaixa: valorPagarModalBaixa,
                pagamentoModalBaixa: pagamentoModalBaixa,
                idContaCorrenteModalBaixa: idContaCorrenteModalBaixa,
                observacaoModalBaixa: observacaoModalBaixa

            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {

                if (data != false) {

                    mensagem('Sucesso', 'Salvo  com Sucesso', 'success');
                    atualizar();
                      $('#baixarModal').modal('hide');
               
                } else {
                    mensagem('Atenção', 'Erro ao salvar parcial', 'error');

                }

            },
            error: function() {

            }
        });
    }
    else{
        
       mensagem('Atenção', 'Prencher todos os campos', 'error'); 
        
    }
    
     
}
function editarBaixa(id){
        
    $('#pesquisarModal').modal('show');
    
    document.getElementById("idEmpresaModal").readOnly            = false;
    document.getElementById("idFilialModal").readOnly             = false;
    document.getElementById("idFornecedorModal").readOnly         = false;
    document.getElementById("dataEmissaoModal").readOnly          = false;
    document.getElementById("documentoModal").readOnly            = false;
    document.getElementById("valorTituloModal").readOnly          = false;
    document.getElementById("tipoCobrancaModal").readOnly         = false;
    document.getElementById("centroCustoModal").readOnly          = false;
    document.getElementById("contaContabilModal").readOnly        = false;
    document.getElementById("historicoModal").readOnly            = false;
    document.getElementById("idCondicaoPagamentoModal").readOnly  = false;
    
    var quantidadeDeParcelas;
    var idContaPagar;
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=editarBaixa',
        data: {
            id: id
       
        },
        type: 'POST',
        dataType: 'json',
        async: false,
        success: function(r) {
            
            
          
            
            document.getElementById("idTituloModal").value            = r[0];
            document.getElementById("idEmpresaModal").value           = r[1];
            document.getElementById("idFilialModal").value            = r[2];
            document.getElementById("idFornecedorModal").value        = r[3];
            document.getElementById("dataEmissaoModal").value         = r[4];
            document.getElementById("documentoModal").value           = r[5];
            document.getElementById("valorTituloModal").value         = r[6];
            document.getElementById("tipoCobrancaModal").value        = r[7];
            document.getElementById("centroCustoModal").value         = r[8];
            document.getElementById("idCondicaoPagamentoModal").value = r[9];
            document.getElementById("contaContabilModal").value       = r[10];
            document.getElementById("historicoModal").value           = r[11]; 
            quantidadeDeParcelas = r[12];
            idContaPagar = r[0];
          
           
           
        },
        error: function(e) {

        }
    });
    
   
    
    $.ajax({
        url: 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller&f=editarBaixaParcela',
        data: {
            quantidadeDeParcelas: quantidadeDeParcelas,
            idContaPagar: idContaPagar

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(data) {

         document.getElementById('tabelaParcela').innerHTML = data;



        },
        error: function(e) {

        }
    });
      
        
        
        
  
    
    
}