<?php

	/* PDO DB connection configuration */

	$db_username = 'root';
	$db_password = '';

	$conn = new PDO( 'mysql:host=localhost;dbname=admission', $db_username, $db_password );

	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}

?>