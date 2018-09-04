<?php
	include_once 'conexaoDB.php';
	//include_once 'conexaoLocal.php';
	include_once 'SelectDB.php';

	$funcao = $_GET['action'];

    if(function_exists($_GET["action"])){
		//chama a funcao
		if($funcao == "SJF"){
			call_user_func($_GET["action"],$_GET["nomeProcesso"],$_GET["tamanho"],$_GET["status"]);
		}else{
			call_user_func($_GET["action"]);
		}
		
	}else{
		echo "<br>funcao nao definida";
	}

	function SJF($nomeProcesso, $tamanho, $status){

		global $db;
			$inserido = false;

			$r = $db->prepare('INSERT INTO sjf(nomeProcesso,tamanho,status)
				VALUES (:nomeProcesso,:tamanho,:status)');

			$r->execute(array(
			':nomeProcesso'=>$nomeProcesso,
			':tamanho'=>$tamanho,
			':status'=>$status
			
			));

			if($r->rowCount() > 0) {
				$inserido = true;
			}

		 if($inserido){
		 	header("location: http://marcelorambo.com/jogo/processos.html");
		 	//header("location: processos.html");
		 }else{
		 	echo "erro ao salvar";
		 }


	}

?>
