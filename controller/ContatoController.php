<?php

class ContatoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function contato()
    {
        $data['page_tag'] = "Contato - Blumenau Bakery";
        $data['page_title'] = "Contato";
        $data['page_name'] = "contato";
        $this->views->getView($this, "contato", $data);
    }
}
