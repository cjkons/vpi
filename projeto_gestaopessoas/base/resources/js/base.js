///////////////////////////////////////////////
/// BASE - TELA PRINCIPAL                   ///
/// CLARIFY - GESTAO DE PESSOAS             ///   
/// Desenvolvido por HEITOR SIQUEIRA        ///
/// JULHO DE 2017                           ///
/// VPI TECNOLOGIA                          ///
///////////////////////////////////////////////

var _idUsuarioLogado = 0;
var numeroDeAbas = 0;

$(document).ready(function () {
    
   
    carregaIcones();
       

    // ANIMAR TOPO
    $("#base_titulo").Morphext({
        animation: "fadeIn",
        separator: ",",
        speed: 10000
    });

//    $("#base_titulo_motivacional").Morphext({
//        //animation: "flip",
//        separator: ",",
//        speed: 4000
//    });

    // VERIFICA SE A SEÇÃO FOI BLOQUEADA
    //isSecaoBloqueada();

    // ADICIONA DINAMICAMENTE A PRIMEIRA ABA 
    // COMO A DE DESKTOP, COM OS ÍCONES FAVORITOS E WIDGETS
    adicionarAbaDesktop();

    // INICIAR CHAT, SETA COMO USUARIO ESTÁ ATIVO
    //iniciarChat();

    // CARREGA OS ÍCONES FAVORITADOS
   

    // CARREGA A LISTA DE USUARIOS DO CHAT
    //getListaUsuariosChat();

    //
    $(window).bind('resize', function () {

        //seta o tamanho do iframe de acordo com o tamanho redimensionavel em tela
        $(".frameAba").height($(window).height() - 100);
    }).trigger('resize');
    
    
    //getUsuarioLogado();
    
    
    //teste bootstrap
    
    var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
    
  
});



function getUsuarioLogado(){
    
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=getIdUsuarioLogado",
        type: "POST",
        dataType: "json",
        async: true,
        cache: false,
        success: function (retorno) {
            _idUsuarioLogado = retorno;
        },
        error: function () {

        }
    });
    
}

function click_menu(id) {

    var v = document.getElementsByClassName('in');

    for (var i = 0; i < v.length; i++) {

        if (v[i].id != id) {
            $(v[i]).addClass('collapsing');

            $(v[i]).removeClass('collapse');
            $(v[i]).removeClass('in');
        }
    }

}

function clickBtnChat() {

    $("#base_btnChat").blur();
    if ($('#chat').css('right') == "0px") {
        $('#chat').animate({right: "-300px"}, 200);
    } else {
        $('#chat').animate({right: "0px"}, 200);
    }


}

function esconderBarraChat() {

    $('#chat').animate({right: "-300px"}, 200);
}

function exibirInputBusca() {

    $("#inputBing").val('');
    $("#inputBing").css('display', 'inline');
    $("#inputBing").animate({
        marginLeft: 0,
        width: 250
    }, 200, function () {
        $("#inputBing").focus();
    });
}

function esconderInputBusca() {

    $("#inputBing").animate({
        marginLeft: 250,
        width: -100
    }, 100, function () {
        $("#inputBing").css('display', 'none');
    });
}

function buscarNoBing(e) {

    if (e.keyCode == 13) {

        var rand = Math.floor((Math.random() * 999999999) + 1);
        ;
        var nome = 'nome' + rand;
        var conteudo = 'conteudo' + rand;
        adicionarAbaSemFavorito("Pesquisa Bing", nome, conteudo, "http://www.bing.com/search?q=" + $("#inputBing").val())
    }
}

// FUNÇÃO QUE MUDA A VISUALIZAÇÃO DO MENU ESQUERDO
function toggleMenuEsquerdo() {
    $("#wrapper").toggleClass("toggled");
}

// FUNÇÃO QUE ADICIONA A ABA DE DESKTOP AO SISTEMA
function adicionarAbaDesktop() {
    
   
       document.getElementById('listAFAVORITOS').innerHTML = ' ';
    
    var nextTab = $('#listaAbas li').size() + 1;
    // cria a aba
    $('<li id="aba-' + 'home' + '">\n\
            <a id="irConteudoAba-' + 'home' + '" href="#conteudoAba-home" data-toggle="tab">Área de Trabalho\n\
                <span title="Área de Trabalho" style="color: black; cursor: alias;padding-left: 5px;font-size: 1.2em "class="glyphicon glyphicon-home"></span>\n\
            </a>\n\
        </li>').appendTo('#listaAbas');
    // cria o conteúdo da aba
    $('<div style="height: 100%;" class="tab-pane active" id="conteudoAba-' + 'home' + '"><iframe class="frameAba" style="width: 100%;" frameBorder="0" id="frameAba-' + 'home' + '"></iframe></div>').appendTo('#listaConteudoAbas');
    // ativa a última aba (criada)
    $('#listaAbas a:last').tab('show');
    $(".frameAba").height($(window).height() - 0); 
    document.getElementById('frameAba-' + 'home').src = 'index.php?m=base&c=logocontroller';

}

// FUNÇÃO QUE ADICIONA ABA E ABRE O CONTEUDO PASSADO POR PARÂMETRO
function adicionarAba(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone) {
   
   //document.getElementById('listaConteudoAbas').innerHTML = '';
   
       document.getElementById('listAFAVORITOS').innerHTML = ' ';
   
   numeroDeAbas = numeroDeAbas + 1;

    if (programaJaAberto(nomePrograma)) {

        var aba = getElementsByIdStartsWith("li", "aba-" + nomePrograma);
        $("#irConteudoAba-" + nomePrograma).click();
    } else {

        var numeroAba = $('#listaAbas li').size() + 1;
        // cria a aba
        $('<li id="aba-' + nomePrograma + '">\n\
            <a id="irConteudoAba-' + nomePrograma + '" href="#conteudoAba-' + nomePrograma + '"  style="text-decoration:none" data-toggle="tab">' + nomeAba + '\
                <span id="btnFecharAba-' + numeroAba + '" onclick="fecharAba(' + "'" + nomePrograma + "'" + ')" title="Fechar Aba" style="color: #990004; cursor: alias;padding-left: 5px;font-size: 1.2em "class="glyphicon glyphicon-remove"></span>\n\
                <span id="btnFavoritarAba-' + numeroAba + '" onclick="isProgramaFavorito(' + "'" + nomeAba + "'" + ',' + "'" + nomePrograma + "'" + ', '+ "'" + idConteudo + "'" + ','+ "'" + controllerChamado + "'" + ','+ "'" + enderecoIcone + "'" + ','+ "'" + numeroAba + "'" + ')" title="Favoritar Aba" style="cursor: alias;font-size: 1.2em "class="glyphicon glyphicon-star-empty"></span>\n\
        </a>\n\
        </li>').appendTo('#listaAbas');
        // cria o conteúdo da aba
        $('<div style="height: 100%;" class="tab-pane" id="conteudoAba-' + nomePrograma + '"><iframe class="frameAba" style="width: 100%;" frameBorder="0" id="frameAba-' + nomePrograma + '"></iframe></div>').appendTo('#listaConteudoAbas');
        // ativa a última aba (criada)
        $('#listaAbas a:last').tab('show');
        $(".frameAba").height($(window).height() - 0);
        document.getElementById('frameAba-' + nomePrograma).src = controllerChamado;
        isProgramaFavorito(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone, numeroAba);
    }

}

// FUNÇÃO QUE ADICIONA ABA E ABRE O CONTEUDO PASSADO POR PARÂMETRO SEM A OPÇÃO DE ICONE PARA FAVORITAÇÃO
function adicionarAbaSemFavorito(nomeAba, nomePrograma, idConteudo, controllerChamado) {
    
    
    
    if (programaJaAberto(nomePrograma)) {

        var aba = getElementsByIdStartsWith("li", "aba-" + nomePrograma);
        $("#irConteudoAba-" + nomePrograma).click();
    } else {

        var numeroAba = $('#listaAbas li').size() + 1;
        // cria a aba
        $('<li id="aba-' + nomePrograma + '">\n\
            <a id="irConteudoAba-' + nomePrograma + '" href="#conteudoAba-' + nomePrograma + '"  style="text-decoration:none" data-toggle="tab">' + nomeAba + '\
                <span id="btnFecharAba-' + numeroAba + '" onclick="fecharAba(' + "'" + nomePrograma + "'" + ')" title="Fechar Aba" style="color: #990004; cursor: alias;padding-left: 5px;font-size: 1.2em "class="glyphicon glyphicon-remove"></span>\n\
        </a>\n\
        </li>').appendTo('#listaAbas');
        // cria o conteúdo da aba
        $('<div style="height: 100%;" class="tab-pane" id="conteudoAba-' + nomePrograma + '"><iframe class="frameAba" style="width: 100%;" frameBorder="0" id="frameAba-' + nomePrograma + '"></iframe></div>').appendTo('#listaConteudoAbas');
        // ativa a última aba (criada)
        $('#listaAbas a:last').tab('show');
        $(".frameAba").height($(window).height() - 0);
        document.getElementById('frameAba-' + nomePrograma).src = controllerChamado;
    }

}


// FUNÇÃO PARA FECHAR A ABA E DESTRUIR SEU CONTEUDO
function fecharAba(idAba) {

    $("#aba-" + idAba).remove();
    $("#conteudoAba-" + idAba).remove();
    $("#frameAba-" + idAba).remove();
    // ativa a última aba
    $('#listaAbas a:last').tab('show');
    
    var qtdAbas = parent.$("ul#indices li").length;
    var nroAba = qtdAbas + 1;
    
    if(numeroDeAbas > 0){
        numeroDeAbas = numeroDeAbas - 1;
    }
    
 
 
    if(numeroDeAbas < 1){
        carregaIcones();
    }
    
    
}

// FUNÇÃO QUE RETORNA TODOS OS ELEMENTOS DO DOM PELO TIPO DE ELEMENTO HTML
// E QUE COMECEM COM UM PREFIXO DEFINIDO POR PARÂMETRO
function getElementsByIdStartsWith(container, selectorTag, prefix) {
    var items = [];
    var myPosts = document.getElementById(container).getElementsByTagName(selectorTag);
    for (var i = 0; i < myPosts.length; i++) {
//omitting undefined null check for brevity
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
                $("#btnFavoritarAba-" + numeroAba).removeClass('glyphicon-star-empty');
                $("#btnFavoritarAba-" + numeroAba).addClass('glyphicon-star');
                $("#btnFavoritarAba-" + numeroAba).css('color', '#fff384');
                $("#btnFavoritarAba-" + numeroAba).css('border', 'solid 5px black;');
                $("#btnFavoritarAba-" + numeroAba).attr('title', 'Desfavoritar Programa');
                $("#btnFavoritarAba-" + numeroAba).attr('onclick', "alterarFavoritacaoPrograma('" + nomeAba + "','" + nomePrograma + "','" + idConteudo + "','" + controllerChamado + "','" + enderecoIcone + "','" + numeroAba + "')")
            } else {
                // programa não é favorito
                $("#btnFavoritarAba-" + numeroAba).removeClass('glyphicon-star');
                $("#btnFavoritarAba-" + numeroAba).addClass('glyphicon-star-empty');
                $("#btnFavoritarAba-" + numeroAba).css('color', '');
                $("#btnFavoritarAba-" + numeroAba).attr('title', 'Favoritar Programa');
                $("#btnFavoritarAba-" + numeroAba).attr('onclick', "alterarFavoritacaoPrograma('" + nomeAba + "','" + nomePrograma + "','" + idConteudo + "','" + controllerChamado + "','" + enderecoIcone + "','" + numeroAba + "')")

            }
        },
        error: function () {
        }
    });
}

// ALTERA O STATUS DE FAVORITAÇÃO DO PROGRAMA
// CASO ESTEJA FAVORITO ELE RETIRA
function alterarFavoritacaoPrograma(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone, numeroAba) {

    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=alterarFavoritacaoPrograma",
        data: {
            nomeAba: nomeAba,
            nomePrograma: nomePrograma,
            idConteudo: idConteudo,
            controllerChamado: controllerChamado,
            enderecoIcone: enderecoIcone
        },
        type: "POST",
        dataType: "json",
        async: true,
        cache: false,
        success: function (retorno) {
            isProgramaFavorito(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone, numeroAba)
        },
        error: function () {

        }
    });
}

// INICIA O CHAT, SETANDO COMO IS_ATIVO = TRUE
function iniciarChat() {

    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=iniciarChat",
        data: {},
        type: "POST",
        dataType: "json",
        async: true,
        success: function (retorno) {

        },
        error: function () {

        }
    });
}

// CARREGA A LISTA DE USUÁRIOS A SER EXIBIDO EM TELA
function getListaUsuariosChat() {

    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=getListaUsuariosChat",
        data: {},
        type: "POST",
        dataType: "json",
        async: false,
        success: function (retorno) {
            if (retorno !== false) {
                document.getElementById('chat_listaUsuarios').innerHTML = retorno;
            } else {
                document.getElementById('chat_listaUsuarios').innerHTML = 'ERRO :(';
            }
        },
        error: function () {
            document.getElementById('chat_listaUsuarios').innerHTML = 'ERRO :(';
        }
    });

    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=getListaUsuariosChat_Opcoes",
        data: {},
        type: "POST",
        dataType: "json",
        async: false,
        success: function (retorno) {
            if (retorno !== false) {
                document.getElementById('chat_listaUsuarios_opcoes').innerHTML = retorno;
            } else {
                document.getElementById('chat_listaUsuarios_opcoes').innerHTML = 'ERRO :(';
            }
        },
        error: function () {
            document.getElementById('chat_listaUsuarios_opcoes').innerHTML = 'ERRO :(';
        }
    });

}

function chat_alterarStatus(novoStatus) {

    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=chat_alterarStatus",
        data: {
            novoStatus: novoStatus
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (retorno) {
            getListaUsuariosChat();
            clickBtnChat();
        },
        error: function () {
        }
    });

}

// FUNÇÃO CHAMADO QUANDO A PÁGINA É FECHADA NO NAVEGADOR
$(window).unload(function () {


    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=sair",
        data: {},
        type: "POST",
        dataType: "json",
        async: false,
        cache: false,
        success: function (retorno) {

        },
        error: function () {

        }
    });

});






















function carregaIcones() {

// carrega os icones que estao salvos no perfil do usuário


    
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=getIconesSalvos",
        data: {
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (listaIcones) {

           

            for (var i = 0; i < 25; i++){
               
                var nomeIcone = 'icone' + listaIcones[i]['ID'];
                var nomeAba = listaIcones[i]['NOME_ABA'];
                var nomePrograma = listaIcones[i]['NOME_PROGRAMA'];
                var idConteudo = listaIcones[i]['ID_CONTEUDO'];
                var controllerChamado = listaIcones[i]['CONTROLLER_CHAMADO'];
                var x = listaIcones[i]['X'];
                var y = listaIcones[i]['Y'];
                
                switch (i) {

                    case 0:
                        var y = parseInt(y) - parseInt(51);
                        break;
                    case 1:
                        var y = parseInt(y) - parseInt(152);
                        break;
                    case 2:
                        var y = parseInt(y) - parseInt(254);
                        break;
                    case 3:
                        var y = parseInt(y) - parseInt(373);
                        break;
                    case 4:
                        var y = parseInt(y) - parseInt(475);
                        break;
                    case 5:
                        var y = parseInt(y) - parseInt(578);
                        break;
                    case 6:
                        var y = parseInt(y) - parseInt(696);
                        break;
                    case 7:
                        var y = parseInt(y) - parseInt(797);
                        break;
                    case 8:
                        var y = parseInt(y) - parseInt(878);
                        break;
                    case 9:
                        var y = parseInt(y) - parseInt(980);
                        break;
                    case 10:
                        var y = parseInt(y) - parseInt(1101);
                        break;
                    case 11:
                        var y = parseInt(y) - parseInt(1202);
                        break;
                    case 12:
                        var y = parseInt(y) - parseInt(1303);
                        break;
                    case 13:
                        var y = parseInt(y) - parseInt(1404);
                        break;
                    case 14:
                        var y = parseInt(y) - parseInt(1524);
                        break;
                    case 15:
                        var y = parseInt(y) - parseInt(1644);
                        break;
                    case 16:
                        var y = parseInt(y) - parseInt(1744);
                        break;
                    case 17:
                        var y = parseInt(y) - parseInt(1846);
                        break;
                    case 18:
                        var y = parseInt(y) - parseInt(1966);
                        break;
                    case 19:
                        var y = parseInt(y) - parseInt(2067);
                        break;
                    case 20:
                        var y = parseInt(y) - parseInt(2168);
                        break;
                    case 21:
                        var y = parseInt(y) - parseInt(2288);
                        break;
                    case 22:
                        var y = parseInt(y) - parseInt(2428);
                        break;
                    case 23:
                        var y = parseInt(y) - parseInt(2530);
                        break;
                    case 24:
                        var y = parseInt(y) - parseInt(2533);
                        break;
                    case 25:
                        var y = parseInt(y) - parseInt(2630);
                        
                        
                        
                 
                }

                
                
                
                var enderecoIcone = listaIcones[i]['ENDERECO_ICONE'];
                var icone = "<div  id='" + nomeIcone.trim() + "' style='width: 0%;height: 0%;'>\n\
                <table class='icone' style='width: 64px;'>\n\
                    <tr>\n\
                        <td class='tdIcone'>\n\
                            <div class='divIcone' style='width: 80px' ondblclick='\n\
                                                                                    adicionarAba(\"" + nomeAba.trim() + "\", \"" + nomePrograma.trim() + "\", \"" + idConteudo.trim() + "\", \"" + controllerChamado.trim() + "\",\"" + enderecoIcone.trim() + "\");'>\n\
                            <div>\n\
                                <img src='" + enderecoIcone.trim() + "' style='width:64px; height: 64px;' title='" + nomeAba.trim() + "'/>\n\
                            </div>\n\
                            <div class='arredondaDiv'  id='nomeAba" + nomeIcone.trim() + "'  style='margin-left: -20px;margin-top: 5px; text-align : center ; background-color: transparent;'>" + nomeAba.trim() + "</div>\n\
                            </div>\n\
                        </td>\n\
                        <td style='vertical-align: top;'>\n\
                            <img onclick='removerIcone(\"" + nomeIcone.trim() + "\",\"" + nomeAba.trim() + "\")' src='resources/base/img/close_icon.png' style='margin-left: -20px;margin-top: -15px;width:16px;height:16px;' title='Remover Atalho'/>\n\
                        </td>\n\
                    </tr>\n\
                </table>\n\
            </div>";
               // alert(icone);
                
             //   document.getElementById('listaConteudoAbas').innerHTML = icone;
              
                $("#listAFAVORITOS").append(icone);
                // caso os valores de X e Y estiverem diferentes de nullo
                // move o icone para o local correto

                if (x != null && y != null && y != undefined && y != undefined) {

                    $("#" + nomeIcone).animate({left: x, top: y}, 1200);
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
                        //alert($(this).attr('id'));
                    }

//                    stop: function() {
//                        document.getElementById('btnLocalizacao').innerHTML = 'Acabou!';
//                        atualizaLocal(nomeIcone, nomeAba);
//                    }

                });
            }
            x = 0;
            y = 0;
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
        url: "index.php?m=base&c=basecontroller&f=atualizaLocal",
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
                alert('Problema ao atualizar a posição do ícone :(');
            }
        },
        error: function () {
            alert('Problema ao atualizar a posição do ícone :(');
        }
    });
}

function removerIcone(idIcone, nomeAba) {

    nomeAba = nomeAba + "";
    $("#" + idIcone).hide("highlight");
    $("#" + idIcone).remove();
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=removerFavorito",
        data: {
            nomeAba: nomeAba
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (retorno) {
            if (retorno == false) {
                alert('Problema ao remover ícone :(');
            }else{
                alert('Icone removido :)');
            }
        },
        error: function () {
            alert('Problema ao remover ícone :(');
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

var numAbaSelecionada = 0;
var abaAnteriorMarcada = false;
function programaJaAberto(nomePrograma) {

    var abasComPrograma = getElementsByIdStartsWith("li", "aba-" + nomePrograma);
    if (abasComPrograma.length > 0) {
        return true;
    } else {
        return false;
    }
}

function criaAba(nomeAba, nomePrograma, idConteudo, controllerChamado, enderecoIcone) {
    
    
    
    document.getElementById('listAFAVORITOS').innerHTML = ' ';

    if (programaJaAberto(nomePrograma)) {

        var aba = parent.getElementsByIdStartsWith("a", "aba_" + nomePrograma);
        parent.$("#" + aba[0].id).trigger("click");
    } else {

        var qtdAbas = parent.$("ul#indices li").length;
        if (qtdAbas < 5) {

            var nroAba = qtdAbas + 1;
            parent.$("#abas").tabs("destroy");
            parent.$("#indices").append("<li id='item_" + nroAba + "'>\n\
                                            <a id='aba_" + nomePrograma + "-" + nroAba + "' href='#div_" + nroAba + "' onclick='guardaNumeroAbaSelecionada(" + nroAba + ")'>" + nomeAba + "</a>\n\
                                                <span>\n\
                                                    <img id='imgFavorito" + nroAba + "' onclick='favoritaAba(" + nroAba + ")' class='favoriteAba pointer' width='20px' height='20px' style='padding-top: 3px;padding-left:-3px; padding-right: 3px'/>\n\
                                                    <div style='display: none' id='parametrosFavoritar" + nroAba + "'>" + nomeAba + "|" + nomePrograma + "|" + idConteudo + "|" + controllerChamado + "|" + enderecoIcone + "</div>\n\
                                                </span>\n\
                                                <span>\n\
                                                    <img onclick='excluiAba(" + nroAba + ")' class='fechaAba pointer' width='20px' height='20px' style='padding-top: 3px; padding-right: 3px'/>\n\
                                                </span>\n\
                                        </li>");
            
            
            
            parent.$("#listaAbas").append("<div id='div_" + nroAba + "' align='center' style='height:98%;'>\n\
                                                <iframe style='width: 100%; height:100%;' id='" + idConteudo + "' class='conteudo'>\n\
                                                </iframe>\n\
                                            </div>");
            parent.$("#abas").tabs();
            parent.$("#aba_" + nomePrograma + "-" + nroAba).trigger("click");
            parent.document.getElementById(idConteudo).src = controllerChamado;
            verificaSeAbaEFavorita(nroAba);
        } else {
            alert("É permitido abrir no máximo 5 programas simultâneamente.");
        }
    }
}

function guardaNumeroAbaSelecionada(nroAbaSelecionada) {
    numAbaSelecionada = nroAbaSelecionada;
}

function fechaTodasAbas() {

    var divsAbas = parent.$("div#listaAbas div");
    for (var i = 0; i < divsAbas.length; i++) {

        var idDiv = divsAbas[i].id;
        var pos = idDiv.indexOf("_");
        var nroReferencia = idDiv.substring(pos + 1, idDiv.length);
        parent.$("#item_" + nroReferencia).remove();
        parent.$("#" + divsAbas[i].id).remove();
    }

    parent.$("#abas").tabs("destroy");
}

function excluiAba(numeroAbaPraRemover) {

    parent.$("#item_" + numeroAbaPraRemover).remove();
    var divsAbas = parent.$("div#listaAbas div");
    for (var i = 0; i < divsAbas.length; i++) {

        var idDiv = divsAbas[i].id;
        var pos = idDiv.indexOf("_");
        var nroReferencia = idDiv.substring(pos + 1, idDiv.length);
        if (nroReferencia == numeroAbaPraRemover) {
            parent.$("#" + divsAbas[i].id).remove();
        }
    }

    if (numAbaSelecionada == numeroAbaPraRemover) {

        var abaAnteriorSelecionada = selecionaAbaAnterior(numeroAbaPraRemover);
        if (abaAnteriorSelecionada == false) {
            selecionaAbaPosterior();
        }
    }

    var todasAbas = parent.document.getElementsByIdStartsWith("a", "aba_");
    if (todasAbas.length == 0) {
        parent.$("#abas").tabs("destroy");
    }
}

function selecionaAbaAnterior(numeroAba) {

    abaAnteriorMarcada = false;
    var todasAbas = parent.document.getElementsByIdStartsWith("a", "aba_");
    for (var j = todasAbas.length; j > 0; j--) {

        var idAba = todasAbas[j - 1].id;
        var pos = idAba.indexOf("-");
        var indiceAba = idAba.substring(pos + 1, idAba.length);
        if (indiceAba < numeroAba) {

            parent.$("#" + todasAbas[j - 1].id).trigger("click");
            abaAnteriorMarcada = true;
            break;
        }
    }

    return abaAnteriorMarcada;
}

function selecionaAbaPosterior() {

    var todasAbas = parent.document.getElementsByIdStartsWith("a", "aba_");
    for (var j = 0; j < todasAbas.length; j++) {

        parent.$("#" + todasAbas[j].id).trigger("click");
        break;
    }
}

function getElementsByIdStartsWith(selectorTag, prefix) {

    var items = [];
    var myPosts = parent.document.getElementsByTagName(selectorTag);
    for (var i = 0; i < myPosts.length; i++) {

        if (myPosts[i].id.lastIndexOf(prefix, 0) === 0) {
            items.push(myPosts[i]);
        }
    }
    return items;
}


function verificaSeAbaEFavorita(nroAba) {

    var strParametros = parent.document.getElementById('parametrosFavoritar' + nroAba).innerHTML;
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=isAbaFavorita",
        data: {
            strParametros: strParametros
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (resultado) {

            if (resultado == true) {
                // alterar imagem de favorito

                parent.$("#imgFavorito" + nroAba).removeClass('favoriteAba');
                parent.$("#imgFavorito" + nroAba).addClass('desfavoriteAba');
                // adicionar icone na área de trabalho
            } else {
                // alterar imagem de favorito
                parent.$("#imgFavorito" + nroAba).removeClass('desfavoriteAba');
                parent.$("#imgFavorito" + nroAba).addClass('favoriteAba');
                // retirar icone na área de trabalho
            }

        },
        error: function () {

        }
    });
}


