<?php

class historicoepiusuariomodel extends CI_Model {

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

        $query = "SELECT max(ID_EPI_HISTORICO) AS ID FROM  GP_EPI_HISTORICO";
        //print_r($query);exit();
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

        
        $query = "SELECT * FROM GP_EPI_HISTORICO WHERE FUNCIONARIO = '$idFuncionario'";
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if (is_array($rs) && count($rs) > 0) {
               
               return false;
                
            } else {
                
                return true;
            }
    }

    public function salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao) {

        $this->initConBanco();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


        $query = "SELECT * FROM GP_EPI_HISTORICO  WHERE ID_EPI_HISTORICO = $id";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();





        if (is_array($rs) && count($rs) > 0) {

            $query = "UPDATE GP_EPI_HISTORICO SET FUNCIONARIO  = '$idFuncionario' , MATRICULA = '$matricula', SETOR = '$setor', FUNCAO = '$funcao', DATA_ADMISSAO = '$dataAdmissao', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EPI_HISTORICO = $id";
            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if ($resultado == true) {
                return true;
            } else {
                return false;
            }
        } else {



            $query = "INSERT INTO GP_EPI_HISTORICO (ID_EPI_HISTORICO, FUNCIONARIO, MATRICULA, SETOR, FUNCAO, DATA_ADMISSAO, DATA_CADASTRO, USUARIO_CADASTRO)
                            VALUES ($id,'$idFuncionario', '$matricula', '$setor', '$funcao', '$dataAdmissao', SYSDATE, '$usuarioLogado')";

            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if ($resultado == true) {
                return true;
            } else {
                return false;
            }
        }
    }
     
    
    public function salvarItensLancamentos($id, $matricula, $imagem, $entDev, $descricaoAnexo) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();


        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        $dataAtual = date('d/m/Y');

        $query = "SELECT MAX(ID_EPI_HISTORICO_ITEM) AS ID_EPI_HISTORICO_ITEM FROM GP_EPI_HISTORICO_ITEM";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) == 0) {
            $novoId = 1;
        } else {
            $novoId = $rs[0]->ID_EPI_HISTORICO_ITEM + 1;
        }



        $query = "INSERT INTO GP_EPI_HISTORICO_ITEM (ID_EPI_HISTORICO, ID_EPI_HISTORICO_ITEM, CAMINHO, MATRICULA, ENT_DEV, DESCRICAO_ANEXO, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $novoId, '$imagem', '$matricula', '$entDev', '$descricaoAnexo', SYSDATE, '$usuarioLogado')";

        //print_r($query); //exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {
            //                
            return true;
        } else {
            return false;
        }
    }

    public function excluir($id) {

        $this->initConBanco();

        $query = "DELETE FROM GP_EPI_HISTORICO WHERE ID_EPI_HISTORICO = $id";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE FROM GP_EPI_HISTORICO_ITEM WHERE ID_EPI_HISTORICO = $id";

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

        $query = "SELECT * FROM GP_EPI_HISTORICO WHERE 1 = 1 ";

        if ($idFuncionarioFiltro != 0 || $idFuncionarioFiltro != "0") {
            $query .= "AND FUNCIONARIO = '$idFuncionarioFiltro'";
        }

        


        $query .= "ORDER BY ID_EPI_HISTORICO DESC";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $itens = $cs->result();

        $obj = array();

        foreach ($itens as $item) {


            $id = $item->ID_EPI_HISTORICO;
            
            
            $idFuncionario = $item->FUNCIONARIO;
            $query = "SELECT NOME_FUNCIONARIO FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = '$idFuncionario'";
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $nomeFuncionario = $rs[0]->NOME_FUNCIONARIO;    

            //$obj['SELECAO'] = "<input type='checkbox'  id='$aux' class='check'  onclick='marcaGrid($aux)'/>";
            $obj['ID_EPI_HISTORICO'] = $id;
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


        $query = "SELECT COUNT(ID_EPI_HISTORICO) AS TOTAL FROM GP_EPI_HISTORICO";

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

        $query = "SELECT * FROM GP_EPI_HISTORICO WHERE ID_EPI_HISTORICO = $id";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {



            $obj[] = $rs[0]->ID_EPI_HISTORICO;
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


    public function carregarFuncionario() {

        $this->initConBanco();


        //$query = "SELECT * FROM GP_CAD_FUNCIONARIO";
        $query = "SELECT * FROM GP_EPI_ENT T1 INNER JOIN GP_CAD_FUNCIONARIO T2 ON T1.FUNCIONARIO = T2.ID_FUNCIONARIO";


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

    
    public function getEditarItemLancamento($id) {

        $this->initConBanco();


        $query = "SELECT COUNT(*) AS TOTAL FROM GP_EPI_HISTORICO_ITEM WHERE ID_EPI_HISTORICO =  '$id'";

        // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $totalSalvo = number_format($rs[0]->TOTAL);

        $query = "SELECT * FROM GP_EPI_HISTORICO_ITEM WHERE ID_EPI_HISTORICO = '$id' ORDER BY ID_EPI_HISTORICO_ITEM";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        $html = "";

        $i = 0;
  
        $s = 0;

        $html .="<tr  style='width: 60%; padding-right: 5px; font-size: 14px;' align='center' >
                    <td  style='width: 5%;  padding-right: 0px;font-size: 14px;'></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Entrega / Devolução</td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'>Descrição do Anexo</td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Anexado Data</td>
                   
              </tr>";

        for ($i = $i; $i < $totalSalvo; $i++) {

            //print_r($i);exit();

            
            $j = $i + 1;



            $caminho = $j;
            $caminho .= "_";
            $caminho .= $j;
            
            $entDev = $j;
            $entDev .= "_";
            $entDev .= $j;
            $entDev .= "_";
            $entDev .= $j;
            
            $descricao = $j;
            $descricao .= "_";
            $descricao .= $j;
            $descricao .= "_";
            $descricao .= $j;
            $descricao .= "_";
            $descricao .= $j;
            
            $data = $j;
            $data .= "_";
            $data .= $j;
            $data .= "_";
            $data .= $j;
            $data .= "_";
            $data .= $j;
            $data .= "_";
            $data .= $j;

            $caminhoValor = $rs[$s]->CAMINHO;
            $entDevValor = $rs[$s]->ENT_DEV;
            $descricaoValor = $rs[$s]->DESCRICAO_ANEXO;
            $dataValor = $rs[$s]->DATA_CADASTRO;
           
            $idLancamentoItem = $rs[$s]->ID_EPI_HISTORICO_ITEM;
            
            if($entDevValor == "E"){
                $entDevValor = "Entrega";
            }else{
                $entDevValor = "Devolução";
            }

            $s = $s + 1;

            //print_r($caminhoValor);
            //print_r($valorSequencia); exit();

            $html .="<tr  style='width: 60%; padding-right: 5px; font-size: 14px;' align='center' >
                    
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><a onclick='visualizarAnexo($id, $idLancamentoItem)'  class='btn btn-primary'><span class='fa fa-search-plus'></span>Visualizar Anexo</a></button></div></td> 
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$entDev'   value='$entDevValor' readonly></div></td>
                    <td  style='width: 35%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$descricao'   value='$descricaoValor' readonly></div></td>
                    <td  style='width: 10%; padding-right: 5px;font-size: 14px;'><div class='form'><input  type='text' class='form-control' id='$data'   value='$dataValor' readonly></div></td>
                    <td  style='width: 5%; padding-right: 0px;font-size: 14px;'><a onclick='excluirAnexo($id,$idLancamentoItem)'  class='btn btn-primary'><span class='glyphicon glyphicon-trash'></span> Excluir Anexo</a></button></div></td> 
                    
                  
                    
              </tr>";
        }


        return $html;
    }

    
    public function excluirAnexo($id, $idLancamento) {

        $this->initConBanco();

        $query = "DELETE FROM GP_EPI_HISTORICO_ITEM WHERE ID_EPI_HISTORICO = '$id' AND ID_EPI_HISTORICO_ITEM = '$idLancamento'";

        //print_r($query);//exit();

        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            return true;
        } else {

            return false;
        }
    }

    public function editarLancamento($id) {

        $this->initConBanco();



        $query = "SELECT * FROM GP_EPI_HISTORICO WHERE ID_EPI_HISTORICO = '$id'";


        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();



        if (is_array($rs) && count($rs) > 0) {



            $obj[] = $rs[0]->ID_EPI_HISTORICO;
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

    public function visualizarAnexo($idLancamentoItem, $id) {

        $this->initConBanco();

            $query = "SELECT * FROM GP_EPI_HISTORICO_ITEM WHERE ID_EPI_HISTORICO = '$id' AND ID_EPI_HISTORICO_ITEM = '$idLancamentoItem'";
            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0) {

                $obj[] = $rs[0]->CAMINHO;
               
                return json_encode($obj);
            } else {

                return 2;
            }
        }

}
