<?php
	include ("database.php");
	
	if (!empty($_POST["roomID"])){
		$roomID = $_POST["roomID"];
		$deleteStmt = $db->prepare("DELETE FROM rooms WHERE roomID = :roomID");
		$deleteStmt->bindParam(':roomID', $roomID);
		$deleteStmt->execute();
		$deleteStmt->closeCursor();
		$_SESSION["roomError"] = False;
	} else {
		$_SESSION["roomError"] = True;
	}
	header("Location: ../../Views/adminMain.php");
?>