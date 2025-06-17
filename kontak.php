<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak - Andien's Cupcake Corner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

<!-- Form Kontak -->
<div class="container mt-5">
    <h2 class="text-center" style="color: #c43670;">Kontak Kami</h2>
    <div class="row">
        <div class="col-md-6">
            <h3>Hubungi Kami</h3>
            <p><strong>Alamat:</strong> Ruko Golf Island, Jl. Pulau Maju Bersama Jl. Pantai Indah Kapuk No.10 Blok i, DKI Jakarta 14470</p>
            <p><strong>Telepon:</strong> +62 0821-8200-1688</p>
            <p><strong>Email:</strong> andiensj123@gmail.com</p>
        </div>
        <div class="col-md-6">
            <h3>Kirim Pesan</h3>
            <form action="proseskontak.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Kirim</button>
            </form>
        </div>
    </div>
</div>

<div class="mt-4 text-center">
        <h1 class="text-center" style="color: #c43670;"><b><i>Lokasi Kami</i></b></h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d32499931.501919854!2d69.83544950000001!3d-6.093368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1db04eee74fd%3A0xa3f9329a8b4643f1!2sMad%20MILK%20Japanese%20Bakery!5e0!3m2!1sid!2sid!4v1741231272542!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen loading="lazy"></iframe>
      </div>
    </div>

    <footer style="background-color: #c43670; color: white; padding: 10px 0; font-family: Arial, sans-serif; font-size: 12px; text-align: center; width: 100%;">
      <div style="display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 900px; margin: auto; padding: 5px;">
          
          <div style="text-align: left; flex: 1; min-width: 150px; margin-bottom: 10px;">
              <h4 style="font-size: 14px; margin-bottom: 5px;">Products</h4>
              <ul style="list-style: none; padding: 0; margin: 0;">
                  <li><a href="../html/buah.html" style="color: white; text-decoration: none; font-size: 12px;">Fruit Cupcake</a></li>
                  <li><a href="../html/filling.html" style="color: white; text-decoration: none; font-size: 12px;">Filling Cupcake</a></li>
                  <li><a href="../html/paketan.html" style="color: white; text-decoration: none; font-size: 12px;">Bundling</a></li>
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
