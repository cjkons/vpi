/////////////////////////////////////////////
//VPI GESTAO                           //
//Login - Versão 1.01                    ///  
//Desenvolvido por Matheus Jaschke       //  
//Janeiro de 2016                        //   
//////////////////////////////////////////
var global_url;

function logar() {
    
    

    var username = document.getElementById('u251-2').value;
    var password = document.getElementById('u254-2').value;

    // VALIDAÇÕES
    if (username.trim() == "") {
        mensagem('Atenção', 'Insira seu usuário', 'alert')
        return false
    }

    if (password.trim() == "") {
        mensagem('Atenção', 'Insira seu senha', 'alert')
        return false;
    }

    $("#u259-4").html("<span class='fa fa-spinner fa-pulse'></span> Entrando...");
    $("#u259-4").attr('disabled', 'disabled');

    // VERIFICA SE USUÁRIO TEM CREDENCIAS CORRETAS
    $.ajax({
        url: 'index.php?m=login&c=login&f=logar',
        data: {
            login: username,
            senha: password
        },
        type: 'POST',
        dataType: 'text',
        async: true,
        cache: false,
        success: function (data) {
            
         
            if (data == 1) {
                $("#btnEntrar").html("<span class='fa fa-thumbs-up'></span> Credenciais Aprovadas");
                $("#btnEntrar").attr('disabled', 'disabled');
                var url = $('#url').val() == "" ? "http://localhost/index.php?m=base" : $('#url').val();
                global_url = url;
                window.location = global_url;
            } else {
                mensagem('Atenção', 'A senha está incorreta', 'error');
                $("#btnEntrar").html("<i class='fa fa-location-arrow'></i> Entrar");
                $("#btnEntrar").removeAttr('disabled');
            }
        },
        error: function (data) {
            alertify.error("Houve um problema ao verificar as suas credenciais");
            $("#btnEntrar").html("<i class='fa fa-location-arrow'></i> Entrar");
            $("#btnEntrar").removeAttr('disabled');
        }
    });
}

function enter(e) {
    var key = e.keyCode || e.which;
    if (key == 13) {
        logar();
    }
}

