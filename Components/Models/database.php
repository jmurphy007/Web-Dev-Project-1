<?php
	$dsn = "mysql:host=localhost;dbname=tropical byte hotel";
	$dbUsername = "root";
	$dbPassword = "";
	
	try {
		$db = new PDO($dsn, $dbUsername, $dbPassword);
	} catch (PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>An error has occured while connecting: $error_message </p>";
	}
?>