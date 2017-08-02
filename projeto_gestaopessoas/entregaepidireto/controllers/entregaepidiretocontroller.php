<?php

class entregaepidiretocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('entregaepidiretoview');
    }

    public function novo() {

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->novo();

        echo json_encode($retorno);
    }

    public function verificarLancamentoEpi() {


        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');




        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->verificarLancamentoEpi($id, $idFuncionario);

        echo json_encode($retorno);
    }
    
    public function salvar() {

        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');
        $matricula = $this->input->POST('matricula');
        $setor = $this->input->POST('setor');
        $funcao = $this->input->POST('funcao');
        $dataAdmissao = $this->input->POST('dataAdmissao');

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao);

        echo json_encode($retorno);
    }

    public function validarSalvarLancamento() {


        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');




        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->validarSalvarLancamento($id, $codCa);

        echo json_encode($retorno);
    }

    public function salvarLancamento() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');



        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEd() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');



        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEdEd() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');



        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi);

        echo json_encode($retorno);
    }

    public function excluir() {

        $id = $this->input->POST('id');

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->excluir($id);
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


        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncionarioFiltro);

        echo json_encode($retorno);
    }

    public function selecionaGrid() {

        $id = $this->input->POST('id');

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->selecionaGrid($id);

        echo ($retorno);
    }

    public function carregarCodCa() {


        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->carregarCodCa();

        echo json_encode($retorno);
    }

    public function carregarTipoEpi() {

        $codCa = $this->input->POST('codCa');

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->carregarTipoEpi($codCa);

        echo json_encode($retorno);
    }

    public function carregarFuncionario() {

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->carregarFuncionario();

        echo json_encode($retorno);
    }

    public function carregarDadosFuncionario() {

        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->carregarDadosFuncionario($idFuncionario);

        echo $retorno;
    }

    public function getItemLancamentoEditar() {

        $this->load->model('entregaepidiretomodel');


        $id = $this->input->POST('id');

        $retorno = $this->entregaepidiretomodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamentoEditarEd() {

        $this->load->model('entregaepidiretomodel');


        $id = $this->input->POST('id');

        $retorno = $this->entregaepidiretomodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamento() {

        $this->load->model('entregaepidiretomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepidiretomodel->getItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamento() {

        $this->load->model('entregaepidiretomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepidiretomodel->getEditarItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamentoEd() {

        $this->load->model('entregaepidiretomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepidiretomodel->getEditarItemLancamentoEd($id);

        echo json_encode($retorno);
    }

    public function editarItemLancamento() {

        $this->load->model('entregaepidiretomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->entregaepidiretomodel->editarItemLancamento($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function editarItemLancamentoEd() {

        $this->load->model('entregaepidiretomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->entregaepidiretomodel->editarItemLancamentoEd($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function excluirLancamentoModalEd() {

        $codCaEd = $this->input->POST('codCaEd');
        $id = $this->input->POST('id');


        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->excluirLancamentoModalEd($codCaEd, $id);
    }

    public function excluirLancamentoModalEdEd() {

        $codCaEdEd = $this->input->POST('codCaEdEd');
        $id = $this->input->POST('id');


        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->excluirLancamentoModalEdEd($codCaEdEd, $id);
    }

    public function salvarItensLancamentos() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');



        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->salvarItensLancamentos($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi);

        echo json_encode($retorno);
    }

    public function editarLancamento() {

        $this->load->model('entregaepidiretomodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepidiretomodel->editarLancamento($id);

        echo ($retorno);
    }

    public function excluirDadosTemp() {

        $this->load->model('entregaepidiretomodel');

        $retorno = $this->entregaepidiretomodel->excluirDadosTemp();
    }

    public function getNumeroLinhas() {

        $this->load->model('entregaepidiretomodel');

        $id = $this->input->POST('id');


        $retorno = $this->entregaepidiretomodel->getNumeroLinhas($id);

        echo json_encode($retorno);
    }

}
