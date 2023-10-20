<?php

class DashboardModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function qtdUsuarios()
    {
        $sql = "SELECT COUNT(*) AS total FROM usuario";
        $request = $this->select($sql);
        return $request['total'];
    }

    public function qtdClientes()
    {
        $sql = "SELECT COUNT(*) AS total FROM cliente";
        $request = $this->select($sql);
        return $request['total'];
    }

    public function qtdProdutos()
    {
        $sql = "SELECT COUNT(*) AS total FROM produto";
        $request = $this->select($sql);
        return $request['total'];
    }

    public function qtdPedidos()
    {
        $sql = "SELECT COUNT(*) AS total FROM pedido";
        $request = $this->select($sql);
        return $request['total'];
    }

    public function lastOrders()
    {
        $sql = "SELECT 
                    p.id,
                    c.nome,
                    DATE_FORMAT(p.data, '%d/%m/%Y') AS 'data',
                    tp.descricao AS 'pagamento',
                    p.total,
                    st.descricao
			    FROM pedido p
			    INNER JOIN cliente c ON c.id = p.id_cliente
                INNER JOIN status_pedido st ON st.id = p.status
                INNER JOIN tipo_pagamento tp ON tp.id = p.tipo_pagamento
			    ORDER BY p.id DESC
                LIMIT 10";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPagosMes(int $ano, int $mes)
    {
        $sql = "SELECT
                    p.id,
                    tp.descricao,
                    COUNT(p.tipo_pagamento) AS 'quantidade',
                    SUM(p.total) AS 'total'
                FROM pedido p 
                INNER JOIN tipo_pagamento tp ON tp.id = p.tipo_pagamento
                WHERE MONTH(p.data) = $mes AND YEAR(p.data) = $ano
                GROUP BY tp.id";
        $pagos = $this->select_all($sql);
        $meses = Meses();
        $arrData = array('ano' => $ano, 'mes' => $meses[intval($mes - 1)], 'tipospago' => $pagos);
        return $arrData;
    }

    public function selectVendasMes(int $ano, int $mes)
    {
        $totalVendasMes = 0;
        $arrVendaDias = array();
        $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $n_dia = 1;
        for ($i = 0; $i < $dias; $i++) {
            $date = date_create($ano . "-" . $mes . "-" . $n_dia);
            $dataVenda = date_format($date, "Y-m-d");
            $sql = "SELECT 
                        DAY(data) AS 'dia',
                        COUNT(id) AS 'quantidade',
                        SUM(total) AS 'total' 
					FROM pedido 
					WHERE DATE(data) = '$dataVenda'
                    AND status = 3";
            $vendaDia = $this->select($sql);
            $vendaDia['dia'] = $n_dia;
            $vendaDia['total'] = $vendaDia['total'] == "" ? 0 : $vendaDia['total'];
            $totalVendasMes += $vendaDia['total'];
            array_push($arrVendaDias, $vendaDia);
            $n_dia++;
        }
        $meses = Meses();
        $arrData = array('ano' => $ano, 'mes' => $meses[intval($mes - 1)], 'total' => $totalVendasMes, 'vendas' => $arrVendaDias);
        return $arrData;
    }

    public function selectVendasAno(int $ano)
    {
        $arrMVendas = array();
        $arrMeses = Meses();
        for ($i = 1; $i <= 12; $i++) {
            $arrData = array('ano' => '', 'no_mes' => '', 'mes' => '', 'venda' => '');
            $sql = "SELECT
                            $ano AS 'ano',
                            $i AS 'mes',
                            SUM(total) AS venda 
						FROM pedido 
						WHERE MONTH(data)= $i
                        AND YEAR(data) = $ano
                        AND status = 3 
						GROUP BY MONTH(data) ";
            $vendaMes = $this->select($sql);
            $arrData['mes'] = $arrMeses[$i - 1];
            if (empty($vendaMes)) {
                $arrData['ano'] = $ano;
                $arrData['no_mes'] = $i;
                $arrData['venda'] = 0;
            } else {
                $arrData['ano'] = $vendaMes['ano'];
                $arrData['no_mes'] = $vendaMes['mes'];
                $arrData['venda'] = $vendaMes['venda'];
            }
            array_push($arrMVendas, $arrData);
        }
        $arrVendas = array('ano' => $ano, 'meses' => $arrMVendas);
        return $arrVendas;
    }
}
