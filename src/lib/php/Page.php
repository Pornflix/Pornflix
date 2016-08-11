<?php

class Page {
	function generate() {
		$content = "";
		$method = $_SERVER['REQUEST_METHOD'];

		session_start();

		$mysql = (new MySQL())->conn;
		$constants = new Constants();
		$session = new Session($mysql);

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
			exit();
		}

		if($session->authenticate()) {
			if($method == 'GET') {
				if(isset($_GET['ws'])) {
					$ws = new Query($mysql);
					$ws->processWebService();
					return;
				}

				if(isset($_GET['view'])) {
					$dp = new DefaultPage($mysql);

					$content .= $dp->generateHeader();
					$content .= $dp->generateBody();
					$content .= $dp->generateFooter();
				} else {
					$dp = new DefaultPage($mysql);

					$content .= $dp->generateHeader();
					$content .= $dp->generateBody();
					$content .= $dp->generateFooter();
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
