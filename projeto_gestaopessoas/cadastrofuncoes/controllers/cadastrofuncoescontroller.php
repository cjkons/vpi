<?php

class cadastrofuncoescontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();
 
        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrofuncoesview');
    }
    
    
    
    public function novo() {
        
        $this->load->model('cadastrofuncoesmodel');

        $retorno = $this->cadastrofuncoesmodel->novo();

        echo json_encode($retorno);
    }
    
    public function salvar() {
                      
        $id             = $this->input->POST('id');        
        $funcao         = $this->input->POST('funcao');
        $descricao      = $this->input->POST('descricao');
        $cbo            = $this->input->POST('cbo');
        $periodoExame   = $this->input->POST('periodoExame');
        $descricaoPpra  = $this->input->POST('descricaoPpra');      
        
                        
                                        
        $this->load->model('cadastrofuncoesmodel');

        $retorno = $this->cadastrofuncoesmodel->salvar($id, $funcao, $descricao, $cbo, $periodoExame, $descricaoPpra);

        echo json_encode($retorno);
    }
    
    public function getAdicionarFuncao() {
        
        $id             = $this->input->POST('id');
        $cbo            = $this->input->POST('cbo');
        
        $this->load->model('cadastrofuncoesmodel');

        $retorno = $this->cadastrofuncoesmodel->getAdicionarFuncao($id, $cbo);

        echo json_encode($retorno);
    }
    
    
    public function editarFuncao() {
        
        $id             = $this->input->POST('id');
        $cbo            = $this->input->POST('cbo');
        
        $this->load->model('cadastrofuncoesmodel');

        $retorno = $this->cadastrofuncoesmodel->editarFuncao($id, $cbo);

        echo ($retorno);
    }
    
    
    public function excluir(){
        
        $id = $this->input->POST('id');
        
        $this->load->model('cadastrofuncoesmodel');
        
        $retorno = $this->cadastrofuncoesmodel->excluir($id);
            
    }
    
    public function pesquisaSimples(){
        
        $cboPesquisarInicio = $this->input->POST('cboPesquisarInicio');
        
             
        $this->load->model('cadastrofuncoesmodel');
        
        $retorno = $this->cadastrofuncoesmodel->pesquisaSimples($cboPesquisarInicio);
        
        echo ($retorno);
                
    }
    
}    
    
    