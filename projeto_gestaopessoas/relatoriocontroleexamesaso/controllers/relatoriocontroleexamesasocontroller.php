<?php

class relatoriocontroleexamesasocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        
        $this->load->view('relatoriocontroleexamesasoview');
   
    }
      
    public function carregarEmpresa() {

        $this->load->model('relatoriocontroleexamesasomodel');

        $retorno = $this->relatoriocontroleexamesasomodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('relatoriocontroleexamesasomodel');

        $retorno = $this->relatoriocontroleexamesasomodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    
    
    public function carregarDataAtual(){
        
        $this->load->model('relatoriocontroleexamesasomodel');
                       
        $retorno = $this->relatoriocontroleexamesasomodel->carregarDataAtual();
        
        echo json_encode($retorno);                
    }
      
    public function filtro() {

        $this->load->model('relatoriocontroleexamesasomodel');
               
        
        $mes            = $this->input->POST('mes');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        

        $retorno = $this->relatoriocontroleexamesasomodel->filtro($mes, $idEmpresa, $idFilial);

        echo json_encode($retorno);
    }
    
    public function getPdf(){
        
        $this->load->model('relatoriocontroleexamesasomodel');
               
        $mes            = $this->input->POST('mes');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
                                      
        $retorno = $this->relatoriocontroleexamesasomodel->getPdf($mes, $idEmpresa, $idFilial);
          
        
    }
    
    
    public function getExcel() {



        set_time_limit(-1);
        
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        $mes            = $this->input->POST('mes');
      

        //print_r($medicao); exit();

        $this->load->model('relatoriocontroleexamesasomodel');

        $nomePastaTemporaria = $this->gerarPastaTemporaria();



        $html = $this->relatoriocontroleexamesasomodel->getExcel($mes, $idEmpresa, $idFilial);



        $path = "c:/DownloadsClarifyPeople/$nomePastaTemporaria/ControleAso.xls";
        //print_r($path); exit();
        file_put_contents($path, $html);
        $r = array('nomePasta' => $nomePastaTemporaria, 'nomeArquivo' => 'controleAso');
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

        header("Content-Disposition: attachment; filename=relatorio_Aso" . date("d-m-Y-h-i-s") . ".xls");

        echo ($arquivo);
    }
   

}
