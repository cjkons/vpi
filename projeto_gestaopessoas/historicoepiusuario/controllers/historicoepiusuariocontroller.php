<?php

class historicoepiusuariocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();
 
        $this->load->library('access');
    }

    public function index() {
        $this->load->view('historicoepiusuarioview');
    }

    public function novo() {

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->novo();

        echo json_encode($retorno);
    }

    public function verificarLancamentoEpi() {


        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->verificarLancamentoEpi($id, $idFuncionario);

        echo json_encode($retorno);
    }
    
    public function salvar() {

        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');
        $matricula = $this->input->POST('matricula');
        $setor = $this->input->POST('setor');
        $funcao = $this->input->POST('funcao');
        $dataAdmissao = $this->input->POST('dataAdmissao');

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao);

        echo json_encode($retorno);
    }
    
    public function salvarItensLancamentos() {

        $id = $this->input->POST('id');
        $matricula = $this->input->POST('matricula');
        $imagem = $this->input->POST('imagem');
        $entDev = $this->input->POST('entDev');
        $descricaoAnexo = $this->input->POST('descricaoAnexo');
        


        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->salvarItensLancamentos($id, $matricula, $imagem, $entDev, $descricaoAnexo);

        echo json_encode($retorno);
    }


    public function excluir() {

        $id = $this->input->POST('id');

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->excluir($id);
    }
    
    public function excluirAnexo() {

        $id = $this->input->POST('id');
        $idLancamento = $this->input->POST('idLancamento');

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->excluirAnexo($id, $idLancamento);
    }

    public function getGrid() {

        // print_r("teste"); exit();

        $idFuncionarioFiltro = $this->input->POST('idFuncionarioFiltro');
        



        $pOrdem = $this->input->POST('order');
        $pColumn = $this->input->POST('columns');
        $indice = $pColumn[$pOrdem[0]['column']]['data'];

        $ordem = $pOrdem[0]['dir'];
        $inicio = $this->input->POST('start');
        $tamanho = $this->input->POST('length');
        $draw = $this->input->POST('draw');


        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncionarioFiltro);

        echo json_encode($retorno);
    }

    public function selecionaGrid() {

        $id = $this->input->POST('id');

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->selecionaGrid($id);

        echo ($retorno);
    }

    public function carregarFuncionario() {

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->carregarFuncionario();

        echo json_encode($retorno);
    }

    public function carregarDadosFuncionario() {

        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('historicoepiusuariomodel');

        $retorno = $this->historicoepiusuariomodel->carregarDadosFuncionario($idFuncionario);

        echo $retorno;
    }

    public function getEditarItemLancamento() {

        $this->load->model('historicoepiusuariomodel');

        $id = $this->input->POST('id');

        $retorno = $this->historicoepiusuariomodel->getEditarItemLancamento($id);

        echo json_encode($retorno);
    }


    public function editarLancamento() {

        $this->load->model('historicoepiusuariomodel');

        $id = $this->input->POST('id');

        $retorno = $this->historicoepiusuariomodel->editarLancamento($id);

        echo ($retorno);
    }

    public function getNumeroLinhas() {

        $this->load->model('historicoepiusuariomodel');

        $id = $this->input->POST('id');


        $retorno = $this->historicoepiusuariomodel->getNumeroLinhas($id);

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
    
    public function visualizarAnexo() {

        $this->load->model('historicoepiusuariomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');

        $retorno = $this->historicoepiusuariomodel->visualizarAnexo($idLancamentoItem, $id);

        echo ($retorno);
    }

}
