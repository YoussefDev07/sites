<?php
  include_once "../master/connect.php";
  
  $today_date = date("Y-m-d");
  $expired_invoices = $connection -> query("SELECT id FROM invoices WHERE expire = '$today_date'") -> fetchAll(PDO::FETCH_COLUMN);

  foreach ($expired_invoices as $index => $id) {
    $connection -> exec("UPDATE invoices SET expired = true WHERE id = $id");
  }

  $expired_invoices = $connection -> query("SELECT site_id FROM invoices WHERE expire = '$today_date'") -> fetchAll(PDO::FETCH_COLUMN);

  foreach ($expired_invoices as $index => $site_id) {
    if (isset($site_id) && is_dir("../w/$site_id")) {
        $htaccess_contents = file_get_contents("../w/.htaccess");
        file_put_contents("../w/.htaccess", $htaccess_contents."\n"."Redirect 302 /$site_id file:///C:/xampp/htdocs/www/Space%20Sites%E2%84%A2/error/expired.htm");
    }
  }