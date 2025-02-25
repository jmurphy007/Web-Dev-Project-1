<!DOCTYPE html>

<?php
	include ("../Components/Models/database.php");
	
	$confirmationNum = $_POST["confirmationNum"];
	
	$stmt1 = $db->prepare("SELECT * FROM reservations WHERE confirmationNum = :confirmationNum");
	$stmt1->bindValue(":confirmationNum", $confirmationNum);
	$stmt1->execute();
	$result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	$stmt1->closeCursor();
?>
<html>
	<head>
		<title>Tropical Byte Hotel - Check Your Reservations</title>
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
					<h1>Your Reservation</h1>
						<center>
							<?php
							if(!$result){
							?>
								<h2 style = "color:red">No reservations with this confirmation number at this time</h2>
							<?php 
							} else {
								foreach($result as $key=>$value){
								?>
									<table class="content">
										<tr class = "reservation reservationTop">
											<td>Room ID:</td>
											<td><?php echo $value['roomID'];?></td>
											<form action = "../Components/Models/deleteReservation.php" method = "POST">
												<input type = "hidden" id = "confirmationNum" name = "confirmationNum" value = "<?php echo $value['confirmationNum'];?>"/>
												<input type = "hidden" id = "user" name = "user" value = "customer"/>
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
								}
							}
							?>
					</center>
				</div>
			</li>
		</ul>
	</body>
</html>