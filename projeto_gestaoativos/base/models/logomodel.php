<?php

class logomodel extends CI_Model {

    private $conBanco;

    public function __construct() {
        parent::__construct();
    }

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("gbxcrm", TRUE);
        }
    }

    public function getUsuarioLogado() {
        $this->load->library("access");

        return $this->access->getUsuarioLogado();
    }

    //

    public function getIdUsuarioLogado() {
        return $this->getUsuarioLogado()->ID;
    }

    public function getIconesSalvos() {

        $this->initConBanco();

        $query = "SELECT * FROM GA_DESKTOP WHERE ID_USUARIO = " . $this->getUsuarioLogado()->ID;
        $cs = $this->conBanco->query($query);
        return $cs->result();
    }

    public function atualizaLocal($nomeAba, $x, $y) {

        $this->initConBanco();

        $query = "UPDATE GA_DESKTOP SET X = $x, Y = $y WHERE NOME_ABA = '$nomeAba' AND ID_USUARIO = " . $this->getUsuarioLogado()->ID;
        return $this->conBanco->query($query);
    }

    public function removerFavorito($nomeAba) {

        $this->initConBanco();

        $query = "DELETE FROM GA_DESKTOP WHERE NOME_ABA = '$nomeAba' AND ID_USUARIO = " . $this->getUsuarioLogado()->ID;
        return $this->conBanco->query($query);
    }

}
