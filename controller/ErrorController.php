<?php

class ErrorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        $data['page_id'] = 3;
        $data['page_tag'] = "Erro - Blumenau Bakery";
        $data['page_title'] = "Erro";
        $data['page_name'] = "erro";
        $this->views->getView($this, "erro", $data);
    }
}

$notFound = new ErrorController();
$notFound->notFound();
