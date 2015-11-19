<?php

include('connection.php');

function save($id, $teste, $content, $algoritmo, $navegador, $elementos)
{
	
	$database->exec($query);
	$database->close();
	return $query;
}

$content = $_POST['content'];
$algoritmo = $_POST['alg'];
$navegador = $_POST['navegador'];
$elementos = $_POST['elementos'];

$teste = ( (isset($_POST['temporization']) ? 'Temporization' : (isset($_POST['memory']) ? 'Memory' : (isset($_POST['exchange']) ? "Exchange" : ""))));

$result = $db->query("SELECT resultado_id, COUNT(*) As Quant FROM resultados GROUP BY resultado_id HAVING Quant < 5");	
$id = $result->fetchArray()[0];

if($id == null)
{
	$next_id = $db->query("SELECT MAX(resultado_id) FROM resultados")->fetchArray();	
	$id = ++$next_id[0];
} 

echo "ID: $id";

$query = "INSERT INTO resultados VALUES($id, '$teste', $content, $algoritmo, '$navegador', $elementos);";
$db->query($query);
$db->close();
//$query = save($result->fetchArray()[0], $teste, $_POST['content'], $_POST['alg'], $_POST['navegador'], $_POST['elementos']);
echo "Saved: $query";