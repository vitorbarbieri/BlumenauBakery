<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function dashboard()
    {
        if($_SESSION['userData']['idCargo'] != 1){
            header("Location:".base_url().'/cliente');
        }

        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - Blumenau Bakery";
        $data['page_title'] = "Dashboard";
        $data['page_name'] = "dashboard";
        $this->views->getView($this, "dashboard", $data);
    }
}
