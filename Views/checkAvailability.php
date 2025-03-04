<!DOCTYPE html>

<?php
	session_start()
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
					<h1>Book your vacation today!</h1>
					<?php
						if (isset($_SESSION["dateError"]) and $_SESSION["dateError"] != ""){
							?>
								<p style = "color:red"><?php echo $_SESSION["dateError"];?></p>
							<?php
						}
					?>
					<center>
						<form action = "../Views/availableRooms.php" method = "POST">
							<table class = "content">
								<tr>
									<td>
										<label for "checkInDate">Check In:</label>
									</td>
									<td>
										<input type = "date" class = "form-control" id = "checkInDate" name = "checkInDate" required />
									</td>
									<td>
										<label for "checkOutDate">Check Out:</label>
									</td>
									<td>
										<input type = "date" class = "form-control" id = "checkOutDate" name = "checkOutDate" required />
									</td>
								</tr>
							</table>
							<button type = "submit" class = "submitBtn">Check Room Availability</button>
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