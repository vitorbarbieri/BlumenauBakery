<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - Blumenau Bakery";
        $data['page_title'] = "Dashboard";
        $data['page_name'] = "dashboard";
        $this->views->getView($this, "dashboard", $data);
    }
}
