<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
<title>Projeto Alg.</title>
</head>

<script src="scripts/js/angular.min.js"></script>
<script src="scripts/js/jquery-1.11.3.min.js"></script>
<script src="scripts/js/bootstrap.min.js"></script>
<script src="scripts/js/Chart.min.js"></script>
<link rel="stylesheet" href="scripts/css/bootstrap.min.css">

<?php 

//require('php/functions.php');
//require('php/shell.php');

//require('php/.php');
//require('php/bin.php');
//require('php/bin.php');

?>

<script>
	var app = angular.module('MyApp', []);
	var current_actived = null;

	app.controller('OptionsController', function($scope) {
		$scope.buttons = [
			{Class: "btn btn-lg btn-info", Model: "SS", Value: "Shell Sort", Id: "shell.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "QS", Value: "Quick Sort", Id: "quick.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "MS", Value: "Merge Sort", Id: "merge.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "BS", Value: "Bin Sort", Id: "bin.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "RS", Value: "Radix Sort", Id: "radix.php", Actived: false},
		];

		$scope.fields = [
			{ID: "input", Model: "input", Name: "", Type: 'number', Class: "", Value: "", Label: "Quantidade de elementos no Array", Click: ""},			
			{ID: "repeat", Model: "repeat", Name: "repeat", Type: 'checkbox', Class: '', Value: "", Label: "Repetir números?", Click: ""},
			{ID: "decreased", Model: "decreased", Name: "decreased", Type: 'checkbox', Class: '', Value: "", Label: "Ordenar Decrementalmente?", Click: ""},
			{ID: "submit", Model: "submit", Name: "post", Type: 'button', Class: 'btn btn-lg btn-success', Value: "-", Label: "", Click: ""}
		];

		$scope.menu = {title: "", text: ""};
		$scope.resposta = {title: "", text: ""};
		//--------------------------------------------------------//

		$scope.getActiveButton = function() {
			for(var a = 0; a < $scope.buttons.length; a++) {
				if($scope.buttons[a].Actived) return $scope.buttons[a].Id;
			}				
		}

		$scope.select = function(button) 
		{
			$scope.menu.title = "Algoritmo de "+button.Value;
			for(index in $scope.buttons) 
			{
				var bt = $scope.buttons[index];
				if(bt.Actived) 
				{
					bt.Class = "btn btn-lg btn-info";
					bt.Actived = false;
				}
			}			

			button.Actived = true;
			current_actived = button;
			button.Class += " btn-danger";

			$scope.fields[$scope.fields.length-1].Value = "Processar "+button.Value;			
		};

		$scope.processar = function(element) 
		{
			if(element.Type != "button" && element.Type != "submit") return;
			var quantidade = document.getElementById('input').value;

			if(quantidade < 2) 
			{
				alert("Insira ao menos 2 valores para serem gerados.");
				return;
			}

			$.ajax({
				type: "POST",
				url: "php/Gerador.php",
				data: {quant: quantidade, type: ($scope.getActiveButton) },				
				dataType: "json",
				success: function(data) 
				{
					
				}
			});			
		}		
	});

</script>

<body ng-app="MyApp">

<div class="navbar navbar-default" style="background-color: orange; box-shadow: 1px 1px 1px #000">
	<div style='font-size: 36px; text-align: center; font-family: "Courier new"'>Trabalho de Construção de Algoritmos</div>
</div>

<div ng-controller="OptionsController">
	<center><span ng-repeat="button in buttons" ng-init="select(buttons[0])">
		<input type='button' ng-click="select(button); " ng-model="button.Model" class={{button.Class}} value={{button.Value}}>		
	</span></center><hr>
	<div ng-model='menu'>
		<center><h2>{{menu.title}}</h2></center>
		<center><div class='container' ng-repeat="field in fields">
			<div><label for="name">{{field.Label}}<input type={{field.Type}} id={{field.ID}} name={{field.Name}} class={{field.Class}} value={{field.Value}} ng-model="field.Model" ng-click="processar(field)" style='text-align: center'></label></div><br>			
		</div></center>
	</div><hr>
	<center><div>
		<h3>{{resposta.title}}</h3>
		<div id='resposta'>{{resposta.text}}</div>
	</div></center>
</div>




</body>