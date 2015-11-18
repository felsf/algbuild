<?php 
	namespace php;

	require_once("Gerador.php");
	require_once('functions.php');

	require_once('../connection.php');

	function run(&$vector, $esquerda, $direita, &$trocas = 0)
	{  
		$esq = $esquerda;  
	    $dir = $direita;  
	    $pivot = $vector[intval(($esq + $dir) / 2)];  
	   
	    $troca = 0;
	    $numTroca = 0;

	    while ($esq <= $dir) 
	    {  
	    	while ($vector[$esq] < $pivot) { $esq++; }
	        while ($vector[$dir] > $pivot) { $dir--; }
	        if ($esq <= $dir) 
	        {  
	            $troca = $vector[$esq];  
	            $vector[$esq] = $vector[$dir];  
	            $vector[$dir] = $troca;  
	            $esq++;  
	            $dir--;  	            
	            $numTroca++;              
	        }  	               
	    }
	    
	    if ($dir > $esquerda) run($vector, $esquerda, $dir, $numTroca);  
	    if ($esq < $direita)  run($vector, $esq, $direita, $numTroca);

	    return $trocas;     
	}

	$array = (new Gerador())->gerar( (isset($_POST['quant']) ? $_POST['quant'] : 10));
	if(isset($_POST['alreadyInverted']) && $_POST['alreadyInverted']) {
		rsort($array);
	}

	rsort($array);
	printv($array);
	echo "<br>";
	run($array, 0, count($array) - 1);
	printv($array);

	$fim = 0;

	if(isset($_POST['temporization']))
	{
		$ini = microtime(true);
		for($a = 0; $a < 1; $a++) run($array, 0, count($array) - 1);	
		$fim = microtime(true) - $ini;	
		echo $fim;
	}
	else if(isset($_POST['memory']))
	{
		$memini = memory_get_peak_usage();
		for($a = 0; $a < 1; $a++) run($array, 0, count($array) - 1);	
		$fim = memory_get_peak_usage() - $memini;
		echo $fim;
	}
	else if(isset($_POST['exchange']))
    {
    	$fim = run($array, 0, count($array) - 1);   
    	echo $fim;
    }

    //printv($array);

	// --------------------------------------------------------------------- //

	if(isset($_POST['save']) && isset($db)) 
	{
		$alg_id = 1;		

		$quant = $_POST['quant'];	
		$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
		
		$id = $result->fetchArray()[0];	
		$teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? "Exchange" : ""))));

		if($id == null)  
		{
			$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
			$id = ++$next_id[0];
		} 	

		$query = "INSERT INTO resultados VALUES ($id, '$teste', $fim, $alg_id, 'PHP', $quant);";
		$db->exec($query);
		
		$db->close();
	}	