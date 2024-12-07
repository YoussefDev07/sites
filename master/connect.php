<?php
  define("COLOR", "#00186d");
  date_default_timezone_set("Asia/Riyadh");
  $connection = new PDO("mysql:host=localhost;dbname=sites", "root", "");

  function script($script) {
    print("<script>");
    echo $script;
    print("</script>");
  }

  function folder_name_filter($folder_name) {
    return trim(strip_tags(str_replace("`", "", str_replace("\"", "", str_replace("'", "", str_replace(":", "", str_replace(" ", "", str_replace("\\", "", str_replace("|", "", str_replace("?", "", str_replace("*", "", str_replace("<", "", str_replace(">", "", $folder_name)))))))))))));
  }