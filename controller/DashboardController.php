<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function dashboard()
    {
        if($_SESSION['userData']['idCargo'] != 1){
            header("Location:".base_url().'/cliente');
        }

        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - Blumenau Bakery";
        $data['page_title'] = "Dashboard";
        $data['page_name'] = "dashboard";

        $data['usuarios'] = $this->model->qtdUsuarios();
        $data['clientes'] = $this->model->qtdClientes();
        $data['produtos'] = $this->model->qtdProdutos();
        $data['pedidos'] = $this->model->qtdPedidos();

        $this->views->getView($this, "dashboard", $data);
    }
}
