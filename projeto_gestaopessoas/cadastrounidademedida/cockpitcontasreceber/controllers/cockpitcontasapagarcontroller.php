<?php

class cockpitcontasapagarcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cockpitcontasapagarview');
    }
    
   
     
    public function salvarModal() {
       
                  
        $idTituloModal            = $this->input->POST('idTituloModal');
        $idEmpresaModal           = $this->input->POST('idEmpresaModal');
        $idFilialModal            = $this->input->POST('idFilialModal');
        $idFornecedorModal        = $this->input->POST('idFornecedorModal');
        $dataEmissaoModal         = $this->input->POST('dataEmissaoModal');
        $documentoModal           = $this->input->POST('documentoModal');
        $valorTituloModal         = $this->input->POST('valorTituloModal');
        $tipoCobrancaModal        = $this->input->POST('tipoCobrancaModal');
        $centroCustoModal         = $this->input->POST('centroCustoModal');
        $contaContabilModal       = $this->input->POST('contaContabilModal');
        $historicoModal           = $this->input->POST('historicoModal');
        $idCondicaoPagamentoModal = $this->input->POST('idCondicaoPagamentoModal');        
                                   
        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->salvarModal($idTituloModal, $idEmpresaModal, $idFilialModal, $idFornecedorModal, $dataEmissaoModal, $documentoModal, $valorTituloModal, $tipoCobrancaModal, $centroCustoModal, $contaContabilModal, $historicoModal, $idCondicaoPagamentoModal);

        echo json_encode($retorno);
    }
      
    
    public function excluirModal(){
        
        $idTituloModal  = $this->input->POST('idTituloModal');
               
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->excluirModal($idTituloModal);
            
    }
    
    
    public function buscaPrimeiroRegistroModal(){
        
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->buscaPrimeiroRegistroModal();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnteriorModal(){
              
        $idTituloModal  = $this->input->POST('idTituloModal');
        
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->buscaRegistroAnteriorModal($idTituloModal);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximoModal(){
        
        $idTituloModal  = $this->input->POST('idTituloModal');
        
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->buscaRegistroProximoModal($idTituloModal);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistroModal(){
        
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->buscaUltimoRegistroModal();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->pesquisaSimples($idInicial, $nomeInicial);
        
        echo ($retorno);
                
    }
    
    public function getGrid() {
        
       
       
        $tipoData   = $this->input->POST('tipoData');
        $periodoIni = $this->input->POST('periodoIni');
        $periodoFim = $this->input->POST('periodoFim');
        $situacao   = $this->input->POST('situacao');
        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial   = $this->input->POST('idFilial');
        
        $pOrdem = $this->input->POST('order');
        $pColumn = $this->input->POST('columns');
        $indice = $pColumn[$pOrdem[0]['column']]['data'];

        $ordem = $pOrdem[0]['dir'];
        $inicio = $this->input->POST('start');
        $tamanho = $this->input->POST('length');
        $draw = $this->input->POST('draw');
       
       
        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $tipoData, $periodoIni, $periodoFim, $situacao, $idEmpresa, $idFilial);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idBanco = $this->input->POST('idBanco');
                     
        $this->load->model('cockpitcontasapagarmodel');
        
        $retorno = $this->cockpitcontasapagarmodel->selecionaGrid($idBanco);
        
        echo ($retorno);
                
    }
    
    public function carregarGrupoEmpresa() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarGrupoEmpresa();

        echo json_encode($retorno);
    }
    
    public function carregarEmpresa() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    public function carregarBanco() {
        
        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial  = $this->input->POST('idFilial');

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarBanco($idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
    
    public function carregarAgencia() {
        
        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial  = $this->input->POST('idFilial');
        $idBanco  = $this->input->POST('idBanco');


        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarAgencia($idEmpresa, $idFilial, $idBanco);

        echo json_encode($retorno);
    }
    
    public function carregarFornecedor() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarFornecedor();

        echo json_encode($retorno);
    }
    
    public function carregarCentroCusto() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarCentroCusto();

        echo json_encode($retorno);
    }
    
    public function carregarCondicaoPagamento() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarCondicaoPagamento();

        echo json_encode($retorno);
    }
    
    public function carregarContaContabil() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarContaContabil();

        echo json_encode($retorno);
    }
    
    public function carregarParcelaHtml() {

        $this->load->model('cockpitcontasapagarmodel');
        
        $codPagamento = $this->input->POST('codParcela');
        $valorTitulo = $this->input->POST('valorTitulo');

        $retorno = $this->cockpitcontasapagarmodel->carregarParcelaHtml($codPagamento, $valorTitulo);

        echo json_encode($retorno);
    }
    
    public function getNumeroLinhas() {

        $this->load->model('cockpitcontasapagarmodel');
        
        $codPagamento = $this->input->POST('codParcela');
       

        $retorno = $this->cockpitcontasapagarmodel->getNumeroLinhas($codPagamento);

        echo json_encode($retorno);
    }
    
    public function novoModal() {

        $this->load->model('cockpitcontasapagarmodel');
    
        $retorno = $this->cockpitcontasapagarmodel->novoModal();

        echo json_encode($retorno);
    }
    
    public function salvarParcela() {

        $this->load->model('cockpitcontasapagarmodel');
        
        $idTitulo       = $this->input->POST('idTituloModal');
        $numeroParcela  = $this->input->POST('numeroParcela');
        $dataVencimento = $this->input->POST('dataVencimento');
        $dataProposta   = $this->input->POST('dataProposta');
        $valor          = $this->input->POST('valor');
        $idEmpresa      = $this->input->POST('idEmpresaModal');
        $idFilial       = $this->input->POST('idFilialModal');
        
        $retorno = $this->cockpitcontasapagarmodel->salvarParcela($idTitulo, $numeroParcela, $dataVencimento, $dataProposta, $valor, $idEmpresa, $idFilial);

        echo json_encode($retorno);
        
    }
    
    public function addLinhas() {

        $this->load->model('cockpitcontasapagarmodel');
        
        $total = $this->input->POST('total');
        $idTituloModal = $this->input->POST('idTituloModal');

        $retorno = $this->cockpitcontasapagarmodel->addLinhas($total, $idTituloModal);

        echo json_encode($retorno);
    }
    
    public function carregarContaCorrente() {

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->carregarContaCorrente();

        echo json_encode($retorno);
    }
    
     public function carregarBaixaModal(){
        
        $this->load->model('cockpitcontasapagarmodel');
        
        $idParcela = $this->input->POST('idParcela');
                
        $retorno = $this->cockpitcontasapagarmodel->carregarBaixaModal($idParcela);
        
        echo ($retorno);                
    }
      
     
        
    public function salvarModalBaixa() {
       
                  
        $idModalBaixa                  = $this->input->POST('idModalBaixa');
        $dataEmissaoModalBaixa         = $this->input->POST('dataEmissaoModalBaixa');
        $documentoModalBaixa           = $this->input->POST('documentoModalBaixa');
        $tipoCobrancaModalBaixa        = $this->input->POST('tipoCobrancaModalBaixa');
        $documentoPagamentoModalBaixa  = $this->input->POST('documentoPagamentoModalBaixa');
        $saldoDevedorModalBaixa        = $this->input->POST('saldoDevedorModalBaixa');
        $multaJurosModalBaixa          = $this->input->POST('multaJurosModalBaixa');
        $descontosModalBaixa           = $this->input->POST('descontosModalBaixa');
        $valorPagarModalBaixa          = $this->input->POST('valorPagarModalBaixa');
        $pagamentoModalBaixa           = $this->input->POST('pagamentoModalBaixa');
        $idContaCorrenteModalBaixa     = $this->input->POST('idContaCorrenteModalBaixa');
        $observacaoModalBaixa          = $this->input->POST('observacaoModalBaix');        
                                   
        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->salvarModalBaixa($idModalBaixa, $dataEmissaoModalBaixa, $documentoModalBaixa, $tipoCobrancaModalBaixa, $documentoModalBaixa, $tipoCobrancaModalBaixa, $documentoPagamentoModalBaixa, $saldoDevedorModalBaixa, $multaJurosModalBaixa, $descontosModalBaixa, $valorPagarModalBaixa, $pagamentoModalBaixa, $idContaCorrenteModalBaixa, $observacaoModalBaixa);

        echo json_encode($retorno);
    }
    
    public function editarBaixa() {
                
        $id  = $this->input->POST('id');

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->editarBaixa($id);

        echo json_encode($retorno);
    }
    
    public function editarBaixaParcela() {
                
        $quantidadeDeParcelas  = $this->input->POST('quantidadeDeParcelas');
        $idContaPagar          = $this->input->POST('idContaPagar');

        $this->load->model('cockpitcontasapagarmodel');

        $retorno = $this->cockpitcontasapagarmodel->editarBaixaParcela($quantidadeDeParcelas, $idContaPagar);

         echo json_encode($retorno);
         
    }
    
    public function carregarDataAtual(){
        
        $this->load->model('cockpitcontasapagarmodel');
                       
        $retorno = $this->cockpitcontasapagarmodel->carregarDataAtual();
        
        echo json_encode($retorno);                
    }
      
    public function getHtmlFiltro() {

        $this->load->model('cockpitcontasapagarmodel');
                 
        
        $periodoIni = $this->input->POST('periodoIni');
        $periodoFim = $this->input->POST('periodoFim');
        $situacao    = $this->input->POST('situacao');
        $tipoData   = $this->input->POST('tipoData');
        $idEmpresa  = $this->input->POST('idEmpresa');
        $idFilial   = $this->input->POST('idFilial');

        $retorno = $this->cockpitcontasapagarmodel->getHtmlFiltro($periodoIni, $periodoFim, $situacao, $tipoData, $idEmpresa, $idFilial);

        echo json_encode($retorno);
    } 
    
    

}
