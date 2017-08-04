///////////////////////////////////////////////
/// Cadastro de Funções                     ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////


$(document).ready(function() {
    
  
 getAdicionarFuncao();
 
 
    
});








function novo(){
       
    document.getElementById("id").readOnly              = true;
    document.getElementById("funcao").readOnly          = false;
    document.getElementById("descricao").readOnly       = false;
    document.getElementById("cbo").readOnly             = false;
    document.getElementById("periodoExame").readOnly    = false;
    document.getElementById("descricaoPpra").disabled   = false;
    
    
    document.getElementById("id").value             = "";
    document.getElementById("funcao").value         = "";
    document.getElementById("descricao").value      = "";
    document.getElementById("cbo").value            = "";
    document.getElementById("periodoExame").value   = 0;
    document.getElementById("descricaoPpra").value  = "";
    
       
    
    //document.getElementById('tabelaCadastro1').innerHTML = "";
    
    
    
    
      $.ajax({
            url: 'index.php?m=cadastrofuncoes&c=cadastrofuncoescontroller&f=novo',
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
    var funcao          =   $('#funcao').val();
    var descricao       =   $('#descricao').val();
    var cbo             =   $('#cbo').val();
    var periodoExame    =   $('#periodoExame').val();
    var descricaoPpra   =   $('#descricaoPpra').val();
    
    var controleDePreenchimento = 'S';
 
    
    if(funcao == ""){
        controleDePreenchimento = 'N';
    }
    if(descricao == ""){
        controleDePreenchimento = 'N';
    }
    if(cbo == ""){
        controleDePreenchimento = 'N';
    }
    if(periodoExame == 0){
        controleDePreenchimento = 'N';
    }
    if(descricaoPpra == ""){
        controleDePreenchimento = 'N';
    }
    
   
    
    
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("id").readOnly              = true;
        document.getElementById("funcao").readOnly          = true;
        document.getElementById("descricao").readOnly       = true;
        document.getElementById("cbo").readOnly             = true;
        document.getElementById("periodoExame").readOnly    = true;
        document.getElementById("descricaoPpra").disabled   = true;
        
        $.ajax({
            url: 'index.php?m=cadastrofuncoes&c=cadastrofuncoescontroller&f=salvar',
            data: {
                id: id,
                funcao: funcao,
                descricao: descricao,
                cbo: cbo,
                periodoExame: periodoExame,
                descricaoPpra: descricaoPpra,
                
                
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    //salvarAtividades();
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    getAdicionarFuncao(id,cbo);
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


function  getAdicionarFuncao(id, cbo) {

        document.getElementById("id").readOnly              = true;
        document.getElementById("funcao").readOnly          = true;
        document.getElementById("descricao").readOnly       = true;
        document.getElementById("cbo").readOnly             = true;
        document.getElementById("periodoExame").readOnly    = true;
        document.getElementById("descricaoPpra").disabled   = true;

    $.ajax({
        url: 'index.php?m=cadastrofuncoes&c=cadastrofuncoescontroller&f=getAdicionarFuncao',
        data: {
            id: id,
            cbo: cbo
            
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


function editarFuncao(id, cbo) {
    
        document.getElementById("id").readOnly              = true;
        document.getElementById("funcao").readOnly          = true;
        document.getElementById("descricao").readOnly       = true;
        document.getElementById("cbo").readOnly             = true;
        document.getElementById("periodoExame").readOnly    = true;
        document.getElementById("descricaoPpra").disabled   = true;
    
    $.ajax({
            url: 'index.php?m=cadastrofuncoes&c=cadastrofuncoescontroller&f=editarFuncao',
            data: {
                
                id: id,
                cbo: cbo
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                  // document.getElementById("idItemModal").value         =  r;
                  
                    document.getElementById("id").readOnly              = true;
                    document.getElementById("funcao").readOnly          = false;
                    document.getElementById("descricao").readOnly       = false;
                    document.getElementById("cbo").readOnly             = false;
                    document.getElementById("periodoExame").readOnly    = true;
                    document.getElementById("descricaoPpra").disabled   = false;
                  
                    
                    document.getElementById("id").value             = r[0];
                    document.getElementById("funcao").value         = r[1];
                    document.getElementById("descricao").value      = r[2];
                    document.getElementById("cbo").value            = r[3];
                    document.getElementById("periodoExame").value   = r[4];
                    document.getElementById("descricaoPpra").value  = r[5];
                    
                                       
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
        url: 'index.php?m=cadastrofuncoes&c=cadastrofuncoescontroller&f=excluir',
        data: {
            
                id: id
                
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                getAdicionarFuncao();
                
            }
            else {
                mensagem('Erro', 'Item nao Excluído', 'error');
                getAdicionarFuncao();
                
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            getAdicionarFuncao();
               
        }
    }); 
     
}

function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("cboPesquisarInicio").value   = "";
    document.getElementById("cboPesquisarFim").value      = "";
    
  
}

function pesquisaFiltro(){
    
    var cboPesquisarInicio      = document.getElementById("cboPesquisarInicio").value;
    var cboPesquisarFim         = document.getElementById("cboPesquisarFim").value;
    
    
    
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrofuncoes&c=cadastrofuncoescontroller&f=pesquisaSimples',
        data: {
            cboPesquisarInicio: cboPesquisarInicio,
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                    document.getElementById("id").value             = r[0];
                    document.getElementById("funcao").value         = r[1];
                    document.getElementById("descricao").value      = r[2];
                    document.getElementById("cbo").value            = r[3];
                    document.getElementById("periodoExame").value   = r[4];
                    document.getElementById("descricaoPpra").value  = r[5];
                    



            
        
            $('#pesquisarModal').modal('hide');          
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}

function atualizar() {

    document.getElementById("id").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("descricao").readOnly = true;
    document.getElementById("cbo").readOnly = true;
    document.getElementById("periodoExame").readOnly = true;
    document.getElementById("descricaoPpra").disabled   = true;
     
    document.getElementById("id").value             = "";
    document.getElementById("funcao").value         = "";
    document.getElementById("descricao").value      = "";
    document.getElementById("cbo").value            = "";
    document.getElementById("periodoExame").value   = 0;
     document.getElementById("descricaoPpra").value = "";
    


     getAdicionarFuncao();



}








