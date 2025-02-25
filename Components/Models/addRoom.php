<?php
	include ("database.php");
	
	if (!empty($_POST["roomID"])){
		$roomID = $_POST["roomID"];
		$roomType = $_POST["roomType"];
		$roomPrice = $_POST["roomPrice"];
		$roomCapacity = $_POST["roomCapacity"];
		$addStmt = $db->prepare("INSERT INTO rooms(roomID, roomType, roomPrice, roomCapacity)VALUES(:roomID,:roomType,:roomPrice, :roomCapacity)");
		$addStmt->bindParam(':roomID', $roomID);
		$addStmt->bindParam(':roomType', $roomType);
		$addStmt->bindParam(':roomPrice', $roomPrice);
		$addStmt->bindParam(':roomCapacity', $roomCapacity);
		$addStmt->execute();
		$addStmt->closeCursor();
		$_SESSION["roomError"] = False;
	} else {
		$_SESSION["roomError"] = True;
	}
	header("Location: ../../Views/adminMain.php");
?>