<?php

class RememberMe {
	private $key = null;
	private $mysql;

	function __construct($mysql, $key) {
		$this->mysql = $mysql;
		$this->key = $key;
	}

	public function authenticate() {
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

	public function remember() {
		
	}
}

?>
