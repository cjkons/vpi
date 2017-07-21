<?php

class cadastrofilialmodel extends CI_Model {

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
        
        $query = "SELECT max(ID_EMPRESA_FILIAL) AS ID_EMPRESA_FILIAL FROM  GP_SYS_EMPRESA_FILIAL";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0 && is_array($rs)){
            $novoIdUsuario = $rs[0]->ID_EMPRESA_FILIAL + 1;
        }
        else{
            $novoIdUsuario = 1;
            
        }
                
        return $novoIdUsuario;
         
    }   
    

    public function salvar($idFilial, $empresa, $razaoSocial, $nomeFantasia, $codigoCNPJ, $codigoCEI, $ativoFilial, $inscricaoEstadual, $inscricaoMunicipal, $endereco, $numero, $cep, $cidade, $bairro, $estado, $pais, $telefone1, $telefone2, $celular, $email, $tipo){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL  WHERE ID_EMPRESA_FILIAL = $idFilial";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_SYS_EMPRESA_FILIAL SET ID_EMPRESA_FILIAL= '$idFilial',  ID_EMPRESA  = '$empresa' , RAZAO_SOCIAL = '$razaoSocial', NOME_FANTASIA = '$nomeFantasia', COD_EMPRESA = '$codigoCNPJ', CEI = '$codigoCEI', ATIVO = '$ativoFilial', INSCRICAO_ESTADUAL = '$inscricaoEstadual', INSCRICAO_MUNICIPAL = '$inscricaoMunicipal', ENDERECO = '$endereco', NUMERO = '$numero',  CEP = '$cep', CIDADE = '$cidade', BAIRRO = '$bairro', ESTADO = '$estado',  PAIS = '$pais', TELEFONE_1 = '$telefone1', TELEFONE_2 = '$telefone2', CELULAR = '$celular', EMAIL = '$email', USUARIO_ALTERADOR = '$usuarioLogado', DATA_ALTERACAO = SYSDATE WHERE ID_EMPRESA_FILIAL = $idFilial";

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
            
            $query = "SELECT MAX(ID)  AS ID FROM  GP_SYS_EMPRESA_FILIAL";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $endereco = str_replace("'", '',$endereco);

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID + 1;
            }                       

            $query = "INSERT INTO GP_SYS_EMPRESA_FILIAL (ID, ID_EMPRESA_FILIAL, ID_EMPRESA, RAZAO_SOCIAL, NOME_FANTASIA, COD_EMPRESA, CEI, ATIVO, INSCRICAO_ESTADUAL, INSCRICAO_MUNICIPAL, ENDERECO, NUMERO, CEP, CIDADE, BAIRRO, ESTADO, PAIS, TELEFONE_1, TELEFONE_2, CELULAR, EMAIL, USUARIO_CADASTRO, DATA_CADASTRO, TIPO_CODIGO)
                             VALUES ($novoId, $idFilial, $empresa, '$razaoSocial', '$nomeFantasia', '$codigoCNPJ', '$codigoCEI', '$ativoFilial', '$inscricaoEstadual', '$inscricaoMunicipal', '$endereco', '$numero', '$cep', '$cidade', '$bairro', '$estado', '$pais', '$telefone1', '$telefone2', '$celular', '$email', '$usuarioLogado', SYSDATE, $tipo)";     

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
    
    public function excluir($idFilial){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = $idFilial";
                        
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
        
        $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL ORDER BY ID_EMPRESA_FILIAL";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_EMPRESA_FILIAL;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->RAZAO_SOCIAL;
            $obj[] = $rs[0]->NOME_FANTASIA;
            $obj[] = $rs[0]->COD_EMPRESA;
            $obj[] = $rs[0]->CEI;
            $obj[] = $rs[0]->ATIVO;
            $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
            $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
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
            $obj[] = $rs[0]->DATA_CADASTRO;
            $obj[] = $rs[0]->DATA_ALTERACAO;
            $obj[] = $rs[0]->TIPO_CODIGO;
                    
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL ORDER BY ID_EMPRESA_FILIAL";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[$cont]->ID_EMPRESA_FILIAL;
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->RAZAO_SOCIAL;
            $obj[] = $rs[$cont]->NOME_FANTASIA;
            $obj[] = $rs[$cont]->COD_EMPRESA;
            $obj[] = $rs[$cont]->CEI;
            $obj[] = $rs[$cont]->ATIVO;
            $obj[] = $rs[$cont]->INSCRICAO_ESTADUAL;
            $obj[] = $rs[$cont]->INSCRICAO_MUNICIPAL;
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
            $obj[] = $rs[$cont]->DATA_CADASTRO;
            $obj[] = $rs[$cont]->DATA_ALTERACAO;
            $obj[] = $rs[$cont]->TIPO_CODIGO;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idFilial){
        
        $this->initConBanco();
        
        $cont = 1;
        
        
        for($i =0; $i < 10; $i++){
            
            $idProcura = $idFilial - $cont; 

            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL =  $idProcura" ;

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA_FILIAL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->CEI;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
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
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->DATA_ALTERACAO;
                $obj[] = $rs[0]->TIPO_CODIGO;

                return json_encode($obj);
            }
            
            $cont++;
        
        
        }
        
            return false;
        
           
    }
    
    
     public function buscaRegistroProximo($idFilial){
        
        $this->initConBanco();
                 
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
                
            $idProcura = $idFilial + $cont;  

            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_EMPRESA_FILIAL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->CEI;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
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
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->DATA_ALTERACAO;
                $obj[] = $rs[0]->TIPO_CODIGO;

                return json_encode($obj);
            }
            
            $cont++;
        } 
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
      $this->initConEngSys();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE NOME_FANTASIA LIKE '%$nomeInicial%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA_FILIAL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->CEI;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
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
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->DATA_ALTERACAO;
                $obj[] = $rs[0]->TIPO_CODIGO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$idInicial'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_EMPRESA_FILIAL;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->RAZAO_SOCIAL;
                $obj[] = $rs[0]->NOME_FANTASIA;
                $obj[] = $rs[0]->COD_EMPRESA;
                $obj[] = $rs[0]->CEI;
                $obj[] = $rs[0]->ATIVO;
                $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
                $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
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
                $obj[] = $rs[0]->DATA_CADASTRO;
                $obj[] = $rs[0]->DATA_ALTERACAO;
                $obj[] = $rs[0]->TIPO_CODIGO;
                
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
        
        $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL ORDER BY ID_EMPRESA_FILIAL";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {

            $aux = $item->ID_EMPRESA_FILIAL;
            
            $obj['ID_EMPRESA_FILIAL'] = $item->ID_EMPRESA_FILIAL;
            $obj['ID_EMPRESA'] = $item->ID_EMPRESA;
            $obj['RAZAO_SOCIAL'] = $item->RAZAO_SOCIAL;
            $obj['NOME_FANTASIA'] = $item->NOME_FANTASIA;
            $obj['COD_EMPRESA'] = $item->COD_EMPRESA;
            $obj['CEI'] = $item->CEI;
            $obj['ATIVO'] = $item->ATIVO;
            $obj['INSCRICAO_ESTADUAL'] = $item->INSCRICAO_ESTADUAL;
            $obj['INSCRICAO_MUNICIPAL'] = $item->INSCRICAO_MUNICIPAL;
            $obj['ENDERECO'] = $item->ENDERECO;
            $obj['NUMERO'] = $item->NUMERO;
            $obj['CEP'] = $item->CEP;
            $obj['CIDADE'] = $item->CIDADE;
            $obj['BAIRRO'] = $item->BAIRRO;
            $obj['ESTADO'] = $item->ESTADO;
            $obj['PAIS'] = $item->PAIS;
            $obj['TELEFONE_1'] = $item->TELEFONE_1;
            $obj['CELULAR'] = $item->CELULAR;
            $obj['EMAIL'] = $item->EMAIL;
            $obj['DATA_CADASTRO'] = $item->DATA_CADASTRO;
            $obj['DATA_ALTERACAO'] = $item->DATA_ALTERACAO;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Selecionar</button>";
          
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
        
        
       
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID) AS TOTAL FROM GP_SYS_EMPRESA_FILIAL";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }        
          
    }
    
    public function selecionaGrid($idFilial){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = $idFilial";
         
       // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_EMPRESA_FILIAL;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->RAZAO_SOCIAL;
            $obj[] = $rs[0]->NOME_FANTASIA;
            $obj[] = $rs[0]->COD_EMPRESA;
            $obj[] = $rs[0]->CEI;
            $obj[] = $rs[0]->ATIVO;
            $obj[] = $rs[0]->INSCRICAO_ESTADUAL;
            $obj[] = $rs[0]->INSCRICAO_MUNICIPAL;
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
            $obj[] = $rs[0]->DATA_CADASTRO;
            $obj[] = $rs[0]->DATA_ALTERACAO;
            $obj[] = $rs[0]->TIPO_CODIGO;

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
}
