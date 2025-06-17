<?php
include 'koneksi.php'; // Pastikan file koneksi ini benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $products = $_POST['products'];

    // Periksa apakah ada produk yang dipesan
    $total_order_price = 0;
    $ordered_items = [];

    foreach ($products as $product_name => $quantity) {
        if ($quantity > 0) {
            // Harga tiap produk
            $product_prices = [
                "Kinder Bueno" => 20000,
                "Cricket" => 25000,
                "Chocolate Biscoff" => 22000,
                "Choco Cream" => 20000,
                "Oreo" => 25000,
                "Cute Bear Choco Vanilla" => 24000,
                "Choco Vanilla Cheri" => 20000,
                "Choco Ball" => 23000
            ];
            $price = $product_prices[$product_name];
            $total_price = $quantity * $price;

            // Tambahkan ke total harga pesanan
            $total_order_price += $total_price;

            // Simpan detail produk untuk dimasukkan ke order_items nanti
            $ordered_items[] = [
                'product_name' => $product_name,
                'total_product' => $quantity,
                'price' => $price,
                'total_price' => $total_price
            ];
        }
    }

    // Jika tidak ada produk yang dipesan, hentikan eksekusi
    if (empty($ordered_items)) {
        echo "Tidak ada produk yang dipilih.";
        exit;
    }

    // Simpan ke tabel `orders`
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, total_price) VALUES (?, ?)");
        if (!$stmt) {
            throw new Exception("Gagal menyiapkan statement: " . $conn->error);
        }
        $stmt->bind_param("si", $customer_name, $total_order_price);
        if (!$stmt->execute()) {
            throw new Exception("Gagal menyimpan pesanan: " . $stmt->error);
        }

        // Ambil ID pesanan yang baru dibuat
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Simpan ke tabel `order_items`
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, total_product, price, total_price) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Gagal menyiapkan statement order_items: " . $conn->error);
        }

        foreach ($ordered_items as $item) {
            $stmt->bind_param("isiii", $order_id, $item['product_name'], $item['total_product'], $item['price'], $item['total_price']);
            if (!$stmt->execute()) {
                throw new Exception("Gagal menyimpan item pesanan: " . $stmt->error);
            }
        }

        $stmt->close();
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
        }
        h2 {
            color: #333;
        }
        .order-info {
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #c43670;
            color: white;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            color: #c43670;
            text-align: right;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: white;
            background: #c43670;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background: #c43670;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Struk Pesanan</h2>
    <div class="order-info">
        <strong>Nama Pelanggan:</strong> <?= htmlspecialchars($customer_name) ?><br>
        <strong>Tanggal:</strong> <?= date("d M Y, H:i") ?>
    </div>

    <table>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
        <?php foreach ($ordered_items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['product_name']) ?></td>
            <td><?= $item['total_product'] ?></td>
            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($item['total_price'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="total">Total Pembayaran:</td>
            <td class="total">Rp <?= number_format($total_order_price, 0, ',', '.') ?></td>
        </tr>
    </table>

    <a href="http://localhost/auth/login/dashboard.php" class="button">Kembali ke Beranda</a>
</div>

</body>
</html>
