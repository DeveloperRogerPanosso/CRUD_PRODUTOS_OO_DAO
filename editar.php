<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<title>Editar Produto</title>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap-reboot.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/style.css"/>
</head>
<body>
	<article>
		<header>
			<div class="title">
				<div class="h1 text-dark bd-lead page-header">Editar Produtos</div>
			</div>
		</header>
		<section>
			<div class="areaAlertInfo">
				<div class="alert alert-info fade show alert-dismissible shadow-sm" role="alert">
					<span class="text-dark bd-lead text-center">
						Atualize os dados nescessários abaixo relacionado ao Produto !!
					</span>
				</div>
			</div>
			<div class="areaFormAdicionarProdutos">
				<?php
					require_once "autoload.php";

					use \classes\produto\Produto;
					use \classes\produto\ProdutoDaoMysql;

					//recebe id vindo da requisicao via URL(GET) para atualização de produto
					$id_produto = addslashes(filter_input(INPUT_GET, "IdProduto", FILTER_SANITIZE_SPECIAL_CHARS));
					if($id_produto == true) {
						$selectProdutoId = new Produto();
						$selectProdutoId->setId($id_produto);

						$produtoDaoMysql = new ProdutoDaoMysql();
						$produtoDaoMysql->getSelectProdutoId($selectProdutoId);
					}
				?>
			</div>
		</section>
	</article>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>
</body>
</html>