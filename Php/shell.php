<?php

/*
** Shell Sort Algorithm
*/

namespace php;

require_once('Algoritmo.php');

class Shell extends Algoritmo {
	
	public function run($vector, $gap = 2) 
	{
		$current = count($vector) / $gap;
		$current = intval($current);
		
		while($current > 0)
		{
			for($a = 0; ($current+$a) < count($vector); $a++)
			{
				if($vector[$a] > $vector[$current + $a]) {
					$aux = $vector[$a];
					$vector[$a] = $vector[$current + $a];
					$vector[$current + $a] = $aux;			
				}
			}
			
			$current /= $gap;
			$current = intval($current);		
		}
		
		$current = 0;
		
		for($a = 0; $a < count($vector); $a++, $current++)
		{
			for($b = $current; $b > 0; $b--)
			{
				if($vector[$b-1] > $vector[$b]) {
					$aux = $vector[$b];
					$vector[$b] = $vector[$b-1];
					$vector[$b-1] = $aux;
				}
			}
		}
		
		return $vector;
	}
}

/*
require_once('Gerador.php');
$quick = new Shell();
$g = new Gerador();
$quick->run($g->gerar(50000));*/