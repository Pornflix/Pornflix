<?php

class Session {
	private $mysql;
	private $key;

	function __construct($mysql, $key) {
		$this->mysql = $mysql;
		$this->key = $key;
	}

	function logon($formUsername, $formPassword, $rememberMe) {
		$sql = "SELECT id, username, password FROM users WHERE username = :user LIMIT 1";

		$result = $this->mysql->prepare($sql);
		$result->execute(['user' => $formUsername]);

		if($row = $result->fetch()) {
			$userid = $row['id'];
			$username = $row['username'];
			$password = $row['password'];

			if(password_verify($formPassword, $password)) {
				$_SESSION['user'] = $userid;

				if($rememberMe === "on") {
					$this->remember($userid);
				}
			}
		}

	}

	function logoff() {
		session_unset();
		session_destroy();

		if(isset($_COOKIE['rememberme'])) {
			$cookie = json_decode($_COOKIE['rememberme'], true);

			$sql =  "DELETE FROM user_sessions\n" .
					"WHERE reference = :ref";

			$result = $this->mysql->prepare($sql);
			$result->execute(['ref' => $cookie['ref']]);

			unset($_COOKIE['rememberme']);
			setcookie('rememberme', null, -1, '/');
		}
	}

	function authenticate() {
		if(isset($_SESSION['user'])) {
			$user = $_SESSION['user'];

			$sql = "SELECT id FROM users WHERE id = :id LIMIT 1";
			$result = $this->mysql->prepare($sql);
			$result->execute(['id' => $user]);

			if($row = $result->fetch()) {
				return true;
			}
		} else if($this->validateCookie()) {
			return true;
		}
		return false;
	}

	function validateCookie() {
		if(empty($_COOKIE['rememberme'])) {
			return false;
		}

		if(!$cookie = json_decode($_COOKIE['rememberme'], true)) {
			return false;
		}

		if(!(isset($cookie['ref']) || isset($cookie['token']) || isset($cookie['mac']))) {
			return false;
		}

		$var = $cookie['ref'] . $cookie['token'];

		if(!hash_equals(bin2hex(hash_hmac('sha256', $var, $this->key)), $cookie['mac'])) {
			return false;
		}

		$sql =  "SELECT user, token\n" .
				"FROM user_sessions\n" .
				"WHERE reference = :ref";

		$result = $this->mysql->prepare($sql);
		$result->execute(['ref' => $cookie['ref']]);

		if($row = $result->fetch()) {
			$userid = $row['user'];
			$token = $row['token'];
		}

		if(hash_equals($cookie['token'], $token)) {
			$_SESSION['user'] = $userid;
		}
	}

	function remember($user) {
        $cookie = [
                "ref" => bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)),
                "token" => bin2hex(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM)),
                "mac" => null
        ];

		$cookie['mac'] = bin2hex(hash_hmac('sha256', $cookie['ref'] . $cookie['token'], $this->key));
        $encoded = json_encode($cookie);

		$timestamp = strtotime("+7 day");
		$expiry = date("Y-m-d H:i:s", $timestamp);

		$sql =  "INSERT INTO user_sessions (user, reference, token, expiry)\n" .
				"VALUES (:user, :ref, :token, :expiry)";

		$result = $this->mysql->prepare($sql);
		$result->execute([
			'user' => $user,
			'ref' => $cookie['ref'],
			'token' => $cookie['token'],
			'expiry' => $expiry
		]);

        setcookie("rememberme", $encoded);
	}

	function signUp($user, $pass, $email) {
		$sql =  "SELECT id\n" .
				"FROM users\n" .
				"WHERE username = :user";

		$result = $this->mysql->prepare($sql);
		$result->execute(['user' => $user]);

		if($result->fetch()) {
			return false;
		}

		$passHash = password_hash($pass, PASSWORD_DEFAULT);
		$sql =  "INSERT INTO users (username, password, email)\n" .
				"VALUES (:user, :pass, :email)";

		$result = $this->mysql->prepare($sql);
		$result->execute(['user' => $user, 'pass' => $passHash, 'email' => $email]);
}


	function changePassword($userid, $password) {
		$newPassword = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE users SET password = :password WHERE id = :id";
		$result = $this->mysql->prepare($sql);
		$result->execute(array('id' => $userid, 'password' => $newPassword));
	}
}

?>
