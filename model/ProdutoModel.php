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

    public function selectProdutos()
    {
        $sql = "SELECT
                    p.id,
                    p.codigo,
                    p.nome,
                    c.nome as cNome,
                    p.estoque,
                    p.preco,
                    p.status
                FROM produto p
                INNER JOIN categoria c ON c.id = p.id_categoria";
        $request = $this->select_all($sql);
        return $request;
    }
}
