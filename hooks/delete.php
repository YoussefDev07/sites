<?php
  include_once "../master/connect.php";

  $type = $_GET["type"];
  $name = $_GET["name"];
  $db_path = $_GET["path"];
  $path = dirname(__DIR__)."/w$db_path/$name";

  if ($type == "folder") {
    if (!is_dir($path)) {
      if ($_GET["path"] == "/") {
        echo "الموقع غير موجود";
      }
      else {
        echo "المجلد غير موجود";
      }
    }
    else {
      if (rmdir($path)) {
        $connection -> exec("DELETE FROM files WHERE type = 'folder' AND name = '$name' AND path = '$db_path'");
        echo "deleted";
      }
      else {
        echo "يجب حذف الملفات الداخلية أولاً";
      }
    }
  }
  elseif ($type == "file") {
    if (!file_exists($path)) {
      echo "الملف غير موجود";
    }
    else {
      if (unlink($path)) {
        $connection -> exec("DELETE FROM files WHERE type = 'file' AND name = '$name' AND path = '$db_path'");
        echo "deleted";
      }
    }
  }