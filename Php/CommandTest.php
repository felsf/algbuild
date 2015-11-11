<?php

namespace php;

require_once('Gerador.php');
require_once('Algoritmo.php');
require_once('Shell.php');

class CommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCount() {
		$gerador = new Gerador();
		$vector = $gerador->gerar(500);		
		$shell = new Shell();
		
		$array = Asort($vector);

		$this->assertEquals($array, $shell->run($vector));
	}   
}
