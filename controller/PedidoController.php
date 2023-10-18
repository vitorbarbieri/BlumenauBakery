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

    public function getPedidos()
    {
        $arrData = $this->model->selectPedidos();
        //dep($arrData);
        for ($i = 0; $i < count($arrData); $i++) {
            $btnAcoes = "";

            $arrData[$i]['custo_envio'] = formatMoney($arrData[$i]['custo_envio']);
            $arrData[$i]['total'] = formatMoney($arrData[$i]['total']);

            switch ($arrData[$i]['status']) {
                case 1:
                    $arrData[$i]['status'] = "Pedido Realizado";
                    break;
                case 2:
                    $arrData[$i]['status'] = "Pedido Enviado";
                    break;
                case 3:
                    $arrData[$i]['status'] = "Pedido Entregue";
                    break;
                default:
                    $arrData[$i]['status'] = "Status NÃO Encontrado";
                    break;
            }

            $arrData[$i]['data'] = date("d/m/Y", strtotime($arrData[$i]['data']));

            $arrData[$i]['opcoes'] = '
                <div class="text-center">
                    <a title="Ver Detalle" href="' . base_url() . '/pedido/ver/' . $arrData[$i]['id'] . '" target="_blanck" class="btn btn-secondary btn-sm">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Ver Detalle" href="' . base_url() . '/pedido/editar/' . $arrData[$i]['id'] . '" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a title="Generar PDF" href="' . base_url() . '/fatura/gerarFatura/' . $arrData[$i]['id'] . '" target="_blanck" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
}
