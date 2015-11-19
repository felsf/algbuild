<?php

require_once('../php/functions.php');

if(!isset($_POST['quant'])) die("Variavel não setada: quantidade de valores a serem gerados.");

$Array = array();
for($a = 0; $a < $_POST['quant'];)
{
	$valor = rand(0, ( (isset($_POST['repeat'] ? 10000 : $_POST['quant']);
	if(isset($_POST['repeat']) && $_POST['repeat'] == false && !in_array($valor, $Array))
	{
		array_push($Array, $valor);
		$a++;
	}
	else $a++;
}

printvl($Array); 