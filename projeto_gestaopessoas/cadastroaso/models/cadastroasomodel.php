<?php
require_once("resources/cadastroaso/dompdf/dompdf_config.inc.php");


class cadastroasomodel extends CI_Model {

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
        
        $query = "SELECT max(ID_ASO) AS ID_ASO FROM GP_CAD_EXAME_ASO";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0 && is_array($rs)){
            $novoIdUsuario = $rs[0]->ID_ASO + 1;
        }
        else{ 
            $novoIdUsuario = 1;
            
        }
                
        return $novoIdUsuario;
         
    }   
    

    public function salvar($idAso, $empresa, $filial, $funcionario, $matricula, $setor, $funcao, $dataNasc, $cpf, $ctps, $pisPasep, $tipoExames, $outrosExames,
                                $medico, $crm, $agBiologico, $agFisico, $agQuimico, $riscoAcidente, $riscoErgonomico, $ausenciaRisco, $resultadoExame, $observacaoExame,
                                $localRealizacao, $dataRealizacao, $exameComplementar1, $dataComplementar1, $exameComplementar2, $dataComplementar2, $exameComplementar3, $dataComplementar3,
                                $exameComplementar4, $dataComplementar4, $exameComplementar5, $dataComplementar5, $exameComplementar6, $dataComplementar6, $exameComplementar7,
                                $dataComplementar7, $exameComplementar8, $dataComplementar8, $pagamentoExame, $valorExame, $anexoExame){

        $this->initConBanco();
        
        $valorExame = str_replace('.', '', $valorExame);
        $valorExame = str_replace(',', '.', $valorExame);
        
        
        
        $query = "SELECT * FROM GP_CAD_EXAME_ASO  WHERE ID_ASO = $idAso";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            if($anexoExame != ""){
                
                $anexo = " ANEXO_EXAME = '$anexoExame',";
            }else{
                $anexo = "";
            }
            
            $query = "UPDATE GP_CAD_EXAME_ASO SET EMPRESA  = '$empresa' , FILIAL = '$filial', FUNCIONARIO = '$funcionario', MATRICULA = '$matricula', SETOR = '$setor', FUNCAO = '$funcao',"
                    . " DATA_NASC = '$dataNasc', CPF = '$cpf', CTPS = '$ctps', PIS_PASEP = '$pisPasep', TIPO_EXAMES = '$tipoExames', OUTROS_EXAMES = '$outrosExames', MEDICO = '$medico', "
                    . " CRM = '$crm', AG_BIOLOGICO = '$agBiologico', AG_FISICO = '$agFisico', AG_QUIMICO = '$agQuimico', RISCO_ACIDENTE = '$riscoAcidente', RISCO_ERGONOMICO = '$riscoErgonomico',"
                    . " AUSENCIA_RISCO = '$ausenciaRisco', RESULTADO_EXAME = '$resultadoExame', OBSERVACAO_EXAME = '$observacaoExame', LOCAL_REALIZACAO = '$localRealizacao', DATA_REALIZACAO = '$dataRealizacao', EXAME_COMPLEMENTAR_1 = '$exameComplementar1',"
                    . " DATA_COMPLEMENTAR_1 = '$dataComplementar1', EXAME_COMPLEMENTAR_2 = '$exameComplementar2', DATA_COMPLEMENTAR_2 = '$dataComplementar2', EXAME_COMPLEMENTAR_3 = '$exameComplementar3', DATA_COMPLEMENTAR_3 = '$dataComplementar3',"
                    . " EXAME_COMPLEMENTAR_4 = '$exameComplementar4', DATA_COMPLEMENTAR_4 = '$dataComplementar4', EXAME_COMPLEMENTAR_5 = '$exameComplementar5', DATA_COMPLEMENTAR_5 = '$dataComplementar5', EXAME_COMPLEMENTAR_6 = '$exameComplementar6',"
                    . " DATA_COMPLEMENTAR_6 = '$dataComplementar6', EXAME_COMPLEMENTAR_7 = '$exameComplementar7', DATA_COMPLEMENTAR_7 = '$dataComplementar7', EXAME_COMPLEMENTAR_8 = '$exameComplementar8', DATA_COMPLEMENTAR_8 = '$dataComplementar8',"
                    . " PAGAMENTO_EXAME = '$pagamentoExame', VALOR_EXAME = '$valorExame', $anexo  USUARIO_ALTERACAO = '$usuarioLogado', DATA_ALTERACAO = SYSDATE WHERE ID_ASO = $idAso";

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
            
            $query = "SELECT MAX(ID_ASO)  AS ID_ASO FROM  GP_CAD_EXAME_ASO";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            

            if(count($rs) == 0 ){
                $novoId = 1;            
            }
            else{
                $novoId = $rs[0]->ID_ASO + 1;
            }                       

            $query = "INSERT INTO GP_CAD_EXAME_ASO (ID_ASO, EMPRESA, FILIAL, FUNCIONARIO, MATRICULA, SETOR, FUNCAO, DATA_NASC, CPF, CTPS, PIS_PASEP, TIPO_EXAMES, OUTROS_EXAMES,"
                    . " MEDICO, CRM, AG_BIOLOGICO, AG_FISICO, AG_QUIMICO, RISCO_ACIDENTE, RISCO_ERGONOMICO, AUSENCIA_RISCO, RESULTADO_EXAME, OBSERVACAO_EXAME, LOCAL_REALIZACAO, DATA_REALIZACAO, "
                    . " EXAME_COMPLEMENTAR_1, DATA_COMPLEMENTAR_1, EXAME_COMPLEMENTAR_2, DATA_COMPLEMENTAR_2, EXAME_COMPLEMENTAR_3, DATA_COMPLEMENTAR_3, EXAME_COMPLEMENTAR_4,"
                    . " DATA_COMPLEMENTAR_4, EXAME_COMPLEMENTAR_5, DATA_COMPLEMENTAR_5, EXAME_COMPLEMENTAR_6, DATA_COMPLEMENTAR_6, EXAME_COMPLEMENTAR_7, DATA_COMPLEMENTAR_7,"
                    . " EXAME_COMPLEMENTAR_8, DATA_COMPLEMENTAR_8, PAGAMENTO_EXAME, VALOR_EXAME, ANEXO_EXAME, DATA_CADASTRO, USUARIO_CADASTRO)
                             
                        VALUES ($novoId, '$empresa', '$filial', '$funcionario', '$matricula', '$setor', '$funcao', '$dataNasc', '$cpf', '$ctps', '$pisPasep', '$tipoExames', '$outrosExames',"
                    . " '$medico', '$crm', '$agBiologico', '$agFisico', '$agQuimico', '$riscoAcidente', '$riscoErgonomico', '$ausenciaRisco', '$resultadoExame', '$observacaoExame', '$localRealizacao', '$dataRealizacao',"
                    . " '$exameComplementar1', '$dataComplementar1', '$exameComplementar2', '$dataComplementar2', '$exameComplementar3', '$dataComplementar3', '$exameComplementar4', '$dataComplementar4',"
                    . " '$exameComplementar5', '$dataComplementar5', '$exameComplementar6', '$dataComplementar6', '$exameComplementar7', '$dataComplementar7', '$exameComplementar8', '$dataComplementar8',"
                    . " '$pagamentoExame', '$valorExame', '$anexoExame', SYSDATE, '$usuarioLogado')";     

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
    
    public function excluir($idAso){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_CAD_EXAME_ASO WHERE ID_ASO = $idAso";
                        
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
        
        $query = "SELECT * FROM GP_CAD_EXAME_ASO ORDER BY ID_ASO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_ASO;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->DATA_NASC;
            $obj[] = $rs[0]->CPF;
            $obj[] = $rs[0]->CTPS;
            $obj[] = $rs[0]->PIS_PASEP;
            
            $obj[] = $rs[0]->TIPO_EXAMES;
            $obj[] = $rs[0]->OUTROS_EXAMES;
            $obj[] = $rs[0]->MEDICO;
            $obj[] = $rs[0]->CRM;
            $obj[] = $rs[0]->AG_BIOLOGICO;
            $obj[] = $rs[0]->AG_FISICO;
            $obj[] = $rs[0]->AG_QUIMICO;
            $obj[] = $rs[0]->RISCO_ACIDENTE;
            $obj[] = $rs[0]->RISCO_ERGONOMICO;
            $obj[] = $rs[0]->AUSENCIA_RISCO;
            $obj[] = $rs[0]->RESULTADO_EXAME;
            $obj[] = $rs[0]->OBSERVACAO_EXAME;
            $obj[] = $rs[0]->DATA_REALIZACAO;
            
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_1;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_1;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_2;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_2;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_3;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_3;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_4;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_4;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_5;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_5;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_6;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_6;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_7;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_7;
            $obj[] = $rs[0]->EXAME_COMPLEMENTAR_8;
            $obj[] = $rs[0]->DATA_COMPLEMENTAR_8;
            $obj[] = $rs[0]->PAGAMENTO_EXAME;
            $obj[] = $rs[0]->VALOR_EXAME;
            
            $obj[] = $rs[0]->LOCAL_REALIZACAO;
            $obj[] = $rs[0]->ANEXO_EXAME;
            
            
                    
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_EXAME_ASO ORDER BY ID_ASO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->ID_ASO;
            $obj[] = $rs[$cont]->EMPRESA;
            $obj[] = $rs[$cont]->FILIAL;
            $obj[] = $rs[$cont]->FUNCIONARIO;
            $obj[] = $rs[$cont]->MATRICULA;
            $obj[] = $rs[$cont]->SETOR;
            $obj[] = $rs[$cont]->FUNCAO;
            $obj[] = $rs[$cont]->DATA_NASC;
            $obj[] = $rs[$cont]->CPF;
            $obj[] = $rs[$cont]->CTPS;
            $obj[] = $rs[$cont]->PIS_PASEP;
            
            $obj[] = $rs[$cont]->TIPO_EXAMES;
            $obj[] = $rs[$cont]->OUTROS_EXAMES;
            $obj[] = $rs[$cont]->MEDICO;
            $obj[] = $rs[$cont]->CRM;
            $obj[] = $rs[$cont]->AG_BIOLOGICO;
            $obj[] = $rs[$cont]->AG_FISICO;
            $obj[] = $rs[$cont]->AG_QUIMICO;
            $obj[] = $rs[$cont]->RISCO_ACIDENTE;
            $obj[] = $rs[$cont]->RISCO_ERGONOMICO;
            $obj[] = $rs[$cont]->AUSENCIA_RISCO;
            $obj[] = $rs[$cont]->RESULTADO_EXAME;
            $obj[] = $rs[$cont]->OBSERVACAO_EXAME;
            $obj[] = $rs[$cont]->DATA_REALIZACAO;
            
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_1;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_1;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_2;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_2;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_3;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_3;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_4;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_4;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_5;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_5;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_6;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_6;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_7;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_7;
            $obj[] = $rs[$cont]->EXAME_COMPLEMENTAR_8;
            $obj[] = $rs[$cont]->DATA_COMPLEMENTAR_8;
            $obj[] = $rs[$cont]->PAGAMENTO_EXAME;
            $obj[] = $rs[$cont]->VALOR_EXAME;
            
            $obj[] = $rs[$cont]->LOCAL_REALIZACAO;
            $obj[] = $rs[$cont]->ANEXO_EXAME;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idAso){
        
        $this->initConBanco();
        
        $cont = 1;
        
        
        for($i =0; $i < 10; $i++){
            
            $idProcura = $idAso - $cont; 

            $query = "SELECT * FROM GP_CAD_EXAME_ASO WHERE ID_ASO =  $idProcura" ;

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_ASO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->PIS_PASEP;

                $obj[] = $rs[0]->TIPO_EXAMES;
                $obj[] = $rs[0]->OUTROS_EXAMES;
                $obj[] = $rs[0]->MEDICO;
                $obj[] = $rs[0]->CRM;
                $obj[] = $rs[0]->AG_BIOLOGICO;
                $obj[] = $rs[0]->AG_FISICO;
                $obj[] = $rs[0]->AG_QUIMICO;
                $obj[] = $rs[0]->RISCO_ACIDENTE;
                $obj[] = $rs[0]->RISCO_ERGONOMICO;
                $obj[] = $rs[0]->AUSENCIA_RISCO;
                $obj[] = $rs[0]->RESULTADO_EXAME;
                $obj[] = $rs[0]->OBSERVACAO_EXAME;
                $obj[] = $rs[0]->DATA_REALIZACAO;

                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_1;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_1;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_2;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_2;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_3;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_3;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_4;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_4;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_5;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_5;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_6;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_6;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_7;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_7;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_8;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_8;
                $obj[] = $rs[0]->PAGAMENTO_EXAME;
                $obj[] = $rs[0]->VALOR_EXAME;
                
                $obj[] = $rs[0]->LOCAL_REALIZACAO;
                $obj[] = $rs[0]->ANEXO_EXAME;


                return json_encode($obj);
            }
            
            $cont++;
        
        
        }
        
            return false;
        
           
    }
    
    
     public function buscaRegistroProximo($idAso){
        
        $this->initConBanco();
                 
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
                
            $idProcura = $idAso + $cont;  

            $query = "SELECT * FROM GP_CAD_EXAME_ASO WHERE ID_ASO =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_ASO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->PIS_PASEP;

                $obj[] = $rs[0]->TIPO_EXAMES;
                $obj[] = $rs[0]->OUTROS_EXAMES;
                $obj[] = $rs[0]->MEDICO;
                $obj[] = $rs[0]->CRM;
                $obj[] = $rs[0]->AG_BIOLOGICO;
                $obj[] = $rs[0]->AG_FISICO;
                $obj[] = $rs[0]->AG_QUIMICO;
                $obj[] = $rs[0]->RISCO_ACIDENTE;
                $obj[] = $rs[0]->RISCO_ERGONOMICO;
                $obj[] = $rs[0]->AUSENCIA_RISCO;
                $obj[] = $rs[0]->RESULTADO_EXAME;
                $obj[] = $rs[0]->OBSERVACAO_EXAME;
                $obj[] = $rs[0]->DATA_REALIZACAO;

                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_1;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_1;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_2;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_2;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_3;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_3;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_4;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_4;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_5;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_5;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_6;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_6;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_7;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_7;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_8;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_8;
                $obj[] = $rs[0]->PAGAMENTO_EXAME;
                $obj[] = $rs[0]->VALOR_EXAME;
                
                $obj[] = $rs[0]->LOCAL_REALIZACAO;
                $obj[] = $rs[0]->ANEXO_EXAME;


                return json_encode($obj);
            }
            
            $cont++;
        } 
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
      $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_CAD_EXAME_ASO WHERE FUNCIONARIO LIKE '%$nomeInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_ASO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->PIS_PASEP;

                $obj[] = $rs[0]->TIPO_EXAMES;
                $obj[] = $rs[0]->OUTROS_EXAMES;
                $obj[] = $rs[0]->MEDICO;
                $obj[] = $rs[0]->CRM;
                $obj[] = $rs[0]->AG_BIOLOGICO;
                $obj[] = $rs[0]->AG_FISICO;
                $obj[] = $rs[0]->AG_QUIMICO;
                $obj[] = $rs[0]->RISCO_ACIDENTE;
                $obj[] = $rs[0]->RISCO_ERGONOMICO;
                $obj[] = $rs[0]->AUSENCIA_RISCO;
                $obj[] = $rs[0]->RESULTADO_EXAME;
                $obj[] = $rs[0]->OBSERVACAO_EXAME;
                $obj[] = $rs[0]->DATA_REALIZACAO;

                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_1;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_1;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_2;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_2;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_3;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_3;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_4;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_4;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_5;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_5;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_6;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_6;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_7;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_7;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_8;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_8;
                $obj[] = $rs[0]->PAGAMENTO_EXAME;
                $obj[] = $rs[0]->VALOR_EXAME;
                
                $obj[] = $rs[0]->LOCAL_REALIZACAO;
                $obj[] = $rs[0]->ANEXO_EXAME;


                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_CAD_EXAME_ASO WHERE ID_ASO = '$idInicial'";
         
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_ASO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->PIS_PASEP;

                $obj[] = $rs[0]->TIPO_EXAMES;
                $obj[] = $rs[0]->OUTROS_EXAMES;
                $obj[] = $rs[0]->MEDICO;
                $obj[] = $rs[0]->CRM;
                $obj[] = $rs[0]->AG_BIOLOGICO;
                $obj[] = $rs[0]->AG_FISICO;
                $obj[] = $rs[0]->AG_QUIMICO;
                $obj[] = $rs[0]->RISCO_ACIDENTE;
                $obj[] = $rs[0]->RISCO_ERGONOMICO;
                $obj[] = $rs[0]->AUSENCIA_RISCO;
                $obj[] = $rs[0]->RESULTADO_EXAME;
                $obj[] = $rs[0]->OBSERVACAO_EXAME;
                $obj[] = $rs[0]->DATA_REALIZACAO;

                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_1;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_1;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_2;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_2;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_3;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_3;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_4;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_4;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_5;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_5;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_6;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_6;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_7;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_7;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_8;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_8;
                $obj[] = $rs[0]->PAGAMENTO_EXAME;
                $obj[] = $rs[0]->VALOR_EXAME;
                
                $obj[] = $rs[0]->LOCAL_REALIZACAO;
                $obj[] = $rs[0]->ANEXO_EXAME;

                
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
        
        $query = "SELECT * FROM GP_CAD_EXAME_ASO ORDER BY ID_ASO";
        //print_r($query);exit();      
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {

            $aux = $item->ID_ASO;
            $empresa = $item->EMPRESA;
            $filial = $item->FILIAL;
            $funcionario = $item->FUNCIONARIO;
            $funcao = $item->FUNCAO;
            $setor = $item->SETOR;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa ";
                  
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $nomeEmpresa  = $rs[0]->NOME_FANTASIA;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL  WHERE ID_EMPRESA_FILIAL = $filial ";
                  
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $nomeFilial  = $rs[0]->NOME_FANTASIA;
            
            $query = "SELECT NOME_FUNCIONARIO FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $funcionario  ";
            //print_r($query);exit();      
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $nomeFuncionario  = $rs[0]->NOME_FUNCIONARIO;
            
            
            
            $obj['ID_ASO'] = $item->ID_ASO;
            $obj['EMPRESA'] = $nomeEmpresa;
            $obj['FILIAL'] = $nomeFilial;
            $obj['FUNCIONARIO'] = $nomeFuncionario;
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
        
                               
        $query = "SELECT COUNT(ID_ASO) AS TOTAL FROM GP_CAD_EXAME_ASO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }         
          
    }
    
    public function selecionaGrid($idAso){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_CAD_EXAME_ASO WHERE ID_ASO = $idAso";
         
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_ASO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->FUNCIONARIO;
                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->PIS_PASEP;

                $obj[] = $rs[0]->TIPO_EXAMES;
                $obj[] = $rs[0]->OUTROS_EXAMES;
                $obj[] = $rs[0]->MEDICO;
                $obj[] = $rs[0]->CRM;
                $obj[] = $rs[0]->AG_BIOLOGICO;
                $obj[] = $rs[0]->AG_FISICO;
                $obj[] = $rs[0]->AG_QUIMICO;
                $obj[] = $rs[0]->RISCO_ACIDENTE;
                $obj[] = $rs[0]->RISCO_ERGONOMICO;
                $obj[] = $rs[0]->AUSENCIA_RISCO;
                $obj[] = $rs[0]->RESULTADO_EXAME;
                $obj[] = $rs[0]->OBSERVACAO_EXAME;
                $obj[] = $rs[0]->DATA_REALIZACAO;

                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_1;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_1;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_2;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_2;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_3;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_3;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_4;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_4;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_5;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_5;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_6;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_6;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_7;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_7;
                $obj[] = $rs[0]->EXAME_COMPLEMENTAR_8;
                $obj[] = $rs[0]->DATA_COMPLEMENTAR_8;
                $obj[] = $rs[0]->PAGAMENTO_EXAME;
                $obj[] = $rs[0]->VALOR_EXAME;
                
                $obj[] = $rs[0]->LOCAL_REALIZACAO;
                $obj[] = $rs[0]->ANEXO_EXAME;

                
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
    
    public function carregarFilial($empresa){
        
        $this->initConBanco();

        if($empresa != ''){
            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA = '$empresa'";
         //print_r($query);exit(); 
        }else{
            $query = "SELECT * FROM GP_SYS_EMPRESA_FILIAL";
        }
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idFilial          = $item->ID_EMPRESA_FILIAL;
                $nomeFantasia       = $item->NOME_FANTASIA;
                $html .= "<option value='$idFilial'>$nomeFantasia</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Filial Cadastrado</option>";
        }
        
    }
    
    public function carregarFuncao(){
        
        $this->initConBanco();

        $query = "SELECT ID_FUNCAO, FUNCAO FROM GP_CAD_FUNCOES ORDER BY FUNCAO ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idFuncao = $item->ID_FUNCAO;
                $funcao      = $item->FUNCAO;
                $html .= "<option value='$idFuncao'>$funcao</option>";
            }

            return $html; 
        } else {
            return "<option value='0'>Nenhuma Função Cadastrado</option>";
        }
           
        
    }
    
    public function carregarFuncionario($empresa, $filial){
        
        $this->initConBanco();

        if($empresa != ''){
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE EMPRESA = '$empresa' AND FILIAL = '$filial'";
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
    
    public function carregarDadosFuncionario($empresa, $filial, $funcionario){
        
        $this->initConBanco();

        if($empresa != 0){
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE EMPRESA = '$empresa' AND FILIAL = '$filial' AND ID_FUNCIONARIO = '$funcionario'";
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
            
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $descSetor;
            $obj[] = $descFuncao;
            $obj[] = $rs[0]->DATA_NASC;
            $obj[] = $rs[0]->CPF;
            $obj[] = $rs[0]->CTPS;
            $obj[] = $rs[0]->PIS_PASEP;
          
            
            return json_encode($obj);
        }
        else{
            
            return false;
        }   
        
    }
    
    public function carregarDataAtual() {

        $dataAtual = date('d/m/Y');

        return $dataAtual;
    }
    
    
    
    public function carregarListaExames(){
        
        $this->initConBanco();

        $query = "SELECT ID_EXAMES, EXAMES FROM GP_CAD_EXAMES ORDER BY EXAMES ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idExames = $item->ID_EXAMES;
                $nome      = $item->EXAMES;
                $html .= "<option value='$idExames'>$nome</option>";
            }

            return $html; 
        } else {
            return "<option value='0'>Nenhum Exame Cadastrado</option>";
        }
           
        
    }
    
    
    ////////// GERA ARQUIVO EM PDF
    
    
    
    public function getPdf ($idAso){
         
         
        
        $this->initConBanco();
        
        
        $query = "SELECT * FROM GP_CAD_EXAME_ASO WHERE ID_ASO = '$idAso'";
        
        
               
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) > 0){
            
                $idAso = $rs[0]->ID_ASO;
                $empresa = $rs[0]->EMPRESA;
                $filial = $rs[0]->FILIAL;
                $funcionario = $rs[0]->FUNCIONARIO;
                $matricula = $rs[0]->MATRICULA;
                $setor = $rs[0]->SETOR;
                $funcao = $rs[0]->FUNCAO;
                $dataNasc = $rs[0]->DATA_NASC;
                $cpf = $rs[0]->CPF;
                $ctps = $rs[0]->CTPS;
                $pisPasep = $rs[0]->PIS_PASEP;

                $tipoExames = $rs[0]->TIPO_EXAMES;
                $outrosExames = $rs[0]->OUTROS_EXAMES;
                $medico = $rs[0]->MEDICO;
                $crm = $rs[0]->CRM;
                $agBiologico = $rs[0]->AG_BIOLOGICO;
                $agFisico = $rs[0]->AG_FISICO;
                $agQuimico = $rs[0]->AG_QUIMICO;
                $riscoAcidente = $rs[0]->RISCO_ACIDENTE;
                $riscoErgonomico = $rs[0]->RISCO_ERGONOMICO;
                $ausenciaRisco = $rs[0]->AUSENCIA_RISCO;
                $resultadoExame = $rs[0]->RESULTADO_EXAME;
                $observacaoExame = $rs[0]->OBSERVACAO_EXAME;
                $dataRealizacao = $rs[0]->DATA_REALIZACAO;

                $exameComplementar1 = $rs[0]->EXAME_COMPLEMENTAR_1;
                $dataComplementar1 = $rs[0]->DATA_COMPLEMENTAR_1;
                $exameComplementar2 = $rs[0]->EXAME_COMPLEMENTAR_2;
                $dataComplementar2 = $rs[0]->DATA_COMPLEMENTAR_2;
                $exameComplementar3 = $rs[0]->EXAME_COMPLEMENTAR_3;
                $dataComplementar3 = $rs[0]->DATA_COMPLEMENTAR_3;
                $exameComplementar4 = $rs[0]->EXAME_COMPLEMENTAR_4;
                $dataComplementar4 = $rs[0]->DATA_COMPLEMENTAR_4;
                $exameComplementar5 = $rs[0]->EXAME_COMPLEMENTAR_5;
                $dataComplementar5 = $rs[0]->DATA_COMPLEMENTAR_5;
                $exameComplementar6 = $rs[0]->EXAME_COMPLEMENTAR_6;
                $dataComplementar6 = $rs[0]->DATA_COMPLEMENTAR_6;
                $exameComplementar7 = $rs[0]->EXAME_COMPLEMENTAR_7;
                $dataComplementar7 = $rs[0]->DATA_COMPLEMENTAR_7;
                $exameComplementar8 = $rs[0]->EXAME_COMPLEMENTAR_8;
                $dataComplementar8 = $rs[0]->DATA_COMPLEMENTAR_8;
                $pagamentoExame = $rs[0]->PAGAMENTO_EXAME;
                $valorExame = $rs[0]->VALOR_EXAME;
                
                $localRealizacao = $rs[0]->LOCAL_REALIZACAO;
                $obj[] = $rs[0]->ANEXO_EXAME;
                
                if ($tipoExames == "ADMISSIONAL"){
                    $adm = "X";
                    $outrosExames = "";
                }
                if ($tipoExames == "DEMISSIONAL"){
                    $dem = "X";
                    $outrosExames = "";
                }
                if ($tipoExames == "PERIODICO"){
                    $per = "X";
                    $outrosExames = "";
                }
                if ($tipoExames == "MUDANCA_FUNCAO"){
                    $mud = "X";
                    $outrosExames = "";
                }
                if ($tipoExames == "RETORNO_TRABALHO"){
                    $ret = "X";
                    $outrosExames = "";
                }
                if ($tipoExames == "OUTROS"){
                    $out = "X";
                }
                
                
                if ($agBiologico == "S"){
                    $agBio = "X";
                }
                if ($agFisico == "S"){
                    $agFis = "X";
                }
                if ($agQuimico == "S"){
                    $agQui = "X";
                }
                if ($riscoAcidente == "S"){
                    $risAc = "X";
                }
                if ($riscoErgonomico == "S"){
                    $risEr = "X";
                }
                if ($ausenciaRisco == "S"){
                    $semRis = "X";
                }
            
            
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA  WHERE ID_EMPRESA = $empresa ";
                  
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $nomeEmpresa  = $rs[0]->NOME_FANTASIA;
            
            $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL  WHERE ID_EMPRESA_FILIAL = $filial ";
                  
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $nomeFilial  = $rs[0]->NOME_FANTASIA;
            
            $query = "SELECT NOME_FUNCIONARIO FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $funcionario  ";
            //print_r($query);exit();      
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $nomeFuncionario  = $rs[0]->NOME_FUNCIONARIO;
            
            
            
        
        
        $html = "";
        $html .= "<table align='center'cellspacing='0'; cellpadding ='9'; style='width: 100%; border: 1 solid #000000;'>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'border: 1 solid #000000; padding-top: 10px; padding-botton: 5px; width: 50%; font-size: 30px; color: #000000;' align='center'><br>ATESTADO DE SAÚDE OCUPACIONAL (ASO)<br><br></td>";
        $html .=" </tr>";                               
        
        $html .="<tr>";
        $html .="<td  colspan = '2' align='left' style= 'width: 100%; height: 150px; font-size: 24px; color: #000000; border: 1 solid #000000;' ><br><br><b>Empresa:</b> $nomeEmpresa &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<b>Filial:</b> $nomeFilial <br><br> "
                . "<b>Funcionário:</b> $nomeFuncionario &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<b>Data Nascimento:</b> $dataNasc<br><br>"
                . "<b>Setor:</b> $setor&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>Função:</b> $funcao &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>Matrícula:</b> $matricula<br><br>"
                . "<b>CPF:</b> $cpf &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>CTPS:</b> $ctps &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>PIS/PASEP:</b> $pisPasep</td><br><br>";
        
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%; border: 1 solid #000000; padding-top: 10px; padding-botton: 5px; width: 50%; font-size: 30px; color: #000000;' align='center'><br><b>Programa de Controle Médico de Saúde Ocupacional (P.C.M.S.O)<b><br></td>";
        $html .=" </tr>"; 
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%;font-size: 21px; color: #000000;'  align='left'><b>MOTIVO DO EXAME:</b><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%;font-size: 21px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;(&nbsp;$adm&nbsp;) Admissional &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$dem&nbsp;) Demissional &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$per&nbsp;) Periódico &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$mud&nbsp;) Mudança de Função &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$ret&nbsp;) Retorno do Trabalho &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$out&nbsp;) Outros<br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%;font-size: 21px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;<b>Outros:</b> $outrosExames</td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%; border-top: 1 solid #000000;font-size: 21px; color: #000000;'  align='left'><b>RISCOS OCUPACIONAIS:</b><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%;font-size: 21px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;(&nbsp;$agBio&nbsp;) Agentes Biológicos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$agFis&nbsp; ) Agentes Físicos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$agQui&nbsp; ) Agentes Quimicos</td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%;font-size: 21px; color: #000000;'  align='left'>&nbsp;&nbsp;&nbsp;(&nbsp;$risAc&nbsp; ) Riscos Acidentes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$risEr&nbsp;) Riscos Ergonômicos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;$semRis&nbsp; ) Ausência de Riscos Ocupacionais Expecíficos</td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%; border-top: 1 solid #000000;font-size: 21px; color: #000000;'  align='left'>Atesto para os devidos fins e de acordo com o artigo 168 da C.L.T.,"
                . "                                                                                                                 e NR-7, da portaria nº 24 de 27/12/94 que o paciente/funcionário<br>"
                . "                                                                                                                 cidato, foi examinado clinicamente, gozando no momento sanidade física e mental, não sendo de moléstias infectocontagiosas, <br> sendo considerado:<br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%;font-size: 21px; color: #000000;'  align='center'><b><u>$resultadoExame(A) PARA A FUNÇÃO<br></u><b></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%; border-top: 1 solid #000000;font-size: 21px; color: #000000;'  align='left'><b>EXAMES COMPLEMENTARES:</b><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'text-transform: uppercase; width: 100%; border-botom: 1 solid #000000;font-size: 21px; color: #000000;'  align='left'><b>&nbsp;$exameComplementar1, &nbsp;$exameComplementar2<br><br> &nbsp;$exameComplementar3, &nbsp;$exameComplementar4<br><br> &nbsp;$exameComplementar5,&nbsp;$exameComplementar6<br><br>&nbsp;$exameComplementar7,&nbsp;$exameComplementar8</b><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'width: 100%; border-top: 1 solid #000000;font-size: 21px; color: #000000;'  align='left'><b><br><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td  style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'></td>";
        $html .="<td  style= 'text-transform: uppercase; font-size: 23px; color: #000000;'  align='center'>$localRealizacao, $dataRealizacao</td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td  style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'></td>";
        $html .="<td  style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'>&nbsp;&nbsp;&nbsp;LOCAL e DATA &nbsp;&nbsp;<br><br><br><br><br><br><br></td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td  style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'>&nbsp;&nbsp;&nbsp;Assinatura: ($nomeFuncionario)&nbsp;&nbsp;&nbsp;</td>";
        $html .="<td  style= 'text-transform: uppercase; text-decoration: overline; font-size: 23px; color: #000000;'  align='center'>&nbsp;&nbsp;&nbsp;($medico - CRM Nº. $crm)&nbsp;&nbsp;&nbsp;</td>";
        $html .="</tr>";
        $html .="<tr>";
        $html .="<td colspan = '2' style= 'font-size: 21px; border-bottom: 1 solid #000000;'  align='left'></td>";
        $html .="</tr>";
        
        
        $html .="</table> ";
         
        }
        
        
        //$pasta = "C:/server/htdocs/gcconcreto/relatoriostemp/relatorio/"; // gcconcreto
        $pasta= 'C:/server/htdocs/gestaopessoas/fwk/uploads/pdf/'; // local

        if (is_dir($pasta)) {
            $diretorio = dir($pasta);

            while ($arquivo = $diretorio->read()) {
                if (($arquivo != '.') && ($arquivo != '..')) {
                    unlink($pasta . $arquivo);
                    echo 'Arquivo ' . $arquivo . ' foi apagado com sucesso. <br />';
                }
            }

            $diretorio->close();
        } else {
            echo 'A pasta não existe.';
        }


        $nomeDoArquivo = "atestado_aso.pdf";
        $tipoFolha = "P"; // P = Retrato | L = Paisagem



        $retorno = $this->geraPDFAtestado($nomeDoArquivo, $html, $tipoFolha);

        if ($retorno) {
            $gerado = true;
        } else {
            $gerado = false;
        }

        if ($gerado == true) {
            echo "Arquivo Gerado: " . $nomeDoArquivo . "\n";
        } else {
            echo "Erro ao gerar o arquivo.";
            return;
        }
    }
    
    private function geraPDFAtestado($nomeDoArquivo, $html, $tipo) {
        //print_r("gerapdf");exit();
        $dompdf = new DOMPDF();
        define("DOMPDF_ENABLE_REMOTE", true);
//	if ($tipo == "L") {
//		$dompdf->set_paper("legal", "landscape"); // Altera o papel para modo paisagem.
//	}
        $dompdf->load_html($html); // Carrega o HTML para a classe.
        $dompdf->render();



        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "normal");
        //$canvas->page_text(510, 18, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 8, array(0, 0, 0)); //header
        //$canvas->page_text(270, 792, "Copyright © 2015 - Empresa XPTO", $font, 6, array(0,0,0)); //footer
        header("Content-type: application/pdf");
        $pdf = $dompdf->output(); // Cria o pdf
       $nomeDoArquivo = "atestado_aso.pdf";

        //$arquivo = 'C:\server\htdocs\gcconcreto\relatoriostemp\relatorio\.'; // gcconcreto
        $arquivo = 'C:\server\htdocs\gestaopessoas\fwk\uploads\pdf\.'; //local
        $arquivo .= $nomeDoArquivo; // Caminho onde será salvo o arquivo.


        if (file_put_contents($arquivo, $pdf)) { //Tenta salvar o pdf gerado
            return true; // Salvo com sucesso.
        } else {
            return false; // Erro ao salvar o arquivo
        }
    }
    
    
    
    
    
}
