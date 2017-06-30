<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cadastroequipamentocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroequipamentoview');
    }
    
   
     
    public function salvar() {
                
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        $codGrupo       = $this->input->POST('codGrupo');
        $codEquipamento = $this->input->POST('codEquipamento');
        $descricao      = $this->input->POST('descricao');
        $placa          = $this->input->POST('placa');
        $ano            = $this->input->POST('ano');
        $marca          = $this->input->POST('marca');
        $kmCadastro     = $this->input->POST('kmCadastro');
        $apelido        = $this->input->POST('apelido');
        $dataAquisicao  = $this->input->POST('dataAquisicao');
        $ativo          = $this->input->POST('ativo');   
        $imagem         = $this->input->POST('imagem');   
                        
        $this->load->model('cadastroequipamentomodel');

        $retorno = $this->cadastroequipamentomodel->salvar($idEmpresa, $idFilial, $codGrupo, $codEquipamento, $descricao, $placa, $ano, $marca, $kmCadastro, $apelido, $dataAquisicao, $ativo, $imagem);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $codEquipamento = $this->input->POST('codEquipamento');
        
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->excluir($codEquipamento);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $codEquipamento = $this->input->POST('codEquipamento');
        
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->buscaRegistroAnterior($codEquipamento);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $codEquipamento = $this->input->POST('codEquipamento');
        
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->buscaRegistroProximo($codEquipamento);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->pesquisaSimples($idInicial, $nomeInicial);
        
        echo ($retorno);
                
    }
    
    public function getGrid() {
        
           
        $pOrdem = $this->input->POST('order');
        $pColumn = $this->input->POST('columns');
        $indice = $pColumn[$pOrdem[0]['column']]['data'];

        $ordem = $pOrdem[0]['dir'];
        $inicio = $this->input->POST('start');
        $tamanho = $this->input->POST('length');
        $draw = $this->input->POST('draw');
       
       
        $this->load->model('cadastroequipamentomodel');

        $retorno = $this->cadastroequipamentomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idEquipamento = $this->input->POST('idEquipamento');
                     
        $this->load->model('cadastroequipamentomodel');
        
        $retorno = $this->cadastroequipamentomodel->selecionaGrid($idEquipamento);
        
        echo ($retorno);
                
    }
    
    public function carregarGrupoEmpresa() {

        $this->load->model('cadastroequipamentomodel');

        $retorno = $this->cadastroequipamentomodel->carregarGrupoEmpresa();

        echo json_encode($retorno);
    }
    
    public function carregarEmpresa() {

        $this->load->model('cadastroequipamentomodel');

        $retorno = $this->cadastroequipamentomodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('cadastroequipamentomodel');

        $retorno = $this->cadastroequipamentomodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    
    public function carregarGrupo() {
        
        $idEmpresa = $this->input->POST('idEmpresa');
        $idFilial = $this->input->POST('idFilial');

        $this->load->model('cadastroequipamentomodel');

        $retorno = $this->cadastroequipamentomodel->carregarGrupo($idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
    
    
    
    
    public function salvarAnexoImagem() {
        
        //PRINT_R("ANEXO"); exit();
        $this->load->library('session');

        $usuario = $this->session->userdata('usuario');
        
          
        $arq = "";

        $ret = "";

        if (isset($_FILES['anexo1'])) {
            $arq = $_FILES['anexo1'];
        }
        
        

        if (!empty($arq)) {

            $pogDo = rand(5, 99999999);
            parse_str($pogDo);
            $data = date("Y-m-d-H-i-s");
            parse_str($data);


            $folder = UPLOADSSERVICEDESK_PATH_IMAGEM . '/';
            
            

            $config = array();
            $config['upload_path'] = $folder;
            $config['file_name'] = $data . $pogDo;
            $config['allowed_types'] = 'gif|jpg|png|bmp|GIF|JPG|PNG|BMP|doc|DOC|docx|DOCX|pdf|PDF|xls|XLS|xlsx|XLSX|txt|TXT|rar|RAR|zip|ZIP';
            $config['max_size'] = '10240';

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            

            if (!is_dir($folder)) {
                mkdir($folder);
            }

            $this->upload->do_upload('anexo1');

            $foto = $this->upload->data();

            move_uploaded_file($_FILES['anexo1']['tmp_name'], $folder . $_FILES['anexo1']['name']);

            $ret = $this->upload->display_errors();
        }

        $anexo = $foto['full_path'];

        echo $anexo;
        
    }
    
    

}
