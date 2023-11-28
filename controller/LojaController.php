<?php

require_once("model/TProduto.php");
require_once("model/TCliente.php");
require_once("model/LoginModel.php");

class LojaController extends Controller
{
    public $login;
    use TProduto, TCliente;

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
        $pagina = 1;
        $qtdProdutos = $this->qtdProdutos();
        $totalProdutos = $qtdProdutos['total_registro'];
        $desde = ($pagina - 1) * QTDPRODLOJA;
        $totalPaginas = ceil($totalProdutos / QTDPRODLOJA);
        $data['produtos'] = $this->getProdutosPage($desde, QTDPRODLOJA);
        $data['pagina'] = $pagina;
        $data['total_paginas'] = $totalPaginas;

        $this->views->getView($this, "loja", $data);
    }

    public function categoria($params)
    {
        if (empty($params)) {
            header("Location: " . base_url());
        } else {
            $arrParams = explode(",", $params);
            $idCategoria = intval($arrParams[0]);
            $rota = strClean($arrParams[1]);
            $pagina = 1;
            if (count($arrParams) > 2 and is_numeric($arrParams[2])) {
                $pagina = $arrParams[2];
            };
            $qtdProdutos = $this->qtdProdutos($idCategoria);
            $total_registro = $qtdProdutos['total_registro'];
            $desde = ($pagina - 1) * QTDPRODCATEGORIA;
            $total_paginas = ceil($total_registro / QTDPRODCATEGORIA);
            $infoCategoria = $this->getProdutosCategoriaT($idCategoria, $rota, $desde, QTDPRODCATEGORIA);
            $data['page_tag'] = $rota . " - Blumenau Bakery";
            $data['page_title'] = $rota;
            $data['page_name'] = "categoria";
            $data['infoCategoria'] = $infoCategoria;
            $data['pagina'] = $pagina;
            $data['total_paginas'] = $total_paginas;
            $data['produtos'] = $infoCategoria['produtos'];
            $this->views->getView($this, "categoria", $data);
        }
    }

    public function produto($params)
    {
        if (empty($params)) {
            header("Location: " . base_url());
        } else {
            $idProduto = intval($params);
            $arrProduto = $this->getProdutoT($idProduto);
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
                $arrInfoProduto = $this->getProdutoT($idProduto);
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

    public function setCliente()
    {
        error_reporting(0);
        if ($_POST) {
            $strNome = ucwords(strClean($_POST['txtNome']));
            $strEmail = strtolower(strClean($_POST['txtEmailCliente']));
            $strCep = strClean($_POST['txtCep']);
            $strEndereco = ucwords(strClean($_POST['txtEndereco']));
            $intNumero = intval(strClean($_POST['txtNumero']));
            $strBairro = ucwords(strClean($_POST['txtBairro']));
            $strCidade = ucwords(strClean($_POST['txtCidade']));
            $intEstado = strtoupper(intval($_POST['listEstado']));
            $intSexo = intval(strClean($_POST['listSexo']));
            $txtDataNascimento = date("Y-m-d H:i:s", strtotime($_POST['txtDataNascimento']));
            $strSenha = hash("SHA256", $_POST['txtSenha']);

            $request = $this->insertCliente($strNome, $strEmail, $strCep, $strEndereco, $intNumero, $strBairro, $strCidade, $intEstado, $intSexo, $txtDataNascimento, $strSenha);
            $status = $request['status'];
            if ($status == 1) {
                $id = $request['id'];
                $arrResponse = array('status' => true, 'msg' => 'Dados guardados corretamente.');
                $_SESSION['idUser'] = $id;
                $_SESSION['loginCliente'] = true;
                $this->login->sessionLoginCliente($id);
            } else {
                if ($status == 2) {
                    $arrResponse = array('status' => false, 'msg' => 'E-mail já cadastrado, utilize outro!');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'Erro ao salvar cliente!');
                }
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function page($pagina = null)
    {
        $pagina = is_numeric($pagina) ? $pagina : 1;
        $qtdProdutos = $this->qtdProdutos();
        $total_registro = $qtdProdutos['total_registro'];
        $desde = ($pagina - 1) * QTDPRODLOJA;
        $total_paginas = ceil($total_registro / QTDPRODLOJA);
        $data['produtos'] = $this->getProdutosPage($desde, QTDPRODLOJA);
        //dep($data['productos']);exit;
        $data['page_tag'] = "Loja - Blumenau Bakery";
        $data['page_title'] = "Loja";
        $data['page_name'] = "loja";
        $data['pagina'] = $pagina;
        $data['total_paginas'] = $total_paginas;
        $this->views->getView($this, "loja", $data);
    }

    public function search()
    {
        if (empty($_REQUEST['s'])) {
            header("Location: " . base_url());
        } else {
            $busca = strClean($_REQUEST['s']);
        }
        $pagina = empty($_REQUEST['p']) ? 1 : intval($_REQUEST['p']);
        $qtdProdutos = $this->qtdProdSearch($busca);
        $total_registro = $qtdProdutos['total_registro'];
        $desde = ($pagina - 1) * QTDPRODBUSCAR;
        $total_paginas = ceil($total_registro / QTDPRODBUSCAR);
        $data['produtos'] = $this->getProdSearch($busca, $desde, QTDPRODBUSCAR);
        $data['page_tag'] = "Busca - " . NOME_EMPRESA;
        $data['page_title'] = "Resultado de: " . ucwords($busca);
        $data['page_name'] = "loja";
        $data['pagina'] = $pagina;
        $data['total_paginas'] = $total_paginas;
        $data['busca'] = $busca;
        // $data['categorias'] = $this->getCategorias();
        $this->views->getView($this, "search", $data);
    }

    public function processarVenda()
    {
        if ($_POST) {
            $idCliente = $_SESSION['idUser'];
            $valorTotal = 0;
            $idTipoPago = intval($_POST['intTipoPago']);
            $enderecoEnvio = strClean($_POST['endereco']) . ' - ' . strClean($_POST['cidade']);
            $status = 1;
            $subTotal = 0;
            date_default_timezone_set("America/Sao_Paulo");
            $dataPedido = date("Y-m-d H:i:s");

            if (!empty($_SESSION['arrCarrinho'])) {
                foreach ($_SESSION['arrCarrinho'] as $pro) {
                    $subTotal += $pro['quantidade'] * $pro['preco'];
                }
                if ($subTotal <= 100) {
                    $custoEnvio = CUSTOENVIO;
                } else {
                    $custoEnvio = 0.00;
                }
                $valorTotal = $subTotal + $custoEnvio;

                // Criar Pedido
                $request_pedido = $this->insertPedido($idCliente, $dataPedido, $custoEnvio, $valorTotal, $idTipoPago, $enderecoEnvio, $status);

                if ($request_pedido > 0) {
                    // Inserir Detalhe Pedido
                    foreach ($_SESSION['arrCarrinho'] as $produto) {
                        $idProduto = $produto['idProduto'];
                        $preco = $produto['preco'];
                        $quantidade = $produto['quantidade'];
                        $this->insertDetalhe($request_pedido, $idProduto, $preco, $quantidade);
                    }

                    // Atualizar Data última compra Pedido
                    $this->updateClient($idCliente, $dataPedido);

                    $order = openssl_encrypt($request_pedido, METHODENCRIPT, KEY);
                    $arrResponse = array(
                        "status" => true,
                        "order" => $order,
                        "msg" => 'Pedido realizado com sucesso'
                    );
                    $_SESSION['dataPedido'] = $arrResponse;
                    unset($_SESSION['arrCarrinho']);
                    session_regenerate_id(true);
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'Não foi possível processar o pedido.');
            }
        } else {
            $arrResponse = array("status" => false, "msg" => 'Não foi possível processar o pedido.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function confirmarPedido()
    {
        if (empty($_SESSION['dataPedido'])) {
            header("Location: " . base_url());
        } else {
            $dataPedido = $_SESSION['dataPedido'];
            $idPedido = openssl_decrypt($dataPedido['order'], METHODENCRIPT, KEY);
            $data['page_tag'] = "Confirmar Pedido";
            $data['page_title'] = "Confirmar Pedido";
            $data['page_name'] = "confirmarPedido";
            $data['order'] = $idPedido;
            $this->views->getView($this, "confirmarPedido", $data);
        }
        unset($_SESSION['dataPedido']);
    }
}
