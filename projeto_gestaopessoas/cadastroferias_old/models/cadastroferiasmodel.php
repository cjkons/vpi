<?php

class cadastroferiasmodel extends CI_Model {

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
        
        $query = "SELECT MAX(ID_FERIAS) AS ID_FERIAS FROM GP_CAD_FERIAS";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_FERIAS + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    } 

   

    public function salvar($codGrupo, $descricaoGrupo, $idEmpresa, $idFilial){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO  WHERE COD_GRUPO LIKE '%$codGrupo%' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        //print_r($query);exit();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_EQP_GRUPO_EQUIPAMENTO  SET DESCRICAO = '$descricaoGrupo', ID_EMPRESA = '$idEmpresa', ID_FILIAL = '$idFilial',  DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE COD_GRUPO LIKE '$codGrupo'  AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial";

            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID_GRUPO) AS ID FROM  GP_EQP_GRUPO_EQUIPAMENTO";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GP_EQP_GRUPO_EQUIPAMENTO (ID_GRUPO, ID_EMPRESA, ID_FILIAL, COD_GRUPO, DESCRICAO, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($novoId, $idEmpresa, $idFilial, '$codGrupo','$descricaoGrupo', SYSDATE, '$usuarioLogado')";     

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
    
    public function excluir($codGrupo){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE COD_GRUPO = '$codGrupo'";
        
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
        
        $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO ORDER BY ID_GRUPO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->COD_GRUPO;
            $obj[] = $rs[0]->DESCRICAO;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
               
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO ORDER BY ID_GRUPO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->COD_GRUPO;
            $obj[] = $rs[$cont]->DESCRICAO;
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->ID_FILIAL;
           
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($codGrupo){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
            
            
            $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE COD_GRUPO =  '$codGrupo'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $idGrupo = $rs[0]->ID_GRUPO;
                    
            $idProcura = $idGrupo - $cont;  

            $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE ID_GRUPO =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->COD_GRUPO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                
               
                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximo($codGrupo){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
                       
            $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE COD_GRUPO =  '$codGrupo'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            //print_r($query);exit();
            
            $idGrupo = $rs[0]->ID_GRUPO;
                    
            $idProcura = $idGrupo + $cont;                  

            $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE ID_GRUPO =  '$idProcura'";
            
            //print_r($query);exit();

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->COD_GRUPO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
               

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE DESCRICAO LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->COD_GRUPO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE COD_GRUPO = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->COD_GRUPO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                
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
        
        $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO ORDER BY ID_GRUPO";
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_GRUPO;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA WHERE ID_EMPRESA = $item->ID_EMPRESA";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $empresa = $rs[0]->NOME_FANTASIA;
            }
            else{
                $empresa = '-';
            }
            
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = $item->ID_FILIAL";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $filial = $rs[0]->NOME_FANTASIA;
            }
            else{
                $filial = '-';
            }
            
            
            $obj['EMPRESA'] = $empresa;
            $obj['FILIAL'] = $filial;
            $obj['COD_GRUPO'] = $item->COD_GRUPO;
            $obj['DESCRICAO'] = $item->DESCRICAO;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
           
                
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
              
   
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_GRUPO) AS TOTAL FROM GP_EQP_GRUPO_EQUIPAMENTO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idGrupo){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_EQP_GRUPO_EQUIPAMENTO WHERE ID_GRUPO = $idGrupo";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->COD_GRUPO;
            $obj[] = $rs[0]->DESCRICAO;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
          
            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    public function carregarEmpresa(){
        
        $this->initConBanco();

        $query = "SELECT ID_EMPRESA, NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ATIVO = 'S' ORDER BY NOME_FANTASIA ";
                  
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
        
            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA = '$idEmpresa'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idFilial = $item->ID_EMPRESA_FILIAL;
                    $nome      = $item->NOME_FANTASIA;
                    $html .= "<option value='$idFilial'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Filial Cadastrada</option>";
            }
        }
        else{
            
            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idFilial = $item->ID_EMPRESA_FILIAL;
                    $nome      = $item->NOME_FANTASIA;
                    $html .= "<option value='$idFilial'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Filial Cadastrada</option>";
            }
            
            
        }
        
    }
    
    public function carregarFuncionario($idEmpresa, $idFilial){
        
        $this->initConBanco();

        if($idEmpresa != ''){
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE EMPRESA = '$idEmpresa' AND FILIAL = '$idFilial'";
         //print_r($query);exit(); 
        }else{
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO";
        }
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idFuncionario          = $item->ID_FUNCIONARIO;
                $nomeFuncionario       = $item->NOME_FUNCIONARIO;
                $html .= "<option value='$idFuncionario'>$nomeFuncionario</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Funcionário Cadastrado</option>";
        }
        
    }
    
    public function carregarDadosFuncionario($idEmpresa, $idFilial, $funcionario){
        
        $this->initConBanco();

        if($idEmpresa != 0){
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE EMPRESA = '$idEmpresa' AND FILIAL = '$idFilial' AND ID_FUNCIONARIO = '$funcionario'";
         //print_r($query);exit(); 
        }else{
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $funcionario";
             //print_r($query);
        }
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $funcao = $rs[0]->FUNCAO;
        $setor = $rs[0]->SETOR;
        
        $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";
                  
        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();
        
        $descFuncao = $rs1[0]->FUNCAO;
        
        $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";
                  
        $cs = $this->conBanco->query($query);
        $rs2 = $cs->result();
        
        $descSetor = $rs2[0]->SETOR;
                
        
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->DATA_ADMISSAO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $descSetor;
            $obj[] = $descFuncao;
            
          
            
            return json_encode($obj);
        }
        else{
            
            return false;
        }   
        
    }
    
   
    
   
}
