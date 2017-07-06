///////////////////////////////////////////////
/// Cadastro de Filial                      ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

var tipoFilial;

$(document).ready(function() {
  
  carregarEmpresa();    
  getGrid();
  
      

});
$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cep').blur(function(){
       
             
             
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'index.php?m=cadastroagencia&c=cadastroagenciacontroller&f=consultarCep', /* URL que será chamada */ 
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
    
    document.getElementById("empresa").readOnly             = false;
    document.getElementById("razaoSocial").readOnly         = false;
    document.getElementById("nomeFantasia").readOnly        = false;
    document.getElementById("inscricaoEstadual").readOnly   = false;
    document.getElementById("inscricaoMunicipal").readOnly  = false;
    document.getElementById("endereco").readOnly            = false;
    document.getElementById("numero").readOnly              = false;
    document.getElementById("cep").readOnly                 = false;
    document.getElementById("cidade").readOnly              = false;
    document.getElementById("bairro").readOnly              = false;
    document.getElementById("estado").readOnly              = false;
    document.getElementById("pais").readOnly                = false;
    document.getElementById("telefone1").readOnly           = false;
    document.getElementById("telefone2").readOnly           = false;
    document.getElementById("celular").readOnly             = false;
    document.getElementById("email").readOnly               = false;
    document.getElementById('ativoFilial').disabled         = false; 
    document.getElementById('projetoFilial').disabled       = false;     
       
    document.getElementById("razaoSocial").value            = "";
    document.getElementById("nomeFantasia").value           = "";
    document.getElementById("codigoCNPJ").value             = "";
    document.getElementById("codigoCEI").value              = "";
    document.getElementById("inscricaoEstadual").value      = "";
    document.getElementById("inscricaoMunicipal").value     = "";
    document.getElementById("endereco").value               = "";
    document.getElementById('numero').value                 = "";
    document.getElementById('cep').value                    = "";
    document.getElementById('cidade').value                 = "";
    document.getElementById('bairro').value                 = "";
    document.getElementById('estado').value                 = "Selecione";
    document.getElementById('pais').value                   = "";
    document.getElementById('telefone1').value              = "";
    document.getElementById('telefone2').value              = "";
    document.getElementById('celular').value                = "";
    document.getElementById('email').value                  = "";
    document.getElementById('dataCadastro').value           = "";
    document.getElementById('dataAlteracao').value          = "";
    
    document.getElementById("tipoFilial").value            = 0;
    document.getElementById("empresa").value            = "Selecione";
    
    $('#projetoFilial').prop('checked', false);
    $('#ativoFilial').prop('checked', false);
    
   
    
         
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("idFilial").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
    
   
     
    var idFilial           =   $('#idFilial').val();             
    var empresa            =   $('#empresa').val();           
    var razaoSocial        =   $('#razaoSocial').val();      
    var nomeFantasia       =   $('#nomeFantasia').val();          
    var codigoCNPJ         =   $('#codigoCNPJ').val();        
    var codigoCEI          =   $('#codigoCEI').val();          
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
 
    if(empresa == ""){
        controleDePreenchimento = 'N';
    }
    if(razaoSocial == ""){
        controleDePreenchimento = 'N';
    }
    if(nomeFantasia == ""){
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
    if(estado == ""){
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
 
    
    if($("#ativoFilial").is(':checked') == true){
        var ativoFilial = 'S';
    }
    else{
        var ativoFilial = 'N';
    }
    
    if($("#projetoFilial").is(':checked') == true){
        var projetoFilial = 'S';
    }
    else{
        var projetoFilial = 'N';
    }
    
    
   
    
    if(controleDePreenchimento ==  'S'){
        
           
        
            if(tipoFilial == 1){
                 
                if(codigoCEI == ""){
                    mensagem('CEI deve ser preenchido', "CEI deve ser preenchido", 'r', 'i', 2000, 1);
                }                
                
                else{
                                              
                    document.getElementById("empresa").readOnly             = true;
                    document.getElementById("razaoSocial").readOnly         = true;
                    document.getElementById("nomeFantasia").readOnly        = true;
                    document.getElementById("inscricaoEstadual").readOnly   = true;
                    document.getElementById("inscricaoMunicipal").readOnly  = true;
                    document.getElementById("endereco").readOnly            = true;
                    document.getElementById("numero").readOnly              = true;
                    document.getElementById("cep").readOnly                 = true;
                    document.getElementById("cidade").readOnly              = true;
                    document.getElementById("bairro").readOnly              = true;
                    document.getElementById("estado").readOnly              = true;
                    document.getElementById("pais").readOnly                = true;
                    document.getElementById("telefone1").readOnly           = true;
                    document.getElementById("telefone2").readOnly           = true;
                    document.getElementById("celular").readOnly             = true;
                    document.getElementById("email").readOnly               = true;
                    document.getElementById("dataCadastro").readOnly        = true;
                    document.getElementById("dataAlteracao").readOnly       = true;
                    document.getElementById('ativoFilial').disabled         = true; 
                    document.getElementById('projetoFilial').disabled       = true;
                    document.getElementById("codigoCNPJ").readOnly          = true;
                    document.getElementById("codigoCEI").readOnly           = true;
                     
                     
                     
                    $.ajax({
                        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=salvar',
                        data: {
                            idFilial: idFilial,
                            empresa: empresa,
                            razaoSocial: razaoSocial,
                            nomeFantasia: nomeFantasia,
                            codigoCNPJ: codigoCNPJ,
                            codigoCEI: codigoCEI,
                            ativoFilial: ativoFilial,
                            projetoFilial: projetoFilial,
                            inscricaoEstadual: inscricaoEstadual,
                            inscricaoMunicipal: inscricaoMunicipal,
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
                            email: email,
                            tipoFilial: tipoFilial


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
            }
            
            if(tipoFilial == 2){

                if(codigoCNPJ == ""){
                     mensagem('CNPJ deve ser preenchidos.', "CNPJ deve ser preenchidos", 'r', 'i', 2000, 1); 
                }
                else{
                    if(validarCNPJ(codigoCNPJ)){

                        document.getElementById("empresa").readOnly             = true;
                        document.getElementById("razaoSocial").readOnly         = true;
                        document.getElementById("nomeFantasia").readOnly        = true;
                        document.getElementById("inscricaoEstadual").readOnly   = true;
                        document.getElementById("inscricaoMunicipal").readOnly  = true;
                        document.getElementById("endereco").readOnly            = true;
                        document.getElementById("numero").readOnly              = true;
                        document.getElementById("cep").readOnly                 = true;
                        document.getElementById("cidade").readOnly              = true;
                        document.getElementById("bairro").readOnly              = true;
                        document.getElementById("estado").readOnly              = true;
                        document.getElementById("pais").readOnly                = true;
                        document.getElementById("telefone1").readOnly           = true;
                        document.getElementById("telefone2").readOnly           = true;
                        document.getElementById("celular").readOnly             = true;
                        document.getElementById("email").readOnly               = true;
                        document.getElementById("dataCadastro").readOnly        = true;
                        document.getElementById("dataAlteracao").readOnly       = true;
                        document.getElementById('ativoFilial').disabled         = true; 
                        document.getElementById('projetoFilial').disabled       = true;
                        document.getElementById("codigoCNPJ").readOnly          = true;
                        document.getElementById("codigoCEI").readOnly           = true;

                        $.ajax({
                            url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=salvar',
                            data: {
                                  idFilial: idFilial,
                                  empresa: empresa,
                                  razaoSocial: razaoSocial,
                                  nomeFantasia: nomeFantasia,
                                  codigoCNPJ: codigoCNPJ,
                                  codigoCEI: codigoCEI,
                                  ativoFilial: ativoFilial,
                                  projetoFilial: projetoFilial,
                                  inscricaoEstadual: inscricaoEstadual,
                                  inscricaoMunicipal: inscricaoMunicipal,
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
                                  email: email, 
                                  tipoFilial: tipoFilial
                            },
                            type: 'POST',
                            dataType: 'json',
                            async: true,
                            success: function(r) {

                                if (r == true) {

                                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                                    $('#basicModal').modal('hide');

                                    document.getElementById("tipoFilial").value    = 0;
                                    ddocument.getElementById("razaoSocial").value            = "";
                                    document.getElementById("nomeFantasia").value           = "";
                                    document.getElementById("codigoCNPJ").value             = "";
                                    document.getElementById("codigoCEI").value              = "";
                                    document.getElementById("ativoFilial").checkd           = false;
                                    document.getElementById("projetoFilial").checkd         = false;
                                    document.getElementById("inscricaoEstadual").value      = "";
                                    document.getElementById("inscricaoMunicipal").value     = "";
                                    document.getElementById("endereco").value               = "";
                                    document.getElementById('numero').value                 = "";
                                    document.getElementById('cep').value                    = "";
                                    document.getElementById('cidade').value                 = "";
                                    document.getElementById('bairro').value                 = "";
                                    document.getElementById('estado').value                 = "";
                                    document.getElementById('pais').value                   = "";
                                    document.getElementById('telefone1').value              = "";
                                    document.getElementById('telefone2').value              = "";
                                    document.getElementById('celular').value                = "";
                                    document.getElementById('email').value                  = "";
                                    document.getElementById('dataCadastro').value           = "";
                                    document.getElementById('dataAlteracao').value          = "";
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
                         mensagem('Atenção', 'CPF inválido', 'alert');
                                                                     
                    }        
                }
            }
    }    
    else{
        mensagem('Atenção', 'Prencha todoas os campos', 'alert');
        
      
            
    }
    
}

function excluir(){
    
    var idFilial  =   $('#idFilial').val();
     
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=excluir',
        data: {
            idFilial: idFilial
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
    
    document.getElementById("empresa").readOnly             = false;
    document.getElementById("razaoSocial").readOnly         = false;
    document.getElementById("nomeFantasia").readOnly        = false;
    document.getElementById("codigoCNPJ").readOnly          = false;
    document.getElementById("codigoCEI").readOnly           = false;
    document.getElementById("inscricaoEstadual").readOnly   = false;
    document.getElementById("inscricaoMunicipal").readOnly  = false;
    document.getElementById("endereco").readOnly            = false;
    document.getElementById("numero").readOnly              = false;
    document.getElementById("cep").readOnly                 = false;
    document.getElementById("cidade").readOnly              = false;
    document.getElementById("bairro").readOnly              = false;
    document.getElementById("estado").readOnly              = false;
    document.getElementById("pais").readOnly                = false;
    document.getElementById("telefone1").readOnly           = false;
    document.getElementById("telefone2").readOnly           = false;
    document.getElementById("celular").readOnly             = false;
    document.getElementById("email").readOnly               = false;
    document.getElementById("dataCadastro").readOnly        = false;
    document.getElementById("dataAlteracao").readOnly        = false;
    document.getElementById('ativoFilial').disabled         = false; 
    document.getElementById('projetoFilial').disabled       = false;     
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("razaoSocial").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly        = true;
    document.getElementById("inscricaoEstadual").readOnly   = true;
    document.getElementById("inscricaoMunicipal").readOnly  = true;
    document.getElementById("endereco").readOnly            = true;
    document.getElementById("numero").readOnly              = true;
    document.getElementById("cep").readOnly                 = true;
    document.getElementById("cidade").readOnly              = true;
    document.getElementById("bairro").readOnly              = true;
    document.getElementById("estado").readOnly              = true;
    document.getElementById("pais").readOnly                = true;
    document.getElementById("telefone1").readOnly           = true;
    document.getElementById("telefone2").readOnly           = true;
    document.getElementById("celular").readOnly             = true;
    document.getElementById("email").readOnly               = true;
    document.getElementById("dataCadastro").readOnly        = true;
    document.getElementById("dataAlteracao").readOnly       = true;
    document.getElementById('ativoFilial').disabled         = true; 
    document.getElementById('projetoFilial').disabled       = true;
    document.getElementById("codigoCNPJ").readOnly          = true;
    document.getElementById("codigoCEI").readOnly           = true;

   
    
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                   
            
            document.getElementById("idFilial").value = r[0];
            document.getElementById("empresa").value = r[1];
            document.getElementById("razaoSocial").value = r[2];
            document.getElementById("nomeFantasia").value = r[3]; 
            document.getElementById("codigoCNPJ").value = r[4]; 
            document.getElementById("codigoCEI").value = r[5]; 
            document.getElementById("inscricaoEstadual").value = r[8]; 
            document.getElementById("inscricaoMunicipal").value = r[9];
            document.getElementById("endereco").value = r[10];
            document.getElementById("numero").value = r[11];
            document.getElementById("cep").value = r[12];
            document.getElementById("cidade").value = r[13]; 
            document.getElementById("bairro").value = r[14]; 
            document.getElementById("estado").value = r[15]; 
            document.getElementById("pais").value = r[16]; 
            document.getElementById("telefone1").value = r[17]; 
            document.getElementById("telefone2").value = r[18];
            document.getElementById("celular").value = r[19];
            document.getElementById("email").value = r[20];
            document.getElementById("dataCadastro").value = r[21]; 
            document.getElementById("dataAlteracao").value = r[22];
            document.getElementById("tipoFilial").value = r[23];
            
                
                      
            if(r[6] == 'S' ){
                  $('#ativoFilial').prop('checked', true);
            }
            else{
                 $('#ativoFilial').prop('checked', false);
                
            }
            if(r[7] == 'S' ){
                  $('#projetoFilial').prop('checked', true);
            }
            else{
                 $('#projetoFilial').prop('checked', false);
                
            }
            
            
            
            
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    
   
    
    
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("razaoSocial").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly        = true;
    document.getElementById("inscricaoEstadual").readOnly   = true;
    document.getElementById("inscricaoMunicipal").readOnly  = true;
    document.getElementById("endereco").readOnly            = true;
    document.getElementById("numero").readOnly              = true;
    document.getElementById("cep").readOnly                 = true;
    document.getElementById("cidade").readOnly              = true;
    document.getElementById("bairro").readOnly              = true;
    document.getElementById("estado").readOnly              = true;
    document.getElementById("pais").readOnly                = true;
    document.getElementById("telefone1").readOnly           = true;
    document.getElementById("telefone2").readOnly           = true;
    document.getElementById("celular").readOnly             = true;
    document.getElementById("email").readOnly               = true;
    document.getElementById("dataCadastro").readOnly        = true;
    document.getElementById("dataAlteracao").readOnly       = true;
    document.getElementById('ativoFilial').disabled         = true; 
    document.getElementById('projetoFilial').disabled       = true;
    document.getElementById("codigoCNPJ").readOnly          = true;
    document.getElementById("codigoCEI").readOnly           = true;
    
    
  
       
         
   
    
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=buscaRegistroAnterior',
        data: {
            idFilial: idFilial
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
         
                    
            
            if(r != false){

                document.getElementById("idFilial").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("razaoSocial").value = r[2];
                document.getElementById("nomeFantasia").value = r[3]; 
                document.getElementById("codigoCNPJ").value = r[4]; 
                document.getElementById("codigoCEI").value = r[5]; 
                document.getElementById("inscricaoEstadual").value = r[8]; 
                document.getElementById("inscricaoMunicipal").value = r[9];
                document.getElementById("endereco").value = r[10];
                document.getElementById("numero").value = r[11];
                document.getElementById("cep").value = r[12];
                document.getElementById("cidade").value = r[13]; 
                document.getElementById("bairro").value = r[14]; 
                document.getElementById("estado").value = r[15]; 
                document.getElementById("pais").value = r[16]; 
                document.getElementById("telefone1").value = r[17]; 
                document.getElementById("telefone2").value = r[18];
                document.getElementById("celular").value = r[19];
                document.getElementById("email").value = r[20];
                document.getElementById("dataCadastro").value = r[21]; 
                document.getElementById("dataAlteracao").value = r[22]
                document.getElementById("tipoFilial").value = r[23];



                if(r[6] == 'S' ){
                      $('#ativoFilial').prop('checked', true);
                }
                else{
                     $('#ativoFilial').prop('checked', false);

                }
                if(r[7] == 'S' ){
                     $('#projetoFilial').prop('checked', true);
                }
                else{
                     $('#projetoFilial').prop('checked', false);
                
                }
              

            }
          
            
            
            
        },
        error: function(e) {
            
             

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("razaoSocial").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly        = true;
    document.getElementById("inscricaoEstadual").readOnly   = true;
    document.getElementById("inscricaoMunicipal").readOnly  = true;
    document.getElementById("endereco").readOnly            = true;
    document.getElementById("numero").readOnly              = true;
    document.getElementById("cep").readOnly                 = true;
    document.getElementById("cidade").readOnly              = true;
    document.getElementById("bairro").readOnly              = true;
    document.getElementById("estado").readOnly              = true;
    document.getElementById("pais").readOnly                = true;
    document.getElementById("telefone1").readOnly           = true;
    document.getElementById("telefone2").readOnly           = true;
    document.getElementById("celular").readOnly             = true;
    document.getElementById("email").readOnly               = true;
    document.getElementById("dataCadastro").readOnly        = true;
    document.getElementById("dataAlteracao").readOnly       = true;
    document.getElementById('ativoFilial').disabled         = true; 
    document.getElementById('projetoFilial').disabled       = true;
    document.getElementById("codigoCNPJ").readOnly          = true;
    document.getElementById("codigoCEI").readOnly           = true;
    
    
    var idFilial  =  $('#idFilial').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=buscaRegistroProximo',
        data: {
            idFilial: idFilial
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idFilial").value = r[0];
                document.getElementById("empresa").value = r[1];
                document.getElementById("razaoSocial").value = r[2];
                document.getElementById("nomeFantasia").value = r[3]; 
                document.getElementById("codigoCNPJ").value = r[4]; 
                document.getElementById("codigoCEI").value = r[5]; 
                document.getElementById("inscricaoEstadual").value = r[8]; 
                document.getElementById("inscricaoMunicipal").value = r[9];
                document.getElementById("endereco").value = r[10];
                document.getElementById("numero").value = r[11];
                document.getElementById("cep").value = r[12];
                document.getElementById("cidade").value = r[13]; 
                document.getElementById("bairro").value = r[14]; 
                document.getElementById("estado").value = r[15]; 
                document.getElementById("pais").value = r[16]; 
                document.getElementById("telefone1").value = r[17]; 
                document.getElementById("telefone2").value = r[18];
                document.getElementById("celular").value = r[19];
                document.getElementById("email").value = r[20];
                document.getElementById("dataCadastro").value = r[21]; 
                document.getElementById("dataAlteracao").value = r[22];
                document.getElementById("tipoFilial").value = r[23];



                if(r[6] == 'S' ){
                      $('#ativoFilial').prop('checked', true);
                }
                else{
                     $('#ativoFilial').prop('checked', false);

                }
                if(r[7] == 'S' ){
                    $('#projetoFilial').prop('checked', true);
                }
                else{
                    $('#projetoFilial').prop('checked', false);
                }
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("razaoSocial").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly        = true;
    document.getElementById("inscricaoEstadual").readOnly   = true;
    document.getElementById("inscricaoMunicipal").readOnly  = true;
    document.getElementById("endereco").readOnly            = true;
    document.getElementById("numero").readOnly              = true;
    document.getElementById("cep").readOnly                 = true;
    document.getElementById("cidade").readOnly              = true;
    document.getElementById("bairro").readOnly              = true;
    document.getElementById("estado").readOnly              = true;
    document.getElementById("pais").readOnly                = true;
    document.getElementById("telefone1").readOnly           = true;
    document.getElementById("telefone2").readOnly           = true;
    document.getElementById("celular").readOnly             = true;
    document.getElementById("email").readOnly               = true;
    document.getElementById("dataCadastro").readOnly        = true;
    document.getElementById("dataAlteracao").readOnly       = true;
    document.getElementById('ativoFilial').disabled         = true; 
    document.getElementById('projetoFilial').disabled       = true; 
    document.getElementById("codigoCNPJ").readOnly          = true;
    document.getElementById("codigoCEI").readOnly           = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idFilial").value = r[0];
            document.getElementById("empresa").value = r[1];
            document.getElementById("razaoSocial").value = r[2];
            document.getElementById("nomeFantasia").value = r[3]; 
            document.getElementById("codigoCNPJ").value = r[4]; 
            document.getElementById("codigoCEI").value = r[5]; 
            document.getElementById("inscricaoEstadual").value = r[8]; 
            document.getElementById("inscricaoMunicipal").value = r[9];
            document.getElementById("endereco").value = r[10];
            document.getElementById("numero").value = r[11];
            document.getElementById("cep").value = r[12];
            document.getElementById("cidade").value = r[13]; 
            document.getElementById("bairro").value = r[14]; 
            document.getElementById("estado").value = r[15]; 
            document.getElementById("pais").value = r[16]; 
            document.getElementById("telefone1").value = r[17]; 
            document.getElementById("telefone2").value = r[18];
            document.getElementById("celular").value = r[19];
            document.getElementById("email").value = r[20];
            document.getElementById("dataCadastro").value = r[21]; 
            document.getElementById("dataAlteracao").value = r[22];
            document.getElementById("tipoFilial").value = r[23];



            if(r[6] == 'S' ){
                $('#ativoFilial').prop('checked', true);
            }
            else{
                $('#ativoFilial').prop('checked', false);
            }
            if(r[7] == 'S' ){
                  $('#projetoFilial').prop('checked', true);
            }
            else{
                 $('#projetoFilial').prop('checked', false);
                
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
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idFilial").value = r[0];
            document.getElementById("empresa").value = r[1];
            document.getElementById("razaoSocial").value = r[2];
            document.getElementById("nomeFantasia").value = r[3]; 
            document.getElementById("codigoCNPJ").value = r[4]; 
            document.getElementById("codigoCEI").value = r[5]; 
            document.getElementById("inscricaoEstadual").value = r[8]; 
            document.getElementById("inscricaoMunicipal").value = r[9];
            document.getElementById("endereco").value = r[10];
            document.getElementById("numero").value = r[11];
            document.getElementById("cep").value = r[12];
            document.getElementById("cidade").value = r[13]; 
            document.getElementById("bairro").value = r[14]; 
            document.getElementById("estado").value = r[15]; 
            document.getElementById("pais").value = r[16]; 
            document.getElementById("telefone1").value = r[17]; 
            document.getElementById("telefone2").value = r[18];
            document.getElementById("celular").value = r[19];
            document.getElementById("email").value = r[20];
            document.getElementById("dataCadastro").value = r[21]; 
            document.getElementById("dataAlteracao").value = r[22];
            document.getElementById("tipoFilial").value = r[23];



            if(r[6] == 'S' ){
                $('#ativoFilial').prop('checked', true);
            }
            else{
                $('#ativoFilial').prop('checked', false);
            }
            if(r[7] == 'S' ){
                  $('#projetoFilial').prop('checked', true);
            }
            else{
                 $('#projetoFilial').prop('checked', false);
                
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
            "url": "index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EMPRESA_FILIAL"},
            {"data": "ID_EMPRESA"},
            {"data": "NOME_FANTASIA"},
            {"data": "ATIVO"},
            {"data": "PROJETO"},
            {"data": "CIDADE"},
            {"data": "TELEFONE_1"},
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
 
 function selecionaGrid(idFilial){
    
   
    // Pesquisa Para alimentar campos
    
    
    document.getElementById("empresa").readOnly             = true;
    document.getElementById("razaoSocial").readOnly         = true;
    document.getElementById("nomeFantasia").readOnly        = true;
    document.getElementById("inscricaoEstadual").readOnly   = true;
    document.getElementById("inscricaoMunicipal").readOnly  = true;
    document.getElementById("endereco").readOnly            = true;
    document.getElementById("numero").readOnly              = true;
    document.getElementById("cep").readOnly                 = true;
    document.getElementById("cidade").readOnly              = true;
    document.getElementById("bairro").readOnly              = true;
    document.getElementById("estado").readOnly              = true;
    document.getElementById("pais").readOnly                = true;
    document.getElementById("telefone1").readOnly           = true;
    document.getElementById("telefone2").readOnly           = true;
    document.getElementById("celular").readOnly             = true;
    document.getElementById("email").readOnly               = true;
    document.getElementById("dataCadastro").readOnly        = true;
    document.getElementById("dataAlteracao").readOnly       = true;
    document.getElementById('ativoFilial').disabled         = true; 
    document.getElementById('projetoFilial').disabled       = true; 
    document.getElementById("codigoCNPJ").readOnly          = true;
    document.getElementById("codigoCEI").readOnly           = true;
    
    
    
    
    
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=selecionaGrid',
        data: {
            idFilial: idFilial
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idFilial").value = r[0];
            document.getElementById("empresa").value = r[1];
            document.getElementById("razaoSocial").value = r[2];
            document.getElementById("nomeFantasia").value = r[3]; 
            document.getElementById("codigoCNPJ").value = r[4]; 
            document.getElementById("codigoCEI").value = r[5]; 
            document.getElementById("inscricaoEstadual").value = r[8]; 
            document.getElementById("inscricaoMunicipal").value = r[9];
            document.getElementById("endereco").value = r[10];
            document.getElementById("numero").value = r[11];
            document.getElementById("cep").value = r[12];
            document.getElementById("cidade").value = r[13]; 
            document.getElementById("bairro").value = r[14]; 
            document.getElementById("estado").value = r[15]; 
            document.getElementById("pais").value = r[16]; 
            document.getElementById("telefone1").value = r[17]; 
            document.getElementById("telefone2").value = r[18];
            document.getElementById("celular").value = r[19];
            document.getElementById("email").value = r[20];
            document.getElementById("dataCadastro").value = r[21]; 
            document.getElementById("dataAlteracao").value = r[22]; 
            document.getElementById("tipoFilial").value = r[23]; 


            if(r[6] == 'S' ){
                $('#ativoFilial').prop('checked', true);
            }
            else{
                $('#ativoFilial').prop('checked', false);
            }
            if(r[7] == 'S' ){
                  $('#projetoFilial').prop('checked', true);
            }
            else{
                 $('#projetoFilial').prop('checked', false);
                
            } 
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
         
  
    document.getElementById("tipoFilial").value    = 0;
    document.getElementById("razaoSocial").value = "";
    document.getElementById("nomeFantasia").value = "";
    document.getElementById("codigoCNPJ").value = "";
    document.getElementById("codigoCEI").value = "";
    document.getElementById("ativoFilial").checkd = false;
    document.getElementById("projetoFilial").checkd = false;
    document.getElementById("inscricaoEstadual").value = "";
    document.getElementById("inscricaoMunicipal").value = "";
    document.getElementById("endereco").value = "";
    document.getElementById('numero').value = "";
    document.getElementById('cep').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('estado').value                 = "Selecione";
    document.getElementById('pais').value = "";
    document.getElementById('telefone1').value = "";
    document.getElementById('telefone2').value = "";
    document.getElementById('celular').value = "";
    document.getElementById('email').value = "";
    document.getElementById('dataCadastro').value = "";
    document.getElementById('dataAlteracao').value = "";
    document.getElementById("empresa").value            = "Selecione";
    
    
    
            
    
}


///////////////////////////////////////////////////
///     Funções específicas para esse BRD        //
///                                             //
//////////////////////////////////////////////////

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastrofilial&c=cadastrofilialcontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('empresa').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function selecionarTipo(){
   
    var tipo = document.getElementById("tipoFilial").value;
   
    tipoFilial = tipo;
     
        
    if(tipoFilial == 1){
       document.getElementById("codigoCNPJ").readOnly  = true;       
       document.getElementById("codigoCEI").readOnly = false;               
    }
    else{      
       document.getElementById("codigoCEI").readOnly  = true;
       document.getElementById("codigoCNPJ").readOnly   = false;
   }
    
}

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

function mascaraCEI(cnpj){
    
    if(cnpj.value.length == 2){
      cnpj.value =  cnpj.value + '.';
    }  
    if(cnpj.value.length == 6){
      cnpj.value = cnpj.value + '.';
    }  
    if(cnpj.value.length == 11){
      cnpj.value = cnpj.value + '/';
    }  
    
}