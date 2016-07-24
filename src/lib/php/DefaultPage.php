<?php

class DefaultPage {
    static function generateHeader() {
        $title = "Home";
        $site = Constants::getSiteName();

        $content = "<!DOCTYPE html>\n";
        $content .= "<html>\n\n";
        $content .= "<head>\n";
        $content .= "\t<title>$title - $site</title>\n\n";
        $content .= "\t<meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\">\n";
        $content .= "\t<meta content=\"utf-8\" http-equiv=\"encoding\">\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Pornflix.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Header.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Footer.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Feed.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Video.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Search.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Helper.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/XHR.js\" ></script>\n";
        $content .= "\t<script language=\"javascript\" src=\"../js/Constants.js\" ></script>\n";
        $content .= "\t<script src=\"http://vjs.zencdn.net/5.10.4/video.js\"></script>\n";
        $content .= "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">\n";
        $content .= "\t<link rel=\"shortcut icon\" href=\"../images/pornflix.ico\">\n";
        $content .= "\t<script src=\"https://use.fontawesome.com/874a48e914.js\"></script>\n";
        $content .= "\t<link href=\"http://vjs.zencdn.net/5.10.4/video-js.css\" rel=\"stylesheet\">\n";
        $content .= "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"http://fonts.googleapis.com/css?family=Roboto:300,400,500,700\">\n";
        $content .= "</head>\n\n";
        $content .= "<body>\n";

        echo $content;
    }

    static function generateBody() {
        echo "\t<div id=\"system\">\n";
        new Pornflix();
        echo "\t</div>\n";
    }

    static function generateFooter() {
        echo "</body>\n\n";
        echo "</html>\n";
    }
}

?>
