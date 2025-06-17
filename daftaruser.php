<?php
session_start();
include 'koneksi.php';

// Ambil parameter pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil daftar user dengan filter pencarian
$query = "SELECT id, username, email, created_at FROM users WHERE username LIKE ? ORDER BY created_at DESC";

$stmt = $conn->prepare($query);
$search_param = "%$search%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Daftar Pengguna Terdaftar</h2>
    
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Username" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a href="hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="http://localhost/auth/login/admindashboard.php" class="btn btn-danger">Beranda</a>
    </div>
</body>
</html>

<?php 
$stmt->close();
$conn->close();
?>
