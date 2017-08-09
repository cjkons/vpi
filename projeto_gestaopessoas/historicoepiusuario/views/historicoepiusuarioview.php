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
        <link href="resources/historicoepiusuario/css/teste.css" rel="stylesheet">
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/historicoepiusuario/js/historicoepiusuario.js"></script>
        <!-- CADASTRO EVENTO -->
    </head>

    <body style="zoom: 85%;">


        <nav class="navbart">
            <div class="container-fluid" align="center">

                <a onclick="novo()" class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-file"></span>  Novo 
                </a>

                <a onclick="atualizar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>        
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>



            </div>
        </nav>
        <br>
        <div class="container" align="center" style="width: 90%;">
            <fieldset class="fieldset-border">
                <legend class="legend-border" >Área de Consulta</legend>
                <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                    <tr>
                        <td  style="width: 27%; padding-right: 5px;font-size: 14px;">

                        </td>
                        <td  style="width: 35%; padding-right: 5px;font-size: 14px;">
                            <div class="form">
                                Funcionário
                                <select  id="idFuncionarioFiltro" class="form-control"  ></select>

                            </div>
                        </td>
                        

                        <td  style="padding-left:  0px;font-size: 14px;">
                            <div>
                                <br>
                                <a onclick="getGrid()"class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                                    <span class="glyphicon glyphicon-search"></span> Pesquisar
                                </a>

                            </div>
                        </td>
                        <td  style="width: 28%; padding-right: 5px;font-size: 14px;">

                        </td>

                    </tr>

                </table>
            </fieldset>
        </div>   
        <HR WIDTH=100%>


        <div style='width: 99%; margin-left: 7px; margin-right: 4px; overflow-x: hidden'>
            <table id="grid" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style='width: 5%;'>ID</th>
                        <th style='width: 25%;'>Funcionário</th>
                        <th style='width: 10%;'>Matricula</th>
                        <th style='width: 20%;'>Setor</th>
                        <th style='width: 20%;'>Função</th>
                        <th style='width: 5%;'>Selecionar</th>
                    </tr>
                </thead>
            </table>
        </div>       



        <br>
        <HR WIDTH=100%>
        <br>

    </body>


    <!-- Modal Novo -->
    <div class="modal fade" data-backdrop="static" id="pesquisarModal" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-esp">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Anexos EPI's / Funcionário</h4>
                </div>
                <div class="modal-body">
                    <nav class="navbart">
                        <div class="container-fluid" align="center">

 
                            <a onclick="salvar()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </a>
                            <a onclick="excluir()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </a>
                             <a onclick="botaoSair()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-refresh"></span> Sair

                            </a>

                            <a href="#" class="btn btn-primary">
                                <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                            </a> 




                        </div>
                    </nav>
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Dados Funcionário</legend>
                        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>

                                <td  style="width: 5%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        ID
                                        <input type='text' class="form-control" id="id"   readonly />
                                    </div>
                                </td>
                                <td  style="width: 35%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Funcionário
                                        <select  id="idFuncionario" class="form-control" onchange="verificarLancamentoEpi()"  ></select>

                                    </div>
                                </td>
                                <td  style="width: 40%; padding-right: 5px;font-size: 14px;">

                                </td>

                            </tr>
                        </table>

                        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >        
                            <tr> 
                               
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Matricula
                                        <input type='text' class="form-control" id="matricula"   placeholder="Matricula" disabled>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Setor
                                        <input type='text' class="form-control" id="setor"   placeholder="Setor" disabled>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Função
                                        <input type='text' class="form-control" id="funcao"   placeholder="Função" disabled>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Data Admissão
                                        <input type='text' class="form-control" id="dataAdmissao"  maxlength="10"  placeholder="Data Admissão" disabled>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">

                                </td>
                            </tr>
                        </table>
 
                        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >        
                            <tr>        
                                
                                <td  style="width: 40%;padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                       Foto
                                        <input type="file" class="form-control" id="imagem" enctype="multipart/form-data" placeholder="imagem"  readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; width: 20%; padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        Entrega ou Devolução
                                        <select id="entDev" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="E">Entrega EPI</option>
                                            <option readonly value="D">Devolução EPI</option>
                                        </select> 
                                    </div>
                                </td>
                                <td  style="width: 30%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Descrição do Anexo
                                        <input type='text' class="form-control" id="descricaoAnexo"   placeholder="Descrição do Anexo" readonly>
                                    </div>
                                </td>
                                  


                                
                            </tr>   

                        </table> 
                    </fieldset>   

                    <br>  
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Relação de Anexos EPI's / Funcionário</legend>
                        <div style="overflow: auto;" align="center"> 


                            <table id="tabelaItem2" class="tabela" style="width:90%" align="center"></table> 
                            <table id="tabelaItem3" class="tabela" style="width:90%" align="center"></table>     



                        </div>    
                    </fieldset>        <br><br><br> 

                </div>
            </div>
        </div>
    </div>                                    

    




</html>