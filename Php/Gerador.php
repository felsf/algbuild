<?php

namespace php;

require_once('functions.php');

class Gerador 
{
	function gerar($quant, $repeat = true) 
	{
		ini_set('max_execution_time', 1000);
		$Array = array();
		for($a = 0; $a < $quant;) 
		{
			$valor = rand(0, $quant * 10);			
			if(!$repeat && in_array($valor, $Array)) continue;
			array_push($Array, $valor); 
			++$a;							
		}
		
		return $Array;
	}
}