<?php

class homemodel extends CI_Model {

    private $conBanco;

    public function __construct() {
        parent::__construct();
    }

    private function initConBanco() {
        if ($this->conBanco == null) {
            $this->conBanco = $this->load->database("gbxcrm", TRUE);
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

    public function getRanking($tipo, $mesDe, $mesAte) {

        $this->initConBanco();

        if ($tipo == 'HOJE') {
            $where = " TO_DATE(T1.DATA_CADASTRO,'DD/MM/YY') = TO_DATE(SYSDATE,'DD/MM/YY') ";
        } else if ($tipo == 'SEMANA') {

            $query = "SELECT TRUNC(SYSDATE,'W')+1-(ROWNUM-1)*7 D,
                            ROUND(SYSDATE,'W')-(ROWNUM-1)*7 R 
                       FROM DUAL CONNECT BY LEVEL < 8";
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $inicio = $rs[1]->D;
            $termino = $rs[0]->D;

            $where = " TO_DATE(T1.DATA_CADASTRO,'DD/MM/YY') BETWEEN TO_DATE('$inicio','DD/MM/YY') AND TO_DATE('$termino','DD/MM/YY') ";
        } else if ($tipo == 'MES') {
            $where = " TO_CHAR(T1.DATA_CADASTRO,'MM') = TO_CHAR(SYSDATE,'MM') ";
        } else if ($tipo == 'ANO') {
            $where = " TO_CHAR(T1.DATA_CADASTRO,'YY') = TO_CHAR(SYSDATE,'YY') ";
        } else {
            $where = " TO_DATE(T1.DATA_CADASTRO,'DD/MM/YY') >= TO_DATE('$mesDe','DD/MM/YY') AND TO_DATE(T1.DATA_CADASTRO,'DD/MM/YY') <= TO_DATE('$mesAte','DD/MM/YY') ";
        }

        $query = "

            SELECT * FROM (

                SELECT  
                SUM(VALOR) AS TOTAL,
                VENDEDOR,
                CADASTRADOR

                FROM 
                (

                SELECT 

                T2.VALOR_TOTAL AS VALOR,
                T3.NOME||' '||T3.SOBRENOME AS VENDEDOR,
                T1.CADASTRADOR

                FROM SSO_VENDA_GERAL T1
                LEFT JOIN SSO_VENDA_FORMAS_PAGAMENTO T2 ON (T2.ID_VENDA = T1.ID AND T2.VERSAO_VENDA = T1.VERSAO)
                INNER JOIN CADASTRO_USUARIO T3 ON (T3.ID = T1.CADASTRADOR AND T3.IES_ULTIMA_VERSAO = 'S')
                WHERE T1.IS_ULTIMA_VERSAO = 'S'
                AND $where
                )

                GROUP BY
                VENDEDOR,
                CADASTRADOR) ORDER BY TOTAL DESC";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        $html = "<table align='center' style='width: 99%;border-collapse: collapse; border: solid 1px grey' border='1'>";
        $html .= "<tr>";

        if (is_array($rs) && count($rs) > 0) {

            $c = count($rs);
            $width = 100 / count($rs);

            $i = 1;
            $total = 0;

            foreach ($rs as $item) {

                $total += $item->TOTAL;

                $x = "";
                $x .= $item->VENDEDOR . ' - ' . $item->TOTAL;

                $imgSrc = "";
                switch ($item->CADASTRADOR) {
                    case 2:
                        $imgSrc = 'bruno.JPG';
                        break;
                    case 3:
                        $imgSrc = 'leonardo.JPG';
                        break;
                    case 4:
                        $imgSrc = 'rafael.JPG';
                        break;
                    case 36:
                        $imgSrc = 'tomaz.JPG';
                        break;
                    case 5:
                        $imgSrc = 'francis.JPG';
                        break;
                    case 1:
                        $imgSrc = 'gabriel.JPG';
                        break;
                    case 65:
                        $imgSrc = 'lucas.JPG';
                        break;
                    case 69:
                        $imgSrc = 'v.png';
                        break;
                    case 40:
                        $imgSrc = 'juliano.jpg';
                        break;
                }

                $item->TOTAL = number_format(str_replace(',', '.', $item->TOTAL) + 0, 2, ',', '.');

                $html .= "<td align='center' style='height: $width%'>
                            <img style='padding-top: 25px;height: 100px;' src='resources/base/img/$imgSrc'></img>
                            <h4><b>$i" . "º - $item->VENDEDOR</b></h4>
                                <br />
                            <h2>R$ $item->TOTAL</h2>

                         </td>";

                $i++;
            }

            $total = number_format(str_replace(',', '.', $total) + 0, 2, ',', '.');

            $html .= "</tr>";
            $html .= "<tr><td colspan='$c' align='center'><h1>VENDAS BRUTAS - Total: R$ $total</h1></td></tr>";
        }

        $html .= "</table>";
        $html .= "<br /><br />";

        $whereX = "";

        if ($tipo == 'HOJE') {
            $whereX = " TO_DATE(T1.DATA_PAGAMENTO,'DD/MM/YY') = TO_DATE(SYSDATE,'DD/MM/YY') ";
        } else if ($tipo == 'SEMANA') {

            $query = "SELECT TRUNC(SYSDATE,'W')+1-(ROWNUM-1)*7 D,
                            ROUND(SYSDATE,'W')-(ROWNUM-1)*7 R 
                       FROM DUAL CONNECT BY LEVEL < 8";
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $inicio = $rs[1]->D;
            $termino = $rs[0]->D;

            $whereX = " TO_DATE(T1.DATA_PAGAMENTO,'DD/MM/YY') BETWEEN TO_DATE('$inicio','DD/MM/YY') AND TO_DATE('$termino','DD/MM/YY') ";
        } else if ($tipo == 'MES') {
            $whereX = " TO_CHAR(T1.DATA_PAGAMENTO,'MM') = TO_CHAR(SYSDATE,'MM') ";
        } else if ($tipo == 'ANO') {
            $whereX = " TO_CHAR(T1.DATA_PAGAMENTO,'YY') = TO_CHAR(SYSDATE,'YY') ";
        } else {
            $whereX = " TO_DATE(T1.DATA_PAGAMENTO,'DD/MM/YY') >= TO_DATE('$mesDe','DD/MM/YY') AND TO_DATE(T1.DATA_PAGAMENTO,'DD/MM/YY') <= TO_DATE('$mesAte','DD/MM/YY') ";
        }

        //

        if ($tipo == 'HOJE') {
            $whereY = " TO_DATE(X1.DATA_CADASTRO,'DD/MM/YY') = TO_DATE(SYSDATE,'DD/MM/YY') ";
        } else if ($tipo == 'SEMANA') {

            $query = "SELECT TRUNC(SYSDATE,'W')+1-(ROWNUM-1)*7 D,
                            ROUND(SYSDATE,'W')-(ROWNUM-1)*7 R 
                       FROM DUAL CONNECT BY LEVEL < 8";
            $cs = $this->conBanco->query($query);
            $rs = $cs->result();

            $inicio = $rs[1]->D;
            $termino = $rs[0]->D;

            $whereY = " TO_DATE(X1.DATA_CADASTRO,'DD/MM/YY') BETWEEN TO_DATE('$inicio','DD/MM/YY') AND TO_DATE('$termino','DD/MM/YY') ";
        } else if ($tipo == 'MES') {
            $whereY = " TO_CHAR(X1.DATA_CADASTRO,'MM') = TO_CHAR(SYSDATE,'MM') ";
        } else if ($tipo == 'ANO') {
            $whereY = " TO_CHAR(X1.DATA_CADASTRO,'YY') = TO_CHAR(SYSDATE,'YY') ";
        } else {
            $whereY = " TO_DATE(X1.DATA_CADASTRO,'DD/MM/YY') >= TO_DATE('$mesDe','DD/MM/YY') AND TO_DATE(X1.DATA_CADASTRO,'DD/MM/YY') <= TO_DATE('$mesAte','DD/MM/YY') ";
        }

        $query = "SELECT * FROM (

                SELECT  
                SUM(VALOR) AS TOTAL,
                VENDEDOR,
                CADASTRADOR,
                TOTAL_VENDA

                FROM 
                (

                SELECT 

                T1.VALOR_PARCELA AS VALOR,
                T3.NOME||' '||T3.SOBRENOME AS VENDEDOR,
                T1.CADASTRADOR,
                (
                          SELECT  
                          SUM(X2.VALOR_TOTAL) AS TOTAL
                          
                          FROM SSO_VENDA_GERAL X1
                          LEFT JOIN SSO_VENDA_FORMAS_PAGAMENTO X2 ON (X2.ID_VENDA = X1.ID AND X2.VERSAO_VENDA = X1.VERSAO)
                          INNER JOIN CADASTRO_USUARIO X3 ON (X3.ID = X1.CADASTRADOR AND X3.IES_ULTIMA_VERSAO = 'S')
                          WHERE X1.IS_ULTIMA_VERSAO = 'S' AND X1.CADASTRADOR = T1.CADASTRADOR
                          AND $whereY
                         
                ) AS TOTAL_VENDA

                FROM SSO_PAGAMENTO T1
                --LEFT JOIN SSO_VENDA_FORMAS_PAGAMENTO T2 ON (T2.ID_VENDA = T1.ID_VENDA)
                INNER JOIN CADASTRO_USUARIO T3 ON (T3.ID = T1.CADASTRADOR AND T3.IES_ULTIMA_VERSAO = 'S')
                WHERE T1.IS_PAGO = 'S' AND $whereX
                )

                GROUP BY
                VENDEDOR,
                CADASTRADOR,
                TOTAL_VENDA
                ) ORDER BY TOTAL DESC";

        $cs = $this->conBanco->query($query);
        $rs = $cs->result();

        //print_r($query);

        $html .= "<table align='center' style='width: 99%;border-collapse: collapse; border: solid 1px grey' border='1'>";
        $html .= "<tr>";

        if (is_array($rs) && count($rs) > 0) {

            $c = count($rs);
            $width = 100 / count($rs);

            $i = 1;
            $total = 0;
            $totalVendaX = 0;

            foreach ($rs as $item) {

                $total += $item->TOTAL;
                $totalVendaX += $item->TOTAL_VENDA;

                $x = "";
                $x .= $item->VENDEDOR . ' - ' . $item->TOTAL;

                $imgSrc = "";
                switch ($item->CADASTRADOR) {
                    case 2:
                        $imgSrc = 'bruno.JPG';
                        break;
                    case 3:
                        $imgSrc = 'leonardo.JPG';
                        break;
                    case 4:
                        $imgSrc = 'rafael.JPG';
                        break;
                    case 36:
                        $imgSrc = 'tomaz.JPG';
                        break;
                    case 5:
                        $imgSrc = 'francis.JPG';
                        break;
                    case 1:
                        $imgSrc = 'gabriel.JPG';
                        break;
                    case 65:
                        $imgSrc = 'lucas.JPG';
                        break;
                    case 69:
                        $imgSrc = 'v.png';
                        break;
                    case 40:
                        $imgSrc = 'juliano.jpg';
                        break;
                }

                $totalVenda = $item->TOTAL_VENDA;

                if ($totalVenda > 0) {
                    $percentual = ($item->TOTAL * 100) / $totalVenda;
                } else {
                    $percentual = 0;
                }

                $percentual = number_format($percentual, 2, ',', '.');

                $item->TOTAL = number_format(str_replace(',', '.', $item->TOTAL) + 0, 2, ',', '.');

                $html .= "<td align='center' style='height: $width%'>
                            <img style='padding-top: 25px;height: 100px;' src='resources/base/img/$imgSrc'></img>
                            <h4><b>$i" . "º - $item->VENDEDOR</b></h4>
                                <br />
                            <h2>R$ $item->TOTAL</h2>
                                <br />
                                <b>APROVEITAMENTO DE: $percentual %</b>
                         </td>";


                $i++;
            }

            if ($totalVendaX > 0) {
                $percentual = ($total * 100) / $totalVendaX;
            } else {
                $percentual = 0;
            }
            $percentual = number_format($percentual, 2, ',', '.');

            $total = number_format(str_replace(',', '.', $total) + 0, 2, ',', '.');



            $html .= "</tr>";
            $html .= "<tr><td colspan='$c' align='center'><h1>RECEBIMENTO BRUTO - Total: R$ $total</h1><br /><b><h2>APROVEITAMENTO MÉDIO DE: $percentual %</h2></b></td></tr>";
        }

        $html .= "</tr></table>";

        return $html;
    }

}
