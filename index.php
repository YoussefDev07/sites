<?php
  if (isset($_GET["admin"])) {
    setcookie("admin", $_GET["admin"], time() + ((86400  * 30) * 12));
  }

  if (empty($_COOKIE["admin"])) {
    header("location:");
  }
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
   <meta name = "title" content = "SPACE Sites™"/>
   <meta name = "description" content = "انشئ موقعك الخاص بواسطة خدمة سايتس!! هدايا عند الشراء وخصومات وعروض مستمرة."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/Space%20Sites%e2%84%a2"/>
   <meta name = "twitter:title" content = "SPACE Sites™"/>
   <meta name = "twitter:description" content = "انشئ موقعك الخاص بواسطة خدمة سايتس!! هدايا عند الشراء وخصومات وعروض مستمرة."/>
   <meta name = "twitter:image" content = "./assets/images/logo.png"/>
   <meta name = "twitter:image:alt" content = "logo"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "http://localhost/www/Space%20Sites%e2%84%a2/"/>
   <meta property = "og:title" content = "SPACE Sites™"/>
   <meta property = "og:description" content = "انشئ موقعك الخاص بواسطة خدمة سايتس!! هدايا عند الشراء وخصومات وعروض مستمرة."/>
   <meta property = "og:image" content = "./assets/images/logo.png"/>
   <meta property = "og:image:alt" content = "logo"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <!--link-->
   <link rel="canonical" href="/"/>
   <link rel="icon" type="image/png" href="./assets/images/logo.png"/>
   <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/>
   <link rel="stylesheet" media="all" href="./assets/libs/css/fontawesome.css"/>
   <link rel="stylesheet" href="./assets/libs/css/animate.css"/>
  <!--title-->
   <title>SPACE Sites™</title>
  <!--script-->
   <script src="./assets/libs/js/jquery.js"></script>
   <script src="./assets/libs/js/wow.js"></script>
   <script type="application/javascript" src="./assets/js/script.js" async></script>
   <noscript>Please Enable JAVASCRIPT to Run The Site...</noscript>
 </head>
 <body>
  <!--directions-->
   <div class="directions">
    <!--header-->
     <div class="header">
      <div class="wow animate__backInUp" data-wow-duration="800ms">
       <img src="./assets/images/logo.png" alt="logo">
       <h1>SPACE Sites™</h1>
      </div>
     </div>
    <button type="button" id="files" class="wow animate__lightSpeedInLeft" data-wow-duration="800ms"><i class="fas fa-file"></i>الملفات</button>
    <span class="theline wow animate__zoomIn" data-wow-duration="800ms"></span>
    <button type="button" id="invoices" class="wow animate__lightSpeedInRight" data-wow-duration="800ms"><i class="fas fa-receipt"></i>الفواتير</button>
   </div>
 </body>
</html>