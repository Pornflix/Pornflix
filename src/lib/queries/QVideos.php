<?php

class QVideos extends Query {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	function getVideoNames($feedName) {
		$encode = array('video' => []);

		$sql = "SELECT videos.id, videos.name\n" .
				"FROM videos\n";

		switch($feedName) {
			case "Newest":
				$sql .= "ORDER BY videos.date DESC\n";
				break;
			case "Anal":
				$sql .= "LEFT JOIN video_tags " .
						"ON video_tags.video = videos.id\n" .
						"LEFT JOIN tags " .
						"ON tags.id = video_tags.tag\n" .
						"WHERE tags.name = 'anal'";
				break;
			case "All":
				break;
			default:
				$sql .="";
		}

		$sql .= "\nLIMIT 8";

		$result = $this->mysql->prepare($sql);
		$result->execute();

		$i = 0;
		while($row = $result->fetch()) {
			$encode['video'][$i]['id'] =  $row['id'];
			$encode['video'][$i]['name'] = $row['name'];
			$i++;
		}
		return $encode;
	}

	function getVideoInfo($id) {
		$encode = array();

		$sql =  "SELECT id, name, description, views\n" .
				"FROM videos\n" .
				"WHERE id = :id\n" .
				"LIMIT 1";

		$result = $this->mysql->prepare($sql);
		$result->execute(array('id' => $id));

		if($row = $result->fetch()) {
			$encode['id'] =  $row['id'];
			$encode['name'] = $row['name'];
			$encode['description'] = $row['description'];
			$encode['views'] = $row['views'];
		}
		return $encode;
	}

	function getRandomDescription() {
		$url = "http://imdb.com/random/title/";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);

		$imdbID = explode("/", curl_getinfo($ch, CURLINFO_EFFECTIVE_URL))[4];
		$url = "http://www.omdbapi.com/?i=$imdbID&plot=short&r=json";

		$movie = json_decode(file_get_contents($url), true);

		return $movie["Plot"];
	}

	function getTags($id) {
		$people = (Constants::getSFW() ? 'actor' : 'pornstar');	

		$encode = array(
			0 => [
				'name' => 'Channel',
				'tag' => []
			],
			1 => [
				'name' => ucfirst($people) . 's',
				'tag' => []
			],
			2 => [
				'name' => 'Tags',
				'tag' => []
			]
		);

		$sql = "SELECT channels.id, channels.name\n" .
				"FROM channels\n" .
				"LEFT JOIN video_channels " .
				"ON video_channels.channel = channels.id\n" .
				"WHERE video = :id;";

		$result = $this->mysql->prepare($sql);
		$result->execute(array('id' => $id));

		while($row = $result->fetch()) {
			$sql =  "SELECT COUNT(id) AS count\n" .
					"FROM video_channels\n" .
					"WHERE channel = :channel\n" .
					"LIMIT 1";

			$result1 = $this->mysql->prepare($sql);
			$result1->execute(array('channel' => $row['id']));

			if($row1 = $result1->fetch()) {
				array_push($encode[0]['tag'], [
					'name' => $row['name'],
					'count' => $row1['count']
				]);
			}
		}

		$sql =  "SELECT tags.id, tags.name, tags.type\n" .
				"FROM tags\n" .
				"LEFT JOIN video_tags ON video_tags.tag = tags.id\n" .
				"WHERE video = :id";

		$result = $this->mysql->prepare($sql);
		$result->execute(['id' => $id]);

		while($row = $result->fetch()) {
			$sql =  "SELECT COUNT(id) AS num\n" .
					"FROM video_tags\n" .
					"WHERE tag = :tag\n" .
					"LIMIT 1";

			$result1 = $this->mysql->prepare($sql);
			$result1->execute(['tag' => $row['id']]);

			if($row1 = $result1->fetch()) {
				array_push($encode[2]['tag'], [
					'name' => $row['name'],
					'count' => $row1['num']
				]);
			}
		}
		array_push($encode[2]['tag'], ['name' => 'Add tag', 'count' => '+']);

		$peoples = $people . "s";

		$sql = "SELECT $peoples.id, $peoples.name, $peoples.gender\n" .
				"FROM $peoples\n" .
				"LEFT JOIN video_$peoples " .
				"ON video_$peoples.$people = $peoples.id\n" .
				"WHERE video = :id";

		$result = $this->mysql->prepare($sql);
		$result->execute(['id' => $id]);

		$i = 0;
		while($row = $result->fetch()) {
			$encode[1]['tag'][$i]['name'] =  $row['name'];
			$encode[1]['tag'][$i]['extra'] = $row['gender'];

			$sql =  "SELECT COUNT(id) AS count\n" .
					"FROM video_$peoples\n" .
					"WHERE $people = :people\n" .
					"LIMIT 1";

			$result1 = $this->mysql->prepare($sql);
			$result1->execute(['people' => $row['id']]);

			if($row1 = $result1->fetch()) {
				$encode[1]['tag'][$i]['count'] = $row1['count'];
			}
			$i++;
		}
		return $encode;
	}

	function addTag($id = null, $tag = null) {
		$id = (isset($id) ? $id : $_GET['id']);
		$tag = (isset($tag) ? $tag : $_GET['tag']);

		$encode = ['success' => 'false'];

		$sql = "SELECT id\n" .
				"FROM tags\n" .
				"WHERE name = :tag\n" .
				"LIMIT 1";

		$result = $this->mysql->prepare($sql);
		$result->execute(['tag' => $tag]);

		if($row = $result->fetch()) {
			$tag_id = $row['id'];
		}

		$sql =  "INSERT INTO video_tags(video, tag, date)\n" .
				"VALUES(:video, :tag, CURRENT_TIMESTAMP)";

		$result = $this->mysql->prepare($sql);

		if(isset($id) && isset($tag_id)) {
			if($result->execute(['video' => $id, 'tag' => $tag_id])) {
				$encode = ['success' => 'true'];
			}
		}
		return $encode;
	}

	function process() {
		if(isset($_GET['method'])) {
			$method = $_GET['method'];

			$content = $this->$method();
			
			echo json_encode($content);
		}
	}

	function incrementViews($id = null) {
		$id = (isset($id) ? $id : $_GET['id']);

		$encode = ['success' => 'false'];

		$sql =  "SELECT views\n" .
				"FROM videos\n" .
				"WHERE id = :id";

		$result = $this->mysql->prepare($sql);
		$result->execute(['id' => $id]);
		$views = $result->fetch()['views'];

		$sql =  "UPDATE videos\n" .
				"SET views = :views\n" .
				"WHERE id = :id";

		$result = $this->mysql->prepare($sql);

		if(isset($views)) {
			if($result->execute(['views' => $views+1, 'id' => $id])) {
				$encode = ['success' => 'true'];
			}
		}
		return $encode;
	}
}

?>
