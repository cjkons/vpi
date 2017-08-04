<?php

class cadastroferiascontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroferiasview');
    }
    
   
    public function novo() {
        
        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->novo();

        echo json_encode($retorno);
    }
    
    public function salvar() {
         
        $ID                    = $this->input->POST('ID');
        $idFilial              = $this->input->POST('idFilial');
        $idEmpresa             = $this->input->POST('idEmpresa');
        $funcionario           = $this->input->POST('funcionario');
        $dataAdmissao          = $this->input->POST('dataAdmissao');
        $matricula             = $this->input->POST('matricula');
        $setor                 = $this->input->POST('setor');
        $funcao                = $this->input->POST('funcao');
        $dataInicioFerias      = $this->input->POST('dataInicioFerias');
        $diasFerias            = $this->input->POST('diasFerias');
        $dataFimFerias         = $this->input->POST('dataFimFerias');
        $comprouDias           = $this->input->POST('comprouDias');
        $diasComprados         = $this->input->POST('diasComprados');
        $diasHaver             = $this->input->POST('diasHaver');
        
        $this->load->model('cadastroferiasmodel');     
        $retorno = $this->cadastroferiasmodel->salvar($ID,$idEmpresa,$idFilial,$funcionario,
             $dataAdmissao,$matricula,$setor,$funcao,$dataInicioFerias,$diasFerias,
             $dataFimFerias,$comprouDias,$diasComprados,$diasHaver);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $ID = $this->input->POST('ID');
        
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->excluir($ID);
            
    }
    
    
    public function pesquisaSimples(){
        
        $matricula =  $this->input->POST('matricula');
        $funcionario = $this->input->POST('funcionario');
        $funcionarioAno = $this->input->POST('funcionarioAno');
        $matriculaAno = $this->input->POST('matriculaAno');
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->pesquisaSimples($matricula, $funcionario, $funcionarioAno,$matriculaAno);
        echo ($retorno);
                
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    
    public function buscaRegistroAnterior(){
        
        $ID = $this->input->POST('ID');
        
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->buscaRegistroAnterior($ID);
        
        echo ($retorno);
                
    }
    
    
    public function buscaRegistroProximo(){
        
        $ID = $this->input->POST('ID');
        
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->buscaRegistroProximo($ID);
        
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
        //$parametro2 = $this->input->GET('parametro1');    
        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
            
    }
    
    
    public function selecionaGrid(){
        
        $ID = $this->input->POST('ID');
                     
        $this->load->model('cadastroferiasmodel');
        
        $retorno = $this->cadastroferiasmodel->selecionaGrid($ID);
        
        echo ($retorno);
                
    }
    
    public function carregarGrupoEmpresa() {
        /*
        $this->load->model('cadastrogrupoequipamentomodel');

        $retorno = $this->cadastrogrupoequipamentomodel->carregarGrupoEmpresa();
        */
        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->carregarGrupoEmpresa();
        echo json_encode($retorno);
    }
    
    public function carregarEmpresa() {

        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    public function carregarFuncionario() {

        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial = $this->input->POST('idFilial');
        
        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->carregarFuncionario($idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
    
    
    
    public function carregarDadosFuncionario() {

        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial = $this->input->POST('idFilial');
        $funcionario = $this->input->POST('funcionario');
        
        $this->load->model('cadastroferiasmodel');

        $retorno = $this->cadastroferiasmodel->carregarDadosFuncionario($idEmpresa, $idFilial, $funcionario);

        echo ($retorno);
    }
    
    

    

}
