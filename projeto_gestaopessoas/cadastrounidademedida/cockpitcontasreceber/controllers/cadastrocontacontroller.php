<?php

class cadastrocontacontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrocontaview');
    }
    
   
     
    public function salvar() {
          
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        $idBanco        = $this->input->POST('idBanco');
        $agencia        = $this->input->POST('agencia');
        $conta          = $this->input->POST('conta');
        $observacao     = $this->input->POST('observacao');
     
                                   
        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->salvar($idEmpresa, $idFilial, $idBanco, $agencia, $conta, $observacao);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $agencia        = $this->input->POST('agencia');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        $idBanco        = $this->input->POST('idBanco');
        $conta          = $this->input->POST('conta');
        
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->excluir($agencia, $idEmpresa, $idFilial, $idBanco, $conta);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
      
        $idEmpresa  = $this->input->POST('idEmpresa');
        $idFilial   = $this->input->POST('idFilial');
        $idBanco    = $this->input->POST('idBanco');
        $agencia    = $this->input->POST('agencia');
        $conta      = $this->input->POST('conta');
        
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->buscaRegistroAnterior($idEmpresa, $idFilial, $idBanco, $agencia, $conta);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idEmpresa  = $this->input->POST('idEmpresa');
        $idFilial   = $this->input->POST('idFilial');
        $idBanco    = $this->input->POST('idBanco');
        $agencia    = $this->input->POST('agencia');
        $conta      = $this->input->POST('conta');
        
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->buscaRegistroProximo($idEmpresa, $idFilial, $idBanco, $agencia, $conta);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->pesquisaSimples($idInicial, $nomeInicial);
        
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
       
       
        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idBanco = $this->input->POST('idBanco');
                     
        $this->load->model('cadastrocontamodel');
        
        $retorno = $this->cadastrocontamodel->selecionaGrid($idBanco);
        
        echo ($retorno);
                
    }
    
    public function carregarGrupoEmpresa() {

        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->carregarGrupoEmpresa();

        echo json_encode($retorno);
    }
    
    public function carregarEmpresa() {

        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    public function carregarBanco() {
        
        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial  = $this->input->POST('idFilial');

        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->carregarBanco($idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
    
    public function carregarAgencia() {
        
        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial  = $this->input->POST('idFilial');
        $idBanco  = $this->input->POST('idBanco');


        $this->load->model('cadastrocontamodel');

        $retorno = $this->cadastrocontamodel->carregarAgencia($idEmpresa, $idFilial, $idBanco);

        echo json_encode($retorno);
    }

    
    

    

}
