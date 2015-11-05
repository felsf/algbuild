<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03-Nov-15
 * Time: 11:19 PM
 */

require_once('functions.php');

function radix($vector, $digitos = 2) // Informa o Vector e quantidade máxima de Digitos do número.
{
    $bucket = array();
    $index = 0;
    for($a = 0; $a < 11; $a++) array_push($bucket, array()); // Preenchendo array de 10 posições (0 a 9)
    for($a = 0; $a < $digitos; $a++)
    {
        for($c = 0; $c < count($bucket); $c++) { // Limpa o Bucket, é como se passasse p/ outras filas.
            unset($bucket[$c]);
            $bucket[$c] = array();
        }

        for($b = 0; $b < count($vector); $b++)
        {
           $index = pow(10, $a+1);
           array_push($bucket[$vector[$b] % $index], $vector[$b]);           
           echo "Elemento $vector[$b] added to position <b>".$vector[$b] % $index."</b> (Index: $index)<br>";          
        }       

        foreach($bucket as $array) {
            if(count($array) > 0) printv($array); // Imprime todas as filas do Bucket que tiverem >= 1 elementos.
        }

        echo "<br>";       
    }   
}

$lista = array();
//radix([7, 2 ,9, 4, 3, 3, 8, 6, 1, 10, 10]);

for($a = 0; $a < 5;) {
    $valor = rand(1, 300);
    if(!in_array($valor, $lista)) {
        array_push($lista, $valor);
        ++$a;
    }
}

radix([246, 79, 284, 174, 245]);
//radix($lista, 2);