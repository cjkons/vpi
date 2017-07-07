<?php

class cadastroexamesmodel extends CI_Model {

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
    
    
    public function novo(){
        
        $this->initConBanco();
        
        $query = "SELECT MAX(ID_EXAMES) AS ID_EXAMES FROM GP_CAD_EXAMES";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_EXAMES + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }   

   public function salvar($id, $exames, $descricao){
        
        $this->initConBanco();
        
        //$quantidade = str_replace(',', '.', $quantidade);
        
        $query = "SELECT * FROM GP_CAD_EXAMES WHERE ID_EXAMES = '$id'" ;
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_EXAMES SET EXAMES = '$exames', DESCRICAO = '$descricao', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_EXAMES = '$id'";

            
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
                                   

            $query = "INSERT INTO GP_CAD_EXAMES (ID_EXAMES, EXAMES, DESCRICAO, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, '$exames', '$descricao', SYSDATE, '$usuarioLogado')";     

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
    
    
    public function getAdicionarExames($id) {

        $this->initConBanco();
        
        //$query = "SELECT * FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$id' AND EMPRESA = '$empresa' AND FILIAL = '$filial' AND CBO = '$cbo'";
        $query = "SELECT * FROM GP_CAD_EXAMES ORDER BY ID_EXAMES";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            

            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>ID</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Exames</td>
                        <td  style='width: 6%; padding-right: 5px;font-size: 14px;'>Descrição</td>
                        
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                
                $j = $j + 1;

                $id = $j;

                $exames  = $j;
                $exames .= "_";
                $exames .= $j;
                
                
                $descricao  = $j;
                $descricao .= "_";
                $descricao .= $j;
                $descricao .= "_";
                $descricao .= $j;
                             
                
                
                $idValor = $item->ID_EXAMES;
                $examesValor = $item->EXAMES;
                $descricaoValor = $item->DESCRICAO;
                
                
               

                $html .="<tr  style='width: 90%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 1%;  padding-right: 10px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarExames($idValor)' readonly ></button></div></td>
                        <td  style='width: 5%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$id'   value='$idValor' readonly></div></td>
                        <td  style='width: 20%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$exames'   value='$examesValor' readonly></div></td>
                        <td  style='width: 20%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$descricao'   value='$descricaoValor' readonly></div></td>
                        


                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }
            
    }
    
    public function editarExames($id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_EXAMES WHERE ID_EXAMES = '$id'";
        //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            
            $obj[] = $rs[0]->ID_EXAMES;
            $obj[] = $rs[0]->EXAMES;
            $obj[] = $rs[0]->DESCRICAO;
           


            return json_encode($obj);
        } else {
            return false;
        }
    }
    
    public function excluir($id) {

        $this->initConBanco();


        $query = "DELETE GP_CAD_EXAMES WHERE ID_EXAMES = '$id'";
        //print_r($query); exit();
        
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            return true;
           
        } else {
            return false;
        }
        
    }
    
    
    public function pesquisaSimples($examesPesquisarInicio, $examesPesquisarFim){
        
      $this->initConBanco();
         
            $query = "SELECT * FROM GP_CAD_EXAMES WHERE EXAMES LIKE '%$examesPesquisarInicio%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EXAMES;
                $obj[] = $rs[0]->EXAMES;
                $obj[] = $rs[0]->DESCRICAO;
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        
           
    }
    
    

    

}   




