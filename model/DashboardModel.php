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
                    p.total,
                    st.descricao
			    FROM pedido p
			    INNER JOIN cliente c ON c.id = p.id_cliente
                INNER JOIN status_pedido st ON st.id = p.status
			    ORDER BY p.id DESC
                LIMIT 10";
        $request = $this->select_all($sql);
        return $request;
    }
}
