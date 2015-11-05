<script src="scripts/js/angular.min.js"></script>
<script src="scripts/js/jquery-1.11.3.min.js"></script>
<script src="scripts/js/bootstrap.min.js"></script>
<script src="scripts/js/Chart.min.js"></script>
<link rel="stylesheet" href="scripts/css/bootstrap.min.css">

<table class='table table-bordered table-responsive' style='font-family: "Arial"; font-size: 12px;'>	
	<th>APS</th>
	<th>OL</th>
	<th>Usercode</th>		
	
	<?php for($a = 0, $b = 0, $c = 0; $a < 36; $a++, $b += 3, $c += 4): ?>
		<tr style='text-align: center'>			
			<td class='danger'><?= $a+1 ?></td>
			<td class='warning'><?= $b ?></td>
			<td class='active'><?= $c ?></td>
		</tr>	
	<?php endfor; ?>
	
</table>