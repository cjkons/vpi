/////////////////////////////////////////////
// Cadastro Unidade de Medida             ///
// SUP_UNIDADE_MEDIDA 1.00               ///   
// Desenvolvido por Matheus Jaschke     ///
// janeiro 2016                          ///
// VPI GESTAO                          ///
/////////////////////////////////////////

$(document).ready(function() {
    
  getGrid();
    
});
function novo(){
      
    
    document.getElementById("codigoUnidade").readOnly      = false;
    document.getElementById("denominacaoUnidade").readOnly = false;
    document.getElementById('ativoUnidade').disabled       = false; 

    document.getElementById("codigoUnidade").value      = "";
    document.getElementById("denominacaoUnidade").value = "";
    document.getElementById("dataCadastro").value       = "";
    $('#ativoUnidade').prop('checked', false);
      
    
  
}
    
function salvar(){
     
    var codigoUnidade      =   $('#codigoUnidade').val();             
    var denominacaoUnidade  =   $('#denominacaoUnidade').val();           
              
    var controleDePreenchimento = 'S';
 
    if(codigoUnidade == " "){
        controleDePreenchimento = 'N';
    }
    if(denominacaoUnidade == " "){
        controleDePreenchimento = 'N';
    }
    if($("#ativoUnidade").is(':checked') == true){
        var ativoUnidade = 'S';
    }
    else{
        var ativoUnidade = 'N';
    }   
    
    
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("codigoUnidade").readOnly      = true;
        document.getElementById("denominacaoUnidade").readOnly = true;
        document.getElementById('ativoUnidade').disabled       = true;
        
      


        $.ajax({
            url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=salvar',
            data: {
                codigoUnidade: codigoUnidade,
                denominacaoUnidade: denominacaoUnidade,
                ativoUnidade: ativoUnidade
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
    else{
         mensagem('Atenção', 'Prencha todoas os campos', 'alert');
       // mensagens de erro
        
          
    }
    
}

function excluir(){
    
    var codigoUnidade =   $('#codigoUnidade').val();
     
    $.ajax({
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=excluir',
        data: {
            codigoUnidade: codigoUnidade
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
    
    document.getElementById("codigoUnidade").readOnly      = false;
    document.getElementById("denominacaoUnidade").readOnly = false;
    document.getElementById('ativoUnidade').disabled       = false; 
       
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("codigoUnidade").readOnly        = true;
    document.getElementById("denominacaoUnidade").readOnly   = true;
    document.getElementById("ativoUnidade").readOnly       = true;
         
   
    
    $.ajax({
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("codigoUnidade").value = r[0];
            document.getElementById("denominacaoUnidade").value = r[1];
            document.getElementById("dataCadastro").value = r[3];
                                 
            if(r[2] == 'S' ){
                  $('#ativoUnidade').prop('checked', true);
            }
            else{
                 $('#ativoUnidade').prop('checked', false);                
            }
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("codigoUnidade").readOnly        = true;
    document.getElementById("denominacaoUnidade").readOnly   = true;
    document.getElementById("ativoUnidade").readOnly       = true;
    
    var codigoUnidade  =  $('#codigoUnidade').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=buscaRegistroAnterior',
        data: {
            codigoUnidade: codigoUnidade
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("codigoUnidade").value = r[0];
                document.getElementById("denominacaoUnidade").value = r[1];
                document.getElementById("dataCadastro").value = r[3];
                                 
            if(r[2] == 'S' ){
                  $('#ativoUnidade').prop('checked', true);
            }
            else{
                 $('#ativoUnidade').prop('checked', false);                
            }
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("codigoUnidade").readOnly        = true;
    document.getElementById("denominacaoUnidade").readOnly   = true;
    document.getElementById("ativoUnidade").readOnly       = true;
    
    var codigoUnidade  =  $('#codigoUnidade').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=buscaRegistroProximo',
        data: {
            codigoUnidade: codigoUnidade
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("codigoUnidade").value = r[0];
                document.getElementById("denominacaoUnidade").value = r[1];
                document.getElementById("dataCadastro").value = r[3];
                                 
            if(r[2] == 'S' ){
                  $('#ativoUnidade').prop('checked', true);
            }
            else{
                 $('#ativoUnidade').prop('checked', false);                
            }
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("codigoUnidade").readOnly        = true;
    document.getElementById("denominacaoUnidade").readOnly   = true;
    document.getElementById("ativoUnidade").readOnly         = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("codigoUnidade").value = r[0];
            document.getElementById("denominacaoUnidade").value = r[1];
            document.getElementById("dataCadastro").value = r[3];
                                 
            if(r[2] == 'S' ){
                  $('#ativoUnidade').prop('checked', true);
            }
            else{
                 $('#ativoUnidade').prop('checked', false);                
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
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("codigoUnidade").value = r[0];
            document.getElementById("denominacaoUnidade").value = r[1];
            document.getElementById("dataCadastro").value = r[3];
                                 
            if(r[2] == 'S' ){
                  $('#ativoUnidade').prop('checked', true);
            }
            else{
                 $('#ativoUnidade').prop('checked', false);                
            }
            
            
                     
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
            "url": "index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "CODIGO_UNIDADE"},
            {"data": "DENOMINACAO"},
            {"data": "ATIVO"},
            {"data": "USUARIO_CADASTRO"},
            {"data": "DATA_CADASTRO"},
            {"data": "USUARIO_ALTERACAO"},
            {"data": "DATA_ALTERACAO"},
            {"data": "SELECIONAR"},
            
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
   
   
  
    
    
     
 }
 
 function selecionaGrid(idCod){
    
   
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller&f=selecionaGrid',
        data: {
            idCod: idCod
                       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("codigoUnidade").value = r[0];
            document.getElementById("denominacaoUnidade").value = r[1];
            document.getElementById("dataCadastro").value = r[3];
                                 
            if(r[2] == 'S' ){
                  $('#ativoUnidade').prop('checked', true);
            }
            else{
                 $('#ativoUnidade').prop('checked', false);                
            }
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
           
    document.getElementById("codigoUnidade").value      = "";
    document.getElementById("denominacaoUnidade").value = "";
    document.getElementById("dataCadastro").value       = "";
    $('#ativoUnidade').prop('checked', false);
            
    
}