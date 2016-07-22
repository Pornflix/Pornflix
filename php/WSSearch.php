<?php

include_once('WebService.php');

/*
 * LITERALLY NO SANITIZATION OF QUERIES, DON'T MAKE THIS SHIT PUBLIC YOU ASSFACE
 * I ALSO MAY HAVE LEFT THE MAIN ARRAY NAME AS "MEME"
 */

class WSSearch extends WebService {
	function getResults() {
		$query = isset($_GET['query']) ? $_GET['query'] : '';

		$host = Constants::getMySQLDomain();
		$user = Constants::getMySQLUser();
		$pass = Constants::getMySQLPass();
		$db = Constants::getDBName();
		$encode = array();

		$mysql = new mysqli($host, $user, $pass, $db);
		if ($mysql->connect_error) {
			die ("Connection failed: " . $mysql->connect_error);
		}

        $pattern = "/.+?(?=(tag|pornstar|channel|end)+:)/";

        preg_match_all($pattern, $query . " end:", $matches);

        $categories = array();
        $tags = array();
        for($i = 0; $i < sizeof($matches[0]); $i++) {
            $categories[$i] = explode(":", $matches[0][$i]);
        }

        $sql = "SELECT DISTINCT `videos`.`id`, `videos`.`name`\nFROM `videos`\n";

        $sql .= "WHERE ";

        for($i = 0; $i < sizeof($categories); $i++) {
			if(sizeof($categories[$i]) == 1) {
				$sql .= "`videos`.`name` LIKE '%" . preg_replace("/^\s\s*/", "", preg_replace("/\s\s*$/", "", $categories[$i][0])) . "%'\n";
			} else {
				if(strpos($categories[$i][1], ',') !== false) {
					$tags = explode(',', $categories[$i][1]);
					for($j = 0; $j < sizeof($tags); $j++) {
						$sql .= "EXISTS (SELECT `videos`.`id`\nFROM `video_" . $categories[$i][0] . "s`\n";
						$sql .= "LEFT JOIN `" . $categories[$i][0] . "s` ON `" . $categories[$i][0] . "s`.`id` = `video_" . $categories[$i][0] . "s`.`" . $categories[$i][0] . "`\n";
						$sql .= "WHERE `video_" . $categories[$i][0] . "s`.`video` = `videos`.`id`\nAND `" . $categories[$i][0] . "s`.`name` = '" . preg_replace("/^\s\s*/", "", preg_replace("/\s\s*$/", "", $tags[$j])) . "')\n";
						if($j != sizeof($tags)-1) {
							$sql .= "AND ";
						}
					}
				} else {
					$sql .= "EXISTS (SELECT `videos`.`id`\nFROM `video_" . $categories[$i][0] . "s`\n";
					$sql .= "LEFT JOIN `" . $categories[$i][0] . "s` ON `" . $categories[$i][0] . "s`.`id` = `video_" . $categories[$i][0] . "s`.`" . $categories[$i][0] . "`\n";
					$sql .= "WHERE `video_" . $categories[$i][0] . "s`.`video` = `videos`.`id`\nAND `" . $categories[$i][0] . "s`.`name` = '" . preg_replace("/^\s\s*/", "", preg_replace("/\s\s*$/", "", $categories[$i][1])) . "')\n";
				}
			}

            if($i != sizeof($categories)-1) {
                $sql .= "AND ";
            }
        }

		$result = $mysql->query($sql);

		if(mysqli_num_rows($result) > 0) {
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$encode['videos'][$i]['id'] =  $row['id'];
				$encode['videos'][$i]['name'] = $row['name'];
				$i++;
			}
			$encode['results'] = true;
		} else {
			$encode['results'] = false;
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
