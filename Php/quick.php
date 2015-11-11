<?php 
	namespace php;

	require_once("Gerador.php");
	require_once('functions.php');

	function run(&$vector, $esquerda, $direita)
	{  
		$esq = $esquerda;  
	    $dir = $direita;  
	    $pivot = $vector[intval(($esq + $dir) / 2)];  
	   
	    $troca = 0;
	    $numTroca = 0;

	    while ($esq <= $dir) 
	    {  
	    	while ($vector[$esq] < $pivot) { $esq++; }
	        while ($vector[$dir] > $pivot) { $dir--; }
	        if ($esq <= $dir) 
	        {  
	            $troca = $vector[$esq];  
	            $vector[$esq] = $vector[$dir];  
	            $vector[$dir] = $troca;  
	            $esq++;  
	            $dir--;  	            
	            $numTroca++;              
	        }  	               
	    }
	    
	    if ($dir > $esquerda) run($vector, $esquerda, $dir);  
	    if ($esq < $direita)  run($vector, $esq, $direita);     
	}

	$array = (new Gerador())->gerar($_POST['quant']);
	$ini = microtime(true);
	for($a = 0; $a < 1; $a++)
	{
		run($array, 0, count($array) - 1);
	}

	$fim = microtime(true) - $ini;
	//printv($array);
	//echo "<br>";
	echo round($fim, 6);
	//echo "Tempo de execução: ".count($array)." elementos | ".($fim*1000)."ms.";