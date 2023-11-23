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
        $this->views->getView($this, "minhaConta", $data);
    }
}
