<?php

require("resources/chamadotecnico/phpmailer/class.phpmailer.php");

class visualizarchamadomodel extends CI_Model {

    private $conBanco;

    public function __construct() {
        parent::__construct();
    }

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("engsys", TRUE);
        }
    }

    private function getUsuarioLogado() {
        $this->load->library("access");

        return $this->access->getUsuarioLogado();
    }

    //------------------------------------------------------------------------//

    public function getUsuario() {
        
        $this->initConBanco();

        $id = $this->getUsuarioLogado()->ID;
    //print_r($query);exit();
        $query = "SELECT NOME, SOBRENOME, EMAIL FROM GP_CADASTRO_USUARIO WHERE ID = $id";
       // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        return $rs[0]; 
    }
    
    public function getFornecedorCliente() {
        
        $this->initConBanco();

        $id = $this->getUsuarioLogado()->ID;

        $query = "SELECT NOME, SOBRENOME, EMAIL FROM GP_CADASTRO_USUARIO WHERE ID = $id";
       // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        return $rs[0];
    }

    public function salvarChamado($nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $anexo) {

        $this->initConBanco();
       
        $idUsuario = $this->getUsuarioLogado()->ID;
        
        $nome = $this->getUsuarioLogado()->NOME;
        $sobrenome = $this->getUsuarioLogado()->SOBRENOME;
        
        $nomeCompleto = $nome." ".$sobrenome;
        
        $query = "SELECT ID_EMPRESA FROM GP_CADASTRO_USUARIO WHERE ID = $idUsuario";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $idEmpresa = $rs[0]->ID_EMPRESA;
        
        $query = "SELECT * FROM GP_SYS_EMPRESA WHERE ID_EMPRESA = $idEmpresa";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $codEmpresa = $rs[0]->COD_EMPRESA;
        $nomeEmpresa = $rs[0]->NOME_FANTASIA;
        
        $query = "SELECT MAX(ID) AS ID FROM VPIPROD.HELPDESK_CHAMADO";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) == 0) {
            $novoId = 1;
        } else {
            $novoId = $rs[0]->ID + 1;
        }
        
        $hotaAtual = date('H:i:s');
        
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE ID = $novoId";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                     
                
        if (is_array($rs) && count($rs) <= 0){
        
        
        
        $query = "INSERT INTO VPIPROD.HELPDESK_CHAMADO (ID,  NUM_CHAMADO, ID_NOME, NOME, EMAIL, TELEFONE, RAMAL, SETOR, MODULO, PRIORIDADE, DESCRICAO, DATA_ABERTURA, HORA_ABERTURA, STATUS_CHAMADO, COD_EMPRESA, NOME_EMPRESA, ANEXO)
                             VALUES ($novoId, $novoId, $idUsuario, '$nome', '$email', '$telefone', '$ramal', '$setor', '$modulo', '$prioridade', '$descricao', SYSDATE, '$hotaAtual', 'A', '$codEmpresa', '$nomeEmpresa', '$anexo')";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {

                $query = "SELECT MAX(ID) AS ID FROM VPIPROD.HELPDESK_CHAMADO_HIST";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoIdHist = 1;
                } else {
                    $novoIdHist = $rs[0]->ID + 1;
                }

                $query = "INSERT INTO VPIPROD.HELPDESK_CHAMADO_HIST (ID,  NUM_CHAMADO, DESCRICAO, DATA, HORA, ATENDIMENTO, STATUS_CHAMADO)
                                 VALUES ($novoIdHist, $novoId, '$descricao', SYSDATE, '$hotaAtual', '$nomeCompleto', 'A')";
                
                
                $status = "A";
                
            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);

                $email = $this->enviaEmailAberturaChamado($novoId, $idUsuario, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $codEmpresa, $nomeEmpresa);
                $email = $this->enviaEmailAlteracaoChamadoInterno($novoId, $status, $codEmpresa, $nomeEmpresa);
                return true;
            } else {
                return false;
            }    
            
        }else{
            
            return false;
        } 
        
    }
    
    
    
    
    private function enviaEmailAberturaChamado($novoId, $idUsuario, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao,  $codEmpresa, $nomeEmpresa){
       //print_r($emailUsuario); exit();
        
        
        
        $textoChamado = $this->getHtmlItensImpressao ($novoId, $idUsuario, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao,  $codEmpresa, $nomeEmpresa);
        //print_r("Enviar Email"); exit();
        $mail = new PHPMailer();

         $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->Host = "br502.hostgator.com.br";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = "suporte@vpitecnologia.com.br";
            @$mail->Password = "Vpisuptec100717";
        
        @$mail->From = "suporte@vpitecnologia.com.br"; // Seu e-mail
        @$mail->FromName = "Suporte - VPI Tecnologia"; // Seu nome

        //$mail->AddAddress('heitor.siqueira@sulcatarinense.com.br', 'Heitor Siqueira');
        //$mail->AddAddress('fabian@sulcatarinense.com.br', 'Fabian Kons');
        
        $mail->AddAddress($email, $nome);

        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->Subject = "Confirmação de Abertura de Chamado Técnico - Processo n° $novoId "; // Assunto da mensagem

        $mail->Body = "<body>
                    
                    <table align='center' style='font-family: sans-serif; width: 90%;'>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td align='left'>
                                         
                                            <div style='font-family: sans-serif; font-size: 30px; margin-right: 50px; margin-left: 200px; color: dodgerblue' align='right' >
                                               VPI TECNOLOGIA
                                            </div>
                                        <td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    <!-- -->

                    <!--  -->
                        
                    <!-- -->

                    <!--  -->
                            <tr>
                                <td>
                                    <p style='font-size: 1px;'> </p>
                                    <p>
                                    Prezado(a) $nome,<br /><br />
                                    Nós Recebemos sua requisição e um novo Chamado Técnico foi Criado.<br /><br /><br />
                                    
                                    </p>
                                    <p style='font-size: 1px;'> </p>
                                </td>
                            </tr>
                     <!-- --->

                    <!-- --->
                        <tr>
                            <td style='background-color: #1b3a86; border-radius: 15px; font-size: 25px;'>
                                <p align='center'  style='color: white; font-family: sans-serif;'>
                                 
                                </p>
                            </td>
                        </tr>
                    <!-- --->

                    <!--  -->
                            <tr>
                                <td>
                                   $textoChamado
                                </td>
                            </tr>
                    <!-- --->

                    <!-- --->
                    <tr>
                        <td style='background-color: #1b3a86; border-radius: 15px; font-size: 25px;'>
                        </td>
                    </tr>
                    <tr>
                        <td align='center'>
                            <font style='font-size: 12px;'>VPI TECNOLOGIA - Mensagem automática, favor não responder este e-mail.</font>
                        </td>
                    </tr>


                </table>
             </body>
                        ";

        $enviado = $mail->Send();

        $mail->ClearAllRecipients();
        $mail->ClearAttachments();



        return $enviado;
       
      
    }
    
     ///////////////////// LAYOUT Do EMAIL
    
    private function getHtmlItensImpressao($novoId, $idUsuario, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $codEmpresa, $nomeEmpresa) {
        
        
        $html = "";
        
        $html .= "<table style='zoom: 90%; width: 100%;border-collapse: collapse' border='1'>";
        
        
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 35%; background-color: #1b3a86; font-family: sans-serif; font-size:18px;'>Detalhes do Chamado nº.: $novoId </font></td>";
        
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Empresa: $nomeEmpresa - ($codEmpresa)</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Solicitante: $nome</font></td>";
        $html .= "</tr>";
       
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>E-mail: $email </font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Telefone:$telefone / Ramal: $ramal </font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Setor: $setor</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Módulo / Sistema: $modulo</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Prioridade: $prioridade</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td rowspan = '2' align='left' style='width: 37%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Descrição Inicial: $descricao</font></td>";
        $html .= "</tr>";
        
        
        
        $html .= "</table>";
        
        
        
                              
        
                                
                            
        return $html;
        
        
        
        
        
       }
       
    
    
    public function carregarChamados() {

        $this->initConBanco();
        
        $id = $this->getUsuarioLogado()->ID;
        
        
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE ID_NOME = $id";
        
        
//        if($idEmpresa != 0){
//            $query .= "AND ID_EMPRESA = '$idEmpresa'";
//        }
//        if($idFilial != 0){
//            $query .= "AND ID_FILIAL = '$idFilial'";
//        }
//        if($idRepresentante != ""){
//            $query .= "AND REPRESENTANTE = '$idRepresentante'";
//        }
//        if($situacao != "0" ){
//            $query .= "AND STATUS = '$situacao'";
//        }
//        if($idCliente != "" ){
//            $query .= "AND CLIENTE = '$idCliente'";
//        }
       
        
        $query .= " ORDER BY NUM_CHAMADO DESC";
        
       //print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
         
        if (is_array($rs) && count($rs) > 0){
            


            $html = "";

            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Chamado</td>
                        <td  style='width: 7%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Data Abertura</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Situação</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Nome</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Contato</td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Descrição</td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Histórico</td>
                        <td  style='width: 3%; padding-right: 0px;'></td>
                        



                  </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                

                $chamado  = $j;
                
                $dataAbertura  = $j;
                $dataAbertura .= "_";
                $dataAbertura .= $j;
                

                $situacao  = $j;
                $situacao .= "_";
                $situacao .= $j;
                $situacao .= "_";
                $situacao .= $j;
                

                $status  = $j;
                $status .= "_";
                $status .= $j;
                $status .= "_";
                $status .= $j;
                $status .= "_";
                $status .= $j;
                

                $nome  = $j;
                $nome .= "_";
                $nome .= $j;
                $nome .= "_";
                $nome .= $j;
                $nome .= "_";
                $nome .= $j;
                $nome .= "_";
                $nome .= $j;
                                

                $contato  = $j;
                $contato .= "_";
                $contato .= $j;
                $contato .= "_";
                $contato .= $j;
                $contato .= "_";
                $contato .= $j;
                $contato .= "_";
                $contato .= $j;
                $contato .= "_";
                $contato .= $j;
                  

                $descricao  = $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                
                
                $ramal = $item->RAMAL;
                
                if($ramal <= 0 || $ramal = null){
                    $ramal = 0;
                }
            
                
                $chamadoValor = $item->NUM_CHAMADO;
                $dataAberturaValor = $item->DATA_ABERTURA;
                
                $nomeValor = $item->NOME;
                $contatoValor = $item->TELEFONE." - Ramal ".$item->RAMAL;
                $descricaoValor = $item->DESCRICAO;
                
                
                $query = "SELECT MAX(ID) AS ID FROM VPIPROD.HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = $chamadoValor";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $id = 1;
                } else {
                    $id = $rs[0]->ID;
                }

               
                
                $query = "SELECT STATUS_CHAMADO FROM VPIPROD.HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = $chamadoValor AND ID = $id";    
                
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                
                $statusValor = $rs[0]->STATUS_CHAMADO;
                
                $html .="<tr  style='width: 95%; padding-right: 5px; font-size: 6px;' align='center' >
                        <td  style='width: 2%;  padding-right: 0px;'><div class='form'></td>
                        <td  style='width: 5%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;' id='$chamado'   value='$chamadoValor' readonly></div></td>
                        <td  style='width: 6%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;' id='$dataAbertura'   value='$dataAberturaValor' readonly></div></td>";
                            
                
                if($statusValor == "A"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: blue; font-weight: bold;' value='Aguardando Atendimento' readonly></div></td>";
                }
                
                if($statusValor == "E"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: green; font-weight: bold;' value='Em Atendimento' readonly></div></td>";
                }
                
                if($statusValor == "R"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: orange; font-weight: bold;' value='Aguardando Retorno Solicitante' readonly></div></td>";
                }
                
                if($statusValor == "F"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: green; font-weight: bold;' value='Atendimento Finalizado' readonly></div></td>";
                }
                if($statusValor == "I"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: blue; font-weight: bold;' value='Informação Complementar' readonly></div></td>";
                }
                if($statusValor == "C"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: red; font-weight: bold;' value='Chamado Cancelado' readonly></div></td>";
                }
                
                if($statusValor == "V"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: orange; font-weight: bold;' value='Solicitando Nova Verificação' readonly></div></td>";
                }
                        
                $html .="<td style='width: 15%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;' id='$nome'      value='$nomeValor' readonly></div></td>
                        <td  style='width: 15%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;' id='$contato'   value='$contatoValor' readonly></div></td>
                        <td  style='width: 30%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;' id='$descricao' value='$descricaoValor' readonly></div></td>
                        <td  style='width: 5%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-info   glyphicon glyphicon-info-sign' onclick='historicoChamado($chamadoValor)' readonly ></button></div></td>
                        <td  style='width: 2%;  padding-right: 0px;'></td>



                  </tr>";
            }


            return $html;


            
        }else{
            
            $html = "";

            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 12px;'>Chamado</td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 12px;'>Data Abertura</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px;'>Situação</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px;'>Nome</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px;'>Contato</td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'>Descrição</td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 12px;'>Histórico</td>
                        <td  style='width: 3%; padding-right: 0px;'></td>
                    </tr>";

      
            $nomeValor = "Nenhum Chamado";
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td colspan = '9'  padding-right: 2px;'><div class='form'><input  type='text' class='form-control'  style='font-size: 12px; ' value='$nomeValor' readonly></div></td>
                    </tr>";
            


            return $html;

        }
    }
    
    
    
    public function historicoChamado($chamado) {

        $this->initConBanco();
        
        $id = $this->getUsuarioLogado()->ID;
        
        
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE NUM_CHAMADO = '$chamado'";
        
        
       //print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
         
        if (is_array($rs) && count($rs) > 0){
            
                $ramal = $rs[0]->RAMAL;
                
                if($ramal <= 0 || $ramal = null){
                    $ramal = 0;
                }
               
                $chamadoValor = $rs[0]->NUM_CHAMADO;
                $dataAberturaValor = $rs[0]->DATA_ABERTURA;
                $prioridadeValor = $rs[0]->PRIORIDADE;
                $statusValor = $rs[0]->STATUS_CHAMADO;
                $nomeValor = $rs[0]->NOME;
                $contatoValor = $rs[0]->TELEFONE." - Ramal ".$ramal;
                $descricaoValor = $rs[0]->DESCRICAO;
                $moduloValor = $rs[0]->MODULO;
                $setorValor = $rs[0]->SETOR;
                $anexoValor = $rs[0]->ANEXO;
                $codEmpresa = $rs[0]->COD_EMPRESA;
                $nomeEmpresa = $rs[0]->NOME_EMPRESA;
                
               
                
                if ($anexoValor != null){
                    
                    $anexo = substr($anexoValor, 21 ); 
                    
                    $anexo = "</b><a href='http://189.11.172.90/vpi/$anexo'  target='_blank'> Visualizar Anexo</a>";
                }
                if ($anexoValor == null){
                    $anexo = " Sem Anexo";
                }
                
                if($prioridadeValor == "BAIXA"){
                    $prioridadeValor = "<span style='color:#2eb82e'> $prioridadeValor</span>";
                }
                if($prioridadeValor == "MEDIA"){
                    $prioridadeValor = "<span style='color:#cccc00'> $prioridadeValor</span>";
                }
                if($prioridadeValor == "ALTA"){
                    $prioridadeValor = "<span style='color:#ff0000'> $prioridadeValor</span>";
                }
                if($prioridadeValor == "URGENTE"){
                    $prioridadeValor = "<span style='color:#ff0000'>*** $prioridadeValor ***</span>";
                }
                

            $html = "";

            $html .="<table style='width: 95%; padding-right: 5px; ' align='center' >";
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td  colspan = '5' style='width: 95%; padding-right: 0px; background-color: #1b3a86; color: #ffffff; font-size: 16px;'>INFORMAÇÕES CHAMADO TÉCNICO Nº $chamado </td>
                    </tr>";
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='left' >
                        <td  style='width: 5%; padding-right: 0px;'></td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Chamado:</b> $chamadoValor</td>
                        <td  style='width: 30%; padding-right: 5px; font-size: 12px;'><b>Data Abertura:</b> $dataAberturaValor</td>
                        <td  style='width: 30%; padding-right: 5px; font-size: 12px;'><b>Empresa:</b> $nomeEmpresa - ($codEmpresa)</td>
                        
                    </tr>
                    
                    <tr>
                        <td style='height:3px;'></td>
                    </tr>
            
                                        
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' >
                        <td  style='width: 5%; padding-right: 0px;'></td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Nome:</b> $nomeValor</td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Contato:</b> $contatoValor</td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Setor:</b> $setorValor</td>    
                            
                    </tr>
                    
                    <tr>
                        <td style='height:3px;'></td>
                    </tr>
                    
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' > 
                        <td  style='width: 5%; padding-right: 0px;'></td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Prioridade:$prioridadeValor</b></td> 
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Módulo/Sitema:</b> $moduloValor</td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'><b>Anexo: $anexo</td>
                    </tr>
                    
                    <tr>
                        <td style='height:3px;'></td>
                    </tr>
            
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' >     
                    
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  colspan = '3' style='width: 95%; padding-right: 5px;font-size: 12px;'><b>Descrição Inicial:</b> $descricaoValor</td>
                    </tr>";
            
            
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td  colspan = '5' style='width: 95%; padding-right: 0px; background-color: #1b3a86; color: #ffffff; font-size: 16px;'>- - - DETALHES - - -</td>
                    </tr>";
            
            $html .="</table>";
            
            $html .="<table style='width: 95%; padding-right: 5px; ' align='center' >";
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Data</td>
                        <td  style='width: 21%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Situação</td>
                        <td  style='width: 16%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Cadastrado por</td>
                        <td  style='width: 35%; padding-right: 5px;font-size: 12px; font-weight: bold;'>Descrição</td>
                        
                        



                  </tr>";



            
            $query = "SELECT T1.NUM_CHAMADO, T1.NOME, T1.TELEFONE, T1.RAMAL, T2.STATUS_CHAMADO, T2.DESCRICAO, T2.ATENDIMENTO, T2.DATA, T2.HORA FROM VPIPROD.HELPDESK_CHAMADO T1 INNER JOIN VPIPROD.HELPDESK_CHAMADO_HIST T2 "
                . "ON T1.NUM_CHAMADO = T2.NUM_CHAMADO WHERE T2.NUM_CHAMADO = '$chamado' ORDER BY T2.ID DESC";
            
           //$query = "SELECT * FROM HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = '$chamado'";
        
            //print_r($query);exit();
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
         

            foreach ($rs as $item) {

               
                
                $ramal = $item->RAMAL;
                
                if($ramal <= 0 || $ramal = null){
                    $ramal = 0;
                }
               
                $dataAberturaValor = $item->DATA." - ". $item->HORA;
                $statusValor = $item->STATUS_CHAMADO;
                $nomeValor = $item->ATENDIMENTO;
                $descricaoValor = $item->DESCRICAO;
                
                if($nomeValor == null){
                    $nomeValor = "Sem Informação";
                }
                
                
                $html .="<tr  style='width: 95%; padding-right: 5px; font-size: 6px;' align='center' >
                       
                        <td  style='width: 15%;  padding-right: 2px;' ><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;'     value='$dataAberturaValor' readonly></div></td>";
                     
                if($statusValor == "A"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000066; font-weight: bold;' value='Aguardando Atendimento' readonly></div></td>";
                }
                
                if($statusValor == "E"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: green; font-weight: bold;' value='Em Atendimento' readonly></div></td>";
                }
                
                if($statusValor == "R"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: orange; font-weight: bold;' value='Aguardando Retorno Solicitante</b>' readonly></div></td>";
                }
                
                if($statusValor == "F"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: green; font-weight: bold;' value='Atendimento Finalizado' readonly></div></td>";
                }
                if($statusValor == "I"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: blue; font-weight: bold;' value='Informação Complementar' readonly></div></td>";
                }
                if($statusValor == "C"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: red; font-weight: bold;' value='Chamado Cancelado' readonly></div></td>";
                }
                
                if($statusValor == "V"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: orange; font-weight: bold;' value='Solicitando Nova Verificação' readonly></div></td>";
                }
                        
                $html .="<td  style='width: 16%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;'   value='$nomeValor' readonly></div></td>
                        <td  style='width: 35%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: #000000;'   value='$descricaoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            
        }
    }
    
    public function novasInformacoesChamado($chamado) {

        $this->initConBanco();
        
        $id = $this->getUsuarioLogado()->ID;
        
        
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE ID_NOME = $id AND NUM_CHAMADO = '$chamado'";
        
        
       //print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
         
        if (is_array($rs) && count($rs) > 0){
            
                $ramal = $rs[0]->RAMAL;
                
                if($ramal <= 0 || $ramal = null){
                    $ramal = 0;
                }
               
                $chamadoValor = $rs[0]->NUM_CHAMADO;
                $dataAberturaValor = $rs[0]->DATA_ABERTURA;
                $prioridadeValor = $rs[0]->PRIORIDADE;
                $statusValor = $rs[0]->STATUS_CHAMADO;
                $nomeValor = $rs[0]->NOME;
                $contatoValor = $rs[0]->TELEFONE." - Ramal ".$rs[0]->RAMAL;
                $descricaoValor = $rs[0]->DESCRICAO;
                $moduloValor = $rs[0]->MODULO;
                $setorValor = $rs[0]->SETOR;


            $html = "";

            $html .="<table style='width: 95%; padding-right: 5px; ' align='center' >";
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td  colspan = '5' style='width: 95%; padding-right: 0px; background-color: #1b3a86; color: #ffffff; font-size: 16px;'>INFORMAÇÕES CHAMADO TÉCNICO Nº $chamado </td>
                    </tr>";
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='left' >
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  colspan = '2' style='width: 30%; padding-right: 5px;font-size: 12px;'>Chamado: $chamadoValor</td>
                        <td  style='width: 60%; padding-right: 5px;font-size: 12px;'>Data Abertura: $dataAberturaValor</td>
                        
                    </tr>
            
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' >
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  colspan = '2' style='width: 30%; padding-right: 5px;font-size: 12px;'>Prioridade: $prioridadeValor</td> 
                        <td  style='width: 60%; padding-right: 5px;font-size: 12px;'>Situação: $statusValor</td>
                            
                    </tr>
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' > 
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  colspan = '2' style='width: 30%; padding-right: 5px;font-size: 12px;'>Nome: $nomeValor</td>
                        <td  style='width: 60%; padding-right: 5px;font-size: 12px;'>Contato: $contatoValor</td>
                    </tr>
                    
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' > 
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  colspan = '2' style='width: 30%; padding-right: 5px;font-size: 12px;'>Setor: $setorValor</td>
                        <td  style='width: 60%; padding-right: 5px;font-size: 12px;'>Módulo/Sitema: $moduloValor</td>
                    </tr>
            
                    <tr  style='width: 95%; padding-right: 5px; ' align='left' >     
                    
                        <td  style='width: 2%; padding-right: 0px;'></td>
                        <td  colspan = '4' style='width: 90%; padding-right: 5px;font-size: 12px;'>Descrição: $descricaoValor</td>
                    </tr>";
            
            
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        <td  colspan = '5' style='width: 95%; padding-right: 0px; background-color: #1b3a86; color: #ffffff; font-size: 16px;'>- - - DETALHES - - -</td>
                    </tr>";
            
            $html .="</table>";
            
            $html .="<table style='width: 95%; padding-right: 5px; ' align='center' >";
            
            $html .="<tr  style='width: 95%; padding-right: 5px; ' align='center' >
                        
                        <td  style='width: 5%; padding-right: 5px;font-size: 12px;'>Data</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px;'>Situação</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 12px;'>Atendente</td>
                        <td  style='width: 30%; padding-right: 5px;font-size: 12px;'>Descrição</td>
                        <td  style='width: 3%; padding-right: 0px;'></td>
                        



                  </tr>";



            
            $query = "SELECT T1.NUM_CHAMADO, T1.NOME, T1.TELEFONE, T1.RAMAL, T2.STATUS_CHAMADO, T2.DESCRICAO, T2.ATENDIMENTO, T2.DATA, T2.HORA FROM VPIPROD.HELPDESK_CHAMADO T1 INNER JOIN VPIPROD.HELPDESK_CHAMADO_HIST T2 "
                . "ON T1.NUM_CHAMADO = T2.NUM_CHAMADO WHERE T1.ID_NOME = $id AND T2.NUM_CHAMADO = '$chamado'";
            
           //$query = "SELECT * FROM HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = '$chamado'";
        
            //print_r($query);exit();
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
         

            foreach ($rs as $item) {

               
                
                $ramal = $item->RAMAL;
                
                if($ramal <= 0 || $ramal = null){
                    $ramal = 0;
                }
               
                $dataAberturaValor = $item->DATA." - ". $item->HORA;
                $statusValor = $item->STATUS_CHAMADO;
                $nomeValor = $item->ATENDIMENTO;
                $descricaoValor = $item->DESCRICAO;
                
                if($nomeValor == null){
                    $nomeValor = "Direcionando Para Analista";
                }
                
                
                $html .="<tr  style='width: 95%; padding-right: 5px; font-size: 6px;' align='center' >
                       
                        <td  style='width: 18%;  padding-right: 2px;' ><div class='form'><input  type='text' class='form-control' style='font-size: 12px;'     value='$dataAberturaValor' readonly></div></td>";
                     
                if($statusValor == "A"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: blue;' value='Aguardando Atendimento' readonly></div></td>";
                }
                
                if($statusValor == "E"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: green;' value='Em Atendimento' readonly></div></td>";
                }
                
                if($statusValor == "R"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: orange;' value='Aguardando Retorno Solicitante' readonly></div></td>";
                }
                
                if($statusValor == "F"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: green;' value='Atendimento Finalizado' readonly></div></td>";
                }
                
                if($statusValor == "V"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: blue;' value='Solicitando Nova Verificação' readonly></div></td>";
                }
                
                if($statusValor == "C"){
                    $html .="<td  style='width: 21%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px; color: red;' value='Chamado Cancelado' readonly></div></td>";
                }
                        
                $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;'   value='$nomeValor' readonly></div></td>
                        <td  style='width: 40%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;'   value='$descricaoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            
        }
    }
    
    ////// SALVAR INFORMAÇÕES REFERENTES AO CHAMADO
    
    public function salvarInformacoesChamado($chamado, $status, $descricao) {

        $this->initConBanco();
       
        $idUsuario = $this->getUsuarioLogado()->ID;
        
        $nome = $this->getUsuarioLogado()->NOME;
        $sobrenome = $this->getUsuarioLogado()->SOBRENOME;
        
        $nomeCompleto = $nome." ".$sobrenome;
        
              
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE NUM_CHAMADO = $chamado";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $codEmpresa = $rs[0]->COD_EMPRESA;
        $nomeEmpresa = $rs[0]->NOME_EMPRESA;
        
        
        $query = "SELECT MAX(ID) AS ID FROM VPIPROD.HELPDESK_CHAMADO_HIST";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) == 0) {
            $novoId = 1;
        } else {
            $novoId = $rs[0]->ID + 1;
        }
        
        $hotaAtual = date('H:i:s');
        
        
        
        $query = "INSERT INTO VPIPROD.HELPDESK_CHAMADO_HIST (ID,  NUM_CHAMADO, DESCRICAO, DATA, HORA, STATUS_CHAMADO, ATENDIMENTO, ID_NOME_HIST  )
                             VALUES ($novoId, $chamado, '$descricao', SYSDATE, '$hotaAtual', '$status', '$nomeCompleto', $idUsuario )";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {

                if($status == 'E' || $status == 'R'|| $status == 'F' || $status == 'C' ){
                    
                    $email = $this->enviaEmailAlteracaoChamado($chamado, $status, $codEmpresa, $nomeEmpresa);
                }
                if($status == 'I'|| $status == 'V' || $status == 'C'|| $status == 'F'){
                    
                    $email = $this->enviaEmailAlteracaoChamadoInterno($chamado, $status, $codEmpresa, $nomeEmpresa);
                }
                
                $query = "UPDATE VPIPROD.HELPDESK_CHAMADO SET STATUS_CHAMADO = '$status' WHERE NUM_CHAMADO = '$chamado'";
    
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if($resultado == true || $resultado == 1){
                    return true;            
                
                    
                }else{
                    return false; 
                }
                
                
            } else {
                return false;
            }    
            
         
        
    }
    
    
    
    private function enviaEmailAlteracaoChamado($chamado, $status, $codEmpresa, $nomeEmpresa){
      // print_r("Enviar Email"); exit();
        
        
        $this->initConBanco();
        
        
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE NUM_CHAMADO = '$chamado'";
        
         //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
         
        if (is_array($rs) && count($rs) > 0){
            
                $ramal = $rs[0]->RAMAL;
                
                if($ramal <= 0 || $ramal = null){
                    $ramal = 0;
                }
               
                $chamado = $rs[0]->NUM_CHAMADO;
                $prioridade = $rs[0]->PRIORIDADE;
                $nome = $rs[0]->NOME;
                $telefone = $rs[0]->TELEFONE;
                $descricao = $rs[0]->DESCRICAO;
                $modulo = $rs[0]->MODULO;
                $setor = $rs[0]->SETOR;
                $email = $rs[0]->EMAIL;
                       
        
        
        if($status == 'E'){
            
            $subject = "Suporte Técnico VPI Tecnologia - Chamado Técnico - Processo n° $chamado está em Atendimento ";
            $inicio = "Sua requisição está em atendimento por nossa equipe de suporte.";
        }
        
        if($status == 'R'){
            
            $subject = "Suporte Técnico VPI Tecnologia - Chamado Técnico - Processo n° $chamado, está aguardando seu retorno";
            $inicio = "Você recebeu uma informação referente ao chamado técnico n° $chamado.";
        }
        
        if($status == 'C'){
            
            $subject = "Suporte Técnico VPI Tecnologia - Confirmação de Cancelamento de Chamado Técnico - Processo n° $chamado ";
            $inicio = "O Chamado nº $chamado, foi Cancelado. <br />"
                    . "Caso esta informação não esteja de acordo, favor entrar em contato com a equipe de suporte.";
        }
        
        if($status == 'F'){
            
            $subject = "Suporte Técnico VPI Tecnologia - Chamado Técnico - Processo n° $chamado, foi Finalizado ";
            $inicio = "O Chamado nº $chamado, foi Foi. <br />"
                    . "Caso esta informação não esteja de acordo, favor entrar em contato com a equipe de suporte.";
        }
        
        
        
        
        
        
        $textoChamado = $this->getHtmlItensImpressaoAlteracao($chamado, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $codEmpresa, $nomeEmpresa);

        
        
        $mail = new PHPMailer();

         $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->Host = "br502.hostgator.com.br";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = "suporte@vpitecnologia.com.br";
            @$mail->Password = "Vpisuptec100717";
        
        @$mail->From = "suporte@vpitecnologia.com.br"; // Seu e-mail
        @$mail->FromName = "Suporte - VPI Tecnologia"; // Seu nome

        //$mail->AddAddress('heitor.siqueira@sulcatarinense.com.br', 'Heitor Siqueira');
        //$mail->AddAddress('fabian@sulcatarinense.com.br', 'Fabian Kons');
        $mail->AddAddress($email, $nome);

        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->Subject = $subject; // Assunto da mensagem

        $mail->Body = "<body>
                    
                    <table align='center' style='font-family: sans-serif; width: 90%;'>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td align='left'>
                                         
                                            <div style='font-family: sans-serif; font-size: 30px; margin-right: 50px; margin-left: 200px; color: dodgerblue' align='right' >
                                               VPI TECNOLOGIA
                                            </div>
                                        <td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    <!-- -->

                    <!--  -->
                        
                    <!-- -->

                    <!--  -->
                            <tr>
                                <td>
                                    <p style='font-size: 1px;'> </p>
                                    <p>
                                    Prezado(a) $nome,<br /><br />
                                    $inicio<br /><br /><br />
                                    
                                    </p>
                                    <p style='font-size: 1px;'> </p>
                                </td>
                            </tr>
                     <!-- --->

                    <!-- --->
                        <tr>
                            <td style='background-color: #1b3a86; border-radius: 15px; font-size: 25px;'>
                                <p align='center'  style='color: white; font-family: sans-serif;'>
                                 
                                </p>
                            </td>
                        </tr>
                    <!-- --->

                    <!--  -->
                            <tr>
                                <td>
                                   $textoChamado
                                </td>
                            </tr>
                    <!-- --->

                    <!-- --->
                    <tr>
                        <td style='background-color: #1b3a86; border-radius: 15px; font-size: 25px;'>
                        </td>
                    </tr>
                    <tr>
                        <td align='center'>
                            <font style='font-size: 12px;'>VPI TECNOLOGIA - Mensagem automática, favor não responder este e-mail.</font>
                        </td>
                    </tr>


                </table>
             </body>
                        ";

        $enviado = $mail->Send();

        $mail->ClearAllRecipients();
        $mail->ClearAttachments();



        return $enviado;
        }  
      
    }
    
     
        
        
    
    
    private function enviaEmailAlteracaoChamadoInterno($chamado, $status, $codEmpresa, $nomeEmpresa){
      // print_r("Enviar Email"); exit();
        
        
        $this->initConBanco();
        
        
        $query = "SELECT * FROM VPIPROD.HELPDESK_CHAMADO WHERE NUM_CHAMADO = '$chamado'";
        
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
         
        if (is_array($rs) && count($rs) > 0){
            
                    $ramal = $rs[0]->RAMAL;

                    if($ramal <= 0 || $ramal = null){
                        $ramal = 0;
                    }

                    $chamado = $rs[0]->NUM_CHAMADO;
                    $prioridade = $rs[0]->PRIORIDADE;
                    $nome = $rs[0]->NOME;
                    $telefone = $rs[0]->TELEFONE;
                    $descricao = $rs[0]->DESCRICAO;
                    $modulo = $rs[0]->MODULO;
                    $setor = $rs[0]->SETOR;
                    $email = $rs[0]->EMAIL;


            if($status == 'A'){

                $subject = "(EMAIL EQUIPE) - Novo Chamado Técnico - Processo n° $chamado";
                $inicio = "Foi aberto um novo Chamado nº $chamado. <br />.";
            }
                    
            if($status == 'I'){

                $subject = "(EMAIL EQUIPE) - Chamado Técnico - Processo n° $chamado - (NOVA INFORMAÇÃO) ";
                $inicio = "Foi enviado informaçoes complementares referente ao Chamado nº $chamado. <br />.";
            }

            if($status == 'V'){

                $subject = "(EMAIL EQUIPE) - Chamado Técnico - Processo n° $chamado - (SOLICITADO NOVA VERIFICAÇÃO)";
                $inicio = "Foi solicitado nova verificacao referente ao Chamado nº $chamado. <br />";
            }    
            
            if($status == 'C'){
            
            $subject = "(EMAIL EQUIPE) - Chamado Técnico - Processo n° $chamado - (CANCELAMENTO) ";
            $inicio = "O Chamado nº $chamado, foi Cancelado. <br />";
                    
            }

            if($status == 'F'){

                $subject = "(EMAIL EQUIPE) - Chamado Técnico - Processo n° $chamado - (FINALIZADO) ";
                $inicio = "O Chamado nº $chamado, foi Finalizado. <br />";
                        
            }

            $textoChamado = $this->getHtmlItensImpressaoAlteracao($chamado, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $codEmpresa, $nomeEmpresa);



            $mail = new PHPMailer();

            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->Host = "br502.hostgator.com.br";
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = "suporte@vpitecnologia.com.br";
            @$mail->Password = "Vpisuptec100717";

            @$mail->From = "suporte@vpitecnologia.com.br"; // Seu e-mail
            @$mail->FromName = "Suporte - VPI Tecnologia"; // Seu nome

//            $mail->AddAddress('heitor.siqueira@vpitecnologia.com.br', 'Heitor Siqueira');
            $mail->AddAddress('setortecnico@vpitecnologia.com.br', 'Setor Tecnico');
            //$mail->AddAddress($email, $nome);

            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
            $mail->Subject = $subject; // Assunto da mensagem

            $mail->Body = "<body>

                        <table align='center' style='font-family: sans-serif; width: 90%;'>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td align='left'>
                                             
                                                <div style='font-family: sans-serif; font-size: 30px; margin-right: 50px; margin-left: 200px; color: dodgerblue' align='right' >
                                                   VPI TECNOLOGIA
                                                </div>
                                            <td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        <!-- -->

                        <!--  -->

                        <!-- -->

                        <!--  -->
                                <tr>
                                    <td>
                                        <p style='font-size: 1px;'> </p>
                                        <p>
                                        
                                        $inicio<br /><br /><br />

                                        </p>
                                        <p style='font-size: 1px;'> </p>
                                    </td>
                                </tr>
                         <!-- --->

                        <!-- --->
                            <tr>
                                <td style='background-color: #1b3a86; border-radius: 15px; font-size: 25px;'>
                                    <p align='center'  style='color: white; font-family: sans-serif;'>

                                    </p>
                                </td>
                            </tr>
                        <!-- --->

                        <!--  -->
                                <tr>
                                    <td>
                                       $textoChamado
                                    </td>
                                </tr>
                        <!-- --->

                        <!-- --->
                        <tr>
                            <td style='background-color: #1b3a86; border-radius: 15px; font-size: 25px;'>
                            </td>
                        </tr>
                        <tr>
                            <td align='center'>
                                <font style='font-size: 12px;'>VPI TECNOLOGIA - Mensagem automática, favor não responder este e-mail.</font>
                            </td>
                        </tr>


                    </table>
                 </body>
                            ";

            $enviado = $mail->Send();

            $mail->ClearAllRecipients();
            $mail->ClearAttachments();



            return $enviado;
        }   
      
    }

    private function getHtmlItensImpressaoAlteracao($chamado, $nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $codEmpresa, $nomeEmpresa) {
   
        
        $html = "";
        
        $html .= "<table style='zoom: 90%; width: 100%;border-collapse: collapse' border='1'>";
        
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 35%; background-color: #1b3a86; font-family: sans-serif; font-size:18px;'>Detalhes do Chamado nº.: $chamado </font></td>";
        
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Empresa: $nomeEmpresa - ($codEmpresa)</font></td>";
        $html .= "</tr>";
       
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Solicitante: $nome</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>E-mail: $email </font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Telefone:$telefone / Ramal: $ramal </font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Setor: $setor</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Modulo / Sistema: $modulo</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td align='left' style='width: 80%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Prioridade: $prioridade</font></td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
        $html .= "<td rowspan = '2' align='left' style='width: 37%; background-color: #fffff; font-family: sans-serif; font-size:16px;'>Descricao Inicial: $descricao</font></td>";
        $html .= "</tr>";
        
        
        
        $html .= "</table>";
        
        
//         $query = "SELECT T2.ID, T2.STATUS_CHAMADO, T2.DESCRICAO, T2.ATENDIMENTO, T2.DATA, T2.HORA FROM HELPDESK_CHAMADO T1 INNER JOIN HELPDESK_CHAMADO_HIST T2 "
//                . "ON T1.NUM_CHAMADO = T2.NUM_CHAMADO WHERE T2.NUM_CHAMADO = '$chamado' AND T1.COD_EMPRESA = '$codEmpresa' ORDER BY ID DESC ";
//            
//           //$query = "SELECT * FROM HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = '$chamado'";
//        
//           // print_r($query);exit();
//        
//            $cs = $this->conBanco->query($query);
//            $rs = $cs->result();
//         
//            $html .="<tr  style='width: 80%; padding-right: 5px; ' align='center' >
//                        <td  colspan = '5' style='width: 80%; padding-right: 0px; background-color: #1b3a86; color: #ffffff; font-size: 16px;'>- - - DETALHES - - -</td>
//                    </tr>";
//            
//                $html .="</table>";
//
//                $html .="<table style='width: 80%; padding-right: 5px; ' align='center' >";
//
//                $html .="<tr  style='width: 80%; padding-right: 5px; ' align='center' >
//
//                            <td  style='width: 5%; padding-right: 5px;font-size: 14px; font-weight: bold;'>Data</td>
//                            <td  style='width: 15%; padding-right: 5px;font-size: 14px; font-weight: bold;'>Situação</td>
//                            <td  style='width: 15%; padding-right: 5px;font-size: 14px; font-weight: bold;'>Cadastrado por</td>
//                            <td  style='width: 30%; padding-right: 5px;font-size: 14px; font-weight: bold;'>Descrição</td>
//                            <td  style='width: 3%; padding-right: 0px;'></td>
//
//
//                      </tr>";
//                
//
//            foreach ($rs as $item) {
//
//               
//               
//                $dataAberturaValor = $item->DATA." - ". $item->HORA;
//                $statusValor = $item->STATUS_CHAMADO;
//                $nomeValor = $item->ATENDIMENTO;
//                $descricaoValor = $item->DESCRICAO;
//                
//                if($nomeValor == null){
//                    $nomeValor = "Direcionando Para Analista";
//                }
//                
//                
//                
//                
//                $html .="<tr  style='width: 80%; padding-right: 5px; font-size: 6px;' align='center' >
//                       
//                        <td  style='width: 15%;  padding-right: 2px;' ><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: #000000;'     value='$dataAberturaValor' readonly></div></td>";
//                     
//                if($statusValor == "A"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: #000066; font-weight: bold;' value='Aguardando Atendimento' readonly></div></td>";
//                }
//                
//                if($statusValor == "E"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: green; font-weight: bold;' value='Em Atendimento' readonly></div></td>";
//                }
//                
//                if($statusValor == "R"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: orange; font-weight: bold;' value='Aguardando Retorno Solicitante</b>' readonly></div></td>";
//                }
//                
//                if($statusValor == "F"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: green; font-weight: bold;' value='Atendimento Finalizado' readonly></div></td>";
//                }
//                if($statusValor == "I"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: blue; font-weight: bold;' value='Informação Complementar' readonly></div></td>";
//                }
//                if($statusValor == "C"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: red; font-weight: bold;' value='Chamado Cancelado' readonly></div></td>";
//                }
//                
//                if($statusValor == "V"){
//                    $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: orange; font-weight: bold;' value='Solicitando Nova Verificação' readonly></div></td>";
//                }
//                        
//                $html .="<td  style='width: 20%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: #000000;'   value='$nomeValor' readonly></div></td>
//                        <td  style='width: 25%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px; color: #000000;'   value='$descricaoValor' readonly></div></td>
//                        
//
//
//
//                  </tr>";
//        
//                              
//            }
                                
                            
        return $html;
        
        
        
        
        
    }
    
    
    public function verificastatusChamado($chamado){
      
        
        $this->initConBanco();
        
        $query = "SELECT MAX(ID) AS ID FROM VPIPROD.HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = '$chamado'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $id = $rs[0]->ID;
        
        
        $query = "SELECT STATUS_CHAMADO FROM VPIPROD.HELPDESK_CHAMADO_HIST WHERE NUM_CHAMADO = '$chamado' AND ID ='$id'";
        
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
         
        $statusChamado = $rs[0]->STATUS_CHAMADO;

            
        if($statusChamado == "C" || $statusChamado == "F"){
            
            return true;
        
            
        }else{
            return false;
        }
        
       
        
        
    }
    
    
    
    

}
