<?php

class cadastrocontamodel extends CI_Model {

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

   

    public function salvar($idEmpresa, $idFilial, $idBanco, $agencia, $conta, $observacao){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM FIN_CONTA  WHERE CONTA LIKE '%$conta%' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial AND ID_BANCO = $idBanco AND AGENCIA = '$agencia'";
        
          //print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
      
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE FIN_CONTA  SET  OBSERVACAO = '$observacao',   DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE CONTA LIKE '%$conta%' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial AND ID_BANCO = $idBanco";

            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID_CONTA) AS ID FROM  FIN_CONTA";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO FIN_CONTA (ID_CONTA, ID_EMPRESA, ID_FILIAL, ID_BANCO,  AGENCIA, CONTA, OBSERVACAO, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($novoId, $idEmpresa, $idFilial, $idBanco,  '$agencia','$conta','$observacao', SYSDATE, '$usuarioLogado')";     

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
    
    public function excluir($agencia, $idEmpresa, $idFilial, $idBanco, $conta){
        
        $this->initConBanco();
        
        $query = "DELETE FROM FIN_CONTA WHERE ID_BANCO = '$idBanco' AND ID_EMPRESA = $idEmpresa AND  ID_FILIAL = $idFilial AND AGENCIA = '$agencia' AND CONTA = '$conta'";
        
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
        
        $query = "SELECT * FROM FIN_CONTA ORDER BY ID_CONTA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->ID_BANCO;
            $obj[] = $rs[0]->AGENCIA;
            $obj[] = $rs[0]->CONTA;
            $obj[] = $rs[0]->OBSERVACAO;
          
               
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM FIN_CONTA ORDER BY ID_CONTA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->ID_FILIAL;
            $obj[] = $rs[$cont]->ID_BANCO;
            $obj[] = $rs[$cont]->AGENCIA;
            $obj[] = $rs[$cont]->CONTA;
            $obj[] = $rs[$cont]->OBSERVACAO;
           
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idEmpresa, $idFilial, $idBanco, $agencia, $conta){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
            
            
            $query = "SELECT * FROM FIN_CONTA WHERE ID_BANCO =  '$idBanco' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial AND AGENCIA = '$agencia' AND CONTA = '$conta'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $idGrupo = $rs[0]->ID_CONTA;
                    
            $idProcura = $idGrupo - $cont;  

            $query = "SELECT * FROM FIN_CONTA WHERE ID_CONTA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_BANCO;
                $obj[] = $rs[0]->AGENCIA;
                $obj[] = $rs[0]->CONTA;
                $obj[] = $rs[0]->OBSERVACAO;
                
               
                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximo($idEmpresa, $idFilial, $idBanco, $agencia, $conta){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
                       
            $query = "SELECT * FROM FIN_CONTA WHERE ID_BANCO =  '$idBanco' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial AND AGENCIA = '$agencia' AND CONTA = '$conta'";

            //print_r($query);exit();
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            //print_r($query);exit();
            
            $idGrupo = $rs[0]->ID_CONTA;
                    
            $idProcura = $idGrupo + $cont;                  

            $query = "SELECT * FROM FIN_CONTA WHERE ID_CONTA =  '$idProcura'";
            
            //print_r($query);exit();

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_BANCO;
                $obj[] = $rs[0]->AGENCIA;
                $obj[] = $rs[0]->CONTA;
                $obj[] = $rs[0]->OBSERVACAO;
               

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM FIN_CONTA WHERE AGENCIA LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_BANCO;
                $obj[] = $rs[0]->AGENCIA;
                $obj[] = $rs[0]->CONTA;
                $obj[] = $rs[0]->OBSERVACAO;
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM FIN_CONTA WHERE CONTA = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_BANCO;
                $obj[] = $rs[0]->AGENCIA;
                $obj[] = $rs[0]->CONTA;
                $obj[] = $rs[0]->OBSERVACAO;
                
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
        
        $query = "SELECT * FROM FIN_CONTA ORDER BY ID_CONTA";
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_CONTA;
            
            $query = "SELECT NOME_FANTASIA FROM SYS_EMPRESA WHERE ID_EMPRESA = $item->ID_EMPRESA";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $empresa = $rs[0]->NOME_FANTASIA;
            }
            else{
                $empresa = '-';
            }
            
            
            $query = "SELECT NOME_FANTASIA FROM SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = $item->ID_FILIAL";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $filial = $rs[0]->NOME_FANTASIA;
            }
            else{
                $filial = '-';
            }
            
            
            $query = "SELECT NOME FROM FIN_BANCO WHERE ID_BANCO = $item->ID_BANCO";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $banco = $rs[0]->NOME;
            }
            else{
                $filial = '-';
            }
            
            
            $query = "SELECT NOME FROM FIN_AGENCIA WHERE ID_AGENCIA = $item->AGENCIA";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $agencia = $rs[0]->NOME;
            }
            else{
                $agencia = '-';
            }
            
            
            
            $obj['EMPRESA'] = $empresa;
            $obj['FILIAL'] = $filial;
            $obj['BANCO'] = $banco;
            $obj['AGENCIA'] = $agencia;
            $obj['CONTA'] = $item->CONTA;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
           
                
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
              
   
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_BANCO) AS TOTAL FROM FIN_BANCO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idBanco){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM FIN_CONTA WHERE ID_CONTA = $idBanco";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->ID_BANCO;
            $obj[] = $rs[0]->AGENCIA;
            $obj[] = $rs[0]->CONTA;
            $obj[] = $rs[0]->OBSERVACAO;
          
            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    public function carregarEmpresa(){
        
        $this->initConBanco();

        $query = "SELECT ID_EMPRESA, NOME_FANTASIA FROM SYS_EMPRESA  WHERE ATIVO = 'S' ORDER BY NOME_FANTASIA ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idEmpresa = $item->ID_EMPRESA;
                $nome      = $item->NOME_FANTASIA;
                $html .= "<option value='$idEmpresa'>$nome</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Empresa Cadastrado</option>";
        }
           
        
    }
    
    public function carregarFilial($idEmpresa){
        
        $this->initConBanco();        
        

        if($idEmpresa != ""){
        
            $query = "SELECT * FROM SYS_EMPRESA_FILIAL WHERE ID_EMPRESA = '$idEmpresa'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idEmpresa = $item->ID_EMPRESA_FILIAL;
                    $nome      = $item->NOME_FANTASIA;
                    $html .= "<option value='$idEmpresa'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Filial Cadastrada</option>";
            }
        }
        else{
            
            $query = "SELECT * FROM SYS_EMPRESA_FILIAL ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idEmpresa = $item->ID_EMPRESA_FILIAL;
                    $nome      = $item->NOME_FANTASIA;
                    $html .= "<option value='$idEmpresa'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Filial Cadastrada</option>";
            }
            
            
        }
        
    }
    
    public function carregarBanco($idEmpresa, $idFilial){
        
        $this->initConBanco();        
        

        if($idEmpresa != "" && $idFilial){
        
            $query = "SELECT * FROM FIN_BANCO WHERE ID_EMPRESA = '$idEmpresa' AND ID_FILIAL = $idFilial ORDER BY ID_BANCO";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idBanco = $item->ID_BANCO;
                    $nome = $item->COD_BANCO;
                    $nome .= " - "; 
                    $nome .= $item->NOME;
                    $html .= "<option value='$idBanco'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhum Banco Cadastrado</option>";
            }
        }
        else{
            
            $query = "SELECT * FROM FIN_BANCO ORDER BY ID_BANCO";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idBanco = $item->ID_BANCO;
                    $nome = $item->COD_BANCO;
                    $nome .= " - "; 
                    $nome .= $item->NOME;
                    $html .= "<option value='$idBanco'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Banco Cadastrado</option>";
            }
            
            
        }
        
    }
    
     public function carregarAgencia($idEmpresa, $idFilial, $idBanco){
        
        $this->initConBanco();        
        

        if($idEmpresa != "" && $idFilial){
        
            $query = "SELECT * FROM FIN_AGENCIA WHERE ID_EMPRESA = '$idEmpresa' AND ID_FILIAL = $idFilial AND ID_BANCO = $idBanco ORDER BY ID_AGENCIA";

            //print_r($query);exit();
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idAgencia = $item->ID_AGENCIA;
                    $nome = $item->AGENCIA;
                    $nome .= " - "; 
                    $nome .= $item->NOME;
                    $html .= "<option value='$idAgencia'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Agência Cadastrado</option>";
            }
        }
        else{
            
            $query = "SELECT * FROM FIN_AGENCIA ORDER BY ID_AGENCIA";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idAgencia = $item->ID_AGENCIA;
                    $nome = $item->AGENCIA;
                    $nome .= " - "; 
                    $nome .= $item->NOME;
                    $html .= "<option value='$idAgencia'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Banco Cadastrado</option>";
            }
            
            
        }
        
    }
    
   
    
   
}
