/////////////////////////////////////////////
// Cadastro de Comprador                  ///
// SYS_EMPRESA 1.00                       ///   
// Desenvolvido por Heitor Siqueira      ///
// OUTUBRO de                            ///
// VPI GESTAO                           ///
/////////////////////////////////////////

$(document).ready(function() {
  carregarEmpresa();  
  carregarFilial();
  getGrid();
  

            
    

});
function novo(){
    
    document.getElementById("idEmpresa").readOnly          = false;
    document.getElementById("idFilial").readOnly           = false;
    document.getElementById("nomeComprador").readOnly      = false;
    document.getElementById("login").readOnly              = false;
    document.getElementById("ativo").disabled              = false;
    
        
    document.getElementById("idComprador").value        = "";
    document.getElementById("idEmpresa").value          = 0;
    document.getElementById("idFilial").value           = 0;
    document.getElementById("nomeComprador").value      = "";
    document.getElementById("login").value              = "";
    
    
    $('#ativo').prop('checked', false);
    
   

         
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("idComprador").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
     
    var idComprador              =   $('#idComprador').val();             
    var idEmpresa                =   $('#idEmpresa').val();           
    var idFilial                 =   $('#idFilial').val();      
    var nomeComprador            =   $('#nomeComprador').val();
    var login                    =   $('#login').val();
    
       
    var controleDePreenchimento = 'S';
 
    if(idComprador == ""){
        controleDePreenchimento = 'N';
    }
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == ""){
        controleDePreenchimento = 'N';
    }
    if(nomeComprador == "" ){
        controleDePreenchimento = 'N';
    }
    if(login == "" ){
        controleDePreenchimento = 'N';
    }
   
    
    
    if($("#ativo").is(':checked') == true){
        var ativo = 'S';
    }
    else{
        var ativo = 'N';
    }   
    
    
   
    
   
    
    if(controleDePreenchimento ==  'S'){
        
        
            
            document.getElementById("idComprador").readOnly        = true;
            document.getElementById("idEmpresa").readOnly          = true;
            document.getElementById("idFilial").readOnly           = true;
            document.getElementById("nomeComprador").readOnly      = true;
            document.getElementById("login").readOnly              = true;
            document.getElementById('ativo').readOnly              = true; 
           
         
      
            $.ajax({
                url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=salvar',
                data: {
                    idComprador: idComprador,
                    idEmpresa: idEmpresa,
                    idFilial: idFilial,
                    nomeComprador: nomeComprador,
                    login: login,
                    ativo: ativo,
                    
                   
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
    
    var idComprador  =   $('#idComprador').val();
     
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=excluir',
        data: {
            idComprador: idComprador
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
            

        }
    }); 
     
}


function pesquisar() {
    
   
    $('#pesquisarModal').modal('show');
    
    document.getElementById("idPesquisarInicio").value      = "";
    document.getElementById("idPesquisarFim").value         = "";
    document.getElementById("nomePesquisarInicio").value    = "";
    document.getElementById("nomePesquisarFim").value       = "";
    
     
}

function editar(){
    
    document.getElementById("idEmpresa").readOnly           = false;
    document.getElementById("idFilial").readOnly            = false;
    document.getElementById("nomeComprador").readOnly       = false;
    document.getElementById("login").readOnly               = false;
    document.getElementById('ativo').disabled               = false;
    
        
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("idComprador").readOnly         = true;
    document.getElementById("idEmpresa").readOnly           = true;
    document.getElementById("idFilial").readOnly            = true;
    document.getElementById("nomeComprador").readOnly       = true;
    document.getElementById("login").readOnly               = true;
    document.getElementById('ativo').disabled               = true;
    
    
   
    
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("idComprador").value            = r[0];
            document.getElementById("idEmpresa").value              = r[1];            
            document.getElementById("idFilial").value               = r[2];
            document.getElementById("nomeComprador").value          = r[3];
            document.getElementById("login").value                  = r[4];
            
                       
            if(r[5] == 'S' ){
                  $('#ativo').prop('checked', true);
            }
            else{
                 $('#ativo').prop('checked', false);
                
            }
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("idComprador").readOnly         = true;
    document.getElementById("idEmpresa").readOnly           = true;
    document.getElementById("idFilial").readOnly            = true;
    document.getElementById("nomeComprador").readOnly       = true;
    document.getElementById("login").readOnly               = true;
    document.getElementById('ativo').disabled               = true;
    
    
    
    var idComprador  =  $('#idComprador').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=buscaRegistroAnterior',
        data: {
            idComprador: idComprador
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idComprador").value            = r[0];
                document.getElementById("idEmpresa").value              = r[1];            
                document.getElementById("idFilial").value               = r[2];
                document.getElementById("nomeComprador").value          = r[3];
                document.getElementById("login").value                  = r[4];
                
               
                if(r[5] == 'S' ){
                      $('#ativo').prop('checked', true);
                }
                else{
                     $('#ativo').prop('checked', false);

                }
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("idComprador").readOnly         = true;
    document.getElementById("idEmpresa").readOnly           = true;
    document.getElementById("idFilial").readOnly            = true;
    document.getElementById("nomeComprador").readOnly       = true;
    document.getElementById("login").readOnly               = true;
    document.getElementById('ativo').disabled               = true;
    
        
    
    var idComprador =  $('#idComprador').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=buscaRegistroProximo',
        data: {
            idComprador: idComprador
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idComprador").value            = r[0];
                document.getElementById("idEmpresa").value              = r[1];            
                document.getElementById("idFilial").value               = r[2];
                document.getElementById("nomeComprador").value          = r[3];
                document.getElementById("login").value                  = r[4];
                
                       
                if(r[5] == 'S' ){
                   $('#ativo').prop('checked', true);
                }
                else{
                    $('#ativo').prop('checked', false);
                }
               
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idComprador").readOnly         = true;
    document.getElementById("idEmpresa").readOnly           = true;
    document.getElementById("idFilial").readOnly            = true;
    document.getElementById("nomeComprador").readOnly       = true;
    document.getElementById("login").readOnly               = true;
    document.getElementById('ativo').disabled               = true;
    
      
    
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idComprador").value            = r[0];
            document.getElementById("idEmpresa").value              = r[1];            
            document.getElementById("idFilial").value               = r[2];
            document.getElementById("nomeComprador").value          = r[3];
            document.getElementById("login").value                  = r[4];
            
            
           
            
            if(r[5] == 'S' ){
                  $('#ativo').prop('checked', true);
            }
            else{
                 $('#ativo').prop('checked', false);
                
            }
            
           
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
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("idComprador").value            = r[0];
            document.getElementById("idEmpresa").value              = r[1];            
            document.getElementById("idFilial").value               = r[2];
            document.getElementById("nomeComprador").value          = r[3];
            document.getElementById("login").value                  = r[4];
            
                                   
            if(r[5] == 'S' ){
                  $('#ativo').prop('checked', true);
            }
            else{
                 $('#ativo').prop('checked', false);
                
            }
            
        
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
            "url": "index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            
            
            {"data": "ID_COMPRADOR"},
            {"data": "ID_EMPRESA"},
             {"data": "ID_FILIAL"},
            {"data": "NOME_COMPRADOR"},
            {"data": "LOGIN"},
            {"data": "ATIVO"},
            {"data": "SELECIONAR"},
         
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
 }
 
 function selecionaGrid(idComprador){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idComprador").readOnly         = true;
    document.getElementById("idEmpresa").readOnly           = true;
    document.getElementById("idFilial").readOnly            = true;
    document.getElementById("nomeComprador").readOnly       = true;
    document.getElementById("login").readOnly               = true;
    document.getElementById('ativo').disabled               = true;
    
     
    
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=selecionaGrid',
        data: {
            idComprador: idComprador
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idComprador").value            = r[0];
            document.getElementById("idEmpresa").value              = r[1];            
            document.getElementById("idFilial").value               = r[2];
            document.getElementById("nomeComprador").value          = r[3];
            document.getElementById("login").value                  = r[4];
            
                       
            if(r[5] == 'S' ){
                  $('#ativo').prop('checked', true);
            }
            else{
                 $('#ativo').prop('checked', false);
                
            }       
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
    getGrid();
   
    document.getElementById("idComprador").value        = "";
    document.getElementById("idEmpresa").value          = 0;
    document.getElementById("idFilial").value           = 0;
    document.getElementById("nomeComprador").value      = "";
    document.getElementById("login").value              = "";
    
    getGrid();
       
   $('#ativo').prop('checked', false);
     
            
    
}


//////////////////////////////////////////////////////////////
//         FUNÇÕES EPECÍFICAS PARA ESSE BRD                //         
/////////////////////////////////////////////////////////////






function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idEmpresa').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista de EMPRESA')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }    
 
 
 function carregarFilial(){
    
    var idEmpresa                 =   $('#idEmpresa').val(); 
           
    $.ajax({
        url: 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller&f=carregarFilial',
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
                alert('Erro ao carregar a lista de FILIAL')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }    