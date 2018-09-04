<?php

	include_once 'SelectDB.php';

	$listaProcessos = SelectDB::getProcessosStatus(1);
	var_dump($listaProcessos);
?>