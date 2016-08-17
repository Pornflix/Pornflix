<?php

class Session {
	private $mysql;
	private $key;

	function __construct($mysql, $key) {
		$this->mysql = $mysql;
		$this->key = $key;
	}

	function logon($formUsername, $formPassword) {
		$sql = "SELECT id, username, password FROM users WHERE username = :user LIMIT 1";

		$result = $this->mysql->prepare($sql);
		$result->execute(['user' => $formUsername]);

		if($row = $result->fetch()) {
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
			$user = $_SESSION['username'];

			$sql = "SELECT * FROM users WHERE username = :user LIMIT 1";
			$result = $this->mysql->prepare($sql);
			$result->execute(['user' => $user]);

			if($row = $result->fetch()) {
				return true;
			}
		} else if($this->authenticate()) {
			return true;
		}
		return false;
	}

	function changePassword($userid, $password) {
		$newPassword = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE users SET password = :password WHERE id = :id;";
		$stmt = $this->mysql->prepare($sql);
		$stmt->execute(array('id' => $userid, 'password' => $password));
	}

	function authenticate() {
		if(!isset($_COOKIE['rememberme']) || empty($_COOKIE['rememberme'])) {
			return false;
		}

		if(!$cookie = json_decode($_COOKIE['rememberme'], true)) {
			return false;
		}

		if(!(isset($cookie['user']) || isset($cookie['token']) || isset($cookie['mac']))) {
			return false;
		}

		$var = $cookie['user'] . $cookie['token'];

		if(!hash_equals(hash_hmac('sha256', $var, $this->key), $cookie['mac'])) {
			return false;
		}

		if(hash_equals($usertoken, $token)) {
			$_SESSION['user'] = $user;
		}
	}

	function remember() {
		
	}
}

?>
