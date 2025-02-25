<!DOCTYPE html>

<?php
	include ("../Components/Models/database.php");
	session_start();
	
	if (isset($_POST["roomIDs"])){
		$selectedRoomIDs = $_POST["roomIDs"];
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
?>
<html>
	<head>
		<title>Tropical Byte Hotel - Book Now!</title>
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
					<h1>Book your vacation today!</h1>
					<h3>Your Room Selection</h3>
					<form action = "" method = "POST">
						<center>
							<table class="content">
								<thead>
									<tr>
										<th>Room ID</th>
										<th>Room Type</th>
										<th>Room Price</th>
										<th>Room Capacity</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($rooms as $room){
									?>
									<tr>
										<td><?php echo $room["roomID"];?></td>
										<td><?php echo htmlspecialchars($room["roomType"]);?></td>
										<td>$<?php echo $room["roomPrice"];?></td>
										<td><?php echo $room["roomCapacity"];?></td>
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
										<input type = "text" class = "form-control" id = "fName" name = "fName" required />
									</td>
									<td>
										<label for "lName">Last Name:</label>
									</td>
									<td>
										<input type = "text" class = "form-control" id = "lName" name = "lName" required />
									</td>
								</tr>
								<tr>
									<td>
										<label for "numAdults">Number of Adults:</label>
									</td>
									<td>
										<input type = "number" class = "form-control" id = "numAdults" name = "numAdults" required />
									</td>
									<td>
										<label for "numChildren">Number of Children:</label>
									</td>
									<td>
										<input type = "number" class = "form-control" id = "numChildren" name = "numChildren" required />
									</td>
								</tr>
								<tr>
									<td>
										<label for "numRooms">Number of Rooms:</label>
									</td>
									<td>
										<input type = "number" class = "form-control" id = "numRooms" name = "numRooms" required />
									</td>
								</tr>
							</table>
							<button type = "submit" class = "submitBtn">Book Now!</button>
						</center>
					</form>
				</div>
			</li>
		</ul>
	</body>
</html>