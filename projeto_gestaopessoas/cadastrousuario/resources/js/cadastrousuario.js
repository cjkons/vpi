///////////////////////////////////////////////
/// Cadastro de Usuario                     ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

$(document).ready(function() {
carregarEmpresa();   
  
 getGrid();
 
 $('#dataNascimento').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });

            
    

});

function novo(){
    
    
    document.getElementById("nomeUsuario").readOnly        = false;
    document.getElementById("sobrenomeUsuario").readOnly   = false;
    document.getElementById("emailUsuario").readOnly       = false;
    document.getElementById("empresaUsuario").readOnly     = false;
    document.getElementById("ativoUsuario").readOnly       = false;
    document.getElementById("senhaUsuario").readOnly       = false;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = false;
    document.getElementById("loginUsuario").readOnly       = false;
    document.getElementById('ativoUsuario').disabled       = false;
    document.getElementById("dataNascimento").readOnly     = false;
    document.getElementById("matricula").readOnly          = false;
    document.getElementById("cargo").readOnly              = false;
    
        
       
    document.getElementById("nomeUsuario").value         = "";
    document.getElementById("sobrenomeUsuario").value    = "";
    document.getElementById("emailUsuario").value        = "";
    document.getElementById("empresaUsuario").value      = 0;
    document.getElementById("ativoUsuario").checkd       = "";
    document.getElementById("senhaUsuario").value        = "";
    document.getElementById("confirmacaoUsuarioSenha").value  = "";
    document.getElementById("loginUsuario").value        = "";
    document.getElementById("dataNascimento").value      = "";
    document.getElementById("matricula").value           = "";
    document.getElementById("cargo").value               = "";
 
    
    $('#ativoUsuario').prop('checked', false);
    
         
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            
             document.getElementById("idUsuario").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
     
    var idUsuario          =   $('#idUsuario').val();             
    var nomeUsuario        =   $('#nomeUsuario').val();           
    var sobrenomeUsuario   =   $('#sobrenomeUsuario').val();      
    var emailUsuario       =   $('#emailUsuario').val();          
    var empresaUsuario     =   $('#empresaUsuario').val();        
    var loginUsuario       =   $('#loginUsuario').val();          
    var senhaUsuario       =   $('#senhaUsuario').val();          
    var confirmacaoUsuario =   document.getElementById('confirmacaoUsuarioSenha').value;  // $('#confirmacaoUsuarioSenha').val;
    var dataNascimento     =   $('#dataNascimento').val();
    //var dataNascimento     =   document.getElementById('dataNascimento').value;//$('#dataNascimento').val;
    var matricula          =   document.getElementById('matricula').value;//$('#matricula').val;
    var cargo              =   document.getElementById('cargo').value;//$('#cargo').val;
     
           
    var controleDePreenchimento = 'S';
 
    if(nomeUsuario == ""){
        controleDePreenchimento = 'N';
    }
    if(sobrenomeUsuario == ""){
        controleDePreenchimento = 'N';
    }
    if(emailUsuario == ""){
        controleDePreenchimento = 'N';
    }
    if(empresaUsuario == ""){
        controleDePreenchimento = 'N';
    }
    if(loginUsuario == ""){
        controleDePreenchimento = 'N';
    }
    if(senhaUsuario == ""){
        controleDePreenchimento = 'N';
    }
    if(dataNascimento == ""){
        controleDePreenchimento = 'N';
    }
    if(matricula == ""){
        controleDePreenchimento = 'N';
    }
    if(cargo == ""){
        controleDePreenchimento = 'N';
    }   
    if($("#ativoUsuario").is(':checked') == true){
        var ativoUsuario = 'S';
    }
    else{
        var ativoUsuario = 'N';
    }   
    
    if(controleDePreenchimento ==  'S'){
        
        //alert(senhaUsuario);
        //alert(confirmacaoUsuario);
        if(senhaUsuario == confirmacaoUsuario ){
            
            //var senhaCriptografada =    CryptoJS.MD5(senhaUsuario).toString();
      
            document.getElementById("nomeUsuario").readOnly        = true;
            document.getElementById("sobrenomeUsuario").readOnly   = true;
            document.getElementById("emailUsuario").readOnly       = true;
            document.getElementById("empresaUsuario").readOnly     = true;
            document.getElementById("ativoUsuario").readOnly       = true;
            document.getElementById("senhaUsuario").readOnly       = true;
            document.getElementById("confirmacaoUsuarioSenha").readOnly = true;
            document.getElementById("loginUsuario").readOnly       = true;
            document.getElementById("dataNascimento").readOnly     = true;
            document.getElementById("matricula").readOnly          = true;
            document.getElementById("cargo").readOnly              = true;
            document.getElementById('ativoUsuario').disabled       = true;
      
      
      
            $.ajax({
                url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=salvar',
                data: {
                    idUsuario: idUsuario,
                    nomeUsuario: nomeUsuario,
                    sobrenomeUsuario: sobrenomeUsuario,
                    emailUsuario: emailUsuario,
                    empresaUsuario: empresaUsuario,
                    ativoUsuario: ativoUsuario,
                    loginUsuario: loginUsuario,
                    dataNascimento: dataNascimento,
                    matricula:  matricula,
                    cargo: cargo,
                    senhaUsuario: senhaUsuario
                   
                },
                type: 'POST',
                dataType: 'json',
                async: true,
                success: function(r) {
                    
                   if( r == true){                  
                        mensagem('Sucesso', 'Salvo com sucesso', 'success');
                        $('#basicModal').modal('hide');
                        atualizar();
                   }
                   else{
                         mensagem('Sucesso', 'Salvo com sucesso', 'success');
                        $('#basicModal').modal('hide');
                       
                       
                   }
                },
                error: function(e) {
                      mensagem('Atenção', 'Erro ao salvar', 'error'); 
                }
            }); 
              
        }
        else{
          mensagem('Atenção', 'As senhas não conferem.', 'alert');   //erro
         
            // senhas nao batem
        }
        
    }
    else{
        
          mensagem('Atenção', 'Prencha todos os campos', 'alert');
        
       // mensagens de erro
        
          
    }
    
}

function excluir(){
    
    var idUsuario  =   $('#idUsuario').val();
     
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=excluir',
        data: {
            idUsuario: idUsuario
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
    document.getElementById("nomePesquisarFim").checkd   = "";
  
}

function editar(){
    
    document.getElementById("nomeUsuario").readOnly        = false;
    document.getElementById("sobrenomeUsuario").readOnly   = false;
    document.getElementById("emailUsuario").readOnly       = false;
    document.getElementById("empresaUsuario").readOnly     = false;
    document.getElementById("ativoUsuario").readOnly       = false;
    document.getElementById("senhaUsuario").readOnly       = false;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = false;
    document.getElementById("loginUsuario").readOnly       = false;
    document.getElementById('ativoUsuario').disabled       = false;
    document.getElementById("dataNascimento").readOnly     = false;
    document.getElementById("matricula").readOnly          = false;
    document.getElementById("cargo").readOnly              = false;
    
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("nomeUsuario").readOnly        = true;
    document.getElementById("sobrenomeUsuario").readOnly   = true;
    document.getElementById("emailUsuario").readOnly       = true;
    document.getElementById("empresaUsuario").readOnly     = true;
    document.getElementById("ativoUsuario").readOnly       = true;
    document.getElementById("senhaUsuario").readOnly       = true;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = true;
    document.getElementById("loginUsuario").readOnly       = true;
    document.getElementById("dataNascimento").readOnly     = true;
    document.getElementById("matricula").readOnly          = true;
    document.getElementById("cargo").readOnly              = true;
   
    
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idUsuario").value = r[0];
            document.getElementById("nomeUsuario").value = r[1];
            document.getElementById("sobrenomeUsuario").value = r[2];
            document.getElementById("emailUsuario").value = r[3]; 
            document.getElementById("empresaUsuario").value = r[4]; 
            document.getElementById("loginUsuario").value = r[6]; 
            document.getElementById("senhaUsuario").value = r[7]; 
            document.getElementById("confirmacaoUsuarioSenha").value = r[7];
            document.getElementById("dataNascimento").value = r[8]; 
            document.getElementById("matricula").value = r[9]; 
            document.getElementById("cargo").value = r[10]; 
            
            
                      
            if(r[5] == 'S' ){
                  $('#ativoUsuario').prop('checked', true);
            }
            else{
                 $('#ativoUsuario').prop('checked', false);
                
            }
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("nomeUsuario").readOnly        = true;
    document.getElementById("sobrenomeUsuario").readOnly   = true;
    document.getElementById("emailUsuario").readOnly       = true;
    document.getElementById("empresaUsuario").readOnly     = true;
    document.getElementById("ativoUsuario").readOnly       = true;
    document.getElementById("senhaUsuario").readOnly       = true;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = true;
    document.getElementById("loginUsuario").readOnly       = true;
     document.getElementById("dataNascimento").readOnly     = true;
    document.getElementById("matricula").readOnly          = true;
    document.getElementById("cargo").readOnly              = true;
    
    
    var idUsuario  =  $('#idUsuario').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=buscaRegistroAnterior',
        data: {
            idUsuario: idUsuario
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idUsuario").value = r[0];
                document.getElementById("nomeUsuario").value = r[1];
                document.getElementById("sobrenomeUsuario").value = r[2];
                document.getElementById("emailUsuario").value = r[3]; 
                document.getElementById("empresaUsuario").value = r[4];             
                document.getElementById("loginUsuario").value = r[6]; 
                document.getElementById("senhaUsuario").value = r[7]; 
                document.getElementById("confirmacaoUsuarioSenha").value = r[7];
                document.getElementById("dataNascimento").value = r[8]; 
                document.getElementById("matricula").value = r[9]; 
                document.getElementById("cargo").value = r[10]; 

                if(r[5] == 'S' ){
                     $('#ativoUsuario').prop('checked', true);
                }
                else{
                      $('#ativoUsuario').prop('checked', false);
                }
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("nomeUsuario").readOnly        = true;
    document.getElementById("sobrenomeUsuario").readOnly   = true;
    document.getElementById("emailUsuario").readOnly       = true;
    document.getElementById("empresaUsuario").readOnly     = true;
    document.getElementById("ativoUsuario").readOnly       = true;
    document.getElementById("senhaUsuario").readOnly       = true;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = true;
    document.getElementById("loginUsuario").readOnly       = true;
     document.getElementById("dataNascimento").readOnly     = true;
    document.getElementById("matricula").readOnly          = true;
    document.getElementById("cargo").readOnly              = true;
    
    
    var idUsuario  =  $('#idUsuario').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=buscaRegistroProximo',
        data: {
            idUsuario: idUsuario
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idUsuario").value = r[0];
                document.getElementById("nomeUsuario").value = r[1];
                document.getElementById("sobrenomeUsuario").value = r[2];
                document.getElementById("emailUsuario").value = r[3]; 
                document.getElementById("empresaUsuario").value = r[4];             
                document.getElementById("loginUsuario").value = r[6]; 
                document.getElementById("senhaUsuario").value = r[7]; 
                document.getElementById("confirmacaoUsuarioSenha").value = r[7];
                document.getElementById("dataNascimento").value = r[8]; 
                document.getElementById("matricula").value = r[9]; 
                document.getElementById("cargo").value = r[10]; 

               
                if(r[5] == 'S' ){
                      $('#ativoUsuario').prop('checked', true);
                }
                else{
                      $('#ativoUsuario').prop('checked', false);
                }
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("nomeUsuario").readOnly        = true;
    document.getElementById("sobrenomeUsuario").readOnly   = true;
    document.getElementById("emailUsuario").readOnly       = true;
    document.getElementById("empresaUsuario").readOnly     = true;
    document.getElementById("ativoUsuario").readOnly       = true;
    document.getElementById("senhaUsuario").readOnly       = true;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = true;
    document.getElementById("loginUsuario").readOnly       = true;
    document.getElementById("dataNascimento").readOnly     = true;
    document.getElementById("matricula").readOnly          = true;
    document.getElementById("cargo").readOnly              = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idUsuario").value = r[0];
            document.getElementById("nomeUsuario").value = r[1];
            document.getElementById("sobrenomeUsuario").value = r[2];
            document.getElementById("emailUsuario").value = r[3]; 
            document.getElementById("empresaUsuario").value = r[4]; 
            
            document.getElementById("loginUsuario").value = r[6]; 
            document.getElementById("senhaUsuario").value = r[7]; 
            document.getElementById("confirmacaoUsuarioSenha").value = r[7];
            document.getElementById("dataNascimento").value = r[8]; 
            document.getElementById("matricula").value = r[9]; 
            document.getElementById("cargo").value = r[10]; 
            
                        
            if(r[5] == 'S' ){
                $('#ativoUsuario').prop('checked', true);
            }
            else{
              
                $('#ativoUsuario').prop('checked', false);
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
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idUsuario").value = r[0];
            document.getElementById("nomeUsuario").value = r[1];
            document.getElementById("sobrenomeUsuario").value = r[2];
            document.getElementById("emailUsuario").value = r[3]; 
            document.getElementById("empresaUsuario").value = r[4]; 
            
            document.getElementById("loginUsuario").value = r[6]; 
            document.getElementById("senhaUsuario").value = r[7]; 
            document.getElementById("confirmacaoUsuarioSenha").value = r[7];
            document.getElementById("dataNascimento").value = r[8]; 
            document.getElementById("matricula").value = r[9]; 
            document.getElementById("cargo").value = r[10]; 
            
                        
            if(r[5] == 'S' ){
                $('#ativoUsuario').prop('checked', true);
            }
            else{
              
                $('#ativoUsuario').prop('checked', false);
            }
            
        
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
            "url": "index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID"},
            {"data": "NOME"},
            {"data": "SOBRENOME"},
            {"data": "EMAIL"},
            {"data": "EMPRESA"},
            {"data": "ATIVO"},
            {"data": "LOGIN"},
            {"data": "DATA_NASCIMENTO"},
            {"data": "CARGO"},
            {"data": "SELECIONAR"},
            
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
 }
 
 function selecionaGrid(idUsuario){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idUsuario").readOnly          = true;
    document.getElementById("nomeUsuario").readOnly        = true;
    document.getElementById("sobrenomeUsuario").readOnly   = true;
    document.getElementById("emailUsuario").readOnly       = true;
    document.getElementById("empresaUsuario").readOnly     = true;
    document.getElementById("ativoUsuario").readOnly       = true;
    document.getElementById("senhaUsuario").readOnly       = true;
    document.getElementById("confirmacaoUsuarioSenha").readOnly = true;
    document.getElementById("loginUsuario").readOnly       = true;
    document.getElementById("dataNascimento").readOnly     = true;
    document.getElementById("matricula").readOnly          = true;
    document.getElementById("cargo").readOnly              = true;
  
    
    
    
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=selecionaGrid',
        data: {
            idUsuario: idUsuario
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
         document.getElementById("idUsuario").value = r[0];
            document.getElementById("nomeUsuario").value = r[1];
            document.getElementById("sobrenomeUsuario").value = r[2];
            document.getElementById("emailUsuario").value = r[3]; 
            document.getElementById("empresaUsuario").value = r[4]; 
            
            document.getElementById("loginUsuario").value = r[6]; 
            document.getElementById("senhaUsuario").value = r[7]; 
            document.getElementById("confirmacaoUsuarioSenha").value = r[7];
            document.getElementById("dataNascimento").value = r[8]; 
            document.getElementById("matricula").value = r[9]; 
            document.getElementById("cargo").value = r[10]; 
            
                        
            if(r[5] == 'S' ){
                $('#ativoUsuario').prop('checked', true);
            }
            else{
              
                $('#ativoUsuario').prop('checked', false);
            }
            
        
            $('#pesquisarModal').modal('hide');            
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
    getGrid();
  
    
    
    document.getElementById("idUsuario").value           = "";
    document.getElementById("dataNascimento").value      = "";
    document.getElementById("nomeUsuario").value         = "";
    document.getElementById("sobrenomeUsuario").value    = "";
    document.getElementById("emailUsuario").value        = "";
    document.getElementById("empresaUsuario").value      = "";
    document.getElementById("ativoUsuario").checkd       = "";
    document.getElementById("senhaUsuario").value        = "";
    document.getElementById("confirmacaoUsuarioSenha").value  = "";
    document.getElementById("loginUsuario").value        = "";
 
    
    $('#ativoUsuario').prop('checked', false);
    
    
            
    
}




function teste(){
    
    var idFluxo = 1;
    
         
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=enviaEmailFinalizar',
        data: {
            idFluxo: idFluxo
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
          
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastrousuario&c=cadastrousuariocontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('empresaUsuario').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista de EMPRESA')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }
