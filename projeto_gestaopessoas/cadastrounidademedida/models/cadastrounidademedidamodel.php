<?php

class cadastrounidademedidamodel extends CI_Model {

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

   public function salvar($codigoUnidade, $denominacaoUnidade, $ativoUnidade){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA  WHERE CODIGO_UNIDADE = '$codigoUnidade' OR DENOMINACAO = '$denominacaoUnidade'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_SUP_UNIDADE_MEDIDA SET CODIGO_UNIDADE = '$codigoUnidade', DENOMINACAO = '$denominacaoUnidade', ATIVO = '$ativoUnidade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE CODIGO_UNIDADE = '$codigoUnidade' OR DENOMINACAO = '$denominacaoUnidade'";

            
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
            
            $query = "SELECT MAX(ID) AS ID FROM  GA_SUP_UNIDADE_MEDIDA";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GA_SUP_UNIDADE_MEDIDA (ID, CODIGO_UNIDADE, DENOMINACAO, DATA_CADASTRO, USUARIO_CADASTRO, ATIVO)
                             VALUES ($novoId, '$codigoUnidade', '$denominacaoUnidade', SYSDATE, '$usuarioLogado', '$ativoUnidade')";     

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
    
    public function excluir($codigoUnidade){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_SUP_UNIDADE_MEDIDA WHERE CODIGO_UNIDADE = '$codigoUnidade'";
        
        
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
        
        $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA ORDER BY ID";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->CODIGO_UNIDADE;
            $obj[] = $rs[0]->DENOMINACAO;
            $obj[] = $rs[0]->ATIVO;
            $obj[] = $rs[0]->DATA_CADASTRO;
            $obj[] = $rs[0]->USUARIO_CADASTRO;
            
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA ORDER BY ID";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->CODIGO_UNIDADE;
            $obj[] = $rs[$cont]->DENOMINACAO;
            $obj[] = $rs[$cont]->ATIVO;
            $obj[] = $rs[$cont]->DATA_CADASTRO;
            $obj[] = $rs[$cont]->USUARIO_CADASTRO;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($codigoUnidade){
        
        $this->initConBanco();
        
        $query = "SELECT ID FROM GA_SUP_UNIDADE_MEDIDA WHERE CODIGO_UNIDADE = '$codigoUnidade'";
        
       // print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $id = $rs[0]->ID;
        
          
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $id - $cont;  

            $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA WHERE ID =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->CODIGO_UNIDADE;
                $obj[] = $rs[0]->DENOMINACAO;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->DATA_CADASTRO;


                return json_encode($obj);
            }
            $cont++;
        }
           
    }
    
     public function buscaRegistroProximo($codigoUnidade){
         
       
        
        $this->initConBanco();
        
        $query = "SELECT ID FROM GA_SUP_UNIDADE_MEDIDA WHERE CODIGO_UNIDADE = '$codigoUnidade'";
        
       // print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $id = $rs[0]->ID;
        
          
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $id + $cont;  

            $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA WHERE ID =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->CODIGO_UNIDADE;
                $obj[] = $rs[0]->DENOMINACAO;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->DATA_CADASTRO;


                return json_encode($obj);
            }
            $cont++;
      
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
      $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA WHERE DENOMINACAO LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->CODIGO_UNIDADE;
                $obj[] = $rs[0]->DENOMINACAO;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->DATA_CADASTRO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA WHERE CODIGO_UNIDADE LIKE '%$idInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                
                $obj[] = $rs[0]->CODIGO_UNIDADE;
                $obj[] = $rs[0]->DENOMINACAO;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->DATA_CADASTRO;

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
        
        $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA ORDER BY ID";
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID;
            
            $obj['CODIGO_UNIDADE'] = $item->CODIGO_UNIDADE;
            $obj['DENOMINACAO'] = $item->DENOMINACAO;
            $obj['ATIVO'] = $item->ATIVO;
            $obj['USUARIO_CADASTRO'] = $item->USUARIO_CADASTRO;
            $obj['DATA_CADASTRO'] = $item->DATA_CADASTRO;
            $obj['USUARIO_ALTERACAO'] = $item->USUARIO_ALTERACAO;
            $obj['DATA_ALTERACAO'] = $item->DATA_ALTERACAO;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
          
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GA_SUP_UNIDADE_MEDIDA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idCod){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_SUP_UNIDADE_MEDIDA WHERE ID = $idCod";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->CODIGO_UNIDADE;
            $obj[] = $rs[0]->DENOMINACAO;
            $obj[] = $rs[0]->ATIVO;
            $obj[] = $rs[0]->DATA_CADASTRO;
            $obj[] = $rs[0]->USUARIO_CADASTRO;
            

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
}
