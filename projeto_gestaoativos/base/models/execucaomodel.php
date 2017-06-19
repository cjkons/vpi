<?php

class execucaomodel extends CI_Model {

    private $conBanco;
    private $conLog;

    public function __construct() {
        parent::__construct();
    }

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("dbsistema", TRUE);
        }
    }

    private function initConLog() {
        if ($this->conLog == null) {
            $this->conLog = $this->load->database("dblog", TRUE);
        }
    }

    private function getUsuarioLogado() {
        $this->load->library("access");

        return $this->access->getUsuarioLogado();
    }

    //

    public function getCodExecucao($programa, $observacao) {

        $this->initConLog();

        $query = "SELECT COUNT(*) AS TOTAL FROM EXECUCAO";

        $cs = $this->conLog->query($query);
        $rs = $cs->result();

        $novoId = $rs[0]->TOTAL + 1;

        //

        $codModulo = $programa[0];
        $versaoModulo = $programa[1];
        $codPrograma = $programa[2];
        $versaoPrograma = $programa[3];
        $releasePrograma = $programa[4];

        $hora = date('H:i:s');
        $idUsuarioLogado = $this->getUsuarioLogado()->ID;

        $query = "INSERT INTO EXECUCAO 
                 (ID, 
                 COD_MODULO, 
                 VERSAO_MODULO, 
                 COD_PROGRAMA, 
                 VERSAO_PROGRAMA, 
                 RELEASE_PROGRAMA,
                 DATA,
                 HORA,
                 USUARIO,
                 OBSERVACAO)
                 
                 VALUES
                 
                 ($novoId,
                 '$codModulo',
                  $versaoModulo,
                  $codPrograma,
                  $versaoPrograma,
                  $releasePrograma,
                  SYSDATE,
                  '$hora',
                  $idUsuarioLogado,
                  '$observacao')";

        if ($this->conLog->query($query)) {
            return $novoId;
        } else {
            return false;
        }
    }

}
