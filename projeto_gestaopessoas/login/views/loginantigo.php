<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>VPI Gestão</title>

        <meta charset="UTF-8"/>

        <!--JQUERY 1.11-->
        <link href="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.css" rel="stylesheet">
        <script src="resources/geral/jquery/jquery-1.11.1.min.js"></script>
        <script src="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.js"></script>
        <!--JQUERY 1.11-->

        <!--NOTIFICAÇÕES-->
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/notificacoes/pnotify.custom.min.css" rel="stylesheet">
        <script src="resources/geral/notificacoes/pnotify.custom.min.js"></script>
        <!--NOTIFICAÇÕES-->

        <!--BOOSTRAP 3.3.0--> 
        <link href="resources/geral/bootstrap/css/cosmo-theme/bootstrap.min.css" rel="stylesheet">
        <script src="resources/geral/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--BOOSTRAP 3.3.0--> 

        <!--LOGIN-->
        <link href="resources/login/css/login.css" rel="stylesheet">
        <script src="resources/login/js/login.js"></script>
        <script src="resources/geral/geral.js"></script>
        <!--LOGIN-->
    </head> 

    <body style='background: url(resources/login/img/login.jpg) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;'>

        <input type="hidden" id="url" value="<?= isset($url) ? $url : "index.php?m=login" ?>" />


        <h1 style='padding-top: 60px;' class='form-signin-heading'>VPI Gestão <br>Seja bem-vindo<br /><span class="form-signin-heading-2"></span></h1>

            <div class="wrapper">
                <div class="form-signin"  align='center'>

                    <!--<img style="width: 50%;" align="center" src="resources/login/img/v.png"/>-->

                    <h2>Credenciais</h2>

                    <div class="input-group">
                        <span class="input-group-addon"><i class='glyphicon glyphicon-user' ></i></span>
                        <input onkeypress="enter(event)" type="text" class="form-control" id="username" placeholder="Usuário/Email" required="" autofocus="" />
                    </div>    

                    <div class="input-group">
                        <span class="input-group-addon"><i class='glyphicon glyphicon-lock' ></i></span>
                        <input onkeypress="enter(event)" type="password" class="form-control" id="password" placeholder="Senha" required=""/>      
                    </div>    
                    <br />
                    <button id="btnEntrar" class="btn btn-md btn-primary btn-block" onclick="logar()"><i class='fa fa-location-arrow'></i> Entrar</button>   
                </div>
            </div>
       
       <div style='bottom:0;width:100%;height:40px;' align='center' class='form-signin-heading'>
            VPI© 2016 - TODOS OS DIREITOS RESERVADOS
        </div>

    </body>
</html>