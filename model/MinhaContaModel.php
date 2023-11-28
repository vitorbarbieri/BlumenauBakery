<?php

class MinhaContaModel extends Mysql
{
    private $intId;
    private $strNome;
    private $strEmail;
    private $strEndereco;
    private $intNumero;
    private $strCep;
    private $strBairro;
    private $strCidade;
    private $intEstado;
    private $strSenha;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectPedidos()
    {
        $idCliente = $_SESSION['userData']['id'];

        $sql = "SELECT 
                    p.id,
                    -- DATE_FORMAT(p.data, '%d%m%Y'),
                    p.data,
                    c.nome AS 'cNome',
                    p.total,
                    p.custo_envio,
                    tp.descricao AS pagamento,
                    p.status 
                FROM pedido p
                INNER JOIN cliente c ON c.id = p.id_cliente
                INNER JOIN tipo_pagamento tp ON tp.id = p.tipo_pagamento
                WHERE p.id_cliente = $idCliente
                ORDER BY p.data DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPedido(int $idPedido)
    {
        $request = array();
        $sql = "SELECT 
                    p.id,
                    -- DATE_FORMAT(p.data, '%d%m%Y'),
                    p.data,
                    id_cliente,
                    c.nome AS 'cNome',
                    p.total,
                    p.custo_envio,
                    p.tipo_pagamento,
                    tp.descricao AS pagamento,
                    p.endereco_entrega,
                    sp.descricao 
                FROM pedido p
                INNER JOIN cliente c ON c.id = p.id_cliente
                INNER JOIN tipo_pagamento tp ON tp.id = p.tipo_pagamento
                INNER JOIN status_pedido sp ON sp.id = p.status
                WHERE p.id = $idPedido";
        $requestPedido = $this->select($sql);

        if (!empty($requestPedido)) {
            $idCliente = $requestPedido['id_cliente'];
            $sql_cliente = "SELECT
                                id,
                                nome,
                                email
                            FROM cliente
                            WHERE id = $idCliente ";
            $requestcliente = $this->select($sql_cliente);
            $sql_detalle = "SELECT 
                                p.id,
                                p.nome AS 'produto',
                                dp.preco,
                                dp.quantidade
                            FROM detalhe_pedido dp
                            INNER JOIN produto p ON p.id = dp.id_produto
                            WHERE dp.id_pedido = $idPedido";
            $requestProductos = $this->select_all($sql_detalle);
            $request = array(
                'cliente' => $requestcliente,
                'pedido' => $requestPedido,
                'detalhe_pedido' => $requestProductos
            );
        }
        return $request;
    }

    public function updateCliente(int $id, string $nome, string $email, string $endereco, int $numero, string $bairro, string $cidade, int $estado, string $cep, string $senha)
    {
        $this->intId = $id;
        $this->strNome = $nome;
        $this->strEmail = $email;
        $this->strEndereco = $endereco;
        $this->intNumero = $numero;
        $this->strBairro = $bairro;
        $this->strCidade = $cidade;
        $this->intEstado = $estado;
        $this->strCep = $cep;
        $this->strSenha = $senha;;

        $sql = "SELECT * FROM cliente WHERE id = '{$this->intId}'";
        $request = $this->select($sql);

        if (!empty($request)) {
            if ($this->strSenha == "") {
                $sql = "UPDATE cliente SET nome = ?, email = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = $this->intId";
                $arrData = array($this->strNome, $this->strEmail, $this->strEndereco, $this->intNumero, $this->strBairro, $this->strCidade, $this->intEstado, $this->strCep);
            } else {
                $sql = "UPDATE cliente SET nome = ?, email = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ?, senha = ? WHERE id = $this->intId";
                $arrData = array($this->strNome, $this->strEmail, $this->strEndereco, $this->intNumero, $this->strBairro, $this->strCidade, $this->intEstado, $this->strCep, $this->strSenha);
            }
            $request = $this->update($sql, $arrData);
            return 1;
        }
    }

    public function selectCliente(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT *
				FROM cliente
				WHERE id = $this->intId";
        $request = $this->select($sql);
        return $request;
    }
}
