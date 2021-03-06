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
                  <a onclick="adicionarAba('Help Desk', 'HELPDESK_01_01', 'helpdesk-01-01', 'index.php?m=chamadotecnico&c=visualizarchamadocontroller', 'resources/geral/images/visualizarchamado.png')" href="#" class="btn btn-default btn-flat">Help Desk</a>
            
                </div>
                <div class="pull-right">
                  <a style="cursor: pointer" onclick="window.location = 'index.php?m=login&c=login&f=logoff&redirect=base'" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
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
            <li><a onclick="adicionarAba('Cadastro de Empresa', 'GASetup_01_01', 'gasetup-01-01', 'index.php?m=cadastroempresa&c=cadastroempresacontroller', 'resources/geral/images/cadastroempresa.png')" href="#"><i class="fa fa-cog"></i> Cadastro Empresa</a></li>
            <li><a onclick="adicionarAba('Cadastro Grupo Empresa', 'GASetup_01_02', 'gasetup-01-02', 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller', 'resources/geral/images/cadastrogrupoempresa.png')" href="#"><i class="fa fa-university"></i>Cadastro Grupo Empresa</a></li>
            <li><a onclick="adicionarAba('Cadastro Filial', 'GASetup_01_03', 'gasetup-01-03', 'index.php?m=cadastrofilial&c=cadastrofilialcontroller', 'resources/geral/images/cadastrofilial.png')" href="#"><i class="fa fa-home"></i>Cadastro Filial</a></li>
           <li><a onclick="adicionarAba('Cadastro Usuario', 'GASetup_01_04', 'gasetup-01-04', 'index.php?m=cadastrousuario&c=cadastrousuariocontroller', 'resources/geral/images/cadastrousuario.png')" href="#"><i class="fa fa-male"></i>Cadastro Usuário</a></li>
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
            <li><a onclick="adicionarAba('Cadastro CheckList', 'EQUIPAMENTOS_01_01', 'equipamentos-01-01', 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller', 'resources/geral/images/cadastrochecklist.png')" href="#"><i class="fa fa-check-square"></i>Cadastro Checklist</a></li> 
            <li><a onclick="adicionarAba('Cadastro Equipamento', 'EQUIPAMENTOS_01_02', 'equipamentos-01-02', 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller', 'resources/geral/images/cadastroequipamentos.png')" href="#"><i class="fa fa-car"></i>Cadastro Equipamento</a></li>
            <li><a onclick="adicionarAba('Cadastro Grupo Equipamento', 'EQUIPAMENTOS_01_03', 'equipamentos-01-03', 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller', 'resources/geral/images/cadastrogrupoequipamentos.png')" href="#"><i class="fa fa-list-alt"></i>Cadastro Grupo Equipamento</a></li>
          <li><a onclick="adicionarAba('Cadastro Plano Preventivo', 'EQUIPAMENTOS_01_04', 'equipamentos-01-04', 'index.php?m=cadastroplanopreventivo&c=cadastroplanopreventivocontroller', 'resources/geral/images/cadastroplanopreventivo.png')" href="#"><i class="fa fa-line-chart"></i>Cadastro Plano Preventivo</a></li>
          </ul>
        </li>
        
        <!-- Menu Suprimentos --> 
        
         <li class="active treeview">
          <a href="#">
            <i class="fa fa-medkit"></i>
            <span>Suprimentos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a onclick="adicionarAba('Cadastro Comprador', 'Suprimentos_01_01', 'suprimentos-01-01', 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller', 'resources/geral/images/cadastrocomprador.png')" href="#"><i class="fa fa-money"></i>Cadastro Comprador</a></li>
            <li><a onclick="adicionarAba('Cadastro Familia', 'Suprimentos_01_02', 'suprimentos-01-02', 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller', 'resources/geral/images/cadastrofamilia.png')" href="#"><i class="fa fa-users"></i>Cadastro Família</a></li>
            <li><a onclick="adicionarAba('Cadastro Item', 'Suprimentos_01_03', 'suprimentos-01-03', 'index.php?m=cadastroitem&c=cadastroitemcontroller', 'resources/geral/images/cadastroitem.png')" href="#"><i class="fa fa-list-alt"></i>Cadastro Item</a></li>
            <li><a onclick="adicionarAba('Cadastro Unidade Medida', 'Suprimentos_01_04', 'suprimentos-01-04', 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller', 'resources/geral/images/cadastrounidademedida.png')" href="#"><i class="fa fa-tachometer"></i>Cadastro Unidade Medida</a></li>
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
  
  <div class="content-wrapper" >
        
     <!--LISTA DE PROGRAMAS--> 

            <!--LISTA DE ABAS-->
            <div style='margin-top: 1px; zoom: 90%; height: auto;' >
                <ul style="background-color: #222D32;" class="nav nav-tabs ulAbas" id="listaAbas"></ul>
                <div class="tab-content" id="listAFAVORITOS" style="zoom: 90%; height: auto; "></div>
                <div class="tab-content" id="listaConteudoAbas" style="zoom: 90%; height: auto; "></div>
            </div>
            <!--LISTA DE ABAS-->

  </div>
  </div>    
  <!-- /.content-wrapper -->
  

  
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="resources/geral/plugins/jQuery/jquery-2.2.3.min.js"></script>
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
<script src="resources/geral/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="resources/geral/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="resources/geral/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="resources/geral/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="resources/geral/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="resources/geral/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="resources/geral/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="resources/geral/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="resources/geral/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="resources/geral/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="resources/base/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="resources/base/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="resources/base/dist/js/demo.js"></script>

          
          
         
           
        </div>
    </body>
    
    <footer style="text-align: center; background-color: #ffffff; position: fixed; " class="footer" >
        <div class="main-footer"style="text-align: center; background-color: #ffffff;; padding: 0px;">
      <b>Version</b> 2.3.8  - 
    
    <strong>Copyright &copy; 2016-2017 <a href="http://www.vpitecnologia.com.br">VPI Tecnologia</a>.</strong> All rights
    
    reserved.
    </div>
  </footer>
    
</html>