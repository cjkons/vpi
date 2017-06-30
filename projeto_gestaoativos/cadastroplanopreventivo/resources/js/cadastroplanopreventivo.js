/////////////////////////////////////////////
// BOLETIM_EQUIPAMENTO_CAMINHAO_BETONEIRA             ///
// EQP_BOLETIM_BETONEIRA 1.00                ///
// EQP_BOLETIM_BETONEIRA_LANCAMENTO 1.00     ///   
// Desenvolvido por Matheus Jaschke      ///
// Setembro 2016                          ///
// VPI GESTAO                          /////
////////////////////////////////////////////
var totalEditar = 1;
var cache = {};
var lastXhr;
var cache1 = {};
var lastXhr1;
cont = 1;
 i = 1;
var linha = 0;
var edita = 0;
var comboEdicao = 0;
var exclusaoParcial = 0;
var editaExclui = 0;


$(document).ready(function() {
    
     
 limparTabelaTmp();
 carregarEquipamento();
 
    
});


function carregarEquipamento(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=carregarEquipamento',
        data: {
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('equipamento').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EQUIPAMENTOS', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}

function carregarApelido(){
     
    var equipamento = document.getElementById("equipamento").value;
          
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=carregarApelido',
        data: {
            equipamento: equipamento
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                
                document.getElementById('descricao').value = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EQUIPAMENTOS', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}

function novo(){
    
    limparTabelaTmp();
    
    cont = 1;
        
    document.getElementById("id").disabled              = false;
    document.getElementById("equipamento").disabled     = false;
    document.getElementById("descricao").readOnly       = true;
    document.getElementById("ativoChecklist").disabled  = false;
    document.getElementById("ativoAtividade").disabled  = false;
    
    
    document.getElementById("id").value             = "";
    document.getElementById("equipamento").value  = 0;
    document.getElementById("descricao").value      = "";
    
    
    $('#ativoChecklist').prop('checked', false);
    $('#ativoAtividade').prop('checked', false);
       
    
    document.getElementById('tabelaPreco2').innerHTML = "";
    document.getElementById('tabelaItem3').innerHTML  = "";
    
    
    
      $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=novo',
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
    var equipamento     =   $('#equipamento').val();             
    var descricao       =   $('#descricao').val();
    
    var controleDePreenchimento = 'S';
 
    if(equipamento == 0){
        controleDePreenchimento = 'N';
    }
    if(descricao == ""){
        controleDePreenchimento = 'N';
    }
    
    if($("#ativoChecklist").is(':checked') == true){
        var ativoChecklist = 'S';
    }
    else{
        var ativoChecklist = 'N';
    }
    
    if($("#ativoAtividade").is(':checked') == true){
        var ativoAtividade = 'S';
    }
    else{
        var ativoAtividade = 'N';
    }
    
    
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("id").disabled              = true;
        document.getElementById("equipamento").disabled     = true;
        document.getElementById("descricao").disabled       = true;
        
        document.getElementById('ativoChecklist').disabled  = true;
        document.getElementById('ativoAtividade').disabled  = true; 
        
        $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=salvar',
            data: {
                id: id,
                equipamento: equipamento,
                descricao: descricao,
                ativoChecklist: ativoChecklist,
                ativoAtividade: ativoAtividade
                
                
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    salvarAtividades();
                   // mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    
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

function excluir(){
    
    var id              =   $('#id').val();
     
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=excluir',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
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


function editar(id){
    linha = 1;
    id = cont;
    edita = 1;
    editaExclui = 1; 
    
    limparTabelaTmp();
    
    document.getElementById("id").disabled                  = false;
    document.getElementById("equipamento").readOnly         = false;
    document.getElementById("descricao").readOnly           = false;
    document.getElementById("ativoChecklist").disabled      = false;
    document.getElementById("ativoAtividade").disabled      = false;
    
    
          
    
    if(id == 1){ 
    
        document.getElementById("idAtividade").readOnly          = false;
        document.getElementById("intervencao").disabled          = false;
        document.getElementById("descAtividade").disabled        = false;
        document.getElementById("frequencia").readOnly           = false;
        document.getElementById("executor").readOnly             = false;
        
       
    }
    else{   
    
        document.getElementById("idAtividade").readOnly          = false;
        document.getElementById("intervencao").disabled          = false;
        document.getElementById("descAtividade").disabled        = false;
        document.getElementById("frequencia").readOnly           = false;
        document.getElementById("executor").readOnly             = false;
        
    
        for(var i = 2; i <= id; i++){
            
           
            var idAtividade     = i;
            var intervencao     = i + '_' + i;
            var descAtividade   = i + '_' + i + '_' + i;
            var frequencia      = i + '_' + i + '_' + i + '_' + i;
            var executor        = i + '_' + i + '_' + i + '_' + i + '_' + i;
            


            document.getElementById(idAtividade).readOnly   = true;
            document.getElementById(intervencao).readOnly   = true;
            document.getElementById(descAtividade).readOnly = true;
            document.getElementById(frequencia).readOnly    = true;
            document.getElementById(executor).readOnly      = true;
            
            
        }
        
    }
    
    
}
  
function atualizar(){
    
  limparTabelaTmp();
    
    
        
    document.getElementById("id").disabled              = false;
    document.getElementById("equipamento").disabled     = false;
    document.getElementById("descricao").readOnly       = true;
    document.getElementById("ativoChecklist").disabled  = true;
    document.getElementById("ativoAtividade").disabled  = true;
    
    
    document.getElementById("id").value             = "";
    document.getElementById("equipamento").value  = 0;
    document.getElementById("descricao").value      = "";
    
    
    $('#ativoChecklist').prop('checked', false);
    $('#ativoAtividade').prop('checked', false);
       
    
    document.getElementById('tabelaPreco2').innerHTML = "";
    document.getElementById('tabelaItem3').innerHTML  = "";         
    
}

//// AJUSTE PARA CARREGAR EM MODAIS

function validarAddAtividade(){
    
    var id              =   $('#id').val();
    var equipamento     =   $('#equipamento').val();             
    var descricao       =   $('#descricao').val();
   
    
     
     
    $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=validarAddAtividade',
            data: {
                
                id: id,
                equipamento: equipamento,
                descricao: descricao
                
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {
                
                   
                   if (data != true) {
                       
                    mensagem('Atenção', 'Já existe cadastro para o equipamento, Consute!', 'r', 'i', 2000, 1);
                   
                   atualizar();
                   

                }
                else {
                    
                    addAtividade();

                } 
                   
                   

            },
            error: function(e) {
                
                atualizar();
                    
            }
            
            
        });  
    
}

function addAtividade() {


    var id              =   $('#id').val(); 
    var equipamento     =   $('#equipamento').val();             
    var descricao       =   $('#descricao').val();
    
             
    var controleDePreenchimento = 'S';
 
    if(equipamento == 0){
        controleDePreenchimento = 'N';
    }
    
    if(descricao == ""){
        controleDePreenchimento = 'N';
      controleDePreenchimento = 'N';
    }

     
    if (controleDePreenchimento == 'S') {



    $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=addAtividade',
            data: {
                
               
                id: id,
                equipamento: equipamento,
                descricao: descricao
                
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                    document.getElementById("idAtividade").value         =  r;  

                    document.getElementById("idAdicionarModal").value = id;
                    
                    document.getElementById("idAtividade").readOnly     = false;
                    document.getElementById("intervencao").readOnly     = false;
                    document.getElementById("descAtividade").readOnly   = false;
                    document.getElementById("frequencia").readOnly      = false;
                    document.getElementById("executor").readOnly        = false;
                    
                    
                   
                    document.getElementById("intervencao").value        = "";
                    document.getElementById("descAtividade").value      = "";
                    document.getElementById("frequencia").value         = "";
                    document.getElementById("executor").value           = "";
                    
                    
//                var idAtividade      = document.getElementById("idAtividade").value         =  r;  
//                var idAdicionarModal = document.getElementById("idAdicionarModal").value = id;

                   
                   getAdicionarAtividade(id);
                    
                   
                   $('#adicionarAtividadeModal').modal('show');

            },
            error: function(e) {
                    mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
            }
            
            
        });   
            
    }else{
         mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
    }        

    
}

function salvarAdicionarAtividade(){
     
        var  idAdicionarModal   =  document.getElementById('idAdicionarModal').value;
        
        var  idAtividade        =  document.getElementById('idAtividade').value;
        
        var  intervencao        =  document.getElementById('intervencao').value;
        var  descAtividade      =  document.getElementById('descAtividade').value;
        var  frequencia         =  document.getElementById('frequencia').value;
        var  executor           =  document.getElementById('executor').value;
        
        
    
   
    var controleDePreenchimento = 'S';

    
    if (intervencao == "") {
        controleDePreenchimento = 'N';
    }
    if (descAtividade == "") {
        controleDePreenchimento = 'N';
    }
    if (frequencia == "") {
        controleDePreenchimento = 'N';
    }
    if (executor == "") {
        controleDePreenchimento = 'N';
    }
    
    
    
    if(controleDePreenchimento ==  'S'){
    

            $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=salvarAdicionarAtividade',
            data: {
                
                idAdicionarModal: idAdicionarModal,
                idAtividade: idAtividade,
                intervencao: intervencao,
                descAtividade: descAtividade,
                frequencia: frequencia,
                executor: executor


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {

                if (data == true) {
                    mensagem('', 'Item Incluido com Sucesso', 'success');
                    

                    
                    getAdicionarAtividade(idAdicionarModal, idAtividade);
                    $('#adicionarAtividadeModal').modal('hide');
                   

                }
                else {
                    mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
                    $('#basicModal').modal('hide');
                    getAdicionarAtividade(idAdicionarModal, idAtividade);

                }
            },
            error: function(e) {
                mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
                $('#basicModal').modal('hide');
                getAdicionarAtividade(idAdicionarModal, idAtividade);



            }
        }); 
    }
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
        
    }
    
    
    
}

function  getAdicionarAtividade(idAdicionarModal, idAtividade) {

    
   
     


    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=getAdicionarAtividade',
        data: {
            idAdicionarModal: idAdicionarModal,
            idAtividade: idAtividade
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem3').innerHTML = r;
            




        },
        error: function (e) {
            
        }
    });


}

function editarAtividade(id, idAtividade) {

    
    //carregarCondutorEditarItem(idBoletim,idItemValor);
    
    $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=editarAtividade',
            data: {
                
               
                id: id,
                idAtividade:idAtividade
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                  // document.getElementById("idItemModal").value         =  r;   
                  
                    document.getElementById('idAdicionarModalEditar').value   = r[0];
                    document.getElementById('idAtividadeEditar').value        = r[1];
                    document.getElementById('intervencaoEditar').value        = r[2];
                    document.getElementById('descAtividadeEditar').value      = r[3];
                    document.getElementById('frequenciaEditar').value         = r[4];
                    document.getElementById('executorEditar').value           = r[5];
                    
                    
                    
                                       
                   $('#adicionarAtividadeModalEditar').modal('show');

            },
            error: function(e) {
                    mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
            }
            
            
        });   
            
           

    
}


function botaoAdicionarAtividadeSair() {


    $('#adicionarAtividadeModal').modal('hide');


}

function botaoAdicionarAtividadeEditarSair() {


    $('#adicionarAtividadeModalEditar').modal('hide');


}


function salvarAtividadeEditar(){
     
        var  id                 =  document.getElementById('idAdicionarModalEditar').value;
        
        var  idAtividade        =  document.getElementById('idAtividadeEditar').value;
        var  intervencao        =  document.getElementById('intervencaoEditar').value;
        var  descAtividade      =  document.getElementById('descAtividadeEditar').value;
        var  frequencia         =  document.getElementById('frequenciaEditar').value;
        var  executor           =  document.getElementById('executorEditar').value; 
        
   
    var controleDePreenchimento = 'S';

    
    if (intervencao == "") {
        controleDePreenchimento = 'N';
    }
    if (descAtividade == 0) {
        controleDePreenchimento = 'N';
    }
    if (frequencia == 0) {
        controleDePreenchimento = 'N';
    }
    if (executor == "") {
        controleDePreenchimento = 'N';
    }
    
    
    
    if(controleDePreenchimento ==  'S'){
    

            $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=salvarAtividadeEditar',
            data: {
                id: id,
                idAtividade: idAtividade,
                intervencao: intervencao,
                descAtividade: descAtividade,
                frequencia: frequencia,
                executor: executor,
                


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    mensagem('', 'Item Alterado com Sucesso', 'r', 's', 2000, 1);
                    

                    
                    //getItemOrcamentoEditarCompletar();
                    $('#adicionarAtividadeModalEditar').modal('hide');
                    //getGridTemporario();
                    
                   // getItemOrcamento(id);
                   getAdicionarAtividade(id);

                }
                else {
                    mensagem('Atenção', 'Erro ao alterar Item', 'error');
                    $('#adicionarAtividadeModalEditar').modal('hide');

                }
            },
            error: function(e) {
                mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
                $('#adicionarAtividadeModalEditar').modal('hide');



            }
        }); 
    }
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
        
    }
    
    
    
}

function excluirAtividadeEditar(){
   
    var  id                 =  document.getElementById('idAdicionarModalEditar').value;
    var  idAtividade        =  document.getElementById('idAtividadeEditar').value;
   
              
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=excluirAtividadeEditar',
        data: {
           
           id: id,
           idAtividade: idAtividade
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                mensagem('', 'Item Excluido com Sucesso', 'r', 's', 2000, 1); 
                
                $('#adicionarAtividadeModalEditar').modal('hide');
                getAdicionarAtividade(id);
            
            } else {
                mensagem('', 'Erro ao excluir Item', 'r', 'e', 2000, 1); 
                $('#adicionarAtividadeModalEditar').modal('hide');
                getAdicionarAtividade(id);
            }

        },
        error: function() {
           
        }
    });
}


function limparTabelaTmp(){
   
   
              
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=limparTabelaTmp',
        data: {
           
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
               
            } else {
               
            }

        },
        error: function() {
           
        }
    });
}



function getNumeroLinhas() {



    var id = document.getElementById('id').value;
    var retorno;
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=getNumeroLinhas',
        data: {
            id: id

        },
        type: 'POST',
        dataType: 'json',
        async: false, //falso eu consigo pegar a variavel do retono
        success: function (data) {

            if (data != false) {
                retorno = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar o número de linhas', 'error');

            }

        },
        error: function () {

        }
    });
    return retorno;



}

function consultar(){
    
    
    var equipamento     =   $('#equipamento').val();             
   

    document.getElementById("equipamento").readOnly         = true;
    document.getElementById("descricao").disabled           = true;
    document.getElementById("ativoChecklist").readOnly      = true;
    document.getElementById("ativoAtividade").readOnly      = true;
    
    document.getElementById('tabelaPreco2').innerHTML = "";
    
    limparTabelaTmp();
     
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=consultar',
        data: {
            
            equipamento: equipamento
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
          
            document.getElementById("id").value             = r[0];
            document.getElementById("equipamento").value    = r[1];
            document.getElementById("descricao").value      = r[2];
            document.getElementById("ativoChecklist").value = r[3];
            document.getElementById("ativoAtividade").value = r[4];
            
            if (r[3] == 'S' ) {
                    $('#ativoChecklist').prop('checked', true);
                }        
            if (r[4] == 'S' ) {
                    $('#ativoAtividade').prop('checked', true);        
                }
            
            var total = r[5];
            cont = total;
            
            var id = r[0];
            
            //addLinhas(total);
            getAdicionarAtividade(id);

            //getGrid();
            
            
        },
        error: function(e) {
             mensagem('Atenção', 'Nao existe cadastros para este Equipamento', 'error');
        }
    }); 
 
    
}




/////////////// Adicionar Item /////////////////////


function addItem(id, idAtividade) {


    
    
              
    var controleDePreenchimento = 'S';
 
    if(id == ""){
        controleDePreenchimento = 'N';
    }
    if(idAtividade == ""){
        controleDePreenchimento = 'N';
    }
   
     
    if (controleDePreenchimento == 'S') {



    $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=addItem',
            data: {
                
               
                id: id,
                idAtividade: idAtividade
                
                
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                    
                    

                    //document.getElementById("idItemModal").readOnly         = false;
                    document.getElementById("item").readOnly                = false;
                    document.getElementById("quantidade").readOnly          = false;
                    document.getElementById("unidadeMedida").readOnly       = false;
                    document.getElementById("observacao").disabled          = false;
                    
                 //  alert();
                    document.getElementById("id").value             = id;
                    document.getElementById("idAtividade").value    = idAtividade;
                    document.getElementById("item").value           = "";
                    document.getElementById("quantidade").value     = "";
                    document.getElementById("unidadeMedida").value  = "";
                    document.getElementById("observacao").value     = "";
                    
                    var idItemModal = document.getElementById("idItemModal").value         =  r;      


                    carregarItem(); 
                    getAdicionarItem(id, idAtividade, idItemModal);

                    $('#adicionarItensModal').modal('show');
                    //$('#adicionarAtividadeModalEditar').modal('show');

            },
            error: function(e) {
                    mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
            }
            
            
        });   
            
    }else{
         mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
    }        

    
}

function botaoItemSair() {


    $('#adicionarItensModal').modal('hide');


}



function carregarItem(){
    
     
           
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=carregarItem',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                 document.getElementById("item").innerHTML = data;
                 
            
               
            
        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }
 
 
 function carregarUnidadeMedida(){
      
      var item = document.getElementById("item").value; 
   
           
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=carregarUnidadeMedida',
        data: {
           item: item
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                
                document.getElementById('unidadeMedida').value = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EQUIPAMENTOS', 'error'); 
               
            }

        },
        error: function() {
            alert('Erro ao carregar a UnidadeMedida');
        }
    });
 } 
 
 
 function validarSalvarItem(){
     
     
    var idItemModal  =   $('#idItemModal').val();
    var item         =   $('#item').val(); 
    var idAtividade     = document.getElementById('idAtividade').value;
    
    
    
    
    $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=validarSalvarItem',
            data: {
                
                idAtividade: idAtividade,
                idItemModal: idItemModal,
                item: item
                
                
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {
                
                   
                   if (data != true) {
                       
                    mensagem('Atenção', 'Já existe cadastro para este Item!', 'r', 'i', 2000, 1);
                     

                }
                else {
                    
                    salvarItem();

                } 
                   
                   

            },
            error: function(e) {
                
                
                    
            }
            
            
        });           
             
     
 }
 
 function salvarItem(){
     
     
     
    var id              = document.getElementById('id').value;
    var idAtividade     = document.getElementById('idAtividade').value;
    
     
    var idItemModal     = document.getElementById('idItemModal').value;
    var item            = document.getElementById('item').value;
    var unidadeMedida   = document.getElementById('unidadeMedida').value;
    var quantidade      = document.getElementById('quantidade').value;
    var observacao      = document.getElementById('observacao').value;
        
        
    
   
    var controleDePreenchimento = 'S';

    
    if (item == 0) {
        controleDePreenchimento = 'N';
    }
    if (quantidade == "") {
        controleDePreenchimento = 'N';
    }
    if (observacao == "") {
        controleDePreenchimento = 'N';
    }
   
    
    
    
    if(controleDePreenchimento ==  'S'){
    

            $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=salvarItem',
            data: {
                
                id: id,
                idAtividade: idAtividade,
                idItemModal: idItemModal,
                item: item,
                unidadeMedida: unidadeMedida,
                quantidade: quantidade,
                observacao: observacao


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {

                if (data == true) {
                    mensagem('', 'Item Incluido com Sucesso', 'success');
                    

                    
                    getAdicionarItem(id, idAtividade, idItemModal);
                    
                    document.getElementById("idItemModal").value = "";
                    document.getElementById("item").value = 0;
                    document.getElementById("quantidade").value = "";
                    document.getElementById("unidadeMedida").value = "";
                    document.getElementById("observacao").value = "";
                    
                    document.getElementById("idItemModal").readOnly         = true;
                    document.getElementById("item").readOnly                = true;
                    document.getElementById("quantidade").readOnly          = true;
                    document.getElementById("unidadeMedida").readOnly       = true;
                    document.getElementById("observacao").readOnly          = true;
                   

                }
                else {
                    mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
                    $('#basicModal').modal('hide');
                    getAdicionarItem(id, idAtividade, idItemModal);
                    
                    document.getElementById("idItemModal").value = "";
                    document.getElementById("item").value = 0;
                    document.getElementById("quantidade").value = "";
                    document.getElementById("unidadeMedida").value = "";
                    document.getElementById("observacao").value = "";
                    
                    document.getElementById("idItemModal").readOnly         = true;
                    document.getElementById("item").readOnly                = true;
                    document.getElementById("quantidade").readOnly          = true;
                    document.getElementById("unidadeMedida").readOnly       = true;
                    document.getElementById("observacao").readOnly          = true;

                }
            },
            error: function(e) {
                mensagem('Atenção', 'Erro ao salvar Descrição', 'error');
                $('#basicModal').modal('hide');
                getAdicionarItem(id, idAtividade, idItemModal);
                
                    document.getElementById("idItemModal").value = "";
                    document.getElementById("item").value = 0;
                    document.getElementById("quantidade").value = "";
                    document.getElementById("unidadeMedida").value = "";
                    document.getElementById("observacao").value = "";
                    
                    document.getElementById("idItemModal").readOnly         = true;
                    document.getElementById("item").readOnly                = true;
                    document.getElementById("quantidade").readOnly          = true;
                    document.getElementById("unidadeMedida").readOnly       = true;
                    document.getElementById("observacao").readOnly          = true;



            }
        }); 
    }
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
        
    }
    
    
    
}

function  getAdicionarItem(id, idAtividade, idItemModal) {

    document.getElementById("item").readOnly = true;
    document.getElementById("quantidade").readOnly = true;
    document.getElementById("unidadeMedida").readOnly = true;
    document.getElementById("observacao").readOnly = true;

    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=getAdicionarItem',
        data: {
            id: id,
            idAtividade: idAtividade,
            idItemModal: idItemModal
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem4').innerHTML = r;
            




        },
        error: function (e) {
            
        }
    });


}

function novoItem() {
    
    var id              =   $('#id').val(); 
    var idAtividade     =   $('#idAtividade').val();   
    

    document.getElementById("item").readOnly = false;
    document.getElementById("quantidade").readOnly = false;
    document.getElementById("unidadeMedida").readOnly = false;
    document.getElementById("observacao").readOnly = false;

    //  alert();
    
    document.getElementById("idItemModal").value = "";
    document.getElementById("item").value = "";
    document.getElementById("quantidade").value = "";
    document.getElementById("unidadeMedida").value = "";
    document.getElementById("observacao").value = "";

    


    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=novoItem',
        data: {
            
            id: id,
            idAtividade: idAtividade
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            document.getElementById("idItemModal").value = r;
            carregarItem();


        },
        error: function (e) {

        }
    });



}


function editarItem(id, idAtividade, idItemModal) {
    
    var id              =   $('#id').val(); 
    var idAtividade     =   $('#idAtividade').val();
   
    document.getElementById("item").readOnly = true;
    document.getElementById("quantidade").readOnly = false;
    document.getElementById("unidadeMedida").readOnly = true;
    document.getElementById("observacao").readOnly = false;
    
    $.ajax({
            url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=editarItem',
            data: {
                
                id: id,
                idAtividade: idAtividade,
                idItemModal:idItemModal
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                  // document.getElementById("idItemModal").value         =  r;   
                  
                    document.getElementById('idItemModal').value     = r[0];
                    document.getElementById('item').value         = r[4];
                    document.getElementById('unidadeMedida').value       = r[1];
                    document.getElementById('quantidade').value           = r[2];
                    document.getElementById('observacao').value = r[3];
                    
                                       
                   //$('#itemModalEditar').modal('show');

            },
            error: function(e) {
                    mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
            }
            
            
        });   
            
           

    
}

function excluirItem(){
   
    var  id                 =  document.getElementById('id').value;
    var  idItemModal        =  document.getElementById('idItemModal').value;
    var  idAtividade        =  document.getElementById('idAtividade').value;
    
    document.getElementById("item").readOnly = true;
    document.getElementById("quantidade").readOnly = true;
    document.getElementById("unidadeMedida").readOnly = true;
    document.getElementById("observacao").readOnly = true;

   
              
    $.ajax({
        url: 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller&f=excluirItem',
        data: {
           
           id: id,
           idItemModal: idItemModal,
           idAtividade: idAtividade
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                mensagem('', 'Item Excluido com Sucesso', 'r', 's', 2000, 1); 
                
                document.getElementById("idItemModal").value = "";
                document.getElementById("item").value = 0;
                document.getElementById("quantidade").value = "";
                document.getElementById("unidadeMedida").value = "";
                document.getElementById("observacao").value = "";
                
                getAdicionarItem(id, idAtividade, idItemModal);
            
            } else {
                mensagem('', 'Erro ao excluir Item', 'r', 'e', 2000, 1); 
                
                document.getElementById("idItemModal").value = "";
                document.getElementById("item").value = 0;
                document.getElementById("quantidade").value = "";
                document.getElementById("unidadeMedida").value = "";
                document.getElementById("observacao").value = "";
                
                getAdicionarItem(id, idAtividade, idItemModal);
            }

        },
        error: function() {
           
        }
    });
}





