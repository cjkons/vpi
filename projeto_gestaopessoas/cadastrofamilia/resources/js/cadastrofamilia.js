/////////////////////////////////////////////
// Cadastro de Empresa                   ///
// SYS_EMPRESA 1.00                      ///   
// Desenvolvido por Matheus Jaschke     ///
// OUTUBRO de                           ///
// VPI GESTAO                          ///
/////////////////////////////////////////

$(document).ready(function() {
    
 
   carregarUnidadeMedida();  
   getGrid();
  
  
});
function novo(){
    
    document.getElementById("denominacaoFamilia").readOnly = false;
    document.getElementById("unidadeMedida").readOnly      = false;
          
    document.getElementById("denominacaoFamilia").value         = " ";
     document.getElementById("dataCadastro").value         = " ";
    
    //document.getElementById("tipoCadastro").value    = 0;
    
   
         
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
          
            document.getElementById("idFamilia").value  = r;
                      
        },
        error: function(e) {
           
        }
    }); 
    
}




    
function salvar(){
     
    var idFamilia          =   $('#idFamilia').val();             
    var denominacaoFamilia  =   $('#denominacaoFamilia').val();
    var unidadeMedida      =   $('#unidadeMedida').val();
          
    var controleDePreenchimento = 'S';
 
    if(denominacaoFamilia== " "){
        controleDePreenchimento = 'N';
    }
    if(unidadeMedida == " "){
        controleDePreenchimento = 'N';
    }
       
    
    if(controleDePreenchimento ==  'S'){
  
        document.getElementById("denominacaoFamilia").readOnly = true;
        document.getElementById("unidadeMedida").readOnly      = true;

        $.ajax({
            url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=salvar',
            data: {
                idFamilia : idFamilia,  
                denominacaoFamilia: denominacaoFamilia,
                unidadeMedida: unidadeMedida
                
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
                  atualizar();
                atualizar();
            }
        });
                 
        
    }
    else{
        
         mensagem('Atenção', 'Prencha todoas os campos', 'alert');
        
       // mensagens de erro
              
    }
    
}

function excluir(){
    
    var idFamilia  =   $('#idFamilia').val();
     
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=excluir',
        data: {
            idFamilia: idFamilia
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


function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("idPesquisarInicio").value   = "";
    document.getElementById("idPesquisarFim").value      = "";
    document.getElementById("nomePesquisarInicio").value = "";
    document.getElementById("nomePesquisarFim").checkd   = "";
    
  
}

function editar(){
    
    document.getElementById("denominacaoFamilia").readOnly = false;
    
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("denominacaoFamilia").readOnly = true;
    document.getElementById("unidadeMedida").readOnly      = true;
    
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idFamilia").value = r[0];
            document.getElementById("denominacaoFamilia").value = r[1];
            document.getElementById("dataCadastro").value = r[2];
            document.getElementById("unidadeMedida").value = r[3];
          
                   
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("denominacaoFamilia").readOnly = true;
    document.getElementById("unidadeMedida").readOnly      = true;
        
    
    var idFamilia  =  $('#idFamilia').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=buscaRegistroAnterior',
        data: {
            idFamilia: idFamilia
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                              
                document.getElementById("idFamilia").value = r[0];
                document.getElementById("denominacaoFamilia").value = r[1];
                document.getElementById("dataCadastro").value = r[2];
                document.getElementById("unidadeMedida").value = r[3];
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    
    document.getElementById("denominacaoFamilia").readOnly = true;
    document.getElementById("unidadeMedida").readOnly      = true;
        
    
    
    var idFamilia  =  $('#idFamilia').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=buscaRegistroProximo',
        data: {
            idFamilia: idFamilia
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                 
                document.getElementById("idFamilia").value = r[0];
                document.getElementById("denominacaoFamilia").value = r[1];
                document.getElementById("dataCadastro").value = r[2];
                document.getElementById("unidadeMedida").value = r[3];


            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("denominacaoFamilia").readOnly = true;
    document.getElementById("unidadeMedida").readOnly      = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("idFamilia").value = r[0];
            document.getElementById("denominacaoFamilia").value = r[1];
            document.getElementById("dataCadastro").value = r[2];
            document.getElementById("unidadeMedida").value = r[3];
            
           
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
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idFamilia").value = r[0];
            document.getElementById("denominacaoFamilia").value = r[1];
            document.getElementById("dataCadastro").value = r[2];
            document.getElementById("unidadeMedida").value = r[3]; 
                                
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
            "url": "index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "CODIGO_FAMILIA"},
            {"data": "DENOMINACAO"},
            {"data": "DATA_CADASTRO"},
            {"data": "UNIDADE_MEDIDA"},
            {"data": "SELECIONAR"},
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
     
 }
 
 function selecionaGrid(idFamilia){
     
            
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=selecionaGrid',
        data: {
            idFamilia: idFamilia
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                 
            document.getElementById("idFamilia").value = r[0];
            document.getElementById("denominacaoFamilia").value = r[1];
            document.getElementById("dataCadastro").value = r[2];
            document.getElementById("unidadeMedida").value = r[3];
                   
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
       
    document.getElementById("denominacaoFamilia").readOnly = false;
    document.getElementById("unidadeMedida").readOnly      = false;
    document.getElementById("denominacaoFamilia").value         = " ";
          
    
}



/////////////////////////////////////
/// Funções Específicas Família /////
/////////////////////////////////////

function carregarUnidadeMedida(){
    
           
    $.ajax({
        url: 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller&f=carregarUnidadeMedida',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('unidadeMedida').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista de fornecedores para esta(s) obra(s)')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
          
    
} 
// Mensagem
