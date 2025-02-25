<?php
	session_start();
	include ("../Models/database.php");
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$stmt1 = $db->prepare("SELECT password FROM admin WHERE username = :username");
	$stmt1->bindValue(":username", $username);
	$stmt1->execute();
	$result = $stmt1->fetchObject()->password;
	$stmt1->closeCursor();
	
	if ($result == $password) {
		$_SESSION["error"] = False;
		header("Location: ../../Views/adminMain.php");
	} else {
		header("Location: ../../Views/adminlogin.php");
		$_SESSION["error"] = True;
	}
?>