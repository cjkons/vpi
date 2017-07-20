///////////////////////////////////////////////
/// Cadastro de Atestados                   ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////



$(document).ready(function() {
    
 carregarFuncionario(); 
 //getAdicionarAtestado();
 getGrid();
 
  
  $('#dataAtestado').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  
  $('#dataRetorno').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
 
    
});


function carregarFuncionario(){
    
           
    $.ajax({
        url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=carregarFuncionario',
        data: {
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(data) {
                
            if (data != false) {
                document.getElementById('funcionario').innerHTML = data;
               
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de  Funcionários', 'error'); 
               
            }

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}




function carregarDadosFuncionario(){
    
    var funcionario             =   $('#funcionario').val();
    
    
    document.getElementById("empresa").value = "";
    document.getElementById("filial").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataAdmissao").value = "";
    
           
    $.ajax({
        url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=carregarDadosFuncionario',
        data: {
           
            funcionario: funcionario
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        
        
        success: function(r) {
            
                document.getElementById("empresa").value = r[0];
                document.getElementById("filial").value = r[1];
                document.getElementById("setor").value = r[2];
                document.getElementById("funcao").value = r[3];
                document.getElementById("matricula").value = r[4];
                document.getElementById("dataAdmissao").value = r[5];
               

        },
        error: function() {
            desbloqueiaTela();
        }
    });
}

function novo(){
       
    document.getElementById("id").readOnly              = true;
    document.getElementById("empresa").readOnly         = true;
    document.getElementById("filial").readOnly          = true;
    document.getElementById("setor").readOnly           = true;
    document.getElementById("funcao").readOnly          = true;
    document.getElementById("matricula").readOnly       = true;
    document.getElementById("dataAdmissao").readOnly    = true;
    document.getElementById("dataAtestado").readOnly    = false;
    document.getElementById("diasAtestado").readOnly    = false;
    document.getElementById("dataRetorno").readOnly     = false;
    document.getElementById("cid").readOnly             = false;
    document.getElementById("observacao").readOnly      = false;
    
    
    document.getElementById("id").value             = "";
    document.getElementById("funcionario").value    = 0;
    document.getElementById("empresa").value        = "";
    document.getElementById("filial").value         = "";
    document.getElementById("setor").value          = "";
    document.getElementById("funcao").value         = "";
    document.getElementById("matricula").value      = "";
    document.getElementById("dataAdmissao").value   = "";
    document.getElementById("dataAtestado").value   = "";
    document.getElementById("diasAtestado").value   = "";
    document.getElementById("dataRetorno").value    = "";
    document.getElementById("cid").value            = "";
    document.getElementById("observacao").value     = "";
    
       
    
    //document.getElementById('tabelaCadastro1').innerHTML = "";
    
    
    
    
      $.ajax({
            url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=novo',
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
     
    var id              =   $('#id').val(); 
    var funcionario     =   $('#funcionario').val();
    var empresa         =   $('#empresa').val();
    var filial          =   $('#filial').val();
    var setor           =   $('#setor').val();
    var funcao          =   $('#funcao').val();
    var dataAdmissao    =   $('#dataAdmissao').val();
    var dataAtestado    =   $('#dataAtestado').val();
    var diasAtestado    =   $('#diasAtestado').val();
    var dataRetorno     =   $('#dataRetorno').val();
    var cid             =   $('#cid').val();
    var observacao      =   $('#observacao').val();
    
    
    var controleDePreenchimento = 'S';
 
    
    if(funcionario == 0){
        controleDePreenchimento = 'N';
    }
    if(dataAtestado == ""){
        controleDePreenchimento = 'N';
    }
    if(diasAtestado == ""){
        controleDePreenchimento = 'N';
    }
    if(dataRetorno == ""){
        controleDePreenchimento = 'N';
    }
    if(cid == ""){
        controleDePreenchimento = 'N';
    }
    if(observacao == ""){
        controleDePreenchimento = 'N';
    }
    
   
    
    
    if(controleDePreenchimento ==  'S'){
          
        document.getElementById("id").readOnly              = true;
        document.getElementById("funcionario").readOnly     = true;
        document.getElementById("empresa").readOnly         = true;
        document.getElementById("filial").readOnly          = true;
        document.getElementById("setor").readOnly           = true;
        document.getElementById("funcao").readOnly          = true;
        document.getElementById("matricula").readOnly       = true;
        document.getElementById("dataAdmissao").readOnly    = true;
        document.getElementById("dataAtestado").readOnly    = true;
        document.getElementById("diasAtestado").readOnly    = true;
        document.getElementById("dataRetorno").readOnly     = true;
        document.getElementById("cid").readOnly             = true;
        document.getElementById("observacao").readOnly      = true;
        
        $.ajax({
            url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=salvar',
            data: {
                id: id,
                funcionario: funcionario,
                empresa: empresa,
                filial: filial,
                dataAtestado: dataAtestado,
                diasAtestado: diasAtestado,
                dataRetorno: dataRetorno,
                cid: cid,
                observacao: observacao
                
                
                
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {

                if (r == true) {
                    //salvarAtividades();
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    //getAdicionarAtestado(id, funcionario, dataAtestado, cid );
                    getGrid();
                    //document.getElementById('tabelaPreco2').innerHTML = "";
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
         mensagem('Atenção', 'Prencha todos os campos', 'alert');
       // mensagens de erro
        
          
    }
    
}


function  getAdicionarAtestado(id, funcionario, dataAtestado, cid ) {

        document.getElementById("id").readOnly              = true;
        document.getElementById("empresa").readOnly         = true;
        document.getElementById("filial").readOnly          = true;
        document.getElementById("setor").readOnly           = true;
        document.getElementById("funcao").readOnly          = true;
        document.getElementById("matricula").readOnly       = true;
        document.getElementById("dataAdmissao").readOnly    = true;
        document.getElementById("dataAtestado").readOnly    = true;
        document.getElementById("diasAtestado").readOnly    = true;
        document.getElementById("dataRetorno").readOnly     = true;
        document.getElementById("cid").readOnly             = true;
        document.getElementById("observacao").readOnly      = true;
    

    $.ajax({
        url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=getAdicionarAtestado',
        data: {
            id: id,
            funcionario: funcionario,
            dataAtestado: dataAtestado,
            cid: cid
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaCadastro1').innerHTML = r;
            




        },
        error: function (e) {
            
        }
    });


}


function editarAtestado(id) {
    
        document.getElementById("id").readOnly              = true;
        document.getElementById("funcionario").readOnly     = true;
        document.getElementById("empresa").readOnly         = true;
        document.getElementById("filial").readOnly          = true;
        document.getElementById("setor").readOnly           = true;
        document.getElementById("funcao").readOnly          = true;
        document.getElementById("matricula").readOnly       = true;
        document.getElementById("dataAdmissao").readOnly    = true;
        document.getElementById("dataAtestado").readOnly    = true;
        document.getElementById("diasAtestado").readOnly    = true;
        document.getElementById("dataRetorno").readOnly     = true;
        document.getElementById("cid").readOnly             = true;
        document.getElementById("observacao").readOnly      = true;
    
    
    $.ajax({
            url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=editarAtestado',
            data: {
                
                id: id
                
               
                 
                 },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                
                  // document.getElementById("idItemModal").value         =  r;
                  
                    document.getElementById("id").readOnly              = true;
                    document.getElementById("funcionario").readOnly     = true;
                    document.getElementById("empresa").readOnly         = true;
                    document.getElementById("filial").readOnly          = true;
                    document.getElementById("setor").readOnly           = true;
                    document.getElementById("funcao").readOnly          = true;
                    document.getElementById("matricula").readOnly       = true;
                    document.getElementById("dataAdmissao").readOnly    = true;
                    document.getElementById("dataAtestado").readOnly    = false;
                    document.getElementById("diasAtestado").readOnly    = false;
                    document.getElementById("dataRetorno").readOnly     = false;
                    document.getElementById("cid").readOnly             = false;
                    document.getElementById("observacao").readOnly      = false;
                  
                  
                    document.getElementById("id").value             = r[0];
                    document.getElementById("funcionario").value    = r[1];
                    document.getElementById("empresa").value        = r[2];
                    document.getElementById("filial").value         = r[3];
                    document.getElementById("setor").value          = r[4];
                    document.getElementById("funcao").value         = r[5];
                    document.getElementById("matricula").value      = r[6];
                    document.getElementById("dataAdmissao").value   = r[7];
                    document.getElementById("dataAtestado").value   = r[8];
                    document.getElementById("diasAtestado").value   = r[9];
                    document.getElementById("dataRetorno").value    = r[10];
                    document.getElementById("cid").value            = r[11];
                    document.getElementById("observacao").value     = r[12];
                    
                                       
                   //$('#itemModalEditar').modal('show');

            },
            error: function(e) {
                    mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);
            }
            
            
        });   
            
           

    
}


function excluir(){
    
    var id              =   $('#id').val(); 
    
     
    $.ajax({
        url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=excluir',
        data: {
            
                id: id
                
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true || r == 1) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                //getAdicionarAtestado();
                getGrid();
                
            }
            else {
                mensagem('Erro', 'Item nao Excluído', 'error');
                //getAdicionarAtestado();
                getGrid();
                
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            //getAdicionarAtestado();
            getGrid();
               
        }
    }); 
     
}

function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("cboPesquisarInicio").value   = "";
    document.getElementById("cboPesquisarFim").value      = "";
    
  
}

function pesquisaFiltro(){
    
    var cboPesquisarInicio      = document.getElementById("cboPesquisarInicio").value;
    var cboPesquisarFim         = document.getElementById("cboPesquisarFim").value;
    
    
    
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=pesquisaSimples',
        data: {
            cboPesquisarInicio: cboPesquisarInicio,
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             
                    document.getElementById("id").value             = r[0];
                    document.getElementById("funcionario").value    = r[1];
                    document.getElementById("empresa").value        = r[2];
                    document.getElementById("filial").value         = r[3];
                    document.getElementById("setor").value          = r[4];
                    document.getElementById("funcao").value         = r[5];
                    document.getElementById("matricula").value      = r[6];
                    document.getElementById("dataAdmissao").value   = r[7];
                    document.getElementById("dataAtestado").value   = r[8];
                    document.getElementById("diasAtestado").value   = r[9];
                    document.getElementById("dataRetorno").value    = r[10];
                    document.getElementById("cid").value            = r[11];
                    document.getElementById("observacao").value     = r[12];
                    



            
        
            $('#pesquisarModal').modal('hide');          
            
            
            
                     
        },
        error: function(e) {

        }
    }); 
            
    
}

function atualizar() {

    document.getElementById("id").readOnly              = true;
    document.getElementById("funcionario").readOnly     = true;
    document.getElementById("empresa").readOnly         = true;
    document.getElementById("filial").readOnly          = true;
    document.getElementById("setor").readOnly           = true;
    document.getElementById("funcao").readOnly          = true;
    document.getElementById("matricula").readOnly       = true;
    document.getElementById("dataAdmissao").readOnly    = true;
    document.getElementById("dataAtestado").readOnly    = false;
    document.getElementById("diasAtestado").readOnly    = false;
    document.getElementById("dataRetorno").readOnly     = false;
    document.getElementById("cid").readOnly             = false;
    document.getElementById("observacao").readOnly      = false;

    document.getElementById("id").value             = "";
    document.getElementById("funcionario").value    = 0;
    document.getElementById("empresa").value        = "";
    document.getElementById("filial").value         = "";
    document.getElementById("setor").value          = "";
    document.getElementById("funcao").value         = "";
    document.getElementById("matricula").value      = "";
    document.getElementById("dataAdmissao").value   = "";
    document.getElementById("dataAtestado").value   = "";
    document.getElementById("diasAtestado").value   = "";
    document.getElementById("dataRetorno").value    = "";
    document.getElementById("cid").value            = "";
    document.getElementById("observacao").value     = "";
    


     //getAdicionarAtestado();
     getGrid();


}


function getGrid() {
    
    
    $('#grid').DataTable({
        "processing": true,
        "serverSide": true,
        ajax: {
            "url": "index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=getGrid",
              
            "type": "POST",
        },
         language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_ATESTADO"},
            {"data": "FUNCIONARIO"},
            {"data": "FILIAL"},
            {"data": "SETOR"},
            {"data": "FUNCAO"},
            {"data": "CID"},
            {"data": "DATA_ATESTADO"},
            {"data": "DATA_RETORNO"},    
            {"data": "EDITAR"},    
            
            
            
           
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    
  
    
  
  
 }
 
 function selecionaGrid(id){
    
   
    // Pesquisa Para alimentar campos
    //alert(idFuncionario);
    
    document.getElementById("id").readOnly              = true;
    document.getElementById("funcionario").readOnly     = true;
    document.getElementById("empresa").readOnly         = true;
    document.getElementById("filial").readOnly          = true;
    document.getElementById("setor").readOnly           = true;
    document.getElementById("funcao").readOnly          = true;
    document.getElementById("matricula").readOnly       = true;
    document.getElementById("dataAdmissao").readOnly    = true;
    document.getElementById("dataAtestado").readOnly    = false;
    document.getElementById("diasAtestado").readOnly    = false;
    document.getElementById("dataRetorno").readOnly     = false;
    document.getElementById("cid").readOnly             = false;
    document.getElementById("observacao").readOnly      = false;
      
    
    
    $.ajax({
        url: 'index.php?m=cadastroatestado&c=cadastroatestadocontroller&f=selecionaGrid',
        data: {
            id: id
            
            
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
                    document.getElementById("id").value             = r[0];
                    document.getElementById("funcionario").value    = r[1];
                    document.getElementById("empresa").value        = r[2];
                    document.getElementById("filial").value         = r[3];
                    document.getElementById("setor").value          = r[4];
                    document.getElementById("funcao").value         = r[5];
                    document.getElementById("matricula").value      = r[6];
                    document.getElementById("dataAdmissao").value   = r[7];
                    document.getElementById("dataAtestado").value   = r[8];
                    document.getElementById("diasAtestado").value   = r[9];
                    document.getElementById("dataRetorno").value    = r[10];
                    document.getElementById("cid").value            = r[11];
                    document.getElementById("observacao").value     = r[12];
                    
                     
        },
        error: function(e) {

        }
    }); 
            
    
}








