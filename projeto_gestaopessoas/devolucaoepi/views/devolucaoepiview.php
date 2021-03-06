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
        <link href="resources/devolucaoepi/css/teste.css" rel="stylesheet">
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/devolucaoepi/js/devolucaoepi.js"></script>
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

                    <h4 class="modal-title" id="myModalLabel">Devolução EPI</h4>
                </div>
                <div class="modal-body">
                    <nav class="navbart">
                        <div class="container-fluid" align="center">


                            <a onclick="salvar()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </a>
                            <a onclick="validarExcluir()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </a>
                            <a onclick="getPdf()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-print"></span> ImprimirDeclaração
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
                                        Funcionário
                                        <select  id="idFuncionario" class="form-control" onchange="carregarDadosFuncionario()"  ></select>

                                    </div>
                                </td>


                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Matricula
                                        <input type='text' class="form-control" id="matricula"   placeholder="Matricula" disabled>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">

                                </td>

                            </tr>
                        </table>

                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >        
                            <tr> 
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">

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
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">

                                </td>
                            </tr>
                        </table>

                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >        
                            <tr>        
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">

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
                        <legend class="legend-border">Relação de EPI's do Funcionário</legend>
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

                    <h4 class="modal-title" id="myModalLabel">Adicionar EPI's</h4>
                </div>
                <div style="height: 90%;"class="modal-body">
                    <nav class="navbart">
                        <div class="container-fluid" align="center">

                            <a onclick="validarSalvarLancamento()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </a>
                            <a onclick="botaoLancamentoSair()" class="btn btn-primary">
                                <span class="glyphicon glyphicon-refresh"></span> Sair

                            </a>

                        </div>
                    </nav>
                    <fieldset class="fieldset-border">
                        <legend class="legend-border">Informe os EPI's para Funcionário</legend>
                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                <td  style="width: 25%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        C.A.
                                        <select  id="codCa" class="form-control" readonly onchange ="carregarTipoEpi(), verificarQuantidadeEntregue()" ></select>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Tipo de EPI
                                        <input type="text" class="form-control" id="tipoEpi"  placeholder="Tipo de EPI" disabled>
                                    </div>
                                </td>
                                 </tr>
                        </table>
                    <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Qtd Entregue
                                        <input type="text" class="form-control" id="qtdEpiEntregue"  placeholder="QTD" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Qtd Devolvida
                                        <input type="number" class="form-control" id="qtdEpi"  placeholder="QTD" onchange ="verificarSaldoEntregue()" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Saldo
                                        <input type="number" class="form-control" id="saldoEpi"  placeholder="QTD" onchange ="verificarSaldoEntregue()" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        N/H
                                        <select style="text-transform: uppercase;" id="estadoEpi" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="D">DESCARTE NATURAL</option>
                                            <option readonly value="M">DESCARTE MAL USO</option>
                                            <option readonly value="P">PERDA</option>
                                            <option readonly value="R">REUTILIZAÇÃO</option>
                                        </select> 
                                    </div>
                                </td>

                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Data Entrega
                                        <input type="text" class="form-control" id="dataEpi"  placeholder="Data" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        Tipo Lançamento
                                        <select style="text-transform: uppercase;" id="tipoLancamento" onchange ="carregarCampoBloco()" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="D">Direta</option>
                                            <option readonly value="B">Em Bloco</option>
                                        </select> 
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Nº Bloco
                                        <input type="text" class="form-control" id="blocoEpi"  placeholder="Nº Bloco" disabled>
                                    </div>
                                </td>
                            </tr>

                        </table>
                        <br>
                        <table id="tabelaHist" class="tabela" style="width:90%" align="center"></table>    
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


                    <h4 class="modal-title" id="myModalLabel">Editar EPI's Adicionados</h4>
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
                        <legend class="legend-border">Edite o EPI para Funcionário</legend>
                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                <td  style="width: 25%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        C.A.
                                        <select  id="codCaEd" class="form-control" readonly onchange ="carregarTipoEpiEd()" ></select>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Tipo de EPI
                                        <input type="text" class="form-control" id="tipoEpiEd"  placeholder="Tipo de EPI" disabled>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>    
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Qtd Entregue
                                        <input type="text" class="form-control" id="qtdEpiEntregueEd"  placeholder="QTD" readonly>
                                    </div>
                                </td>
                             
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Qtd Devolvida
                                        <input type="text" class="form-control" id="qtdEpiEd"  placeholder="QTD" onchange ="verificarSaldoEntregueEd()" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Saldo
                                        <input type="number" class="form-control" id="saldoEpiEd"  placeholder="QTD" onchange ="verificarSaldoEntregue()" readonly>
                                    </div>
                                </td>
                             
                                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        N/H
                                        <select style="text-transform: uppercase;" id="estadoEpiEd" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="D">DESCARTE NATURAL</option>
                                            <option readonly value="M">DESCARTE MAL USO</option>
                                            <option readonly value="P">PERDA</option>
                                            <option readonly value="R">REUTILIZAÇÃO</option>
                                        </select> 
                                    </div>
                                </td>

                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Data Entrega
                                        <input type="text" class="form-control" id="dataEpiEd"  placeholder="Data" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%;  padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        Tipo Lançamento
                                        <select style="text-transform: uppercase;" id="tipoLancamentoEd" onchange ="carregarCampoBlocoEdEd()" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="D">Direta</option>
                                            <option readonly value="B">Em Bloco</option>
                                        </select> 
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Nº Bloco
                                        <input type="text" class="form-control" id="blocoEpiEd"  placeholder="Nº Bloco" disabled>
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


                    <h4 class="modal-title" id="myModalLabel">Editar EPI's Adicionados</h4>
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
                        <legend class="legend-border">Edite o EPI para Funcionário</legend>
                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>
                                <td  style="width: 25%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        C.A.
                                        <select  id="codCaEdEd" class="form-control" readonly onchange ="carregarTipoEpiEdEd()" ></select>
                                    </div>
                                </td>
                                <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Tipo de EPI
                                        <input type="text" class="form-control" id="tipoEpiEdEd"  placeholder="Tipo de EPI" disabled>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                            <tr>        
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Qtd Entregue
                                        <input type="text" class="form-control" id="qtdEpiEntregueEdEd"  placeholder="QTD" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Qtd Devolvida
                                        <input type="text" class="form-control" id="qtdEpiEdEd"  placeholder="QTD" onchange ="verificarSaldoEntregueEdEd()" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Saldo
                                        <input type="number" class="form-control" id="saldoEpiEdEd"  placeholder="QTD" onchange ="verificarSaldoEntregueEdEd()" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        N/H
                                        <select style="text-transform: uppercase;" id="estadoEpiEdEd" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="D">DESCARTE NATURAL</option>
                                            <option readonly value="M">DESCARTE MAL USO</option>
                                            <option readonly value="P">PERDA</option>
                                            <option readonly value="R">REUTILIZAÇÃO</option>
                                        </select> 
                                    </div>
                                </td>

                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Data Entrega
                                        <input type="text" class="form-control" id="dataEpiEdEd"  placeholder="Data" readonly>
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                                    <div class="form">
                                        Tipo Lançamento
                                        <select style="text-transform: uppercase;" id="tipoLancamentoEdEd" onchange ="carregarCampoBlocoEdEd()" class="form-control" readonly>
                                            <option readonly value="0">Selecione</option>
                                            <option readonly value="D">Direta</option>
                                            <option readonly value="B">Em Bloco</option>
                                        </select> 
                                    </div>
                                </td>
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Nº Bloco
                                        <input type="text" class="form-control" id="blocoEpiEdEd"  placeholder="Nº Bloco" disabled>
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


    <div class="modal-footer">





</html>