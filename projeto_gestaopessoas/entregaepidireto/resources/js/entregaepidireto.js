///////////////////////////////////////////////
/// ENTREGA DE EPI DIRETO                   ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////
var totalLinhas = 0;

var totalEditar = 1;
var cache = {};
var lastXhr;
var cache1 = {};
var lastXhr1;
cont = 1;
i = 1;


$(document).ready(function () {


    carregarCodCa();
    carregarCodCaEd();
    carregarCodCaEdEd();

    carregarFuncionario();
    carregarFuncionarioFiltro();
    
    getGrid();



    $('#dataEpi').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR"
    });

    


});


////////////////////// SALVAR 
////////////////////// SALVAR 
function verificarLancamentoEpi() {

    var id       = $('#id').val();
    var idFuncionario = $('#idFuncionario').val();
    
    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=verificarLancamentoEpi',
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

            } else {
                
                 lancamentoEpi();
            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
} 

function validarSalvarLancamento() {

    var id = document.getElementById('id').value;
    var codCa = document.getElementById('codCa').value;



    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=validarSalvarLancamento',
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


function salvarLancamento() {

    var id = document.getElementById('id').value;
    var codCa = document.getElementById('codCa').value;
    var tipoEpi = document.getElementById('tipoEpi').value;
    var qtdEpi = document.getElementById('qtdEpi').value;
    var estadoEpi = document.getElementById('estadoEpi').value;
    var dataEpi = document.getElementById('dataEpi').value;

    var controleDePreenchimento = 'S';

    if (codCa == 0) {
        controleDePreenchimento = 'N';
    }
    if (tipoEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (qtdEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (estadoEpi == 0) {
        controleDePreenchimento = 'N';
    }
    if (dataEpi == 0) {
        controleDePreenchimento = 'N';
    }




    if (controleDePreenchimento == 'S') {

        $.ajax({
            url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=salvarLancamento',
            data: {
                id: id,
                codCa: codCa,
                tipoEpi: tipoEpi,
                qtdEpi: qtdEpi,
                estadoEpi: estadoEpi,
                dataEpi: dataEpi


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function (data) {

                if (data != false) {

                    mensagem('', 'Item Incluido com Sucesso', 'r', 's', 2000, 1);
                    atualizarItem();

                    getItemLancamento(id);
                    $('#lancamentoModal').modal('hide');


                    atualizarItem();


                } else {

                    mensagem('Atenção', 'Erro ao Incluir Item', 'r', 'r', 2000, 1);
                    atualizarItem();
                    $('#lancamentoModal').modal('hide');

                }

            },
            error: function () {

            }
        });
    } else {


        mensagem('Atenção', 'Prencher todos os campos', 'r', 'i', 2000, 1);

    }


}


function salvar() {

    var id = $('#id').val();
    var idFuncionario = $('#idFuncionario').val();
    var matricula = $('#matricula').val();
    var setor = $('#setor').val();
    var funcao = $('#funcao').val();
    var dataAdmissao = $('#dataAdmissao').val();


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



    if (controleDePreenchimento == 'S') {


        document.getElementById("idFuncionario").readOnly = true;
        document.getElementById("matricula").readOnly = true;
        document.getElementById("setor").readOnly = true;
        document.getElementById("funcao").readOnly = true;
        document.getElementById("dataAdmissao").readOnly = true;



        $.ajax({
            url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=salvar',
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

    var numeroDeLinhas = getNumeroLinhas();

    var linhas = parseInt(numeroDeLinhas);

    for (var i = 1; i <= linhas; i++) {
        //alert(i);
        //var aux1 = i;
        var aux2 = i + "_" + i;
        var aux3 = i + "_" + i + "_" + i;
        var aux4 = i + "_" + i + "_" + i + "_" + i + "_" + i;
        var aux5 = i + "_" + i + "_" + i + "_" + i + "_" + i + "_" + i;
        var aux6 = i + "_" + i + "_" + i + "_" + i + "_" + i + "_" + i + "_" + i;

        //alert(valorCredito);
        var id = $('#id').val();
        //alert(idPermuta);
        var codCa = document.getElementById(aux2).value;
        //alert(codItem);
        var tipoEpi = document.getElementById(aux3).value;
        //alert(undMedida);
        var qtdEpi = document.getElementById(aux4).value;
        //alert(qtdTotal);
        var estadoEpi = document.getElementById(aux5).value;
        //alert(valorUnit);
        var dataEpi = document.getElementById(aux6).value;
        //alert(valorTotal);

        //alert("3");
        var controleDePreenchimento = 'S';

        if (codCa == 0) {
            controleDePreenchimento = 'N';
        }
        if (tipoEpi == "") {
            controleDePreenchimento = 'N';
        }
        if (qtdEpi == "") {
            controleDePreenchimento = 'N';
        }
        if (estadoEpi == 0) {
            controleDePreenchimento = 'N';
        }
        if (dataEpi == "") {
            controleDePreenchimento = 'N';
        }


        if (controleDePreenchimento == 'S') {

            $.ajax({
                url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=salvarItensLancamentos',
                data: {
                    id: id,
                    codCa: codCa,
                    tipoEpi: tipoEpi,
                    qtdEpi: qtdEpi,
                    estadoEpi: estadoEpi,
                    dataEpi: dataEpi

                },
                type: 'POST',
                dataType: 'json',
                async: false,
                success: function (data) {

                    if (data != false) {

                        mensagem('', '', '', '', 2000, 1);
                        //  atualizarItem();

                        // getItemOrcamento();
                        // $('#itemModal').modal('hide');

                        // getTotalGeral();
                        // getGrid();



                    } else {

                        mensagem('', 'Item salvo  com Sucesso', 'r', 's', 2000, 1);
                        atualizarItem();
                        $('#pesquisarModal').modal('hide');
                        //getGrid();

                    }

                },
                error: function () {

                }
            });

        } else {


            mensagem('Atenção', 'Prencher todos os campos', 'r', 'i', 2000, 1);

        }
    }
    //excluirDadosTemp();
    //$('#pesquisarModal').modal('hide');

}

function getNumeroLinhas() {



    var id = document.getElementById('id').value;
    var retorno;
    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getNumeroLinhas',
        data: {
            id: id

        },
        type: 'POST',
        dataType: 'json',
        async: false, //falso eu consigo pegar a variavel do retono
        success: function (data) {

            if (data != false) {
                retorno = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar o número de linhas', 'error');

            }

        },
        error: function () {

        }
    });
    return retorno;


}

function salvarLancamentoEd() {



    var id = document.getElementById('id').value;
    var codCa = document.getElementById('codCaEd').value;
    var tipoEpi = document.getElementById('tipoEpiEd').value;
    var qtdEpi = document.getElementById('qtdEpiEd').value;
    var estadoEpi = document.getElementById('estadoEpiEd').value;
    var dataEpi = document.getElementById('dataEpiEd').value;


    var controleDePreenchimento = 'S';

    if (codCa == 0) {
        controleDePreenchimento = 'N';
    }
    if (tipoEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (qtdEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (estadoEpi == 0) {
        controleDePreenchimento = 'N';
    }
    if (dataEpi == 0) {
        controleDePreenchimento = 'N';
    }




    if (controleDePreenchimento == 'S') {

        $.ajax({
            url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=salvarLancamentoEd',
            data: {
                id: id,
                codCa: codCa,
                tipoEpi: tipoEpi,
                qtdEpi: qtdEpi,
                estadoEpi: estadoEpi,
                dataEpi: dataEpi


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function (data) {

                if (data != false) {

                    mensagem('', 'Item Incluido com Sucesso', 'r', 's', 2000, 1);
                    atualizarItem();

                    getItemLancamento(id);

                    $('#lancamentoEdicaoModal').modal('hide');

                    atualizarItem();


                } else {

                    mensagem('Atenção', 'Erro ao Incluir Item', 'r', 'r', 2000, 1);
                    atualizarItem();

                    $('#lancamentoEdicaoModal').modal('hide');

                }

            },
            error: function () {

            }
        });
    } else {


        mensagem('Atenção', 'Prencher todos os campos', 'r', 'i', 2000, 1);

    }


}

function salvarLancamentoEdEd() {



    var id = document.getElementById('id').value;
    var codCa = document.getElementById('codCaEdEd').value;
    var tipoEpi = document.getElementById('tipoEpiEdEd').value;
    var qtdEpi = document.getElementById('qtdEpiEdEd').value;
    var estadoEpi = document.getElementById('estadoEpiEdEd').value;
    var dataEpi = document.getElementById('dataEpiEdEd').value;


    document.getElementById('tabelaItem2').innerHTML = "";

    var controleDePreenchimento = 'S';

    if (codCa == 0) {
        controleDePreenchimento = 'N';
    }
    if (tipoEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (qtdEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (estadoEpi == 0) {
        controleDePreenchimento = 'N';
    }
    if (dataEpi == 0) {
        controleDePreenchimento = 'N';
    }

    if (controleDePreenchimento == 'S') {

        $.ajax({
            url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=salvarLancamentoEdEd',
            data: {
                id: id,
                codCa: codCa,
                tipoEpi: tipoEpi,
                qtdEpi: qtdEpi,
                estadoEpi: estadoEpi,
                dataEpi: dataEpi


            },
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function (data) {

                if (data != false) {

                    mensagem('', 'Item Incluido com Sucesso', 'r', 's', 2000, 1);
                    atualizarItem();

                    getEditarItemLancamentoEd(id);

                    $('#lancamentoEdicaoModalEd').modal('hide');

                    atualizarItem();


                } else {

                    mensagem('Atenção', 'Erro ao Incluir Item', 'r', 'r', 2000, 1);
                    atualizarItem();

                    $('#lancamentoEdicaoModalEd').modal('hide');

                }

            },
            error: function () {

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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=excluir',
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


function excluirLancamentoModalEd() {

    var codCaEd = $('#codCaEd').val();
    var id = $('#id').val();


    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=excluirLancamentoModalEd',
        data: {
            codCaEd: codCaEd,
            id: id


        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            if (r == true) {
                mensagem('', 'Excluido com Sucesso', 'r', 's', 2000, 1);

                atualizarItem();
                getEditarItemLancamento(id);
                $('#lancamentoEdicaoModal').modal('hide');

            } else {
                mensagem('', 'Excluido com Sucesso', 'r', 's', 2000, 1);

                atualizarItem();
                getEditarItemLancamento(id);
                $('#lancamentoEdicaoModal').modal('hide');


            }
        },
        error: function (e) {
            mensagem('', 'Excluido com Sucesso', 'r', 's', 2000, 1);

            atualizarItem();
            getEditarItemLancamento(id);
            $('#lancamentoEdicaoModal').modal('hide');

        }
    });

}

function excluirLancamentoModalEdEd() {

    var codCaEdEd = $('#codCaEdEd').val();
    var id = $('#id').val();


    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=excluirLancamentoModalEdEd',
        data: {
            codCaEdEd: codCaEdEd,
            id: id


        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            if (r == true) {
                mensagem('', 'Excluido com Sucesso', 'r', 's', 2000, 1);
                $('#lancamentoEdicaoModalEd').modal('hide');
                atualizarItem();
                getEditarItemLancamento(id);


            } else {
                mensagem('', 'Excluido com Sucesso', 'r', 's', 2000, 1);
                $('#lancamentoEdicaoModalEd').modal('hide');
                atualizarItem();
                getEditarItemLancamento(id);



            }
        },
        error: function (e) {
            mensagem('', 'Excluido com Sucesso', 'r', 's', 2000, 1);
            $('#lancamentoEdicaoModalEd').modal('hide');
            atualizarItem();
            getEditarItemLancamento(id);

        }
    });

}

function excluirDadosTemp() {

    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=excluirDadosTemp',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


        },
        error: function (e) {


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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getItemLancamentoEditar',
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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getItemLancamentoEditarEd',
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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getItemLancamento',
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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getEditarItemLancamento',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaItem2').innerHTML = r;
            //document.getElementById('tabelaItem3').innerHTML = "";


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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getEditarItemLancamentoEd',
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
    
    excluirDadosTemp();

    var objFiltro = new Object();

    objFiltro.idFuncionarioFiltro = $("#idFuncionarioFiltro").val();
    

    $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=getGrid",
            "data": objFiltro,
            "type": "POST",
        },
        language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EPI_ENT"},
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
    
    

    excluirDadosTemp();
    atualizarItem();

}

function atualizarItem() {

    document.getElementById("codCa").value = 0;
    document.getElementById("tipoEpi").value = "";
    document.getElementById("qtdEpi").value = "";
    document.getElementById("estadoEpi").value = 0;
    document.getElementById("dataEpi").value = "";

    document.getElementById("codCaEd").value = 0;
    document.getElementById("tipoEpiEd").value = "";
    document.getElementById("qtdEpiEd").value = "";
    document.getElementById("estadoEpiEd").value = 0;
    document.getElementById("dataEpiEd").value = "";

    document.getElementById("codCaEdEd").value = 0;
    document.getElementById("tipoEpiEdEd").value = "";
    document.getElementById("qtdEpiEdEd").value = "";
    document.getElementById("estadoEpiEdEd").value = 0;
    document.getElementById("dataEpiEdEd").value = "";



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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=editarItemLancamentoTemporario',
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


    document.getElementById("codCaEd").readOnly = true;
    document.getElementById("tipoEpiEd").readOnly = true;
    document.getElementById("qtdEpiEd").disabled = false;
    document.getElementById("estadoEpiEd").readOnly = true;
    document.getElementById("dataEpiEd").disabled = false;


    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=editarItemLancamento',
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


    document.getElementById("codCaEdEd").readOnly = true;
    document.getElementById("tipoEpiEdEd").readOnly = true;
    document.getElementById("qtdEpiEdEd").disabled = false;
    document.getElementById("estadoEpiEdEd").readOnly = true;
    document.getElementById("dataEpiEdEd").disabled = false;




    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=editarItemLancamentoEd',
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

    excluirDadosTemp();


    document.getElementById("idFuncionario").disabled = true;
    document.getElementById("matricula").disabled = true;
    document.getElementById("setor").disabled = true;
    document.getElementById("funcao").disabled = true;
    document.getElementById("dataAdmissao").disabled = true;

    document.getElementById('tabelaItem3').innerHTML = "";

    document.getElementById("id").value = id;
    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=editarLancamento',
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
    excluirDadosTemp();
    novoModal();




}

function novoModal() {


    document.getElementById("id").readOnly = true;
    document.getElementById("idFuncionario").readOnly = false;
    document.getElementById("matricula").readOnly = true;
    document.getElementById("setor").readOnly = true;
    document.getElementById("funcao").readOnly = true;
    document.getElementById("dataAdmissao").readOnly = true;

    document.getElementById("id").value = "";
    document.getElementById("idFuncionario").value = 0;
    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataAdmissao").value = "";

    document.getElementById('tabelaItem2').innerHTML = "";
    document.getElementById('tabelaItem3').innerHTML = "";



    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=novo',
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

function carregarCodCa() {




    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarCodCa',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('codCa').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar lista de C.A.', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}


function carregarCodCaEd() {

    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarCodCa',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('codCaEd').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar lista de C.A.', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function carregarCodCaEdEd() {

    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarCodCa',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('codCaEdEd').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar lista de C.A.', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}


function carregarTipoEpi() {

    var codCa = $('#codCa').val();

    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarTipoEpi',
        data: {
            codCa: codCa

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {

                document.getElementById('tipoEpi').value = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar Tipo de EPIs', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function carregarTipoEpiEd() {

    var codCa = $('#codCaEd').val();

    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarTipoEpi',
        data: {
            codCa: codCa

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {

                document.getElementById('tipoEpiEd').value = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar Tipo de EPIs', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}



function carregarFuncionario() {


    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarFuncionario',
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
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarFuncionario',
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


function carregarDadosFuncionario() {


    var idFuncionario = $('#idFuncionario').val();


    document.getElementById("matricula").value = "";
    document.getElementById("setor").value = "";
    document.getElementById("funcao").value = "";
    document.getElementById("dataAdmissao").value = "";


    $.ajax({
        url: 'index.php?m=entregaepidireto&c=entregaepidiretocontroller&f=carregarDadosFuncionario',
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

