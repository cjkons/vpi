<?php

class cadastroepicontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroepiview');
    }
    
     public function carregarTipoEpi() {

        $this->load->model('cadastroepimodel');

        $retorno = $this->cadastroepimodel->carregarTipoEpi();

        echo json_encode($retorno);
    }
    
    public function verificarCaDigitado(){
        
        $numeroCa = $this->input->POST('numeroCa');
        
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->verificarCaDigitado($numeroCa);
        
        echo json_encode($retorno);
            
    }
    
    public function novo() {
        
        $this->load->model('cadastroepimodel');

        $retorno = $this->cadastroepimodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idEpi              = $this->input->POST('idEpi');
        $numeroCa           = $this->input->POST('numeroCa');
        $tipoEpi            = $this->input->POST('tipoEpi');
        $descricaoEpi       = $this->input->POST('descricaoEpi');
        $validadeCa         = $this->input->POST('validadeCa');
        $fabricante         = $this->input->POST('fabricante');
        
        $this->load->model('cadastroepimodel');

        $retorno = $this->cadastroepimodel->salvar($idEpi, $numeroCa, $tipoEpi, $descricaoEpi, $validadeCa, $fabricante);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idEpi   = $this->input->POST('idEpi');
        
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->excluir($idEpi);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idEpi   = $this->input->POST('idEpi');
        
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->buscaRegistroAnterior($idEpi);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idEpi   = $this->input->POST('idEpi');
        
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->buscaRegistroProximo($idEpi);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        $this->load->model('cadastroepimodel');

        $retorno = $this->cadastroepimodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
        
             
        
        
    }
    
    public function selecionaGrid(){
        
        $idEpi = $this->input->POST('idEpi');
                     
        $this->load->model('cadastroepimodel');
        
        $retorno = $this->cadastroepimodel->selecionaGrid($idEpi);
        
        echo ($retorno);
                
    }
        
    
      
    
    
   

    

}
