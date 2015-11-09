<?php

namespace php;

require("Algoritmo.php");
require_once('functions.php');
require_once('Shell.php');
require_once('Bin.php');


class Gerador {
	function gerar($quant) {
		$Array = array();
		for($a = 0; $a < $quant; $a++) array_push($Array, rand(0, 10000));

		return $Array;
	}
}

$vector = array();

if(isset($_POST['quant'])) {
	$gerador = new Gerador();
	$vector = $gerador->gerar($_POST['quant']);
	//echo "Vector gerado: "; printv($vector);		
}

if(isset($_POST['type']))
{
	ini_set('max_execution_time', 300);
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
			$quick = new Quick();
			$quick->run($vector);
			break;
		}
		case "merge.php":
		{
			$merge = new Merge();
			$merge->run($vector);			
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

	$fim = microtime(true) - $inicio;
	echo "Tempo de processamento: ".ToMS($fim)."ms.";
}

