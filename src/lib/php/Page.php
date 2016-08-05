<?php

class Page {
	function generate() {
		$content = "";

		if(isset($_GET['ws'])) {
			$ws = new Query();
			$ws->processWebService();
			return;
		} else if(isset($_GET['view'])) {
			$constants = new Constants();

			$dp = new DefaultPage;

			$content .= $dp::generateHeader();
			$content .= $dp::generateBody();
			$content .= $dp::generateFooter();
		} else {
			$splash = new Splash();

			$content .= $splash->generate();
		}

		echo $content;
	}
}

?>
