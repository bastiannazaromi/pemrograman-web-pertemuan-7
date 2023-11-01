<?php
session_start();

if (!isset($_SESSION['log_user'])) {
	header('location: login.php');
}

$user = $_SESSION['log_user'];

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'dashboard';
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Aplikasi CRUD Sederhana</title>
	<link rel="stylesheet" type="text/css" href="src/admin/style.css">
</head>

<body>
	<button class="toggle-button">☰</button>

	<div class="sidebar">
		<h2><a href=".">Hallo, <?php echo $user['data']['nama']; ?></a></h2>
		<nav class="menu">
			<hr>
			<a href="?page=user">Menu User</a>
			<a href="javascript:void(0)">Menu Lainnya</a>
			<!-- Tambahkan item menu lainnya -->

			<!-- Tombol Logout -->
			<a href="logout.php" class="logout">Logout</a>
		</nav>
	</div>

	<?php include($page . '.php'); ?>

	<div class="footer">
		&copy; <?= date('Y'); ?> CRUD Sederhana
	</div>

	<script src="src/admin/script.js"></script>
</body>

</html>