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
        $data['lastOrders'] = $this->model->lastOrders();
        // $data['productosTen'] = $this->model->productosTen();
        
        $ano = date('Y');
        $mes = date('m');
        $data['pagosMes'] = $this->model->selectPagosMes($ano,$mes);
        // $data['ventasMDia'] = $this->model->selectVentasMes($ano,$mes);
        // $data['ventasAno'] = $this->model->selectVentasAno($ano);

        $this->views->getView($this, "dashboard", $data);
    }
}
