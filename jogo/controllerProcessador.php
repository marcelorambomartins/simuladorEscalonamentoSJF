<?php
	include_once 'conexaoDB.php';
	//include_once 'conexaoLocal.php';
	include_once 'SelectDB.php';

	$post = json_decode(file_get_contents("php://input"));

	$action = $post->action;

    if(function_exists($action)){
		//chama a funcao
		if($action == "refresh"){
			call_user_func($action);
		}else if($action == "escalonador"){
			call_user_func($action,$post->status);
		}else{
			call_user_func($action);
		}
		
	}else{
		echo "<br>funcao nao definida";
	}


	function refresh(){
		// 1 = novo   ,  2 = fila   ,  3 = processados

	$listaProcessos = array();
	$listaProcessos = (object) $listaProcessos;

	$listaProcessos->novos = SelectDB::getProcessosStatus(1);
	$listaProcessos->fila = SelectDB::getProcessosEscalonar();
	$listaProcessos->processados = SelectDB::getProcessosStatus(3);

	
	echo json_encode($listaProcessos);

	
	}

	function escalonador($status){

		if($status == 2){

				$novoProcesso = SelectDB::getPrimeiroProcessoStatus(1);

				foreach ($novoProcesso as $item) {
					updateStatus($item['id'],$item['status']);
				}
		}else{

				$processar = SelectDB::getPrimeiroProcessoEscalonar();

				foreach ($processar as $item) {
					updateStatus($item['id'],$item['status']);
				}
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
