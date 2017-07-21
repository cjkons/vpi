<?php

class cadastrofilialcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrofilialview');
    }
    
   public function novo() {
        
        $this->load->model('cadastrofilialmodel');

        $retorno = $this->cadastrofilialmodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idFilial           = $this->input->POST('idFilial');
        $empresa            = $this->input->POST('empresa');
        $razaoSocial        = $this->input->POST('razaoSocial');
        $nomeFantasia       = $this->input->POST('nomeFantasia');
        $codigoCNPJ         = $this->input->POST('codigoCNPJ');
        $codigoCEI          = $this->input->POST('codigoCEI');
        $ativoFilial        = $this->input->POST('ativoFilial');
        $inscricaoEstadual  = $this->input->POST('inscricaoEstadual');
        $inscricaoMunicipal = $this->input->POST('inscricaoMunicipal');
        $endereco           = $this->input->POST('endereco');
        $numero             = $this->input->POST('numero');
        $cep                = $this->input->POST('cep');
        $cidade             = $this->input->POST('cidade');
        $bairro             = $this->input->POST('bairro');
        $estado             = $this->input->POST('estado');
        $pais               = $this->input->POST('pais');
        $telefone1          = $this->input->POST('telefone1');
        $telefone2          = $this->input->POST('telefone2');
        $celular            = $this->input->POST('celular');
        $email              = $this->input->POST('email');
        $tipo               = $this->input->POST('tipoFilial');
        
                        
        $this->load->model('cadastrofilialmodel');

        $retorno = $this->cadastrofilialmodel->salvar($idFilial, $empresa, $razaoSocial, $nomeFantasia, $codigoCNPJ, $codigoCEI, $ativoFilial, $inscricaoEstadual, $inscricaoMunicipal, $endereco, $numero, $cep, $cidade, $bairro, $estado, $pais, $telefone1, $telefone2, $celular, $email, $tipo);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idFilial = $this->input->POST('idFilial');
        
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->excluir($idFilial);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idUsuario = $this->input->POST('idFilial');
        
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->buscaRegistroAnterior($idUsuario);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idFilial = $this->input->POST('idFilial');
        
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->buscaRegistroProximo($idFilial);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->pesquisaSimples($idInicial, $nomeInicial);
        
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

        $this->load->model('cadastrofilialmodel');

        $retorno = $this->cadastrofilialmodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
            
        
     
    }
    
    public function selecionaGrid(){
        
        $idFilial = $this->input->POST('idFilial');
                     
        $this->load->model('cadastrofilialmodel');
        
        $retorno = $this->cadastrofilialmodel->selecionaGrid($idFilial);
        
        echo ($retorno);
                
    }
    public function carregarEmpresa() {

        $this->load->model('cadastrofilialmodel');

        $retorno = $this->cadastrofilialmodel->carregarEmpresa();

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
    
    

    

}
