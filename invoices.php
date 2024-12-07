<?php
  if (empty($_COOKIE["admin"])) {
    header("location:");
  }
  
  include_once "./master/connect.php";
?>
<html lang="ar" dir="rtl" type="text/html">
 <head>
  <!--meta-->
   <meta charset = "utf-8"/>
   <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
   <meta name = "theme-color" content = "#000000"/>
   <meta name = "color-scheme" content = "dark"/>
   <meta name = "author" content = "Youssef Dev"/>
   <meta name = "owner" content = "Youssef Over, AmerGAME"/>
   <meta name = "copyright" content = "Space©"/>
   <meta name = "google" content = "notranslate"/>
   <meta name = "robots" content = "none"/>
   <meta name = "title" content = "الـفـواتـيـر"/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/Space%20Sites%e2%84%a2"/>
   <meta name = "twitter:title" content = "الـفـواتـيـر"/>
   <meta name = "twitter:image" content = "./assets/images/logo.png"/>
   <meta name = "twitter:image:alt" content = "logo"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "http://localhost/www/Space%20Sites%e2%84%a2/"/>
   <meta property = "og:site_name" content = "SPACE Sites™"/>
   <meta property = "og:title" content = "الـفـواتـيـر"/>
   <meta property = "og:image" content = "./assets/images/logo.png"/>
   <meta property = "og:image:alt" content = "logo"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <!--link-->
   <link rel="canonical" href="/"/>
   <link rel="icon" type="image/png" href="./assets/images/logo.png"/>
   <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/>
   <link rel="stylesheet" media="all" href="./assets/libs/css/fontawesome.css"/>
   <link rel="stylesheet" href="./assets/libs/css/animate.css"/>
   <link rel="stylesheet" href="./assets/libs/css/sweetalert2.css"/>
  <!--title-->
   <title>الـفـواتـيـر</title>
  <!--script-->
   <script src="./assets/libs/js/jquery.js"></script>
   <script src="./assets/libs/js/axios.js"></script>
   <script src="./assets/libs/js/wow.js"></script>
   <script src="./assets/libs/js/sweetalert2.js"></script>
   <script type="application/javascript" src="./assets/js/script.js" async></script>
   <noscript>Please Enable JAVASCRIPT to Run The Site...</noscript>
 </head>
 <body>
  <!--header-->
   <div class="header">
    <div class="wow animate__backInUp" data-wow-duration="800ms">
     <img src="./assets/images/logo.png" alt="logo">
     <h1>SPACE Sites™</h1>
    </div>
    <div class="orignal wow animate__backInDown" data-wow-duration="800ms">
     <a href="./files.php"><button type="button">الملفات</button></a>
     <span class="line"></span>
     <a href="./index.php"><button type="button">الصفحة الرئيسية</button></a>
    </div>
    <div class="devices wow animate__backInDown" data-wow-duration="800ms">
     <a href="./files.php"><button type="button"><i class="fas fa-file"></i></button></a>
     <span class="line"></span>
     <a href="./index.php"><button type="button"><i class="fas fa-home"></i></button></a>
    </div>
   </div>
  <!--head-->
   <div class="head"></div>
  <!--search-->
   <form class="search wow animate__flipInX" data-wow-duration="800ms" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <button type="submit" title="إجراء البحث"><i class="fas fa-search fa-rotate-90"></i></button>
    <input type="text" name="customer_id" id="searchInput" placeholder="البحث باستخدام معرف العميل..." autocomplete="off" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo (isset($_POST["customer_id"])) ? trim($_POST["customer_id"]):trim($_POST["site_id"]); } ?>" required>
    <button type="button" id="searchSwitch" title="تبديل وضع البحث"><i class="fas fa-retweet fa-spin"></i></button>
    <a href="./add_invoice.php" title="إضافة فاتورة"><i class="fas fa-plus"></i></a>
   </form>
  <?php require "./includes/expired-invoices.php"; ?>
  <!--hr-->
   <span class="hr">
    <hr class="wow animate__zoomIn" data-wow-duration="800ms">
   </span>
  <?php require "./includes/invoices.php"; ?>
 </body>
</html>