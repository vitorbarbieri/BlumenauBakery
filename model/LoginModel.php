<?php

class LoginModel extends Mysql
{
    private $idUer;
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

        $sql = "SELECT id, status FROM usuario WHERE email = '$this->login' AND senha = '$this->senha'";
        $request = $this->select($sql);
        return $request;
    }

    public function SessionLogin($idUser)
    {
        $this->idUser = $idUser;

        // Buscar cargo
        $sql = "SELECT u.id,
                       u.nome,
                       u.sobrenome,
                       u.telefone,
                       u.email,
                       u.cpf,
                       c.id as 'idCargo',
                       c.nome as 'nomeCargo',
                       u.status
                FROM usuario u
                INNER JOIN cargo c ON c.id = u.id_cargo
                WHERE u.id = $this->idUser";
        $request = $this->select($sql);
        return $request;
    }
}
