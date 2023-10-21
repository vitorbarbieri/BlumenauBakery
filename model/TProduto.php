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
				LIMIT " . QTDPRODHOME;
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

	public function getProdutosPage(int $desde, int $qtdPorPagina)
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
				ORDER BY p.id ASC
				LIMIT $desde, $qtdPorPagina";
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

	public function getProdutosCategoriaT(int $idCategoria, string $rota, $desde = null, $porPagina = null)
	{
		$this->intIdCategoria = $idCategoria;
		$this->strCategoria = $rota;
		$where = "";
		if (is_numeric($desde) and is_numeric($porPagina)) {
			$where = " LIMIT " . $desde . "," . $porPagina;
		}

		$this->conexao = new Mysql();
		$sql_cat = "SELECT id, nome FROM categoria WHERE id = $this->intIdCategoria";
		$request = $this->conexao->select($sql_cat);

		if (!empty($request)) {
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
					ORDER BY p.nome ASC " . $where;
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
			$request = array(
				'idCategoria' => $this->intIdCategoria,
				'rota' => $this->strCategoria,
				'produtos' => $request
			);
		}
		return $request;
	}

	public function getProdutoT(int $idProduto)
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

	public function qtdProdutos($categoria = null)
	{
		$where = "";
		if ($categoria != null) {
			$where = " AND id_categoria = " . $categoria;
		}
		$this->con = new Mysql();
		$sql = "SELECT COUNT(*) as total_registro FROM produto WHERE status = 1 " . $where;
		$result_register = $this->con->select($sql);
		$total_registro = $result_register;
		return $total_registro;
	}

	public function qtdProdSearch($busca)
	{
		$this->conexao = new Mysql();
		$sql = "SELECT COUNT(*) AS total_registro FROM produto WHERE nome LIKE '%$busca%' AND status = 1";
		$result_register = $this->conexao->select($sql);
		$total_registro = $result_register;
		return $total_registro;
	}

	public function getProdSearch($busca, $desde, $porPagina)
	{
		$this->conexao = new Mysql();
		$sql = "SELECT 
					p.id,
					p.codigo,
					p.nome,
					p.descricao,
					p.id_categoria,
					c.nome as categoria,
					p.preco,
					p.estoque
				FROM produto p 
				INNER JOIN categoria c ON c.id = p.id_categoria
				WHERE p.status = 1
				AND p.nome
				LIKE '%$busca%'
				ORDER BY p.nome ASC
				LIMIT $desde,$porPagina";
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
