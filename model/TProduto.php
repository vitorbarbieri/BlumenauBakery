<?php

require_once("core/Mysql.php");

trait TProduto
{
	private $conexao;
	private $strCategoria;
	private $intIdCategoria;
	private $strProduto;
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
				ORDER BY p.id DESC";
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

	// public function getProductosCategoriaT(string $categoria)
	// {
	// 	$this->strCategoria = $categoria;
	// 	$this->conexao = new Mysql();
	// 	$sql_cat = "SELECT idcategoria FROM categoria WHERE nombre = '{$this->strCategoria}'";
	// 	$request = $this->conexao->select($sql_cat);

	// 	if (!empty($request)) {
	// 		$this->intIdcategoria = $request['idcategoria'];
	// 		$sql = "SELECT p.idproducto,
	// 						p.codigo,
	// 						p.nombre,
	// 						p.descripcion,
	// 						p.categoriaid,
	// 						c.nombre as categoria,
	// 						p.precio,
	// 						p.stock
	// 				FROM producto p 
	// 				INNER JOIN categoria c
	// 				ON p.categoriaid = c.idcategoria
	// 				WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria ";
	// 		$request = $this->conexao->select_all($sql);
	// 		if (count($request) > 0) {
	// 			for ($c = 0; $c < count($request); $c++) {
	// 				$intIdProduto = $request[$c]['idproducto'];
	// 				$sqlImg = "SELECT img
	// 								FROM imagen
	// 								WHERE productoid = $intIdProduto";
	// 				$arrImg = $this->conexao->select_all($sqlImg);
	// 				if (count($arrImg) > 0) {
	// 					for ($i = 0; $i < count($arrImg); $i++) {
	// 						$arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
	// 					}
	// 				}
	// 				$request[$c]['images'] = $arrImg;
	// 			}
	// 		}
	// 	}
	// 	return $request;
	// }

	// public function getProductoT(string $producto)
	// {
	// 	$this->conexao = new Mysql();
	// 	$this->strProducto = $producto;
	// 	$sql = "SELECT p.idproducto,
	// 					p.codigo,
	// 					p.nombre,
	// 					p.descripcion,
	// 					p.categoriaid,
	// 					c.nombre as categoria,
	// 					p.precio,
	// 					p.stock
	// 			FROM producto p 
	// 			INNER JOIN categoria c
	// 			ON p.categoriaid = c.idcategoria
	// 			WHERE p.status != 0 AND p.nombre = '{$this->strProducto}' ";
	// 	$request = $this->conexao->select($sql);
	// 	if (!empty($request)) {
	// 		$intIdProduto = $request['idproducto'];
	// 		$sqlImg = "SELECT img
	// 						FROM imagen
	// 						WHERE productoid = $intIdProduto";
	// 		$arrImg = $this->conexao->select_all($sqlImg);
	// 		if (count($arrImg) > 0) {
	// 			for ($i = 0; $i < count($arrImg); $i++) {
	// 				$arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
	// 			}
	// 		}
	// 		$request['images'] = $arrImg;
	// 	}
	// 	return $request;
	// }

	// public function getProductosRandom(int $idcategoria, int $qtd, string $opcao)
	// {
	// 	$this->intIdcategoria = $idcategoria;
	// 	$this->qtd = $qtd;
	// 	$this->opcao = $opcao;

	// 	if ($opcao == "r") {
	// 		$this->opcao = " RAND() ";
	// 	} else if ($opcao == "a") {
	// 		$this->opcao = " idproducto ASC ";
	// 	} else {
	// 		$this->opcao = " idproducto DESC ";
	// 	}

	// 	$this->conexao = new Mysql();
	// 	$sql = "SELECT p.idproducto,
	// 					p.codigo,
	// 					p.nombre,
	// 					p.descripcion,
	// 					p.categoriaid,
	// 					c.nombre as categoria,
	// 					p.precio,
	// 					p.stock
	// 			FROM producto p 
	// 			INNER JOIN categoria c
	// 			ON p.categoriaid = c.idcategoria
	// 			WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria
	// 			ORDER BY $this->opcao LIMIT  $this->qtd ";
	// 	$request = $this->conexao->select_all($sql);
	// 	if (count($request) > 0) {
	// 		for ($c = 0; $c < count($request); $c++) {
	// 			$intIdProduto = $request[$c]['idproducto'];
	// 			$sqlImg = "SELECT img
	// 							FROM imagen
	// 							WHERE productoid = $intIdProduto";
	// 			$arrImg = $this->conexao->select_all($sqlImg);
	// 			if (count($arrImg) > 0) {
	// 				for ($i = 0; $i < count($arrImg); $i++) {
	// 					$arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
	// 				}
	// 			}
	// 			$request[$c]['images'] = $arrImg;
	// 		}
	// 	}
	// 	return $request;
	// }
}
