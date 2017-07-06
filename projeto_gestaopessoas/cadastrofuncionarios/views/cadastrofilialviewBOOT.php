<html>
  <head>
    <meta charset="UTF-8">
    <title>EngSys</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       <link rel='stylesheet' type='text/css' href='resources/geral/css/sig/estilo.css'></link>
    
        <link rel='stylesheet' type='text/css' href='resources/sig/css/estilo.css'></link>
	  
    <!-- Bootstrap 3.3.4 -->
    <link href="resources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    
    <link rel='stylesheet' type='text/css' href='resources/geral/js/jquery/plugins/datatables/jquery.dataTables.css'></link>
    <!-- Theme style -->
    <link href="resources/sig/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="resources/sig/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="resources/sig/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="resources/sig/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="resources/sig/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="resources/sig/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="resources/sig/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="resources/sig/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    
    
    
    
     
    <link href="resources/login/alertify/themes/alertify.core.css" rel="stylesheet">
    <link href="resources/login/alertify/themes/alertify.default.css" rel="stylesheet">
    <script type='text/javascript' src='resources/geral/js/jquery/jquery.js'></script> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>.dataTables_info{font-size: 10px;}</style>
  <style>.dataTables_length label{font-size: 12px;}</style>
  <style>.paginate_button label{font-size: 12px;}</style>
  <style>.paginate_button a{font-size: 12px;}</style>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php?m=sig&c=sig" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ENG</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ENGSYS</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
           
          </a>
          
        </nav>
      </header>
	 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
         
        
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Navega&ccedil&atildeo</li>
                     
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Adm Sistema</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?m=cadastrofilial&c=cadastrofilial"><i class="fa fa-circle-o"></i> Cadastro Filial</a></li>
                <li><a href="index.php?m=cadastroempresa&c=cadastroempresa"><i class="fa fa-circle-o"></i> Cadastro Empresa</a></li>
                <li><a href="index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresa"><i class="fa fa-circle-o"></i> Cadastro Grupo Empresa</a></li>
                <li><a href="index.php?m=cadastrousuario&c=cadastrousuario"><i class="fa fa-circle-o"></i> Cadastro Usuario</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Engenharia</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Orçamento</a></li>
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Planejamento</a></li>
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Controle</a></li>
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Gestão de projetos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Financeiro</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Contas a Pagar</a></li>
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Contas a Receber</a></li>
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Transações Bancárias</a></li>
                <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Gestão de Contratos Financeiros</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Suprimentos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Compras</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Requisição de Compras</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Cotação de Fornecedores</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Designação de Fornecedores</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Aprovações</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Pedidos de Compras</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Follow up</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Estoque</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Movimentação</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Implatação de Saldos</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Transfêrencias</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Manutenção Custo Médio</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Reserva Estoque</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Fechamento Mensal</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Relatórios</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Recebimentos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Entradas de Notas Fiscais</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Entrada de Fretes</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Devolução a Fornecedores</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Contrato e Medições</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Cadastro de Contratos</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Medições</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Portal Fornecedor</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Integração Contábil - Fiscal</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Parâmetros</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="index.php?m=cadastrofornecedorcliente&c=cadastrofornecedorcliente"><i class="fa fa-circle-o"></i> Cadastro Fornecedor/Cliente</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Cadastro de Itens</a></li>
                        <li><a href="index.php?m=cadastrounidademedida&c=cadastrounidademedida"><i class="fa fa-circle-o"></i> Cadastro Unidades de Medida</a></li>
                        <li><a href="index.php?m=cadastrofamilia&c=cadastrofamilia"><i class="fa fa-circle-o"></i> Cadastro Família Itens</a></li>
                        <li><a href="pages/examples/4041.html"><i class="fa fa-circle-o"></i> Cadastro Compradores</a></li>
                    </ul>
                </li>
              </ul>
            </li>
         </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      
        
        
        
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <link href="resources/cadastrofamilia/css/bootstrap.min.css" rel="stylesheet">
        <script src="resources/cadastrofilial/js/cadastrofilial.js" type="text/javascript"></script>
        
        
        <script type='text/javascript' src='resources/geral/js/jquery/plugins/jqgrid/js/jquery.jqGrid.min.js'></script>
        <script type='text/javascript' src='resources/geral/js/jquery/plugins/jqgrid/js/i18n/grid.locale-pt-br.js'></script>
                 
        
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           
                          
          <nav class="navbar navbar-default">
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
                <a onclick="buscaPrimeiroRegistro()"  class="btn btn-primary ">
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
        <section class="content-header">      
         <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Identificação</font>
                            <input type="number" class="form-control" id="idFilial" placeholder="Identificação" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Empresa</font>
                            <select  id="empresa" class="form-control"  readonly></select>
                        </div>
                   </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Razão Social</font>
                            <input type="text" class="form-control" id="razaoSocial"  placeholder="Razão Social" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form-group">
                             <font size="2">Nome Fantasia</font>
                            <input type="text" class="form-control" id="nomeFantasia" placeholder="Nome Fantasia" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                       <div class="form-group">
                            <font size="2">Tipo</font>
                            <select  id="tipoFilial" class="form-control" readonly onchange="selecionarTipo()">
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="1">CEI</option>
                                    <option readonly value="2">CNPJ</option>
                            </select> 
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
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
                    <td  style="padding-right: 5px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Endereço</font>
                            <input type="text" class="form-control" id="endereco"   placeholder="Endereço" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Número</font>
                            <input type="text" class="form-control" id="numero"   placeholder="Número" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                      <div class="form-group">
                            <font size="2">Cep</font>
                            <input type="text" class="form-control" id="cep"  maxlength="9"  placeholder="Cep" readonly onkeypress="mascaraCEP(this)">
                        </div>
                   </td>
                    <td style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            <font size="2">Cidade</font>
                            <input type="text" class="form-control" id="cidade"   placeholder="Cidade" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
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
                                     <option readonly>Selecione</option>
                                     <option readonly>Acre</option>
                                     <option readonly>Alagoas</option>
                                     <option readonly>Amapá</option>
                                     <option readonly>Amazonas</option>
                                     <option readonly>Bahia</option>
                                     <option readonly>Ceará</option>
                                     <option readonly>Distrito Federal</option>
                                     <option readonly>Espírito Santo</option>
                                     <option readonly>Goiás</option>
                                     <option readonly>Maranhão</option>
                                     <option readonly>Mato Grosso</option>
                                     <option readonly>Mato Grosso do Sul</option>
                                     <option readonly>Minas Gerais</option>
                                     <option readonly>Pará</option>
                                     <option readonly>Paraíba</option>
                                     <option readonly>Paraná</option>
                                     <option readonly>Pernambuco</option>
                                     <option readonly>Piauí</option>
                                     <option readonly>Rio de Janeiro</option>
                                     <option readonly>Rio Grande do Norte</option>
                                     <option readonly>Rio Grande do Sul</option>
                                     <option readonly>Rondônia</option>
                                     <option readonly>Roraima</option>
                                     <option readonly>Santa Catarina</option>
                                     <option readonly>São Paulo</option>
                                     <option readonly>Sergipe</option>
                                     <option readonly>São Paulo</option>
                                     <option readonly>Sergipe</option>
                                     <option readonly>Tocatins</option>
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
                    <td  style="padding-right: 5px;font-size: 14px;">
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
                    <td  style="padding-right: 5px;font-size: 14px;">
                          <div class="form-group">
                            <font size="2">Data Alteração</font>
                            <input type="text" class="form-control" id="dataAlteracao"  placeholder="Data Alteração" readonly>
                        </div>
                    </td>
                </tr>       
        </table>
            <br><br>
             <div style='width: 100%; overflow-x: hidden'>
                <table id="grid" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Empresa</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>Cod Empresa</th>
                            <th>Cei</th>
                            <th>Ativo</th>                            
                            <th>Projeto</th>
                            <th>Inscrição Estadual</th>
                            <th>Inscrição Municipal</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Cep</th>
                            <th>Cidade</th>                   
                            <th>Bairro</th>
                            <th>Estado</th>
                            <th>Pais</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Data Cadastro</th>
                            <th>Data Alteração</th>
                        </tr>
                    </thead>
                </table>
            </div>
            
            
            
            
            
        </section>  
              
        
        
        <!-- Main content -->
        <section class="content">
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong> 2015 <a href="">Empresa X</a>.</strong> Todos os Direitos Reservados.
      </footer>
      
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
	
	
	

    <!-- PRA RODAR  GRID/TABELAS -->
     <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    
     <!-- jQuery 2.1.4 -->
    <script src="resources/sig/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="resources/sig/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="resources/sig/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="resources/sig/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="resources/sig/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='resources/sig/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="resources/sig/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="resources/sig/dist/js/demo.js" type="text/javascript"></script>
     <!-- page script -->
     
     
     

                
        
    
    <link rel='stylesheet' type='text/css' href='resources/geral/js/jquery/plugins/datatables/jquery.dataTables.css'></link>
        
    
	  
	  
	  
    </body>  