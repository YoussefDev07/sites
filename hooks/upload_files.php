<?php
  #uploading
  if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
  <style>
   body {
     background-color: black;
   }
   /*uploading*/

   .uploading {
     margin-top: 100px;
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
   }

   .uploading h2 {
    margin-top: 25px;
    color: white
   }

   .lds-ring, .lds-ring div {
     box-sizing: border-box;
   }

   .lds-ring {
     display: inline-block;
     position: relative;
     width: 80px;
     height: 80px;
   }

   .lds-ring div {
     box-sizing: border-box;
     display: block;
     position: absolute;
     width: 64px;
     height: 64px;
     margin: 8px;
     border: 8px solid currentColor;
     border-radius: 50%;
     animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
     border-color: white transparent transparent transparent;
   }

   .lds-ring div:nth-child(1) {
     animation-delay: -0.45s
   }

   .lds-ring div:nth-child(2) {
     animation-delay: -0.3s
   }

   .lds-ring div:nth-child(3) {
     animation-delay: -0.15s
   }

   @keyframes lds-ring {
    0% {
     transform: rotate(0deg);
    }
    100% {
     transform: rotate(360deg);
    }
   }

   .uploading textarea {
     margin-top: 100px;
     width: 80vw;
     height: 40vh;
     resize: none;
     outline: none;
     background: none;
     border: none;
     font-size: 18px;
     color: white;
   }

  /*@media: uploading (mobile)*/

  @media (max-width:767px) {
    .uploading textarea {
     width: 90vw;
     height: 45vh;
     font-size: 15px;
    }
  }
  </style>
  <meta name = "viewport" content = "width=device-width, initial-scale=0.8"/>
  <meta name = "theme-color" content = "#000"/>
  <meta name = "color-scheme" content = "dark"/>
  <!--uploading-->
   <div class="uploading">
    <div class="lds-ring">
     <div></div>
     <div></div>
     <div></div>
     <div></div>
    </div>
    <h2 dir="rtl">جاري الرفع...</h2>
    <textarea readonly><?php 
      $files_names = $_FILES["files"]["name"];
      foreach ($files_names as $key => $value) {
        $size = $_FILES["files"]["size"][$key];
        $formated_size = ($size >= 1024) ? ($size/1024)."MB":$size."KB";

        if ($size >= 1048576) {
          $formated_size = round($size/1048576, 1)."MB";
        }
        elseif ($size >= 1024) {
          $formated_size = round($size/1024, 1)."KB";
        }
        else {
          $formated_size = $size."B";
        }

        echo $value."\t".$formated_size."\n";
      }

      if (array_sum($_FILES["files"]["size"]) >= 1048576) {
        $total_size = round(array_sum($_FILES["files"]["size"])/1048576, 1)."MB";
      }
      elseif (array_sum($_FILES["files"]["size"]) >= 1024) {
        $total_size = round(array_sum($_FILES["files"]["size"])/1024, 1)."KB";
      }
      else {
        $total_size = array_sum($_FILES["files"]["size"])."B";
      }

      echo "\n".count($_FILES["files"]["full_path"])." files ($total_size)";
     ?>
    </textarea>
   </div>
<?php endif; ?>
<?php
  include_once "../master/connect.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploaded_files = $_FILES["files"];
    $path = dirname(__DIR__, 1)."/w".$_POST["path"]."/";

    if (array_sum($_FILES["files"]["size"]) >= 20971520) {
      script("alert('حجم الملفات الكلي أكبر من 20 ميغابايت')");
    }
    else {
      for ($i=0;$i<count($uploaded_files["name"]);$i++) {
        if (!file_exists($path.$uploaded_files["name"][$i]) && move_uploaded_file($uploaded_files["tmp_name"][$i], $path.$uploaded_files["name"][$i])) {
          $connection -> prepare("INSERT INTO files(type, name, path) VALUES (?, ?, ?)") -> execute(["file", $uploaded_files["name"][$i], $_POST["path"]]);
        }
        else {
          script("alert('عذراّ، لا يمكن رفع ملف: ".$uploaded_files["name"][$i]."')");
        }
      }
    }

    script("location.assign('../files.php?path=".$_POST["path"]."')");
  }
  else {
    script("location.assign('../files.php");
  }