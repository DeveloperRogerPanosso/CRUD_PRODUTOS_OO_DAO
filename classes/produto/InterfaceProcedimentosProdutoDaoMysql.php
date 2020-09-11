<?php
		namespace classes\produto;

		interface ProcedimentosProdutoDaoMysql {
			public function insertProduto(Produto $insertProduto);
			public function getProdutosAll();
			public function getSelectProdutoId(Produto $selectProdutoId);
			public function updateProduto(Produto $updateProduto);
			public function deleteProduto(Produto $deleteProduto);
			public function getSomaTotalProdutos();
			public function getMediaTotalProdutos();
		}
?>