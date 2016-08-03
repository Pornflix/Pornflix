<?php

class Splash {	
	public function generate() {
		$content = $this->splashHeader();
		$content .= $this->splashBody();
		$content .= $this->splashFooter();

		return $content;
	}

	function splashHeader() {
		$content = "<!DOCTYPE html>\n";
		$content .= "<html>\n\n";
		$content .= "<head>\n";
		$content .= "\t<title>" . Constants::getSiteName() . "</title>\n";
		$content .= "\t<meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\">\n";
		$content .= "\t<meta content=\"utf-8\" http-equiv=\"encoding\">\n";
		$content .= "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/splash.css\">\n";
		$content .= "\t<link rel=\"shortcut icon\" href=\"../images/pornflix.ico\">\n";
		$content .= "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"http://fonts.googleapis.com/css?family=Roboto:300,400,500,700\">\n";
		$content .= "</head>\n\n";
		$content .= "<body>\n";

		return $content;
	}

	function splashBody() {
		$content = "\t<div id=\"system\" style=\"background-image: url('../data/backgrounds/" . rand(1,39) . ".jpg');\">\n";
		$content .= "\t\t<div id=\"container\">\n";
		$content .= "\t\t\t<div id=\"header\">\n";
		$content .= "\t\t\t\t<span id=\"logo\">Pornflix</span>\n";
		$content .= "\t\t\t\t<span id=\"sign-in\">Sign In</span>\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t\t<div id=\"tagline\">\n";
		$content .= "\t\t\t\t<span id=\"title\">Completely ad free.</span>\n";
		$content .= "\t\t\t\t<span id=\"subtitle\">HD porn. $10 a month.</span>\n";
		$content .= "\t\t\t\t<a href=\"#\">\n";
		$content .= "\t\t\t\t\t<span id=\"button\">Try free for a month</span>\n";
		$content .= "\t\t\t\t</a>\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t</div>\n";
		$content .= "\t</div>\n";

		return $content;
	}

	function splashFooter() {
		$content = "</body>\n\n";
		$content .= "</html>\n";

		return $content;
	}
}

?>
