<?php

class MySQL {
	public $conn;

	function __construct() {
		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();

		$this->conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

	}
}

?>
