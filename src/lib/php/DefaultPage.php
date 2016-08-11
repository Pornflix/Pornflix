<?php

class DefaultPage {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	public function generateHeader() {
		$title = "Home";
		$site = Constants::getSiteName();
		
		$content = "<!DOCTYPE html>\n";
		$content .= "<html>\n\n";
		$content .= "<head>\n";
		$content .= "\t<title>$title - $site</title>\n\n";
		$content .= "\t<meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\">\n";
		$content .= "\t<meta content=\"utf-8\" http-equiv=\"encoding\">\n";
		$content .= "\t<script language=\"javascript\" src=\"../js/Helper.js\" ></script>\n";
		$content .= "\t<script language=\"javascript\" src=\"../js/XHR.js\"></script>\n";
		$content .= "\t<script src=\"http://vjs.zencdn.net/5.10.4/video.js\"></script>\n";
		$content .= "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">\n";
		$content .= "\t<link rel=\"shortcut icon\" href=\"../images/pornflix.ico\">\n";
		$content .= "\t<script src=\"https://use.fontawesome.com/bc31adac8a.js\"></script>\n";
		$content .= "\t<link href=\"http://vjs.zencdn.net/5.10.4/video-js.css\" rel=\"stylesheet\">\n";
		$content .= "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"http://fonts.googleapis.com/css?family=Roboto:300,400,500,700\">\n";
		$content .= "</head>\n\n";
		$content .= "<body>\n";

		return $content;
	}

	public function generateBody() {
		$content =  "\t<div id=\"system\">\n";
		$content .= (new Pornflix($this->mysql))->generate();
		$content .= "\t</div>\n";

		return $content;
	}

	public function generateFooter() {
		$content = "</body>\n\n";
		$content .= "</html>\n";

		return $content;
	}
}

?>
