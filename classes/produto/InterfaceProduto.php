<?php
		//define namespace para interface seguindo nomenclatura de seu diretorio
		//(pastas) facilitando processo de carregamento automatico de arquivo(autoload)
		namespace classes\produto;

		interface ProcedimentosProduto {
			public function setId(string $id);
			public function getId() : string;
			public function setNome(string $nome);
			public function getNome() : string;
			public function setMarca(string $marca);
			public function getMarca() : string;
			public function setPreco(string $preco);
			public function getPreco() : string;
			public function setCodigo(string $codigo);
			public function getCodigo() : string;
			public function setDescricao(string $descricao);
			public function getDescricao() : string;
		}
?>