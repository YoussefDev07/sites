<?php
  include_once "../master/connect.php";

  $id = $_GET["invoice_id"];
  switch ($_GET["period"]) {
    case "month_1":
      $period = 1;
      break;
    case "month_2":
      $period = 2;
      break;
    case "month_3":
      $period = 3;
      break;
    case "month_6":
      $period = 6;
      break;
    case "month_9":
      $period = 9;
      break;
    case "year_1":
      $period = 12;
      break;
  }

  if ($_GET["period"] == "forever") {
    $period = "0000-00-00";
  }
  else {
    $period = date("Y-m-d", time() + ((86400  * 30) * $period));
  }

  $connection -> exec("UPDATE invoices SET expire = '$period', expired = false WHERE id = $id");

  $site_id = $connection -> query("SELECT site_id FROM invoices WHERE id = $id") -> fetchAll(PDO::FETCH_COLUMN); $site_id = $site_id[0];
  $htaccess_contents = file_get_contents("../w/.htaccess");
  file_put_contents("../w/.htaccess", str_replace("Redirect 302 /$site_id file:///C:/xampp/htdocs/www/Space%20Sites%E2%84%A2/error/expired.htm", "", $htaccess_contents));
