<?php

session_start();

if (isset($_SESSION['log_user'])) {
	header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>

	<link rel="stylesheet" type="text/css" href="src/login/style.css">
</head>

<body>
	<h2>Form Login</h2>
	<form action="prosesLogin.php" method="POST" id="loginForm">
		<label for="username">Username</label>
		<input type="text" id="username" name="username" required autocomplete="off"><br><br>

		<label for="password">Password</label>
		<input type="password" id="password" name="password" required autocomplete="false" readonly onfocus="this.removeAttribute('readonly');"><br><br>

		<button type="button" id="loginButton">Login</button>
	</form>

	<script src="src/login/script.js"></script>
</body>

</html>