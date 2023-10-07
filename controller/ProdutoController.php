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

    public function getCategorias($idProduto)
    {
        $intIdProduto = intval($idProduto);

        $htmlOptions = "";
        $arrData = $this->model->selectCategorias();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                if ($arrData[$i]['id'] == $intIdProduto) {
                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '" selected>' . $arrData[$i]['pergunta'] . '</option>';
                } else {
                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '">' . $arrData[$i]['nome'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }

    public function getProdutos()
    {
        $arrData = $this->model->selectProdutos();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['codigo'] == null) {
                $arrData[$i]['codigo'] = 0;
            }

            $arrData[$i]['preco'] = formatMoney($arrData[$i]['preco']);

            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Ativo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inativo</span>';
            }

            $arrData[$i]['opcoes'] = '
            <div class="text-center">
                <button class="btn btn-secondary btn-sm" onClick="verProduto(' . $arrData[$i]['id'] . ')" title="Ver" type="button">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button class="btn btn-primary btn-sm" onClick="editarProduto(' . $arrData[$i]['id'] . ')" title="Editar" type="button">
                    <i class="fa-solid fa-pencil"></i>
                </button>
                <button class="btn btn-danger btn-sm" onClick="deletarProduto(' . $arrData[$i]['id'] . ')" title="Excluir" type="button">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
}
