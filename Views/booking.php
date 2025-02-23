<!DOCTYPE html>
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
					<form action = "../Components/Scripts/reservationController.php" method = "POST">
						<center>
							<table class = "content">
								<tr>
									<td>
										<label for "fName">First Name:</label>
									</td>
									<td>
										<input type = "text" class = "form-control" id = "fName" name = "fName" required>
									</td>
									<td>
										<label for "lName">Last Name:</label>
									</td>
									<td>
										<input type = "text" class = "form-control" id = "lName" name = "lName" required>
									</td>
								</tr>
								<tr>
									<td>
										<label for "numAdults">Number of Adults:</label>
									</td>
									<td>
										<input type = "number" class = "form-control" id = "numAdults" name = "numAdults" required>
									</td>
									<td>
										<label for "numChildren">Number of Children:</label>
									</td>
									<td>
										<input type = "number" class = "form-control" id = "numChildren" name = "numChildren" required>
									</td>
								</tr>
								<tr>
									<td>
										<label for "numRooms">Number of Rooms:</label>
									</td>
									<td>
										<input type = "number" class = "form-control" id = "numRooms" name = "numRooms" required>
									</td>
								</tr>
								<tr>
									<td>
										<label for "checkInDate">Check In:</label>
									</td>
									<td>
										<input type = "date" class = "form-control" id = "checkInDate" name = "checkInDate" required>
									</td>
									<td>
										<label for "checkOutDate">Check Out:</label>
									</td>
									<td>
										<input type = "date" class = "form-control" id = "checkOutDate" name = "checkOutDate" required>
									</td>
								</tr>
							</table>
							<button type = "submit" class = "submitBtn">Check Room Availability</button>
						</center>
					</form>
				</div>
			</li>
		</ul>
	</body>
</html>