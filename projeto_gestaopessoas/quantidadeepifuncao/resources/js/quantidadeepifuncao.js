///////////////////////////////////////////////
/// Cadastro de Epi                         ///
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


    
    carregarFuncao();
    carregarFuncaoFiltro();
   
    
    carregarTipoEpi();
    carregarTipoEpiEd();
    getGrid();



    


});


////////////////////// SALVAR 

function verificarSalvarLancamento() {

    var id       = $('#id').val();
    var tipoEpi = $('#tipoEpi').val();
    var impressaoEpi = $('#impressaoEpi').val();
    
    
    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=verificarSalvarLancamento',
        data: {
            
            id: id,
            tipoEpi: tipoEpi,
            impressaoEpi: impressaoEpi
        
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                
               mensagem('Atenção', 'Já existe cadastro para esta Função, Verifique na área de Consulta! ', 'error');

            } else {
                
                 salvarLancamento();
            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
} 

function salvarLancamento() {

    var id = document.getElementById('id').value;
    var tipoEpi = document.getElementById('tipoEpi').value;
    var quantidade = document.getElementById('quantidade').value;
    var durabilidade = document.getElementById('durabilidade').value;
    

    var controleDePreenchimento = 'S';

    if (tipoEpi == 0) {
        controleDePreenchimento = 'N';
    }
   
    if (quantidade == "") {
        controleDePreenchimento = 'N';
    }
    if (durabilidade == "") {
        controleDePreenchimento = 'N';
    }
    


    if (controleDePreenchimento == 'S') {

        $.ajax({
            url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=salvarLancamento',
            data: {
                id: id,
                tipoEpi: tipoEpi,
                quantidade: quantidade,
                durabilidade: durabilidade

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
function validarExcluir(){
    $('#excluirModal').modal('show');
}
 
function salvar() {

    var id = $('#id').val();
    var idFuncao = $('#idFuncao').val();
    var impressaoEpi = $('#impressaoEpi').val();
    


    var controleDePreenchimento = 'S';

    if (id == "") {
        controleDePreenchimento = 'N';
    }
    if (idFuncao == 0) {
        controleDePreenchimento = 'N';
    }
    if (impressaoEpi == 0) {
        controleDePreenchimento = 'N';
    }
    


    if (controleDePreenchimento == 'S') {


        document.getElementById("idFuncao").readOnly = true;
        



        $.ajax({
            url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=salvar',
            data: {
                id: id,
                idFuncao: idFuncao,
                impressaoEpi: impressaoEpi
                


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
        //var aux5 = i + "_" + i + "_" + i + "_" + i + "_" + i + "_" + i;
        //var aux6 = i + "_" + i + "_" + i + "_" + i + "_" + i + "_" + i + "_" + i;

        //alert(valorCredito);
        var id = $('#id').val();
        //alert(idPermuta);
        var tipoEpi = document.getElementById(aux2).value;
        //alert(codItem);
        var quantidade = document.getElementById(aux3).value;
        //alert(undMedida);
        var durabilidade = document.getElementById(aux4).value;
        //alert(qtdTotal);
        
        var controleDePreenchimento = 'S';

        if (tipoEpi == 0) {
            controleDePreenchimento = 'N';
        }
        if (quantidade == "") {
            controleDePreenchimento = 'N';
        }
        if (durabilidade == "") {
            controleDePreenchimento = 'N';
        }
        


        if (controleDePreenchimento == 'S') {

            $.ajax({
                url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=salvarItensLancamentos',
                data: {
                    id: id,
                    tipoEpi: tipoEpi,
                    quantidade: quantidade,
                    durabilidade: durabilidade

                },
                type: 'POST',
                dataType: 'json',
                async: false,
                success: function (data) {

                    if (data != false) {

                       // mensagem('', '', '', '', 2000, 1);
                        //  atualizarItem();

                        // getItemOrcamento();
                        // $('#itemModal').modal('hide');

                        // getTotalGeral();
                        // getGrid();



                    } else {

                        //mensagem('', 'Item salvo  com Sucesso', 'r', 's', 2000, 1);
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
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getNumeroLinhas',
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
    var tipoEpi = document.getElementById('tipoEpiEd').value;
    var quantidade = document.getElementById('quantidadeEd').value;
    var durabilidade = document.getElementById('durabilidadeEd').value;
    


    var controleDePreenchimento = 'S';

    if (tipoEpi == "") {
        controleDePreenchimento = 'N';
    }
    if (quantidade == "") {
        controleDePreenchimento = 'N';
    }
    if (durabilidade == "") {
        controleDePreenchimento = 'N';
    }
    




    if (controleDePreenchimento == 'S') {

        $.ajax({
            url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=salvarLancamentoEd',
            data: {
                id: id,
                tipoEpi: tipoEpi,
                quantidade: quantidade,
                durabilidade: durabilidade
                


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


    document.getElementById('tabelaItem2').innerHTML = "";
    
    var id = document.getElementById('id').value;
    var tipoEpi = document.getElementById('tipoEpiEdEd').value;
    var quantidade = document.getElementById('quantidadeEdEd').value;
    var durabilidade = document.getElementById('durabilidadeEdEd').value;
    
    var controleDePreenchimento = 'S';

    if (tipoEpi == 0) {
        controleDePreenchimento = 'N';
    }
    if (quantidade == "") {
        controleDePreenchimento = 'N';
    }
    if (durabilidade == "") {
        controleDePreenchimento = 'N';
    }
    

    if (controleDePreenchimento == 'S') {

        $.ajax({
            url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=salvarLancamentoEdEd',
            data: {
                
                id: id,
                tipoEpi: tipoEpi,
                quantidade: quantidade,
                durabilidade: durabilidade


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
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=excluir',
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

    var tipoEpiEd = $('#tipoEpiEd').val();
    var id = $('#id').val();


    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=excluirLancamentoModalEd',
        data: {
            tipoEpiEd: tipoEpiEd,
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

    var tipoEpiEdEd = $('#tipoEpiEdEd').val();
    var id = $('#id').val();


    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=excluirLancamentoModalEdEd',
        data: {
            tipoEpiEdEd: tipoEpiEdEd,
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
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=excluirDadosTemp',
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

    document.getElementById("tipoEpi").readOnly = true;
    document.getElementById("quantidade").readOnly = true;
    document.getElementById("durabilidade").disabled = false;
    

    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getItemLancamentoEditar',
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

    document.getElementById("tipoEpi").readOnly = true;
    document.getElementById("quantidade").readOnly = true;
    document.getElementById("durabilidade").disabled = false;

    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getItemLancamentoEditarEd',
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
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getItemLancamento',
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
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getEditarItemLancamento',
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
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getEditarItemLancamentoEd',
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

    objFiltro.idFuncaoFiltro = $("#idFuncaoFiltro").val();
    

    $('#grid').DataTable({
        "destroy": true,
        ajax: {
            "url": "index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=getGrid",
            "data": objFiltro,
            "type": "POST",
        },
        language: {
            "url": '//cdn.datatables.net/plug-ins/1.10.7/i18n/Portuguese-Brasil.json'
        },
        "columns": [
            {"data": "ID_EPI_QTD_FUNCAO"},
            {"data": "FUNCAO"},
            {"data": "EDITAR_LANCAMENTO"},
            {"data": "LISTA_FUNCIONARIOS"}
        ],
        searching: false
    });


    $('#grid')
            .removeClass('display')
            .addClass('table table-hover table-striped table-bordered');
    
    atualizar();


}


function atualizar() {


    document.getElementById("idFuncaoFiltro").value = 0;
    
    

    excluirDadosTemp();
    atualizarItem();

}

function atualizarItem() {

    document.getElementById("tipoEpi").value = 0;
    document.getElementById("quantidade").value = "";
    document.getElementById("durabilidade").value = "";
    
    document.getElementById("tipoEpiEd").value = 0;
    document.getElementById("quantidadeEd").value = "";
    document.getElementById("durabilidadeEd").value = "";
    
    document.getElementById("tipoEpiEdEd").value = 0;
    document.getElementById("quantidadeEdEd").value = "";
    document.getElementById("durabilidadeEdEd").value = "";
    



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






function editarItemLancamento(idLancamentoItem) {


    var id = $('#id').val();


    
    document.getElementById("quantidadeEd").readOnly = false;
    document.getElementById("durabilidadeEd").readOnly = false;


    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=editarItemLancamento',
        data: {
            id: id,
            idLancamentoItem: idLancamentoItem



        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            document.getElementById("tipoEpiEd").value = r[0];
            document.getElementById("quantidadeEd").value = r[1];
            document.getElementById("durabilidadeEd").value = r[2];
            

            $('#lancamentoEdicaoModal').modal('show');

        },
        error: function () {

        }
    });

}

function editarItemLancamentoEd(idLancamentoItem) {


    var id = $('#id').val();


    document.getElementById("tipoEpiEdEd").readOnly = true;
    document.getElementById("quantidadeEdEd").readOnly = false;
    document.getElementById("durabilidadeEdEd").readOnly = false;




    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=editarItemLancamentoEd',
        data: {
            id: id,
            idLancamentoItem: idLancamentoItem



        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {
           
            document.getElementById("tipoEpiEdEd").value = r[0];
            document.getElementById("quantidadeEdEd").value = r[1];
            document.getElementById("descricaoEdEd").value = r[2];
            
            $('#lancamentoEdicaoModalEd').modal('show');

        },
        error: function () {

        }
    });

}


function editarLancamento(id) {
    
    excluirDadosTemp();


    document.getElementById("idFuncao").disabled = true;
    
    document.getElementById('tabelaItem3').innerHTML = "";

    
    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=editarLancamento',
        data: {
            id: id

        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {



            document.getElementById("id").value = r[0];
            document.getElementById("idFuncao").value = r[1];
            document.getElementById("impressaoEpi").value = r[2];
            

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
    //excluirDadosTemp();
    novoModal();




}

function novoModal() {


    document.getElementById("id").readOnly = true;
    document.getElementById("idFuncao").readOnly = false;
    document.getElementById("impressaoEpi").readOnly = false;;

    document.getElementById("id").value = "";
    document.getElementById("idFuncao").value = 0;
    document.getElementById("impressaoEpi").value = 0;
   
    document.getElementById('tabelaItem2').innerHTML = "";
    document.getElementById('tabelaItem3').innerHTML = "";



    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=novo',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById("id").value = r;


        },
        error: function (e) {

        }
    });

}
function verificarLancamentoEpi() {

    var id       = $('#id').val();
    var idFuncao = $('#idFuncao').val();
    
    
    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=verificarLancamentoEpi',
        data: {
            
            id: id,
            idFuncao: idFuncao
            
        
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                
               mensagem('Atenção', 'Já existe cadastro para esta Função, Verifique na área de Consulta! ', 'error');

            } else {
                
                 lancamentoEpi();
            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}    
    

function lancamentoEpi() {



    var id = $('#id').val();
    var idFuncao = $('#idFuncao').val();
    var impressaoEpi = $('#impressaoEpi').val();
   


    var controleDePreenchimento = 'S';

    if (id == "") {
        controleDePreenchimento = 'N';
    }
    if (idFuncao == 0) {
        controleDePreenchimento = 'N';
    }
    if (impressaoEpi == 0) {
        controleDePreenchimento = 'N';
    }
    

    if (controleDePreenchimento == 'S') {
        
        document.getElementById("quantidade").readOnly = false;
        document.getElementById("durabilidade").readOnly = false;

        document.getElementById("tipoEpi").value = 0;
        document.getElementById("quantidade").value = "";
        document.getElementById("durabilidade").value = "";


        $('#lancamentoModal').modal('show');


    } else {

        mensagem('Atenção', 'Prencha todos os campos', 'r', 'i', 2000, 1);



    }
}

///// CARREGAR DADOS 

function carregarTipoEpi() {




    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=carregarTipoEpi',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('tipoEpi').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar Tipo de EPIs', 'error');

            }

        },
        error: function () {
           // desbloqueiaTela();
        }
    });
}

function carregarTipoEpiEd() {




    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=carregarTipoEpiEd',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('tipoEpiEd').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar Tipo de EPIs', 'error');

            }

        },
        error: function () {
           // desbloqueiaTela();
        }
    });
}

function carregarFuncao() {


    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=carregarFuncao',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('idFuncao').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de Funcionarios', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function carregarFuncaoFiltro() {


    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=carregarFuncao',
        data: {
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data) {

            if (data != false) {
                document.getElementById('idFuncaoFiltro').innerHTML = data;

            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de Funcionarios', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}

function carregarFuncaoFuncionarios(id) {


    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=carregarFuncaoFuncionarios',
        data: {
            
            id:id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {

            if (r != false) {
                document.getElementById('idFuncaoLista').value = r;
                
            } else {
                mensagem('Atenção', 'Erro ao carregar a lista de Funcionarios', 'error');

            }

        },
        error: function () {
            desbloqueiaTela();
        }
    });
}



////////////////////// SISTEMA DE IMPRESSAO POR FUNCAO PERIODO



function botaoFuncionariosSair() {


    $('#listaFuncionariosModal').modal('hide');


}

function  carregarListaFuncionarios(id) {

   
    
    $('#listaFuncionariosModal').modal('show');

    $.ajax({
        url: 'index.php?m=quantidadeepifuncao&c=quantidadeepifuncaocontroller&f=carregarListaFuncionarios',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (r) {


            document.getElementById('tabelaFuncionarios').innerHTML = r;
            carregarFuncaoFuncionarios(id);
            


            //atualizarItem();

        },
        error: function (e) {
            //atualizarItem();
        }
    });


}




