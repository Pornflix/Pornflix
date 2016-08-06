<?php

class Page {
	function generate() {
		$content = "";
		$method = $_SERVER['REQUEST_METHOD'];

		session_start();

		$constants = new Constants();
		$session = new Session();
		
		if($method == 'POST') {
			if(isset($_POST['command'])) {
				switch($_POST['command']) {
					case "logon":
						$session->logon($_POST['user'], $_POST['pass']);
						break;
					case "logoff":
						$session->logoff();
				}
			}

			header("Location: " . $_SERVER['REQUEST_URI']);
			die;
		}

		if($session->authenticate()) {
			if($method == 'GET') {
				switch($_GET) {
					case "ws":
						$ws = new Query();
						$ws->processWebService();
						return;
					case "view":
						$dp = new DefaultPage;

						$content .= $dp::generateHeader();
						$content .= $dp::generateBody();
						$content .= $dp::generateFooter();
					default: 
						$dp = new DefaultPage;

						$content .= $dp::generateHeader();
						$content .= $dp::generateBody();
						$content .= $dp::generateFooter();
				}
			}
		} else {
			$splash = new Splash();

			$content .= $splash->generate();
		}

		echo $content;
	}
}

?>
