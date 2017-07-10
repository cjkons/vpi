<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cadastroasocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastroasoview');
    }
    
   public function novo() {
        
        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idAso         = $this->input->POST('idAso');
        $empresa            = $this->input->POST('empresa');
        $filial        = $this->input->POST('filial');
        $funcionario       = $this->input->POST('funcionario');
        $matricula         = $this->input->POST('matricula');
        $setor         = $this->input->POST('setor');
        $funcao        = $this->input->POST('funcao');
        $dataNasc      = $this->input->POST('dataNasc');
        $cpf  = $this->input->POST('cpf');
        $ctps = $this->input->POST('ctps');
        $pisPasep           = $this->input->POST('pisPasep');
        
        $tipoExames             = $this->input->POST('tipoExames');
        $outrosExames                = $this->input->POST('outrosExames');
        $medico             = $this->input->POST('medico');
        $crm             = $this->input->POST('crm');
        $agBiologico             = $this->input->POST('agBiologico');
        $agFisico               = $this->input->POST('agFisico');
        $agQuimico          = $this->input->POST('agQuimico');
        $riscoAcidente          = $this->input->POST('riscoAcidente');
        $riscoErgonomico            = $this->input->POST('riscoErgonomico');
        $ausenciaRisco              = $this->input->POST('ausenciaRisco');
        $resultadoExame              = $this->input->POST('resultadoExame');
        $observacaoExame              = $this->input->POST('observacaoExame');
        $localRealizacao              = $this->input->POST('localRealizacao');
        $dataRealizacao              = $this->input->POST('dataRealizacao');
        
        $exameComplementar1              = $this->input->POST('exameComplementar1');
        $dataComplementar1              = $this->input->POST('dataComplementar1');
        $exameComplementar2              = $this->input->POST('exameComplementar2');
        $dataComplementar2              = $this->input->POST('dataComplementar2');
        $exameComplementar3              = $this->input->POST('exameComplementar3');
        $dataComplementar3              = $this->input->POST('dataComplementar3');
        $exameComplementar4              = $this->input->POST('exameComplementar4');
        $dataComplementar4              = $this->input->POST('dataComplementar4');
        $exameComplementar5              = $this->input->POST('exameComplementar5');
        $dataComplementar5              = $this->input->POST('dataComplementar5');
        $exameComplementar6              = $this->input->POST('exameComplementar6');
        $dataComplementar6              = $this->input->POST('dataComplementar6');
        $exameComplementar7              = $this->input->POST('exameComplementar7');
        $dataComplementar7              = $this->input->POST('dataComplementar7');
        $exameComplementar8              = $this->input->POST('exameComplementar8');
        $dataComplementar8              = $this->input->POST('dataComplementar8');
        $pagamentoExame              = $this->input->POST('pagamentoExame');
        $valorExame              = $this->input->POST('valorExame');
        
        $anexoExame              = $this->input->POST('anexoExame');
        
        
        
        
        
                        
        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->salvar($idAso, $empresa, $filial, $funcionario, $matricula, $setor, $funcao, $dataNasc, $cpf, $ctps, $pisPasep, $tipoExames, $outrosExames,
                                                                $medico, $crm, $agBiologico, $agFisico, $agQuimico, $riscoAcidente, $riscoErgonomico, $ausenciaRisco, $resultadoExame, $observacaoExame,
                                                                $localRealizacao, $dataRealizacao, $exameComplementar1, $dataComplementar1, $exameComplementar2, $dataComplementar2, $exameComplementar3, $dataComplementar3,
                                                                $exameComplementar4, $dataComplementar4, $exameComplementar5, $dataComplementar5, $exameComplementar6, $dataComplementar6, $exameComplementar7,
                                                                $dataComplementar7, $exameComplementar8, $dataComplementar8, $pagamentoExame, $valorExame, $anexoExame);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idAso = $this->input->POST('idAso');
        
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->excluir($idAso);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idAso = $this->input->POST('idAso');
        
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->buscaRegistroAnterior($idAso);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idAso = $this->input->POST('idAso');
        
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->buscaRegistroProximo($idAso);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
            
        
     
    }
    
    public function selecionaGrid(){
        
        $idAso = $this->input->POST('idAso');
                     
        $this->load->model('cadastroasomodel');
        
        $retorno = $this->cadastroasomodel->selecionaGrid($idAso);
        
        echo ($retorno);
                
    }
    public function carregarEmpresa() {

        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->carregarEmpresa();

        echo json_encode($retorno);
    }
    
    public function carregarFilial() {
        
        $empresa = $this->input->POST('empresa');

        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->carregarFilial($empresa);

        echo json_encode($retorno);
    }
    
    public function carregarFuncionario() {

        $empresa = $this->input->POST('empresa');
        $filial = $this->input->POST('filial');
        
        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->carregarFuncionario($empresa, $filial);

        echo json_encode($retorno);
    }
    
    
    
    public function carregarDadosFuncionario() {

        $empresa = $this->input->POST('empresa');
        $filial = $this->input->POST('filial');
        $funcionario = $this->input->POST('funcionario');
        
        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->carregarDadosFuncionario($empresa, $filial, $funcionario);

        echo ($retorno);
    }
    
    public function carregarDataAtual() {

        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->carregarDataAtual();

        echo json_encode($retorno);
    }
    
    public function carregarListaExames() {

        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->carregarListaExames();

        echo json_encode($retorno);
    }
    
    
   public function getPdf() {
                          
        $idAso          = $this->input->POST('idAso');
        
        $this->load->model('cadastroasomodel');

        $retorno = $this->cadastroasomodel->getPdf($idAso);

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
    
    
    
    public function salvarAnexo() {
        
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

            $this->upload->do_upload('anexo');

            $foto = $this->upload->data();

            move_uploaded_file($_FILES['anexo']['tmp_name'], $folder . $_FILES['anexo']['name']);

            $ret = $this->upload->display_errors();
        }

        $anexo = $foto['full_path'];

        echo $anexo;
        
    }
    
    
    
    
    

    

}
