<?php


		/////////fazer refresh////////////
		/*
		$page = $_SERVER['PHP_SELF'];
		$sec = "10";
		header("Refresh: $sec; url=$page");
		*/
?>

<!DOCTYPE html>
	<head>

	<meta charset="utf-8">

	<title>Processador</title>

	<link rel="stylesheet" type="text/css" href="estilos2.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>


  	<script>

  		var myapp = angular.module('myapp', []);

		myapp.controller('mainController',function($scope,$http,$interval){


  			$scope.refresh = function (){
  				

                $http({

					method: 'POST',
					url: 'controllerProcessador.php',
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: 
					{  
						action: 'refresh'
					}

					}).then(function successCallback(response) {
						console.log(response.data);

						$scope.dados = response.data;

					}, function errorCallback(response) {
						console.log(response);
					});
  				
  			}


  			$scope.escalonador = function (status){
  				

                $http({

					method: 'POST',
					url: 'controllerProcessador.php',
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: 
					{  
						action: 'escalonador',
						status: status
					}

					}).then(function successCallback(response) {
						console.log(response.data);

						$scope.dados = response.data;

					}, function errorCallback(response) {
						console.log(response);
					});
  				
  			}


  			
  			$scope.init = function () {
    			$scope.refresh();
			}


			$interval(function(){$scope.refresh()}, 1000);
			$interval(function(){$scope.escalonador(2)}, 10000);
			$interval(function(){$scope.escalonador(3)}, 20000);

  		});

  		
  	</script>


	</head>
	<body ng-app="myapp">

	<div class="container" ng-controller="mainController" ng-init="init()">

		<div id="color" class="jumbotron">
			<h1>Processador</h1>
			<p>
				<h3>Executando... {{dados.fila[0].nomeProcesso}}</h3>
			</p>
		</div>

		<div class="container-fluid">
		  
		  <div class="row">
		    <div class="col-sm-4">
		      <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h1>Novos</h1>
		        </div>
		        <div class="panel-body">
			        <table class="table">
					  <tr>
					    <th>Nome Processo</th>
					    <th>Tamanho</th> 
					  </tr>

					  <tr ng-repeat="item in dados.novos">
					  		<td>{{item.nomeProcesso}}</td>
					  		<td>{{item.tamanho}}</td>
					  </tr>

					  		
					</table>
		        </div>
		      </div> 
		    </div> 
		    <div class="col-sm-4">
		      <div class="panel panel-default text-center" id="color">
		        <div class="panel-heading">
		          <h1>Fila</h1>
		        </div>
		        <div class="panel-body">
		          	<table class="table">
					  <tr>
					    <th>Nome Processo</th>
					    <th>Tamanho</th> 
					  </tr>

						<tr ng-repeat="item in dados.fila">
					  		<td>{{item.nomeProcesso}}</td>
					  		<td>{{item.tamanho}}</td>
					    </tr>

					</table>
		        </div>
		      </div> 
		    </div> 
		   <div class="col-sm-4">
		      <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h1>Processados</h1>
		        </div>
		        <div class="panel-body">
		          	<table class="table">
					  <tr>
					    <th>Nome Processo</th>
					    <th>Tamanho</th> 
					  </tr>

						  <tr ng-repeat="item in dados.processados">
					  		<td>{{item.nomeProcesso}}</td>
					  		<td>{{item.tamanho}}</td>
					      </tr>

					</table>
		        </div>
		      </div> 
		    </div> 
		  </div>
		</div>
		
	</div>

	</body>
</html>
