<?php
session_start(); // Memulai sesi
session_destroy(); // Menghapus semua session
header("Location: login.php"); // Redirect ke halaman login
exit;
?>
