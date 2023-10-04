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
}
