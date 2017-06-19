<?php

class cadastrochecklistmodel extends CI_Model {

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
        
        $query = "SELECT MAX(ID_CHECKLIST) AS ID_CHECKLIST FROM GA_CAD_CHECKLIST";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_CHECKLIST + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }
    
    public function novoIdDesc($idCheckList){
        
        $this->initConBanco();
        
        $query = "SELECT MAX(ID_CHECKLIST_DESC) AS ID_CHECKLIST_DESC FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = $idCheckList ";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoIdDesc = $rs[0]->ID_CHECKLIST_DESC + 1;
        }
        else{
            $novoIdDesc = 1;
            
        }
                
        return $novoIdDesc;
         
    }

   public function salvar($idCheckList, $checkList){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idCheckList' OR CHECKLIST = '$checkList'";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_CAD_CHECKLIST SET ID_CHECKLIST = '$idCheckList', CHECKLIST = '$checkList', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_CHECKLIST = '$idCheckList' OR CHECKLIST = '$checkList'";

            
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
            
            $query = "SELECT MAX(ID_CHECKLIST) AS ID_CHECKLIST FROM GA_CAD_CHECKLIST";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID_CHECKLIST + 1;
            }                       

            $query = "INSERT INTO GA_CAD_CHECKLIST (ID_CHECKLIST, CHECKLIST, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($idCheckList, '$checkList', SYSDATE, '$usuarioLogado')";     

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
    
    
    public function salvarDescricao($idCheckList, $idCheckListDesc, $descricao, $grupo, $subGrupo) {
        // print_r("salvarDescricao");exit();
        $this->initConBanco();

        //VERIFICAR SE JA TEM A SALVO A CHECKLIST NA TABELA MAE

        $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idCheckList'";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {


            $query = "SELECT * FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = $idCheckList AND ID_CHECKLIST_DESC = '$idCheckListDesc'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO

            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GA_CAD_CHECKLIST_DESC SET DESCRICAO = '$descricao', GRUPO = '$grupo', SUBGRUPO = '$subGrupo', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_CHECKLIST LIKE '%$idCheckList%' AND  ID_CHECKLIST_DESC = '$idCheckListDesc'";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {

                $query = "SELECT MAX(ID_CHECKLIST_DESC) AS ID_CHECKLIST_DESC FROM GA_CAD_CHECKLIST_DESC";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                if (count($rs) == 0) {
                    $novoId = 1;
                } else {
                    $novoId = $rs[0]->ID_CHECKLIST_DESC + 1;
                }

                $query = "INSERT INTO GA_CAD_CHECKLIST_DESC (ID_CHECKLIST, ID_CHECKLIST_DESC, DESCRICAO, GRUPO, SUBGRUPO, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($idCheckList, $novoId, '$descricao', '$grupo', '$subGrupo', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            
        } else {
            return false;
        }
    }

    public function excluir($idCheckList){
        
        $this->initConBanco();
        
        
        $query = "DELETE FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = $idCheckList";
       // print_r($query);exit();
        $resultado = $this->conBanco->query($query);
                        
        if($resultado == true || $resultado == 1){
            $query = "DELETE FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idCheckList'";  
            $resultado = $this->conBanco->query($query);
                        
                if($resultado == true || $resultado == 1){
                    return true;            
                }
                else{
                    return false;
                }
                }
        else{
            return false;
        }
        
        
        
         
    }
    
    public function excluirItem($idCheckList, $idCheckListDesc){
               
        
        $this->initConBanco();
        
        
        $query = "DELETE FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = $idCheckList AND ID_CHECKLIST_DESC = '$idCheckListDesc'";
        //print_r($query); exit();
        $resultado = $this->conBanco->query($query);
                        
        if($resultado == true || $resultado == 1){
            return true;            
        }
        else{
            return false;
        }
         
    }
    
    public function excluirDescricao($idCheckList, $idCheckListDesc){
        
                
        
        $this->initConBanco();
        
        
        
        $query = "DELETE FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = $idCheckList AND ID_CHECKLIST_DESC = '$idCheckListDesc'";
        //print_r($query); exit();
        
       
        $resultado = $this->conBanco->query($query);
                        
        if($resultado == true || $resultado == 1){
            return true;            
        }
        else{
            return false;
        }
         
    }
    public function buscaPrimeiroRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_CAD_CHECKLIST ORDER BY ID_CHECKLIST";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
       
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_CHECKLIST;
            $obj[] = $rs[0]->CHECKLIST;
            
            $idCheckList = $rs[0]->ID_CHECKLIST;
            
            $query = "SELECT count(*) as TOTAL FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList'";
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $obj[] = $rs[0]->TOTAL;
                  
               
            return json_encode($obj);
        }
        else{
            return false;
        }
    }

       
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_CAD_CHECKLIST ORDER BY ID_CHECKLIST";
       
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
        $obj = array();
        
        $cont = count($rs) - 1;
        //print_r($cont); exit();
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->ID_CHECKLIST;
            $obj[] = $rs[$cont]->CHECKLIST;
            
            
            $idCheckList = $rs[$cont]->ID_CHECKLIST;
            //print_r($idPreco); exit();
            $query = "SELECT count(*) as TOTAL FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList'";
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $obj[] = $rs[0]->TOTAL;
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idCheckList){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idCheckList'";
        
       // print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $idCheckList = $rs[0]->ID_CHECKLIST;
        
          
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idCheckList - $cont;  

            $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_CHECKLIST;
                $obj[] = $rs[0]->CHECKLIST;
               
                $idCheckList = $rs[0]->ID_CHECKLIST;
                
                $query = "SELECT count(*) as TOTAL FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList'";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $obj[] = $rs[0]->TOTAL;

                return json_encode($obj);
            }
            $cont++;
        }
           
    }
    
    public function buscaRegistroProximo($idCheckList) {

        $this->initConBanco();

        $cont = 1;

        for ($i = 0; $i < 10; $i++) {

            $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idCheckList'";

            // print_r($query);exit();

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $idCheckList = $rs[0]->ID_CHECKLIST;


            $cont = 1;

            for ($i = 0; $i < 10; $i++) {

                $idProcura = $idCheckList + $cont;

                $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST =  $idProcura";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $obj = array();

                if (is_array($rs) && count($rs) > 0) {

                    $obj[] = $rs[0]->ID_CHECKLIST;
                    $obj[] = $rs[0]->CHECKLIST;

                    $idCheckList = $rs[0]->ID_CHECKLIST;

                    $query = "SELECT count(*) as TOTAL FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idCheckList'";

                    $cs = $this->conBanco->query($query);
                    $rs = $cs->result();

                    $obj[] = $rs[0]->TOTAL;

                    return json_encode($obj);
                }
                $cont++;
            }
        }
    }

    public function pesquisaSimples($idInicial, $nomeInicial){
        
      $this->initConBanco();
             
        if($idInicial == "" || $idInicial == null ){
            
           $query = " SELECT * FROM GA_CAD_CHECKLIST WHERE CHECKLIST LIKE '%$nomeInicial%'";
            
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_CHECKLIST;
                $obj[] = $rs[0]->CHECKLIST;
                
                $idCheckList = $rs[0]->ID_CHECKLIST;
                
                $query = "SELECT count(*) as TOTAL FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList'";
                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $obj[] = $rs[0]->TOTAL;
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
           $query = "SELECT * FROM GA_CAD_CHECKLIST WHERE ID_CHECKLIST = '$idInicial'";
            
             
           // print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_CHECKLIST;
                $obj[] = $rs[0]->CHECKLIST;
                
                $idCheckList = $rs[0]->ID_CHECKLIST;
                
                $query = "SELECT count(*) as TOTAL FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList'";
                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $obj[] = $rs[0]->TOTAL;
                

                return json_encode($obj);
            }
            else{
                return false;
            }         
            
        }    
    }    
      
    
    
    public function addParcela1($idCheckList){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList' ORDER BY ID_CHECKLIST_DESC";       
        
        //print_r($id);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            
            $obj[] = $rs[0]->ID_CHECKLIST_DESC;
            $obj[] = $rs[0]->DESCRICAO;
            $obj[] = $rs[0]->GRUPO;
            $obj[] = $rs[0]->SUBGRUPO;
           
                  
               
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    
    
    public function plusParcelaBusca($idCheckList, $total){
        
        $this->initConBanco();
               
        
        $html = "";
        
        for($i = 1; $i < $total; $i++){
        
        
            
            $idCheckListDesc   = $i;

            $descricao      = $i;
            $descricao     .= "_";
            $descricao     .= $i;

            $grupo     = $i;
            $grupo    .= "_";
            $grupo    .= $i;
            $grupo    .= "_";
            $grupo    .= $i;

            $subGrupo    = $i;
            $subGrupo   .= "_";
            $subGrupo   .= $i;
            $subGrupo   .= "_";
            $subGrupo   .= $i;
            $subGrupo   .= "_";
            $subGrupo   .= $i;
                    
        
            
            $query = "SELECT * FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList' ORDER BY ID_CHECKLIST_DESC";       
        
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            
            $valorIdCheckListDesc  = $rs[$i]->ID_CHECKLIST_DESC;
            $valorDescricao  = $rs[$i]->DESCRICAO;
            $valorGrupo = $rs[$i]->GRUPO;
            $valorSubgrupo = $rs[$i]->SUBGRUPO;
            
            
           //print_r($valorCodProduto);
            
           //print_r($valorSequencia); exit();
            
            $html .="<tr style='width: 80%; border-collapse: collapse' cellpadding='0' cellspacing='5px' align='center'>
                    <td  style='padding-right: 3px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-info  glyphicon glyphicon-plus' onclick='plusTabelaPrecos()'  onchange='carregarCodItemId($i) onblur='desabilitarBox('comboDispositivo')'</button></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input size='8px' type='hidden' class='form-control' id='$idCheckListDesc' value='$valorIdCheckListDesc'  placeholder='ID' readonly></div></td>   
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$descricao'  value='$valorDescricao'   placeholder='Descrição' readonly></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='number' class='form-control' id='$grupo' value='$valorGrupo'  placeholder='Grupo' readonly></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='number' class='form-control' id='$subGrupo'  value='$valorSubgrupo'   onchange = 'salvarDescricao($i)' placeholder='Subgrupo' readonly></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><button type='button' style='background-color: red;' class='btn btn-info  glyphicon glyphicon-remove' onclick='removerTr(this, $valorIdCheckListDesc)'></button></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><button type='button'  class='btn btn-info  glyphicon glyphicon-floppy-disk' onclick='salvarDescricao($i)'></button></div></td>
               </tr>";
        
        }    
        
        return $html;
        
        
    }
    
    
    public function plusTabelaPreco($idCheckList){
        
        $this->initConBanco();
       
        $query = "SELECT MAX(ID_CHECKLIST_DESC) AS TOTAL FROM GA_CAD_CHECKLIST_DESC WHERE ID_CHECKLIST = '$idCheckList' ORDER BY ID_CHECKLIST_DESC";       
        //print_r($query); exit();
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
       //print_r($rs[0]->TOTAL); exit();
        if (is_array($rs) && count($rs) > 0) {
            $valor =  $rs[0]->TOTAL + 1;
            return $valor;
        
        }
        else{
            
            return 0;
        }
       
        
        
    }
    
    public function carregarValorCombo($idPreco, $codProduto){
        
        $this->initConBanco();

        $query = "SELECT * FROM VEN_TABELA_PRECO_DESCRICAO  WHERE ID_PRECO = '$idPreco' AND COD_PRODUTO = '$codProduto' ORDER BY ID_PRODUTO";       
        //print_r($query); exit();
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        //print_r($query); exit();
       
        $obj = array();

        if (is_array($rs) && count($rs) > 0) {

            $obj[] = $rs[0]->COD_PRODUTO;
         


            return json_encode($obj);
        }
    }
    
    
    
    


    
    
    
    
    
    
    
    
}
