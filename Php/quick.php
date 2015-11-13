<?php 
	namespace php;

	require_once("Gerador.php");
	require_once('functions.php');

	require_once('../connection.php');

	function run(&$vector, $esquerda, $direita)
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
	    
	    if ($dir > $esquerda) run($vector, $esquerda, $dir);  
	    if ($esq < $direita)  run($vector, $esq, $direita);     
	}

	$array = (new Gerador())->gerar($_POST['quant']);
	$ini = microtime(true);
	for($a = 0; $a < 1; $a++) run($array, 0, count($array) - 1);	

	$fim = microtime(true) - $ini;	
	echo $fim;

	if(isset($_POST['save']) && isset($db)) 
	{
		$alg_id = 1;

		$quant = $_POST['quant'];	
		$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
		
		$id = $result->fetchArray()[0];	

		if($id == null)  
		{
			$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
			$id = ++$next_id[0];
		} 	

		$db->exec("INSERT INTO resultados VALUES ($id, $fim, $alg_id, 'PHP', $quant);");
		$db->close();
	}	