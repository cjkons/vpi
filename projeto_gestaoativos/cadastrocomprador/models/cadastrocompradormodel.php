<?php

class cadastrocompradormodel extends CI_Model {

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
        
        $query = "SELECT max(ID_COMPRADOR) AS ID_COMPRADOR FROM  GA_SUP_COMPRADOR";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoIdUsuario = $rs[0]->ID_COMPRADOR + 1;
        }
        else{
            $novoIdUsuario = 1;
            
        }
                
        return $novoIdUsuario;
         
    }   
    

    public function salvar($idComprador, $idEmpresa, $idFilial, $nomeComprador, $login, $ativo){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_COMPRADOR  WHERE ID_COMPRADOR = $idComprador";
        
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_SUP_COMPRADOR  SET ID_EMPRESA = $idEmpresa, ID_FILIAL = '$idFilial', NOME_COMPRADOR = '$nomeComprador',  LOGIN = '$login', ATIVO = '$ativo', USUARIO_ALTERACAO = '$usuarioLogado', DATA_ALTERACAO = SYSDATE  WHERE ID_COMPRADOR = $idComprador";

            $resultado = $this->conBanco->query($query);
            //print_r($query); exit();    
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID_COMPRADOR) AS ID_COMPRADOR FROM  GA_SUP_COMPRADOR";
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID_COMPRADOR + 1;
            }                       
           
            $query = "INSERT INTO GA_SUP_COMPRADOR (ID_COMPRADOR, ID_EMPRESA, ID_FILIAL, NOME_COMPRADOR, LOGIN, ATIVO, USUARIO_CADASTRO, DATA_CADASTRO)
                             VALUES ($novoId, $idEmpresa, $idFilial, '$nomeComprador', '$login', '$ativo', '$usuarioLogado', SYSDATE)";     
            //print_r($query); exit();
          
            $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    public function excluir($idComprador){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_SUP_COMPRADOR WHERE ID_COMPRADOR = $idComprador";
        
        
        
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
        
        $query = "SELECT * FROM GA_SUP_COMPRADOR ORDER BY ID_COMPRADOR";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_COMPRADOR;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->NOME_COMPRADOR;
            $obj[] = $rs[0]->LOGIN;
            $obj[] = $rs[0]->ATIVO;
            
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_COMPRADOR ORDER BY ID_COMPRADOR";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->ID_COMPRADOR;
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->ID_FILIAL;
            $obj[] = $rs[$cont]->NOME_COMPRADOR;
            $obj[] = $rs[$cont]->LOGIN;
            $obj[] = $rs[$cont]->ATIVO;
            
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idComprador){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
        
            $idProcura = $idComprador - $cont;  

            $query = "SELECT * FROM GA_SUP_COMPRADOR WHERE ID_COMPRADOR =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_COMPRADOR;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->NOME_COMPRADOR;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->ATIVO;
                
                

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximo($idComprador){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        

            $idProcura = $idComprador + $cont;  

            $query = "SELECT * FROM GA_SUP_COMPRADOR WHERE ID_COMPRADOR =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_COMPRADOR;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->NOME_COMPRADOR;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->ATIVO;
                
                

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_SUP_COMPRADOR WHERE NOME_COMPRADOR LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_COMPRADOR;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->NOME_COMPRADOR;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->ATIVO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_SUP_COMPRADOR WHERE ID_COMPRADOR = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_COMPRADOR;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->NOME_COMPRADOR;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->ATIVO;
                
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
        
        $query = "SELECT * FROM GA_SUP_COMPRADOR ORDER BY ID_COMPRADOR";
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_COMPRADOR;
            $idEmpresa = $item->ID_EMPRESA;
            $idFilial = $item->ID_FILIAL;
            
            $itens = $cs->result();
            
            $query = "SELECT NOME_FANTASIA FROM GA_SYS_EMPRESA WHERE ID_EMPRESA = $idEmpresa ";
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $query = "SELECT NOME_FANTASIA FROM GA_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = $idFilial ";
            
            $cf = $this->conBanco->query($query);
            $rf = $cf->result();
            //print_r($query); exit();
            
            if(is_array($rf) && count($rf) > 0){
                $nomeFantasia = $rf[0]->NOME_FANTASIA;
                
            }
            else{
                $nomeFantasia = " - ";
            }
            
            
            $obj['ID_COMPRADOR'] = $item->ID_COMPRADOR;
            $obj['ID_EMPRESA'] = $rs[0]->NOME_FANTASIA;
            $obj['ID_FILIAL'] = $nomeFantasia;
            $obj['NOME_COMPRADOR'] = $item->NOME_COMPRADOR;
            $obj['LOGIN'] = $item->LOGIN;
            $obj['ATIVO'] = $item->ATIVO;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
           
                
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
              
   
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_COMPRADOR) AS TOTAL FROM GA_SUP_COMPRADOR";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idComprador){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_SUP_COMPRADOR WHERE ID_COMPRADOR = $idComprador";
       // print_r($query); exit();    
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_COMPRADOR;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->NOME_COMPRADOR;
            $obj[] = $rs[0]->LOGIN;
            $obj[] = $rs[0]->ATIVO;
            
            
            //$obj['ID_EMPRESA'] = $item->ID_EMPRESA;
            //$obj['ID_COMPRADOR'] = $item->ID_COMPRADOR;
            //$obj['NOME_COMPRADOR'] = $item->NOME_COMPRADOR;
            //$obj['LOGIN'] = $item->LOGIN;
            //$obj['ATIVO'] = $item->ATIVO;
            //$obj['ID_FILIAL'] = $item->ID_FILIAL;

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    
    public function carregarEmpresa(){
        
        $this->initConBanco();

        $query = "SELECT ID_EMPRESA, NOME_FANTASIA FROM GA_SYS_EMPRESA ORDER BY NOME_FANTASIA ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $codEmpresa         = $item->ID_EMPRESA;
                $nomeFantasia       = $item->NOME_FANTASIA;
                $html .= "<option value='$codEmpresa'>$nomeFantasia</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }

    public function carregarFilial($idEmpresa){
        
        $this->initConBanco();

        if($idEmpresa != ''){
            $query = "SELECT * FROM GA_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA = '$idEmpresa'";
        
        }else{
            $query = "SELECT * FROM GA_SYS_EMPRESA_FILIAL";
        }
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idFilial          = $item->ID_EMPRESA_FILIAL;
                $nomeFantasia       = $item->NOME_FANTASIA;
                $html .= "<option value='$idFilial'>$nomeFantasia</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }
    
    

}
