<?php
	include ("database.php");
	
	if (!empty($_POST["confirmationNum"])){
		$confirmationNum = $_POST["confirmationNum"];
		$deleteStmt = $db->prepare("DELETE FROM reservations WHERE confirmationNum = :confirmationNum");
		$deleteStmt->bindParam(':confirmationNum', $confirmationNum);
		$deleteStmt->execute();
		$deleteStmt->closeCursor();
		$_SESSION["reservationError"] = False;
	} else {
		$_SESSION["reservationError"] = True;
	}
	
	if ($_POST["user"] == "admin"){
		header("Location: ../../Views/adminMain.php");
	} else {
		header("Location: ../../Views/home.php");
	}
?>