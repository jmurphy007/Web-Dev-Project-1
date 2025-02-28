<?php
	include ("database.php");
	session_start();
	
	function getRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';

		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}

		return $string;
	}
	
	if (isset($_SESSION["roomIDs"])){
		$checkInDate = $_POST["checkInDate"];
		$checkOutDate = $_POST["checkOutDate"];
		$fName = $_POST["fName"];
		$lName = $_POST["lName"];
		$email = $_POST["email"];
		$numAdults = $_POST["numAdults"];
		$numChildren = $_POST["numChildren"];
		$selectedRoomIDs = $_SESSION["roomIDs"];
		$arrayAsString = implode(",", array_fill(0, count($selectedRoomIDs), "?"));
		while(True){
			$confirmationNum = getRandomString();
			
			$stmt1 = $db->prepare("SELECT * FROM reservations WHERE confirmationNum = :confirmationNum");
			$stmt1->bindValue(":confirmationNum", $confirmationNum);
			$stmt1->execute();
			$result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			$stmt1->closeCursor();
			
			if (!$result){
				break;
			}
		}
		foreach($selectedRoomIDs as $roomID){
			$stmt2 = $db->prepare("SELECT roomPrice FROM rooms WHERE roomID = :roomID");
			$stmt2->bindValue(":roomID", $roomID);
			$stmt2->execute();
			$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
			$stmt2->closeCursor();
			$checkOut = new DateTime($checkOutDate);
			$checkIn = new DateTime($checkInDate);
			$cost = ((int)$result2["roomPrice"]) * $checkOut->diff($checkIn)->format("%a");
			
			$addStmt = $db->prepare("INSERT INTO reservations(roomID, fName, lName, email, numAdults, numChildren, checkInDate, checkOutDate, cost, confirmationNum)
										VALUES(:roomID,:fName, :lName, :email, :numAdults, :numChildren, :checkInDate, :checkOutDate, :cost, :confirmationNum)");
			$addStmt->bindParam(':roomID', $roomID);
			$addStmt->bindParam(':fName', $fName);
			$addStmt->bindParam(':lName', $lName);
			$addStmt->bindParam(':email', $email);
			$addStmt->bindParam(':numAdults', $numAdults);
			$addStmt->bindParam(':numChildren', $numChildren);
			$addStmt->bindParam(':checkInDate', $checkInDate);
			$addStmt->bindParam(':checkOutDate', $checkOutDate);
			$addStmt->bindParam(':cost', $cost);
			$addStmt->bindParam(':confirmationNum', $confirmationNum);
			$addStmt->execute();
			$addStmt->closeCursor();
			
			$_SESSION["confirmedNum"] = $confirmationNum;
			header("Location: ../../Views/bookedReservations.php");
		}
		$_SESSION["dateError"] = False;
	} else {
		$_SESSION["dateError"] = "There was an error booking your reservation, please try again.";
		header("Location: ../../Views/checkAvailability.php");
	}
?>