<?php

class Feed {
	public function drawFeed($data, $feedName) {
		$content = $this->startFeedContainer($feedName);
		$content .= $this->drawVideos($data);
		$content .= $this->endFeedContainer();

		return $content;
	}

	public function startFeedContainer($feedName) {
		$content = "\t\t\t<ul class=\"feed-list\" style=\"width: 880px;\">\n";
		$content .= "\t\t\t\t<div class=\"title\">\n";
		$content .= "\t\t\t\t\t<span class=\"feed-name\">$feedName</span>\n";
		$content .= "\t\t\t\t\t<a href=\"?view=more&feed=$feedName\"><span class=\"more\">More<i class=\"fa fa-chevron-right more-chevron\" aria-hidden=\"true\"></i></span></a>\n";
		$content .= "\t\t\t\t</div>\n";
		
		$content .= "\t\t\t\t<div class=\"feed-container\">\n";
		
		return $content;
	}

	function drawVideos($data) {
		$content = "";
		for($i = 0; $i < sizeof($data['video']); $i++) {
			$content .= "\t\t\t\t\t<li class=\"feed-item\">\n";
			$content .= "\t\t\t\t\t\t<a class=\"preview-link\" href=\"" . htmlspecialchars("/?view=video&id=" . $data['video'][$i]['id']) . "\">\n";
			$source = Constants::getDataDir() . "/videos/" . $data['video'][$i]['id'] . "/preview.jpg";
			$content .= "\t\t\t\t\t\t\t<img class=\"preview\" src=\"$source\" style=\"width: 200px; height: " . round((9/16)*200) . "px;\">\n";
			$content .= "\t\t\t\t\t\t</a>\n";
			$content .= "\t\t\t\t\t\t<span class=\"preview-title ellipsis\" style=\"width: 200px;\">" . $data['video'][$i]['name'] . "</span>\n";
			$content .= "\t\t\t\t\t</li>\n";
		}
		return $content;
	}

	public function endFeedContainer() {
		$content = "\t\t\t\t</div>\n";
		$content .= "\t\t\t</ul>\n";
		return $content;
	}

}

?>
