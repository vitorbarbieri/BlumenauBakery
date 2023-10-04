<?php

class UsuarioModel extends Mysql
{
    private $intId;
    private $strCpf;
    private $strNome;
    private $strSobrenome;
    private $strTelefone;
    private $strEmail;
    private $strSenha;
    private $intCargo;
    private $dateCadastro;
    private $intStatus;
    private $strToken;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectUsuarios()
    {
        $sql = "SELECT u.id,
                       u.nome,
                       u.sobrenome,
                       u.email,
                       c.nome as cNome,
                       u.status
                FROM usuario u
                INNER JOIN cargo c ON u.id_cargo = c.id";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectUsuario(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT u.id,
                       u.nome,
                       u.sobrenome,
                       u.telefone,
                       u.email,
                       u.cpf,
                       c.id as cId,
                       u.data_criacao,
                       u.status
                FROM usuario u
                INNER JOIN cargo c ON u.id_cargo = c.id
                WHERE u.id = $this->intId";
        $request = $this->select($sql);
        return $request;
    }

    public function insertUsuario(string $cpf, string $nome, string $sobrenome, string $tel, string $email, int $cargo, int $status, string $senha, $dataCriacao)
    {
        $this->strCpf = $cpf;
        $this->strNome = $nome;
        $this->strSobrenome = $sobrenome;
        $this->strTelefone = $tel;
        $this->strEmail = $email;
        $this->strSenha = $senha;
        $this->intCargo = $cargo;
        $this->dateCadastro = $dataCriacao;
        $this->intStatus = $status;

        $sql = "SELECT * FROM usuario WHERE cpf = '{$this->strCpf}'";
        $request = $this->select($sql);

        if (empty($request)) {
            $sql = "INSERT INTO usuario (nome, sobrenome, telefone, email, senha, cpf, id_cargo, data_criacao, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $arrData = array($this->strNome, $this->strSobrenome, $this->strTelefone, $this->strEmail, $this->strSenha, $this->strCpf, $this->intCargo, $this->dateCadastro, $this->intStatus);
            $request = $this->insert($sql, $arrData);
            $return = 1;
        } else {
            $return = 2;
        }
        return $return;
    }

    public function updateUsuario(int $id, string $cpf, string $nome, string $sobrenome, string $tel, string $email, int $cargo, int $status, string $senha)
    {
        $this->intId = $id;
        $this->strCpf = $cpf;
        $this->strNome = $nome;
        $this->strSobrenome = $sobrenome;
        $this->strTelefone = $tel;
        $this->strEmail = $email;
        $this->strSenha = $senha;
        $this->intCargo = $cargo;
        $this->intStatus = $status;

        $sql = "SELECT * FROM usuario WHERE id = '{$this->intId}'";
        $request = $this->select($sql);

        if (!empty($request)) {
            if ($this->strSenha == "") {
                $sql = "UPDATE usuario SET nome = ?, sobrenome = ?, telefone = ?, email = ?, cpf = ?, id_cargo = ?, status = ? WHERE id = $this->intId";
                $arrData = array($this->strNome, $this->strSobrenome, $this->strTelefone, $this->strEmail, $this->strCpf, $this->intCargo, $this->intStatus);
            } else {
                $sql = "UPDATE usuario SET nome = ?, sobrenome = ?, telefone = ?, email = ?, senha = ?, cpf = ?, id_cargo = ?, status = ? WHERE id = $this->intId";
                $arrData = array($this->strNome, $this->strSobrenome, $this->strTelefone, $this->strEmail, $this->strSenha, $this->strCpf, $this->intCargo, $this->intStatus);
            }
            $request = $this->update($sql, $arrData);
            return 1;
        }
    }

    public function deleteUsuario($id)
    {
        $this->intId = $id;

        $sql = "DELETE FROM usuario WHERE id = $this->intId";
        $request = $this->delete($sql);
        if ($request) {
            return 1;
        } else {
            return 2;
        }
    }
}
