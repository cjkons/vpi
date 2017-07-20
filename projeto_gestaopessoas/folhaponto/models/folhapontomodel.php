<?php

require_once("resources/folhaponto/dompdf/dompdf_config.inc.php");

class folhapontomodel extends CI_Model {

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

    public function carregarFuncionario() {

        $this->initConBanco();

        $query = "SELECT ID_FUNCIONARIO, NOME_FUNCIONARIO FROM GP_CAD_FUNCIONARIO  WHERE DESATIVADO = 'N' ORDER BY NOME_FUNCIONARIO ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idFuncionario = $item->ID_FUNCIONARIO;
                $nome = $item->NOME_FUNCIONARIO;
                $html .= "<option value='$idFuncionario'>$nome</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhum Funcionário Cadastrado</option>";
        }
    }

    public function carregarFuncao($funcionario) {

        $this->initConBanco();


        if ($funcionario != 0) {

            $query = "SELECT FUNCAO FROM GP_CAD_FUNCIONARIO  WHERE ID_FUNCIONARIO = '$funcionario' ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $idFuncao = $rs[0]->FUNCAO;
            
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES  WHERE ID_FUNCAO = '$idFuncao' ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $funcao = $rs[0]->FUNCAO;
            
            return $funcao;
            
            
            
        } else {

            return false;
        }
       
    }

    

    public function filtro($mes1, $funcionario, $funcao) {

        $dataAtualizada = date('Y');

        $this->initConBanco();
        
        $query = "SELECT NOME_FUNCIONARIO, EMPRESA, FILIAL FROM GP_CAD_FUNCIONARIO  WHERE ID_FUNCIONARIO = '$funcionario' ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;
            $empresa = $rs[0]->EMPRESA;
            $filial = $rs[0]->FILIAL;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeEmpresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$filial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeFilial = $rs[0]->NOME_FANTASIA;



        switch ("$mes1") {

            case "01":
                $mes = "JANEIRO";
                $mesProx = "FEVEREIRO";
                break;
            case "02":
                $mes = "FEVEREIRO";
                $mesProx = "MARÇO";
                break;
            case "03":
                $mes = "MARÇO";
                $mesProx = "ABRIL";
                break;
            case "04":
                $mes = "ABRIL";
                $mesProx = "MAIO";
                break;
            case "05":
                $mes = "MAIO";
                $mesProx = "JUNHO";
                break;
            case "06":
                $mes = "JUNHO";
                $mesProx = "JULHO";
                break;
            case "07":
                $mes = "JULHO";
                $mesProx = "AGOSTO";
                break;
            case "08":
                $mes = "AGOSTO";
                $mesProx = "SETEMBRO";
                break;
            case "09":
                $mes = "SETEMBRO";
                $mesProx = "OUTUBRO";
                break;
            case "10":
                $mes = "OUTUBRO";
                $mesProx = "NOVEMBRO";
                break;
            case "11":
                $mes = "NOVEMBRO";
                $mesProx = "DEZEMBRO";
                break;
            case "12":
                $mes = "DEZEMBRO";
                $mesProx = "JANEIRO";
                break;
        }
        
        
        
        $numero_dias = $mes1;
        $numero_dias = array(  
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	$diasMes = ($numero_dias[$mes1]); // NUMERO DE DIAS NO MES SELECIONADO
       
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        //print_r($diasMes);
        
        
        $periodo = 1;
        
        $dataFuturo = "28/".$mes1 ."/". $dataAtualizada;
                
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
        if (count(explode("/", $dataFuturo)) > 1) {
            $dataMes = implode("-", array_reverse(explode("/", $dataFuturo)));
        } elseif (count(explode("-", $dataFuturo)) > 1) {
            $dataMes = implode("/", array_reverse(explode("-", $dataFuturo)));
        }
        
        $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMes)));
        
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo1));
                    
                    $diaSemanaTexto1 =  $diasemana[$diasemana_numero - intval(1)];
                    $diaSemanaTexto2 =  $diasemana[$diasemana_numero];
        
        
        $html = "";
        
        //CABECALHO INICIO
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1';>";
        $html .= "<tr style = 'background-color: #579CE9;'>";
        $html .= "<td class = 'nomeempresa' rowspan = '6' colspan = '4' align = 'left'  style = 'text-transform: uppercase; color: #ffffff; font-size: 20px; ' align = 'left'><b>&nbsp;&nbsp;Empresa:</b> $nomeEmpresa <br>&nbsp;<b> Filial:</b> $nomeFilial</td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '5'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td></td>";
        $html .= "<td class = 'nomerelatorio'colspan = '4' style = 'color: #ffffff; font-size: 20px;' align = 'CENTER'><b>FOLHA DE FREQUÊNCIA</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '5'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  colspan = '2' class = 'datas' style = 'text-transform: uppercase; color: #ffffff; font-size: 18px;' align = 'right'><b>Período:</b></td>";
        $html .= "<td  colspan = '4'  style = 'color: #ffffff; font-size: 16px; ' align = 'center'> $mes / $mesProx</td>";
        $html .= "</tr>";

//        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
//        $html .= "<td  colspan = '2' class = 'datas' style = 'color: #ffffff; ' align = 'right'><b> Período:</b></td>";
//        $html .= "<td  colspan = '3'  style = 'color: #ffffff; ' align = 'center'>$periodoIni à $periodoFim</td>";
//        $html .= "</tr>";
        $html .= "</table>";
        //CABECALHO FIM


        $html .= "<table style = 'width:100%;' border: 1px; solid; #000000;' >";
        $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
        $html .= "<tr style = 'width:90%; height: 22px;'>";
        $html .= "<td colspan = '2' style = ' color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 20px;'  align = 'center'><b>FUNCIONÁRIO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'center'><b>$nomeFuncionario</b></td>";
        
        $html .= "<td style = 'color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 20px;'  align = 'center'><b>FUNÇÃO:</b></td>";
        $html .= "<td colspan = '2' style = 'text-transform: uppercase; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'center'><b>$funcao</b></td>";
        $html .= "</tr>";
        
        $html .= "</table>";
        
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        $html .= "<tr style = 'width:90%; background-color: #579CE9; border-width: 10px; height: 20px;'>";
        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>&nbsp;&nbsp;DATA</b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>&nbsp;&nbsp;DIA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ENTRADA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>SAIDA</b></td>";
        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ASSINATURA</b></td>";
        
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ENTRADA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>SAIDA</b></td>";
        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ASSINATURA</b></td>";

        $html .= "</tr>";
        
        // PRIMEIRO DIA
        
        if($diaSemanaTexto1 == "Domingo"){
            $html .= "<tr style = 'width:90%; background-color: #579CE9; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        
        }else{
           
            $html .= "<tr style = 'width:90%; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        }
        // SEGUNDO DIA
        if($diaSemanaTexto2 == "Domingo"){
            
            $html .= "<tr style = 'width:90%; background-color: #579CE9; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        
            
        }else{
            
            $html .= "<tr style = 'width:90%;  height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        }
        
        
        // PROXIMOS DIAS
        for ($i = 0; $i < $diasMes - 2; $i++) {

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMesF)));
                    
                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo2));
                    
                    $diaSemanaTexto =  $diasemana[$diasemana_numero];
                
                    if($diaSemanaTexto == "Domingo"){
                        
                        $html .= "<tr style = 'width:90%;  background-color: #579CE9; border: 1px; border-style: solid; border-color: black;  height: 20px;'>";
                        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";    
                        $html .= "</tr>";
                    
                        
                    }else{
                        
                        $html .= "<tr style = 'width:90%; height: 20px;'>";
                        $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                       
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";    
                        $html .= "</tr>";
                        
                    }
                
                   
            }
            
            $html .= "</table>";
        
            $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
            $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
            $html .= "<tr style = 'width:90%; height: 20px;'>";
            $html .= "<td style = 'width: 5%;  color: #000000; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 5%;  color: #000000; font-size: 14px;'  align = 'center'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;HORAS HAVER:</b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";    
            $html .= "</tr>";
            
            $html .= "<tr style = 'width:90%; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #000000; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 5%; color: #000000; font-size: 14px;'  align = 'center'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;HORAS PAGAR:</b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b></b></td>";
                       
            $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";    
            $html .= "</tr>";
            
            $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
            
            $html .= "<tr style = 'width:90%; height: 20px;'>";
            $html .= "<td colspan = '2' style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ASS. FUNCIONÁRIO:</b></td>";
            $html .= "<td colspan = '2' style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'center'><b>-</b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff;  font-size: 14px;'  align = 'left'><b></b></td>";
            
                       
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ASS. EMPREGADOR:</b></td>";
            $html .= "<td colspan = '2'style = 'width: ; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b>-</b></td>";
            
            $html .= "</tr>";
        
            $html .= "</table>";
        
            $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        
       return $html;     
        
        
    
    }
    
    public function filtro1($mes1, $funcionario, $funcao) {

        $dataAtualizada = date('Y');

        $this->initConBanco();
        
        $query = "SELECT NOME_FUNCIONARIO, EMPRESA, FILIAL FROM GP_CAD_FUNCIONARIO  WHERE ID_FUNCIONARIO = '$funcionario' ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;
            $empresa = $rs[0]->EMPRESA;
            $filial = $rs[0]->FILIAL;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeEmpresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$filial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeFilial = $rs[0]->NOME_FANTASIA;



        switch ("$mes1") {

            case "01":
                $mes = "JANEIRO";
                $mesProx = "FEVEREIRO";
                break;
            case "02":
                $mes = "FEVEREIRO";
                $mesProx = "MARÇO";
                break;
            case "03":
                $mes = "MARÇO";
                $mesProx = "ABRIL";
                break;
            case "04":
                $mes = "ABRIL";
                $mesProx = "MAIO";
                break;
            case "05":
                $mes = "MAIO";
                $mesProx = "JUNHO";
                break;
            case "06":
                $mes = "JUNHO";
                $mesProx = "JULHO";
                break;
            case "07":
                $mes = "JULHO";
                $mesProx = "AGOSTO";
                break;
            case "08":
                $mes = "AGOSTO";
                $mesProx = "SETEMBRO";
                break;
            case "09":
                $mes = "SETEMBRO";
                $mesProx = "OUTUBRO";
                break;
            case "10":
                $mes = "OUTUBRO";
                $mesProx = "NOVEMBRO";
                break;
            case "11":
                $mes = "NOVEMBRO";
                $mesProx = "DEZEMBRO";
                break;
            case "12":
                $mes = "DEZEMBRO";
                $mesProx = "JANEIRO";
                break;
        }
        
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        
        $numero_dias = $mes1;
        $numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	$diasMes = ($numero_dias[$mes1]); // NUMERO DE DIAS NO MES SELECIONADO
       
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        //print_r($diasMes);
        
        
        $periodo = 1;
        
        $dataFuturo = "28/".$mes1 ."/". $dataAtualizada;
                
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
        if (count(explode("/", $dataFuturo)) > 1) {
            $dataMes = implode("-", array_reverse(explode("/", $dataFuturo)));
        } elseif (count(explode("-", $dataFuturo)) > 1) {
            $dataMes = implode("/", array_reverse(explode("-", $dataFuturo)));
        }
        
        $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMes)));
        
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo1));
                    
                    $diaSemanaTexto1 =  $diasemana[$diasemana_numero - 1];
                    $diaSemanaTexto2 =  $diasemana[$diasemana_numero];
        
        
        $html = "";
        
        //CABECALHO INICIO
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1';>";
        

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td class = 'nomerelatorio'colspan = '5' style = 'color: #ffffff; font-size: 20px;' align = 'center'><b>INTERVALOS PARA LANCHE</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '5'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  colspan = '2' class = 'datas' style = 'text-transform: uppercase; color: #ffffff; font-size: 18px;' align = 'right'><b>Período:</b></td>";
        $html .= "<td  colspan = '2'  style = 'color: #ffffff; font-size: 16px; ' align = 'center'> $mes / $mesProx</td>";
        $html .= "<td    style = 'color: #ffffff; font-size: 16px; ' align = 'center'></td>";
        $html .= "</tr>";

//        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
//        $html .= "<td  colspan = '2' class = 'datas' style = 'color: #ffffff; ' align = 'right'><b> Período:</b></td>";
//        $html .= "<td  colspan = '3'  style = 'color: #ffffff; ' align = 'center'>$periodoIni à $periodoFim</td>";
//        $html .= "</tr>";
        $html .= "</table>";
        //CABECALHO FIM


        $html .= "<table style = 'width:100%;' border: 1px; solid; #000000;' >";
        $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
        $html .= "<tr style = 'width:90%; height: 22px;'>";
        $html .= "<td colspan = '2' style = ' color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 20px;'  align = 'center'><b>FUNCIONÁRIO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'center'><b>$nomeFuncionario</b></td>";
        
        $html .= "<tr style = 'width:90%; height: 22px;'>";
        $html .= "<td colspan = '2'style = 'color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 20px;'  align = 'center'><b>FUNÇÃO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'center'><b>$funcao</b></td>";
        $html .= "</tr>";
        
        $html .= "</table>";
        
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        $html .= "<tr style = 'width:90%; background-color: #579CE9; border-width: 10px; height: 20px;'>";
        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>&nbsp;&nbsp;DATA</b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>&nbsp;&nbsp;DIA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ENTRADA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>SAIDA</b></td>";
        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ASSINATURA</b></td>";
        
        

        $html .= "</tr>";
        
        // PRIMEIRO DIA
        
        if($diaSemanaTexto1 == "Domingo"){
            $html .= "<tr style = 'width:90%; background-color: #579CE9; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
             
            $html .= "</tr>";
        
        }else{
           
            $html .= "<tr style = 'width:90%; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
            
            $html .= "</tr>";
        }
        // SEGUNDO DIA
        if($diaSemanaTexto2 == "Domingo"){
            
            $html .= "<tr style = 'width:90%; background-color: #579CE9; height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
              
            $html .= "</tr>";
        
            
        }else{
            
            $html .= "<tr style = 'width:90%;  height: 20px;'>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
            
               
            $html .= "</tr>";
        }
        
        
        // PROXIMOS DIAS
        for ($i = 0; $i < $diasMes - 2; $i++) {

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMesF)));
                    
                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo2));
                    
                    $diaSemanaTexto =  $diasemana[$diasemana_numero];
                
                    if($diaSemanaTexto == "Domingo"){
                        
                        $html .= "<tr style = 'width:90%;  background-color: #579CE9; border: 1px; border-style: solid; border-color: black;  height: 20px;'>";
                        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        
                          
                        $html .= "</tr>";
                    
                        
                    }else{
                        
                        $html .= "<tr style = 'width:90%; height: 20px;'>";
                        $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 17%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 14px;'  align = 'left'><b></b></td>";
                       
                           
                        $html .= "</tr>";
                        
                    }
                
                   
            }
            
            $html .= "</table>";
        
            $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
            $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
            
            $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
            
            $html .= "<tr style = 'width:90%; height: 20px;'>";
            $html .= "<td colspan = '2' style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 16px;'  align = 'center'><b>ASS. FUNCIONÁRIO:</b></td>";
            $html .= "<td colspan = '2' style = 'width: 5%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'center'><b>-</b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff;  font-size: 14px;'  align = 'left'><b></b></td>";
            
                       
            $html .= "<td style = 'width: 10%; color: #000000; font-size: 16px;'  align = 'center'><b></b></td>";
            $html .= "<td colspan = '2'style = 'width: ; color: #ffffff; font-size: 18px;'  align = 'left'><b>-</b></td>";
            
            $html .= "</tr>";
        
            $html .= "</table>";
        
            $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        
       return $html;     
        
        
    
    }

    public function getPdf($mes1, $funcionario, $funcao) {

       $dataAtualizada = date('Y');

        $this->initConBanco();
        
        $query = "SELECT NOME_FUNCIONARIO, EMPRESA, FILIAL FROM GP_CAD_FUNCIONARIO  WHERE ID_FUNCIONARIO = '$funcionario' ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;
            $empresa = $rs[0]->EMPRESA;
            $filial = $rs[0]->FILIAL;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeEmpresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$filial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeFilial = $rs[0]->NOME_FANTASIA;



        switch ("$mes1") {

            case "01":
                $mes = "JANEIRO";
                $mesProx = "FEVEREIRO";
                break;
            case "02":
                $mes = "FEVEREIRO";
                $mesProx = "MARÇO";
                break;
            case "03":
                $mes = "MARÇO";
                $mesProx = "ABRIL";
                break;
            case "04":
                $mes = "ABRIL";
                $mesProx = "MAIO";
                break;
            case "05":
                $mes = "MAIO";
                $mesProx = "JUNHO";
                break;
            case "06":
                $mes = "JUNHO";
                $mesProx = "JULHO";
                break;
            case "07":
                $mes = "JULHO";
                $mesProx = "AGOSTO";
                break;
            case "08":
                $mes = "AGOSTO";
                $mesProx = "SETEMBRO";
                break;
            case "09":
                $mes = "SETEMBRO";
                $mesProx = "OUTUBRO";
                break;
            case "10":
                $mes = "OUTUBRO";
                $mesProx = "NOVEMBRO";
                break;
            case "11":
                $mes = "NOVEMBRO";
                $mesProx = "DEZEMBRO";
                break;
            case "12":
                $mes = "DEZEMBRO";
                $mesProx = "JANEIRO";
                break;
        }
        
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        
        $numero_dias = $mes1;
        $numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	$diasMes = ($numero_dias[$mes1]); // NUMERO DE DIAS NO MES SELECIONADO
       
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        //print_r($diasMes);
        
        
        $periodo = 1;
        
        $dataFuturo = "28/".$mes1 ."/". $dataAtualizada;
                
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
        if (count(explode("/", $dataFuturo)) > 1) {
            $dataMes = implode("-", array_reverse(explode("/", $dataFuturo)));
        } elseif (count(explode("-", $dataFuturo)) > 1) {
            $dataMes = implode("/", array_reverse(explode("-", $dataFuturo)));
        }
        
        $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMes)));
        
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo1));
                    
                    $diaSemanaTexto1 =  $diasemana[$diasemana_numero - 1];
                    $diaSemanaTexto2 =  $diasemana[$diasemana_numero];
        
        
        $html = "";
        
        // CABECALHO DO PDF
        $html .= "<table style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0';>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td colspan = '4' rowspan = '6' align = 'left' style = 'font-size: 30px; color: #ffffff;'><b>&nbsp;&nbsp;<b>Empresa:</b> $nomeEmpresa <br>&nbsp;<b> Filial:</b> $nomeFilial</td>";
        $html .= "<td rowspan = '2' colspan = '2'  align = 'center' style = 'font-size: 28px; color: #ffffff;'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOLHA DE FREQUÊNCIA</b></td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2'     align = 'right' style = 'font-size: 26px; color: #ffffff;'><b>Período:</b></td>";
        $html .= "<td rowspan = '2'     align = 'center' style = 'font-size: 26px; color: #ffffff;'>$mes / $mesProx </td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2'    align = 'right' style = 'font-size: 22px; color: #ffffff;'></td>";
        $html .= "<td rowspan = '2'     align = 'center' style = 'font-size: 22px; color: #ffffff;'><b>  </td></tr>";
        $html .= "</table>";
        
        
        $html .= "<table style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0';>";
        $html .= "<tr '><td style = 'color: #ffffff; font-size: 5px;' align = 'center'></td></tr>";
        $html .= "<tr style = 'width:90%; border-width: 10px; height: 20px;'>";
        $html .= "<td colspan = '2' style = 'width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 30px;'  align = 'center'><b>&nbsp;FUNCIONÁRIO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase; width: 5%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 22px;'  align = 'center'><b>$nomeFuncionario</b></td>";
        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 30px;'  align = 'center'><b>FUNÇÃO:</b></td>";
        $html .= "<td colspan = '2' style = 'text-transform: uppercase; width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 22px;'  align = 'center'><b>$funcao</b></td>";
        

        $html .= "</tr>";
        
        
        $html .= "<tr style = 'width:90%; background-color: #579CE9; border-width: 10px; height: 30px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>&nbsp;&nbsp;DATA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>&nbsp;&nbsp;DIA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>ENTRADA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>SAIDA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>ASSINATURA</b></td>";
        
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>ENTRADA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>SAIDA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>ASSINATURA</b></td>";

        $html .= "</tr>";
        
        // PRIMEIRO DIA
        
        if($diaSemanaTexto1 == "Domingo"){
            $html .= "<tr style = 'width:90%; background-color: #579CE9; height: 30px;'>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        
        }else{
           
            $html .= "<tr style = 'width:90%; height: 30px;'>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        }
        // SEGUNDO DIA
        if($diaSemanaTexto2 == "Domingo"){
            
            $html .= "<tr style = 'width:90%; background-color: #579CE9; height:30px;'>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        
            
        }else{
            
            $html .= "<tr style = 'width:90%;  height: 30px;'>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";   
            $html .= "</tr>";
        }
        
        
        // PROXIMOS DIAS
        for ($i = 0; $i < $diasMes - 2; $i++) {

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMesF)));
                    
                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo2));
                    
                    $diaSemanaTexto =  $diasemana[$diasemana_numero];
                
                    if($diaSemanaTexto == "Domingo"){
                        
                        $html .= "<tr style = 'width:90%;  background-color: #579CE9; border: 1px; border-style: solid; border-color: black;  height: 30px;'>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";    
                        $html .= "</tr>";
                    
                        
                    }else{
                        
                        $html .= "<tr style = 'width:90%; height: 30px;'>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                       
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";    
                        $html .= "</tr>";
                        
                    }
                
                   
            }
            
            
            
                        $html .= "<tr style = 'width:90%; height: 30px;'>";
                        $html .= "<td style = 'width: 10%; color: #000000; font-size: 16px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; font-size: 16px;'  align = 'center'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 22px;'  align = 'center'><b>HORAS HAVER:</b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>HORAS PAGAR:</b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 20px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "</tr>";
            
            
        
            
                        $html .= "<tr style = 'width:90%; height: 30px;'>";
                        $html .= "<td style = 'width: 10%;  color: #000000; font-size: 16px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%;  color: #000000; font-size: 16px;'  align = 'center'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; font-size: 20px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #FFFFFF; font-size: 18px;'  align = 'left'><b>H</b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; font-size: 14px;'  align = 'left'><b></b></td>";    
                        $html .= "</tr>";
            
                        $html .= "<tr style = 'width:90%; height: 20px;'>";
                        $html .= "<td style = 'width: 10%;  color: #000000; font-size: 16px;'  align = 'left'><b></b></td>";
                        
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; text-transform: uppercase; border-color: black; font-size: 25px;'  align = 'left'><b>ASS. FUNCIONÁRIO: </b></td>";
                        $html .= "<td colspan = '2' style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        
                        $html .= "<td style = 'width: 10%; border: 1px; border-style: solid; border-color: black; color: #000000; font-size: 25px;'  align = 'left'><b>ASS. EMPREGADOR</b></td>";
                        $html .= "<td colspan = '2'style = 'width: 10%; border: 1px; border-style: solid; border-color: black; color: #ffffff; font-size: 14px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%;  color: #000000; font-size: 16px;'  align = 'center'><b></b></td>";
            
                        
            
        
            $html .= "</table>";
        
        
            
        
            
        
        /////////////////////////////

        //$pasta = "C:/server/htdocs/gcconcreto/relatoriostemp/relatorio/"; //- GCCONCRETO 
        //$pasta = "C:/server/htdocs/vpi/relatoriostemp/relatorio/"; //- VPI
        $pasta = 'C:/server/htdocs/gestaopessoas/fwk/uploads/pdf/'; //LOCAL


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


        $nomeDoArquivo = "folha_ponto.pdf";
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
        $nomeDoArquivo = "folha_ponto.pdf";

        //$arquivo = 'C:\server\htdocs\gcconcreto\relatoriostemp\relatorio\.'; //- GCCONCRETO
        //$arquivo = 'C:\server\htdocs\vpi\relatoriostemp\relatorio\.'; //- VPI
        $arquivo = 'C:\server\htdocs\gestaopessoas\fwk\uploads\pdf\.'; // - LOCAL 
        $arquivo .= $nomeDoArquivo; // Caminho onde será salvo o arquivo.


        if (file_put_contents($arquivo, $pdf)) { //Tenta salvar o pdf gerado
            return true; // Salvo com sucesso.
        } else {
            return false; // Erro ao salvar o arquivo
        }
    }
    
    
    
    
    public function getPdf1($mes1, $funcionario, $funcao) {

       $dataAtualizada = date('Y');

        $this->initConBanco();
        
        $query = "SELECT NOME_FUNCIONARIO, EMPRESA, FILIAL FROM GP_CAD_FUNCIONARIO  WHERE ID_FUNCIONARIO = '$funcionario' ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;
            $empresa = $rs[0]->EMPRESA;
            $filial = $rs[0]->FILIAL;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa ";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeEmpresa = $rs[0]->NOME_FANTASIA;


        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$filial'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeFilial = $rs[0]->NOME_FANTASIA;



        switch ("$mes1") {

            case "01":
                $mes = "JANEIRO";
                $mesProx = "FEVEREIRO";
                break;
            case "02":
                $mes = "FEVEREIRO";
                $mesProx = "MARÇO";
                break;
            case "03":
                $mes = "MARÇO";
                $mesProx = "ABRIL";
                break;
            case "04":
                $mes = "ABRIL";
                $mesProx = "MAIO";
                break;
            case "05":
                $mes = "MAIO";
                $mesProx = "JUNHO";
                break;
            case "06":
                $mes = "JUNHO";
                $mesProx = "JULHO";
                break;
            case "07":
                $mes = "JULHO";
                $mesProx = "AGOSTO";
                break;
            case "08":
                $mes = "AGOSTO";
                $mesProx = "SETEMBRO";
                break;
            case "09":
                $mes = "SETEMBRO";
                $mesProx = "OUTUBRO";
                break;
            case "10":
                $mes = "OUTUBRO";
                $mesProx = "NOVEMBRO";
                break;
            case "11":
                $mes = "NOVEMBRO";
                $mesProx = "DEZEMBRO";
                break;
            case "12":
                $mes = "DEZEMBRO";
                $mesProx = "JANEIRO";
                break;
        }
        
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        
        $numero_dias = $mes1;
        $numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	$diasMes = ($numero_dias[$mes1]); // NUMERO DE DIAS NO MES SELECIONADO
       
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        //print_r($diasMes);
        
        
        $periodo = 1;
        
        $dataFuturo = "28/".$mes1 ."/". $dataAtualizada;
                
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
        if (count(explode("/", $dataFuturo)) > 1) {
            $dataMes = implode("-", array_reverse(explode("/", $dataFuturo)));
        } elseif (count(explode("-", $dataFuturo)) > 1) {
            $dataMes = implode("/", array_reverse(explode("-", $dataFuturo)));
        }
        
        $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMes)));
        
        // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo1 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo1));
                    
                    $diaSemanaTexto1 =  $diasemana[$diasemana_numero - 1];
                    $diaSemanaTexto2 =  $diasemana[$diasemana_numero];
        
        
        $html = "";
        
        // CABECALHO DO PDF
        
        
        $html .= "<table style = 'width:60%;' border = '0'; cellpadding ='0'; cellspacing = '0';>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";
        $html .="<td style = 'color: #ffffff; font-size: 5px;' align = 'center'></td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;' border: 10px; height: 20px;'>";
        $html .= "<td colspan = '5' style = 'color: #000000; font-size: 30px;'  align = 'center'><b>FOLHA DE LANCHE</b></td>";
        $html .= "</tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '2' style = 'color: #000000;  font-size: 30px;'  align = 'center'><b>&nbsp;PERÍODO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase;color: #000000;  font-size: 22px;'  align = 'center'><b>$mes / $mesProx</b></td>";
        $html .= "</tr>";
        $html .= "</table>";
        
        $html .= "<table style = 'width:60%;' border = '0'; cellpadding ='0'; cellspacing = '0';>";
        $html .= "<tr><td style = 'color: #ffffff; font-size: 5px;' align = 'center'></td></tr>";
        $html .= "<tr style = 'width:60%; border-width: 10px; height: 20px;'>";
        $html .= "<td colspan = '2' style = 'color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 30px;'  align = 'center'><b>&nbsp;FUNCIONÁRIO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 22px;'  align = 'center'><b>$nomeFuncionario</b></td>";
        $html .= "</tr>";
        $html .= "<tr style = 'width:60%; border-width: 10px; height: 20px;'>";
        $html .= "<td colspan = '2' style = 'color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 30px;'  align = 'center'><b>&nbsp;FUNÇÃO:</b></td>";
        $html .= "<td colspan = '3' style = 'text-transform: uppercase; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 22px;'  align = 'center'><b>$funcao</b></td>";
        

        $html .= "</tr>";
        
        
        $html .= "<tr style = 'width:60%; background-color: #579CE9; border-width: 10px; height: 30px;'>";
        $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>&nbsp;&nbsp;DATA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>&nbsp;&nbsp;DIA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>ENTRADA</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>SAIDA</b></td>";
        $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>ASSINATURA</b></td>";
        
        $html .= "</tr>";
        
        // PRIMEIRO DIA
        
        if($diaSemanaTexto1 == "Domingo"){
            $html .= "<tr style = 'width:60%; background-color: #579CE9; height: 30px;'>";
            $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "</tr>";
        
        }else{
           
            $html .= "<tr style = 'width:60%; height: 30px;'>";
            $html .= "<td style = 'width: 15%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto1</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "</tr>";
        }
        // SEGUNDO DIA
        if($diaSemanaTexto2 == "Domingo"){
            
            $html .= "<tr style = 'width:60%; background-color: #579CE9; height:30px;'>";
            $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "</tr>";
        
            
        }else{
            
            $html .= "<tr style = 'width:60%;  height: 30px;'>";
            $html .= "<td style = 'width: 15%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
            $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto2</b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
            
            $html .= "</tr>";
        }
        
        
        // PROXIMOS DIAS
        for ($i = 0; $i < $diasMes - 2; $i++) {

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodo. 'day', strtotime($dataMesF)));
                    
                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataExameFuturo2 = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    $diasemana_numero = date('w', strtotime($dataExameFuturo2));
                    
                    $diaSemanaTexto =  $diasemana[$diasemana_numero];
                
                    if($diaSemanaTexto == "Domingo"){
                        
                        $html .= "<tr style = 'width:60%;  background-color: #579CE9; border: 1px; border-style: solid; border-color: black;  height: 30px;'>";
                        $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        
                        $html .= "</tr>";
                    
                        
                    }else{
                        
                        $html .= "<tr style = 'width:60%; height: 30px;'>";
                        $html .= "<td style = 'width: 15%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'left'><b>&nbsp;&nbsp;$dataExameFuturo</b></td>";
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; border-color: black; font-size: 25px;'  align = 'center'><b>$diaSemanaTexto</b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 15%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                       
                        $html .= "</tr>";
                        
                    }
                
                   
            }
            
            
                        $html .= "<tr style = 'width: 60%; height: 30px;'>";
                        $html .= "<td style = 'width: 15%;  color: #000000; font-size: 16px;'  align = 'left'><b></b></td>";
                        $html .= "<td style = 'width: 10%;  color: #000000; font-size: 16px;'  align = 'center'><b></b></td>";
                        $html .= "<td style = 'width: 15%; color: #000000; font-size: 20px;'  align = 'left'><b></b></td>";
                        $html .= "</tr>";
            
                        $html .= "<tr style = 'width: 60%; height: 20px;'>";
                        $html .= "<td style = 'width: 10%;  color: #000000; font-size: 16px;'  align = 'left'><b></b></td>";
                        
                        $html .= "<td style = 'width: 10%; color: #000000; border: 1px; border-style: solid; text-transform: uppercase; border-color: black; font-size: 25px;'  align = 'left'><b>ASS. FUNCIONÁRIO: </b></td>";
                        $html .= "<td colspan = '3' style = 'width: 10%; color: #ffffff; border: 1px; border-style: solid; border-color: black; font-size: 18px;'  align = 'left'><b></b></td>";
                        $html .= "</tr>";
                        
            
        
            $html .= "</table>";
        
        
            
        
            
        
        /////////////////////////////

        //$pasta = "C:/server/htdocs/gcconcreto/relatoriostemp/relatorio/"; //- GCCONCRETO 
        //$pasta = "C:/server/htdocs/vpi/relatoriostemp/relatorio/"; //- VPI
        $pasta = 'C:/server/htdocs/gestaopessoas/fwk/uploads/pdf/'; //LOCAL


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


        $nomeDoArquivo = "folha_ponto1.pdf";
        $tipoFolha = "P"; // P = Retrato | L = Paisagem



        $retorno = $this->geraPDF1($nomeDoArquivo, $html, $tipoFolha);

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

    private function geraPDF1($nomeDoArquivo, $html, $tipo) {
        //print_r("gerapdf");exit();
        $dompdf1 = new DOMPDF();
        define("DOMPDF_ENABLE_REMOTE", true);
//	if ($tipo == "L") {
//		$dompdf->set_paper("legal", "landscape"); // Altera o papel para modo paisagem.
//	}
        $dompdf1->load_html($html); // Carrega o HTML para a classe.
        $dompdf1->render();



        $canvas = $dompdf1->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "normal");
        $canvas->page_text(540, 820, "Pág. {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0, 0, 0)); //header
        $canvas->page_text(270, 820, "VPI TECNOLOGIA  -  GESTÃO", $font, 6, array(0, 0, 0)); //footer 
        header("Content-type: application/pdf");
        $pdf = $dompdf1->output(); // Cria o pdf
        $nomeDoArquivo = "folha_ponto1.pdf";

        //$arquivo = 'C:\server\htdocs\gcconcreto\relatoriostemp\relatorio\.'; //- GCCONCRETO
        //$arquivo = 'C:\server\htdocs\vpi\relatoriostemp\relatorio\.'; //- VPI
        $arquivo = 'C:\server\htdocs\gestaopessoas\fwk\uploads\pdf\.'; // - LOCAL 
        $arquivo .= $nomeDoArquivo; // Caminho onde será salvo o arquivo.


        if (file_put_contents($arquivo, $pdf)) { //Tenta salvar o pdf gerado
            return true; // Salvo com sucesso.
        } else {
            return false; // Erro ao salvar o arquivo
        }
    }
    
    
    
    
    

    public function getExcel($mes, $idEmpresa, $idFilial) {

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

        $periodoRelatorio = 7;

        $html = "";

        // CABECALHO EXCEL

        $html = "";
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'>";
        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '9' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '7' style= ' font-size: 20px;  color: #ffffff;' align = 'center'><b>&nbsp;&nbsp;&nbsp;&nbsp;RELATÓRIO DE ANIVERSÁRIO</b></td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9;'  border='0'>";
        $html .= "<td  colspan = '9' style= ' font-size: 23px;  color: #ffffff;' align = 'left'><b>$empresa / $filial</b></td>";
        $html .= "<td  colspan = '4' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b>Data Emissão: </td>";
        $html .= "<td  colspan = '3' style= ' font-size: 14px;  color: #ffffff;' align = 'center'><b></b>$dataAtualizada</td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '9' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '4' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b></td>";
        $html .= "<td  colspan = '3' style= ' font-size: 14px;  color: #ffffff;' align = 'center'></td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #ffffff; '  border='0'>";
        $html .= "<td colspan = '10' style= ' font-size: 6px;  color: #ffffff;' align = 'left'>-</td>";
        $html .= "</tr>";

        //FINAL DO CABECALHO EXCEL
        
        $html .= "<table border = '0'; cellpadding ='0'; cellspacing = '0' >";
       
        $html .= "<tr style = 'background-color: #579CE9; width:100%;'>";
        $html .= "<td style = 'color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Matrícula</b></td>";
        $html .= "<td colspan = '4' style = 'color: #ffffff; font-size: 18px;'  align = 'left'><b>Funcionário</b></td>";
        $html .= "<td colspan = '4' style = 'color: #ffffff; font-size: 18px;'  align = 'left'><b>Função</b></td>";
        $html .= "<td colspan = '2' style = 'color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Admissão</b></td>";
        $html .= "<td colspan = '2' style = 'color: #ffffff; font-size: 18px;'  align = 'left'><b>Mês</b></td>";
        $html .= "<td colspan = '3' style = 'color: #ffffff; font-size: 14px;'  align = 'left'><b>Tempo de Empresa</b></td>";

        $html .= "</tr>";



        $query = " SELECT  T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_NASC, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO
                            FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2
                            ON  T1.FUNCAO = T2.ID_FUNCAO
                            WHERE
                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial'";

        if ($mes != 0 || $mes != "0") {

            $query .= " AND T1.DATA_ADMISSAO LIKE '%/$mes/%'";
        }

        $query .= " ORDER BY TO_DATE(DATA_ADMISSAO,'dd/mm/yyyy')";


        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {


            //print_r($tamanho);

            foreach ($rs as $item) {

                $dataAdmissao = $item->DATA_ADMISSAO;
                $matricula = $item->MATRICULA;
                $nomeFuncionario = $item->NOME_FUNCIONARIO;
                $funcao = $item->FUNCAO;


                if (count(explode("/", $dataAdmissao)) > 1) {
                    $dataMes = implode("-", array_reverse(explode("/", $dataAdmissao)));
                } elseif (count(explode("-", $dataAdmissao)) > 1) {
                    $dataMes = implode("/", array_reverse(explode("-", $dataAdmissao)));
                }

                $mesAdmissao = date('m', strtotime($dataMes));



                switch ($mesAdmissao) {

                    case 01:
                        $mesAdmissao = "JANEIRO";
                        break;
                    case 02:
                        $mesAdmissao = "FEVEREIRO";
                        break;
                    case 03:
                        $mesAdmissao = "MARÇO";
                        break;
                    case 04:
                        $mesAdmissao = "ABRIL";
                        break;
                    case 05:
                        $mesAdmissao = "MAIO";
                        break;
                    case 06:
                        $mesAdmissao = "JUNHO";
                        break;
                    case 07:
                        $mesAdmissao = "JULHO";
                        break;
                    case 08:
                        $mesAdmissao = "AGOSTO";
                        break;
                    case 09:
                        $mesAdmissao = "SETEMBRO";
                        break;
                    case 10:
                        $mesAdmissao = "OUTUBRO";
                        break;
                    case 11:
                        $mesAdmissao = "NOVEMBRO";
                        break;
                    case 12:
                        $mesAdmissao = "DEZEMBRO";
                        break;
                }

                if ($mes != 0 || $mes != "0") {

                    $query = " SELECT  T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_NASC, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO
                                            FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2
                                            ON  T1.FUNCAO = T2.ID_FUNCAO
                                            WHERE
                                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial' AND T1.MATRICULA = '$matricula' AND T1.DATA_ADMISSAO LIKE '%/$mes/%' ORDER BY TO_DATE(DATA_ADMISSAO,'dd/mm/yyyy')";


                    //print_r($query);exit();

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs) && count($rs) > 0) {

                        $j = 0;
                        $tamanho = count($rs);

                         //print_r($tamanho);exit();

                        for ($i = 0; $i < $tamanho; $i++) {

                            // CONVERTER FORMATO DE DATA DE D/M/Y PARA Y-M-D   
                            if (count(explode("/", $dataAdmissao)) > 1) {
                                $dataTeste = implode("-", array_reverse(explode("/", $dataAdmissao)));
                            } elseif (count(explode("-", $dataAdmissao)) > 1) {
                                $dataTeste = implode("/", array_reverse(explode("-", $dataAdmissao)));
                            }


                            // CALCULO PARA SABER IDADE APARTIR DA DATA DE ADMISSAO        
                            $dataNascimento = $dataTeste;
                            $date = new DateTime($dataNascimento);
                            $interval = $date->diff(new DateTime(date('Y-m-d')));
                            $tempoEmpresa = $interval->format('%Y Anos, %m Meses e %d Dias');


                            // PASSAR COR NA LINHA QUE A DATA DE ADMISSAO COINCIDIR COM A DATA ATUAL        
                            $dataAdmissaoComparacao = date('m-d', strtotime($dataTeste));
                            $dataAtualizadaComparacao = date('m-d');

                            if ($dataAdmissaoComparacao == $dataAtualizadaComparacao) {

                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = ' font-size: 19px; background-color: #FFC0CB;' align = 'left'><b>&nbsp;&nbsp;$matricula</b></td>";
                                $html .= "<td  colspan = '4' style = ' background-color: #FFC0CB; text-transform: uppercase; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;$nomeFuncionario</b></td>";
                                $html .= "<td  colspan = '4' style = ' background-color: #FFC0CB; text-transform: uppercase; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;$funcao</b></td>";
                                $html .= "<td  colspan = '2' style = ' background-color: #FFC0CB; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '2' style = ' background-color: #FFC0CB; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$mesAdmissao&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '3' style = ' background-color: #FFC0CB; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$tempoEmpresa&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";

                                $html .= "</tr>";
                            } else {
                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = 'font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$matricula&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '4' style = 'font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;$nomeFuncionario&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '4' style = 'font-size: 19px;' align = 'left'><b>$funcao&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '2' style = 'font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '2' style = 'font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$mesAdmissao&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";
                                $html .= "<td  colspan = '3' style = 'font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$tempoEmpresa&nbsp;&nbsp;&nbsp;&nbsp;</b></td>";

                                $html .= "</tr>";
                            }

                            // QUEBRA DE LINHA PRA SUB TOTAL EQUIPAMENTO E DATA

                            if ($i == ($tamanho - 1)) {

                               $html .= "<tr style = 'width:100%; background-color: #579CE9; height: 17px;'>";

                                $html .= "</tr>";
                            } 
                        }
                    }
                    
        // SEM MES SELECIONADO            
                } else {
                    $query = " SELECT  T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_NASC, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO
                                            FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_FUNCOES T2
                                            ON  T1.FUNCAO = T2.ID_FUNCAO
                                            WHERE
                                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial' AND T1.MATRICULA = '$matricula' ORDER BY TO_DATE(DATA_ADMISSAO,'dd/mm/yyyy')";


                    //print_r($query);exit();

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    if (is_array($rs) && count($rs) > 0) {

                        $j = 0;
                        $tamanho = count($rs);

                         //print_r($tamanho);

                        for ($i = 0; $i < $tamanho; $i++) {

                            // CONVERTER FORMATO DE DATA DE D/M/Y PARA Y-M-D   
                            if (count(explode("/", $dataAdmissao)) > 1) {
                                $dataTeste = implode("-", array_reverse(explode("/", $dataAdmissao)));
                            } elseif (count(explode("-", $dataAdmissao)) > 1) {
                                $dataTeste = implode("/", array_reverse(explode("-", $dataAdmissao)));
                            }


                            // CALCULO PARA SABER IDADE APARTIR DA DATA DE ADMISSAO        
                            $dataNascimento = $dataTeste;
                            $date = new DateTime($dataNascimento);
                            $interval = $date->diff(new DateTime(date('Y-m-d')));
                            $tempoEmpresa = $interval->format('%Y Anos, %m Meses e %d Dias');


                            // PASSAR COR NA LINHA QUE A DATA DE ADMISSAO COINCIDIR COM A DATA ATUAL        
                            $dataAdmissaoComparacao = date('m-d', strtotime($dataTeste));
                            $dataAtualizadaComparacao = date('m-d');

                            if ($dataAdmissaoComparacao == $dataAtualizadaComparacao) {

                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = 'font-size: 14px; background-color: #FFC0CB;' align = 'left'><b>&nbsp;&nbsp;$matricula</b></td>";
                                $html .= "<td  colspan = '4' style = ' background-color: #FFC0CB;text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$nomeFuncionario</b></td>";
                                $html .= "<td  colspan = '4' style = ' background-color: #FFC0CB;text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$funcao</b></td>";
                                $html .= "<td  colspan = '2' style = ' background-color: #FFC0CB;width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao</b></td>";
                                $html .= "<td  colspan = '2' style = ' background-color: #FFC0CB;width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$mesAdmissao</b></td>";
                                $html .= "<td  colspan = '3' style = ' background-color: #FFC0CB; width: 20%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$tempoEmpresa</b></td>";

                                $html .= "</tr>";
                            } else {
                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = 'font-size: 14px;' align = 'left'><b>$matricula</b></td>";
                                $html .= "<td  colspan = '4' style = 'text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$nomeFuncionario</b></td>";
                                $html .= "<td  colspan = '4' style = 'text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$funcao</b></td>";
                                $html .= "<td  colspan = '2' style = 'width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao</b></td>";
                                $html .= "<td  colspan = '2' style = 'width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$mesAdmissao</b></td>";
                                $html .= "<td  colspan = '3' style = 'width: 20%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$tempoEmpresa</b></td>";

                                $html .= "</tr>";
                            }

                            // QUEBRA DE LINHA PRA SUB TOTAL EQUIPAMENTO E DATA

                            if ($i == ($tamanho - 1)) {

                               $html .= "<tr style = 'width:100%; background-color: #579CE9; height: 17px;'>";

                                $html .= "</tr>";
                            }

                            
                        }
                    }
                }
            }
        }




        return $html;
    }

}
