<?php

require_once("resources/relatoriofuncionarios/dompdf/dompdf_config.inc.php");

class relatoriofuncionariosmodel extends CI_Model {

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
    
    
    private function converterData($data){
       
        if (count(explode("/", $data)) > 1) {
                    $dataMes = implode("-", array_reverse(explode("/", $data)));
        } 
        else if (count(explode("-", $data)) > 1) {
            $dataMes = implode("/", array_reverse(explode("-", $data)));
        }
        return $dataMes;    
    }
    
    
    private function selecionarMes($mesAdmissao){
       
        $meses = ["01"=>"JANEIRO","02"=>"FEVEREIRO","03"=>"MARÇO","04"=>"ABRIL",
                  "05"=>"MAIO","06"=>"JUNHO","07"=>"JULHO","08"=>"AGOSTO",
                  "09"=>"SETEMBRO","10"=>"OUTUBRO","11"=>"NOVEMBRO","12"=>"DEZEMBRO"];
        
        return $meses["$mesAdmissao"];
        
    }
    
    
    private function exibirCabecalho($dataAtualizada,$empresa,$filial){
        
        $html = "";

        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1';>";
        $html .= "<tr style = 'background-color: #579CE9;'>";
        $html .= "<td class = 'nomeempresa' rowspan = '6' colspan = '4' align = 'left'  style = 'text-transform: uppercase; color: #ffffff; ' align = 'center';><b>&nbsp;&nbsp;Empresa:</b> $empresa <br>&nbsp;&nbsp;<b>Filial:</b> $filial</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '3'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td class = 'nomerelatorio'colspan = '3' style = 'color: #ffffff;' align = 'CENTER'><b>RELATÓRIO FUNCIONARIO</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '3'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  colspan = '2' class = 'datas' style = 'text-transform: uppercase; color: #ffffff; ' align = 'right'><b>Data Emissão:</b></td>";
        $html .= "<td  colspan = '2'  style = 'color: #ffffff; font-size: 16px; ' align = 'center'>$dataAtualizada</td>";
        $html .= "</tr>";
        $html .= "</table>";
        
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
        $html .= "<tr style = 'width:100%; background-color: #579CE9; height: 17px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;Matrícula</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Função</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Data Admissão</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Mês</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Data Demissão</b></td>";
        $html .= "<td colspan = '2' style = 'width: 20%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Tempo de Empresa</b></td>";
        $html .= "</tr>";
        
        return $html;
    }
    
        private function cabecalhoPdf($empresa,$filial,$dataAtualizada){
        
        $html = "";
        // CABECALHO DO PDF
        $html .= "<table style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0';>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td colspan = '4' rowspan = '6' align = 'left' style = 'font-size: 22px; color: #ffffff;'><b>&nbsp;&nbsp;<b>Empresa: </b>$empresa &nbsp;&nbsp;<b>Filial: </b>$filial</td>";
        $html .= "<td rowspan = '2' colspan = '2'  align = 'center' style = 'font-size: 22px; color: #ffffff;'><b>&nbsp;&nbsp;RELATÓRIO DE FUNCIONÁRIO</b></td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2'     align = 'right' style = 'font-size: 22px; color: #ffffff;'><b>Data Emissao:</b></td>";
        $html .= "<td rowspan = '2'     align = 'center' style = 'font-size: 20px; color: #ffffff;'>$dataAtualizada </td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2'    align = 'right' style = 'font-size: 22px; color: #ffffff;'></td>";
        $html .= "<td rowspan = '2'     align = 'center' style = 'font-size: 22px; color: #ffffff;'><b>  </td></tr>";
        $html .= "</table>";

        // FINAL CABECALHO

        $html .= "<table  style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0' >";
        $html .= "<tr style = 'background-color: #ffffff; height: 50px;'><td colspan = '10' style = ' color: #ffffff; font-size: 5px;' align = 'center'><b>--------</td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Matrícula</b></td>";
        $html .= "<td colspan = '2' style = 'width: 30%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Funcionário</b></td>";
        $html .= "<td colspan = '2' style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Função</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'center'><b>Data Admissão</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'center'><b>Mês</b></td>";
        $html .= "<td colspan = '2' style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'center'><b>Tempo de Empresa</b></td>";
        $html .= "</tr>";
        $html .= "</table>";
        return $html;
    }
    
    
    private function getHTML($mes,$idEmpresa, $idFilial,$type){
        
        
        $dataAtualizada = date('d/m/Y');

        $this->initConBanco();

        $query1 = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $idEmpresa ";
        //print_r($query1);exit();
        $rs1 = $this->conBanco->query($query1)->result();
        $empresa = $rs1[0]->NOME_FANTASIA;


        $query2 = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$idFilial'";
        $rs2 = $this->conBanco->query($query2)->result();
        $filial = $rs2[0]->NOME_FANTASIA;
        if($type == "relatorio"){ 
            $html = $this->exibirCabecalho($dataAtualizada,$empresa,$filial); //CABECALHO 
        }
        else if($type == "relatorioPDF"){
            $html = $this->cabecalhoPdf($empresa,$filial,$dataAtualizada);
        }
        
        $query3 = " SELECT  T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO,
                            T1.DATA_NASC, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL,
                            T1.DESATIVADO, T1.DATA_DEMISSAO,
                            
                            T2.ID_FUNCAO, T2.FUNCAO
                            
                    FROM GP_CAD_FUNCIONARIO T1 
                    INNER JOIN GP_CAD_FUNCOES T2

                    ON  T1.FUNCAO = T2.ID_FUNCAO
                    WHERE
                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial'";

        if (!($mes == 0 || $mes == "0")) {
            $query3 .= " AND T1.DATA_ADMISSAO LIKE '%/$mes/%'";
        }

        $query3 .= " ORDER BY TO_DATE(DATA_ADMISSAO,'dd/mm/yyyy')"; 
        //print_r($query);exit();

        $rs3 = $this->conBanco->query($query3)->result();

        if (is_array($rs3) && count($rs3) > 0) {

            foreach ($rs3 as $item) {

                $dataAdmissao       = $item->DATA_ADMISSAO;
                $dataDemmissao      = $item->DATA_DEMISSAO;
                $desativado         = $item->DESATIVADO;
                $matricula          = $item->MATRICULA;
                $nomeFuncionario    = $item->NOME_FUNCIONARIO;
                $funcao             = $item->FUNCAO;
                    
                $dataAdmissaoMes = $this->converterData($dataAdmissao);
                $mesAdmissao = date('m', strtotime($dataAdmissaoMes));
                
                $mesAdmissao = $this->selecionarMes($mesAdmissao);
                
                $query4 = " SELECT      T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO,
                                        T1.DATA_NASC, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL,
                                        T1.DESATIVADO, T1.DATA_DEMISSAO,

                                        T2.ID_FUNCAO, T2.FUNCAO

                            FROM GP_CAD_FUNCIONARIO T1
                            
                            INNER JOIN GP_CAD_FUNCOES T2

                            ON  T1.FUNCAO = T2.ID_FUNCAO
                                
                            WHERE
                                        T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial' AND T1.MATRICULA = '$matricula'";
                if(!($mes == 0 || $mes == "0")){
                    $query4 .= " AND T1.DATA_ADMISSAO LIKE '%/$mes/%'";
                }
                
                $query4 .= " ORDER BY TO_DATE(DATA_ADMISSAO,'dd/mm/yyyy')";
 
                //print_r($query4);exit();
                $rs4 = $this->conBanco->query($query4)->result();

                if (is_array($rs4) && count($rs4) > 0) {

                    for ($i = 0; $i < count($rs4); $i++) {

                        // CONVERTER FORMATO DE DATA DE D/M/Y PARA Y-M-D  
                        $dataTeste = $this->converterData($dataAdmissao);

                        // CALCULO PARA SABER IDADE APARTIR DA DATA DE ADMISSAO        
                        $date = new DateTime($dataTeste);
                        $interval = $date->diff(new DateTime(date('Y-m-d')));
                        $tempoEmpresa = $interval->format('%Y Anos, %m Meses e %d Dias');

                        // PASSAR COR NA LINHA QUE A DATA DE ADMISSAO COINCIDIR COM A DATA ATUAL        
                        if($desativado == "N"){
                           $dataDemmissao = "Não demitido";
                        }
                        
                        $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                        $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 14px;' align = 'left'><b>$matricula</b></td>";
                        $html .= "<td  style = 'text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$nomeFuncionario</b></td>";
                        $html .= "<td  style = 'text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$funcao</b></td>";
                        $html .= "<td  style = 'width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao</b></td>";
                        $html .= "<td  style = 'width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$mesAdmissao</b></td>";
                        $html .= "<td  style = 'width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataDemmissao</b></td>";
                        $html .= "<td  colspan = '2' style = 'width: 20%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$tempoEmpresa</b></td>";

                        $html .= "</tr>";

                        }
                    }
                }
            }
        
        return $html;
        
        
    }
    
    
    public function filtro($mes, $idEmpresa, $idFilial) {
        
        $type = "relatorio";
        $html = $this->getHTML($mes, $idEmpresa, $idFilial, $type);
        
        return $html;
    }

    
    public function getPdf($mes, $idEmpresa, $idFilial) {

        $dataAtualizada = date('d/m/Y');
        $type = "relatorioPDF";
        $html = $this->getHTML($mes, $idEmpresa, $idFilial, $type);
        //$pasta = "C:/server/htdocs/gcconcreto/relatoriostemp/relatorio/"; //- GCCONCRETO 
        //$pasta = "C:/server/htdocs/vpi/relatoriostemp/relatorio/"; //- VPI
        $pasta = 'C:/server/htdocs/gestaopessoas/fwk/uploads/pdf/'; //LOCAL
        if(!is_dir($pasta)){
            mkdir($pasta);
        }
        /*
        if (is_dir($pasta)) {
            $diretorio = dir($pasta);
            
            while ($arquivo = $diretorio->read()) {
                if (($arquivo != '.') && ($arquivo != '..')) {
                    unlink($pasta . $arquivo);
                    echo 'Arquivo ' . $arquivo . ' foi apagado com sucesso. <br />';
                }
            }
            $diretorio->close();
        }
        */
        $nomeDoArquivo = "relario_funcionarios.pdf";
        $tipoFolha = "P"; // P = Retrato | L = Paisagem
        $retorno = $this->geraPDF($nomeDoArquivo, $html, $tipoFolha);

        if ($retorno) {
            $gerado = true;
        } else {
            $gerado = false;
        }

        if ($gerado) {
            echo "Arquivo Gerado: " . $nomeDoArquivo . "\n";
        } else {
            echo "Erro ao gerar o arquivo.";
            return;
        }
    }

    
    private function geraPDF($nomeDoArquivo, $html, $tipo) {
        
        //print_r("gerapdf");exit();
        $dompdf = new DOMPDF();
        
        //define("DOMPDF_ENABLE_REMOTE", true);
//	if ($tipo == "L") {
//		$dompdf->set_paper("legal", "landscape"); // Altera o papel para modo paisagem.
//	}
        $dompdf->load_html($html); // Carrega o HTML para a classe.
        $dompdf->set_paper('A4','portrait');
        $dompdf->render();

        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "normal");
        $canvas->page_text(540, 820, "Pág. {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0, 0, 0)); //header
        $canvas->page_text(270, 820, "VPI TECNOLOGIA  -  CLARIFY People", $font, 6, array(0, 0, 0)); //footer 
        header("Content-type: application/pdf");
        $pdf = $dompdf->output(); // Cria o pdf
        echo "hehehehhee";exit();
        $nomeDoArquivo = "relario_funcionarios.pdf";

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
        $html .= "<td  colspan = '7' style= ' font-size: 20px;  color: #ffffff;' align = 'center'><b>&nbsp;&nbsp;&nbsp;&nbsp;RELATÓRIO DE FUNCIONÁRIO</b></td>";
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
