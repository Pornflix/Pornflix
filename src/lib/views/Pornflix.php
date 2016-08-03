<?php

class Pornflix {
	public function generate() {
		$content = "";
		$view = !empty($_GET['view']) ? $_GET['view'] : "";
		
		switch($view) {
			case "video":
				$content .= (new Header)->generate();
				$content .= (new Video)->generate();
				break;
			case "search":
				$content .= (new Header)->generate();
				$content .= (new Search)->generate();
				break;
			default:
				$content .= (new Header)->generate();
				$content .= (new HomeFeed)->generate();
		}
		$content .= (new Footer)->generate();
		return $content;
	}
}

?>
