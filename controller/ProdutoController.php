<?php

class ProdutoController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function produto()
    {
        $data['page_id'] = 5;
        $data['page_tag'] = "Produto - Manolo Bakes";
        $data['page_title'] = "Produtos";
        $data['page_name'] = "Produto";
        $data['page_functions_js'] = "functionsProduto.js";
        $this->views->getView($this, "produto", $data);
    }
}
