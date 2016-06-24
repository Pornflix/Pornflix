<?php

include_once('WebService.php');

class WSVideos extends WebService {
	function memes() {
		$servername = "127.0.0.1";
		$username = Constants::getMySQLUser();
		$password = Constants::getMySQLPass();
		$dbname = Constants::getDBName();
		$encode = array();

		$mysql = new mysqli($servername, $username, $password, $dbname);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}
		$sql = "SELECT `id`,`name` FROM videos;";
		$result = $mysql->query($sql);

		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$encode[$i]['id'] =  $row['id'];
			$encode[$i]['name'] = $row['name'];
			$i++;
		}

		$mysql->close();
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
