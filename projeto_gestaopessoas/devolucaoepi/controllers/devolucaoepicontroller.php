<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class devolucaoepicontroller extends CI_Controller {
  
    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('devolucaoepiview');
    }

    public function novo() {

        $this->load->model('devolucaoepimodel'); 

        $retorno = $this->devolucaoepimodel->novo();

        echo json_encode($retorno);
    }
    
    public function verificarLancamentoEpi() {


        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');




        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->verificarLancamentoEpi($id, $idFuncionario);

        echo json_encode($retorno);
    }

    public function salvar() {

        $id = $this->input->POST('id');
        $idFuncionario = $this->input->POST('idFuncionario');
        $matricula = $this->input->POST('matricula');
        $setor = $this->input->POST('setor');
        $funcao = $this->input->POST('funcao');
        $dataAdmissao = $this->input->POST('dataAdmissao');

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->salvar($id, $idFuncionario, $matricula, $setor, $funcao, $dataAdmissao);

        echo json_encode($retorno);
    }

    public function validarSalvarLancamento() {


        $id = $this->input->POST('id');
        $codCa = $this->input->POST('codCa');




        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->validarSalvarLancamento($id, $codCa);

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



        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

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



        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

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



        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->salvarLancamento($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

        echo json_encode($retorno);
    }

    public function excluir() {

        $id = $this->input->POST('id');

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->excluir($id);
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


        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw, $idFuncionarioFiltro);

        echo json_encode($retorno);
    }

    public function selecionaGrid() {

        $id = $this->input->POST('id');

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->selecionaGrid($id);

        echo ($retorno);
    }
    
     public function carregarCodCa1() {

        $funcao = $this->input->POST('funcao');
        $matricula = $this->input->POST('matricula');
        
        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->carregarCodCa1($funcao, $matricula);

        echo json_encode($retorno);
    }

    public function carregarCodCa() {


        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->carregarCodCa();

        echo json_encode($retorno);
    }

    public function carregarTipoEpi() {

        $codCa = $this->input->POST('codCa');

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->carregarTipoEpi($codCa);

        echo json_encode($retorno);
    }

    public function carregarFuncionario() {

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->carregarFuncionario();

        echo json_encode($retorno);
    }

    public function carregarDadosFuncionario() {

        $idFuncionario = $this->input->POST('idFuncionario');

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->carregarDadosFuncionario($idFuncionario);

        echo $retorno;
    }

    public function getItemLancamentoEditar() {

        $this->load->model('devolucaoepimodel');


        $id = $this->input->POST('id');

        $retorno = $this->devolucaoepimodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamentoEditarEd() {

        $this->load->model('devolucaoepimodel');


        $id = $this->input->POST('id');

        $retorno = $this->devolucaoepimodel->getItemLancamentoEditar($id);

        echo json_encode($retorno);
    }

    public function getItemLancamento() {

        $this->load->model('devolucaoepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->devolucaoepimodel->getItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamento() {

        $this->load->model('devolucaoepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->devolucaoepimodel->getEditarItemLancamento($id);

        echo json_encode($retorno);
    }

    public function getEditarItemLancamentoEd() {

        $this->load->model('devolucaoepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->devolucaoepimodel->getEditarItemLancamentoEd($id);

        echo json_encode($retorno);
    }

    public function editarItemLancamento() {

        $this->load->model('devolucaoepimodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');
        $matricula = $this->input->POST('matricula');



        $retorno = $this->devolucaoepimodel->editarItemLancamento($idLancamentoItem, $id, $matricula);

        echo ($retorno);
    }

    public function editarItemLancamentoEd() {

        $this->load->model('devolucaoepimodel');

        $idLancamentoItem = $this->input->POST('idLancamentoItem');
        $id = $this->input->POST('id');
        $matricula = $this->input->POST('matricula');



        $retorno = $this->devolucaoepimodel->editarItemLancamentoEd($idLancamentoItem, $id, $matricula);

        echo ($retorno);
    }

    public function excluirLancamentoModalEd() {

        $codCaEd = $this->input->POST('codCaEd');
        $id = $this->input->POST('id');


        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->excluirLancamentoModalEd($codCaEd, $id);
    }

    public function excluirLancamentoModalEdEd() {

        $codCaEdEd = $this->input->POST('codCaEdEd');
        $id = $this->input->POST('id');


        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->excluirLancamentoModalEdEd($codCaEdEd, $id);
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



        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->salvarItensLancamentos($id, $codCa, $tipoEpi, $qtdEpi, $estadoEpi, $dataEpi, $tipoLancamento, $blocoEpi);

        echo json_encode($retorno);
    }

    public function editarLancamento() {

        $this->load->model('devolucaoepimodel');

        $id = $this->input->POST('id');

        $retorno = $this->devolucaoepimodel->editarLancamento($id);

        echo ($retorno);
    }

    public function excluirDadosTemp() {

        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->excluirDadosTemp();
    }

    public function getNumeroLinhas() {

        $this->load->model('devolucaoepimodel');

        $id = $this->input->POST('id');


        $retorno = $this->devolucaoepimodel->getNumeroLinhas($id);

        echo json_encode($retorno);
    }
    
    public function verificarQuantidadeEntregue() {


        $codCa = $this->input->POST('codCa');
        $funcao = $this->input->POST('funcao');
        $matricula = $this->input->POST('matricula');




        $this->load->model('devolucaoepimodel');

        $retorno = $this->devolucaoepimodel->verificarQuantidadeEntregue($codCa, $funcao, $matricula);

        echo json_encode($retorno);
    }
    
    public function getItemHistorico() {

        $this->load->model('devolucaoepimodel');

        $id = $this->input->POST('id');
        $idLancamentoItem = $this->input->POST('idLancamentoItem');

        $retorno = $this->devolucaoepimodel->getItemHistorico($id, $idLancamentoItem);

        echo json_encode($retorno);
    }
    
    
    ///////////// IMPRESSAO
    
    public function getPdf(){
        
        $this->load->model('devolucaoepimodel');
               
       
        $id                  = $this->input->POST('id');
        $idFuncionario       = $this->input->POST('idFuncionario');
                                      
        $retorno = $this->devolucaoepimodel->getPdf($id, $idFuncionario);
          
        echo json_encode($retorno);
        
    }

}
