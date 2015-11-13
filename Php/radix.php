<?php

namespace php;

require_once('Gerador.php');
require_once('../connection.php');

function run($vector)
{   

}

$testes = 1;
$array = (new Gerador())->gerar($_POST['quant']);
$ini = microtime(true);
for($a = 0; $a < $testes; $a++) run($array);
$fim = microtime(true) - $ini;
$fim = 0.5;
echo $fim;

if(isset($_POST['save']) && isset($db)) {

    $alg_id = 4;

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