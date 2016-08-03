<?php

class Query {
	function processWebService() {
		if(isset($_GET['ws'])) {
			$webservice = null;

			$wsName = $_GET['ws'];
			
			$webservice = new $wsName();

			if($webservice != null) {
				$webservice->process();
			}
		}
	}

	function process() {

	}
}

?>
