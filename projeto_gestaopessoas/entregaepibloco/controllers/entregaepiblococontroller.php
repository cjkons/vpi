<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class entregaepiblococontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('entregaepiblocoview');
    }

    public function novo() {

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->novo();

        echo json_encode($retorno);
    }
    
    public function verificarLancamentoEpi() {


        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');




        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->verificarLancamentoEpi($id, $idFuncionario);

        echo json_encode($retorno);
    }

    public function salvar() {

        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');
        $matricula = $this->input->POST('matricula');
        $setor = $this->input->POST('setor');
        $funcao = $this->input->POST('funcao');
        $dataAdmissao = $this->input->POST('dataAdmissao');

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao);

        echo json_encode($retorno);
    }

    public function validarSalvarLancamento() {


        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');




        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->validarSalvarLancamento($id, $codCa);

        echo json_encode($retorno);
    }

    public function salvarLancamento() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $blocoEpi);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEd() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $blocoEpi);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEdEd() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $blocoEpi);

        echo json_encode($retorno);
    }

    public function excluir() {

        $id = $this->input->POST('id');

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->excluir($id);
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


        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncionarioFiltro);

        echo json_encode($retorno);
    }

    public function selecionaGrid() {

        $id = $this->input->POST('id');

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->selecionaGrid($id);

        echo ($retorno);
    }

    public function carregarCodCa() {


        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->carregarCodCa();

        echo json_encode($retorno);
    }

    public function carregarTipoEpi() {

        $codCa = $this->input->POST('codCa');

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->carregarTipoEpi($codCa);

        echo json_encode($retorno);
    }

    public function carregarFuncionario() {

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->carregarFuncionario();

        echo json_encode($retorno);
    }

    public function carregarDadosFuncionario() {

        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->carregarDadosFuncionario($idFuncionario);

        echo $retorno;
    }

    public function getItemLancamentoEditar() {

        $this->load->model('entregaepiblocomodel');


        $id = $this->input->POST('id');

        $retorno = $this->entregaepiblocomodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamentoEditarEd() {

        $this->load->model('entregaepiblocomodel');


        $id = $this->input->POST('id');

        $retorno = $this->entregaepiblocomodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamento() {

        $this->load->model('entregaepiblocomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepiblocomodel->getItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamento() {

        $this->load->model('entregaepiblocomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepiblocomodel->getEditarItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamentoEd() {

        $this->load->model('entregaepiblocomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepiblocomodel->getEditarItemLancamentoEd($id);

        echo json_encode($retorno);
    }

    public function editarItemLancamento() {

        $this->load->model('entregaepiblocomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->entregaepiblocomodel->editarItemLancamento($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function editarItemLancamentoEd() {

        $this->load->model('entregaepiblocomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->entregaepiblocomodel->editarItemLancamentoEd($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function excluirLancamentoModalEd() {

        $codCaEd = $this->input->POST('codCaEd');
        $id = $this->input->POST('id');


        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->excluirLancamentoModalEd($codCaEd, $id);
    }

    public function excluirLancamentoModalEdEd() {

        $codCaEdEd = $this->input->POST('codCaEdEd');
        $id = $this->input->POST('id');


        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->excluirLancamentoModalEdEd($codCaEdEd, $id);
    }

    public function salvarItensLancamentos() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->salvarItensLancamentos($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $blocoEpi);

        echo json_encode($retorno);
    }

    public function editarLancamento() {

        $this->load->model('entregaepiblocomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepiblocomodel->editarLancamento($id);

        echo ($retorno);
    }

    public function excluirDadosTemp() {

        $this->load->model('entregaepiblocomodel');

        $retorno = $this->entregaepiblocomodel->excluirDadosTemp();
    }

    public function getNumeroLinhas() {

        $this->load->model('entregaepiblocomodel');

        $id = $this->input->POST('id');


        $retorno = $this->entregaepiblocomodel->getNumeroLinhas($id);

        echo json_encode($retorno);
    }
    
    
    ///////////// IMPRESSAO
    
    public function getPdf(){
        
        $this->load->model('entregaepiblocomodel');
               
       
        $id                  = $this->input->POST('id');
        $idFuncionario       = $this->input->POST('idFuncionario');
                                      
        $retorno = $this->entregaepiblocomodel->getPdf($id, $idFuncionario);
          
        echo json_encode($retorno);
        
    }

}
