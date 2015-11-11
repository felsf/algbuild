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

<script>
	var app = angular.module('MyApp', ['chart.js']);
	var current_actived = null;

	app.controller('OptionsController', function($scope) 
	{
		$scope.charts = [
			{
				ID: "Modal0",
				Name: "Shell Sort",
				Label: [], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[],], // Data
				Previous: "#Modal4",
				Next: "#Modal1"
			},
			{
				ID: "Modal1",
				Name: "Quick Sort",
				Label: [], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[],], // Data
				Previous: "#Modal0",
				Next: "#Modal2"
			},
			{
				ID: "Modal2",
				Name: "Merge Sort",
				Label: [], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[],], // Data
				Previous: "#Modal1",
				Next: "#Modal3"
			},
			{
				ID: "Modal3",
				Name: "Bin Sort",
				Label: [], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[],], // Data
				Previous: "#Modal2",
				Next: "#Modal4"
			},
			{
				ID: "Modal4",
				Name: "Radix Sort",
				Label: [], // Label
				Serie: ["Serie A"],	// Serie
				Data: [[],], // Data
				Previous: "#Modal3",
				Next: "#Modal0"
			},

		];		

		$scope.buttons = [
			{PK: 0, Class: "btn btn-lg btn-info", Model: "SS", Value: "Shell Sort", Id: "Shell.php", Actived: false},
			{PK: 1, Class: "btn btn-lg btn-info", Model: "QS", Value: "Quick Sort", Id: "Quick.php", Actived: false},
			{PK: 2, Class: "btn btn-lg btn-info", Model: "MS", Value: "Merge Sort", Id: "Merge.php", Actived: false},
			{PK: 3, Class: "btn btn-lg btn-info", Model: "BS", Value: "Bin Sort", Id: "Bin.php", Actived: false},
			{PK: 4, Class: "btn btn-lg btn-info", Model: "RS", Value: "Radix Sort", Id: "Radix.php", Actived: false},
		];

		$scope.fields = [
			{ID: "input", Model: "input", Name: "", Type: 'number', Class: "", Value: "", Label: "Quantidade de elementos no Array", Click: ""},			
			{ID: "repeat", Model: "repeat", Name: "repeat", Type: 'checkbox', Class: '', Value: "", Label: "Repetir números?", Click: ""},
			{ID: "decreased", Model: "decreased", Name: "decreased", Type: 'checkbox', Class: '', Value: "", Label: "Ordenar Decrementalmente?", Click: ""},
			{ID: "submitButton", Model: "submit", Name: "post", Type: 'button', Class: 'btn btn-lg btn-success', Value: "-", Label: "", Click: "disable()"}
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
				if($scope.buttons[a].Actived) return $scope.buttons[a].PK;
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
				url: "php/"+$scope.getActiveButton(),
				data: {quant: quantidade, repeat: document.getElementById('repeat').checked},				
				dataType: "html",
				success: function(data) 
				{
					$("#resposta").hide(1000, function() {
						$(this).fadeIn(1000);
					});					

					$("#submitButton").fadeIn(1000);

					//console.log("Grafico: "+$scope.charts[$scope.getButtonValue()].ID);
					var Chart = $scope.getButtonValue();
					$scope.charts[Chart].Label.push($scope.charts[Chart].Label.length + 1);
					$scope.charts[Chart].Data[0].push(data);


					$scope.resposta.title = "Resultados do procedimento";
					$scope.resposta.text = "Tempo de processamento: "+data+" ms.";
				}
			});			
		}		
						
	});

	$(window).ready(function() {
		document.getElementById('repeat').checked = true; // Marcando a caixinha de Repeat no início!
	});	

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
			<div><label for="name">{{field.Label}}<input type={{field.Type}} id={{field.ID}} name={{field.Name}} class="{{field.Class}}" value="{{field.Value}}" ng-model="field.Model" ng-click="processar(field);" style='text-align: center;'></label></div><br>			
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