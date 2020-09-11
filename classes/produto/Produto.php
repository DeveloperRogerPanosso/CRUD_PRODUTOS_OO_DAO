<?php
		//define namespace para classe seguindo nomenclatura de seu 
		//diretorio(pastas) facilitando processo de carregamento automatico(autoload)
		namespace classes\produto;

		require_once "InterfaceProduto.php";

		class Produto implements ProcedimentosProduto {
			private $id;
			private string $nome;
			private string $marca;
			private string $preco;
			private string $codigo;
			private string $descricao;

			//define encapsulamento as propriedades da classe(stters e getters)
			public function setId(string $id) {
				if(isset($id) AND !empty($id) AND is_string($id)) {
					$this->id = addslashes(htmlspecialchars(trim($id))) ?? null;
					return true;
				}else {
					echo error_get_last();
					return false;
					exit;
				}
			}
			public function getId() : string {
				return $this->id;
			}

			public function setNome(string $nome) {
				if(isset($nome) AND !empty($nome) AND is_string($nome)) {
					if(strlen($nome) >= 3) {
						$this->nome = addslashes(htmlspecialchars(trim(ucwords($nome)))) ?? null;
						return true;
					}else {
						echo error_get_last();
						return false;
						exit;
					}
				}
			}
			public function getNome() : string {
				return $this->nome ?? "Nome não informado !!";
			}

			public function setMarca(string $marca) {
				if(isset($marca) AND !empty($marca) AND is_string($marca)) {
					if(strlen($marca) >= 2) {
						$this->marca = addslashes(htmlspecialchars(trim(ucwords($marca)))) ?? null;
						return true;
					}else {
						echo error_get_last();
						return false;
						exit;
					}
				}
			}
			public function getMarca() : string {
				return $this->marca ?? "Marca não informada !!";
			}

			public function setPreco(string $preco) {
				if(isset($preco) AND !empty($preco) AND is_string($preco)) {
					$this->preco = addslashes(htmlspecialchars(trim(str_replace(",",".",$preco)))) ?? null;
					return true;
				}else {
					echo error_get_last();
					return false;
					exit;
				}
			}
			public function getPreco() : string {
				return $this->preco ?? "Preõ não informado !!";
			}

			public function setCodigo(string $codigo) {
				if(isset($codigo) AND !empty($codigo) AND is_string($codigo)) {
					if(strlen($codigo) > 11) {
						echo error_get_last();
						return false;
						exit;
					}else {
						$this->codigo = addslashes(htmlspecialchars(trim($codigo))) ?? null;
						return true;
					}
				}
			}

			//define metodo auxiliar privado auxiliando na propriedade interna $codigo
			private function lenghtCodigo() {
				if(isset($this->codigo) AND strlen($this->codigo) > 11) {
					echo "O código informado " . $this->codigo . " não é valido !!";
				}else {
					echo "O código informado " . $this->codigo . " é valido !!";
				}
			}
			public function getCodigo() : string {
				$this->lenghtCodigo();
				return $this->codigo ?? "Código não informado !!";
			}

			public function setDescricao(string $descricao) {
				if(isset($descricao) AND !empty($descricao) AND is_string($descricao)) {
					if(strlen($descricao) >= 8) {
						$this->descricao = addslashes(htmlspecialchars(trim(ucfirst($descricao)))) ?? null;
						return true;
					}else {
						echo error_get_last();
						return false;
						exit;
					}
				}
			}
			public function getDescricao() : string {
				return $this->descricao ?? "Descrição não informada !!";
			}
		}
?>