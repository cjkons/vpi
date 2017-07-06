<?php

class cadastrousuariomodel extends CI_Model {

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
        
        $query = "SELECT max(ID) AS ID FROM  GP_CADASTRO_USUARIO";
                        
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
    

    public function salvar($idUsuario, $nomeUsuario, $sobrenomeUsuario, $emailUsuario, $empresaUsuario, $ativoUsuario, $loginUsuario, $senha, $dataNascimento, $matricula, $cargo){
        
        $this->initConBanco();
        
        
        $usuarioLogado = "teste";
        
        $query = "SELECT * FROM GP_CADASTRO_USUARIO  WHERE ID = $idUsuario";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        
                
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CADASTRO_USUARIO SET ID_EMPRESA = '$empresaUsuario',  NOME  = '$nomeUsuario' , SOBRENOME = '$sobrenomeUsuario', EMAIL = '$emailUsuario', DATA_NASCIMENTO = '$dataNascimento', LOGIN = '$loginUsuario', SENHA = '$senha', IES_ATIVO = '$ativoUsuario', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERADOR = '$usuarioLogado' WHERE ID = $idUsuario";
            
            $resultado = $this->conBanco->query($query);
               
            if($resultado == true){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID) AS ID FROM GP_CADASTRO_USUARIO";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GP_CADASTRO_USUARIO (ID, ID_EMPRESA, NOME, SOBRENOME, LOGIN, EMAIL, SENHA, IES_ATIVO, DATA_CADASTRO, USUARIO_CADASTRO, MATRICULA, CARGO, DATA_NASCIMENTO)
                            VALUES ($idUsuario,'$empresaUsuario', '$nomeUsuario', '$sobrenomeUsuario', '$loginUsuario', '$emailUsuario', '$senha', '$ativoUsuario', SYSDATE, '$usuarioLogado', '$matricula', '$cargo', '$dataNascimento')";     

             
            $resultado = $this->conBanco->query($query);
            
            if($resultado == true){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    public function excluir($idUsuario){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_CADASTRO_USUARIO WHERE ID = $idUsuario";
        
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
        
        $query = "SELECT * FROM GP_CADASTRO_USUARIO ORDER BY ID";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
       
        
        if (is_array($rs) && count($rs) > 0){
            
                        
            
            
            $obj[] = $rs[0]->ID;
            $obj[] = $rs[0]->NOME;
            $obj[] = $rs[0]->SOBRENOME;
            $obj[] = $rs[0]->EMAIL;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->IES_ATIVO;
            $obj[] = $rs[0]->LOGIN;
            $obj[] = $rs[0]->SENHA;
            $obj[] = $rs[0]->DATA_NASCIMENTO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->CARGO;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CADASTRO_USUARIO ORDER BY ID";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            
            $obj[] = $rs[$cont]->ID;
            $obj[] = $rs[$cont]->NOME;
            $obj[] = $rs[$cont]->SOBRENOME;
            $obj[] = $rs[$cont]->EMAIL;
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->IES_ATIVO;
            $obj[] = $rs[$cont]->LOGIN;
            $obj[] = $rs[$cont]->SENHA;
            $obj[] = $rs[$cont]->DATA_NASCIMENTO;
            $obj[] = $rs[$cont]->MATRICULA;
            $obj[] = $rs[$cont]->CARGO;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idUsuario){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idUsuario - $cont;  

            $query = "SELECT * FROM GP_CADASTRO_USUARIO WHERE ID =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
                

                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->NOME;
                $obj[] = $rs[0]->SOBRENOME;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->IES_ATIVO;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->SENHA;
                $obj[] = $rs[0]->DATA_NASCIMENTO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->CARGO;

                return json_encode($obj);
            }
            $cont++;
        }
           
    }
    
     public function buscaRegistroProximo($idUsuario){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
            $idProcura = $idUsuario + $cont;  

            $query = "SELECT * FROM GP_CADASTRO_USUARIO WHERE ID =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
                

                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->NOME;
                $obj[] = $rs[0]->SOBRENOME;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->IES_ATIVO;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->SENHA;
                $obj[] = $rs[0]->DATA_NASCIMENTO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->CARGO;

                return json_encode($obj);
            }
            $cont++;
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_CADASTRO_USUARIO WHERE NOME LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                
                
            
                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->NOME;
                $obj[] = $rs[0]->SOBRENOME;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->IES_ATIVO;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->SENHA;
                $obj[] = $rs[0]->DATA_NASCIMENTO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->CARGO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_CADASTRO_USUARIO WHERE ID LIKE  '%$idInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
                
                
            
                
                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->NOME;
                $obj[] = $rs[0]->SOBRENOME;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->IES_ATIVO;
                $obj[] = $rs[0]->LOGIN;
                $obj[] = $rs[0]->SENHA;
                $obj[] = $rs[0]->DATA_NASCIMENTO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->CARGO;

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
        
        $query = "SELECT * FROM GP_CADASTRO_USUARIO ORDER BY ID";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID;
            
            
            
            $obj['ID'] = $item->ID;
            $obj['NOME'] = $item->NOME;
            $obj['SOBRENOME'] = $item->SOBRENOME;
            $obj['EMAIL'] = $item->EMAIL;
            $obj['EMPRESA'] = $item->ID_EMPRESA;
            $obj['ATIVO'] = $item->IES_ATIVO;
            $obj['LOGIN'] = $item->LOGIN;
            $obj['DATA_NASCIMENTO'] = $item->DATA_NASCIMENTO;
            $obj['CARGO'] = $item->CARGO;
            
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
          
          

            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
      
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GP_CADASTRO_USUARIO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idUsuario){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_CADASTRO_USUARIO WHERE ID = $idUsuario";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            
            
            $obj[] = $rs[0]->ID;
            $obj[] = $rs[0]->NOME;
            $obj[] = $rs[0]->SOBRENOME;
            $obj[] = $rs[0]->EMAIL;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->IES_ATIVO;
            $obj[] = $rs[0]->LOGIN;
            $obj[] = $rs[0]->SENHA;
            $obj[] = $rs[0]->DATA_NASCIMENTO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->CARGO;

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    
    public function carregarEmpresa(){
        
        $this->initConBanco();

        $query = "SELECT ID_EMPRESA, NOME_FANTASIA FROM GP_SYS_EMPRESA ORDER BY NOME_FANTASIA ";
                  
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
}
