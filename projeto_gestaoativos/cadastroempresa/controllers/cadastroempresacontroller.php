<?php

class cadastroempresacontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');  
    }

    public function index() {
        $this->load->view('cadastroempresaview');
    }
    
    public function novo() {
        
        $this->load->model('cadastroempresamodel');

        $retorno = $this->cadastroempresamodel->novo();

        echo json_encode($retorno);
    }
     
    public function salvar() {
                
        $idEmpresa          = $this->input->POST('idEmpresa');
        $grupoEmpresa       = $this->input->POST('grupoEmpresa');
        $razaoSocial        = $this->input->POST('razaoSocial');
        $codigoCNPJ         = $this->input->POST('codigoCNPJ');
        $nomeFantasia       = $this->input->POST('nomeFantasia');
        $inscricaoEstadual  = $this->input->POST('inscricaoEstadual');
        $inscricaoMunicipal = $this->input->POST('inscricaoMunicipal');
        $ativoEmpresa       = $this->input->POST('ativoEmpresa'); 
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
                        
        $this->load->model('cadastroempresamodel');

        $retorno = $this->cadastroempresamodel->salvar($idEmpresa, $grupoEmpresa, $razaoSocial, $codigoCNPJ, $nomeFantasia, $inscricaoEstadual, $inscricaoMunicipal, $ativoEmpresa, $endereco, $numero, $cep, $cidade, $bairro, $estado, $pais, $telefone1, $telefone2, $celular, $email);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idEmpresa = $this->input->POST('idEmpresa');
        
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->excluir($idEmpresa);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroAnterior(){
        
        $idEmpresa = $this->input->POST('idEmpresa');
        
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->buscaRegistroAnterior($idEmpresa);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
        $idEmpresa = $this->input->POST('idEmpresa');
        
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->buscaRegistroProximo($idEmpresa);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->pesquisaSimples($idInicial, $nomeInicial);
        
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
       
       
        $this->load->model('cadastroempresamodel');

        $retorno = $this->cadastroempresamodel->getGrid($indice, $ordem, $inicio, $tamanho, $draw);

        echo json_encode($retorno);
           
     
    }
    
    public function selecionaGrid(){
        
        $idEmpresa = $this->input->POST('idEmpresa');
                     
        $this->load->model('cadastroempresamodel');
        
        $retorno = $this->cadastroempresamodel->selecionaGrid($idEmpresa);
        
        echo ($retorno);
                
    }
    
    public function carregarGrupoEmpresa() {

        $this->load->model('cadastroempresamodel');

        $retorno = $this->cadastroempresamodel->carregarGrupoEmpresa();

        echo json_encode($retorno);
    }
   
    // FUNÇAO PARA CONSULTAR CEP
    
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
