<?php

class cadastrocompradorcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');  
    }

    public function index() {
        $this->load->view('cadastrocompradorview');
    }
    
    public function novo() {
        
        $this->load->model('cadastrocompradormodel');

        $retorno = $this->cadastrocompradormodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idComprador            = $this->input->POST('idComprador');
        $idEmpresa              = $this->input->POST('idEmpresa');
        $idFilial               = $this->input->POST('idFilial');
        $nomeComprador          = $this->input->POST('nomeComprador');
        $login                  = $this->input->POST('login');
        $ativo                  = $this->input->POST('ativo');
           
                        
        $this->load->model('cadastrocompradormodel');

        $retorno = $this->cadastrocompradormodel->salvar($idComprador, $idEmpresa, $idFilial, $nomeComprador, $login, $ativo);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idComprador = $this->input->POST('idComprador');
        
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->excluir($idComprador);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idComprador = $this->input->POST('idComprador');
        
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->buscaRegistroAnterior($idComprador);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idComprador = $this->input->POST('idComprador');
        
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->buscaRegistroProximo($idComprador);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->pesquisaSimples($idInicial, $nomeInicial);
        
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
       
       
        $this->load->model('cadastrocompradormodel');

        $retorno = $this->cadastrocompradormodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idComprador = $this->input->POST('idComprador');
                     
        $this->load->model('cadastrocompradormodel');
        
        $retorno = $this->cadastrocompradormodel->selecionaGrid($idComprador);
        
        echo ($retorno);
                
    }
    
    public function carregarEmpresa() {

        $this->load->model('cadastrocompradormodel');

        $retorno = $this->cadastrocompradormodel->carregarEmpresa();

        echo json_encode($retorno);
    }
   
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('cadastrocompradormodel');

        $retorno = $this->cadastrocompradormodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    
    

}
