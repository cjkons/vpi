<?php

class cadastrounidademedidacontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrounidademedidaview');
    }
    
    public function salvar() {
        
        
                
        $codigoUnidade      = $this->input->POST('codigoUnidade');
        $denominacaoUnidade = $this->input->POST('denominacaoUnidade');
        $ativoUnidade       = $this->input->POST('ativoUnidade');
                                        
        $this->load->model('cadastrounidademedidamodel');

        $retorno = $this->cadastrounidademedidamodel->salvar($codigoUnidade, $denominacaoUnidade, $ativoUnidade);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $codigoUnidade = $this->input->POST('codigoUnidade');
        
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->excluir($codigoUnidade);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $codigoUnidade = $this->input->POST('codigoUnidade');
        
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->buscaRegistroAnterior($codigoUnidade);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
       
        $codigoUnidade = $this->input->POST('codigoUnidade');
        
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->buscaRegistroProximo($codigoUnidade);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->pesquisaSimples($idInicial, $nomeInicial);
        
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
       
       
        $this->load->model('cadastrounidademedidamodel');

        $retorno = $this->cadastrounidademedidamodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
        
        
        
       
        
    }
    
    public function selecionaGrid(){
        
        $idCod = $this->input->POST('idCod');
                     
        $this->load->model('cadastrounidademedidamodel');
        
        $retorno = $this->cadastrounidademedidamodel->selecionaGrid($idCod);
        
        echo ($retorno);
                
    }
   

    

}
