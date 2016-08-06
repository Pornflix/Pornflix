<?php

class Session {
	function __construct() {

	}

	function isLoggedIn() {
		
	}

	function logon($user, $pass) {
		$host = Constants::getMySQLDomain();
		$mysqluser = Constants:: getMySQLUser();
		$mysqlpass = Constants::getMySQLPass();
		$db = Constants::getDBName();

		$mysql = new mysqli($host, $mysqluser, $mysqlpass, $db);

		$sql = "SELECT * FROM `users` WHERE `username` = \"$user\" LIMIT 1";
		$result = $mysql->query($sql);

		if($row = $result->fetch_assoc()) {
			$userid = $row['id'];
			$username = $row['username'];
			$password = $row['password'];

			echo $pass;
			echo $password;

			if($password == $pass) {
				$_SESSION['userid'] = $userid;
				$_SESSION['username'] = $username;
			}
		}
	}

	function logoff() {
		session_unset();
		session_destroy();
	}

	function authenticate() {
		if(isset($_SESSION['username'])) {
			$host = Constants::getMySQLDomain();
			$mysqluser = Constants:: getMySQLUser();
			$mysqlpass = Constants::getMySQLPass();
			$db = Constants::getDBName();
			$user = $_SESSION['username'];
			$mysql = new mysqli($host, $mysqluser, $mysqlpass, $db);

			$sql = "SELECT * FROM `users` WHERE `username`=\"$user\"";
			$result = $mysql->query($sql);

			if($row = $result->fetch_assoc()) {
				return true;
				}
		}
		return false;
	}
}

?>
