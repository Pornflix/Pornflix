<?php

interface Configuration {
	const SFW = false;
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
}

?>
