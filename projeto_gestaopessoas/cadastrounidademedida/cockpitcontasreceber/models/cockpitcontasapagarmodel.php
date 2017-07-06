<?php

class cockpitcontasapagarmodel extends CI_Model {

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

   

    public function salvarModal($idTituloModal, $idEmpresaModal, $idFilialModal, $idFornecedorModal, $dataEmissaoModal, $documentoModal, $valorTituloModal, $tipoCobrancaModal, $centroCustoModal, $contaContabilModal, $historicoModal, $idCondicaoPagamentoModal){
     
        $this->initConBanco();
                
        $valorTituloModal = str_replace( '.', '',$valorTituloModal); // altera os valores com virgula para ponto
        $valorTituloModal = str_replace( ',', '.',$valorTituloModal);
        
        
        $query = "SELECT * FROM FIN_CONTA_PAGAR  WHERE ID_CONTA_PAGAR = $idTituloModal";
        
        //print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                     
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            $versaoAntiga =  $rs[0]->VERSAO;
            $versao = $rs[0]->VERSAO + 1;
             
            $query = "UPDATE FIN_CONTA_PAGAR SET ULTIMA_VERSAO = 'N' WHERE ID_CONTA_PAGAR = $idTituloModal AND VERSAO = $versaoAntiga";                             

            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);
             
        }
        else{
            $versao = 1;
        }
        
       

        $query = "INSERT INTO FIN_CONTA_PAGAR (ID_CONTA_PAGAR, SITUACAO, DOCUMENTO, DATA_EMISSAO, FORNECEDOR, HISTORICO, TIPO_COBRANCA, ORIGEM, PARCELA, VALOR, VERSAO, ID_EMPRESA, ID_FILIAL, USUARIO_CADASTRO, DATA_CADASTRO, CENTRO_CUSTO, CONTA_CONTABIL, ULTIMA_VERSAO)
                             VALUES ($idTituloModal, 'Aberto', '$documentoModal', '$dataEmissaoModal', '$idFornecedorModal', '$historicoModal', '$tipoCobrancaModal', 'Financeiro', '$idCondicaoPagamentoModal', $valorTituloModal, '$versao', '$idEmpresaModal', '$idFilialModal', '$usuarioLogado', SYSDATE, '$centroCustoModal', '$contaContabilModal', 'S')";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {
            return true;
        } else {
            return false;
        }
    
    }
    
    public function excluirModal($idTituloModal){
        
        $this->initConBanco();
        
        $query = "DELETE FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR = '$idTituloModal'";
               
        $resultado = $this->conBanco->query($query);
                        
        if($resultado == true || $resultado == 1){
            
            $query = "DELETE FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR = '$idTituloModal'";

            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {
                return true;
            } else {
                return false;
            }
        }
        else{
            return false;
        }
         
    }
    
    public function buscaPrimeiroRegistroModal(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ULTIMA_VERSAO = 'S' ORDER BY ID_CONTA_PAGAR";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
              
        
        
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_CONTA_PAGAR;
            $obj[] = $rs[0]->ID_EMPRESA;
            $obj[] = $rs[0]->ID_FILIAL;
            $obj[] = $rs[0]->FORNECEDOR;
            $obj[] = $rs[0]->DATA_EMISSAO;
            $obj[] = $rs[0]->DOCUMENTO;
            $obj[] = $rs[0]->VALOR;
            $obj[] = $rs[0]->TIPO_COBRANCA;
            $obj[] = $rs[0]->CENTRO_CUSTO;
            $obj[] = $rs[0]->CONTA_CONTABIL;
            $obj[] = $rs[0]->HISTORICO;
            $obj[] = $rs[0]->PARCELA;
            
            $idContaPagar = $rs[0]->ID_CONTA_PAGAR;
            
            $query = "SELECT count(*) as TOTAL FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR = '$idContaPagar' AND ULTIMA_VERSAO = 'S'";
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $obj[] = $rs[0]->TOTAL;
            
            
          
               
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    public function buscaUltimoRegistroModal(){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ULTIMA_VERSAO = 'S' ORDER BY ID_CONTA_PAGAR";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $obj = array();
        
        $cont = count($rs) - 1;
      
        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[$cont]->ID_CONTA_PAGAR;
            $obj[] = $rs[$cont]->ID_EMPRESA;
            $obj[] = $rs[$cont]->ID_FILIAL;
            $obj[] = $rs[$cont]->FORNECEDOR;
            $obj[] = $rs[$cont]->DATA_EMISSAO;
            $obj[] = $rs[$cont]->DOCUMENTO;
            $obj[] = $rs[$cont]->VALOR;
            $obj[] = $rs[$cont]->TIPO_COBRANCA;
            $obj[] = $rs[$cont]->CENTRO_CUSTO;
            $obj[] = $rs[$cont]->CONTA_CONTABIL;
            $obj[] = $rs[$cont]->HISTORICO;
            $obj[] = $rs[$cont]->PARCELA;
            
             $idContaPagar = $rs[$cont]->ID_CONTA_PAGAR;
            
            $query = "SELECT count(*) as TOTAL FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR = '$idContaPagar' AND ULTIMA_VERSAO = 'S'";
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $obj[] = $rs[0]->TOTAL;
            
           
        
            return json_encode($obj);
        }
        else{
            return false;
        }
           
    }
    
    public function buscaRegistroAnteriorModal($idTituloModal){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
            
            
            $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR =  '$idTituloModal' AND ULTIMA_VERSAO = 'S'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            $idConta = $rs[0]->ID_CONTA_PAGAR;
                    
            $idProcura = $idConta - $cont;  

            $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR =  $idProcura AND ULTIMA_VERSAO = 'S'" ;

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_CONTA_PAGAR;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->FORNECEDOR;
                $obj[] = $rs[0]->DATA_EMISSAO;
                $obj[] = $rs[0]->DOCUMENTO;
                $obj[] = $rs[0]->VALOR;
                $obj[] = $rs[0]->TIPO_COBRANCA;
                $obj[] = $rs[0]->CENTRO_CUSTO;
                $obj[] = $rs[0]->CONTA_CONTABIL;
                $obj[] = $rs[0]->HISTORICO;
                $obj[] = $rs[0]->PARCELA;
                
                $idContaPagar = $rs[0]->ID_CONTA_PAGAR;

                $query = "SELECT count(*) as TOTAL FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR = '$idContaPagar' AND ULTIMA_VERSAO = 'S'";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $obj[] = $rs[0]->TOTAL;


                return json_encode($obj);
            }
            
            $cont++;
       
        }
           
    }
    
     public function buscaRegistroProximoModal($idTituloModal){
        
        $this->initConBanco();
        
        $cont = 1;
                
        for($i =0; $i < 10; $i++){
            
                       
            $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR =  '$idTituloModal' AND ULTIMA_VERSAO = 'S'";

            //print_r($query);exit();
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
        
            //print_r($query);exit();
            
            $idConta = $rs[0]->ID_CONTA_PAGAR;
                    
            $idProcura = $idConta + $cont;                  

            $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR =  '$idProcura' AND ULTIMA_VERSAO = 'S'";
            
            //print_r($query);exit();

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){

                $obj[] = $rs[0]->ID_CONTA_PAGAR;
                $obj[] = $rs[0]->ID_EMPRESA;
                $obj[] = $rs[0]->ID_FILIAL;
                $obj[] = $rs[0]->FORNECEDOR;
                $obj[] = $rs[0]->DATA_EMISSAO;
                $obj[] = $rs[0]->DOCUMENTO;
                $obj[] = $rs[0]->VALOR;
                $obj[] = $rs[0]->TIPO_COBRANCA;
                $obj[] = $rs[0]->CENTRO_CUSTO;
                $obj[] = $rs[0]->CONTA_CONTABIL;
                $obj[] = $rs[0]->HISTORICO;
                $obj[] = $rs[0]->PARCELA;
                
                $idContaPagar = $rs[0]->ID_CONTA_PAGAR;

                $query = "SELECT count(*) as TOTAL FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR = '$idContaPagar' AND ULTIMA_VERSAO = 'S'";

                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $obj[] = $rs[0]->TOTAL;
                

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
    
    public function getGrid($indice, $ordem, $inicio, $tamanho, $draw, $tipoData, $periodoIni, $periodoFim, $situacao, $idEmpresa, $idFilial){
        
             
        $this->initConBanco();
        
        
        $count = $this->getCountGrid();

        $grid = array();

        $grid['draw'] = $draw; // mecanismo de conformidade
        $grid['recordsTotal'] = $count; // total de registros 
        $grid['recordsFiltered'] = $count; // tota de registros filtrados

        $data = array(); // linhas
        //$itens = $this->getDataGrid($indice, $ordem, $inicio, $tamanho, $parametro1, $parametro2);
        if($situacao != "0"){
        
            if($tipoData == "Data Proposta"){

                $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA WHERE  DATA_PROPOSTA >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim'  AND SITUACAO = Upper('$situacao') AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial  ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $itens = $cs->result();


            }
            if($tipoData == "Vencimento"){

               $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA  WHERE  DATA_VENCIMENTO >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim'  AND SITUACAO = Upper('$situacao')AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial ORDER BY ID_CONTA_PAGAR_PARCELA";

               //print_r($query);exit();
               $cs = $this->conBanco->query($query);
               $itens = $cs->result();

            }
        }
        else{
            
            if($tipoData == "Data Proposta"){

                $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA WHERE  DATA_PROPOSTA >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $itens = $cs->result();


            }
            if($tipoData == "Vencimento"){

               $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA  WHERE  DATA_VENCIMENTO >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial  ORDER BY ID_CONTA_PAGAR_PARCELA";

               //print_r($query);exit();
               $cs = $this->conBanco->query($query);
               $itens = $cs->result();

            }
                 
        }        
                
        $obj = array();

        foreach ($itens as $item) {
                 
            $aux = $item->ID_CONTA_PAGAR_PARCELA;
            $busca = $item->ID_CONTA_PAGAR;
            
            $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE  ID_CONTA_PAGAR = '$busca' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial";
                
           // print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
               
            if($item->SITUACAO == "PAGO"){
                
                $obj['STATUS'] = "<img style='width: 100;' src='resources/cockpitcontasapagar/img/iconeOk.jpg'/>";  
                
            }
            if($item->SITUACAO == "ABERTO"){
                
                $obj['STATUS'] = "<img style='width: 100;' src='resources/cockpitcontasapagar/img/iconeNok.jpg'/>";  
                
            }
            
            
            $valorParcela = str_replace(',', '.', $item->VALOR_PARCELA);
            $valorParcela = number_format($valorParcela, 2, ',', '.');
            
            
            $valorTotal = str_replace(',', '.', $rs[0]->VALOR);
            $valorTotal = number_format($valorTotal, 2, ',', '.');
            
                        
            $obj['SITUACAO'] = $item->SITUACAO;
            $obj['DOCUMENTO'] = $rs[0]->DOCUMENTO;
            $obj['VENCIMENTO'] = "$item->DATA_VENCIMENTO";
            $obj['EMISSAO'] = $rs[0]->DATA_EMISSAO;
            $obj['FORNECEDOR'] = $rs[0]->FORNECEDOR;
            $obj['HISTORICO'] = $rs[0]->HISTORICO;
            $obj['TIPO'] = $rs[0]->TIPO_COBRANCA;
            $obj['ORIGEM'] = $rs[0]->ORIGEM;
            $obj['PARCELA'] = $item->NUMERO_PARCELA;
            $obj['VALOR_PARCELA'] = $valorParcela;
            $obj['VALOR_TOTAL'] = $valorTotal;
            if($item->SITUACAO == "PAGO"){
                $obj['BAIXAR']  = "<button type='submit' class='btn-primary' ></button>";
                $obj['EXCLUIR'] = "<button type='submit' class='btn-primary' ></button>"; 
            }
            if($item->SITUACAO == "ABERTO"){
                $obj['BAIXAR']  = "<button type='submit' class='btn-primary' onclick='pesquisarBaixa($aux)'>Baixar</button>";
                $obj['EXCLUIR'] = "<button type='submit' class='btn-primary' onclick='editarBaixa($aux)'>Editar</button>";             
            }
                                  
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
    
    
    public function carregarFornecedor(){
        
        $this->initConBanco();

        $query = "SELECT NOME_FANTASIA FROM SUP_FORNECEDOR_CLIENTE  WHERE ATIVO = 'S' ORDER BY NOME_FANTASIA ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

              
                $nome      = $item->NOME_FANTASIA;
                $html .= "<option value='$nome'>$nome</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Empresa Cadastrado</option>";
        }
           
        
    }
    
    public function carregarCentroCusto(){
        
        $this->initConBanco();

        $query = "SELECT CENTRO_CUSTO FROM FIN_CENTRO_CUSTO  WHERE ATIVO = 'SIM' ORDER BY CENTRO_CUSTO ";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

              
                $nome      = $item->CENTRO_CUSTO;
                $html .= "<option value='$nome'>$nome</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Empresa Cadastrado</option>";
        }
           
        
    }
    
    public function carregarCondicaoPagamento(){
        
        $this->initConBanco();

        $query = "SELECT * FROM FIN_CONDICAO_PAGAMENTO ORDER BY CODIGO";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {
                               
            
            foreach ($rs as $item) {
                
                $codigo      = $item->CODIGO;
                
                $query = "SELECT * FROM FIN_CONDICAO_PAGAMENTO_PARCELA WHERE CODIGO_CONDICAO = '$item->CODIGO'";
                  
                $cs = $this->conBanco->query($query);
                $pr = $cs->result();
                
                $parcelas     = "";
                $parcelas    .= $codigo;
                $parcelas    .= " - ";
                foreach($pr as $parcial){
                    
                    $parcelas .= $parcial->QUANTIDADE_DIAS;
                    $parcelas .= "/";
                    
                                
                }
  
                
                $html .= "<option value='$codigo'>$parcelas</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Conição de pagamento cadastrada</option>";
        }
           
        
    }
    
    public function carregarContaContabil(){
        
        $this->initConBanco();

        $query = "SELECT * FROM FIN_PLANO_CONTAS order by CONTA";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $cod    = $item->ID_PLANO_CONTAS;
                $nome  = $item->CONTA;
                $html .= "<option value='$cod'>$nome</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Nenhuma Empresa Cadastrado</option>";
        }
           
        
    }
    public function carregarParcelaHtml($codPagamento, $valorTitulio){
        
        $this->initConBanco();

        $query = "SELECT * FROM FIN_CONDICAO_PAGAMENTO WHERE CODIGO = '$codPagamento'";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "";

        if (is_array($rs) && count($rs) > 0) {
         

            $codigo = $rs[0]->CODIGO;

            $query = "SELECT count(*) AS TOTAL FROM FIN_CONDICAO_PAGAMENTO_PARCELA WHERE CODIGO_CONDICAO = '$codigo'";
            
            $cs = $this->conBanco->query($query);
            $parcela = $cs->result();
            
            $total =  $parcela[0]->TOTAL;
            
            $query = "SELECT * FROM FIN_CONDICAO_PAGAMENTO_PARCELA WHERE CODIGO_CONDICAO = '$codigo'";
            
            $cs = $this->conBanco->query($query);
            $resultado = $cs->result();
            
            
            
            $dataAtual = date('d/m/Y');
            
            
            $html .="<tr>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Parcela</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Vencimento</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Data Proposta</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Valor</div></td>
                    </tr>";
            
            
            
            
            for($i = 1;$i <= $total; $i++){
                
                $idParcela       = $i;
                $idVencimento    = $i;
                $idVencimento   .= "_";
                $idVencimento   .= $i;        
                $idDataProposta  = $i;
                $idDataProposta .= "_";
                $idDataProposta .= $i;        
                $idDataProposta .= "_";
                $idDataProposta .= $i; 
                $idValor         = $i;
                $idValor        .= "_";
                $idValor        .= $i;        
                $idValor        .= "_";
                $idValor        .= $i;
                $idValor        .= "_";
                $idValor        .= $i;
                
                $j = $i - 1;
                $quantidadeDias = $resultado[$j]->QUANTIDADE_DIAS;
                $porcentagem    = $resultado[$j]->PORCENTAGEM;
                
                
                
                
                $valor =  ($valorTitulio * ($porcentagem/100)); 
                
                $valor = str_replace(',', '.', $valor);
                $valorFinal = number_format($valor, 2, ',', '.');
                
                
                $diasAdd = "+";
                $diasAdd .= $quantidadeDias;
                $diasAdd .= " days";
                
                $dataTroca = str_replace("/", "-", $dataAtual);
                    
                $dataAdd =   date('d/m/Y', strtotime($diasAdd ,strtotime($dataTroca)));   // date('d/m/Y', strtotime($dataAtual.  '+ 10 days'));
                
                
                $html .="<tr>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idParcela' value='$i'></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idVencimento' value='$dataAdd'></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idDataProposta' value='$dataAtual'></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idValor' value='$valorFinal' onblur='salvarParcela($i)'></div></td>
                        </tr>";
                
                
            }
           
            return $html;
            
        } else {
            return 0;
        }
    }
    
    public function getNumeroLinhas($codPagamento){
        
        $this->initConBanco();

        $query = "SELECT COUNT(*) AS TOTAL FROM FIN_CONDICAO_PAGAMENTO_PARCELA WHERE CODIGO_CONDICAO = '$codPagamento'";
         
        //print_r($query);exit();
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {

            $total = $rs[0]->TOTAL;
            return $total;
          
        } 
        else {
            return false;
        }
        
                   
    }
    
    public function novoModal(){
        
        $this->initConBanco();
                  
        $query = "SELECT MAX(ID_CONTA_PAGAR) AS ID FROM  FIN_CONTA_PAGAR";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) == 0) {
            $novoId = 1;
        } else {
            $novoId = $rs[0]->ID + 1;
        }
        
        return $novoId;
    }
    
    public function salvarParcela($idTitulo, $numeroParcela, $dataVencimento, $dataProposta, $valor, $idEmpresa, $idFilial){
        
        $this->initConBanco();
        
        
                  
        $valor = str_replace( '.', '',$valor); // altera os valores com virgula para ponto
        $valor = str_replace( ',', '.',$valor);       
        
        
        $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA  WHERE ID_CONTA_PAGAR = $idTitulo AND NUMERO_PARCELA = $numeroParcela";
        
              
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                     
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            $versaoAntiga =  $rs[0]->VERSAO;
            $versao = $rs[0]->VERSAO + 1;
             
            $query = "UPDATE FIN_CONTA_PAGAR_PARCELA SET ULTIMA_VERSAO = 'N' WHERE ID_CONTA_PAGAR = $idTitulo AND VERSAO = $versaoAntiga AND NUMERO_PARCELA = $numeroParcela";                             

            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);
             
             
        }
        else{
            $versao = 1;
        }
        
        $query = "SELECT MAX(ID_CONTA_PAGAR_PARCELA) AS ID FROM  FIN_CONTA_PAGAR_PARCELA";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (count($rs) == 0) {
            $novoId = 1;
        } else {
            $novoId = $rs[0]->ID + 1;
        }

        $query = "INSERT INTO FIN_CONTA_PAGAR_PARCELA (ID_CONTA_PAGAR_PARCELA, ID_CONTA_PAGAR, NUMERO_PARCELA, DATA_VENCIMENTO,  DATA_PROPOSTA, VALOR_PARCELA, VERSAO, DATA_CADASTRO, USUARIO_CADASTRO, SITUACAO, ULTIMA_VERSAO, ID_EMPRESA, ID_FILIAL)
                             VALUES ($novoId, $idTitulo, $numeroParcela, '$dataVencimento', '$dataProposta',  $valor, '$versao',  SYSDATE, '$usuarioLogado','ABERTO', 'S', '$idEmpresa', '$idFilial')";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function addLinhas($total, $idTituloModal){
        
        $this->initConBanco();
        
        
        $this->initConBanco();

        $query = "select *   FROM FIN_CONTA_PAGAR_parcela WHERE ID_CONTA_PAGAR = '$idTituloModal' AND ULTIMA_VERSAO = 'S' ORDER BY NUMERO_PARCELA";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "";

        if (is_array($rs) && count($rs) > 0) {
            
            
            $html .="<tr>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Parcela</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Vencimento</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Data Proposta</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Valor</div></td>
                    </tr>";
            
            for($i= 1; $i <= $total; $i++){
                
                
                $idParcela       = $i;
                $idVencimento    = $i;
                $idVencimento   .= "_";
                $idVencimento   .= $i;        
                $idDataProposta  = $i;
                $idDataProposta .= "_";
                $idDataProposta .= $i;        
                $idDataProposta .= "_";
                $idDataProposta .= $i; 
                $idValor         = $i;
                $idValor        .= "_";
                $idValor        .= $i;        
                $idValor        .= "_";
                $idValor        .= $i;
                $idValor        .= "_";
                $idValor        .= $i;
                
                $j = $i - 1;
                $parcela = $rs[$j]->NUMERO_PARCELA;
                $dataVencimento  = $rs[$j]->DATA_VENCIMENTO;
                $dataProposta    = $rs[$j]->DATA_PROPOSTA;
                $valor           = $rs[$j]->VALOR_PARCELA;
                
                
                $html .="<tr>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idParcela' value='$parcela' readonly></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idVencimento' value='$dataVencimento' readonly></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idDataProposta' value='$dataProposta' readonly></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idValor' value='$valor' onblur='salvarParcela($i)' readonly></div></td>
                        </tr>";
                           
            }
        }
        
        return $html;
        
        
    }
    
    public function carregarContaCorrente(){
        
        $this->initConBanco();

        $query = "SELECT * FROM FIN_CONTA ORDER BY ID_CONTA";
                  
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {
                
                $query = "SELECT * FROM FIN_CONTA ORDER BY ID_CONTA";
                  
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                

                $idConta  = $item->ID_CONTA;
                $banco    = $item->ID_BANCO;
                $agencia  = $item->AGENCIA;
                
                $query = "SELECT * FROM FIN_BANCO WHERE ID_BANCO = $banco";
                  
                $cs = $this->conBanco->query($query);
                $rsbanco = $cs->result();
                
                if (is_array($rsbanco) && count($rsbanco) > 0) {
                    $nome = $rsbanco[0]->NOME;
                    
                }
                else{
                     $nome = " - ";
                }
                
               
                
                $query = "SELECT * FROM FIN_AGENCIA WHERE ID_AGENCIA = $agencia";
                  
                $cs = $this->conBanco->query($query);
                $rsagencia = $cs->result();
                
                 if (is_array($rsagencia) && count($rsagencia) > 0) {
                     
                      $nome .= " - ";
                      $nome .= $rsagencia[0]->NOME;
                      $nome .= " - ";
                      $nome .= $item->CONTA;
                      
                 }
                 else{
                     $nome .=  " ";
                 }
                
                
               
                
                
                $html .= "<option value='$idConta'>$nome</option>";
            }

            return $html;
        } 
        else {
            return "<option value='0'>Nenhuma Empresa Cadastrado</option>";
        }
      
        
    }
    public function carregarBaixaModal($idParcela){
        
        $this->initConBanco();
        
        
        $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR_PARCELA =  '$idParcela'";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
            
            
        $idConta = $rs[0]->ID_CONTA_PAGAR;
                    
        $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR =  '$idConta'";
          
        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rsConta = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0 && is_array($rsConta) && count($rs)> 0) {
            
            $dataAtual = date('d/m/Y');
           
            $obj[] = $dataAtual;
            $obj[] = $rsConta[0]->DOCUMENTO;
            $obj[] = $rsConta[0]->TIPO_COBRANCA;
            $obj[] = $rs[0]->VALOR_PARCELA;
            $obj[] = $rs[0]->VALOR_PARCELA;
            $obj[] = $rs[0]->VALOR_PARCELA;
            $obj[] = $rsConta[0]->HISTORICO;
           
            return json_encode($obj);
        }
    }
    
    public function salvarModalBaixa($idModalBaixa, $dataEmissaoModalBaixa, $documentoModalBaixa, $tipoCobrancaModalBaixa, $documentoModalBaixa, $tipoCobrancaModalBaixa, $documentoPagamentoModalBaixa, $saldoDevedorModalBaixa, $multaJurosModalBaixa, $descontosModalBaixa, $valorPagarModalBaixa, $pagamentoModalBaixa, $idContaCorrenteModalBaixa, $observacaoModalBaixa){
        
        $this->initConBanco();
        
        
        $descontosModalBaixa  = str_replace( '.', '',$descontosModalBaixa); // altera os valores com virgula para ponto
        $descontosModalBaixa  = str_replace( ',', '.',$descontosModalBaixa);
        $valorPagarModalBaixa = str_replace( '.', '',$valorPagarModalBaixa);
        $valorPagarModalBaixa = str_replace( ',', '.',$valorPagarModalBaixa);
        $multaJurosModalBaixa = str_replace( '.', '',$multaJurosModalBaixa); // altera os valores com virgula para ponto
        $multaJurosModalBaixa = str_replace( ',', '.',$multaJurosModalBaixa);
        
          
        $query = "UPDATE FIN_CONTA_PAGAR_PARCELA SET CONTA_ORIGEM_PAGAMENTO = '$idContaCorrenteModalBaixa',  DATA_PAGAMENTO = '$dataEmissaoModalBaixa', VALOR_DESCONTO = $descontosModalBaixa, VALOR_MULTA = $multaJurosModalBaixa, VALOR_PAGO = $valorPagarModalBaixa, SITUACAO = 'PAGO', NUMERO_DOCUMENTO_PAGAMENTO = '$documentoPagamentoModalBaixa'  WHERE ID_CONTA_PAGAR_PARCELA = '$idModalBaixa' AND ULTIMA_VERSAO = 'S'";

        //print_r($query);exit();
        $resultado = $this->conBanco->query($query);
            
                
        if($resultado == true || $resultado == 1){
            
            $query = "SELECT ID_CONTA_PAGAR FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR_PARCELA =  '$idModalBaixa' AND ULTIMA_VERSAO = 'S'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $idContaPagar =  $rs[0]->ID_CONTA_PAGAR;
            
            $query = "SELECT COUNT(*) FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR =  '$idContaPagar' AND SITUACAO = 'ABERTO' AND ULTIMA_VERSAO = 'S'";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                    
            if(count($rs)> 0){
                return true;
            }
            else{
                $query = "UPDATE FIN_CONTA_PAGAR SET SITUACAO = 'PAGO', WHERE ID_CONTA_PAGAR_PARCELA = '$idContaPagar' AND ULTIMA_VERSAO = 'S'";
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);
                return true;
            }
                           
        }
        else{
            return false;
        }
        
        
    }
    
    public function editarBaixa($id){
        
        $this->initConBanco();
        
        $query = "SELECT ID_CONTA_PAGAR FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR_PARCELA =  '$id' AND ULTIMA_VERSAO = 'S'";

       //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result(); 
        
        
        if(is_array($rs) && count($rs) > 0){
            
            $idContaPagar = $rs[0]->ID_CONTA_PAGAR;
            
            $query = "SELECT * FROM FIN_CONTA_PAGAR WHERE ID_CONTA_PAGAR =  '$idContaPagar' AND ULTIMA_VERSAO = 'S'" ;

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                       
            $obj = array();
            
            if(is_array($rs) && count($rs) > 0){
                
                $valor = $rs[0]->VALOR;
                $valor = str_replace(',', '.', $valor);
                $valorFinal = number_format($valor, 2, ',', '.');
                
                 
                $obj[] =  $rs[0]->ID_CONTA_PAGAR ;
                $obj[] =  $rs[0]->ID_EMPRESA;
                $obj[] =  $rs[0]->ID_FILIAL;
                $obj[] =  $rs[0]->FORNECEDOR;
                $obj[] =  $rs[0]->DATA_EMISSAO;
                $obj[] =  $rs[0]->DOCUMENTO;
                $obj[] =  $valorFinal;
                $obj[] =  $rs[0]->TIPO_COBRANCA;
                $obj[] =  $rs[0]->CENTRO_CUSTO;
                $obj[] =  $rs[0]->PARCELA;
                $obj[] =  $rs[0]->CONTA_CONTABIL;
                $obj[] =  $rs[0]->HISTORICO;
                
                $query = "SELECT count(*) as TOTAL FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR = '$idContaPagar' AND ULTIMA_VERSAO = 'S'";
        
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
            
                $obj[] = $rs[0]->TOTAL;
                                
                return ($obj);
                
            }
            
            
        }
        
    }
    public function editarBaixaParcela($quantidadeDeParcelas, $idContaPagar){
        
        
        
        $this->initConBanco();
        
        $query = "SELECT * FROM FIN_CONTA_PAGAR_PARCELA WHERE ID_CONTA_PAGAR =  '$idContaPagar' AND ULTIMA_VERSAO = 'S'";

            //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result(); 
        
        $html = "";
        
        $html .="<tr>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Parcela</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Vencimento</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Data Proposta</div></td>
                        <td  style='padding-right: 5px;font-size: 14px;'><div class='form'>Valor</div></td>
                    </tr>";




        for ($i = 1; $i <= $quantidadeDeParcelas; $i++) {

            $idParcela = $i;
            $idVencimento = $i;
            $idVencimento .= "_";
            $idVencimento .= $i;
            $idDataProposta = $i;
            $idDataProposta .= "_";
            $idDataProposta .= $i;
            $idDataProposta .= "_";
            $idDataProposta .= $i;
            $idValor = $i;
            $idValor .= "_";
            $idValor .= $i;
            $idValor .= "_";
            $idValor .= $i;
            $idValor .= "_";
            $idValor .= $i;

            $j = $i - 1;            
            
            $dataVencimento = $rs[$j]->DATA_VENCIMENTO;
            $dataProposta   = $rs[$j]->DATA_PROPOSTA;
            $valor          = $rs[$j]->VALOR_PARCELA;
            
            
            $valor = str_replace(',', '.', $valor);
            $valorFinal = number_format($valor, 2, ',', '.');
           

            $html .="<tr>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idParcela' value='$i'></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idVencimento' value='$dataVencimento'></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idDataProposta' value='$dataProposta'></div></td>
                            <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$idValor' value='$valorFinal' onblur='salvarParcela($i)'></div></td>
                        </tr>";
        }

        return $html;
        
        
    }
    
    public function carregarDataAtual(){
        
        $dataAtual = date('d/m/Y');
        
        return $dataAtual;
       
    }
    
    public function getHtmlFiltro($periodoIni, $periodoFim, $situacao, $tipoData, $idEmpresa, $idFilial){
        
        
        $this->initConBanco();
        
        
        $html = "";
         
        if($situacao != "0"){
        
            if($tipoData == "Data Proposta"){

                $query = "SELECT SUM(VALOR_PARCELA) AS VALOR_PARCELA FROM FIN_CONTA_PAGAR_PARCELA WHERE  DATA_PROPOSTA >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim'  AND SITUACAO = Upper('$situacao') AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial  ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                
                $valorParcela = $rs[0]->VALOR_PARCELA;
                
                
                $query = "SELECT SUM(VALOR_PAGO)AS VALOR_PAGO FROM FIN_CONTA_PAGAR_PARCELA WHERE  DATA_PROPOSTA >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim'  AND SITUACAO = Upper('$situacao') AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial  ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                
                $valorPago = $rs[0]->VALOR_PAGO;
                

            }
            if($tipoData == "Vencimento"){

                $query = "SELECT SUM(VALOR_PARCELA) AS VALOR_PARCELA FROM FIN_CONTA_PAGAR_PARCELA  WHERE  DATA_VENCIMENTO >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim'  AND SITUACAO = Upper('$situacao')AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
               
                $valorParcela = $rs[0]->VALOR_PARCELA;
               
               
               $query = "SELECT SUM(VALOR_PAGO) AS VALOR_PAGO FROM FIN_CONTA_PAGAR_PARCELA  WHERE  DATA_VENCIMENTO >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim'  AND SITUACAO = Upper('$situacao')AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial ORDER BY ID_CONTA_PAGAR_PARCELA";

               //print_r($query);exit();
               $cs = $this->conBanco->query($query);
               $rs = $cs->result();
               
               $valorPago = $rs[0]->VALOR_PAGO;

            }
        }
        else{
            
            if($tipoData == "Data Proposta"){

                $query = "SELECT SUM(VALOR_PARCELA)AS VALOR_PARCELA FROM FIN_CONTA_PAGAR_PARCELA WHERE  DATA_PROPOSTA >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                
                $valorParcela = $rs[0]->VALOR_PARCELA;
                
                
                $query = "SELECT SUM(VALOR_PAGO)AS VALOR_PAGO FROM FIN_CONTA_PAGAR_PARCELA WHERE  DATA_PROPOSTA >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                
                $valorPago = $rs[0]->VALOR_PAGO;
                
                

            }
            if($tipoData == "Vencimento"){

               $query = "SELECT SUM(VALOR_PARCELA)AS VALOR_PARCELA FROM FIN_CONTA_PAGAR_PARCELA  WHERE  DATA_VENCIMENTO >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial  ORDER BY ID_CONTA_PAGAR_PARCELA";

                //print_r($query);exit();
               $cs = $this->conBanco->query($query);
               $rs = $cs->result();
               
               $valorParcela = $rs[0]->VALOR_PARCELA;
               
               $query = "SELECT SUM(VALOR_PAGO)AS VALOR_PAGO FROM FIN_CONTA_PAGAR_PARCELA  WHERE  DATA_VENCIMENTO >= '$periodoIni' AND DATA_PROPOSTA <= '$periodoFim' AND ULTIMA_VERSAO = 'S' AND ID_EMPRESA = $idEmpresa AND ID_FILIAL = $idFilial  ORDER BY ID_CONTA_PAGAR_PARCELA";

               //print_r($query);exit();
               $cs = $this->conBanco->query($query);
               $rs = $cs->result();
               
               $valorPago = $rs[0]->VALOR_PAGO;
               

            }
                 
        }
        
       if($valorPago == "" || $valorPago == null){
           $valorPago = 0;
           
       }
       
       if($situacao == "Pago"){
           $valorParcela = 0;
       }
        
        $valorParcela = str_replace(',', '.', $valorParcela);
        $valorParcela = number_format($valorParcela, 2, ',', '.');
        
        $valorPago = str_replace(',', '.', $valorPago);
        $valorPago = number_format($valorPago, 2, ',', '.');
            
          
            
        
        $html .="<tr>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><img style='width: 100;' src='resources/cockpitcontasapagar/img/iconeOk.jpg'/>No Prazo</div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><img style='width: 100;' src='resources/cockpitcontasapagar/img/iconeNok.jpg'/>Atrasado</div></td>
                    <td>
                        <div class=form>
                            Total a pagar
                            <input type='text' class='form-control' value='$valorParcela'  readonly>
                        </div>
                    </td>
                     <td>
                        <div class=form>
                            Total Pago
                            <input type='text' class='form-control' value='$valorPago'  readonly>
                        </div>
                    </td>
                     
                </tr>";
        
        
        return $html;
    }   
    
}