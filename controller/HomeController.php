<?php
require_once("model/TProduto.php");
class HomeController extends Controller
{
    use TProduto;
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $data['page_tag'] = "Home - Blumenau Bakery";
        $data['page_title'] = "Home";
        $data['page_name'] = "home";
        $data['produtos'] = $this->getProdutosT();
        $this->views->getView($this, "home", $data);
    }
}
