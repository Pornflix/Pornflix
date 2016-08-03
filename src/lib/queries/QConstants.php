<?php

include_once('../WebService.php');

class QConstants extends Query {
	function getConstants() {
		$encode = array(
			'site' => Constants::getSiteName(),
			'dataDir' => Constants::getDataDir()
		);

		return json_encode($encode);
	}

	function process() {
		if (isset($_GET['method']))
		{
			$method = $_GET['method'];

			$content = $this->$method();

			echo $content;
		}
		else
		{
			echo "<WSYGSMS__process>Method Not Set</WSYGSMS__process>";
		}
	}
}

?>
