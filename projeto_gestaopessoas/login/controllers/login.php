<?php

class Login extends CI_Controller {

    // FUNÇÃO PADRÃO
    public function index() {

        // URL DE RETORNO SERÁ USADA CASO A CHAMA DA APLICAÇÃO FAZ REFERENCIA A UMA ROTA
        // E NÃO EXISTE SEÇÃO PARA O USUÁRIO
        // ENTÃO O USUÁRIO PRIMEIRAMENTE DEVE SE LOGAR, CRIANDO ASSIM
        // A SUA SEÇÃO E EM SEGUIDA É REDIRECIONADO PARA O LINK QUE FOI CHAMADO PRIMEIRAMENTE
        $returnUrl = $this->input->get('returnUrl');
        $this->loadViewLogin(array('url' => base64_decode($returnUrl)));
    }

    public function logar() {
        $this->load->model('LoginModel');

        // CASO O USUÁRIO JÁ ESTEJA LOGADO
        if ($this->LoginModel->isLogado() && $this->input->POST('verificacaoBloqueio') != 'S') {
            echo true;
        } else {
            $login = $this->input->post('login');

            $senha = $this->input->post('senha');

            $this->load->model('LoginModel');

            $result = $this->LoginModel->logar($login, $senha);

            echo $result; 
        }
    }

    // VERIFICA SE O USUÁRIO JÁ ESTA LOGADO
    public function isLogado() {

        $this->load->model('LoginModel');

        return $this->LoginModel->isLogado();
    }

    // FAZ O LOGOFF DO USUÁRIO
    public function logoff() {

        $redirect = $this->input->get('redirect');

        $this->load->model('LoginModel');

        $this->LoginModel->logoff();

        $this->loadViewLogin(array('url' => 'index.php?m=' . (!empty($redirect) ? $redirect : "login")));
    }

    // CARREGA A VIEW DE QUE O USUARIO NÃO TEM PERMISSÃO DE ACESSO
    public function semPermissao() {
        $this->load->view('SemPermissaoAcesso');
    }

    // CARREGA A VIEW DE LOGIN
    private function loadViewLogin($data) {
        $header = "";

        $this->loadView('login', $header, $data);
    }

    private function loadView($viewName, $header, $data = null) {

        $this->load->view('topo', array('head' => $header));
        $this->load->view($viewName, $data);
        $this->load->view('rodape');
    }

    private function loadViewRaw($viewName, $header) {

        $this->load->view($viewName, $header);
    }

}
