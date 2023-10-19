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
}
