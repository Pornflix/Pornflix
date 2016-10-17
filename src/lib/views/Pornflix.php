<?php

class Pornflix {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	public function generate() {
		$content = "";
		$view = !empty($_GET['view']) ? $_GET['view'] : "";
		
		switch($view) {
			case "video":
				$content .= (new Header($this->mysql))->generate();
				$content .= (new Video($this->mysql))->generate();
				break;
			case "search":
				$content .= (new Header($this->mysql))->generate();
				$content .= (new Search($this->mysql))->generate();
				break;
			case "more":
				$content .= (new Header($this->mysql))->generate();
				$content .= (new More($this->mysql))->generate();
				break;
			case "upload":
				$content .= (new Header($this->mysql))->generate();
				$content .= (new Upload($this->mysql))->generate();
				break;
			default:
				$content .= (new Header($this->mysql))->generate();
				$content .= (new HomeFeed($this->mysql))->generate();
		}
		$content .= (new Footer($this->mysql))->generate();
		return $content;
	}
}

?>
