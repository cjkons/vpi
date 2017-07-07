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

        <!--MENU-->
        <link href="resources/geral/menu/simple-sidebar.css" rel="stylesheet">
        <!--MENU-->

        <!--NOTIFICAÇÕES-->
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/notificacoes/pnotify.custom.min.css" rel="stylesheet">
        <script src="resources/geral/notificacoes/pnotify.custom.min.js"></script>
        <!--NOTIFICAÇÕES-->

        <!--BOOSTRAP 3.3.0--> 
        <link href="resources/geral/bootstrap/css/cerulean-theme/bootstrap.min.css" rel="stylesheet">
        <script src="resources/geral/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--BOOSTRAP 3.3.0--> 

        <!--MORPHTEXT-->
        <link href="resources/geral/morphext/morphext.css" rel="stylesheet">
        <link href="resources/geral/morphext/animate.css" rel="stylesheet">
        <script src="resources/geral/morphext/morphext.min.js" type="text/javascript"></script>
        <!--MORPHTEXT-->

        <!--DATEPICKER-->
        <link href="resources/geral/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
        <script src="resources/geral/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="resources/geral/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js" type="text/javascript"></script>
        <!--DATEPICKER-->

        <!--CHAT-->
        <link type="text/css" rel="stylesheet" media="all" href="resources/geral/chat/chat.css" />
        <script type="text/javascript" src="resources/geral/chat/chat.js"></script>
        <!--CHAT-->

        <!--BLOCKUI-->
        <script src="resources/geral/blockUI/jquery.blockUI.js" type="text/javascript"></script>
        <!--BLOCKUI-->

        <!--HOME-->
        <script src="resources/base/js/ranking.js"></script>
        <script src="resources/geral/geral.js"></script>
        <!--HOME-->

    </head>

    <body>

        <div style='width: 100%; padding: 10px;'>

            <div align='center' class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><h2>RANKING DA OPERAÇÃO</h2></h3>
                </div>
                <div class="panel-body">
                    <table align='center' style='width: 80%;'>
                        <tr>
                            <td align='center' style='width: 120px;'>
                                <div class="input-group input-group-md">
                                    <select onchange="getRanking()" id='tipo' style='width: 100%;min-width: 200px;' class='form-control'>
                                        <option value='HOJE'>Hoje</option>
                                        <option value='SEMANA'>Esta Semana</option>
                                        <option value='MES'>Este Mês</option>
                                        <option value='ANO'>Este Ano</option>
                                        <option value='ESPECIFICAR'>Especificar Datas</option>
                                    </select>
                                    <div class="input-group-btn">
                                        <button class="btn btn-md btn-success" onclick="getRanking()"><span class="fa fa-refresh"></span></button>
                                    </div>
                                </div>
                            </td>
                            <td class="especificar-data" align="right" style="width: 70px;padding-right: 10px;">
                                De:
                            </td>
                            <td class="especificar-data" style="width: 200px;">
                                <input id='dataDe' placeholder=" data inicial " style="width: 100%;" class="form-control datepicker"/>
                            </td>
                            <td class="especificar-data" align="right" style="width: 45px;padding-right: 10px;">
                                Até:
                            </td>
                            <td class="especificar-data" style="width: 200px;">
                                <div class="input-group input-group-md">
                                    <input id='dataAte' placeholder=" data final " style="width: 100%;" class="form-control datepicker"/>
                                    <div class="input-group-btn">
                                        <button onclick="getRanking()" class="btn btn-md btn-success"><span class="fa fa-check-square-o"></span></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div id='resultado'></div>


    </body>
</html>