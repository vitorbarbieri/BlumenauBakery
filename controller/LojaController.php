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
}
