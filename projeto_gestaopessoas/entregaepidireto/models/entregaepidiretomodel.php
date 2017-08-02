<?php

class entregaepidiretomodel extends CI_Model {

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

    public function salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi) {
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

                $query = "UPDATE GP_EPI_ENT_ITEM_TEMP SET COD_CA = '$descricaoCodCa', TIPO_EPI = '$tipoEpi', QTD_EPI = '$qtdEpi', N_H = '$estadoEpi', DATA = '$dataEpi', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT LIKE '%$id%' AND COD_CA = '$descricaoCodCa'";

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


                $query = "INSERT INTO GP_EPI_ENT_ITEM_TEMP (ID_EPI_ENT, ID_EPI_ENT_ITEM, COD_CA, TIPO_EPI, QTD_EPI, N_H, DATA, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$descricaoCodCa', '$tipoEpi', '$qtdEpi', '$estadoEpi', '$dataEpi', SYSDATE, '$usuarioLogado')";

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

                $query = "UPDATE GP_EPI_ENT_ITEM SET COD_CA = '$descricaoCodCa', TIPO_EPI = '$tipoEpi', QTD_EPI = '$qtdEpi', N_H = '$estadoEpi', DATA = '$dataEpi', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT LIKE '%$id%' AND COD_CA = '$descricaoCodCa'";

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


                $query = "INSERT INTO GP_EPI_ENT_ITEM (ID_EPI_ENT, ID_EPI_ENT_ITEM, COD_CA, TIPO_EPI, QTD_EPI, N_H, DATA, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$descricaoCodCa', '$tipoEpi', '$qtdEpi', '$estadoEpi', '$dataEpi', SYSDATE, '$usuarioLogado')";

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

    public function buscaPrimeiroRegistro() {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI ORDER BY ID_EPI";

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

    public function buscaUltimoRegistro() {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI ORDER BY ID_EPI";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        $cont = count($rs) - 1;

        if (is_array($rs) && count($rs) > 0) {



            $obj[] = $rs[$cont]->ID_EPI;
            $obj[] = $rs[$cont]->COD_CA;
            $obj[] = $rs[$cont]->TIPO_EPI;
            $obj[] = $rs[$cont]->DESCRICAO_EPI;
            $obj[] = $rs[$cont]->VALIDADE_CA;
            $obj[] = $rs[$cont]->FABRICANTE_EPI;


            return json_encode($obj);
        } else {
            return false;
        }
    }

    public function buscaRegistroAnterior($idEpi) {

        $this->initConBanco();

        $cont = 1;

        for ($i = 0; $i < 10; $i++) {

            $idProcura = $idEpi - $cont;

            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI =  $idProcura";

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
            }
            $cont++;
        }
    }

    public function buscaRegistroProximo($idEpi) {

        $this->initConBanco();

        $cont = 1;

        for ($i = 0; $i < 10; $i++) {

            $idProcura = $idEpi + $cont;

            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI =  $idProcura";

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
            }
            $cont++;
        }
    }

    public function pesquisaSimples($idInicial, $nomeInicial) {

        $this->initConBanco();

        if ($idInicial == "" || $idInicial == null) {

            $query = "SELECT * FROM GP_CAD_EPI WHERE COD_CA LIKE '%$nomeInicial%'";

            //print_r($query);exit();
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
        } else {
            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI LIKE  '%$idInicial%'";

            //print_r($query);exit();
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

    public function carregarCodCa() {

        $this->initConBanco();

        $query = "SELECT COD_CA, ID_EPI FROM GP_CAD_EPI ORDER BY COD_CA";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idEpi = $item->ID_EPI;
                $codCa = $item->COD_CA;
                $html .= "<option value='$idEpi'>$codCa</option>";
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
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>QTD</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Data</td>
                    
                  
                    
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



            $codCaValor = $rs[$s]->COD_CA;
            // print_r("1"); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
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




            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$descricaoCodCa' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' onclick='alteraItem($j)' readonly ></div></td>
                    
                  
                    
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
                        <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Data</td>



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



                $codCaValor = $rs[$s]->COD_CA;
                // print_r($itemValor); exit();
                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                $qtdEpiValor = $rs[$s]->QTD_EPI;
                $estadoEpiValor = $rs[$s]->N_H;
                $dataEpiValor = $rs[$s]->DATA;
                $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

                $s = $s + 1;

                if($estadoEpiValor == "H"){
                
                    $estadoEpiValor = "HIGIENIZADO";
                
                }else{

                    $estadoEpiValor = "NOVO";
                }




                $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                        <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' onclick='alteraItem($j)' readonly ></div></td>



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
                        <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>QTD</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Data</td>



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



                $codCaValor = $rs[$s]->COD_CA;
                // print_r($itemValor); exit();
                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                $qtdEpiValor = $rs[$s]->QTD_EPI;
                $estadoEpiValor = $rs[$s]->N_H;
                $dataEpiValor = $rs[$s]->DATA;
                $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

                $s = $s + 1;

                if($estadoEpiValor == "H"){
                
                    $estadoEpiValor = "HIGIENIZADO";
                
                }else{

                    $estadoEpiValor = "NOVO";
                }





                $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                        <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' onclick='alteraItem($j)' readonly ></div></td>



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
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>QTD</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Data</td>
                    
                  
                    
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



            $codCaValor = $rs[$s]->COD_CA;
            // print_r($itemValor); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

            $s = $s + 1;

            if($estadoEpiValor == "H"){
                
                $estadoEpiValor = "HIGIENIZADO";
                
            }else{
                
                $estadoEpiValor = "NOVO";
            }



//            
            //print_r($valorCodProduto);
            //print_r($valorSequencia); exit();

            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamentoEd($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' onclick='alteraItem($j)' readonly ></div></td>
                    
                  
                    
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
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>QTD</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Data</td>
                    
                  
                    
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



            $codCaValor = $rs[$s]->COD_CA;
            // print_r($itemValor); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

            $s = $s + 1;




//            
            //print_r($valorCodProduto);
            //print_r($valorSequencia); exit();

            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamentoEd($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$codCaValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' onclick='alteraItem($j)' readonly ></div></td>
                    
                  
                    
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

        $query = "SELECT * FROM GP_EPI_ENT_ITEM_TEMP WHERE ID_EPI_ENT =  '$id' ORDER BY ID_EPI_ENT_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = $totalSalvo;

        $s = 0;

        $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>C.A.</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Tipo de EPI</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>QTD</td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>N/H</td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Data</td>
                    
                  
                    
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



            $codCaValor = $rs[$s]->COD_CA;
            // print_r("1"); exit();
            $tipoEpiValor = $rs[$s]->TIPO_EPI;
            $qtdEpiValor = $rs[$s]->QTD_EPI;
            $estadoEpiValor = $rs[$s]->N_H;
            $dataEpiValor = $rs[$s]->DATA;
            $idLancamentoItem = $rs[$s]->ID_EPI_ENT_ITEM;

            $s = $s + 1;


            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = '$codCaValor'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $descricaoCodCa = $rs1[0]->COD_CA;


            $html .="<tr  style='width: 90%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idLancamentoItem)' readonly ></button></div></td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$codCa'   value='$descricaoCodCa' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'  value='$tipoEpiValor' readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$qtdEpi'   value='$qtdEpiValor'   readonly></div></td>
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$estadoEpi'   value='$estadoEpiValor'   readonly></div></td>    
                    <td  style='width: 15%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$dataEpi'    value='$dataEpiValor' onclick='alteraItem($j)' readonly ></div></td>
                    
                  
                    
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

    public function salvarItensLancamentos($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();



        $query = "SELECT * FROM GP_EPI_ENT_ITEM  WHERE ID_EPI_ENT = '$id' AND COD_CA = '$codCa'";

        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

        if (is_array($rs) && count($rs) > 0) {





            $query = "UPDATE GP_EPI_ENT_ITEM SET COD_CA = '$codCa', TIPO_EPI = '$tipoEpi', QTD_EPI = '$qtdEpi', N_H = '$estadoEpi', DATA = '$dataEpi', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_ENT '%$id%' AND  COD_CA = '$codCa'";

            //print_r($query);//exit();
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



            $query = "INSERT INTO GP_EPI_ENT_ITEM (ID_EPI_ENT, ID_EPI_ENT_ITEM, COD_CA, TIPO_EPI, QTD_EPI, N_H, DATA, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$codCa', '$tipoEpi', '$qtdEpi', '$estadoEpi', '$dataEpi', SYSDATE, '$usuarioLogado')";

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



            $centroCusto = $rs[0]->CENTRO_CUSTO;

            if ($centroCusto == null) {
                $centroCusto = "SEM CENTRO DE CUSTO";
            }


            $obj[] = $rs[0]->ID_EPI_ENT;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $centroCusto;
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

}
