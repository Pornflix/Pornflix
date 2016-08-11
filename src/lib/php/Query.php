<?php

class Query {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	function processWebService() {
		if(isset($_GET['ws'])) {
			$webservice = null;

			$wsName = $_GET['ws'];
			
			$webservice = new $wsName($this->mysql);

			if($webservice != null) {
				$webservice->process();
			}
		}
	}

	function process() {

	}
}

?>
