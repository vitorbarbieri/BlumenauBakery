<?php

class MinhaContaModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectPedidos()
    {
        $idCliente = $_SESSION['userData']['id'];

        $sql = "SELECT 
                    p.id,
                    -- DATE_FORMAT(p.data, '%d%m%Y'),
                    p.data,
                    c.nome AS 'cNome',
                    p.total,
                    p.custo_envio,
                    tp.descricao AS pagamento,
                    p.status 
                FROM pedido p
                INNER JOIN cliente c ON c.id = p.id_cliente
                INNER JOIN tipo_pagamento tp ON tp.id = p.tipo_pagamento
                WHERE p.id_cliente = $idCliente
                ORDER BY p.data DESC";
        $request = $this->select_all($sql);
        return $request;
    }
}
