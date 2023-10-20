<?php

require_once("core/Mysql.php");

trait TProduto
{
	private $conexao;
	private $strCategoria;
	private $intIdCategoria;
	private $strProduto;
	private $intIdProduto;
	private $qtd;
	private $opcao;

	public function getProdutosT()
	{
		$this->conexao = new Mysql();
		$sql = "SELECT 
					p.id,
					p.codigo,
					p.nome,
					p.descricao,
					p.id_categoria,
					c.nome as cNome,
					p.preco,
					p.estoque
				FROM produto p 
				INNER JOIN categoria c ON p.id_categoria = c.id
				WHERE p.status = 1
				ORDER BY p.id DESC
				LIMIT 12";
		$request = $this->conexao->select_all($sql);
		if (count($request) > 0) {
			for ($c = 0; $c < count($request); $c++) {
				$intIdProduto = $request[$c]['id'];
				$sqlImg = "SELECT img FROM imagem WHERE id_produto = $intIdProduto";
				$arrImg = $this->conexao->select_all($sqlImg);
				if (count($arrImg) > 0) {
					for ($i = 0; $i < count($arrImg); $i++) {
						$arrImg[$i]['url_image'] = media() . '/img/uploads/' . $arrImg[$i]['img'];
					}
				}
				$request[$c]['images'] = $arrImg;
			}
		}
		return $request;
	}

	public function getProductosCategoriaT(string $categoria)
	{
		$this->strCategoria = $categoria;
		$this->conexao = new Mysql();
		$sql_cat = "SELECT id FROM categoria WHERE nome = '{$this->strCategoria}'";
		$request = $this->conexao->select($sql_cat);

		if (!empty($request)) {
			$this->intIdCategoria = $request['id'];
			$sql = "SELECT 
						p.id,
						p.codigo,
						p.nome,
						p.descricao,
						p.id_categoria,
						c.nome as cNome,
						p.preco,
						p.estoque
					FROM produto p 
					INNER JOIN categoria c ON p.id_categoria = c.id
					WHERE p.status = 1
					AND p.id_categoria = $this->intIdCategoria
					ORDER BY p.nome";
			$request = $this->conexao->select_all($sql);
			if (count($request) > 0) {
				for ($c = 0; $c < count($request); $c++) {
					$intIdProduto = $request[$c]['id'];
					$sqlImg = "SELECT img FROM imagem WHERE id_produto = $intIdProduto";
					$arrImg = $this->conexao->select_all($sqlImg);
					if (count($arrImg) > 0) {
						for ($i = 0; $i < count($arrImg); $i++) {
							$arrImg[$i]['url_image'] = media() . '/img/uploads/' . $arrImg[$i]['img'];
						}
					}
					$request[$c]['images'] = $arrImg;
				}
			}
		}
		return $request;
	}

	public function getProductoT(int $idProduto)
	{
		$this->conexao = new Mysql();
		$this->intIdProduto = $idProduto;
		$sql = "SELECT 
					p.id,
					p.codigo,
					p.nome,
					p.descricao,
					p.id_categoria,
					c.nome as cNome,
					p.preco,
					p.estoque
				FROM produto p 
				INNER JOIN categoria c ON p.id_categoria = c.id
				WHERE p.status = 1
				AND p.id = $this->intIdProduto";
		$request = $this->conexao->select($sql);
		if (!empty($request)) {
			$intIdProduto = $request['id'];
			$sqlImg = "SELECT img FROM imagem WHERE id_produto = $intIdProduto";
			$arrImg = $this->conexao->select_all($sqlImg);
			if (count($arrImg) > 0) {
				for ($i = 0; $i < count($arrImg); $i++) {
					$arrImg[$i]['url_image'] = media() . '/img/uploads/' . $arrImg[$i]['img'];
				}
			}
			$request['images'] = $arrImg;
		}
		return $request;
	}

	public function getProdutosRandom(int $idCategoria, int $qtd, string $opcao, int $idProduto)
	{
		$this->intIdCategoria = $idCategoria;
		$this->qtd = $qtd;
		$this->opcao = $opcao;
		$this->intIdProduto = $idProduto;

		if ($opcao == "r") {
			$this->opcao = " RAND() ";
		} else if ($opcao == "a") {
			$this->opcao = " id ASC ";
		} else {
			$this->opcao = " id DESC ";
		}

		$this->conexao = new Mysql();
		$sql = "SELECT 
					p.id,
					p.codigo,
					p.nome,
					p.descricao,
					p.id_categoria,
					c.nome as cNome,
					p.preco,
					p.estoque
				FROM produto p 
				INNER JOIN categoria c ON p.id_categoria = c.id
				WHERE p.status = 1
				AND p.id_categoria = $this->intIdCategoria
				AND p.id != $this->intIdProduto
				ORDER BY $this->opcao
				LIMIT  $this->qtd";
		$request = $this->conexao->select_all($sql);
		if (count($request) > 0) {
			for ($c = 0; $c < count($request); $c++) {
				$intIdProduto = $request[$c]['id'];
				$sqlImg = "SELECT img FROM imagem WHERE id_produto = $intIdProduto";
				$arrImg = $this->conexao->select_all($sqlImg);
				if (count($arrImg) > 0) {
					for ($i = 0; $i < count($arrImg); $i++) {
						$arrImg[$i]['url_image'] = media() . '/img/uploads/' . $arrImg[$i]['img'];
					}
				}
				$request[$c]['images'] = $arrImg;
			}
		}
		return $request;
	}
}
