/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


  
$(document).ready(function() {
  carregarEmpresa();
  carregarFilial();
  carregarFuncionario();
  
  getGrid();
  
  $('#dataInicioFerias').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });
  });

function novo() {
    /*
    var namesTrue = ["ID","idEmpresa","idFilial","funcionario","dataAdmissao"];
    namesTrue.push("matricula","setor","funcao","dataFimFerias","comprouDias");
    namesTrue.push("diasComprados","diasHaver");
    var namesFalse = ["dataInicioFerias","diasFerias"];
    
    for(var i = 0; i < namesTrue.length; i++){
        document.getElementById(namesTrue[i]).readOnly = true;
    }
    for(var i = 0; i < namesFalse.length; i++){
        document.getElementById(namesFalse[i]).readOnly = false;
    }
    */
    
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = false;
    document.getElementById("diasFerias").readOnly = false;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;
    
    document.getElementById("ID").value = "";
    document.getElementById("idEmpresa").value = 0;
    document.getElementById("idFilial").value = 0;
    document.getElementById("funcionario").value = 0;
    document.getElementById("dataAdmissao").value = "";
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataInicioFerias").value = "";
    document.getElementById("diasFerias").value = "";
    document.getElementById("dataFimFerias").value = 0;
    document.getElementById("diasComprados").value = 0;
    document.getElementById("comprouDias").value = 0;
    document.getElementById("diasHaver").value = "";
    
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=novo',
        data: {
            
           
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
             document.getElementById("ID").value  = r;
             carregarDataAtual();    
            
        },
        error: function(e) {
           
        }
    });
}





function validarNumerico(strValidar, value){
    value = document.getElementById(strValidar).value;
    if(value > 30) document.getElementById(strValidar).value = "";
}


function salvar(){

    var idEmpresa         =   $('#idEmpresa').val(),             
        idFilial          =   $('#idFilial').val(),
        funcionario       =   $('#funcionario').val(),        
        dataAdmissao      =   $('#dataAdmissao').val(),
        matricula         =   $('#matricula').val(),
        setor             =   $('#setor').val(),
        funcao            =   $('#funcao').val(),        
        dataInicioFerias  =   $('#dataInicioFerias').val(),
        diasFerias        =   $('#diasFerias').val(),
        dataFimFerias     =   $('#dataFimFerias').val(),
        comprouDias       =   $('#comprouDias').val(),        
        diasComprados     =   $('#diasComprados').val(),
        diasHaver         =   $('#diasHaver').val(),
        ID                =   $('#ID').val(),
        controle            = true;  

    controle = (idEmpresa != 0)&&(idFilial != 0)&&(funcionario != 0);
    controle = (controle)&&(dataAdmissao != "")&&(matricula != "")&&(calcDiasHaver()); 
    controle = (controle)&&(setor != "")&&(funcao != "")&&(dataInicioFerias != "");
    controle = (controle)&&(comprouDias != 0)&&(diasComprados != "");
    
    if(controle){
       
        document.getElementById("ID").readOnly = true;
        document.getElementById("idEmpresa").readOnly = true;
        document.getElementById("idFilial").readOnly = true;
        document.getElementById("funcionario").readOnly = true;
        document.getElementById("dataAdmissao").readOnly = true;
        document.getElementById("matricula").readOnly = true;
        document.getElementById("setor").readOnly = true;
        document.getElementById("funcao").readOnly = true;
        document.getElementById("dataInicioFerias").readOnly = false;
        document.getElementById("diasFerias").readOnly = false;
        document.getElementById("dataFimFerias").readOnly = true;
        document.getElementById("comprouDias").readOnly = true;
        document.getElementById("diasComprados").readOnly = true;
        document.getElementById("diasHaver").readOnly = true;
        
        
        $.ajax({
            url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=salvar',

            data: {
                ID: ID,
                idEmpresa:  idEmpresa,
                idFilial:  idFilial,
                funcionario: funcionario,
                dataAdmissao: dataAdmissao,
                matricula: matricula,
                setor:  setor,
                funcao: funcao,
                dataInicioFerias: dataInicioFerias,
                diasFerias: diasFerias,
                dataFimFerias:  dataFimFerias,
                comprouDias: comprouDias,
                diasComprados: diasComprados,
                diasHaver: diasHaver
                
            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(r) {
                if (r == true) {
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    $('#basicModal').modal('hide');
                    atualizar();
                    atualizarGrid();
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

function validarExcluir(){
    $('#excluirModal').modal('show');
}

function excluir(){
    
    var ID  =   $('#ID').val();
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=excluir',
        data: {
            ID: ID
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                atualizar();
                atualizarGrid();
                $('#excluirModal').modal('hide');
            }
            else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#excluirModal').modal('hide');
                atualizar();
                atualizarGrid();
            }
        },
        error: function(e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            $('#excluirModal').modal('hide');
            atualizar();
            atualizarGrid();
        }
    }); 
    
}


function pesquisar() {
    
    $('#pesquisarModal').modal('show');
    
    document.getElementById("matricula").value   = "";
    document.getElementById("funcionario").value = "";
    document.getElementById("pesquisaFuncionarioAno").value   = "";
    document.getElementById("pesquisaMatriculaAno").value = "";
     
}

function editar(){
    
    document.getElementById("idEmpresa").readOnly = false;
    document.getElementById("idFilial").readOnly = false;
    document.getElementById("funcionario").readOnly = false;
    document.getElementById("dataInicioFerias").readOnly = false;
    document.getElementById("diasFerias").readOnly = false;
    document.getElementById("comprouDias").readOnly = false;
    
}


function pesquisaFiltro(){
    
    var matricula   = document.getElementById("pesquisaMatricula").value;
    var funcionario = document.getElementById("pesquisaFuncionario").value;
    var funcionarioAno = document.getElementById("pesquisaFuncionarioAno").value;
    var matriculaAno = document.getElementById("pesquisaMatriculaAno").value;
    // Pesquisa Para alimentar campos
    
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=pesquisaSimples',
        data: {
            matricula: matricula,
            funcionario: funcionario,
            funcionarioAno: funcionarioAno,
            matriculaAno: matriculaAno
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                        
            document.getElementById("ID").value = r[0];
            document.getElementById("idEmpresa").value = r[1];
            document.getElementById("idFilial").value = r[2];
            document.getElementById("funcionario").value = r[3];
            document.getElementById("dataAdmissao").value = r[4];
            document.getElementById("matricula").value = r[5];
            document.getElementById("setor").value = r[6];
            document.getElementById("funcao").value = r[7];
            document.getElementById("dataInicioFerias").value = r[8];
            document.getElementById("diasFerias").value = r[9];
            document.getElementById("dataFimFerias").value = r[10];
            document.getElementById("comprouDias").value = r[11];
            document.getElementById("diasComprados").value = r[12];
            document.getElementById("diasHaver").value = r[13];
                               
            $('#pesquisarModal').modal('hide');          
                    
                     
        },
        error: function(e) {

        }
    }); 
            
    
}

function buscaPrimeiroRegistro(){
    
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = true;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;
   
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=buscaPrimeiroRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
                   
            document.getElementById("ID").value = r[0];
            document.getElementById("idEmpresa").value = r[1];
            document.getElementById("idFilial").value = r[2];
            document.getElementById("funcionario").value= r[3];
            document.getElementById("dataAdmissao").value = r[4];
            document.getElementById("matricula").value = r[5];
            document.getElementById("setor").value = r[6];
            document.getElementById("funcao").value = r[7];
            document.getElementById("dataInicioFerias").value = r[8];
            document.getElementById("diasFerias").value = r[9];
            document.getElementById("dataFimFerias").value = r[10];
            document.getElementById("comprouDias").value = r[11];
            document.getElementById("diasComprados").value = r[12];
            document.getElementById("diasHaver").value = r[13];
            
        },
        error: function(e) {

        }
    }); 
 
    
}


function buscaUltimoRegistro(){
    
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = true;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;

    
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=buscaUltimoRegistro',
        data: {
       
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            document.getElementById("ID").value = r[0];
            document.getElementById("idEmpresa").value = r[1];
            document.getElementById("idFilial").value = r[2];
            document.getElementById("funcionario").value= r[3];
            document.getElementById("dataAdmissao").value = r[4];
            document.getElementById("matricula").value = r[5];
            document.getElementById("setor").value = r[6];
            document.getElementById("funcao").value = r[7];
            document.getElementById("dataInicioFerias").value = r[8];
            document.getElementById("diasFerias").value = r[9];
            document.getElementById("dataFimFerias").value = r[10];
            document.getElementById("comprouDias").value = r[11];
            document.getElementById("diasComprados").value = r[12];
            document.getElementById("diasHaver").value = r[13];
             
        },
        error: function(e) {

        }
    }); 

}


function buscaRegistroAnterior(){
    
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = true;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;

    
    var ID  =  $('#ID').val();  
  
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=buscaRegistroAnterior',
        data: {
            ID: ID
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){

                document.getElementById("ID").value = r[0];
                document.getElementById("idEmpresa").value = r[1];
                document.getElementById("idFilial").value = r[2];
                document.getElementById("funcionario").value= r[3];
                document.getElementById("dataAdmissao").value = r[4];
                document.getElementById("matricula").value = r[5];
                document.getElementById("setor").value = r[6];
                document.getElementById("funcao").value = r[7];
                document.getElementById("dataInicioFerias").value = r[8];
                document.getElementById("diasFerias").value = r[9];
                document.getElementById("dataFimFerias").value = r[10];
                document.getElementById("comprouDias").value = r[11];
                document.getElementById("diasComprados").value = r[12];
                document.getElementById("diasHaver").value = r[13];

            }
        },
        error: function(e) {
            
             

        }
    }); 
 
    
}


function buscaRegistroProximo(){
    
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = true;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;
    
    var ID  =  $('#ID').val();    
    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=buscaRegistroProximo',
        data: {
            ID: ID
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
            if(r != false){
                
                document.getElementById("ID").value = r[0];
                document.getElementById("idEmpresa").value = r[1];
                document.getElementById("idFilial").value = r[2];
                document.getElementById("funcionario").value= r[3];
                document.getElementById("dataAdmissao").value = r[4];
                document.getElementById("matricula").value = r[5];
                document.getElementById("setor").value = r[6];
                document.getElementById("funcao").value = r[7];
                document.getElementById("dataInicioFerias").value = r[8];
                document.getElementById("diasFerias").value = r[9];
                document.getElementById("dataFimFerias").value = r[10];
                document.getElementById("comprouDias").value = r[11];
                document.getElementById("diasComprados").value = r[12];
                document.getElementById("diasHaver").value = r[13]; 
            }
           
        },
        error: function(e) {

        }
    }); 
 
    
}


function getGrid() {
    
    var tableGrid = $('#grid').DataTable({
        "destroy": true,
        
        ajax: {
            "url": "index.php?m=cadastroferias&c=cadastroferiascontroller&f=getGrid",
            "type": "POST",
        },
        language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "EMPRESA"},
            {"data": "FILIAL"},
            {"data": "FUNCIONARIO"},
            {"data": "DATA_ADMISSAO"},
            {"data": "MATRICULA"},
            {"data": "FUNCAO"},
            {"data": "SETOR"},
            {"data": "SELECIONAR"},
        ],
        searching: false
    });

    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
 }
 
 
function atualizarGrid(){
    setTimeout(function(){tableGrid.ajax.reload();}, 200);
}


function selecionaGrid(ID,nomeEmpresa,nomeFilial){
    
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = true;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;

    $.ajax({
        url: 'index.php?m=cadastroferias&c=cadastroferiascontroller&f=selecionaGrid',
        data: {
            ID: ID
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function(r) {
            
                document.getElementById("ID").value = r[0];
                document.getElementById("idEmpresa").value = r[1];
                document.getElementById("idFilial").value = r[2];
                document.getElementById("funcionario").value = r[3];
                document.getElementById("dataAdmissao").value = r[4];
                document.getElementById("matricula").value = r[5];
                document.getElementById("funcao").value = r[6];
                document.getElementById("setor").value = r[7];
                document.getElementById("dataInicioFerias").value = r[8];
                document.getElementById("diasFerias").value = r[9];
                document.getElementById("dataFimFerias").value = r[10];
                document.getElementById("comprouDias").value = r[11];
                document.getElementById("diasComprados").value = r[12];
                document.getElementById("diasHaver").value = r[13]; 
        },
        error: function(e) {

        }
    }); 
}


function atualizar(){
     
    document.getElementById("ID").readOnly = true;
    document.getElementById("idEmpresa").readOnly = true;
    document.getElementById("idFilial").readOnly = true;
    document.getElementById("funcionario").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataInicioFerias").readOnly = true;
    document.getElementById("diasFerias").readOnly = true;
    document.getElementById("dataFimFerias").readOnly = true;
    document.getElementById("comprouDias").readOnly = true;
    document.getElementById("diasComprados").readOnly = true;
    document.getElementById("diasHaver").readOnly = true;
    
    document.getElementById("ID").value = "";
    document.getElementById("idEmpresa").value = 0;
    document.getElementById("idFilial").value = 0;
    document.getElementById("funcionario").value = 0;
    document.getElementById("dataAdmissao").value = "";
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataInicioFerias").value = "";
    document.getElementById("diasFerias").value = "";
    document.getElementById("dataFimFerias").value = 0;
    document.getElementById("diasComprados").value = 0;
    document.getElementById("comprouDias").value = 0;
    document.getElementById("diasHaver").value = "";
             
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
    var funcionario               =   $('#funcionario').val();
    
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



function verificarDomingo(dia){
    var qualDia = String(dia).split('/');
    var diaDaSemana = new Date(qualDia[2],qualDia[1]-1,qualDia[0]);
    diaDaSemana = String(diaDaSemana).split(' ')[0];
    if(diaDaSemana == 'Sun'){
        dia = true;
    }
    else{
        dia = false;
    }
    return dia;
}

function carregarDiaFim(){
    var mes31 = ['01','03','05','07','08','10','12'],
        mes30 = ['04','06','09','11'];
     
    var sMes31 = false,
        sMes30 = false;
    
    var inicio = $('#dataInicioFerias').val(),
        data = inicio.split('/'),
        qtsDias =  $('#diasFerias').val(),
        fim = parseInt(data[0]) + parseInt(qtsDias),
        completarDia = $('#dataInicioFerias').val().slice(2,inicio.length);
    
    var fimDasFerias = '';
    
    
    if (data[1] == '02'){
        // verificando se é ano bissesto
        if(((data[2] % 4 == 0) && (data[2] % 100 != 0)) || (data[2] % 400 == 0)){
            if(fim > 29){
                fimDasFerias = (fim - 29) + '/' + (parseInt(data[1]) + 1) + '/' + data[2];
            }
            else fimDasFerias = fim + '/' + parseInt(data[1]) + '/' + data[2];
        }
        else{
            if(fim > 28){
                fimDasFerias = (fim - 28) + '/' + (parseInt(data[1]) + 1) + '/' + data[2];
            }
            else fimDasFerias = fim + '/' + parseInt(data[1]) + '/' + data[2];
        }
        if(verificarDomingo(fimDasFerias)){
            var temp = fimDasFerias.split('/');
            fimDasFerias = (parseInt(temp[0])+1) + '/' + temp[1] + '/' +temp[2];
        }
    }
    else if (mes31.indexOf(data[1]) !== -1){
        if(fim > 31){
            fimDasFerias = (fim - 31) + '/' + (parseInt(data[1]) + 1) + '/' + data[2];
        }
        else fimDasFerias = fim + completarDia;
        
        if(verificarDomingo(fimDasFerias)){
            var temp = fimDasFerias.split('/');
            fimDasFerias = (parseInt(temp[0])+1) + '/' + temp[1] + '/' +temp[2];
        }
    }
    else if (mes30.indexOf(data[1]) !== -1){
        if(fim > 30){
            fimDasFerias = (fim - 30) + '/' + (parseInt(data[1]) + 1) + '/' + data[2];
        }
        else fimDasFerias = fim + completarDia;
        if(verificarDomingo(fimDasFerias)){
            var temp = fimDasFerias.split('/');
            fimDasFerias = (parseInt(temp[0])+1) + '/' + temp[1] + '/' +temp[2];
        }
        
    }

    //document.getElementById("dataFimFerias").value = fimDasFerias;
    return fimDasFerias;
}

function carregarDiasComprados(){
    var comprouDias                 =   $('#comprouDias').val(); 
    if (comprouDias == 0){
        document.getElementById("diasComprados").value = "";
        document.getElementById("diasComprados").readOnly = true; 
    }
    else if(comprouDias == "N"){
        document.getElementById("diasComprados").value = 0;
        document.getElementById("diasComprados").readOnly = true; 
        calcDiasHaver();  
    }
    else{
        document.getElementById("diasComprados").readOnly = false;
    }
    
}

function validarDiasHaver(){
    var qtDiasComprados = $('#diasComprados').val(),
        qtDiasFerias    = $('#diasFerias').val(),
        diasHaver = 30 - parseInt(qtDiasComprados) - parseInt(qtDiasFerias),
        state = false;

    if(diasHaver < 0) state = false;
    else state = true;
    return [state,diasHaver];
}

function calcDiasHaver(){
    var salvar = false,
        dias = 0;
    var diasHaver = validarDiasHaver();
    if(diasHaver[0]){
        dias = diasHaver[1];
        salvar = true;
    }
    else{
        mensagem('Atenção', 'Dias haver inválido', 'error');
        dias = 0;
        salvar = false;
    }
    //document.getElementById("diasHaver").value = dias;
    return salvar;
}

function atualizarDias(){
    var diaFim = carregarDiaFim(),
        diasFerias = document.getElementById("diasFerias").value,
        comprouDias = document.getElementById("comprouDias").value,
        diasHaver = validarDiasHaver();

    
    if (diaFim.length > 0){
        if(diasFerias >= 0 && diasFerias <= 30){
            document.getElementById("dataFimFerias").value = diaFim;
                if(calcDiasHaver()){ 
                    document.getElementById("diasHaver").value = diasHaver[1];
                }
            }
        }
        carregarDiasComprados();
}