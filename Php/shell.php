<?php 
namespace php;

require_once('Gerador.php');
require_once('functions.php');

require_once('../connection.php');

function run($nums) 
{
	$h = 1;
	$n = count($nums);
	$numTroca=0;
	while($h < $n) $h = ($h * 3) + 1;
	
	$h = $h / 3;
	$h = intval($h);
	$c = 0; $j = 0;
	while ($h > 0) 
	{
		for ($i = $h; $i < $n; $i++) 
		{
	            $c = $nums[$i];
	            $j = $i;
	            while ($j >= $h && $nums[$j - $h] > $c) 
	            {
	                $nums[$j] = $nums[$j - $h];
	                $j = $j - $h;
	                $numTroca++;
	            }
	            $nums[$j] = $c;
	    }
	    $h = $h / 2;
	    $h = intval($h);
	}
	    return $numTroca;
}
	
	$fim = 0;
	$array = (new Gerador())->gerar( (isset($_POST['quant']) ? $_POST['quant'] : 10000));	
	if(isset($_POST['alreadyInverted']) && $_POST['alreadyInverted']) {
		rsort($array);
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
        run($array);    
        $fim = memory_get_peak_usage() - $memini;
        echo $fim;
    }
    else if(isset($_POST['exchange']))
    {
        $fim = run($array);   
        echo $fim;
    }

    //printv($array);

if(isset($_POST['save']) && isset($db)) {
	$alg_id = 0;

	$quant = $_POST['quant'];	
	$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
	
	$id = $result->fetchArray()[0];	
	$teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? 'Exchange' : ''))));

	if($id == null)  {
		$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
		$id = ++$next_id[0];
	} 	

	$query = "INSERT INTO resultados VALUES ($id, '$teste', $fim, $alg_id, 'PHP', $quant);";		
	$db->exec($query);
	$db->close();
}