<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Cek apakah password benar
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];

            // Cek apakah user adalah admin
            if ($row['username'] === 'admin') {
                header("Location: admindashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        }
    }

    // Jika gagal login
    echo "<div class='alert alert-danger text-center'>Username atau password salah!</div>";

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
        <h4 class="text-center mb-3" style="color: #c43670;">Login</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <button type="submit" name="login" class="btn" style="border-color: #c43670; color:#c43670; text-align: center;"><b>LOGIN</b></button>
            </div>
            </div>
            <div class="mt-3 text-center">
                <a href="http://localhost/auth/login/register.php" class="d-block">New around here? Sign up</a>
                <a href="#" class="d-block">Forgot password?</a>
            </div>
        </form>
    </div>
</body>
</html>
