<?php

class LoginModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    private $conBanco;

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("engsys", TRUE);
        }
    }

    public function logar($login, $senha) {

        $podeLogar = false;

        $this->initConBanco();

        $query = "SELECT ID, NOME, SOBRENOME, LOGIN, SENHA, EMAIL FROM GP_CADASTRO_USUARIO WHERE LOGIN = '$login' AND IES_ATIVO = 'S'  ";

        $cs = $this->conBanco->query($query);
		
	//print_r($query);exit();
		
                
        $rs = $cs->result();
		
		
		//print_r($rs[0]->SENHA);exit();
		
		
        if (is_array($rs) && count($rs) > 0) {
            if ($senha != trim($rs[0]->SENHA)) {
				
                return false;
            }
        } else {
            return false;
        }
		
	  

        $usuario = new stdClass();

        $usuario->ID = $rs[0]->ID;
        $usuario->LOGIN = $rs[0]->LOGIN;
        $usuario->NOME = $rs[0]->NOME;
        $usuario->SOBRENOME = $rs[0]->SOBRENOME;
        $usuario->NOME_COMPLETO = $rs[0]->NOME . ' ' . $rs[0]->SOBRENOME;
        $usuario->EMAIL = $rs[0]->EMAIL;

		
		//  print_r($usuario);exit();
		
		
        //Busca permissoes usuario

		
        $idUsuario = $rs[0]->ID;
        $query = "SELECT * FROM GP_USUARIO_PROGRAMA WHERE ID_USUARIO = $idUsuario AND IES_ULTIMA_VERSAO = 'S' AND IS_PERMITIDO = 'S'";
		
		
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $aPermissoes = array();

        if (is_array($rs) && count($rs) > 0) {

            foreach ($rs as $permissao) {

                $aPermissoes[] = $permissao->COD_MODULO . '.' . $permissao->COD_PROGRAMA;
            }
        }

        $usuario->funcoes = $aPermissoes;

        //SETAR USUARIO NA SESSAO      
        $this->session->set_userdata(array("usuario" => $usuario)); 

        $podeLogar = true;
		
		
		//print_r($podeLogar);exit();

        return $podeLogar;
        
    }

    public function isLogado() {
        $usuario = $this->session->userdata('usuario');

        if (!empty($usuario)) {
            return true;
        } else {
            return false;
        }
    }

    public function logoff() {

        $this->session->sess_destroy();

        return true;
    }

    private function getUsuarioLogado() {
        $this->load->library("access");

        return $this->access->getUsuarioLogado();
    }

}
