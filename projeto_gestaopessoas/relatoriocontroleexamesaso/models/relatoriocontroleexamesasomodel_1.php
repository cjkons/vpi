<?php

require_once("resources/relatoriocontroleexamesaso/dompdf/dompdf_config.inc.php");

class relatoriocontroleexamesasomodel extends CI_Model {

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

    public function carregarEmpresa() {

        $this->initConBanco();

        $query = "SELECT ID_EMPRESA, NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ATIVO = 'S' ORDER BY NOME_FANTASIA ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idEmpresa = $item->ID_EMPRESA;
                $nome = $item->NOME_FANTASIA;
                $html .= "<option value='$idEmpresa'>$nome</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Empresa Cadastrado</option>";
        }
    }

    public function carregarFilial($idEmpresa) {

        $this->initConBanco();


        if ($idEmpresa != "") {

            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA = '$idEmpresa'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idEmpresa = $item->ID_EMPRESA_FILIAL;
                    $nome = $item->NOME_FANTASIA;
                    $html .= "<option value='$idEmpresa'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Filial Cadastrada</option>";
            }
        } else {

            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idEmpresa = $item->ID_EMPRESA_FILIAL;
                    $nome = $item->NOME_FANTASIA;
                    $html .= "<option value='$idEmpresa'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Filial Cadastrada</option>";
            }
        }
    }

    

    public function carregarDataAtual() {

        $dataAtual = date('d/m/Y');

        return $dataAtual;
    }

    public function filtro($periodoIni, $periodoFim, $situacao, $idEmpresa, $idFilial) {

        $dataAtualizada = date('d/m/Y');

        $this->initConBanco();

        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $idEmpresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $empresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$idFilial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $filial = $rs[0]->NOME_FANTASIA;


        $periodoRelatorio = 2;

        $html = "";

        //CABECALHO INICIO
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1';>";
        $html .= "<tr style = 'background-color: #579CE9;'>";
        $html .= "<td class = 'nomeempresa' rowspan = '6' colspan = '6' align = 'left'  style = 'color: #ffffff; ' align = 'center';><b>&nbsp;&nbsp;$empresa / $filial</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '5'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td class = 'nomerelatorio'colspan = '5' style = 'color: #ffffff;' align = 'right'><b>RELATÓRIO DE EXAMES ASO&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '5'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  colspan = '2' class = 'datas' style = 'color: #ffffff; ' align = 'right'><b>Data Emissão:</b></td>";
        $html .= "<td  colspan = '3'  style = 'color: #ffffff; ' align = 'center'>$dataAtualizada</td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  colspan = '2' class = 'datas' style = 'color: #ffffff; ' align = 'right'><b> Período:</b></td>";
        $html .= "<td  colspan = '3'  style = 'color: #ffffff; ' align = 'center'>$periodoIni à $periodoFim</td>";
        $html .= "</tr>";
        $html .= "</table>";
        //CABECALHO FIM
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        $html .= "<tr style = 'background-color: #ffffff; height: 10px;'>";
        $html .= "<tr style = 'background-color: #579CE9; height: 15px;'>";

        $html .= "<tr style = 'background-color: #579CE9; height: 15px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff;' align = 'left'><b>Nome</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;' align = 'center'><b></b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;'  align = 'left'><b>Data</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;'  align = 'left'><b>Período</b></td>";



        for ($i = 0; $i < $periodoRelatorio; $i++) {


            $html .= "<td style = 'width: 3%; color: #ffffff;'  align = 'left'><b>Data</b></td>";
            $html .= "<td style = 'width: 3%; color: #ffffff;'  align = 'left'><b>Tipo</b></td>";
            $html .= "<td style = 'width: 9%; color: #ffffff;' align = 'left'><b>Data</b></td>";
            $html .= "<td style = 'width: 9%; color: #ffffff;' align = 'left'><b>Data</b></td>";
            $html .= "<td style = 'width: 9%; color: #ffffff;' align = 'left'><b>Tipo</b></td>";
        }


        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 15px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff;'  align = 'left'><b>Funcionário</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;'  align = 'left'><b>Funcao</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;'  align = 'left'><b>Admissão</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;'  align = 'left'><b>Exame ASO</b></td>";


        for ($i = 0; $i < $periodoRelatorio; $i++) {


            $html .= "<td style = 'width: 3%; color: #ffffff;'  align = 'left'><b>Primeiro Exame</b></td>";
            $html .= "<td style = 'width: 3%; color: #ffffff;'  align = 'left'><b>Exame</b></td>";
            $html .= "<td style = 'width: 9%; color: #ffffff;' align = 'left'><b>Prox. Exame</b></td>";
            $html .= "<td style = 'width: 9%; color: #ffffff;' align = 'left'><b>Realização Exame</b></td>";
            $html .= "<td style = 'width: 9%; color: #ffffff;' align = 'left'><b>Exame</b></td>";
        }



        $html .= "</tr>";



        $query = " SELECT DISTINCT T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO, T2.PERIODO_EXAME_ASO
                                FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2
                                ON  T1.FUNCAO = T2.ID_FUNCAO
                                WHERE
                                T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial' ";


        if ($situacao != 0 || $situacao != "0") {
            $query .= " AND T3.TIPO_EXAMES = '$situacao'";
        }

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {




            foreach ($rs as $item) {

                $idFuncionario = $item->ID_FUNCIONARIO;

    // CALCULO PARA DATAS FUTURAS DO EXAME
                $dataAdmissao = date('d/m/Y', strtotime($item->DATA_ADMISSAO));
                $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                $periodoExame = $periodoExame;
                $dataProxExame = new DateTime($dataAdmissao);
                $dataProxExame->add(new DateInterval('P' . $periodoExame . 'M'));
                $dataProxExame = $dataProxExame->format('m/d/Y');

                $dataExameFuturo = date('d/m/Y', strtotime($dataProxExame));



                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                $html .= "<td  style = 'width: 10%;' align = 'left'><b>$item->NOME_FUNCIONARIO</b></td>";
                $html .= "<td  style = 'width: 10%;' align = 'left'><b>$item->FUNCAO</b></td>";
                $html .= "<td  style = 'width: 10%; ' align = 'left'><b>$item->DATA_ADMISSAO</b></td>";
                $html .= "<td  style = 'width: 10%; ' align = 'left'><b>$item->PERIODO_EXAME_ASO</b></td>";


    // REPETIÇÃO DO RELATORIO                
    /// TRAZER EM SEQUENCIA AS DATAS DE EXAMES REALIZADOS
                $query = " SELECT T1.DATA_ADMISSAO, T3.TIPO_EXAMES, T3.DATA_REALIZACAO, T2.PERIODO_EXAME_ASO FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2 
                                ON T1.FUNCAO = T2.ID_FUNCAO INNER JOIN GP_CAD_EXAME_ASO T3  
                                ON T1.ID_FUNCIONARIO = T3.FUNCIONARIO 
                                WHERE T3.DATA_REALIZACAO >= TO_DATE('$periodoIni', 'DD/MM/YYYY') AND T3.DATA_REALIZACAO <= TO_DATE ('$periodoFim', 'DD/MM/YYYY')
                                AND T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial' AND T1.ID_FUNCIONARIO = '$idFuncionario'";
                //print_r($query);exit();    
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (is_array($rs) && count($rs) > 0) {

                    $dataAdmissao = date('d/m/Y', strtotime($item->DATA_ADMISSAO));
                    $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                    $periodoExame = $periodoExame;
                    $dataProxExame = new DateTime($dataAdmissao);
                    $dataProxExame->add(new DateInterval('P' . $periodoExame . 'M'));
                    $dataProxExame = $dataProxExame->format('m/d/Y');

                    $dataExameFuturo = date('d/m/Y', strtotime($dataProxExame));

                    foreach ($rs as $item) {
                        
                        $tipoExame = $item->TIPO_EXAMES;
                        $tipoExame = substr("$tipoExame", 0, 3);

                        $html .= "<td  style = 'width: 10%;' align = 'left'><b>$item->DATA_REALIZACAO</b></td>";
                        $html .= "<td  style = 'width: 10%;'  align = 'left'><b>$tipoExame</b></td>";
                        $html .= "<td  style = 'width: 10%;'  align = 'left'>$dataExameFuturo</td>";
                        
                        $dataAdmissao = date('d/m/Y', strtotime($dataExameFuturo));
                            $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                            $periodoExame = $periodoExame;
                            $dataProxExame = new DateTime($dataAdmissao);
                            $dataProxExame->add(new DateInterval('P' . $periodoExame . 'M'));
                            $dataProxExame = $dataProxExame->format('m/d/Y');

                            $dataExameFuturoProx = date('d/m/Y', strtotime($dataProxExame));

                        $query = " SELECT T1.DATA_ADMISSAO, T3.TIPO_EXAMES, T3.DATA_REALIZACAO, T2.PERIODO_EXAME_ASO FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2 
                                                ON T1.FUNCAO = T2.ID_FUNCAO INNER JOIN GP_CAD_EXAME_ASO T3  
                                                ON T1.ID_FUNCIONARIO = T3.FUNCIONARIO 
                                                WHERE T3.DATA_REALIZACAO >= TO_DATE('$dataExameFuturo', 'DD/MM/YYYY') AND T3.DATA_REALIZACAO <= TO_DATE ('$dataExameFuturoProx', 'DD/MM/YYYY')
                                                AND T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial' AND T1.ID_FUNCIONARIO = '$idFuncionario'";
                        //print_r($query);   
                        $cs = $this->conBanco->query($query);
                        $rs = $cs->result();


                        if (is_array($rs) && count($rs) > 0) {

                            $tipoExame = $rs[0]->TIPO_EXAMES;
                            $tipoExame = substr("$tipoExame", 0, 3);
                            
                            $dataRealizacaoExame = $rs[0]->DATA_REALIZACAO;
                            
                            //print_r($tipoExame);
                            
                            
                            
                            if ($tipoExame > 0 || $tipoExame != "" ) {
                                
                                $linhaExame = "<td  style = 'width: 10%; background-color: blue;'  align = 'left'><b>$tipoExame 02</b></td>";
                                $linhaData  = "<td  style = 'width: 10%;'  align = 'left'><b>$dataRealizacaoExame 02</b></td>";
                            }
                            if ($tipoExame == " " || $tipoExame <= 0 && $dataAtualizada >= $dataExameFuturo) {
                                $linhaExame = "<td colspan = '2' style = 'width: 10%; background-color: red;'  align = 'left'><b>ATRASADO</b></td>";
                              
                            }
                            else {
                                $linhaExame = "<td  style = 'width: 10%; background-color: green;'  align = 'left'><b>---44</b></td>";
                                $linhaData  = "<td  style = 'width: 10%;'  align = 'left'><b>---</b></td>";
                            }
                            
                            
                            $html .= $linhaExame;
                            $html .= $linhaData;
                            
                        } else {
                            
                            if ($dataAtualizada >= $dataExameFuturo){
                               
                                $html .= "<td  style = 'width: 10%;background-color: red;'  align = 'left'><b>---</b></td>"; 
                                $html .= "<td  style = 'width: 10%;background-color: red;'  align = 'left'><b>---</b></td>"; 
                                
                            }else{
                               $html .= "<td  style = 'width: 10%;background-color: green;'  align = 'left'><b>---</b></td>"; 
                               $html .= "<td  style = 'width: 10%;background-color: green;'  align = 'left'><b>---</b></td>"; 
                            }
                        }

                            
                        }


                        // CARREGAR DATAS DO PROXIMOS EXAMES

                        for ($i = 0; $i < $periodoRelatorio; $i++) {



                            // CALCULO PARA DATAS FUTURAS DO EXAME
                            $dataAdmissao = date('d/m/Y', strtotime($dataExameFuturo));
                            $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                            $periodoExame = $periodoExame;
                            $dataProxExame = new DateTime($dataAdmissao);
                            $dataProxExame->add(new DateInterval('P' . $periodoExame . 'M'));
                            $dataProxExame = $dataProxExame->format('m/d/Y');

                            $dataExameFuturo = date('d/m/Y', strtotime($dataProxExame));

                            //$html .= "<td  style = 'width: 10%;' align = 'left'><b>$dataExameFuturo</b></td>";

                            $html .= "<td  style = 'width: 10%;'  align = 'left'>$dataExameFuturo</td>";
                            
                            $dataAdmissao = date('d/m/Y', strtotime($dataExameFuturo));
                            $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                            $periodoExame = $periodoExame;
                            $dataProxExame = new DateTime($dataAdmissao);
                            $dataProxExame->add(new DateInterval('P' . $periodoExame . 'M'));
                            $dataProxExame = $dataProxExame->format('m/d/Y');

                            $dataExameFuturo2 = date('d/m/Y', strtotime($dataProxExame));

                            $query = " SELECT T1.DATA_ADMISSAO, T3.TIPO_EXAMES, T3.DATA_REALIZACAO, T2.PERIODO_EXAME_ASO FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2 
                                                ON T1.FUNCAO = T2.ID_FUNCAO INNER JOIN GP_CAD_EXAME_ASO T3  
                                                ON T1.ID_FUNCIONARIO = T3.FUNCIONARIO 
                                                WHERE T3.DATA_REALIZACAO >= TO_DATE('$dataExameFuturo', 'DD/MM/YYYY') AND T3.DATA_REALIZACAO <= TO_DATE('$dataExameFuturo2', 'DD/MM/YYYY')
                                                AND T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial'  AND T1.ID_FUNCIONARIO = '$idFuncionario'";
                            //print_r($query); exit();
                            $cs = $this->conBanco->query($query);
                            $rs = $cs->result();


                            if (is_array($rs) && count($rs) > 0) {

                            $tipoExame = $rs[0]->TIPO_EXAMES;
                             $tipoExame = substr("$tipoExame", 0, 3);

                            if ($tipoExame != "" && $dataAtualizada >= $dataExameFuturo) {
                                
                                $linhaExame = "<td  style = 'width: 10%; background-color: blue;'  align = 'left'><b>$tipoExame 02</b></td>";
                                $linhaData  = "<td  style = 'width: 10%;'  align = 'left'><b>$dataRealizacaoExame 02</b></td>";
                            }
                            if ($tipoExame == "" && $dataAtualizada <= $dataExameFuturoProx) {
                                $linhaExame = "<td colspan = '2' style = 'width: 10%; background-color: red;'  align = 'left'><b>ATRASADO</b></td>";
                              
                            }
                            else {
                                $linhaExame = "<td  style = 'width: 10%; background-color: green;'  align = 'left'><b>---</b></td>";
                                $linhaData  = "<td  style = 'width: 10%;'  align = 'left'><b>---</b></td>";
                            }
                            
                            
                            $html .= $linhaExame;
                            $html .= $linhaData;
                            } else {

                                $html .= "<td  style = 'width: 10%;'  align = 'left'><b>---</b></td>";
                                $html .= "<td  style = 'width: 10%;'  align = 'left'><b>---</b></td>";
                            }
                        }
                    }
                }
            }

                                                  
        return $html;
        
    }

    public function getPdf($periodoIni, $periodoFim, $situacao, $tipoData, $idEmpresa, $idFilial, $idFornecedor) {

        $dataAtualizada = date('d/m/Y');

        $this->initConBanco();

        $query = "SELECT NOME_FANTASIA FROM SYS_EMPRESA  WHERE ID_EMPRESA = $idEmpresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $empresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$idFilial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $filial = $rs[0]->NOME_FANTASIA;


        $html = "";

        // CABECALHO DO PDF
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'; cellpadding ='3'; cellspacing = '0';>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td colspan = '8' rowspan = '6' align = 'left' style = 'font-size: 36px; color: #ffffff;'><b>&nbsp;&nbsp;$empresa / $filial</b></td>";
        $html .= "<td rowspan = '2' colspan = '4'  align = 'center' style = 'font-size: 26px; color: #ffffff;'><b>&nbsp;&nbsp;RELATÓRIO DE CONTAS A PAGAR</b></td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2' colspan = '2'    align = 'right' style = 'font-size: 20px; color: #ffffff;'><b>Data Emissao:</b></td>";
        $html .= "<td rowspan = '2' colspan = '2'    align = 'center' style = 'font-size: 20px; color: #ffffff;'>$dataAtualizada </td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2' colspan = '2'   align = 'right' style = 'font-size: 20px; color: #ffffff;'><b><b>Período:</b></td>";
        $html .= "<td rowspan = '2' colspan = '2'    align = 'center' style = 'font-size: 20px; color: #ffffff;'><b>$periodoIni à $periodoFim  </td></tr>";
        $html .= "</table>";

        // FINAL CABECALHO

        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0' >";
        $html .= "<tr style = 'background-color: #ffffff; height: 50px;'><td colspan = '10' style = ' color: #ffffff; font-size: 5px;' align = 'center'><b>--------</td></tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";
        $html .= "<td colspan = '3' style = 'color: #ffffff; font-size: 16px;' align = 'left'><b>&nbsp;&nbsp;Fornecedor</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'right'><b>Documento</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'center'><b>DataEmissão</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'left'><b>Histórico</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'right'><b>Tipo Cobrança</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'center'><b>$tipoData</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'left'><b>Situação&nbsp;&nbsp;</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'right'><b>Valor Original&nbsp;&nbsp;</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 16px;' align = 'right'><b>Valor Pago&nbsp;&nbsp;</b></td>";





        if ($situacao != "0") {

            $valorTotal = 0;

            if ($tipoData == "Data Proposta") {



                $query = "SELECT T1.SITUACAO, T1.DATA_PROPOSTA, T1.VALOR_PARCELA, T1.VALOR_PAGO, T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";

                if ($idFornecedor != 0 || $idFornecedor != "0") {
                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }

                //print_r($query); exit();

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {



                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');

                        $valorPago = $item->VALOR_PAGO;



                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '3' style= ' font-size: 14px;' align = 'left'>$item->FORNECEDOR</td>";
                        $html .= "<td  style= ' font-size: 14px;' align = 'right'>$item->DOCUMENTO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_CADASTRO</td>";
                        $html .= "<td  style= ' font-size: 13px;'  align = 'left'>$item->HISTORICO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>$item->TIPO_COBRANCA&nbsp;&nbsp;</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_PROPOSTA</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'left'>$item->SITUACAO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>R$ $valorParcela&nbsp;&nbsp;</td>";
                        
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>-</b></td>";
                        }
                        $html .= "</tr>";
                    }


                    $query = "SELECT SUM(T1.VALOR_PARCELA)AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }


                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');



                    $query = "SELECT SUM(T1.VALOR_PAGO)AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }


                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }
            if ($tipoData == "Vencimento") {

                $query = "SELECT T1.SITUACAO, T1.DATA_VENCIMENTO, T1.VALOR_PARCELA, T1.VALOR_PAGO, T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                if ($idFornecedor != 0 || $idFornecedor != "0") {
                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {

                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');

                        $valorPago = $item->VALOR_PAGO;



                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '3' style= ' font-size: 14px;' align = 'left'>$item->FORNECEDOR</td>";
                        $html .= "<td  style= ' font-size: 14px;' align = 'right'>$item->DOCUMENTO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_CADASTRO</td>";
                        $html .= "<td  style= ' font-size: 13px;'  align = 'left'>$item->HISTORICO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>$item->TIPO_COBRANCA&nbsp;&nbsp;</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_VENCIMENTO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'left'>$item->SITUACAO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>R$ $valorParcela&nbsp;&nbsp;</td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>-</b></td>";
                        }
                        $html .= "</tr>";
                    }

                    $query = "SELECT SUM(T1.VALOR_PARCELA) AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');


                    $query = "SELECT SUM(T1.VALOR_PAGO) AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }

            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL ORIGINAL</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotal</b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "</tr>";

            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL PAGO</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotalPago</b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "</tr>";
        } else {


            $valorTotal = 0;

            if ($tipoData == "Data Proposta") {

                $query = "SELECT T1.SITUACAO, T1.DATA_PROPOSTA, T1.VALOR_PARCELA, T1.VALOR_PAGO, T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                if ($idFornecedor != 0 || $idFornecedor != "0") {
                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }


                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {
                        // $valorTotal = $valorTotal  + $item->VALOR_PARCELA;

                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');

                        $valorPago = $item->VALOR_PAGO;


                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '3' style= ' font-size: 14px;' align = 'left'>$item->FORNECEDOR</td>";
                        $html .= "<td  style= ' font-size: 14px;' align = 'right'>$item->DOCUMENTO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_CADASTRO</td>";
                        $html .= "<td  style= ' font-size: 13px;'  align = 'left'>$item->HISTORICO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>$item->TIPO_COBRANCA&nbsp;&nbsp;</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_PROPOSTA</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'left'>$item->SITUACAO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>R$ $valorParcela&nbsp;&nbsp;</td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>-</b></td>";
                        }
                        $html .= "</tr>";
                    }

                    $query = "SELECT SUM(T1.VALOR_PARCELA) AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');




                    $query = "SELECT SUM(T1.VALOR_PAGO) AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();



                    if (is_array($rs)) {
                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }
            if ($tipoData == "Vencimento") {

                $query = "SELECT T1.SITUACAO, T1.DATA_VENCIMENTO, T1.VALOR_PARCELA, T1.VALOR_PAGO, T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                if ($idFornecedor != 0 || $idFornecedor != "0") {
                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }


                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {


                        $valorTotal = $valorTotal + $item->VALOR_PARCELA;


                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');

                        $valorPago = $item->VALOR_PAGO;

                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '3' style= ' font-size: 14px;' align = 'left'>$item->FORNECEDOR</td>";
                        $html .= "<td  style= ' font-size: 14px;' align = 'right'>$item->DOCUMENTO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_CADASTRO</td>";
                        $html .= "<td  style= ' font-size: 13px;'  align = 'left'>$item->HISTORICO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>$item->TIPO_COBRANCA&nbsp;&nbsp;</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'center'>$item->DATA_VENCIMENTO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'left'>$item->SITUACAO</td>";
                        $html .= "<td  style= ' font-size: 14px;'  align = 'right'>R$ $valorParcela&nbsp;&nbsp;</td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 14px;' align = 'right'><b>-</b></td>";
                        }
                        $html .= "</tr>";
                    }

                    $query = "SELECT SUM(T1.VALOR_PARCELA) AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');



                    $query = "SELECT SUM(T1.VALOR_PAGO) AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }
                    // print_r($query);exit();
                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {

                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }




            $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td class = 'Vtotal' align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL</b></td>";
            $html .= "<td class = 'Vtotal' align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotal</b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "</tr>";

            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL PAGO</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotalPago</b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "</tr>";
        }

        $pasta = "C:/server/htdocs/gcconcreto/relatoriostemp/relatorio/"; //- GCCONCRETO 
        //$pasta = "C:/server/htdocs/vpi/relatoriostemp/relatorio/"; //- VPI
        $pasta = 'C:/server/htdocs/vpigestao/fwk/relatoriostemp/relatorio/'; //LOCAL


        if (is_dir($pasta)) {
            $diretorio = dir($pasta);

            while ($arquivo = $diretorio->read()) {
                if (($arquivo != '.') && ($arquivo != '..')) {
                    unlink($pasta . $arquivo);
                    echo 'Arquivo ' . $arquivo . ' foi apagado com sucesso. <br />';
                }
            }

            $diretorio->close();
        } else {
            echo 'A pasta não existe.';
        }


        $nomeDoArquivo = "contas_pagar.pdf";
        $tipoFolha = "P"; // P = Retrato | L = Paisagem



        $retorno = $this->geraPDF($nomeDoArquivo, $html, $tipoFolha);

        if ($retorno) {
            $gerado = true;
        } else {
            $gerado = false;
        }






        if ($gerado == true) {
            echo "Arquivo Gerado: " . $nomeDoArquivo . "\n";
        } else {
            echo "Erro ao gerar o arquivo.";
            return;
        }
    }

    private function geraPDF($nomeDoArquivo, $html, $tipo) {
        //print_r("gerapdf");exit();
        $dompdf = new DOMPDF();
        define("DOMPDF_ENABLE_REMOTE", true);
//	if ($tipo == "L") {
//		$dompdf->set_paper("legal", "landscape"); // Altera o papel para modo paisagem.
//	}
        $dompdf->load_html($html); // Carrega o HTML para a classe.
        $dompdf->render();



        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "normal");
        $canvas->page_text(540, 820, "Pág. {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0, 0, 0)); //header
        $canvas->page_text(270, 820, "VPI TECNOLOGIA  -  GESTÃO", $font, 6, array(0, 0, 0)); //footer 
        header("Content-type: application/pdf");
        $pdf = $dompdf->output(); // Cria o pdf
        $nomeDoArquivo = "contas_pagar.pdf";

        $arquivo = 'C:\server\htdocs\gcconcreto\relatoriostemp\relatorio\.'; //- GCCONCRETO
        //$arquivo = 'C:\server\htdocs\vpi\relatoriostemp\relatorio\.'; //- VPI
        $arquivo = 'C:\server\htdocs\vpigestao\fwk\relatoriostemp\pdf\.'; // - LOCAL 
        $arquivo .= $nomeDoArquivo; // Caminho onde será salvo o arquivo.


        if (file_put_contents($arquivo, $pdf)) { //Tenta salvar o pdf gerado
            return true; // Salvo com sucesso.
        } else {
            return false; // Erro ao salvar o arquivo
        }
    }

    public function getExcel($periodoIni, $periodoFim, $situacao, $tipoData, $idEmpresa, $idFilial, $idFornecedor) {

        $dataAtualizada = date('d/m/Y');

        $this->initConBanco();

        $query = "SELECT NOME_FANTASIA FROM SYS_EMPRESA  WHERE ID_EMPRESA = $idEmpresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $empresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$idFilial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $filial = $rs[0]->NOME_FANTASIA;


        // CABECALHO EXCEL

        $html = "";
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'>";
        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '7' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '3' style= ' font-size: 20px;  color: #ffffff;' align = 'center'><b>&nbsp;&nbsp;&nbsp;&nbsp;RELATÓRIO DE CONTAS A PAGAR</b></td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9;'  border='0'>";
        $html .= "<td  colspan = '7' style= ' font-size: 23px;  color: #ffffff;' align = 'left'><b>$empresa / $filial</b></td>";
        $html .= "<td  colspan = '1' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b>Data Emissão: </td>";
        $html .= "<td  colspan = '2' style= ' font-size: 14px;  color: #ffffff;' align = 'center'><b></b>$dataAtualizada</td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '7' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '1' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b>Período: </td>";
        $html .= "<td  colspan = '2' style= ' font-size: 14px;  color: #ffffff;' align = 'center'><b></b>$periodoIni à $periodoFim</td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #ffffff; '  border='0'>";
        $html .= "<td colspan = '10' style= ' font-size: 6px;  color: #ffffff;' align = 'left'>-</td>";
        $html .= "</tr>";

        //FINAL DO CABECALHO EXCEL


        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";
        $html .= "<td colspan = '2' style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Fornecedor</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Documento</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>DataEmissão</b></td>";
        $html .= "<td colspan = '2' style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Histórico</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Tipo Cobrança</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>$tipoData</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Situação</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Valor Original</b></td>";
        $html .= "<td style = 'color: #ffffff; font-size: 14px;' align = 'center'><b>Valor Pago</b></td>";





        if ($situacao != "0") {

            $valorTotal = 0;

            if ($tipoData == "Data Proposta") {



                $query = "SELECT T1.SITUACAO, T1.DATA_PROPOSTA, T1.VALOR_PARCELA, T1.VALOR_PAGO,T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";



                if ($idFornecedor != 0 || $idFornecedor != "0") {

                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }




                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {



                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');

                        $valorPago = $item->VALOR_PAGO;

                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;' align = 'left'><b>$item->FORNECEDOR</b></td>";
                        $html .= "<td  style= ' font-size: 11px;' align = 'left'><b>$item->DOCUMENTO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_CADASTRO</b></td>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;'  align = 'center'><b>$item->HISTORICO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->TIPO_COBRANCA</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_PROPOSTA</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->SITUACAO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>R$ $valorParcela</b></td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>-</b></td>";
                        }

                        $html .= "</tr>";
                    }

                    $query = "SELECT SUM(T1.VALOR_PARCELA)AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";

                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');


                    $query = "SELECT SUM(T1.VALOR_PAGO)AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S' ";

                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {

                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }
            if ($tipoData == "Vencimento") {

                $query = "SELECT T1.SITUACAO, T1.DATA_VENCIMENTO, T1.VALOR_PARCELA,  T1.VALOR_PAGO, T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial
                            AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                if ($idFornecedor != 0 || $idFornecedor != "0") {
                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {

                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');

                        $valorPago = $item->VALOR_PAGO;

                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;' align = 'left'><b>$item->FORNECEDOR</b></td>";
                        $html .= "<td  style= ' font-size: 11px;' align = 'left'><b>$item->DOCUMENTO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_CADASTRO</b></td>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;'  align = 'center'><b>$item->HISTORICO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->TIPO_COBRANCA</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_VENCIMENTO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->SITUACAO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>R$ $valorParcela</b></td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>-</b></td>";
                        }

                        $html .= "</tr>";
                    }


                    $query = "SELECT SUM(T1.VALOR_PARCELA)AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                                INNER JOIN FIN_CONTA_PAGAR T2
                                ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                                WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                                AND  T1.ID_EMPRESA = $idEmpresa 
                                AND  T1.ID_FILIAL  =  $idFilial
                                AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');


                    $query = "SELECT SUM(T1.VALOR_PAGO)AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                                INNER JOIN FIN_CONTA_PAGAR T2
                                ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                                WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                                AND  T1.ID_EMPRESA = $idEmpresa 
                                AND  T1.ID_FILIAL  =  $idFilial
                                AND  T1.SITUACAO   = '$situacao' AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {

                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }

            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL ORIGINAL</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotal</b></td>";
            $html .= "</tr>";

            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL PAGO</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotalPago</b></td>";
            $html .= "</tr>";
        } else {


            $valorTotal = 0;

            if ($tipoData == "Data Proposta") {

                $query = "SELECT T1.SITUACAO, T1.DATA_PROPOSTA, T1.VALOR_PARCELA, T2.DOCUMENTO,  T1.VALOR_PAGO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                if ($idFornecedor != 0 || $idFornecedor != "0") {
                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }


                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {


                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');


                        $valorPago = $item->VALOR_PAGO;


                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;' align = 'left'><b>$item->FORNECEDOR</b></td>";
                        $html .= "<td  style= ' font-size: 11px;' align = 'left'><b>$item->DOCUMENTO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_CADASTRO</b></td>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;'  align = 'center'><b>$item->HISTORICO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->TIPO_COBRANCA</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_PROPOSTA</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->SITUACAO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>R$ $valorParcela</b></td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>-</b></td>";
                        }
                        $html .= "</tr>";
                    }

                    $query = "SELECT SUM(T1.VALOR_PARCELA)AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');


                    $query = "SELECT SUM(T1.VALOR_PAGO)AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_PROPOSTA  >= '$periodoIni' AND T1.DATA_PROPOSTA <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";


                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {

                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }
            if ($tipoData == "Vencimento") {

                $query = "SELECT T1.SITUACAO, T1.DATA_VENCIMENTO, T1.VALOR_PARCELA,  T1.VALOR_PAGO, T2.DOCUMENTO, T2.FORNECEDOR, T1.DATA_CADASTRO , T2.HISTORICO, T2.TIPO_COBRANCA FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                if ($idFornecedor != 0 || $idFornecedor != "0") {

                    $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                }



                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if (is_array($rs) && count($rs) > 0) {

                    foreach ($rs as $item) {


                        $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
                        $valorParcela = number_format($valorParcela, 2, ',', '.');


                        $valorPago = $item->VALOR_PAGO;


                        $html .= "<tr  style = 'width:100%;'  border='0'>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;' align = 'left'><b>$item->FORNECEDOR</b></td>";
                        $html .= "<td  style= ' font-size: 11px;' align = 'left'><b>$item->DOCUMENTO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_CADASTRO</b></td>";
                        $html .= "<td  colspan = '2' style= ' font-size: 11px;'  align = 'center'><b>$item->HISTORICO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->TIPO_COBRANCA</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->DATA_VENCIMENTO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>$item->SITUACAO</b></td>";
                        $html .= "<td  style= ' font-size: 11px;'  align = 'center'><b>R$ $valorParcela</b></td>";
                        if ($valorPago != "") {
                            // $valorTotal = $valorTotal  + $item->VALOR_PAGO;
                            $valorPago = str_replace(',', '.', $valorPago);
                            $valorPago = number_format($valorPago, 2, ',', '.');
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>R$ $valorPago</b></td>";
                        } else {
                            $html .= "<td  style = 'font-size: 11px;' align = 'center'><b>-</b></td>";
                        }
                        $html .= "</tr>";
                    }

                    $query = "SELECT SUM(T1.VALOR_PARCELA)AS TOTAL FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {
                        $valorTotal = $rs[0]->TOTAL;
                    } else {
                        $valorTotal = 0;
                    }


                    $valorTotal = str_replace(',', '.', $valorTotal);
                    $valorTotal = number_format($valorTotal, 2, ',', '.');


                    $query = "SELECT SUM(T1.VALOR_PAGO)AS TOTAL_PAGO FROM FIN_CONTA_PAGAR_PARCELA  T1
                            INNER JOIN FIN_CONTA_PAGAR T2
                            ON  T2.ID_CONTA_PAGAR = T1.ID_CONTA_PAGAR
                            WHERE T1.DATA_VENCIMENTO  >= '$periodoIni' AND T1.DATA_VENCIMENTO <= '$periodoFim'
                            AND  T1.ID_EMPRESA = $idEmpresa 
                            AND  T1.ID_FILIAL  =  $idFilial AND T2.ULTIMA_VERSAO = 'S' AND T1.ULTIMA_VERSAO = 'S'";

                    if ($idFornecedor != 0 || $idFornecedor != "0") {
                        $query .= "AND  T2.FORNECEDOR = '$idFornecedor'";
                    }

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs)) {

                        $valorTotalPago = $rs[0]->TOTAL_PAGO;

                        if ($valorTotalPago != null) {

                            $valorTotalPago = str_replace(',', '.', $valorTotalPago);
                            $valorTotalPago = number_format($valorTotalPago, 2, ',', '.');
                        } else {
                            $valorTotalPago = 0;
                        }
                    } else {
                        $valorTotalPago = 0;
                    }
                }
            }
            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL ORIGINAL</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotal</b></td>";
            $html .= "</tr>";


            $html .= "<tr  style = 'width:100%;' border='0'>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'left'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center'><b></b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>VALOR TOTAL PAGO</b></td>";
            $html .= "<td  align = 'center' style = 'white-space: nowrap; padding: 6px; font-size: 19px; color: #265791;'><b>R$ $valorTotalPago</b></td>";
            $html .= "</tr>";
        }

        return $html;
    }

}
