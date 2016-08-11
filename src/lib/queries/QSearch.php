<?php

/*
 * LITERALLY NO SANITIZATION OF QUERIES, DON'T MAKE THIS SHIT PUBLIC YOU ASSFACE
 * I ALSO MAY HAVE LEFT THE MAIN ARRAY NAME AS "MEME"
 */

class QSearch extends Query {
	private $sql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	function getResults($query) {
		$encode = array();
		$categories = array();
		$tags = array();
		$params = array();
		$pattern = "/.+?(?=(tag|pornstar|channel|end)+:)/";
		
		preg_match_all($pattern, $query . " end:", $matches);
		
		for($i = 0; $i < sizeof($matches[0]); $i++) {
			$categories[$i] = explode(":", $matches[0][$i]);
		}
		
		$sql =  "SELECT DISTINCT SQL_CALC_FOUND_ROWS videos.id, videos.name\n" .
				"FROM videos\n";
		
		$sql .= "WHERE ";
		
		for($i = 0; $i < sizeof($categories); $i++) {
			$cat_name = $categories[$i][0];
			$table = $categories[$i][0] . "s";

			if(sizeof($categories[$i]) == 1) {
				$params['video'] = "%" . preg_replace("/^\s\s*/", "",
										 preg_replace("/\s\s*$/", "",
										 $cat_name)) . "%";

				$sql .= "videos.name LIKE :video\n";
			} else {
				if(strpos($categories[$i][1], ',') !== false) {
					$tags = explode(',', $categories[$i][1]);

					for($j = 0; $j < sizeof($tags); $j++) {
						$sql .= "EXISTS (" .
								"SELECT videos.id\n" .
								"FROM video_$table\n" .
								"LEFT JOIN $table " .
								"ON $table.id = video_$table.$cat_name\n" .
								"WHERE video_$table.video = videos.id\n" .
								"AND $table.name = :tag$i$j)";

						$params["tag$i$j"] = preg_replace("/^\s\s*/", "",
											 preg_replace("/\s\s*$/", "",
											 $tags[$j]));

						if($j != sizeof($tags)-1) {
							$sql .= " AND ";
						}
					}
				} else {
					$sql .= "EXISTS (" .
							"SELECT videos.id\n" .
							"FROM video_$table\n" .
							"LEFT JOIN $table " .
							"ON $table.id = video_$table.$cat_name\n" .
							"WHERE video_$table.video = videos.id\n" .
							"AND $table.name = :tag)";

					$params['tag'] = preg_replace("/^\s\s*/", "",
								 	 preg_replace("/\s\s*$/", "",
								 	 $categories[$i][1]));
				}
			}

			if($i != sizeof($categories)-1) {
				$sql .= "AND ";
			}
		}

		$result = $this->mysql->prepare($sql);
		$result->execute($params);

		$row_result = $this->mysql->prepare("SELECT FOUND_ROWS()");
		$row_result->execute();
		$row_count = $row_result->fetchColumn();

		if($row_count > 0) {
			$i = 0;
			while($row = $result->fetch()) {
				$encode['video'][$i]['id'] =  $row['id'];
				$encode['video'][$i]['name'] = $row['name'];
				$i++;
			}
			$encode['results'] = true;
		} else {
			$encode['results'] = false;
		}
		return $encode;
	}

	function process() {
		if (isset($_GET['method']))	{
			$method = $_GET['method'];

			$content = $this->$method();

			echo json_encode($content);
		}
	}
}

?>
