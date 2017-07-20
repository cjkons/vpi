///////////////////////////////////////////////
/// Cadastro de Aniversario                 ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

var totalLinhas = 0;
var totalEditar = 0;

$(document).ready(function() {
  
 
  carregarEmpresa();
  carregarFilial();
  
   
   
  $('#periodoIni').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
  $('#periodoFim').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
    

});


function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idEmpresaFiltro').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
           
        }
    });
}

function carregarFilial(){
    
    var idEmpresa = document.getElementById("idEmpresaFiltro").value;
    
              
    $.ajax({
        url: 'index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=carregarFilial',
        data: {
            idEmpresa: idEmpresa
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idFilialFiltro').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Filial', 'error'); 
               
            }

        },
        error: function() {
          
        }
    });
}

function carregarDataAtual(){
    
   
     $.ajax({
        url: 'index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=carregarDataAtual',
        data: {
                        
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            document.getElementById('periodoIni').value = data;
            document.getElementById('periodoFim').value = data;
               
          

        },
        error: function() {
          
        }
    });
   
    
}

function filtro(){
    
  
   var idEmpresa         = $("#idEmpresaFiltro").val();      
   var idFilial          = $("#idEmpresaFiltro").val();
   var mes               = $("#mes").val();
  
  
   
   
   var controleDePreenchimento = 'S';
    
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == 0){
        controleDePreenchimento = 'N';
    } 
    
    
        
    if(controleDePreenchimento ==  'S'){
    
        $.ajax({
            url: 'index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=filtro',
            data: {
                mes: mes,
                idEmpresa: idEmpresa,
                idFilial: idFilial
               


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                document.getElementById('relatorio').innerHTML         = r;   


            },
            error: function(e) {

            }
        });   
     }
    else{
        mensagem('Atenção', 'Prencha todos os campos, empresa, filial e datas são necessários', 'alert');
    }
    
}



function getPdf() {
    
   var idEmpresa         = $("#idEmpresaFiltro").val();      
   var idFilial          = $("#idEmpresaFiltro").val();
   var mes               = $("#mes").val();
  
   
   var controleDePreenchimento = 'S';
    
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == 0){
        controleDePreenchimento = 'N';
    } 
         
         
    
    if(controleDePreenchimento ==  'S'){

        $.ajax({
            url: 'index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=getPdf',
            data: {
                
                idEmpresa: idEmpresa,
                idFilial: idFilial,
                mes: mes

            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(data) {

                abrirArquivoPdf();

                //desbloqueiaTela();           
            },
            error: function() {

                abrirArquivoPdf();

            }
        });
    }
    else{    
        mensagem('Atenção', 'Prencha todos os campos, empresa, filial, datas e tipo de data são necessarios', 'alert');
    }
    
} 
function abrirArquivoPdf() {

    
    //window.open('http://www.vpitecnologia.com.br/gcconcreto/relatoriostemp/relatorio/.contas_pagar.pdf'); //- GCCONCRETO
    //window.open('C:/teste/pdf/.teste1.pdf'); - local
    //window.open('http://www.vpitecnologia.com.br/vpi/relatoriostemp/relatorio/.contas_pagar.pdf'); - VPI
    window.open('http://189.11.172.90/gestaopessoas/fwk/uploads/pdf/.relatorio_aniversario.pdf'); - servidor
    //window.open('http://localhost/gestaopessoas/fwk/uploads/pdf/.relatorio_aniversario.pdf'); //- local
   // var nomePasta = data['nomePasta'];
   //var nomeArquivo = data['nomeArquivo'];
   // window.open('http://localhost/vpigestao/fwk/index.php?m=relatoriomedicao&c=relatoriomedicaocontroller&f=abrirArquivoExcel&nomePastaTemporaria=' + /teste/pdf + '&nomeArquivo=' + nomeArquivo, '_blank');
}

function getExcel() {

 
    bloqueiaTela('Processando Relatorio, essa operação pode demorar, aguarde....');

   var idEmpresa         = $("#idEmpresaFiltro").val();      
   var idFilial          = $("#idEmpresaFiltro").val();
   var mes               = $("#mes").val();
  
   
   var controleDePreenchimento = 'S';
    
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == 0){
        controleDePreenchimento = 'N';
    } 
         
    
    if(controleDePreenchimento ==  'S'){

    $.ajax({
        url: 'index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=getExcel',
        data: {
            
            idEmpresa: idEmpresa,
            idFilial: idFilial,
            mes: mes
          
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            var nomePasta = data['nomePasta'];

            var nomeArquivo = data['nomeArquivo'];

            abrirArquivoExcel(nomePasta, nomeArquivo);


            desbloqueiaTela();
        }
        ,
        error: function () {
            desbloqueiaTela();
        }
    });
     }
    else{
        mensagem('Atenção', 'Prencha todos os campos, empresa, filial, datas e tipo de data são necessarios', 'alert');
    }
    
}

function abrirArquivoExcel(nomePastaTemporaria, nomeArquivo) {
    // servidor
    //window.open('http://192.168.100.30/engtopo/index.php?m=relatoriomedicao&c=relatoriomedicaocontroller&f=abrirArquivoExcel&nomePastaTemporaria=' + nomePastaTemporaria + '&nomeArquivo=' + nomeArquivo, '_blank');
    //VPI - window.open('http://www.vpitecnologia.com.br/vpi//index.php?m=relatoriocontasapagar&c=relatoriocontasapagarcontroller&f=abrirArquivoExcel&nomePastaTemporaria=' + nomePastaTemporaria + '&nomeArquivo=' + nomeArquivo, '_blank');
    //LOCALHOST window.open('http://localhost/gestaopessoas/fwk//index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=abrirArquivoExcel&nomePastaTemporaria=' + nomePastaTemporaria + '&nomeArquivo=' + nomeArquivo, '_blank'); 
    window.open('http://189.11.172.90/gestaopessoas/fwk/index.php?m=relatorioaniversario&c=relatorioaniversariocontroller&f=abrirArquivoExcel&nomePastaTemporaria=' + nomePastaTemporaria + '&nomeArquivo=' + nomeArquivo, '_blank');
    //alert(window);
}
function bloqueiaTela(texto) {
      

    $.blockUI({
        css: {
            backgroundColor: '#FFFFFF',
            border: '0px'
        },
        overlayCSS: {
            backgroundColor: '#c6d8ec',
            opacity: 0.3
        },
        message: '<table class="carregando"><tr><td><img width="50px" src="resources/relatorioaniversario/img/001.gif" /></td><td style="font-size: 18px;">' + texto + '</td></tr></table>'
    });
}

function desbloqueiaTela() {
    $.unblockUI();
}


