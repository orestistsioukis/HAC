<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="img/logos/favicon.png">
	<title>High Altitude Climbing</title>
</head>

<body>
	<header>
		<a href="index.php" class="header-brand"><abbr title="High Altitude Climbing">HAC</abbr></a>
		<nav>

			<ul>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="trips.php">Trips</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
			<?php
				if (isset($_SESSION['userId'])) {
					echo '<form action="includes/logout.inc.php" method="POST">
							<button type="submit" name="logout-submit" class="logout-button">Logout</button>
						  </form>';
				}
				else {
					/* LOGIN FORM */
					echo '<button type="button" name="login" class="login-open-button" onclick="openLoginForm()">Login</button>
					<div class="login-form-popup" id="loginForm">
						<form action="includes/login.inc.php" method="POST" class="login-form-container">
							<h1>Login</h1>
							<label for="email">Email: </label>
							<input type="text" name="mailuid" placeholder="Username/E-mail..." required><br><br>
							<label for="pwd">Password: </label>
							<input type="password" name="pwd" placeholder="Enter password" required><br><br>
							<button type="submit" name="login-submit" class="login">Login</button>
							<button type="button" name="close" class="close" onclick="closeLoginForm()">Close</button>
							<label for="sign-up">Not signed up yet! Click:</label>
							<button class="signup-open-button" onclick="openSignUpForm()">Signup</button>
						</form>
					</div>';
				}
			?>
			<!-- SIGNUP FORM-->
			<div class="signup-form-popup" id="signUpForm">
				<form action="includes/signup.inc.php" method="POST" class="signup-form-container">
					<h1>Signup</h1>
					<?php
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "emptyfields") {
								echo '<p class="signuperror">Fill in all fields!</p>';
							}
							else if ($_GET['error'] == "invalidmailuid") {
								echo '<p class="signuperror">Invalid username and e-mail!</p>';
							}
							else if ($_GET['error'] == "invalidmail") {
								echo '<p class="signuperror">Invalid e-mail!</p>';
							}
							else if ($_GET['error'] == "invaliduid") {
								echo '<p class="signuperror">Invalid username!</p>';
							}
							else if ($_GET['error'] == "passwordcheck") {
								echo '<p class="signuperror">Your passwords don\'t match!</p>';
							}
							else if ($_GET['error'] == "usertaken") {
								echo '<p class="signuperror">Username is already taken!</p>';
							}
						}
						else if (@$_GET['signup'] == "success") {
							echo '<p class="signupsuccess">Signup successful!</p>';
						}
					?>
					<label for="username">Username: </label>
					<input type="text" name="uid" placeholder="Enter your username" ><br><br>
					<label for="email">Email: </label>
					<input type="text" name="mail" placeholder="Enter your email" ><br><br>
					<label for="pwd">Password: </label>
					<input type="password" name="pwd" placeholder="Enter your password" ><br><br>
					<label for="repeat-pwd">Repeat-Password: </label>
					<input type="password" name="pwd-repeat" placeholder="Enter your password again"
						><br><br>
					<button type="submit" name="signup-submit" class="sign-up">Signup</button>
					<button type="button" name="close" class="close" onclick="closeSignUpForm()">Close</button>
				</form>
			</div>
		</nav>
		<div id="msg">
			<?php
				if (isset($_SESSION['userId'])) {
					echo '<p class="msg-login">You are logged in!</p>';
				}
				else {
					echo '<p class="msg-logout">You are logged out!</p>';
				}
			?>
		</div>
	</header>