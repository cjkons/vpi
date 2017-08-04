<?php

class cadastrofuncionariosmodel extends CI_Model {

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
        
        $query = "SELECT max(ID_FUNCIONARIO) AS ID_FUNCIONARIO FROM GP_CAD_FUNCIONARIO";
                        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0 && is_array($rs)){
            $novoIdUsuario = $rs[0]->ID_FUNCIONARIO + 1;
        }
        else{
            $novoIdUsuario = 1;
            
        }
                
        return $novoIdUsuario;
         
    }   
    

    public function salvar($idFuncionario, $empresa, $filial, $livro, $pagina, $nomeFuncionario, $dataNasc, $cidadeNasc, $estadoNasc, $dataCadastro,
                            $matricula, $funcao, $salarioValor, $salarioPagamento, $dataAdmissao, $experiencia, $horarioInicial1, $horarioFinal1, $horarioInicial2,
                            $horarioFinal2, $imagem, $cep, $endereco, $numero, $bairro, $cidade, $estado, $email, $telefone1, $telefone2, $telefone3, $cpf, $identidade,
                            $expedidorIdentidade, $estadoIdentidade, $dataIdentidade, $ctps, $serieCtps, $pisPasep, $dataPisPasep, $estadoCtps, $dataCtps, $tituloEleitor, $zonaEleitor,
                            $secaoEleitor, $nomeMae, $nomePai, $sexo, $estadoCivil, $deficienteFisico, $grauInstrucao, $etnia, $corOlhos, $corCabelos, $altura, $peso, $nomeFilho1,
                            $dataNasc1, $nomeFilho2, $dataNasc2, $nomeFilho3, $dataNasc3, $nomeFilho4, $dataNasc4, $nomeFilho5, $dataNasc5, $nomeFilho6, $dataNasc6, $setor, $desativado, $valeTransporte, $dataDemissao){

        $this->initConBanco();
        
        $salarioValor = str_replace('.', '', $salarioValor);
        $salarioValor = str_replace(',', '.', $salarioValor);
        
        $altura = str_replace(',', '.', $altura);
        
        $peso = str_replace(',', '.', $peso);
        
        $endereco = str_replace("'", '', $endereco);
        
         
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO  WHERE ID_FUNCIONARIO = $idFuncionario AND CPF = '$cpf'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_FUNCIONARIO SET EMPRESA  = '$empresa' , FILIAL = '$filial', LIVRO = '$livro', PAGINA = '$pagina',"
                    . " NOME_FUNCIONARIO = '$nomeFuncionario', DATA_NASC = '$dataNasc', CIDADE_NASC = '$cidadeNasc', ESTADO_NASC = '$estadoNasc', MATRICULA = '$matricula',"
                    . " FUNCAO = '$funcao', SALARIO_VALOR = $salarioValor, SALARIO_PAGAMENTO = '$salarioPagamento', DATA_ADMISSAO = '$dataAdmissao', EXPERIENCIA = '$experiencia',"
                    . " HORARIO_INICIAL_1 = '$horarioInicial1', HORARIO_FINAL_1 = '$horarioFinal1', HORARIO_INICIAL_2 = '$horarioInicial2', HORARIO_FINAL_2 = '$horarioFinal2', IMAGEM = '$imagem',"
                    . " CEP = '$cep', ENDERECO = '$endereco', NUMERO = '$numero', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado', EMAIL = '$email', TELEFONE_1 = '$telefone1', TELEFONE_2 = '$telefone2',"
                    . " TELEFONE_3 = '$telefone3', CPF = '$cpf', IDENTIDADE = '$identidade', EXPEDIDOR_IDENTIDADE = '$expedidorIdentidade', ESTADO_IDENTIDADE = '$estadoIdentidade', DATA_IDENTIDADE = '$dataIdentidade', CTPS = '$ctps',"
                    . " SERIE_CTPS = '$serieCtps', PIS_PASEP = '$pisPasep', ESTADO_CTPS = '$estadoCtps', DATA_CTPS = '$dataCtps', TITULO_ELEITOR = '$tituloEleitor', ZONA_ELEITOR = '$zonaEleitor', SECAO_ELEITOR = '$secaoEleitor',"
                    . " NOME_MAE = '$nomeMae', NOME_PAI = '$nomePai', SEXO = '$sexo', ESTADO_CIVIL = '$estadoCivil', DEFICIENTE_FISICO = '$deficienteFisico', GRAU_INSTRUCAO = '$grauInstrucao', ETNIA = '$etnia', COR_OLHOS = '$corOlhos',"
                    . " COR_CABELOS = '$corCabelos', ALTURA = '$altura', PESO = '$peso', NOME_FILHO_1 = '$nomeFilho1', DATA_NASC_1 = '$dataNasc1', NOME_FILHO_2 = '$nomeFilho2', DATA_NASC_2 = '$dataNasc2', NOME_FILHO_3 = '$nomeFilho3',"
                    . " DATA_NASC_3 = '$dataNasc3', NOME_FILHO_4 = '$nomeFilho4', DATA_NASC_4 = '$dataNasc4', NOME_FILHO_5 = '$nomeFilho5', DATA_NASC_5 = '$dataNasc5', NOME_FILHO_6 = '$nomeFilho6', DATA_NASC_6 = '$dataNasc6', SETOR = '$setor', DESATIVADO = '$desativado', DATA_PIS_PASEP ='$dataPisPasep', VALE_TRANSPORTE = '$valeTransporte', DATA_DEMISSAO = '$dataDemissao', USUARIO_ALTERACAO = '$usuarioLogado', DATA_ALTERACAO = SYSDATE WHERE ID_FUNCIONARIO = $idFuncionario";

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
            
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO  WHERE CPF = '$cpf'";
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            if (is_array($rs) && count($rs) > 0){
                
                return false;
                
            }else{
                
                $query = "SELECT MAX(ID_FUNCIONARIO)  AS ID_FUNCIONARIO FROM  GP_CAD_FUNCIONARIO";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();


                if(count($rs) == 0 ){
                    $novoId = 1;            
                }
                else{
                    $novoId = $rs[0]->ID_FUNCIONARIO + 1;
                }                       

                $query = "INSERT INTO GP_CAD_FUNCIONARIO (ID_FUNCIONARIO, EMPRESA, FILIAL, LIVRO, PAGINA, NOME_FUNCIONARIO, DATA_NASC, CIDADE_NASC, ESTADO_NASC, MATRICULA, FUNCAO, SALARIO_VALOR,"
                        . " SALARIO_PAGAMENTO, DATA_ADMISSAO, EXPERIENCIA, HORARIO_INICIAL_1, HORARIO_FINAL_1, HORARIO_INICIAL_2, HORARIO_FINAL_2, IMAGEM, CEP, ENDERECO, NUMERO, BAIRRO, CIDADE,"
                        . " ESTADO, EMAIL, TELEFONE_1, TELEFONE_2, TELEFONE_3, CPF, IDENTIDADE, EXPEDIDOR_IDENTIDADE, ESTADO_IDENTIDADE, DATA_IDENTIDADE, CTPS, SERIE_CTPS, PIS_PASEP, ESTADO_CTPS,"
                        . " DATA_CTPS, TITULO_ELEITOR, ZONA_ELEITOR, SECAO_ELEITOR, NOME_MAE, NOME_PAI, SEXO, ESTADO_CIVIL, DEFICIENTE_FISICO, GRAU_INSTRUCAO, ETNIA, COR_OLHOS, COR_CABELOS, ALTURA,"
                        . " PESO, NOME_FILHO_1, DATA_NASC_1, NOME_FILHO_2, DATA_NASC_2, NOME_FILHO_3, DATA_NASC_3, NOME_FILHO_4, DATA_NASC_4, NOME_FILHO_5, DATA_NASC_5, NOME_FILHO_6, SETOR, DESATIVADO, DATA_PIS_PASEP, VALE_TRANSPORTE, DATA_DEMISSAO, USUARIO_CADASTRO, DATA_CADASTRO)

                            VALUES ($novoId, '$empresa', '$filial', '$livro', '$pagina', '$nomeFuncionario', '$dataNasc', '$cidadeNasc', '$estadoNasc', '$matricula', '$funcao', $salarioValor, '$salarioPagamento',"
                        . " '$dataAdmissao', '$experiencia', '$horarioInicial1', '$horarioFinal1', '$horarioInicial2', '$horarioFinal2', '$imagem', '$cep', '$endereco', $numero, '$bairro', '$cidade', '$estado', '$email',"
                        . " '$telefone1', '$telefone2', '$telefone3', '$cpf', '$identidade', '$expedidorIdentidade', '$estadoIdentidade', '$dataIdentidade', '$ctps', '$serieCtps', '$pisPasep', '$estadoCtps', '$dataCtps', '$tituloEleitor',"
                        . " '$zonaEleitor', '$secaoEleitor', '$nomeMae', '$nomePai', '$sexo', '$estadoCivil', '$deficienteFisico', '$grauInstrucao', '$etnia', '$corOlhos', '$corCabelos', '$altura', '$peso', '$nomeFilho1', '$dataNasc1', '$nomeFilho2',"
                        . " '$dataNasc2', '$nomeFilho3', '$dataNasc3', '$nomeFilho4', '$dataNasc4', '$nomeFilho5', '$dataNasc5', '$nomeFilho6', '$setor', '$desativado', '$dataPisPasep', '$valeTransporte', '$dataDemissao', '$usuarioLogado', SYSDATE)";     

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
    }
    
    public function excluir($idFuncionario){
        
        $this->initConBanco();
        
        $query = "DELETE FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $idFuncionario";
                        
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
        
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO ORDER BY ID_FUNCIONARIO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_FUNCIONARIO;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $rs[0]->LIVRO;
            $obj[] = $rs[0]->PAGINA;
            $obj[] = $rs[0]->NOME_FUNCIONARIO;
            $obj[] = $rs[0]->DATA_NASC;
            $obj[] = $rs[0]->CIDADE_NASC;
            $obj[] = $rs[0]->ESTADO_NASC;
            $obj[] = $rs[0]->DATA_CADASTRO;
            
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->SALARIO_VALOR;
            $obj[] = $rs[0]->SALARIO_PAGAMENTO;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            $obj[] = $rs[0]->EXPERIENCIA;
            $obj[] = $rs[0]->HORARIO_INICIAL_1;
            $obj[] = $rs[0]->HORARIO_FINAL_1;
            $obj[] = $rs[0]->HORARIO_INICIAL_2;
            $obj[] = $rs[0]->HORARIO_FINAL_2;
            $obj[] = $rs[0]->IMAGEM;
            
            $obj[] = $rs[0]->CEP;
            $obj[] = $rs[0]->ENDERECO;
            $obj[] = $rs[0]->NUMERO;
            $obj[] = $rs[0]->BAIRRO;
            $obj[] = $rs[0]->CIDADE;
            $obj[] = $rs[0]->ESTADO;
            $obj[] = $rs[0]->EMAIL;
            $obj[] = $rs[0]->TELEFONE_1;
            $obj[] = $rs[0]->TELEFONE_2;
            $obj[] = $rs[0]->TELEFONE_3;
            
            $obj[] = $rs[0]->CPF;
            $obj[] = $rs[0]->IDENTIDADE;
            $obj[] = $rs[0]->EXPEDIDOR_IDENTIDADE;
            $obj[] = $rs[0]->ESTADO_IDENTIDADE;
            $obj[] = $rs[0]->DATA_IDENTIDADE;
            $obj[] = $rs[0]->CTPS;
            $obj[] = $rs[0]->SERIE_CTPS;
            $obj[] = $rs[0]->PIS_PASEP;
            $obj[] = $rs[0]->ESTADO_CTPS;
            $obj[] = $rs[0]->DATA_CTPS;
            $obj[] = $rs[0]->TITULO_ELEITOR;
            $obj[] = $rs[0]->ZONA_ELEITOR;
            $obj[] = $rs[0]->SECAO_ELEITOR;
            
            $obj[] = $rs[0]->NOME_MAE;
            $obj[] = $rs[0]->NOME_PAI;
            $obj[] = $rs[0]->SEXO;
            $obj[] = $rs[0]->ESTADO_CIVIL;
            $obj[] = $rs[0]->DEFICIENTE_FISICO;
            $obj[] = $rs[0]->GRAU_INSTRUCAO;
            $obj[] = $rs[0]->ETNIA;
            $obj[] = $rs[0]->COR_OLHOS;
            $obj[] = $rs[0]->COR_CABELOS;
            $obj[] = $rs[0]->ALTURA;
            $obj[] = $rs[0]->PESO;
            
            $obj[] = $rs[0]->NOME_FILHO_1;
            $obj[] = $rs[0]->DATA_NASC_1;
            $obj[] = $rs[0]->NOME_FILHO_2;
            $obj[] = $rs[0]->DATA_NASC_2;
            $obj[] = $rs[0]->NOME_FILHO_3;
            $obj[] = $rs[0]->DATA_NASC_3;
            $obj[] = $rs[0]->NOME_FILHO_4;
            $obj[] = $rs[0]->DATA_NASC_4;
            $obj[] = $rs[0]->NOME_FILHO_5;
            $obj[] = $rs[0]->DATA_NASC_5;
            $obj[] = $rs[0]->NOME_FILHO_6;
            $obj[] = $rs[0]->DATA_NASC_6;
            
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->DESATIVADO;
            $obj[] = $rs[0]->DATA_PIS_PASEP;
            $obj[] = $rs[0]->VALE_TRANSPORTE;
            
            $obj[] = $rs[0]->DATA_DEMISSAO;
            
            
                    
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistro(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO ORDER BY ID_FUNCIONARIO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            
            $obj[] = $rs[$cont]->ID_FUNCIONARIO;
            $obj[] = $rs[$cont]->EMPRESA;
            $obj[] = $rs[$cont]->FILIAL;
            $obj[] = $rs[$cont]->LIVRO;
            $obj[] = $rs[$cont]->PAGINA;
            $obj[] = $rs[$cont]->NOME_FUNCIONARIO;
            $obj[] = $rs[$cont]->DATA_NASC;
            $obj[] = $rs[$cont]->CIDADE_NASC;
            $obj[] = $rs[$cont]->ESTADO_NASC;
            $obj[] = $rs[$cont]->DATA_CADASTRO;
            
            $obj[] = $rs[$cont]->MATRICULA;
            $obj[] = $rs[$cont]->FUNCAO;
            $obj[] = $rs[$cont]->SALARIO_VALOR;
            $obj[] = $rs[$cont]->SALARIO_PAGAMENTO;
            $obj[] = $rs[$cont]->DATA_ADMISSAO;
            $obj[] = $rs[$cont]->EXPERIENCIA;
            $obj[] = $rs[$cont]->HORARIO_INICIAL_1;
            $obj[] = $rs[$cont]->HORARIO_FINAL_1;
            $obj[] = $rs[$cont]->HORARIO_INICIAL_2;
            $obj[] = $rs[$cont]->HORARIO_FINAL_2;
            $obj[] = $rs[$cont]->IMAGEM;
            
            $obj[] = $rs[$cont]->CEP;
            $obj[] = $rs[$cont]->ENDERECO;
            $obj[] = $rs[$cont]->NUMERO;
            $obj[] = $rs[$cont]->BAIRRO;
            $obj[] = $rs[$cont]->CIDADE;
            $obj[] = $rs[$cont]->ESTADO;
            $obj[] = $rs[$cont]->EMAIL;
            $obj[] = $rs[$cont]->TELEFONE_1;
            $obj[] = $rs[$cont]->TELEFONE_2;
            $obj[] = $rs[$cont]->TELEFONE_3;
            
            $obj[] = $rs[$cont]->CPF;
            $obj[] = $rs[$cont]->IDENTIDADE;
            $obj[] = $rs[$cont]->EXPEDIDOR_IDENTIDADE;
            $obj[] = $rs[$cont]->ESTADO_IDENTIDADE;
            $obj[] = $rs[$cont]->DATA_IDENTIDADE;
            $obj[] = $rs[$cont]->CTPS;
            $obj[] = $rs[$cont]->SERIE_CTPS;
            $obj[] = $rs[$cont]->PIS_PASEP;
            $obj[] = $rs[$cont]->ESTADO_CTPS;
            $obj[] = $rs[$cont]->DATA_CTPS;
            $obj[] = $rs[$cont]->TITULO_ELEITOR;
            $obj[] = $rs[$cont]->ZONA_ELEITOR;
            $obj[] = $rs[$cont]->SECAO_ELEITOR;
            
            $obj[] = $rs[$cont]->NOME_MAE;
            $obj[] = $rs[$cont]->NOME_PAI;
            $obj[] = $rs[$cont]->SEXO;
            $obj[] = $rs[$cont]->ESTADO_CIVIL;
            $obj[] = $rs[$cont]->DEFICIENTE_FISICO;
            $obj[] = $rs[$cont]->GRAU_INSTRUCAO;
            $obj[] = $rs[$cont]->ETNIA;
            $obj[] = $rs[$cont]->COR_OLHOS;
            $obj[] = $rs[$cont]->COR_CABELOS;
            $obj[] = $rs[$cont]->ALTURA;
            $obj[] = $rs[$cont]->PESO;
            
            $obj[] = $rs[$cont]->NOME_FILHO_1;
            $obj[] = $rs[$cont]->DATA_NASC_1;
            $obj[] = $rs[$cont]->NOME_FILHO_2;
            $obj[] = $rs[$cont]->DATA_NASC_2;
            $obj[] = $rs[$cont]->NOME_FILHO_3;
            $obj[] = $rs[$cont]->DATA_NASC_3;
            $obj[] = $rs[$cont]->NOME_FILHO_4;
            $obj[] = $rs[$cont]->DATA_NASC_4;
            $obj[] = $rs[$cont]->NOME_FILHO_5;
            $obj[] = $rs[$cont]->DATA_NASC_5;
            $obj[] = $rs[$cont]->NOME_FILHO_6;
            $obj[] = $rs[$cont]->DATA_NASC_6;
            
            $obj[] = $rs[$cont]->SETOR;
            $obj[] = $rs[$cont]->DESATIVADO;
            $obj[] = $rs[$cont]->DATA_PIS_PASEP;
            $obj[] = $rs[$cont]->VALE_TRANSPORTE;
            
            $obj[] = $rs[$cont]->DATA_DEMISSAO;
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnterior($idFuncionario){
        
        $this->initConBanco();
        
        $cont = 1;
        
        
        for($i =0; $i < 10; $i++){
            
            $idProcura = $idFuncionario - $cont; 

            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO =  $idProcura" ;

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_FUNCIONARIO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->LIVRO;
                $obj[] = $rs[0]->PAGINA;
                $obj[] = $rs[0]->NOME_FUNCIONARIO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CIDADE_NASC;
                $obj[] = $rs[0]->ESTADO_NASC;
                $obj[] = $rs[0]->DATA_CADASTRO;

                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->SALARIO_VALOR;
                $obj[] = $rs[0]->SALARIO_PAGAMENTO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->EXPERIENCIA;
                $obj[] = $rs[0]->HORARIO_INICIAL_1;
                $obj[] = $rs[0]->HORARIO_FINAL_1;
                $obj[] = $rs[0]->HORARIO_INICIAL_2;
                $obj[] = $rs[0]->HORARIO_FINAL_2;
                $obj[] = $rs[0]->IMAGEM;

                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->TELEFONE_3;

                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->IDENTIDADE;
                $obj[] = $rs[0]->EXPEDIDOR_IDENTIDADE;
                $obj[] = $rs[0]->ESTADO_IDENTIDADE;
                $obj[] = $rs[0]->DATA_IDENTIDADE;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->SERIE_CTPS;
                $obj[] = $rs[0]->PIS_PASEP;
                $obj[] = $rs[0]->ESTADO_CTPS;
                $obj[] = $rs[0]->DATA_CTPS;
                $obj[] = $rs[0]->TITULO_ELEITOR;
                $obj[] = $rs[0]->ZONA_ELEITOR;
                $obj[] = $rs[0]->SECAO_ELEITOR;

                $obj[] = $rs[0]->NOME_MAE;
                $obj[] = $rs[0]->NOME_PAI;
                $obj[] = $rs[0]->SEXO;
                $obj[] = $rs[0]->ESTADO_CIVIL;
                $obj[] = $rs[0]->DEFICIENTE_FISICO;
                $obj[] = $rs[0]->GRAU_INSTRUCAO;
                $obj[] = $rs[0]->ETNIA;
                $obj[] = $rs[0]->COR_OLHOS;
                $obj[] = $rs[0]->COR_CABELOS;
                $obj[] = $rs[0]->ALTURA;
                $obj[] = $rs[0]->PESO;

                $obj[] = $rs[0]->NOME_FILHO_1;
                $obj[] = $rs[0]->DATA_NASC_1;
                $obj[] = $rs[0]->NOME_FILHO_2;
                $obj[] = $rs[0]->DATA_NASC_2;
                $obj[] = $rs[0]->NOME_FILHO_3;
                $obj[] = $rs[0]->DATA_NASC_3;
                $obj[] = $rs[0]->NOME_FILHO_4;
                $obj[] = $rs[0]->DATA_NASC_4;
                $obj[] = $rs[0]->NOME_FILHO_5;
                $obj[] = $rs[0]->DATA_NASC_5;
                $obj[] = $rs[0]->NOME_FILHO_6;
                $obj[] = $rs[0]->DATA_NASC_6;
                
                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->DESATIVADO;
                $obj[] = $rs[0]->DATA_PIS_PASEP;
                $obj[] = $rs[0]->VALE_TRANSPORTE;
                
                $obj[] = $rs[0]->DATA_DEMISSAO;


                return json_encode($obj);
            }
            
            $cont++;
        
        
        }
        
            return false;
        
           
    }
    
    
     public function buscaRegistroProximo($idFuncionario){
        
        $this->initConBanco();
                 
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
        
                
            $idProcura = $idFuncionario + $cont;  

            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO =  $idProcura";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_FUNCIONARIO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->LIVRO;
                $obj[] = $rs[0]->PAGINA;
                $obj[] = $rs[0]->NOME_FUNCIONARIO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CIDADE_NASC;
                $obj[] = $rs[0]->ESTADO_NASC;
                $obj[] = $rs[0]->DATA_CADASTRO;

                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->SALARIO_VALOR;
                $obj[] = $rs[0]->SALARIO_PAGAMENTO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->EXPERIENCIA;
                $obj[] = $rs[0]->HORARIO_INICIAL_1;
                $obj[] = $rs[0]->HORARIO_FINAL_1;
                $obj[] = $rs[0]->HORARIO_INICIAL_2;
                $obj[] = $rs[0]->HORARIO_FINAL_2;
                $obj[] = $rs[0]->IMAGEM;

                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->TELEFONE_3;

                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->IDENTIDADE;
                $obj[] = $rs[0]->EXPEDIDOR_IDENTIDADE;
                $obj[] = $rs[0]->ESTADO_IDENTIDADE;
                $obj[] = $rs[0]->DATA_IDENTIDADE;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->SERIE_CTPS;
                $obj[] = $rs[0]->PIS_PASEP;
                $obj[] = $rs[0]->ESTADO_CTPS;
                $obj[] = $rs[0]->DATA_CTPS;
                $obj[] = $rs[0]->TITULO_ELEITOR;
                $obj[] = $rs[0]->ZONA_ELEITOR;
                $obj[] = $rs[0]->SECAO_ELEITOR;

                $obj[] = $rs[0]->NOME_MAE;
                $obj[] = $rs[0]->NOME_PAI;
                $obj[] = $rs[0]->SEXO;
                $obj[] = $rs[0]->ESTADO_CIVIL;
                $obj[] = $rs[0]->DEFICIENTE_FISICO;
                $obj[] = $rs[0]->GRAU_INSTRUCAO;
                $obj[] = $rs[0]->ETNIA;
                $obj[] = $rs[0]->COR_OLHOS;
                $obj[] = $rs[0]->COR_CABELOS;
                $obj[] = $rs[0]->ALTURA;
                $obj[] = $rs[0]->PESO;

                $obj[] = $rs[0]->NOME_FILHO_1;
                $obj[] = $rs[0]->DATA_NASC_1;
                $obj[] = $rs[0]->NOME_FILHO_2;
                $obj[] = $rs[0]->DATA_NASC_2;
                $obj[] = $rs[0]->NOME_FILHO_3;
                $obj[] = $rs[0]->DATA_NASC_3;
                $obj[] = $rs[0]->NOME_FILHO_4;
                $obj[] = $rs[0]->DATA_NASC_4;
                $obj[] = $rs[0]->NOME_FILHO_5;
                $obj[] = $rs[0]->DATA_NASC_5;
                $obj[] = $rs[0]->NOME_FILHO_6;
                $obj[] = $rs[0]->DATA_NASC_6;

                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->DESATIVADO;
                $obj[] = $rs[0]->DATA_PIS_PASEP;
                $obj[] = $rs[0]->VALE_TRANSPORTE;
                
                $obj[] = $rs[0]->DATA_DEMISSAO;

                return json_encode($obj);
            }
            
            $cont++;
        } 
           
    }
    
    public function pesquisaSimples($idInicial, $nomeInicial){
        
      $this->initConBanco();
         
        if($idInicial == "" || $idInicial == null ){
            
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE NOME_FUNCIONARIO LIKE '%$nomeInicial%'";
            
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FUNCIONARIO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->LIVRO;
                $obj[] = $rs[0]->PAGINA;
                $obj[] = $rs[0]->NOME_FUNCIONARIO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CIDADE_NASC;
                $obj[] = $rs[0]->ESTADO_NASC;
                $obj[] = $rs[0]->DATA_CADASTRO;

                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->SALARIO_VALOR;
                $obj[] = $rs[0]->SALARIO_PAGAMENTO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->EXPERIENCIA;
                $obj[] = $rs[0]->HORARIO_INICIAL_1;
                $obj[] = $rs[0]->HORARIO_FINAL_1;
                $obj[] = $rs[0]->HORARIO_INICIAL_2;
                $obj[] = $rs[0]->HORARIO_FINAL_2;
                $obj[] = $rs[0]->IMAGEM;

                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->TELEFONE_3;

                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->IDENTIDADE;
                $obj[] = $rs[0]->EXPEDIDOR_IDENTIDADE;
                $obj[] = $rs[0]->ESTADO_IDENTIDADE;
                $obj[] = $rs[0]->DATA_IDENTIDADE;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->SERIE_CTPS;
                $obj[] = $rs[0]->PIS_PASEP;
                $obj[] = $rs[0]->ESTADO_CTPS;
                $obj[] = $rs[0]->DATA_CTPS;
                $obj[] = $rs[0]->TITULO_ELEITOR;
                $obj[] = $rs[0]->ZONA_ELEITOR;
                $obj[] = $rs[0]->SECAO_ELEITOR;

                $obj[] = $rs[0]->NOME_MAE;
                $obj[] = $rs[0]->NOME_PAI;
                $obj[] = $rs[0]->SEXO;
                $obj[] = $rs[0]->ESTADO_CIVIL;
                $obj[] = $rs[0]->DEFICIENTE_FISICO;
                $obj[] = $rs[0]->GRAU_INSTRUCAO;
                $obj[] = $rs[0]->ETNIA;
                $obj[] = $rs[0]->COR_OLHOS;
                $obj[] = $rs[0]->COR_CABELOS;
                $obj[] = $rs[0]->ALTURA;
                $obj[] = $rs[0]->PESO;

                $obj[] = $rs[0]->NOME_FILHO_1;
                $obj[] = $rs[0]->DATA_NASC_1;
                $obj[] = $rs[0]->NOME_FILHO_2;
                $obj[] = $rs[0]->DATA_NASC_2;
                $obj[] = $rs[0]->NOME_FILHO_3;
                $obj[] = $rs[0]->DATA_NASC_3;
                $obj[] = $rs[0]->NOME_FILHO_4;
                $obj[] = $rs[0]->DATA_NASC_4;
                $obj[] = $rs[0]->NOME_FILHO_5;
                $obj[] = $rs[0]->DATA_NASC_5;
                $obj[] = $rs[0]->NOME_FILHO_6;
                $obj[] = $rs[0]->DATA_NASC_6;

                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->DESATIVADO;
                $obj[] = $rs[0]->DATA_PIS_PASEP;
                $obj[] = $rs[0]->VALE_TRANSPORTE;
                
                $obj[] = $rs[0]->DATA_DEMISSAO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        }
        else{
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = '$idInicial'";
         
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
                        
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FUNCIONARIO;
                $obj[] = $rs[0]->EMPRESA;
                $obj[] = $rs[0]->FILIAL;
                $obj[] = $rs[0]->LIVRO;
                $obj[] = $rs[0]->PAGINA;
                $obj[] = $rs[0]->NOME_FUNCIONARIO;
                $obj[] = $rs[0]->DATA_NASC;
                $obj[] = $rs[0]->CIDADE_NASC;
                $obj[] = $rs[0]->ESTADO_NASC;
                $obj[] = $rs[0]->DATA_CADASTRO;

                $obj[] = $rs[0]->MATRICULA;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->SALARIO_VALOR;
                $obj[] = $rs[0]->SALARIO_PAGAMENTO;
                $obj[] = $rs[0]->DATA_ADMISSAO;
                $obj[] = $rs[0]->EXPERIENCIA;
                $obj[] = $rs[0]->HORARIO_INICIAL_1;
                $obj[] = $rs[0]->HORARIO_FINAL_1;
                $obj[] = $rs[0]->HORARIO_INICIAL_2;
                $obj[] = $rs[0]->HORARIO_FINAL_2;
                $obj[] = $rs[0]->IMAGEM;

                $obj[] = $rs[0]->CEP;
                $obj[] = $rs[0]->ENDERECO;
                $obj[] = $rs[0]->NUMERO;
                $obj[] = $rs[0]->BAIRRO;
                $obj[] = $rs[0]->CIDADE;
                $obj[] = $rs[0]->ESTADO;
                $obj[] = $rs[0]->EMAIL;
                $obj[] = $rs[0]->TELEFONE_1;
                $obj[] = $rs[0]->TELEFONE_2;
                $obj[] = $rs[0]->TELEFONE_3;

                $obj[] = $rs[0]->CPF;
                $obj[] = $rs[0]->IDENTIDADE;
                $obj[] = $rs[0]->EXPEDIDOR_IDENTIDADE;
                $obj[] = $rs[0]->ESTADO_IDENTIDADE;
                $obj[] = $rs[0]->DATA_IDENTIDADE;
                $obj[] = $rs[0]->CTPS;
                $obj[] = $rs[0]->SERIE_CTPS;
                $obj[] = $rs[0]->PIS_PASEP;
                $obj[] = $rs[0]->ESTADO_CTPS;
                $obj[] = $rs[0]->DATA_CTPS;
                $obj[] = $rs[0]->TITULO_ELEITOR;
                $obj[] = $rs[0]->ZONA_ELEITOR;
                $obj[] = $rs[0]->SECAO_ELEITOR;

                $obj[] = $rs[0]->NOME_MAE;
                $obj[] = $rs[0]->NOME_PAI;
                $obj[] = $rs[0]->SEXO;
                $obj[] = $rs[0]->ESTADO_CIVIL;
                $obj[] = $rs[0]->DEFICIENTE_FISICO;
                $obj[] = $rs[0]->GRAU_INSTRUCAO;
                $obj[] = $rs[0]->ETNIA;
                $obj[] = $rs[0]->COR_OLHOS;
                $obj[] = $rs[0]->COR_CABELOS;
                $obj[] = $rs[0]->ALTURA;
                $obj[] = $rs[0]->PESO;

                $obj[] = $rs[0]->NOME_FILHO_1;
                $obj[] = $rs[0]->DATA_NASC_1;
                $obj[] = $rs[0]->NOME_FILHO_2;
                $obj[] = $rs[0]->DATA_NASC_2;
                $obj[] = $rs[0]->NOME_FILHO_3;
                $obj[] = $rs[0]->DATA_NASC_3;
                $obj[] = $rs[0]->NOME_FILHO_4;
                $obj[] = $rs[0]->DATA_NASC_4;
                $obj[] = $rs[0]->NOME_FILHO_5;
                $obj[] = $rs[0]->DATA_NASC_5;
                $obj[] = $rs[0]->NOME_FILHO_6;
                $obj[] = $rs[0]->DATA_NASC_6;

                $obj[] = $rs[0]->SETOR;
                $obj[] = $rs[0]->DESATIVADO;
                $obj[] = $rs[0]->DATA_PIS_PASEP;
                $obj[] = $rs[0]->VALE_TRANSPORTE;
                
                $obj[] = $rs[0]->DATA_DEMISSAO;
                
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
        
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO ORDER BY ID_FUNCIONARIO";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {

            $aux = $item->ID_FUNCIONARIO;
            $empresa = $item->EMPRESA;
            $filial = $item->FILIAL;
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
            
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = $funcao  ";
             //print_r($query);exit();      
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $nomeFuncao  = $rs[0]->FUNCAO;
            
            $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = $setor  ";
             //print_r($query);exit();      
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $nomeSetor  = $rs[0]->SETOR;
            
            $obj['ID_FUNCIONARIO'] = $item->ID_FUNCIONARIO;
            $obj['EMPRESA'] = $nomeEmpresa;
            $obj['FILIAL'] = $nomeFilial;
            $obj['NOME_FUNCIONARIO'] = $item->NOME_FUNCIONARIO;
            $obj['MATRICULA'] = $item->MATRICULA;
            $obj['FUNCAO'] = $nomeFuncao;
            $obj['SETOR'] = $nomeSetor;
            $obj['SELECIONAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>SELECIONAR</button>";
          
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
        
        
       
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_FUNCIONARIO) AS TOTAL FROM GP_CAD_FUNCIONARIO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }         
          
    }
    
    public function selecionaGrid($idFuncionario){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE ID_FUNCIONARIO = $idFuncionario";
         
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                                
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $rs[0]->ID_FUNCIONARIO;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $rs[0]->LIVRO;
            $obj[] = $rs[0]->PAGINA;
            $obj[] = $rs[0]->NOME_FUNCIONARIO;
            $obj[] = $rs[0]->DATA_NASC;
            $obj[] = $rs[0]->CIDADE_NASC;
            $obj[] = $rs[0]->ESTADO_NASC;
            $obj[] = $rs[0]->DATA_CADASTRO;
            
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->FUNCAO;
            $obj[] = $rs[0]->SALARIO_VALOR;
            $obj[] = $rs[0]->SALARIO_PAGAMENTO;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            $obj[] = $rs[0]->EXPERIENCIA;
            $obj[] = $rs[0]->HORARIO_INICIAL_1;
            $obj[] = $rs[0]->HORARIO_FINAL_1;
            $obj[] = $rs[0]->HORARIO_INICIAL_2;
            $obj[] = $rs[0]->HORARIO_FINAL_2;
            $obj[] = $rs[0]->IMAGEM;
            
            $obj[] = $rs[0]->CEP;
            $obj[] = $rs[0]->ENDERECO;
            $obj[] = $rs[0]->NUMERO;
            $obj[] = $rs[0]->BAIRRO;
            $obj[] = $rs[0]->CIDADE;
            $obj[] = $rs[0]->ESTADO;
            $obj[] = $rs[0]->EMAIL;
            $obj[] = $rs[0]->TELEFONE_1;
            $obj[] = $rs[0]->TELEFONE_2;
            $obj[] = $rs[0]->TELEFONE_3;
            
            $obj[] = $rs[0]->CPF;
            $obj[] = $rs[0]->IDENTIDADE;
            $obj[] = $rs[0]->EXPEDIDOR_IDENTIDADE;
            $obj[] = $rs[0]->ESTADO_IDENTIDADE;
            $obj[] = $rs[0]->DATA_IDENTIDADE;
            $obj[] = $rs[0]->CTPS;
            $obj[] = $rs[0]->SERIE_CTPS;
            $obj[] = $rs[0]->PIS_PASEP;
            $obj[] = $rs[0]->ESTADO_CTPS;
            $obj[] = $rs[0]->DATA_CTPS;
            $obj[] = $rs[0]->TITULO_ELEITOR;
            $obj[] = $rs[0]->ZONA_ELEITOR;
            $obj[] = $rs[0]->SECAO_ELEITOR;
            
            $obj[] = $rs[0]->NOME_MAE;
            $obj[] = $rs[0]->NOME_PAI;
            $obj[] = $rs[0]->SEXO;
            $obj[] = $rs[0]->ESTADO_CIVIL;
            $obj[] = $rs[0]->DEFICIENTE_FISICO;
            $obj[] = $rs[0]->GRAU_INSTRUCAO;
            $obj[] = $rs[0]->ETNIA;
            $obj[] = $rs[0]->COR_OLHOS;
            $obj[] = $rs[0]->COR_CABELOS;
            $obj[] = $rs[0]->ALTURA;
            $obj[] = $rs[0]->PESO;
            
            $obj[] = $rs[0]->NOME_FILHO_1;
            $obj[] = $rs[0]->DATA_NASC_1;
            $obj[] = $rs[0]->NOME_FILHO_2;
            $obj[] = $rs[0]->DATA_NASC_2;
            $obj[] = $rs[0]->NOME_FILHO_3;
            $obj[] = $rs[0]->DATA_NASC_3;
            $obj[] = $rs[0]->NOME_FILHO_4;
            $obj[] = $rs[0]->DATA_NASC_4;
            $obj[] = $rs[0]->NOME_FILHO_5;
            $obj[] = $rs[0]->DATA_NASC_5;
            $obj[] = $rs[0]->NOME_FILHO_6;
            $obj[] = $rs[0]->DATA_NASC_6;
            
            $obj[] = $rs[0]->SETOR;
            $obj[] = $rs[0]->DESATIVADO;
            $obj[] = $rs[0]->DATA_PIS_PASEP;
            $obj[] = $rs[0]->VALE_TRANSPORTE;
            
            $obj[] = $rs[0]->DATA_DEMISSAO;
                
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
    
    public function carregarSetor(){
        
        $this->initConBanco();

        $query = "SELECT ID_SETOR, SETOR FROM GP_CAD_SETOR ORDER BY SETOR ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idSetor = $item->ID_SETOR;
                $setor      = $item->SETOR;
                $html .= "<option value='$idSetor'>$setor</option>";
            }

            return $html; 
        } else {
            return "<option value='0'>Nenhuma Setor Cadastrado</option>";
        }
           
        
    }
    
    public function carregarDataAtual() {

        $dataAtual = date('d/m/Y');

        return $dataAtual;
    }
    
    
    
    
    
}
