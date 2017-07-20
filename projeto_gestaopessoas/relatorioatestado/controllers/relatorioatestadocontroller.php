<?php

class relatorioatestadocontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        
        $this->load->view('relatorioatestadoview');
   
    }
      
    public function carregarEmpresa() {

        $this->load->model('relatorioatestadomodel');

        $retorno = $this->relatorioatestadomodel->carregarEmpresa();

        echo json_encode($retorno);
    }
        
    public function carregarFilial() {
        
        $idEmpresa = $this->input->POST('idEmpresa');

        $this->load->model('relatorioatestadomodel');

        $retorno = $this->relatorioatestadomodel->carregarFilial($idEmpresa);

        echo json_encode($retorno);
    }
    
    
    
    public function carregarDataAtual(){
        
        $this->load->model('relatorioatestadomodel');
                       
        $retorno = $this->relatorioatestadomodel->carregarDataAtual();
        
        echo json_encode($retorno);                
    }
      
    public function filtro() {

        $this->load->model('relatorioatestadomodel');
               
        $periodoIni     = $this->input->POST('periodoIni');
        $periodoFim     = $this->input->POST('periodoFim');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
        

        $retorno = $this->relatorioatestadomodel->filtro($idEmpresa, $idFilial, $periodoIni, $periodoFim);

        echo json_encode($retorno);
    }
    
    public function getPdf(){
        
        $this->load->model('relatorioatestadomodel');
               
        $periodoIni     = $this->input->POST('periodoIni');
        $periodoFim     = $this->input->POST('periodoFim');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');
                                      
        $retorno = $this->relatorioatestadomodel->getPdf($idEmpresa, $idFilial, $periodoIni, $periodoFim);
          
        
    }
    
    
    public function getExcel() {



        set_time_limit(-1);
        $periodoIni     = $this->input->POST('periodoIni');
        $periodoFim     = $this->input->POST('periodoFim');
        $idEmpresa      = $this->input->POST('idEmpresa');
        $idFilial       = $this->input->POST('idFilial');

        //print_r($medicao); exit();

        $this->load->model('relatorioatestadomodel');

        $pastaClarify = $this->gerarPastaClarifyPeople();
        
        $nomePastaTemporaria = $this->gerarPastaTemporaria();



        $html = $this->relatorioatestadomodel->getExcel($idEmpresa, $idFilial, $periodoIni, $periodoFim);



        $path = "c:/DownloadsClarifyPeople/$nomePastaTemporaria/RelatorioAtestado.xls";
        //print_r($path); exit();
        file_put_contents($path, $html);
        $r = array('nomePasta' => $nomePastaTemporaria, 'nomeArquivo' => 'RelatorioAtestado');
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

        header("Content-Disposition: attachment; filename=relatorio_atestado" . date("d-m-Y-h-i-s") . ".xls");

        echo ($arquivo);
    }
   

}
