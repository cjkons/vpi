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
        <link href="resources/quantidadeepifuncao/css/teste.css" rel="stylesheet">
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/quantidadeepifuncao/js/quantidadeepifuncao.js"></script>
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
                        <td  style="width: 22%; padding-right: 5px;font-size: 14px;">

                        </td>
                        <td  style="width: 36%; padding-right: 5px;font-size: 14px;">
                            <div class="form">
                                Função
                                <select  id="idFuncaoFiltro" class="form-control"  ></select>

                            </div>
                        </td>
                        
                        <td  style="width: 10%; padding-left:  0px;font-size: 14px;">
                            <div>
                                <br>
                                <a onclick="getGrid()"class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                                    <span class="glyphicon glyphicon-search"></span> Pesquisar
                                </a>

                            </div>
                        </td>
                        <td  style="width: 22%; padding-right: 5px;font-size: 14px;">

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
                       
                        <th style='width: 10%;'>ID</th>
                        <th style='width: 25%;'>Função</th>
                        <th style='width: 10%;'>Selecionar</th>
                        
                    </tr>
                </thead>
            </table>
        </div>       



        
    </body>


    <!-- Modal Novo -->
    <div class="modal fade" data-backdrop="static" id="pesquisarModal" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-esp">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Cadastro de EPI's por Função</h4>
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
                        <legend class="legend-border">Dados Função</legend>
                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>

                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">

                                </td>

                                <td  style="width: 5%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        ID
                                        <input type='text' class="form-control" id="id"   readonly />
                                    </div>
                                </td>
                                <td  style="width: 35%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Função
                                        <select  id="idFuncao" class="form-control"  ></select>

                                    </div>
                                </td>

                                <td  id="botaoAdicionarItem" style="width: 10%; padding-left:  0px;font-size: 14px;">
                                    <div>
                                        <br>
                                        <a onclick="verificarLancamentoEpi()"  class="btn btn-primary" ata-toggle="modal" data-target="#myModal" >
                                            <span class="glyphicon glyphicon-arrow-right"></span> Lançamento de EPI's
                                        </a>
                                    </div>
                                </td>  


                                <td  style="width: 70%; padding-right: 5px;font-size: 14px;">

                                </td>
                            </tr>   

                        </table> 
                    </fieldset>   

                    <br>  
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Relação de EPI's da Função</legend>
                        <div style="overflow: auto;" align="center"> 


                            <table id="tabelaItem2" class="tabela" style="width:90%" align="center"></table> 
                            <table id="tabelaItem3" class="tabela" style="width:90%" align="center"></table>     



                        </div>    
                    </fieldset>        <br><br><br> 

                </div>
            </div>
        </div>
    </div>                                    

    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal item *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->

    <!-- Modal item -->
    <div class="modal fade" data-backdrop="static" id="lancamentoModal" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-esp">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Adicionar EPI's para Função</h4>
                </div>
                <div style="height: 90%;"class="modal-body">
                    <nav class="navbart">
                        <div class="container-fluid" align="center">

                            <a onclick="verificarSalvarLancamento()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </a>
                            <a onclick="botaoLancamentoSair()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-refresh"></span> Sair

                            </a>

                        </div>
                    </nav>
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Informe os EPI's para Funcionário</legend>
                        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                <td  style="width: 25%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Selecione o Tipo EPI
                                        <select  id="tipoEpi" class="form-control" readonly  ></select>
                                    </div>
                                </td>
                                
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Quantidade
                                        <input type="number" class="form-control" id="quantidade" maxlength="5" placeholder="Quantidade" readonly>
                                    </div>
                                </td>
                                
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Durabilidade
                                        <input type="number" class="form-control" id="durabilidade" maxlength="5"  placeholder="Durabilidade" readonly>
                                    </div>
                                </td>
                            </tr>

                        </table> 
                        <br>
                        <br>
                    </fieldset>
                </div>
                <div class="modal-footer">



                </div>
            </div>
        </div>
    </div>

    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal item  Ediçao Salvo em Banco Temp *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->

    <!-- Modal item -->
    <div class="modal fade" data-backdrop="static" id="lancamentoEdicaoModal" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-esp">
            <div class="modal-content">
                <div class="modal-header">


                    <h4 class="modal-title" id="myModalLabel">Edição de EPI cadastrado para Função</h4>
                </div>
                <div class="modal-body">
                    <nav class="navbart">
                        <div class="container-fluid" align="center">

                            <a onclick="salvarLancamentoEd()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </a>
                            </a>
                            <a onclick="excluirLancamentoModalEd()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </a>

                            <a onclick="botaoSairEd()" class="btn btn-primary">
                                <span class=" glyphicon glyphicon-refresh"></span> Sair

                            </a>



                        </div>
                    </nav>
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Editar EPI's Adicionados</legend>
                        <table style="width: 45%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                <td  style="width: 25%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Selecione o Tipo EPI
                                        <select  id="tipoEpiEd" class="form-control" disabled  ></select>
                                    </div>
                                </td>
                               
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Quantidade
                                        <input type="number" class="form-control" id="quantidadeEd" maxlength="5" placeholder="Quantidade" readonly>
                                    </div>
                                </td>
                                
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Durabilidade
                                        <input type="number" class="form-control" id="durabilidadeEd" maxlength="5" placeholder="Durabilidade" readonly>
                                    </div>
                                </td>
                            </tr>

                        </table> 
                        <br>
                        <br>
                        <br>
                    </fieldset>


                </div>
                <div class="modal-footer">



                </div>
            </div>
        </div>
    </div>


    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal item  Ediçao Apos Salvar em Banco *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->

    <!-- Modal item -->
    <div class="modal fade" data-backdrop="static" id="lancamentoEdicaoModalEd" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-esp">
            <div class="modal-content">
                <div class="modal-header">


                    <h4 class="modal-title" id="myModalLabel">Edição de EPI cadastrado para Função</h4>
                </div>
                <div class="modal-body">
                    <nav class="navbart">
                        <div class="container-fluid" align="center">

                            <a onclick="salvarLancamentoEdEd()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </a>
                            </a>
                            <a onclick="excluirLancamentoModalEdEd()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </a>

                            <a onclick="botaoSairEdEd()" class="btn btn-primary">
                                <span class=" glyphicon glyphicon-refresh"></span> Sair

                            </a>



                        </div>
                    </nav>
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Editar EPI's Adicionados </legend>
                        <table style="width: 45%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                <td  style="width: 25%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                         Tipo EPI
                                        <select  id="tipoEpiEdEd" class="form-control" disabled  ></select>
                                    </div>
                                </td>
                                
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Quantidade
                                        <input type="number" class="form-control" id="quantidadeEdEd" maxlength="5" placeholder="Quantidade" readonly>
                                    </div>
                                </td>
                                
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Durabilidade
                                        <input type="number" class="form-control" id="durabilidadeEdEd" maxlength="5" placeholder="Durabilidade" readonly>
                                    </div>
                                </td>
                            </tr>

                        </table> 
                        <br>
                        <br>
                        <br>
                    </fieldset>



                </div>
                <div class="modal-footer">



                </div>
            </div>
        </div>
    </div>




    <div class="modal-footer">





</html>