<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03-Nov-15
 * Time: 10:32 PM
 */

require_once('functions.php');

function bin($vector)
{
    $bucket = array();
    for($a = 0; $a < count($vector)+1; $a++) array_push($bucket, 0);
    for($a = 0; $a < count($vector); $a++)  $bucket[$vector[$a]]++;
    for($a = 0; $a < count($vector); $a++)
    {
       for($b = 0; $b < $bucket[$a]; $b++)
            echo $a."\n";
    }
}