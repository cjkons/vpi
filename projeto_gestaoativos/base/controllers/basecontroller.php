<?php

class basecontroller extends CI_Controller {

    public function __construct() { 

        parent::__construct();
 
        $this->load->library('access');
        
    }

    public function index() {

        $this->load->model('basemodel');

        $nomeUsuarioLogado = $this->basemodel->getUsuarioLogado()->NOME_COMPLETO;

        $this->load->view('baseview', array('nomeUsuarioLogado' => $nomeUsuarioLogado));
    }

    public function isProgramaFavorito() {

        $idConteudo = $this->input->POST('idConteudo');

        $this->load->model('basemodel');

        $retorno = $this->basemodel->isProgramaFavorito($idConteudo);

        echo json_encode($retorno);
    }

    public function alterarFavoritacaoPrograma() {

        $nomeAba = $this->input->POST('nomeAba');
        $nomePrograma = $this->input->POST('nomePrograma');
        $idConteudo = $this->input->POST('idConteudo');
        $controllerChamado = $this->input->POST('controllerChamado');
        $enderecoIcone = $this->input->POST('enderecoIcone');

        $this->load->model('basemodel');

        $retorno = $this->basemodel->alterarFavoritacaoPrograma($nomeAba, $nomePrograma, $idConteudo, $controllerChamado, $enderecoIcone);

        echo json_encode($retorno);
    }

    public function bloquearTela() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->bloquearTela();

        echo json_encode($retorno);
    }

    public function desbloquearTela() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->desbloquearTela();

        echo json_encode($retorno);
    }

    public function isSecaoBloqueada() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->isSecaoBloqueada();

        echo json_encode($retorno);
    }

    //

    public function getCodExecucao() {

        $this->load->model('execucaomodel');

        $codPrograma = $this->input->POST('codPrograma');
        $observacao = $this->input->POST('observacao');

        $retorno = $this->execucaomodel->getCodExecucao($codPrograma, $observacao);

        echo json_encode($retorno);
    }

    public function getIdUsuarioLogado() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->getIdUsuarioLogado();

        echo json_encode($retorno);
    }
    
    
    public function getIconesSalvos() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->getIconesSalvos();

        echo json_encode($retorno);
    }
    
   
    
     public function atualizaLocal() {

        $nomeAba = $this->input->POST('nomeAba');
        $x = $this->input->POST('x');
        $y = $this->input->POST('y');

        $this->load->model('basemodel');

        $retorno = $this->basemodel->atualizaLocal($nomeAba, $x, $y);

        echo json_encode($retorno);
    }
    
    

    public function getListaUsuariosChat() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->getListaUsuariosChat();

        echo json_encode($retorno);
    }

    public function getListaUsuariosChat_Opcoes() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->getListaUsuariosChat_Opcoes();

        echo json_encode($retorno);
    }

    public function chat_alterarStatus() {

        $this->load->model('basemodel');

        $novoStatus = $this->input->POST('novoStatus');

        $retorno = $this->basemodel->chat_alterarStatus($novoStatus);

        echo json_encode($retorno);
    }

    public function sair() {

        $this->load->model('basemodel');

        $this->basemodel->sair();

        echo true;
    }

    public function iniciarChat() {

        $this->load->model('basemodel');

        $retorno = $this->basemodel->iniciarChat();

        echo json_encode($retorno);
    }
    
    public function removerFavorito() {

        $nomeAba = $this->input->POST('nomeAba');

        $this->load->model('basemodel');
        
        echo json_encode($this->basemodel->removerFavorito($nomeAba));
    }

}
