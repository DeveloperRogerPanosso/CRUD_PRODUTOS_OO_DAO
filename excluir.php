<?php
		require_once "autoload.php";

		use \classes\produto\Produto;
		use \classes\produto\ProdutoDaoMysql;

		//recebe id do produto para exclusão via URL(GET)
		$id_produto = addslashes(filter_input(INPUT_GET, "IdProduto"));

		if($id_produto == true) {
			$deleteProduto = new Produto();
			$deleteProduto->setId($id_produto);

			$produtoDaoMysql = new ProdutoDaoMysql();
			$produtoDaoMysql->deleteProduto($deleteProduto);
		}else {
			header("Location: select_produtos.php");
			exit;
		}
?>