<?php

class PedidoController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        session_regenerate_id(true);
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function pedido()
    {
        $data['page_tag'] = "Pedido - Blumenau Bakery";
        $data['page_title'] = "Pedido";
        $data['page_name'] = "pedido";
        $data['page_functions_js'] = "functionsPedido.js";
        $this->views->getView($this, "pedido", $data);
    }
}
