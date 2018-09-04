<?php
	//include_once 'conexaoDB.php';
	include_once 'conexaoLocal.php';
	include_once 'SelectDB.php';

	$dados = json_decode(file_get_contents("php://input"));
	$action = $dados ->action;

	echo $action;
?>