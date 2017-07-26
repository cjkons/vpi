///////////////////////////////////////////////
/// Cadastro de Ferias                      ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

$(document).ready(function() {
 
  //getGrid();
  carregarEmpresa();
  carregarFilial();
  carregarFuncionario();
  
  $('#dataInicioFerias').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  $('#dataFimFerias').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
  
            
    

});


            
function novo() {

    document.getElementById("id").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = false;
    document.getElementById("dataFimFerias").readOnly = false;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").disabled = true;
    document.getElementById("diasHaver").readOnly = false;


    document.getElementById("id").value = "";
    document.getElementById("idEmpresa").value = 0;
    document.getElementById("idFilial").value = 0;
    document.getElementById("funcionario").value = 0;
    document.getElementById("dataAdmissao").value = "";
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataInicioFerias").value = "";
    document.getElementById("dataFimFerias").value = "";
    document.getElementById("diasFerias").value = "";
    document.getElementById("comprouDias").value = 0;
    document.getElementById("diasComprados").value = "";
    document.getElementById("diasHaver").value = "";
    
     $.ajax({
            url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=novo',
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
     
    var codGrupo          =   $('#codGrupo').val();             
    var descricaoGrupo    =   $('#descricaoGrupo').val();
    var idEmpresa         =   $('#idEmpresa').val();             
    var idFilial          =   $('#idFilial').val();
     
       
    var controleDePreenchimento = 'S';
 
    if(codGrupo == ""){
        controleDePreenchimento = 'N';
    }
    if(descricaoGrupo == ""){
        controleDePreenchimento = 'N';
    }
    if(idEmpresa == 0){
        controleDePreenchimento = 'N';
    }
    if(idFilial == 0){
        controleDePreenchimento = 'N';
    }
        
    if(controleDePreenchimento ==  'S'){
 
                   
        document.getElementById("codGrupo").readOnly = true;
        document.getElementById("descricaoGrupo").readOnly = true;
        document.getElementById("idEmpresa").readOnly = true;
        document.getElementById("idFilial").readOnly = true;
        
      

        $.ajax({
            url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=salvar',
            data: {
                codGrupo: codGrupo,
                descricaoGrupo:  descricaoGrupo,
                idEmpresa: idEmpresa,
                idFilial: idFilial
                
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
                mensagem('Atenção', 'Erro ao salvar', 'error');

            }
        }); 
              
       
        
    }
    else{
        mensagem('Atenção', 'Prencha todos os campos', 'alert');
         
          
    }
    
}

function excluir(){
    
    var codGrupo  =   $('#codGrupo').val();
     
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=excluir',
        data: {
            codGrupo: codGrupo
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
    document.getElementById("nomePesquisarFim").value   = "";
    
     
}

function editar(){
    

    document.getElementById("descricaoGrupo").readOnly        = false;
    document.getElementById("idEmpresa").readOnly       = false;
    document.getElementById("idFilial").readOnly        = false;
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("codGrupo").readOnly        = true;
    document.getElementById("descricaoGrupo").readOnly  = true;
    document.getElementById("idEmpresa").readOnly       = true;
    document.getElementById("idFilial").readOnly        = true;
   
   
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            document.getElementById("codGrupo").value          = r[0];
            document.getElementById("descricaoGrupo").value    = r[1];
            document.getElementById("idEmpresa").value         = r[2];
            document.getElementById("idFilial").value          = r[3];   
                                     
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroAnterior(){
    
    document.getElementById("codGrupo").readOnly        = true;
    document.getElementById("descricaoGrupo").readOnly  = true;
    
    
    var codGrupo  =  $('#codGrupo').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaRegistroAnterior',
        data: {
            codGrupo: codGrupo
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                document.getElementById("codGrupo").value          = r[0];
                document.getElementById("descricaoGrupo").value    = r[1];
                document.getElementById("idEmpresa").value         = r[2];
                document.getElementById("idFilial").value          = r[3];  
                            
            }
            
        },
        error: function(e) {

        }
    }); 
 
    
}
function buscaRegistroProximo(){
    
    document.getElementById("codGrupo").readOnly       = true;
    document.getElementById("descricaoGrupo").readOnly        = true;
    
       
    var codGrupo  =  $('#codGrupo').val();             
   
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaRegistroProximo',
        data: {
            codGrupo: codGrupo
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("codGrupo").value          = r[0];
                document.getElementById("descricaoGrupo").value    = r[1];
                document.getElementById("idEmpresa").value         = r[2];
                document.getElementById("idFilial").value          = r[3];  
                      
            
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("codGrupo").readOnly       = true;
    document.getElementById("descricaoGrupo").readOnly        = true;
    
      
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("codGrupo").value          = r[0];
            document.getElementById("descricaoGrupo").value    = r[1];
            document.getElementById("idEmpresa").value         = r[2];
            document.getElementById("idFilial").value          = r[3];  
             
           
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
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=pesquisaSimples',
        data: {
            idInicial: idInicial,
            nomeInicial: nomeInicial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("codGrupo").value          = r[0];
            document.getElementById("descricaoGrupo").value    = r[1];
            document.getElementById("idEmpresa").value         = r[2];
            document.getElementById("idFilial").value          = r[3];  
                               
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
            "url": "index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "COD_GRUPO"},
            {"data": "DESCRICAO"},
            {"data": "SELECIONAR"},
          
           
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
     
 }
 
 function selecionaGrid(idGrupo){
    
   
    // Pesquisa Para alimentar campos
    
    document.getElementById("codGrupo").readOnly              = true;
    document.getElementById("descricaoGrupo").readOnly        = true;
    document.getElementById("idEmpresa").readOnly             = true;
    document.getElementById("idFilial").readOnly              = true;
   
    
    
    $.ajax({
        url: 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller&f=selecionaGrid',
        data: {
            idGrupo: idGrupo
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                      
            document.getElementById("codGrupo").value           = r[0];
            document.getElementById("descricaoGrupo").value     = r[1];            
            document.getElementById("idEmpresa").value       = r[2];
            document.getElementById("idFilial").value        = r[3];       
                     
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
           
  
   document.getElementById("idEmpresa").value          = "";
   document.getElementById("razaoSocial").value        = "";
   document.getElementById("idEmpresa").value          = "";
   document.getElementById("razaoSocial").value        = "";
             
    
}

function carregarEmpresa(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=carregarEmpresa',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('idEmpresa').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  EMPRESA', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}


function carregarFilial(){
    
    var idEmpresa = document.getElementById("idEmpresa").value;
    
           
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=carregarFilial',
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
                mensagem('Atenção', 'Erro ao carregar a lista de  Filial', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarFuncionario(){
    
    var idEmpresa = document.getElementById("idEmpresa").value;
    var idFilial = document.getElementById("idFilial").value;
    
           
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=carregarFuncionario',
        data: {
            idEmpresa: idEmpresa,
            idFilial: idFilial
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('funcionario').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Filial', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarDadosFuncionario(){
    
    var idEmpresa                 =   $('#idEmpresa').val(); 
    var idFilial                  =   $('#idFilial').val(); 
    var funcionario             =   $('#funcionario').val();
    
    
    document.getElementById("dataAdmissao").value = "";
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    
           
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=carregarDadosFuncionario',
        data: {
            
            idEmpresa: idEmpresa,
            idFilial: idFilial,
            funcionario: funcionario
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(r) {
            
                document.getElementById("dataAdmissao").value = r[0];
                document.getElementById("matricula").value = r[1];
                document.getElementById("setor").value = r[2];
                document.getElementById("funcao").value = r[3];
                
                

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function carregarDiasComprados(){
    
    var comprouDias                 =   $('#comprouDias').val(); 
    
    if (comprouDias != 'S'){
         
         document.getElementById("diasComprados").value = "";
         document.getElementById("diasComprados").disabled = true; 
        
    }else{
        document.getElementById("diasComprados").disabled = false;
    }
    
    
}