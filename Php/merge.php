<?php

/*
** Merge Sort Algorithm
*/

namespace php;

class Merge extends Algoritmo {

	public function run($vector, $inicio, $fim) 
	{
		if ($fim <= $inicio) return;	

		$numTroca=0;
		$meio = intval((inicio + fim) / 2);
		$this->run($vector, $inicio, $meio);
		$this->run($vector, $meio + 1, $fim);

		$A = array(); for($a = 0; $a < ($meio - $inicio + 1); $a++) array_push($A, 0);
		$B = array(); for($a = 0; $a < ($fim - $meio); $a++) array_push($B, 0);

		for ($i = 0; $i <= $meio - $inicio; $i++) $A[$i] = $vector[$inicio + $i];		
		for ($i = 0; $i <= $fim - $meio - 1; $i++) $B[$i] = $vector[$meio + 1 + $i];

		$i = 0;
		$j = 0;

		for ($k = $inicio; $k <= $fim; $k++) 
		{
			if ($i < count($A) && $j < count($B)) 
			{
				if ($A[$i] < $B[$j]) $vector[$k] = $A[$i++];
				else $vector[$k] = $B[$j++];
				$numTroca++;
			} 

			else if ($i < count($A)) $vector[$k] = $A[$i++];
			else if ($j < count($B)) $vector[$k] = $B[$j++];
			
		}
	}
}
