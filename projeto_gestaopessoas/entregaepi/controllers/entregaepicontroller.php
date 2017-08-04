<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class entregaepicontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('entregaepiview');
    }

    public function novo() {

        $this->load->model('entregaepimodel'); 

        $retorno = $this->entregaepimodel->novo();

        echo json_encode($retorno);
    }
    
    public function verificarLancamentoEpi() {


        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');




        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->verificarLancamentoEpi($id, $idFuncionario);

        echo json_encode($retorno);
    }

    public function salvar() {

        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');
        $matricula = $this->input->POST('matricula');
        $setor = $this->input->POST('setor');
        $funcao = $this->input->POST('funcao');
        $dataAdmissao = $this->input->POST('dataAdmissao');

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao);

        echo json_encode($retorno);
    }

    public function validarSalvarLancamento() {


        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');




        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->validarSalvarLancamento($id, $codCa);

        echo json_encode($retorno);
    }

    public function salvarLancamento() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $tipoLancamento = $this->input->POST('tipoLancamento');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEd() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $tipoLancamento = $this->input->POST('tipoLancamento');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

        echo json_encode($retorno);
    }

    public function salvarLancamentoEdEd() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $tipoLancamento = $this->input->POST('tipoLancamento');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

        echo json_encode($retorno);
    }

    public function excluir() {

        $id = $this->input->POST('id');

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->excluir($id);
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


        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncionarioFiltro);

        echo json_encode($retorno);
    }

    public function selecionaGrid() {

        $id = $this->input->POST('id');

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->selecionaGrid($id);

        echo ($retorno);
    }

    public function carregarCodCa1() {

        $funcao = $this->input->POST('funcao');
        
        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->carregarCodCa1($funcao);

        echo json_encode($retorno);
    }
    
    public function carregarCodCa() {

        
        
        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->carregarCodCa();

        echo json_encode($retorno);
    }

    public function carregarTipoEpi() {

        $codCa = $this->input->POST('codCa');

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->carregarTipoEpi($codCa);

        echo json_encode($retorno);
    }

    public function carregarFuncionario() {

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->carregarFuncionario();

        echo json_encode($retorno);
    }

    public function carregarDadosFuncionario() {

        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->carregarDadosFuncionario($idFuncionario);

        echo $retorno;
    }

    public function getItemLancamentoEditar() {

        $this->load->model('entregaepimodel');


        $id = $this->input->POST('id');

        $retorno = $this->entregaepimodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamentoEditarEd() {

        $this->load->model('entregaepimodel');


        $id = $this->input->POST('id');

        $retorno = $this->entregaepimodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamento() {

        $this->load->model('entregaepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepimodel->getItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamento() {

        $this->load->model('entregaepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepimodel->getEditarItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamentoEd() {

        $this->load->model('entregaepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepimodel->getEditarItemLancamentoEd($id);

        echo json_encode($retorno);
    }

    public function editarItemLancamento() {

        $this->load->model('entregaepimodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->entregaepimodel->editarItemLancamento($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function editarItemLancamentoEd() {

        $this->load->model('entregaepimodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');



        $retorno = $this->entregaepimodel->editarItemLancamentoEd($idLancamentoItem, $id);

        echo ($retorno);
    }

    public function excluirLancamentoModalEd() {

        $codCaEd = $this->input->POST('codCaEd');
        $id = $this->input->POST('id');


        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->excluirLancamentoModalEd($codCaEd, $id);
    }

    public function excluirLancamentoModalEdEd() {

        $codCaEdEd = $this->input->POST('codCaEdEd');
        $id = $this->input->POST('id');


        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->excluirLancamentoModalEdEd($codCaEdEd, $id);
    }

    public function salvarItensLancamentos() {

        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');
        $tipoEpi = $this->input->POST('tipoEpi');
        $qtdEpi = $this->input->POST('qtdEpi');
        $estadoEpi = $this->input->POST('estadoEpi');
        $dataEpi = $this->input->POST('dataEpi');
        $tipoLancamento = $this->input->POST('tipoLancamento');
        $blocoEpi = $this->input->POST('blocoEpi');



        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->salvarItensLancamentos($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

        echo json_encode($retorno);
    }

    public function editarLancamento() {

        $this->load->model('entregaepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->entregaepimodel->editarLancamento($id);

        echo ($retorno);
    }

    public function excluirDadosTemp() {

        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->excluirDadosTemp();
    }

    public function getNumeroLinhas() {

        $this->load->model('entregaepimodel');

        $id = $this->input->POST('id');


        $retorno = $this->entregaepimodel->getNumeroLinhas($id);

        echo json_encode($retorno);
    }
    
    public function verificarQuantidadePermitida() {


        $tipoEpi = $this->input->POST('tipoEpi');
        $funcao = $this->input->POST('funcao');




        $this->load->model('entregaepimodel');

        $retorno = $this->entregaepimodel->verificarQuantidadePermitida($tipoEpi, $funcao);

        echo json_encode($retorno);
    }
    
    
    ///////////// IMPRESSAO
    
    public function getPdf(){
        
        $this->load->model('entregaepimodel');
               
       
        $id                  = $this->input->POST('id');
        $idFuncionario       = $this->input->POST('idFuncionario');
                                      
        $retorno = $this->entregaepimodel->getPdf($id, $idFuncionario);
          
        echo json_encode($retorno);
        
    }
    
    
    

}
