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

// Array daftar produk dengan topping buah
$products = [
    "Sweet Berry Whip" => ["price" => 22000, "image" => "Asset/unduhan (21).jpeg"],
    "Strawberry Choco Burst" => ["price" => 25000, "image" => "Asset/✰pinterest_ laurenchiangg.jpeg"],
    "Lychee Whip Bliss" => ["price" => 23000, "image" => "Asset/unduhan (20).jpeg"],
    "Matcha Strawberry" => ["price" => 21000, "image" => "Asset/Matcha Strawberry Cupcakes 1.png"],
    "Sweet Apple" => ["price" => 24000, "image" => "Asset/Yum 1.png"],
    "Fruit Tart Vanilla" => ["price" => 20000, "image" => "Asset/Fruit Tart Vanilla Cupcakes 1.png"],
    "Kiwi" => ["price" => 22000, "image" => "Asset/Kiwi Cupcakes 1.png"],
    "White Chocolate Blueberry" => ["price" => 26000, "image" => "Asset/White Chocolate Blueberry Cupcakes [90 Minutes] 1.png"],
    "Lemon Cupcake" => ["price" => 26000, "image" => "Asset/Lemon Curd Filled Cupcake with Lemon Buttercream Frosting — Under A Tin Roof 1.png"],
    "Chocolate Raspberry" => ["price" => 26000, "image" => "Asset/Chocolate Raspberry Cupcakes 1.png"],
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = trim($_POST['customer_name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $selected_products = $_POST['products'] ?? [];

    if (!empty($customer_name) && !empty($address) && !empty($selected_products)) {
        $total_price = 0;
        foreach ($selected_products as $product => $quantity) {
            if (!empty($products[$product]) && $quantity > 0) {
                $total_price += $quantity * $products[$product]['price'];
            }
        }

        if ($total_price > 0) {
            $sql = "INSERT INTO orders (customer_name, address, total_price, order_date) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssd", $customer_name, $address, $total_price);
            $stmt->execute();
            $order_id = $stmt->insert_id;
            $stmt->close();

            $sql_item = "INSERT INTO order_items (order_id, product_name, total_product, price, total_price) VALUES (?, ?, ?, ?, ?)";
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
        $message = "Mohon isi nama pelanggan, alamat, dan pilih minimal satu produk!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Cupcake Buah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg,rgb(223, 146, 178),rgb(235, 235, 235));
            text-align: center;
            padding: 20px;
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
            border: 2px solidrgb(216, 165, 186);
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .product:hover { transform: scale(1.05); }
        .product img {
            width: 80% ;
            border-radius: 8px;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
            font-size: 16px;
            padding: 5px;
            margin-top: 5px;
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
        .btn:hover { background:rgb(225, 136, 173); }

        .frmm {
            padding: 40px;
        }
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
    <h2> <b>Pesan Cupcake dengan Topping Buah Favoritmu!</b></h2>
    <form action="strukbuah.php" method="POST">
        <div class="form-group frmm">
            <label for="customer_name">Nama Pelanggan:</label><br>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>
                <div class="form-group frmm">
            <label for="customer_address">Alamat Pengiriman:</label><br>
            <input type="text" id="customer_address" name="customer_address" required>
        </div>
        <div class="product-list">
            <?php foreach ($products as $name => $details): ?>
             <div class="product">
                    <img src="<?php echo $details['image']; ?>" alt="<?php echo $name; ?>">
                    <h3><?php echo $name; ?></h3>
                    <p class="price">Rp <?php echo number_format($details['price'], 0, ',', '.'); ?></p>
                    <input type="number" name="products[<?php echo $name; ?>]" class="quantity-input" min="0" value="0">
                </div>
            <?php endforeach; ?>
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
