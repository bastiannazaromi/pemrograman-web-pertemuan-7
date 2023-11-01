<?php

session_start();

// Menghapus semua variabel session
unset($_SESSION);

// Mengakhiri sesi
session_destroy();

// Redirect atau lakukan tindakan lain setelah menghapus sesi
header("Location: login.php");
