<?php

class folhapontocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        
        $this->load->view('folhapontoview');
   
    }
      
    public function carregarFuncionario() {

        $this->load->model('folhapontomodel');

        $retorno = $this->folhapontomodel->carregarFuncionario();

        echo json_encode($retorno);
    }
        
    public function carregarFuncao() {
        
        $funcionario = $this->input->POST('funcionario');

        $this->load->model('folhapontomodel');

        $retorno = $this->folhapontomodel->carregarFuncao($funcionario);

        echo json_encode($retorno);
    }
    
    
    
    public function carregarDataAtual(){
        
        $this->load->model('relatorioaniversariomodel');
                       
        $retorno = $this->relatorioaniversariomodel->carregarDataAtual();
        
        echo json_encode($retorno);                
    }
      
    public function filtro() {

        $this->load->model('folhapontomodel');
               
        $mes            = $this->input->POST('mes');
        $funcionario    = $this->input->POST('funcionario');
        $funcao         = $this->input->POST('funcao');
        

        $retorno = $this->folhapontomodel->filtro($mes, $funcionario, $funcao);

        echo json_encode($retorno);
    }
    
    public function filtro1() {

        $this->load->model('folhapontomodel');
               
        $mes            = $this->input->POST('mes');
        $funcionario    = $this->input->POST('funcionario');
        $funcao         = $this->input->POST('funcao');
        

        $retorno = $this->folhapontomodel->filtro1($mes, $funcionario, $funcao);

        echo json_encode($retorno);
    }
    
    public function getPdf(){
        
        $this->load->model('folhapontomodel');
               
        $mes            = $this->input->POST('mes');
        $funcionario    = $this->input->POST('funcionario');
        $funcao         = $this->input->POST('funcao');
                                      
        $retorno = $this->folhapontomodel->getPdf($mes, $funcionario, $funcao);
          
        
    }
    
    public function getPdf1(){
        
        $this->load->model('folhapontomodel');
               
        $mes            = $this->input->POST('mes');
        $funcionario    = $this->input->POST('funcionario');
        $funcao         = $this->input->POST('funcao');
                                      
        $retorno = $this->folhapontomodel->getPdf1($mes, $funcionario, $funcao);
          
        
    }
    
    
    public function getExcel() {



        set_time_limit(-1);
        $mes            = $this->input->POST('mes');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
      

        //print_r($medicao); exit();

        $this->load->model('relatorioaniversariomodel');

        $pastaClarify = $this->gerarPastaClarifyPeople();
        
        $nomePastaTemporaria = $this->gerarPastaTemporaria();



        $html = $this->relatorioaniversariomodel->getExcel($mes, $idEmpresa, $idFilial);



        $path = "c:/DownloadsClarifyPeople/$nomePastaTemporaria/RelatorioAniversario.xls";
        //print_r($path); exit();
        file_put_contents($path, $html);
        $r = array('nomePasta' => $nomePastaTemporaria, 'nomeArquivo' => 'RelatorioAniversario');
        echo json_encode($r);
    }

    public function gerarPastaClarifyPeople() {
       
        $diretorio = "c:/DownloadsClarifyPeople";
        
        
        if (!file_exists($diretorio)){
            mkdir("$diretorio", 0700);
            
            }
        return;
       
    
    }
    public function gerarPastaTemporaria() {

        $hash = md5(sha1(md5(date('d/m/Y : H:i:s') . rand(0, 666666))));

        mkdir("c:/DownloadsClarifyPeople/$hash");
        return $hash;
    }
    
    public function abrirArquivoExcel() {
        
        $nomePastaTemporaria = $this->input->GET('nomePastaTemporaria');

        $nomeArquivo = $this->input->GET('nomeArquivo');
        $arquivo = file_get_contents("c:/DownloadsClarifyPeople/$nomePastaTemporaria/$nomeArquivo.xls");

        header("Content-type: application/ms-excel");

        header("Content-Disposition: attachment; filename=relatorio_aniversario" . date("d-m-Y-h-i-s") . ".xls");

        echo ($arquivo);
    }
   

}
