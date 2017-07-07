/////////////////////////////////////////////
// Cadastro Grupo Equipamento             ///
// EQP_GRUPO_EQUIPAMENTO 1.00             ///   
// Desenvolvido por Matheus Jaschke     ///
// Março de 2016                        ///
// VPI GESTAO                          ///
/////////////////////////////////////////

$(document).ready(function() {
  
  getGrid();
  carregarEmpresa();
  carregarFilial();
  carregarBanco();
  carregarAgencia();
   
    

});
function novo(){
    
    document.getElementById("idEmpresa").readOnly     = false;
    document.getElementById("idFilial").readOnly      = false;
    document.getElementById("idBanco").readOnly       = false;
    document.getElementById("agencia").readOnly       = false;
    document.getElementById("conta").readOnly         = false;
    document.getElementById("observacao").readOnly    = false;
  
    document.getElementById("idEmpresa").value        = 0;
    document.getElementById("idFilial").value         = 0;
    document.getElementById("idBanco").value          = 0;
    document.getElementById("agencia").value          = 0;
    document.getElementById("conta").value             = "";
    document.getElementById("observacao").value        = "";
    
          
}
    
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

function excluir(){
    
    var agencia   =   $('#agencia').val();
    var idEmpresa =   $('#idEmpresa').val();             
    var idFilial  =   $('#idFilial').val();
    var idBanco   =   $('#idBanco').val();
    var conta     =   $('#conta').val();
     
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=excluir',
        data: {
            agencia: agencia,
            idEmpresa: idEmpresa,
            idFilial: idFilial,
            idBanco: idBanco,
            conta: conta
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
            }
            else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            $('#basicModal').modal('hide');
            atualizar();
            

        }
    }); 
     
}


function pesquisar() {
    
   
    $('#pesquisarModal').modal('show');
    
    document.getElementById("codBanco").value           = "";
    document.getElementById("nome").value               = "";
    document.getElementById("observacao").value         = "";
    document.getElementById("idEmpresa").value          = 0;
    document.getElementById("idFilial").value           = 0;
    
     
}

function editar(){
        
    document.getElementById("observacao").readOnly      = false;
   
   
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("idEmpresa").readOnly     = true;
    document.getElementById("idFilial").readOnly      = true;
    document.getElementById("idBanco").readOnly       = true;
    document.getElementById("agencia").readOnly       = true;
    document.getElementById("conta").readOnly         = true;
    document.getElementById("observacao").readOnly    = true;
      
   
    
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=buscaPrimeiroRegistro',
        data: {
       
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
function buscaRegistroAnterior(){
    
    document.getElementById("idEmpresa").readOnly     = true;
    document.getElementById("idFilial").readOnly      = true;
    document.getElementById("idBanco").readOnly       = true;
    document.getElementById("agencia").readOnly       = true;
    document.getElementById("conta").readOnly         = true;
    document.getElementById("observacao").readOnly    = true;
    
    
    var agencia   =   $('#agencia').val();
    var idEmpresa =   $('#idEmpresa').val();             
    var idFilial  =   $('#idFilial').val();
    var idBanco   =   $('#idBanco').val();
    var conta     =   $('#conta').val();
   
    
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=buscaRegistroAnterior',
        data: {
            idEmpresa: idEmpresa,
            idFilial: idFilial,
            idBanco: idBanco,
            agencia: agencia,
            conta: conta
            
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("idEmpresa").value     = r[0];
                document.getElementById("idFilial").value      = r[1];
                document.getElementById("idBanco").value       = r[2];
                document.getElementById("agencia").value       = r[3];
                document.getElementById("conta").value         = r[4];   
                document.getElementById("observacao").value    = r[5];   
                            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("idEmpresa").readOnly     = true;
    document.getElementById("idFilial").readOnly      = true;
    document.getElementById("idBanco").readOnly       = true;
    document.getElementById("agencia").readOnly       = true;
    document.getElementById("conta").readOnly         = true;
    document.getElementById("observacao").readOnly    = true;
    
       
    var agencia   =   $('#agencia').val();
    var idEmpresa =   $('#idEmpresa').val();             
    var idFilial  =   $('#idFilial').val();
    var idBanco   =   $('#idBanco').val();
    var conta     =   $('#conta').val();
   
    
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=buscaRegistroProximo',
        data: {
            idEmpresa: idEmpresa,
            idFilial: idFilial,
            idBanco: idBanco,
            agencia: agencia,
            conta: conta
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idEmpresa").value     = r[0];
                document.getElementById("idFilial").value      = r[1];
                document.getElementById("idBanco").value       = r[2];
                document.getElementById("agencia").value       = r[3];
                document.getElementById("conta").value         = r[4];   
                document.getElementById("observacao").value    = r[5];  
                      
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idEmpresa").readOnly     = true;
    document.getElementById("idFilial").readOnly      = true;
    document.getElementById("idBanco").readOnly       = true;
    document.getElementById("agencia").readOnly       = true;
    document.getElementById("conta").readOnly         = true;
    document.getElementById("observacao").readOnly    = true;
    
      
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=buscaUltimoRegistro',
        data: {
       
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
 
    $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=cadastroconta&c=cadastrocontacontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "BANCO"},
            {"data": "AGENCIA"},
            {"data": "CONTA"},
            {"data": "SELECIONAR"},
          
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
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
function atualizar(){
     
    getGrid();
  
    document.getElementById("idEmpresa").value        = 0;
    document.getElementById("idFilial").value         = 0;
    document.getElementById("idBanco").value          = 0;
    document.getElementById("agencia").value          = 0;
    document.getElementById("conta").value             = "";
    document.getElementById("observacao").value        = "";
    
           
  
             
    
}

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastrobanco&c=cadastrobancocontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idEmpresa').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}


function carregarFilial(){
    
    var idEmpresa = document.getElementById("idEmpresa").value;
    
           
    $.ajax({
        url: 'index.php?m=cadastrobanco&c=cadastrobancocontroller&f=carregarFilial',
        data: {
            idEmpresa: idEmpresa
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idFilial').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Filial', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarBanco(){
    
    var idEmpresa = document.getElementById("idEmpresa").value;
    var idFilial  = document.getElementById("idFilial").value;
           
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=carregarBanco',
        data: {
            idEmpresa: idEmpresa,
            idFilial: idFilial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idBanco').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  bancos', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarAgencia(){
    
    var idEmpresa = document.getElementById("idEmpresa").value;
    var idFilial  = document.getElementById("idFilial").value;
    var idBanco   = document.getElementById("idBanco").value;
           
    $.ajax({
        url: 'index.php?m=cadastroconta&c=cadastrocontacontroller&f=carregarAgencia',
        data: {
            idEmpresa: idEmpresa,
            idFilial: idFilial,
            idBanco: idBanco
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('agencia').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  bancos', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}








//////////////////////////////////////////////////////////////
//         FUNÇÕES EPECÍFICAS PARA ESSE BRD                //         
/////////////////////////////////////////////////////////////


function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
   
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}
function mascara(telefone1){ 
    if(telefone1.value.length == 0){
         telefone1.value = '(' + telefone1.value;
    }     
    if(telefone1.value.length == 3){
        telefone1.value = telefone1.value + ') ';
    }    
    if(telefone1.value.length == 9){
        telefone1.value = telefone1.value + '-'; 
    }
}

function mascaraCNPJ(cnpj){
    
    if(cnpj.value.length == 2){
      cnpj.value =  cnpj.value + '.';
    }  
    if(cnpj.value.length == 6){
      cnpj.value = cnpj.value + '.';
    }  
    if(cnpj.value.length == 10){
      cnpj.value = cnpj.value + '/';
    }  
    if(cnpj.value.length == 15){
      cnpj.value = cnpj.value + '-';
    }       
}

function mascaraCEP(cep){
    
    if(cep.value.length == 5){
      cep.value =  cep.value + '-';
    }  
    
}

