<?php

class QCommon extends Query {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	function getUsername($id) {
		$sql =  "SELECT username\n" .
				"FROM users\n" .
				"WHERE id = :id";

		$result = $this->mysql->prepare($sql);
		$result->execute(['id' => $id]);

		if($row = $result->fetch()) {
			return $row['username'];
		}
	}

	function process() {
		if(isset($_GET['method'])) {
			$method = $_GET['method'];

			$content = $this->$method();
			
			echo json_encode($content);
		}
	}
}

?>
