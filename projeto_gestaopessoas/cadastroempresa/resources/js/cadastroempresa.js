///////////////////////////////////////////////
/// Cadastro de Empresa                     ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

$(document).ready(function() {
 
  
    getGrid();
    carregarGrupoEmpresa();        
    

});
$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cep').blur(function(){
       
              mensagem(' ' ,' Localizando CEP...', 'info');
             
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=consultarCep', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    
                    if(data.sucesso == 1){
                        $('#endereco').val(data.endereco);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#estado').val(data.estado);
 
                        $('#numero').focus();
                    }
                    else {
                        mensagem('Atenção', 'CEP Não encontrado', 'error');
                    }
                }
           });   
   return false;    
   })
});
function novo(){
    
    document.getElementById("grupoEmpresa").readOnly       = false;
    document.getElementById("razaoSocial").readOnly        = false;
    document.getElementById("codigoCNPJ").readOnly         = false;
    document.getElementById("nomeFantasia").readOnly       = false;
    document.getElementById("inscricaoEstadual").readOnly  = false;
    document.getElementById("inscricaoMunicipal").readOnly = false;
    document.getElementById('ativoEmpresa').disabled       = false; 
    document.getElementById("endereco").readOnly           = false;
    document.getElementById("numero").readOnly             = false;
    document.getElementById("cep").readOnly                = false;
    document.getElementById("cidade").readOnly             = false;
    document.getElementById("bairro").readOnly             = false;
    document.getElementById("estado").readOnly             = false;
    document.getElementById("pais").readOnly               = false;
    document.getElementById("telefone1").readOnly          = false;
    document.getElementById("telefone2").readOnly          = false;
    document.getElementById("celular").readOnly            = false;
    document.getElementById("email").readOnly              = false;
    
        
    document.getElementById("grupoEmpresa").value       = "Seleicone";   
    document.getElementById("razaoSocial").value        = "";
    document.getElementById("codigoCNPJ").value         = "";
    document.getElementById("nomeFantasia").value       = "";
    document.getElementById("inscricaoEstadual").value  = "";
    document.getElementById("inscricaoMunicipal").value = "";
    document.getElementById("endereco").value           = "";
    document.getElementById("numero").value             = "";
    document.getElementById("cep").value                = "";
    document.getElementById("cidade").value             = "";
    document.getElementById("bairro").value             = "";
    document.getElementById('estado').value             = "Selecione";
    document.getElementById("pais").value               = "";
    document.getElementById("telefone1").value          = "";
    document.getElementById("telefone2").value          = "";
    document.getElementById("celular").value            = "";
    document.getElementById("email").value              = "";
    
    $('#ativoEmpresa').prop('checked', false);
    
   

         
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("idEmpresa").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
     
    var idEmpresa          =   $('#idEmpresa').val();             
    var grupoEmpresa       =   $('#grupoEmpresa').val();           
    var razaoSocial        =   $('#razaoSocial').val();      
    var codigoCNPJ         =   $('#codigoCNPJ').val();          
    var nomeFantasia       =   $('#nomeFantasia').val();        
    var inscricaoEstadual  =   $('#inscricaoEstadual').val();          
    var inscricaoMunicipal =   $('#inscricaoMunicipal').val();          
    var endereco           =   $('#endereco').val();
    var numero             =   $('#numero').val();    
    var cep                =   $('#cep').val();  
    var cidade             =   $('#cidade').val();             
    var bairro             =   $('#bairro').val();           
    var estado             =   $('#estado').val();      
    var pais               =   $('#pais').val();          
    var telefone1          =   $('#telefone1').val();        
    var telefone2          =   $('#telefone2').val();          
    var celular            =   $('#celular').val();          
    var email              =   $('#email').val();          
      
    
    
    
       
    var controleDePreenchimento = 'S';
 
    if(grupoEmpresa == ""){
        controleDePreenchimento = 'N';
    }
    if(razaoSocial == ""){
        controleDePreenchimento = 'N';
    }
    if(codigoCNPJ == ""){
        controleDePreenchimento = 'N';
    }
    if(nomeFantasia == "" ){
        controleDePreenchimento = 'N';
    }
   
    if(endereco == ""){
        controleDePreenchimento = 'N';
    }
    if(numero == ""){
        controleDePreenchimento = 'N';
    }
    if(cep == ""){
        controleDePreenchimento = 'N';
    }
    if(cidade == ""){
        controleDePreenchimento = 'N';
    }
    if(bairro == ""){
        controleDePreenchimento = 'N';
    }
    if(estado == "Selecione"){
        controleDePreenchimento = 'N';
    }
     if(pais == ""){
        controleDePreenchimento = 'N';
    }
    if(telefone1 == ""){
        controleDePreenchimento = 'N';
    }
    if(telefone2 == ""){
        controleDePreenchimento = 'N';
    }
    if(celular == ""){
        controleDePreenchimento = 'N';
    }
    if(email == ""){
        controleDePreenchimento = 'N';
    }
   
        
    
    if($("#ativoEmpresa").is(':checked') == true){
        var ativoEmpresa = 'S';
    }
    else{
        var ativoEmpresa = 'N';
    }   
    
    
   
    
   
    
    if(controleDePreenchimento ==  'S'){
        
        if(validarCNPJ(codigoCNPJ)){
            
            document.getElementById("grupoEmpresa").readOnly       = true;
            document.getElementById("razaoSocial").readOnly        = true;
            document.getElementById("codigoCNPJ").readOnly         = true;
            document.getElementById("nomeFantasia").readOnly       = true;
            document.getElementById("inscricaoEstadual").readOnly  = true;
            document.getElementById("inscricaoMunicipal").readOnly = true;
            document.getElementById('ativoEmpresa').disabled       = true; 
            document.getElementById("endereco").readOnly           = true;
            document.getElementById("numero").readOnly             = true;
            document.getElementById("cep").readOnly                = true;
            document.getElementById("cidade").readOnly             = true;
            document.getElementById("bairro").readOnly             = true;
            document.getElementById("estado").readOnly             = true;
            document.getElementById("pais").readOnly               = true;
            document.getElementById("telefone1").readOnly          = true;
            document.getElementById("telefone2").readOnly          = true;
            document.getElementById("celular").readOnly            = true;
            document.getElementById("email").readOnly              = true;
         
      
            $.ajax({
                url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=salvar',
                data: {
                    idEmpresa: idEmpresa,
                    grupoEmpresa: grupoEmpresa,
                    razaoSocial: razaoSocial,
                    codigoCNPJ: codigoCNPJ,
                    nomeFantasia: nomeFantasia,
                    inscricaoEstadual: inscricaoEstadual,
                    inscricaoMunicipal: inscricaoMunicipal,
                    ativoEmpresa: ativoEmpresa,
                    endereco: endereco,
                    numero: numero,
                    cep: cep,
                    cidade: cidade,
                    bairro: bairro,
                    estado: estado,
                    pais: pais,
                    telefone1: telefone1,
                    telefone2: telefone2,
                    celular: celular,
                    email: email
                   
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
            mensagem('Atenção', 'CNPJ inválido', 'alert');
            
            // senhas nao batem
        }
        
    }
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
       
        
     
        
       // mensagens de erro
        
          
    }
    
}

function excluir(){
    
    var idEmpresa  =   $('#idEmpresa').val();
     
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=excluir',
        data: {
            idEmpresa: idEmpresa
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
            mensagem('Atenção', 'Erro ao excluir', 'error'); 
            

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
    
    document.getElementById("grupoEmpresa").readOnly       = false;
    document.getElementById("razaoSocial").readOnly        = false;
    document.getElementById("codigoCNPJ").readOnly         = false;
    document.getElementById("nomeFantasia").readOnly       = false;
    document.getElementById("inscricaoEstadual").readOnly  = false;
    document.getElementById("inscricaoMunicipal").readOnly = false;
    document.getElementById('ativoEmpresa').disabled       = false; 
    document.getElementById("endereco").readOnly           = false;
    document.getElementById("numero").readOnly             = false;
    document.getElementById("cep").readOnly                = false;
    document.getElementById("cidade").readOnly             = false;
    document.getElementById("bairro").readOnly             = false;
    document.getElementById("estado").readOnly             = false;
    document.getElementById("pais").readOnly               = false;
    document.getElementById("telefone1").readOnly          = false;
    document.getElementById("telefone2").readOnly          = false;
    document.getElementById("celular").readOnly            = false;
    document.getElementById("email").readOnly              = false;
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("grupoEmpresa").readOnly       = true;
    document.getElementById("razaoSocial").readOnly        = true;
    document.getElementById("codigoCNPJ").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly       = true;
    document.getElementById("inscricaoEstadual").readOnly  = true;
    document.getElementById("inscricaoMunicipal").readOnly = true;
    document.getElementById('ativoEmpresa').disabled       = true; 
    document.getElementById("endereco").readOnly           = true;
    document.getElementById("numero").readOnly             = true;
    document.getElementById("cep").readOnly                = true;
    document.getElementById("cidade").readOnly             = true;
    document.getElementById("bairro").readOnly             = true;
    document.getElementById("estado").readOnly             = true;
    document.getElementById("pais").readOnly               = true;
    document.getElementById("telefone1").readOnly          = true;
    document.getElementById("telefone2").readOnly          = true;
    document.getElementById("celular").readOnly            = true;
    document.getElementById("email").readOnly              = true;
         
   
    
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("idEmpresa").value          = r[0];
            document.getElementById("grupoEmpresa").value       = r[1];            
            document.getElementById("razaoSocial").value        = r[2];
            document.getElementById("codigoCNPJ").value         = r[3];
            document.getElementById("nomeFantasia").value       = r[4];
            document.getElementById("inscricaoEstadual").value  = r[5];
            document.getElementById("inscricaoMunicipal").value = r[6];            
            document.getElementById("endereco").value           = r[8];
            document.getElementById("numero").value             = r[9];
            document.getElementById("cep").value                = r[10];
            document.getElementById("cidade").value             = r[11];
            document.getElementById("bairro").value             = r[12];
            document.getElementById("estado").value             = r[13];
            document.getElementById("pais").value               = r[14];
            document.getElementById("telefone1").value          = r[15];
            document.getElementById("telefone2").value          = r[16];
            document.getElementById("celular").value            = r[17];
            document.getElementById("email").value              = r[18];
            
           
                       
            if(r[7] == 'S' ){
                  $('#ativoEmpresa').prop('checked', true);
            }
            else{
                 $('#ativoEmpresa').prop('checked', false);
                
            }
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("grupoEmpresa").readOnly       = true;
    document.getElementById("razaoSocial").readOnly        = true;
    document.getElementById("codigoCNPJ").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly       = true;
    document.getElementById("inscricaoEstadual").readOnly  = true;
    document.getElementById("inscricaoMunicipal").readOnly = true;
    document.getElementById('ativoEmpresa').disabled       = true; 
    document.getElementById("endereco").readOnly           = true;
    document.getElementById("numero").readOnly             = true;
    document.getElementById("cep").readOnly                = true;
    document.getElementById("cidade").readOnly             = true;
    document.getElementById("bairro").readOnly             = true;
    document.getElementById("estado").readOnly             = true;
    document.getElementById("pais").readOnly               = true;
    document.getElementById("telefone1").readOnly          = true;
    document.getElementById("telefone2").readOnly          = true;
    document.getElementById("celular").readOnly            = true;
    document.getElementById("email").readOnly              = true;
    
    
    var idEmpresa  =  $('#idEmpresa').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=buscaRegistroAnterior',
        data: {
            idEmpresa: idEmpresa
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("idEmpresa").value          = r[0];
                document.getElementById("grupoEmpresa").value       = r[1];            
                document.getElementById("razaoSocial").value        = r[2];
                document.getElementById("codigoCNPJ").value         = r[3];
                document.getElementById("nomeFantasia").value       = r[4];
                document.getElementById("inscricaoEstadual").value  = r[5];
                document.getElementById("inscricaoMunicipal").value = r[6];            
                document.getElementById("endereco").value           = r[8];
                document.getElementById("numero").value             = r[9];
                document.getElementById("cep").value                = r[10];
                document.getElementById("cidade").value             = r[11];
                document.getElementById("bairro").value             = r[12];
                document.getElementById("estado").value             = r[13];
                document.getElementById("pais").value               = r[14];
                document.getElementById("telefone1").value          = r[15];
                document.getElementById("telefone2").value          = r[16];
                document.getElementById("celular").value            = r[17];
                document.getElementById("email").value              = r[18];
                

                if(r[7] == 'S' ){
                      $('#ativoEmpresa').prop('checked', true);
                }
                else{
                     $('#ativoEmpresa').prop('checked', false);

                }
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("grupoEmpresa").readOnly       = true;
    document.getElementById("razaoSocial").readOnly        = true;
    document.getElementById("codigoCNPJ").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly       = true;
    document.getElementById("inscricaoEstadual").readOnly  = true;
    document.getElementById("inscricaoMunicipal").readOnly = true;
    document.getElementById('ativoEmpresa').disabled       = true; 
    document.getElementById("endereco").readOnly           = true;
    document.getElementById("numero").readOnly             = true;
    document.getElementById("cep").readOnly                = true;
    document.getElementById("cidade").readOnly             = true;
    document.getElementById("bairro").readOnly             = true;
    document.getElementById("estado").readOnly             = true;
    document.getElementById("pais").readOnly               = true;
    document.getElementById("telefone1").readOnly          = true;
    document.getElementById("telefone2").readOnly          = true;
    document.getElementById("celular").readOnly            = true;
    document.getElementById("email").readOnly              = true;
    
    
    var idEmpresa  =  $('#idEmpresa').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=buscaRegistroProximo',
        data: {
            idEmpresa: idEmpresa
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idEmpresa").value          = r[0];
                document.getElementById("grupoEmpresa").value       = r[1];            
                document.getElementById("razaoSocial").value        = r[2];
                document.getElementById("codigoCNPJ").value         = r[3];
                document.getElementById("nomeFantasia").value       = r[4];
                document.getElementById("inscricaoEstadual").value  = r[5];
                document.getElementById("inscricaoMunicipal").value = r[6];            
                document.getElementById("endereco").value           = r[8];
                document.getElementById("numero").value             = r[9];
                document.getElementById("cep").value                = r[10];
                document.getElementById("cidade").value             = r[11];
                document.getElementById("bairro").value             = r[12];
                document.getElementById("estado").value             = r[13];
                document.getElementById("pais").value               = r[14];
                document.getElementById("telefone1").value          = r[15];
                document.getElementById("telefone2").value          = r[16];
                document.getElementById("celular").value            = r[17];
                document.getElementById("email").value              = r[18];
               
                       
                if(r[7] == 'S' ){
                   $('#ativoEmpresa').prop('checked', true);
                }
                else{
                    $('#ativoEmpresa').prop('checked', false);
                }
               
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("grupoEmpresa").readOnly       = true;
    document.getElementById("razaoSocial").readOnly        = true;
    document.getElementById("codigoCNPJ").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly       = true;
    document.getElementById("inscricaoEstadual").readOnly  = true;
    document.getElementById("inscricaoMunicipal").readOnly = true;
    document.getElementById('ativoEmpresa').disabled       = true; 
    document.getElementById("endereco").readOnly           = true;
    document.getElementById("numero").readOnly             = true;
    document.getElementById("cep").readOnly                = true;
    document.getElementById("cidade").readOnly             = true;
    document.getElementById("bairro").readOnly             = true;
    document.getElementById("estado").readOnly             = true;
    document.getElementById("pais").readOnly               = true;
    document.getElementById("telefone1").readOnly          = true;
    document.getElementById("telefone2").readOnly          = true;
    document.getElementById("celular").readOnly            = true;
    document.getElementById("email").readOnly              = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idEmpresa").value          = r[0];
            document.getElementById("grupoEmpresa").value       = r[1];            
            document.getElementById("razaoSocial").value        = r[2];
            document.getElementById("codigoCNPJ").value         = r[3];
            document.getElementById("nomeFantasia").value       = r[4];
            document.getElementById("inscricaoEstadual").value  = r[5];
            document.getElementById("inscricaoMunicipal").value = r[6];            
            document.getElementById("endereco").value           = r[8];
            document.getElementById("numero").value             = r[9];
            document.getElementById("cep").value                = r[10];
            document.getElementById("cidade").value             = r[11];
            document.getElementById("bairro").value             = r[12];
            document.getElementById("estado").value             = r[13];
            document.getElementById("pais").value               = r[14];
            document.getElementById("telefone1").value          = r[15];
            document.getElementById("telefone2").value          = r[16];
            document.getElementById("celular").value            = r[17];
            document.getElementById("email").value              = r[18];
           
            
            if(r[7] == 'S' ){
                  $('#ativoEmpresa').prop('checked', true);
            }
            else{
                 $('#ativoEmpresa').prop('checked', false);
                
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
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("idEmpresa").value          = r[0];
            document.getElementById("grupoEmpresa").value       = r[1];            
            document.getElementById("razaoSocial").value        = r[2];
            document.getElementById("codigoCNPJ").value         = r[3];
            document.getElementById("nomeFantasia").value       = r[4];
            document.getElementById("inscricaoEstadual").value  = r[5];
            document.getElementById("inscricaoMunicipal").value = r[6];            
            document.getElementById("endereco").value           = r[8];
            document.getElementById("numero").value             = r[9];
            document.getElementById("cep").value                = r[10];
            document.getElementById("cidade").value             = r[11];
            document.getElementById("bairro").value             = r[12];
            document.getElementById("estado").value             = r[13];
            document.getElementById("pais").value               = r[14];
            document.getElementById("telefone1").value          = r[15];
            document.getElementById("telefone2").value          = r[16];
            document.getElementById("celular").value            = r[17];
            document.getElementById("email").value              = r[18];
                       
            if(r[7] == 'S' ){
                  $('#ativoEmpresa').prop('checked', true);
            }
            else{
                 $('#ativoEmpresa').prop('checked', false);
                
            }
            
        
            $('#pesquisarModal').modal('hide');          
                    
                     
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
            "url": "index.php?m=cadastroempresa&c=cadastroempresacontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EMPRESA"},
            {"data": "ID_GRUPO_EMPRESA"},
            {"data": "NOME_FANTASIA"},
            {"data": "ATIVO"},
            {"data": "CIDADE"},
            {"data": "TELEFONE_1"},
            {"data": "TELEFONE_2"},
            {"data": "CELULAR"},
            {"data": "EMAIL"},
            {"data": "SELECIONAR"},
         
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
 }
 
 function selecionaGrid(idEmpresa){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("grupoEmpresa").readOnly       = true;
    document.getElementById("razaoSocial").readOnly        = true;
    document.getElementById("codigoCNPJ").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly       = true;
    document.getElementById("inscricaoEstadual").readOnly  = true;
    document.getElementById("inscricaoMunicipal").readOnly = true;
    document.getElementById('ativoEmpresa').disabled       = true; 
    document.getElementById("endereco").readOnly           = true;
    document.getElementById("numero").readOnly             = true;
    document.getElementById("cep").readOnly                = true;
    document.getElementById("cidade").readOnly             = true;
    document.getElementById("bairro").readOnly             = true;
    document.getElementById("estado").readOnly             = true;
    document.getElementById("pais").readOnly               = true;
    document.getElementById("telefone1").readOnly          = true;
    document.getElementById("telefone2").readOnly          = true;
    document.getElementById("celular").readOnly            = true;
    document.getElementById("email").readOnly              = true;
    
    
    
    
    
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=selecionaGrid',
        data: {
            idEmpresa: idEmpresa
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idEmpresa").value          = r[0];
            document.getElementById("grupoEmpresa").value       = r[1];            
            document.getElementById("razaoSocial").value        = r[2];
            document.getElementById("codigoCNPJ").value         = r[3];
            document.getElementById("nomeFantasia").value       = r[4];
            document.getElementById("inscricaoEstadual").value  = r[5];
            document.getElementById("inscricaoMunicipal").value = r[6];            
            document.getElementById("endereco").value           = r[8];
            document.getElementById("numero").value             = r[9];
            document.getElementById("cep").value                = r[10];
            document.getElementById("cidade").value             = r[11];
            document.getElementById("bairro").value             = r[12];
            document.getElementById("estado").value             = r[13];
            document.getElementById("pais").value               = r[14];
            document.getElementById("telefone1").value          = r[15];
            document.getElementById("telefone2").value          = r[16];
            document.getElementById("celular").value            = r[17];
            document.getElementById("email").value              = r[18];
            
                       
            if(r[7] == 'S' ){
                  $('#ativoEmpresa').prop('checked', true);
            }
            else{
                 $('#ativoEmpresa').prop('checked', false);
                
            }       
            
            
            
                     
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
   
         
   document.getElementById("grupoEmpresa").value       = "Seleicone";
   document.getElementById("idEmpresa").value          = "";
   document.getElementById("razaoSocial").value        = "";
   document.getElementById("codigoCNPJ").value         = "";
   document.getElementById("nomeFantasia").value       = "";
   document.getElementById("inscricaoEstadual").value  = "";
   document.getElementById("inscricaoMunicipal").value = "";
   document.getElementById("endereco").value           = "";
   document.getElementById("numero").value             = "";
   document.getElementById("cep").value                = "";
   document.getElementById("cidade").value             = "";
   document.getElementById("bairro").value             = "";
   document.getElementById('estado').value             = "Selecione";
   document.getElementById("pais").value               = "";
   document.getElementById("telefone1").value          = "";
   document.getElementById("telefone2").value          = "";
   document.getElementById("celular").value            = "";
   document.getElementById("email").value              = "";
    
   $('#ativoEmpresa').prop('checked', false);
     
            
    
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

function carregarGrupoEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroempresa&c=cadastroempresacontroller&f=carregarGrupoEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('grupoEmpresa').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista de GRUPO EMPRESA')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }    