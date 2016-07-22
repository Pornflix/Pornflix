<?php

include_once('WebService.php');

class WSVideos extends WebService {
	function getVideoNames() {
		$feedName = isset($_GET['feedName']) ? $_GET['feedName'] : '';

		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();
		$encode = array('video' => [], 'feedName'=> $feedName);

		$mysql = new mysqli($host, $user, $pass, $db);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}
		$sql = "SELECT `videos`.`id`, `videos`.`name`
				FROM `videos`\n";

		switch($feedName) {
			case "Newest":
				$sql .= "ORDER BY `videos`.`date` DESC";
				break;
			case "Anal":
				$sql .= "LEFT JOIN `video_tags` ON `video_tags`.`video` = `videos`.`id`
						 LEFT JOIN `tags` ON `tags`.`id` = `video_tags`.`tag`
						 WHERE `tags`.`name` = 'anal'";
				break;
			case "All":
				break;
			default:
				$sql .="";
		}

		$sql .= "\nLIMIT 8";

		$result = $mysql->query($sql);

		$i = 0;
		while($row = $result->fetch_assoc()) {
			$encode['video'][$i]['id'] =  $row['id'];
			$encode['video'][$i]['name'] = $row['name'];
			$i++;
		}

		$mysql->close();
		return json_encode($encode);
	}

	function getVideoInfo() {
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();
		$encode = array();

		$mysql = new mysqli($host, $user, $pass, $db);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}
		$sql = "SELECT `id`,`name`,`description`,`views` FROM videos WHERE `id` = $id LIMIT 1;";
		$result = $mysql->query($sql);

		if($row = $result->fetch_assoc()) {
			$encode['id'] =  $row['id'];
			$encode['name'] = $row['name'];
			$encode['description'] = $row['description'];
			$encode['views'] = $row['views'];
		}

		$mysql->close();
		return json_encode($encode);
	}

	function getTags() {
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();
		$encode = array(
			0 => [
				'name' => 'Channel',
				'tag' => []
			],
			1 => [
				'name' => 'Pornstars',
				'tag' => []
			],
			2 => [
				'name' => 'Tags',
				'tag' => []
			]
		);

		$mysql = new mysqli($host, $user, $pass, $db);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}

		$sql = "SELECT `channels`.`id`, `channels`.`name`
				FROM `channels`
				LEFT JOIN `video_channels` ON `video_channels`.`channel` = `channels`.`id`
				WHERE `video` = $id;";
		$result = $mysql->query($sql);

		while($row = $result->fetch_assoc()) {
			$result1 = $mysql->query("SELECT COUNT(`id`) AS `count` FROM `video_channels` WHERE `channel` = " . $row['id'] . " LIMIT 1;");
			if($row1 = $result1->fetch_assoc()) {
				array_push($encode[0]['tag'], ['name' => $row['name'], 'count' => $row1['count']]);
			}
		}

		$sql = "SELECT `tags`.`id`, `tags`.`name`, `tags`.`type`
				FROM `tags`
				LEFT JOIN `video_tags` ON `video_tags`.`tag` = `tags`.`id`
				WHERE `video` = $id;";
		$result = $mysql->query($sql);

		while($row = $result->fetch_assoc()) {
			$result1 = $mysql->query("SELECT COUNT(`id`) AS `count` FROM `video_tags` WHERE `tag` = " . $row['id'] . " LIMIT 1;");
			if($row1 = $result1->fetch_assoc()) {
				array_push($encode[2]['tag'], ['name' => $row['name'], 'count' => $row1['count']]);
			}
		}
		array_push($encode[2]['tag'], ['name' => 'Add tag', 'count' => '+']);

		$sql = "SELECT `pornstars`.`id`, `pornstars`.`name`, `pornstars`.`gender`
				FROM `pornstars`
				LEFT JOIN `video_pornstars` ON `video_pornstars`.`pornstar` = `pornstars`.`id`
				WHERE `video` = $id;";
		$result = $mysql->query($sql);

		$i = 0;
		while($row = $result->fetch_assoc()) {
			$encode[1]['tag'][$i]['name'] =  $row['name'];
			$encode[1]['tag'][$i]['extra'] = $row['gender'];

			$result1 = $mysql->query("SELECT COUNT(`id`) AS `count` FROM `video_pornstars` WHERE `pornstar`  = " . $row['id'] . " LIMIT 1;");
			if($row1 = $result1->fetch_assoc()) {
				$encode[1]['tag'][$i]['count'] = $row1['count'];
			}
			$i++;
		}
		$mysql->close();
		return json_encode($encode);
	}

	function addTag() {
		$id = $_GET['id'];
		$tag = $_GET['tag'];

		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();

		$mysql = new mysqli($host, $user, $pass, $db);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}

		$sql = "SELECT `id`
				FROM `tags`
				WHERE `name` = '$tag'
				LIMIT 1";
		$result = $mysql->query($sql);
		if($row = $result->fetch_assoc()) {
			$tag_id = $row['id'];
		}

		$sql = "INSERT INTO video_tags(video, tag, date) VALUES('$id', '$tag_id', CURRENT_TIMESTAMP);";

		if($mysql->query($sql) === TRUE && isset($id) && isset($tag)) {
			$encode = array('success' => 'true');
		} else {
			$encode = array('success' => 'failed');
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
