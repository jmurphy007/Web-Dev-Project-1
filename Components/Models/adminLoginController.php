<?php
	session_start();
	include ("../Models/database.php");
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	# Admin Username - tropicalByte
	# Admin Password - adminPass123
	
	$stmt1 = $db->prepare("SELECT password FROM admin WHERE username = :username");
	$stmt1->bindValue(":username", $username);
	$stmt1->execute();
	$result = $stmt1->fetchObject()->password;
	$stmt1->closeCursor();
	
	$verify = password_verify($password, $result); 
	
	if ($verify) {
		$_SESSION["error"] = False;
		header("Location: ../../Views/adminMain.php");
	} else {
		header("Location: ../../Views/adminlogin.php");
		$_SESSION["error"] = True;
	}
?>