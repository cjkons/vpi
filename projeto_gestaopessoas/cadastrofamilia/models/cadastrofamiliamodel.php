<?php

class cadastrofamiliamodel extends CI_Model {

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
        
        $query = "SELECT max(ID_FAMILIA) AS ID_FAMILIA FROM  GA_SUP_FAMILIA";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoIdFamilia = $rs[0]->ID_FAMILIA + 1;
        }
        else{
            $novoIdFamilia = 1;
            
        }
                
        return $novoIdFamilia;
         
    }   
    

    public function salvar($idFamilia, $denominacaoFamilia, $unidadeMedida){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_FAMILIA  WHERE ID_FAMILIA = $idFamilia";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_SUP_FAMILIA SET DENOMINACAO_FAMILIA  = '$denominacaoFamilia' , COD_UNIDADE = '$unidadeMedida', USUARIO_ALTERACAO = '$usuarioLogado', DATA_ALTERACAO = SYSDATE WHERE ID_FAMILIA = $idFamilia";

           // print_r($query);exit();
            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID) AS ID FROM  GA_SUP_FAMILIA";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GA_SUP_FAMILIA (ID, ID_FAMILIA, DENOMINACAO_FAMILIA, COD_UNIDADE, USUARIO_CADASTRO, DATA_CADASTRO)
                             VALUES ($novoId, $idFamilia,'$denominacaoFamilia', '$unidadeMedida', '$usuarioLogado', SYSDATE)";     

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
    
    public function excluir($idFamilia){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_SUP_FAMILIA WHERE ID_FAMILIA = $idFamilia";
        
                
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
        
        $query = "SELECT * FROM GA_SUP_FAMILIA ORDER BY ID_FAMILIA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_FAMILIA;
            $obj[] = $rs[0]->DENOMINACAO_FAMILIA;
            $obj[] = $rs[0]->DATA_CADASTRO;
            $obj[] = $rs[0]->COD_UNIDADE;
                    
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_FAMILIA ORDER BY ID_FAMILIA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->ID_FAMILIA;
            $obj[] = $rs[$cont]->DENOMINACAO_FAMILIA;
            $obj[] = $rs[$cont]->DATA_CADASTRO;
            $obj[] = $rs[$cont]->COD_UNIDADE;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idFamilia){
        
        $this->initConBanco();
        
        
        $cont = 1;
                
        for($i =0; $i < 30; $i++){     


            $idProcura = $idFamilia - $cont;  

            $query = "SELECT * FROM GA_SUP_FAMILIA WHERE ID_FAMILIA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_FAMILIA;
                $obj[] = $rs[0]->DENOMINACAO_FAMILIA;
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->COD_UNIDADE;

                return json_encode($obj);
            }
        
        }   
    }
    
     public function buscaRegistroProximo($idFamilia){
        
        $this->initConBanco();
        
        
        $cont = 1;
                
        for($i =0; $i < 30; $i++){
        


            $idProcura = $idFamilia + $cont;  

            $query = "SELECT * FROM GA_SUP_FAMILIA WHERE ID_FAMILIA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_FAMILIA;
                $obj[] = $rs[0]->DENOMINACAO_FAMILIA;
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->COD_UNIDADE;

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_SUP_FAMILIA WHERE DENOMINACAO_FAMILIA LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FAMILIA;
                $obj[] = $rs[0]->DENOMINACAO_FAMILIA;
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->COD_UNIDADE;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_SUP_FAMILIA WHERE ID_FAMILIA = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FAMILIA;
                $obj[] = $rs[0]->DENOMINACAO_FAMILIA;
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->COD_UNIDADE;
                
                return json_encode($obj);
            }
            else{
                return false;
            }         
            
        }    
    }
    
    public function getGrid($indice, $ordem, $inicio, $tamanho, $draw){
        
        
        $this->initConBanco();
        
        $count = $this->getCountGrid();

        $grid = array();

        $grid['draw'] = $draw; // mecanismo de conformidade
        $grid['recordsTotal'] = $count; // total de registros 
        $grid['recordsFiltered'] = $count; // tota de registros filtrados

        $data = array(); // linhas
        //$itens = $this->getDataGrid($indice, $ordem, $inicio, $tamanho, $parametro1, $parametro2);
        
        $query = "SELECT * FROM GA_SUP_FAMILIA ORDER BY ID_FAMILIA";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_FAMILIA;

            
            $obj['CODIGO_FAMILIA'] = $item->ID_FAMILIA;
            $obj['DENOMINACAO'] = $item->DENOMINACAO_FAMILIA;
            $obj['DATA_CADASTRO'] = $item->DATA_CADASTRO;
            $obj['UNIDADE_MEDIDA'] = $item->COD_UNIDADE;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
          
            

            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GA_SUP_FAMILIA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idFamilia){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_SUP_FAMILIA WHERE ID_FAMILIA = $idFamilia";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_FAMILIA;
            $obj[] = $rs[0]->DENOMINACAO_FAMILIA;
            $obj[] = $rs[0]->DATA_CADASTRO;
            $obj[] = $rs[0]->COD_UNIDADE;
            

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    public function carregarUnidadeMedida(){
        
        $this->initConBanco();

        $query = "SELECT CODIGO_UNIDADE FROM GA_SUP_UNIDADE_MEDIDA ORDER BY CODIGO_UNIDADE ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = '';

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $codUnidade = $item->CODIGO_UNIDADE;
                $html .= "<option value='$codUnidade'>$codUnidade</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Unidade de Medida Cadastrada</option>";
        }
    
        
    }

}
