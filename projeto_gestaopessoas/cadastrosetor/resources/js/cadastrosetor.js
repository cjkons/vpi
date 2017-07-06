///////////////////////////////////////////////
/// Cadastro de Setor                       ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////
 

$(document).ready(function() {
    
  
 getAdicionarSetor();
 
    
}); 



function novo(){
       
    document.getElementById("id").readOnly              = true;
    document.getElementById("setor").readOnly          = false;
   
    
    
    
    document.getElementById("id").value             = "";
    document.getElementById("setor").value         = "";
    
    
    
    
    
      $.ajax({
            url: 'index.php?m=cadastrosetor&c=cadastrosetorcontroller&f=novo',
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
   
function salvar(){
     
    var id              =   $('#id').val(); 
    var setor          =   $('#setor').val();
    
    
    
    
    var controleDePreenchimento = 'S';
 
    
    if(setor == ""){
        controleDePreenchimento = 'N';
    }
    
    
   
    
    
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("id").readOnly              = true;
        document.getElementById("setor").readOnly          = true;
        
        
        
        $.ajax({
            url: 'index.php?m=cadastrosetor&c=cadastrosetorcontroller&f=salvar',
            data: {
                id: id,
                setor: setor,
                
                
                
                
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    //salvarAtividades();
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    getAdicionarSetor(id);
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


function  getAdicionarSetor(id) {

        document.getElementById("id").readOnly              = true;
        document.getElementById("setor").readOnly          = true;
        
        
    

    $.ajax({
        url: 'index.php?m=cadastrosetor&c=cadastrosetorcontroller&f=getAdicionarSetor',
        data: {
            id: id
            
            
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


function editarSetor(id) {
    
        
        document.getElementById("setor").readOnly           = true;
        
          
    
    $.ajax({
            url: 'index.php?m=cadastrosetor&c=cadastrosetorcontroller&f=editarSetor',
            data: {
                
                id: id
               
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                  // document.getElementById("idItemModal").value         =  r;
                  
                    document.getElementById("id").readOnly              = true;
                    document.getElementById("setor").readOnly          = false;
                    
                    
                  
                    
                    document.getElementById("id").value         = r[0];
                    document.getElementById("setor").value     = r[1];
                  
                   
                    
                                       
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
        url: 'index.php?m=cadastrosetor&c=cadastrosetorcontroller&f=excluir',
        data: {
            
                id: id
                
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                getAdicionarSetor();
                
            }
            else {
                mensagem('Erro', 'Item nao Excluído', 'error');
                getAdicionarSetor();
                
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            getAdicionarSetor();
               
        }
    }); 
     
}

function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("setorPesquisarInicio").value   = "";
    document.getElementById("setorPesquisarFim").value      = "";
    
  
}

function pesquisaFiltro(){
    
    var setorPesquisarInicio      = document.getElementById("setorPesquisarInicio").value;
    var setorPesquisarFim         = document.getElementById("setorPesquisarFim").value;
    
    
    
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrosetor&c=cadastrosetorcontroller&f=pesquisaSimples',
        data: {
            setorPesquisarInicio: setorPesquisarInicio,
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                    document.getElementById("id").value         = r[0];
                    document.getElementById("setor").value     = r[1];
                    
                    



            
        
            $('#pesquisarModal').modal('hide');          
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}

function atualizar() {

    document.getElementById("id").readOnly = true;
    document.getElementById("setor").readOnly = true;
    
    

    document.getElementById("id").value             = "";
    document.getElementById("setor").value         = "";
   
    


     getAdicionarSetor();



}








