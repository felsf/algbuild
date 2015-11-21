<?php

namespace php;

require_once('Gerador.php');
require_once('../connection.php');

function run(&$vector) {
    $i = 0;
    $b = array();
    $maior = $vector[0];
    $exp = 1;
    
    $trocas = 0;

    for($a = 0; $a < count($vector); $a++) array_push($b, 0);
  
    for ($i = 0; $i < count($vector); $i++) {
        if ($vector[$i] > $maior)
            $maior = $vector[$i];
    }
 
    while ( intval($maior/$exp) > 0) {
        $bucket = array(); for($a = 0; $a < count($vector); $a++) array_push($bucket, 0);       
        for ($i = 0; $i < count($vector); $i++)
            $bucket[($vector[$i] / $exp) % 10]++; 
        for ($i = 1; $i < 10; $i++)
            $bucket[$i] += $bucket[$i - 1];
        for ($i = count($vector) - 1; $i >= 0; $i--) {
            $b[--$bucket[intval($vector[$i] / $exp) % 10]] = $vector[$i];            
        }
        for ($i = 0; $i < count($vector); $i++){
            $vector[$i] = $b[$i];
            ++$trocas;
        }

        $exp *= 10;
    }

    return -1;
 }


$array = (new Gerador())->gerar( (isset($_POST['quant']) ? $_POST['quant'] : 10000));
if(isset($_POST['alreadyInverted']) && $_POST['alreadyInverted']) {
        rsort($array);
    }
$fim = 0;

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

    // --------------------------------------------------------------------- //

if(isset($_POST['save']) && isset($db)) {

    $alg_id = 4;

    $quant = $_POST['quant'];   
    $result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");  
    
    $id = $result->fetchArray()[0]; 
    $teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? "Exchange" : ""))));

    if($id == null)  {
        $next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();
        $id = ++$next_id[0];
    }  

    $obs = "";
    if(isset($_POST['obs']))
    {
        $obs = $_POST['obs'];
    } 

    $query = "INSERT INTO resultados VALUES ($id, '$teste', $fim, $alg_id, 'PHP', $quant, '$obs');";
    $db->exec($query);
    $db->close();
}