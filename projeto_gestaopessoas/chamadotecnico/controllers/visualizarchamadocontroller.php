<?php

class visualizarchamadocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
        //$this->access->permissionCheck('CONFIG.3');
    }

    public function index() { 
        $this->load->view('visualizarchamadoview');
    }
 
    public function getUsuario() {
       
        $this->load->model('visualizarchamadomodel');

        $retorno = $this->visualizarchamadomodel->getUsuario();

        echo json_encode($retorno);
    }

    public function salvarChamado() {
        
        
        $nome       = $this->input->POST('nome');
        $email      = $this->input->POST('email');
        $telefone   = $this->input->POST('telefone');
        $ramal      = $this->input->POST('ramal');
        $setor      = $this->input->POST('setor');
        $modulo     = $this->input->POST('modulo');
        $prioridade = $this->input->POST('prioridade');
        $descricao  = $this->input->POST('descricao');
        $anexo       = $this->input->POST('anexo');

        $this->load->model('visualizarchamadomodel');

        $retorno = $this->visualizarchamadomodel->salvarChamado($nome, $email, $telefone, $ramal, $setor, $modulo, $prioridade, $descricao, $anexo);

        echo json_encode($retorno);
    }
    
    public function salvarInformacoesChamado() {
        
        $chamado     = $this->input->POST('chamado');
        $status = $this->input->POST('status');
        $descricao  = $this->input->POST('descricao');

        $this->load->model('visualizarchamadomodel');

        $retorno = $this->visualizarchamadomodel->salvarInformacoesChamado( $chamado, $status, $descricao);

        echo json_encode($retorno);
    }
    
    
    public function getGrid() {
            
        
          
        $pOrdem = $this->input->POST('order');
        $pColumn = $this->input->POST('columns');
        $indice = $pColumn[$pOrdem[0]['column']]['data'];

        $ordem = $pOrdem[0]['dir'];
        $inicio = $this->input->POST('start');
        $tamanho = $this->input->POST('length');
        $draw = $this->input->POST('draw');
       
       
        $this->load->model('visualizarchamadomodel');

        $retorno = $this->visualizarchamadomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    
    public function carregarChamados() {

        $this->load->model('visualizarchamadomodel');


        $retorno = $this->visualizarchamadomodel->carregarChamados();

        echo json_encode($retorno);
    }
    
    public function historicoChamado() {

        $this->load->model('visualizarchamadomodel');

        $chamado  = $this->input->POST('chamado');

        $retorno = $this->visualizarchamadomodel->historicoChamado($chamado);

        echo json_encode($retorno);
    }
    
    public function novasInformacoesChamado() {

        $this->load->model('visualizarchamadomodel');

        $chamado  = $this->input->POST('chamado');

        $retorno = $this->visualizarchamadomodel->novasInformacoesChamado($chamado);

        echo json_encode($retorno);
    }
    
    public function verificastatusChamado() {

        $this->load->model('visualizarchamadomodel');

        $chamado  = $this->input->POST('chamado');

        $retorno = $this->visualizarchamadomodel->verificastatusChamado($chamado);

        echo json_encode($retorno);
    }
    
    
    
    public function salvarAnexoAberturaOS() {
        //PRINT_R("ANEXO"); exit();
        $this->load->library('session');

        $usuario = $this->session->userdata('usuario');

        $arq = "";

        $ret = "";

        if (isset($_FILES['anexo'])) {
            $arq = $_FILES['anexo'];
        }

        if (!empty($arq)) {

            $pogDo = rand(5, 99999999);
            parse_str($pogDo);
            $data = date("Y-m-d-H-i-s");
            parse_str($data);


            $folder = UPLOADSSERVICEDESK_PATH . '/' . $usuario->ID . '/' . $data . '/';
            $folder2 = UPLOADSSERVICEDESK_PATH . '/' . $usuario->ID;

            $config = array();
            $config['upload_path'] = $folder;
            $config['allowed_types'] = 'gif|jpg|png|bmp|GIF|JPG|PNG|BMP|doc|DOC|docx|DOCX|pdf|PDF|xls|XLS|xlsx|XLSX|txt|TXT|rar|RAR|zip|ZIP';
            $config['max_size'] = '10240';

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!is_dir($folder2)) {
                mkdir($folder2);
            }

            if (!is_dir($folder)) {
                mkdir($folder);
            }

            $this->upload->do_upload('anexo');

            $foto = $this->upload->data();

            move_uploaded_file($_FILES['anexo']['tmp_name'], $folder . $_FILES['anexo']['name']);

            $ret = $this->upload->display_errors();
        }

        $anexo = $foto['full_path'];

        echo $anexo;
    }

}

