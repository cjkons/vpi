// ADMIN CAMAROTE
// 
// BASE.JS - BLOQUEAR TELA
// 
//
// MATHEUS FRANCISCO JASCHKE
//

function bloquearTela() {

    $.blockUI({
        message: $('#login_desbloqueio_form'),
        css: {
            border: 'none',
            padding: '3px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: 1,
            color: 'white',
            top: '10%'
        },
        overlayCSS: {
            backgroundColor: '#fff',
            background: 'url(resources/login/img/bg.jpg) no-repeat center center fixed',
            opacity: 1,
            cursor: 'wait',
            '-webkit-background-size': 'cover',
            '-o-background-size': 'cover',
            '-moz-background-size': 'cover',
            'background-size': 'cover'
        }, });

    // ESCONDE A BARRA SUPERIOR
    $("#barra_superior").hide();

    // SETA EM BANCO QUE A SEÇÃO ESTÁ BLOQUEADA
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=bloquearTela",
        data: {},
        type: "POST",
        dataType: "json",
        async: true,
        cache: false,
        success: function(data) {

        },
        error: function() {
        }
    });
}

function desbloquearTela() {

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // VALIDAÇÕES
    if (username.trim() == "") {
        mensagem('Atenção', 'Insira seu usuário', 'alert')
        return false
    }

    if (password.trim() == "") {
        mensagem('Atenção', 'Insira seu senha', 'alert')
        return false;
    }

    $("#txtEntrar").html('Verificando...');
    $("#btnEntrar").attr('disabled', 'disabled');

    // VERIFICA SE USUÁRIO TEM CREDENCIAS CORRETAS
    $.ajax({
        url: 'index.php?m=login&c=login&f=logar',
        data: {
            login: username,
            senha: password,
            verificacaoBloqueio: 'S'
        },
        type: 'POST',
        dataType: 'text',
        async: true,
        cache: false,
        success: function(data) {

            if (data == 1) {
                $.unblockUI();
                $("#barra_superior").show();

                // SETA EM BANCO QUE A SEÇÃO ESTÁ DESBLOQUEADA
                $.ajax({
                    url: "index.php?m=base&c=basecontroller&f=desbloquearTela",
                    data: {},
                    type: "POST",
                    dataType: "json",
                    async: true,
                    cache: false,
                    success: function(data) {

                    },
                    error: function() {
                    }
                });

                $("#txtEntrar").html('Entrar');
                $("#btnEntrar").removeAttr('disabled');
                $("#username").val('');
                $("#password").val('');

            } else {
                mensagem('Atenção', 'A senha está incorreta', 'error');
                $("#txtEntrar").html('Entrar');
                $("#btnEntrar").removeAttr('disabled');
            }
        },
        error: function(data) {
            alertify.error("Houve um problema ao verificar as suas credenciais");
            $("#txtEntrar").html('Entrar');
            $("#btnEntrar").removeAttr('disabled');
        }
    });

}

function isSecaoBloqueada() {

// SETA EM BANCO QUE A SEÇÃO ESTÁ BLOQUEADA
    $.ajax({
        url: "index.php?m=base&c=basecontroller&f=isSecaoBloqueada",
        data: {},
        type: "POST",
        dataType: "json",
        async: true,
        cache: false,
        success: function(data) {
            if (data == true) {
                window.location = 'index.php?m=login&c=login&f=logoff&redirect=base';
            }
        },
        error: function() {
        }
    });

}

function enter(e) {
    var key = e.keyCode || e.which;
    if (key == 13) {
        desbloquearTela();
    }
}