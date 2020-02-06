<?php
	// These are the fields needed for setting up the external database connection.
	$serverName = "remotemysql.com:3306";
	$username = "3ISdS27gPP";
	$password = "dEnOlOyyio";
	$dbName = "3ISdS27gPP";
	
	// this should be moved to tests.
	try{
		$conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>