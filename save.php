<?php

require_once('connection.php')

$teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? "Exchange" : ""))));
$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	

function save($id, $teste, $content, $algoritmo, $navegador, $elementos)
{
	$query = "INSERT INTO resultados VALUES($id, '$teste', $content, $algoritmo, '$navegador', $elementos);";
	$db->exec($query);
	$db->close();
}

save($result->fetchArray()[0], $teste, $_POST['content'], $_POST['alg'], $_POST['navegador'], $_POST['elementos']);