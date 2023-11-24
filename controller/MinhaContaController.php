<?php

class MinhaContaController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function minhaConta()
    {
        $data['page_tag'] = "Conta - Blumenau Bakery";
        $data['page_title'] = "Conta";
        $data['page_name'] = "conta";
        $data['pedidos'] = $this->getPedidos();

        $this->views->getView($this, "minhaConta", $data);
    }

    public function getPedidos()
    {
        $arrData = $this->model->selectPedidos();
        // dep($arrData);
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['custo_envio'] = formatMoney($arrData[$i]['custo_envio']);
            $arrData[$i]['total'] = formatMoney($arrData[$i]['total']);

            switch ($arrData[$i]['status']) {
                case 1:
                    $arrData[$i]['status'] = "Pedido Recebido";
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
        return $arrData;
        die();
    }

    public function verPedido(string $idPedido)
    {
        $idPedidoNum = intval($idPedido);
        if (!is_numeric($idPedidoNum)) {
            header("Location:" . base_url() . '/minhaConta');
        }

        $data['page_tag'] = "Pedido - Tienda Virtual";
        $data['page_title'] = "Pedido";
        $data['page_name'] = "pedido";
        $data['arrPedido'] = $this->model->selectPedido($idPedidoNum);
        $this->views->getView($this, "order", $data);
    }
}
