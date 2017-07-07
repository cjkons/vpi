<?php

class cadastroplanopreventivomodel extends CI_Model {

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
    
    
    public function novo(){
        
        $this->initConBanco();
        
        $query = "SELECT MAX(ID_PL_PREVENT) AS ID_PL_PREVENT FROM GA_PL_PREVENT";
              //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                       
        if(count($rs) > 0){
            $novoId = $rs[0]->ID_PL_PREVENT + 1;
        }
        else{
            $novoId = 1;
            
        }
                
        return $novoId;
         
    }   

   public function salvar($id, $equipamento, $descricao, $ativoChecklist, $ativoAtividade){
        
        $this->initConBanco();
        
        //$quantidade = str_replace(',', '.', $quantidade);
        
        $query = "SELECT * FROM GA_PL_PREVENT WHERE COD_EQUIPAMENTO = '$equipamento'" ;
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        $usuarioLogado = $this->getUsuarioLogado()->NOME_COMPLETO; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        if (is_array($rs) && count($rs) > 0){
            
            $query = "UPDATE GA_PL_PREVENT SET ID_PL_PREVENT = $id, COD_EQUIPAMENTO = '$equipamento', DESC_EQUIPAMENTO = '$descricao', CHECKLIST = '$ativoChecklist', ATIVIDADE = '$ativoAtividade', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id";

            
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
                                   

            $query = "INSERT INTO GA_PL_PREVENT (ID_PL_PREVENT, COD_EQUIPAMENTO, DESC_EQUIPAMENTO, CHECKLIST, ATIVIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, '$equipamento', '$descricao', '$ativoChecklist', '$ativoAtividade', SYSDATE, '$usuarioLogado')";     

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
    
    
    public function salvarAtividades($id, $idAtividade, $intervencao , $descAtividade, $frequencia, $executor){
        
        $this->initConBanco();
              

        $query = "SELECT * FROM  GA_PL_PREVENT_ATV  WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade";
        
        //print_r($query);
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
               
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO
        
        
  

        if (is_array($rs) && count($rs) > 0){  
            
            
            $query = "UPDATE GA_PL_PREVENT_ATV SET INTERVENCAO = '$intervencao', DESC_ATIVIDADE = '$descAtividade', FREQUENCIA = '$frequencia', EXECUTOR = '$executor', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ";
            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        
            
        
        }else{
            
            
            $query = "INSERT INTO GA_PL_PREVENT_ATV (ID_PL_PREVENT, ID_ATIVIDADE, INTERVENCAO, DESC_ATIVIDADE, FREQUENCIA, EXECUTOR, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, $idAtividade, '$intervencao', $descAtividade, '$frequencia', '$executor', SYSDATE, '$usuarioLogado')";     
            
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
   
    public function excluir($id) {

        $this->initConBanco();


        $query = "DELETE GA_PL_PREVENT WHERE ID_PL_PREVENT = $id";
        //print_r($query); exit();
        $resultado = $this->conBanco->query($query);

        if ($resultado == true || $resultado == 1) {

            $query = "DELETE GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = $id";
            $resultado = $this->conBanco->query($query);

            if ($resultado == true || $resultado == 1) {

                $query = "DELETE GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = $id";
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    
                    $query = "DELETE GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = $id";
                    $resultado = $this->conBanco->query($query);

                    if ($resultado == true || $resultado == 1) {
                        return true;

                    } else {
                        return false;
                    }
                    
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }

    
     public function carregarEquipamento(){
        
        $this->initConBanco();
        
             
            $query = "SELECT * FROM GA_EQP_EQUIPAMENTO  WHERE ATIVO = 'S' ORDER BY DESCRICAO";

            //print_r($query);exit();
            
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $codEquipamento = $item->COD_EQUIPAMENTO;
                    $placa = $item->PLACA;
                    $html .= "<option value='$codEquipamento'>$placa</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhum Equipamento  Cadastrado</option>";
            }
       
        
    }
    
    
    public function carregarApelido($equipamento){
        
        $this->initConBanco();        
        

        if($equipamento != ""){
        
            $query = "SELECT ID_EQUIPAMENTO, DESCRICAO FROM GA_EQP_EQUIPAMENTO  WHERE COD_EQUIPAMENTO = '$equipamento' AND ATIVO = 'S'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {

                    $descricao = $rs[0]->DESCRICAO;
                    
                   
                

                return $descricao;
            } else {
                return "";
            }
        }
        
        
    }
    
     
    /////////// novos ajustes
    // AJUSTES PARA CARREGAR EM MODAL
    public function validarAddAtividade($id, $equipamento, $descricao) {

        $this->initConBanco();

    // VERIFICA SE O ID É NOVO
        $query = "SELECT * FROM GA_PL_PREVENT WHERE ID_PL_PREVENT = $id";

       // print_r($query);exit(); 
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
    // SE O ID NAO FOR NOVO, VERIFICA SE TEM CADASTRO COM O EQUIPAMENTO
        if (is_array($rs) && count($rs) != "") {

            return true;
            
    // SE O ID FOR NOVO, VERIFICA SE JA TEM CADASTRO DO EQUIPAMENTO        
        } else {

            $query = "SELECT * FROM GA_PL_PREVENT WHERE COD_EQUIPAMENTO = '$equipamento'";

            // print_r($query);exit(); 
             $cs = $this->conBanco->query($query);
             $rs = $cs->result();

            if (is_array($rs) && count($rs) == "") {
                //se nao existir cadastro com esse equipamento 
                return true;
                 
            }else{
               //se ja existir cadastro com esse equipamento 
                 return false; 
            }
             
        }    
    }

    public function addAtividade($id, $equipamento, $descricao){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT WHERE ID_PL_PREVENT = '$id'";
        
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) == ""){
        
        $query = "SELECT MAX(ID_ATIVIDADE) AS ID_ATIVIDADE FROM GA_PL_PREVENT_ATV_TMP WHERE ID_PL_PREVENT = '$id'";
                  // print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
           
            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ATIVIDADE + 1;
            }
            else{
                $novoId = 1;

            }

            
        }else{
           $query = "SELECT MAX(ID_ATIVIDADE) AS ID_ATIVIDADE FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id'";
               //    print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ATIVIDADE + 1;
            }
            else{
                $novoId = 1;

            }


            
        
        }   
    return $novoId; 
    
    }
    
    
    public function salvarAdicionarAtividade($id, $idAtividade, $intervencao , $descAtividade, $frequencia, $executor) {

        $this->initConBanco();

        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


        $query = "SELECT * FROM  GA_PL_PREVENT WHERE ID_PL_PREVENT = $id ";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        
        
        if (is_array($rs) && count($rs) > 0) {



            $query = "SELECT * FROM  GA_PL_PREVENT_ATV  WHERE ID_PL_PREVENT = $id  AND ID_ATIVIDADE = $idAtividade";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            if (is_array($rs) && count($rs) > 0) {


                $query = "UPDATE GA_PL_PREVENT_ATV SET INTERVENCAO = '$intervencao', DESC_ATIVIDADE = '$descAtividade', FREQUENCIA = '$frequencia', EXECUTOR = '$executor',  DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ";
                //print_r($query); exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {


                $query = "INSERT INTO GA_PL_PREVENT_ATV (ID_PL_PREVENT, ID_ATIVIDADE, INTERVENCAO, DESC_ATIVIDADE, FREQUENCIA, EXECUTOR, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, $idAtividade, '$intervencao', '$descAtividade', '$frequencia', '$executor', SYSDATE, '$usuarioLogado')";

                //print_r($query); exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            
        // SE FOR SALVA DE UMA NOVA INCLUSAO DE BOLETIM
            
        } else {


            $query = "SELECT * FROM  GA_PL_PREVENT_ATV_TMP  WHERE ID_PL_PREVENT = $id  AND ID_ATIVIDADE = $idAtividade";

           // print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            

            if (is_array($rs) && count($rs) > 0) {

                $query = "UPDATE GA_PL_PREVENT_ATV_TMP SET INTERVENCAO = '$intervencao', DESC_ATIVIDADE = '$descAtividade', FREQUENCIA = '$frequencia', EXECUTOR = '$executor',  DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ";
                 //print_r($query); exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
                
                
            } else {


                $query = "INSERT INTO GA_PL_PREVENT_ATV_TMP (ID_PL_PREVENT, ID_ATIVIDADE, INTERVENCAO, DESC_ATIVIDADE, FREQUENCIA, EXECUTOR, DATA_CADASTRO, USUARIO_CADASTRO)
                             VALUES ($id, $idAtividade, '$intervencao', '$descAtividade', '$frequencia', '$executor', SYSDATE, '$usuarioLogado')";
                //print_r($query); exit();
                $resultado = $this->conBanco->query($query);
                
                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
    
    
    public function getAdicionarAtividade($idAdicionarModal, $idAtividade) {

        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT WHERE ID_PL_PREVENT =  '$idAdicionarModal'";

       // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            


            $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT =  '$idAdicionarModal' ORDER BY ID_ATIVIDADE";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Intervenção</td>
                        <td  style='width: 6%; padding-right: 5px;font-size: 14px;'>Atividade</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Frequência</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Executor</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'></td>
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                

                $idAtividade = $j;

                $intervencao  = $j;
                $intervencao .= "_";
                $intervencao .= $j;
                
                $descAtividade  = $j;
                $descAtividade .= "_";
                $descAtividade .= $j;
                $descAtividade .= "_";
                $descAtividade .= $j;
                
                $frequencia  = $j;
                $frequencia .= "_";
                $frequencia .= $j;
                $frequencia .= "_";
                $frequencia .= $j;
                $frequencia .= "_";
                $frequencia .= $j;
                
                $executor  = $j;
                $executor .= "_";
                $executor .= $j;
                $executor .= "_";
                $executor .= $j;
                $executor .= "_";
                $executor .= $j;
                $executor .= "_";
                $executor .= $j;
                
                
                $idAtividadeValor = $item->ID_ATIVIDADE;
                $intervencaoValor = $item->INTERVENCAO;
                $descAtividadeValor = $item->DESC_ATIVIDADE;
                $frequenciaValor = $item->FREQUENCIA;
                $executorValor = $item->EXECUTOR;
                


                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; padding-botton: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 2px;'><a onclick='editarAtividade($idAdicionarModal, $idAtividadeValor)' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span>  Editar Atividade </a></td>
                        <td  style='width: 5%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$idAtividade'   value='$idAtividadeValor' readonly></div></td>
                        <td  style='width: 15%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$intervencao'   value='$intervencaoValor' readonly></div></td>
                        <td  style='width: 15%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$descAtividade'   value='$descAtividadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 2px;'><div class='form'><input  type='number' class='form-control' style='font-size: 14px;' id='$frequencia'   value='$frequenciaValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$executor'   value='$executorValor' readonly></div></td>
                        <td  style='width: 5%;  padding-right: 2px;'><a onclick='addItem($idAdicionarModal, $idAtividadeValor)' class='btn btn-primary'><span class='fa fa-plus-square'></span>  Adicionar Item </a></td>
                        <td  style='width: 5%;  padding-right: 2px;'><a onclick='adicionarListaAtividades ($idAdicionarModal, $idAtividadeValor)' class='btn btn-primary'><span class='glyphicon glyphicon-file'></span>  Atividades </a></td>




                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }else{
        
            $query = "SELECT * FROM GA_PL_PREVENT_ATV_TMP WHERE ID_PL_PREVENT =  '$idAdicionarModal' ORDER BY ID_ATIVIDADE";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Intervenção</td>
                        <td  style='width: 6%; padding-right: 5px;font-size: 14px;'>Atividade</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Frequência</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Executor</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'></td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'></td>
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                

                $idAtividade = $j;

                $intervencao  = $j;
                $intervencao .= "_";
                $intervencao .= $j;
                
                $descAtividade  = $j;
                $descAtividade .= "_";
                $descAtividade .= $j;
                $descAtividade .= "_";
                $descAtividade .= $j;
                
                $frequencia  = $j;
                $frequencia .= "_";
                $frequencia .= $j;
                $frequencia .= "_";
                $frequencia .= $j;
                $frequencia .= "_";
                $frequencia .= $j;
                
                $executor  = $j;
                $executor .= "_";
                $executor .= $j;
                $executor .= "_";
                $executor .= $j;
                $executor .= "_";
                $executor .= $j;
                $executor .= "_";
                $executor .= $j;
                
                
                $idAtividadeValor = $item->ID_ATIVIDADE;
                $intervencaoValor = $item->INTERVENCAO;
                $descAtividadeValor = $item->DESC_ATIVIDADE;
                $frequenciaValor = $item->FREQUENCIA;
                $executorValor = $item->EXECUTOR;
                

                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; padding-botton: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 5%;  padding-right: 2px;'><a onclick='editarAtividade($idAdicionarModal, $idAtividadeValor)' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span>  Editar Atividade </a></td>
                        <td  style='width: 5%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$idAtividade'   value='$idAtividadeValor' readonly></div></td>
                        <td  style='width: 15%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$intervencao'   value='$intervencaoValor' readonly></div></td>
                        <td  style='width: 15%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$descAtividade'   value='$descAtividadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 2px;'><div class='form'><input  type='number' class='form-control' style='font-size: 14px;' id='$frequencia'   value='$frequenciaValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 14px;' id='$executor'   value='$executorValor' readonly></div></td>
                        <td  style='width: 5%;  padding-right: 2px;'><a onclick='addItem($idAdicionarModal, $idAtividadeValor)' class='btn btn-primary'><span class='fa fa-plus-square'></span>  Adicionar Item </a></td>
                        <td  style='width: 5%;  padding-right: 2px;'><a onclick='adicionarListaAtividades($idAdicionarModal, $idAtividadeValor)' class='btn btn-primary'><span class='glyphicon glyphicon-file'></span>  Atividades </a></td>




                  </tr>";
            }


            return $html;
        }

            
    }
    
    
    public function editarAtividade($id, $idAtividade){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = '$idAtividade'";
        //     print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                    
        $obj = array();

        if (is_array($rs) && count($rs) > 0){
                
            
            $obj[] = $rs[0]->ID_PL_PREVENT;
            $obj[] = $rs[0]->ID_ATIVIDADE;
            $obj[] = $rs[0]->INTERVENCAO;
            $obj[] = $rs[0]->DESC_ATIVIDADE;
            $obj[] = $rs[0]->FREQUENCIA;
            $obj[] = $rs[0]->EXECUTOR;
            
            
            return json_encode($obj);
        
            
        }else{
            
            $query = "SELECT * FROM GA_PL_PREVENT_ATV_TMP WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = '$idAtividade'";
            //     print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){
                
            
                $obj[] = $rs[0]->ID_PL_PREVENT;
                $obj[] = $rs[0]->ID_ATIVIDADE;
                $obj[] = $rs[0]->INTERVENCAO;
                $obj[] = $rs[0]->DESC_ATIVIDADE;
                $obj[] = $rs[0]->FREQUENCIA;
                $obj[] = $rs[0]->EXECUTOR;


                return json_encode($obj);


            }else{
                return false;
            } 
        }  
    }  
    
    
    
    public function salvarAtividadeEditar($id, $idAtividade, $intervencao , $descAtividade, $frequencia, $executor){
        
        $this->initConBanco();
       
        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


        $query = "SELECT * FROM  GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = $id  AND ID_ATIVIDADE = $idAtividade";
        
        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         

        if (is_array($rs) && count($rs) > 0){  
            
           
            $query = "UPDATE GA_PL_PREVENT_ATV SET INTERVENCAO = '$intervencao', DESC_ATIVIDADE = '$descAtividade', FREQUENCIA = '$frequencia', EXECUTOR = '$executor',  DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ";
            //print_r($query);exit();
            $resultado = $this->conBanco->query($query);
                
            if($resultado == true || $resultado == 1){
                return true;            
            }
            else{
                return false;
            }
        }
        
        
        /// SENAO NAO ENCONTRAR NA TABELA PRINCIPAL PARA ATUALIZAR, ELE VAI PROCURAR NA TABELA TEMPORARIA
        else{
            
            $query = "SELECT * FROM  GA_PL_PREVENT_ATV_TMP  WHERE ID_PL_PREVENT = $id  AND ID_ATIVIDADE = $idAtividade";
        
            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            if (is_array($rs) && count($rs) > 0){  

               
                $query = "UPDATE GA_PL_PREVENT_ATV_TMP SET INTERVENCAO = '$intervencao', DESC_ATIVIDADE = '$descAtividade', FREQUENCIA = '$frequencia', EXECUTOR = '$executor',  DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ";
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if($resultado == true || $resultado == 1){
                    return true;            
                
                    
                }else{
                    return false;
                }
            
            
            
            }else{
                return false;
            }
        }    
            
    }
    
    
    public function excluirAtividadeEditar($id, $idAtividade){
        
        $this->initConBanco();        
        
         $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
        if (is_array($rs) && count($rs) > 0) {
            
            
            $query = "DELETE GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' ";
            // print_r($query);exit();
             $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
            
                $query = "DELETE GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' ";
                // print_r($query);exit();
                 $resultado = $this->conBanco->query($query);

                if($resultado == true || $resultado == 1){

                       $query = "DELETE GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' ";
                        // print_r($query);exit();
                         $resultado = $this->conBanco->query($query);

                        if($resultado == true || $resultado == 1){

                               return true;


                        } else {
                            return false;
                        }
                       
                   
                } else {
                    return false;
                }
                
            } else {
                return false;
            }
            
            
            
        }else{
            
            $query = "DELETE GA_PL_PREVENT_ATV_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' ";
            // print_r($query);exit();
             $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
            
                $query = "DELETE GA_PL_PREVENT_ITEM_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' ";
                // print_r($query);exit();
                 $resultado = $this->conBanco->query($query);

                if($resultado == true || $resultado == 1){

                       $query = "DELETE GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' ";
                        // print_r($query);exit();
                         $resultado = $this->conBanco->query($query);

                        if($resultado == true || $resultado == 1){

                               return true;


                        } else {
                            return false;
                        }
                       
                   
                } else {
                    return false;
                }
                
            } else {
                return false;
            }
           
        }
        
      
    
    }
    
    
    public function limparTabelaTmp(){
        
        $this->initConBanco();        
        
        $query = "DELETE GA_PL_PREVENT_ATV_TMP";
        // print_r($query);exit();
        $resultado = $this->conBanco->query($query);

        if($resultado == true || $resultado == 1){
            
            $query = "DELETE GA_PL_PREVENT_ITEM_TMP";
            // print_r($query);exit();
            $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
                
                $query = "DELETE GA_PL_PREVENT_ATV_DESC_TMP";
                // print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if($resultado == true || $resultado == 1){

                    return true;

                } else {
                        return false;
                }
                   
            } else {
                    return false;
            }
            
        } else {
                    return false;
            }   
      
    
    }  
    
    
    public function getNumeroLinhas($id) {

        $this->initConBanco();

        $query = "SELECT COUNT(*) AS TOTAL FROM GA_PL_PREVENT_ATV_TMP WHERE ID_PL_PREVENT = '$id'";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $totalTemp = $rs[0]->TOTAL;

        } else {
            $totalTemp = 0;
        }
        
        $query = "SELECT COUNT(*) AS TOTAL FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id'";

        //print_r($query);exit();

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();


        if (is_array($rs) && count($rs) > 0) {

            $totalSalvo = $rs[0]->TOTAL;

           
        } else {
            $totalSalvo = 0;
        }
        
        $total = $totalTemp + $totalSalvo;
        
         return $total;
    }
    
    
    public function consultar($equipamento){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT WHERE COD_EQUIPAMENTO = '$equipamento'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
       
        $obj = array();
        
        if (is_array($rs) && count($rs) > 0){
           
            $obj[] = $rs[0]->ID_PL_PREVENT;
            $obj[] = $rs[0]->COD_EQUIPAMENTO;
            $obj[] = $rs[0]->DESC_EQUIPAMENTO;
            $obj[] = $rs[0]->CHECKLIST;
            $obj[] = $rs[0]->ATIVIDADE;
            
            
            
            $id = $rs[0]->ID_PL_PREVENT;
            
            $query = "SELECT count(*) as TOTAL FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id'";
        
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            
            $obj[] = $rs[0]->TOTAL;
                  
               
            return json_encode($obj);
        }
        else{
            return false;
        }
    }
    
    
    /////////////////// ADICIONAR ITEM ///////////////////////
    
    
    
    public function addItem($id, $idAtividade){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
        //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) == ""){
        
        $query = "SELECT MAX(ID_ITEM) AS ID_ITEM FROM GA_PL_PREVENT_ITEM_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                   //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
           
            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ITEM + 1;
            }
            else{
                $novoId = 1;

            }

            
        }else{
           $query = "SELECT MAX(ID_ITEM) AS ID_ITEM FROM GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                 //  print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ITEM + 1;
            }
            else{
                $novoId = 1;

            }


            
        
        }   
    //return $novoId; 
    return json_encode($novoId);
    }
    
    
    public function carregarItem(){
        
        $this->initConBanco();
        
        

        $query = "SELECT * FROM GA_SUP_ITEM WHERE ATIVO = 'S' ORDER BY DESC_ITEM ";
        
        
        $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {


                foreach ($rs as $item) {

                    $codItem = $item->COD_ITEM;
                    $descItem = $item->DESC_ITEM;
                    $html .= "<option value='$codItem'>$descItem</option>";
                }

                return $html;
            } else {
                return "<option value='0'>Nenhum Item Cadastrado</option>";
            }
        
    } 
    
    public function carregarUnidadeMedida($item){
        
        $this->initConBanco();        
        
        // print_r($item);exit();   
        if($item != ""){
        
            $query = "SELECT T2.DENOMINACAO FROM GA_SUP_ITEM T1
                    INNER JOIN GA_SUP_UNIDADE_MEDIDA T2
                    ON T1.UNIDADE_MEDIDA = T2.ID
                    WHERE T1.COD_ITEM = '$item'";

            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $html = "<option value='0'>Selecione</option>";

            if (is_array($rs) && count($rs) > 0) {

                    $descricao = $rs[0]->DENOMINACAO;
                    
                   
                

                return $descricao;
            } else {
                return "";
            }
        }
        
        
    }
    
    public function validarSalvarItem($id, $idAtividade, $idItemModal, $item) {

        $this->initConBanco();

        // VERIFICA SE O ITEM ESTA NA TABELA TMP OU NAO 
        $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE ID_ATIVIDADE = $idAtividade";

        //print_r($query);exit(); 
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        // SE ITEM NAO ESTIVER NA TABELA TMP   
        // 
        // SE O FOR NOVO,
        if (is_array($rs) && count($rs) != "") {
            
            $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE COD_ITEM = '$item' AND ID_ATIVIDADE = $idAtividade AND ID_PL_PREVENT = '$id' ";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            if (is_array($rs) && count($rs) == "") {

                // RETORNA POSITIVO
                return true;
            
                
            } else {

                // SE O ITEM NAO FOR NOVO, 
                // VERIFICA SE O ID É NOVO             
                $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE ID_ITEM = $idItemModal AND ID_ATIVIDADE = $idAtividade";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                if (is_array($rs) && count($rs) == "") {

                    // RETORNA ERRO, ITEM USADO NAO PODE SER SE TIVER REGISTRO EM TABELA  
                    return false;
                } else {
                    // SE O ID NAO FOR NOVO, RETORNA POSITIVO   
                    return true;
                }
                 
                
            }


            // VERIFICA SE O ID ESTA NA TABELA TMP            
        } else {

            $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE COD_ITEM = '$item' AND ID_ATIVIDADE = $idAtividade";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();
            if (is_array($rs) && count($rs) == "") {

                // RETORNA POSITIVO
                return true;
            } else {

                // SE O ITEM NAO FOR NOVO, 
                // VERIFICA SE O ID É NOVO             
                $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE ID_ITEM = $idItemModal AND ID_ATIVIDADE = $idAtividade";

                //print_r($query);exit();
                $cs = $this->conBanco->query($query);
                $rs = $cs->result();
                if (is_array($rs) && count($rs) == "") {

                    // RETORNA ERRO, ITEM USADO NAO PODE SER SE TIVER REGISTRO EM TABELA  
                    return false;
                } else {
                    // SE O ID NAO FOR NOVO, RETORNA POSITIVO   
                    return true;
                }
                
            }
        }
    }

    public function salvarItem($id, $idAtividade, $idItemModal, $item, $unidadeMedida, $quantidade, $observacao) {

        $this->initConBanco();
        
        

// VERIFICA SE A ATIVIDADE EM QUESTAO, ESTA SALVA NA TABELA TEMPORARIA OU NAO.
        $query = "SELECT * FROM  GA_PL_PREVENT_ATV  WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade";

       // print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


// SE A ATIVIDADE ESTIVER SALVA NA TABELA FINAL (NAO TEMPORARIO)
        if (is_array($rs) && count($rs) != "") {


            $query = "SELECT * FROM  GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND COD_ITEM = '$item'";

            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {



                $query = "UPDATE GA_PL_PREVENT_ITEM SET COD_ITEM = '$item', UNIDADE_MEDIDA = '$unidadeMedida', QUANTIDADE = '$quantidade', OBSERVACAO = '$observacao', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND ID_ITEM = $idItemModal";
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {


                $query = "INSERT INTO GA_PL_PREVENT_ITEM (ID_PL_PREVENT, ID_ATIVIDADE, ID_ITEM, COD_ITEM, UNIDADE_MEDIDA, QUANTIDADE, OBSERVACAO, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $idAtividade, $idItemModal, '$item', '$unidadeMedida', '$quantidade', '$observacao', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            
// SE A ATIVIDADE ESTIVER SALVA NA TABELA TEMPORARIO. (TEMPORARIO)            
        } else {

            $query = "SELECT * FROM  GA_PL_PREVENT_ITEM_TMP WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND COD_ITEM = '$item'";

            //print_r($query);
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {



                $query = "UPDATE GA_PL_PREVENT_ITEM_TMP SET COD_ITEM = '$item', UNIDADE_MEDIDA = '$unidadeMedida', QUANTIDADE = '$quantidade', OBSERVACAO = '$observacao', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND ID_ITEM = $idItemModal";
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {


                $query = "INSERT INTO GA_PL_PREVENT_ITEM_TMP (ID_PL_PREVENT, ID_ATIVIDADE, ID_ITEM, COD_ITEM, UNIDADE_MEDIDA, QUANTIDADE, OBSERVACAO, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $idAtividade, $idItemModal, '$item', '$unidadeMedida', '$quantidade', '$observacao', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
    
    public function getAdicionarItem($id, $idAtividade, $idItemModal) {

        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = $idAtividade";

       // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            


            $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ORDER BY ID_ITEM";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Item</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Unidade Medida</td>
                        <td  style='width: 6%; padding-right: 5px;font-size: 14px;'>Quantidade</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Observacao</td>
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                $idItemModalModal = $j;

                $itemItem = $j;
                $itemItem .= "_";
                $itemItem .= $j;

                $unidadeMedida  = $j;
                $unidadeMedida .= "_";
                $unidadeMedida .= $j;
                $unidadeMedida .= "_";
                $unidadeMedida .= $j;
                
                $quantidade  = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;
                 $quantidade .= "_";
                $quantidade .= $j;
                
                $observacao  = $j;
                $observacao .= "_";
                $observacao .= $j;
                $observacao .= "_";
                $observacao .= $j;
                $observacao .= "_";
                $observacao .= $j;
                $observacao .= "_";
                $observacao .= $j;
                
                
                $idItemModalValor = $item->ID_ITEM;
                $itemValor = $item->COD_ITEM;
                $unidadeMedidaValor = $item->UNIDADE_MEDIDA;
                $quantidadeValor = $item->QUANTIDADE;
                $observacaoValor = $item->OBSERVACAO;
                
                



               $query = "SELECT DESC_ITEM FROM GA_SUP_ITEM  WHERE COD_ITEM = '$itemValor'";


                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $descricaoItem = $rs[0]->DESC_ITEM;




                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItem($id, $idAtividade, $idItemModalValor)' readonly ></button></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$idItemModalModal'   value='$idItemModalValor' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$itemItem'   value='$descricaoItem' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$unidadeMedida'   value='$unidadeMedidaValor' readonly></div></td>
                        <td  style='width: 6%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$quantidade'   value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$observacao'   value='$observacaoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }else{
        
            $query = "SELECT * FROM GA_PL_PREVENT_ITEM_TMP WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ORDER BY ID_ATIVIDADE";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Item</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Unidade Medida</td>
                        <td  style='width: 6%; padding-right: 5px;font-size: 14px;'>Quantidade</td>
                        <td  style='width: 10%; padding-right: 5px;font-size: 14px;'>Observacao</td>
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                

                $idItemModalModal = $j;

                $itemItem = $j;
                $itemItem .= "_";
                $itemItem .= $j;

                $unidadeMedida  = $j;
                $unidadeMedida .= "_";
                $unidadeMedida .= $j;
                $unidadeMedida .= "_";
                $unidadeMedida .= $j;
                
                $quantidade  = $j;
                $quantidade .= "_";
                $quantidade .= $j;
                $quantidade .= "_";
                $quantidade .= $j;
                 $quantidade .= "_";
                $quantidade .= $j;
                
                $observacao  = $j;
                $observacao .= "_";
                $observacao .= $j;
                $observacao .= "_";
                $observacao .= $j;
                $observacao .= "_";
                $observacao .= $j;
                $observacao .= "_";
                $observacao .= $j;
                
                
                $idItemModalValor = $item->ID_ITEM;
                $itemValor = $item->COD_ITEM;
                $unidadeMedidaValor = $item->UNIDADE_MEDIDA;
                $quantidadeValor = $item->QUANTIDADE;
                $observacaoValor = $item->OBSERVACAO;
                
                



               $query = "SELECT DESC_ITEM FROM GA_SUP_ITEM  WHERE COD_ITEM = '$itemValor'";


                $cs = $this->conBanco->query($query);
                $rs = $cs->result();

                $descricaoItem = $rs[0]->DESC_ITEM;




                $html .="<tr  style='width: 100%; padding-right: 5px; font-size: 14px;' align='center' >
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarItem($id, $idAtividade, $idItemModalValor)' readonly ></button></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$idItemModalModal'   value='$idItemModalValor' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$itemItem'   value='$descricaoItem' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$unidadeMedida'   value='$unidadeMedidaValor' readonly></div></td>
                        <td  style='width: 6%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$quantidade'   value='$quantidadeValor' readonly></div></td>
                        <td  style='width: 10%; padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$observacao'   value='$observacaoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;
        }

            
    }
    
    
    public function novoItem($id, $idAtividade){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
        //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) == ""){
        
        $query = "SELECT MAX(ID_ITEM) AS ID_ITEM FROM GA_PL_PREVENT_ITEM_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                   //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
           
            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ITEM + 1;
            }
            else{
                $novoId = 1;

            }

            
        }else{
           $query = "SELECT MAX(ID_ITEM) AS ID_ITEM FROM GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                 //  print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ITEM + 1;
            }
            else{
                $novoId = 1;

            }


            
        
        }   
    
    return json_encode($novoId);
    }
    
    
    public function editarItem($id, $idAtividade, $idItemModal){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ITEM = '$idItemModal'";
        //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                    
        $obj = array();

        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[0]->ID_ITEM;
            
            $obj[] = $rs[0]->UNIDADE_MEDIDA;
            $obj[] = $rs[0]->QUANTIDADE;
            $obj[] = $rs[0]->OBSERVACAO;
            
            $obj[] = $rs[0]->COD_ITEM;
            
            
            return json_encode($obj);
        
            
        }else{
            
            $query = "SELECT * FROM GA_PL_PREVENT_ITEM_TMP WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ITEM = '$idItemModal'";
            // print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){


                $obj[] = $rs[0]->ID_ITEM;
                $obj[] = $rs[0]->UNIDADE_MEDIDA;
                $obj[] = $rs[0]->QUANTIDADE;
                $obj[] = $rs[0]->OBSERVACAO;

                $obj[] = $rs[0]->CODITEM;
                
//             

            }else{
                return false;
            } 
        }  
    }
    
    
    public function excluirItem($id, $idAtividade, $idItemModal){
        
        $this->initConBanco();        
        
         $query = "SELECT * FROM GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ITEM = '$idItemModal'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
        if (is_array($rs) && count($rs) > 0) {
            
            
            $query = "DELETE GA_PL_PREVENT_ITEM WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ITEM = '$idItemModal' ";
            // print_r($query);exit();
             $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
            
                   return true;
                   
            } else {
                    return false;
            }
            
            
            
        }else{
            
            $query = "DELETE GA_PL_PREVENT_ATV_ITEM_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ITEM = '$idItemModal' ";
            // print_r($query);exit();
             $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
            
                   return true;
                   
            } else {
                    return false;
            }
            
                
           
        }
        
      
    
    }
    
    //// adicionar atividades
    
    public function adicionarListaAtividades($id, $idAtividade){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
        //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) == ""){
        
        $query = "SELECT MAX(ID_ATIVIDADE_DESC) AS ID_ATIVIDADE_DESC FROM GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                   //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
           
            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ATIVIDADE_DESC + 1;
            }
            else{
                $novoId = 1;

            }

            
        }else{
           $query = "SELECT MAX(ID_ATIVIDADE_DESC) AS ID_ATIVIDADE_DESC FROM GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                 //  print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ATIVIDADE_DESC + 1;
            }
            else{
                $novoId = 1;

            }


            
        
        }   
    //return $novoId; 
    return json_encode($novoId);
    }
    
    
    
    
    public function getAdicionarAtividadesDescricao($id, $idAtividade, $idDescricaoModal) {

        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = $idAtividade";

        //print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            


            $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ORDER BY ID_ATIVIDADE_DESC";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Atividade Descrição</td>
                        
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                $idDescricaoModalModal = $j;

                $atividadeDescricao  = $j;
                $atividadeDescricao .= "_";
                $atividadeDescricao .= $j;

                
                
                $idDescricaoModalValor = $item->ID_ATIVIDADE_DESC;
                $atividadeDescricaoValor = $item->DESC_ATIVIDADE;
                
                
                



                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarAtividadeDescricao($id, $idAtividade, $idDescricaoModalValor)' readonly ></button></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$idDescricaoModalModal'   value='$idDescricaoModalValor' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$atividadeDescricao'   value='$atividadeDescricaoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }else{
        
            $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ORDER BY ID_ATIVIDADE_DESC";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Atividade Descrição</td>
                        
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                $idDescricaoModalModal = $j;

                $atividadeDescricao  = $j;
                $atividadeDescricao .= "_";
                $atividadeDescricao .= $j;

                
                
                $idDescricaoModalValor = $item->ID_ATIVIDADE_DESC;
                $atividadeDescricaoValor = $item->DESC_ATIVIDADE;
                
                
                



                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarAtividadeDescricao($id, $idAtividade, $idDescricaoModalValor)' readonly ></button></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$idDescricaoModalModal'   value='$idDescricaoModalValor' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$atividadeDescricao'   value='$atividadeDescricaoValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;

        }

            
    }
    
    public function novoAtividadesDescricao($id, $idAtividade){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
        //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        if (is_array($rs) && count($rs) == ""){
        
        $query = "SELECT MAX(ID_ATIVIDADE_DESC) AS ID_ATIVIDADE_DESC FROM GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                   //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
           
            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ATIVIDADE_DESC + 1;
            }
            else{
                $novoId = 1;

            }

            
        }else{
           $query = "SELECT MAX(ID_ATIVIDADE_DESC) AS ID_ATIVIDADE_DESC FROM GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade'";
                 //  print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            if(count($rs) > 0){
                $novoId = $rs[0]->ID_ATIVIDADE_DESC + 1;
            }
            else{
                $novoId = 1;

            }


            
        
        }   
    
    return json_encode($novoId);
    }
    
    
    public function salvarAtividadesDescricao($id, $idAtividade, $idDescricaoModal , $descricaoAtividades) {

        $this->initConBanco();
        
        

// VERIFICA SE A ATIVIDADE EM QUESTAO, ESTA SALVA NA TABELA TEMPORARIA OU NAO.
        $query = "SELECT * FROM  GA_PL_PREVENT_ATV  WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade";

       // print_r($query); exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $usuarioLogado = "TESTE SISTEMA"; // IMPLEMENTAR A FUNÇÃO PRA PEGAR O USUÁRIO LOGADO


// SE A ATIVIDADE ESTIVER SALVA NA TABELA FINAL (NAO TEMPORARIO)
        if (is_array($rs) && count($rs) != "") {


            $query = "SELECT * FROM  GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND ID_ATIVIDADE_DESC = '$idDescricaoModal'";

            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {



                $query = "UPDATE GA_PL_PREVENT_ATV_DESC SET DESC_ATIVIDADE = '$descricaoAtividades', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND ID_ATIVIDADE_DESC = $idDescricaoModal";
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {


                $query = "INSERT INTO GA_PL_PREVENT_ATV_DESC (ID_PL_PREVENT, ID_ATIVIDADE, ID_ATIVIDADE_DESC, DESC_ATIVIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $idAtividade, $idDescricaoModal, '$descricaoAtividades', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            
// SE A ATIVIDADE ESTIVER SALVA NA TABELA TEMPORARIO. (TEMPORARIO)            
        } else {

            $query = "SELECT * FROM  GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND ID_ATIVIDADE_DESC = '$idDescricaoModal'";

            //print_r($query); exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();



            if (is_array($rs) && count($rs) > 0) {



                $query = "UPDATE GA_PL_PREVENT_ATV_DESC_TMP SET DESC_ATIVIDADE = '$descricaoAtividades', DATA_ALTERACAO = SYSDATE, USUARIO_ALTERACAO = '$usuarioLogado' WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade AND ID_ATIVIDADE_DESC = $idDescricaoModal";
                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {


                $query = "INSERT INTO GA_PL_PREVENT_ATV_DESC_TMP (ID_PL_PREVENT, ID_ATIVIDADE, ID_ATIVIDADE_DESC, DESC_ATIVIDADE, DATA_CADASTRO, USUARIO_CADASTRO)
                                 VALUES ($id, $idAtividade, $idDescricaoModal, '$descricaoAtividades', SYSDATE, '$usuarioLogado')";

                //print_r($query);exit();
                $resultado = $this->conBanco->query($query);

                if ($resultado == true || $resultado == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
    
    
     public function getAdicionarAtividadeDescricao($id, $idAtividade, $idDescricaoModal) {

        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = $idAtividade";

       // print_r($query);exit();
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
        
        
        
        if (is_array($rs) && count($rs) > 0){
            


            $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ORDER BY ID_ATIVIDADE_DESC";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Atividade Descrição</td>
                        
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                $idDescricaoModalModal = $j;

                $descricaoAtividades = $j;
                $descricaoAtividades .= "_";
                $descricaoAtividades .= $j;

                
                
                
                $idItemModalValor = $item->ID_ATIVIDADE_DESC;
                $descricaoAtividadesValor = $item->DESC_ATIVIDADE;
                
                

                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarAtividadeDescricao($id, $idAtividade, $idItemModalValor)' readonly ></button></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$idDescricaoModalModal'   value='$idItemModalValor' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$descricaoAtividades'   value='$descricaoAtividadesValor' readonly></div></td>
                        



                  </tr>";
            }


            return $html;


            /// CARREGA TABELA TEMPORARIA DE ITENS INSERIDOS NOVO 
        }else{
        
            $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = $id AND ID_ATIVIDADE = $idAtividade ORDER BY ID_ATIVIDADE_DESC";

            //print_r($query);exit();
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();


            $html = "";

            $html .="<tr  style='width: 10%; padding-right: 5px; ' align='center' >
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Editar</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Seq.</td>
                        <td  style='width: 4%; padding-right: 5px;font-size: 14px;'>Atividade Descrição</td>
                        
                        
                    </tr>";


            $j = 0;

            foreach ($rs as $item) {

                //print_r($i);exit();

                $id = $j;
                $j = $j + 1;

                $idDescricaoModalModal = $j;

                $descricaoAtividades = $j;
                $descricaoAtividades .= "_";
                $descricaoAtividades .= $j;

                
                
                
                $idItemModalValor = $item->ID_ATIVIDADE_DESC;
                $descricaoAtividadesValor = $item->DESC_ATIVIDADE;
                
                

                $html .="<tr  style='width: 100%; padding-right: 5px; padding-top: 2px; font-size: 14px;' align='center' >
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><button type='button' class='btn btn-primary   glyphicon glyphicon-new-window' onclick='editarAtividadeDescricao($id, $idAtividade, $idItemModalValor)' readonly ></button></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$idDescricaoModalModal'   value='$idItemModalValor' readonly></div></td>
                        <td  style='width: 4%;  padding-right: 2px;'><div class='form'><input  type='text' class='form-control' style='font-size: 12px;' id='$descricaoAtividades'   value='$descricaoAtividadesValor' readonly></div></td>
                        
 


                  </tr>";
            }


            return $html;
        }

            
    }
    
    
    public function editarAtividadeDescricao($id, $idAtividade,  $idItemModalValor){
        
        $this->initConBanco();
        
        $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ATIVIDADE_DESC = '$idItemModalValor'";
        //print_r($query);exit();     
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
                    
        $obj = array();

        if (is_array($rs) && count($rs) > 0){
            
            
            $obj[] = $rs[0]->ID_ATIVIDADE_DESC;
            $obj[] = $rs[0]->DESC_ATIVIDADE;
            
            
            
            return json_encode($obj);
        
            
        }else{
            
            $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT =  '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ATIVIDADE_DESC = '$idItemModalValor'";
            // print_r($query);exit();     
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $obj = array();

            if (is_array($rs) && count($rs) > 0){


                $obj[] = $rs[0]->ID_ATIVIDADE_DESC;
                $obj[] = $rs[0]->DESC_ATIVIDADE;
                
//             

            }else{
                return false;
            } 
        }  
    }
    
    
    public function excluirAtividadesDescricao($id, $idAtividade, $idDescricaoModal){
        
        $this->initConBanco();        
        
         $query = "SELECT * FROM GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ATIVIDADE_DESC = '$idDescricaoModal'";
        
        $cs = $this->conBanco->query($query);
        $rs = $cs->result();
         
        if (is_array($rs) && count($rs) > 0) {
            
            
            $query = "DELETE GA_PL_PREVENT_ATV_DESC WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ATIVIDADE_DESC = '$idDescricaoModal' ";
             //print_r($query);exit();
             $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
            
                   return true;
                   
            } else {
                    return false;
            }
            
            
            
        }else{
            
            $query = "DELETE GA_PL_PREVENT_ATV_DESC_TMP WHERE ID_PL_PREVENT = '$id' AND ID_ATIVIDADE = '$idAtividade' AND ID_ATIVIDADE_DESC = '$idDescricaoModal' ";
            // print_r($query);exit();
             $resultado = $this->conBanco->query($query);

            if($resultado == true || $resultado == 1){
            
                   return true;
                   
            } else {
                    return false;
            }
            
                
           
        }
        
      
    
    }
    
    
    
    
    

}   




