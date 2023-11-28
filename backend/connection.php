<?php
    $server = "127.0.0.1";
	$user = "root";
	$pass = "";
	$db = "tesis";
	$connection = new mysqli($server, $user, $pass, $db);
	if ($connection->connect_error) {
		die("Error: " . $connection->connect_error);
	}
?>