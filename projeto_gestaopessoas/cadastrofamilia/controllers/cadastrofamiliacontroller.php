<?php

class cadastrofamiliacontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrofamiliaview');
    }
    
    public function novo() {
        
        $this->load->model('cadastrofamiliamodel');

        $retorno = $this->cadastrofamiliamodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idFamilia          = $this->input->POST('idFamilia');
        $denominacaoFamilia = $this->input->POST('denominacaoFamilia');
        $unidadeMedida      = $this->input->POST('unidadeMedida');
        
                        
        $this->load->model('cadastrofamiliamodel');

        $retorno = $this->cadastrofamiliamodel->salvar($idFamilia, $denominacaoFamilia, $unidadeMedida);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idFamilia = $this->input->POST('idFamilia');
        
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->excluir($idFamilia);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idFamilia = $this->input->POST('idFamilia');
        
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->buscaRegistroAnterior($idFamilia);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idFamilia = $this->input->POST('idFamilia');
        
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->buscaRegistroProximo($idFamilia);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        $this->load->model('cadastrofamiliamodel');

        $retorno = $this->cadastrofamiliamodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
        
    }
    
    public function selecionaGrid(){
        
        $idFamilia = $this->input->POST('idFamilia');
                     
        $this->load->model('cadastrofamiliamodel');
        
        $retorno = $this->cadastrofamiliamodel->selecionaGrid($idFamilia);
        
        echo ($retorno);
                
    }
    
    public function carregarUnidadeMedida() {

        $this->load->model('cadastrofamiliamodel');

        $retorno = $this->cadastrofamiliamodel->carregarUnidadeMedida();

        echo json_encode($retorno);
    }
    
   

    

}
