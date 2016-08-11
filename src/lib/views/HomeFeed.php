<?php

class HomeFeed {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	public function generate() {
		$feedNames = Constants::getFeedNames();
		$content = "\t\t<div class=\"container feed\">\n";
		$feedName = "All";
		
		for($i = 0; $i < sizeof($feedNames); $i++) {
			$data = (new QVideos($this->mysql))->getVideoNames($feedNames[$i]);
			$content .= (new Feed)->drawFeed($data, $feedNames[$i]);
		}
		
		$content .= "\t\t</div>\n";

		return $content;
	}
}

?>
