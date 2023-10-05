<?php

class ClienteController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function cliente()
    {
        $data['page_id'] = 3;
        $data['page_tag'] = "Cliente - Blumenau Bakary";
        $data['page_title'] = "Cliente";
        $data['page_name'] = "cliente";
        $data['page_functions_js'] = "functionsCliente.js";
        $this->views->getView($this, "cliente", $data);
    }

    public function getClientes()
    {
        $arrData = $this->model->selectClientes();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Ativo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inativo</span>';
            }

            $arrData[$i]['ultima_compra'] = date("d/m/Y", strtotime($arrData[$i]['ultima_compra']));

            $arrData[$i]['opcao'] = '
            <div class="text-center">
                <button class="btn btn-secondary btn-sm" onClick="verCliente(' . $arrData[$i]['id'] . ')" title="Permissão" type="button">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
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
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
