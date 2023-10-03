<?php

class Mysql extends Conexao
{
    private $conexao;
    private $strquery;
    private $arrValues;

    function __construct()
    {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conect();
    }

    // Inserir registro
    public function insert(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $insert = $this->conexao->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrValues);
        if ($resInsert) {
            $lastInsert = $this->conexao->lastInsertId();
        } else {
            $lastInsert = 0;
        }
        return $lastInsert;
    }

    // Buscar registro
    public function select(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexao->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // Buscar todos os registros
    public function select_all(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexao->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    // Atualziar registro
    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $update = $this->conexao->prepare($this->strquery);
        $resExecute = $update->execute($this->arrValues);
        return $resExecute;
    }
    
    // Eliminar registro
    public function delete(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexao->prepare($this->strquery);
        $del = $result->execute();
        return $del;
    }
}
