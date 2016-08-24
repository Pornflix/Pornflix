<?php

class Splash {	
	public function generate() {
		if(isset($_GET['sign-in'])) {
			$content = $this->splashHeader();
			$content .= $this->splashLogin();
			$content .= $this->splashFooter();
		} else if(isset($_GET['sign-up'])) {
			$content = $this->splashHeader();
			$content .= $this->splashSignUp();
			$content .= $this->splashFooter();
		} else {
			$content = $this->splashHeader();
			$content .= $this->splashBody();
			$content .= $this->splashFooter();
		}

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
		$file = rand(1, countdir(Constants::getDataDir() . "/backgrounds/")) . ".jpg";
		$content = "\t<div id=\"system\" style=\"background-image: url('" . Constants::getDataDir() . "/backgrounds/$file');\">\n";
		$content .= "\t\t<div id=\"container\">\n";
		$content .= "\t\t\t<div id=\"header\">\n";
		$content .= "\t\t\t\t<a href=\"/\"><span id=\"logo\">" . Constants::getSiteName() . "</span></a>\n";
		$content .= "\t\t\t\t<a href=\"/?sign-in\"><span id=\"sign-in-button\">Sign In</span></a>\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t\t<div id=\"tagline\">\n";
		$content .= "\t\t\t\t<span id=\"title\">Completely ad free.</span>\n";
		$content .= "\t\t\t\t<span id=\"subtitle\">HD " . (Constants::getSFW() ? "videos" : "porn") . ". $10 a month.</span>\n";
		$content .= "\t\t\t\t<a href=\"/?sign-up\">\n";
		$content .= "\t\t\t\t\t<span id=\"button\">try free for a month</span>\n";
		$content .= "\t\t\t\t</a>\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t</div>\n";
		$content .= "\t</div>\n";

		return $content;
	}

	function splashLogin() {
		$file = rand(1, countDir(Constants::getDataDir() . "/backgrounds/")) . ".jpg";
		$content = "\t<div id=\"system\" style=\"background-image: url('" . Constants::getDataDir() . "/backgrounds/$file');\">\n";
		$content .= "\t\t<div id=\"container\">\n";
		$content .= "\t\t\t<div id=\"header\">\n";
		$content .= "\t\t\t\t<a href=\"/\"><span id=\"logo\">" . Constants::getSiteName() . "</span></a>\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t\t<div id=\"sign-in-container\">\n";
		$content .= "\t\t\t\t<form id=\"sign-in-form\" method=\"post\" name=\"logon\" action=\"/\">\n";
		$content .= "\t\t\t\t\t<span id=\"sign-in-title\">Sign In</span>\n";
		$content .= "\t\t\t\t\t<span id=\"sign-in-subtitle\">Username</span>\n";
		$content .= "\t\t\t\t\t<input type=\"hidden\" name=\"command\" value=\"logon\">\n";
		$content .= "\t\t\t\t\t<input id=\"sign-in-input\" type=\"text\" name=\"user\" required autofocus>\n";
		$content .= "\t\t\t\t\t<span id=\"sign-in-subtitle\">Password</span>\n";
		$content .= "\t\t\t\t\t<input id=\"sign-in-input\" type=\"password\" name=\"pass\" required>\n";
		$content .= "\t\t\t\t\t<input id=\"remember-me-checkbox\" type=\"checkbox\" name=\"remember-me\">Remember me on this device\n";
		$content .= "\t\t\t\t\t<button id=\"sign-in-submit\" type=\"submit\">Sign In</button>\n";
		$content .= "\t\t\t\t</form>\n";
		$content .= "\t\t\t</div>\n";
		$content .= "\t\t</div>\n";
		$content .= "\t</div>\n";

		return $content;
	}

	function splashSignUp() {

	}

	function splashFooter() {
		$content = "<script>
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

					ga('create', 'UA-81487339-1', 'auto');
					ga('send', 'pageview');

					</script>";
		$content .= "</body>\n\n";
		$content .= "</html>\n";

		return $content;
	}
}

?>
