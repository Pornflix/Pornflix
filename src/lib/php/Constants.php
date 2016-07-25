<?php

class Constants implements Configuration {
	static function getSFW() {
		return self::SFW;
	}

	static function getTestSite() {
        return self::TEST_SITE;
    }

	static function getSiteName() {
		if(!self::getSFW()) {
			return self::NSFW_SITE_NAME;
		} else {
			return self::SFW_SITE_NAME;
		}
	}

	static function getMySQLUser() {
		return self::MYSQL_USER;
	}

	static function getMySQLPass() {
		return self::MYSQL_PASS;
	}

	static function getMySQLDomain() {
		return self::MYSQL_DOMAIN;
	}

	static function getDBName() {
		if(!self::getSFW()) {
			return self::NSFW_DATABASE;
		} else {
			return self::SFW_DATABASE;
		}
	}

	static function getDataDir() {
		if(!self::getSFW()) {
			return self::NSFW_DATA_DIR;
		} else {
			return self::SFW_DATA_DIR;
		}
	}

	static function getFeedNames() {
		if(!self::getSFW()) {
			return self::NSFW_FEED_NAMES;
		} else {
			return self::SFW_FEED_NAMES;
		}
	}
}

?>
