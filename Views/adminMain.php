<!DOCTYPE html>

<?php
	session_start();
	include ("../Components/Models/database.php");
	
	$stmt1 = $db->prepare("SELECT * FROM reservations");
	$stmt1->execute();
	$result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	$stmt1->closeCursor();
	
	$stmt2 = $db->prepare("SELECT * FROM rooms");
	$stmt2->execute();
	$rooms = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	$stmt2->closeCursor();
	
	$stmt3 = $db->prepare("SELECT MAX(roomID) as roomID FROM rooms");
	$stmt3->execute();
	$result2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
	$stmt3->closeCursor();
	
	foreach ($result2 as $key=>$value){
		$maxNum = $value["roomID"];
	}
	
	$maxNum = $maxNum + 1;
?>
<html>
	<head>
		<title>Tropical Byte Hotel - Admin Page</title>
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
			<li class = "contentli">
				<div class = "content">
					<h1>Rooms</h1>
					<center>
						<?php
							if (!$_SESSION["roomError"]){
								if ($_SESSION["roomError"]){
								?>
									<h2 style = "color:red">Error with room database, please try again</h2>
								<?php
									$_SESSION["roomError"] = False;
								} else {
									$_SESSION["roomError"] = False;
								}
							}
						
							if(!$rooms){
							?>
								<h2 style = "color:red">No rooms at this time</h2>
								<table>
									<tr>
										<form action = "../Components/Models/addRoom.php" method = "POST">
											<td><input type = "hidden" id = "roomID" name = "roomID" value = "<?php echo $maxNum;?>" required /><?php echo $maxNum;?></td>
											<td><input type = "text" class = "form-control" id = "roomType" name = "roomType" required /></td>
											<td><input type = "number" class = "form-control" id = "roomPrice" name = "roomPrice" required /></td>
											<td><input type = "number" class = "form-control" id = "roomCapacity" name = "roomCapacity" required /></td>
											<td colspan = "2"><button type = "submit" class = "submitBtn" name = "ADD" style = "width: 80%; font-size: 45px">&#43;</button></td>
										</form>
									</tr>
								</tbody>
							</table>
							<?php 
							} else {
							?>
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
										foreach($rooms as $key=>$value){
									?>
										<tr>
											<form action = "../Components/Models/updateRoom.php" method = "POST">
												<td><input type = "hidden" id = "roomID" name = "roomID" value = "<?php echo $value['roomID'];?>" /><?php echo $value['roomID'];?></td>
												<td><input type = "text" class = "form-control" id = "roomType" name = "roomType" value = "<?php echo htmlspecialchars($value['roomType']);?>" required /></td>
												<td><input type = "number" class = "form-control" id = "roomPrice" name = "roomPrice" value = "<?php echo $value['roomPrice'];?>" required /></td>
												<td><input type = "number" class = "form-control" id = "roomCapacity" name = "roomCapacity" value = "<?php echo $value['roomCapacity'];?>" required /></td>
												<td><button type = "submit" class = "submitBtn" name = "UPDATE" style = "font-size: 45px">&#8635;</button></td>
											</form>
											<form action = "../Components/Models/deleteRoom.php" method = "POST">
												<input type = "hidden" id = "roomID" name = "roomID" value = <?php echo $value['roomID'];?>/>
												<td><button type = "submit" class = "submitBtn" name = "DELETE" style = "font-size: 45px">&#128465;</button></td>
											</form>
										</tr>
									<?php
										}
									}
									?>
									<tr>
										<form action = "../Components/Models/addRoom.php" method = "POST">
											<td><input type = "hidden" id = "roomID" name = "roomID" value = "<?php echo $maxNum;?>"/><?php echo $maxNum;?></td>
											<td><input type = "text" class = "form-control" id = "roomType" name = "roomType" required /></td>
											<td><input type = "number" class = "form-control" id = "roomPrice" name = "roomPrice" required /></td>
											<td><input type = "number" class = "form-control" id = "roomCapacity" name = "roomCapacity" required /></td>
											<td colspan = "2"><button type = "submit" class = "submitBtn" name = "ADD" style = "width: 80%; font-size: 45px" >&#43;</button></td>
										</form>
									</tr>
								</tbody>
							</table>
					</center>
				</div>
			</li>
			<li class = "contentli">
				<div class = "content">
					<h1>Reservations</h1>
					<center>
						<?php
						if(!$result){
						?>
							<h2 style = "color:red">No reservations at this time</h2>
						<?php 
						} else {
							$i = 1;
							foreach($result as $key=>$value){
								?>
								<h2>Reservation <?php echo $i;?></h2>
								<table class="content">
										<tr class = "reservation reservationTop">
											<td>Room ID:</td>
											<td><?php echo $value['roomID'];?></td>
											<form action = "../Components/Models/deleteReservation.php" method = "POST">
												<input type = "hidden" id = "confirmationNum" name = "confirmationNum" value = "<?php echo $value['confirmationNum'];?>"/>
												<input type = "hidden" id = "user" name = "user" value = "admin"/>
												<td rowspan = "11" style = "width: 5%"><button type = "submit" class = "submitBtn" name = "DELETE" style = "font-size: 45px">&#128465;</button></td>
											</form>
										</tr>
										<tr class = "reservation">
											<td>First Name:</td>
											<td><?php echo $value['fName'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Last Name:</td>
											<td><?php echo $value['lName'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Email:</td>
											<td><?php echo $value['email'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Number of Adults:</td>
											<td><?php echo $value['numAdults'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Number of Children:</td>
											<td><?php echo $value['numChildren'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Number of Rooms:</td>
											<td><?php echo $value['numRooms'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Check In Date:</td>
											<td><?php echo $value['checkInDate'];?></td>
										</tr>
										<tr class = "reservation">
											<td>Check Out Date:</td>
											<td><?php echo $value['checkOutdate'];?></td>
										</tr>
										<tr class = "reservation reservationBottom">
											<td>Total Cost:</td>
											<td>$<?php echo $value['cost'];?></td>
										</tr>
								</table>
								
									<?php
									$i = $i + 1;
									}
								}
								?>
					</center>
				</div>
			</li>
		</ul>
	</body>
</html>