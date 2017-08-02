<?php

class quantidadeepifuncaomodel extends CI_Model {

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

        $query = "SELECT max(ID_EPI_QTD_FUNCAO) AS ID FROM  GP_EPI_QTD_FUNCAO";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) > 0) {
            $novoIdUsuario = $rs[0]->ID + 1;
        } else {
            $novoIdUsuario = 1;
        }

        return $novoIdUsuario;
    }

    public function salvar($id, $idFuncao) {

        $this->initConBanco();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO  WHERE FUNCAO = '$idFuncao'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $query = "UPDATE GP_EPI_QTD_FUNCAO SET FUNCAO  = '$idFuncao', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE FUNCAO = '$idFuncao'";

            $resultado = $this->conBanco->query($query);

            if ($resultado == true) {
                return true;
            } else {
                return false;
            }
        } else {



            $query = "INSERT INTO GP_EPI_QTD_FUNCAO (ID_EPI_QTD_FUNCAO, FUNCAO, DATA_CADASTRO, USUARIO_CADASTRO)
                            VALUES ($id,'$idFuncao', SYSDATE, '$usuarioLogado')";


            $resultado = $this->conBanco->query($query);

            if ($resultado == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    

    public function salvarLancamento($id, $tipoEpi, $quantidade, $durabilidade) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

        
        

///// CONSULTA PRA VERIFICAR SE O ID JA ESTA SALVO NA TABELA MAE        
        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO WHERE ID_EPI_QTD_FUNCAO = '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


///// SE O ID NAO ESTIVER SALVO, VAI SALVAR OS FILHOS NA TABELA ITEM TEMP     
        if (is_array($rs) && count($rs) == null) {

            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP  WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi'";

            //print_r($query);//exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GP_EPI_QTD_FUNCAO_ITEM_TEMP SET TIPO_EPI = '$tipoEpi', QUANTIDADE = '$quantidade', DURABILIDADE = '$durabilidade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_QTD_FUNCAO LIKE '%$id%' AND TIPO_EPI = '$tipoEpi'";

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

                $query = "SELECT MAX(ID_FUNCAO_ITEM) AS ID_FUNCAO_ITEM FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_FUNCAO_ITEM + 1;
                }


                $query = "INSERT INTO GP_EPI_QTD_FUNCAO_ITEM_TEMP (ID_EPI_QTD_FUNCAO, ID_FUNCAO_ITEM, TIPO_EPI, QUANTIDADE, DURABILIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$tipoEpi', '$quantidade', '$durabilidade', SYSDATE, '$usuarioLogado')";

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
            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM  WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GP_EPI_QTD_FUNCAO_ITEM SET TIPO_EPI = '$tipoEpi', QUANTIDADE = '$quantidade', DURABILIDADE = '$durabilidade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_QTD_FUNCAO LIKE '%$id%' AND TIPO_EPI = '$tipoEpi'";

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

                $query = "SELECT MAX(ID_FUNCAO_ITEM) AS ID_FUNCAO_ITEM FROM GP_EPI_QTD_FUNCAO_ITEM";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_FUNCAO_ITEM + 1;
                }


                $query = "INSERT INTO GP_EPI_QTD_FUNCAO_ITEM (ID_EPI_QTD_FUNCAO, ID_FUNCAO_ITEM, TIPO_EPI, QUANTIDADE, DURABILIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$tipoEpi', '$quantidade', '$durabilidade', SYSDATE, '$usuarioLogado')";

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
    
    public function salvarLancamentoEd($id, $tipoEpi, $quantidade, $durabilidade) {
        //print_r($tipoEpi);//exit();
        $this->initConBanco();

        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        
///// CONSULTA PRA VERIFICAR SE O ID JA ESTA SALVO NA TABELA MAE        
        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO WHERE ID_EPI_QTD_FUNCAO = '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


///// SE O ID NAO ESTIVER SALVO, VAI SALVAR OS FILHOS NA TABELA ITEM TEMP     
        if (is_array($rs) && count($rs) == null) {

            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP  WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi'";

            //print_r($query);//exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GP_EPI_QTD_FUNCAO_ITEM_TEMP SET TIPO_EPI = '$tipoEpi', QUANTIDADE = '$quantidade', DURABILIDADE = '$durabilidade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_QTD_FUNCAO LIKE '%$id%' AND TIPO_EPI = '$tipoEpi'";

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

                $query = "SELECT MAX(ID_FUNCAO_ITEM) AS ID_FUNCAO_ITEM FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_FUNCAO_ITEM + 1;
                }


                $query = "INSERT INTO GP_EPI_QTD_FUNCAO_ITEM_TEMP (ID_EPI_QTD_FUNCAO, ID_FUNCAO_ITEM, TIPO_EPI, QUANTIDADE, DURABILIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$tipoEpi', '$quantidade', '$durabilidade', SYSDATE, '$usuarioLogado')";

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
            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM  WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GP_EPI_QTD_FUNCAO_ITEM SET TIPO_EPI = '$tipoEpi', QUANTIDADE = '$quantidade', DURABILIDADE = '$durabilidade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_QTD_FUNCAO LIKE '%$id%' AND TIPO_EPI = '$tipoEpi'";

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

                $query = "SELECT MAX(ID_FUNCAO_ITEM) AS ID_FUNCAO_ITEM FROM GP_EPI_QTD_FUNCAO_ITEM";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_FUNCAO_ITEM + 1;
                }


                $query = "INSERT INTO GP_EPI_QTD_FUNCAO_ITEM (ID_EPI_QTD_FUNCAO, ID_FUNCAO_ITEM, TIPO_EPI, QUANTIDADE, DURABILIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$tipoEpi', '$quantidade', '$durabilidade', SYSDATE, '$usuarioLogado')";

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

        $query = "DELETE FROM GP_EPI_QTD_FUNCAO WHERE ID_EPI_QTD_FUNCAO = $id";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = $id";

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

    

    public function getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncaoFiltro) {

        //     print_r("teste"); exit();
        $this->initConBanco();


        $count = $this->getCountGrid();

        $grid = array();

        $grid['draw'] = $draw; // mecanismo de conformidade
        $grid['recordsTotal'] = $count; // total de registros 
        $grid['recordsFiltered'] = $count; // tota de registros filtrados


        $data = array();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO WHERE 1 = 1 ";

        if ($idFuncaoFiltro != 0 || $idFuncaoFiltro != "0") {
            $query .= "AND FUNCAO = '$idFuncaoFiltro'";
        }

        $query .= "ORDER BY ID_EPI_QTD_FUNCAO DESC";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $itens = $cs->result();

        $obj = array();

        foreach ($itens as $item) {


            $id = $item->ID_EPI_QTD_FUNCAO;
            
            
            $idFuncaoFiltro = $item->FUNCAO;
            
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$idFuncaoFiltro'";
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {
            
                $nomeFuncao = $rs[0]->FUNCAO;  
               
            }else{
                $nomeFuncao = "-";
            }

            //$obj['SELECAO'] = "<input type='checkbox'  id='$aux' class='check'  onclick='marcaGrid($aux)'/>";
            $obj['ID_EPI_QTD_FUNCAO'] = $id;
            $obj['FUNCAO'] = $nomeFuncao;
           
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

        $query = "SELECT * FROM GP_EPI_ENT WHERE ID_EPI = $idEpi";

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

    
    public function carregarTipoEpi() {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI_TIPO ORDER BY EQUIPAMENTO";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idEpiTipo = $item->ID_EPI_TIPO;
                $equipamento = $item->EQUIPAMENTO;
                $html .= "<option value='$idEpiTipo'>$equipamento</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
    }
        
      
    public function carregarTipoEpiEd() {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EPI_TIPO";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idEpiTipo1 = $item->ID_EPI_TIPO;
                $equipamento1 = $item->EQUIPAMENTO;
                $html .= "<option value='$idEpiTipo1'>$equipamento1</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
    }
    

    public function carregarFuncao() {

        $this->initConBanco();


        $query = "SELECT * FROM GP_CAD_FUNCOES";


        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {


            foreach ($rs as $item) {

                $idFuncao = $item->ID_FUNCAO;
                $nomeFuncao = $item->FUNCAO;
                $html .= "<option value='$idFuncao'>$nomeFuncao</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Funcionário Cadastrado</option>";
        }
    }

    
    public function getItemLancamentoEditarEd($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO =  '$id' ORDER BY ID_FUNCAO_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = $totalSalvo;

        $s = 0;

        $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Quantidade Disponível</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Durabilidade</td>
                        



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $quantidade = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;

                $durabilidade = $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;

                


                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                // print_r($itemValor); exit();
                $quantidadeValor = $rs[$s]->QUANTIDADE;
                $durabilidadeValor = $rs[$s]->DURABILIDADE;
                
                $idTipoEpi = $rs[$s]->ID_FUNCAO_ITEM;

                $s = $s + 1;
                
                
                $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $tipoEpiValor ";

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                    
                $idEpiTipo = $rs1[0]->EQUIPAMENTO;

                



                $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idTipoEpi)' readonly ></button></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'   value='$idEpiTipo' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$quantidade'  value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$durabilidade'   value='$durabilidadeValor'   readonly></div></td>
                        


                  </tr>";
            }


            return $html;
    }

    public function getItemLancamento($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();


        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO WHERE ID_EPI_QTD_FUNCAO = '$id'";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) == null || is_array($rs) && count($rs) == "null") {

            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO = '$id' ORDER BY ID_FUNCAO_ITEM";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $i = 0;

            $s = 0;

            $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Quantidade Disponível</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Durabilidade</td>
                        



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $quantidade = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;

                $durabilidade = $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;

                


                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                // print_r($itemValor); exit();
                $quantidadeValor = $rs[$s]->QUANTIDADE;
                $durabilidadeValor = $rs[$s]->DURABILIDADE;
                
                $idTipoEpi = $rs[$s]->ID_FUNCAO_ITEM;

                $s = $s + 1;
                
                $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $tipoEpiValor ";

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                    
                $idEpiTipo = $rs1[0]->EQUIPAMENTO;
                
                
               



                $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idTipoEpi)' readonly ></button></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'   value='$idEpiTipo' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$quantidade'  value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$durabilidade'   value='$durabilidadeValor'   readonly></div></td>
                        


                  </tr>";
            }


            return $html;
        } else {

            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' ORDER BY ID_FUNCAO_ITEM";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $i = 0;

            $s = 0;

            $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Quantidade Disponível</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Durabilidade</td>
                        


                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $quantidade = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;

                $durabilidade = $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;

                


                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                // print_r($tipoEpiValor); exit();
                $quantidadeValor = $rs[$s]->QUANTIDADE;
                $durabilidadeValor = $rs[$s]->DURABILIDADE;
                
                $idTipoEpi = $rs[$s]->ID_FUNCAO_ITEM;

                $s = $s + 1;
                
                $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $tipoEpiValor ";

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                    
                $idEpiTipo = $rs1[0]->EQUIPAMENTO;

                


                $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idTipoEpi)' readonly ></button></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'   value='$idEpiTipo' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$quantidade'  value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$durabilidade'   value='$durabilidadeValor'   readonly></div></td>
                        


                  </tr>";
            }


            return $html;
        }
    }

    public function getEditarItemLancamento($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' ORDER BY ID_FUNCAO_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = 0;

        $s = 0;

        $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Quantidade Disponível</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Durabilidade</td>
                        



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $quantidade = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;

                $durabilidade = $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;

                


                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                // print_r($itemValor); exit();
                $quantidadeValor = $rs[$s]->QUANTIDADE;
                $durabilidadeValor = $rs[$s]->DURABILIDADE;
                
                $idTipoEpi = $rs[$s]->ID_FUNCAO_ITEM;

                $s = $s + 1;
                
                 $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $tipoEpiValor ";

                $cs = $this->conBanco->query($query);
                $rs1 = $cs->result();

                    
                $idEpiTipo = $rs1[0]->EQUIPAMENTO;
                
               

                $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idTipoEpi)' readonly ></button></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'   value='$idEpiTipo' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$quantidade'  value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$durabilidade'   value='$durabilidadeValor'   readonly></div></td>
                        


                  </tr>";
            }


            return $html;
    }

    public function getEditarItemLancamentoEd($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' ORDER BY ID_FUNCAO_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = 0;

        $s = 0;

        $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Quantidade Disponível</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Durabilidade</td>
                        



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $quantidade = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;

                $durabilidade = $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;

                


                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                // print_r($itemValor); exit();
                $quantidadeValor = $rs[$s]->QUANTIDADE;
                $durabilidadeValor = $rs[$s]->DURABILIDADE;
                
                $idTipoEpi = $rs[$s]->ID_FUNCAO_ITEM;

                $s = $s + 1;
                
                

                $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idTipoEpi)' readonly ></button></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'   value='$tipoEpiValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$quantidade'  value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$durabilidade'   value='$durabilidadeValor'   readonly></div></td>
                        


                  </tr>";
            }


            return $html;
    }

    public function getItemLancamentoEditar($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalNovo = number_format($rs[0]->TOTAL);


        $totalGeral = $totalNovo + $totalSalvo;

        //print_r($totalGeral);exit();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO =  '$id' ORDER BY ID_FUNCAO_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = $totalSalvo;

        $s = 0;

        $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'>Editar</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Tipo EPI</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Quantidade Disponível</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Durabilidade</td>
                        



                  </tr>";

            for ($i = $i; $i < $totalGeral; $i++) {

                //print_r($i);exit();

                $id = $i;
                $j = $i + 1;



                $tipoEpi = $j;
                $tipoEpi .= "_";
                $tipoEpi .= $j;

                $quantidade = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;

                $durabilidade = $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;
                $durabilidade .= "_";
                $durabilidade .= $j;

                


                $tipoEpiValor = $rs[$s]->TIPO_EPI;
                // print_r($itemValor); exit();
                $quantidadeValor = $rs[$s]->QUANTIDADE;
                $durabilidadeValor = $rs[$s]->DURABILIDADE;
                
                $idTipoEpi = $rs[$s]->ID_FUNCAO_ITEM;

                $s = $s + 1;

                

                $html .="<tr  style='width: 45%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItemLancamento($idTipoEpi)' readonly ></button></div></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$tipoEpi'   value='$tipoEpiValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$quantidade'  value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$durabilidade'   value='$durabilidadeValor'   readonly></div></td>
                        


                  </tr>";
            }


            return $html;
    }

    public function editarItemLancamentoTemporario($idLancamentoItem, $id) {

        $this->initConBanco();


        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem' ";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            $obj[] = $rs[0]->TIPO_EPI;
            $obj[] = $rs[0]->QUANTIDADE;
            $obj[] = $rs[0]->DURABILIDADE;
            



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

       $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem' ";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem' ";
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

               
                            
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QUANTIDADE;
                $obj[] = $rs[0]->DURABILIDADE;

                return json_encode($obj);
            } else {

                return 2;
            }
        } else {


            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QUANTIDADE;
                $obj[] = $rs[0]->DURABILIDADE;
                //          
                return json_encode($obj);
            } else {

                return 2;
            }
        }
    }

    public function editarItemLancamentoEd($idLancamentoItem, $id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem'";
        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QUANTIDADE;
                $obj[] = $rs[0]->DURABILIDADE;

                return json_encode($obj);
            } else {

                return 2;
            }
        } else {


            $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO = '$id' AND ID_FUNCAO_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->QUANTIDADE;
                $obj[] = $rs[0]->DURABILIDADE;

                return json_encode($obj);
            } else {

                return 2;
            }
        }
    }

    public function excluirLancamentoModalEd($tipoEpiEd, $id) {

        $this->initConBanco();

        $query = "DELETE FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpiEd'";

        //print_r($query);//exit();

        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpiEd'";

            //print_r($query);//exit();

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

     public function verificarLancamentoEpi($id, $idFuncao) {
        
        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO WHERE ID_EPI_QTD_FUNCAO = '$id' AND FUNCAO = '$idFuncao'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {

                return false;
        } else {

                return true;
        }
        
    }
    
    public function verificarSalvarLancamento($id, $tipoEpi) {
        
        $this->initConBanco();

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi'";

        //print_r($query);//exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {

                return true;
        } else {

                $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi'";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (is_array($rs) && count($rs) > 0) {

                        return true;
                } else {

                        return false;
                }
        }
    }
    
    public function salvarItensLancamentos($id, $tipoEpi, $quantidade, $durabilidade) {
         //print_r($tipoEpi);exit();
        $this->initConBanco();

        $query = "SELECT ID_EPI_TIPO FROM GP_CAD_EPI_TIPO WHERE EQUIPAMENTO = '$tipoEpi'";

        //print_r($query); exit();
        $cs1 = $this->conBanco->query($query);
        $rs1 = $cs1->result();
        
        $tipoEpi1 = $rs1[0]->ID_EPI_TIPO;

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO_ITEM  WHERE ID_EPI_QTD_FUNCAO = '$id' AND TIPO_EPI = '$tipoEpi1'";

        //print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

        if (is_array($rs) && count($rs) > 0) {





            $query = "UPDATE GP_EPI_QTD_FUNCAO_ITEM SET TIPO_EPI = '$tipoEpi1', QUANTIDADE = '$quantidade', DURABILIDADE = '$durabilidade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_QTD_FUNCAO '%$id%' AND TIPO_EPI = '$tipoEpi1'";

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

            $query = "SELECT MAX(ID_FUNCAO_ITEM) AS ID_FUNCAO_ITEM FROM GP_EPI_QTD_FUNCAO_ITEM";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (count($rs) == 0) {
                $novoId = 1;
            } else {
                $novoId = $rs[0]->ID_FUNCAO_ITEM + 1;
            }



            $query = "INSERT INTO GP_EPI_QTD_FUNCAO_ITEM (ID_EPI_QTD_FUNCAO, ID_FUNCAO_ITEM, TIPO_EPI, QUANTIDADE, DURABILIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$tipoEpi1', '$quantidade', '$durabilidade', SYSDATE, '$usuarioLogado')";

            //print_r($query); //exit();
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

        $query = "SELECT * FROM GP_EPI_QTD_FUNCAO WHERE ID_EPI_QTD_FUNCAO = '$id'";


        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {


            $obj[] = $rs[0]->ID_EPI_QTD_FUNCAO;
            $obj[] = $rs[0]->FUNCAO;
           
            return json_encode($obj);
        } else {
            return false;
        }
    }

    public function excluirDadosTemp() {
        //print_r("EXCLUIR");exit();
        $this->initConBanco();

        $query = "DELETE GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO >= 1";
        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO >= 1";

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

        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM_TEMP WHERE ID_EPI_QTD_FUNCAO = '$id'";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $totalTemp = $rs[0]->TOTAL;



            $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_QTD_FUNCAO_ITEM WHERE ID_EPI_QTD_FUNCAO = '$id'";

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
