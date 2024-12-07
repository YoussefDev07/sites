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
   <meta name = "title" content = "إنـشـاء فـاتـورة"/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/Space%20Sites%e2%84%a2"/>
   <meta name = "twitter:title" content = "إنـشـاء فـاتـورة"/>
   <meta name = "twitter:image" content = "./assets/images/logo.png"/>
   <meta name = "twitter:image:alt" content = "logo"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "http://localhost/www/Space%20Sites%e2%84%a2/"/>
   <meta property = "og:site_name" content = "SPACE Sites™"/>
   <meta property = "og:title" content = "إنـشـاء فـاتـورة"/>
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
   <title>إنـشـاء فـاتـورة</title>
  <!--script-->
   <script src="./assets/libs/js/jquery.js"></script>
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
  <!--add-->
   <form class="add wow animate__zoomInUp" data-wow-duration="800ms" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <div>
     <input type="text" name="customer_id" maxlength="100" placeholder="معرف/رقم/ايميل العميل *" autocapitalize="off" autocomplete="off" required>
     <input type="text" name="site_id" maxlength="250" placeholder="معرف الموقع" autocapitalize="off" autocomplete="off">
     <select name="customer_id_app_link" required>
      <option selected disabled>منصة معرف العميل *</option>
      <option value="discord">ديسكورد</option>
     </select>
    </div>
    <div>
     <input type="number" name="price" min="0" step="0.01" placeholder="المبلغ *" autocomplete="off" required>
     <select name="currency" required>
      <option selected disabled>العملة *</option>
      <option value="credit">كريدت</option>
     </select>
     <select name="pay_method" required>
      <option selected disabled>طريقة الدفع *</option>
      <option value="probot">بروبوت</option>
     </select>
    </div>
    <div>
     <input type="number" name="discount" min="0" max="100" placeholder="الخصم *" autocomplete="off" required>
     <select name="expire" required>
      <option selected disabled>مدة إنتهاء الصلاحية *</option>
      <option value="month_1">شهر</option>
      <option value="month_2">شهرين</option>
      <option value="month_3">3 شهور</option>
      <option value="month_6">6 شهور</option>
      <option value="month_9">9 شهور</option>
      <option value="year_1">سنة</option>
      <option value="forever">للأبد</option>
     </select>
     <span>
      <input type="checkbox" name="buy_files">
      <label>شراء الملفات</label>
     </span>
    </div>
    <input type="submit" value="إنشاء الفاتورة">
   </form>
 </body>
</html>
<?php
 #add
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $customer_id = trim(strip_tags($_POST["customer_id"]));
  $site_id = (isset($_POST["site_id"])) ? trim(strip_tags($_POST["site_id"])):"";
  $price = trim(strip_tags($_POST["price"]));
  $currency = $_POST["currency"];
  $pay_method = $_POST["pay_method"];
  $discount = trim(strip_tags($_POST["discount"]));
  $buy_files = (isset($_POST["buy_files"])) ? true:false;

  switch ($_POST["customer_id_app_link"]) {
    case "discord":
      $customer_id_app_link = "https://discord.com/users/";
      break;
  }

  switch ($_POST["expire"]) {
    case "month_1":
      $expire = 1;
      break;
    case "month_2":
      $expire = 2;
      break;
    case "month_3":
      $expire = 3;
      break;
    case "month_6":
      $expire = 6;
      break;
    case "month_9":
      $expire = 9;
      break;
    case "year_1":
      $expire = 12;
      break;
  }

  if ($_POST["expire"] == "forever") {
    $expire = "0000-00-00";
  }
  else {
    $expire = date("Y-m-d", time() + ((86400  * 30) * $expire));
  }

  $stmt = $connection -> prepare("INSERT INTO invoices(customer_id, site_id, customer_id_app_link, price, currency, pay_method, discount, buy_files, expire, creator, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt -> execute([$customer_id, $site_id, $customer_id_app_link, $price, $currency, $pay_method, $discount, $buy_files, $expire, $_COOKIE["admin"], date("Y-m-d")]);
  script("Swal.fire({text:'تم إنشاء الفاتورة!', icon:'success', confirmButtonText:'عُلم', confirmButtonColor:'".COLOR."'}).then((result)=>{if (result.isConfirmed) {location.assign('./invoices.php')}})");
 }
?>