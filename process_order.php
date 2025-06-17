<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_auth";

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Harga tetap (Rp 20.000 per cupcake)
$price_per_item = 20000;

// Proses form saat tombol ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $product_name = $_POST['product_name'];
    $total_product = $_POST['total_product'];
    $total_price = $total_product * $price_per_item; // Menghitung total harga
    $order_date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO orders (customer_name, product_name, total_product, price, total_price, order_date) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiisi", $customer_name, $product_name, $total_product, $price_per_item, $total_price, $order_date);

    if ($stmt->execute()) {
        $message = "Pesanan berhasil disimpan! Total harga: Rp " . number_format($total_price, 0, ',', '.');
    } else {
        $message = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Cupcake</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8e8ee;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 900px;
            background: #fff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .image-container {
            width: 40%;
            background: #fbd9e5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .product-image {
            width: 100%;
            max-width: 250px;
            height: auto;
            border-radius: 15px;
        }

        .product-info {
            width: 60%;
            padding: 30px;
        }

        .category {
            font-weight: bold;
            color: #c43670;
            font-size: 14px;
            text-transform: uppercase;
        }

        .product-name {
            font-size: 28px;
            font-weight: bold;
            margin-top: 5px;
        }

        .price {
            background: #c43670;
            color: white;
            padding: 6px 15px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            display: inline-block;
            margin: 10px 0;
        }

        .description {
            font-size: 15px;
            color: #555;
            margin-top: 10px;
            line-height: 1.5;
        }

        .order-form {
            margin-top: 20px;
        }

        .order-form label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }

        .order-form input {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 2px solid #c43670;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }

        .btn {
            width: 100%;
            max-width: 200px;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;

        }

        .btn-buy {
            background: #c43670;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Bagian Gambar -->
    <div class="image-container">
        <img src="Asset/Kinder bueno cupcakes.jpeg" alt="Cupcake Kinder Bueno" class="product-image">
    </div>

    <!-- Bagian Informasi -->
    <div class="product-info">
        <h2 class="category">TOPPING</h2>
        <h1 class="product-name">Kinder Bueno</h1>
        <p class="price">Rp. 20.000,-</p>
        <p class="description">
            Rasakan kelembutan cupcake coklat premium dengan topping krim lembut yang dipadukan dengan Kinder Bueno. 
            Dibuat dari bahan berkualitas tinggi, cupcake ini memberikan sensasi manis yang sempurna di setiap gigitan. 
            Cocok untuk hadiah, acara spesial, atau sekadar memanjakan diri!
        </p>

        <!-- Form Pemesanan -->
        <form action="" method="POST" class="order-form">
            <label for="customer_name">Nama Pelanggan:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="product_name">Nama Produk:</label>
            <input type="text" id="product_name" name="product_name" value="Kinder Bueno Cupcake" readonly>

            <label for="total_product">Jumlah:</label>
            <input type="number" id="total_product" name="total_product" min="1" required>

            <button type="submit" class="btn btn-buy">Pesan Sekarang</button>
        </form>

        <!-- Tampilkan pesan sukses atau error -->
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
    </div>
</div>

</body>
</html>
