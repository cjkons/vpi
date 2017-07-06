<?php

class cadastrosetorcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();
 
        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrosetorview');
    }
    
    public function novo() {
        
        $this->load->model('cadastrosetormodel');

        $retorno = $this->cadastrosetormodel->novo();

        echo json_encode($retorno);
    }
    
    public function salvar() {
                      
        $id             = $this->input->POST('id');        
        $setor        = $this->input->POST('setor');
        
                       
                                        
        $this->load->model('cadastrosetormodel');

        $retorno = $this->cadastrosetormodel->salvar($id, $setor);

        echo json_encode($retorno);
    }
    
    public function getAdicionarSetor() {
        
        $id             = $this->input->POST('id');
        
        
        $this->load->model('cadastrosetormodel');

        $retorno = $this->cadastrosetormodel->getAdicionarSetor($id);

        echo json_encode($retorno);
    }
    
    
    public function editarSetor() {
        
        $id             = $this->input->POST('id');
       
        
        $this->load->model('cadastrosetormodel');

        $retorno = $this->cadastrosetormodel->editarSetor($id);

        echo ($retorno);
    }
    
    
    public function excluir(){
        
        $id = $this->input->POST('id');
        
        $this->load->model('cadastrosetormodel');
        
        $retorno = $this->cadastrosetormodel->excluir($id);
            
    }
    
    public function pesquisaSimples(){
        
        $setorPesquisarInicio = $this->input->POST('setorPesquisarInicio');
        
             
        $this->load->model('cadastrosetormodel');
        
        $retorno = $this->cadastrosetormodel->pesquisaSimples($setorPesquisarInicio);
        
        echo ($retorno);
                
    }
    
}    
    
    