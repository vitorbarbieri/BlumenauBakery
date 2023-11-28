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
        $data['cliente'] = $this->getCliente($_SESSION['userData']['id']);

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

    public function setUsuario($id)
    {
        if ($_POST) {
            $intId = intval(strClean($_POST['idUsuario']));
            $strNome = ucwords(strClean($_POST['txtNome']));
            $strEmail = strtolower(strClean($_POST['txtEmail']));
            $strEndereco = ucwords(strClean($_POST['txtEndereço']));
            $intNumero = intval(strClean($_POST['txtNumero']));
            $strCep = strClean($_POST['txtCep']);
            $strBairro = strClean($_POST['txtBairro']);
            $strCidade = strClean($_POST['txtCidade']);
            $intEstado = intval(strClean($_POST['listEstado']));

            $strSenha = "";
            if ($_POST['txtSenha'] != "") {
                $strSenha = hash("SHA256", $_POST['txtSenha']);
            }

            if ($strSenha == "") {
                $request = $this->model->updateCliente($intId, $strNome, $strEmail, $strEndereco, $intNumero, $strBairro, $strCidade, $intEstado, $strCep, $strSenha);
            } else {
                $request = $this->model->updateCliente($intId, $strNome, $strEmail, $strEndereco, $intNumero, $strBairro, $strCidade, $intEstado, $strCep, $strSenha);
            }

            if ($request == 1) {
                $arrResponse = array('status' => true, 'msg' => 'Dados atualizado com sucesso');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Erro ao atualizar os dados');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCliente($id)
    {
        $idCliente = intval($id);
        if ($idCliente > 0) {
            $arrData = $this->model->selectCliente($idCliente);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Cliente não existe.');
            } else {
                $arrData['data_nascimento'] = date("d/m/Y", strtotime($arrData['data_nascimento']));

                $arrData['ultima_compra'] = date("d/m/Y", strtotime($arrData['ultima_compra']));
                $ano = substr($arrData['ultima_compra'], 6, 4);
                if ($ano < 2000) {
                    $arrData['ultima_compra'] = '00/00/0000';
                }

                $arrResponse = array('status' => true, 'data' => $arrData);
            }
        }
        return $arrData;
        die();
    }
}
