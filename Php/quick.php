<?php

/*
** Quick Sort Algorithm
*/

namespace php;

require_once('Gerador.php');

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
	}	
}