<?php

class cadastrofuncoesmodel extends CI_Model {

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
    
    public function carregarExames(){
        
        $this->initConBanco();

        $query = "SELECT ID_EXAMES, EXAMES FROM GP_CAD_EXAMES ORDER BY EXAMES ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idExames = $item->ID_EXAMES;
                $exames      = $item->EXAMES;
                $html .= "<option value='$idExames'>$exames</option>";
            }

            return $html; 
        } else {
            return "<option value='0'>Nenhum Exame Cadastrado</option>";
        }
           
        
    }
    
    
    public function novo(){
        
        $this->initConBanco();
        
        $query = "SELECT MAX(ID_FUNCAO) AS ID_FUNCAO FROM GP_CAD_FUNCOES";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_FUNCAO + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }   

   public function salvar($id, $funcao, $descricao, $cbo){
        
        $this->initConBanco();
        
        //$quantidade = str_replace(',', '.', $quantidade);
        
        $query = "SELECT * FROM GP_CAD_FUNCOES WHERE CBO = '$cbo'" ;
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_FUNCOES SET FUNCAO = '$funcao', DESCRICAO = '$descricao', CBO = '$cbo', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE CBO = '$cbo'";

            
            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
                                   

            $query = "INSERT INTO GP_CAD_FUNCOES (ID_FUNCAO, FUNCAO, DESCRICAO, CBO, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, '$funcao', '$descricao', '$cbo', SYSDATE, '$usuarioLogado')";     

            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    
    public function getAdicionarFuncao($id, $cbo) {

        $this->initConBanco();
        
        //$query = "SELECT * FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$id' AND EMPRESA = '$empresa' AND FILIAL = '$filial' AND CBO = '$cbo'";
        $query = "SELECT * FROM GP_CAD_FUNCOES ORDER BY ID_FUNCAO";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            

            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>ID</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Função</td>
                        <td  style='width: 6%; padding-right: 5px;font-size: 14px;'>Descrição</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>CBO</td>
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                
                $j = $j + 1;

                $id = $j;

                $funcao  = $j;
                $funcao .= "_";
                $funcao .= $j;
                
                
                $descricao  = $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                
                
                $cbo  = $j;
                $cbo .= "_";
                $cbo .= $j;
                $cbo .= "_";
                $cbo .= $j;
                $cbo .= "_";
                $cbo .= $j;
                
                
                
                $idValor = $item->ID_FUNCAO;
                $funcaoValor = $item->FUNCAO;
                $descricaoValor = $item->DESCRICAO;
                $cboValor = $item->CBO;
                
                
               

                $html .="<tr  style='width: 90%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 1%;  padding-right: 10px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarFuncao($idValor, $cboValor)' readonly ></button></div></td>
                        <td  style='width: 5%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$id'   value='$idValor' readonly></div></td>
                        <td  style='width: 20%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$funcao'   value='$funcaoValor' readonly></div></td>
                        <td  style='width: 20%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$descricao'   value='$descricaoValor' readonly></div></td>
                        <td  style='width: 9%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$cbo'   value='$cboValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }
            
    }
    
    public function editarFuncao($id, $cbo) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$id' AND CBO = '$cbo'";
        //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            
            $obj[] = $rs[0]->ID_FUNCAO;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->DESCRICAO;
            $obj[] = $rs[0]->CBO;


            return json_encode($obj);
        } else {
            return false;
        }
    }
    
    public function excluir($id) {

        $this->initConBanco();


        $query = "DELETE GP_CAD_FUNCOES WHERE ID_FUNCAO = '$id'";
        //print_r($query); exit();
        
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            return true;
           
        } else {
            return false;
        }
        
    }
    
    
    public function pesquisaSimples($cboPesquisarInicio){
        
      $this->initConBanco();
         
            $query = "SELECT * FROM GP_CAD_FUNCOES WHERE CBO LIKE '%$cboPesquisarInicio%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FUNCAO;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->CBO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        
           
    }
    
    

    

}   




