///////////////////////////////////////////////
/// Cadastro de Exames                      ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////


$(document).ready(function() {
    
  
 getAdicionarExames();
 
    
});



function novo(){
       
    document.getElementById("id").readOnly              = true;
    document.getElementById("exames").readOnly          = false;
    document.getElementById("descricao").readOnly       = false;
    
    
    
    document.getElementById("id").value             = "";
    document.getElementById("exames").value         = "";
    document.getElementById("descricao").value      = "";
    
    
       
    
    //document.getElementById('tabelaCadastro1').innerHTML = "";
    
    
    
    
      $.ajax({
            url: 'index.php?m=cadastroexames&c=cadastroexamescontroller&f=novo',
            data: {
                            
                
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                  
                   document.getElementById("id").value         =  r;
                   
             
            },
            error: function(e) {
             
            }
        });
    
    
  
}

function validarExcluir(){
    $('#excluirModal').modal('show');
}
   
function salvar(){
     
    var id              =   $('#id').val(); 
    var exames          =   $('#exames').val();
    var descricao       =   $('#descricao').val();
   
    
    
    var controleDePreenchimento = 'S';
 
    
    if(exames == ""){
        controleDePreenchimento = 'N';
    }
    if(descricao == ""){
        controleDePreenchimento = 'N';
    }
    
   
    
    
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("id").readOnly              = true;
        document.getElementById("exames").readOnly          = true;
        document.getElementById("descricao").readOnly       = true;
       
        
        $.ajax({
            url: 'index.php?m=cadastroexames&c=cadastroexamescontroller&f=salvar',
            data: {
                id: id,
                exames: exames,
                descricao: descricao
               
                
                
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    //salvarAtividades();
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    getAdicionarExames(id);
                    atualizar();
                    //document.getElementById('tabelaPreco2').innerHTML = "";
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
         mensagem('Atenção', 'Prencha todos os campos', 'alert');
       // mensagens de erro
        
          
    }
    
}


function  getAdicionarExames(id) {

        document.getElementById("id").readOnly              = true;
        document.getElementById("exames").readOnly          = true;
        document.getElementById("descricao").readOnly       = true;
       
    

    $.ajax({
        url: 'index.php?m=cadastroexames&c=cadastroexamescontroller&f=getAdicionarExames',
        data: {
            id: id,
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaCadastro1').innerHTML = r;
            




        },
        error: function (e) {
            
        }
    });


}


function editarExames(id) {
    
        document.getElementById("id").readOnly              = true;
        document.getElementById("exames").readOnly          = true;
        document.getElementById("descricao").readOnly       = true;
      
    
    $.ajax({
            url: 'index.php?m=cadastroexames&c=cadastroexamescontroller&f=editarExames',
            data: {
                
                id: id
               
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                  // document.getElementById("idItemModal").value         =  r;
                  
                    document.getElementById("id").readOnly              = true;
                    document.getElementById("exames").readOnly          = false;
                    document.getElementById("descricao").readOnly       = false;
                    
                  
                    
                    document.getElementById("id").value         = r[0];
                    document.getElementById("exames").value     = r[1];
                    document.getElementById("descricao").value  = r[2];
                    
                    
                                       
                   //$('#itemModalEditar').modal('show');

            },
            error: function(e) {
                    mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
            }
            
            
        });   
            
           

    
}


function excluir(){
    
    var id              =   $('#id').val(); 
    
     
    $.ajax({
        url: 'index.php?m=cadastroexames&c=cadastroexamescontroller&f=excluir',
        data: {
            
                id: id
                
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                getAdicionarExames();
                
            }
            else {
                mensagem('Erro', 'Item nao Excluído', 'error');
                getAdicionarExames();
                
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            getAdicionarExames();
               
        }
    }); 
     
}

function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("cboPesquisarInicio").value   = "";
    document.getElementById("cboPesquisarFim").value      = "";
    
  
}

function pesquisaFiltro(){
    
    var examesPesquisarInicio      = document.getElementById("examesPesquisarInicio").value;
    var examesPesquisarFim         = document.getElementById("examesPesquisarFim").value;
    
    
    
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastroexames&c=cadastroexamescontroller&f=pesquisaSimples',
        data: {
            examesPesquisarInicio: examesPesquisarInicio,
            examesPesquisarFim: examesPesquisarFim
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                    document.getElementById("id").value         = r[0];
                    document.getElementById("exames").value     = r[1];
                    document.getElementById("descricao").value  = r[2];
                    



            
        
            $('#pesquisarModal').modal('hide');          
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}

function atualizar() {

    document.getElementById("id").readOnly = true;
    document.getElementById("exames").readOnly = true;
    document.getElementById("descricao").readOnly = true;
    

    document.getElementById("id").value             = "";
    document.getElementById("exames").value         = "";
    document.getElementById("descricao").value      = "";
    


     getAdicionarExames();



}








