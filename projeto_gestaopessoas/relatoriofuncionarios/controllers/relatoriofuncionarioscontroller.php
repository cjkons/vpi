<?php

class relatoriofuncionarioscontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        
        $this->load->view('relatoriofuncionariosview');
   
    }
      
    public function carregarEmpresa() {

        $this->load->model('relatoriofuncionariosmodel');

        $retorno = $this->relatoriofuncionariosmodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('relatoriofuncionariosmodel');

        $retorno = $this->relatoriofuncionariosmodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    
    
    public function carregarDataAtual(){
        
        $this->load->model('relatoriofuncionariosmodel');
                       
        $retorno = $this->relatoriofuncionariosmodel->carregarDataAtual();
        
        echo json_encode($retorno);                
    }
      
    public function filtro() {

        $this->load->model('relatoriofuncionariosmodel');
               
        $mes            = $this->input->POST('mes');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        

        $retorno = $this->relatoriofuncionariosmodel->filtro($mes, $idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
    
    public function getPdf(){
        
        $this->load->model('relatoriofuncionariosmodel');
               
        $mes            = $this->input->POST('mes');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
                                      
        $retorno = $this->relatoriofuncionariosmodel->getPdf($mes, $idEmpresa, $idFilial);
          
        
    }
    
    
    public function getExcel() {
        
        set_time_limit(-1);
        $mes            = $this->input->POST('mes');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        
        $this->load->model('relatoriofuncionariosmodel');
        $pastaClarify = $this->gerarPastaClarifyPeople();
        $nomePastaTemporaria = $this->gerarPastaTemporaria();
        $html = $this->relatoriofuncionariosmodel->getExcel($mes, $idEmpresa, $idFilial);
        
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
