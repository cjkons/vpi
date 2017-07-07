<?php

class cadastroitemmodel extends CI_Model {

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
        
        $query = "SELECT max(ID) AS ID FROM  GA_SUP_ITEM";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }   
    

    public function salvar($idItem, $codItem, $descItem, $comprador, $unidadeMedida, $tipoFiscal, $tipoItem, $familia, $contaContabil, $codNCM, $codFiscal, $contabiliza, $incidenciaICMS, $incidenciaIPI, $contabPISCOFINS, $ativo){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_ITEM  WHERE ID = $idItem";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_SUP_ITEM  SET COD_ITEM = '$codItem', DESC_ITEM = '$descItem', COMPRADOR = '$comprador',  UNIDADE_MEDIDA = '$unidadeMedida', TIPO_FISCAL = '$tipoFiscal', TIPO_ITEM = '$tipoItem', FAMILIA = '$familia', CONTA_CONTABIL = $contaContabil, COD_NCM = '$codNCM', COD_FISCAL = '$codFiscal', CONTABILIZA = '$contabiliza', INCIDENCIA_ICMS = '$incidenciaICMS', INCIDENCIA_IPI = '$incidenciaIPI',  CONTAB_PIS_COFINS = '$contabPISCOFINS', ATIVO = '$ativo', USUARIO_ALTERACAO = '$usuarioLogado', DATA_ALTERACAO = SYSDATE  WHERE ID = $idItem";

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
            
            $query = "SELECT MAX(ID) AS ID FROM  GA_SUP_ITEM";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GA_SUP_ITEM (ID, COD_ITEM, DESC_ITEM, COMPRADOR, UNIDADE_MEDIDA, TIPO_FISCAL, TIPO_ITEM, FAMILIA, CONTA_CONTABIL, COD_NCM, COD_FISCAL, CONTABILIZA, INCIDENCIA_ICMS, INCIDENCIA_IPI, CONTAB_PIS_COFINS, ATIVO, USUARIO_CADASTRO, DATA_CADASTRO)
                             VALUES ($idItem, '$codItem', '$descItem', '$comprador', '$unidadeMedida', '$tipoFiscal', '$tipoItem', '$familia', $contaContabil, '$codNCM', '$codFiscal', '$contabiliza', '$incidenciaICMS', '$incidenciaIPI', '$contabPISCOFINS', '$ativo', '$usuarioLogado', SYSDATE)";     

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
    
    public function excluir($idItem){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_SUP_ITEM WHERE ID = $idItem";
        
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
        
        $query = "SELECT * FROM GA_SUP_ITEM ORDER BY ID";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID;
            $obj[] = $rs[0]->COD_ITEM;
            $obj[] = $rs[0]->DESC_ITEM;
            $obj[] = $rs[0]->COMPRADOR;
            $obj[] = $rs[0]->UNIDADE_MEDIDA;
            $obj[] = $rs[0]->TIPO_FISCAL;
            $obj[] = $rs[0]->TIPO_ITEM;
            $obj[] = $rs[0]->FAMILIA;            
            $obj[] = $rs[0]->CONTA_CONTABIL;
            $obj[] = $rs[0]->COD_NCM;
            $obj[] = $rs[0]->COD_FISCAL;
            $obj[] = $rs[0]->CONTABILIZA;
            $obj[] = $rs[0]->INCIDENCIA_ICMS;
            $obj[] = $rs[0]->INCIDENCIA_IPI;
            $obj[] = $rs[0]->CONTAB_PIS_COFINS;
            $obj[] = $rs[0]->ATIVO;
            
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SUP_ITEM ORDER BY ID";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->ID;
            $obj[] = $rs[$cont]->COD_ITEM;
            $obj[] = $rs[$cont]->DESC_ITEM;
            $obj[] = $rs[$cont]->COMPRADOR;
            $obj[] = $rs[$cont]->UNIDADE_MEDIDA;
            $obj[] = $rs[$cont]->TIPO_FISCAL;
            $obj[] = $rs[$cont]->TIPO_ITEM;
            $obj[] = $rs[$cont]->FAMILIA;            
            $obj[] = $rs[$cont]->CONTA_CONTABIL;
            $obj[] = $rs[$cont]->COD_NCM;
            $obj[] = $rs[$cont]->COD_FISCAL;
            $obj[] = $rs[$cont]->CONTABILIZA;
            $obj[] = $rs[$cont]->INCIDENCIA_ICMS;
            $obj[] = $rs[$cont]->INCIDENCIA_IPI;
            $obj[] = $rs[$cont]->CONTAB_PIS_COFINS;
            $obj[] = $rs[$cont]->ATIVO;
            
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idItem){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
        
            $idProcura = $idItem - $cont;  

            $query = "SELECT * FROM GA_SUP_ITEM WHERE ID =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->COD_ITEM;
                $obj[] = $rs[0]->DESC_ITEM;
                $obj[] = $rs[0]->COMPRADOR;
                $obj[] = $rs[0]->UNIDADE_MEDIDA;
                $obj[] = $rs[0]->TIPO_FISCAL;
                $obj[] = $rs[0]->TIPO_ITEM;
                $obj[] = $rs[0]->FAMILIA;
                $obj[] = $rs[0]->CONTA_CONTABIL;
                $obj[] = $rs[0]->COD_NCM;
                $obj[] = $rs[0]->COD_FISCAL;
                $obj[] = $rs[0]->CONTABILIZA;
                $obj[] = $rs[0]->INCIDENCIA_ICMS;
                $obj[] = $rs[0]->INCIDENCIA_IPI;
                $obj[] = $rs[0]->CONTAB_PIS_COFINS;
                $obj[] = $rs[0]->ATIVO;

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximo($idItem){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        

            $idProcura = $idItem + $cont;  

            $query = "SELECT * FROM GA_SUP_ITEM WHERE ID =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->COD_ITEM;
                $obj[] = $rs[0]->DESC_ITEM;
                $obj[] = $rs[0]->COMPRADOR;
                $obj[] = $rs[0]->UNIDADE_MEDIDA;
                $obj[] = $rs[0]->TIPO_FISCAL;
                $obj[] = $rs[0]->TIPO_ITEM;
                $obj[] = $rs[0]->FAMILIA;
                $obj[] = $rs[0]->CONTA_CONTABIL;
                $obj[] = $rs[0]->COD_NCM;
                $obj[] = $rs[0]->COD_FISCAL;
                $obj[] = $rs[0]->CONTABILIZA;
                $obj[] = $rs[0]->INCIDENCIA_ICMS;
                $obj[] = $rs[0]->INCIDENCIA_IPI;
                $obj[] = $rs[0]->CONTAB_PIS_COFINS;
                $obj[] = $rs[0]->ATIVO;

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_SUP_ITEM WHERE DESC_ITEM LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->COD_ITEM;
                $obj[] = $rs[0]->DESC_ITEM;
                $obj[] = $rs[0]->COMPRADOR;
                $obj[] = $rs[0]->UNIDADE_MEDIDA;
                $obj[] = $rs[0]->TIPO_FISCAL;
                $obj[] = $rs[0]->TIPO_ITEM;
                $obj[] = $rs[0]->FAMILIA;
                $obj[] = $rs[0]->CONTA_CONTABIL;
                $obj[] = $rs[0]->COD_NCM;
                $obj[] = $rs[0]->COD_FISCAL;
                $obj[] = $rs[0]->CONTABILIZA;
                $obj[] = $rs[0]->INCIDENCIA_ICMS;
                $obj[] = $rs[0]->INCIDENCIA_IPI;
                $obj[] = $rs[0]->CONTAB_PIS_COFINS;
                $obj[] = $rs[0]->ATIVO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_SUP_ITEM WHERE ID = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID;
                $obj[] = $rs[0]->COD_ITEM;
                $obj[] = $rs[0]->DESC_ITEM;
                $obj[] = $rs[0]->COMPRADOR;
                $obj[] = $rs[0]->UNIDADE_MEDIDA;
                $obj[] = $rs[0]->TIPO_FISCAL;
                $obj[] = $rs[0]->TIPO_ITEM;
                $obj[] = $rs[0]->FAMILIA;
                $obj[] = $rs[0]->CONTA_CONTABIL;
                $obj[] = $rs[0]->COD_NCM;
                $obj[] = $rs[0]->COD_FISCAL;
                $obj[] = $rs[0]->CONTABILIZA;
                $obj[] = $rs[0]->INCIDENCIA_ICMS;
                $obj[] = $rs[0]->INCIDENCIA_IPI;
                $obj[] = $rs[0]->CONTAB_PIS_COFINS;
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
        
        $query = "SELECT * FROM GA_SUP_ITEM ORDER BY ID";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID;
            $idUnidadeMedida = $item->UNIDADE_MEDIDA;
            
          
            $query = "SELECT DENOMINACAO FROM GA_SUP_UNIDADE_MEDIDA WHERE ID = $idUnidadeMedida ";
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if (is_array($rs) && count($rs) > 0) {
                $denominacao = $rs[0]->DENOMINACAO;
            } else {
                $denominacao = "-";
            }

            $obj['ID'] = $item->ID;
            $obj['COD_ITEM'] = $item->COD_ITEM;
            $obj['DESC_ITEM'] = $item->DESC_ITEM;
            $obj['COMPRADOR'] = $item->COMPRADOR;
            $obj['UNIDADE_MEDIDA'] = $denominacao;
            $obj['TIPO_FISCAL'] = $item->TIPO_FISCAL;
            $obj['TIPO_ITEM'] = $item->TIPO_ITEM;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
           
                
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
              
   
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GA_SUP_ITEM";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idItem){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_SUP_ITEM WHERE ID = $idItem";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID;
            $obj[] = $rs[0]->COD_ITEM;
            $obj[] = $rs[0]->DESC_ITEM;
            $obj[] = $rs[0]->COMPRADOR;
            $obj[] = $rs[0]->UNIDADE_MEDIDA;
            $obj[] = $rs[0]->TIPO_FISCAL;
            $obj[] = $rs[0]->TIPO_ITEM;
            $obj[] = $rs[0]->FAMILIA;
            $obj[] = $rs[0]->CONTA_CONTABIL;
            $obj[] = $rs[0]->COD_NCM;
            $obj[] = $rs[0]->COD_FISCAL;
            $obj[] = $rs[0]->CONTABILIZA;
            $obj[] = $rs[0]->INCIDENCIA_ICMS;
            $obj[] = $rs[0]->INCIDENCIA_IPI;
            $obj[] = $rs[0]->CONTAB_PIS_COFINS;
            $obj[] = $rs[0]->ATIVO;


            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    
    public function carregarUnidadeMedida(){
        
        $this->initConBanco();

        $query = "SELECT ID, DENOMINACAO FROM GA_SUP_UNIDADE_MEDIDA ORDER BY ID ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $codId          = $item->ID;
                $denominacao    = $item->DENOMINACAO;
                $html .= "<option value='$codId'>$denominacao</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }    

    
    public function carregarFamilia(){
        
        $this->initConBanco();

        $query = "SELECT ID, DENOMINACAO_FAMILIA FROM GA_SUP_FAMILIA ORDER BY ID ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $codId          = $item->ID;
                $denominacaoFamilia    = $item->DENOMINACAO_FAMILIA;
                $html .= "<option value='$codId'>$denominacaoFamilia</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }
    
    
    
    public function carregarComprador(){
        
        $this->initConBanco();

        $query = "SELECT ID_COMPRADOR, NOME_COMPRADOR FROM GA_SUP_COMPRADOR ORDER BY ID_COMPRADOR ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $IdComprador          = $item->ID_COMPRADOR;
                $nomeComprador    = $item->NOME_COMPRADOR;
                $html .= "<option value='$IdComprador'>$nomeComprador</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }
}
