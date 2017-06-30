<?php

class cadastrogrupoequipamentocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrogrupoequipamentoview');
    }
    
   
     
    public function salvar() {
                
        $codGrupo       = $this->input->POST('codGrupo');
        $descricaoGrupo = $this->input->POST('descricaoGrupo');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
           
                        
        $this->load->model('cadastrogrupoequipamentomodel');

        $retorno = $this->cadastrogrupoequipamentomodel->salvar($codGrupo, $descricaoGrupo, $idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $codGrupo = $this->input->POST('codGrupo');
        
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->excluir($codGrupo);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $codGrupo = $this->input->POST('codGrupo');
        
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->buscaRegistroAnterior($codGrupo);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $codGrupo = $this->input->POST('codGrupo');
        
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->buscaRegistroProximo($codGrupo);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->pesquisaSimples($idInicial, $nomeInicial);
        
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
       
       
        $this->load->model('cadastrogrupoequipamentomodel');

        $retorno = $this->cadastrogrupoequipamentomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idGrupo = $this->input->POST('idGrupo');
                     
        $this->load->model('cadastrogrupoequipamentomodel');
        
        $retorno = $this->cadastrogrupoequipamentomodel->selecionaGrid($idGrupo);
        
        echo ($retorno);
                
    }
    
    public function carregarGrupoEmpresa() {

        $this->load->model('cadastrogrupoequipamentomodel');

        $retorno = $this->cadastrogrupoequipamentomodel->carregarGrupoEmpresa();

        echo json_encode($retorno);
    }
    
    public function carregarEmpresa() {

        $this->load->model('cadastrogrupoequipamentomodel');

        $retorno = $this->cadastrogrupoequipamentomodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('cadastrogrupoequipamentomodel');

        $retorno = $this->cadastrogrupoequipamentomodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    

    

}
