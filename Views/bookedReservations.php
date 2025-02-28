<!DOCTYPE html>

<?php
	session_start()
?>

<html>
	<head>
		<title>Tropical Byte Hotel - Confirmed!</title>
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
					<h1>Your reservation is confirmed!</h1>
					<center>
						<p>Your confirmation number is <?php echo $_SESSION["confirmedNum"];?>, use this if you want to check on your reservation at anytime.</p>
						<form action = "home.php" method = "POST">
							<button type = "submit" class = "submitBtn">Home</button>
						</form>
					</center>
				</div>
			</li>
		</ul>
	</body>
</html>