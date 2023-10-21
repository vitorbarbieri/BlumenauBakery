<?php

class SobreController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function sobre()
    {
        $data['page_tag'] = "Sobre - Blumenau Bakery";
        $data['page_title'] = "Sobre";
        $data['page_name'] = "sobre";
        $this->views->getView($this, "sobre", $data);
    }
}
