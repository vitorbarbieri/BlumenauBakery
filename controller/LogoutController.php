<?php

class LogoutController extends Controller
{
    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['login']) && !isset($_SESSION['loginCliente'])) {
            die();
        } else {
            if (isset($_SESSION['login'])) {
                $login = "admin";
            } else {
                $login = "loja";
            }
        }

        session_unset();
        session_destroy();

        if ($login == "loja") {
            header('location: ' . base_url());
        } else {
            header('location: ' . base_url() . '/login');
        }
    }
}
