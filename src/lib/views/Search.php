<?php

class Search {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	function generate() {
		$query = $_GET['query'];

		$data = (new QSearch($this->mysql))->getResults($query);
		$content = "";

		if($data['results']) {
			$content .= "\t\t<div class=\"container search\">\n";
			$content .= (new Feed)->drawFeed($data, "Search results");
		} else {
			$content .= "\t\t<div class=\"container search\" style=\"text-align: center;\">\n";
			$content .= (new Feed)->startFeedContainer("Search results");
			$content .= "No results found";
			$content .= (new Feed)->endFeedContainer();
		}

		$content .= "\t\t\t</div>\n";

		return $content;
	}
}

?>
