<?php

function printv($vector) {
	foreach($vector as $element)
		echo $element."\n";
	//echo "<br>";
}

function printvl($vector) {
	echo "<ul>";
	foreach($vector as $element) {
		echo "<li>".$element."</li>";
	}
	echo "</ul>";
}
