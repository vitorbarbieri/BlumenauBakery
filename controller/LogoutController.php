<?php

class LogoutController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function admin()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location: ' . base_url() . '/login');
    }

    public function loja()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location: ' . base_url());
    }
}
