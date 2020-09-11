<?php
		//define autoload
		require_once "autoload.php";

		//referencia namespace das classes para uso
		use \classes\produto\Produto;
		use \classes\produto\ProdutoDaoMysql;

		//recebe dados da requisicao "form" como POST para atribui-los como atributo
		//do objeto produto
		$nome = addslashes(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));
		$marca = addslashes(filter_input(INPUT_POST, "marca", FILTER_SANITIZE_SPECIAL_CHARS));
		$preco = addslashes(filter_input(INPUT_POST, "preco", FILTER_SANITIZE_SPECIAL_CHARS));
		$codigo = addslashes(filter_input(INPUT_POST, "codigo", FILTER_SANITIZE_SPECIAL_CHARS));
		$descricao = addslashes(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS));

		if($nome AND $marca AND $preco AND $codigo AND $descricao) {
			$insert = new Produto();
			$insert->setNome($nome);
			$insert->setMarca($marca);
			$insert->setPreco($preco);
			$insert->setCodigo($codigo);
			$insert->setDescricao($descricao);

			$produtoDaoMysql = new ProdutoDaoMysql();
			$produtoDaoMysql->insertProduto($insert);
		}
?>