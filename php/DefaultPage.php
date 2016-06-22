<?php

class DefaultPage {
    static function generateHeader() {
        $title = "Home";
        $site = "Netflix";

	echo "<!DOCTYPE html>\n";
        echo "<html>\n\n";
        echo "<head>\n";
        echo "\t<title>$title - $site</title>\n\n";
        echo "\t<script language=\"javascript\" src=\"../js/Pornflix.js\" ></script>\n";
        echo "\t<script language=\"javascript\" src=\"../js/Helper.js\" ></script>\n";
		echo "\t<script language=\"javascript\" src=\"../js/XHR.js\" ></script>\n";
        echo "\t<script src=\"https://use.fontawesome.com/3d3b4a3821.js\"></script>\n";
        echo "\t<link rel=\"shortcut icon\" href=\"../images/pornflix.ico\">\n";
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">\n";
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300\">\n";
        echo "</head>\n\n";
        echo "<body>\n";
    }

    static function generateBody() {
        echo "\t<div id=\"system\"></div>\n";
        echo "\t<script>\n\t\tvar System = new Pornflix(document.getElementById('system'));\n\t</script>\n";
    }

    static function generateFooter() {
        echo "</body>\n\n";
        echo "</html>\n";
    }
}

?>
