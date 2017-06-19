/*******************************************************************************
 ************************** ADMIN CAMAROTE ****************************
 * 
 * DESKTOP
 *
 * 
 ******************************************************************************/

$(document).ready(function () {
    moveRelogio();
    carregaIcones();

});


function moveRelogio() {

    var momentoAtual = new Date()
    var hora = momentoAtual.getHours()
    var minuto = momentoAtual.getMinutes()
    var segundo = momentoAtual.getSeconds()

    if (segundo < 10) {
        segundo = "0" + segundo;
    }
    if (minuto < 10) {
        minuto = "0" + minuto;
    }
    if (hora < 10) {
        hora = "0" + hora;
    }

    if (segundo == 59) {

        getRanking();
    }

    var horaImprimivel = new Date().toLocaleString().split(" ")[0] + " - " + hora + ":" + minuto + ":" + segundo;

    setTimeout("moveRelogio()", 1000)
}

function carregaIcones() {

    $.ajax({
        url: "index.php?m=base&c=logocontroller&f=getIconesSalvos",
        data: {},
        type: "POST",
        dataType: "json",
        async: true,
        success: function (listaIcones) {

            for (var i = 0; i < listaIcones.length; i++) {

                var nomeIcone = 'icone' + listaIcones[i]['ID'];
                var nomeAba = listaIcones[i]['NOME_ABA'];
                var nomePrograma = listaIcones[i]['NOME_PROGRAMA'];
                var idConteudo = listaIcones[i]['ID_CONTEUDO'];
                var controllerChamado = listaIcones[i]['CONTROLLER_CHAMADO'];
                var x = listaIcones[i]['X'];
                var y = listaIcones[i]['Y'];

                var enderecoIcone = listaIcones[i]['ENDERECO_ICONE'];

                var icone = "<div id='" + nomeIcone + "' style='width: 0%;height: 0%;'>\n\
                                <table class='icone' style='width: 64px;'>\n\
                                    <tr>\n\
                                        <td align='center' style='width: 80%;' class='tdIcone'>\n\
                                            <div class='divIcone' ondblclick='\n\
                                                adicionarAba(\"" + nomeAba + "\", \"" + nomePrograma + "\", \"" + idConteudo + "\", \"" + controllerChamado + "\",\"" + enderecoIcone + "\");'>\n\
                                            <div>\n\
                                                <i class='" + enderecoIcone + " fa-4x' style='width:64px; height: 64px;' title='" + nomeAba + "'></i>\n\
                                            </div>\n\
                                            <div class='arredondaDiv' id='nomeAba" + nomeIcone + "' style='background-color: ; padding: 2px;width: 100%;cursor: pointer'>" + nomeAba + "</div>\n\
                                            </div>\n\
                                        </td>\n\
                                        <td style='vertical-align: top;width: 20%;' align='right'>\n\
                                                <img onclick='removerIcone(\"" + nomeIcone + "\",\"" + nomeAba + "\")' src='resources/base/img/close_icon.png' style='z-index: 99999;margin-left: -20px;margin-top: -15px;width:16px;height:16px;' title='Remover Atalho'/>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div>";

                $("#body").append(icone);

                if (x != null && y != null && y != undefined && y != undefined) {

                    $("#" + nomeIcone).animate({left: x, top: y}, 500);

                }

                $("#" + nomeIcone).draggable({
                    handle: ".icone",
                    scroll: true,
                    start: function () {
                        $(this).data("startingScrollTop", $(this).parent().scrollTop());
                    },
                    drag: function (event, ui) {


                    },
                    stop: function (event, ui) {
                        atualizaLocal($(this).attr('id'));
                    }
                });
            }
        },
        error: function () {

        }
    });
}

function atualizaLocal(idIcone) {

    var x = getPosicaoElemento(idIcone).left;
    var y = getPosicaoElemento(idIcone).top;

    var nomeAba = document.getElementById('nomeAba' + idIcone).innerHTML;

    $.ajax({
        url: "index.php?m=base&c=logocontroller&f=atualizaLocal",
        data: {
            nomeAba: nomeAba,
            x: x,
            y: y
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (retorno) {
            if (retorno == false) {
                $.growlUI('Problema ao atualizar a posição do ícone :(');
            } else {
                $.growlUI('Posição atualizada');
            }
        },
        error: function () {
            $.growlUI('Problema ao atualizar a posição do ícone :(');
        }
    });

}

function removerIcone(idIcone, nomeAba) {

    nomeAba = nomeAba + "";

    $("#" + idIcone).hide("highlight");
    $("#" + idIcone).remove();



    $.ajax({
        url: "index.php?m=base&c=logocontroller&f=removerFavorito",
        data: {
            nomeAba: nomeAba
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (retorno) {
            if (retorno == false) {
                $.growlUI('Problema ao remover ícone :(');
            }
        },
        error: function () {
            $.growlUI('Problema ao remover ícone :(');
        }
    });

}

function getPosicaoElemento(elemID) {

    var offsetTrail = document.getElementById(elemID);
    var offsetLeft = 0;
    var offsetTop = 0;

    while (offsetTrail) {
        offsetLeft += offsetTrail.offsetLeft;
        offsetTop += offsetTrail.offsetTop;
        offsetTrail = offsetTrail.offsetParent;
    }

    if (navigator.userAgent.indexOf("Mac") != -1 &&
            typeof document.body.leftMargin != "undefined") {
        offsetLeft += document.body.leftMargin;
        offsetTop += document.body.topMargin;
    }

    return {left: offsetLeft, top: offsetTop};
}

//

// FUNÇÃO QUE ADICIONA ABA E ABRE O CONTEUDO PASSADO POR PARÂMETRO
function adicionarAba(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone) {

    if (programaJaAberto(nomePrograma)) {

        var aba = parent.getElementsByIdStartsWith("li", "aba-" + nomePrograma);
        parent.$("#irConteudoAba-" + nomePrograma).click();
    } else {

        var numeroAba = $('#listaAbas li').size() + 1;
        // cria a aba
        parent.$('<li id="aba-' + nomePrograma + '">\n\
            <a id="irConteudoAba-' + nomePrograma + '" href="#conteudoAba-' + nomePrograma + '"  style="text-decoration:none" data-toggle="tab">' + nomeAba + '\
                <span id="btnFecharAba-' + numeroAba + '" onclick="fecharAba(' + "'" + nomePrograma + "'" + ')" title="Fechar Aba" style="color: #990004; cursor: alias;padding-left: 5px;font-size: 1.2em "class="glyphicon glyphicon-remove"></span>\n\
                <span id="btnFavoritarAba-' + numeroAba + '"  title="Favoritar Aba" style="cursor: alias;font-size: 1.2em "class="glyphicon glyphicon-star-empty"></span>\n\
        </a>\n\
        </li>').appendTo('#listaAbas');
        // cria o conteúdo da aba
        parent.$('<div style="height: 100%;" class="tab-pane" id="conteudoAba-' + nomePrograma + '"><iframe class="frameAba" style="width: 100%;" frameBorder="0" id="frameAba-' + nomePrograma + '"></iframe></div>').appendTo('#listaConteudoAbas');
        // ativa a última aba (criada)
        parent.$('#listaAbas a:last').tab('show');
        parent.$(".frameAba").height($(window).height() - 0);
        parent.document.getElementById('frameAba-' + nomePrograma).src = controllerChamado;
        isProgramaFavorito(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone, numeroAba);
    }

}

var numAbaSelecionada = 0;
var abaAnteriorMarcada = false;
function programaJaAberto(nomePrograma) {

    var abasComPrograma = parent.getElementsByIdStartsWith("li", "aba-" + nomePrograma);
    if (abasComPrograma.length > 0) {
        return true;
    } else {
        return false;
    }
}

// FUNÇÃO QUE RETORNA TODOS OS ELEMENTOS DO DOM PELO TIPO DE ELEMENTO HTML
// E QUE COMECEM COM UM PREFIXO DEFINIDO POR PARÂMETRO
function getElementsByIdStartsWith(container, selectorTag, prefix) {
    var items = [];
    var myPosts = document.getElementById(container).getElementsByTagName(selectorTag);
    for (var i = 0; i < myPosts.length; i++) {
        if (myPosts[i].id.lastIndexOf(prefix, 0) === 0) {
            items.push(myPosts[i]);
        }
    }
    return items;
}

// VERIFICA SE O PROGRAMA ABERTO FOI FAVORITADO
// RETORNA TRUE CASO PROGRAMA É FAVORITO
// RETORNA FALSE CASO NÃO FOR FAVORITO
function isProgramaFavorito(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone, numeroAba) {

    nomeAba = String(nomeAba);
    nomePrograma = String(nomePrograma);
    idConteudo = String(idConteudo);
    controllerChamado = String(controllerChamado);
    enderecoIcone = String(enderecoIcone);
    numeroAba = String(numeroAba);
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=isProgramaFavorito",
        data: {
            idConteudo: idConteudo
        },
        type: "POST",
        dataType: "json",
        async: true,
        cache: false,
        success: function (isProgramaFavoritado) {

            if (isProgramaFavoritado) {
                // programa é favorito
                parent.$("#btnFavoritarAba-" + numeroAba).removeClass('glyphicon-star-empty');
                parent.$("#btnFavoritarAba-" + numeroAba).addClass('glyphicon-star');
                parent.$("#btnFavoritarAba-" + numeroAba).css('color', '#fff384');
                parent.$("#btnFavoritarAba-" + numeroAba).css('border', 'solid 5px black;');
                parent.$("#btnFavoritarAba-" + numeroAba).attr('title', 'Desfavoritar Programa');
                parent.$("#btnFavoritarAba-" + numeroAba).attr('onclick', "alterarFavoritacaoPrograma('" + nomeAba + "','" + nomePrograma + "','" + idConteudo + "','" + controllerChamado + "','" + enderecoIcone + "','" + numeroAba + "')")
            } else {
                // programa não é favorito
                parent.$("#btnFavoritarAba-" + numeroAba).removeClass('glyphicon-star');
                parent.$("#btnFavoritarAba-" + numeroAba).addClass('glyphicon-star-empty');
                parent.$("#btnFavoritarAba-" + numeroAba).css('color', '');
                parent.$("#btnFavoritarAba-" + numeroAba).attr('title', 'Favoritar Programa');
                parent.$("#btnFavoritarAba-" + numeroAba).attr('onclick', "alterarFavoritacaoPrograma('" + nomeAba + "','" + nomePrograma + "','" + idConteudo + "','" + controllerChamado + "','" + enderecoIcone + "','" + numeroAba + "')")

            }
        },
        error: function () {
        }
    });
}