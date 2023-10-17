<?php

require_once("core/Mysql.php");

trait TCliente
{
    private $strNome;
    private $strEmail;
    private $intCep;
    private $strEndereco;
    private $intNumero;
    private $strBairro;
    private $strCidade;
    private $intEstado;
    private $intSexo;
    private $txtDataNascimento;
    private $strSenha;

    public function insertCliente(string $nome, string $email, string $cep, string $endereco, int $numero, string $bairro, string $cidade, int $estado, int $sexo, string $dataNascimento, string $senha)
    {
		$this->conexao = new Mysql();
        $this->strNome = $nome;
        $this->strEmail = $email;
        $this->intCep = $cep;
        $this->strEndereco = $endereco;
        $this->intNumero = $numero;
        $this->strBairro = $bairro;
        $this->strCidade = $cidade;
        $this->intEstado = $estado;
        $this->intSexo = $sexo;
        $this->txtDataNascimento = $dataNascimento;
        $this->strSenha = $senha;

        $sql = "SELECT * FROM cliente WHERE email = '{$this->strEmail}'";
        $request = $this->conexao->select_all($sql);

        if (empty($request)) {
            $query_insert  = "INSERT INTO cliente (nome, email, senha, endereco, numero, bairro, cidade, estado, cep, data_nascimento, sexo, status) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $arrData = array($this->strNome, $this->strEmail, $this->strSenha, $this->strEndereco, $this->intNumero, $this->strBairro, $this->strCidade, $this->intEstado, $this->intCep, $this->txtDataNascimento, $this->intSexo, 1);
            $request = $this->conexao->insert($query_insert, $arrData);
            $return = array('status' => 1, 'id' => $request);
        } else {
            $return = array('status' => 2);
        }
        return $return;
    }
}
