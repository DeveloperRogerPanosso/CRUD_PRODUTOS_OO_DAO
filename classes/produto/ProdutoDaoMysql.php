<?php
		namespace classes\produto;

		//referencia namespace em que a classe ConnectMysql está localizada
		use \classes\connect\ConnectMysql;

		//inclui classe Produto Para utilização de seus metodos
		require_once "classes/produto/Produto.php";

		//inclui interface da Classe ProdutoDaoMysql implementando procedimentos
		require_once "InterfaceProcedimentosProdutoDaoMysql.php";

		class ProdutoDaoMysql implements ProcedimentosProdutoDaoMysql {
			public function insertProduto(Produto $insert) {
				$query = "SELECT * FROM produtos WHERE nome = :nome AND marca = :marca 
				AND preco = :preco AND codigo = :codigo AND descricao = :descricao";
				$query = ConnectMysql::getConnect()->prepare($query);
				$query->bindValue(":nome", $insert->getNome());
				$query->bindValue(":marca", $insert->getMarca());
				$query->bindValue(":preco", $insert->getPreco());
				$query->bindValue(":codigo", $insert->getCodigo());
				$query->bindValue(":descricao", $insert->getDescricao());
				$query->execute();

				if($query->rowCount() === 0) {
					$query = "INSERT INTO produtos (nome,marca,preco,codigo,descricao) 
					VALUES (:nome, :marca, :preco, :codigo, :descricao)";
					$query = ConnectMysql::getConnect()->prepare($query);
					$query->bindValue(":nome", $insert->getNome());
					$query->bindValue(":marca", $insert->getMarca());
					$query->bindValue(":preco", $insert->getPreco());
					$query->bindValue(":codigo", $insert->getCodigo());
					$query->bindValue(":descricao", $insert->getDescricao());
					$query->execute(); //executa consulta no servidor Mysql

					if($query->rowCount() > 0) {
						session_start();
						$_SESSION["insert_produto"] = "
						<div class='alert alert-success fade show alert-dismissible shadow-sm alertSuccess' role='alert'>
							<span class='text-light bd-lead text-center'>
								<a class='close' href='#' data-dismiss='alert' aria-label='close'>
									<span aria-hidden='true'>&times;</span>
								</a>
								Produto Inserido com Suscesso !!
							</span>
						</div>";
						header("Location: select_produtos.php");
						return true;
					}else {
						echo "<span class='text-danger bd-lead'>Não há dados de produtos cadastrados !!</span>";
						header("Location: select_produtos.php");
						return false;
					}
				}else {
					session_start();
					$_SESSION["produto_existente"] = "
					<div class='alert alert-danger fade show alert-dismissible shadow-sm alertDanger' role='alert'>
						<span class='text-light bd-lead text-center'>
							<a class='close' href='#' data-dismiss='alert' aria-label='close'>
								<span aria-hidden='true'>&times;</span>
							</a>
							Produto a ser Inserido já existente !!
						</span>
					</div>";
					header("Location: index.php");
					return false;
				}
			}

			public function getProdutosAll() {
?>
			<form name="ordenacao_results" method="GET">
				<div class="form-row">
					<div class="col-sm-3 order-1">
						<div class="form-group">
							<label class="text-dark bd-lead form-label" for="ordenar">Ordenar</label>
							<?php
								//recebe variavel por via GET(URL) recebdo dados do ordenacao
								$ordenacao = addslashes(filter_input(INPUT_GET, "ordenacao", FILTER_SANITIZE_SPECIAL_CHARS));
								if(isset($ordenacao) AND !empty($ordenacao) AND is_string($ordenacao)) {
									$query = "SELECT * FROM produtos ORDER BY {$ordenacao} ASC";
								}else {
									$ordenacao = null;
									$query = "SELECT * FROM produtos ORDER BY id ASC";
								}
							?>
							<select name="ordenacao" class="form-control form-control-md text-dar" autocomplete="off" id="ordencao" onchange="this.form.submit()">
								<option class="text-dark bd-lead" value="id" <?=($ordenacao == "id")?"selected=selected":"";?>>Ordenar por Id</option>
								<option class="text-dark bd-lead" value="nome" <?=($ordenacao == "nome")?"selected=selected":"";?>>Ordenar por Nome</option>
								<option class="text-dark bd-lead" value="marca" <?=($ordenacao == "marca")?"selected=selected":"";?>>Ordenar por Marca</option>
								<option class="text-dark bd-lead" value="preco" <?=($ordenacao == "preco")?"selected=selected":"";?>>Ordenar por Preço</option>
								<option class="text-dark bd-lead" value="codigo" <?=($ordenacao == "codigo")?"selected=selected":"";?>>Ordenar por Código</option>
								<option class="text-dark bd-lead" value="descricao" <?=($ordenacao == "descricao")?"selected=selected":"";?>>Ordenar por Descrição</option>
							</select>
						</div>
					</div>
				</div>
			</form>
			<div class="table-responsive-sm">
				<table class="table table-striped table-hover table-md">
					<caption class="text-primary bd-lead font-italic">List Of Products</caption>
					<thead class="thead-dark text-center">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nome</th>
							<th scope="col">Marca</th>
							<th scope="col">Preço</th>
							<th scope="col">Código</th>
							<th scope="col">Descrição</th>
							<th scope="col">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//executa consulta no servidor mysql
							$query = ConnectMysql::getConnect()->query($query);

							if($query->rowCount() > 0) {
								$dadosProdutos = $query->fetchAll(\PDO::FETCH_ASSOC);
								foreach ($dadosProdutos as $value) {
						?>
								<tr>
									<td class="text-dark text-center"><?=$value["id"];?></td>
									<td class="text-dark text-center"><?=$value["nome"];?></td>
									<td class="text-dark text-center"><?=$value["marca"];?></td>
									<td class="text-dark text-center">R$ <?=str_replace(",",".",$value["preco"]);?></td>
									<td class="text-dark text-center"><?=$value["codigo"];?></td>
									<td class="text-dark text-center">
										<a class="link-striped text-primary" href="#" data-toggle="modal" data-target="#ModalDescricaoProduto<?=$value['id'];?>">Descrição</a>
										<div class="modal fade" id="ModalDescricaoProduto<?=$value['id'];?>" role='dialog'>
											<div class="modal-dialog shadow-sm modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header text-dark bd-lead bg-light">
														<h5 class="modal-title text-dark bd-lead">Produto <?=$value["nome"];?></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<span class="text-dark bd-lead">
															<?=$value["descricao"];?>
														</span>
													</div>
													<div class="modal-footer bg-light">
														<button type="button" class="btn btn-danger btn-md shadow-sm" data-dismiss="modal">Fechar</button>
													</div>
												</div>
											</div>
										</div>
									</td>
									<td class="text-dark text-center">
										<a class="link-striped text-success" href="editar.php?IdProduto=<?=$value['id'];?>">Editar</a> - 
										<a class="link-striped text-danger" href="excluir.php?IdProduto=<?=$value['id'];?>" onclick="return confirm('Tem certeza de que deseja excluir este Produto ?')">Excluir</a>
									</td>
								</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
<?php
			}

			public function getSelectProdutoId(Produto $selectProdutoId) {
				$query = "SELECT * FROM produtos WHERE id = :id_produto";
				$query = ConnectMysql::getConnect()->prepare($query);
				$query->bindValue(":id_produto", $selectProdutoId->getId());
				$query->execute();

				//testa se consulta obteve valor de retorno maior que 0
				if($query->rowCount() > 0) {
					$dadosProduto = $query->fetch(\PDO::FETCH_ASSOC);
?>
					<form name="editar" method="POST" action="update_produtos.php">
						<div class="form-row">
							<div class="col-sm-6 order-1">
								<div class="form-group">
									<label class="text-dark bd-lead form-label" for="Nome">Nome</label>
									<input type="hidden" name="id_produto" value="<?=$dadosProduto['id'];?>"/>
									<input type="text" name="nome" class="form-control form-control-md text-dark" autocomplete="off" value="<?=$dadosProduto['nome'];?>"/>
								</div>
							</div>
							<div class="col-sm-6 order-2">
								<div class="form-group">
									<label class="text-dark bd-lead form-label" for="marca">Marca</label>
									<input type="text" name="marca" class="form-control form-control-md text-dark" autocomplete="off" value="<?=$dadosProduto['marca'];?>"/>
								</div>
							</div>
							<div class="col-sm-6 order-3">
								<div class="form-group">
									<label class="text-dark bd-lead form-label" for="preco">Preço</label>
									<input type="text" name="preco" class="form-control form-control-md text-dark" autocomplete="off" value="<?=$dadosProduto['preco'];?>"/>
								</div>
							</div>
							<div class="col-sm-6 order-4">
								<div class="form-group">
									<label class="text-dark bd-lead form-label" for="codigo">Preço</label>
									<input type="text" name="codigo" class="form-control form-control-md text-dark" autocomplete="off" value="<?=$dadosProduto['codigo'];?>"/>
								</div>
							</div>
							<div class="col-sm-12 order-5">
								<div class="form-group">
									<label class="text-dark bd-lead form-label" for="descricao">Descrição</label>
									<input type="text" name="descricao" autocomplete="off" class="form-control form-control-md text-dark" value="<?=$dadosProduto['descricao'];?>">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-6 order-1">
								<div class="form-group">
									<button type="submit" class="btn btn-success btn-md shadow-sm">Editar</button>
								</div>
							</div>
						</div>
					</form>
<?php
				}else {
					echo "<span class='text-danger bd-lead'>Não há dados de cadastro de produto de acordo com id</span>";
					header("Location: select_produtos.php");
					return false;
				}
			}

			public function updateProduto(Produto $updateProduto) {
				$query = "UPDATE produtos SET nome = :nome, marca = :marca, preco = :preco, 
				codigo = :codigo, descricao = :descricao WHERE id = :id_produto";
				$query = ConnectMysql::getConnect()->prepare($query);
				$query->bindValue(":nome", $updateProduto->getNome());
				$query->bindValue(":marca", $updateProduto->getMarca());
				$query->bindValue(":preco", $updateProduto->getPreco());
				$query->bindValue(":codigo", $updateProduto->getCodigo());
				$query->bindValue(":descricao", $updateProduto->getDescricao());
				$query->bindValue(":id_produto", $updateProduto->getId());
				$query->execute();

				if($query->rowCount() > 0) {
					session_start();
					$_SESSION["update_produto"] = "
					<div class='alert alert-success fade show alert-dismissible shadow-sm alertSuccess' role='alert'>
						<span class='text-light bd-lead text-center'>
							<a class='close' href='#' data-dismiss='alert'aria-label='close'>
								<span aria-hidden='true'>&times;</span>
							</a>
							Produto Atualizado com suscesso. Em id: " . $updateProduto->getId() . " !!
						</span>
					</div>";
					header("Location: select_produtos.php");
					return true;
				}else {
					header("Location: select_produtos.php");
					return false;
				}
			}

			public function deleteProduto(Produto $deleteProduto) {
				$query = "DELETE FROM produtos WHERE id = :id_produto";
				$query = ConnectMysql::getConnect()->prepare($query);
				$query->bindValue(":id_produto", $deleteProduto->getId());
				$query->execute();

				if($query->rowCount() > 0) {
					session_start();
					$_SESSION["delete_produto"] = "
					<div class='alert alert-danger fade show alert-dismissible shadow-sm alertDanger' role='alert'>
						<span class='text-light bd-lead text-center'>
							<a class='close' href='#' data-dismiss='alert' aria-label='close'>
								<span aria-hidden='true'>&times;</span>
							</a>
							Produto Excluido com Suscesso. Id: " . $deleteProduto->getId() . " !!
						</span>
					</div>";
					header("Location: select_produtos.php");
					return true;
				}else {
					header("Location: select_produtos.php");
					return false;
				}
			}

			public function getSomaTotalProdutos() {
				$query = "SELECT SUM(preco) AS soma_total FROM produtos";
				$query = ConnectMysql::getConnect()->query($query);

				if($query->rowCount() > 0) {
					$soma_total = $query->fetch(\PDO::FETCH_ASSOC);
					echo "<strong>Soma Total: </strong>R$ " 
					. str_replace(".",",",number_format($soma_total["soma_total"], 2)) . "<br>\n";
					return true;
				}else {
					return false;
				}
			}

			public function getMediaTotalProdutos() {
				$query = "SELECT AVG(preco) AS media_total FROM produtos";
				$query = ConnectMysql::getConnect()->query($query);

				if($query->rowCount() > 0) {
					$media_total = $query->fetch(\PDO::FETCH_ASSOC);
					echo "<strong>Média Total: </strong>R$ "
					. str_replace(".", ",", number_format($media_total["media_total"], 2)) . "<br>\n";
					return true;
				}else {
					return false;
				}
			}
		}
?>