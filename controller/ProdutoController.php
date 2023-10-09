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
    public function setProduto()
    {
        if ($_POST) {
            // dep($_POST);
            // die();

            $intId = intval(strClean($_POST['idProduto']));
            $strNome = strClean($_POST['txtNome']);
            $strDescricao = strClean($_POST['txtDescricao']);
            $strCodigo = strClean($_POST['txtCodigo']);
            $decPreco = floatval(str_replace(",", ".", $_POST['txtPreço']));
            $intEstoque = intval($_POST['txtEstoque']);
            $intCategoria = intval($_POST['listCategoria']);
            $intStatus = intval($_POST['listStatus']);

            if ($intId == 0) {
                $retorno = $this->model->insertProduto($strNome, $strDescricao, $strCodigo, $decPreco, $intEstoque, $intCategoria, $intStatus);
                $idProduto = $retorno['id'];
                $request = $retorno['status'];
                $option = 1;
            } else {
                $request = $this->model->updateProduto($intId, $strNome, $strDescricao, $strCodigo, $decPreco, $intEstoque, $intCategoria, $intStatus);
                $option = 2;
            }

            if ($request == 1) {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'idProducto' => $idProduto,'msg' => 'Produto salvo com sucesso');
                } else {
                    $arrResponse = array('status' => true, 'idProducto' => $intId,'msg' => 'Produto atualizado com sucesso');
                }
            } else {
                if ($request == 2) {
                    $arrResponse = array('status' => false, 'msg' => 'Atenção, Código já está sendo utilizado');
                } else {
                    if ($option == 1) {
                        $arrResponse = array('status' => false, 'msg' => 'Erro ao salvar o Produto');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Erro ao atualizar o Produto');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setImage()
    {
        // dep($_POST);
        // dep($_FILES);

        if ($_POST) {
            if (empty($_POST['idProduto'])) {
                $arrResponse = array('status' => false, 'msg' => 'Erro de dado.');
            } else {
                $idProduto = intval($_POST['idProduto']);
                $foto = $_FILES['foto'];
                $imgNome = 'pro_' . md5(date('d-m-Y H:m:s')) . '.jpg';
                $request_image = $this->model->insertImage($idProduto, $imgNome);
                if ($request_image) {
                    $uploadImage = uploadImage($foto, $imgNome);
                    $arrResponse = array('status' => true, 'imgname' => $imgNome, 'msg' => 'Arquivo carregado.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error de carga.');
                }
            }
            sleep(0.5);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        };
        die();
    }
}
