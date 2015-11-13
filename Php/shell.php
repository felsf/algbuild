<?php 
namespace php;

require_once('Gerador.php');
require_once('functions.php');

require_once('../connection.php');

function run($vector, $gap = 2) 
{
	$current = count($vector) / $gap;
	$current = intval($current);
	
	while($current > 0)
	{
		for($a = 0; ($current+$a) < count($vector); $a++)
		{
			if($vector[$a] > $vector[$current + $a]) 
			{
				$aux = $vector[$a];
				$vector[$a] = $vector[$current + $a];
				$vector[$current + $a] = $aux;			
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
			}
		}
	}		
		
	
}

$testes = 1;
$array = (new Gerador())->gerar($_POST['quant'], $_POST['repeat']);
$ini = microtime(true);
for($a = 0; $a < $testes; $a++) run($array);
$fim = microtime(true) - $ini;

if(isset($_POST['save']) && isset($db)) {

	$alg_id = 0;

	$quant = $_POST['quant'];	
	$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
	
	$id = $result->fetchArray()[0];	

	if($id == null)  {
		$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
		$id = ++$next_id[0];
	} 	

	$db->exec("INSERT INTO resultados VALUES ($id, $fim, $alg_id, 'PHP', $quant);");
	$db->close();
}
echo $fim;