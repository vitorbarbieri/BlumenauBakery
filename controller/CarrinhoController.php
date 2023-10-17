<?php

require_once("model/TCliente.php");
require_once("model/TProduto.php");

class CarrinhoController extends Controller
{
    use TProduto, TCliente;
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function carrinho()
    {
        $data['page_tag'] = "Carrinho - Blumenau Bakery";
        $data['page_title'] = "Carrinho";
        $data['page_name'] = "carrinho";
        $this->views->getView($this, "carrinho", $data);
    }

    public function processarPago()
    {
        if (empty($_SESSION['arrCarrinho'])) {
            header("Location: " . base_url());
            die();
        }
        if (isset($_SESSION['loginCliente'])) {
            $this->setDetalheTemp();
        }

        $data['page_tag'] = "Pagamento - Blumenau Bakery";
        $data['page_title'] = "Pagamento";
        $data['page_name'] = "pagamento";
        $this->views->getView($this, "pagamento", $data);
    }

    public function setDetalheTemp()
    {
        $arrPedido = array('idCliente' => $_SESSION['idUser'], 'idTransacao' => session_id(), 'produtos' => $_SESSION['arrCarrinho']);
        $this->insertDetalheCliente($arrPedido);
    }
}
