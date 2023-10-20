<?php

class LoginLojaModel extends Mysql
{
    private $login;
    private $senha;

    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser(string $login, string $senha)
    {
        $this->login = $login;
        $this->senha = $senha;

        $sql = "SELECT id, status FROM cliente WHERE email = '$this->login' AND senha = '$this->senha'";
        $request = $this->select($sql);
        return $request;
    }
}
