<?php
$start = memory_get_peak_usage(true);
 echo "Memoria Antes: ".$start; echo "<br>"; 
 include('../php/radix.php'); echo "<br>";
 echo "Memoria Depois: ".memory_get_peak_usage(true);