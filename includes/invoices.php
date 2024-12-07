<!--invoices-->
 <div class="invoices">
  <?php
   #invoices
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST["customer_id"])) {
       $customer_id = trim($_POST["customer_id"]);
       $query = "SELECT * FROM invoices WHERE customer_id = '$customer_id'";
     }
     else if (isset($_POST["site_id"])) {
       $site_id = trim($_POST["site_id"]);
       $query = "SELECT * FROM invoices WHERE site_id = '$site_id'";
     }
   }
   else {
     $query = "SELECT * FROM invoices ORDER BY id DESC";
   }

   $invoices = $connection -> query($query);
   while($invoice = $invoices -> fetch()):
  ?>
  <table class="wow animate__slideInUp" data-wow-duration="800ms" data-wow-offset="1">
   <caption>فاتورة #<?php echo $invoice["id"]; ?> (<?php echo str_replace("-", "/", $invoice["date"]); ?>)
    <pre>منشئ الفاتورة: <?php echo $invoice["creator"]; ?></pre>
   </caption>
   <tr>
    <th>معرف/رقم/ايميل العميل</th>
    <th>معرف الموقع</th>
    <th>المبلغ</th>
    <th>العملة</th>
    <th>طريقة الدفع</th>
    <th>الخصم</th>
    <th>شراء الملفات</th>
    <th>إنتهاء الصلاحية</th>
   </tr>
   <tr>
    <td dir="auto" title="<?php echo $invoice["customer_id"]; ?>"><a target="_blank" href="<?php echo $invoice["customer_id_app_link"].$invoice["customer_id"]; ?>"><?php echo mb_strimwidth($invoice["customer_id"], 0, 22, "..."); ?></a></td>
    <td dir="auto" title="<?php echo $invoice["site_id"]; ?>"><a target="_blank" href="./w/<?php echo $invoice["site_id"]; ?>"><?php echo mb_strimwidth($invoice["site_id"], 0, 15, "..."); ?></a></td>
    <td><?php echo price_format($invoice["price"]); ?></td>
    <td><?php echo str_replace("credit", "كريدت", $invoice["currency"]) ?></td>
    <td role="icon"><?php echo pay_method($invoice["pay_method"]); ?></td>
    <td><?php echo $invoice["discount"]; ?>%</td>
    <td><?php echo buy_files_check($invoice["buy_files"]); ?></td>
    <td><?php echo (empty($invoice["expire"]) || $invoice["expire"] == "0000-00-00") ? '<i class="fas fa-infinity"></i>':str_replace("-", "/", $invoice["expire"]); ?></td>
   </tr>
  </table>
  <div class="wow animate__backInUp" data-wow-duration="800ms" data-wow-offset="1" role="media">
   <h3>فاتورة #<?php echo $invoice["id"]; ?> (<?php echo str_replace("-", "/", $invoice["date"]); ?>)</h3>
   <div>
    <span style="grid-area:customer-id">
     <strong>معرف/رقم/ايميل العميل:</strong>
     <a dir="auto" target="_blank" href="<?php echo $invoice["customer_id_app_link"].$invoice["customer_id"]; ?>"><?php echo mb_strimwidth($invoice["customer_id"], 0, 28, "..."); ?></a>
    </span>
    <span style="grid-area:site-id">
     <strong>معرف الموقع:</strong>
     <a dir="auto" target="_blank" href="./w/<?php echo $invoice["site_id"]; ?>"><?php echo mb_strimwidth($invoice["site_id"], 0, 28, "..."); ?></a>
    </span>
    <span style="grid-area:price">
     <strong>المبلغ:</strong>
     <a><?php echo price_format($invoice["price"]); ?></a>
    </span>
    <span style="grid-area:discount">
     <strong>الخصم:</strong>
     <a><?php echo $invoice["discount"]; ?>%</a>
    </span>
    <span style="grid-area:currency">
     <strong>العملة:</strong>
     <a><?php echo str_replace("credit", "كريدت", $invoice["currency"]) ?></a>
    </span>
    <span style="grid-area:pay-method">
     <strong>طريقة الدفع:</strong>
     <a role="icon"><?php echo pay_method($invoice["pay_method"]); ?></a>
    </span>
    <span style="grid-area:buy-files">
     <strong>شراء الملفات:</strong>
     <?php echo buy_files_check($invoice["buy_files"]); ?>
    </span>
    <span style="grid-area:expire">
     <strong>إنتهاء الصلاحية:</strong>
     <a><?php echo (empty($invoice["expire"]) || $invoice["expire"] == "0000-00-00") ? '<i class="fas fa-infinity"></i>':str_replace("-", "/", $invoice["expire"]); ?></a>
    </span>
   </div>
   <h6>منشئ الفاتورة: <?php echo $invoice["creator"] ?></h6>
  </div>
  <?php endwhile; ?>
 </div>