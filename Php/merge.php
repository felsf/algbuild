<?php

namespace php;

require_once('Gerador.php');
require_once('functions.php');	


function run(&$array, $inicio, $fim) 
{
	if ($fim <= $inicio) return;

	$numTroca=0;
	$meio = intval(($inicio + $fim) / 2);
	
	run($array, $inicio, $meio);
	run($array, $meio + 1, $fim);
	
	$A = array(); for($a = 0; $a < $meio - $inicio + 1; $a++) { array_push($A, $a); }
	$B = array(); for($a = 0; $a < $fim - $meio; $a++) { array_push($B, $a); }
		
	for ($i = 0; $i <= $meio - $inicio; $i++) $A[$i] = $array[$inicio + $i];
	for ($i = 0; $i <= $fim - $meio - 1; $i++) $B[$i] = $array[$meio + 1 + $i];
	

	$i = 0;
	$j = 0;

	for ($k = $inicio; $k <= $fim; $k++) 
	{
		if ($i < count($A) && $j < count($B)) 
		{
			if ($A[$i] < $B[$j]) $array[$k] = $A[$i++];
			else $array[$k] = $B[$j++];
			$numTroca++;
		}
		else if ($i < count($A)) $array[$k] = $A[$i++];
		else if ($j < count($B)) $array[$k] = $B[$j++];	
	}

	return $numTroca;		
}


$testes = 1;
$array = (new Gerador())->gerar($_POST['quant']);		

$ini = microtime(true);
for($a = 0; $a < $testes; $a++) run($array, 0, count($array) - 1);
$fim = microtime(true) - $ini;
echo $fim;