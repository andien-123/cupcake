<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "db_auth"; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil parameter pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan pencarian
$sql = "SELECT * FROM contact_messages WHERE name LIKE ? OR email LIKE ? OR message LIKE ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$search_param = "%$search%";
$stmt->bind_param("sss", $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pesan Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Pesan dari Pelanggan</h2>
        
        <form method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama, Email, atau Pesan" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Belum ada pesan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <a href="http://localhost/auth/login/admindashboard.php" class="btn btn-danger">Beranda</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
