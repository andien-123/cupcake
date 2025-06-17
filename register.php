<?php
include "koneksi.php"; // Hubungkan ke database

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Enkripsi password

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success text-center'>Registrasi berhasil! <a href='login.php'>Login</a></div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .custom-shadow {
            box-shadow: 0px 4px 10px #c43670;
        }
        body {
            background-image: url("Asset/Desktop - 2.png");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 custom-shadow" style="width: 500px; border: none; background-color:rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);">
        <h4 class="text-center mb-3" style="color: #c43670;">Register</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn w-100" style="background-color: #c43670; color: white;">Daftar</button>
            <div class="mt-3 text-center">
                <a href="login.php" class="d-block">Sudah punya akun? Login</a>
            </div>
        </form>
    </div>
</body>
</html>
