<?php

require_once("model/TTipoPago.php");

class PedidoController extends Controller
{
    use TTipoPago;

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
                    <a title="Ver Pedido" href="' . base_url() . '/pedido/verPedido/' . $arrData[$i]['id'] . '" target="_blanck" class="btn btn-secondary btn-sm">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Editar Pedido" class="btn btn-primary btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['id'] . ')">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a title="Gerar PDF" href="' . base_url() . '/fatura/gerarFatura/' . $arrData[$i]['id'] . '" target="_blanck" class="btn btn-warning btn-sm">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function verPedido(int $idPedido)
    {
        if (!is_numeric($idPedido)) {
            header("Location:" . base_url() . '/pedidos');
        }

        $data['page_tag'] = "Pedido - Tienda Virtual";
        $data['page_title'] = "Pedido";
        $data['page_name'] = "pedido";
        $data['arrPedido'] = $this->model->selectPedido($idPedido);
        $this->views->getView($this, "order", $data);
    }

    public function getPedido(int $idPedido)
    {
        if ($idPedido == "") {
            $arrResponse = array("status" => false, "msg" => 'Dados incorretos.');
        } else {
            $requestPedido = $this->model->selectPedido($idPedido, "");
            if (empty($requestPedido)) {
                $arrResponse = array("status" => false, "msg" => "Pedido não existe.");
            } else {
                $requestPedido['tiposPago'] = $this->getTiposPagoT();
                $requestPedido['statusPedido'] = $this->getStatusPedidoT();
                $htmlModal = getFile("partials/modals/PedidoModal", $requestPedido);
                $arrResponse = array("status" => true, "html" => $htmlModal);
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setPedido()
    {
        if ($_POST) {
            $idPedido = intval($_POST['idPedido']);
            $status = intval($_POST['listEstado']);

            if ($idPedido == 0 || $status == 0) {
                $arrResponse = array("status" => false, "msg" => 'Dados Incorretos.');
            } else {
                $requestPedido = $this->model->updatePedido($idPedido, $status);
                if ($requestPedido) {
                    $arrResponse = array("status" => true, "msg" => "Dados atualizados corretamente");
                } else {
                    $arrResponse = array("status" => false, "msg" => "Erro ao atualizar pedido.");
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
