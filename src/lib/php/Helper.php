<?php

function countDir($dir) {
	$number = count(array_diff(scandir($dir), array(".", "..")));
	return $number;
}

?>
