<?php

class quantidadeepifuncaocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('quantidadeepifuncaoview');
    }

    public function novo() {

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->novo();

        echo json_encode($retorno);
    }

    public function salvar() {

        $id = $this->input->POST('id');
        $idFuncao = $this->input->POST('idFuncao');
        
        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->salvar($id, $idFuncao);

        echo json_encode($retorno);
    }
    
    public function verificarLancamentoEpi() {

        $id = $this->input->POST('id');
        $idFuncao = $this->input->POST('idFuncao');

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->verificarLancamentoEpi($id, $idFuncao);

        echo json_encode($retorno);
    }
    
    public function verificarSalvarLancamento() {

        $id = $this->input->POST('id');
        $tipoEpi = $this->input->POST('tipoEpi');

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->verificarSalvarLancamento($id, $tipoEpi);

        echo json_encode($retorno);
    }

    

    public function salvarLancamento() {

        $id = $this->input->POST('id');
        $tipoEpi = $this->input->POST('tipoEpi');
        $quantidade = $this->input->POST('quantidade');
        $durabilidade = $this->input->POST('durabilidade');
        



        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->salvarLancamento($id, $tipoEpi, $quantidade, $durabilidade);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEd() {

        $id = $this->input->POST('id');
        $tipoEpi = $this->input->POST('tipoEpi');
        $quantidade = $this->input->POST('quantidade');
        $durabilidade = $this->input->POST('durabilidade');
        
        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->salvarLancamentoEd($id, $tipoEpi, $quantidade, $durabilidade);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEdEd() {

        $id = $this->input->POST('id');
        $tipoEpi = $this->input->POST('tipoEpi');
        $quantidade = $this->input->POST('quantidade');
        $durabilidade = $this->input->POST('durabilidade');
        
        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->salvarLancamento($id, $tipoEpi, $quantidade, $durabilidade);

        echo json_encode($retorno);
    }

    public function excluir() {

        $id = $this->input->POST('id');

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->excluir($id);
    }

    public function getGrid() {

        // print_r("teste"); exit();

        $idFuncaoFiltro = $this->input->POST('idFuncaoFiltro');
        
        $pOrdem = $this->input->POST('order');
        $pColumn = $this->input->POST('columns');
        $indice = $pColumn[$pOrdem[0]['column']]['data'];

        $ordem = $pOrdem[0]['dir'];
        $inicio = $this->input->POST('start');
        $tamanho = $this->input->POST('length');
        $draw = $this->input->POST('draw');


        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncaoFiltro);

        echo json_encode($retorno);
    }

    public function selecionaGrid() {

        $id = $this->input->POST('id');

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->selecionaGrid($id);

        echo ($retorno);
    }

    

    public function carregarTipoEpi() {

      
        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->carregarTipoEpi();

        echo json_encode($retorno);
    }
    
     public function carregarTipoEpiEd() {

      
        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->carregarTipoEpi();

        echo json_encode($retorno);
    }

    public function carregarFuncao() {

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->carregarFuncao();

        echo json_encode($retorno);
    }

    public function carregarDadosFuncionario() {

        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->carregarDadosFuncionario($idFuncionario);

        echo $retorno;
    }

    public function getItemLancamentoEditar() {

        $this->load->model('quantidadeepifuncaomodel');


        $id = $this->input->POST('id');

        $retorno = $this->quantidadeepifuncaomodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamentoEditarEd() {

        $this->load->model('quantidadeepifuncaomodel');


        $id = $this->input->POST('id');

        $retorno = $this->quantidadeepifuncaomodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamento() {

        $this->load->model('quantidadeepifuncaomodel');

        $id = $this->input->POST('id');

        $retorno = $this->quantidadeepifuncaomodel->getItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamento() {

        $this->load->model('quantidadeepifuncaomodel');

        $id = $this->input->POST('id');

        $retorno = $this->quantidadeepifuncaomodel->getEditarItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamentoEd() {

        $this->load->model('quantidadeepifuncaomodel');

        $id = $this->input->POST('id');

        $retorno = $this->quantidadeepifuncaomodel->getEditarItemLancamentoEd($id);

        echo json_encode($retorno);
    }

    public function editarItemLancamento() {

        $this->load->model('quantidadeepifuncaomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->quantidadeepifuncaomodel->editarItemLancamento($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function editarItemLancamentoEd() {

        $this->load->model('quantidadeepifuncaomodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->quantidadeepifuncaomodel->editarItemLancamentoEd($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function excluirLancamentoModalEd() {

        $tipoEpiEd = $this->input->POST('tipoEpiEd');
        $id = $this->input->POST('id');


        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->excluirLancamentoModalEd($tipoEpiEd, $id);
    }

    public function excluirLancamentoModalEdEd() {

        $tipoEpiEd = $this->input->POST('tipoEpiEd');
        $id = $this->input->POST('id');


        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->excluirLancamentoModalEdEd($tipoEpiEd, $id);
    }

    public function salvarItensLancamentos() {

        $id = $this->input->POST('id');
        $tipoEpi = $this->input->POST('tipoEpi');
        $quantidade = $this->input->POST('quantidade');
        $durabilidade = $this->input->POST('durabilidade');
        


        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->salvarItensLancamentos($id, $tipoEpi, $quantidade, $durabilidade);

        echo json_encode($retorno);
    }

    public function editarLancamento() {

        $this->load->model('quantidadeepifuncaomodel');

        $id = $this->input->POST('id');

        $retorno = $this->quantidadeepifuncaomodel->editarLancamento($id);

        echo ($retorno);
    }

    public function excluirDadosTemp() {

        $this->load->model('quantidadeepifuncaomodel');

        $retorno = $this->quantidadeepifuncaomodel->excluirDadosTemp();
    }

    public function getNumeroLinhas() {

        $this->load->model('quantidadeepifuncaomodel');

        $id = $this->input->POST('id');


        $retorno = $this->quantidadeepifuncaomodel->getNumeroLinhas($id);

        echo json_encode($retorno);
    }

}
