<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>VPI Gestão</title>
        <meta charset="UTF-8"/>

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
        
        <nav id='barra_superior' style="border-color: #579ce9;" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand glyphicon glyphicon-list" onclick='toggleMenuEsquerdo()' href="#"></a>		  

                    <a class="navbar-brand" href="#" >VPI Gestão</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" style='padding-right: 0px;'>

                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                <i class="glyphicon glyphicon-user" aria-hidden="true"></i>  <span id="nomeUsuarioLogado"><?= $nomeUsuarioLogado ?></span> <span class="caret"></span>
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

        <div id="wrapper" style='padding-top: 20px;' >

            <!--LISTA DE PROGRAMAS-->
            <div id="sidebar-wrapper" style="height: 100%; background-color: #f2f2f2;">

                <div style='height: 200px;padding-top: 50px;width: 100%; white-space: nowrap;' align='center'>

                    <img style='width: 100%;' src='resources/geral/images/LOGO_ADM_CAMAROTE.png'/>

                    <br />

                    <small>VPI Gestão</small>
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
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_custo" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Custos
                                <div class="collapse" id="menu_esquerdo_custo" style="height: 0px;">
				               
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_custo_b" class="collapsed">
                                                <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Boletins
                                                <div class="collapse" id="sub_menu_esquerdo_custo_b" style="height: 0px;">
                                                    <ul>
                                                        <li>
                                                            <a onclick="adicionarAba('Despesa Informada', 'CUSTO_01_05', 'custo-01-05', 'index.php?m=despesainformada&c=despesainformadacontroller', 'resources/geral/images/despinf.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Despesa Informada</a>
                                                        </li> 
                                                        <li>
                                                            <a onclick="adicionarAba('Medicao', 'CUSTO_01_03', 'custo-01-03', 'index.php?m=customedicao&c=customedicaocontroller', 'resources/geral/images/medicao.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Medição Cliente</a>
                                                        </li> 
                                                        <li>
                                                            <a onclick="adicionarAba('Medicao Fornecedor', 'CUSTO_01_04', 'custo-01-04', 'index.php?m=customedicaofornecedor&c=customedicaofornecedorcontroller', 'resources/geral/images/medicaofornecedor.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Medição Fornecedor</a>
                                                        </li> 
                                                    </ul>
                                                 </div>
                                             </a>
                                         </li>
                                        
                                    </ul>                                  
                                 
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_custo" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais
                                                 <div class="collapse" id="sub_menu_esquerdo_custo" style="height: 0px;">
                                                    <ul>
                                                        <li>
                                                             <a onclick="adicionarAba('Cadastro Grupo Atividade', 'CUSTO_01_01', 'custo-01-01', 'index.php?m=cadastrogrupoatividade&c=cadastrogrupoatividadecontroller', 'resources/geral/images/grupoatividade.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Grupo Atividade</a>
                                                        </li>
                                                        <li>
                                                             <a onclick="adicionarAba('Cadastro Atividade', 'CUSTO_01_02', 'custo-01-02', 'index.php?m=cadastroatividade&c=cadastroatividadecontroller', 'resources/geral/images/atividade.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Atividade</a>
                                                        </li>
                                                        <li>
                                                            <a onclick="adicionarAba('Contrato Fornecedor', 'CUSTO_01_06', 'custo-01-06', 'index.php?m=contratofornecedor&c=contratofornecedorcontroller', 'resources/geral/images/contrato.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Contrato Fornecedor</a>
                                                        </li> 
                                                    </ul>
                                                 </div>
                                             </a>
                                         </li>
                                        
                                    </ul>
									<ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_relatorio_custo" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Relatórios
                                                 <div class="collapse" id="sub_menu_esquerdo_relatorio_custo" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Relatorio Medicao', 'CUSTO_01_06', 'custo-01-06', 'index.php?m=relatoriomedicao&c=relatoriomedicaocontroller', 'glyphicon glyphicon-user')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Relatório Medição</a>
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
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_daschboard" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>DashBoard
                                <div class="collapse" id="menu_esquerdo_daschboard" style="height: 0px;">
                                     <ul>
                                        <li>
                                            <a onclick="adicionarAba('DashBoard Custos', 'DASHBOARCUSTO_03_08', 'dashboard-06-02', 'index.php?m=daschboardcustos&c=daschboardcustoscontroller', 'resources/geral/images/daschboarcustos.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Custos</a>
                                        </li> 
                                    </ul>
                                     <ul>
                                        <li>
                                            <a onclick="adicionarAba('DashBoard Faturamento', 'DASHBOARDFATURAMENTO_03_09', 'dashboard-06-03', 'index.php?m=daschboardfaturamento&c=daschboardfaturamentocontroller', 'resources/geral/images/daschboardfaturamento.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Faturamento</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('DashBoard Financeiro', 'DASHBOARDFINANCEIRO_03_07', 'dashboard-06-01', 'index.php?m=daschboardfinanceiro&c=daschboardfinanceirocontroller', 'resources/geral/images/daschboardfinanceiro.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Financeiro</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('DashBoard Gestão de Frota', 'DASHBOARDGESTAODEFROTA_03_09', 'dashboard-06-04', 'index.php?m=daschboardgestaodefrota&c=daschboardgestaodefrotacontroller', 'resources/geral/images/gestaodefrota.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Gestão de Frotas</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('DashBoard Suprimentos', 'DASHBOARDSUPRIMENTOS_03_09', 'dashboard-06-04', 'index.php?m=daschboardsuprimentos&c=daschboardsuprimentoscontroller', 'resources/geral/images/suprimentos.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Suprimentos</a>
                                        </li> 
                                    </ul>
                                      <ul>
                                        <li>
                                            <a onclick="adicionarAba('DashBoard Vendas', 'DASHBOARDVENDAS_03_09', 'dashboard-06-04', 'index.php?m=daschboardvendas&c=daschboardvendascontroller', 'resources/geral/images/vendas.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Suprimentos</a>
                                        </li> 
                                    </ul>
                                    
                                   
                                    
                                </div>    
                            </a>
                        </li>                
                        <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_financeiro" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Financeiro
                                <div class="collapse" id="menu_esquerdo_financeiro" style="height: 0px;">
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Cockpit Contas a Pagar', 'FINANCEIRO_03_07', 'camarote-03-07', 'index.php?m=cockpitcontasapagar&c=cockpitcontasapagarcontroller', 'resources/geral/images/contas_pagar.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Contas a Pagar</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Cockpit Contas a Receber', 'FINANCEIRO_03_08', 'camarote-03-08', 'index.php?m=cockpitcontasareceber&c=cockpitcontasarecebercontroller', 'resources/geral/images/contas_receber.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Contas a Receber</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                            <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_financeiro_fluxo" class="collapsed">
                                                <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Fluxo de Caixa  
                                                <div class="collapse" id="sub_menu_esquerdo_financeiro_fluxo" style="height: 0px;">
                                                    <ul>
                                                        <li>
                                                            <a onclick="adicionarAba('Fluxo de caixa diário', 'FINFLUXOCAIXA_01_01', 'finfluxocaixa-01-01', 'index.php?m=fluxocaixadiario&c=fluxocaixadiariocontroller', 'resources/geral/images/fluxo_caixa_diario.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Fluxo de caixa diário</a>
                                                        </li>                                                        
                                                    </ul>

                                                </div>
                                            </a>
                                        </li>

                                    </ul> 
                                    
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_financeiro" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais  
                                                 <div class="collapse" id="sub_menu_esquerdo_financeiro" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Agência', 'FINANCEIRO_03_03', 'financeiro-03-03', 'index.php?m=cadastroagencia&c=cadastroagenciacontroller', 'resources/geral/images/cadastroagencia.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Agência</a>
                                                         </li>                                                        
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Banco', 'FINANCEIRO_03_01', 'financeiro-03-01', 'index.php?m=cadastrobanco&c=cadastrobancocontroller', 'resources/geral/images/cadastrobanco.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Banco</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Centro Custo', 'FINANCEIRO_03_05', 'financeiro-03-05', 'index.php?m=cadastrocentrocusto&c=cadastrocentrocustocontroller', 'resources/geral/images/cadastrocentrocusto.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Centro Custos</a>
                                                         </li> 
                                                         
                                                          <li>
                                                             <a onclick="adicionarAba('Cadastro Condicao de Pagamento', 'FINANCEIRO_03_06', 'financeiro-03-06', 'index.php?m=cadastrocondicaopagamento&c=cadastrocondicaopagamentocontroller', 'resources/geral/images/cadastrocondicaopagamento.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Condição Pagamento</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Conta', 'FINANCEIRO_03_02', 'financeiro-03-02', 'index.php?m=cadastroconta&c=cadastrocontacontroller', 'resources/geral/images/cadastroconta.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Conta</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Grupo Despesas', 'FINANCEIRO_03_07', 'financeiro-03-07', 'index.php?m=cadastrogrupodespesas&c=cadastrogrupodespesascontroller', 'resources/geral/images/cadastrogrupodespesas.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Grupo Despesas</a>
                                                         </li> 
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Tipo Despesas', 'FINANCEIRO_03_08', 'financeiro-03-08', 'index.php?m=cadastrotipodespesas&c=cadastrotipodespesascontroller', 'resources/geral/images/cadastrotipodespesas.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Tipo Despesas</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Plano de Contas', 'FINANCEIRO_03_04', 'financeiro-03-04', 'index.php?m=cadastroplanocontas&c=cadastroplanocontascontroller', 'resources/geral/images/planocontas.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Plano de Contas</a>
                                                         </li>
                                                        
                                                    </ul>
                                                 </div>
                                             </a>
                                         </li>
                                        <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_financeiro_relatorio" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Relatórios  
                                                 <div class="collapse" id="sub_menu_esquerdo_financeiro_relatorio" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Relatório Contas a Pagar', 'FINRELATORIO_01_01', 'finrelatorio-01-01', 'index.php?m=relatoriocontasapagar&c=relatoriocontasapagarcontroller', 'resources/geral/images/relatorio_conta_pagar.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Contas à Pagar</a>
                                                         </li>                                                        
                                                         <li>
                                                             <a onclick="adicionarAba('Relatório Contas a Receber', 'FINRELATORIO_01_02', 'finrelatorio-01-02', 'index.php?m=relatoriocontasareceber&c=relatoriocontasarecebercontroller', 'resources/geral/images/relatorio_conta_receber.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Contas à Receber</a>
                                                         </li>
                                                                                               
                                                    </ul>
                                                     
                                                 </div>
                                             </a>
                                         </li>
                                        
                                    </ul> 
                                        
                                    </ul>
                                </div>    
                            </a>
                        </li>                              
                         
                        <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_faturamento" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Faturamento
                                <div class="collapse" id="menu_esquerdo_faturamento" style="height: 0px;">
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Emissor NFE', 'FATURAMENTO_04_01', 'faturamento-04-01', 'index.php?m=emissornfe&c=emissornfecontroller', 'resources/geral/images/emissornfe.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Emissor Nfe</a>
                                        </li> 
                                    </ul>
                                </div>    
                            </a>
                        </li>               
                        <li style="border-bottom: solid #e8e8e8 1px;">
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_equipamentos" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Gestão Frota
                                <div class="collapse" id="menu_esquerdo_equipamentos" style="height: 0px;">
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Boletim Equipamento Bomba', 'EQUIPAMENTOS_03_04', 'equipamentos-03-04', 'index.php?m=boletimequipamentobomba&c=boletimequipamentobombacontroller', 'resources/geral/images/boletim_equipamento.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Diária Bomba</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Boletim Equipamento Caminhões Betoneiras', 'EQUIPAMENTOS_03_05', 'equipamentos-03-05', 'index.php?m=boletimcaminhoesbetoneiras&c=boletimcaminhoesbetoneirascontroller', 'resources/geral/images/boletim_equipamento1.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Diária Caminhões Betoneira</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li>
                                            <a onclick="adicionarAba('Boletim Equipamento Caminhões Fretes', 'EQUIPAMENTOS_03_06', 'equipamentos-03-06', 'index.php?m=boletimcaminhaofrete&c=boletimcaminhaofretecontroller', 'resources/geral/images/boletim_equipamento2.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Diária Caminhões Frete</a>
                                        </li> 
                                    </ul>
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_equipamento" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais
                                                 <div class="collapse" id="sub_menu_esquerdo_equipamento" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Equipamento', 'EQUIPAMENTOS_03_01', 'equipamentos-03-01', 'index.php?m=cadastroequipamento&c=cadastroequipamentocontroller', 'resources/geral/images/cadastrofamilia.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Equipamento</a>
                                                         </li>
                                                          <li>
                                                             <a onclick="adicionarAba('Cadastro Grupo Equipamento', 'EQUIPAMENTOS_03_02', 'equipamentos-03-02', 'index.php?m=cadastrogrupoequipamento&c=cadastrogrupoequipamentocontroller', 'resources/geral/images/unidademedida.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Grupo Equipamento</a>
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
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_recursos_humanos" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Recursos Humanos
                                <div class="collapse" id="menu_esquerdo_recursos_humanos" style="height: 0px;">
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_recursos_humanos" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais
                                                 <div class="collapse" id="sub_menu_esquerdo_recursos_humanos" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Cargos ', 'RECURSOSHUMANOS_09_01', 'recursoshumanos-09-01', 'index.php?m=cadastrocargo&c=cadastrocargocontroller', 'resources/geral/images/cadastrocargo.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Cargos</a>
                                                         </li>
                                                          <li>
                                                             <a onclick="adicionarAba('Cadastro Colaborador', 'RECURSOSHUMANOS_09_02', 'recursoshumanos-09-02', 'index.php?m=cadastrocolaborador&c=cadastrocolaboradorcontroller', 'resources/geral/images/cadastrocolaborador.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Colaborador</a>
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
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_suprimentos" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Suprimentos
                                <div class="collapse" id="menu_esquerdo_suprimentos" style="height: 0px;">
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_suprimentos" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais
                                                 <div class="collapse" id="sub_menu_esquerdo_suprimentos" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Familia', 'SUPRIMENTOS_02_01', 'suprimentos-02-01', 'index.php?m=cadastrofamilia&c=cadastrofamiliacontroller', 'resources/geral/images/cadastrofamilia.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Família</a>
                                                         </li>
                                                          <li>
                                                             <a onclick="adicionarAba('Cadastro Unidade Medida', 'SUPRIMENTOS_02_02', 'suprimentos-02-02', 'index.php?m=cadastrounidademedida&c=cadastrounidademedidacontroller', 'resources/geral/images/unidademedida.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Unidade Medida</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Item', 'SUPRIMENTOS_02_03', 'suprimentos-02-03', 'index.php?m=cadastroitem&c=cadastroitemcontroller', 'resources/geral/images/item.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Item</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Comprador', 'SUPRIMENTOS_02_04', 'suprimentos-02-04', 'index.php?m=cadastrocomprador&c=cadastrocompradorcontroller', 'resources/geral/images/comprador.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Comprador</a>
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
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_tecnologia" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Tecnologia da Informação
                                <div class="collapse" id="menu_esquerdo_tecnologia" style="height: 0px;">
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_tecnologia" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>ServiceDesk
                                                 <div class="collapse" id="sub_menu_esquerdo_tecnologia" style="height: 0px;">
                                                    <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Área Técnica', 'TECNOLOGIA_INFORMACAO_01_01', 'tecnologia-01-01', 'index.php?m=helpdesk&c=areatecnica&f=loadViewAreaTecnica', 'resources/geral/images/cadastrofamilia.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Área Técnica</a>
                                                         </li>
                                                          <li>
                                                             <a onclick="adicionarAba('Cadastro Unidade Medida', 'TECNOLOGIA_INFORMACAO_01_02', 'tecnologia-01-02', 'index.php?m=helpdesk&c=areausuario&f=loadViewAreaUsuario', 'resources/geral/images/unidademedida.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Ordem de Serviço</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Item', 'TECNOLOGIA_INFORMACAO_01_03', 'tecnologia-01-03', 'index.php?m=helpdesk&c=cadastro&f=loadViewCadastro', 'resources/geral/images/item.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Configurações</a>
                                                         </li>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Comprador', 'TECNOLOGIA_INFORMACAO_01_04', 'tecnologia-01-04', 'index.php?m=helpdesk&c=designacaochamado&f=loadViewDesignacaoChamado', 'resources/geral/images/comprador.jpg')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Designação de OS</a>
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
                            <a onclick="" href="#" data-toggle="collapse" data-target="#menu_esquerdo_vendas" class="collapsed">
                                <span class='icone-menu-esquerdo glyphicon glyphicon-globe' style=''></span>Vendas
                                <div class="collapse" id="menu_esquerdo_vendas" style="height: 0px;">
                                    <ul>
                                        <li style="border-bottom: solid #e8e8e8 1px;">
                                             <a onclick="" href="#" data-toggle="collapse" data-target="#sub_menu_esquerdo_vendas" class="collapsed">
                                                 <span class='icone-menu-esquerdo glyphicon glyphicon-import' style=''></span>Parâmetros Gerais  
                                                 <div class="collapse" id="sub_menu_esquerdo_vendas" style="height: 0px;">
                                                     <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Cadastro Representante', 'VENDAS_03_02', 'vendas-03-02', 'index.php?m=cadastrorepresentante&c=cadastrorepresentantecontroller', 'resources/geral/images/cadastrorepresentate.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Cadastro Representante</a>
                                                         </li>
                                                  
                                                    </ul>
                                                     <ul>
                                                         <li>
                                                             <a onclick="adicionarAba('Descrição Tabela Preços', 'VENDAS_03_01', 'vendas-03-01', 'index.php?m=descricaotabelapreco&c=descricaotabelaprecocontroller', 'resources/geral/images/descricaotabelapreco.png')" href="#"><span class='icone-menu-esquerdo glyphicon glyphicon-file' style=''></span>Descrição Tabela Preços</a>
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
            <div style='margin-top: 30px; height: 100%;' >
                <ul class="nav nav-tabs ulAbas" id="listaAbas" style="height: 100%;"></ul>
                <div class="tab-content" id="listAFAVORITOS" style="height: 100%;"></div>
                <div class="tab-content" id="listaConteudoAbas" style="height: 100%;"></div>
            </div>
            <!--LISTA DE ABAS-->
        </div>
    </body>
</html>