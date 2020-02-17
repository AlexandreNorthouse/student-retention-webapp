<?php
	// These are the fields needed for setting up the external database connection.
	$serverName = "localhost:3306";
	$username = "root";
	$password = "";
	$dbName = "student_engagement_retention_local";
	
	// this should be moved to tests.
	try{
		$conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>