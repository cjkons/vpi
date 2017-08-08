///////////////////////////////////////////////
/// DEVOLUCAO DE EPI DIRETO                 ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// AGOSTO DE 2017                          ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////



$(document).ready(function () {

    carregarFuncionario();
    carregarFuncionarioFiltro();
    
    getGrid();




});





function validarSalvarLancamento() {

    var id = document.getElementById('id').value;
    var codCa = document.getElementById('codCa').value;



    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=validarSalvarLancamento',
        data: {
            id: id,
            codCa: codCa

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {


                salvarLancamento();


            } else {

                mensagem('', 'Item já incluído neste lançamento!', 'r', 'e', 2000, 1);

            }

        },
        error: function () {

        }
    });
}

function salvar() {

    var id = $('#id').val();
    var idFuncionario = $('#idFuncionario').val();
    var matricula = $('#matricula').val();
    var setor = $('#setor').val();
    var funcao = $('#funcao').val();
    var dataAdmissao = $('#dataAdmissao').val();
    var imagem           = $('#imagem').val();
    var entDev           = $('#entDev').val();
    var descricaoAnexo           = $('#descricaoAnexo').val();


    var controleDePreenchimento = 'S';

    if (id == "") {
        controleDePreenchimento = 'N';
    }
    if (idFuncionario == 0) {
        controleDePreenchimento = 'N';
    }
    if (matricula == "") {
        controleDePreenchimento = 'N';
    }
    if (setor == "") {
        controleDePreenchimento = 'N';
    }

    if (funcao == "") {
        controleDePreenchimento = 'N';
    }
    if (dataAdmissao == "") {
        controleDePreenchimento = 'N';
    }
    if (imagem == "") {
        controleDePreenchimento = 'N';
    }
    if (entDev == 0) {
        controleDePreenchimento = 'N';
    }
    if (descricaoAnexo == "") {
        controleDePreenchimento = 'N';
    }



    if (controleDePreenchimento == 'S') {


        document.getElementById("idFuncionario").readOnly = true;
        document.getElementById("matricula").readOnly = true;
        document.getElementById("setor").readOnly = true;
        document.getElementById("funcao").readOnly = true;
        document.getElementById("dataAdmissao").readOnly = true;



        $.ajax({
            url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=salvar',
            data: {
                id: id,
                idFuncionario: idFuncionario,
                matricula: matricula,
                setor: setor,
                funcao: funcao,
                dataAdmissao: dataAdmissao


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function (r) {

                if (r == true) {
                    
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    salvarItensLancamentos();
                    $('#pesquisarModal').modal('hide');
                    atualizar();
                    getGrid();
                } else {
                    mensagem('Sucesso', 'Salvo com sucesso', 'success');
                    $('#pesquisarModal').modal('hide');
                    getGrid();


                }
            },
            error: function (e) {
                mensagem('Atenção', 'Erro ao salvar', 'error');
            }
        });


    } else {

        mensagem('Atenção', 'Prencha todos os campos', 'alert');

        // mensagens de erro


    }

}

function salvarItensLancamentos() {

   
        var id               = $('#id').val();
        var imagem           = $('#imagem').val();
        var matricula        = $('#matricula').val();
        var entDev           = $('#entDev').val();
        var descricaoAnexo           = $('#descricaoAnexo').val();
        
        
        var controleDePreenchimento = 'S';

        if (imagem == "") {
            controleDePreenchimento = 'N';
        }
       
        if (controleDePreenchimento == 'S') {
            
        var fd1 = new FormData();

            fd1.append('anexo1', document.getElementById('imagem').files[0]);


            $.ajax({
                url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=salvarAnexoImagem',
                type: 'POST',
                cache: false,
                data: fd1,
                processData: false,    
                contentType: false,
                async: false,
                success: function (enderecoAnexo, pasta) {
        
        
        
                    $.ajax({
                        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=salvarItensLancamentos',
                        data: {
                                    id: id,
                                    matricula: matricula,
                                    imagem: enderecoAnexo, // PASSANDO VALOR DA IMAGEM VINDA DO ANEXO
                                    entDev: entDev,
                                    descricaoAnexo: descricaoAnexo
                                 
                            


                        },
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        success: function(r) {

                            if (r == true) {
                                mensagem('Sucesso', 'Salvo com sucesso', 'success');
                                $('#basicModal').modal('hide');
                                document.getElementById("imagemView").innerHTML = "";
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
            });
                
        

            

        } else {


            mensagem('Atenção', 'Prencher todos os campos', 'r', 'i', 2000, 1);

        }
    
    

}

/////////////// EXCLUIR ////////////////////////////


function excluir() {

    var id = $('#id').val();

    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=excluir',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#pesquisarModal').modal('hide');
                atualizar();
                getGrid();
            } else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                $('#pesquisarModal').modal('hide');
                atualizar();
                getGrid();
            }
        },
        error: function (e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            $('#pesquisarModal').modal('hide');
            atualizar();
            getGrid();
        }
    });

}

function excluirAnexo(id,idLancamentoItem) {

    

    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=excluirAnexo',
        data: {
            id: id,
            idLancamento: idLancamentoItem
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            if (r == true) {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
                getEditarItemLancamento(id);
                
            } else {
                mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
               getEditarItemLancamento(id);
            }
        },
        error: function (e) {
            mensagem('Sucesso', 'Excluído  com Sucesso', 'success');
            getEditarItemLancamento(id);
        }
    });

}



/////////// CARREGAMENTOS EM VIEW ///////////////////////

function  getItemLancamentoEditar() {


    var id = $("#id").val();

    document.getElementById("codCa").readOnly = true;
    document.getElementById("tipoEpi").readOnly = true;
    document.getElementById("qtdEpi").disabled = false;
    document.getElementById("estadoEpi").readOnly = true;
    document.getElementById("dataEpi").disabled = false;



    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=getItemLancamentoEditar',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem3').innerHTML = r;

        },
        error: function (e) {

        }
    });


}

function  getItemLancamentoEditarEd() {


    var id = $("#id").val();

    document.getElementById("codCa").readOnly = true;
    document.getElementById("tipoEpi").readOnly = true;
    document.getElementById("qtdEpi").disabled = false;
    document.getElementById("estadoEpi").readOnly = true;
    document.getElementById("dataEpi").disabled = false;

    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=getItemLancamentoEditarEd',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem3').innerHTML = r;

        },
        error: function (e) {

        }
    });


}

function  getItemLancamento(id) {


    //var id = $("#id").val();


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=getItemLancamento',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem2').innerHTML = r;
            document.getElementById('tabelaItem3').innerHTML = "";


            atualizarItem();

        },
        error: function (e) {
            atualizarItem();
        }
    });


}

function  getEditarItemLancamento(id) {


    //var id = $("#id").val();
    


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=getEditarItemLancamento',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem2').innerHTML = r;
            document.getElementById('tabelaItem3').innerHTML = "";


            atualizarItem();

        },
        error: function (e) {
            atualizarItem();
        }
    });


}
function  getEditarItemLancamentoEd(id) {


    //var id = $("#id").val();


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=getEditarItemLancamentoEd',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            //document.getElementById('tabelaItem2').innerHTML = r;
            document.getElementById('tabelaItem3').innerHTML = r;


            atualizarItem();

        },
        error: function (e) {
            atualizarItem();
        }
    });


}

function getGrid() {
    
   

    var objFiltro = new Object();

    objFiltro.idFuncionarioFiltro = $("#idFuncionarioFiltro").val();
    

    $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=getGrid",
            "data": objFiltro,
            "type": "POST",
        },
        language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EPI_HISTORICO"},
            {"data": "FUNCIONARIO"},
            {"data": "MATRICULA"},
            {"data": "SETOR"},
            {"data": "FUNCAO"},
            {"data": "EDITAR"}
        ],
        searching: false
    });


    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    atualizar();


}


function atualizar() {


    document.getElementById("idFuncionarioFiltro").value = 0;
    
    

   
    atualizarItem();

}

function atualizarItem() {

    document.getElementById("imagem").value = "";
    document.getElementById("entDev").value = 0;
    document.getElementById("descricaoAnexo").value = "";
    
    



}


////////////// FUNCOES DE FECHAR MODAIS //////////////////////////


function botaoLancamentoSair() {


    $('#lancamentoModal').modal('hide');


}

function botaoSair() {


    $('#pesquisarModal').modal('hide');


}

function botaoSairEd() {


    $('#lancamentoEdicaoModal').modal('hide');


}

function botaoSairEdEd() {


    $('#lancamentoEdicaoModalEd').modal('hide');


}


/////////////////////// CARREGAMENTO DOS CAMPOS DE MODAL




function editarItemLancamentoTemporario(idLancamentoItem) {


    var id = $('#id').val();

    document.getElementById("codCa").readOnly = true;
    document.getElementById("tipoEpi").readOnly = true;
    document.getElementById("qtdEpi").disabled = false;
    document.getElementById("estadoEpi").readOnly = true;
    document.getElementById("dataEpi").disabled = false;


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=editarItemLancamentoTemporario',
        data: {
            id: id,
            idLancamentoItem: idLancamentoItem


        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            document.getElementById("codCaEd").value = r[0];
            document.getElementById("tipoEpiEd").value = r[1];
            document.getElementById("qtdEpiEd").value = r[2];
            document.getElementById("estadoEpiEd").value = r[3];
            document.getElementById("dataEpiEd").value = r[4];

            getItemLancamento(id);

            $('#lancamentoEdicaoModal').modal('show');

        },
        error: function () {

        }
    });

}

function editarItemLancamento(idLancamentoItem) {


    var id = $('#id').val();


    document.getElementById("codCaEd").disabled = true;
    document.getElementById("tipoEpiEd").readOnly = true;
    document.getElementById("qtdEpiEd").readOnly = false;
    document.getElementById("estadoEpiEd").readOnly = true;
    document.getElementById("dataEpiEd").readOnly = false;


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=editarItemLancamento',
        data: {
            id: id,
            idLancamentoItem: idLancamentoItem



        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            document.getElementById("codCaEd").value = r[0];
            document.getElementById("tipoEpiEd").value = r[1];
            document.getElementById("qtdEpiEd").value = r[2];
            document.getElementById("estadoEpiEd").value = r[3];
            document.getElementById("dataEpiEd").value = r[4];



            $('#lancamentoEdicaoModal').modal('show');

        },
        error: function () {

        }
    });

}

function editarItemLancamentoEd(idLancamentoItem) {


    var id = $('#id').val();


    document.getElementById("codCaEdEd").disabled = true;
    document.getElementById("tipoEpiEdEd").readOnly = true;
    document.getElementById("qtdEpiEdEd").readOnly = false;
    document.getElementById("estadoEpiEdEd").readOnly = true;
    document.getElementById("dataEpiEdEd").readOnly = false;




    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=editarItemLancamentoEd',
        data: {
            id: id,
            idLancamentoItem: idLancamentoItem



        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {
           
            document.getElementById("codCaEdEd").value = r[0];
            document.getElementById("tipoEpiEdEd").value = r[1];
            document.getElementById("qtdEpiEdEd").value = r[2];
            document.getElementById("estadoEpiEdEd").value = r[3];
            document.getElementById("dataEpiEdEd").value = r[4];



            $('#lancamentoEdicaoModalEd').modal('show');

        },
        error: function () {

        }
    });

}


function editarLancamento(id) {

    


    document.getElementById("idFuncionario").disabled = true;
    document.getElementById("matricula").disabled = true;
    document.getElementById("setor").disabled = true;
    document.getElementById("funcao").disabled = true;
    document.getElementById("dataAdmissao").disabled = true;
    document.getElementById("imagem").readOnly = false;
    document.getElementById("entDev").readOnly = false;
    document.getElementById("descricaoAnexo").readOnly = false;
    

    document.getElementById('tabelaItem3').innerHTML = "";

    document.getElementById("id").value = id;
    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=editarLancamento',
        data: {
            id: id

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {



            document.getElementById("id").value = r[0];
            document.getElementById("idFuncionario").value = r[1];
            document.getElementById("matricula").value = r[2];
            document.getElementById("setor").value = r[3];
            document.getElementById("funcao").value = r[4];
            document.getElementById("dataAdmissao").value = r[5];

            $('#pesquisarModal').modal('show');
            getEditarItemLancamento(id);

        },
        error: function (e) {

        }
    });

}

////////////////////////////////////////



function novo() {


    $('#pesquisarModal').modal('show');

    //atualizar();
    
    novoModal();




}

function novoModal() {


    document.getElementById("id").readOnly = true;
    document.getElementById("idFuncionario").readOnly = false;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;
    document.getElementById("imagem").readOnly = false;
    document.getElementById("entDev").readOnly = false;
    document.getElementById("descricaoAnexo").readOnly = false;

    document.getElementById("id").value = "";
    document.getElementById("idFuncionario").value = 0;
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataAdmissao").value = "";
    document.getElementById("imagem").value = "";
    document.getElementById("entDev").value = 0;
    document.getElementById("descricaoAnexo").value = "";

    document.getElementById('tabelaItem2').innerHTML = "";
    document.getElementById('tabelaItem3').innerHTML = "";



    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=novo',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            document.getElementById("idFuncionario").disabled = false;
            document.getElementById("id").value = r;


        },
        error: function (e) {

        }
    });

}

function lancamentoEpi() {



    var id = $('#id').val();
    var idFuncionario = $('#idFuncionario').val();
    var matricula = $('#matricula').val();


    var controleDePreenchimento = 'S';

    if (id == "") {
        controleDePreenchimento = 'N';
    }
    if (idFuncionario == 0) {
        controleDePreenchimento = 'N';
    }
    if (matricula == "") {
        controleDePreenchimento = 'N';
    }

    if (controleDePreenchimento == 'S') {

        document.getElementById("qtdEpi").readOnly = false;
        document.getElementById("dataEpi").readOnly = false;


        $('#lancamentoModal').modal('show');


    } else {

        mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);



    }
}

///// CARREGAR DADOS 

function carregarFuncionario() {


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=carregarFuncionario',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('idFuncionario').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de Funcionarios', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function carregarFuncionarioFiltro() {


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=carregarFuncionario',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('idFuncionarioFiltro').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de Funcionarios', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function verificarLancamentoEpi() {

    var id       = $('#id').val();
    var idFuncionario = $('#idFuncionario').val();
    
    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=verificarLancamentoEpi',
        data: {
            
            id: id,
            idFuncionario: idFuncionario
        
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data == false) {
                
               mensagem('Atenção', 'Já existe cadastro para esta Funcionário, Verifique na área de Consulta! ', 'error');
                document.getElementById("idFuncionario").value = 0;
                document.getElementById("matricula").value = "";
                document.getElementById("setor").value = "";
                document.getElementById("funcao").value = "";
                document.getElementById("dataAdmissao").value = "";
                document.getElementById("imagem").value = "";
                document.getElementById("entDev").value = 0;
                document.getElementById("descricaoAnexo").value = "";        

            } else {
                
                 carregarDadosFuncionario();
            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
} 


function carregarDadosFuncionario() {


    var idFuncionario = $('#idFuncionario').val();


    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataAdmissao").value = "";


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=carregarDadosFuncionario',
        data: {
            idFuncionario: idFuncionario

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            document.getElementById("matricula").value = r[0];
            document.getElementById("setor").value = r[1];
            document.getElementById("funcao").value = r[2];
            document.getElementById("dataAdmissao").value = r[3];



        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function visualizarAnexo(id, idLancamentoItem) {


    $.ajax({
        url: 'index.php?m=historicoepiusuario&c=historicoepiusuariocontroller&f=visualizarAnexo',
        data: {
            id: id,
            idLancamentoItem: idLancamentoItem



        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            var caminhoValor = r[0];
            
        

            var caminhoValor = caminhoValor.substr(57);
           

             //      var enderecoMedicao = "http://localhost/gestaopessoas/fwk/uploads/historicosEpi/" + caminhoValor; // servidor
                   var enderecoMedicao = "http://189.11.172.90/gestaopessoas/fwk/uploads/historicosEpi/" + caminhoValor; // servidor
           //
                   window.open(enderecoMedicao, '_blank');


                   },
        error: function () {

        }
    });

}

