<?php

require_once('../php/functions.php');

if(!isset($_POST['quant'])) die("Variavel não setada: quantidade de valores a serem gerados.");

$Array = array();
for($a = 0; $a < $_POST['quant']; $a++) array_push($Array, rand(0, 10000));

printvl($Array); 