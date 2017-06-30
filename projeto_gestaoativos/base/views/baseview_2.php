<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VPI | Clarify</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="resources/base/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="resources/geral/css/font-awesome4.5.0.min.css" rel="stylesheet">
  <!-- Ionicons -->
  <link href="resources/geral/css/ionicons.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="resources/base/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="resources/base/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="resources/geral/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="resources/geral/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="resources/geral/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="resources/geral/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="resources/geral/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="resources/geral/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

        <!--JQUERY 1.11--> 
        <link href="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.css" rel="stylesheet">
        <script src="resources/geral/jquery/jquery-1.11.1.min.js"></script>
        <script src="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.js"></script>
        <!--JQUERY 1.11-->

        <!--MENU-->
        <link href="resources/geral/menu/simple-sidebar.css" rel="stylesheet">
        <!--MENU-->

        <!--NOTIFICAÇÕES-->
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/notificacoes/pnotify.custom.min.css" rel="stylesheet">
        <script src="resources/geral/notificacoes/pnotify.custom.min.js"></script>
        <!--NOTIFICAÇÕES-->

        <!--BOOSTRAP 3.3.0
        <link href="resources/geral/bootstrap/css/cerulean-theme/bootstrap.min.css" rel="stylesheet">
        <script src="resources/geral/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--BOOSTRAP 3.3.0--> 

        <!--BLOCKUI-->  
        <script src="resources/geral/blockUI/jquery.blockUI.js" type="text/javascript"></script>
        <!--BLOCKUI-->

        <!--BASE-->
        <link href="resources/base/css/base.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <script src="resources/base/js/base.js"></script>
        <script src="resources/base/js/bloquearTela.js"></script>
        <!--BASE-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">VPI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>VPI</b>Clarify</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
     
                      <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
              
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <img src="resources/base/dist/img/userVPI.png" class="user-image" alt="User Image">
              <span class="hidden-xs" id="nomeUsuarioLogado"><?= $nomeUsuarioLogado ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="resources/base/dist/img/userVPI.png" class="img-circle" alt="User Image">
                <p>
                 <span class="hidden-xs" id="nomeUsuarioLogado"><?= $nomeUsuarioLogado ?></span>
                  <small>Membro desde janeiro de 2017</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a style="cursor: pointer" onclick="window.location = 'index.php?m=login&c=login&f=logoff&redirect=base'" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          <li>
              <a style="cursor: pointer" onclick="window.location = 'index.php?m=login&c=login&f=logoff&redirect=base'"><i class="glyphicon glyphicon-off"></i> Sair</a>
          </li>
          
        </ul>
      </div>
      
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="resources/base/dist/img/userVPI.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><span id="nomeUsuarioLogado"><?= $nomeUsuarioLogado ?></span></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Procurar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">CLARIFY - Gestão de Ativos</li>
        
        <!-- Menu Setup de Sistema --> 
        
         <li class="active treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Setup de Sistema</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a onclick="adicionarAba('Cadastro de Empresa', 'CAMAROTE_01_01', 'camarote-01-01', 'index.php?m=cadastroempresa&c=cadastroempresacontroller', 'resources/geral/images/cadastroempresa.png')" href="#"><i class="fa fa-building-o"></i> Cadastro Empresa</a></li>
            <li><a onclick="adicionarAba('Cadastro Grupo Empresa', 'CAMAROTE_01_03', 'camarote-01-03', 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller', 'resources/geral/images/grupo.png')" href="#"><i class="fa fa-building-o"></i>Cadastro Grupo Empresa</a></li>
            <li><a onclick="adicionarAba('Cadastro Filial', 'CAMAROTE_01_04', 'camarote-01-04', 'index.php?m=cadastrofilial&c=cadastrofilialcontroller', 'resources/geral/images/filial.jpg')" href="#"><i class="fa fa-building-o"></i>Cadastro Filial</a></li>
            <li><a onclick="adicionarAba('Cadastro Usuario', 'CAMAROTE_01_05', 'camarote-01-05', 'index.php?m=cadastrousuario&c=cadastrousuariocontroller', 'resources/geral/images/usuario.jpg')" href="#"><i class="fa fa-building-o"></i>Cadastro Usuário</a></li>
            <li><a onclick="adicionarAba('Cadastro Fornecedor Cliente', 'CAMAROTE_01_06', 'camarote-01-06', 'index.php?m=cadastrofornecedorcliente&c=cadastrofornecedorclientecontroller', 'resources/geral/images/fornecedor.jpg')" href="#"><i class="fa fa-building-o"></i> Cadastro Fornecedor Cliente</a></li> 
          </ul>
        </li>
       
        
        <!-- Menu Gestão Ativos --> 
        
         <li class="active treeview">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>Gestão Ativos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a onclick="adicionarAba('Cadastro CheckList', 'GestaoAtivos_01_01', 'gestaoAtivos-01-01', 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller', 'resources/geral/images/cadastrochecklist.jpg')" href="#"><i class="fa fa-list-alt"></i>Cadastro Checklist</a></li> 
          </ul>
        </li>
        
        <!-- Menu Sair --> 
        
         <li class="active treeview">
          <a style="cursor: pointer" onclick="window.location = 'index.php?m=login&c=login&f=logoff&redirect=base'">
              <i class="glyphicon glyphicon-off"></i>
              <span>Sair</span>
          </a>
         </li>
        
        

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
        
     <!--LISTA DE PROGRAMAS--> 

            <!--LISTA DE ABAS-->
            <div style='margin-top: 1px; zoom: 90%; height: 90%;' >
                <ul style="background-color: #3C8DBC;" class="nav nav-tabs ulAbas" id="listaAbas"></ul>
                <div class="tab-content" id="listAFAVORITOS" style="zoom: 90%; height: 90%; "></div>
                <div class="tab-content" id="listaConteudoAbas" style="zoom: 90%; height: 90%; "></div>
            </div>
            <!--LISTA DE ABAS-->

  </div>
     
  <!-- /.content-wrapper -->
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2017-2016 <a href="http://www.vpitecnologia.com.br">VPI Tecnologia</a>.</strong> All rights
    reserved.
  </footer>
  

<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="resources/base/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="resources/base/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="resources/base/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="resources/base/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="resources/base/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="resources/base/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="resources/base/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="resources/base/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="resources/base/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="resources/base/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="resources/base/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="resources/base/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="resources/base/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="resources/base/dist/js/demo.js"></script>
</body>
</html>
