<?php
include 'koneksi.php'; // Pastikan file koneksi ini benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address']; // Mendapatkan alamat dari input
    $products = $_POST['products'];

    $total_order_price = 0;
    $ordered_items = [];

    foreach ($products as $product_name => $quantity) {
        if ($quantity > 0) {
            $product_prices = [
                "Sweet Berry Whip" => 22000,
                "Strawberry Choco Burst" => 25000,
                "Lychee Whip Bliss" => 23000,
                "Matcha Strawberry" => 21000,
                "Sweet Apple" => 24000,
                "Fruit Tart Vanilla" => 20000,
                "Kiwi" => 22000,
                "White Chocolate Blueberry" => 26000,
                "Lemon Cupcake" => 26000,
                "Chocolate Raspberry" => 26000
            ];
            $price = $product_prices[$product_name];
            $total_price = $quantity * $price;

            $total_order_price += $total_price;
            $ordered_items[] = [
                'product_name' => $product_name,
                'total_product' => $quantity,
                'price' => $price,
                'total_price' => $total_price
            ];
        }
    }

    if (empty($ordered_items)) {
        echo "Tidak ada produk yang dipilih.";
        exit;
    }

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, total_price, address) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $customer_name, $total_order_price, $customer_address);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, total_product, price, total_price) VALUES (?, ?, ?, ?, ?)");

        foreach ($ordered_items as $item) {
            $stmt->bind_param("isiii", $order_id, $item['product_name'], $item['total_product'], $item['price'], $item['total_price']);
            $stmt->execute();
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
    <title>Struk Pesanan Buah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
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
            color: #c43670;
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
            background: #ffffff;
            color: #c43670;
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
            background: #a82b5a;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Struk Pesanan - Cupcake Buah</h2>
    <div class="order-info">
        <strong>Nama Pelanggan:</strong> <?= htmlspecialchars($customer_name) ?><br>
        <strong>Alamat Pengiriman:</strong> <?= htmlspecialchars($customer_address) ?><br>
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
