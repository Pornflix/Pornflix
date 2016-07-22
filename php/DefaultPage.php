<?php

class DefaultPage {
    static function generateHeader() {
        $title = "Home";
        $site = Constants::getSiteName();

		echo "<!DOCTYPE html>\n";
        echo "<html>\n\n";
        echo "<head>\n";
        echo "\t<title>$title - $site</title>\n\n";
		echo "\t<meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\">\n";
		echo "\t<meta content=\"utf-8\" http-equiv=\"encoding\">\n";
        echo "\t<script language=\"javascript\" src=\"../js/Pornflix.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/Header.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/Footer.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/Feed.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/Video.js\" ></script>\n";
        echo "\t<script language=\"javascript\" src=\"../js/Search.js\" ></script>\n";
        echo "\t<script language=\"javascript\" src=\"../js/Helper.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/XHR.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/Constants.js\" ></script>\n";
		echo "\t<script src=\"http://vjs.zencdn.net/5.10.4/video.js\"></script>\n";
		echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">\n";
        echo "\t<link rel=\"shortcut icon\" href=\"../images/pornflix.ico\">\n";
		echo "\t<script src=\"https://use.fontawesome.com/874a48e914.js\"></script>\n";
		echo "\t<link href=\"http://vjs.zencdn.net/5.10.4/video-js.css\" rel=\"stylesheet\">\n";
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"http://fonts.googleapis.com/css?family=Roboto:300,400,500,700\">\n";
        echo "</head>\n\n";
        echo "<body>\n";
    }

    static function generateBody() {
		$view = null;
        $params = null;
		if(isset($_GET['view'])) {
			$view = ", '" . $_GET['view'] . "'";
		}
        if(isset($_GET['query'])) {
            $params = ", {'query': '" . $_GET['query']. "'}";
        }
		if(isset($_GET['id'])) {
			$params = ", {'id': '" . $_GET['id'] . "'}";
		}
        echo "\t<div id=\"system\"></div>\n";
        echo "\t<script>\n\t\tvar System = new Pornflix(document.getElementById('system')$view$params);\n\t</script>\n";
    }

    static function generateFooter() {
        echo "</body>\n\n";
        echo "</html>\n";
    }
}

?>
