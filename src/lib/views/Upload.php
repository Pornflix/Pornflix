<?php

class Upload {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	public function generate() {
		$content = "\t\t<div class=\"container upload\">\n";
		$content .= "\t\t\t<div class=\"upload-container\">\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t</div>\n";

		return $content;
	}
}

?>
