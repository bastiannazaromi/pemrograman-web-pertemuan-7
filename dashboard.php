<?php
require 'koneksi.php'; // Sertakan file koneksi.php atau sesuaikan dengan nama file yang sesuai

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

?>

<div class="content">
	<div class="card-container">
		<!-- Card Total User -->
		<div class="card">
			<h2>Total User</h2>
			<p><?php echo $result->num_rows; ?></p>
		</div>
		<div class="card">
			<h2>Total Buku</h2>
			<p>100</p>
		</div>
	</div>
</div>