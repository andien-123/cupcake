<?php
// Koneksi ke database
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database
$password = ""; // Sesuaikan dengan password database
$dbname = "db_auth"; // Sesuaikan dengan nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Simpan ke database
$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='kontak.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
