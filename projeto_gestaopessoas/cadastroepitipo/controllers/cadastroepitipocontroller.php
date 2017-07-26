<?php

class cadastroepitipocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroepitipoview');
    }
    
    public function novo() {
        
        $this->load->model('cadastroepitipomodel');

        $retorno = $this->cadastroepitipomodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idEpiTipo   = $this->input->POST('idEpiTipo');
        $tipoEpi     = $this->input->POST('tipoEpi');
        $descricao   = $this->input->POST('descricao');
          
        
        
        $this->load->model('cadastroepitipomodel');

        $retorno = $this->cadastroepitipomodel->salvar($idEpiTipo, $tipoEpi, $descricao);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idEpiTipo = $this->input->POST('idEpiTipo');
        
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->excluir($idEpiTipo);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idEpiTipo = $this->input->POST('idEpiTipo');
        
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->buscaRegistroAnterior($idEpiTipo);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idEpiTipo = $this->input->POST('idEpiTipo');
        
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->buscaRegistroProximo($idEpiTipo);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        //$parametro1 = $this->input->GET('parametro1');
       // $parametro2 = $this->input->GET('parametro1');

        $this->load->model('cadastroepitipomodel');

        $retorno = $this->cadastroepitipomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
        
             
        
        
    }
    
    public function selecionaGrid(){
        
        $idEpiTipo = $this->input->POST('idEpiTipo');
                     
        $this->load->model('cadastroepitipomodel');
        
        $retorno = $this->cadastroepitipomodel->selecionaGrid($idEpiTipo);
        
        echo ($retorno);
                
    }
        
    
      
    
    
   

    

}
