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
        <script type="text/javascript" src='resources/chamadotecnico/js/jquery-ui.js'></script>
        <!--JQUERY 1.11-->

        <!--NOTIFICAÇÕES-->
        <link href="resources/geral/notificacoes/pnotify.custom.min.css" rel="stylesheet">
        <script src="resources/geral/notificacoes/pnotify.custom.min.js"></script>
        <!--NOTIFICAÇÕES-->

        <!--BOOSTRAP 3.3.0--> 
        <link href="resources/geral/bootstrap/css/yeti-theme/bootstrap.min.css" rel="stylesheet">
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

        <!-- JASNY BOOTSTRAP -->
        <script src="resources/geral/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
        <link href="resources/geral/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
        <!-- JASNY BOOTSTRAP -->

        <!-- CONFIGURAÇÃO DE USUARIO -->
        <script src="resources/chamadotecnico/js/visualizarchamado.js"></script>
        <!-- CONFIGURAÇÃO DE USUARIO -->

    </div>


</head>

<body>
    
    <div class="container-fluid" align="center">
        <a onclick="abrirChamado()" class="btn btn-primary">
            <span class="glyphicon glyphicon-wrench"></span> Abrir Chamado
        </a>
        <a onclick="carregarChamados()" class="btn btn-primary">
            <span class="glyphicon glyphicon-refresh"></span> Atualizar
        </a>

    </div>
    <div style='width: 100%; padding: 5px;'>
        <div align='center' class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><h2>Grid de Chamado Técnico</h2></h3>
            </div>
        </div>
    </div>
    
    <div style='width: 100%; padding: 5px;'>
    <table id="tabelaChamado" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="2px" align="center" >
    
    <div style='width: 100%; overflow-x: hidden' >
               <table id="grid" class="display" cellspacing="0" width="100%" align='center'>
                   <thead>
                       
                   </thead>
               </table>
    </div> 
    
    
    
    
    
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal Cadastro Chamado *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->
    
    
   
    
    <div class="modal fade" id="abrirChamadoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
      <div class="modal-dialog" style="width: 650px;">
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" align='center'>Abertura de Chamado Técnico</h4>
          </div>
          <div class="modal-body " >
              
            <table style='width: 610px; padding: 5px;' align='center' >
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">Nome</span>
                            <input style="width: 445px; height: 50px; padding: 5px;" id="nome" maxlength="50" type="text" class="form-control" placeholder="" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="height:5px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">E-mail</span>
                            <input style="width: 445px; height: 50px;  padding: 5px;" id="email" type="text" class="form-control" placeholder="" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="height:5px;"></td>
                </tr>
                <tr>
            </table>        
            <table style="width: 610px;" align='center'>        
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">Telefone</span>
                            <input style="width: 200px; height: 50px; padding: 5px;"type="text" class="form-control" id="telefone" maxlength="12"    onkeypress="mascara(this)">

                        </div>
                    </td>

                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 145px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">Ramal</span>
                            <input style="width: 100px; height: 50px; padding: 5px;" id="ramal" maxlength="4" type="text" class="form-control" placeholder="">
                        </div>
                    </td>
                </tr>
            </table> 
            <table style="width: 610px;" align='center'> 
                <tr>
                    <td style="height: 5px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">Setor</span>
                            <input style="width: 445px; height: 50px; padding: 5px;" id="setor" maxlength="30" type="text" class="form-control" placeholder="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="height: 5px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">Módulo / Sistema</span>
                            <input style="width: 445px; height: 50px; padding: 5px;" id="modulo" maxlength="30" type="text" class="form-control" placeholder="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="height: 5px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 50px; text-align: center; padding: 5px;" class="input-group-addon">Prioridade</span>
                            <select  style="width: 445px ; height: 50px; padding: 5px; background-color: white" id="prioridade" class="form-control" >
                                                    <option value="0" selected>Selecione</option> 
                                                    <option value="BAIXA" >Baixa</option> 
                                                    <option value="MEDIA" >Média</option>
                                                    <option value="ALTA" >Alta</option>
                                                    <option value="URGENTE" >Urgente</option>
                            </select>
                        </div>
                    </td>
                </tr>
               <tr>
                    <td style="height: 5px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 90px; text-align: center; " class="input-group-addon">Descrição</span>
                            <textarea style="width: 445px; height: 100px; background-color: white"  class="col-xs-9 cold-md-6" maxlength="250"  id="descricao" placeholder="">

                            </textarea>

                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="height: 5px;"></td>
                </tr>
                
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 30px; text-align: center; padding: 5px;" class="input-group-addon">Anexo</span>
                            <input style="width: 445px; height: 40px; text-align: center; padding: 5px;" class="form-control"  type='file' id='anexo' name='anexo'></input>
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td style="height: 5px;"></td>
                </tr>

                <tr>
                    <td align="center">
                        <button onclick='fecharModalChamado()' type="button" class="btn btn-lg btn-primary" aria-label="Left Align" style="padding-right: 10px;">
                            <span class='glyphicon glyphicon-random'></span>
                             Sair
                        </button>
                        <button onclick='salvarChamado()' type="button" class="btn btn-lg btn-success" aria-label="Left Align" style="padding-left: 10px;">
                            <span class='glyphicon glyphicon-cloud-upload'></span>
                             Salvar
                        </button>
                    </td>
                </tr>

            </table>
              
    </div>
            </div>
      </div>
    </div>
    
     <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal Historico Chamado *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->
    
    <div  class="modal fade" id="historicoChamadoModal" tabindex="50" role="dialog"   aria-labelledby="myModalLabel"  aria-hidden="true" align="center" >
      <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content"  >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" align='center'>Histórico de Chamado Técnico</h4>
          </div>
           
            <div class="container-fluid" align="center">

               
                <a onclick="novasInformacoesChamado()" class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-ok-circle"></span>  Adicionar Informações 
                </a>

                
                <a onclick="fecharHistoricoChamado()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-remove-circle"></span> Sair
                </a>
                           

            </div>
            <div class="modal-body " align="center" >
            
                <input type="hidden" name="numChamado" id="numChamadoHistorico"  />
                                                      
              <div id="tabelaHistorico" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="2px" align="center" >

             </div>       
            
            </div>
      </div>
    </div>
    
    
     <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal Mais Informacoes Chamado *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->
    
    
   
    
    <div class="modal fade" id="informacoesChamadoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
      <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" align='center'>Adicionar Informações ao Chamado Técnico</h4>
          </div>
          <div class="modal-body " >
              
                   
            <input type="hidden" name="numChamado" id="numChamadoAdicionar"  />
            
            <table style="width: 610px;" align='center'> 
                <tr>
                    <td style="height: 5px;"></td>
                </tr>
                
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; text-align: center; padding: 5px;" class="input-group-addon">Status</span>
                            <select  style="width: 445px; background-color: white" id="statusAdicionar" class="form-control" >
                                                    <option value="0" selected>Selecione</option> 
                                                    <option value="I" >Informação Complementar</option> 
                                                    <option value="V" >Solicitando Nova Verificação</option>
                                                    <option value="C" >Cancelando Chamado</option>
                                                    <option value="F" >Finalizando Chamado</option>
                                                    
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="height: 5px;"></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-lg">
                            <span style="width: 165px; height: 90px; text-align: center; " class="input-group-addon">Descrição</span>
                            <textarea style="width: 445px; height: 100px; background-color: white"  class="col-xs-9 cold-md-6" maxlength="250"  id="descricaoAdicionar" placeholder="">

                            </textarea>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="height: 5px;"></td>
                </tr>

                <tr>
                    <td align="center">
                        <button onclick='fecharModalInformacoesChamado()' type="button" class="btn btn-lg btn-primary" aria-label="Left Align" style="padding-right: 10px;">
                            <span class='glyphicon glyphicon-random'></span>
                             Sair
                        </button>
                        <button onclick='salvarInformacoes()' type="button" class="btn btn-lg btn-success" aria-label="Left Align" style="padding-left: 10px;">
                            <span class='glyphicon glyphicon-cloud-upload'></span>
                             Salvar
                        </button>
                    </td>
                </tr>

            </table>
              
    </div>
            </div>
      </div>
    </div>
    
    
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal Carregando  *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->
    
    
   
    
    <div class="modal fade" id="carregandoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
      <div class="modal-dialog" style="width: 40%; height: 40%;">
        <div class="modal-content" >
          <div class="modal-body " >
              
           
            
           
               <table class="carregando"><tr><td><img width="50px" src="resources/chamadotecnico/img/loading.gif" /></td><td style="font-size: 18px;">Aguarde...</td></tr></table>

            
              
    </div>
            </div>
      </div>
    </div>
    
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal Carregando  *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->
    
    
   
    
    <div class="modal fade" id="carregandoModalAbrir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
      <div class="modal-dialog" style="width: 40%; height: 40%;">
        <div class="modal-content" >
          <div class="modal-body " >
              
           
            
           
               <table class="carregando"><tr><td><img width="50px" src="resources/relatoriomedicao/img/001.gif" /></td><td style="font-size: 18px;">Aguarde...</td></tr></table>

            
              
    </div>
            </div>
      </div>
    </div>
    
    
     
    
</body>
</html>