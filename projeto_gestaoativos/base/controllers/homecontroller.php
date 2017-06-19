<?php

class homecontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
        $this->access->permissionCheck('SSB.14');
    }

    public function index() {

        $this->load->model('basemodel');

        $nomeUsuarioLogado = $this->basemodel->getUsuarioLogado()->NOME_COMPLETO;

        $this->load->view('homeview');
    }

    public function getRanking() {

        $tipo = $this->input->POST('tipo');
        $mesDe = $this->input->POST('dataDe');
        $mesAte = $this->input->POST('dataAte');

        $this->load->model('homemodel');

        $retorno = $this->homemodel->getRanking($tipo, $mesDe, $mesAte);

        echo json_encode($retorno);
    }

}
