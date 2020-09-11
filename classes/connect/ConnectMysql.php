<?php
		//define namespace para classe seguindo nomenclatura de seu diretorio
		namespace classes\connect;

		class ConnectMysql {
			private static $connect;

			public static function getConnect() {
				if(!isset($connect)) {
					//cria instancia da classe PDO(objeto de conexão)
					self::$connect = new \PDO("mysql:dbname=b7web_php1_crud_dao_produtos;port=3306;host=localhost", "root", "");
					//echo "conexão estabelecida com suscesso !!";
				}
				return self::$connect;
			}
		}
?>