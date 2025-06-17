<?php
session_start();
include 'koneksi.php';

// Ambil parameter pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil daftar order dan itemnya dengan filter pencarian
$query = "
    SELECT orders.id, orders.customer_name, orders.total_price, orders.order_date, 
           order_items.product_name, order_items.total_product, order_items.price 
    FROM orders
    JOIN order_items ON orders.id = order_items.order_id
    WHERE orders.customer_name LIKE ?
    ORDER BY orders.order_date DESC
";

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
    <title>Daftar Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-3">Daftar Pelanggan yang Melakukan Order</h2>
    
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Pelanggan" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
                <th>Tanggal Order</th>
                <th>Detail Item</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $current_order_id = null;
            while ($row = $result->fetch_assoc()) {
                if ($current_order_id !== $row['id']) {
                    if ($current_order_id !== null) {
                        echo "</ul></td></tr>";
                    }
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>Rp " . number_format($row['total_price'], 0, ',', '.') . "</td>
                            <td>{$row['order_date']}</td>
                            <td><ul>";
                    $current_order_id = $row['id'];
                }
                echo "<li>{$row['product_name']} ({$row['total_product']} x Rp " . number_format($row['price'], 0, ',', '.') . ")</li>";
            }
            if ($current_order_id !== null) {
                echo "</ul></td></tr>";
            }
            ?>
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
