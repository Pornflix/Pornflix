<?php

class Page {
	function generate() {
		$content = "";

		if(isset($_GET['ws'])) {
			$ws = new Query();
			$ws->processWebService();
			return;
		} else if(isset($_GET['splash'])) {
			$splash = new Splash();

			$content .= $splash->generate();
		} else {
			$constants = new Constants();

			$dp = new DefaultPage;

			$content .= $dp::generateHeader();
			$content .= $dp::generateBody();
			$content .= $dp::generateFooter();
		}

		echo $content;
	}
}

?>
