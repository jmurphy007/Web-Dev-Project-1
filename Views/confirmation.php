<!DOCTYPE html>

<?php
	include ("../Components/Models/database.php");
	session_start();
	
	if (isset($_SESSION["roomIDs"])){
		$selectedRoomIDs = $_SESSION["roomIDs"];
		$arrayAsString = implode(",", array_fill(0, count($selectedRoomIDs), "?"));
		
		$stmt = $db->prepare("SELECT r.* 
								FROM rooms r 
								WHERE r.roomID IN ($arrayAsString)
								");
		$stmt->execute($selectedRoomIDs);
		$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
	}
	$checkInDate = $_POST["checkInDate"];
	$checkOutDate = $_POST["checkOutDate"];
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$email = $_POST["email"];
	$numAdults = $_POST["numAdults"];
	$numChildren = $_POST["numChildren"];
?>
<html>
	<head>
		<title>Tropical Byte Hotel - Confirm Your Booking</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jordan Murphy & Farid Sawaqed" />
		<meta name="description" content="{insert description here}"/>
		<meta name="viewport" content="height= device-height, width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../Components/Styles/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<script src="../Components/Scripts/pageTemplates.js"></script>
		<ul>
			<li>
				<div class = "content">
					<h1>Confirm your booking</h1>
					<h3>Your Room Selection</h3>
					<center>
						<form action = "../Components/Models/addReservation.php" method = "POST">
							<table class="content">
								<thead>
									<tr>
										<th>Room ID</th>
										<th>Room Type</th>
										<th>Room Price Per night</th>
										<th>Room Capacity</th>
										<th>Total Cost</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($rooms as $room){
											$checkOut = new DateTime($checkOutDate);
											$checkIn = new DateTime($checkInDate);
											$cost = ((int)$room["roomPrice"]) * $checkOut->diff($checkIn)->format("%a");
									?>
									<tr>
										<td><?php echo $room["roomID"];?></td>
										<td><?php echo htmlspecialchars($room["roomType"]);?></td>
										<td>$<?php echo $room["roomPrice"];?></td>
										<td><?php echo $room["roomCapacity"];?></td>
										<td>$<?php echo $cost?></td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
							<table class="content">
								<thead>
									<tr>
										<th>Check In</th>
										<th>Check Out</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $checkInDate;?></td>
										<td><?php echo $checkOutDate;?></td>
									</tr>
								</tbody>
							</table>
							<table class = "content">
								<tr>
									<td>
										<label for "fName">First Name:</label>
									</td>
									<td>
										<label for "fName"><?php echo $fName;?></label>
									</td>
									<td>
										<label for "lName">Last Name:</label>
									</td>
									<td>
										<label for "lName"><?php echo $lName;?></label>
									</td>
								</tr>
								<tr>
									<td colspan = "1">
										<label for "email">Email:</label>
									</td>
									<td colspan = "3">
										<label for "email"><?php echo $email;?></label>
									</td>
									<td>
								</tr>
								<tr>
									<td>
										<label for "numAdults">Number of Adults:</label>
									</td>
									<td>
										<label for "numAdults"><?php echo $numAdults;?></label>
									</td>
									<td>
										<label for "numChildren">Number of Children:</label>
									</td>
									<td>
										<label for "numChildren"><?php echo $numChildren;?></label>
									</td>
								</tr>
							</table>
							<input type = "hidden" class = "form-control" id = "fName" name = "fName" value = "<?php echo $fName?>" />
							<input type = "hidden" class = "form-control" id = "lName" name = "lName" value = "<?php echo $lName?>" />
							<input type = "hidden" class = "form-control" id = "email" name = "email" value = "<?php echo $email?>" />
							<input type = "hidden" class = "form-control" id = "numAdults" name = "numAdults" value = "<?php echo $numAdults?>" />
							<input type = "hidden" class = "form-control" id = "numChildren" name = "numChildren" value = "<?php echo $numChildren?>" />
							<input type = "hidden" class = "form-control" id = "checkInDate" name = "checkInDate" value = "<?php echo $checkInDate?>" />
							<input type = "hidden" class = "form-control" id = "checkOutDate" name = "checkOutDate" value = "<?php echo $checkOutDate?>" />
							<button type = "submit" class = "submitBtn">Submit</button>
						</form>
						<form action = "home.php" method = "POST">
							<button type = "submit" class = "submitBtn">Cancel</button>
						</form>
					</center>
				</div>
			</li>
		</ul>
	</body>
</html>