<?php

/*
** Insertion Sort Algorithm
*/

require_once('functions.php');

function insertion_1($vector) // Inplace
{
	for($a = 0; $a < count($vector); $a++)
	{
		for($b = $a; $b > 0; $b--)
		{
			if($vector[$b] < $vector[$b-1]) {
				$aux = $vector[$b];
				$vector[$b] = $vector[$b-1];
				$vector[$b-1] = $aux;
			}			
		}
	}
	
	return $vector;
}

function insertion_2($vector) // Outplace
{
	$final = array();
	for($a = 0; $a < count($vector); $a++)
	{
		array_push($final, $vector[$a]);

		for($b = count($final) - 1; $b > 0; $b--)
		{
			if($final[$b] < $final[$b-1]) {
				$aux = $final[$b];
				$final[$b] = $final[$b-1];
				$final[$b-1] = $aux;				
			}
		}	
	}
		
	return $final;
}