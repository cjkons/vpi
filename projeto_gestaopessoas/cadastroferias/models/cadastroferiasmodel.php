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
        
        $query = "SELECT max(ID_FERIAS) AS ID_FERIAS FROM GP_CAD_FERIAS";
                     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        if(count($rs) > 0 && is_array($rs)){
            $novoIdUsuario = $rs[0]->ID_FERIAS + 1;
        }
        else{
            $novoIdUsuario = 1;
        }
                
        return $novoIdUsuario;
         
    } 

    public function salvar($ID, $idEmpresa,$idFilial, $funcionario, $dataAdmissao,
                           $matricula,$setor,$funcao,$dataInicioFerias,
                           $diasFerias,$dataFimFerias,$comprouDias,$diasComprados,
                           $diasHaver){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_FERIAS WHERE ID_FERIAS= $ID";
         
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; 
        
        
        
        if (is_array($rs) && count($rs) > 0){
            
            $query2 = "SELECT DATA_FIM FROM GP_CAD_FERIAS WHERE ID_FERIAS= $ID";
            $cs2 = $this->conBanco->query($query2);
            $rs2 = $cs2->result();
            if (is_array($rs2) && count($rs2) > 0){
                $oldDataFim = $rs2[0]->DATA_FIM;
                $query3 =" UPDATE GP_CAD_FERIAS  SET ID_FERIAS = '$ID',"
                        ." EMPRESA = '$idEmpresa', FILIAL = '$idFilial',"
                        ." FUNCIONARIO = '$funcionario', DATA_ADMISSAO = '$dataAdmissao', "
                        ." MATRICULA = '$matricula', SETOR = '$setor', "
                        ." FUNCAO = '$funcao', DATA_INICIO = '$dataInicioFerias', "
                        ." DATA_FIM = '$dataFimFerias', COMPRA_DIAS = '$comprouDias', "
                        ." DIAS_COMPRADO = '$diasComprados', DIAS_HAVER = '$diasHaver', "
                        ." USUARIO_CADASTRO = '$usuarioLogado', DATA_CADASTRO = SYSDATE "
                        ." WHERE ID_FERIAS LIKE '$ID'  AND DATA_FIM = '$oldDataFim'";
                
                //print_r($query3);exit();        
                $resultado = $this->conBanco->query($query3);
                if($resultado == true || $resultado == 1){
                    return true;            
                }
                else{
                    return false;
                }
            }
        }
        else{
            $query = "SELECT MAX(ID_FERIAS)  AS ID_FERIAS FROM  GP_CAD_FERIAS";
            //print_r('aqui');
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            if(count($rs) == 0 ){
                $novoId = 1;
            }
            else{
                $novoId = $rs[0]->ID_FERIAS + 1;
            }
            
            $query = "INSERT INTO GP_CAD_FERIAS(ID_FERIAS,EMPRESA, FILIAL, FUNCIONARIO,
                                                DATA_ADMISSAO, MATRICULA, SETOR, FUNCAO,
                                                DATA_INICIO, DIAS_FERIAS, DATA_FIM, 
                                                COMPRA_DIAS, DIAS_COMPRADO, DIAS_HAVER,
                                                USUARIO_CADASTRO,DATA_CADASTRO)
                     VALUES ($ID, '$idEmpresa', '$idFilial', '$funcionario', '$dataAdmissao',
                           '$matricula','$setor','$funcao','$dataInicioFerias',
                           '$diasFerias','$dataFimFerias','$comprouDias','$diasComprados',
                           '$diasHaver','$usuarioLogado',SYSDATE)";
            //print_r($query);
            $resultado = $this->conBanco->query($query);
            
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    public function excluir($ID){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_CAD_FERIAS WHERE ID_FERIAS = '$ID'";
        
        //print_r($query);exit();
        
        $resultado = $this->conBanco->query($query);
                        
        if($resultado == true || $resultado == 1){
            return true;            
        }
        else{
            return false;
        }
         
    }

    
    public function pesquisaSimples($matricula, $funcionario,$funcionarioAno,$matriculaAno){
        $this->initConBanco();
        if($matricula == "" || $matricula == null ){
            
            $query = "SELECT ID_FUNCIONARIO FROM GP_CAD_FUNCIONARIO WHERE UPPER(NOME_FUNCIONARIO) LIKE UPPER('%$funcionario%')";
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            $funcionario = $rs[0]->ID_FUNCIONARIO;
            $query = "SELECT * FROM GP_CAD_FERIAS WHERE FUNCIONARIO ='$funcionario' AND DATA_INICIO LIKE ('%$funcionarioAno%')";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            $obj = array();                  
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FERIAS;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_INICIO;
                $obj[] = $rs[0]->DIAS_FERIAS;
                $obj[] = $rs[0]->DATA_FIM;
                $obj[] = $rs[0]->COMPRA_DIAS;
                $obj[] = $rs[0]->DIAS_COMPRADO;
                $obj[] = $rs[0]->DIAS_HAVER;
                
                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_CAD_FERIAS WHERE MATRICULA = '$matricula' AND DATA_INICIO LIKE ('%$matriculaAno%')";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            $obj = array(); 
            
            if (is_array($rs) && count($rs) > 0){
                
                $obj[] = $rs[0]->ID_FERIAS;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_INICIO;
                $obj[] = $rs[0]->DIAS_FERIAS;
                $obj[] = $rs[0]->DATA_FIM;
                $obj[] = $rs[0]->COMPRA_DIAS;
                $obj[] = $rs[0]->DIAS_COMPRADO;
                $obj[] = $rs[0]->DIAS_HAVER;
                
                return json_encode($obj);
            }
            else{
                return false;
            }         
            
        }    
    }
    
    public function buscaPrimeiroRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT FUNCIONARIO,ID_FERIAS FROM GP_CAD_FERIAS ORDER BY ID_FERIAS";
        
        $cs = $this->conBanco->query($query);
        $funcionarios = $cs->result();
        $maxIds = count($funcionarios);
        $counter = 0;
        $desativado = "S";
        while(($desativado == "S") && ($maxIds>$counter)){
            $funcionario = $funcionarios[$counter]->FUNCIONARIO[0];
            $ID          = $funcionarios[$counter]->ID_FERIAS[0];
            $query2 = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO='$funcionario'";
            //print_r($query2);exit();
            $cs2 = $this->conBanco->query($query2);
            $rs2 = $cs2->result();
            $desativado = $rs2[0]->DESATIVADO[0];
            $counter++;
        } 
        
        $query3 = "SELECT * FROM GP_CAD_FERIAS WHERE FUNCIONARIO='$funcionario' AND ID_FERIAS = '$ID'";
        //print_r($query3);exit();
        $cs3 = $this->conBanco->query($query3);
        $rs = $cs3->result();
        
        $obj = array();
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_FERIAS;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->DATA_INICIO;
            $obj[] = $rs[0]->DIAS_FERIAS;
            $obj[] = $rs[0]->DATA_FIM;
            $obj[] = $rs[0]->COMPRA_DIAS;
            $obj[] = $rs[0]->DIAS_COMPRADO;
            $obj[] = $rs[0]->DIAS_HAVER;
                    
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT FUNCIONARIO,ID_FERIAS FROM GP_CAD_FERIAS ORDER BY ID_FERIAS DESC";
        //print_r($query);exit();
        $funcionarios = $this->conBanco->query($query)->result();
        $maxIds = count($funcionarios);
        $counter = 0;
        $desativado = "S";
        
        while(($desativado == "S") && ($counter < $maxIds)){
            $funcionario = $funcionarios[$counter]->FUNCIONARIO;
            $ID = $funcionarios[$counter]->ID_FERIAS;
            $query2 = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO='$funcionario'";
            //print_r($query2);exit();
            $cs2 = $this->conBanco->query($query2);
            $rs2 = $cs2->result();
            $desativado = $rs2[0]->DESATIVADO[0];
            $counter++;
        } 
        $query3 = "SELECT * FROM GP_CAD_FERIAS WHERE FUNCIONARIO='$funcionario' AND ID_FERIAS='$ID'";
        //print_r($query3);exit();
        $cs3 = $this->conBanco->query($query3);
        $rs = $cs3->result();
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_FERIAS;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->DATA_INICIO;
            $obj[] = $rs[0]->DIAS_FERIAS;
            $obj[] = $rs[0]->DATA_FIM;
            $obj[] = $rs[0]->COMPRA_DIAS;
            $obj[] = $rs[0]->DIAS_COMPRADO;
            $obj[] = $rs[0]->DIAS_HAVER;
                    
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    
    public function buscaRegistroAnterior($ID){
        
        $this->initConBanco();
        
        $query = "SELECT FUNCIONARIO,ID_FERIAS FROM GP_CAD_FERIAS WHERE CAST(ID_FERIAS AS INT) < $ID ORDER BY ID_FERIAS DESC";
        //print_r($query);exit();
        $funcionarios = $this->conBanco->query($query)->result();
        $maxIds = count($funcionarios);
        $counter = 0;
        $desativado = "S";
        
        if (is_array($funcionarios) && count($funcionarios) > 0){
            
            while(($desativado == "S") && ($counter>=0)){
                $funcionario = $funcionarios[$counter]->FUNCIONARIO;
                $ID = $funcionarios[$counter]->ID_FERIAS;
                $query2 = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO='$funcionario'";
                //print_r($query2);exit();
                $cs2 = $this->conBanco->query($query2);
                $rs2 = $cs2->result();
                $desativado = $rs2[0]->DESATIVADO[0];
                $counter++;
            }
            
            $query3 = "SELECT * FROM GP_CAD_FERIAS WHERE FUNCIONARIO='$funcionario' AND ID_FERIAS='$ID'";
            //print_r($query3);exit();
            $cs3 = $this->conBanco->query($query3);
            $rs = $cs3->result();
            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_FERIAS;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_INICIO;
                $obj[] = $rs[0]->DIAS_FERIAS;
                $obj[] = $rs[0]->DATA_FIM;
                $obj[] = $rs[0]->COMPRA_DIAS;
                $obj[] = $rs[0]->DIAS_COMPRADO;
                $obj[] = $rs[0]->DIAS_HAVER;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
    }
    
    
    public function buscaRegistroProximo($ID){
        
        $this->initConBanco();
        
        $query = "SELECT FUNCIONARIO,ID_FERIAS FROM GP_CAD_FERIAS WHERE CAST(ID_FERIAS AS INT) > $ID ORDER BY ID_FERIAS ASC";
        //print_r($query);exit();
        $funcionarios = $this->conBanco->query($query)->result();
        $maxIds = count($funcionarios);
        $counter = 0;
        $desativado = "S";
        
        if (is_array($funcionarios) && count($funcionarios) > 0){
            
            while(($desativado == "S") && ($counter>=0)){
                $funcionario = $funcionarios[$counter]->FUNCIONARIO;
                $ID = $funcionarios[$counter]->ID_FERIAS;
                $query2 = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO='$funcionario'";
                //print_r($query2);exit();
                $cs2 = $this->conBanco->query($query2);
                $rs2 = $cs2->result();
                $desativado = $rs2[0]->DESATIVADO[0];
                $counter++;
            }
            
            $query3 = "SELECT * FROM GP_CAD_FERIAS WHERE FUNCIONARIO='$funcionario' AND ID_FERIAS='$ID'";
            //print_r($query3);exit();
            $cs3 = $this->conBanco->query($query3);
            $rs = $cs3->result();
            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_FERIAS;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_INICIO;
                $obj[] = $rs[0]->DIAS_FERIAS;
                $obj[] = $rs[0]->DATA_FIM;
                $obj[] = $rs[0]->COMPRA_DIAS;
                $obj[] = $rs[0]->DIAS_COMPRADO;
                $obj[] = $rs[0]->DIAS_HAVER;

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
        
        $query = "SELECT * FROM GP_CAD_FERIAS ORDER BY ID_FERIAS";
        
        $itens = $this->conBanco->query($query)->result();
        
        $obj = array();

        foreach ($itens as $item) {
            
            $aux           = $item->ID_FERIAS;
            $idFuncionario = $item->FUNCIONARIO;
            $empresa       = $item->EMPRESA;
            $filial        = $item->FILIAL;
            
            $query  = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa";
            //print_r($query);exit();
            $rs = $this->conBanco->query($query)->result();
            $nomeEmpresa  = $rs[0]->NOME_FANTASIA;
            
            $query2 = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL  WHERE ID_EMPRESA_FILIAL = $filial";
            //print_r($query2);exit();
            $rs2 = $this->conBanco->query($query2)->result();
            $nomeFilial  = $rs2[0]->NOME_FANTASIA;
            
            $query3 = "SELECT NOME_FUNCIONARIO FROM GP_CAD_FUNCIONARIO  WHERE EMPRESA = '$empresa' AND ID_FUNCIONARIO='$idFuncionario'";
            //print_r($query3);exit();
            $rs3 = $this->conBanco->query($query3)->result();
            $funcionario  = $rs3[0]->NOME_FUNCIONARIO;
            $obj['EMPRESA'] = $nomeEmpresa;
            $obj['FILIAL'] = $nomeFilial;
            $obj['FUNCIONARIO'] = $funcionario;
            $obj['DATA_ADMISSAO'] = $item->DATA_ADMISSAO;
            $obj['MATRICULA'] = $item->MATRICULA;
            $obj['FUNCAO'] = $item->FUNCAO;
            $obj['SETOR'] = $item->SETOR;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>SELECIONAR</button>";
          
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
    
    public function selecionaGrid($ID){
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_FERIAS WHERE ID_FERIAS = $ID";
        //print_r($query);exit();
        $rs    = $this->conBanco->query($query)->result();
        
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $ID;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->DATA_INICIO;
            $obj[] = $rs[0]->DIAS_FERIAS;
            $obj[] = $rs[0]->DATA_FIM;
            $obj[] = $rs[0]->COMPRA_DIAS;
            $obj[] = $rs[0]->DIAS_COMPRADO;
            $obj[] = $rs[0]->DIAS_HAVER;
                
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
