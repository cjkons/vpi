/////////////////////////////////////////////
// Cadastro Grupo Equipamento             ///
// EQP_GRUPO_EQUIPAMENTO 1.00             ///   
// Desenvolvido por Matheus Jaschke     ///
// Março de 2016                        ///
// VPI GESTAO                          ///
/////////////////////////////////////////

$(document).ready(function() {
    
  var carregar;
  
  getGrid();
  carregarEmpresa();
  carregarFilial();
  carregarGrupo();
  
  $('#dataAquisicao').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
  
  
  
 
 
            
    

});
function novo(){
    
    document.getElementById("idEmpresa").readOnly      = false;
    document.getElementById("idFilial").readOnly       = false;
    document.getElementById("codGrupo").readOnly       = false;
    document.getElementById("codEquipamento").readOnly = false;
    document.getElementById("descricao").readOnly      = false;
    document.getElementById("placa").readOnly          = false;
    document.getElementById("ano").readOnly            = false;
    document.getElementById("marca").readOnly          = false;
    document.getElementById("kmCadastro").readOnly     = false;
    document.getElementById("apelido").readOnly        = false;
    document.getElementById("dataAquisicao").readOnly  = false;
    document.getElementById("ativo").readOnly          = false;
    document.getElementById("imagem").readOnly         = false;
    document.getElementById('ativo').disabled          = false; 
    
    
    document.getElementById("idEmpresa").value      = 0;
    document.getElementById("idFilial").value       = 0;
    document.getElementById("codGrupo").value       = 0;
    document.getElementById("codEquipamento").value = "";
    document.getElementById("descricao").value      = "";
    document.getElementById("placa").value          = "";
    document.getElementById("ano").value            = "";
    document.getElementById("marca").value          = "";
    document.getElementById("kmCadastro").value     = "";
    document.getElementById("apelido").value        = "";
    document.getElementById("dataAquisicao").value  = "";
    document.getElementById("imagem").value         = "";
    
    $('#ativo').prop('checked', false);
    
    
          
}




function salvar() {

    var idEmpresa = $('#idEmpresa').val();
    var idFilial = $('#idFilial').val();
    var codGrupo = $('#codGrupo').val();
    var codEquipamento = $('#codEquipamento').val();
    var descricao = $('#descricao').val();
    var placa = $('#placa').val();
    var ano = $('#ano').val();
    var marca = $('#marca').val();
    var kmCadastro = $('#kmCadastro').val();
    var apelido = $('#apelido').val();
    var dataAquisicao = $('#dataAquisicao').val();
    var imagem = $('#imagem').val();



    var controleDePreenchimento = 'S';

    if (idEmpresa == "") {
        controleDePreenchimento = 'N';
    }
    if (idFilial == "") {
        controleDePreenchimento = 'N';
    }
    if (codGrupo == 0) {
        controleDePreenchimento = 'N';
    }
    if (codEquipamento == 0) {
        controleDePreenchimento = 'N';
    }
    if (descricao == "") {
        controleDePreenchimento = 'N';
    }
    if (placa == "") {
        controleDePreenchimento = 'N';
    }
    if (ano == 0) {
        controleDePreenchimento = 'N';
    }
    if (marca == 0) {
        controleDePreenchimento = 'N';
    }
    if (kmCadastro == "") {
        controleDePreenchimento = 'N';
    }
    if (apelido == "") {
        controleDePreenchimento = 'N';
    }
    if (dataAquisicao == 0) {
        controleDePreenchimento = 'N';
    }
    if (idFilial == 0) {
        controleDePreenchimento = 'N';
    }
    if ($("#ativo").is(':checked') == true) {
        var ativo = 'S';
    } else {
        var ativo = 'N';
    }


    if (controleDePreenchimento == 'S') {


        document.getElementById("idEmpresa").readOnly = true;
        document.getElementById("idFilial").readOnly = true;
        document.getElementById("codGrupo").readOnly = true;
        document.getElementById("codEquipamento").readOnly = true;
        document.getElementById("descricao").readOnly = true;
        document.getElementById("placa").readOnly = true;
        document.getElementById("ano").readOnly = true;
        document.getElementById("marca").readOnly = true;
        document.getElementById("kmCadastro").readOnly = true;
        document.getElementById("apelido").readOnly = true;
        document.getElementById("dataAquisicao").readOnly = true;
        document.getElementById("ativo").readOnly = true;
        document.getElementById('ativo').disabled = true;

// SE FOR INSERIDO IMAGEM 
        if (imagem != "") {


            var fd1 = new FormData();

            fd1.append('anexo1', document.getElementById('imagem').files[0]);


            $.ajax({
                url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=salvarAnexoImagem',
                type: 'POST',
                cache: false,
                data: fd1,
                processData: false,
                contentType: false,
                async: false,
                success: function (enderecoAnexo, pasta) {


                    $.ajax({
                        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=salvar',
                        data: {
                            imagem: enderecoAnexo,
                            idEmpresa: idEmpresa,
                            idFilial: idFilial,
                            codGrupo: codGrupo,
                            codEquipamento: codEquipamento,
                            descricao: descricao,
                            placa: placa,
                            ano: ano,
                            marca: marca,
                            kmCadastro: kmCadastro,
                            apelido: apelido,
                            dataAquisicao: dataAquisicao,
                            ativo: ativo


                        },
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        success: function (r) {

                            if (r == true) {
                                mensagem('Sucesso', 'Salvo com sucesso', 'success');
                                $('#basicModal').modal('hide');
                                atualizar();
                            } else {
                                mensagem('Atenção', 'Erro ao salvar', 'error');
                                atualizar();
                            }
                        },
                        error: function (e) {
                            mensagem('Atenção', 'Erro ao salvar', 'error');

                        }

                    });
                }
            });
    // SE NAO FOR INSERIDO IMAGEM         
        } else {
            $.ajax({
                url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=salvar',
                data: {
                    
                    idEmpresa: idEmpresa,
                    idFilial: idFilial,
                    codGrupo: codGrupo,
                    codEquipamento: codEquipamento,
                    descricao: descricao,
                    placa: placa,
                    ano: ano,
                    marca: marca,
                    kmCadastro: kmCadastro,
                    apelido: apelido,
                    dataAquisicao: dataAquisicao,
                    ativo: ativo


                },
                type: 'POST',
                dataType: 'json',
                async: true,
                success: function (r) {

                    if (r == true) {
                        mensagem('Sucesso', 'Salvo com sucesso', 'success');
                        $('#basicModal').modal('hide');
                        atualizar();
                    } else {
                        mensagem('Atenção', 'Erro ao salvar', 'error');
                        atualizar();
                    }
                },
                error: function (e) {
                    mensagem('Atenção', 'Erro ao salvar', 'error');

                }

            });

        }

    } else {
        mensagem('Atenção', 'Prencha todos os campos', 'alert');


    }

}

function excluir(){
    
    var codEquipamento  =   $('#codEquipamento').val();
     
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=excluir',
        data: {
            codEquipamento: codEquipamento
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
    
    document.getElementById("idPesquisarInicio").value   = "";
    document.getElementById("idPesquisarFim").value      = "";
    document.getElementById("nomePesquisarInicio").value = "";
    document.getElementById("nomePesquisarFim").value   = "";
    
     
}

function editar(){
    
    document.getElementById("idEmpresa").readOnly      = false;
    document.getElementById("idFilial").readOnly       = false;
    document.getElementById("codGrupo").readOnly       = false;
    document.getElementById("descricao").readOnly      = false;
    document.getElementById("placa").readOnly          = false;
    document.getElementById("ano").readOnly            = false;
    document.getElementById("marca").readOnly          = false;
    document.getElementById("kmCadastro").readOnly     = false;
    document.getElementById("apelido").readOnly        = false;
    document.getElementById("dataAquisicao").readOnly  = false;
    document.getElementById("ativo").readOnly          = false;
    document.getElementById("imagem").readOnly         = false;
    document.getElementById('ativo').disabled          = false; 
    
    
}


function buscaPrimeiroRegistro(){
    
        
        document.getElementById("idEmpresa").readOnly      = true;
        document.getElementById("idFilial").readOnly       = true;
        document.getElementById("codGrupo").readOnly       = true;
        document.getElementById("codEquipamento").readOnly = true;
        document.getElementById("descricao").readOnly      = true;
        document.getElementById("placa").readOnly          = true;
        document.getElementById("ano").readOnly            = true;
        document.getElementById("marca").readOnly          = true;
        document.getElementById("kmCadastro").readOnly     = true;
        document.getElementById("apelido").readOnly        = true;
        document.getElementById("dataAquisicao").readOnly  = true;
        document.getElementById("ativo").readOnly          = true;
        document.getElementById("imagem").readOnly         = true;
        document.getElementById('ativo').disabled          = true; 
        document.getElementById('imagemView').innerHTML = ""; 
   
        
    
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("idEmpresa").value      = r[0];
            document.getElementById("idFilial").value       = r[1];
            document.getElementById("codGrupo").value       = r[2];
            document.getElementById("codEquipamento").value = r[3];
            document.getElementById("descricao").value      = r[4];
            document.getElementById("placa").value          = r[5];
            document.getElementById("ano").value            = r[6];
            document.getElementById("marca").value          = r[7]; 
            document.getElementById("kmCadastro").value     = r[8];
            document.getElementById("apelido").value        = r[9];
            document.getElementById("dataAquisicao").value  = r[10];
            document.getElementById("imagemView").value     = r[11];
            
            if(r[12] == 'S' ){
                  $('#ativo').prop('checked', true);
            }
            else{
                 $('#ativo').prop('checked', false);
                
            }
            
            var imagemView = r[11];
                
            carregarImagem(imagemView);  
           
                                     
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
     
    document.getElementById("idEmpresa").readOnly      = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("codGrupo").readOnly = true;
    document.getElementById("codEquipamento").readOnly = true;
    document.getElementById("descricao").readOnly = true;
    document.getElementById("placa").readOnly = true;
    document.getElementById("ano").readOnly = true;
    document.getElementById("marca").readOnly = true;
    document.getElementById("kmCadastro").readOnly = true;
    document.getElementById("apelido").readOnly = true;
    document.getElementById("dataAquisicao").readOnly = true;
    document.getElementById("ativo").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById('ativo').disabled = true; 
     document.getElementById('imagemView').innerHTML = ""; 
    
    
    var codEquipamento  =  $('#codEquipamento').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=buscaRegistroAnterior',
        data: {
            codEquipamento: codEquipamento
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("idEmpresa").value      = r[0];
                document.getElementById("idFilial").value       = r[1];
                document.getElementById("codGrupo").value       = r[2];
                document.getElementById("codEquipamento").value = r[3];
                document.getElementById("descricao").value      = r[4];
                document.getElementById("placa").value          = r[5];
                document.getElementById("ano").value            = r[6];
                document.getElementById("marca").value          = r[7]; 
                document.getElementById("kmCadastro").value     = r[8];
                document.getElementById("apelido").value        = r[9];
                document.getElementById("dataAquisicao").value  = r[10];
                document.getElementById("imagemView").value         = r[11];

                if(r[12] == 'S' ){
                      $('#ativo').prop('checked', true);
                }
                else{
                     $('#ativo').prop('checked', false);

                } 
                
                var imagemView = r[11];
                
                carregarImagem(imagemView); 
                            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
     
    document.getElementById("idEmpresa").readOnly      = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("codGrupo").readOnly = true;
    document.getElementById("codEquipamento").readOnly = true;
    document.getElementById("descricao").readOnly = true;
    document.getElementById("placa").readOnly = true;
    document.getElementById("ano").readOnly = true;
    document.getElementById("marca").readOnly = true;
    document.getElementById("kmCadastro").readOnly = true;
    document.getElementById("apelido").readOnly = true;
    document.getElementById("dataAquisicao").readOnly = true;
    document.getElementById("ativo").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById('ativo').disabled = true; 
     document.getElementById('imagemView').innerHTML = ""; 
    
    
       
    var codEquipamento  =  $('#codEquipamento').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=buscaRegistroProximo',
        data: {
            codEquipamento: codEquipamento
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idEmpresa").value      = r[0];
                document.getElementById("idFilial").value       = r[1];
                document.getElementById("codGrupo").value       = r[2];
                document.getElementById("codEquipamento").value = r[3];
                document.getElementById("descricao").value      = r[4];
                document.getElementById("placa").value          = r[5];
                document.getElementById("ano").value            = r[6];
                document.getElementById("marca").value          = r[7]; 
                document.getElementById("kmCadastro").value     = r[8];
                document.getElementById("apelido").value        = r[9];
                document.getElementById("dataAquisicao").value  = r[10];
                document.getElementById("imagemView").value         = r[11];

                if(r[12] == 'S' ){
                      $('#ativo').prop('checked', true);
                }
                else{
                     $('#ativo').prop('checked', false);

                }  
                
                var imagemView = r[11];
                carregarImagem(imagemView);  
                      
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
     
    document.getElementById("idEmpresa").readOnly      = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("codGrupo").readOnly = true;
    document.getElementById("codEquipamento").readOnly = true;
    document.getElementById("descricao").readOnly = true;
    document.getElementById("placa").readOnly = true;
    document.getElementById("ano").readOnly = true;
    document.getElementById("marca").readOnly = true;
    document.getElementById("kmCadastro").readOnly = true;
    document.getElementById("apelido").readOnly = true;
    document.getElementById("dataAquisicao").readOnly = true;
    document.getElementById("ativo").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById('ativo').disabled = true; 
    document.getElementById('imagemView').innerHTML = ""; 
      
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idEmpresa").value      = r[0];
            document.getElementById("idFilial").value       = r[1];
            document.getElementById("codGrupo").value       = r[2];
            document.getElementById("codEquipamento").value = r[3];
            document.getElementById("descricao").value      = r[4];
            document.getElementById("placa").value          = r[5];
            document.getElementById("ano").value            = r[6];
            document.getElementById("marca").value          = r[7]; 
            document.getElementById("kmCadastro").value     = r[8];
            document.getElementById("apelido").value        = r[9];
            document.getElementById("dataAquisicao").value  = r[10];
            document.getElementById("imagemView").value     = r[11];

            if(r[12] == 'S' ){
                $('#ativo').prop('checked', true);
            }
            else{
                $('#ativo').prop('checked', false);
            }  
            
            
            var imagemView = r[11];
            carregarImagem(imagemView);  
           
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
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("idEmpresa").value      = r[0];
            document.getElementById("idFilial").value       = r[1];
            document.getElementById("codGrupo").value       = r[2];
            document.getElementById("codEquipamento").value = r[3];
            document.getElementById("descricao").value      = r[4];
            document.getElementById("placa").value          = r[5];
            document.getElementById("ano").value            = r[6];
            document.getElementById("marca").value          = r[7]; 
            document.getElementById("kmCadastro").value     = r[8];
            document.getElementById("apelido").value        = r[9];
            document.getElementById("dataAquisicao").value  = r[10];
            document.getElementById("imagemView").value         = r[11];

            if(r[12] == 'S' ){
                $('#ativo').prop('checked', true);
            }
            else{
                $('#ativo').prop('checked', false);
            }  
            
            var imagemView = r[11];
            carregarImagem(imagemView);
                               
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
            "url": "index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "COD_EQUIPAMENTO"},
            {"data": "COD_GRUPO"},
            {"data": "PLACA"},
            {"data": "APELIDO"},
            {"data": "DESCRICAO"},
            {"data": "SELECIONAR"},
          
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
 }
 
 function selecionaGrid(idEquipamento){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idEmpresa").readOnly      = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("codGrupo").readOnly = true;
    document.getElementById("codEquipamento").readOnly = true;
    document.getElementById("descricao").readOnly = true;
    document.getElementById("placa").readOnly = true;
    document.getElementById("ano").readOnly = true;
    document.getElementById("marca").readOnly = true;
    document.getElementById("kmCadastro").readOnly = true;
    document.getElementById("apelido").readOnly = true;
    document.getElementById("dataAquisicao").readOnly = true;
    document.getElementById("ativo").readOnly = true;
    document.getElementById("imagem").readOnly = true;
    document.getElementById('ativo').disabled = true; 
   
    
    
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=selecionaGrid',
        data: {
            idEquipamento: idEquipamento
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: false,
        success: function(r) {
                      
            document.getElementById("idEmpresa").value      = r[0];
            document.getElementById("idFilial").value       = r[1];
            
            carregarGrupo();
            
            
            document.getElementById("codEquipamento").value = r[3];
            document.getElementById("descricao").value      = r[4];
            document.getElementById("placa").value          = r[5];
            document.getElementById("ano").value            = r[6];
            document.getElementById("marca").value          = r[7]; 
            document.getElementById("kmCadastro").value     = r[8];
            document.getElementById("apelido").value        = r[9];
            document.getElementById("dataAquisicao").value  = r[10];
            document.getElementById("imagemView").value         = r[11];

            if(r[12] == 'S' ){
                $('#ativo').prop('checked', true);
            }
            else{
                $('#ativo').prop('checked', false);
            }     
            document.getElementById("codGrupo").value       = r[2];  
            
            var imagemView = r[11];
            carregarImagem(imagemView);
            
            $('#pesquisarModal').modal('hide');                
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
    getGrid();
  
  
  
    document.getElementById("idEmpresa").value = 0;
    document.getElementById("idFilial").value = 0;
    document.getElementById("codGrupo").value = 0;
    document.getElementById("codEquipamento").value = "";
    document.getElementById("descricao").value = "";
    document.getElementById("placa").value = "";
    document.getElementById("ano").value = "";
    document.getElementById("marca").value = "";
    document.getElementById("kmCadastro").value = "";
    document.getElementById("apelido").value = "";
    document.getElementById("dataAquisicao").value = "";
    document.getElementById("imagem").value = "";

    $('#ativo').prop('checked', false);
             
    
}

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=carregarEmpresa',
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
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=carregarFilial',
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
function carregarGrupo(){
    
    var idEmpresa = document.getElementById("idEmpresa").value;
    var idFilial = document.getElementById("idEmpresa").value;
           
    $.ajax({
        url: 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller&f=carregarGrupo',
        data: {
            idEmpresa: idEmpresa,
            idFilial: idFilial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('codGrupo').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  grupo equipamento', 'error'); 
               
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

/// CARREGAMENTO DE IMAGEM EM TELA, APOS SALVA


function carregarImagem( img ){
    
    var caminho = img.substr(61);
    
    
    carregar = new Image();
    carregar.src = "/gestaoativos/fwk/uploadsEquipamentos/imagens" + caminho;
    
    document.getElementById("imagemView").innerHTML = "Carregando...";
    setTimeout( "verificaCarregamento()", 1 );
}
 



function verificaCarregamento(){
    
    if( carregar.complete )
    {
        document.getElementById("imagemView").innerHTML = "<img src=\"" 
                + carregar.src + " \" style='max-width:350px; max-height:300; onclick='abrirImagem()' />";
    }
    else
    {
        setTimeout( "verificaCarregamento()", 1 );
    }
}


function ampliarImagem() {

    var anexoMedicaoView = $('#imagemView').val();
    
    
    if (anexoMedicaoView == '') {
        
        mensagem('Atenção', 'Sem Imagem anexada!', 'r', 'i', 2000, 1);
    
    } else {

        var anexoMedicaoView = anexoMedicaoView.substr(61);


        var enderecoMedicao = "http://localhost/gestaoativos/fwk/uploadsEquipamentos/imagens"; // localhost
        //var enderecoMedicao = "http://sig.sulcatarinense.com.br/uploadsPermuta/Medicoes/"; // servidor

        window.open(enderecoMedicao + anexoMedicaoView, '_blank');
    }
}




// Mensagens de Alerta


function mensagem(titulo, mensagem, orientacao, tipoMensagem, overlay, opacidade) {


    if (titulo != "") {
        mensagem = "<div style='font-size: 15px;' align='center'><b>" + titulo + "</b></div><br /><p align='center'>" + mensagem + "</p>";
    }

    var o = 'right';
    switch (orientacao) {
        case 'r':
            o = 'right';
            break;
        case 'l':
            o = 'left';
            break;
        case 't':
            o = 'top';
            break;
        case 'b':
            o = 'bottom';
            break;
        default:
            o = 'right';
            break;
    }

    var w = 'info';
    switch (tipoMensagem) {
        case 'i':
            w = 'info';
            break;
        case 'e':
            w = 'error';
            break;
        case 'w':
            w = 'warning';
            break;
        case 's':
            w = 'success';
            break;
        default:
            w = 'info';
            break;
    }

    notif({
        type: w,
        msg: mensagem,
        position: o,
        opacity: opacidade,
        multiline: true,
        time: overlay
    });

}



