<?php

class ProdutoModel extends Mysql
{
    private $intId;
    private $strNome;
    private $strDescricao;
    private $strCodigo;
    private $floPreco;
    private $intEstoque;
    private $intIdCategoria;
    private $intStatus;
    private $strImagem;

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

    public function insertProduto(string $nome, string $descricao, string $codigo, float $preco, int $estoque, int $categoria, int $tatus)
    {
        $this->strNome = $nome;
        $this->strDescricao = $descricao;
        $this->strCodigo = $codigo;
        $this->floPreco = $preco;
        $this->intEstoque = $estoque;
        $this->intIdCategoria = $categoria;
        $this->intStatus = $tatus;

        $sql = "SELECT * FROM produto WHERE codigo = $this->strCodigo";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query = "INSERT INTO produto (nome, id_categoria, codigo, descricao, preco, estoque, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $arrData = array($this->strNome, $this->intIdCategoria, $this->strCodigo, $this->strDescricao, $this->floPreco, $this->intEstoque, $this->intStatus);
            $request = $this->insert($query, $arrData);
            $return = array('id' => $request, 'status' => 1);
        } else {
            $return = array('id' => 0, 'status' => 2);
        }
        return $return;
    }

    public function insertImage(int $idProduto, string $nomeImagem)
    {
        $this->intId = $idProduto;
        $this->strImagem = $nomeImagem;
        $query_insert  = "INSERT INTO imagem (id_produto, img) VALUES (?, ?)";
        $arrData = array($this->intId, $this->strImagem);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }
}
