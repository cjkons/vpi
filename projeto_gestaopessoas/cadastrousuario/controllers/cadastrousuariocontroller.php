<?php

class cadastrousuariocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrousuarioview');
    }
    
    public function novo() {
        
        $this->load->model('cadastrousuariomodel');

        $retorno = $this->cadastrousuariomodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idUsuario          = $this->input->POST('idUsuario');
        $nomeUsuario        = $this->input->POST('nomeUsuario');
        $sobrenomeUsuario   = $this->input->POST('sobrenomeUsuario');
        $emailUsuario       = $this->input->POST('emailUsuario');
        $empresaUsuario     = $this->input->POST('empresaUsuario');
        $ativoUsuario       = $this->input->POST('ativoUsuario');
        $loginUsuario       = $this->input->POST('loginUsuario');
        $senha              = $this->input->POST('senhaUsuario');      
        
        
        $this->load->model('cadastrousuariomodel');

        $retorno = $this->cadastrousuariomodel->salvar($idUsuario, $nomeUsuario, $sobrenomeUsuario, $emailUsuario, $empresaUsuario, $ativoUsuario, $loginUsuario, $senha);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idUsuario = $this->input->POST('idUsuario');
        
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->excluir($idUsuario);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idUsuario = $this->input->POST('idUsuario');
        
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->buscaRegistroAnterior($idUsuario);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idUsuario = $this->input->POST('idUsuario');
        
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->buscaRegistroProximo($idUsuario);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        $this->load->model('cadastrousuariomodel');

        $retorno = $this->cadastrousuariomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
        
             
        
        
    }
    
    public function selecionaGrid(){
        
        $idUsuario = $this->input->POST('idUsuario');
                     
        $this->load->model('cadastrousuariomodel');
        
        $retorno = $this->cadastrousuariomodel->selecionaGrid($idUsuario);
        
        echo ($retorno);
                
    }
        
    public function enviaEmailFinalizar() {
                
        $idFluxo          = $this->input->POST('idFluxo');
                        
        $this->load->model('cadastrousuariomodel');

        $retorno = $this->cadastrousuariomodel->enviaEmailFinalizar($idFluxo);

        echo json_encode($retorno);
    }
    
    public function carregarEmpresa() {

        $this->load->model('cadastrousuariomodel');

        $retorno = $this->cadastrousuariomodel->carregarEmpresa();

        echo json_encode($retorno);
    }
      
    
    
   

    

}
