<?php
require 'koneksi.php';
session_start();

// Memeriksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Mengambil nilai username dan password dari data POST
	$username = $_POST["username"];
	$password = $_POST["password"];

	// Mengecek username di database
	$query = "SELECT * FROM user WHERE username = '$username'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		$user = $result->fetch_assoc();

		if (password_verify($password, $user['password'])) {
			// Autentikasi berhasil

			$_SESSION['log_user'] = [
				'is_loged_in' => true,
				'data' => $user
			];

			header("Location: index.php");
		} else {
			// Autentikasi gagal
			echo "Autentikasi gagal. Silakan periksa kembali password Anda.";
		}
	} else {
		echo "Autentikasi gagal. Silakan periksa kembali username Anda.";
	}
} else {
	// Jika tidak ada data POST, mungkin halaman ini diakses secara langsung tanpa pengiriman form
	header("Location: login.php");
}
