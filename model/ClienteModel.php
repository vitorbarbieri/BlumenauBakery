<?php

class ClienteModel extends Mysql
{
    private $intId;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectClientes()
    {
        $sql = "SELECT id,
                       nome,
                       email,
                       ultima_compra,
                       status
                FROM cliente";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCliente(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT *
				FROM cliente
				WHERE id = $this->intId";
        $request = $this->select($sql);
        return $request;
    }
}
