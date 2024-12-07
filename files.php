<?php
  if (empty($_COOKIE["admin"])) {
    header("location:");
  }

  if (empty($_GET["path"])) {
    header("location:?path=/");
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
   <meta name = "title" content = "الـمـلـفـات"/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/Space%20Sites%e2%84%a2"/>
   <meta name = "twitter:title" content = "الـمـلـفـات"/>
   <meta name = "twitter:image" content = "./assets/images/logo.png"/>
   <meta name = "twitter:image:alt" content = "logo"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "http://localhost/www/Space%20Sites%e2%84%a2/"/>
   <meta property = "og:site_name" content = "SPACE Sites™"/>
   <meta property = "og:title" content = "الـمـلـفـات"/>
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
   <title>الـمـلـفـات</title>
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
     <a href="./invoices.php"><button type="button">الفواتير</button></a>
     <span class="line"></span>
     <a href="./index.php"><button type="button">الصفحة الرئيسية</button></a>
    </div>
    <div class="devices wow animate__backInDown" data-wow-duration="800ms">
     <a href="./invoices.php"><button type="button"><i class="fas fa-receipt"></i></button></a>
     <span class="line"></span>
     <a href="./index.php"><button type="button"><i class="fas fa-home"></i></button></a>
    </div>
   </div>
  <!--head-->
   <div class="head"></div>
  <!--files-->
   <div dir="ltr" class="files">
    <!--upload-->
     <div class="upload wow animate__flipInY" data-wow-duration="800ms">
      <?php
        if ($_GET["path"] == "/") { $site_folder = "إنشاء موقع<i class='fas fa-plus-square'></i>"; }
        else { $site_folder = "إنشاء مجلد<i class='fas fa-folder-plus'></i>"; }
      ?>
      <span>
       <button id="createFolder" path="<?php echo $_GET["path"]; ?>" type="button"><?php echo $site_folder; ?></button>
       <?php if ($_GET["path"] != "/"): ?>
       <button id="uploadFile" path="<?php echo $_GET["path"]; ?>" type="button">رفع ملف<i class="fas fa-file-upload"></i></button>
       <?php endif; ?>
      </span>
     </div>
    <!--files-list-->
     <ul class="files-list">
      <li role="path" class="wow animate__lightSpeedInLeft" data-wow-duration="800ms" data-wow-offset="1"><?php echo $_GET["path"]; ?></li>
      <?php if ($_GET["path"] != "/"): ?>
      <li class="wow animate__lightSpeedInLeft" data-wow-duration="800ms" data-wow-offset="1" id="backFolder"><i class="fas fa-reply"></i>../</li>
      <?php endif; ?>
      <?php
       $folder_website_icon = ($_GET["path"] == "/") ? '<i class="fas fa-globe"></i>':'<i class="fas fa-folder"></i>';
       $folders = $connection -> query("SELECT * FROM files WHERE type = 'folder' AND path = '".$_GET["path"]."' ORDER BY name ASC");
       while ($folder = $folders -> fetch()):
      ?>
      <li class="wow animate__lightSpeedInLeft" data-wow-duration="800ms" data-wow-offset="1" role="folder" data-path="<?php echo $_GET["path"]; ?>" data-folder-name="<?php echo $folder["name"]; ?>"><?php echo $folder_website_icon; ?><?php echo $folder["name"]; ?><i class="fas fa-trash-alt delete" title="حذف المجلد/الموقع" data-path="<?php echo $_GET["path"]; ?>" data-name="<?php echo $folder["name"]; ?>" data-type="folder" style="color: #c70000;"></i></li>
      <?php endwhile; ?>
      <?php
       $files = $connection -> query("SELECT * FROM files WHERE type = 'file' AND path = '".$_GET["path"]."' ORDER BY name ASC");
       while ($file = $files -> fetch()):
      ?>
      <li class="wow animate__lightSpeedInLeft" data-wow-duration="800ms" data-wow-offset="1"><i class="fas fa-file"></i><?php echo $file["name"]; ?><i class="fas fa-trash-alt delete" title="حذف الملف" data-path="<?php echo $_GET["path"]; ?>" data-name="<?php echo $file["name"]; ?>" data-type="file" style="color: #c70000;"></i></li>
      <?php endwhile; ?>
     </ul>
   </div>
 </body>
</html>