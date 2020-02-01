<?php
	$serverName = "localhost:3306";
	$username = "root";
	$password = "";
	$dbName = "student-engagement-retention";
	
	try{
		$conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>