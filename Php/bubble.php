<?php

/*
** Bubble Sort Algorithm
*/

function bubbleSort_1($vector)
{
	$limit = count($vector);
	require_once('functions.php');
	
	while($limit > 0)
	{
		echo "<br>";
		printv($vector);
		
		for($a = 0; $a < $limit-1; $a++) {
			if($vector[$a] > $vector[$a+1]) {
				$aux = $vector[$a];
				$vector[$a] = $vector[$a+1];
				$vector[$a+1] = $aux;
			}
		}
		
		$limit--;
	}	
	
	return $vector;
}

function bubbleSort_2($vector)
{
	$limit = count($vector);
	require_once('functions.php');
	
	while($limit > 0)
	{
		echo "<br>";
		printv($vector);
		
		for($a = 0; $a < $limit-1; $a++) {
			if($vector[$a] < $vector[$a+1]) {
				$aux = $vector[$a];
				$vector[$a] = $vector[$a+1];
				$vector[$a+1] = $aux;
			}
		}
		
		$limit--;
	}	
	
	return $vector;
}

bubbleSort_2(array(5, 9, 0, 2, 1, 3, 7, 10, 24, 15, 18, 17, 13, 6));