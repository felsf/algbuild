<?php

namespace php;

require_once('Gerador.php');

function run($vector)
{	
	$bucket = array();
	for($a = 0; $a < max($vector)+1; $a++) array_push($bucket, 0);
	for($a = 0; $a < count($vector); $a++)  $bucket[$vector[$a]]++;	
	return $bucket; 	
}

$testes = 1;
$array = (new Gerador())->gerar($_POST['quant']);
$ini = microtime(true);
for($a = 0; $a < $testes; $a++) run($array);
$fim = microtime(true) - $ini;
echo $fim;