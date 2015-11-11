<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
<title>Projeto Alg.</title>
</head>

<script src="scripts/js/angular.min.js"></script>
<script src="scripts/js/jquery-1.11.3.min.js"></script>
<script src="scripts/js/bootstrap.min.js"></script>
<script src="scripts/js/Chart.min.js"></script>
<script src="scripts/js/angular-chart.min.js"></script>

<link rel="stylesheet" href="scripts/css/bootstrap.min.css">
<link rel="stylesheet" href="scripts/css/angular-chart.min.css">

<?php 

//require('php/functions.php');
//require('php/shell.php');

//require('php/.php');
//require('php/bin.php');
//require('php/bin.php');

?>

<script>
	var app = angular.module('MyApp', ['chart.js']);
	var current_actived = null;

	app.controller('OptionsController', function($scope) 
	{
		$scope.charts = [
			{
				ID: "Modal0",
				Name: "Shell Sort",
				Label: [1, 2, 3, 4, 5], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[20,40,10,25,49],], // Data
				Previous: "#Modal4",
				Next: "#Modal1"
			},
			{
				ID: "Modal1",
				Name: "Quick Sort",
				Label: [1, 2, 3, 4, 5, 6], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[1, 3, 5, 7, 9],], // Data
				Previous: "#Modal0",
				Next: "#Modal2"
			},
			{
				ID: "Modal2",
				Name: "Merge Sort",
				Label: [1, 2, 3, 4, 5], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[20,40,10,25,49],], // Data
				Previous: "#Modal1",
				Next: "#Modal3"
			},
			{
				ID: "Modal3",
				Name: "Bin Sort",
				Label: [1, 2, 3, 4, 5, 6], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[1, 3, 5, 7, 9],], // Data
				Previous: "#Modal2",
				Next: "#Modal4"
			},
			{
				ID: "Modal4",
				Name: "Radix Sort",
				Label: [1, 2, 3, 4, 5, 6], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[1, 3, 5, 7, 9],], // Data
				Previous: "#Modal3",
				Next: "#Modal0"
			},

		];		

		$scope.buttons = [
			{Class: "btn btn-lg btn-info", Model: "SS", Value: "Shell Sort", Id: "Shell.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "QS", Value: "Quick Sort", Id: "Quick.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "MS", Value: "Merge Sort", Id: "Merge.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "BS", Value: "Bin Sort", Id: "Bin.php", Actived: false},
			{Class: "btn btn-lg btn-info", Model: "RS", Value: "Radix Sort", Id: "Radix.php", Actived: false},
		];

		$scope.fields = [
			{ID: "input", Model: "input", Name: "", Type: 'number', Class: "", Value: "", Label: "Quantidade de elementos no Array", Click: ""},			
			{ID: "repeat", Model: "repeat", Name: "repeat", Type: 'checkbox', Class: '', Value: "", Label: "Repetir números?", Click: ""},
			{ID: "decreased", Model: "decreased", Name: "decreased", Type: 'checkbox', Class: '', Value: "", Label: "Ordenar Decrementalmente?", Click: ""},
			{ID: "submit", Model: "submit", Name: "post", Type: 'button', Class: 'btn btn-lg btn-success', Value: "-", Label: "", Click: ""}
		];		

		$scope.menu = {title: "", text: ""};
		$scope.resposta = {title: "-", text: "-"};
		$scope.resultados = [ [], [], [], [], [] ];

		//--------------------------------------------------------//

		$scope.getActiveButton = function() {
			for(var a = 0; a < $scope.buttons.length; a++) {
				if($scope.buttons[a].Actived) return $scope.buttons[a].Id;
			}				
		}

		$scope.getButtonValue = function() {
			for(var a = 0; a < $scope.buttons.length; a++) {
				if($scope.buttons[a].Actived) return $scope.buttons[a].Value;
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
				dataType: "html",
				success: function(data) 
				{
					$("#resposta").hide(1000, function() {
						$(this).fadeIn(1000);
					});

					$scope.charts($scope.getButtonValue();


					$scope.resposta.title = "Resultados do procedimento";
					$scope.resposta.text = "Tempo de processamento: "+data+" ms.";
				}
			});			
		}

		var chartList = new Array(5);
		var dataList = new Array(5);	

		$scope.loadGraphics = function()
		{
			for(a = 0; a < chartList.length; a++)
			{
				var data = 
				{
					labels: ["1", "2", "3"],
					datasets: 
					[
						{
							label: "My First Dataset",
							fillColor: "rgba(220, 220, 220, 0.2)",
							strokeColor: "rgba(220, 220, 220, 1)",
							pointColor: "rgba(220, 220, 220, 1)",
							pointStrokeColor: "orange",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220, 220, 220, 1)",
							data: [5, 12, 15]
						}
					]
				};

				dataList[a] = data;
				var div = "chart"+a;				
				var element = document.getElementById("chart0").getContext("2d");
				chartList[a] = new Chart(element).Line(dataList[a], {animationSteps: 15});							
			}		
		}				
	});
	
	//var quant = 5;
	
	function test() {
		var data = 
			{
				labels: ["1", "2", "3"],
				datasets: 
				[
					{
						label: "My First Dataset",
						fillColor: "rgba(220, 220, 220, 0.2)",
						strokeColor: "rgba(220, 220, 220, 1)",
						pointColor: "rgba(220, 220, 220, 1)",
						pointStrokeColor: "orange",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220, 220, 220, 1)",
						data: [5, 12, 15]
					}
				]
			};
		var element = document.getElementById("chart0").getContext("2d");
		var gc = new Chart(element).Line(data, {responsive: false});
	}

	$("#graphicsModal0").on('shown.bs.modal', function(event) {

	});

	function add(time) 
	{		
		gc.addData([document.getElementById('digitador').value], data.labels.length+1);  		  		
  		gc.update();
  	}  	

</script>

<style>
	#btn-graphics:hover
	{
		background-color: green;		
		border: none;
	}
</style>

<body ng-app="MyApp" onLoad="">

<div class="navbar navbar-default" style="background-color: orange; box-shadow: 1px 1px 1px #000">
	<div style='font-size: 36px; text-align: center; font-family: "trebuchet"'>Trabalho de Construção de Algoritmos</div>
</div>

<div ng-controller="OptionsController">
	<center><span ng-repeat="button in buttons" ng-init="select(buttons[0]); loadGraphics()">
		<input type='button' ng-click="select(button); " ng-model="button.Model" class={{button.Class}} value={{button.Value}}>		
	</span><br><br><input type='button' id='btn-graphics' data-toggle="modal" data-target="#Modal0" class='btn btn-lg btn-warning' value='Graphics!'>
	</center><hr>
	<div ng-model='menu'>
		<center><h2>{{menu.title}}</h2></center>
		<center><div class='container' ng-repeat="field in fields">
			<div><label for="name">{{field.Label}}<input type={{field.Type}} id={{field.ID}} name={{field.Name}} class={{field.Class}} value={{field.Value}} ng-model="field.Model" ng-click="processar(field)" style='text-align: center'></label></div><br>			
		</div></center>
	</div><hr>
	<center><div id='resposta'>
		<h3>{{resposta.title}}</h3>
		<div>{{resposta.text}}</div>
	</div></center><hr>

	<div ng-repeat="chart in charts">
		<div class='modal fade' id="{{chart.ID}}">
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header' style='font-size: 20px'>Algoritmo de {{chart.Name}}</div>
					<div class='modal-body'>
						<canvas id="chart.ID" width="500%" class="chart chart-line" chart-data="chart.Data" chart-labels="chart.Label"></canvas>
					</div>
					<div class='modal-footer'>
						<button class='btn-lg btn-info' data-dismiss='modal' data-toggle='modal' data-target="{{chart.Previous}}">Previous Chart</button>
						<button class='btn-lg btn-success' data-dismiss='modal' data-toggle='modal' data-target="{{chart.Next}}">Next Chart</button>
					</div>
				</div>				
			</div>		
		</div>		
	</div>	

	<!-- <input type="number" ng-model="inputer">
	<button ng-click="d[0].push(inputer); l.push(l[l.length-1]+1)">Added</button> -->
</div>

</body>