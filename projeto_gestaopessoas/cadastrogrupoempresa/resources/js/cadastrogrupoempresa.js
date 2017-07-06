///////////////////////////////////////////////
/// Cadastro de Grupo Empresa               ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////


$(document).ready(function() {
    
  getGrid();
    

});
function novo(){
        
    document.getElementById("denominacaoGrupoEmpresa").readOnly = false;
    document.getElementById("denominacaoGrupoEmpresa").value    = " ";
    
         
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("idGrupoEmpresa").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
     
    var idGrupoEmpresa          =   $('#idGrupoEmpresa').val();             
    var denominacaoGrupoEmpresa =   $('#denominacaoGrupoEmpresa').val();           
      
    var controleDePreenchimento = 'S';
 
    if(denominacaoGrupoEmpresa == " "){
        controleDePreenchimento = 'N';
    }
               
    
    if(controleDePreenchimento ==  'S'){
        
        document.getElementById("denominacaoGrupoEmpresa").readOnly = true;

        $.ajax({
            url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=salvar',
            data: {
                idGrupoEmpresa: idGrupoEmpresa,
                denominacaoGrupoEmpresa: denominacaoGrupoEmpresa       

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
                }
            },
            error: function(e) {
                mensagem('Atenção', 'Erro ao salvar', 'error'); 
            }
        }); 
              
        
        
    }
    else{
        mensagem('Atenção', 'Prencha todoas os campos', 'alert');
              
       // mensagens de erro
   }   
    
}

function excluir(){
    
    var idGrupoEmpresa  =   $('#idGrupoEmpresa').val();
     
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=excluir',
        data: {
            idGrupoEmpresa: idGrupoEmpresa
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                   
            if (r == true || r == '1') {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
            }
            else{
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');

        }
    }); 
     
}


function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    
    document.getElementById("idPesquisarInicio").value   = "";
    document.getElementById("idPesquisarFim").value      = "";
    document.getElementById("nomePesquisarInicio").value = "";
    document.getElementById("nomePesquisarFim").checkd   = "";
  
}

function editar(){
    
    document.getElementById("denominacaoGrupoEmpresa").readOnly   = false;
    
 }

function buscaPrimeiroRegistro(){
    
    document.getElementById("denominacaoGrupoEmpresa").readOnly    = true;
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idGrupoEmpresa").value = r[0];
            document.getElementById("denominacaoGrupoEmpresa").value = r[1];
                         
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("denominacaoGrupoEmpresa").readOnly        = true;
    
    
    var idGrupoEmpresa  =  $('#idGrupoEmpresa').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=buscaRegistroAnterior',
        data: {
            idGrupoEmpresa: idGrupoEmpresa
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idGrupoEmpresa").value = r[0];
                document.getElementById("denominacaoGrupoEmpresa").value = r[1];
              
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("denominacaoGrupoEmpresa").readOnly        = true;
    
    
    var idGrupoEmpresa  =  $('#idGrupoEmpresa').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=buscaRegistroProximo',
        data: {
            idGrupoEmpresa: idGrupoEmpresa
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idGrupoEmpresa").value = r[0];
                document.getElementById("denominacaoGrupoEmpresa").value = r[1];
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("denominacaoGrupoEmpresa").readOnly        = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idGrupoEmpresa").value = r[0];
            document.getElementById("denominacaoGrupoEmpresa").value = r[1];
            
           
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
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("idGrupoEmpresa").value = r[0];
            document.getElementById("denominacaoGrupoEmpresa").value = r[1];
               
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function getGrid() {
 
   
    $('#grid').DataTable({
        "processing": true,
        "serverSide": true,
        ajax: {
            "url": "index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_GRUPO_EMPRESA"},
            {"data": "DENOMINACAO"},
            {"data": "USUARIO_CADASTRO"},
            {"data": "DATA_CADASTRO"},
            {"data": "USUARIO_ALTERACAO"},
            {"data": "DATA_ALTERACAO"},
            {"data": "SELECIONAR"},
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
     
 }
 
 function selecionaGrid(idGrupoEmpresa){
     
   
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller&f=selecionaGrid',
        data: {
            idGrupoEmpresa: idGrupoEmpresa
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                         
            document.getElementById("idGrupoEmpresa").value = r[0];
            document.getElementById("denominacaoGrupoEmpresa").value = r[1];
                        
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
          
    document.getElementById("denominacaoGrupoEmpresa").value    = " ";
    document.getElementById("idGrupoEmpresa").value    = " ";   
    
}





