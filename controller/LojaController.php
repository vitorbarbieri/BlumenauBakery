<?php

require_once("model/TProduto.php");
require_once("model/LoginModel.php");

class LojaController extends Controller
{
    public $login;
    use TProduto;

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->login = new LoginModel();
    }

    public function loja()
    {
        $data['page_tag'] = "Loja - Blumenau Bakery";
        $data['page_title'] = "Loja";
        $data['page_name'] = "loja";
        $data['produtos'] = $this->getProdutosT();
        $this->views->getView($this, "loja", $data);
    }

    public function categoria($params)
    {
        if (empty($params)) {
            header("Location: " . base_url());
        } else {
            $categoria = strClean($params);
            $data['page_tag'] = $categoria . " - Blumenau Bakery";
            $data['page_title'] = $categoria;
            $data['page_name'] = "categoria";
            $data['produtos'] = $this->getProductosCategoriaT($categoria);
            $this->views->getView($this, "categoria", $data);
        }
    }

    public function produto($params)
    {
        if (empty($params)) {
            header("Location: " . base_url());
        } else {
            $idProduto = intval($params);
            $arrProduto = $this->getProductoT($idProduto);
            $data['page_tag'] = "Produto - Blumenau Bakery";
            $data['page_title'] = "Produto";
            $data['page_name'] = "produto";
            $data['produto'] = $arrProduto;
            $data['produtos'] = $this->getProdutosRandom($arrProduto['id_categoria'], 4, "r", $arrProduto['id']);
            $this->views->getView($this, "produto", $data);
        }
    }

    public function addCarrinho()
    {
        if ($_POST) {
            $arrCarrinho = array();
            $qtdCarrinho = 0;
            $idProduto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $quantidade = $_POST['cant'];
            if (is_numeric($idProduto) and is_numeric($quantidade)) {
                $arrInfoProduto = $this->getProductoT($idProduto);
                if (!empty($arrInfoProduto)) {
                    $arrProduto = array(
                        'idProduto' => $idProduto,
                        'produto' => $arrInfoProduto['nome'],
                        'quantidade' => $quantidade,
                        'preco' => $arrInfoProduto['preco'],
                        'imagem' => $arrInfoProduto['images'][0]['url_image']
                    );

                    if (isset($_SESSION['arrCarrinho'])) {
                        $on = true;
                        $arrCarrinho = $_SESSION['arrCarrinho'];
                        for ($pr = 0; $pr < count($arrCarrinho); $pr++) {
                            if ($arrCarrinho[$pr]['idProduto'] == $idProduto) {
                                $arrCarrinho[$pr]['quantidade'] += $quantidade;
                                $on = false;
                            }
                        }
                        if ($on) {
                            array_push($arrCarrinho, $arrProduto);
                        }
                        $_SESSION['arrCarrinho'] = $arrCarrinho;
                    } else {
                        array_push($arrCarrinho, $arrProduto);
                        $_SESSION['arrCarrinho'] = $arrCarrinho;
                    }
                    foreach ($_SESSION['arrCarrinho'] as $pro) {
                        $qtdCarrinho += $pro['quantidade'];
                    }

                    $htmlCarrinho = "";
                    $htmlCarrinho = getFile('partials/modals/CarrinhoModal', $_SESSION['arrCarrinho']);
                    $arrResponse = array(
                        "status" => true,
                        "msg" => 'foi adicionado ao carrinho!',
                        "qtdCarrinho" => $qtdCarrinho,
                        "htmlCarrinho" => $htmlCarrinho
                    );
                } else {
                    $arrResponse = array("status" => false, "msg" => 'Produto não existe.');
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dados incorretos.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delCarrinho()
    {
        if ($_POST) {
            $arrCarrinho = array();
            $qtdCarrinho = 0;
            $subTotal = 0;
            $idProduto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $opcao = $_POST['option'];
            if (is_numeric($idProduto) and ($opcao == 1 or $opcao == 2)) {
                $arrCarrinho = $_SESSION['arrCarrinho'];
                for ($pr = 0; $pr < count($arrCarrinho); $pr++) {
                    if ($arrCarrinho[$pr]['idProduto'] == $idProduto) {
                        unset($arrCarrinho[$pr]);
                    }
                }
                sort($arrCarrinho);
                $_SESSION['arrCarrinho'] = $arrCarrinho;
                foreach ($_SESSION['arrCarrinho'] as $pro) {
                    $qtdCarrinho += $pro['quantidade'];
                    $subTotal += $pro['quantidade'] * $pro['preco'];
                }
                $htmlCarrito = "";
                if ($opcao == 1) {
                    $htmlCarrito = getFile('partials/modals/CarrinhoModal', $_SESSION['arrCarrinho']);
                }
                $arrResponse = array(
                    "status" => true,
                    "msg" => 'Produto eliminado!',
                    "qtdCarrinho" => $qtdCarrinho,
                    "htmlCarrito" => $htmlCarrito,
                    "subTotal" => formatMoney($subTotal),
                    "total" => formatMoney($subTotal + CUSTOENVIO)
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dado incorreto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function updateCarrinho()
    {
        if ($_POST) {
            $arrCarrinho = array();
            $totalProduto = 0;
            $subTotal = 0;
            $total = 0;
            $idProduto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $quantidade = intval($_POST['quantidade']);
            if (is_numeric($idProduto) and $quantidade > 0) {
                $arrCarrinho = $_SESSION['arrCarrinho'];
                for ($p = 0; $p < count($arrCarrinho); $p++) {
                    if ($arrCarrinho[$p]['idProduto'] == $idProduto) {
                        $arrCarrinho[$p]['quantidade'] = $quantidade;
                        $totalProduto = $arrCarrinho[$p]['preco'] * $quantidade;
                        break;
                    }
                }
                $_SESSION['arrCarrinho'] = $arrCarrinho;
                foreach ($_SESSION['arrCarrinho'] as $pro) {
                    $subTotal += $pro['quantidade'] * $pro['preco'];
                }
                $arrResponse = array(
                    "status" => true,
                    "msg" => 'Produto ataulizado!',
                    "totalProduto" => formatMoney($totalProduto),
                    "subTotal" => formatMoney($subTotal),
                    "total" => formatMoney($subTotal + CUSTOENVIO)
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dado incorreto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
