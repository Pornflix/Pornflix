<?php

class Constants implements Configuration {
	static function getSFW() {
		return self::SFW;
	}

	static function getTestSite() {
        return self::TEST_SITE;
    }

	static function getMySQLUser() {
		return self::MYSQL_USER;
	}

	static function getMySQLPass() {
		return self::MYSQL_PASS;
	}

	static function getDBName() {
		if(!self::getSFW()) {
			return self::NSFW_DATABASE;
		} else {
			return self::SFW_DATABASE;
		}
	}
}

?>
