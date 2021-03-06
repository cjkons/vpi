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

        <link href="resources/folhaponto/css/teste.css" rel="stylesheet">
        
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
        
        

        <!-- RELATÓRIO -->
       
        <script src="resources/folhaponto/js/folhaponto.js"></script>
        
        
        <!-- RELATÓRIO-->
    </head>

    <body style="zoom: 85%;" >
           <nav class="navbart">
            <div class="container-fluid" align="center">
                    
             
                <a onclick="getPdf()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-print"></span> Imprimir Folha Ponto
                </a>
                <a onclick="getPdf1()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-print"></span> Imprimir Folha Lanche 
                </a>
                
                       
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>    

            </div>
        </nav>
        <br>
        <div class="container" align="center" style="width: 90%;">
            <fieldset class="fieldset-border">
                <legend class="legend-border" >Informe os Campos</legend>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                           Funcionário
                            <select  style="text-transform: uppercase;" id="funcionario" class="form-control"  required="" onchange="carregarFuncao()" ></select>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div>
                            Função
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="funcao"   placeholder="Função" readonly>
                        </div>
                    </td>
               
                    <td  style="padding-right: 5px;font-size: 14px;">
                        Mês
                        <select style="text-transform: uppercase;" id="mes" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="01">Janeiro</option>
                                    <option readonly value="02">Fevereiro</option>
                                    <option readonly value="03">Março</option>
                                    <option readonly value="04">Abril</option>
                                    <option readonly value="05">Maio</option>
                                    <option readonly value="06">Junho</option>
                                    <option readonly value="07">Julho</option>
                                    <option readonly value="08">Agosto</option>
                                    <option readonly value="09">Setembro</option>
                                    <option readonly value="10">Outubro</option>
                                    <option readonly value="11">Novembro</option>
                                    <option readonly value="12">Dezembro</option>
                                    
                            </select> 
                    </td>
                    
                    
                    <td  style="padding-left:0px; font-size: 14px;">
                        <div>
                         <br>
                         <a onclick="filtro()" class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
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
        
    <ul id="abas" align="center">
               <li><a href="#tab1">FOLHA PONTO</a></li>
               <li><a href="#tab2">FOLHA LANCHE</a></li>
               
    </ul>    
        
        
        <br>
        <HR WIDTH=100%>
        <br>
        
    <div id="tab1" class="contaba" >    
        <table id="relatorio" style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" ></table>
     
    </div>  
        
    <div id="tab2" class="contaba" >    
        <table id="relatorio1" style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" ></table>
     
    </div>      

    </body>
    
    
        </div>
      </div>
    </div>
</html>