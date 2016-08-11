<?php

class Session {
	private $mysql;

	function __construct($mysql) {
		$this->mysql = $mysql;
	}

	function isLoggedIn() {
		
	}

	function logon($formUsername, $formPassword) {
		$mysqluser = Constants:: getMySQLUser();
		$mysqlpass = Constants::getMySQLPass();
		$db = Constants::getDBName();

		$mysql = new mysqli($host, $mysqluser, $mysqlpass, $db);

		$sql = "SELECT `id`,`username`,`password` FROM `users` WHERE `username` = \"$formUsername\" LIMIT 1";
		$result = $mysql->query($sql);

		if($row = $result->fetch_assoc()) {
			$userid = $row['id'];
			$username = $row['username'];
			$password = $row['password'];

			if(password_verify($formPassword, $password)) {
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
			$sql = "SELECT * FROM `users` WHERE `username`=\"$user\" LIMIT 1";
			$result = $mysql->query($sql);

			if($row = $result->fetch_assoc()) {
				return true;
			}
		}
		return false;
	}

	function changePassword($userid, $password) {
		$newPassword = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE users SET password = :password WHERE id = :id;";
		$stmt = $this->mysql->prepare($sql);
		$stmt->execute(array('id' => $userid, 'password' => $password));
	}
}

?>
