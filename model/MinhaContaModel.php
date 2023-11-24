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

    public function selectPedido(int $idPedido)
    {
        $request = array();
        $sql = "SELECT 
                    p.id,
                    -- DATE_FORMAT(p.data, '%d%m%Y'),
                    p.data,
                    id_cliente,
                    c.nome AS 'cNome',
                    p.total,
                    p.custo_envio,
                    p.tipo_pagamento,
                    tp.descricao AS pagamento,
                    p.endereco_entrega,
                    sp.descricao 
                FROM pedido p
                INNER JOIN cliente c ON c.id = p.id_cliente
                INNER JOIN tipo_pagamento tp ON tp.id = p.tipo_pagamento
                INNER JOIN status_pedido sp ON sp.id = p.status
                WHERE p.id = $idPedido";
        $requestPedido = $this->select($sql);

        if (!empty($requestPedido)) {
            $idCliente = $requestPedido['id_cliente'];
            $sql_cliente = "SELECT
                                id,
                                nome,
                                email
                            FROM cliente
                            WHERE id = $idCliente ";
            $requestcliente = $this->select($sql_cliente);
            $sql_detalle = "SELECT 
                                p.id,
                                p.nome AS 'produto',
                                dp.preco,
                                dp.quantidade
                            FROM detalhe_pedido dp
                            INNER JOIN produto p ON p.id = dp.id_produto
                            WHERE dp.id_pedido = $idPedido";
            $requestProductos = $this->select_all($sql_detalle);
            $request = array(
                'cliente' => $requestcliente,
                'pedido' => $requestPedido,
                'detalhe_pedido' => $requestProductos
            );
        }
        return $request;
    }
}
