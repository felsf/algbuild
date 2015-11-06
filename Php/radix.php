<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03-Nov-15
 * Time: 11:19 PM
 */

namespace php;

require('Algoritmo.php');
require('functions.php');


class Radix extends Algoritmo
{
    public function run($vector, $digitos = 2) // Informa o Vector e quantidade máxima de Digitos do número.
    {
        $bucket = array();
        $unidades = array();

        $index = 0;
        for($a = 0; $a < 11; $a++) array_push($bucket, array()); // Preenchendo array de 10 posições (0 a 9)
        for($a = 0; $a < 11; $a++) array_push($unidades, array()); // Preenchendo array de UNIDADES de 10 posições (0 a 9)
        for($a = 0; $a < $digitos; $a++)
        {
            for($c = 0; $c < count($bucket); $c++) { // Limpa o Bucket, é como se passasse p/ outras filas.
                unset($bucket[$c]);
                $bucket[$c] = array();
            }

            switch($index) {
                    case 10: $formula = $vector[$b] % $index; break;
                    case 100: $formula = intval(($vector[$b]%100)/10); break;
                    default: $formula = intval($vector[$b]/$index); break;
            }

            if($index == 10) {

            }

            else 
            {

                for($b = 0; $b < count($vector); $b++)
                {
                   $index = pow(10, $a+1);
                   $formula = 0;

                   

                   if($index >= 100 && $vector[$b] % $index == $vector[$b]) $formula = 0;           

                   array_push($bucket[$formula], $vector[$b]);           
                   echo "Elemento $vector[$b] added to position <b>".$formula."</b> (Index: $index)<br>";          
                }       

                foreach($bucket as $array) {
                    if(count($array) > 0) printv($array); // Imprime todas as filas do Bucket que tiverem >= 1 elementos.
                }                
            }    

            echo "<br>";   
        }   
    }
}

$radix = new Radix();
printv($radix->run([246, 79, 284, 174, 245]));