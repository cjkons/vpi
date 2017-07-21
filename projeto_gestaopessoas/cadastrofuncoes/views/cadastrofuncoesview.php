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
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        <link href="resources/cadastrofuncoes/css/zoom.css" rel="stylesheet">
        <link href="resources/cadastrofuncoes/css/teste.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/cadastrofuncoes/js/cadastrofuncoes.js"></script>
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
                
                
                <a onclick="excluir()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-trash"></span> Excluir
                </a>
                <a onclick="atualizar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>

              
                
           


            </div>
        </nav>
        <br> 
        
     
        <table style="width: 85%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
            <tr>
                <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        ID
                        <input style="text-transform: uppercase;" type="text" class="form-control" id="id"    placeholder="ID" readonly>
                    </div>
                </td>
                
               <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        Função
                        <input style="text-transform: uppercase;" type="text" class="form-control" id="funcao"   placeholder="Função" readonly >
                    </div>
                </td>
                <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        Descrição
                        <input style="text-transform: uppercase;" type="text" class="form-control" id="descricao"   placeholder="Descrição" readonly >
                    </div>
                </td>
                <td  style="width:10%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        CBO
                        <input style="text-transform: uppercase;" type="number" class="form-control" id="cbo"   placeholder="CBO" readonly >
                    </div>
                </td>
                <td  style="width:10%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                            Período para Exame ASO
                            <select style="text-transform: uppercase;" id="periodoExame" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
                                     <option value ="1 MES"readonly>01 Mês</option>
                                     <option value ="2 MESES"readonly>02 Meses</option>
                                     <option value ="3 MESES"readonly>03 Meses</option>
                                     <option value ="4 MESES"readonly>04 Meses</option>
                                     <option value ="5 MESES"readonly>05 Meses</option>
                                     <option value ="6 MESES"readonly>06 Meses</option>
                                     <option value ="7 MESES"readonly>07 Meses</option>
                                     <option value ="8 MESES"readonly>08 Meses</option>
                                     <option value ="9 MESES"readonly>09 Meses</option>
                                     <option value ="10 MESES"readonly>10 Meses</option>
                                     <option value ="11 MESES"readonly>11 Meses</option>
                                     <option value ="12 MESES"readonly>12 Meses</option>
                                     
                                </select>
                        </div>
                </td>
         </tr>
        </table>       
        <table style="width: 85%; border-collapse: collapse;"  cellpadding="0" cellspacing="5px" align="center" >        
                <tr>
                    <td style="width:10%; padding-top: 10px; padding-right: 10px; font-size: 14px;">
                        Descrição PPRA
                        <div class="input-group input-group-lg">
                            
                            <textarea style="width: 600px; height: 100px; background-color: white"  class="col-xs-9 cold-md-6" maxlength="350"  id="descricaoPpra" placeholder="" disabled>

                            </textarea>

                        </div>
                    </td>
                </tr>


            </tr>
        </table>
    
    </div> 
        
        
         
        <br><br>
        <HR WIDTH=100%>
        
        
        <table id="tabelaCadastro1" style="width: 85%; border-collapse: collapse" cellpadding="0" cellspacing="2px" align="center" >                    

        

        </body>
</html>