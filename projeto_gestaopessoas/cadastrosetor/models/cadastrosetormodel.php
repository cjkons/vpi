<?php

class cadastrosetormodel extends CI_Model {

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
        
        $query = "SELECT MAX(ID_SETOR) AS ID_SETOR FROM GP_CAD_SETOR";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_SETOR + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }   

   public function salvar($id, $setor){
        
        $this->initConBanco();
        
        //$quantidade = str_replace(',', '.', $quantidade);
        
        $query = "SELECT * FROM GP_CAD_SETOR WHERE ID_SETOR = '$id'" ;
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_SETOR SET SETOR = '$setor', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_SETOR = '$id'";

            
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
                                   

            $query = "INSERT INTO GP_CAD_SETOR (ID_SETOR, SETOR, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, '$setor', SYSDATE, '$usuarioLogado')";     

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
    
    
    public function getAdicionarSetor($id) {

        $this->initConBanco();
        
        //$query = "SELECT * FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$id' AND EMPRESA = '$empresa' AND FILIAL = '$filial' AND CBO = '$cbo'";
        $query = "SELECT * FROM GP_CAD_SETOR ORDER BY SETOR";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            

            $html = "";

            $html .="<tr  style='width: 50%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4% text-transform: uppercase;; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td></td>
                        <td  style='width: 4%text-transform: uppercase;; padding-right: 5px;font-size: 14px;'>Setor</td>
                        
                        
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                
                $j = $j + 1;

                $id = $j;

                $setor  = $j;
                $setor .= "_";
                $setor .= $j;
                
                
                
                
                $idValor = $item->ID_SETOR;
                $setorValor = $item->SETOR;
                
                
                
                
               

                $html .="<tr  style='width: 50%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 1%;  padding-right: 10px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarSetor($idValor)' readonly ></button></div></td>
                        <td  style='width: 1%;'  ><div class='form'><input  type='hidden' class='form-control' style='font-size: 12px;' id='$id'   value='$idValor' readonly></div></td>
                        <td  style='width: 20%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$setor'   value='$setorValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }
            
    }
    
    public function editarSetor($id) {

        $this->initConBanco();

        $query = "SELECT * FROM GP_CAD_SETOR WHERE ID_SETOR = '$id'";
        //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            
            $obj[] = $rs[0]->ID_SETOR;
            $obj[] = $rs[0]->SETOR;
            
            


            return json_encode($obj);
        } else {
            return false;
        }
    }
    
    public function excluir($id) {

        $this->initConBanco();


        $query = "DELETE GP_CAD_SETOR WHERE ID_SETOR = '$id'";
        //print_r($query); exit();
        
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            return true;
           
        } else {
            return false;
        }
        
    }
    
    
    public function pesquisaSimples($setorPesquisarInicio){
        
      $this->initConBanco();
         
            $query = "SELECT * FROM GP_CAD_SETOR WHERE SETOR LIKE '%$setorPesquisarInicio%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_SETOR;
                $obj[] = $rs[0]->SETOR;
               
                return json_encode($obj);
            }
            else{
                return false;
            }
        
           
    }
    
    

    

}   




