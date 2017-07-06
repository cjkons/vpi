<?php

class logocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {

        $this->load->view('logoview');
    }

    public function getIconesSalvos() {

        $this->load->model('logomodel');

        echo json_encode($this->logomodel->getIconesSalvos());
    }

    public function atualizaLocal() {

        $nomeAba = $this->input->POST('nomeAba');
        $x = $this->input->POST('x');
        $y = $this->input->POST('y');

        $this->load->model('logomodel');
        echo json_encode($this->logomodel->atualizaLocal($nomeAba, $x, $y));
    }

    public function removerFavorito() {

        $nomeAba = $this->input->POST('nomeAba');

        $this->load->model('logomodel');
        echo json_encode($this->logomodel->removerFavorito($nomeAba));
    }

}
