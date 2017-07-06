<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>VPI Gestão</title>
        
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

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
        <script type="text/javascript" src="resources/cadastroequipamento/js/notifIt.js"></script>
        <!--BOOSTRAP 3.3.0--> 

        <!--DATEPICKER-->
        <link href="resources/geral/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
        <script src="resources/geral/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="resources/geral/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="resources/cadastroequipamento/css/notifIt.css"></link>
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
        <script src="http://xregexp.com/v/3.0.0/xregexp-all-min.js"></script>
        <!--GERAL-->

        <!-- CADASTRO EVENTO -->
        <script src="resources/cadastroequipamento/js/cadastroequipamento.js"></script>
        <!-- CADASTRO EVENTO -->
    </head>

    <body style="zoom: 85%; height: 100%;">
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
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Empresa
                            <select  id="idEmpresa" class="form-control"  readonly onchange="carregarFilial()" ></select>
                        </div>
                    </td>
                    <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Filial
                            <select  id="idFilial" class="form-control"  readonly onchange="carregarGrupo()"></select>
                        </div>
                    </td>
                    <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Código Grupo
                              <select  id="codGrupo" class="form-control"  readonly ></select>
                        </div>
                    </td>
                    <td  rowspan="4"  style="width: 30%; padding-left: 10px; padding-top: 10px; font-size: 14px; " readonly>
                        <div style="width: 350px; height: 300px; align-items: center; overflow:auto; border: 1px solid graytext;" id="imagemView" onclick="ampliarImagem()" readonly></div>
                    </td>
                </tr>
          
                 <tr>
                    <td  style="width: 20px; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Código Equipamento
                            <input type="text" class="form-control" id="codEquipamento"   placeholder="Código Equipamento" readonly>
                        </div>
                    </td> 
                    <td  style="width: 30%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Descrição
                            <input type="text" class="form-control" id="descricao"   placeholder="Descriçao" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Placa
                           <input type="text" class="form-control" id="placa"   placeholder="Placa" readonly>
                        </div>
                    </td>
                    
                </tr>
            
                 <tr>
                     <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Ano
                            <input type="number" class="form-control" id="ano"   placeholder="Ano" readonly>
                        </div>
                    </td>
                    <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Marca
                            <input type="text" class="form-control" id="marca"   placeholder="Marca" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Km Cadastro
                            <input type="number" class="form-control" id="kmCadastro"   placeholder="Km Cadastro" readonly>
                        </div>
                    </td>
                    
                    
                    
                </tr>
       
                <tr>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Data Aquisição
                            <input type="text" class="form-control" id="dataAquisicao"   placeholder="Data Aquisição" readonly>
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px; padding-top: 12px;  font-size: 14px;">
                        <div class="form">
                            <input type="checkbox" id="ativo" style="width: 30px; height: 30px; padding-top: 12px;" name="ativo" disabled="true"/>
                            <font size="4">Ativo</font>
                        </div>
                    </td>
                    
                   
                </tr>
                <tr>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                        <div class="form">
                            Apelido
                            <input type="text" class="form-control" id="apelido"   placeholder="Apelido" readonly>
                        </div>
                    </td>
                    <td  style="width: 35%;padding-right: 10px;font-size: 14px;">
                            <div class="form">
                               Imagem
                               <input type="file" class="form-control" id="imagem" enctype="multipart/form-data" placeholder="imagem"  readonly>
                        </div>
                    </td>
                    
                </tr>
       
                
     

           
        </table>
       
           <br><br>
           <div style='width: 99%; margin-left: 7px; margin-right: 4px; overflow-x: hidden'>
               <table id="grid" class="display" cellspacing="0" width="100%" style="overflow: hidden;">
                      <thead>
                          <tr>
                              <th>Empresa</th>
                              <th>Filial</th>
                              <th>Código Equipamento</th>
                              <th>Código Grupo</th>
                              <th>Placa</th>
                              <th>Apelido</th>
                              <th>Descrição</th>
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
                        <label for="inputEmail3" class="col-sm-2 control-label">Código Equipamento</label>
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
                        <label for="inputEmail3" class="col-sm-2 control-label">Descrição</label>
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