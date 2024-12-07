<?php
  include_once "../master/connect.php";

  $id = $_GET["id"];
  $connection -> exec("UPDATE invoices SET hide = true WHERE id = $id");