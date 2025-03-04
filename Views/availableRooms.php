<!DOCTYPE html>

<?php
	include ("../Components/Models/database.php");
	session_start();
	
	$checkInDate = $_POST["checkInDate"];
	$checkOutDate = $_POST["checkOutDate"];
	
	if ($checkOutDate < $checkInDate){
		$_SESSION["dateError"] = "Check out must not be before check in.";
		header("Location: checkAvailability.php");
	} elseif ($checkInDate <= date('Y-m-d')){
		$_SESSION["dateError"] = "Check in must be tomorrow or later.";
		header("Location: checkAvailability.php");
	} else {
		$_SESSION["dateError"] = "";
		
		$stmt = $db->prepare("SELECT r.* 
								FROM rooms r 
								WHERE NOT EXISTS (
									SELECT 1 
										FROM reservations res 
										WHERE res.roomID = r.roomID 
										AND (
											(res.checkInDate BETWEEN :checkInDate AND :checkOutDate) OR
											(res.checkOutDate BETWEEN :checkInDate AND :checkOutDate) OR
											(:checkInDate BETWEEN res.checkInDate AND res.checkOutDate)
										)
									)
								");
		$stmt->bindParam(':checkInDate', $checkInDate);
		$stmt->bindParam(':checkOutDate', $checkOutDate);
		$stmt->execute();
		$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		}
?>

<html>
	<head>
		<title>Tropical Byte Hotel - Book Now!</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jordan Murphy & Farid Sawaqed" />
		<meta name="viewport" content="height= device-height, width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../Components/Styles/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<script src="../Components/Scripts/pageTemplates.js"></script>
		<ul>
			<li>
				<div class = "content">
					<h1>Available Rooms</h1>
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
							<?php 
							} else {
							?>
							<form action = "../Views/booking.php" method = "POST">
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
													<td><input type = "hidden" id = "roomID" name = "roomID" value = "<?php echo $value['roomID'];?>" /><?php echo $value['roomID'];?></td>
													<td><?php echo htmlspecialchars($value['roomType']);?></td>
													<td><?php echo $value['roomPrice'];?></td>
													<td><?php echo $value['roomCapacity'];?></td>
													<td><input type = "checkbox" name = "roomIDs[]" value = "<?php echo $value['roomID'];?>" /></td>
													
												</tr>
										<?php
											}
										}
										?>
									</tbody>
								</table>
								<input type = "hidden" class = "form-control" id = "checkInDate" name = "checkInDate" value = "<?php echo $checkInDate?>" />
								<input type = "hidden" class = "form-control" id = "checkOutDate" name = "checkOutDate" value = "<?php echo $checkOutDate?>" />
								<button type = "submit" class = "submitBtn" name = "Book">Book Now!</button>
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