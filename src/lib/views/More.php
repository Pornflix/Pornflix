<?php

class More {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	public function generate() {
		$feed = $_GET['feed'];

		$content = "\t\t<div class=\"container more\">\n";
		$content .= "\t\t</div>\n";

		return $content;
	}
}

?>
