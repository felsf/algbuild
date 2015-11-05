<?php

/*
*	@Lista de Exercícios de Ordenação
*/

require_once('functions.php');

function bubble_step($vector) // BubbleSort step-by-step.
{
	$until = count($vector);	
	printv($vector);

	while($until > 0) {
		for($a = 0; $a < $until-1; $a++) {
			if($vector[$a] > $vector[$a+1]) { // Se maior, troca.
				$aux = $vector[$a];
				$vector[$a] = $vector[$a+1];
				$vector[$a+1] = $aux;
				printv($vector); // Imprime Array.
			}
		}

		--$until;
	}
}

function bubble_bidirectional($vector) {
	$ul = 0;
	$ur = count($vector)-1;

	while($ul != $ur)
	{
		$left = count($vector)-1;
		$right = 0;

		while($left > $ul)
		{
			if($vector[$left] < $vector[$left-1]) {
				$aux = $vector[$left];
				$vector[$left] = $vector[$left-1];
				$vector[$left-1] = $aux;				
			}

			if($vector[$right] > $vector[$right+1]) {
				$aux = $vector[$right];
				$vector[$right] = $vector[$right+1];
				$vector[$right+1] = $aux;				
			}

			--$left;
			++$right;			

			printv($vector);
		}
		
		++$ul;
		--$ur;
	}	
}

function quickSort($vector) 
{
	$pivot = $vector[0];
	$length = intval(count($vector)/2);

	$aux = $vector[0];	
	$vector[0] = $vector[$length];
	$vector[$length] = $aux;	

	printv($vector);
}

//bubble_step([7, 2 ,9, 4, 3, 3, 8, 6, 1, 10]);
//bubble_bidirectional([7, 2 ,9, 4, 3, 8, 6, 10, 1]);
quickSort([7, 2 ,9, 4, 3, 8, 6, 10, 1, 12]);