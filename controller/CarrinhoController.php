<?php

require_once("model/TProduto.php");

class CarrinhoController extends Controller
{
    use TProduto;
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function carrinho()
    {
        $data['page_tag'] = "Carrinho - Blumenau Bakery";
        $data['page_title'] = "Carrinho";
        $data['page_name'] = "carrinho";
        $this->views->getView($this, "carrinho", $data);
    }
}
