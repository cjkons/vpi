<?php

class cadastroepitipomodel extends CI_Model {

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
        
        $query = "SELECT max(ID_EPI_TIPO) AS ID FROM  GP_CAD_EPI_TIPO";
                        
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
    

    public function salvar($idEpiTipo, $tipoEpi, $descricao){
        
        $this->initConBanco();
        
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        //$usuarioLogado = "teste";
        
        $query = "SELECT * FROM GP_CAD_EPI_TIPO  WHERE EQUIPAMENTO = '$tipoEpi'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
                
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_EPI_TIPO SET EQUIPAMENTO  = '$tipoEpi' , DESCRICAO = '$descricao', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE EQUIPAMENTO = '$tipoEpi'";
            
            $resultado = $this->conBanco->query($query);
               
            if($resultado == true){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
                                

            $query = "INSERT INTO GP_CAD_EPI_TIPO (ID_EPI_TIPO, EQUIPAMENTO, DESCRICAO, DATA_CADASTRO, USUARIO_CADASTRO)
                            VALUES ($idEpiTipo,'$tipoEpi', '$descricao', SYSDATE, '$usuarioLogado')";     

             
            $resultado = $this->conBanco->query($query);
            
            if($resultado == true){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    public function excluir($idEpiTipo){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $idEpiTipo";
        
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
        
        $query = "SELECT * FROM GP_CAD_EPI_TIPO ORDER BY ID_EPI_TIPO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
       
        
        if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EPI_TIPO;
                $obj[] = $rs[0]->EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_EPI_TIPO ORDER BY ID_EPI_TIPO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->ID_EPI_TIPO;
            $obj[] = $rs[$cont]->EQUIPAMENTO;
            $obj[] = $rs[$cont]->DESCRICAO;
            
            
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idEpiTipo){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idEpiTipo - $cont;  

            $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
                $obj[] = $rs[0]->ID_EPI_TIPO;
                $obj[] = $rs[0]->EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
                    
                

                return json_encode($obj);
            }
            $cont++;
        }
           
    }
    
     public function buscaRegistroProximo($idEpiTipo){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idEpiTipo + $cont;  

            $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
                

                $obj[] = $rs[0]->ID_EPI_TIPO;
                $obj[] = $rs[0]->EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
            
                

                return json_encode($obj);
            }
            $cont++;
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE EQUIPAMENTO LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                
                
            
                $obj[] = $rs[0]->ID_EPI_TIPO;
                $obj[] = $rs[0]->EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
            
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO LIKE  '%$idInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                
                
                $obj[] = $rs[0]->ID_EPI_TIPO;
                $obj[] = $rs[0]->EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
            
                

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
        
        $query = "SELECT * FROM GP_CAD_EPI_TIPO ORDER BY ID_EPI_TIPO";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_EPI_TIPO;
            
            
            
            $obj['ID_EPI_TIPO'] = $item->ID_EPI_TIPO;
            $obj['EQUIPAMENTO'] = $item->EQUIPAMENTO;
            $obj['DESCRICAO'] = $item->DESCRICAO;
            
            
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
          
          

            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
      
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_EPI_TIPO) AS TOTAL FROM GP_CAD_EPI_TIPO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idEpiTipo){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_CAD_EPI_TIPO WHERE ID_EPI_TIPO = $idEpiTipo";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            
            
            $obj[] = $rs[0]->ID_EPI_TIPO;
            $obj[] = $rs[0]->EQUIPAMENTO;
            $obj[] = $rs[0]->DESCRICAO;
            
            

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    
    
}
