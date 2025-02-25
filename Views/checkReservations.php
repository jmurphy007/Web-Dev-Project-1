<!DOCTYPE html>
<html>
	<head>
		<title>Tropical Byte Hotel - Check on Your Reservation</title>
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
					<h1>Enter your confirmation number to check on your reservation</h1>
					<form action = "../Views/reservationSearch.php" method = "POST">
						<center>
							<label for "confirmationNum">Confirmation Number</label>
							<input type = "text" class = "form-control" id = "confirmationNum" name = "confirmationNum" required>
							<button type = "submit" class = "submitBtn">Check Reservation</button>
						</center>
					</form>
				</div>
			</li>
		</ul>
	</body>
</html>