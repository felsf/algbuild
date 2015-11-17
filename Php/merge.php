<?php

namespace php;

require_once('Gerador.php');
require_once('functions.php');	

require_once('../connection.php');

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


	$array = (new Gerador())->gerar( (isset($_POST['quant']) ? $_POST['quant'] : 20));		
	
	$fim = 0;

	if(isset($_POST['temporization']))
    {
        $ini = microtime(true);
        run($array, 0, count($array) - 1);   
        $fim = microtime(true) - $ini;  
        echo $fim;
    }
    else if(isset($_POST['memory']))
    {
        $memini = memory_get_peak_usage();
        run($array, 0, count($array) - 1);    
        $fim = memory_get_peak_usage() - $memini;
        echo $fim;
    }
    else if(isset($_POST['exchange']))
    {
    	$fim = run($array, 0, count($array) - 1);   
    	echo $fim;
	}

	//printv($array);

if(isset($_POST['save']) && isset($db))
{
	$alg_id = 2;

	$quant = $_POST['quant'];	
	$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
	$teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? "Exchange" : ""))));

	$id = $result->fetchArray()[0];	

	if($id == null)  {
		$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
		$id = ++$next_id[0];
	} 	

	$query = "INSERT INTO resultados VALUES ($id, '$teste', $fim, $alg_id, 'PHP', $quant);";
	$db->exec($query);
	$db->close();
}