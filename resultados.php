<?php 

/*
* 0 -> Shell Sort
* 1 -> Quick Sort
* 2 -> Merge Sort
* 3 -> Bin Sort
* 4 -> Radix Sort
*/

require_once('connection.php');

?>

<script src="scripts/js/angular.min.js"></script>
<script src="scripts/js/jquery-1.11.3.min.js"></script>
<script src="scripts/js/bootstrap.min.js"></script>
<script src="scripts/js/Chart.min.js"></script>
<script src="scripts/js/angular-chart.min.js"></script>

<link rel="stylesheet" href="scripts/css/bootstrap.min.css">
<link rel="stylesheet" href="scripts/css/angular-chart.min.css">

<script>
	angular.module('Resultados', ['chart.js']).controller('ResultsController', function($scope) {
			$scope.charts = [
			<?php for($a = 0; $a < intval($db->query('SELECT COUNT(*) from resultados')->fetchArray()); $a++): ?>
				<?php $resultados = $db->query('SELECT * FROM resultados GROUP BY resultado_id'); ?>
				<?php while($row = $resultados->fetchArray()): ?>
				{
					ID: "<?= 'resultados'.$row['resultado_id']; ?>",
					ResultadoID: <?= $row['resultado_id']; ?>,
					Teste: "<?= $row['teste']; ?>",
					ResultadoID: <?= $row['resultado_id']; ?>,
					Data: [ [0, 0, 0, 0, 0], ],
					Labels: ['Shell Sort', 'Quick Sort', 'Merge Sort', 'Bin Sort', 'Radix Sort'],
					Navegador: "<?= $row['navegador']; ?>",
					Elementos: <?= $row['elementos']; ?>,
					Info: "",	
				},
				<?php endwhile; ?>
			<?php endfor; ?>			
						
		];

		<?php $resultados = $db->query('SELECT * FROM resultados ORDER BY resultado_id '); ?>
		
		<?php for($b = 0; $row = $resultados->fetchArray(); $b++): ?>
			var id = <?= $row['resultado_id']; ?>;				

			for(var a = 0; a < $scope.charts.length; a++)
			{
				if($scope.charts[a].ResultadoID == id) {
					$scope.charts[a].Data[0][<?= $row['algoritmo']; ?>] = <?= $row['content']; ?>;					
					$scope.charts[a].Info += ($scope.charts[a].Labels[<?= $b % 5; ?>]+": "+<?= $row['content']; ?>+ (($scope.charts[a].Teste == "Temporization") ?  " ms." : (($scope.charts[a].Teste == "Exchange") ? " trades." : " MBs"))+  " --- ");						
					console.log($scope.charts[a].Info);
				}
			}

		<?php endfor; ?>

	});
</script>

<body ng-app='Resultados'>

<div class='container' ng-controller='ResultsController'>	
	<span ng-repeat='chart in charts'>
		<center>
		<h3>Algoritmos de Ordenação com	<i>{{chart.Elementos}}<i> Elementos rodando em <b>{{chart.Navegador}}</b> - Resultado ID: {{chart.ResultadoID}}<br><br>
		Teste de <b>{{chart.Teste}}<b></h3></center>
		<span class='row'><canvas id='{{chart.ID}}' width='500%' class='chart chart-bar' chart-data='chart.Data' chart-labels='chart.Labels'></canvas></span>	
		<center><i>** {{chart.Info}}</i></center>
		<hr>
	</span>
</div>

</body>