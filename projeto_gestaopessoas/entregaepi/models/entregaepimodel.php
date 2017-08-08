<?php
require_once("resources/entregaepi/dompdf/dompdf_config.inc.php");

class entregaepimodel extends CI_Model { 

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

    public function novo() {

        $this->initConBanco();

        $query = "SELECT max(ID_EPI_ENT) AS ID FROM  GP_EPI_ENT";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) > 0) {
            $novoIdUsuario = $rs[0]->ID + 1;
        } else {
            $novoIdUsuario = 1;
        }

        return $novoIdUsuario;
    }
    
    public function verificarLancamentoEpi($id, $idFuncionario) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_ENT WHERE FUNCIONARIO = '$idFuncionario'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {
               
                $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI_ENT = '$id' AND  FUNCIONARIO = '$idFuncionario'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (is_array($rs) && count($rs) > 0) {
                   
                    return true;
                
                    
                } else {
                   
                    return false;
                }
                
            } else {
                
                return true;
            }
    }

    public function salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao) {

        $this->initConBanco();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


        $query = "SELECT * FROM GP_EPI_ENT  WHERE ID_EPI_ENT = $id";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();





        if (is_array($rs) && count($rs) > 0) {

            $query = "UPDATE GP_EPI_ENT SET FUNCIONARIO  = '$idFuncionario' , MATRICULA = '$matricula', SETOR = '$setor', FUNCAO = '$funcao', DATA_ADMISSAO = '$dataAdmissao' DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT = $id";

            $resultado = $this->conBanco->query($query);

            if ($resultado == true) {
                return true;
            } else {
                return false;
            }
        } else {



            $query = "INSERT INTO GP_EPI_ENT (ID_EPI_ENT, FUNCIONARIO, MATRICULA, SETOR, FUNCAO, DATA_ADMISSAO, DATA_CADASTRO, USUARIO_CADASTRO)
                            VALUES ($id,'$idFuncionario', '$matricula', '$setor', '$funcao', '$dataAdmissao', SYSDATE, '$usuarioLogado')";


            $resultado = $this->conBanco->query($query);

            if ($resultado == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function validarSalvarLancamento($id, $codCa) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

        $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCa'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();

        $descricaoCodCa = $rs1[0]->COD_CA;

///// CONSULTA PRA VERIFICAR SE O ID JA ESTA SALVO NA TABELA MAE        
        $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI_ENT = '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


///// SE O ID NAO ESTIVER SALVO, VAI SALVAR OS FILHOS NA TABELA ITEM TEMP     
        if (is_array($rs) && count($rs) == null) {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP  WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {

                return false;
            } else {

                return true;
            }
        } else {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {

                $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP  WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (is_array($rs) && count($rs) > 0) {

                    return false;
                } else {

                    return true;
                }
            } else {

                return true;
            }
        }
    }

    public function salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

        $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCa'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();

        $descricaoCodCa = $rs1[0]->COD_CA;
        
        //////// VALIDAR CAMPO EM BLOCO OU DIRETO
        

///// CONSULTA PRA VERIFICAR SE O ID JA ESTA SALVO NA TABELA MAE        
        $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI_ENT = '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


///// SE O ID NAO ESTIVER SALVO, VAI SALVAR OS FILHOS NA TABELA ITEM TEMP     
        if (is_array($rs) && count($rs) == null) {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP  WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GP_EPI_ENT_ITEM_TEMP SET COD_CA = '$descricaoCodCa', TIPO_EPI = '$tipoEpi', QTD_EPI = '$qtdEpi', N_H = '$estadoEpi', DATA = '$dataEpi', BLOCO_EPI = '$blocoEpi', TIPO_LANCAMENTO = '$tipoLancamento', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT LIKE '%$id%' AND COD_CA = '$descricaoCodCa'";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    //                
                    return true;
                    //               
                } else {
                    return false;
                }
            } else {

                $query = "SELECT MAX(ID_EPI_ENT_ITEM) AS ID_EPI_ENT_ITEM FROM GP_EPI_ENT_ITEM_TEMP";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_EPI_ENT_ITEM + 1;
                }


                $query = "INSERT INTO GP_EPI_ENT_ITEM_TEMP (ID_EPI_ENT, ID_EPI_ENT_ITEM, COD_CA, TIPO_EPI, QTD_EPI, N_H, DATA, BLOCO_EPI, TIPO_LANCAMENTO, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$descricaoCodCa', '$tipoEpi', '$qtdEpi', '$estadoEpi', '$dataEpi', '$blocoEpi', '$tipoLancamento', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    //                
                    return true;
                } else {
                    return false;
                }
            }
        }

/// SENAO VAI SALVAR OS FILHOS NA TABELA ITEM            
        else {
            $query = "SELECT * FROM GP_EPI_ENT_ITEM  WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GP_EPI_ENT_ITEM SET COD_CA = '$descricaoCodCa', TIPO_EPI = '$tipoEpi', QTD_EPI = '$qtdEpi', N_H = '$estadoEpi', DATA = '$dataEpi', BLOCO_EPI = '$blocoEpi', TIPO_LANCAMENTO = '$tipoLancamento', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT LIKE '%$id%' AND COD_CA = '$descricaoCodCa'";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    //                
                    return true;
                    //               
                } else {
                    return false;
                }
            } else {

                $query = "SELECT MAX(ID_EPI_ENT_ITEM) AS ID_EPI_ENT_ITEM FROM GP_EPI_ENT_ITEM";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_EPI_ENT_ITEM + 1;
                }


                $query = "INSERT INTO GP_EPI_ENT_ITEM (ID_EPI_ENT, ID_EPI_ENT_ITEM, COD_CA, TIPO_EPI, QTD_EPI, N_H, DATA, BLOCO_EPI, TIPO_LANCAMENTO, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$descricaoCodCa', '$tipoEpi', '$qtdEpi', '$estadoEpi', '$dataEpi', '$blocoEpi', '$tipoLancamento', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    //                
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function excluir($id) {

        $this->initConBanco();

        $query = "DELETE FROM GP_EPI_ENT WHERE ID_EPI_ENT = $id";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = $id";

            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
    public function getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncionarioFiltro) {

        //     print_r("teste"); exit();
        $this->initConBanco();


        $count = $this->getCountGrid();

        $grid = array();

        $grid['draw'] = $draw; // mecanismo de conformidade
        $grid['recordsTotal'] = $count; // total de registros 
        $grid['recordsFiltered'] = $count; // tota de registros filtrados


        $data = array();

        $query = "SELECT * FROM GP_EPI_ENT WHERE 1 = 1 ";

        if ($idFuncionarioFiltro != 0 || $idFuncionarioFiltro != "0") {
            $query .= "AND FUNCIONARIO = '$idFuncionarioFiltro'";
        }

       

        $query .= "ORDER BY ID_EPI_ENT DESC";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $itens = $cs->result();

        $obj = array();

        foreach ($itens as $item) {


            $id = $item->ID_EPI_ENT;
            
            
            $idFuncionario = $item->FUNCIONARIO;
            $query = "SELECT NOME_FUNCIONARIO FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = '$idFuncionario'";
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;    

            //$obj['SELECAO'] = "<input type='checkbox'  id='$aux' class='check'  onclick='marcaGrid($aux)'/>";
            $obj['ID_EPI_ENT'] = $id;
            $obj['FUNCIONARIO'] = $nomeFuncionario;
            $obj['MATRICULA'] = $item->MATRICULA;
            $obj['SETOR'] = $item->SETOR;
            $obj['FUNCAO'] = $item->FUNCAO;
            

            $obj['EDITAR'] = "<button type='submit' class='btn-primary' onclick='editarLancamento($id)'>Editar</button>";

            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
    }

    private function getCountGrid() {

        $this->initConBanco();


        $query = "SELECT COUNT(ID_EPI_ENT) AS TOTAL FROM GP_EPI_ENT";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }
    }

    public function selecionaGrid($id) {


        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI = $id";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {



            $obj[] = $rs[0]->ID_EPI;
            $obj[] = $rs[0]->COD_CA;
            $obj[] = $rs[0]->TIPO_EPI;
            $obj[] = $rs[0]->DESCRICAO_EPI;
            $obj[] = $rs[0]->VALIDADE_CA;
            $obj[] = $rs[0]->FABRICANTE_EPI;



            return json_encode($obj);
        } else {
            return false;
        }
    }

    ////

    public function carregarCodCa1($funcao) {
        
        $this->initConBanco();

        

            $query = "SELECT ID_FUNCAO FROM GP_CAD_FUNCOES WHERE FUNCAO = '$funcao' ";

            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $idFuncao = $rs1[0]->ID_FUNCAO;


            $query = "SELECT T1.ID_EPI, T1.COD_CA, T1.DESCRICAO_EPI FROM GP_CAD_EPI T1 INNER JOIN GP_EPI_QTD_FUNCAO_ITEM T2 ON T1.TIPO_EPI = T2.TIPO_EPI
                            INNER JOIN GP_EPI_QTD_FUNCAO T3 ON T3.ID_EPI_QTD_FUNCAO = T2.ID_EPI_QTD_FUNCAO
                            INNER JOIN GP_CAD_FUNCOES T4 ON T3.FUNCAO = T4.ID_FUNCAO
                            WHERE T4.ID_FUNCAO = '$idFuncao' ORDER BY T1.DESCRICAO_EPI";
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idEpi = $item->ID_EPI;
                    $codCa = $item->COD_CA;
                    $descricao = $item->DESCRICAO_EPI;
                    $html .= "<option value='$idEpi'>$codCa ($descricao)</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
            }
        
    }

    public function carregarCodCa() {

        $this->initConBanco();

        $query = "SELECT COD_CA, DESCRICAO_EPI, ID_EPI FROM GP_CAD_EPI ORDER BY COD_CA";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idEpi = $item->ID_EPI;
                $codCa = $item->COD_CA;
                $descricao = $item->DESCRICAO_EPI;
                $html .= "<option value='$idEpi'>$codCa ($descricao)</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
    }

    public function carregarTipoEpi($codCa) {

        $this->initConBanco();

        $query = "SELECT TIPO_EPI FROM GP_CAD_EPI WHERE ID_EPI = '$codCa' ";
        //print_r($query);       
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $idTipoEpi = $rs[0]->TIPO_EPI;

        $query = "SELECT EQUIPAMENTO FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = '$idTipoEpi'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            $equipamento = $rs[0]->EQUIPAMENTO;

            return $equipamento;
        } else {

            return false;
        }
    }

    public function verificarCaDigitado($numeroCa) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI WHERE COD_CA = $numeroCa";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) != null || is_array($rs) && count($rs) != "null") {
            // print_r("true");
            return true;
        } else {
            // print_r("false");
            return false;
        }
    }

    public function carregarFuncionario() {

        $this->initConBanco();


        $query = "SELECT * FROM GP_CAD_FUNCIONARIO";


        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idFuncionario = $item->ID_FUNCIONARIO;
                $nomeFuncionario = $item->NOME_FUNCIONARIO;
                $html .= "<option value='$idFuncionario'>$nomeFuncionario</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Funcionário Cadastrado</option>";
        }
    }

    public function carregarDadosFuncionario($idFuncionario) {

        $this->initConBanco();


        $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $idFuncionario";
        //print_r($query);

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $funcao = $rs[0]->FUNCAO;
        $setor = $rs[0]->SETOR;

        $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();

        $descFuncao = $rs1[0]->FUNCAO;

        $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

        $cs = $this->conBanco->query($query);
        $rs2 = $cs->result();

        $descSetor = $rs2[0]->SETOR;


        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $descSetor;
            $obj[] = $descFuncao;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            


            return json_encode($obj);
        } else {

            return false;
        }
    }

    public function carregarDataAtual() {

        $dataAtual = date('d/m/Y');

        return $dataAtual;
    }

    public function getItemLancamentoEditarEd($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id' ORDER BY ID_EPI_ENT_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = $totalSalvo;

        $s = 0;

        $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar ED</td>
                    <td  style='width: 25%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                    <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>QTD</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Data</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Lançamento</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Nº Bloco</td>
                    
                  
                    
              </tr>";

        for ($i = $i; $i < $totalGeral; $i++) {

            //print_r($i);exit();

            $id = $i;
            $j = $i + 1;



            $codCa = $j;
            $codCa .= "_";
            $codCa .= $j;

            $tipoEpi = $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;

            $qtdEpi = $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;

            $estadoEpi = $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;

            $dataEpi = $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            
            $blocoEpi = $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            
            $lancamento = $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;



            $codCaValor = $rs[$s]->COD_CA;
            // print_r("1"); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $blocoEpiValor = $rs[$s]->BLOCO_EPI;
            $lancamentoValor = $rs[$s]->TIPO_LANCAMENTO;
            
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;
            

            $s = $s + 1;

            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCaValor'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $descricaoCodCa = $rs1[0]->COD_CA;
            
            
            if($estadoEpiValor == "H"){
                
                $estadoEpiValor = "HIGIENIZADO";
                
            }else{
                
                $estadoEpiValor = "NOVO";
            }
            
            if($lancamentoValor == "D"){
                
                $blocoEpiValor = "SEM NÚMERO";
                
            }
            
            if($lancamentoValor == "D"){
                
                $lancamentoValor = "DIRETO";
                
            }else{
                
                $lancamentoValor = "EM BLOCO";
            }
            
            




            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 25%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$descricaoCodCa' readonly></div></td>
                    <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor'  readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$lancamento'    value='$lancamentoValor' readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$blocoEpi'    value='$blocoEpiValor' readonly ></div></td>    
                    
              </tr>";
        }


        return $html;
    }

    public function getItemLancamento($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();


        $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI_ENT = '$id'";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) == null || is_array($rs) && count($rs) == "null") {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT = '$id' ORDER BY ID_EPI_ENT_ITEM";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $i = 0;

            $s = 0;

            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Data</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Lançamento</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Nº Bloco</td>



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $codCa = $j;
                $codCa .= "_";
                $codCa .= $j;

                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $qtdEpi = $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;

                $estadoEpi = $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;

                $dataEpi = $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                
                $blocoEpi = $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                
                $lancamento = $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;





                $codCaValor = $rs[$s]->COD_CA;
                // print_r($itemValor); exit();
                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                $qtdEpiValor = $rs[$s]->QTD_EPI;
                $estadoEpiValor = $rs[$s]->N_H;
                $dataEpiValor = $rs[$s]->DATA;
                $blocoEpiValor = $rs[$s]->BLOCO_EPI;
                $lancamentoValor = $rs[$s]->TIPO_LANCAMENTO;
            
            
                $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;
                

                $s = $s + 1;

                if($estadoEpiValor == "H"){
                
                    $estadoEpiValor = "HIGIENIZADO";
                
                }else{

                    $estadoEpiValor = "NOVO";
                }
                
                 if($lancamentoValor == "D"){
                
                $blocoEpiValor = "SEM NÚMERO";
                
                }
                
                if($lancamentoValor == "D"){
                
                $lancamentoValor = "DIRETO";
                
                }else{

                    $lancamentoValor = "EM BLOCO";
                 }
                 
                




                $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' readonly ></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$lancamento'    value='$lancamentoValor' readonly ></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$blocoEpi'    value='$blocoEpiValor' readonly ></div></td>


                  </tr>";
            }


            return $html;
        } else {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' ORDER BY ID_EPI_ENT_ITEM";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $i = 0;

            $s = 0;

            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Data</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Lançamento</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Nº Bloco</td>



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $codCa = $j;
                $codCa .= "_";
                $codCa .= $j;

                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $qtdEpi = $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;
                $qtdEpi .= "_";
                $qtdEpi .= $j;

                $estadoEpi = $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;
                $estadoEpi .= "_";
                $estadoEpi .= $j;

                $dataEpi = $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                $dataEpi .= "_";
                $dataEpi .= $j;
                
                $blocoEpi = $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;
                $blocoEpi .= "_";
                $blocoEpi .= $j;


                $lancamento = $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;
                $lancamento .= "_";
                $lancamento .= $j;



                $codCaValor = $rs[$s]->COD_CA;
                // print_r($itemValor); exit();
                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                $qtdEpiValor = $rs[$s]->QTD_EPI;
                $estadoEpiValor = $rs[$s]->N_H;
                $dataEpiValor = $rs[$s]->DATA;
                $blocoEpiValor = $rs[$s]->BLOCO_EPI;
                $lancamentoValor = $rs[$s]->TIPO_LANCAMENTO;
            
            
                $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

                $s = $s + 1;

                if($estadoEpiValor == "H"){
                
                    $estadoEpiValor = "HIGIENIZADO";
                
                }else{

                    $estadoEpiValor = "NOVO";
                }


                if($lancamentoValor == "D"){
                
                $blocoEpiValor = "SEM NÚMERO";
                
                }
                
                if($lancamentoValor == "D"){
                
                $lancamentoValor = "DIRETO";
                
                }else{

                    $lancamentoValor = "EM BLOCO";
                }
                
                


                $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' readonly ></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$lancamento'    value='$lancamentoValor' readonly ></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$blocoEpi'    value='$blocoEpiValor' readonly ></div></td>


                  </tr>";
            }


            return $html;
        }
    }

    public function getEditarItemLancamento($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' ORDER BY ID_EPI_ENT_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = 0;

        $s = 0;

        $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Data</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Lançamento</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Nº Bloco</td>
                    
                  
                    
              </tr>";

        for ($i = $i; $i < $totalGeral; $i++) {

            //print_r($i);exit();

            $id = $i;
            $j = $i + 1;



            $codCa = $j;
            $codCa .= "_";
            $codCa .= $j;

            $tipoEpi = $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;

            $qtdEpi = $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;

            $estadoEpi = $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;

            $dataEpi = $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;

            $blocoEpi = $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;

            $lancamento = $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;



            $codCaValor = $rs[$s]->COD_CA;
            // print_r($itemValor); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $blocoEpiValor = $rs[$s]->BLOCO_EPI;
            $lancamentoValor = $rs[$s]->TIPO_LANCAMENTO;
            
            
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

            $s = $s + 1;

            if($estadoEpiValor == "H"){
                
                $estadoEpiValor = "HIGIENIZADO";
                
            }else{
                
                $estadoEpiValor = "NOVO";
            }

            if($lancamentoValor == "D"){
                
                $blocoEpiValor = "SEM NÚMERO";
                
            }
            
            if($lancamentoValor == "D"){
                
                $lancamentoValor = "DIRETO";
                
            }else{
                
                $lancamentoValor = "EM BLOCO";
            }
            
            
            

//            
            //print_r($valorCodProduto);
            //print_r($valorSequencia); exit();

            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamentoEd($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 25%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                    <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$lancamento'    value='$lancamentoValor' readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$blocoEpi'    value='$blocoEpiValor' readonly ></div></td>
                  
                    
              </tr>";
        }


        return $html;
    }

    public function getEditarItemLancamentoEd($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' ORDER BY ID_EPI_ENT_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = 0;

        $s = 0;

        $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Data</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Lançamento</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Nº Bloco</td>
                    
                  
                    
              </tr>";

        for ($i = $i; $i < $totalGeral; $i++) {

            //print_r($i);exit();

            $id = $i;
            $j = $i + 1;



            $codCa = $j;
            $codCa .= "_";
            $codCa .= $j;

            $tipoEpi = $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;

            $qtdEpi = $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;

            $estadoEpi = $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;

            $dataEpi = $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;

            $blocoEpi = $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;

            $lancamento = $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;


            $codCaValor = $rs[$s]->COD_CA;
            // print_r($itemValor); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $blocoEpiValor = $rs[$s]->BLOCO_EPI;
            $lancamentoValor = $rs[$s]->TIPO_LANCAMENTO;
            
            
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

            $s = $s + 1;

            if($lancamentoValor == "D"){
                
                $blocoEpiValor = "SEM NÚMERO";
                
            }

            
            if($lancamentoValor == "D"){
                
                $lancamentoValor = "DIRETO";
                
            }else{
                
                $lancamentoValor = "EM BLOCO";
            }
            
            
            

//            
            //print_r($valorCodProduto);
            //print_r($valorSequencia); exit();

            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamentoEd($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 25%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                    <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor'  readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$lancamento'    value='$lancamentoValor' readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$blocoEpi'    value='$blocoEpiValor' readonly ></div></td>
                  
                    
              </tr>";
        }


        return $html;
    }

    public function getItemLancamentoEditar($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_ENT_ITEM_BLOCO_TEMP WHERE ID_EPI_ENT =  '$id' ORDER BY ID_EPI_ENT_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = $totalSalvo;

        $s = 0;

        $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 25%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Data</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Lançamento</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Nº Bloco</td>
                    
                  
                    
              </tr>";

        for ($i = $i; $i < $totalGeral; $i++) {

            //print_r($i);exit();

            $id = $i;
            $j = $i + 1;



            $codCa = $j;
            $codCa .= "_";
            $codCa .= $j;

            $tipoEpi = $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;
            $tipoEpi .= "_";
            $tipoEpi .= $j;

            $qtdEpi = $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;
            $qtdEpi .= "_";
            $qtdEpi .= $j;

            $estadoEpi = $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;
            $estadoEpi .= "_";
            $estadoEpi .= $j;

            $dataEpi = $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;
            $dataEpi .= "_";
            $dataEpi .= $j;

            $blocoEpi = $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;
            $blocoEpi .= "_";
            $blocoEpi .= $j;


            $lancamento = $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;
            $lancamento .= "_";
            $lancamento .= $j;

            $codCaValor = $rs[$s]->COD_CA;
            // print_r("1"); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $blocoEpiValor = $rs[$s]->BLOCO_EPI;
            $lancamentoValor = $rs[$s]->TIPO_LANCAMENTO;
            
            
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

            $s = $s + 1;


            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCaValor'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $descricaoCodCa = $rs1[0]->COD_CA;


            if($lancamentoValor == "D"){
                
                $blocoEpiValor = "SEM NÚMERO";
                
            }
            
            if($lancamentoValor == "D"){
                
                $lancamentoValor = "DIRETO";
                
            }else{
                
                $lancamentoValor = "EM BLOCO";
            }
            
            
            
            
            
            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 25%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$descricaoCodCa' readonly></div></td>
                    <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor'  readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$lancamento'    value='$lancamentoValor' readonly ></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$blocoEpi'    value='$blocoEpiValor' readonly ></div></td>
                    
                  
                    
              </tr>";
        }


        return $html;
    }

    public function editarItemLancamentoTemporario($idLancamentoItem, $id) {

        $this->initConBanco();


        $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem' ";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            $obj[] = $rs[0]->COD_CA;
            $obj[] = $rs[0]->TIPO_EPI;
            $obj[] = $rs[0]->QTD_EPI;
            $obj[] = $rs[0]->N_H;
            $obj[] = $rs[0]->DATA;
            $obj[] = $rs[0]->TIPO_LANCAMENTO;
            $obj[] = $rs[0]->BLOCO_EPI;



//        $this->initConLogix();
//        
//            $query = "SELECT * FROM ITEM  WHERE DEN_ITEM = '$idItem'";
//            //print_r($query); exit();
//            $cs = $this->conLogix->query($query);
//            $rs = $cs->result();
//
//            $obj[] = $rs[0]->DEN_ITEM;
//            


            return json_encode($obj);
        } else {
            return 2;
        }
    }

    public function editarItemLancamento($idLancamentoItem, $id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem'";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $codCa = $rs[0]->COD_CA;

                $query = "SELECT ID_EPI FROM GP_CAD_EPI WHERE COD_CA = '$codCa'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $descricaoCodCa = $rs1[0]->ID_EPI;
                //            
                $obj[] = $descricaoCodCa;
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QTD_EPI;
                $obj[] = $rs[0]->N_H;
                $obj[] = $rs[0]->DATA;
                $obj[] = $rs[0]->TIPO_LANCAMENTO;
                $obj[] = $rs[0]->BLOCO_EPI;

                return json_encode($obj);
            } else {

                return 2;
            }
        } else {


            $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $codCa = $rs[0]->COD_CA;

                $query = "SELECT ID_EPI FROM GP_CAD_EPI WHERE COD_CA = '$codCa'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $descricaoCodCa = $rs1[0]->ID_EPI;
                //            
                $obj[] = $descricaoCodCa;
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QTD_EPI;
                $obj[] = $rs[0]->N_H;
                $obj[] = $rs[0]->DATA;
                $obj[] = $rs[0]->TIPO_LANCAMENTO;
                $obj[] = $rs[0]->BLOCO_EPI;
                //          
                return json_encode($obj);
            } else {

                return 2;
            }
        }
    }

    public function editarItemLancamentoEd($idLancamentoItem, $id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem'";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $query = "SELECT * FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $codCa = $rs[0]->COD_CA;

                $query = "SELECT ID_EPI FROM GP_CAD_EPI WHERE COD_CA = '$codCa'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $descricaoCodCa = $rs1[0]->ID_EPI;
                //            
                $obj[] = $descricaoCodCa;
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QTD_EPI;
                $obj[] = $rs[0]->N_H;
                $obj[] = $rs[0]->DATA;
                $obj[] = $rs[0]->TIPO_LANCAMENTO;
                $obj[] = $rs[0]->BLOCO_EPI;
                
                return json_encode($obj);
            } else {

                return 2;
            }
        } else {


            $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT = '$id' AND ID_EPI_ENT_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $codCa = $rs[0]->COD_CA;

                $query = "SELECT ID_EPI FROM GP_CAD_EPI WHERE COD_CA = '$codCa'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                $descricaoCodCa = $rs1[0]->ID_EPI;
                //            
                $obj[] = $descricaoCodCa;
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QTD_EPI;
                $obj[] = $rs[0]->N_H;
                $obj[] = $rs[0]->DATA;
                $obj[] = $rs[0]->TIPO_LANCAMENTO;
                $obj[] = $rs[0]->BLOCO_EPI;

                return json_encode($obj);
            } else {

                return 2;
            }
        }
    }

    public function excluirLancamentoModalEd($codCaEd, $id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCaEd'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();

        $descricaoCodCa = $rs1[0]->COD_CA;

        $query = "DELETE FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

        //print_r($query);//exit();

        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            return true;
        } else {

            return false;
        }
    }

    public function excluirLancamentoModalEdEd($codCaEdEd, $id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCaEdEd'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();

        $descricaoCodCa = $rs1[0]->COD_CA;

        $query = "DELETE FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

        //print_r($query);exit();

        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id' AND COD_CA = '$descricaoCodCa'";

            //print_r($query);exit();

            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function salvarItensLancamentos($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        //////// VALIDAR CAMPO EM BLOCO OU DIRETO
        
        if($estadoEpi == "NOVO"){
            $estadoEpi = "N";
        }else{
            $estadoEpi = "H";
        }
        
        if ($tipoLancamento == "DIRETO") {

            $tipoLancamento = "D";
        } else {

            $tipoLancamento = "B";
        }

        $query = "SELECT * FROM GP_EPI_ENT_ITEM  WHERE ID_EPI_ENT = '$id' AND COD_CA = '$codCa'";

        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

        if (is_array($rs) && count($rs) > 0) {





            $query = "UPDATE GP_EPI_ENT_ITEM SET COD_CA = '$codCa', TIPO_EPI = '$tipoEpi', QTD_EPI = '$qtdEpi', N_H = '$estadoEpi', DATA = '$dataEpi', BLOCO_EPI = '$blocoEpi', TIPO_LANCAMENTO = '$tipoLancamento', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT '%$id%' AND  COD_CA = '$codCa'";

            print_r($query);//exit();
            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {
                //                
                return true; 
                //               
            } else {
                return false;
            }
        } else {

            $query = "SELECT MAX(ID_EPI_ENT_ITEM) AS ID_EPI_ENT_ITEM FROM GP_EPI_ENT_ITEM";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (count($rs) == 0) {
                $novoId = 1;
            } else {
                $novoId = $rs[0]->ID_EPI_ENT_ITEM + 1;
            }
  


            $query = "INSERT INTO GP_EPI_ENT_ITEM (ID_EPI_ENT, ID_EPI_ENT_ITEM, COD_CA, TIPO_EPI, QTD_EPI, N_H, DATA, BLOCO_EPI, TIPO_LANCAMENTO, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$codCa', '$tipoEpi', '$qtdEpi', '$estadoEpi', '$dataEpi', '$blocoEpi', '$tipoLancamento', SYSDATE, '$usuarioLogado')";

            print_r($query); //exit();
            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {
                //                
                return true;
            } else {
                return false;
            }
        }
    }

    public function editarLancamento($id) {

        $this->initConBanco();



        $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI_ENT = '$id'";


        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();



        if (is_array($rs) && count($rs) > 0) {


            $obj[] = $rs[0]->ID_EPI_ENT;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->FUNCAO;
            
            $obj[] = $rs[0]->DATA_ADMISSAO;



            return json_encode($obj);
        } else {
            return false;
        }
    }

    public function excluirDadosTemp() {
        //print_r("EXCLUIR");exit();
        $this->initConBanco();

        $query = "DELETE GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT >= 1";
        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT >= 1";

            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {


                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getNumeroLinhas($id) {

        $this->initConBanco();

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT = '$id'";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $totalTemp = $rs[0]->TOTAL;



            $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_ENT_ITEM WHERE ID_EPI_ENT = '$id'";

            //print_r($query);exit();

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $totalSalvo = $rs[0]->TOTAL;

            $total = $totalTemp + $totalSalvo;
            //print_r($total); exit();
            return $total;
        } else {
            return false;
        }
    }
    
    public function verificarQuantidadePermitida($tipoEpi, $funcao) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        $query = "SELECT ID_FUNCAO FROM GP_CAD_FUNCOES  WHERE FUNCAO = '$funcao' ";
        //print_r($query);exit();
        $cs1 = $this->conBanco->query($query);
        $rs1 = $cs1->result();

        $idFuncao = $rs1[0]->ID_FUNCAO;
        
        $query = "SELECT ID_EPI_TIPO FROM GP_CAD_EPI_TIPO WHERE EQUIPAMENTO = '$tipoEpi' ";
        //print_r($query);exit();
        $cs2 = $this->conBanco->query($query);
        $rs2 = $cs2->result();

        $idEpiTipo = $rs2[0]->ID_EPI_TIPO;

        //$query = "SELECT QUANTIDADE FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$idFuncao' AND TIPO_EPI = '$idEpiTipo'";
        $query = "SELECT T2.QUANTIDADE FROM GP_EPI_QTD_FUNCAO T1 INNER JOIN GP_EPI_QTD_FUNCAO_ITEM T2 ON T1.ID_EPI_QTD_FUNCAO = T2.ID_EPI_QTD_FUNCAO
                        WHERE T1.FUNCAO = '$idFuncao' AND T2.TIPO_EPI = '$idEpiTipo'";
        //print_r($query);//exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {
            
            $quantidade = $rs[0]->QUANTIDADE;

            return $quantidade;
        }else {
            
            return false;
        }
    }
    
    
    
    //////// IMPRESSAO
    
    
    
    public function getPdf($id, $idFuncionario) {

        $dataAtualizada = date('d/m/Y');

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $idFuncionario ";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;
        $dataNasc = $rs[0]->DATA_NASC;
        $setor = $rs[0]->SETOR;
        $funcao = $rs[0]->FUNCAO;
        $matricula = $rs[0]->MATRICULA;
        $cpf = $rs[0]->CPF;
        $ctps = $rs[0]->CTPS;     
        $serieCtps = $rs[0]->SERIE_CTPS; 
        $pisPasep = $rs[0]->PIS_PASEP; 
        
        $query = "SELECT * FROM GP_CAD_FUNCOES  WHERE ID_FUNCAO = $funcao ";
        //print_r($query);exit();
        $cs1 = $this->conBanco->query($query);
        $rs1 = $cs1->result();

        $descFuncao = $rs1[0]->FUNCAO;
        
        $query = "SELECT * FROM GP_CAD_SETOR WHERE ID_SETOR = $setor ";
        //print_r($query);exit();
        $cs2 = $this->conBanco->query($query);
        $rs2 = $cs2->result();

        $descSetor = $rs2[0]->SETOR;
        

        $html = "";
        $html .= "<table align='center'cellspacing='0'; cellpadding ='9'; style='width: 100%; border: 1 solid #000000;'>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'border: 1 solid #000000; padding-top: 10px; padding-botton: 5px; width: 50%; font-size: 30px; color: #000000;' align='center'><br>DECLARAÇÃO DE ENTREGA DE EPI<br><br></td>";
        $html .=" </tr>";                               
        
        $html .="<tr>";
        $html .="<td  colspan = '7' align='left' style= 'width: 100%; height: 150px; font-size: 28px; color: #000000; border: 1 solid #000000;' ><b>Funcionário:</b> $nomeFuncionario &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<b>Data Nascimento:</b> $dataNasc<br><br>"
                . "<b>Setor:</b> $descSetor&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>Função:</b> $descFuncao &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>Matrícula:</b> $matricula<br><br>"
                . "<b>CPF:</b> $cpf &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>CTPS:</b> $ctps - Série: $serieCtps&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>PIS/PASEP:</b> $pisPasep</td><br><br>";
        
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= ' padding-top: 10px; padding-botton: 5px; width: 50%; font-size: 30px; color: #000000;' align='center'><br>DECLARO QUE<br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; font-size: 26px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;1 - Recebi da empresa Sulcatarinense M.A.C.B.C. Ltda. os equipamentos de proteção individual - EPI, nas "
                . "                                                                                                                           datas aqui resgistradas, os quais desde já me comprometo a usá-los na execução de minhas atividades e tarefas, zelando"
                . "                                                                                                                           pela sua perfeita guarda, conservação, uso e funcionamento."
                . "                                                                                                                           Assumindo também o compromisso de devolvê-los quando solicitados ou por ocasião de recisão de contrato de trabalho.<br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; font-size: 26px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;2 - O descumprimento dos termos aqui estabelecidos, importará em ato faltoso do empregado, com aplicação de penalidades, "
                . "                                                                                                                           que a critério do empregador, poderão variar de advertência, por escrito à recisão do contrato de trabalho por justa causa, independente "
                . "                                                                                                                            de outras medidas de orgem jurídica aplicáveis com base especialmente no artigo 158 da CLT e NR-01 da portaria do MTE nº 3214/78(1.8 e 1.8..1).<br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; font-size: 26px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;3 - No caso de perda, dano, extravio, ou avaria dos equipamentos referidos no item 1, autorizo desde já a dedução, do valor correspondente ao EPI, do"
                . "                                                                                                                           meu salário.<br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; font-size: 26px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;4 - Declaro que os equipamentos que recebi estão em perfeitas condições e que utilizo conforme as normas de segurança e treinamento realizados pela Empresa"
                . "                                                                                                                           Sulcatarinense M.A.C.B.C Ltda.<br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; border-bottom: 1 solid #000000;font-size: 26px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;5 - Declaro ainda ter recebido treinamento referente ao uso, guarda, conservação e funcionamento do EPI, estando Apto para usá-los."
                . "                                                                                                                           Sulcatarinense M.A.C.B.C Ltda.<br></td>";
        $html .="</tr>";
        
        
        $html .="<tr>";
        $html .="<td colspan = '7' style= ' padding-top: 10px; padding-botton: 5px; width: 50%; font-size: 30px; color: #000000;' align='center'><br>DESCRIÇÃO DOS EPI'S FORNECIDOS<br><br></td>";
        $html .="</tr>";
        $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                $html .= "<td  style = 'text-transform: uppercase; width: 5%; font-size: 22px;' align = 'left'><b>Nº</b></td>";
                $html .= "<td  style = 'text-transform: uppercase; width: 15%; font-size: 22px;' align = 'left'><b>CÓDIGO C.A.</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 22px;' align = 'left'><b>TIPO EPI</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 22px;' align = 'left'><b>QUANTIDADE</b></td>";
                $html .= "<td  style = 'width: 3%; font-size: 22px;' align = 'left'><b>&nbsp;&nbsp;ESTADO EPI</b></td>";
                $html .= "<td  style = 'width: 5%; font-size: 22px;' align = 'left'>&nbsp;&nbsp;<b>DATA RECEBIMENTO</b></td>";
                $html .= "<td  style = 'width: 5%; font-size: 22px;' align = 'left'>&nbsp;&nbsp;<b>BLOCO REGISTRO</b></td>";
                $html .= "</tr>";
        
               
        
        $query = " SELECT T1.ID_EPI_ENT_ITEM, T1.COD_CA, T1.TIPO_EPI, T1.QTD_EPI, T1.N_H, T1.DATA, T1.BLOCO_EPI FROM GP_EPI_ENT_ITEM T1 INNER JOIN GP_EPI_ENT T2
                        ON T1.ID_EPI_ENT = T2.ID_EPI_ENT WHERE T2.FUNCIONARIO = '$idFuncionario' AND T2.ID_EPI_ENT = $id ";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $estadoEpi = $item->N_H;
                if ($estadoEpi == "N"){
                    $estadoEpi = "NOVO";
                }else{
                    $estadoEpi = "HIGIENIZADO";
                }
        

                $html .= "<tr class = 'linhaOc' style = 'width:100%;'>";
                $html .= "<td  style = 'text-transform: uppercase; width: 5%; font-size: 22px;' align = 'left'>$item->ID_EPI_ENT_ITEM</td>";
                $html .= "<td  style = 'text-transform: uppercase; width: 15%; font-size: 22px;' align = 'left'>$item->COD_CA</td>";
                $html .= "<td  style = 'width: 3%; font-size: 22px;' align = 'left'>$item->TIPO_EPI</td>";
                $html .= "<td  style = 'width: 3%; font-size: 22px;' align = 'left'>$item->QTD_EPI</td>";
                $html .= "<td  style = 'width: 3%; font-size: 22px;' align = 'left'>&nbsp;&nbsp;$estadoEpi</td>";
                $html .= "<td  style = 'width: 5%; font-size: 22px;' align = 'left'>&nbsp;&nbsp;$item->DATA</td>";
                $html .= "<td  style = 'width: 5%; font-size: 22px;' align = 'left'>&nbsp;&nbsp;$item->BLOCO_EPI</td>";
                $html .= "</tr>";
                
            }
        }
        
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; border-bottom: 1 solid #000000;font-size: 30px; color: #000000;'  align='left'><br><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '7' style= 'width: 100%; font-size: 30px; color: #000000;'  align='left'></td>";
        $html .="</tr>";
        
        $html .="<tr>";
        $html .="<td colspan = '3' style= 'text-transform: uppercase; font-size: 23px; color: #000000;'  align='center'>Biguaçu, $dataAtualizada</td>";
        $html .="<td colspan = '4' style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'><br><br><br><br><br><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '3' style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'>&nbsp;&nbsp;&nbsp;Assinatura: ($nomeFuncionario)&nbsp;&nbsp;&nbsp;</td>";
        $html .="<td colspan = '4' style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'>&nbsp;&nbsp;&nbsp;(Responsável Empresa)&nbsp;&nbsp;&nbsp;</td>";
        $html .="</tr>";
        
        
        $html .="</table> ";
         
        
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


        $nomeDoArquivo = "relatorio_entregaEpi.pdf";
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
        $canvas->page_text(240, 820, "VPI TECNOLOGIA  -  CLARIFY People", $font, 6, array(0, 0, 0)); //footer 
        header("Content-type: application/pdf");
        $pdf = $dompdf->output(); // Cria o pdf 
        $nomeDoArquivo = "relatorio_entregaEpi.pdf";

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

}
