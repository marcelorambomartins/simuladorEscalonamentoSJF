<?php
	include_once 'conexaoDB.php';
	//include_once 'conexaoLocal.php';

	class SelectDB{

		public static function getProcessosStatus($status){
			global $db;

			$r = $db->prepare('SELECT * FROM sjf where status=:status');
				$r->execute(array(':status' => $status));

				$linhas = $r->fetchAll(PDO::FETCH_ASSOC);

			return $linhas;
		}//fim do metodo

		public static function getProcessosEscalonar(){
			global $db;

			$resultado = $db->query('SELECT * FROM sjf where status = 2 ORDER BY tamanho ASC' );

			$linhas = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return $linhas;

		}//fim do metodo


		public static function getPrimeiroProcessoStatus($status){
			global $db;

			$resultado = $db->prepare('SELECT * FROM sjf where status=:status ORDER BY tamanho ASC Limit 1');
				$resultado->execute(array(':status' => $status));

			$linhas = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return $linhas;

		}//fim do metodo

		public static function getPrimeiroProcessoEscalonar(){
			global $db;

			$resultado = $db->query('SELECT * FROM sjf where status = 2 ORDER BY tamanho ASC Limit 1' );

			$linhas = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return $linhas;

		}//fim do metodo


	}//fim da classe

?>


