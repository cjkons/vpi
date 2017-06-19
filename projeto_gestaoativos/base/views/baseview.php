<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <title>VPI Tecnologia - Clarify GA</title>
        <meta charset="UTF-8"/>

        <!--JQUERY 1.11--> 
        <link href="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.css" rel="stylesheet">
        <script src="resources/geral/jquery/jquery-1.11.1.min.js"></script>
        <script src="resources/geral/jquery/jquery-ui-1.11.2/jquery-ui.min.js"></script>
        <!--JQUERY 1.11-->

        <!--MENU-->
        <link href="resources/geral/menu/simple-sidebar.css" rel="stylesheet">
        <link href="resources/base/css/wrapper.css" rel="stylesheet">
        <!--MENU-->

        <!--NOTIFICAÇÕES-->
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/notificacoes/pnotify.custom.min.css" rel="stylesheet">
        <script src="resources/geral/notificacoes/pnotify.custom.min.js"></script>
        <!--NOTIFICAÇÕES-->

        <!--BOOSTRAP 3.3.0--> 
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

    <body style="zoom: 85%;">
        
        
        <nav id='barra_superior' style="border-color: #579ce9" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand glyphicon glyphicon-list" onclick='toggleMenuEsquerdo()' href="#"></a>		  

                    <a class="navbar-brand" href="#" >CLARIFY - Gestão de Ativos</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" style='padding-right: 0px;'>

                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                <i class="glyphicon glyphicon-user" aria-hidden="true"></i>  <span id="nomeUsuarioLogado"><?= $nomeUsuarioLogado ?></span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" style="width: 300px;">

                                <li><a onclick="adicionarAbaSemFavorito('Configurações', 'CONFIG_01_04', 'config-01-04', 'index.php?m=admusuario&c=configuracoesusuariocontroller')" href="#"><i class="glyphicon glyphicon-cog"></i> Configurações</a></li>
                                <li><a style="cursor: pointer" onclick="window.location = 'index.php?m=login&c=login&f=logoff&redirect=base'"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div> 
        </nav>
<!--FINAL BARRA SUPERIOR-->

        <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       Brand
                    </a>
                </li>
                <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_camarote" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Adm Sistema
                                <div class="collapse" id="menu_esquerdo_camarote" style="height: 0px;">
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_camarote" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais
                                                 <div class="collapse" id="sub_menu_esquerdo_camarote" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro de Empresa', 'CAMAROTE_01_01', 'camarote-01-01', 'index.php?m=cadastroempresa&c=cadastroempresacontroller', 'resources/geral/images/cadastroempresa.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Empresa</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Grupo Empresa', 'CAMAROTE_01_03', 'camarote-01-03', 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller', 'resources/geral/images/grupo.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Grupo Empresa</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Filial', 'CAMAROTE_01_04', 'camarote-01-04', 'index.php?m=cadastrofilial&c=cadastrofilialcontroller', 'resources/geral/images/filial.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Filial</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Usuario', 'CAMAROTE_01_05', 'camarote-01-05', 'index.php?m=cadastrousuario&c=cadastrousuariocontroller', 'resources/geral/images/usuario.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Usuário</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Fornecedor Cliente', 'CAMAROTE_01_06', 'camarote-01-06', 'index.php?m=cadastrofornecedorcliente&c=cadastrofornecedorclientecontroller', 'resources/geral/images/fornecedor.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Fornecedor Cliente</a>
                                                         </li> 
                                                    </ul>
                                                 </div>
                                             </a>
                                         </li>
                                        
                                    </ul>
                                </div>
                            </a>
                        </li>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">Team</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Adm Sistema <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Dropdown heading</li>
                    <li><a onclick="adicionarAba('Cadastro de Empresa', 'CAMAROTE_01_01', 'camarote-01-01', 'index.php?m=cadastroempresa&c=cadastroempresacontroller', 'resources/geral/images/cadastroempresa.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Empresa</a></li>
                    <li><a onclick="adicionarAba('Cadastro Grupo Empresa', 'CAMAROTE_01_03', 'camarote-01-03', 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller', 'resources/geral/images/grupo.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Grupo Empresa</a></li>
                    <li><a onclick="adicionarAba('Cadastro Filial', 'CAMAROTE_01_04', 'camarote-01-04', 'index.php?m=cadastrofilial&c=cadastrofilialcontroller', 'resources/geral/images/filial.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Filial</a></li>
                    <li><a onclick="adicionarAba('Cadastro Usuario', 'CAMAROTE_01_05', 'camarote-01-05', 'index.php?m=cadastrousuario&c=cadastrousuariocontroller', 'resources/geral/images/usuario.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Usuário</a></li>
                    <li><a onclick="adicionarAba('Cadastro Fornecedor Cliente', 'CAMAROTE_01_06', 'camarote-01-06', 'index.php?m=cadastrofornecedorcliente&c=cadastrofornecedorclientecontroller', 'resources/geral/images/fornecedor.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Fornecedor Cliente</a></li>
                  </ul>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="https://twitter.com/maridlcrmn">Follow me</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
    			<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1>Fancy Toggle Sidebar Navigation</h1>
                        <p>Bacon ipsum dolor sit amet tri-tip shoulder tenderloin shankle. Bresaola tail pancetta ball tip doner meatloaf corned beef. Kevin pastrami tri-tip prosciutto ham hock pork belly bacon pork loin salami pork chop shank corned beef tenderloin meatball cow. Pork bresaola meatloaf tongue, landjaeger tail andouille strip steak tenderloin sausage chicken tri-tip. Pastrami tri-tip kielbasa sausage porchetta pig sirloin boudin rump meatball andouille chuck tenderloin biltong shank </p>
                        <p>Pig meatloaf bresaola, spare ribs venison short loin rump pork loin drumstick jowl meatball brisket. Landjaeger chicken fatback pork loin doner sirloin cow short ribs hamburger shoulder salami pastrami. Pork swine beef ribs t-bone flank filet mignon, ground round tongue. Tri-tip cow turducken shank beef shoulder bresaola tongue flank leberkas ball tip.</p>
                        <p>Filet mignon brisket pancetta fatback short ribs short loin prosciutto jowl turducken biltong kevin pork chop pork beef ribs bresaola. Tongue beef ribs pastrami boudin. Chicken bresaola kielbasa strip steak biltong. Corned beef pork loin cow pig short ribs boudin bacon pork belly chicken andouille. Filet mignon flank turkey tongue. Turkey ball tip kielbasa pastrami flank tri-tip t-bone kevin landjaeger capicola tail fatback pork loin beef jerky.</p>
                        <p>Chicken ham hock shankle, strip steak ground round meatball pork belly jowl pancetta sausage spare ribs. Pork loin cow salami pork belly. Tri-tip pork loin sausage jerky prosciutto t-bone bresaola frankfurter sirloin pork chop ribeye corned beef chuck. Short loin hamburger tenderloin, landjaeger venison porchetta strip steak turducken pancetta beef cow leberkas sausage beef ribs. Shoulder ham jerky kielbasa. Pig doner short loin pork chop. Short ribs frankfurter rump meatloaf.</p>
                        <p>Filet mignon biltong chuck pork belly, corned beef ground round ribeye short loin rump swine. Hamburger drumstick turkey, shank rump biltong pork loin jowl sausage chicken. Rump pork belly fatback ball tip swine doner pig. Salami jerky cow, boudin pork chop sausage tongue andouille turkey.</p>                         
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->









<!--WRAPPER ATUAL-->
        <div id="wrapper" style='padding-top: 20px;' >

            <!--LISTA DE PROGRAMAS-->
            <div id="sidebar-wrapper" style="height: 100%; background-color: #f2f2f2;">

                <div style='height: 200px;padding-top: 50px;width: 100%; white-space: nowrap;' align='center'>
                    <br />
                    <img style='width: 100%;' src='resources/geral/images/LOGO_ADM_CAMAROTE.png'/>

                    <br />

                    <small>VPI Tecnologia</small>
                </div>

                <div style='height: 69%; overflow-y: auto; border-top: solid #1a6ecc; overflow-x: hidden'>

                    <ul class="sidebar-nav" >

                        <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_camarote" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Adm Sistema
                                <div class="collapse" id="menu_esquerdo_camarote" style="height: 0px;">
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_camarote" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais
                                                 <div class="collapse" id="sub_menu_esquerdo_camarote" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro de Empresa', 'CAMAROTE_01_01', 'camarote-01-01', 'index.php?m=cadastroempresa&c=cadastroempresacontroller', 'resources/geral/images/cadastroempresa.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Empresa</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Grupo Empresa', 'CAMAROTE_01_03', 'camarote-01-03', 'index.php?m=cadastrogrupoempresa&c=cadastrogrupoempresacontroller', 'resources/geral/images/grupo.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Grupo Empresa</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Filial', 'CAMAROTE_01_04', 'camarote-01-04', 'index.php?m=cadastrofilial&c=cadastrofilialcontroller', 'resources/geral/images/filial.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Filial</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Usuario', 'CAMAROTE_01_05', 'camarote-01-05', 'index.php?m=cadastrousuario&c=cadastrousuariocontroller', 'resources/geral/images/usuario.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Usuário</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Fornecedor Cliente', 'CAMAROTE_01_06', 'camarote-01-06', 'index.php?m=cadastrofornecedorcliente&c=cadastrofornecedorclientecontroller', 'resources/geral/images/fornecedor.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Fornecedor Cliente</a>
                                                         </li> 
                                                    </ul>
                                                 </div>
                                             </a>
                                         </li>
                                        
                                    </ul>
                                </div>
                            </a>
                        </li>
                        <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_gestaoAtivos" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Gestão Ativos
                                <div class="collapse" id="menu_esquerdo_gestaoAtivos" style="height: 0px;">
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Cadastro CheckList', 'GestaoAtivos_01_01', 'gestaoAtivos-01-01', 'index.php?m=cadastrochecklist&c=cadastrochecklistcontroller', 'resources/geral/images/cadastrochecklist.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Checklist</a>
                                        </li> 
                                    </ul>
                                </div>    
                            </a>
                        </li> 
                        
                        <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_config" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Configurações
                                <div class="collapse" id="menu_esquerdo_config" style="height: 0px;">
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Cadastro Usuario', 'CAMAROTE_01_05', 'camarote-01-05', 'index.php?m=cadastrousuario&c=cadastrousuariocontroller', 'resources/geral/images/usuario.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Usuário</a>
                                        </li> 
                                        <li>
                                            <a onclick="adicionarAba('Controle de Acesso', 'CONFIG_01_02', 'config-01-02', 'index.php?m=admusuario&c=controleacessocontroller', 'glyphicon glyphicon-lock')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-lock' style=''></span>Controle de Acesso</a>
                                        </li> 
                                    </ul>
                                </div>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <!--LISTA DE PROGRAMAS--> 

            <!--LISTA DE ABAS-->
            <div style='margin-top: 30px;height: 100%;' >
                <ul class="nav nav-tabs ulAbas" id="listaAbas"></ul>
                <div class="tab-content" id="listAFAVORITOS" style="height: 100%;"></div>
                <div class="tab-content" id="listaConteudoAbas" style="height: 100%;"></div>
            </div>
            <!--LISTA DE ABAS-->
        </div>
    </body>
</html>