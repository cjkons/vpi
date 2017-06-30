<?php

class cadastroequipamentomodel extends CI_Model {

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

   

    public function salvar($idEmpresa, $idFilial, $codGrupo, $codEquipamento, $descricao, $placa, $ano, $marca, $kmCadastro, $apelido, $dataAquisicao, $ativo, $imagem){
        
        $this->initConBanco();
        
        //print_r($imagem);exit();
        
        $query = "SELECT * FROM GA_EQP_EQUIPAMENTO  WHERE COD_EQUIPAMENTO LIKE '%$codEquipamento%' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        //print_r($query);exit();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_EQP_EQUIPAMENTO  SET ID_EMPRESA = '$idEmpresa', ID_FILIAL = '$idFilial', ID_GRUPO = '$codGrupo', DESCRICAO = '$descricao', PLACA = '$placa', ANO = '$ano', MARCA = '$marca', KM_CADASTRO = $kmCadastro, APELIDO = '$apelido',  DATA_AQUISICAO = '$dataAquisicao', ATIVO = '$ativo', IMAGEM = '$imagem', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE COD_EQUIPAMENTO LIKE '$codEquipamento' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial";

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
            
            $query = "SELECT MAX(ID_EQUIPAMENTO) AS ID FROM  GA_EQP_EQUIPAMENTO";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GA_EQP_EQUIPAMENTO (ID_EQUIPAMENTO, ID_EMPRESA, ID_FILIAL, ID_GRUPO, COD_EQUIPAMENTO, DESCRICAO, PLACA, ANO, MARCA, KM_CADASTRO, APELIDO, DATA_AQUISICAO, IMAGEM, ATIVO,  DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($novoId, $idEmpresa, $idFilial, '$codGrupo', '$codEquipamento', '$descricao', '$placa', $ano, '$marca', $kmCadastro, '$apelido', '$dataAquisicao', '$imagem', '$ativo', SYSDATE, '$usuarioLogado')";     

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
    
    public function excluir($codEquipamento){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_EQP_EQUIPAMENTO WHERE COD_EQUIPAMENTO = '$codEquipamento'";
        
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
        
        $query = "SELECT * FROM GA_EQP_EQUIPAMENTO ORDER BY ID_EQUIPAMENTO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->ID_GRUPO;
            $obj[] = $rs[0]->COD_EQUIPAMENTO;
            $obj[] = $rs[0]->DESCRICAO;
            $obj[] = $rs[0]->PLACA;
            $obj[] = $rs[0]->ANO;
            $obj[] = $rs[0]->MARCA;
            $obj[] = $rs[0]->KM_CADASTRO;
            $obj[] = $rs[0]->APELIDO;
            $obj[] = $rs[0]->DATA_AQUISICAO;
            $obj[] = $rs[0]->IMAGEM;
            $obj[] = $rs[0]->ATIVO;
            
            
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_EQP_EQUIPAMENTO ORDER BY ID_EQUIPAMENTO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->ID_FILIAL;
            $obj[] = $rs[$cont]->ID_GRUPO;
            $obj[] = $rs[$cont]->COD_EQUIPAMENTO;
            $obj[] = $rs[$cont]->DESCRICAO;
            $obj[] = $rs[$cont]->PLACA;
            $obj[] = $rs[$cont]->ANO;
            $obj[] = $rs[$cont]->MARCA;
            $obj[] = $rs[$cont]->KM_CADASTRO;
            $obj[] = $rs[$cont]->APELIDO;
            $obj[] = $rs[$cont]->DATA_AQUISICAO;
            $obj[] = $rs[$cont]->IMAGEM;
            $obj[] = $rs[$cont]->ATIVO;
            
           
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($codEquipamento){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
            
            
            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE COD_EQUIPAMENTO =  '$codEquipamento'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $idGrupo = $rs[0]->ID_EQUIPAMENTO;
                    
            $idProcura = $idGrupo - $cont;  

            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE ID_EQUIPAMENTO =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_GRUPO;
                $obj[] = $rs[0]->COD_EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->PLACA;
                $obj[] = $rs[0]->ANO;
                $obj[] = $rs[0]->MARCA;
                $obj[] = $rs[0]->KM_CADASTRO;
                $obj[] = $rs[0]->APELIDO;
                $obj[] = $rs[0]->DATA_AQUISICAO;
                $obj[] = $rs[0]->IMAGEM;
                $obj[] = $rs[0]->ATIVO;
                
                
               
                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximo($codGrupo){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
                       
            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE COD_EQUIPAMENTO =  '$codGrupo'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            //print_r($query);exit();
            
            $idGrupo = $rs[0]->ID_EQUIPAMENTO;
                    
            $idProcura = $idGrupo + $cont;                  

            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE ID_EQUIPAMENTO =  '$idProcura'";
            
            //print_r($query);exit();

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_GRUPO;
                $obj[] = $rs[0]->COD_EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->PLACA;
                $obj[] = $rs[0]->ANO;
                $obj[] = $rs[0]->MARCA;
                $obj[] = $rs[0]->KM_CADASTRO;
                $obj[] = $rs[0]->APELIDO;
                $obj[] = $rs[0]->DATA_AQUISICAO;
                $obj[] = $rs[0]->IMAGEM;
                $obj[] = $rs[0]->ATIVO;
                
               

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE DESCRICAO LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_GRUPO;
                $obj[] = $rs[0]->COD_EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->PLACA;
                $obj[] = $rs[0]->ANO;
                $obj[] = $rs[0]->MARCA;
                $obj[] = $rs[0]->KM_CADASTRO;
                $obj[] = $rs[0]->APELIDO;
                $obj[] = $rs[0]->DATA_AQUISICAO;
                $obj[] = $rs[0]->IMAGEM;
                $obj[] = $rs[0]->ATIVO;
                
                

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE COD_EQUIPAMENTO = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->ID_GRUPO;
                $obj[] = $rs[0]->COD_EQUIPAMENTO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->PLACA;
                $obj[] = $rs[0]->ANO;
                $obj[] = $rs[0]->MARCA;
                $obj[] = $rs[0]->KM_CADASTRO;
                $obj[] = $rs[0]->APELIDO;
                $obj[] = $rs[0]->DATA_AQUISICAO;
                $obj[] = $rs[0]->IMAGEM;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->IMAGEM;
                $obj[] = $rs[0]->ID_EQUIPAMENTO;
                
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
        
        $query = "SELECT * FROM GA_EQP_EQUIPAMENTO ORDER BY ID_EQUIPAMENTO";
        
        //print_r($query);exit();
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_EQUIPAMENTO;
            
            $query = "SELECT NOME_FANTASIA FROM GA_SYS_EMPRESA WHERE ID_EMPRESA = $item->ID_EMPRESA";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $empresa = $rs[0]->NOME_FANTASIA;
            }
            else{
                $empresa = '-';
            }
            
            
            $query = "SELECT NOME_FANTASIA FROM GA_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = $item->ID_FILIAL";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $filial = $rs[0]->NOME_FANTASIA;
            }
            else{
                $filial = '-';
            }
            
            
            $query = "SELECT COD_GRUPO, DESCRICAO FROM GA_EQP_GRUPO_EQUIPAMENTO WHERE ID_GRUPO = $item->ID_GRUPO";
               
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if(is_array($rs) && count($rs)> 0){
                $grupo  = $rs[0]->COD_GRUPO;
                $grupo .= " - ";
                $grupo  = $rs[0]->DESCRICAO;
            }
            else{
                $filial = '-';
            }
            
            
            $obj['EMPRESA'] = $empresa;
            $obj['FILIAL'] = $filial;
            $obj['COD_EQUIPAMENTO'] = $item->COD_EQUIPAMENTO;
            $obj['COD_GRUPO'] = $grupo;
            $obj['PLACA'] = $item->PLACA;   
            $obj['APELIDO'] = $item->APELIDO;   
            $obj['DESCRICAO'] = $item->DESCRICAO;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
           
                
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
              
   
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_EQUIPAMENTO) AS TOTAL FROM GA_EQP_EQUIPAMENTO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idEquipamento){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_EQP_EQUIPAMENTO WHERE ID_EQUIPAMENTO = $idEquipamento";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->ID_GRUPO;
            $obj[] = $rs[0]->COD_EQUIPAMENTO;
            $obj[] = $rs[0]->DESCRICAO;
            $obj[] = $rs[0]->PLACA;
            $obj[] = $rs[0]->ANO;
            $obj[] = $rs[0]->MARCA;
            $obj[] = $rs[0]->KM_CADASTRO;
            $obj[] = $rs[0]->APELIDO;
            $obj[] = $rs[0]->DATA_AQUISICAO;
            $obj[] = $rs[0]->IMAGEM;
            $obj[] = $rs[0]->ATIVO;
          
            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    public function carregarEmpresa(){
        
        $this->initConBanco();

        $query = "SELECT ID_EMPRESA, NOME_FANTASIA FROM GA_SYS_EMPRESA  WHERE ATIVO = 'S' ORDER BY NOME_FANTASIA ";
                  
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
        
            $query = "SELECT * FROM GA_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA = '$idEmpresa'";

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
            
            $query = "SELECT * FROM GA_SYS_EMPRESA_FILIAL ";

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
    
    
    public function carregarGrupo($idEmpresa, $idFilial){
        
        $this->initConBanco();        
        

        if($idEmpresa != "" && $idFilial !=""){
        
            $query = "SELECT * FROM GA_EQP_GRUPO_EQUIPAMENTO WHERE ID_EMPRESA = '$idEmpresa' AND ID_FILIAL = '$idFilial'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idGrupo = $item->ID_GRUPO;
                    $nome  = $item->COD_GRUPO;
                    $nome .= " - ";    
                    $nome .= $item->DESCRICAO;
                    $html .= "<option value='$idGrupo'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhum Grupo Cadastrado</option>";
            }
        }
        else{
            
            $query = "SELECT * FROM GA_EQP_GRUPO_EQUIPAMENTO ";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $idGrupo = $item->ID_GRUPO;
                    $nome  = $item->COD_GRUPO;
                    $nome .= " - ";    
                    $nome .= $item->DESCRICAO;
                    $html .= "<option value='$idGrupo'>$nome</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
            }
            
            
        }
        
    }
    
    
   
    
   
}
