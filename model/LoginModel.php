<?php

class LoginModel extends Mysql
{
    private $idUser;
    private $strEmail;
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

    public function sessionLogin($idUser)
    {
        $this->idUser = $idUser;

        // Buscar cargo
        $sql = "SELECT 
                    u.id,
                    u.nome,
                    u.sobrenome,
                    u.telefone,
                    u.email,
                    u.cpf,
                    c.id as 'idCargo',
                    c.nome as 'nomeCargo',
                    u.status,
                    u.id_pergunta,
                    p.pergunta,
                    resposta
                FROM usuario u
                INNER JOIN cargo c ON c.id = u.id_cargo
                INNER JOIN pergunta p ON p.id = u.id_pergunta
                WHERE u.id = $this->idUser";
        $request = $this->select($sql);
        $_SESSION['userData'] = $request;
        return $request;
    }

    public function selectUsuarioPergunta(string $email)
    {
        $this->strEmail = $email;
        $sql = "SELECT 
                    u.id,
                    pergunta
                FROM usuario u
                INNER JOIN pergunta p ON p.id = u.id_pergunta
                WHERE u.email = '{$this->strEmail}'";
        $request = $this->select($sql);
        return $request;
    }

    public function buscaRespostaUsuario(int $id)
    {
        $this->idUer = $id;
        $sql = "SELECT resposta
                FROM usuario
                WHERE id = $this->idUer";
        $request = $this->select($sql);
        return $request;
    }

    public function setSenha(int $id, string $senha)
    {
        $this->idUer = $id;
        $this->senha = $senha;
        $sql = "UPDATE usuario SET senha = ? WHERE id = $this->idUer";
        $arrData = array("{$this->senha}");
        $this->update($sql, $arrData);
    }
}
