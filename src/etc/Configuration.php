<?php

interface Configuration {
	const SFW = true;
	const TEST_SITE = true;

	const SFW_SITE_NAME = "Netflix";
	const NSFW_SITE_NAME = "Pornflix";

	const MYSQL_USER = "root";
	const MYSQL_PASS = "Shylah6525";
	const MYSQL_DOMAIN = "localhost";

	const SFW_DATABASE = "SFW";
	const NSFW_DATABASE = "Pornflix";

	const SFW_DATA_DIR = "data/SFW";
	const NSFW_DATA_DIR = "data/NSFW";

	const SFW_FEED_NAMES = ["All", "New", "Comedy"];
	const NSFW_FEED_NAMES = ["All", "Newest", "Anal"];

	const REMEMBER_ME_KEY = "awuieflakjshlfkja";

	const PREVIVEW_SIZE = 200;
}

?>
