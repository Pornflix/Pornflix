<?php

include_once('WebService.php');

class WSVideos extends WebService {
	function memes() {
		$servername = "127.0.0.1";
		$username = "root";
		$password = "Shylah6525";
		$dbname = "SFW";
		$encode = array();

		$mysql = new mysqli($servername, $username, $password, $dbname);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}
		$sql = "SELECT `id`,`name` FROM videos;";
		$result = $mysql->query($sql);

		while ($row = $result->fetch_assoc()) {
			$encode['id'] = $row['id'];
			$encode['name'] = $row['name'];
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
