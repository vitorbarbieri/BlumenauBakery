<?php

class LoginLojaModel extends Mysql
{
    private $nome;
    private $email;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $dataNascimento;
    private $sexo;
    private $senha;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser(string $email, string $senha)
    {
        $this->email = $email;
        $this->senha = $senha;

        $sql = "SELECT id, status FROM cliente WHERE email = '$this->email' AND senha = '$this->senha'";
        $request = $this->select($sql);
        return $request;
    }

    public function insertUsuario(string $nome, string $email, string $endereco, int $numero, string $bairro, string $cidade, int $estado, string $cep, $dataNascimento, int $sexo, string $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->dataNascimento = $dataNascimento;
        $this->sexo = $sexo;
        $this->senha = $senha;
        $this->status = 1;

        $sql = "SELECT * FROM cliente WHERE email = '{$this->email}'";
        $request = $this->select($sql);

        if (empty($request)) {
            $sql = "INSERT INTO cliente (nome, email, senha, endereco, numero, bairro, cidade, estado, cep, data_nascimento, sexo, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $arrData = array($this->nome, $this->email, $this->senha, $this->endereco, $this->numero, $this->bairro, $this->cidade, $this->estado, $this->cep, $this->dataNascimento, $this->sexo, $this->status);
            $request = $this->insert($sql, $arrData);
            $return = array('id' => $request, 'status' => 1);
        } else {
            $return = array('id' => 0, 'status' => 2);
        }
        return $return;
    }
}
