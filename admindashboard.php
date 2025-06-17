<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .zoom-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .zoom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
        .dashboard-title {
            color: #343a40;
            font-weight: bold;
        }
        .card-content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
        }
        .icon-img {
            width: 120px;
            height: auto;
        }
        .custom-btn {
            background-color: #c43670;
            color: white;
            border-radius: 8px;
            font-weight: bold;
        }
        .custom-btn:hover {
            background-color: #a82d5c;
        }
    </style>
</head>
<body class="container py-5">
    <h2 class="text-center dashboard-title mb-4">Admin Dashboard</h2>
    
    <div class="row justify-content-center g-4">
        <!-- Daftar Pengguna -->
        <div class="col-md-4 text-center">
            <a href="http://localhost/auth/login/daftaruser.php" class="text-decoration-none">
                <div class="card zoom-card">
                    <div class="card-content">
                        <img src="Asset/woman.png" alt="Users" class="icon-img">
                        <h5 class="mt-3" style="color: #c43670;">Daftar Pengguna</h5>
                        <p class="text-muted">Lihat semua user yang terdaftar</p>
                        <button class="btn custom-btn">Lihat</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Daftar Order -->
        <div class="col-md-4 text-center">
            <a href="http://localhost/auth/login/daftarorder.php" class="text-decoration-none">
                <div class="card zoom-card">
                    <div class="card-content">
                        <img src="Asset/checklist.png" alt="Orders" class="icon-img">
                        <h5 class="mt-3" style="color: #c43670;">Daftar Order</h5>
                        <p class="text-muted">Cek semua order yang masuk</p>
                        <button class="btn custom-btn">Lihat</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pesan dari User -->
        <div class="col-md-4 text-center">
            <a href="http://localhost/auth/login/admin.php" class="text-decoration-none">
                <div class="card zoom-card">
                    <div class="card-content">
                        <img src="Asset/comments.png" alt="Messages" class="icon-img">
                        <h5 class="mt-3" style="color: #c43670;">Pesan User</h5>
                        <p class="text-muted">Baca feedback dan pesan dari pengguna</p>
                        <button class="btn custom-btn">Lihat</button>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
