<?php
		//define autoload 
		require_once "autoload.php";

		use \classes\produto\Produto;
		use \classes\produto\ProdutoDaoMysql;

		//recebe dados da requisicao "form" de edição como POST para update
		$id_produto = addslashes(filter_input(INPUT_POST, "id_produto", FILTER_SANITIZE_SPECIAL_CHARS));
		$nome = addslashes(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));
		$marca = addslashes(filter_input(INPUT_POST, "marca", FILTER_SANITIZE_SPECIAL_CHARS));
		$preco = addslashes(filter_input(INPUT_POST, "preco", FILTER_SANITIZE_SPECIAL_CHARS));
		$codigo = addslashes(filter_input(INPUT_POST, "codigo", FILTER_SANITIZE_SPECIAL_CHARS));
		$descricao = addslashes(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS));

		//testa se dados são validos 
		if($id_produto AND $nome AND $marca AND $preco AND $codigo AND $descricao) {
			$updateProduto = new Produto();
			$updateProduto->setId($id_produto);
			$updateProduto->setNome($nome);
			$updateProduto->setMarca($marca);
			$updateProduto->setPreco($preco);
			$updateProduto->setCodigo($codigo);
			$updateProduto->setDescricao($descricao);

			$produtoDaoMysql = new ProdutoDaoMysql();
			$produtoDaoMysql->updateProduto($updateProduto);
		}
?>