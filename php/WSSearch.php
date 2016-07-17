<?php

include_once('WebService.php');

/*
 * LITERALLY NO SANITIZATION OF QUERIES, DON'T MAKE THIS SHIT PUBLIC YOU ASSFACE
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

        $meme = array();
        $final = array();
        $comma = array();
        for($i = 0; $i < sizeof($matches[0]); $i++) {
            $meme[$i] = explode(":", $matches[0][$i]);
        }

        $sql = "SELECT DISTINCT `videos`.`id`, `videos`.`name`\nFROM `videos`\n";

        for($i = 0; $i < sizeof($meme); $i++) {
            if(sizeof($meme[$i]) == 2) {
                $sql .= "LEFT JOIN `video_" . $meme[$i][0] . "s` ON `video_" . $meme[$i][0] . "s`.`video` = `videos`.`id`\n";
                $sql .= "LEFT JOIN `" . $meme[$i][0] . "s` ON `" . $meme[$i][0] . "s`.`id` = `video_" . $meme[$i][0] . "s`.`" . $meme[$i][0] . "`\n";
            }
        }

        $sql .= "WHERE ";

        for($i = 0; $i < sizeof($meme); $i++) {
            if(sizeof($meme[$i]) == 1) {
                $sql .= "`videos`.`name` LIKE '%" . preg_replace("/^\s\s*/", "", preg_replace("/\s\s*$/", "", $meme[$i][0])) . "%'\n";
            } else {
                if (strpos($meme[$i][1], ',') !== false) {
                    $comma = explode(",", $meme[$i][1]);
                    for($j = 0; $j < sizeof($comma); $j++) {
                        $sql .=  "`" . $meme[$i][0] . "s`.`name` LIKE '%" . preg_replace("/^\s\s*/", "", preg_replace("/\s\s*$/", "", $comma[$j])) . "%'\n";
                        if($j != sizeof($comma)-1) {
                            $sql .= "OR ";
                        }
                    }
                } else {
                    $sql .= "`" . $meme[$i][0] . "s`.`name` LIKE '%" . preg_replace("/^\s\s*/", "", preg_replace("/\s\s*$/", "", $meme[$i][1])) . "%'\n";
                }
            }

            if($i != sizeof($meme)-1) {
                $sql .= "AND ";
            }
        }

		$result = $mysql->query($sql);

		$i = 0;
		while($row = $result->fetch_assoc()) {
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
