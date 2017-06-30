<?php

class cadastrogrupoempresacontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrogrupoempresaview');
    }
    
    public function novo() {
        
        $this->load->model('cadastrogrupoempresamodel');

        $retorno = $this->cadastrogrupoempresamodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idGrupoEmpresa          = $this->input->POST('idGrupoEmpresa');
        $denominacaoGrupoEmpresa = $this->input->POST('denominacaoGrupoEmpresa');
       
                        
        $this->load->model('cadastrogrupoempresamodel');

        $retorno = $this->cadastrogrupoempresamodel->salvar($idGrupoEmpresa, $denominacaoGrupoEmpresa);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idGrupoEmpresa = $this->input->POST('idGrupoEmpresa');
        
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->excluir($idGrupoEmpresa);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idGrupoEmpresa = $this->input->POST('idGrupoEmpresa');
        
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->buscaRegistroAnterior($idGrupoEmpresa);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idGrupoEmpresa = $this->input->POST('idGrupoEmpresa');
        
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->buscaRegistroProximo($idGrupoEmpresa);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->pesquisaSimples($idInicial, $nomeInicial);
        
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
       
       
        $this->load->model('cadastrogrupoempresamodel');

        $retorno = $this->cadastrogrupoempresamodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
        
        
        
        
    }
    
    public function selecionaGrid(){
        
        $idGrupoEmpresa = $this->input->POST('idGrupoEmpresa');
                     
        $this->load->model('cadastrogrupoempresamodel');
        
        $retorno = $this->cadastrogrupoempresamodel->selecionaGrid($idGrupoEmpresa);
        
        echo ($retorno);
                
    }
    
    
   

    

}
