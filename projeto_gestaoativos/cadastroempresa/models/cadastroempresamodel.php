<?php

class cadastroempresamodel extends CI_Model {

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
        
        $query = "SELECT max(ID_EMPRESA) AS ID_EMPRESA FROM  GA_SYS_EMPRESA";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoIdUsuario = $rs[0]->ID_EMPRESA + 1;
        }
        else{
            $novoIdUsuario = 1;
            
        }
                
        return $novoIdUsuario;
         
    }   
    

    public function salvar($idEmpresa, $grupoEmpresa, $razaoSocial, $codigoCNPJ, $nomeFantasia, $inscricaoEstadual, $inscricaoMunicipal, $ativoEmpresa, $endereco, $numero, $cep, $cidade, $bairro, $estado, $pais, $telefone1, $telefone2, $celular, $email){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SYS_EMPRESA  WHERE ID_EMPRESA = $idEmpresa";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_SYS_EMPRESA  SET ID_GRUPO_EMPRESA = $grupoEmpresa, RAZAO_SOCIAL = '$razaoSocial', COD_EMPRESA = '$codigoCNPJ',  NOME_FANTASIA = '$nomeFantasia', INSCRICAO_ESTADUAL = '$inscricaoEstadual', INSCRICAO_MUNICIPAL = '$inscricaoMunicipal', ATIVO = '$ativoEmpresa', ENDERECO = '$endereco', NUMERO = '$numero', CEP = '$cep', CIDADE = '$cidade', BAIRRO = '$bairro', ESTADO = '$estado',  PAIS = '$pais', TELEFONE_1 = '$telefone1', TELEFONE_2 = '$telefone2', CELULAR = '$celular', EMAIL = '$email', USUARIO_ALTERADOR = '$usuarioLogado', DATA_ALTERACAO = SYSDATE  WHERE ID_EMPRESA = $idEmpresa";

            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
            
            $query = "SELECT MAX(ID) AS ID FROM  GA_SYS_EMPRESA";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GA_SYS_EMPRESA (ID, ID_EMPRESA, ID_GRUPO_EMPRESA, RAZAO_SOCIAL, COD_EMPRESA, NOME_FANTASIA, INSCRICAO_ESTADUAL, INSCRICAO_MUNICIPAL, ATIVO, ENDERECO, NUMERO, CEP, CIDADE, BAIRRO, ESTADO, PAIS, TELEFONE_1, TELEFONE_2, CELULAR, EMAIL, USUARIO_CADASTRADOR, DATA_CADASTRO)
                             VALUES ($novoId, $idEmpresa, $grupoEmpresa, '$razaoSocial', '$codigoCNPJ', '$nomeFantasia', '$inscricaoEstadual', '$inscricaoMunicipal', '$ativoEmpresa', '$endereco', '$numero', '$cep', '$cidade', '$bairro', '$estado', '$pais', '$telefone1', '$telefone2', '$celular', '$email', '$usuarioLogado', SYSDATE)";     

           // print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    public function excluir($idEmpresa){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GA_SYS_EMPRESA WHERE ID_EMPRESA = $idEmpresa";
        
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
        
        $query = "SELECT * FROM GA_SYS_EMPRESA ORDER BY ID_EMPRESA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
            $obj[] = $rs[0]->RAZAO_SOCIAL;
            $obj[] = $rs[0]->COD_EMPRESA;
            $obj[] = $rs[0]->NOME_FANTASIA;
            $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
            $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
            $obj[] = $rs[0]->ATIVO;            
            $obj[] = $rs[0]->ENDERECO;
            $obj[] = $rs[0]->NUMERO;
            $obj[] = $rs[0]->CEP;
            $obj[] = $rs[0]->CIDADE;
            $obj[] = $rs[0]->BAIRRO;
            $obj[] = $rs[0]->ESTADO;
            $obj[] = $rs[0]->PAIS;
            $obj[] = $rs[0]->TELEFONE_1;
            $obj[] = $rs[0]->TELEFONE_2;
            $obj[] = $rs[0]->CELULAR;
            $obj[] = $rs[0]->EMAIL;
            
        
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_SYS_EMPRESA ORDER BY ID_EMPRESA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->ID_GRUPO_EMPRESA;
            $obj[] = $rs[$cont]->RAZAO_SOCIAL;
            $obj[] = $rs[$cont]->COD_EMPRESA;
            $obj[] = $rs[$cont]->NOME_FANTASIA;
            $obj[] = $rs[$cont]->INSCRICAO_ESTADUAL;
            $obj[] = $rs[$cont]->INSCRICAO_MUNICIPAL;
            $obj[] = $rs[$cont]->ATIVO;            
            $obj[] = $rs[$cont]->ENDERECO;
            $obj[] = $rs[$cont]->NUMERO;
            $obj[] = $rs[$cont]->CEP;
            $obj[] = $rs[$cont]->CIDADE;
            $obj[] = $rs[$cont]->BAIRRO;
            $obj[] = $rs[$cont]->ESTADO;
            $obj[] = $rs[$cont]->PAIS;
            $obj[] = $rs[$cont]->TELEFONE_1;
            $obj[] = $rs[$cont]->TELEFONE_2;
            $obj[] = $rs[$cont]->CELULAR;
            $obj[] = $rs[$cont]->EMAIL;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idEmpresa){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
        
            $idProcura = $idEmpresa - $cont;  

            $query = "SELECT * FROM GA_SYS_EMPRESA WHERE ID_EMPRESA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
                $obj[] = $rs[0]->ATIVO;            
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->PAIS;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->CELULAR;
                $obj[] = $rs[0]->EMAIL;

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximo($idEmpresa){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        

            $idProcura = $idEmpresa + $cont;  

            $query = "SELECT * FROM GA_SYS_EMPRESA WHERE ID_EMPRESA =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
                $obj[] = $rs[0]->ATIVO;            
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->PAIS;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->CELULAR;
                $obj[] = $rs[0]->EMAIL;

                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
       
        $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GA_SYS_EMPRESA WHERE NOME_FANTASIA LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
                $obj[] = $rs[0]->ATIVO;            
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->PAIS;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->CELULAR;
                $obj[] = $rs[0]->EMAIL;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GA_SYS_EMPRESA WHERE ID_EMPRESA = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
                $obj[] = $rs[0]->ATIVO;            
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->PAIS;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->CELULAR;
                $obj[] = $rs[0]->EMAIL;
                
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
        
        $query = "SELECT * FROM GA_SYS_EMPRESA ORDER BY ID_EMPRESA";
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux = $item->ID_EMPRESA;
            
            $obj['ID_EMPRESA'] = $item->ID_EMPRESA;
            $obj['ID_GRUPO_EMPRESA'] = $item->ID_GRUPO_EMPRESA;
            $obj['RAZAO_SOCIAL'] = $item->RAZAO_SOCIAL;
            $obj['COD_EMPRESA'] = $item->COD_EMPRESA;
            $obj['NOME_FANTASIA'] = $item->NOME_FANTASIA;
            $obj['INSCRICAO_ESTADUAL'] = $item->INSCRICAO_ESTADUAL;
            $obj['INSCRICAO_MUNICIPAL'] = $item->INSCRICAO_MUNICIPAL;
            $obj['ATIVO'] = $item->ATIVO;
            $obj['ENDERECO'] = $item->ENDERECO;
            $obj['NUMERO'] = $item->NUMERO;
            $obj['CEP'] = $item->CEP;
            $obj['CIDADE'] = $item->CIDADE;
            $obj['BAIRRO'] = $item->BAIRRO;
            $obj['ESTADO'] = $item->ESTADO;
            $obj['PAIS'] = $item->PAIS;
            $obj['TELEFONE_1'] = $item->TELEFONE_1;
            $obj['TELEFONE_2'] = $item->TELEFONE_2;
            $obj['CELULAR'] = $item->CELULAR;
            $obj['EMAIL'] = $item->EMAIL;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
           
                
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
              
   
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GA_SYS_EMPRESA";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idEmpresa){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GA_SYS_EMPRESA WHERE ID_EMPRESA = $idEmpresa";
            
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_GRUPO_EMPRESA;
            $obj[] = $rs[0]->RAZAO_SOCIAL;
            $obj[] = $rs[0]->COD_EMPRESA;
            $obj[] = $rs[0]->NOME_FANTASIA;
            $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
            $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
            $obj[] = $rs[0]->ATIVO;            
            $obj[] = $rs[0]->ENDERECO;
            $obj[] = $rs[0]->NUMERO;
            $obj[] = $rs[0]->CEP;
            $obj[] = $rs[0]->CIDADE;
            $obj[] = $rs[0]->BAIRRO;
            $obj[] = $rs[0]->ESTADO;
            $obj[] = $rs[0]->PAIS;
            $obj[] = $rs[0]->TELEFONE_1;
            $obj[] = $rs[0]->TELEFONE_2;
            $obj[] = $rs[0]->CELULAR;
            $obj[] = $rs[0]->EMAIL;

            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    
    public function carregarGrupoEmpresa(){
        
        $this->initConBanco();

        $query = "SELECT ID_GRUPO_EMPRESA, DENOMINACAO FROM GA_SYS_GRUPO_EMPRESA ORDER BY DENOMINACAO ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $codGrupoEmpresa = $item->ID_GRUPO_EMPRESA;
                $denominacao      = $item->DENOMINACAO;
                $html .= "<option value='$codGrupoEmpresa'>$denominacao</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Grupo Cadastrado</option>";
        }
        
    }    

}
