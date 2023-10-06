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
}
