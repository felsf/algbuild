<?php 
namespace php;

require_once('Gerador.php');
require_once('functions.php');

require_once('../connection.php');

function run(&$vector, $gap = 2) 
{
	$current = count($vector) / $gap;
	$current = intval($current);
	$trocas = 0;

	while($current > 0)
	{
		for($a = 0; ($current+$a) < count($vector); $a++)
		{
			if($vector[$a] > $vector[$current + $a]) 
			{
				$aux = $vector[$a];
				$vector[$a] = $vector[$current + $a];
				$vector[$current + $a] = $aux;	
				++$trocas;		
			}
		}
			
			$current /= $gap;
			$current = intval($current);		
	}
		
	$current = 0;
		
	for($a = 0; $a < count($vector); $a++, $current++)
	{
		for($b = $current; $b > 0; $b--)
		{
			if($vector[$b-1] > $vector[$b]) 
			{
				$aux = $vector[$b];
				$vector[$b] = $vector[$b-1];
				$vector[$b-1] = $aux;
				++$trocas;
			}
		}
	}

	return $trocas;
}
	
	$fim = 0;
	$array = (new Gerador())->gerar( (isset($_POST['quant']) ? $_POST['quant'] : 10000));	

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