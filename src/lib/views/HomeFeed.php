<?php

class HomeFeed {
	public function __construct() {
        $feedNames = Constants::getFeedNames();
        $content = "\t\t<div class=\"container feed\">\n";
        $feedName = "All";

        for($i = 0; $i < sizeof($feedNames); $i++) {
            $data = (new WSVideos)->getVideoNames($feedNames[$i]);
            $content .= (new Feed)->drawFeed($data, $feedNames[$i]);
        }

        $content .= "\t\t</div>\n";

        echo $content;
	}
}

?>
