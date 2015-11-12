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
	<?php 
		require_once('connection.php'); 		
	?>
	
	angular.module('Resultados', ['chart.js']).controller('ResultsController', function($scope) {
		$scope.charts = [
			<?php $resultados = $db->query('SELECT * FROM resultados GROUP BY elementos ORDER BY elementos ASC'); ?>			
			<?php while($row = $resultados->fetchArray()): ?>
			{
				ID: "<?= 'resultados'.$row['elementos']; ?>",
				Data: [ [0, 0, 0, 0, 0], ],
				Labels: ['Shell Sort', 'Quick Sort', 'Merge Sort', 'Bin Sort', 'Radix Sort'],
				Navegador: "<?= $row['navegador']; ?>",
				Elementos: <?= $row['elementos']; ?>,
			},
			<?php endwhile; ?>			
		];

		<?php $resultados = $db->query('SELECT * FROM resultados ORDER BY elementos ASC '); ?>
		
		<?php while($row = $resultados->fetchArray()): ?>
			var elementos = <?= $row['elementos']; ?>;			
			for(var a = 0; a < $scope.charts.length; a++)
			{
				if($scope.charts[a].Elementos == elementos) {
					$scope.charts[a].Data[0][<?= $row['algoritmo']; ?>] = <?= $row['time']; ?>;
					console.log('Added '+<?= $row['time']; ?>);
				}
			}
		<?php endwhile; ?>

	});
</script>

<body ng-app='Resultados'>

<div class='container' ng-controller='ResultsController'>
	<span ng-repeat='chart in charts'>
		<center><h3>Algoritmos de Ordenação com	<i>{{chart.Elementos}}<i> Elementos rodando em <b>{{chart.Navegador}}</b></h3></center>
		<span class='row'><canvas id='{{chart.ID}}' width='500%' class='chart chart-bar' chart-data='chart.Data' chart-labels='chart.Labels'></canvas></span>	
		<hr>
	</span>
</div>

</body>