<?php

	/* MySQLI DB connection configuration */

	$connection = mysqli_connect("localhost","root","", "admission");

	if(!$connection){
		die("Database not selected.");

	}
?>