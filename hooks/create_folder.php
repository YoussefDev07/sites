<?php
  include_once "../master/connect.php";

  $folder_name = folder_name_filter($_GET["folder_name"]);
  $path = folder_name_filter($_GET["path"]);

  if (is_dir("../w$path/$folder_name")) {
    if ($path == "/") {
      echo "الموقع موجود مسبقاً";
    }
    else {
      echo "المجلد موجود مسبقاً";
    }
  }
  else {
    mkdir("../w$path/$folder_name");
    $stmt = $connection -> prepare("INSERT INTO files(type, name, path) VALUES (?, ?, ?)");
    $stmt -> execute(["folder", $folder_name, $path]);
    echo "done";
  }