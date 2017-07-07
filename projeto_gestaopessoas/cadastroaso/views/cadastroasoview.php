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
         <link href="resources/cadastroaso/css/teste.css" rel="stylesheet">
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO FILIAL -->
        <script src="resources/cadastroaso/js/cadastroaso.js"></script>
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
                
                 <a onclick="atualizar()" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar
                </a>        
                <a href="#" class="btn btn-primary">
                    <span class="glyphicon glyphicon-question-sign"></span> Ajuda
                </a>
              
             <br><br>
          
        <ul id="abas" align="center">
               <li><a href="#tab1" onclick="mostrarGrid()">DADOS FUNCIONÁRIO</a></li>
               <li><a href="#tab2" onclick="ocultarGrid()">EXAMES ASO  </a></li>
               <li><a href="#tab3" onclick="ocultarGrid()">EXAMES COMPLEMENTARES</a></li>
               
   </ul>

            </div>
               
        </nav>
        
        

<!-- conteudo das abas -->

    <div id="tab1" class="contaba" >
   
     <fieldset class="fieldset-border">
            <legend class="legend-border">Dados Funcionário</legend>  
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                   <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            ID
                            <input style="text-transform: uppercase;" type="number" class="form-control" id="idAso" placeholder="ID" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Empresa
                            <select  id="empresa" class="form-control"  readonly onchange="carregarFilial()" ></select>
                        </div>
                   </td>
                  
                   
                   <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Filial
                            <select  id="filial" class="form-control" onchange="carregarFuncionario()"  readonly ></select>
                        </div>
                   </td>
                   <td  style="width: 30%; padding-right: 10px;font-size: 14px;"></td> 
                   
                        </tr>
        </table>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>           
                   
                   <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Funcionário
                            <select  style="text-transform: uppercase;"  id="funcionario" class="form-control" onchange="carregarDadosFuncionario()"  readonly></select>
                        </div>
                   </td>
                   <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Matrícula
                            <input style="text-transform: uppercase;" type="number" class="form-control" id="matricula" maxlength="8" placeholder="Matrícula" readonly>
                        </div>
                   </td>
                   <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Setor
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="setor" placeholder="Setor" readonly>
                        </div>
                   </td>
                   <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Função
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="funcao" placeholder="Função" readonly>
                        </div>
                   </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;"></td>
             </tr>
        </table>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>   
                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Data Nascimento
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="dataNasc" maxlength="18"  placeholder="Data" readonly>
                        </div>
                </td>
                <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            CPF
                            <input type="text" class="form-control" id="cpf"  maxlength="14"  placeholder="CPF"  onkeypress="mascaraCPF(this)" readonly>
                        </div>
                </td>
                
                    <td style="width: 15%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            CTPS
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="ctps"   placeholder="CTPS" readonly>
                        </div>
                    </td>
                   
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            PIS/PASEP
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="pisPasep"  placeholder="PIS/PASEP" readonly>
                        </div>
                    </td>
                    <td  style="width: 40%; padding-right: 10px;font-size: 14px;"></td>
                
        </table>
     </fieldset>        
    </div>    
    <!-- conteudo das abas -->

    <div id="tab2" class="contaba" >
   
        
        <fieldset class="fieldset-border">
            <legend class="legend-border">Tipo Exame / Médico Responsável</legend>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 20%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Exame
                            <select style="text-transform: uppercase;" id="tipoExames" class="form-control" onchange="carregarOutrosExames()"readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="ADMISSIONAL">Admissional</option>
                                    <option readonly value="DEMISSIONAL">Demissional</option>
                                    <option readonly value="PERIODICO">Periódico</option>
                                    <option readonly value="MUDANCA_FUNCAO">Mudança de Função</option>
                                    <option readonly value="RETORNO_TRABALHO">Retorno do Trabalho</option>
                                    <option readonly value="OUTROS">Outros</option>
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Outros
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="outrosExames"  placeholder="Outros" disabled>
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">                  
                    </td>
                    <td  style="width: 30%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                           Nome Médico
                            <input style="text-transform: uppercase;" type="livro" class="form-control" id="medico"  placeholder="Nome Médico" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                             Nº CRM
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="crm" placeholder="Nº CRM" readonly>
                        </div>
                    </td>
                    <td  style="width: 28%; padding-right: 10px;font-size: 14px;">                  
                    </td>
                    
                   
                           
              </tr>
        </table>
        
         </fieldset>
        <fieldset class="fieldset-border">
            <legend class="legend-border">Riscos Ocupacionais</legend>
            <table style="width: 90%; height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    
                     <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 20px; height: 20px;" id="agBiologico" /> Agentes Biológicos
                       </div>
                    </td>
                    
                    <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 20px; height: 20px;" id="agFisico" /> Agentes Físicos
                       </div>
                    </td>
                    
                    <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 20px; height: 20px;" id="agQuimico" /> Agentes Quimicos
                       </div>
                    </td>
                  
                    <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 20px; height: 20px;" id="riscoAcidente" /> Riscos Acidentes
                       </div>
                    </td>
                    
                    <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 20px; height: 20px;" id="riscoErgonomico" /> Riscos Ergonômicos
                       </div>
                    </td>
                    
                    <td  style="width: 25%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 20px; height: 20px;" id="ausenciaRisco" /> Ausência de Riscos Ocupacionais
                       </div>
                    </td>
              
         </tr>
        </table>
     </fieldset>
     <fieldset class="fieldset-border">
     <legend class="legend-border">Resultado</legend>

        <table style="width: 90%; height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 15%; padding-right: 10px; font-size: 20px;">
                       <div class="form-group">
                            Resultado ASO
                            <select style="text-transform: uppercase;" id="resultadoExame" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="APTO">APTO</option>
                                    <option readonly value="INAPTO">INAPTO</option>
                                    
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 35%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Observação Resultado
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="observacaoExame"   placeholder="Observação Resultado" readonly>
                        </div>
                    </td>
                    <td  style="width: 28%; padding-right: 10px;font-size: 14px;">                  
                    </td>
                    <td  style="width: 12%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="dataRealizacao"  placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    </tr>
        </table>
     </fieldset>
           
    </div>
    
<div id="tab3" class="contaba">

    <fieldset class="fieldset-border">
     <legend class="legend-border">Exames Complementares</legend>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar1"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar1"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar2"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar2"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                 
                    
                </tr>
        </table>
     <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar3"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar3"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar4"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar4"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                 
                    
                </tr>
        </table>
     <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar5"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar5"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar6"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar6"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                 
                    
                </tr>
        </table>
     <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar7"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar7"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Exame
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="exameComplementar8"   placeholder="Exame" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Realização
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="dataComplementar8"   placeholder="Data Realização" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                 
                    
                </tr>
        </table>
     
    </fieldset>
    
    <fieldset class="fieldset-border">
     <legend class="legend-border">Valores</legend> 
     <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    <td  style="width: 48%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 15%; padding-right: 10px; font-size: 20px;">
                       <div class="form-group">
                            Empresa Pagou Exame? 
                            <select style="text-transform: uppercase;" id="pagamentoExame" class="form-control" onchange="carregarValorExame()"readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="S">SIM</option>
                                    <option readonly value="N">NÃO</option>
                                    
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Valor do Exame
                            <input style="text-transform: uppercase;"  type="text" class="form-control" id="valorExame"   placeholder="Valor Exame" onkeypress="mascaraValor(this, mvalorValor)" maxlength="11" disabled>
                        </div>
                    </td>
                    <td  style="width: 12%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    
                    
                 
                    
                </tr>
        </table>
    </fieldset> 
    
    
   </div>

       
           <br>
           <div style='width: 99%; margin-left: 7px; margin-right: 4px; overflow-x: hidden'>
                  <table id="grid" class="display" cellspacing="0" width="100%">
                      <thead >
                          <tr>
                              <th>ID</th>
                              <th>EMPRESA</th>
                              <th>FILIAL</th>
                              <th>FUNCIONÁRIO</th>
                              <th>MATRICULA</th>
                              <th>SETOR</th>
                              <th>FUNÇÃO</th>                            
                              <th>SELECIONAR</th>
                          </tr>
                      </thead>
                  </table>
            </div>       
        

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