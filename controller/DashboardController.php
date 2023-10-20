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
        if ($_SESSION['userData']['idCargo'] != 1) {
            header("Location:" . base_url() . '/cliente');
        }

        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - Blumenau Bakery";
        $data['page_title'] = "Dashboard";
        $data['page_name'] = "dashboard";
        $data['page_functions_js'] = "functionsDashboard.js";

        $data['usuarios'] = $this->model->qtdUsuarios();
        $data['clientes'] = $this->model->qtdClientes();
        $data['produtos'] = $this->model->qtdProdutos();
        $data['pedidos'] = $this->model->qtdPedidos();
        $data['lastOrders'] = $this->model->lastOrders();
        // $data['productosTen'] = $this->model->productosTen();

        $ano = date('Y');
        $mes = date('m');
        $data['pagosMes'] = $this->model->selectPagosMes($ano, $mes);
        $data['vendasMDia'] = $this->model->selectVendasMes($ano, $mes);
        $data['vendasAno'] = $this->model->selectVendasAno($ano);

        $this->views->getView($this, "dashboard", $data);
    }

    public function tipoPagoMes()
    {
        if ($_POST) {
            $grafica = "tipoPagoMes";
            $nData = str_replace(" ", "", $_POST['data']);
            $arrData = explode('-', $nData);
            $mes = $arrData[0];
            $ano = $arrData[1];
            $pagos = $this->model->selectPagosMes($ano, $mes);
            $script = getFile("partials/modals/graficosModal", $pagos);
            echo $script;
            die();
        }
    }

    public function vendasMes()
    {
        if ($_POST) {
            $grafica = "vendasMes";
            $nData = str_replace(" ", "", $_POST['data']);
            $arrData = explode('-', $nData);
            $mes = $arrData[0];
            $ano = $arrData[1];
            $pagos = $this->model->selectVendasMes($ano, $mes);
            $script = getFile("partials/modals/graficosModal", $pagos);
            echo $script;
            die();
        }
    }
}
