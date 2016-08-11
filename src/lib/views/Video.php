<?php

class Video {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	public function generate() {
		$id = $_GET['id'];

		$data = (new QVideos($this->mysql))->getVideoInfo($id);

		$content = "\t\t<div class=\"container video\">\n";
		$content .= "\t\t\t<div class=\"video-container\">\n";
		$content .= "\t\t\t\t<div class=\"video-info\">\n";
		$content .= "\t\t\t\t\t<video class=\"html5-video video-js\" controls data-setup=\"{}\" style=\"width: 640px; height: 360px;\">\n";
		$content .= "\t\t\t\t\t\t<source src=\"../" . Constants::getDataDir() . "/videos/" . $id ."/video.mp4\" type=\"video/mp4\">\n";
		$content .= "\t\t\t\t\t</video>\n";
		$content .= "\t\t\t\t\t<span class=\"video-title\">" . $data['name'] . "</span>\n";
		$content .= "\t\t\t\t\t<span class=\"video-views\">" . $data['views'] . " views</span>\n";
		$content .= "\t\t\t\t\t<span class=\"video-desc\">" . (!empty($data['description']) ? $data['description'] : "Loading...<script type=\"text/javascript\">Helper.getRandomDescription();</script>") . "</span>\n";
		$content .= "\t\t\t\t</div>\n";

		$content .= $this->drawTags($id);
		$data = (new QVideos($this->mysql))->getVideoNames("Recommended");

		$content .= "\t\t\t\t<div class=\"recommended\">\n";
		$content .= (new Feed)->drawFeed($data, "Recommended");
		$content .= "\t\t\t\t</div>\n";

		$content .= "\t\t\t</div>\n";
		$content .= "\t\t</div>\n";

		return $content;
	}

	function drawTags($id) {
		$data = (new QVideos($this->mysql))->getTags($id);		

		$content = "\t\t\t\t<div class=\"tags\">\n";
		for($i = 0; $i < sizeof($data); $i++) {
			$content .= "\t\t\t\t\t<span class=\"tags-name\">" . $data[$i]['name'] . "</span>\n";
			$content .= "\t\t\t\t\t<ul class=\"tags-list\">\n";
			for($j = 0; $j < sizeof($data[$i]['tag']); $j++) {
				$name = strtolower(preg_replace("/s$/", "", $data[$i]['name'])) . ": " . $data[$i]['tag'][$j]['name'] . " ";
				$className = "tags-item tags-item-" . strtolower($data[$i]['name']) . " " . (isset($data[$i]['tag'][$j]['extra']) ? "tags-item-extra-" . strtolower($data[$i]['tag'][$j]['extra']) : "");
				
				if($data[$i]['tag'][$j]['name'] == "Add tag") {
					$content .= "\t\t\t\t\t\t<a class=\"tags-link\" onclick=\"Helper.addTag($id)\">\n";
				} else {
					$content .= "\t\t\t\t\t\t<a class=\"tags-link\" onclick=\"Helper.setSearch('$name')\">\n";
				}
				$content .= "\t\t\t\t\t\t\t<li class=\"$className\">\n";
				$content .= "\t\t\t\t\t\t\t\t" . $data[$i]['tag'][$j]['name'] . "\n";
				$content .= "\t\t\t\t\t\t\t\t<span class=\"tags-count tags-count-" . strtolower($data[$i]['name']) . "\">" . $data[$i]['tag'][$j]['count'] . "</span>\n";
				$content .= "\t\t\t\t\t\t\t</li>\n";
				$content .= "\t\t\t\t\t\t</a>\n";
			}
			$content .= "\t\t\t\t\t</ul>\n";
		}
		$content .= "\t\t\t\t</div>\n";
		return $content;
	}
}

?>
