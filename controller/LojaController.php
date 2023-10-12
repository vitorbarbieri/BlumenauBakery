<?php

require_once("model/TProduto.php");

class LojaController extends Controller
{
    use TProduto;
    public function __construct()
    {
        parent::__construct();
    }

    public function loja()
    {
        $data['page_tag'] = "Categoria - Blumenau Bakery";
        $data['page_title'] = "Categoria";
        $data['page_name'] = "categoria";
        $data['produtos'] = $this->getProdutosT();
        $this->views->getView($this, "categoria", $data);
    }

    public function categoria($params)
    {
        if (empty($params)) {
            header("Location: " . base_url());
        } else {
            $categoria = strClean($params);
            $data['page_tag'] = $categoria . " - Blumenau Bakery";
            $data['page_title'] = $categoria;
            $data['page_name'] = "categoria";
            $data['produtos'] = $this->getProductosCategoriaT($categoria);
            $this->views->getView($this, "categoria", $data);
        }
    }

    public function produto($params)
    {
        if (empty($params)) {
            header("Location: " . base_url());
        } else {
            $idProduto = intval($params);
            $arrProduto = $this->getProductoT($idProduto);
            $data['page_tag'] = "Produto - Blumenau Bakery";
            $data['page_title'] = "Produto";
            $data['page_name'] = "produto";
            $data['produto'] = $arrProduto;
            $data['produtos'] = $this->getProdutosRandom($arrProduto['id_categoria'], 4, "r", $arrProduto['id']);
            $this->views->getView($this, "produto", $data);
        }
    }
}
