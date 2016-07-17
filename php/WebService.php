<?php

include_once('WSVideos.php');

class WebService {
	function processWebService() {
		if(isset($_GET['webservice'])) {
			$webservice = null;

			$wsName = $_GET['webservice'];

			$webservice = new $wsName();

			if ($webservice != null)
			{
				$webservice->process();
			}
			else
			{
				echo "<WebService__process>Invalid Webservice</WebService__process>";
			}
		}
	}

	function process() {

	}
}

?>
