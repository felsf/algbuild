<?php

/*
** Bubble Sort Algorithm
*/

require_once('functions.php');

function bubble_1($vector) // Normal
{
	$limite = 0;
	
	for(; $limite < count($vector); $limite++)
	{
		for($a = 0; $a < count($vector) - $limite - 1; $a++)
		{
			if($vector[$a] > $vector[$a+1]) { 
				$aux = $vector[$a];
				$vector[$a] = $vector[$a+1];
				$vector[$a+1] = $aux;
			}
		}		
	}
	
	return $vector;
}

function bubble_2($vector) // Inverse
{
	$limite = 0;
	
	for(; $limite < count($vector); $limite++)
	{
		for($a = 0; $a < count($vector) - $limite - 1; $a++)
		{
			if($vector[$a] < $vector[$a+1]) { 
				$aux = $vector[$a];
				$vector[$a] = $vector[$a+1];
				$vector[$a+1] = $aux;
			}
		}		
	}
	
	return $vector;
}