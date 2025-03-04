<!DOCTYPE html>

<?php
	session_start()
?>
<html>
	<head>
		<title>Tropical Byte Hotel - Admin Login</title>
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
					<h1>Administrator Login</h1>
					<form action = "../Components/Models/adminLoginController.php" method = "POST">
						<center>
							<table class = "content">
								<tr>
									<td>
										<label for "username">Username</label>
									</td>
									<td>
										<input type = "text" class = "form-control" id = "username" name = "username" required />
									</td>
								</tr>
								<tr>
									<td>
										<label for "lName">Password</label>
									</td>
									<td>
										<input type = "password" class = "form-control" id = "password" name = "password" required />
									</td>
								</tr>
							</table>
							<button type = "submit" class = "submitBtn" value = "Login">Log In</button>
						</center>
					</form>
					<?php
						if (isset($_SESSION["error"])) {
							if ($_SESSION["error"]){
								?><br><p style= "color:red;">Invalid login, please try again</p><?php
								$_SESSION["error"] = False;
							} else {
								$_SESSION["error"] = False;
							}
						}
					?>
				</div>
			</li>
		</ul>
	</body>
</html>