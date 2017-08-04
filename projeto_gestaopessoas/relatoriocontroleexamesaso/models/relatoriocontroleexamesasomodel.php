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

    public function filtro($mes, $idEmpresa, $idFilial) {

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

        //CABECALHO INICIO
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1';>";
        $html .= "<tr style = 'background-color: #579CE9;'>";
        $html .= "<td class = 'nomeempresa' rowspan = '6' colspan = '8' align = 'left'  style = 'text-transform: uppercase; color: #ffffff; ' align = 'center';><b>&nbsp;&nbsp;Empresa:</b> $empresa <br>&nbsp;&nbsp;<b>Filial:</b> $filial</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '7'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td class = 'nomerelatorio'colspan = '7' style = 'color: #ffffff;' align = 'CENTER'><b>RELATÓRIO DE CONTROLE DE DATAS <br>PARA EXAMES ASO</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '7'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  colspan = '2' class = 'datas' style = 'text-transform: uppercase; color: #ffffff; ' align = 'right'><b>Data Emissão:</b></td>";
        $html .= "<td  colspan = '3'  style = 'color: #ffffff; font-size: 16px; ' align = 'center'>$dataAtualizada</td>";
        $html .= "</tr>";

//        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
//        $html .= "<td  colspan = '2' class = 'datas' style = 'color: #ffffff; ' align = 'right'><b> Período:</b></td>";
//        $html .= "<td  colspan = '3'  style = 'color: #ffffff; ' align = 'center'>$periodoIni à $periodoFim</td>";
//        $html .= "</tr>";
        $html .= "</table>";
        //CABECALHO FIM


        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
        $html .= "<tr style = 'width:100%; background-color: #579CE9; height: 17px;'>";


        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;font-size: 14px;' align = 'center'><b></b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;Data</b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;&nbsp;Período</b></td>";


        for ($i = 0; $i < $periodoRelatorio + 1; $i++) {

            $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data</b></td>";
        }


        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 17px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b> Função</b></td>";
        $html .= "<td style = 'width: 3%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Admissão</b></td>";
        $html .= "<td style = 'width: 3%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Exame ASO</b></td>";


        for ($i = 0; $i < $periodoRelatorio + 1; $i++) {




            $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 14px;' align = 'left'><b>Prox. Exame</b></td>";
        }



        $html .= "</tr>";



        $query = " SELECT DISTINCT T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO, T2.PERIODO_EXAME_ASO
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




            foreach ($rs as $item) {

                $idFuncionario = $item->ID_FUNCIONARIO;
                
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        /////////// CALCULO PARA DATAS FUTURAS DO EXAME ///////////////////////////////////////////////////////////
                $dataAdmissao = $item->DATA_ADMISSAO;
                $periodoExame = $item->PERIODO_EXAME_ASO * 1;
               // print_r($dataAdmissao);
                
                // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                if (count(explode("/", $dataAdmissao)) > 1) {
                    $dataMes = implode("-", array_reverse(explode("/", $dataAdmissao)));
                } elseif (count(explode("-", $dataAdmissao)) > 1) {
                    $dataMes = implode("/", array_reverse(explode("-", $dataAdmissao)));
                }
                //print_r($dataMes);
                
                // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodoExame. 'month', strtotime($dataMes)));
                
                //print_r($dataExameFuturo);
                //$dataExameFuturo = date('Y/m/d', strtotime($dataProxExame));
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 

                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 14px;' align = 'left'><b>$item->NOME_FUNCIONARIO</b></td>";
                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 14px;' align = 'left'><b>$item->FUNCAO</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 14px;' align = 'left'><b>$item->DATA_ADMISSAO</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$item->PERIODO_EXAME_ASO</b></td>";
                $html .= "<td  style = 'width: 5%; font-size: 14px;' align = 'left'>&nbsp;&nbsp;$dataExameFuturo</td>";
                   

                

                
                for ($i = 0; $i < $periodoRelatorio; $i++) {

        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        /////////// CALCULO PARA DATAS FUTURAS DO EXAME ///////////////////////////////////////////////////////////
                   // $dataAdmissao = $item->DATA_ADMISSAO;
                   // $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                   // print_r($dataAdmissao);

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    //print_r($dataMes);
                    
                    $dataAnterior = $dataMesF;
                    
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodoExame. 'month', strtotime($dataMesF)));

                    //print_r($dataExameFuturo);
                    //$dataExameFuturo = date('Y/m/d', strtotime($dataProxExame));
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
             
                    $html .= "<td  style = 'width: 5%; font-size: 14px;'  align = 'left'>&nbsp;&nbsp;$dataExameFuturo </td>";
                      
                      
                            

                    
                }
                $html .= "</tr>";
                $html .= "<tr style = 'background-color: #579CE9; height: 3px;'>";
                $html .= "<td colspan = '12' style = 'width: 5%; font-size: 14px;'  align = 'left'></td>";
                $html .= "</tr>";
            }
        }



        return $html;
    }

    public function getPdf($mes, $idEmpresa, $idFilial) {

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

        // CABECALHO DO PDF
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'; cellpadding ='3'; cellspacing = '0';>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td colspan = '8' rowspan = '6' align = 'left' style = 'font-size: 36px; color: #ffffff;'><b>&nbsp;&nbsp;<b>Empresa: </b>$empresa </br></br>&nbsp;&nbsp;<b>Filial: </b>$filial</td>";
        $html .= "<td rowspan = '2' colspan = '4'  align = 'center' style = 'font-size: 30px; color: #ffffff;'><b>&nbsp;&nbsp;RELATÓRIO DE CONTROLE DE DATAS </br> PARA EXAMES ASO</b></td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2' colspan = '2'    align = 'right' style = 'font-size: 22px; color: #ffffff;'><b>Data Emissao:</b></td>";
        $html .= "<td rowspan = '2' colspan = '2'    align = 'center' style = 'font-size: 20px; color: #ffffff;'>$dataAtualizada </td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2' colspan = '2'   align = 'right' style = 'font-size: 22px; color: #ffffff;'></td>";
        $html .= "<td rowspan = '2' colspan = '2'    align = 'center' style = 'font-size: 22px; color: #ffffff;'><b>  </td></tr>";
        $html .= "</table>";

        // FINAL CABECALHO

        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0' >";
        $html .= "<tr style = 'background-color: #ffffff; height: 50px;'><td colspan = '10' style = ' color: #ffffff; font-size: 5px;' align = 'center'><b>--------</td></tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";


        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;font-size: 18px;' align = 'center'><b></b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;Data</b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;&nbsp;Período</b></td>";


        for ($i = 0; $i < $periodoRelatorio + 1; $i++) {

            $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data</b></td>";
        }


        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 17px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b> Função</b></td>";
        $html .= "<td style = 'width: 3%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Admissão</b></td>";
        $html .= "<td style = 'width: 3%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Exame ASO</b></td>";


        for ($i = 0; $i < $periodoRelatorio + 1; $i++) {




            $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;' align = 'left'><b>Prox. Exame</b></td>";
        }



        $html .= "</tr>";

        

        $query = " SELECT DISTINCT T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO, T2.PERIODO_EXAME_ASO
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




            foreach ($rs as $item) {

                $idFuncionario = $item->ID_FUNCIONARIO;
                
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        /////////// CALCULO PARA DATAS FUTURAS DO EXAME ///////////////////////////////////////////////////////////
                $dataAdmissao = $item->DATA_ADMISSAO;
                $periodoExame = $item->PERIODO_EXAME_ASO * 1;
               // print_r($dataAdmissao);
                
                // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                if (count(explode("/", $dataAdmissao)) > 1) {
                    $dataMes = implode("-", array_reverse(explode("/", $dataAdmissao)));
                } elseif (count(explode("-", $dataAdmissao)) > 1) {
                    $dataMes = implode("/", array_reverse(explode("-", $dataAdmissao)));
                }
                //print_r($dataMes);
                
                // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodoExame. 'month', strtotime($dataMes)));
                
                //print_r($dataExameFuturo);
                //$dataExameFuturo = date('Y/m/d', strtotime($dataProxExame));
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 

                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 19px;' align = 'left'><b>$item->NOME_FUNCIONARIO</b></td>";
                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 19px;' align = 'left'><b>$item->FUNCAO</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 19px;' align = 'left'><b>$item->DATA_ADMISSAO</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$item->PERIODO_EXAME_ASO</b></td>";
                $html .= "<td  style = 'width: 5%; font-size: 19px;' align = 'left'>&nbsp;&nbsp;$dataExameFuturo</td>";
                   

                

                
                for ($i = 0; $i < $periodoRelatorio; $i++) {

        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        /////////// CALCULO PARA DATAS FUTURAS DO EXAME ///////////////////////////////////////////////////////////
                   // $dataAdmissao = $item->DATA_ADMISSAO;
                   // $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                   // print_r($dataAdmissao);

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    //print_r($dataMes);
                    
                    $dataAnterior = $dataExameFuturo;
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodoExame. 'month', strtotime($dataMesF)));

                    //print_r($dataExameFuturo);
                    //$dataExameFuturo = date('Y/m/d', strtotime($dataProxExame));
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
             
                    $html .= "<td  style = 'width: 5%; font-size: 19px;'  align = 'left'>&nbsp;&nbsp;$dataExameFuturo </td>";
                      
                 
                    
                }
                $html .= "</tr>";
                $html .= "<tr style = 'background-color: #579CE9; height: 3px;'>";
                $html .= "<td colspan = '12' style = 'width: 5%; font-size: 14px;'  align = 'left'></td>";
                $html .= "</tr>";
            }
        }


        
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


        $nomeDoArquivo = "relatorio_datas_ASO.pdf";
        $tipoFolha = "L"; // P = Retrato | L = Paisagem



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
	if ($tipo == "L") {
		$dompdf->set_paper("legal", "landscape"); // Altera o papel para modo paisagem.
	}
        $dompdf->load_html($html); // Carrega o HTML para a classe.
        $dompdf->render();



        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "normal");
        $canvas->page_text(540, 820, "Pág. {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0, 0, 0)); //header
        $canvas->page_text(270, 820, "VPI TECNOLOGIA  -  CLARIFY People", $font, 6, array(0, 0, 0)); //footer 
        header("Content-type: application/pdf");
        $pdf = $dompdf->output(); // Cria o pdf
        $nomeDoArquivo = "relatorio_datas_ASO.pdf";

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
        
        // CABECALHO EXCEL

        $html = "";
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'>";
        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '8' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '4' style= ' font-size: 20px;  color: #ffffff;' align = 'center'><b>&nbsp;&nbsp;&nbsp;&nbsp;RELATÓRIO DE CONTROLE DE DATAS PARA EXAME ASO</b></td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9;'  border='0'>";
        $html .= "<td  colspan = '8' style= ' font-size: 23px;  color: #ffffff;' align = 'left'><b>$empresa / $filial</b></td>";
        $html .= "<td  colspan = '2' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b>Data Emissão: </td>";
        $html .= "<td  colspan = '2' style= ' font-size: 14px;  color: #ffffff;' align = 'center'><b></b>$dataAtualizada</td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '8' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '2' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b></td>";
        $html .= "<td  colspan = '2' style= ' font-size: 14px;  color: #ffffff;' align = 'center'></td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #ffffff; '  border='0'>";
        $html .= "<td colspan = '10' style= ' font-size: 6px;  color: #ffffff;' align = 'left'>-</td>";
        $html .= "</tr>";

        //FINAL DO CABECALHO EXCEL


        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0' >";
        $html .= "<tr style = 'background-color: #ffffff; height: 10px;'><td colspan = '10' style = ' color: #ffffff; font-size: 5px;' align = 'center'><b>--------</td></tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";


        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff;font-size: 18px;' align = 'center'><b></b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;Data</b></td>";
        $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;&nbsp;Período</b></td>";


        for ($i = 0; $i < $periodoRelatorio + 1; $i++) {

            $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;' align = 'left'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data</b></td>";
        }


        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b> Função</b></td>";
        $html .= "<td style = 'width: 3%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Admissão</b></td>";
        $html .= "<td style = 'width: 3%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Exame ASO</b></td>";


        for ($i = 0; $i < $periodoRelatorio + 1; $i++) {




            $html .= "<td style = 'width: 5%; color: #ffffff; font-size: 18px;' align = 'left'><b>Prox. Exame</b></td>";
        }



        $html .= "</tr>";
        
        
        $query = " SELECT DISTINCT T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.ID_FUNCAO, T2.FUNCAO, T2.PERIODO_EXAME_ASO
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




            foreach ($rs as $item) {

                $idFuncionario = $item->ID_FUNCIONARIO;
                
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        /////////// CALCULO PARA DATAS FUTURAS DO EXAME ///////////////////////////////////////////////////////////
                $dataAdmissao = $item->DATA_ADMISSAO;
                $periodoExame = $item->PERIODO_EXAME_ASO * 1;
               // print_r($dataAdmissao);
                
                // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                if (count(explode("/", $dataAdmissao)) > 1) {
                    $dataMes = implode("-", array_reverse(explode("/", $dataAdmissao)));
                } elseif (count(explode("-", $dataAdmissao)) > 1) {
                    $dataMes = implode("/", array_reverse(explode("-", $dataAdmissao)));
                }
                //print_r($dataMes);
                
                // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodoExame. 'month', strtotime($dataMes)));
                
                //print_r($dataExameFuturo);
                //$dataExameFuturo = date('Y/m/d', strtotime($dataProxExame));
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 

                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 19px;' align = 'left'><b>$item->NOME_FUNCIONARIO</b></td>";
                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 19px;' align = 'left'><b>$item->FUNCAO</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 19px;' align = 'left'><b>$item->DATA_ADMISSAO</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 19px;' align = 'left'><b>&nbsp;&nbsp;$item->PERIODO_EXAME_ASO</b></td>";
                $html .= "<td  style = 'width: 5%; font-size: 19px;' align = 'left'>&nbsp;&nbsp;$dataExameFuturo</td>";
                   

                

                
                for ($i = 0; $i < $periodoRelatorio; $i++) {

        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        /////////// CALCULO PARA DATAS FUTURAS DO EXAME ///////////////////////////////////////////////////////////
                   // $dataAdmissao = $item->DATA_ADMISSAO;
                   // $periodoExame = $item->PERIODO_EXAME_ASO * 1;
                   // print_r($dataAdmissao);

                    // CONVERTER DATA "D/M/Y" PARA " Y-M-D" 
                    if (count(explode("/", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("-", array_reverse(explode("/", $dataExameFuturo)));
                    } elseif (count(explode("-", $dataExameFuturo)) > 1) {
                        $dataMesF = implode("/", array_reverse(explode("-", $dataExameFuturo)));
                    }
                    //print_r($dataMes);
                    
                    $dataAnterior = $dataExameFuturo;
                    
                    // FAZ CALCULO DATA FUTURA PASSANDO O PERIODO COMO REFERENCIA
                    $dataExameFuturo = date('d/m/Y', strtotime('+' .$periodoExame. 'month', strtotime($dataMesF)));

                    //print_r($dataExameFuturo);
                    //$dataExameFuturo = date('Y/m/d', strtotime($dataProxExame));
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
             
                    $html .= "<td  style = 'width: 5%; font-size: 19px;'  align = 'left'>&nbsp;&nbsp;$dataExameFuturo </td>";
                      
                   
                }
                
                $html .= "</tr>";
                $html .= "<tr style = 'background-color: #579CE9; height: 3px;'>";
                $html .= "<td colspan = '12' style = 'width: 5%; font-size: 14px;'  align = 'left'></td>";
                $html .= "</tr>";
            }
        }


        





        

        return $html;
    }

}
