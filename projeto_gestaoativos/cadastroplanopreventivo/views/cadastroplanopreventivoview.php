<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>VPI Gestão</title>
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
        <link href="resources/boletimcaminhaobetoneira/css/zoom.css" rel="stylesheet">
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/cadastroplanopreventivo/js/cadastroplanopreventivo.js"></script>
        <!-- CADASTRO EVENTO -->
    </head>

    <body style="zoom: 85%;">
        <nav class="navbart">
            <div class="container-fluid" align="center">

                <a onclick="novo()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-file"></span>  Novo 
                </a>
                <a onclick="consultar()"  class="btn btn-primary" >
                    <span class="fa fa-search"></span> Consultar Equipamento
                </a>
                <a onclick="salvar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                </a>
                
                <a onclick="editar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span> Editar
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
        <table style="width: 70%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
            <tr>
                <td  style="width: 1%; padding-right: 10px;font-size: 14px;">
                    <div class="form">

                        <input type="hidden" class="form-control" id="id"    placeholder="Id" readonly>
                    </div>
                </td>
                <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        Equipamento (Placa)
                        <select  id="equipamento" class="form-control" onchange="carregarApelido()" readonly ></select>
                    </div>
                </td>
                <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                    <div class="form">
                        Descrição
                        <input type="text" class="form-control" id="descricao"  placeholder="Descrição" readonly>

                    </div>
                </td>
                <td  style="width: 10%; padding-top: 40px; font-size: 14px;">
                    <div class="form-group">
                        <input type="checkbox" id="ativoChecklist" name="ativoChecklist" style="padding-top: 50px; width: 30px; height: 30px;" disabled="true"/>
                        <font size="3">CheckList</font>
                    </div>
                </td>
                <td  style="width: 10%; padding-right: 10px; padding-top: 40px; font-size: 14px;">
                    <div class="form-group">

                        <input type="checkbox" id="ativoAtividade" name="ativoAtividade" style="padding-top: 50px; width: 30px; height: 30px;" disabled="true"/>
                        <font size="3">Atividade</font>
                    </div>
                </td>
                
                


            </tr>
        </table>



        <table style="width: 70%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" > 
            <tr>
                <td  style="width: 70%; padding-left: 13px; font-size: 14px;" align="left">
                    <div>
                        <br>
                        <a onclick="validarAddAtividade()"  class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-arrow-right"></span> Adicionar Atividade
                        </a>
                    </div>
                </td> 
            </tr>
        </table>                 

        <br>
        <HR WIDTH=100%>
        
        
        <table id="tabelaItem3" style="width: 95%; border-collapse: collapse" cellpadding="0" cellspacing="2px" align="center" >                    

           

            <table id="tabelaPreco2" style="width: 95%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center"></table>


            <!-- ------------------------------------------------------------------------------------------------------------------------------------------
                        ********************************************************Modal ADICIONAR ITEM *********************************************************************
                        ***********************************************************************************************************************************************
                       ---------------------------------------------------------------------------------------------------------------------------------------------->

                        <!-- Modal item -->
                        <div style="position: absolute; width: 100%;" class="modal fade" data-backdrop="static" id="adicionarItensModal" tabindex="50" align="center" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div  style="width: 60%;"  class="modal-dialog-esp" align="center">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h4 class="modal-title" id="myModalLabel2">Adicionar Item</h4>
                                    </div>
                                    <div class="modal-body">
                                        <nav class="navbart">
                                            <div class="container-fluid" align="center">
                                                
                                                <a onclick="novoItem()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-file"></span>  Novo 
                                                </a>
                                                <a onclick="validarSalvarItem()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                                                </a>
                                                <a onclick="botaoItemSair()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-refresh"></span> Sair
                                                </a>
                                                </a>
                                                <a onclick="#" class="btn btn-primary">
                                                    <span class="glyphicon"></span>- - - 

                                                </a>

                                                <a onclick="excluirItem()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-trash"></span> Excluir
                                                </a>

                                            </div>
                                        </nav>

                                        </table>
                                        <table style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                            <tr>
                                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                                    <div class="form">
                                                        Seq.
                                                        <input type="text" class="form-control" id="idItemModal"  placeholder="Seq." disabled >
                                                    </div>
                                                </td>

                                            
                                                <td  style="width: 30%; padding-right: 5px;font-size: 14px;">
                                                    <div class="form">
                                                        Item   
                                                        <select  id="item" class="form-control" onchange="carregarUnidadeMedida()" readonly ></select>
                                                        
                                                    </div>
                                                </td>
                                          
                                            <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                                <div class="form">
                                                    Unidade Medida
                                                    <input type="text" class="form-control" id="unidadeMedida"   placeholder="Unidade Medida" disabled>
                                                </div>
                                            </td>
                                             <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                                    <div class="form">
                                                        Quantidade
                                                        <input type="number" class="form-control" id="quantidade"   placeholder="Quantidade" readonly >
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>      
                                        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    
                                            <tr>
                                                <td  style="width: 28%; padding-right: 5px;font-size: 14px;">
                                                    <div class="form">
                                                        Observação
                                                        <textarea style=" width: 100%; height: 100px; resize: none;" class="form-control" id="observacao"  rows="4"   placeholder="Observação"  maxlength="200"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table> 
        
        
                            <br>
                            <HR WIDTH=100%>
                            <br>                    

        
                                        
                                <br><br><br>
                                <table id="tabelaItem4" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center"></table>


                                    </div>
                                    
                                    

            
                               
                                </div>
                            </div>
                        </div>

                        
                        <!-- ------------------------------------------------------------------------------------------------------------------------------------------
                        ********************************************************Modal LISTA ATIVIDADES *********************************************************************
                        ***********************************************************************************************************************************************
                       ---------------------------------------------------------------------------------------------------------------------------------------------->

                        <!-- Modal item -->
                        <div style="position: absolute; width: 100%;" class="modal fade" data-backdrop="static" id="adicionarListaAtividadesModal" tabindex="50" align="center" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div  style="width: 60%;"  class="modal-dialog-esp" align="center">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h4 class="modal-title" id="myModalLabel2">Adicionar Lista Atividades</h4>
                                    </div>
                                    <div class="modal-body">
                                        <nav class="navbart">
                                            <div class="container-fluid" align="center">
                                                
                                                <a onclick="novoAtividadesDescricao()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-file"></span>  Novo 
                                                </a>
                                                <a onclick="salvarAtividadesDescricao()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                                                </a>
                                                <a onclick="botaoAtividadesDescricaoSair()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-refresh"></span> Sair
                                                </a>
                                                </a>
                                                <a onclick="#" class="btn btn-primary">
                                                    <span class="glyphicon"></span>- - - 

                                                </a>

                                                <a onclick="excluirAtividadesDescricao()" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-trash"></span> Excluir
                                                </a>

                                            </div>
                                        </nav>

                                        </table>
                                        <table style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                            <tr>
                                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                                    <div class="form">
                                                        Seq.
                                                        <input type="text" class="form-control" id="idDescricaoModal"  placeholder="Seq." disabled >
                                                    </div>
                                                </td>

                                            
                                                <td  style="width: 30%; padding-right: 5px;font-size: 14px;">
                                                    <div class="form">
                                                        Descrição Atividades   
                                                        <input type="text" class="form-control" id="descricaoAtividades"   placeholder="Descrição Atividades" disabled>
                                                        
                                                    </div>
                                                </td>
                                            </tr>    
                                            
                                        </table> 
        
        
                            <br>
                            <HR WIDTH=100%>
                            <br>                    

        
                                        
                                <br><br><br>
                                <table id="tabelaItem5" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center"></table>


                                    </div>
                                    
                                    

            
                               
                                </div>
                            </div>
                        </div>




            <!-- ------------------------------------------------------------------------------------------------------------------------------------------
            ********************************************************Modal Adicionar Atividade**************************************************************
            ***********************************************************************************************************************************************
           ---------------------------------------------------------------------------------------------------------------------------------------------->

            <!-- Modal item -->
            <div style="width: 100%;" class="modal fade" data-backdrop="static" id="adicionarAtividadeModal" tabindex="50" align="center" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div  style="width: 40%;"  class="modal-dialog-esp" align="center">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="myModalLabel">Adicionar Atividade</h4>
                        </div>
                        <div class="modal-body">
                            <nav class="navbart">
                                <div class="container-fluid" align="center">

                                    <a onclick="salvarAdicionarAtividade()" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                                    </a>
                                    <a onclick="botaoAdicionarAtividadeSair()" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-refresh"></span> Sair

                                    </a>

                                </div>
                            </nav>

                            </table>
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                <tr>
                                    <td  style="width: 1%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">

                                            <input type="hidden" class="form-control" id="idAdicionarModal" disabled >
                                        </div>
                                    </td>

                                </tr>
                            </table>   
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                <tr>
                                    <td  style="width: 4%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">
                                            Seq.                                  
                                            <input type="number" class="form-control" id="idAtividade" placeholder="Seq." disabled >
                                        </div>
                                    </td>
                                    <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">
                                            Intervenção
                                            <input type="text" class="form-control" id="intervencao"   placeholder="Intervenção" >
                                        </div>
                                    </td>
                                </tr>
                            </table>     
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    

                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Atividade
                                        <input type="text" class="form-control" id="descAtividade"   placeholder="Atividade" >
                                    </div>
                                </td>
                                </tr>
                            </table>     
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    
                                <tr>
                                    <td  style="width: 28%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">
                                            Freq.
                                            <input type="number" class="form-control" id="frequencia"   placeholder="Freq." >
                                        </div>
                                    </td>
                                </tr>
                            </table>     
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >        
                                <td  style="width: 28%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Executor
                                        <input type="text" class="form-control" id="executor"   placeholder="Executor." >
                                    </div>
                                </td>
                                </tr>
                            </table>   



                        </div>

                    </div>
                </div>
            </div>



            <!-- ------------------------------------------------------------------------------------------------------------------------------------------
            ********************************************************Modal Atividade Editar *********************************************************************
            ***********************************************************************************************************************************************
           ---------------------------------------------------------------------------------------------------------------------------------------------->

            <!-- Modal item -->
            <div style="width: 100%; "class="modal fade" data-backdrop="static" id="adicionarAtividadeModalEditar" tabindex="50" align="center" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div style="width: 40%;" class="modal-dialog-esp">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="myModalLabel">Editar Atividade</h4>
                        </div>
                        <div class="modal-body">
                            <nav class="navbart">
                                <div class="container-fluid" align="center">

                                    <a onclick="salvarAtividadeEditar()" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                                    </a>
                                    <a onclick="botaoAdicionarAtividadeEditarSair()" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-refresh"></span> Sair

                                    </a>
                                    <a onclick="#" class="btn btn-primary">
                                        <span class="glyphicon"></span>- - - 

                                    </a>

                                    <a onclick="excluirAtividadeEditar()" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-trash"></span> Excluir
                                    </a>

                                </div>
                            </nav>

                            </table>
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                <tr>
                                    <td  style="width: 1%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">

                                            <input type="hidden" class="form-control" id="idAdicionarModalEditar" disabled >
                                        </div>
                                    </td>

                                </tr>
                            </table>  
                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                <tr>
                                    <td  style="width: 4%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">
                                            Seq.                                  
                                            <input type="number" class="form-control" id="idAtividadeEditar" placeholder="Seq. " readOnly >
                                        </div>
                                    </td>
                                    <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">
                                            Intervenção
                                            <input type="text" class="form-control" id="intervencaoEditar"   placeholder="Intervenção" >
                                        </div>
                                    </td>
                                </tr>
                            </table>   

                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    
                                <td  style="width: 10%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Atividade
                                        <input type="text" class="form-control" id="descAtividadeEditar"   placeholder="Atividade" >
                                    </div>
                                </td>
                                </tr>
                            </table>   

                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    
                                <td  style="width: 28%; padding-right: 5px;font-size: 14px;">
                                    <div class="form">
                                        Frequência
                                        <input type="number" class="form-control" id="frequenciaEditar"   placeholder="Frequência" >
                                    </div>
                                </td>
                                </tr>
                            </table>   

                            <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                                <tr>
                                    <td  style="width: 20%; padding-right: 5px;font-size: 14px;">
                                        <div class="form">
                                            Executor
                                            <input type="text" class="form-control" id="executorEditar"  placeholder="Executor" >
                                        </div>
                                    </td>    
                                </tr>
                            </table>   

                        </div>


                        

                        <div class="modal-footer">



                        </div>
                    </div>
                </div>
            </div>                                


        </body>
</html>