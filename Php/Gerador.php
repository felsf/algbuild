<?php

namespace php;

require("Algoritmo.php");
require_once('functions.php');
require_once('Shell.php');
require_once('Merge.php');
require_once('Bin.php');
require_once('Quick.php');


class Gerador {
	function gerar($quant) 
	{
		ini_set('max_execution_time', 1000);
		$Array = array();
		for($a = 0; $a < $quant;) 
		{
			$valor = rand(0, $quant * 10);			
			//if(in_array($valor, $Array)) continue;
			array_push($Array, $valor); 
			++$a;							
		}
		
		return $Array;
	}
}

$vector = array();

if(isset($_POST['quant'])) {	
	$gerador = new Gerador();
	$vector = $gerador->gerar($_POST['quant']);	
}

if(isset($_POST['type']))
{
	$inicio = microtime(true);
	switch($_POST['type'])
	{
		case "shell.php":
		{
			$shell = new Shell();
			$shell->run($vector);			
			break;
		}
		case "quick.php":
		{
			echo "quick\n";
			$quick = new Quick();
			$quick->run($vector, 0, $_POST['quant'] - 1);
			break;
		}
		case "merge.php":
		{
			echo "Merge";
			$merge = new Merge();
			$merge->run($vector, 0, $_POST['quant'] - 1);			
			break;
		}	
		case "bin.php":
		{
			$bin = new Bin();
			$bin->run($vector);
			break;
		}
		case "radix.php":
		{
			$radix = new Radix();
			$radix->run($vector);
			break;
		}	
	}

	$final = explode('.', round($inicio) - microtime(true));
	$final = explode($final[1][3], $final[1]);
	echo "Tempo de processamento: ".round($final[0], 3)."ms.";
}

