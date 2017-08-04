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

        <link href="resources/relatorioaniversario/css/teste.css" rel="stylesheet">
        
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
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->
        
        <!--GERAL AJUSTE RESPONSIVO TABELA E TEXTO-->
        <link href="resources/relatorioatestado/css/campos.css" rel="stylesheet">
        <link href="resources/relatorioatestado/css/texto.css" rel="stylesheet">
        <link href="resources/relatorioatestado/css/teste.css" rel="stylesheet">
        <!--GERAL-->

        <!-- RELATÓRIO CONTAS A PAGAR -->
        <link href="resources/relatorioatestado/css/estilomodal.css" rel="stylesheet">
        <script src="resources/relatorioatestado/js/relatorioatestado.js"></script>
        
        
        <!-- RELATÓRIO CONTAS A PAGAR -->
    </head>

    <body style="zoom: 85%;" >
           <nav class="navbart">
            <div class="container-fluid" align="center">
                    
             
                <a onclick="getPdf()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </a>
                <a onclick="getExcel()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-share"></span> Exportar
                </a>
                       
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>    

            </div>
        </nav>
        
    <br>
        <div class="container" align="center" style="width: 90%;">
            <fieldset class="fieldset-border">
                <legend class="legend-border">Informe os Campos </legend>    
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    
                    <td  style="width: 25%;padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Empresa
                            <select  id="idEmpresaFiltro" class="form-control"  required="" onchange="carregarFilial()" ></select>
                        </div>
                    </td>
                    <td  style="width: 25%;padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Filial
                            <select  id="idFilialFiltro"  required="" class="form-control"  ></select>
                        </div>
                    </td>
                    <td  style="width:10%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Período Início
                            <input type="text" class="form-control" id="periodoIni" maxlength="10"   placeholder="Data Início">
                        </div>
                    </td>
                    <td  style="width:10%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Período Final
                            <input type="text" class="form-control" id="periodoFim" maxlength="10"   placeholder="Data Final" >
                        </div>
                    </td>
                    

                   
                    
                    
                    <td  style="width:10%;padding-left:0px; font-size: 14px;">
                        <div>
                         <br>
                         <a onclick="filtro()"class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                             <span class="glyphicon glyphicon-search"></span> Pesquisar
                         </a>
                        </div>
                    </td>
                    
                  
                </tr>
               
        </table>
   </fieldset>    
        </div>
     
            <div style='width: 100%; overflow-x: hidden'>
             
           </div>       
        <br>
        <HR WIDTH=100%>
        <br>
        <table id="relatorio" style="width: 95%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" ></table>
     
        
       

    </body>
     
          
          </div>
        </div>
      </div>
    </div>
</html>