<?php

include_once('WebService.php');

class WSVideos extends WebService {
	function getVideoNames() {
		$feedName = $_GET['feedName'];

		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();
		$encode = array('video' => [], 'feedName'=> $feedName);

		$mysql = new mysqli($host, $user, $pass, $db);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}
		$sql = "SELECT `id`,`name` FROM videos;";
		$result = $mysql->query($sql);

		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$encode['video'][$i]['id'] =  $row['id'];
			$encode['video'][$i]['name'] = $row['name'];
			$i++;
		}

		$mysql->close();
		return json_encode($encode);
	}

	function getRecommendedVideos() {
		
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
