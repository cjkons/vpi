///////////////////////////////////////////////
/// Cadastro de Tipo Epi                    ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

$(document).ready(function() {

  
 getGrid();
 
            
    

});

function novo(){
    
    
    document.getElementById("tipoEpi").readOnly   = false;
    document.getElementById("descricao").readOnly   = false;
     
    document.getElementById("idEpiTipo").value         = "";
    document.getElementById("tipoEpi").value    = "";
    document.getElementById("descricao").value    = "";
   
         
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            
             document.getElementById("idEpiTipo").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
     
    var idEpiTipo       =   $('#idEpiTipo').val();             
    var tipoEpi         =   $('#tipoEpi').val();           
    var descricao       =   $('#descricao').val();      
     
           
    var controleDePreenchimento = 'S';
 
    if(idEpiTipo == ""){
        controleDePreenchimento = 'N';
    }
    if(tipoEpi == ""){
        controleDePreenchimento = 'N';
    }
    if(descricao == ""){
        controleDePreenchimento = 'N';
    }
     
    
    if(controleDePreenchimento ==  'S'){
        
            document.getElementById("tipoEpi").readOnly     = true;
            document.getElementById("descricao").readOnly   = true;
            
      
      
      
            $.ajax({
                url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=salvar',
                data: {
                    idEpiTipo: idEpiTipo,
                    tipoEpi: tipoEpi,
                    descricao: descricao
                   
                },
                type: 'POST',
                dataType: 'json',
                async: true,
                success: function(r) {
                    
                   if( r == true){                  
                        mensagem('Sucesso', 'Salvo com sucesso', 'success');
                        $('#basicModal').modal('hide');
                        atualizar();
                        getGrid();
                   }
                   else{
                         mensagem('Sucesso', 'Salvo com sucesso', 'success');
                        $('#basicModal').modal('hide');
                        getGrid();
                       
                       
                   }
                },
                error: function(e) {
                      mensagem('Atenção', 'Erro ao salvar', 'error'); 
                }
            }); 
              
        
        
    }
    else{
        
          mensagem('Atenção', 'Prencha todos os campos', 'alert');
        
       // mensagens de erro
        
          
    }
    
}

function excluir(){
    
    var idEpiTipo  =   $('#cadastroepitipo&c=cadastroepitipocontroller').val();
     
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=excluir',
        data: {
            idEpiTipo: idEpiTipo
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
                getGrid();
            }
            else {
                 mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
                getGrid();
            }
        },
        error: function(e) {
              mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
                getGrid();
        }
    }); 
     
}

function validarExcluir(){
    $('#excluirModal').modal('show');
}

function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("idPesquisarInicio").value   = "";
    document.getElementById("idPesquisarFim").value      = "";
    document.getElementById("nomePesquisarInicio").value = "";
    document.getElementById("nomePesquisarFim").checkd   = "";
  
}

function editar(){
    
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = false;
    document.getElementById("descricao").readOnly   = false;
    
    
   
    
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = true;
    document.getElementById("descricao").readOnly   = true;
    
    
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idEpiTipo").value = r[0];
            document.getElementById("tipoEpi").value = r[1];
            document.getElementById("descricao").value = r[2];
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = true;
    document.getElementById("descricao").readOnly   = true;    
    
    
    var idEpiTipo  =  $('#idEpiTipo').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=buscaRegistroAnterior',
        data: {
            idEpiTipo: idEpiTipo
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idEpiTipo").value = r[0];
                document.getElementById("tipoEpi").value = r[1];
                document.getElementById("descricao").value = r[2];
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = true;
    document.getElementById("descricao").readOnly   = true;
    
    
    var idEpiTipo  =  $('#idEpiTipo').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=buscaRegistroProximo',
        data: {
            idEpiTipo: idEpiTipo
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idEpiTipo").value = r[0];
                document.getElementById("tipoEpi").value = r[1];
                document.getElementById("descricao").value = r[2];
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = true;
    document.getElementById("descricao").readOnly   = true;
    
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
                document.getElementById("idEpiTipo").value = r[0];
                document.getElementById("tipoEpi").value = r[1];
                document.getElementById("descricao").value = r[2];
            
           
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
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                document.getElementById("idEpiTipo").value = r[0];
                document.getElementById("tipoEpi").value = r[1];
                document.getElementById("descricao").value = r[2];
            
            
        
            $('#pesquisarModal').modal('hide');          
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function getGrid() {
          
    
    ///////////
    
    
     $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EPI_TIPO"},
            {"data": "EQUIPAMENTO"},
            {"data": "DESCRICAO"},
            {"data": "SELECIONAR"},
            
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
 }
 
 function selecionaGrid(idEpiTipo){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = true;
    document.getElementById("descricao").readOnly   = true;
    
    
    $.ajax({
        url: 'index.php?m=cadastroepitipo&c=cadastroepitipocontroller&f=selecionaGrid',
        data: {
            idEpiTipo: idEpiTipo
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idEpiTipo").value = r[0];
            document.getElementById("tipoEpi").value = r[1];
            document.getElementById("descricao").value = r[2];
            
        
            $('#pesquisarModal').modal('hide');            
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
    
  
    document.getElementById("idEpiTipo").readOnly   = true;
    document.getElementById("tipoEpi").readOnly     = true;
    document.getElementById("descricao").readOnly   = true;
    
    document.getElementById("idEpiTipo").value = "";
    document.getElementById("tipoEpi").value = "";
    document.getElementById("descricao").value = "";
 
    
    $('#ativoUsuario').prop('checked', false);
    
    
            
    
}





