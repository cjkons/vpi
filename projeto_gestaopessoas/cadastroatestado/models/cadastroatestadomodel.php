<?php

class cadastroatestadomodel extends CI_Model {

    private $conBanco;

    public function __construct() {
        parent::__construct();
    }

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("engsys", TRUE);
        }
    }

    private function getUsuarioLogado() {
        $this->load->library("access");

        return $this->access->getUsuarioLogado();
    }
    
    public function carregarFuncionario(){
        
        $this->initConBanco();

       
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO ORDER BY NOME_FUNCIONARIO";
       
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $html = "<option value='0'>Selecione</option>";

        if (is_array($rs) && count($rs) > 0) {

            
            foreach ($rs as $item) {

                $idFuncionario          = $item->ID_FUNCIONARIO;
                $nomeFuncionario       = $item->NOME_FUNCIONARIO;
                $html .= "<option value='$idFuncionario'>$nomeFuncionario</option>";
            }

            return $html;
        } else {
            return "<option value='0'>Erro ao carregar lista de Funcionários</option>";
        }
        
    }
    
     public function carregarDadosFuncionario($funcionario){
        
        $this->initConBanco();

        
        $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario'";
         //print_r($query);exit(); 
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $empresa = $rs[0]->EMPRESA;
        $filial = $rs[0]->FILIAL;
        $setor = $rs[0]->SETOR;
        $funcao = $rs[0]->FUNCAO;
        
        
        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA WHERE ID_EMPRESA = '$empresa' ";
                  
        $cs = $this->conBanco->query($query);
        $rs1 = $cs->result();
        
        $descEmpresa = $rs1[0]->NOME_FANTASIA;
        
        $query = "SELECT NOME_FANTASIA FROM GP_SYS_EMPRESA_FILIAL WHERE ID_EMPRESA_FILIAL = '$filial' ";
                  
        $cs = $this->conBanco->query($query);
        $rs2 = $cs->result();
        
        $descFilial = $rs2[0]->NOME_FANTASIA;
        
        $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";
                  
        $cs = $this->conBanco->query($query);
        $rs3 = $cs->result();
        
        $descFuncao = $rs3[0]->FUNCAO;
        
        $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";
                  
        $cs = $this->conBanco->query($query);
        $rs4 = $cs->result();
        
        $descSetor = $rs4[0]->SETOR;
                
        
        $obj = array();
           
        if (is_array($rs) && count($rs) > 0){
            
            $obj[] = $descEmpresa;
            $obj[] = $descFilial;
            $obj[] = $descSetor;
            $obj[] = $descFuncao;
            $obj[] = $rs[0]->MATRICULA;
            $obj[] = $rs[0]->DATA_ADMISSAO;
            
          
            
            return json_encode($obj);
        }
        else{
            
            return false;
        }   
        
    }
    
    
    
    public function novo(){
        
        $this->initConBanco();
        
        $query = "SELECT MAX(ID_ATESTADO) AS ID_ATESTADO FROM GP_CAD_ATESTADO";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_ATESTADO + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }   

   public function salvar($id, $funcionario, $empresa, $filial, $dataAtestado, $diasAtestado, $dataRetorno, $cid, $observacao){
        
        $this->initConBanco();
        
        //$quantidade = str_replace(',', '.', $quantidade);
        
        $query = "SELECT * FROM GP_CAD_ATESTADO WHERE FUNCIONARIO = '$funcionario' AND DATA_ATESTADO = '$dataAtestado' AND CID = '$cid'";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GP_CAD_ATESTADO SET EMPRESA = '$empresa', FILIAL = '$filial', DATA_ATESTADO = '$dataAtestado', DIAS_ATESTADO = '$diasAtestado', DATA_RETORNO = '$dataRetorno', 
                    CID = '$cid', OBSERVACAO = '$observacao',  DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE FUNCIONARIO = '$funcionario' AND DATA_ATESTADO = '$dataAtestado' AND CID = '$cid'";

            
            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        else{
                                   

            $query = "INSERT INTO GP_CAD_ATESTADO (ID_ATESTADO, FUNCIONARIO, EMPRESA, FILIAL, DATA_ATESTADO, DIAS_ATESTADO, DATA_RETORNO, CID, OBSERVACAO, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, '$funcionario', '$empresa', '$filial', '$dataAtestado', '$diasAtestado', '$dataRetorno', '$cid', '$observacao', SYSDATE, '$usuarioLogado')";     

            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
    }
    
    
    public function getAdicionarAtestado($id, $funcionario, $dataAtestado, $cid) {

        $this->initConBanco();
        
        //$query = "SELECT * FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$id' AND EMPRESA = '$empresa' AND FILIAL = '$filial' AND CBO = '$cbo'";
        $query = "SELECT * FROM GP_CAD_ATESTADO ORDER BY ID_ATESTADO";
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            

            $html = "";

            $html .="<tr  style='width: 90%; padding-right: 5px; ' align='center' >
                        <td  style='width: 1%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'></td>
                         <td  style='width: 5%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 8%; padding-right: 5px;font-size: 14px;'>Data</td>
                        <td  style='width: 8%; padding-right: 5px;font-size: 14px;'>Data</td>
                       
                        
                    </tr>";
            
            $html .="<tr  style='width: 90%; padding-right: 5px; ' align='center' >
                        <td  style='width: 1%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 14px;'>ID</td>
                        <td  style='width: 20%; padding-right: 5px;font-size: 14px;'>Funcionário</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Filial</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Setor</td>
                        <td  style='width: 15%; padding-right: 5px;font-size: 14px;'>Função</td>
                        <td  style='width: 5%; padding-right: 5px;font-size: 14px;'>CID</td>
                        <td  style='width: 8%; padding-right: 5px;font-size: 14px;'>Atestado</td>
                        <td  style='width: 8%; padding-right: 5px;font-size: 14px;'>Retorno</td>
                       
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                
                $j = $j + 1;

                $id = $j;

                $funcionario  = $j;
                $funcionario .= "_";
                $funcionario .= $j;
                
                
                $filial  = $j;
                $filial .= "_";
                $filial .= $j;
                $filial .= "_";
                $filial .= $j;
                
                $setor  = $j;
                $setor .= "_";
                $setor .= $j;
                $setor .= "_";
                $setor .= $j;
                $setor .= "_";
                $setor .= $j;
                
                $funcao  = $j;
                $funcao .= "_";
                $funcao .= $j;
                $funcao .= "_";
                $funcao .= $j;
                $funcao .= "_";
                $funcao .= $j;
                $funcao .= "_";
                $funcao .= $j;
                
                $cid  = $j;
                $cid .= "_";
                $cid .= $j;
                $cid .= "_";
                $cid .= $j;
                $cid .= "_";
                $cid .= $j;
                $cid .= "_";
                $cid .= $j;
                $cid .= "_";
                $cid .= $j;
                
                $dataAtestado  = $j;
                $dataAtestado .= "_";
                $dataAtestado .= $j;
                $dataAtestado .= "_";
                $dataAtestado .= $j;
                $dataAtestado .= "_";
                $dataAtestado .= $j;
                $dataAtestado .= "_";
                $dataAtestado .= $j;
                $dataAtestado .= "_";
                $dataAtestado .= $j;
                 $dataAtestado .= "_";
                $dataAtestado .= $j;
                
                $dataRetorno  = $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                $dataRetorno .= "_";
                $dataRetorno .= $j;
                
                
                
                $idValor = $item->ID_ATESTADO;
                
                $filialValor = $item->FILIAL;
                $dataAtestadoValor = $item->DATA_ATESTADO;
                $dataRetornoValor = $item->DATA_RETORNO;
                $cidValor = $item->CID;
                
                $funcionario1 = $item->FUNCIONARIO;
            
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario1'";
             //print_r($query);exit(); 

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $setor = $rs[0]->SETOR;
            $funcao = $rs[0]->FUNCAO;
            
            $funcionarioValor = $rs[0]->NOME_FUNCIONARIO;
            
         
        
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $descFuncao = $rs1[0]->FUNCAO;

            $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

            $cs = $this->conBanco->query($query);
            $rs2 = $cs->result();

            $descSetor = $rs2[0]->SETOR;
                
            $setorValor = $descSetor;
            $funcaoValor = $descFuncao;    
                
                
               

                $html .="<tr  style='width: 90%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 1%;  padding-right: 10px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarAtestado($idValor)' readonly ></button></div></td>
                        <td  style='width: 5%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$id'   value='$idValor' readonly></div></td>
                        <td  style='width: 20%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='text-transform: uppercase;font-size: 12px;' id='$funcionario'   value='$funcionarioValor' readonly></div></td>
                        <td  style='width: 15%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='text-transform: uppercase;font-size: 12px;' id='$filial'   value='$filialValor' readonly></div></td>
                        <td  style='width: 15%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='text-transform: uppercase;font-size: 12px;' id='$setor'   value='$setorValor' readonly></div></td>
                        <td  style='width: 15%; padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='text-transform: uppercase;font-size: 12px;' id='$funcao'   value='$funcaoValor' readonly></div></td>
                        <td  style='width: 5%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$cid'   value='$cidValor' readonly></div></td>
                        <td  style='width: 6%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$dataAtestado'   value='$dataAtestadoValor' readonly></div></td>
                        <td  style='width: 6%;  padding-right: 10px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$dataRetorno'   value='$dataRetornoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }
            
    }
    
    public function editarAtestado($id) {

        $this->initConBanco();
        
        

        $query = "SELECT * FROM GP_CAD_ATESTADO WHERE ID_ATESTADO = '$id'";
        //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {
            
            $funcionario = $rs[0]->FUNCIONARIO;
            
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario'";
             //print_r($query);exit(); 

            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $setor = $rs1[0]->SETOR;
            $funcao = $rs1[0]->FUNCAO;
            $matricula = $rs1[0]->MATRICULA;
            $dataAdmissao = $rs1[0]->DATA_ADMISSAO;
         
        
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

            $cs = $this->conBanco->query($query);
            $rs2 = $cs->result();

            $descFuncao = $rs2[0]->FUNCAO;

            $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

            $cs = $this->conBanco->query($query);
            $rs3 = $cs->result();

            $descSetor = $rs3[0]->SETOR;
                
        
        $obj = array();

            
            $obj[] = $rs[0]->ID_ATESTADO;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $descSetor;
            $obj[] = $descFuncao;
            $obj[] = $matricula;
            $obj[] = $dataAdmissao;
            $obj[] = $rs[0]->DATA_ATESTADO;
            $obj[] = $rs[0]->DIAS_ATESTADO;
            $obj[] = $rs[0]->DATA_RETORNO;
            $obj[] = $rs[0]->CID;
            $obj[] = $rs[0]->OBSERVACAO;


            return json_encode($obj);
        } else {
            return false;
        }
    }
    
    public function excluir($id) {

        $this->initConBanco();


        $query = "DELETE GP_CAD_ATESTADO WHERE ID_ATESTADO = '$id'";
        //print_r($query); exit();
        
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            return true;
           
        } else {
            return false;
        }
        
    }
    
    
    public function pesquisaSimples($cboPesquisarInicio){
        
      $this->initConBanco();
         
            $query = "SELECT * FROM GP_CAD_ATESTADO WHERE CBO LIKE '%$cboPesquisarInicio%'";
             
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
                                
            $obj = array();
            
            if (is_array($rs) && count($rs) > 0){
            
                $obj[] = $rs[0]->ID_FUNCAO;
                $obj[] = $rs[0]->FUNCAO;
                $obj[] = $rs[0]->DESCRICAO;
                $obj[] = $rs[0]->CBO;
                $obj[] = $rs[0]->PERIODO_EXAME_ASO;

                return json_encode($obj);
            }
            else{
                return false;
            }
        
           
    }
    
    
    public function getGrid($indice, $ordem, $inicio, $tamanho, $draw){
        
        
        $this->initConBanco();
        
        $count = $this->getCountGrid();

        $grid = array();

        $grid['draw'] = $draw; // mecanismo de conformidade
        $grid['recordsTotal'] = $count; // total de registros 
        $grid['recordsFiltered'] = $count; // tota de registros filtrados

        $data = array(); // linhas
        //$itens = $this->getDataGrid($indice, $ordem, $inicio, $tamanho, $parametro1, $parametro2);
        
        $query = "SELECT * FROM GP_CAD_ATESTADO ORDER BY ID_ATESTADO";
        
        
               
        $cs = $this->conBanco->query($query);
        $itens = $cs->result();
        
        $obj = array();

        foreach ($itens as $item) {

            
                
            $funcionario1 = $item->FUNCIONARIO;
            
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario1'";
             //print_r($query);exit(); 

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $setor = $rs[0]->SETOR;
            $funcao = $rs[0]->FUNCAO;
            
            $funcionarioValor = $rs[0]->NOME_FUNCIONARIO;
            $aux = $item->ID_ATESTADO;
         
        
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $descFuncao = $rs1[0]->FUNCAO;

            $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

            $cs = $this->conBanco->query($query);
            $rs2 = $cs->result();

            $descSetor = $rs2[0]->SETOR;
                
            $setorValor = $descSetor;
            $funcaoValor = $descFuncao;    
            
            $obj['ID_ATESTADO'] = $item->ID_ATESTADO;
            $obj['FUNCIONARIO'] = $funcionarioValor;
            $obj['FILIAL'] = $item->FILIAL;
            $obj['SETOR'] = $descSetor;
            $obj['FUNCAO'] = $descFuncao;
            $obj['CID'] = $item->CID;
            $obj['DATA_ATESTADO'] = $item->DATA_ATESTADO;
            $obj['DATA_RETORNO'] = $item->DATA_RETORNO;
            $obj['EDITAR'] = "<button type='submit' class='btn-primary' onclick='selecionaGrid($aux)'>Editar</button>";
          
            $data[] = $obj;
        }

        $grid['data'] = $data;

        return $grid;
        
        
       
            
    }
    
    private function getCountGrid(){
        
        $this->initConBanco();
        
                               
        $query = "SELECT COUNT(ID_ATESTADO) AS TOTAL FROM GP_CAD_ATESTADO";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        if (is_array($rs) && count($rs) > 0) {
            return $rs[0]->TOTAL;
        } else {
            return 0;
        }         
          
    }
    
    public function selecionaGrid($id){
        
       
        $this->initConBanco();
       
        $query = "SELECT * FROM GP_CAD_ATESTADO WHERE ID_ATESTADO = '$id'";
        //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $obj = array();

        if (is_array($rs) && count($rs) > 0) {
            
            $funcionario = $rs[0]->FUNCIONARIO;
            
            $query = "SELECT * FROM GP_CAD_FUNCIONARIO WHERE  ID_FUNCIONARIO = '$funcionario'";
             //print_r($query);exit(); 

            $cs = $this->conBanco->query($query);
            $rs1 = $cs->result();

            $setor = $rs1[0]->SETOR;
            $funcao = $rs1[0]->FUNCAO;
            $matricula = $rs1[0]->MATRICULA;
            $dataAdmissao = $rs1[0]->DATA_ADMISSAO;
         
        
            $query = "SELECT FUNCAO FROM GP_CAD_FUNCOES WHERE ID_FUNCAO = '$funcao' ";

            $cs = $this->conBanco->query($query);
            $rs2 = $cs->result();

            $descFuncao = $rs2[0]->FUNCAO;

            $query = "SELECT SETOR FROM GP_CAD_SETOR WHERE ID_SETOR = '$setor' ";

            $cs = $this->conBanco->query($query);
            $rs3 = $cs->result();

            $descSetor = $rs3[0]->SETOR;
                
        
        $obj = array();

            
            $obj[] = $rs[0]->ID_ATESTADO;
            $obj[] = $rs[0]->FUNCIONARIO;
            $obj[] = $rs[0]->EMPRESA;
            $obj[] = $rs[0]->FILIAL;
            $obj[] = $descSetor;
            $obj[] = $descFuncao;
            $obj[] = $matricula;
            $obj[] = $dataAdmissao;
            $obj[] = $rs[0]->DATA_ATESTADO;
            $obj[] = $rs[0]->DIAS_ATESTADO;
            $obj[] = $rs[0]->DATA_RETORNO;
            $obj[] = $rs[0]->CID;
            $obj[] = $rs[0]->OBSERVACAO;


            return json_encode($obj);
        }
        else{
            return false;
        }
        
    }
    
    

    

}   




