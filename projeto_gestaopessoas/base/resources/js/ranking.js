/*******************************************************************************
 ************************** ADMIN CAMAROTE *****************************
 * 
 * RANKING 
 *
 * SSB.1.14.1.1 -> OUTUBRO 2015 -> MATHEUS FRANCISCO JASCHKE
 * 
 * 
 * 
 ******************************************************************************/

$(document).ready(function () {

    getRanking();
    moveRelogio();
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

function getRanking() {

    if ($("#tipo").val() == 'ESPECIFICAR') {
        $(".especificar-data").css('display', 'table-cell');
    } else {
        $(".especificar-data").css('display', 'none');
        $("#dataDe").val('');
        $("#dataAte").val('');
    }

    $("#resultado").html('');

    $.ajax({
        url: "index.php?m=base&c=homecontroller&f=getRanking",
        data: {
            tipo: $("#tipo").val(),
            dataDe: $("#dataDe").val(),
            dataAte: $("#dataAte").val()
        },
        type: "POST",
        dataType: "json",
        async: true,
        success: function (resultado) {

            $("#resultado").html(resultado);

        },
        error: function () {
            //alert('deu problema');
        }
    });
}

