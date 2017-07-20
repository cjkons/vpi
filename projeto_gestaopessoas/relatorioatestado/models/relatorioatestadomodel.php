<?php

require_once("resources/relatorioatestado/dompdf/dompdf_config.inc.php");

class relatorioatestadomodel extends CI_Model {

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

    public function filtro($idEmpresa, $idFilial, $periodoIni, $periodoFim) {

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

        

        $html = "";

        //CABECALHO INICIO
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1';>";
        $html .= "<tr style = 'background-color: #579CE9;'>";
        $html .= "<td class = 'nomeempresa' rowspan = '6' colspan = '5' align = 'left'  style = 'text-transform: uppercase; color: #ffffff; ' align = 'center';><b>&nbsp;&nbsp;Empresa:</b> $empresa <br>&nbsp;&nbsp;<b>Filial:</b> $filial</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '3'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td class = 'nomerelatorio'colspan = '3' style = 'color: #ffffff;' align = 'CENTER'><b>RELATÓRIO DE ATESTADOS</b></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td colspan = '3'></td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  class = 'datas' style = 'text-transform: uppercase; color: #ffffff; ' align = 'right'><b>Data Emissão:</b></td>";
        $html .= "<td  colspan = '2' style = 'color: #ffffff; font-size: 16px; ' align = 'center'>$dataAtualizada</td>";
        $html .= "</tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";
        $html .= "<td  class = 'datas' style = 'color: #ffffff; ' align = 'right'><b> Período:</b></td>";
        $html .= "<td  colspan = '3'  style = 'color: #ffffff; font-size: 14px;  ' align = 'center'>$periodoIni à $periodoFim</td>";
        $html .= "</tr>";
        $html .= "</table>";
        //CABECALHO FIM


        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '1'>";
        $html .= "<tr style = 'width:100%; background-color: #ffffff; height: 10px; font-size: 16px;'>";
        $html .= "<tr style = 'width:100%; background-color: #579CE9; height: 17px;'>";

        
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;Matrícula</b></td>";
        $html .= "<td style = 'width: 25%; color: #ffffff; font-size: 14px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Setor</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Função</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Data Admissão</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Data Atestado</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>Data Retorno</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 14px;'  align = 'left'><b>CID</b></td>";
      

        $html .= "</tr>";

        //print_r($periodoIni); exit();

        $query = " SELECT T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.DATA_ATESTADO, T2.DATA_RETORNO, T2.CID 
                    FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_ATESTADO T2 ON T1.ID_FUNCIONARIO = T2.FUNCIONARIO
                            WHERE
                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial'";
        
        if ($periodoIni != "" || $periodoIni != null) {

            $query .= " AND T2.DATA_ATESTADO >= '$periodoIni'";
        }
        if ($periodoFim != "" || $periodoFim != null) {

            $query .= " AND T2.DATA_ATESTADO <= '$periodoFim'";
        }

        $query .= " ORDER BY TO_DATE(DATA_ATESTADO,'dd/mm/yyyy')"; 


        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {


            //print_r($tamanho);

            foreach ($rs as $item) {
 
                $funcionario = $item->ID_FUNCIONARIO;
                
            
                $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario'";
                 //print_r($query);exit(); 

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $setor = $rs1[0]->SETOR;
                $funcao = $rs1[0]->FUNCAO;
                $matricula1 = $rs1[0]->MATRICULA;
                $dataAdmissao = $rs1[0]->DATA_ADMISSAO;


                $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

                $cs = $this->conBanco->query($query);
                $rs2 = $cs->result();

                $descFuncao = $rs2[0]->FUNCAO;

                $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

                $cs = $this->conBanco->query($query);
                $rs3 = $cs->result();

                $descSetor = $rs3[0]->SETOR;


                
                
                
                
                $matricula = $matricula1;
                $nomeFuncionario = $item->NOME_FUNCIONARIO;
                $setor = $descSetor;
                $funcao = $descFuncao;
                $dataAdmissao = $item->DATA_ADMISSAO;
                $dataAtestado = $item->DATA_ATESTADO;
                $dataRetorno = $item->DATA_RETORNO;
                $cid = $item->CID;


                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 14px;' align = 'left'><b>$matricula</b></td>";
                                $html .= "<td  style = ' text-transform: uppercase; width: 25%; font-size: 14px;' align = 'left'><b>$nomeFuncionario</b></td>";
                                $html .= "<td  style = ' text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$descSetor</b></td>";
                                $html .= "<td  style = ' text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$descFuncao</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAtestado</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 14px;' align = 'left'><b>$dataRetorno</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 14px;' align = 'left'><b>$cid</b></td>";

                                $html .= "</tr>";
                            

            }
                            
                        
                       
        }
        
    return $html;
    }

    public function getPdf($idEmpresa, $idFilial, $periodoIni, $periodoFim) {

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


        $html = "";

        // CABECALHO DO PDF
        $html .= "<table style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0';>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td colspan = '4' rowspan = '6' align = 'left' style = 'font-size: 22px; color: #ffffff;'><b>&nbsp;&nbsp;<b>Empresa: </b>$empresa <br>&nbsp;&nbsp;<b>Filial: </b>$filial</td>";
        $html .= "<td rowspan = '2' colspan = '2'  align = 'center' style = 'font-size: 22px; color: #ffffff;'><b>&nbsp;&nbsp;RELATÓRIO DE ATESTADOS</b></td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2'     align = 'right' style = 'font-size: 22px; color: #ffffff;'><b>Data Emissao:</b></td>";
        $html .= "<td rowspan = '2'     align = 'center' style = 'font-size: 20px; color: #ffffff;'>$dataAtualizada </td></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'></tr>";
        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'><td rowspan = '2' align = 'right' style = 'font-size: 20px; color: #ffffff;'><b><b>Período:</b></td>";
        $html .= "<td rowspan = '2' align = 'center' style = 'font-size: 20px; color: #ffffff;'><b>$periodoIni à $periodoFim  </td></tr>";
        $html .= "</table>";
        $html .= "</table>";

        // FINAL CABECALHO

        $html .= "<table  style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0' >";
        $html .= "<tr style = 'background-color: #ffffff; height: 50px;'><td colspan = '10' style = ' color: #ffffff; font-size: 5px;' align = 'center'><b>--------</td></tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 50px;'>";

        
        
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Matrícula</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Setor</b></td>";
        $html .= "<td style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Função</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Admissão</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Atestado</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Retorno</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>CID</b></td>";
        

        

        $html .= "</tr>";

        $query = " SELECT T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.DATA_ATESTADO, T2.DATA_RETORNO, T2.CID 
                    FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_ATESTADO T2 ON T1.ID_FUNCIONARIO = T2.FUNCIONARIO
                            WHERE
                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial'";
        
        if ($periodoIni != "" || $periodoIni != null) {

            $query .= " AND T2.DATA_ATESTADO >= '$periodoIni'";
        }
        if ($periodoFim != "" || $periodoFim != null) {

            $query .= " AND T2.DATA_ATESTADO <= '$periodoFim'";
        }

        $query .= " ORDER BY TO_DATE(DATA_ATESTADO,'dd/mm/yyyy')"; 
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {
 
                $funcionario1 = $item->ID_FUNCIONARIO;
                
            
                $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario1'";
                 //print_r($query);exit(); 

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $setor = $rs1[0]->SETOR;
                $funcao = $rs1[0]->FUNCAO;
                $matricula1 = $rs1[0]->MATRICULA;
                $dataAdmissao = $rs1[0]->DATA_ADMISSAO;


                $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

                $cs = $this->conBanco->query($query);
                $rs2 = $cs->result();

                $descFuncao = $rs2[0]->FUNCAO;

                $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

                $cs = $this->conBanco->query($query);
                $rs3 = $cs->result();

                $descSetor = $rs3[0]->SETOR;


                $matricula = $matricula1;
                $nomeFuncionario = $item->NOME_FUNCIONARIO;
                $setor = $descSetor;
                $funcao = $descFuncao;
                $dataAdmissao = $item->DATA_ADMISSAO;
                $dataAtestado = $item->DATA_ATESTADO;
                $dataRetorno = $item->DATA_RETORNO;
                $cid = $item->CID;
                
                                
                                
                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 16px;' align = 'left'><b>$matricula</b></td>";
                                $html .= "<td  style = ' text-transform: uppercase; width: 20%; font-size: 16px;' align = 'left'><b>$nomeFuncionario</b></td>";
                                $html .= "<td  style = ' text-transform: uppercase; width: 20%; font-size: 16px;' align = 'left'><b>$descSetor</b></td>";
                                $html .= "<td  style = ' text-transform: uppercase; width: 20%; font-size: 16px;' align = 'left'><b>$descFuncao</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 16px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 16px;' align = 'left'><b>&nbsp;&nbsp;$dataAtestado</b></td>";
                                $html .= "<td  style = ' width: 20%; font-size: 16px;' align = 'left'><b>&nbsp;&nbsp;$dataRetorno</b></td>";
                                $html .= "<td  style = ' width: 20%; font-size: 16px;' align = 'left'><b>&nbsp;&nbsp;$cid</b></td>";
                                
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


        $nomeDoArquivo = "relatorio_atestado.pdf";
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
        $nomeDoArquivo = "relatorio_atestado.pdf";

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
    
    

    public function getExcel($idEmpresa, $idFilial, $periodoIni, $periodoFim) {

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

        

        $html = "";

        // CABECALHO EXCEL

        $html = "";
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'>";
        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '4' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '7' style= ' font-size: 20px;  color: #ffffff;' align = 'center'><b>&nbsp;&nbsp;&nbsp;&nbsp;RELATÓRIO DE ANIVERSÁRIO</b></td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9;'  border='0'>";
        $html .= "<td  colspan = '4' style= ' font-size: 23px;  color: #ffffff;' align = 'left'><b>$empresa <br>Filial: $filial</b></td>";
        $html .= "<td  colspan = '4' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b>Data Emissão: </td>";
        $html .= "<td  colspan = '3' style= ' font-size: 14px;  color: #ffffff;' align = 'center'><b></b>$dataAtualizada</td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #579CE9; '  border='0'>";
        $html .= "<td  colspan = '4' style= ' font-size: 16px;  color: #ffffff;' align = 'left'><b></b></td>";
        $html .= "<td  colspan = '4' style= ' font-size: 14px;  color: #ffffff;' align = 'right'><b></b>Período: </td>";
        $html .= "<td  colspan = '3' style= ' font-size: 14px;  color: #ffffff;' align = 'center'><b></b>$periodoIni à $periodoFim</td>";
        $html .= "</tr>";

        $html .= "<tr  style = 'background-color: #ffffff; '  border='0'>";
        $html .= "<td colspan = '11' style= ' font-size: 6px;  color: #ffffff;' align = 'left'>-</td>";
        $html .= "</tr>";

        //FINAL DO CABECALHO EXCEL
        
        $html .= "<table class = 'awesome-text-box' style = 'width:100%;' border = '0'; cellpadding ='0'; cellspacing = '0' >";
        $html .= "<tr style = 'background-color: #ffffff; height: 10px;'><td colspan = '10' style = ' color: #ffffff; font-size: 5px;' align = 'center'><b>--------</td></tr>";

        $html .= "<tr style = 'background-color: #579CE9; height: 20px;'>";


        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Matrícula</b></td>";
        $html .= "<td colspan = '2' style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>&nbsp;&nbsp;Funcionário</b></td>";
        $html .= "<td colspan = '2' style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Setor</b></td>";
        $html .= "<td colspan = '2' style = 'width: 20%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Função</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Admissão</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Atestado</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>Data Retorno</b></td>";
        $html .= "<td style = 'width: 10%; color: #ffffff; font-size: 18px;'  align = 'left'><b>CID</b></td>";
        

        $html .= "</tr>";
        
        
        
        $query = " SELECT T1.MATRICULA, T1.ID_FUNCIONARIO, T1.NOME_FUNCIONARIO, T1.DATA_ADMISSAO, T1.EMPRESA, T1.FILIAL, T2.DATA_ATESTADO, T2.DATA_RETORNO, T2.CID 
                    FROM GP_CAD_FUNCIONARIO T1 INNER JOIN GP_CAD_ATESTADO T2 ON T1.ID_FUNCIONARIO = T2.FUNCIONARIO
                            WHERE
                            T1.EMPRESA = '$idEmpresa' AND T1.FILIAL = '$idFilial'";
        
        if ($periodoIni != "" || $periodoIni != null) {

            $query .= " AND T2.DATA_ATESTADO >= '$periodoIni'";
        }
        if ($periodoFim != "" || $periodoFim != null) {

            $query .= " AND T2.DATA_ATESTADO <= '$periodoFim'";
        }

        $query .= " ORDER BY TO_DATE(DATA_ATESTADO,'dd/mm/yyyy')"; 


        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) > 0) {


            //print_r($tamanho);

            foreach ($rs as $item) {
 
                $funcionario1 = $item->ID_FUNCIONARIO;
                
            
                $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario1'";
                 //print_r($query);exit(); 

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $setor = $rs1[0]->SETOR;
                $funcao = $rs1[0]->FUNCAO;
                $matricula1 = $rs1[0]->MATRICULA;
                $dataAdmissao = $rs1[0]->DATA_ADMISSAO;


                $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

                $cs = $this->conBanco->query($query);
                $rs2 = $cs->result();

                $descFuncao = $rs2[0]->FUNCAO;

                $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

                $cs = $this->conBanco->query($query);
                $rs3 = $cs->result();

                $descSetor = $rs3[0]->SETOR;


                $matricula = $matricula1;
                $nomeFuncionario = $item->NOME_FUNCIONARIO;
                $setor = $descSetor;
                $funcao = $descFuncao;
                $dataAdmissao = $item->DATA_ADMISSAO;
                $dataAtestado = $item->DATA_ATESTADO;
                $dataRetorno = $item->DATA_RETORNO;
                $cid = $item->CID;
                
                                
                             
                                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                                $html .= "<td  style = 'text-transform: uppercase; width: 10%; font-size: 14px;' align = 'left'><b>$matricula</b></td>";
                                $html .= "<td  colspan = '2' style = ' text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$nomeFuncionario</b></td>";
                                $html .= "<td  colspan = '2' style = ' text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$descSetor</b></td>";
                                $html .= "<td  colspan = '2' style = ' text-transform: uppercase; width: 20%; font-size: 14px;' align = 'left'><b>$descFuncao</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAdmissao</b></td>";
                                $html .= "<td  style = ' width: 10%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataAtestado</b></td>";
                                $html .= "<td  style = ' width: 20%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$dataRetorno</b></td>";
                                $html .= "<td  style = ' width: 20%; font-size: 14px;' align = 'left'><b>&nbsp;&nbsp;$cid</b></td>";
                                
                                $html .= "</tr>";
            }

                            // QUEBRA DE LINHA PRA SUB TOTAL EQUIPAMENTO E DATA

        }


    return $html;
    }

}
