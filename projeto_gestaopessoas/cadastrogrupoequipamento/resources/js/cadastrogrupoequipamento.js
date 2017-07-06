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
 
            
    

});
function novo(){
    
    document.getElementById("codGrupo").readOnly        = false;
    document.getElementById("descricaoGrupo").readOnly  = false;
    document.getElementById("idEmpresa").readOnly       = false;
    document.getElementById("idFilial").readOnly        = false;
    document.getElementById("codGrupo").value           = "";
    document.getElementById("descricaoGrupo").value     = "";
    document.getElementById("idEmpresa").value          = 0;
    
          
}
    
function salvar(){
     
    var codGrupo          =   $('#codGrupo').val();             
    var descricaoGrupo    =   $('#descricaoGrupo').val();
    var idEmpresa         =   $('#idEmpresa').val();             
    var idFilial          =   $('#idFilial').val();
     
       
    var controleDePreenchimento = 'S';
 
    if(codGrupo == ""){
        controleDePreenchimento = 'N';
    }
    if(descricaoGrupo == ""){
        controleDePreenchimento = 'N';
    }
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == 0){
        controleDePreenchimento = 'N';
    }
        
    if(controleDePreenchimento ==  'S'){
 
                   
        document.getElementById("codGrupo").readOnly = true;
        document.getElementById("descricaoGrupo").readOnly = true;
        document.getElementById("idEmpresa").readOnly = true;
        document.getElementById("idFilial").readOnly = true;
        
      

        $.ajax({
            url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=salvar',
            data: {
                codGrupo: codGrupo,
                descricaoGrupo:  descricaoGrupo,
                idEmpresa: idEmpresa,
                idFilial: idFilial
                
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
    
    var codGrupo  =   $('#codGrupo').val();
     
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=excluir',
        data: {
            codGrupo: codGrupo
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
    

    document.getElementById("descricaoGrupo").readOnly        = false;
    document.getElementById("idEmpresa").readOnly       = false;
    document.getElementById("idFilial").readOnly        = false;
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("codGrupo").readOnly        = true;
    document.getElementById("descricaoGrupo").readOnly  = true;
    document.getElementById("idEmpresa").readOnly       = true;
    document.getElementById("idFilial").readOnly        = true;
   
   
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("codGrupo").value          = r[0];
            document.getElementById("descricaoGrupo").value    = r[1];
            document.getElementById("idEmpresa").value         = r[2];
            document.getElementById("idFilial").value          = r[3];   
                                     
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("codGrupo").readOnly        = true;
    document.getElementById("descricaoGrupo").readOnly  = true;
    
    
    var codGrupo  =  $('#codGrupo').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaRegistroAnterior',
        data: {
            codGrupo: codGrupo
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("codGrupo").value          = r[0];
                document.getElementById("descricaoGrupo").value    = r[1];
                document.getElementById("idEmpresa").value         = r[2];
                document.getElementById("idFilial").value          = r[3];  
                            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("codGrupo").readOnly       = true;
    document.getElementById("descricaoGrupo").readOnly        = true;
    
       
    var codGrupo  =  $('#codGrupo').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaRegistroProximo',
        data: {
            codGrupo: codGrupo
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("codGrupo").value          = r[0];
                document.getElementById("descricaoGrupo").value    = r[1];
                document.getElementById("idEmpresa").value         = r[2];
                document.getElementById("idFilial").value          = r[3];  
                      
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("codGrupo").readOnly       = true;
    document.getElementById("descricaoGrupo").readOnly        = true;
    
      
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("codGrupo").value          = r[0];
            document.getElementById("descricaoGrupo").value    = r[1];
            document.getElementById("idEmpresa").value         = r[2];
            document.getElementById("idFilial").value          = r[3];  
             
           
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
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("codGrupo").value          = r[0];
            document.getElementById("descricaoGrupo").value    = r[1];
            document.getElementById("idEmpresa").value         = r[2];
            document.getElementById("idFilial").value          = r[3];  
                               
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
            "url": "index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "COD_GRUPO"},
            {"data": "DESCRICAO"},
            {"data": "SELECIONAR"},
          
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
 }
 
 function selecionaGrid(idGrupo){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("codGrupo").readOnly              = true;
    document.getElementById("descricaoGrupo").readOnly        = true;
    document.getElementById("idEmpresa").readOnly             = true;
    document.getElementById("idFilial").readOnly              = true;
   
    
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=selecionaGrid',
        data: {
            idGrupo: idGrupo
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                      
            document.getElementById("codGrupo").value           = r[0];
            document.getElementById("descricaoGrupo").value     = r[1];            
            document.getElementById("idEmpresa").value       = r[2];
            document.getElementById("idFilial").value        = r[3];       
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
   getGrid();
  
   $(window).bind('resize', function() {
        $("#grid").setGridWidth($(window).width() - 10);
   }).trigger('resize');
           
  
   document.getElementById("idEmpresa").value          = "";
   document.getElementById("razaoSocial").value        = "";
   document.getElementById("idEmpresa").value          = "";
   document.getElementById("razaoSocial").value        = "";
             
    
}

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=carregarEmpresa',
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
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=carregarFilial',
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

