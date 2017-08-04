<?php

class cadastroepimodel extends CI_Model {

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
    
    public function carregarTipoEpi(){
        
        $this->initConBanco();

        $query = "SELECT ID_EPI_TIPO, EQUIPAMENTO, DESCRICAO FROM GP_CAD_EPI_TIPO ORDER BY EQUIPAMENTO ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idTipoEpi         = $item->ID_EPI_TIPO;
                $equipamento       = $item->EQUIPAMENTO;
                $descricao       = $item->DESCRICAO;
                $html .= "<option value='$idTipoEpi'>$equipamento ($descricao)</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }
    
    public function verificarCaDigitado($numeroCa){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_EPI WHERE COD_CA = $numeroCa";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) != null || is_array($rs) && count($rs) != "null"){
         // print_r("true");
            return true;
        }
        else{
           // print_r("false");
            return false;
        }
         
    }

    public function novo(){
        
        $this->initConBanco();
        
        $query = "SELECT max(ID_EPI) AS ID FROM  GP_CAD_EPI";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoIdUsuario = $rs[0]->ID + 1;
        }
        else{
            $novoIdUsuario = 1;
            
        }
                
        return $novoIdUsuario;
         
    }   
    

    public function salvar($idEpi, $numeroCa, $tipoEpi, $descricaoEpi, $validadeCa, $fabricante){
        
        $this->initConBanco();
        
        
        $usuarioLogado = "teste";
        
        $query = "SELECT * FROM GP_CAD_EPI  WHERE COD_CA = $numeroCa";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        
                
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_EPI SET ID_EPI = '$idEpi',  COD_CA  = '$numeroCa' , TIPO_EPI = '$tipoEpi', DESCRICAO_EPI = '$descricaoEpi', VALIDADE_CA = '$validadeCa', FABRICANTE_EPI = '$fabricante', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE COD_CA = $numeroCa";
            
            $resultado = $this->conBanco->query($query);
               
            if($resultado == true){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
                                

            $query = "INSERT INTO GP_CAD_EPI (ID_EPI, COD_CA, TIPO_EPI, DESCRICAO_EPI, VALIDADE_CA, FABRICANTE_EPI, DATA_CADASTRO, USUARIO_CADASTRO)
                            VALUES ($idEpi,'$numeroCa', '$tipoEpi', '$descricaoEpi', '$validadeCa', '$fabricante', SYSDATE, '$usuarioLogado')";     

             
            $resultado = $this->conBanco->query($query);
            
            if($resultado == true){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    public function excluir($idEpi){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_CAD_EPI WHERE ID_EPI = $idEpi";
        
        //print_r($query);exit();
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
        
        $query = "SELECT * FROM GP_CAD_EPI ORDER BY ID_EPI";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
       
        
        if (is_array($rs) && count($rs) > 0){
            
                        
            
            
            $obj[] = $rs[0]->ID_EPI;
            $obj[] = $rs[0]->COD_CA;
            $obj[] = $rs[0]->TIPO_EPI;
            $obj[] = $rs[0]->DESCRICAO_EPI;
            $obj[] = $rs[0]->VALIDADE_CA;
            $obj[] = $rs[0]->FABRICANTE_EPI;
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_EPI ORDER BY ID_EPI";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            
            $obj[] = $rs[$cont]->ID_EPI;
            $obj[] = $rs[$cont]->COD_CA;
            $obj[] = $rs[$cont]->TIPO_EPI;
            $obj[] = $rs[$cont]->DESCRICAO_EPI;
            $obj[] = $rs[$cont]->VALIDADE_CA;
            $obj[] = $rs[$cont]->FABRICANTE_EPI;
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idEpi){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idEpi - $cont;  

            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
                

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
    
     public function buscaRegistroProximo($idEpi){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idEpi + $cont;  

            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
                

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
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_CAD_EPI WHERE COD_CA LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                
                
            
                $obj[] = $rs[0]->ID_EPI;
                $obj[] = $rs[0]->COD_CA;
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->DESCRICAO_EPI;
                $obj[] = $rs[0]->VALIDADE_CA;
                $obj[] = $rs[0]->FABRICANTE_EPI;
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI LIKE  '%$idInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                
                
            
                $obj[] = $rs[0]->ID_EPI;
                $obj[] = $rs[0]->COD_CA;
                $obj[] = $rs[0]->TIPO_EPI;
                $obj[] = $rs[0]->DESCRICAO_EPI;
                $obj[] = $rs[0]->VALIDADE_CA;
                $obj[] = $rs[0]->FABRICANTE_EPI;
                

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
        
        $query = "SELECT * FROM GP_CAD_EPI ORDER BY ID_EPI";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_EPI;
            
            $tipoEpi = $item->TIPO_EPI;
            
            $query = "SELECT EQUIPAMENTO FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $tipoEpi";
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $equipamento = $rs[0]->EQUIPAMENTO;
            
            $obj['ID_EPI'] = $item->ID_EPI;
            $obj['COD_CA'] = $item->COD_CA;
            $obj['TIPO_EPI'] = $equipamento;
            $obj['DESCRICAO_EPI'] = $item->DESCRICAO_EPI;
            $obj['VALIDADE_CA'] = $item->VALIDADE_CA;
            $obj['FABRICANTE_EPI'] = $item->FABRICANTE_EPI;
            
            
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
          
          

            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
      
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_EPI) AS TOTAL FROM GP_CAD_EPI";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idEpi){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_CAD_EPI WHERE ID_EPI = $idEpi";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            
            
            $obj[] = $rs[0]->ID_EPI;
            $obj[] = $rs[0]->COD_CA;
            $obj[] = $rs[0]->TIPO_EPI;
            $obj[] = $rs[0]->DESCRICAO_EPI;
            $obj[] = $rs[0]->VALIDADE_CA;
            $obj[] = $rs[0]->FABRICANTE_EPI;
            
            

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    
    
}
