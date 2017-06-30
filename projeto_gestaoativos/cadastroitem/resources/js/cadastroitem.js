/////////////////////////////////////////////
// Cadastro de Empresa                   ///
// SYS_EMPRESA 1.00                      ///   
// Desenvolvido por Heitor Siqueira     ///
// OUTUBRO de                           ///
// VPI GESTAO                          ///
/////////////////////////////////////////

$(document).ready(function() {
carregarUnidadeMedida();
carregarFamilia();
carregarComprador();
getGrid();

    

});


function novo(){
    // desabilitar campos e buscar 
    
    
    document.getElementById("codItem").readOnly             = false;
    document.getElementById("descItem").readOnly            = false;
    document.getElementById("comprador").readOnly           = false;
    document.getElementById("unidadeMedida").readOnly       = false;
    document.getElementById("tipoFiscal").readOnly          = false;
    document.getElementById("tipoItem").readOnly            = false; 
    document.getElementById("familia").readOnly             = false;
    document.getElementById("contaContabil").readOnly       = false;
    document.getElementById("codNCM").readOnly              = false;
    document.getElementById("codFiscal").readOnly           = false;
    document.getElementById("contabiliza").readOnly         = false;
    document.getElementById("incidenciaICMS").readOnly      = false;
    document.getElementById("incidenciaIPI").readOnly       = false;
    document.getElementById("contabPISCOFINS").readOnly     = false;
    document.getElementById("ativo").disabled               = false;
   
    
    //Preencher campos vazio
        
    document.getElementById("idItem").value             = "";   
    document.getElementById("codItem").value            = "";
    document.getElementById("descItem").value           = "";
    document.getElementById("comprador").value          = 0;
    document.getElementById("unidadeMedida").value      = 0;
    document.getElementById("tipoFiscal").value         = 0;
    document.getElementById("tipoItem").value           = 0;
    document.getElementById("familia").value            = 0;
    document.getElementById("contaContabil").value      = "";
    document.getElementById("codNCM").value             = "";
    document.getElementById("codFiscal").value          = "";
    document.getElementById("contabiliza").value        = 0;
    document.getElementById("incidenciaICMS").value     = 0;
    document.getElementById("incidenciaIPI").value      = 0;
    document.getElementById("contabPISCOFINS").value    = 0;
        
    $('#ativo').prop('checked', false);
    
   

         
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            //atribuindo retorno ao campo
            
             document.getElementById("idItem").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}
    
function salvar(){
     // pegar valores atribuidos no html
     
    var idItem             =   $('#idItem').val();     
    var codItem            =   $('#codItem').val();           
    var descItem           =   $('#descItem').val();      
    var comprador          =   $('#comprador').val();
    var unidadeMedida      =   $('#unidadeMedida').val();        
    var tipoFiscal         =   $('#tipoFiscal').val();          
    var tipoItem           =   $('#tipoItem').val();          
    var familia            =   $('#familia').val();
    var contaContabil      =   $('#contaContabil').val();    
    var codNCM             =   $('#codNCM').val();  
    var codFiscal          =   $('#codFiscal').val();             
    var contabiliza        =   $('#contabiliza').val();           
    var incidenciaICMS     =   $('#incidenciaICMS').val();      
    var incidenciaIPI      =   $('#incidenciaIPI').val();          
    var contabPISCOFINS    =   $('#contabPISCOFINS').val();        
              
    //alert(comprador);        
    
    
    
    // validacao para ver ser esta preenchido ou nao
     
    var controleDePreenchimento = 'S';
 
    if(idItem == ""){
        controleDePreenchimento = 'N';
    }
    if(codItem == ""){
        controleDePreenchimento = 'N';
    }
    if(descItem == ""){
        controleDePreenchimento = 'N';
    }
    if(comprador == "" ){
        controleDePreenchimento = 'N';
    }
   
    if(unidadeMedida == 0){
        controleDePreenchimento = 'N';
    }
    if(tipoFiscal == ""){
        controleDePreenchimento = 'N';
    }
    if(tipoItem == ""){
        controleDePreenchimento = 'N';
    }
    if(familia == 0){
        controleDePreenchimento = 'N';
    }
    if(contaContabil == ""){
        controleDePreenchimento = 'N';
    }
    if(codNCM == ""){
        controleDePreenchimento = 'N';
    }
     if(codFiscal == ""){
        controleDePreenchimento = 'N';
    }
    if(contabiliza == 0){
        controleDePreenchimento = 'N';
    }
    if(incidenciaICMS == 0){
        controleDePreenchimento = 'N';
    }
    if(incidenciaIPI == 0){
        controleDePreenchimento = 'N';
    }
    if(contabPISCOFINS == 0){
        controleDePreenchimento = 'N';
    }
   
        
    // pega valor do checkbox
    
    if($("#ativo").is(':checked') == true){
        var ativo = 'S';
    }
    else{
        var ativo = 'N';
    }   
    
    
   
    
    //verifica se esta todos os campos preenchidos
    
    if(controleDePreenchimento ==  'S'){
        
       
           //bloquear campos tudo 
        document.getElementById("idItem").readOnly = true;
        document.getElementById("codItem").readOnly = true;
        document.getElementById("descItem").readOnly = true;
        document.getElementById("comprador").readOnly = true;
        document.getElementById("unidadeMedida").readOnly = true;
        document.getElementById("tipoFiscal").readOnly = true;
        document.getElementById("tipoItem").readOnly = true;
        document.getElementById("familia").readOnly = true;
        document.getElementById("contaContabil").readOnly = true;
        document.getElementById("codNCM").readOnly = true;
        document.getElementById("codFiscal").readOnly = true;
        document.getElementById("contabiliza").readOnly = true;
        document.getElementById("incidenciaICMS").readOnly = true;
        document.getElementById("incidenciaIPI").readOnly = true;
        document.getElementById("contabPISCOFINS").readOnly = true;
        document.getElementById("ativo").readOnly = true;
        

            // chamadas passando as  variaveis em ajax
        $.ajax({
            url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=salvar',
            data: {
                idItem: idItem,
                codItem: codItem,
                descItem: descItem,
                comprador: comprador,
                unidadeMedida: unidadeMedida,
                tipoFiscal: tipoFiscal,
                tipoItem: tipoItem,
                familia: familia,
                contaContabil: contaContabil,
                codNCM: codNCM,
                codFiscal: codFiscal,
                contabiliza: contabiliza,
                incidenciaICMS: incidenciaICMS,
                incidenciaIPI: incidenciaIPI,
                contabPISCOFINS: contabPISCOFINS,
                ativo: ativo,
                

            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function (r) {

                if (r == true) {
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    $('#basicModal').modal('hide');
                    atualizar();
                } else {
                    mensagem('Atenção', 'Erro ao salvar', 'error');
                    atualizar();
                }
            },
            error: function (e) {
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
    
    var idItem  =   $('#idItem').val();
     
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=excluir',
        data: {
            idItem: idItem
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
            atualizar();

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
    
    document.getElementById("codItem").readOnly             = false;
    document.getElementById("descItem").readOnly            = false;
    document.getElementById("comprador").readOnly           = false;
    document.getElementById("unidadeMedida").readOnly       = false;
    document.getElementById("tipoFiscal").readOnly          = false;
    document.getElementById("tipoItem").readOnly            = false; 
    document.getElementById("familia").readOnly             = false;
    document.getElementById("contaContabil").readOnly       = false;
    document.getElementById("codNCM").readOnly              = false;
    document.getElementById("codFiscal").readOnly           = false;
    document.getElementById("contabiliza").readOnly         = false;
    document.getElementById("incidenciaICMS").readOnly      = false;
    document.getElementById("incidenciaIPI").readOnly       = false;
    document.getElementById("contabPISCOFINS").readOnly     = false;
    document.getElementById("ativo").disabled               = false;
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("idItem").readOnly              = true;
    document.getElementById("codItem").readOnly             = true;
    document.getElementById("descItem").readOnly            = true;
    document.getElementById("comprador").readOnly           = true;
    document.getElementById("unidadeMedida").readOnly       = true;
    document.getElementById("tipoFiscal").readOnly          = true;
    document.getElementById("tipoItem").readOnly            = true;
    document.getElementById("familia").readOnly             = true;
    document.getElementById("contaContabil").readOnly       = true;
    document.getElementById("codNCM").readOnly              = true;
    document.getElementById("codFiscal").readOnly           = true;
    document.getElementById("contabiliza").readOnly         = true;
    document.getElementById("incidenciaICMS").readOnly      = true;
    document.getElementById("incidenciaIPI").readOnly       = true;
    document.getElementById("contabPISCOFINS").readOnly     = true;
    document.getElementById("ativo").readOnly               = true;
         
   
    
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("idItem").value             = r[0];
            document.getElementById("codItem").value            = r[1];
            document.getElementById("descItem").value           = r[2];
            document.getElementById("comprador").value          = r[3];
            document.getElementById("unidadeMedida").value      = r[4];
            document.getElementById("tipoFiscal").value         = r[5];
            document.getElementById("tipoItem").value           = r[6];
            document.getElementById("familia").value            = r[7];
            document.getElementById("contaContabil").value      = r[8];
            document.getElementById("codNCM").value             = r[9];
            document.getElementById("codFiscal").value          = r[10];
            document.getElementById("contabiliza").value        = r[11];
            document.getElementById("incidenciaICMS").value     = r[12];
            document.getElementById("incidenciaIPI").value      = r[13];
            document.getElementById("contabPISCOFINS").value    = r[14];
            
            
            if(r[15] == 'S' ){
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
    
    document.getElementById("idItem").readOnly              = true;
    document.getElementById("codItem").readOnly             = true;
    document.getElementById("descItem").readOnly            = true;
    document.getElementById("comprador").readOnly           = true;
    document.getElementById("unidadeMedida").readOnly       = true;
    document.getElementById("tipoFiscal").readOnly          = true;
    document.getElementById("tipoItem").readOnly            = true;
    document.getElementById("familia").readOnly             = true;
    document.getElementById("contaContabil").readOnly       = true;
    document.getElementById("codNCM").readOnly              = true;
    document.getElementById("codFiscal").readOnly           = true;
    document.getElementById("contabiliza").readOnly         = true;
    document.getElementById("incidenciaICMS").readOnly      = true;
    document.getElementById("incidenciaIPI").readOnly       = true;
    document.getElementById("contabPISCOFINS").readOnly     = true;
    document.getElementById("ativo").readOnly               = true;
    
    
    
    var idItem  =  $('#idItem').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=buscaRegistroAnterior',
        data: {
            idItem: idItem
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("idItem").value             = r[0];
                document.getElementById("codItem").value            = r[1];
                document.getElementById("descItem").value           = r[2];
                document.getElementById("comprador").value          = r[3];
                document.getElementById("unidadeMedida").value      = r[4];
                document.getElementById("tipoFiscal").value         = r[5];
                document.getElementById("tipoItem").value           = r[6];
                document.getElementById("familia").value            = r[7];
                document.getElementById("contaContabil").value      = r[8];
                document.getElementById("codNCM").value             = r[9];
                document.getElementById("codFiscal").value          = r[10];
                document.getElementById("contabiliza").value        = r[11];
                document.getElementById("incidenciaICMS").value     = r[12];
                document.getElementById("incidenciaIPI").value      = r[13];
                document.getElementById("contabPISCOFINS").value    = r[14];
                

                if(r[15] == 'S' ){
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
    
    document.getElementById("idItem").readOnly              = true;
    document.getElementById("codItem").readOnly             = true;
    document.getElementById("descItem").readOnly            = true;
    document.getElementById("comprador").readOnly           = true;
    document.getElementById("unidadeMedida").readOnly       = true;
    document.getElementById("tipoFiscal").readOnly          = true;
    document.getElementById("tipoItem").readOnly            = true;
    document.getElementById("familia").readOnly             = true;
    document.getElementById("contaContabil").readOnly       = true;
    document.getElementById("codNCM").readOnly              = true;
    document.getElementById("codFiscal").readOnly           = true;
    document.getElementById("contabiliza").readOnly         = true;
    document.getElementById("incidenciaICMS").readOnly      = true;
    document.getElementById("incidenciaIPI").readOnly       = true;
    document.getElementById("contabPISCOFINS").readOnly     = true;
    document.getElementById("ativo").readOnly               = true;
    
      
    
    var idItem  =  $('#idItem').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=buscaRegistroProximo',
        data: {
            idItem: idItem
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("idItem").value             = r[0];
                document.getElementById("codItem").value            = r[1];
                document.getElementById("descItem").value           = r[2];
                document.getElementById("comprador").value          = r[3];
                document.getElementById("unidadeMedida").value      = r[4];
                document.getElementById("tipoFiscal").value         = r[5];
                document.getElementById("tipoItem").value           = r[6];
                document.getElementById("familia").value            = r[7];
                document.getElementById("contaContabil").value      = r[8];
                document.getElementById("codNCM").value             = r[9];
                document.getElementById("codFiscal").value          = r[10];
                document.getElementById("contabiliza").value        = r[11];
                document.getElementById("incidenciaICMS").value     = r[12];
                document.getElementById("incidenciaIPI").value      = r[13];
                document.getElementById("contabPISCOFINS").value    = r[14];
               
                       
                if(r[15] == 'S' ){
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
    
    document.getElementById("idItem").readOnly              = true;
    document.getElementById("codItem").readOnly             = true;
    document.getElementById("descItem").readOnly            = true;
    document.getElementById("comprador").readOnly           = true;
    document.getElementById("unidadeMedida").readOnly       = true;
    document.getElementById("tipoFiscal").readOnly          = true;
    document.getElementById('tipoItem').readOnly            = true;
    document.getElementById("familia").readOnly             = true;
    document.getElementById("contaContabil").readOnly       = true;
    document.getElementById("codNCM").readOnly              = true;
    document.getElementById("codFiscal").readOnly           = true;
    document.getElementById("contabiliza").readOnly         = true;
    document.getElementById("incidenciaICMS").readOnly      = true;
    document.getElementById("incidenciaIPI").readOnly       = true;
    document.getElementById("contabPISCOFINS").readOnly     = true;
    document.getElementById("ativo").readOnly               = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idItem").value             = r[0];
            document.getElementById("codItem").value            = r[1];
            document.getElementById("descItem").value           = r[2];
            document.getElementById("comprador").value          = r[3];
            document.getElementById("unidadeMedida").value      = r[4];
            document.getElementById("tipoFiscal").value         = r[5];
            document.getElementById("tipoItem").value           = r[6];
            document.getElementById("familia").value            = r[7];
            document.getElementById("contaContabil").value      = r[8];
            document.getElementById("codNCM").value             = r[9];
            document.getElementById("codFiscal").value          = r[10];
            document.getElementById("contabiliza").value        = r[11];
            document.getElementById("incidenciaICMS").value     = r[12];
            document.getElementById("incidenciaIPI").value      = r[13];
            document.getElementById("contabPISCOFINS").value    = r[14];
            
            if(r[15] == 'S' ){
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
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idItem").value             = r[0];
            document.getElementById("codItem").value            = r[1];
            document.getElementById("descItem").value           = r[2];
            document.getElementById("comprador").value          = r[3];
            document.getElementById("unidadeMedida").value      = r[4];
            document.getElementById("tipoFiscal").value         = r[5];
            document.getElementById("tipoItem").value           = r[6];
            document.getElementById("familia").value            = r[7];
            document.getElementById("contaContabil").value      = r[8];
            document.getElementById("codNCM").value             = r[9];
            document.getElementById("codFiscal").value          = r[10];
            document.getElementById("contabiliza").value        = r[11];
            document.getElementById("incidenciaICMS").value     = r[12];
            document.getElementById("incidenciaIPI").value      = r[13];
            document.getElementById("contabPISCOFINS").value    = r[14];
            
            
                       
            if(r[15] == 'S' ){
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
            "url": "index.php?m=cadastroitem&c=cadastroitemcontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID"},
            {"data": "COD_ITEM"},
            {"data": "DESC_ITEM"},
            {"data": "UNIDADE_MEDIDA"},
            {"data": "TIPO_FISCAL"},
            {"data": "TIPO_ITEM"},
            {"data": "SELECIONAR"},
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
 
   /* $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=cadastroitem&c=cadastroitemcontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID"},
            {"data": "COD_ITEM"},
            {"data": "DESC_ITEM"},
            {"data": "UNIDADE_MEDIDA"},
            {"data": "TIPO_FISCAL"},
            {"data": "TIPO_ITEM"},
            {"data": "SELECIONAR"},
         
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     */
 }
 
 function selecionaGrid(idItem){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idItem").readOnly              = true;
    document.getElementById("codItem").readOnly             = true;
    document.getElementById("descItem").readOnly            = true;
    document.getElementById("comprador").readOnly           = true;
    document.getElementById("unidadeMedida").readOnly       = true;
    document.getElementById("tipoFiscal").readOnly          = true;
    document.getElementById('tipoItem').readOnly            = true;
    document.getElementById("familia").readOnly             = true;
    document.getElementById("contaContabil").readOnly       = true;
    document.getElementById("codNCM").readOnly              = true;
    document.getElementById("codFiscal").readOnly           = true;
    document.getElementById("contabiliza").readOnly         = true;
    document.getElementById("incidenciaICMS").readOnly      = true;
    document.getElementById("incidenciaIPI").readOnly       = true;
    document.getElementById("contabPISCOFINS").readOnly     = true;
    document.getElementById("ativo").readOnly               = true;
     
       
    
    
    
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=selecionaGrid',
        data: {
            idItem: idItem
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            
            
            document.getElementById("idItem").value             = r[0];
            document.getElementById("codItem").value            = r[1];
            document.getElementById("descItem").value           = r[2];
            document.getElementById("comprador").value          = r[3];
            document.getElementById("unidadeMedida").value      = r[4];
            document.getElementById("tipoFiscal").value         = r[5];
            document.getElementById("tipoItem").value           = r[6];
            document.getElementById("familia").value            = r[7];
            document.getElementById("contaContabil").value      = r[8];
            document.getElementById("codNCM").value             = r[9];
            document.getElementById("codFiscal").value          = r[10];
            document.getElementById("contabiliza").value        = r[11];
            document.getElementById("incidenciaICMS").value     = r[12];
            document.getElementById("incidenciaIPI").value      = r[13];
            document.getElementById("contabPISCOFINS").value    = r[14];
            
                       
            if(r[15] == 'S' ){
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
	
    document.getElementById("idItem").readOnly = "";
    document.getElementById("codItem").readOnly = "";
    document.getElementById("descItem").readOnly = "";
    document.getElementById("comprador").readOnly = "";
    document.getElementById("unidadeMedida").readOnly = "";
    document.getElementById("tipoFiscal").readOnly = "";
    document.getElementById("tipoItem").readOnly = "";
    document.getElementById("familia").readOnly = "";
    document.getElementById("contaContabil").readOnly = "";
    document.getElementById("codNCM").readOnly = "";
    document.getElementById("codFiscal").readOnly = "";
    document.getElementById("contabiliza").readOnly = "";
    document.getElementById("incidenciaICMS").readOnly = "";
    document.getElementById("incidenciaIPI").readOnly = "";
    document.getElementById("contabPISCOFINS").readOnly = "";
    document.getElementById("ativo").readOnly = true;
         
   
    
   $('#ativo').prop('checked', false);
     
     getGrid();
            
    
}


//////////////////////////////////////////////////////////////
//         FUNÇÕES EPECÍFICAS PARA ESSE BRD                //         
/////////////////////////////////////////////////////////////




function carregarUnidadeMedida(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=carregarUnidadeMedida',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('unidadeMedida').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista de UNIDADE MEDIDA')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }    
 
 function carregarFamilia(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=carregarFamilia',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('familia').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista FAMILIA')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }    
 
 
 function carregarComprador(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroitem&c=cadastroitemcontroller&f=carregarComprador',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('comprador').innerHTML = data;
               
            } else {
                alert('Erro ao carregar a lista COMPRADOR')
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
 }    