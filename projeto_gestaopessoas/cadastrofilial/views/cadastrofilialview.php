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
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO FILIAL -->
        <script src="resources/cadastrofilial/js/cadastrofilial.js"></script>
        <!-- CADASTRO FILIAL -->
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
                        <div class="form-group">
                            <font size="2">Identificação</font>
                            <input type="number" class="form-control" id="idFilial" placeholder="Identificação" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Empresa</font>
                            <select  id="empresa" class="form-control"  readonly></select>
                        </div>
                   </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Razão Social</font>
                            <input type="text" class="form-control" id="razaoSocial"  placeholder="Razão Social" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                             <font size="2">Nome Fantasia</font>
                            <input type="text" class="form-control" id="nomeFantasia" placeholder="Nome Fantasia" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Tipo</font>
                            <select  id="tipoFilial" class="form-control" readonly onchange="selecionarTipo()">
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="1">CEI</option>
                                    <option readonly value="2">CNPJ</option>
                            </select> 
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Código Fornecedor</font>
                            <input type="text" class="form-control" id="codigoCNPJ" maxlength="18"  placeholder="CNPJ" readonly onkeypress="mascaraCNPJ(this)">
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">CEI</font>
                            <input type="text" class="form-control" id="codigoCEI" maxlength="14"  placeholder="CNPJ" readonly onkeypress="mascaraCEI(this)">
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                      <div class="form-group">
                            <input type="checkbox" id="ativoFilial" name="ativoFilial" disabled="true"/>
                            <font size="2">Ativo</font>
                        </div>
                   </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <input type="checkbox" id="projetoFilial" name="projetoFilial" disabled="true"/> 
                            <font size="2">Projeto</font>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Inscrição Estadual</font>
                            <input type="text" class="form-control" id="inscricaoEstadual"  placeholder="Inscrição Estadual" readonly>
                        </div>
                   </td>
                    <td style="padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Inscrição Municipal</font>
                            <input type="text" class="form-control" id="inscricaoMunicipal"  placeholder="Inscrição Municipal" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                      <div class="form-group">
                            <font size="2">Cep</font>
                            <input type="text" class="form-control" id="cep"  maxlength="9"  placeholder="Cep" readonly onkeypress="mascaraCEP(this)">
                        </div>
                   </td>
                    
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Endereço</font>
                            <input type="text" class="form-control" id="endereco"   placeholder="Endereço" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Número</font>
                            <input type="text" class="form-control" id="numero"   placeholder="Número" readonly>
                        </div>
                    </td>
                    <td style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Cidade</font>
                            <input type="text" class="form-control" id="cidade"   placeholder="Cidade" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Bairro</font>
                            <input type="text" class="form-control" id="bairro"  placeholder="Bairro" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Estado</font>
                            <select id="estado" class="form-control"  readonly>
                                     <option readonly >Selecione</option>
                                     <option value ="AC"readonly>Acre</option>
                                     <option value ="AL"readonly>Alagoas</option>
                                     <option value ="AP"readonly>Amapá</option>
                                     <option value ="AM"readonly>Amazonas</option>
                                     <option value ="BA"readonly>Bahia</option>
                                     <option value ="CE"readonly>Ceará</option>
                                     <option value ="DF"readonly>Distrito Federal</option>
                                     <option value ="ES"readonly>Espírito Santo</option>
                                     <option value ="GO"readonly>Goiás</option>
                                     <option value ="MA"readonly>Maranhão</option>
                                     <option value ="MT"readonly>Mato Grosso</option>
                                     <option value ="MS"readonly>Mato Grosso do Sul</option>
                                     <option value ="MG"readonly>Minas Gerais</option>
                                     <option value ="PA"readonly>Pará</option>
                                     <option value ="PB"readonly>Paraíba</option>
                                     <option value ="PR"readonly>Paraná</option>
                                     <option value ="PE"readonly>Pernambuco</option>
                                     <option value ="PI"readonly>Piauí</option>
                                     <option value ="RJ"readonly>Rio de Janeiro</option>
                                     <option value ="RN"readonly>Rio Grande do Norte</option>
                                     <option value ="RS"readonly>Rio Grande do Sul</option>
                                     <option value ="RD"readonly>Rondônia</option>
                                     <option value ="RO"readonly>Roraima</option>
                                     <option value ="SC" readonly>Santa Catarina</option>
                                     <option value ="SP"readonly>São Paulo</option>
                                     <option value ="SE"readonly>Sergipe</option>
                                     <option value ="TO"readonly>Tocatins</option>
                                </select>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                      <div class="form-group">
                            <font size="2">País</font>
                            <input type="text" class="form-control" id="pais"   placeholder="País" readonly>
                        </div>
                   </td>
                    <td style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Telefone</font>
                            <input type="text" class="form-control" id="telefone1" size="20" maxlength="15"   placeholder="Telefone 1" readonly onkeypress="mascara(this)">
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Telefone</font>
                            <input type="text" class="form-control" id="telefone2" size="20" maxlength="15"   placeholder="Telefone 2" readonly onkeypress="mascara(this)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Celular</font>
                            <input type="text" class="form-control" id="celular" size="20" maxlength="15"  placeholder="Celular" readonly onkeypress="mascara(this)">
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                      <div class="form-group">
                            <font size="2">Email</font>
                            <input type="email" class="form-control" id="email"   placeholder="E-mail" readonly>
                        </div>
                   </td>
                    <td style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Data Cadastro</font>
                            <input type="text" class="form-control" id="dataCadastro"   placeholder="Data Cadastro" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Data Alteração</font>
                            <input type="text" class="form-control" id="dataAlteracao"  placeholder="Data Alteração" readonly>
                        </div>
                    </td>
                </tr>       
             
           
        </table>
       
           <br><br>
           <div style='width: 99%; margin-left: 7px; margin-right: 4px; overflow-x: hidden'>
                  <table id="grid" class="display" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>ID Empresa</th>
                              <th>Nome Fantasia</th>
                              <th>Ativo</th>                            
                              <th>Projeto</th>
                              <th>Cidade</th>                   
                              <th>Telefone</th>
                              <th>Celular</th>
                              <th>Email</th>
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