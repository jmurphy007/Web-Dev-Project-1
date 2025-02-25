<?php
	include ("database.php");
	
	if (!empty($_POST["roomID"])){
		$roomID = $_POST["roomID"];
		$roomType = $_POST["roomType"];
		$roomPrice = $_POST["roomPrice"];
		$roomCapacity = $_POST["roomCapacity"];
		$updateStmt = $db->prepare("UPDATE rooms 
				SET roomType = :roomType, roomPrice = :roomPrice, roomCapacity = :roomCapacity 
				WHERE roomID = :roomID");
		$updateStmt->bindParam(':roomID', $roomID);
		$updateStmt->bindParam(':roomType', $roomType);
		$updateStmt->bindParam(':roomPrice', $roomPrice);
		$updateStmt->bindParam(':roomCapacity', $roomCapacity);
		$updateStmt->execute();
		$updateStmt->closeCursor();
		$_SESSION["roomError"] = False;
	} else {
		$_SESSION["roomError"] = True;
	}
	header("Location: ../../Views/adminMain.php");
?>