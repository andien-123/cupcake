<?php
session_start();
include 'koneksi.php';

// Pastikan ID user dikirim melalui URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cek apakah user yang sedang login mencoba menghapus dirinya sendiri
    if ($_SESSION['username'] == "admin") { 
        $query = $conn->prepare("DELETE FROM users WHERE id = ?");
        $query->bind_param("i", $id);

        if ($query->execute()) {
            echo "<script>alert('User berhasil dihapus!'); window.location='daftaruser.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus user!'); window.location='daftaruser.php';</script>";
        }
    } else {
        echo "<script>alert('Anda tidak memiliki izin untuk menghapus user ini!'); window.location='daftaruser.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='daftaruser.php';</script>";
}

$conn->close();
?>
