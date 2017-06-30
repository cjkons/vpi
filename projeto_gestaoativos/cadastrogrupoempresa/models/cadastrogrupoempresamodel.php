<?php

class cadastrogrupoempresamodel extends CI_Model {

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
        
        $query = "SELECT max(ID_GRUPO_EMPRESA) AS ID_GRUPO_EMPRESA FROM  GA_SYS_GRUPO_EMPRESA";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoIdGrupoEmpresa = $rs[0]->ID_GRUPO_EMPRESA + 1;
        }
        else{
            $novoIdGrupoEmpresa = 1;
            
        }
                
        return $novoIdGrupoEmpresa;
         
    }   
    

    public function salvar($idGrupoEmpresa, $denomincaoGrupoEmpresa){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA  WHERE ID_GRUPO_EMPRESA = $idGrupoEmpresa";
        
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_SYS_GRUPO_EMPRESA SET DENOMINACAO = '$denomincaoGrupoEmpresa', USUARIO_ALTERACAO = '$usuarioLogado', DATA_ALTERACAO = SYSDATE WHERE ID_GRUPO_EMPRESA = $idGrupoEmpresa";

            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID) AS ID FROM  GA_SYS_GRUPO_EMPRESA";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GA_SYS_GRUPO_EMPRESA (ID, ID_GRUPO_EMPRESA, DENOMINACAO, USUARIO_CADASTRO, DATA_CADASTRO)
                             VALUES ($novoId, $idGrupoEmpresa, '$denomincaoGrupoEmpresa', '$usuarioLogado', SYSDATE)";     

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
    
    public function excluir($idGrupoEmpresa){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_SYS_GRUPO_EMPRESA WHERE ID_GRUPO_EMPRESA = $idGrupoEmpresa";
        
        $resultado = $this->conBanco->query($query);
        
        //print_r($resultado);exit();
                        
        if($resultado == true || $resultado == 1){
            return true;            
        }
        else{
            return false;
        }
         
    }
    
    public function buscaPrimeiroRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA ORDER BY ID_GRUPO_EMPRESA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
            $obj[] = $rs[0]->DENOMINACAO;
           
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA ORDER BY ID_GRUPO_EMPRESA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->ID_GRUPO_EMPRESA;
            $obj[] = $rs[$cont]->DENOMINACAO;
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idGrupoEmpresa){
        
        $this->initConBanco();
        
        
         $cont = 1;
                
        for($i =0; $i < 10; $i++){
        

            $idProcura = $idGrupoEmpresa - $cont;  

            $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA WHERE ID_GRUPO_EMPRESA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->DENOMINACAO;


                return json_encode($obj);
            }
            
            $cont++;
        
        }
           
    }
    
     public function buscaRegistroProximo($idGrupoEmpresa){
        
        $this->initConBanco();
        
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idGrupoEmpresa + $cont;  

            $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA WHERE ID_GRUPO_EMPRESA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->DENOMINACAO;

                return json_encode($obj);
            }
            $cont++;
       
        }
      
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA WHERE DENOMINACAO LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->DENOMINACAO;
            
                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA WHERE ID_GRUPO_EMPRESA LIKE '%$idInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                            
                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->DENOMINACAO;
              
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
        
        $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA ORDER BY ID_GRUPO_EMPRESA";
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
                   
            $aux = $item->ID_GRUPO_EMPRESA;
            
            $obj['ID_GRUPO_EMPRESA'] = $item->ID_GRUPO_EMPRESA;
            $obj['DENOMINACAO'] = $item->DENOMINACAO;
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
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GA_SYS_GRUPO_EMPRESA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idGrupoEmpresa){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_SYS_GRUPO_EMPRESA WHERE ID_GRUPO_EMPRESA = $idGrupoEmpresa";
                 
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
            $obj[] = $rs[0]->DENOMINACAO;
                      
            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }

}
