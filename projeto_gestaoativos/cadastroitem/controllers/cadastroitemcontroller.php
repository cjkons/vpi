<?php

class cadastroitemcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');  
    }

    public function index() {
        $this->load->view('cadastroitemview');
    }
    
    public function novo() {
        
        $this->load->model('cadastroitemmodel');

        $retorno = $this->cadastroitemmodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idItem             = $this->input->POST('idItem');
        $codItem            = $this->input->POST('codItem');
        $descItem           = $this->input->POST('descItem');
        $comprador          = $this->input->POST('comprador');
        $unidadeMedida      = $this->input->POST('unidadeMedida');
        $tipoFiscal         = $this->input->POST('tipoFiscal');
        $tipoItem           = $this->input->POST('tipoItem');
        $familia            = $this->input->POST('familia'); 
        $contaContabil      = $this->input->POST('contaContabil');
        $codNCM             = $this->input->POST('codNCM');
        $codFiscal          = $this->input->POST('codFiscal');
        $contabiliza        = $this->input->POST('contabiliza');
        $incidenciaICMS     = $this->input->POST('incidenciaICMS');
        $incidenciaIPI      = $this->input->POST('incidenciaIPI');
        $contabPISCOFINS    = $this->input->POST('contabPISCOFINS');
        $ativo              = $this->input->POST('ativo');      
             
                        
        $this->load->model('cadastroitemmodel');

        $retorno = $this->cadastroitemmodel->salvar($idItem, $codItem, $descItem, $comprador, $unidadeMedida, $tipoFiscal, $tipoItem, $familia, $contaContabil, $codNCM, $codFiscal, $contabiliza, $incidenciaICMS, $incidenciaIPI, $contabPISCOFINS, $ativo);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idItem = $this->input->POST('idItem');
        
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->excluir($idItem);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idItem = $this->input->POST('idItem');
        
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->buscaRegistroAnterior($idItem);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idItem = $this->input->POST('idItem');
        
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->buscaRegistroProximo($idItem);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->pesquisaSimples($idInicial, $nomeInicial);
        
        echo ($retorno);
                
    }
    
    public function getGrid() {
        
           
        $pOrdem = $this->input->POST('order');
        $pColumn = $this->input->POST('columns');
        $indice = $pColumn[$pOrdem[0]['column']]['data'];

        $ordem = $pOrdem[0]['dir'];
        $inicio = $this->input->POST('start');
        $tamanho = $this->input->POST('length');
        $draw = $this->input->POST('draw');
       
       
        $this->load->model('cadastroitemmodel');

        $retorno = $this->cadastroitemmodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idItem = $this->input->POST('idItem');
                     
        $this->load->model('cadastroitemmodel');
        
        $retorno = $this->cadastroitemmodel->selecionaGrid($idItem);
        
        echo ($retorno);
                
    }
    
    public function carregarUnidadeMedida() {

        $this->load->model('cadastroitemmodel');

        $retorno = $this->cadastroitemmodel->carregarUnidadeMedida();

        echo json_encode($retorno);
    }
   
    
    public function carregarFamilia() {

        $this->load->model('cadastroitemmodel');

        $retorno = $this->cadastroitemmodel->carregarFamilia();

        echo json_encode($retorno);
    }
    
    
    public function carregarComprador() {

        $this->load->model('cadastroitemmodel');

        $retorno = $this->cadastroitemmodel->carregarComprador();

        echo json_encode($retorno);
    }

    

}
