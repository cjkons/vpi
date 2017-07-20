<?php

class cadastroatestadocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();
 
        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroatestadoview');
    }
    
    
    
    public function carregarFuncionario() {

        
        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->carregarFuncionario();

        echo json_encode($retorno);
    }
    
     public function carregarDadosFuncionario() {

        $funcionario = $this->input->POST('funcionario');
        
        
        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->carregarDadosFuncionario($funcionario);

        echo ($retorno);
    }
    
    public function novo() {
        
        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->novo();

        echo json_encode($retorno);
    }
    
    public function salvar() {
                      
        $id             = $this->input->POST('id');        
        $funcionario    = $this->input->POST('funcionario');
        $empresa        = $this->input->POST('empresa');
        $filial         = $this->input->POST('filial');
        $dataAtestado   = $this->input->POST('dataAtestado');
        $diasAtestado   = $this->input->POST('diasAtestado');
        $dataRetorno    = $this->input->POST('dataRetorno');
        $cid            = $this->input->POST('cid');
        $observacao     = $this->input->POST('observacao');
              
        
                        
                                        
        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->salvar($id, $funcionario, $empresa, $filial, $dataAtestado, $diasAtestado, $dataRetorno, $cid, $observacao);

        echo json_encode($retorno);
    }
    
    public function getAdicionarAtestado() {
        
        $id             = $this->input->POST('id');
        $funcionario    = $this->input->POST('funcionario');
        $dataAtestado   = $this->input->POST('dataAtestado');
        $cid            = $this->input->POST('cid');
        
        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->getAdicionarAtestado($id, $funcionario, $dataAtestado, $cid);

        echo json_encode($retorno);
    }
    
    
    public function editarAtestado() {
        
        $id             = $this->input->POST('id');
        
        
        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->editarAtestado($id);

        echo ($retorno);
    }
    
    
    public function excluir(){
        
        $id = $this->input->POST('id');
        
        $this->load->model('cadastroatestadomodel');
        
        $retorno = $this->cadastroatestadomodel->excluir($id);
            
    }
    
    public function pesquisaSimples(){
        
        $cboPesquisarInicio = $this->input->POST('cboPesquisarInicio');
        
             
        $this->load->model('cadastroatestadomodel');
        
        $retorno = $this->cadastroatestadomodel->pesquisaSimples($cboPesquisarInicio);
        
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

        $this->load->model('cadastroatestadomodel');

        $retorno = $this->cadastroatestadomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
            
        
     
    }
    
    public function selecionaGrid(){
        
        $id = $this->input->POST('id');
                     
        $this->load->model('cadastroatestadomodel');
        
        $retorno = $this->cadastroatestadomodel->selecionaGrid($id);
        
        echo ($retorno);
                
    }
    
}    
    
    