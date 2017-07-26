///////////////////////////////////////////////
/// Cadastro de Epi                         ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

$(document).ready(function() {

 carregarTipoEpi();
  
 getGrid();
 
 $('#validadeCa').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
   

});

function carregarTipoEpi(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=carregarTipoEpi',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('tipoEpi').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar Tipo de EPIs', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function novo(){
    
    
    document.getElementById("idEpi").readOnly            = true;
    document.getElementById("numeroCa").readOnly         = false;
    document.getElementById("tipoEpi").readOnly          = false;
    document.getElementById("descricaoEpi").readOnly     = false;
    document.getElementById("validadeCa").readOnly       = false;
    document.getElementById("fabricante").readOnly       = false;
    
    
    document.getElementById("idEpi").value         = "";
    document.getElementById("numeroCa").value         = "";
    document.getElementById("tipoEpi").value         = 0;
    document.getElementById("descricaoEpi").value         = "";
    document.getElementById("validadeCa").value         = "";
    document.getElementById("fabricante").value         = "";
        
     
         
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            
             document.getElementById("idEpi").value  = r;
                 
            
        },
        error: function(e) {
           
        }
    }); 
    
}

function verificarCaDigitado(){
    
    var numeroCa  =   $('#numeroCa').val();
     
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=verificarCaDigitado',
        data: {
            numeroCa: numeroCa
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == 1) {
                
                     mensagem('Atençao', 'Este CA já foi Cadastrado!', 'error');
            }
            else {
                    mensagem('', 'Ok!', 'success');
            }
        },
        error: function(e) {
              
        }
    }); 
     
}
    
function salvar(){
     
    var idEpi               =   $('#idEpi').val();             
    var numeroCa            =   $('#numeroCa').val();           
    var tipoEpi             =   $('#tipoEpi').val();      
    var descricaoEpi        =   $('#descricaoEpi').val();          
    var validadeCa          =   $('#validadeCa').val();        
    var fabricante          =   $('#fabricante').val();          
    
           
    var controleDePreenchimento = 'S';
 
    if(idEpi == ""){
        controleDePreenchimento = 'N';
    }
    if(numeroCa == ""){
        controleDePreenchimento = 'N';
    }
    if(tipoEpi == 0){
        controleDePreenchimento = 'N';
    }
    
    if(validadeCa == ""){
        controleDePreenchimento = 'N';
    }
    if(fabricante == ""){
        controleDePreenchimento = 'N';
    }
    
     
    
    if(controleDePreenchimento ==  'S'){
        
        
            document.getElementById("idEpi").readOnly        = true;
            document.getElementById("numeroCa").readOnly   = true;
            document.getElementById("tipoEpi").readOnly       = true;
            document.getElementById("descricaoEpi").readOnly     = true;
            document.getElementById("validadeCa").readOnly       = true;
            document.getElementById("fabricante").readOnly       = true;
            
      
      
            $.ajax({
                url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=salvar',
                data: {
                    idEpi: idEpi,
                    numeroCa: numeroCa,
                    tipoEpi: tipoEpi,
                    descricaoEpi: descricaoEpi,
                    validadeCa: validadeCa,
                    fabricante: fabricante
                    
                   
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
                         mensagem('Sucesso', 'Salvo com sucesso', 'success');
                        $('#basicModal').modal('hide');
                        getGrid();
                       
                       
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
    
    var idEpi  =   $('#idEpi').val();
     
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=excluir',
        data: {
            idEpi: idEpi
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
                getGrid();
            }
            else {
                 mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
                getGrid();
            }
        },
        error: function(e) {
              mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#basicModal').modal('hide');
                atualizar();
                getGrid();
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
    
        document.getElementById("idEpi").readOnly            = true;
        document.getElementById("numeroCa").readOnly         = false;
        document.getElementById("tipoEpi").readOnly          = false;
        document.getElementById("descricaoEpi").readOnly     = false;
        document.getElementById("validadeCa").readOnly       = false;
        document.getElementById("fabricante").readOnly       = false;
   
    
       
    
}

function buscaPrimeiroRegistro(){
    
        document.getElementById("idEpi").readOnly            = true;
        document.getElementById("numeroCa").readOnly         = true;
        document.getElementById("tipoEpi").readOnly          = true;
        document.getElementById("descricaoEpi").readOnly     = true;
        document.getElementById("validadeCa").readOnly       = true;
        document.getElementById("fabricante").readOnly       = true;
    
   
    
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            
            
            document.getElementById("idEpi").value         = r[0];
            document.getElementById("numeroCa").value         = r[1];
            document.getElementById("tipoEpi").value         = r[2];
            document.getElementById("descricaoEpi").value         = r[3];
            document.getElementById("validadeCa").value         = r[4];
            document.getElementById("fabricante").value         = r[5];
            
           
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
        document.getElementById("idEpi").readOnly            = true;
        document.getElementById("numeroCa").readOnly         = true;
        document.getElementById("tipoEpi").readOnly          = true;
        document.getElementById("descricaoEpi").readOnly     = true;
        document.getElementById("validadeCa").readOnly       = true;
        document.getElementById("fabricante").readOnly       = true;
    
    
    
    var idEpi  =  $('#idEpi').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=buscaRegistroAnterior',
        data: {
            idEpi: idEpi
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idEpi").value         = r[0];
            document.getElementById("numeroCa").value         = r[1];
            document.getElementById("tipoEpi").value         = r[2];
            document.getElementById("descricaoEpi").value         = r[3];
            document.getElementById("validadeCa").value         = r[4];
            document.getElementById("fabricante").value         = r[5];
            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
        document.getElementById("idEpi").readOnly            = true;
        document.getElementById("numeroCa").readOnly         = true;
        document.getElementById("tipoEpi").readOnly          = true;
        document.getElementById("descricaoEpi").readOnly     = true;
        document.getElementById("validadeCa").readOnly       = true;
        document.getElementById("fabricante").readOnly       = true;
    
    
    var idEpi  =  $('#idEpi').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=buscaRegistroProximo',
        data: {
            idEpi: idEpi
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
            
                document.getElementById("idEpi").value         = r[0];
            document.getElementById("numeroCa").value         = r[1];
            document.getElementById("tipoEpi").value         = r[2];
            document.getElementById("descricaoEpi").value         = r[3];
            document.getElementById("validadeCa").value         = r[4];
            document.getElementById("fabricante").value         = r[5];
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("idEpi").readOnly            = true;
        document.getElementById("numeroCa").readOnly         = true;
        document.getElementById("tipoEpi").readOnly          = true;
        document.getElementById("descricaoEpi").readOnly     = true;
        document.getElementById("validadeCa").readOnly       = true;
        document.getElementById("fabricante").readOnly       = true;
  
    
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("idEpi").value         = r[0];
            document.getElementById("numeroCa").value         = r[1];
            document.getElementById("tipoEpi").value         = r[2];
            document.getElementById("descricaoEpi").value         = r[3];
            document.getElementById("validadeCa").value         = r[4];
            document.getElementById("fabricante").value         = r[5];
            
           
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
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
            document.getElementById("idEpi").value         = r[0];
            document.getElementById("numeroCa").value         = r[1];
            document.getElementById("tipoEpi").value         = r[2];
            document.getElementById("descricaoEpi").value         = r[3];
            document.getElementById("validadeCa").value         = r[4];
            document.getElementById("fabricante").value         = r[5];
        
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
            "url": "index.php?m=cadastroepi&c=cadastroepicontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EPI"},
            {"data": "COD_CA"},
            {"data": "TIPO_EPI"},
            {"data": "DESCRICAO_EPI"},
            {"data": "VALIDADE_CA"},
            {"data": "FABRICANTE_EPI"},
            {"data": "SELECIONAR"},
            
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
 }
 
 function selecionaGrid(idEpi){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("idEpi").readOnly            = true;
        document.getElementById("numeroCa").readOnly         = true;
        document.getElementById("tipoEpi").readOnly          = true;
        document.getElementById("descricaoEpi").readOnly     = true;
        document.getElementById("validadeCa").readOnly       = true;
        document.getElementById("fabricante").readOnly       = true;
  
    
    
    
    $.ajax({
        url: 'index.php?m=cadastroepi&c=cadastroepicontroller&f=selecionaGrid',
        data: {
            idEpi: idEpi
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
         document.getElementById("idEpi").value         = r[0];
            document.getElementById("numeroCa").value         = r[1];
            document.getElementById("tipoEpi").value         = r[2];
            document.getElementById("descricaoEpi").value         = r[3];
            document.getElementById("validadeCa").value         = r[4];
            document.getElementById("fabricante").value         = r[5];
           
            $('#pesquisarModal').modal('hide');            
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}
function atualizar(){
     
    
    document.getElementById("idEpi").value         = "";
    document.getElementById("numeroCa").value         = "";
    document.getElementById("tipoEpi").value         = 0;
    document.getElementById("descricaoEpi").value         = "";
    document.getElementById("validadeCa").value         = "";
    document.getElementById("fabricante").value         = "";
 
    
    
    
            
    
}

