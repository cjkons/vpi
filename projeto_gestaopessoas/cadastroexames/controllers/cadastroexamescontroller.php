<?php

class cadastroexamescontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();
 
        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroexamesview');
    }
    
    public function novo() {
        
        $this->load->model('cadastroexamesmodel');

        $retorno = $this->cadastroexamesmodel->novo();

        echo json_encode($retorno);
    }
    
    public function salvar() {
                      
        $id             = $this->input->POST('id');        
        $exames         = $this->input->POST('exames');
        $descricao      = $this->input->POST('descricao');
        
        
                        
                                        
        $this->load->model('cadastroexamesmodel');

        $retorno = $this->cadastroexamesmodel->salvar($id, $exames, $descricao);

        echo json_encode($retorno);
    }
    
    public function getAdicionarExames() {
        
        $id             = $this->input->POST('id');
       
        
        $this->load->model('cadastroexamesmodel');

        $retorno = $this->cadastroexamesmodel->getAdicionarExames($id);

        echo json_encode($retorno);
    }
    
    
    public function editarExames() {
        
        $id             = $this->input->POST('id');
        
        
        $this->load->model('cadastroexamesmodel');

        $retorno = $this->cadastroexamesmodel->editarExames($id);

        echo ($retorno);
    }
    
    
    public function excluir(){
        
        $id = $this->input->POST('id');
        
        $this->load->model('cadastroexamesmodel');
        
        $retorno = $this->cadastroexamesmodel->excluir($id);
            
    }
    
    public function pesquisaSimples(){
        
        $examesPesquisarInicio = $this->input->POST('examesPesquisarInicio');
        $examesPesquisarFim = $this->input->POST('$examesPesquisarFim');
        
             
        $this->load->model('cadastroexamesmodel');
        
        $retorno = $this->cadastroexamesmodel->pesquisaSimples($examesPesquisarInicio, $examesPesquisarFim);
        
        echo ($retorno);
                
    }
    
}    
    
    