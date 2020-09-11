<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<title>Select Produtos</title>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap-reboot.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/style.css"/>
</head>
<body>
	<article>
		<header>
			<div class="title">
				<div class="h1 text text-dark bd-lead text-center">Produtos</div>
			</div>
		</header>
		<section>
			<div class="areaAlertInfo">
				<a class="link-striped text-primary mr-2" title="Adicionar Produtos" href="index.php">Adicioinar Produtos</a>
				<a class="link-striped text-primary mr-2" title="Soma Total" href="#" data-toggle="modal" data-target="#ModalSomaTotal">Soma Total</a>
				<a class="link-striped text-primary" title="Média Total" href="#" data-toggle="modal" data-target="#ModalMediaTotal">Média Total</a>
				<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
					<span class='text text-dark bd-lead text-center'>
						Segue Abaixo os seguintes produtos adicionados !!
					</span>
				</div>
				<?php require_once "sessions.php"; ?>
			</div>
			<div class="areaSelectProdutos">
				<?php
					require_once "autoload.php";

					use \classes\produto\ProdutoDaoMysql;

					$selectProdutos = new ProdutoDaoMysql();
					$selectProdutos->getProdutosAll();
				?>
			</div>
		</section>
	</article>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>
	<?php
		require_once "modal_soma_total.php"; 
		require_once "modal_media_total.php"; 
	?>
</body>
</html>