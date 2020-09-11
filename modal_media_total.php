<div class="modal fade" id="ModalMediaTotal" role="dialog">
	<div class="modal-dialog shadow-sm modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header bg-light">
				<h5 class="modal-title text-dark bd-lead">Média Total</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					require_once "autoload.php";

					use \classes\produto\produtoDaoMysql;

					$produtoDaoMysql = new ProdutoDaoMysql();
					$produtoDaoMysql->getMediaTotalProdutos();
				?>
			</div>
			<div class="modal-footer bg-light">
				<button type="button" class="btn btn-danger btn-md shadow-sm" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>