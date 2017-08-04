<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>VPI | Clarify</title>
        <meta charset="UTF-8"/> 
    <a href="cadastrofuncionariosview.php"></a>
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
         <link href="resources/cadastrofuncionarios/css/teste.css" rel="stylesheet">
        <link href="resources/geral/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="resources/geral/geral.css" rel="stylesheet">
        
        <link href="resources/geral/resetarScrollBar.css" rel="stylesheet">
        <script src="resources/geral/geral.js"></script>
        <!--GERAL-->

        <!-- CADASTRO FILIAL -->
        <script src="resources/cadastrofuncionarios/js/cadastrofuncionarios.js"></script>
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
                <a onclick="validarExcluir()" class="btn btn-primary">
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
         * CAMPO OBRIGATÓRIO 
        <ul id="abas" align="center">
               <li><a href="#tab1">DADOS FUNCIONÁRIO</a></li>
               <li><a href="#tab2">DADOS EMPREGATÍCIOS</a></li>
               <li><a href="#tab3">ENDEREÇO</a></li>
               <li><a href="#tab4">DOCUMENTOS</a></li>
               <li><a href="#tab5">SOCIAIS 1</a></li>
               <li><a href="#tab6">SOCIAIS 2</a></li>
   </ul>

            </div>
               
        </nav>
        
        

<!-- conteudo das abas -->
<div class="container" align="center" style="width: 98%;">
            <fieldset class="fieldset-border">
                <legend class="legend-border" >Dados Funcionário</legend>
    <div id="tab1" class="contaba" >
   
    
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            ID
                            <input  type="number" class="form-control" id="idFuncionario" placeholder="ID" readonly>
                        </div>
                    </td>
                    <td  style="width: 30%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Empresa *
                            <select   id="empresa" class="form-control" onchange="carregarFilial()"  readonly></select>
                        </div>
                   </td>
                   <td  style="width: 30%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Filial *
                            <select    id="filial" class="form-control"  readonly></select>
                        </div>
                   </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                           Livro *
                            <input  type="livro" class="form-control" id="livro"  placeholder="Livro" readonly>
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                             Pag.
                            <input  type="text" class="form-control" id="pagina" placeholder="Pag." readonly>
                        </div>
                    </td>
                        </tr>
        </table>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 40%; padding-right: 10px;font-size: 14px; ">
                       <div class="form-group">
                            Nome Funcionário *
                            <input  type="text" class="form-control" id="nomeFuncionario" placeholder="Funcionário" readonly>
                        </div>
                   </td>
                   <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Data Nascimento *
                            <input  type="text" class="form-control" id="dataNasc" maxlength="18"  placeholder="Data" readonly>
                        </div>
                   </td>
                   
                   <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Naturalidade
                            <input  type="text" class="form-control" id="cidadeNasc" placeholder="Naturalidade" readonly>
                        </div>
                   </td>
                   
                   <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Estado
                            <select style="" id="estadoNasc" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
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
                    
                   
              </tr>
        </table>
        <table style="width: 90%; height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    
                   
                    <td style="width: 10%;padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Data Cadastro
                            <input  type="text" class="form-control" id="dataCadastro"   placeholder="Data Cadastro" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 30px; height: 30px;" id="valeTransporte" /> Receberá Vale Transporte
                       </div>
                    </td>
                    <td  style="width: 30%;padding-right: 10px;font-size: 14px;">
                            
                    </td>
                    <td  style="width: 15%; padding-right: 10px; font-size: 14px;">
                       <div class="form">
                           <input type="checkbox" style="width: 30px; height: 30px;" id="desativado" onchange="habilitarDataDemissao()"/> Funcionário Demitido
                       </div>
                    </td>
                    <td style="width: 10%;padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Data Demissão
                            <input type="text" class="form-control" id="dataDemissao"   placeholder="Data Demissão" disabled>
                        </div>
                    </td>
            </tr>
        </table>
    </div>
<div id="tab2" class="contaba">
   
     
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Matrícula *
                            <input  type="number" class="form-control" id="matricula" maxlength="8" placeholder="Matrícula" readonly>
                        </div>
                   </td>
                    <td  style="width: 22%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Função *
                            <select   id="funcao" class="form-control" readonly></select>
                        </div>
                   </td>
                   <td  style="width: 22%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Setor *
                            <select  id="setor" class="form-control" readonly></select>
                        </div>
                   </td>
                   <td  style="width: 13%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Salário Valor *
                            <input type="text" class="form-control" id="salarioValor" placeholder="Salário Valor" onkeypress="mascaraValor(this, mvalorValor);" maxlength="14" readonly>
                        </div>
                   </td>
                   <td  style="width: 13%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Modalidade Salário *
                            <select id="salarioPagamento" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="MENSALISTA">Mensalista</option>
                                    <option readonly value="QUINZENALISTA">Quinzenalista</option>
                                    <option readonly value="SEMANALISTA">Semanalista</option>
                                    <option readonly value="DIARISTA">Diarista</option>
                            </select> 
                        </div>
                    </td>
                    
                     <td style="width: 150px; height: 150px; " rowspan="3"  readonly>
                        <div style="width: 150px; height: 150px;  border: 1px solid graytext;" id="imagemView" readonly></div>
                    </td>
                             </tr>
        </table>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr> 
                   <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Data Admissão *
                            <input   type="text" class="form-control" id="dataAdmissao" placeholder="Data Admissão" readonly>
                        </div>
                   </td>
                   <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Contrato Experiência *
                            <select   id="experiencia" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="30">30 Dias</option>
                                    <option readonly value="60">60 Dias</option>
                                    <option readonly value="90">90 Dias</option>
                                    
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Horário Inicial 1
                            <input   type="text" class="form-control" id="horarioInicial1"  placeholder="Horário Inicial" onkeypress="mascara( this, mvalor );" maxlength="5" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 15px;font-size: 14px;">
                        <div class="form-group">
                            Horário Final 1
                            <input  type="text" class="form-control" id="horarioFinal1"  placeholder="Horário Final" onkeypress="mascara( this, mvalor );" maxlength="5" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Horário Inicial 2
                            <input type="text" class="form-control" id="horarioInicial2"  placeholder="Horário Inicial" onkeypress="mascara( this, mvalor );" maxlength="5" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Horário Final 2
                            <input  type="text" class="form-control" id="horarioFinal2"  placeholder="Horário Final" onkeypress="mascara( this, mvalor );" maxlength="5" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 20%;padding-right: 10px;font-size: 14px;">
                            <div class="form-group">
                               Foto *
                               <input type="file" class="form-control" id="imagem" enctype="multipart/form-data" placeholder="imagem"  readonly>
                        </div>
                    </td>
                    
                   
                    
                   
                  
                   
                </tr>
        </table>
    </div>
    <div id="tab3" class="contaba">
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            CEP *
                            <input  type="text" class="form-control" id="cep"  maxlength="9"  placeholder="Cep"  onkeypress="mascaraCEP(this)" readonly>
                        </div>
                   </td>
                   <td  style="width: 35%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Endereço *
                            <input  type="text" class="form-control" id="endereco"   placeholder="Endereço" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                           Número
                            <input  type="text" class="form-control" id="numero" maxlength="6"  placeholder="Número" readonly>
                        </div>
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Bairro *
                            <input type="text" class="form-control" id="bairro"  placeholder="Bairro" readonly>
                        </div>
                    </td>
                      </tr>
             </table>    
             <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    
                <tr>
                    <td style="width: 25%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Cidade *
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="cidade"   placeholder="Cidade" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Estado *
                            <select id="estado" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
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
                    <td style="width: 20%; padding-right: 10px;font-size: 14px;">
                    
                    <div class="form-group">
                            Email
                            <input style="text-transform: uppercase;" type="email" class="form-control" id="email"   placeholder="E-mail" readonly>
                        </div>
                     </td>
                   
                </tr>
             </table>    
             <table style="width: 90%; height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >    
                <tr>
                 <td style="padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Telefone 1 *
                            <input type="text" class="form-control" id="telefone1" size="20" maxlength="14"   placeholder="Telefone 1" readonly onkeypress="mascaraTelefone(this)">
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Telefone 2
                            <input  type="text" class="form-control" id="telefone2" size="20" maxlength="14"   placeholder="Telefone 2" readonly onkeypress="mascaraTelefone(this)">
                        </div>
                    </td>
                
                
                    <td  style="padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Telefone 3
                            <input type="text" class="form-control" id="telefone3" size="20" maxlength="14"  placeholder="Telefone 3" readonly onkeypress="mascaraTelefone(this)">
                        </div>
                    </td>
                    <td  style="padding-right: 10px;font-size: 14px;">
                     
                   </td>
                   </tr>
        </table>
        
   </div>
    <div id="tab4" class="contaba">
   
    <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                   <tr> 
        <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            CPF *
                            <input type="text" class="form-control" id="cpf"  maxlength="14"  placeholder="CPF"  onkeypress="mascaraCPF(this)" readonly>
                        </div>
                   </td>
                   <td  style="width: 2%; padding-right: 10px;font-size: 13px;">
                       
                    </td>
                   <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Identidade *
                            <input type="text" class="form-control" id="identidade"   placeholder="Identidade" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                           Orgão Expedidor *
                            <input  type="text" class="form-control" id="expedidorIdentidade"   placeholder="Expedidor" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Estado *
                            <select   id="estadoIdentidade" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
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
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Expedição *
                            <input  type="text" class="form-control" id="dataIdentidade"  placeholder="Data Expedição" readonly>
                        </div>
                    </td>
                    <td  style="width: 17%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            
                        </div>
                    </td>
                    </tr>
        </table>
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                    <td style="width: 15%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            CTPS *
                            <input  type="text" class="form-control" id="ctps"   placeholder="CTPS" readonly>
                        </div>
                    </td>
                    <td style="width: 15%; padding-right: 10px;font-size: 14px;">
                        <div class="form-group">
                            Série *
                            <input  type="text" class="form-control" id="serieCtps"   placeholder="Série" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Estado *
                            <select id="estadoCtps" class="form-control"  readonly>
                                     <option readonly value="0" >Selecione</option>
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
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Expedição *
                            <input   type="text" class="form-control" id="dataCtps"  placeholder="Data Expedição" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                           
                        </div>
                    </td>
                   
                </tr>
        </table>
       
        <table style="width: 90%;  height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                    
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            PIS/PASEP *
                            <input  type="text" class="form-control" id="pisPasep"  placeholder="PIS/PASEP" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Expedição *
                            <input  type="text" class="form-control" id="dataPisPasep"  placeholder="Data Expedição" readonly>
                        </div>
                    </td>
                    <td  style="width: 2%; padding-right: 10px;font-size: 13px;">
                       
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Título Eleitor
                            <input  type="text" class="form-control" id="tituloEleitor" maxlength="18"  placeholder="Título Eleitor" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Zona Eleitoral
                            <input  type="text" class="form-control" id="zonaEleitor" maxlength="18"  placeholder="Zona Eleitoral" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 13px;">
                       <div class="form-group">
                            Seção Eleitoral
                            <input  type="text" class="form-control" id="secaoEleitor" maxlength="18"  placeholder="Seção Eleitoral" readonly>
                        </div>
                    </td>
                    <td  style="width: 8%; padding-right: 10px;font-size: 13px;">
                       
                    </td>
                   
                    
                    
                    
                </tr>       
             
           
        </table>
   </div> 

  <div id="tab5" class="contaba">
   
     <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>
                    <td  style="width: 30%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Nome Mãe *
                            <input type="text" class="form-control" id="nomeMae" placeholder="Nome Mãe" readonly>
                        </div>
                   </td>
                   <td  style="width: 30%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Nome Pai
                            <input  type="text" class="form-control" id="nomePai" placeholder="Nome Pai" readonly>
                        </div>
                   </td>
              </tr>       
             
           
        </table>            
      <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>             
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Sexo *
                            <select id="sexo" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="M">Masculino</option>
                                    <option readonly value="F">Feminino</option>
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Estado Civil *
                            <select  id="estadoCivil" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="CASADO">Casado</option>
                                    <option readonly value="DIVORCIADO">Divorciado</option>
                                    <option readonly value="SOLTEIRO">Solteiro</option>
                                    <option readonly value="U_ESTAVEL">União Estável</option>
                                    <option readonly value="VIUVO">Viúvo</option>
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Deficiente Físico *
                            <select  id="deficienteFisico" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="S">Sim</option>
                                    <option readonly value="N">Não</option>
                                    
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Grau de Instrução
                            <select  id="grauInstrucao" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="ANALFABETO">Analfabeto</option>
                                    <option readonly value="F_INCOMPLETO">Fundamental Incompleto</option>
                                    <option readonly value="F_COMPLETO">Fundamental Completo</option>
                                    <option readonly value="M_INCOMPLETO">Médio Incompleto</option>
                                    <option readonly value="M_COMPLETO">Médio Completo</option>
                                    <option readonly value="S_INCOMPLETO">Superior Incompleto</option>
                                    <option readonly value="S_COMPLETO">Superior Completo</option>
                                    <option readonly value="POS_GRADUADO">Pós Graduação</option>
                                    <option readonly value="DOUTORADO">Doutorado</option>
                            </select> 
                        </div>
                    </td>
                </tr>
     </table>
         <table style="width: 90%;  height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                       <div class="form-group">
                            Etnia
                            <select  id="etnia" class="form-control" readonly>
                                    <option readonly value="0">Selecione</option>
                                    <option readonly value="BRANCO">Branco</option>
                                    <option readonly value="CABOCLO">Caboclo</option>
                                    <option readonly value="CAFUZO">Cafuzo</option>
                                    <option readonly value="INDIGENA">Indígena</option>
                                    <option readonly value="MULATO">Mulato</option>
                                    <option readonly value="NEGRO">Negro</option>
                                    <option readonly value="PARDO">Pardo</option>
                                    
                            </select> 
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Cor Olhos
                            <input  type="text" class="form-control" id="corOlhos"   placeholder="Cor Olhos" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Cor Cabelos
                            <input  type="text" class="form-control" id="corCabelos"   placeholder="Cor Cabelos" readonly>
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Altura
                            <input  type="text" class="form-control" id="altura"   placeholder="Altura" maxlength="3" onkeypress="mascaraValor(this, mvalorValor);" readonly>
                        </div>
                    </td>
                    <td  style="width: 5%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Peso
                            <input  type="text" class="form-control" id="peso"   placeholder="Peso" maxlength="6" onkeypress="mascaraValor(this, mvalorValor);" readonly>
                        </div>
                    </td>
                             </tr>
        </table>
     
   </div>

<div id="tab6" class="contaba">
   
        <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Nome Filho 01:
                            <input  type="text" class="form-control" id="nomeFilho1"   placeholder="Nome Filho" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Nascimento Filho 01:
                            <input   type="text" class="form-control" id="dataNasc1"   placeholder="Data Nascimento" readonly>
                        </div>
                    </td>
                    
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                 
                    <td  style="width:25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Nome Filho 02:
                            <input  type="text" class="form-control" id="nomeFilho2"   placeholder="Nome Filho" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Nascimento Filho 02:
                            <input  type="text" class="form-control" id="dataNasc2"   placeholder="Data Nascimento" readonly>
                        </div>
                    </td>
                </tr>
        </table>
    <table style="width: 90%; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Nome Filho 03:
                            <input type="text" class="form-control" id="nomeFilho3"   placeholder="Nome Filho" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Nascimento Filho 03:
                            <input   type="text" class="form-control" id="dataNasc3"   placeholder="Data Nascimento" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Nome Filho 04:
                            <input  type="text" class="form-control" id="nomeFilho4"   placeholder="Nome Filho" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Nascimento Filho 04:
                            <input type="text" class="form-control" id="dataNasc4"   placeholder="Data Nascimento" readonly>
                        </div>
                    </td>
                </tr>
        </table>
    <table style="width: 90%;  height: 79px; border-collapse: collapse" cellpadding="0" cellspacing="5px" align="center" >
                <tr>            
                    
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Nome Filho 05:
                            <input  type="text" class="form-control" id="nomeFilho5"   placeholder="Nome Filho" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Nascimento Filho 05:
                            <input   type="text" class="form-control" id="dataNasc5"   placeholder="Data Nascimento" readonly>
                        </div>
                    </td>
                    <td  style="width: 10%; padding-right: 10px;font-size: 14px;">
                         
                    </td>
                    <td  style="width: 25%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Nome Filho 06:
                            <input   type="text" class="form-control" id="nomeFilho6"   placeholder="Nome Filho" readonly>
                        </div>
                    </td>
                    <td  style="width: 15%; padding-right: 10px;font-size: 14px;">
                          <div class="form-group">
                            Data Nascimento Filho 06:
                            <input  type="text" class="form-control" id="dataNasc6"   placeholder="Data Nascimento" readonly>
                        </div>
                    </td>
                </tr>
        </table>
    
   </div>
       
</fieldset>    
        </div>        
        
       
           
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
    
     <!-- Modal para botão Excluir -->
    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Informação</h4>
          </div>
          <div class="modal-body">
              <p><h4>Funcionário não pode ser excluido, <br> Selecione Campo "Funcionário Demitido" caso Necessário.</h4></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Sair</button>
            
          </div>
        </div>
      </div>
    </div>
    
</html>