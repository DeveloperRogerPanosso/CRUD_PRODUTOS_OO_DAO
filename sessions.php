<?php
		//define sessões referentes a ações executadas
		if(isset($_SESSION["insert_produto"]) AND !empty($_SESSION["insert_produto"])) {
			echo $_SESSION["insert_produto"];
			$_SESSION["insert_produto"] = null;
			unset($_SESSION["insert_produto"]);
		}

		if(isset($_SESSION["produto_existente"]) AND !empty($_SESSION["produto_existente"])) {
			echo $_SESSION["produto_existente"];
			$_SESSION["produto_existente"] = null;
			unset($_SESSION["produto_existente"]);
		}

		if(isset($_SESSION["update_produto"]) AND !empty($_SESSION["update_produto"])) {
			echo $_SESSION["update_produto"];
			$_SESSION["update_produto"] = null;
			unset($_SESSION["update_produto"]);
		}

		if(isset($_SESSION["delete_produto"]) AND !empty($_SESSION["delete_produto"])) {
			echo $_SESSION["delete_produto"];
			$_SESSION["delete_produto"] = null;
			unset($_SESSION["delete_produto"]);
		}
?>