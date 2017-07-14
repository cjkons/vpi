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

        <link href="resources/relatorioaniversario/css/teste.css" rel="stylesheet">
        
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
        
        <!--GERAL AJUSTE RESPONSIVO TABELA E TEXTO-->
        <link href="resources/relatorioaniversario/css/campos.css" rel="stylesheet">
        <link href="resources/relatorioaniversario/css/texto.css" rel="stylesheet">
        <!--GERAL-->

        <!-- RELATÓRIO CONTAS A PAGAR -->
        <link href="resources/relatorioaniversario/css/estilomodal.css" rel="stylesheet">
        <script src="resources/relatorioaniversario/js/relatorioaniversario.js"></script>
        
        
        <!-- RELATÓRIO CONTAS A PAGAR -->
    </head>

    <body style="zoom: 85%;" >
           <nav class="navbart">
            <div class="container-fluid" align="center">
                    
             
                <a onclick="getPdf()" class="btn btn-info">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </a>
                <a onclick="getExcel()" class="btn btn-info">
                    <span class="glyphicon glyphicon-share"></span> Exportar
                </a>
                       
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>    

            </div>
        </nav>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Empresa
                            <select  id="idEmpresaFiltro" class="form-control"  required="" onchange="carregarFilial()" ></select>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Filial
                            <select  id="idFilialFiltro"  required="" class="form-control"  ></select>
                        </div>
                    </td>
               
                    <td  style="padding-right: 5px;font-size: 14px;">
                        Mês
                        <select style="text-transform: uppercase;" id="mes" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="01">Janeiro</option>
                                    <option readonly value="02">Fevereiro</option>
                                    <option readonly value="03">Março</option>
                                    <option readonly value="04">Abril</option>
                                    <option readonly value="05">Maio</option>
                                    <option readonly value="06">Junho</option>
                                    <option readonly value="07">Julho</option>
                                    <option readonly value="08">Agosto</option>
                                    <option readonly value="09">Setembro</option>
                                    <option readonly value="10">Outubro</option>
                                    <option readonly value="11">Novembro</option>
                                    <option readonly value="12">Dezembro</option>
                                    
                            </select> 
                    </td>
                    
                    
                    <td  style="padding-left:0px; font-size: 14px;">
                        <div>
                         <br>
                         <a onclick="filtro()"class="btn btn-info" ata-toggle="modal" data-target="#myModal">
                             <span class="glyphicon glyphicon-search"></span> Pesquisar
                         </a>
                        </div>
                    </td>

                  
                </tr>
               
        </table>
   
     
            <div style='width: 100%; overflow-x: hidden'>
             
           </div>       
        <br>
        <HR WIDTH=100%>
        <br>
        <table id="relatorio" style="width: 95%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" ></table>
     
        
       

    </body>
    <!-- Modal Novo Titulo -->
    <div class="modal fade" id="pesquisarModal" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog-esp">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Novo Lançamento</h4>
          </div>
          <div class="modal-body">
               <nav class="navbart">
            <div class="container-fluid" align="center">

                <a onclick="novoModal()"class="btn btn-info">
                    <span class="glyphicon glyphicon-file"></span>  Novo 
                </a>
                <a onclick="salvarModal()" class="btn btn-info btn-outline">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                </a>
                <a onclick="editarModal()" class="btn btn-info">
                    <span class="glyphicon glyphicon-pencil"></span> Editar
                </a>
                <a onclick="excluirModal()" class="btn btn-info">
                    <span class="glyphicon glyphicon-trash"></span> Excluir
                </a>
                <a onclick="buscaPrimeiroRegistroModal()"  class="btn btn-info">
                    <span class="glyphicon glyphicon-fast-backward"></span> 
                </a>
                <a onclick="buscaRegistroAnteriorModal()" class="btn btn-info">
                    <span class="glyphicon glyphicon glyphicon-backward"></span> 
                </a>
                <a onclick="buscaRegistroProximoModal()"class="btn btn-info">
                    <span class="glyphicon glyphicon-forward"></span> 
                </a>
                <a onclick="buscaUltimoRegistroModal()" class="btn btn-info">
                    <span class="glyphicon glyphicon-fast-forward"></span> 
                </a>
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </a>
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-share"></span> Exportar
                </a>
                 <a onclick="atualizarModal()" class="btn btn-info">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>        
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>    

            </div>
        </nav>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                     <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Id
                            <input type="text" class="form-control" id="idTituloModal"   placeholder="ID" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Empresa
                            <select  id="idEmpresaModal" class="form-control"  readonly onchange="carregarFilial()" ></select>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Filial
                            <select  id="idFilialModal" class="form-control"  readonly></select>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Fornecedor
                           <select  id="idFornecedorModal" class="form-control"  readonly></select>
                         </div>
                    </td>
                </tr>
        </table>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Data Emissão
                           <input type='text' class="form-control" id="dataEmissaoModal"  maxlength="10"  placeholder="Data Final" readonly>
                        </div>
                    </td>
                    <td  style="padding-left:  0px;font-size: 14px;">
                        <div>
                            Documento
                            <input type="text" class="form-control" id="documentoModal"   placeholder="Documento" readonly>
                        </div>
                    </td>
                    <td  style="padding-left:  0px;font-size: 14px;">
                        <div>
                            Valor Titulo
                            <input type="text" class="form-control" id="valorTituloModal" onkeypress="mascara( this, mvalor );"  placeholder="Valor Título" readonly>
                        </div>
                    </td>                 
                </tr>
              
               
        </table>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Tipo de Cobrança
                            <select  id="tipoCobrancaModal" class="form-control" readonly>
                                  <option value="0" readonly>Selecione</option>
                                  <option value="Boleto" readonly>Boleto</option>
                                  <option value="Cheque" readonly>Cheque</option>
                                  <option value="Dinheiro" readonly>Dinheiro</option>
                                  <option value="Transferência" readonly>Transferência</option>
                            </select>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Centro de custo
                            <select  id="centroCustoModal" class="form-control"  readonly></select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Condição de Pagamento
                           <select  id="idCondicaoPagamentoModal" class="form-control"  readonly onchange="carregarParcelaHtml()" ></select>
                        </div>
                    </td>
                    <td  style="padding-left:  0px;font-size: 14px;">
                        <div>
                            Conta Contabil
                            <select  id="contaContabilModal" class="form-control"  readonly  ></select>
                        </div>
                    </td>
                </tr>
              
               
        </table>
              <br><br><br>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div>
                            Histórico Pagamento
                            <input type="text" class="form-control" id="historicoModal"   placeholder="Observação" readonly>
                        </div>
                    </td>                    
                </tr>
        </table>
        <br><br>      
        <table id="tabelaParcela" style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" ></table>      
            
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Sair</button>
            <button type="button" class="btn btn-outline" data-dismiss="modal">Ok</button>
          
          </div>
        </div>
      </div>
    </div
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------
    ********************************************************Modal para baixas *********************************************************************
    ***********************************************************************************************************************************************
    ---------------------------------------------------------------------------------------------------------------------------------------------->
    
     <!-- Modal Baixa Titulo -->
    <div class="modal fade" id="baixarModal" tabindex="50" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog-esp">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Baixar</h4>
          </div>
          <div class="modal-body">
               <nav class="navbart">
            <div class="container-fluid" align="center">
               
                <a onclick="salvarModalBaixa()" class="btn btn-info btn-outline">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                </a>
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </a>
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-share"></span> Exportar
                </a>
                 <a onclick="atualizarModal()" class="btn btn-info">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>        
                <a href="#" class="btn btn-info">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>    

            </div>
        </nav>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Identificador parcela
                            <input type='text' class="form-control" id="idModalBaixa"    placeholder="id" readonly >
                        </div>
                    </td>
                     <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Data Pagamento
                            <input type='text' class="form-control" id="dataEmissaoModalBaixa"    placeholder="Data Pagamento" >
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Documento
                            <input type='text' class="form-control" id="documentoModalBaixa"   placeholder="Documeto" readonly>
                        </div>
                    </td>
                    <td  style="padding-right: 5px;font-size: 14px;">
                        <div class="form">
                            Tipo de Cobrança
                            <select  id="tipoCobrancaModalBaixa" class="form-control" readonly>
                                  <option value="0" readonly>Selecione</option>
                                  <option value="Boleto" readonly>Boleto</option>
                                  <option value="Cheque" readonly>Cheque</option>
                                  <option value="Dinheiro" readonly>Dinheiro</option>
                                  <option value="Transferência" readonly>Transferência</option>
                            </select>
                        </div>
                </tr>
        </table>
        <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           N° Doc Pagamento
                           <input type='text' class="form-control" id="documetoPagamentoModalBaixa"  maxlength="10"  placeholder="Número do documento de pagamento">
                        </div>
                    </td>
                </tr>
        </table>
        <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Conta Corrente
                           <select  id="idContaCorrenteModalBaixa" class="form-control"  readonly  ></select>
                           
                        </div>
                    </td>
                </tr>
        </table>
         <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Saldo Devedor
                           <input type='text' class="form-control" id="saldoDevedorModalBaixa"  maxlength="10"  placeholder="Saldo Devedor" readonly>
                        </div>
                    </td>
                </tr>
        </table>
        <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Multa/Juros
                           <input type='text' class="form-control" id="multaJurosModalBaixa"  placeholder="Multa Juros" onkeypress="mascara( this, mvalor );" maxlength="14" onblur="calcularValorfinalPagamentoJuro()" >
                        </div>
                    </td>
                </tr>
        </table>
        <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Descontos
                           <input type='text' class="form-control" id="descontoModalBaixa" placeholder="Descontos" onkeypress="mascara( this, mvalor );" maxlength="14" onblur="calcularValorfinalPagamentoDesconto()" >
                        </div>
                    </td>
                </tr>
        </table>
         <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Valor a Pagar
                           <input type='text' class="form-control" id="valorPagarModalBaixa"  maxlength="10"  placeholder="Valor a Pagar" readonly>
                        </div>
                    </td>
                </tr>
        </table>
        <table style="width: 40%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Pagamento
                           <input type='text' class="form-control" id="pagamentoModalBaixa"  maxlength="10"  placeholder="Data Pagamento" readonly>
                        </div>
                    </td>
                </tr>
        </table>
        <table style="width: 80%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >      
                <tr>
                    <td  style="padding-right: 10px;font-size: 14px;">
                        <div class="form">
                           Observação
                           <input type='text' class="form-control" id="observacaoModalBaixa"  maxlength="10"  placeholder="Observação" readonly>
                        </div>
                    </td>
                </tr>
        </table>      
                   
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Sair</button>
            <button type="button" class="btn btn-outline" data-dismiss="modal">Ok</button>
          
          </div>
        </div>
      </div>
    </div>
</html>