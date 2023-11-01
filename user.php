<?php
require 'koneksi.php';

if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

	// Query SQL untuk memasukkan data ke dalam tabel user
	$sql = "INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')";

	if ($conn->query($sql) === TRUE) {
		// Data berhasil ditambahkan

		$conn->close();

		header('location: ?page=user');
	} else {
		// Jika terjadi kesalahan
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];

	if (isset($_POST['password'])) {
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

		// Query SQL untuk mengupdate data ke dalam tabel user
		$sql = "UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id=$id";
	} else {
		// Query SQL untuk mengupdate data ke dalam tabel user
		$sql = "UPDATE user SET nama='$nama', username='$username' WHERE id=$id";
	}

	if ($conn->query($sql) === TRUE) {
		// Data berhasil ditambahkan

		$conn->close();

		header('location: ?page=user');
	} else {
		// Jika terjadi kesalahan
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else if (isset($_GET['hapus'])) {
	$id = $_GET['hapus'];

	$sql = "DELETE FROM user WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		// Data berhasil dihapus

		$conn->close();

		header('location: ?page=user');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
}

// Query SQL untuk mengambil semua data user
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<div class="content">
	<div class="card-container">
		<?php if (isset($_GET['act'])) : ?>
			<?php if ($_GET['act']  == 'tambah') : ?>
				<div class="card">
					<h1>Tambah User</h1>
					<form action="?page=user" method="POST">
						<label for="nama">Nama</label><br>
						<input type="text" id="nama" name="nama" autocomplete="off" required><br>

						<label for="username">Username</label><br>
						<input type="text" id="username" name="username" autocomplete="off" required><br>

						<label for="password">Password:</label><br>
						<input type="password" id="password" name="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" required><br>

						<a href="?page=user" id="batalButton">Batal</a>
						<button type="submit" id="submitButton" name="simpan">Tambah</button>
					</form>
				</div>
			<?php elseif ($_GET['act']  == 'edit') : ?>
				<?php
				$id = $_GET['id'];

				$sql = "SELECT * FROM user WHERE id='$id'";
				$result = $conn->query($sql);
				?>

				<?php if ($result->num_rows > 0) : ?>
					<?php $row = $result->fetch_assoc(); ?>

					<div class="card">
						<h1>Edit User</h1>
						<form action="?page=user" method="POST">
							<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

							<label for="nama">Nama</label><br>
							<input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" autocomplete="off" required><br>

							<label for="username">Username</label><br>
							<input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" autocomplete="off" required><br>

							<label for="password">Password:</label><br>
							<input type="password" id="password" name="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');"><br>

							<a href="?page=user" id="batalButton">Batal</a>
							<button type="submit" id="submitButton" name="update">Edit</button>
						</form>
					</div>
				<?php else : ?>
					<div class="card">
						<h1>Data tidak ditemukan</h1>
					</div>
				<?php endif; ?>

			<?php endif; ?>
		<?php else : ?>
			<div class="card">
				<h1>Data User</h1>
				<a href="?page=user&act=tambah" class="add-button">Tambah User</a>
				<table>
					<tr>
						<th>No.</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Action</th>
					</tr>
					<?php $i = 1;
					if ($result->num_rows > 0) : ?>
						<?php while ($row = $result->fetch_assoc()) : ?>
							<tr>
								<td style="text-align: center;"><?php echo $i++; ?></td>
								<td><?php echo $row['nama']; ?></td>
								<td><?php echo $row['username']; ?></td>
								<td style="text-align: center;">
									<a href="?page=user&act=edit&id=<?php echo $row['id']; ?>" class="edit-button">Edit</a>
									<a href="?page=user&hapus=<?php echo $row['id']; ?>" class="delete-button" onclick="return confirm('Anda yakin data akan dihapus ?')">Hapus</a>
								</td>
							</tr>
						<?php endwhile; ?>
					<?php else : ?>
						<tr>
							<td colspan='4'>Tidak ada data user</td>
						</tr>";
					<?php endif; ?>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>