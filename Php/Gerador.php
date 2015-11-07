<?php

namespace php;

require_once('functions.php');
require_once('Shell.php');


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
	echo "Vector gerado: "; printv($vector);		
}

if(isset($_POST['type']))
{
	echo "Vector ordenado: <br>";

	switch($_POST['type'])
	{
		case "shell.php":
		{
			$shell = new Shell();
			printv($shell->run($vector));			
			break;
		}
		case "quick.php":
		{
			$quick = new Quick();
			printv($quick->run($vector));
			break;
		}
		case "merge.php":
		{
			$merge = new Merge();
			printv($merge->run($vector));			
			break;
		}	
		case "bin.php":
		{
			$bin = new Bin();
			printv($bin->run($vector));
			break;
		}
		case "radix.php":
		{
			$radix = new Radix();
			printv($radix->run($vector));
			break;
		}
	}
}

