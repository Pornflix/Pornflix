<?php

class Page {
    function generate() {
		if (isset($_GET['webservice']) || isset($_GET['jsonservice'])) {
			$ws = new WebService();
			$ws->processWebService();
            return;
		} else {
			$constants = new Constants();

			$dp = new DefaultPage;

			$dp::generateHeader();
			$dp::generateBody();
			$dp::generateFooter();
		}
    }
}

?>
