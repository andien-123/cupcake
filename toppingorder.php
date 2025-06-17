<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_auth";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";

// Array daftar produk
$products = [
    "Kinder Bueno" => ["price" => 20000, "image" => "assets/kinder-bueno.jpg"],
    "Cricket" => ["price" => 25000, "image" => "assets/cricket.jpg"],
    "Chocolate Biscoff" => ["price" => 22000, "image" => "assets/choco-biscoff.jpg"],
    "Choco Cream" => ["price" => 20000, "image" => "assets/choco-cream.jpg"],
    "Oreo" => ["price" => 25000, "image" => "assets/oreo.jpg"],
    "Cute Bear Choco Vanilla" => ["price" => 24000, "image" => "assets/cute-bear.jpg"],
    "Choco Vanilla Cheri" => ["price" => 20000, "image" => "assets/choco-vanilla-cheri.jpg"],
    "Choco Ball" => ["price" => 23000, "image" => "assets/choco-ball.jpg"]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = trim($_POST['customer_name'] ?? '');
    $selected_products = $_POST['products'] ?? [];

    if (!empty($customer_name) && !empty($selected_products)) {
        $total_price = 0;

        foreach ($selected_products as $product => $quantity) {
            if (!empty($products[$product]) && $quantity > 0) {
                $total_price += $quantity * $products[$product]['price'];
            }
        }

        if ($total_price > 0) {
            // Simpan pesanan ke tabel orders
            $sql = "INSERT INTO orders (customer_name, total_price, order_date) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sd", $customer_name, $total_price);
            $stmt->execute();
            $order_id = $stmt->insert_id;
            $stmt->close();

            // Simpan setiap produk ke tabel order_items
            $sql_item = "INSERT INTO order_items (order_id, product_name, total_product, price, total_price) 
                         VALUES (?, ?, ?, ?, ?)";
            $stmt_item = $conn->prepare($sql_item);

            foreach ($selected_products as $product => $quantity) {
                if (!empty($products[$product]) && $quantity > 0) {
                    $price_per_item = $products[$product]['price'];
                    $subtotal = $quantity * $price_per_item;

                    $stmt_item->bind_param("isidd", $order_id, $product, $quantity, $price_per_item, $subtotal);
                    $stmt_item->execute();
                }
            }
            $stmt_item->close();

            $message = "Pesanan berhasil! Total harga: Rp " . number_format($total_price, 0, ',', '.');
        } else {
            $message = "Mohon pilih minimal satu produk!";
        }
    } else {
        $message = "Mohon isi nama pelanggan dan pilih minimal satu produk!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Cupcake</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fbd9e5, #ff99c8);
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #c43670;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }
        .product {
            width: 200px;
            background: white;
            border: 2px solid #c43670;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .product:hover { transform: scale(1.05); }
        .product img {
            width: 100%;
            border-radius: 8px;
        }
        .product h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        .product .price {
            font-weight: bold;
            color: #c43670;
            font-size: 16px;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
            font-size: 16px;
            padding: 5px;
            margin-top: 5px;
        }
        .form-group {
            margin: 20px 0;
        }
        input[type="text"] {
            width: 60%;
            padding: 12px;
            border: 2px solid #c43670;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
        }
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 18px;
            background: #c43670;
            color: white;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .btn:hover { background: #a82c5e; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #fbd9e5;">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: #c43670;" href="#"><b>Andien's Cupcake Corner</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto" style="margin: 5px; gap: 5rem;">
                    <li class="nav-item"><a class="nav-link active" style="color: #c43670;" href="http://localhost/auth/login/dashboard.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: #c43670;" href="../html/about.html">About</a></li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" style="color: #c43670;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori</a>
                      <ul class="dropdown-menu" >
                        <li><a class="dropdown-item" style="color: #c43670;" href="../html/buah.html">Buah</a></li>
                        <li><a class="dropdown-item" style="color: #c43670;" href="../html/filling.html">Topping</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" style="color: #c43670;" href="../html/paketan.html">Paketan</a></li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" style="color: #c43670;" href="http://localhost/auth/login/kontak.php">Kontak</a></li>
                </ul>
            </div>
        </div>
</nav>
<div style="height: 70px;"></div> 
    <h2>Pesan Cupcake dengan Topping Favoritmu!</h2>
    <form action="struktopping.php" method="POST">
        <div class="form-group">
            <label for="customer_name">Nama Pelanggan:</label><br>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>
        <div class="product-list">
        <div class="product">
                <img src="Asset/Kinder bueno cupcakes.jpeg" alt="Kinder Bueno Cupcake">
                <h3>Kinder Bueno</h3>
                <p class="price">Rp 20.000</p>
                <input type="number" name="products[Kinder Bueno]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/Cricket Cake - Afternoon Crumbs 1.png" alt="Cricket Cupcake">
                <h3>Cricket</h3>
                <p class="price">Rp 25.000</p>
                <input type="number" name="products[Cricket]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/Chocolate Biscoff Cupcakes 1.png" alt="Chocolate Biscoff">
                <h3>Chocolate Biscoff</h3>
                <p class="price">Rp 22.000</p>
                <input type="number" name="products[Chocolate Biscoff]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/Chocolate cake 1.png" alt="Choco Cream">
                <h3>Choco Cream</h3>
                <p class="price">Rp 20.000</p>
                <input type="number" name="products[Choco Cream]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/ᴄᴜᴘᴄᴀᴋᴇ 1.png" alt="Oreo">
                <h3>Oreo</h3>
                <p class="price">Rp 25.000</p>
                <input type="number" name="products[Oreo]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/unduhan (28) 1.png" alt="Cute Bear Choco Vanilla">
                <h3>Cute Bear Choco Vanilla</h3>
                <p class="price">Rp 24.000</p>
                <input type="number" name="products[Cute Bear Choco Vanilla]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/unduhan (27) 1.png" alt="Choco Vanilla Cheri">
                <h3>Choco Vanilla Cheri</h3>
                <p class="price">Rp 20.000</p>
                <input type="number" name="products[Choco Vanilla Cheri]" class="quantity-input" min="0" value="0">
            </div>
            <div class="product">
                <img src="Asset/unduhan (24) 1.png" alt="Choco Ball">
                <h3>Choco Ball</h3>
                <p class="price">Rp 23.000</p>
                <input type="number" name="products[Choco Ball]" class="quantity-input" min="0" value="0">
            </div>
        </div>
        <button type="submit" class="btn">Pesan Sekarang</button>
    </form>

    <div style="height: 30px;"></div>

    <footer style="background-color: #c43670; color: white; padding: 10px 0; font-family: Arial, sans-serif; font-size: 12px; text-align: center; width: 100%;">
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 900px; margin: auto; padding: 5px;">
        
        <div style="text-align: left; flex: 1; min-width: 150px; margin-bottom: 10px;">
            <h4 style="font-size: 14px; margin-bottom: 5px;">Products</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li><a href="../html/buah.html" style="color: white; text-decoration: none; font-size: 12px;">Fruit Cupcake</a></li>
                <li><a href="#" style="color: white; text-decoration: none; font-size: 12px;">Filling Cupcake</a></li>
                <li><a href="#" style="color: white; text-decoration: none; font-size: 12px;">Bundling</a></li>
            </ul>
        </div>

        <div style="text-align: left; flex: 1.5; min-width: 200px; margin-bottom: 10px;">
            <h4 style="font-size: 14px; margin-bottom: 5px;">Contact</h4>
            <p style="margin: 3px 0; font-size: 12px;">Andien's Cupcake Corner</p>
            <p style="margin: 3px 0; font-size: 12px;">Palembang, Indonesia</p>
            <p style="margin: 3px 0; font-size: 12px;">Call: <a href="tel:+6282182001688" style="color: white; text-decoration: none;">0821-8200-1688</a></p>
            <p style="margin: 3px 0; font-size: 12px;">Email: <a href="mailto:andiensj123@gmail.com" style="color: white; text-decoration: none;">hello@andienscupcake.com</a></p>
        </div>

        <div style="text-align: left; flex: 1; min-width: 150px; margin-bottom: 10px;">
            <h4 style="font-size: 14px; margin-bottom: 5px;">Follow Us</h4>
            <a href="https://www.instagram.com/016.8mm" style="color: white; text-decoration: none; margin-right: 8px; font-size: 14px;">
                <i class="fab fa-instagram"><img src="Asset/instagram_1419647.png" style="width: 20px;"></i>
            </a>
            <a href="https://wa.me/6282182001688" style="color: white; text-decoration: none; margin-right: 8px; font-size: 14px;">
                <i class="fab fa-whatsapp"><img src="Asset/whatsapp_1419661.png" style="width: 20px;"></i>
            </a>
            <a href="#" style="color: white; text-decoration: none; margin-right: 8px; font-size: 14px;">
                <i class="fab fa-facebook"><img src="Asset/facebook_1419644.png" style="width: 20px;"></i>
            </a>
        </div>
    </div>

    <div style="margin-top: 5px; font-size: 10px; background-color: #b32d5e; padding: 5px 0;">
        © 2025 Andien's Cupcake Corner | All Rights Reserved
    </div>
</footer>
</body>
</html>
