<?php 

require_once("core/Mysql.php");

trait TTipoPago{
	private $conexao;

	public function getTiposPagoT(){
		$this->conexao = new Mysql();
		$sql = "SELECT * FROM tipo_pagamento";
		$request = $this->conexao->select_all($sql);
		return $request;
	}

	public function getStatusPedidoT(){
		$this->conexao = new Mysql();
		$sql = "SELECT * FROM status_pedido";
		$request = $this->conexao->select_all($sql);
		return $request;
	}
}