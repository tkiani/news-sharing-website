<?php
// Content of database.php

$mysqli = new mysqli('localhost', 'site_user', 'site_pass', 'site');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>
