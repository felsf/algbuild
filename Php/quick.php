<?php

/*
** Quick Sort Algorithm
*/

namespace php;

class Quick extends Algoritmo {

	public function run($vector, $esquerda, $direita)
	{  
		$esq = $esquerda;  
	    $dir = $direita;  
	    $pivot = $vector[intval(($esq + $dir) / 2)];  
	    
	    $troca = 0;
	    $numTroca = 0;  
	  
	    while ($esq <= $dir) 
	    {  
	        while ($vector[$esq] < $pivot) $esq++;            
	        while ($vector[$dir] > $pivot) $dir--;
	        if ($esq <= $dir) 
	        {  
	            $troca = $vector[$esq];  
	            $vector[$esq] = $vector[$dir];  
	            $vector[$dir] = $troca;  
	            $esq++;  
	            $dir++;  
	            $numTroca++;              
	        }  	               
	    } 
	    
	    if ($dir > $esquerda) $this->run($vector, $esquerda, $dir);  
	    if ($esq < $direita)  $this->run($vector, $esq, $direita); 
        return $numTroca; 
	}

	public function partition($array, $ini, $fim) {
		$a = 0;	$esquerda = 0; $direita = 0; $aux = 0;
		$a = $array[$ini];
		$esquerda = $ini;
		$direita = $fim;

		while($esquerda < $direita) {
			while($array[$esquerda] <= $a && $esquerda < $direita) $esquerda++;
			while($array[$direita--] > $a);

			if($esquerda < $direita) {
				$aux = $array[$esquerda];
				$array[$esquerda] = $array[$direita];
				$array[$direita] = $aux;
			}
		}

		$array[$ini] = $array[$direita];
		$array[$direita] = $a;
		return $direita;
	}
}