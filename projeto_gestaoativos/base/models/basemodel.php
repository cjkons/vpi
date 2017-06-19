<?php

class basemodel extends CI_Model {

    private $conBanco;

    public function __construct() {
        parent::__construct();
    }

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("engsys", TRUE);
        }
    }

    public function getUsuarioLogado() {
        $this->load->library("access");

        return $this->access->getUsuarioLogado();
    }

    //

    public function getIdUsuarioLogado() {
        return $this->getUsuarioLogado()->ID;
    }

    public function isProgramaFavorito($idConteudo) {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;

        $query = "SELECT COUNT(*) AS TOTAL FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND ID_CONTEUDO = '$idConteudo'";
        $consulta = $this->conBanco->query($query);

        $rs = $consulta->result();

        if ($rs[0]->TOTAL == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function alterarFavoritacaoPrograma($nomeAba, $nomePrograma, $idConteudo, $controllerChamado, $enderecoIcone) {

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;

        $this->initConBanco();

        $query = "SELECT COUNT(*) AS TOTAL FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND NOME_ABA = '$nomeAba' AND NOME_PROGRAMA = '$nomePrograma' AND ID_CONTEUDO = '$idConteudo' AND CONTROLLER_CHAMADO = '$controllerChamado'";
        $consulta = $this->conBanco->query($query);

        $rs = $consulta->result();

        if ($rs[0]->TOTAL == 0) {
            // insere
            //pega o ultimo ID inserido
            $query = "SELECT MAX(ID) AS MAXIMO FROM DESKTOP";
            $consulta = $this->conBanco->query($query);
            $rs = $consulta->result();

            $novoId = $rs[0]->MAXIMO + 1;

            $query = "INSERT INTO DESKTOP (ID, ID_USUARIO, NOME_ABA, NOME_PROGRAMA, ID_CONTEUDO, CONTROLLER_CHAMADO, ENDERECO_ICONE) VALUES('$novoId','$idUsuarioLogado','$nomeAba','$nomePrograma','$idConteudo','$controllerChamado','$enderecoIcone')";
            $this->conBanco->query($query);
            // retorna que inseriu
            return true;
        } else {
            // deleta
            $query = "DELETE FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND NOME_ABA = '$nomeAba' AND NOME_PROGRAMA = '$nomePrograma' AND ID_CONTEUDO = '$idConteudo' AND CONTROLLER_CHAMADO = '$controllerChamado'";
            $this->conBanco->query($query);
            //retorna que apagou
            return false;
        }
    }

    //

    public function getInformacoesUsuarioLogado() {

        $usuario = $this->getUsuarioLogado();

        return $usuario;
    }

    public function getNomeUsuarioLogado() {

        $usuario = $this->getUsuarioLogado();
        return $usuario->NOME_COMPLETO;
    }

    public function getNomeCompletoUsuarioLogado() {

        return $this->getNomeUsuarioLogado();
    }

    public function favoritaAba($nomeAba, $nomePrograma, $idConteudo, $controllerChamado, $enderecoIcone) {

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;

        $this->initConBanco();

        $query = "SELECT COUNT(*) AS TOTAL FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND NOME_ABA = '$nomeAba' AND NOME_PROGRAMA = '$nomePrograma' AND ID_CONTEUDO = '$idConteudo' AND CONTROLLER_CHAMADO = '$controllerChamado'";
        $consulta = $this->conBanco->query($query);

        $rs = $consulta->result();

        if ($rs[0]->TOTAL == 0) {
            // insere
            //pega o ultimo ID inserido
            $query = "SELECT MAX(ID) AS MAXIMO FROM DESKTOP";
            $consulta = $this->conBanco->query($query);
            $rs = $consulta->result();

            $novoId = $rs[0]->MAXIMO + 1;

            $query = "INSERT INTO DESKTOP (ID, ID_USUARIO, NOME_ABA, NOME_PROGRAMA, ID_CONTEUDO, CONTROLLER_CHAMADO, ENDERECO_ICONE) VALUES('$novoId','$idUsuarioLogado','$nomeAba','$nomePrograma','$idConteudo','$controllerChamado','$enderecoIcone')";
            $this->conBanco->query($query);
            // retorna que inseriu
            return 'adicionou';
        } else {
            // deleta
            $query = "DELETE FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND NOME_ABA = '$nomeAba' AND NOME_PROGRAMA = '$nomePrograma' AND ID_CONTEUDO = '$idConteudo' AND CONTROLLER_CHAMADO = '$controllerChamado'";
            $this->conBanco->query($query);
            //retorna que apagou
            return 'retirou';
        }
    }

    public function isAbaFavorita($nomeAba, $nomePrograma, $idConteudo, $controllerChamado, $enderecoIcone) {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;

        $query = "SELECT COUNT(*) AS TOTAL FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND NOME_ABA = '$nomeAba' AND NOME_PROGRAMA = '$nomePrograma' AND ID_CONTEUDO = '$idConteudo' AND CONTROLLER_CHAMADO = '$controllerChamado'";
        $consulta = $this->conBanco->query($query);

        $rs = $consulta->result();

        if ($rs[0]->TOTAL == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getIconesSalvos() {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;

        $query = "SELECT * FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' ORDER BY ID";
        
        //print_r($query);exit();
        
        
        $consulta = $this->conBanco->query($query);
        $rs = $consulta->result();

        return $rs;
    }

    public function removerFavorito($nomeAba) {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;

        $query = "DELETE FROM DESKTOP WHERE ID_USUARIO = '$idUsuarioLogado' AND NOME_ABA = '$nomeAba'";
        return $this->conBanco->query($query);
    }

    public function atualizaLocal($nomeAba, $x, $y) {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado();
        $idUsuarioLogado = $usuario->ID;
        
        $x = $x - 250;
        
        

        $query = "UPDATE DESKTOP SET X = '$x', Y = '$y' WHERE NOME_ABA = '$nomeAba' AND ID_USUARIO = '$idUsuarioLogado'";
        //print_r($query);
        return $this->conBanco->query($query);
    }

    //

    public function bloquearTela() {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado()->ID;

        $query = "UPDATE BLOQUEIO SET IS_BLOQUEADO = 'S' WHERE USUARIO = $usuario";

        return $this->conBanco->query($query);
    }

    public function desbloquearTela() {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado()->ID;

        $query = "UPDATE BLOQUEIO SET IS_BLOQUEADO = 'N' WHERE USUARIO = $usuario";

        return $this->conBanco->query($query);
    }

    public function isSecaoBloqueada() {

        $this->initConBanco();

        $usuario = $this->getUsuarioLogado()->ID;

        $query = "SELECT * FROM BLOQUEIO WHERE USUARIO = $usuario";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0 && $rs[0]->IS_BLOQUEADO == 'N') {
            return false;
        } else if (is_array($rs) && count($rs) == 0) {

            $query = "INSERT INTO BLOQUEIO (USUARIO, IS_BLOQUEADO) VALUES ($usuario, 'N')";
            $this->conBanco->query($query);

            return false;
        } else {

            return true;
        }
    }

//

    public function iniciarChat() {

        $this->initConBanco();

        $idUsuarioLogado = $this->getUsuarioLogado()->ID;

        $query = "SELECT COUNT(*) AS TOTAL FROM USUARIO_CHAT_STATUS WHERE ID_USUARIO = $idUsuarioLogado";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $hora = date('H:i:s');

        if ($rs[0]->TOTAL == 0) {
// insere um novo registro
            $query = "INSERT INTO USUARIO_CHAT_STATUS (ID_USUARIO, STATUS, IS_ATIVO, DATA, HORA) VALUES ($idUsuarioLogado, 'ONLINE','S',SYSDATE,'$hora')";
        } else {
            $query = "UPDATE USUARIO_CHAT_STATUS SET IS_ATIVO = 'S', DATA = SYSDATE, HORA = '$hora' WHERE ID_USUARIO = $idUsuarioLogado";
        }

        return $this->conBanco->query($query);
    }

    public function getListaUsuariosChat() {

        $this->initConBanco();

        $idUsuarioLogado = $this->getUsuarioLogado()->ID;

        $query = "SELECT ID_EMPRESA FROM CADASTRO_USUARIO WHERE ID = $idUsuarioLogado";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $idEmpresa = $rs[0]->ID_EMPRESA;

//**********************************************************************

        $query = "SELECT * FROM CADASTRO_USUARIO T1
                LEFT JOIN USUARIO_CHAT_STATUS T2 ON (T2.ID_USUARIO = T1.ID)
                WHERE 
                T1.IES_ATIVO = 'S'
                AND IES_ULTIMA_VERSAO = 'S'
                AND ID_EMPRESA = $idEmpresa
                AND T1.ID != $idUsuarioLogado";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {

            $html = "";

            foreach ($rs as $item) {

                if ($item->STATUS == 'ONLINE' && $item->IS_ATIVO == 'S') {
                    $classStatus = "chat-usuario-online";
                } else if ($item->STATUS == 'OCUPADO' && $item->IS_ATIVO == 'S') {
                    $classStatus = "chat-usuario-ocupado";
                } else {
                    $classStatus = "chat-usuario-offline";
                }

                $nome = $item->NOME;
                $id = $item->ID;
                $nomeCompleto = $item->NOME . ' ' . $item->SOBRENOME;

                $html .= "<a href='#' onclick='chatWith($id,\"$nome\")' class='list-group-item'><div class='$classStatus'> </div>  $nomeCompleto</a>";
            }

            return $html;
        }
    }

    public function getListaUsuariosChat_Opcoes() {

        $this->initConBanco();

        $idUsuarioLogado = $this->getUsuarioLogado()->ID;

        $query = "SELECT * FROM USUARIO_CHAT_STATUS WHERE ID_USUARIO = $idUsuarioLogado";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        if (is_array($rs) && count($rs) > 0) {

            $html = "";

            foreach ($rs as $item) {

                if ($item->STATUS == 'ONLINE' && $item->IS_ATIVO == 'S') {

                    $html = "<li><a href='#'><div class='chat-usuario-online'> </div>   Online</a></li>";
                    $html .= "<li class='divider'></li>";
                    $html .= "<li onclick='chat_alterarStatus(\"OCUPADO\")'><a href='#'><div class='chat-usuario-ocupado'> </div>   Aparecer como Ocupado</a></li>";
                    $html .= "<li onclick='chat_alterarStatus(\"OFFLINE\")'><a href='#'><div class='chat-usuario-offline'> </div>   Aparecer como Offline</a></li>";
                } else if ($item->STATUS == 'OCUPADO' && $item->IS_ATIVO == 'S') {

                    $html = "<li><a href='#'><div class='chat-usuario-ocupado'> </div>   Ocupado</a></li>";
                    $html .= "<li class='divider'></li>";
                    $html .= "<li onclick='chat_alterarStatus(\"ONLINE\")'><a href='#'><div class='chat-usuario-online'> </div>   Aparecer como Online</a></li>";
                    $html .= "<li onclick='chat_alterarStatus(\"OFFLINE\")'><a href='#'><div class='chat-usuario-offline'> </div>   Aparecer como Offline</a></li>";
                } else {

                    $html = "<li><a href='#'><div class='chat-usuario-offline'> </div>   Offline</a></li>";
                    $html .= "<li class='divider'></li>";
                    $html .= "<li onclick='chat_alterarStatus(\"ONLINE\")'><a href='#'><div class='chat-usuario-online'> </div>   Aparecer como Online</a></li>";
                    $html .= "<li onclick='chat_alterarStatus(\"OCUPADO\")'><a href='#'><div class='chat-usuario-ocupado'> </div>   Aparecer como Ocupado</a></li>";
                }

                $html .= "<li class='divider'></li>";
                $html .= "<li><a onclick='getListaUsuariosChat()' href='#'><div class='glyphicon glyphicon-repeat'> </div>Recarregar Lista</a></li>";
            }

            return $html;
        }
    }

    public function chat_alterarStatus($novoStatus) {

        $this->initConBanco();

        $idUsuarioLogado = $this->getUsuarioLogado()->ID;

        $query = "UPDATE USUARIO_CHAT_STATUS SET STATUS = '$novoStatus' WHERE ID_USUARIO = $idUsuarioLogado";

        return $this->conBanco->query($query);
    }

    public function sair() {

        $this->initConBanco();
        $idUsuarioLogado = $this->getUsuarioLogado()->ID;
        $hora = date('H:i:s');

        $query = "UPDATE USUARIO_CHAT_STATUS SET IS_ATIVO = 'N', DATA = SYSDATE, HORA = '$hora' WHERE ID_USUARIO = $idUsuarioLogado";

        return $this->conBanco->query($query);
    }

}
