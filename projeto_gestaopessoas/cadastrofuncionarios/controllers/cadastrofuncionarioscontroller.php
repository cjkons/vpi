<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cadastrofuncionarioscontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrofuncionariosview');
    }
    
   public function novo() {
        
        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idFuncionario           = $this->input->POST('idFuncionario');
        $empresa            = $this->input->POST('empresa');
        $filial        = $this->input->POST('filial');
        $livro       = $this->input->POST('livro');
        $pagina         = $this->input->POST('pagina');
        $nomeFuncionario         = $this->input->POST('nomeFuncionario');
        $dataNasc        = $this->input->POST('dataNasc');
        $cidadeNasc      = $this->input->POST('cidadeNasc');
        $estadoNasc  = $this->input->POST('estadoNasc');
        $dataCadastro = $this->input->POST('dataCadastro');
        
        
        $matricula           = $this->input->POST('matricula');
        $funcao             = $this->input->POST('funcao');
        $salarioValor                = $this->input->POST('salarioValor');
        $salarioPagamento             = $this->input->POST('salarioPagamento');
        $dataAdmissao             = $this->input->POST('dataAdmissao');
        $experiencia             = $this->input->POST('experiencia');
        $horarioInicial1               = $this->input->POST('horarioInicial1');
        $horarioFinal1          = $this->input->POST('horarioFinal1');
        $horarioInicial2          = $this->input->POST('horarioInicial2');
        $horarioFinal2            = $this->input->POST('horarioFinal2');
        $imagem              = $this->input->POST('imagem');
        
        $cep              = $this->input->POST('cep');
        $endereco              = $this->input->POST('endereco');
        $numero              = $this->input->POST('numero');
        $bairro              = $this->input->POST('bairro');
        $cidade              = $this->input->POST('cidade');
        $estado              = $this->input->POST('estado');
        $email              = $this->input->POST('email');
        $telefone1              = $this->input->POST('telefone1');
        $telefone2              = $this->input->POST('telefone2');
        $telefone3              = $this->input->POST('telefone3');
        
        $cpf              = $this->input->POST('cpf');
        $identidade              = $this->input->POST('identidade');
        $expedidorIdentidade              = $this->input->POST('expedidorIdentidade');
        $estadoIdentidade              = $this->input->POST('estadoIdentidade');
        $dataIdentidade             = $this->input->POST('dataIdentidade');
        $ctps              = $this->input->POST('ctps');
        $serieCtps              = $this->input->POST('serieCtps');
        $pisPasep              = $this->input->POST('pisPasep');
        $dataPisPasep              = $this->input->POST('dataPisPasep');
        $estadoCtps              = $this->input->POST('estadoCtps');
        $dataCtps              = $this->input->POST('dataCtps');
        $tituloEleitor              = $this->input->POST('tituloEleitor');
        $zonaEleitor              = $this->input->POST('zonaEleitor');
        $secaoEleitor              = $this->input->POST('secaoEleitor');
        
        $nomeMae              = $this->input->POST('nomeMae');
        $nomePai              = $this->input->POST('nomePai');
        $sexo              = $this->input->POST('sexo');
        $estadoCivil              = $this->input->POST('estadoCivil');
        $deficienteFisico              = $this->input->POST('deficienteFisico');
        $grauInstrucao              = $this->input->POST('grauInstrucao');
        $etnia              = $this->input->POST('etnia');
        $corOlhos              = $this->input->POST('corOlhos');
        $corCabelos              = $this->input->POST('corCabelos');
        $altura              = $this->input->POST('altura');
        $peso              = $this->input->POST('peso');
        
        $nomeFilho1              = $this->input->POST('nomeFilho1');
        $dataNasc1              = $this->input->POST('dataNasc1');
        $nomeFilho2              = $this->input->POST('nomeFilho2');
        $dataNasc2              = $this->input->POST('dataNasc2');
        $nomeFilho3              = $this->input->POST('nomeFilho3');
        $dataNasc3              = $this->input->POST('dataNasc3');
        $nomeFilho4              = $this->input->POST('nomeFilho4');
        $dataNasc4              = $this->input->POST('dataNasc4');
        $nomeFilho5              = $this->input->POST('nomeFilho5');
        $dataNasc5              = $this->input->POST('dataNasc5');
        $nomeFilho6              = $this->input->POST('nomeFilho6');
        $dataNasc6              = $this->input->POST('dataNasc6');
        
        $setor = $this->input->POST('setor');
        $desativado = $this->input->POST('desativado');
        $valeTransporte = $this->input->POST('valeTransporte');
        
        
        
        
        
                        
        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->salvar($idFuncionario, $empresa, $filial, $livro, $pagina, $nomeFuncionario, $dataNasc, $cidadeNasc, $estadoNasc, $dataCadastro,
                                                        $matricula, $funcao, $salarioValor, $salarioPagamento, $dataAdmissao, $experiencia, $horarioInicial1, $horarioFinal1, $horarioInicial2,
                                                        $horarioFinal2, $imagem, $cep, $endereco, $numero, $bairro, $cidade, $estado, $email, $telefone1, $telefone2, $telefone3, $cpf, $identidade,
                                                        $expedidorIdentidade, $estadoIdentidade, $dataIdentidade, $ctps, $serieCtps, $pisPasep, $dataPisPasep, $estadoCtps, $dataCtps, $tituloEleitor, $zonaEleitor,
                                                        $secaoEleitor, $nomeMae, $nomePai, $sexo, $estadoCivil, $deficienteFisico, $grauInstrucao, $etnia, $corOlhos, $corCabelos, $altura, $peso, $nomeFilho1,
                                                        $dataNasc1, $nomeFilho2, $dataNasc2, $nomeFilho3, $dataNasc3, $nomeFilho4, $dataNasc4, $nomeFilho5, $dataNasc5, $nomeFilho6, $dataNasc6, $setor, $desativado, $valeTransporte);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idFuncionario = $this->input->POST('idFuncionario');
        
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->excluir($idFuncionario);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idFuncionario = $this->input->POST('idFuncionario');
        
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->buscaRegistroAnterior($idFuncionario);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idFuncionario = $this->input->POST('idFuncionario');
        
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->buscaRegistroProximo($idFuncionario);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        //$parametro1 = $this->input->GET('parametro1');
       // $parametro2 = $this->input->GET('parametro1');

        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
            
        
     
    }
    
    public function selecionaGrid(){
        
        $idFuncionario = $this->input->POST('idFuncionario');
                     
        $this->load->model('cadastrofuncionariosmodel');
        
        $retorno = $this->cadastrofuncionariosmodel->selecionaGrid($idFuncionario);
        
        echo ($retorno);
                
    }
    public function carregarEmpresa() {

        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->carregarEmpresa();

        echo json_encode($retorno);
    }
    
    public function carregarFilial() {
        
        $empresa = $this->input->POST('empresa');

        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->carregarFilial($empresa);

        echo json_encode($retorno);
    }
    
    public function carregarFuncao() {

        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->carregarFuncao();

        echo json_encode($retorno);
    }
    
    public function carregarSetor() {

        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->carregarSetor();

        echo json_encode($retorno);
    }
    
    public function carregarDataAtual() {

        $this->load->model('cadastrofuncionariosmodel');

        $retorno = $this->cadastrofuncionariosmodel->carregarDataAtual();

        echo json_encode($retorno);
    }
    
    
    
    
    public function consultarCep() {
        $cep = $_POST['cep'];

        $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

        $dados['sucesso'] = (string) $reg->resultado;
        $dados['endereco'] = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
        $dados['bairro'] = (string) $reg->bairro;
        $dados['cidade'] = (string) $reg->cidade;
        $dados['estado'] = (string) $reg->uf;

        echo json_encode($dados);
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
