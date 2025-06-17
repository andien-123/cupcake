<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
      .navbar-nav .nav-link {
        transition: all 0.1s ease-in-out;
      }
      
      .navbar-nav .nav-link:hover {
        color: black !important;
        transform: scale(1.1);
      }
      
      .zoom-card {
        transition: all 0.3s ease-in-out;
      }
      
      .zoom-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 8px 20px #c43670;
      }
      
      .promo-content, .info-content {
        display: none;
        position: absolute;
        background: rgba(255, 255, 255, 0.9);
        padding: 10px;
        border-radius: 10px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
      }
    
    </style>
  </head>
  <body class="">
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
                <span class="navbar-text me-3" style="color:#c43670;">Welcome, <b><?php echo $username; ?></b>!</span>
                <a href="../html/cupcake.html" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
    </nav>
    <div style="height: 65px;"></div>
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators" >
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Asset/Frame 22 (1).png" class="d-block w-100" alt="..." height="" >
        </div>
        <div class="carousel-item">
          <img src="Asset/Frame 23.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="Asset/Frame 24.png" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="card text-center" style="background-color: #fbd9e5;">
      <div class="card-header">
        <b>WELCOME</b>
      </div>
      <div class="card-body" style="background-color: white;">
        <h5 class="card-title">Selamat Datang, <b style="color:#c43670"><?php  echo $username; ?>!</b></h5>
        <p class="card-text">Terima kasih sudah berkunjung ke Andien's Cupcake Corner. Nikmati berbagai pilihan cupcake lezat kami!</p>
      </div>  
    </div>


    <div class="m-10" style="margin: 10px; padding: 10px; display:flex; gap:3rem; justify-content:center">
    <div class="card mb-3 zoom-card" style="max-width: 560px; ">
      <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
          <img src="Asset/unduhan (20).jpeg" style="padding: 7px;" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><b>Lychee Whip Bliss</b></h5>
            <p class="card-text">Nikmati kelembutan sponge cake yang dipadukan dengan leci segar dan topping whipped cream yang fluffy. Sensasi manis yang bikin jatuh cinta!</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3 zoom-card" style="max-width: 560px; ">
      <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
          <img src="Asset/✰pinterest_ laurenchiangg.jpeg" style="padding: 7px;" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><b>Strawberry Choco Burst</b></h5>
            <p class="card-text">Cupcake coklat yang lembut dengan isian coklat lumer, disempurnakan dengan stroberi utuh yang segar di atasnya. Manis, segar, dan meleleh di mulut!</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 5 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
   
  <div class="m-10" style="margin: 10px; padding: 10px; display:flex; gap:3rem; justify-content:center">
    <div class="card mb-3 zoom-card" style="max-width: 560px; ">
      <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
          <img src="Asset/Kinder bueno cupcakes.jpeg" style="padding: 7px;" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><b>KitKat Choco Bliss</b></h5>
            <p class="card-text">Cupcake coklat yang lembut, dihiasi krim coklat yang creamy dan potongan KitKat renyah. Sensasi lembut dan crunchy dalam satu gigitan!</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 11 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3 zoom-card" style="max-width: 560px; ">
      <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
          <img src="Asset/unduhan (21).jpeg" style="padding: 7px;" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><b>Sweet Berry Whip</b></h5>
            <p class="card-text">Kelezatan buttercream lembut yang manis, dihiasi stroberi segar dan taburan gula halus. Perpaduan sempurna antara creamy, fresh, dan sweet!</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 10 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>

      <div class="container text-center mt-5 " style="padding-bottom: 35px;">
        <h2 style="color: #c43670; font-weight: bold;">MADE FOR YOU</h2>
        <h4 style="font-style: italic; color: #000;">{ With Love }</h4>
        <p style="max-width: 600px; margin: 10px auto; color: #555;">
            Kami menghadirkan cupcake spesial dengan layanan terbaik untuk Anda. Nikmati diskon menarik, paket eksklusif, dan pengiriman cepat hanya di Andien's Cupcake Corner!
        </p>
        
        <div class="row mt-4 justify-content-center">
            <div class="col-md-3 text-center">
                <div class="card promo-card zoom-card" style="background-color: #ffffff; border-radius: 10px; padding: 20px;">
                    <div>
                        <img src="Asset/unduhan (22) 1.png" alt="Delivery" style="width: 140px;">
                    </div>
                    <h5 style="color: #c43670; margin-top: 10px;">Delivery</h5>
                    <p>Hanya 30 menit</p>
                    <button class="btn" style="background-color: #c43670; color: white; border-radius: 5px;">Read More</button>
                </div>
            </div>
    
            <div class="col-md-3 text-center">
                <div class="card promo-card zoom-card" style="background-color: #ffffff; border-radius: 10px; padding: 20px;">
                    <div>
                        <img src="Asset/♡︎!  𝑐𝑢𝑝𝑐𝑎𝑘𝑒 1.png" alt="Package" style="width: 140px;">
                    </div>
                    <h5 style="color: #c43670; margin-top: 10px;">Package</h5>
                    <p>Gratis untuk pesanan tertentu</p>
                    <button class="btn" style="background-color: #c43670; color: white; border-radius: 5px;">Read More</button>
                </div>
            </div>
    
            <div class="col-md-3 text-center">
                <div class="card promo-card zoom-card" style="background-color: #ffffff; border-radius: 10px; padding: 20px;">
                    <div>
                        <img src="Asset/i l u v e 1.png" alt="Discount" style="width: 140px;">
                    </div>
                    <h5 style="color: #c43670; margin-top: 10px;">Discount 15%</h5>
                    <p>Promo pembukaan spesial</p>
                    <button class="btn" style="background-color: #c43670; color: white; border-radius: 5px;">Read More</button>
                </div>
            </div>
        </div>
    </div>
    
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