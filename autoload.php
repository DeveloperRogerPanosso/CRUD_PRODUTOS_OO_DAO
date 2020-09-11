<?php
		//define autoload realizando registro de instancia da classe e 
		//verificando em diretorio especifico se arquivo com implementação
		//da classe é exisnte de acordo com namespace definido
		spl_autoload_register(function($classe) {
			//echo "Classe Instanciada: " . $classe . "<br>\n";
			$diretorioBase = __DIR__."/".str_replace("\\", "/", $classe).".php";
			if(isset($diretorioBase) AND file_exists($diretorioBase)) {
				require_once $diretorioBase;
				//echo "Arquivo com implementação da classe existente !!";
				return true;
			}else {
				echo "Arquivo com implementação da classe iexistente !!";
				return false;
			}
		})
?>