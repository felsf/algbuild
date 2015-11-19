<?php

namespace php;

require_once('Gerador.php');
require_once('../connection.php');

function run($vector)
{
	$bucket = array();
	for($a = 0; $a < max($vector)+1; $a++) array_push($bucket, 0);
	for($a = 0; $a < count($vector); $a++)  $bucket[$vector[$a]]++;	
	return $bucket; 
}

	$array = (new Gerador())->gerar( (isset($_POST['quant']) ? $_POST['quant'] : 10));		
	$obs = "";

	if(isset($_POST['alreadyInverted']) && $_POST['alreadyInverted']) {
		rsort($array);
	}

	if(isset($_POST['obs']))
	{
		$obs = $_POST['obs'];
	}	

	if(isset($_POST['temporization']))
    {
        $ini = microtime(true);
        run($array);  
        $fim = microtime(true) - $ini;         
        echo $fim;
    }
    else if(isset($_POST['memory']))
    {
        $memini = memory_get_peak_usage();
        $bucket = run($array);    
        $fim= memory_get_peak_usage() - $memini;
        echo $fim;
    }
    else if(isset($_POST['exchange']))
    {
    	$fim = -1;
    	echo $fim;
    }

if(isset($_POST['save']) && isset($db)) {

	$alg_id = 3;

	$quant = $_POST['quant'];
	$teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? "Exchange" : ""))));
	$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
	
	$id = $result->fetchArray()[0];	

	if($id == null)  {
		$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
		$id = ++$next_id[0];
	} 	

	$query = "INSERT INTO resultados VALUES ($id,  '$teste', $fim, $alg_id, 'PHP', $quant, '$obs');";
	$db->exec($query);
	$db->close();
}