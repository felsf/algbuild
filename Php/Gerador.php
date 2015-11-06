<?php

namespace php;

require_once('functions.php');

class Gerador {

	function gerar($quant) {
		$Array = array();
		for($a = 0; $a < $quant; $a++) array_push($Array, rand(0, 10000));

		return $Array;
	}
}

if(isset($_POST['quant'])) {
	$gerador = new Gerador();
	$vector = $gerador->gerar($_POST['quant']);
	printvl($vector);	
}