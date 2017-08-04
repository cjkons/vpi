<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>VPI | Clarify</title>
        <meta charset="UTF-8"/>

        <!--PROGRESS BAR-->
        <script src="resources/geral/progress-bar/pace.min.js"></script>
        <link href="resources/geral/progress-bar/dataurl.css" rel="stylesheet">
        <!--PROGRESS BAR-->

        <!--JQUERY 1.11-->
        <link href="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.css" rel="stylesheet">
        <script src="resources/geral/jquery/jquery-1.11.1.min.js"></script>
        <script src="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.js"></script>
        <!--JQUERY 1.11-->

        <!--NOTIFICAÇÕES-->
        <link href="resources/geral/notificacoes/pnotify.custom.min.css" rel="stylesheet">
        <script src="resources/geral/notificacoes/pnotify.custom.min.js"></script>
        <!--NOTIFICAÇÕES-->

        <!--BOOSTRAP 3.3.0--> 
        <link href="resources/geral/bootstrap/css/cerulean-theme/bootstrap.min.css" rel="stylesheet">
        <script src="resources/geral/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--BOOSTRAP 3.3.0--> 

        <!--DATEPICKER-->
        <link href="resources/geral/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
        <script src="resources/geral/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="resources/geral/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js" type="text/javascript"></script>
        <!--DATEPICKER-->

        <!--BLOCKUI-->
        <script src="resources/geral/blockUI/jquery.blockUI.js" type="text/javascript"></script>
        <!--BLOCKUI-->

        <!--GRID-->
        <link href="resources/geral/grid/css/dataTables.bootstrap.css" rel="stylesheet">
        <script src="resources/geral/grid/js/jquery.dataTables.min.js"></script>
        <script src="resources/geral/grid/js/dataTables.bootstrap.js"></script>
        <!--GRID-->

        <!--GERAL-->
        <link href="resources/cadastrosetor/css/teste.css" rel="stylesheet">
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        <link href="resources/boletimcaminhaobetoneira/css/zoom.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/cadastrosetor/js/cadastrosetor.js"></script>
        <!-- CADASTRO EVENTO -->
    </head>

    <body style="zoom: 85%;">
        <nav class="navbart">
            <div class="container-fluid" align="center">

                <a onclick="novo()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-file"></span>  Novo 
                </a>
               
                <a onclick="salvar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                </a>
                
                
                <a onclick="validarExcluir()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-trash"></span> Excluir
                </a>
                <a onclick="atualizar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>




            </div>
        </nav>
        <br> 
        <div class="container" align="center" style="width: 90%;">
            <fieldset class="fieldset-border">
                <legend class="legend-border" >Dados Setor</legend>
        <table style="width: 50%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
            <tr>
                <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        ID
                        <input style="text-transform: uppercase;" type="text" class="form-control" id="id"    placeholder="ID" readonly>
                    </div>
                </td>
                
               <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        Setor
                        <input type="text" class="form-control" id="setor"   placeholder="Setor" readonly >
                    </div>
                </td>
                
                




            </tr>
        </table>
    </fieldset>    
        </div>

        <br><br>
        <HR WIDTH=100%>
        
        
        <table id="tabelaCadastro1" style="width: 50%; border-collapse: collapse" cellpadding="0" cellspacing="2px" align="center" >                    

         
            <!-- Modal para botão Excluir -->
    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Excluir</h4>
          </div>
          <div class="modal-body">
              <p><h4> Tem certeza que deseja excluir ?</h4></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Sair</button>
            <button type="button" onclick="excluir()"class="btn btn-primary" data-dismiss="modal">Excluir</button>
          </div>
        </div>
      </div>
    </div>

        </body>
</html>