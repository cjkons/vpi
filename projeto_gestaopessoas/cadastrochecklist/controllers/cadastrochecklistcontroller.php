<?php

class cadastrochecklistcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {
        $this->load->view('cadastrochecklistview');
    }
    
    public function novo() {
        
        $this->load->model('cadastrochecklistmodel');

        $retorno = $this->cadastrochecklistmodel->novo();

        echo json_encode($retorno);
    }
    
    
    public function novoIdDesc() {
        
        $idCheckList  = $this->input->POST('idCheckList');
        
        $this->load->model('cadastrochecklistmodel');

        $retorno = $this->cadastrochecklistmodel->novoIdDesc($idCheckList);

        echo json_encode($retorno);
    }
    
    
    public function salvar() {
               
        $idCheckList     = $this->input->POST('idCheckList');
        $checkList       = $this->input->POST('checkList');
                                       
        $this->load->model('cadastrochecklistmodel');

        $retorno = $this->cadastrochecklistmodel->salvar($idCheckList, $checkList);

        echo json_encode($retorno);
    }
    
    
    public function salvarDescricao() {
         
        $idCheckList     = $this->input->POST('idCheckList');
        $idCheckListDesc = $this->input->POST('idCheckListDesc');
        $descricao       = $this->input->POST('descricao');
        $grupo           = $this->input->POST('grupo');
        $subGrupo        = $this->input->POST('subGrupo');
        
                                        
        $this->load->model('cadastrochecklistmodel');

        $retorno = $this->cadastrochecklistmodel->salvarDescricao($idCheckList, $idCheckListDesc, $descricao , $grupo, $subGrupo);

        echo json_encode($retorno);
    }
      
    
    public function excluir(){
        
        $idCheckList = $this->input->POST('idCheckList');
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->excluir($idCheckList);
            
    }
    
    public function excluirItem(){
        
        $idCheckList = $this->input->POST('idCheckList');
        $idCheckListDesc = $this->input->POST('idCheckListDesc');
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->excluirItem($idCheckList, $idCheckListDesc);
            
    }
    
    public function excluirDescricao(){
        
        $idCheckList         = $this->input->POST('idCheckList');
        $idCheckListDesc      = $this->input->POST('idCheckListDesc');
                
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->excluirDescricao($idCheckList, $idCheckListDesc);
            
    }
    
    
    public function buscaPrimeiroRegistro(){
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->buscaPrimeiroRegistro();
        
        echo ($retorno);
                
    }

    
    public function buscaRegistroAnterior(){
        
        $idCheckList = $this->input->POST('idCheckList');
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->buscaRegistroAnterior($idCheckList);
        
        echo ($retorno);
                
    }
    
    public function buscaRegistroProximo(){
        
       
        $idCheckList = $this->input->POST('idCheckList');
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->buscaRegistroProximo($idCheckList);
        
        echo ($retorno);
                
    }  
            
    public function buscaUltimoRegistro(){
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->buscaUltimoRegistro();
        
        echo ($retorno);                
    }
    
    public function pesquisaSimples(){
        
        $idInicial = $this->input->POST('idInicial');
        $nomeInicial = $this->input->POST('nomeInicial');
             
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->pesquisaSimples($idInicial, $nomeInicial);
        
        echo ($retorno);
                
    }
    
       
    
    public function plusTabelaPreco(){
        
        $cont = $this->input->POST('cont');
        
        $idCheckList = $this->input->POST('idCheckList');
     
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->plusTabelaPreco($idCheckList);
            
             
        
        $idCheckListDesc   = $cont;
        
        $idCheckListDescValor   = $retorno;
                
        $descricao      = $cont;
        $descricao     .= "_";
        $descricao     .= $cont;
        
        $grupo    = $cont;
        $grupo    .= "_";
        $grupo    .= $cont;
        $grupo    .= "_";
        $grupo    .= $cont;
        
        $subGrupo   = $cont;
        $subGrupo   .= "_";
        $subGrupo   .= $cont;
        $subGrupo   .= "_";
        $subGrupo   .= $cont;
        $subGrupo   .= "_";
        $subGrupo   .= $cont;
        
        
        
        $html ="<tr style='width: 80%; border-collapse: collapse' cellpadding='0' cellspacing='5px' align='center' >
                    <td  style='padding-right: 3px;font-size: 14px;'><div class='form'><button type='button' class='btn btn-info  glyphicon glyphicon-plus' onclick='plusTabelaPrecos($cont)' ></button></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='hidden' class='form-control' id='$idCheckListDesc'  value='$idCheckListDescValor' placeholder='ID' readonly></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='text' class='form-control' id='$descricao'   placeholder='Descrição'  ></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='number' class='form-control' id='$grupo' placeholder='Grupo' ></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><input type='number' class='form-control' id='$subGrupo'   onchange='salvarDescricao($cont)' placeholder='Subgrupo' ></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><button type='button' style='background-color: red;' class='btn btn-info  glyphicon glyphicon-remove' onclick='removerTr(this)' onchange='salvarDescricao($cont)'></button></div></td>
                    <td  style='padding-right: 5px;font-size: 14px;'><div class='form'><button type='button'  class='btn btn-info  glyphicon glyphicon-floppy-disk' onclick='salvarDescricao($cont)'></button></div></td>
              </tr>";

        
        
        
        

        ///$this->load->model('cadastrocondicaopagamentomodel');

       // $retorno = $this->cadastrocondicaopagamentomodel->carregarFilial($idEmpresa);

        echo json_encode($html);

    }
    
    
    
    public function carregarCodItem() {

        $this->load->model('descricaotabelaprecomodel');

        $retorno = $this->descricaotabelaprecomodel->carregarCodItem();

        echo json_encode($retorno);
    }
    
       
    
    public function carregarItem() {

        $codProduto      = $this->input->POST('codProduto');
        
        $this->load->model('descricaotabelaprecomodel');

        $retorno = $this->descricaotabelaprecomodel->carregarItem($codProduto);

        echo ($retorno);  
    }
    
    
    public function plusParcelaBusca() {
        
        $total = $this->input->POST('total');
        $idCheckList = $this->input->POST('idCheckList');
        //$codProduto = $this->input->POST('codProduto');
        
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->plusParcelaBusca($idCheckList, $total);
        
        echo json_encode($retorno);

    
    }
    
    public function addParcela1(){
        
        
        $idCheckList  = $this->input->POST('idCheckList');
        
        $this->load->model('cadastrochecklistmodel');
        
        $retorno = $this->cadastrochecklistmodel->addParcela1($idCheckList);
        
        echo ($retorno);
                
    }
    
    public function carregarValorCombo() {
        
        $idPreco  = $this->input->POST('idPreco');
        $codProduto = $this->input->POST('codProduto');
        

        $this->load->model('descricaotabelaprecomodel');

        $retorno = $this->descricaotabelaprecomodel->carregarValorCombo($idPreco, $codProduto);

        echo ($retorno);
    }
    
    

  
    

}
