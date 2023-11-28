<?php

class PerfilModel extends Mysql
{
    private $intId;
    private $strNome;
    private $strSobrenome;
    private $strTelefone;
    private $strEmail;
    private $strSenha;
    private $intIdPergunta;
    private $strResposta;

    public function __construct()
    {
        parent::__construct();
    }

    public function updatePerfil(int $id, string $nome, string $sobrenome, string $telefone, string $email, string $senha, int $idPergunta, string $resposta)
    {
        $this->intId = $id;
        $this->strNome = $nome;
        $this->strSobrenome = $sobrenome;
        $this->strTelefone = $telefone;
        $this->strEmail = $email;
        $this->strSenha = $senha;
        $this->intIdPergunta = $idPergunta;
        $this->strResposta = $resposta;

        if ($this->intIdPergunta == 0) {
            $sql = "UPDATE usuario SET nome = ?, sobrenome = ?, telefone = ?, email = ? WHERE id = $this->intId ";
            $arrData = array($this->strNome, $this->strSobrenome, $this->strTelefone, $this->strEmail);
        } else {
            if ($this->strSenha == "") {
                $sql = "UPDATE usuario SET id_pergunta = ?, resposta = ? WHERE id = $this->intId ";
                $arrData = array($this->intIdPergunta, $this->strResposta);
            } else {
                $sql = "UPDATE usuario SET senha = ?, id_pergunta = ?, resposta = ? WHERE id = $this->intId ";
                $arrData = array($this->strSenha, $this->intIdPergunta, $this->strResposta);
            }
        }
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
