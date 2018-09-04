<?php
	//include_once 'conexaoDB.php';
	include_once 'conexaoLocal.php';
	include_once 'SelectDB.php';

	$funcao = $_GET['action'];

    if(function_exists($_GET["action"])){
		//chama a funcao
		if($funcao == "SJF"){
			call_user_func($_GET["action"],$_GET["nomeProcesso"],$_GET["tamanho"],$_GET["status"]);
		}else if($funcao == "refresh"){
			call_user_func($_GET["action"],$_GET["status"]);
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
		 	//header("location: http://marcelorambo.com/jogo/processos.html");
		 	header("location: processos.html");
		 }else{
		 	echo "erro ao salvar";
		 }


	}


	function refresh($status){
		// 1 = novo   ,  2 = fila   ,  3 = processados


	$listaProcessos = SelectDB::getProcessosStatus($status);
	
	echo json_encode($listaProcessos);

	
	}

	function escalonador(){

		$novoProcesso = SelectDB::getPrimeiroProcessoStatus(1);

				foreach ($novoProcesso as $item) {
					updateStatus($item['id'],$item['status']);
				}

		$processar = SelectDB::getPrimeiroProcessoEscalonar();

				foreach ($processar as $item) {
					updateStatus($item['id'],$item['status']);
				}
		
	}

	function updateStatus($id, $statusAtual){

		$novoStatus = $statusAtual + 1;

		global $db;

		$inserido = false;

		$r = $db->prepare('UPDATE sjf SET status=:novoStatus  WHERE id=:id');

		$r->execute(array(
		':novoStatus'=>$novoStatus,
		':id'=>$id
		));
			

		if($r->rowCount() > 0) {
			$inserido = true;
		}

		return $inserido;

	}

?>
