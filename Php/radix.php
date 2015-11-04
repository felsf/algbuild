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
    for($a = 0; $a < 10; $a++) array_push($bucket, array()); // Preenchendo array de 10 posições (0 a 9)
    for($a = 0; $a < $digitos; $a++)
    {
        for($b = 0; $b < count($vector); $b++)
        {
           $index = pow(10, $a+1);
           array_push($bucket[$vector[$b] % $index], $bucket[$vector[$b]]);
        }

        printv($bucket[$vector])
    }

    printv($bucket);
}

radix(7, 2 ,9, 4, 3, 8, 6, 1, 10);

