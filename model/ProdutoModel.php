<?php

class ProdutoModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectCategorias()
    {
        $sql = "SELECT id, nome FROM categoria";
        $request = $this->select_all($sql);
        return $request;
    }
}
