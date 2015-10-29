<?php

/*
** Selection Sort Algorithm
*/

require_once('functions.php');


function selection($vector) 
{
	$until = count($vector);	
	$current = 0;
	
	for(; $until > 0; $until--)
	{
		$current = 0;		
		for($a = 0; $a < $until; $a++)
		{
			if($vector[$a] > $vector[$current]) $current = $a;		
		}
		
		$aux = $vector[$until - 1];
		$vector[$until - 1] = $vector[$current];
		$vector[$current] = $aux;
	}

	return $vector;
}