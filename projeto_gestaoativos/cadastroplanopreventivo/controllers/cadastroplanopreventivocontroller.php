<?php

class cadastroplanopreventivocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();
 
        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroplanopreventivoview');
    }
    
    public function novo() {
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->novo();

        echo json_encode($retorno);
    }
    
    public function salvar() {
                      
        $id               = $this->input->POST('id');        
        $equipamento      = $this->input->POST('equipamento');
        $descricao        = $this->input->POST('descricao');
        $ativoChecklist   = $this->input->POST('ativoChecklist');
        $ativoAtividade   = $this->input->POST('ativoAtividade');
        
                        
                                        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->salvar($id, $equipamento, $descricao, $ativoChecklist, $ativoAtividade);

        echo json_encode($retorno);
    }
    
    
     public function salvarAtividades() {
        
        $id              = $this->input->POST('id');
        $idAtividade     = $this->input->POST('idAtividade');
        $intervencao     = $this->input->POST('intervencao');
        $descAtividade   = $this->input->POST('descAtividade');
        $frequencia      = $this->input->POST('frequencia');
        $executor        = $this->input->POST('executor');
        
        
                                        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->salvarAtividades($id, $idAtividade, $intervencao , $descAtividade, $frequencia, $executor);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $id = $this->input->POST('id');
        
        $this->load->model('cadastroplanopreventivomodel');
        
        $retorno = $this->cadastroplanopreventivomodel->excluir($id);
            
    }
    
       
    public function carregarEquipamento() {
         
       $this->load->model('cadastroplanopreventivomodel');

       $retorno = $this->cadastroplanopreventivomodel->carregarEquipamento();

        echo json_encode($retorno);
    }  
    
    public function carregarApelido() {
        
       $equipamento  = $this->input->POST('equipamento');
         
       $this->load->model('cadastroplanopreventivomodel');

       $retorno = $this->cadastroplanopreventivomodel->carregarApelido($equipamento);

        echo json_encode($retorno);
    }  
    
    
    //////////////////novos ajustes
    
    public function validarAddAtividade() {
        
        $id             = $this->input->POST('id');
        $equipamento    = $this->input->POST('equipamento');
        $descricao      = $this->input->POST('descricao');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->validarAddAtividade($id, $equipamento, $descricao);

        echo json_encode($retorno);
    }
    
    
    public function addAtividade() {
        
        $id             = $this->input->POST('id');
        $equipamento    = $this->input->POST('equipamento');
        $descricao      = $this->input->POST('descricao');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->addAtividade($id, $equipamento, $descricao);

        echo json_encode($retorno);
    }
    
    public function salvarAdicionarAtividade() {
        
        $id                 = $this->input->POST('idAdicionarModal');
        $idAtividade        = $this->input->POST('idAtividade');
        $intervencao        = $this->input->POST('intervencao');
        $descAtividade      = $this->input->POST('descAtividade');
        $frequencia         = $this->input->POST('frequencia');
        $executor           = $this->input->POST('executor');
        
        
                                        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->salvarAdicionarAtividade($id, $idAtividade, $intervencao , $descAtividade, $frequencia, $executor);

        echo json_encode($retorno);
    }
    
    
    public function getAdicionarAtividade() {
        
        $idAdicionarModal   = $this->input->POST('idAdicionarModal');
        $idAtividade        = $this->input->POST('idAtividade');

        $this->load->model('cadastroplanopreventivomodel');



        $retorno = $this->cadastroplanopreventivomodel->getAdicionarAtividade($idAdicionarModal, $idAtividade);

        echo json_encode($retorno);
    }
    
    
     public function editarAtividade() {
        
        $id                = $this->input->POST('id');
        $idAtividade       = $this->input->POST('idAtividade');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->editarAtividade($id, $idAtividade);

        echo ($retorno);
    }
    
    public function salvarAtividadeEditar() {
        
        $id                 = $this->input->POST('id');
        $idAtividade        = $this->input->POST('idAtividade');
        $intervencao        = $this->input->POST('intervencao');
        $descAtividade      = $this->input->POST('descAtividade');
        $frequencia         = $this->input->POST('frequencia');
        $executor           = $this->input->POST('executor');
                                       
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->salvarAtividadeEditar($id, $idAtividade, $intervencao , $descAtividade, $frequencia, $executor);

        echo json_encode($retorno);
    }
    
    public function excluirAtividadeEditar() {
        
        $id                 = $this->input->POST('id');
        $idAtividade        = $this->input->POST('idAtividade');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->excluirAtividadeEditar($id, $idAtividade);

        echo json_encode($retorno);
    }
    
    public function limparTabelaTmp() {
        
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->limparTabelaTmp();

        echo json_encode($retorno);
    }
    
    public function getNumeroLinhas() {

        $this->load->model('cadastroplanopreventivomodel');

        $id = $this->input->POST('id');


        $retorno = $this->cadastroplanopreventivomodel->getNumeroLinhas($id);

        echo json_encode($retorno);
    }
    
    public function consultar(){
        
        $equipamento = $this->input->POST('equipamento');
        
        $this->load->model('cadastroplanopreventivomodel');
        
        $retorno = $this->cadastroplanopreventivomodel->consultar($equipamento);
        
        echo ($retorno);
                
    }
    
    
    
    
    ///////////// ADICIONAR ITEM //////////////////////////
    
    
    
    public function addItem() {
        
        $id                = $this->input->POST('id');
        $idAtividade       = $this->input->POST('idAtividade');
        
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->addItem($id, $idAtividade);

        echo json_encode($retorno);
        //echo ($retorno);
    }
    
    public function carregarItem() {

        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->carregarItem();

        echo json_encode($retorno);  
    }
    
    
    public function carregarUnidadeMedida() {

        $item      = $this->input->POST('item');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->carregarUnidadeMedida($item);

        echo json_encode($retorno);  
    }
    
    public function validarSalvarItem() {
        
        $idAtividade     = $this->input->POST('idAtividade');
        $idItemModal     = $this->input->POST('idItemModal');
        $item            = $this->input->POST('item');
        
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->validarSalvarItem($idAtividade, $idItemModal, $item);

        echo json_encode($retorno);
        //echo ($retorno);
    }
    
    public function salvarItem() {
        
        $id              = $this->input->POST('id');
        $idAtividade     = $this->input->POST('idAtividade');
        $idItemModal     = $this->input->POST('idItemModal');
        $item            = $this->input->POST('item');
        $unidadeMedida   = $this->input->POST('unidadeMedida');
        $quantidade      = $this->input->POST('quantidade');
        $observacao      = $this->input->POST('observacao');
        
        
                                        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->salvarItem($id, $idAtividade, $idItemModal , $item, $unidadeMedida, $quantidade, $observacao);

        echo json_encode($retorno);
    }
    
    public function getAdicionarItem() {
        
        $id                 = $this->input->POST('id');
        $idAtividade        = $this->input->POST('idAtividade');
        $idItemModal        = $this->input->POST('idItemModal');
        
        $this->load->model('cadastroplanopreventivomodel');



        $retorno = $this->cadastroplanopreventivomodel->getAdicionarItem($id, $idAtividade, $idItemModal);

        echo json_encode($retorno);
    }
    
    public function novoItem() {
        
        $id                 = $this->input->POST('id');
        $idAtividade        = $this->input->POST('idAtividade');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->novoItem($id, $idAtividade);

        echo json_encode($retorno);
    }
    
    
    
    public function editarItem() {
        
        $id                = $this->input->POST('id');
        $idAtividade       = $this->input->POST('idAtividade');
        $idItemModal       = $this->input->POST('idItemModal');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->editarItem($id, $idAtividade,  $idItemModal);

        echo ($retorno);
    }
    
    public function excluirItem() {
        
        $id                 = $this->input->POST('id');
        $idAtividade        = $this->input->POST('idAtividade');
        $idItemModal       = $this->input->POST('idItemModal');
        
        $this->load->model('cadastroplanopreventivomodel');

        $retorno = $this->cadastroplanopreventivomodel->excluirItem($id, $idAtividade, $idItemModal);

        echo json_encode($retorno);
    }
    
    
}