<?php

class Feed {
    public function Feed() {
        $feedNames = Constants::getFeedNames();
        $content = "\t\t<div class=\"container feed\">\n";
        $feedName = "All";

        for($i = 0; $i < sizeof($feedNames); $i++) {
            $data = (new WSVideos)->getVideoNames($feedNames[$i]);
            $content .= $this->drawFeeds($data, $feedNames[$i]);
        }

        $content .= "\t\t</div>\n";

        echo $content;
    }

    function drawFeeds($data, $feedName) {
        $content = "\t\t\t<ul class=\"row\" style=\"width: 900px;\">\n";
        $content .= "\t\t\t\t<div class=\"title\">\n";
        $content .= "\t\t\t\t\t<span class=\"feed-name\">$feedName</span>\n";
        $content .= "\t\t\t\t\t<span class=\"more\">More<i class=\"fa fa-chevron more-chevron\"></i></span>\n";
        $content .= "\t\t\t\t</div>\n";

        $content .= "\t\t\t\t<div class=\"video-container\">\n";

        for($i = 0; $i < sizeof($data['video']); $i++) {
            $content .= "\t\t\t\t\t<li class=\"feed-item\">\n";
            $content .= "\t\t\t\t\t\t<a class=\"preview-link\" href=\"" . htmlspecialchars("/?view=video&id=" . $data['video'][$i]['id']) . "\">\n";
            $content .= "\t\t\t\t\t\t\t<img class=\"preview\" src=\"" . Constants::getDataDir() . "/" . $data['video'][$i]['id'] . "/preview.jpg\" style=\"width: 200px; height: " . round((9/16)*200) . "px;\">\n";
            $content .= "\t\t\t\t\t\t</a>\n";
            $content .= "\t\t\t\t\t\t<span class=\"preview-title ellipsis\" style=\"width: 200px;\">" . $data['video'][$i]['name'] . "</span>\n";
            $content .= "\t\t\t\t\t</li>\n";
        }

        $content .= "\t\t\t\t</div>\n";
        $content .= "\t\t\t</ul>\n";

        return $content;
    }
}

?>
