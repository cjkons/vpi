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
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO ITEM -->
        <script src="resources/cadastroitem/js/cadastroitem.js"></script>
        <!-- CADASTRO ITEM -->
        
        
    </head>

    <body style="zoom: 85%;" >
           <nav class="navbart">
            <div class="container-fluid" align="center">

                <a onclick="novo()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-file"></span>  Novo 
                </a>
                <a onclick="salvar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                </a>
                <a onclick="editar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span> Editar
                </a>
                <a onclick="pesquisar()"class="btn btn-primary" ata-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-search"></span> Pesquisar
                </a>
                <a onclick="excluir()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-trash"></span> Excluir
                </a>
                <a onclick="buscaPrimeiroRegistro()"  class="btn btn-primary">
                    <span class="glyphicon glyphicon-fast-backward"></span> 
                </a>
                <a onclick="buscaRegistroAnterior()" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-backward"></span> 
                </a>
                <a onclick="buscaRegistroProximo()"class="btn btn-primary">
                    <span class="glyphicon glyphicon-forward"></span> 
                </a>
                <a onclick="buscaUltimoRegistro()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-fast-forward"></span> 
                </a>
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </a>
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-share"></span> Exportar
                </a>
                 <a onclick="atualizar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>        
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>
              
             

            </div>
        </nav>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
            <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                           <div class="form">
                                ID Item
                                <input type="number" class="form-control" id="idItem"   placeholder="ID Item" readonly>
                           </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                           <div class="form">
                                Código Item
                                <input type="text" class="form-control" id="codItem" maxlength="15"   placeholder="Código Item" readonly>
                           </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                           <div class="form">
                                Descrição Item
                                <input type="text" class="form-control" id="descItem"   placeholder="Descrição Item" readonly>
                           </div>
                    </td>
                       
                    <td  style="padding-right: 10px;font-size: 14px;">
                           <div class="form">
                                Comprador
                                <select id="comprador" class="form-control" readonly ></select>
                           </div>
                    </td>
                    
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Unidade medida
                                <select id="unidadeMedida" class="form-control"  readonly></select>
                        </div>
                   </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                                Tipo Fiscal
                                <select  id="tipoFiscal" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
                                     <option readonly value="Ativo Imobilizado">Ativo Imobilizado</option>
                                     <option readonly value="Produto Acabado">Produto Acabado</option>
                                     <option readonly value="Matéria Prima">Matéria Prima</option>
                                     <option readonly value="Serviços">Serviços</option>
                                     <option readonly value="Embalagens">Embalagens</option>
                                     <option readonly value="Material de Uso Consumo">Material de Uso Consumo</option>
                                     <option readonly value="Outros Insumos">Outros Insumos</option>
                                     
                                     
                                </select>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                           <div class="form">
                                Tipo Item
                                 <select id="tipoItem" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
                                     <option readonly value="Material">Material</option>
                                     <option readonly value="Serviço">Serviço</option>
                                   
                                </select>
                           </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Familia Item
                                <select id="familia" class="form-control"  readonly></select>
                        </div>
                   </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Conta contábil
                                <input type="text" class="form-control" id="contaContabil" maxlength="6"   placeholder="Conta contábil" readonly>
                        </div>
                   </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                                Código NCM
                                <input type="text" class="form-control" id="codNCM" maxlength="8"  placeholder="Código NCM" readonly>
                        </div>
                    </td> 
                    <td style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                                Código Fiscal
                                <input type="text" class="form-control" id="codFiscal" maxlength="4"  placeholder="Código fical" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Contabiliza?
                                <select id="contabiliza" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
                                     <option readonly value="S">Sim</option>
                                     <option readonly value="N">Não</option>
                                </select>
                        </div>
                   </td>
                    
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Incidência de ICMS
                                <select id="incidenciaICMS" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
                                     <option readonly value="Crédito">Crédito</option>
                                     <option readonly value="Isento">Isento</option>
                                     <option readonly value="Não Tributada">Não Tributada</option>
                                     <option readonly value="Outros">Outros</option>
                                </select>
                        </div>
                   </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Incidencia de IPI
                                <select id="incidenciaIPI" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
                                     <option readonly value="Isento">Isento</option>
                                     <option readonly value="Com crédito">Com crédito</option>
                                     <option readonly value="Outros">Outros</option>
                                     
                                </select>
                        </div>
                   </td>
                   <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form">
                                Crédito PIS/COFINS?
                                <select id="contabPISCOFINS" class="form-control"  readonly>
                                    <option readonly value="0" >Selecione</option>
                                    <option readonly value="S">Sim</option>
                                    <option readonly value="N">Não</option>
                                   
                                </select>
                        </div>
                   </td>
                   <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="ativo" name="ativo" disabled="true"/> Ativo
                            </label>
                        </div>
                    </td>
                </tr>
                             
                  
                          
        </table>
       
           <br><br>
           <div style='width: 99%; margin-left: 7px; margin-right: 4px; overflow-x: hidden'>
                  <table id="grid" class="display" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Código Item</th>
                              <th>Descrição Item</th>
                              <th>Unidade Medida</th>
                              <th>Tipo Fiscal</th>
                              <th>Tipo Item</th>
                              <th>Selecionar</th>
                          </tr>
                      </thead>
                  </table>
            </div>       
             
           
       
        <br>
        <HR WIDTH=100%>
        <br>

    </body>
    <!-- Modal -->
    <div class="modal fade" id="pesquisarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Pesquisar</h4>
          </div>
          <div class="modal-body">
              
            <table style="width: 50%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Identificação</label>
                    </td>
                    
                    
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="idPesquisarInicio" style="width: 150px" placeholder="ID">
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-fast-backward"></span> </div>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="input-group">
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-fast-forward"></span>  </div>
                            <input type="text" class="form-control" id="idPesquisarFim" style="width: 150px" placeholder="ID">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                    </td>
                    
                    
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomePesquisarInicio" style="width: 150px" placeholder="Nome">
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-fast-backward"></span> </div>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="input-group">
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-fast-forward"></span>  </div>
                            <input type="text" class="form-control" id="nomePesquisarFim" style="width: 150px" placeholder="Nome">
                        </div>
                    </td>
                </tr>
               
               
             </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Sair</button>
            <button onclick="pesquisaFiltro()" type="button" class="btn btn-outline" data-dismiss="modal">Ok</button>
          
          </div>
        </div>
      </div>
    </div>
    
</html>