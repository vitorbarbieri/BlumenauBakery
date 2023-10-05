<?php

class PerfilModel extends Mysql
{
    private $intId;
    private $strNome;
    private $strSobrenome;
    private $strTelefone;
    private $strSenha;
    private $intIdPergunta;
    private $strResposta;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function updatePerfil(int $id, string $nome, string $sobrenome, string $telefone, string $senha, int $idPergunta, string $resposta){
        $this->intId = $id;
        $this->strSenha = $senha;
        $this->intIdPergunta = $idPergunta;
        $this->strResposta = $resposta;

        if($this->strSenha != "")
        {
            $sql = "UPDATE usuario SET senha = ?, id_pergunta = ?, resposta = ? WHERE id = $this->intId ";
            $arrData = array($this->strSenha, $this->intIdPergunta, $this->strResposta);
        }else{
            $sql = "UPDATE usuario SET id_pergunta = ?, resposta = ? WHERE id = $this->intId ";
            $arrData = array($this->intIdPergunta, $this->strResposta);
        }
        $request = $this->update($sql,$arrData);
        return $request;
    }
}
