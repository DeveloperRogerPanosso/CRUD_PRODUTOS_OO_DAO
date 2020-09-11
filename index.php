<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<title>Inerir Produtos</title>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap-reboot.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/style.css"/>
</head>
<body>
	<article>
		<header>
			<div class="title">
				<div class="h1 text text-dark bd-lead text-center">Adicionar Produtos</div>
			</div>
		</header>
		<section>
			<div class="areaAlertInfo">
				<a class="link-striped text-primary" title="Visualizar Produtos Adicionados" href="select_produtos.php">Visualizar Produtos Adicionados</a>
				<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
					<span class='text text-dark bd-lead text-center'>
						Preencha os campos abaixo corretamente adicionando produtos !!
					</span>
				</div>
			</div>
			<div class="areaFormAdicionarProdutos">
				<form name="adicionar" method="POST" action="insert_produtos.php">
					<div class="form-row">
						<div class="col-sm-6 order-1">
							<div class="form-group">
								<label class="text text-dark bd-lead form-label" for="nome">Nome</label>
								<input type="text" name="nome" class="form-control form-control-md text-dark" autocomplete="off" placeholder=" Nome do Produto.. " id="nome" required/>
							</div>
						</div>
						<div class="col-sm-6 order-2">
							<div class="form-group">
								<label class="text text-dark bd-lead form-label" for="marca">Marca</label>
								<input type="text" name="marca" class="form-control form-control-md text-dark" autocomplete="off" placeholder=" Marca do Produto.. " id="marca" required/>
							</div>
						</div>
						<div class="col-sm-6 order-3">
							<div class="form-group">
								<label class="text text-dark bd-lead form-label" for="preco">Preço</label>
								<input type="text" name="preco" class="form-control form-control-md text-dark" autocomplete="off" placeholder=" Preço do Produto.. " id="preco" required/>
							</div>
						</div>
						<div class="col-sm-6 order-4">
							<div class="form-group">
								<label class="text text-dark bd-lead form-label" for="codigo">Código</label>
								<input type="text" name="codigo" class="form-control form-control-md text-dark" autocomplete="off" placeholder=" Código do Produto.. " id="codigo" required/>
							</div>
						</div>
						<div class="col-sm-12 order-5">
							<div class="form-group">
								<label class="text text-dark bd-lead form-label" for="descricao">Descrição</label>
								<textarea name="descricao" class="form-control form-control-md text-dark" rows="4" autocomplete="off" placeholder=" Descrição do Produto.. " id="descricao_produto" required></textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-6 order-1">
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-md shadow-sm">Adicionar</button>
								<button type="reset" class="btn btn-danger btn-md shadow-sm">Resetar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</article>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>
</body>
</html>