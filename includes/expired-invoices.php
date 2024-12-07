<!--expired-invoices-->
 <details class="expired-invoices wow animate__fadeInDown" data-wow-duration="800ms">
  <?php $expired_invoices_count = $connection -> query("SELECT COUNT(id) FROM invoices WHERE expired = true AND hide = false") -> fetchAll(PDO::FETCH_COLUMN); $expired_invoices_count = $expired_invoices_count[0]; ?>
  <summary>الفواتير المنتهية الصلاحية [<?PHP echo $expired_invoices_count; ?>]</summary>
   <div class="invoices">
    <?php
      #invoices
      function price_format($price) {
        $check = strval($price);
        $check = explode(".", $check);

        if (empty($check[1])) {
          return number_format($price, 0, '.', ',');
        }
        if (strlen($check[1]) == 1) {
          return number_format($price, 1, '.', ',');
        }
        else if (strlen($check[1]) == 2) {
          return number_format($price, 2, '.', ',');
        }
        else {
          return number_format($price, 2, '.', ',');
        }
      }

      function pay_method($method) {
        if ($method == "probot") {
          return '<img title="ProBot ✨" src="./assets/images/probot.webp" alt="probot">بروبوت';
        }
      }

      function buy_files_check($status) {
        if ($status == 1) {
          return '<i class="fas fa-check" style="color: #27b91d;"></i>';
        }
        else {
          return '<i class="fas fa-times" style="color: #c70000;"></i>';
        }
      }

      $expired_invoices = $connection -> query("SELECT * FROM invoices WHERE expired = true AND hide = false");
      while($expired_invoice = $expired_invoices -> fetch()):
      ?>
      <table class="wow animate__slideInUp" data-wow-duration="800ms" data-wow-offset="1">
       <caption>فاتورة #<?php echo $expired_invoice["id"]; ?> (<?php echo str_replace("-", "/", $expired_invoice["date"]); ?>)
        <pre>منشئ الفاتورة: <?php echo $expired_invoice["creator"]; ?></pre>
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
        <th>تجديد</th>
        <th>إخفاء</th>
       </tr>
       <tr>
        <td dir="auto" title="<?php echo $expired_invoice["customer_id"]; ?>"><a target="_blank" href="<?php echo $expired_invoice["customer_id_app_link"].$expired_invoice["customer_id"]; ?>"><?php echo mb_strimwidth($expired_invoice["customer_id"], 0, 22, "..."); ?></a></td>
        <td dir="auto" title="<?php echo $expired_invoice["site_id"]; ?>"><a target="_blank" href="./w/<?php echo $expired_invoice["site_id"]; ?>"><?php echo mb_strimwidth($expired_invoice["site_id"], 0, 15, "..."); ?></a></td>
        <td><?php echo price_format($expired_invoice["price"]); ?></td>
        <td><?php echo str_replace("credit", "كريدت", $expired_invoice["currency"]) ?></td>
        <td role="icon"><?php echo pay_method($expired_invoice["pay_method"]); ?></td>
        <td><?php echo $expired_invoice["discount"]; ?>%</td>
        <td><?php echo buy_files_check($expired_invoice["buy_files"]); ?></td>
        <td><?php echo (empty($expired_invoice["expire"]) || $expired_invoice["expire"] == "0000-00-00") ? '<i class="fas fa-infinity"></i>':str_replace("-", "/", $expired_invoice["expire"]); ?></td>
        <td><button class="renew" type="button" data-id="<?php echo $expired_invoice["id"]; ?>"><i class="fas fa-sync fa-pulse"></i></button></td>
        <td><button class="hide" type="button" data-id="<?php echo $expired_invoice["id"]; ?>"><i class="fas fa-eye-slash"></i></button></td>
       </tr>
      </table>
      <div class="wow animate__backInUp" data-wow-duration="800ms" data-wow-offset="1" role="media">
       <h3>فاتورة #<?php echo $expired_invoice["id"]; ?> (<?php echo str_replace("-", "/", $expired_invoice["date"]); ?>)</h3>
       <div>
        <span style="grid-area:customer-id">
         <strong>معرف/رقم/ايميل العميل:</strong>
         <a dir="auto" target="_blank" href="<?php echo $expired_invoice["customer_id_app_link"].$expired_invoice["customer_id"]; ?>"><?php echo mb_strimwidth($expired_invoice["customer_id"], 0, 28, "..."); ?></a>
        </span>
        <span style="grid-area:site-id">
         <strong>معرف الموقع:</strong>
         <a dir="auto" target="_blank" href="./w/<?php echo $expired_invoice["site_id"]; ?>"><?php echo mb_strimwidth($expired_invoice["site_id"], 0, 28, "..."); ?></a>
        </span>
        <span style="grid-area:price">
         <strong>المبلغ:</strong>
         <a><?php echo price_format($expired_invoice["price"]); ?></a>
        </span>
        <span style="grid-area:discount">
         <strong>الخصم:</strong>
         <a><?php echo $expired_invoice["discount"]; ?>%</a>
        </span>
        <span style="grid-area:currency">
         <strong>العملة:</strong>
         <a><?php echo str_replace("credit", "كريدت", $expired_invoice["currency"]) ?></a>
        </span>
        <span style="grid-area:pay-method">
         <strong>طريقة الدفع:</strong>
         <a role="icon"><?php echo pay_method($expired_invoice["pay_method"]); ?></a>
        </span>
        <span style="grid-area:buy-files">
         <strong>شراء الملفات:</strong>
         <?php echo buy_files_check($expired_invoice["buy_files"]); ?>
        </span>
        <span style="grid-area:expire">
         <strong>إنتهاء الصلاحية:</strong>
         <a><?php echo (empty($expired_invoice["expire"]) || $expired_invoice["expire"] == "0000-00-00") ? '<i class="fas fa-infinity"></i>':str_replace("-", "/", $expired_invoice["expire"]); ?></a>
        </span>
        <span style="grid-area:renew">
         <strong>تجديد:</strong>
         <button class="renew" type="button" data-id="<?php echo $expired_invoice["id"]; ?>"><i class="fas fa-sync fa-pulse"></i></button>
        </span>
        <span style="grid-area:hide">
         <strong>إخفاء:</strong>
         <button class="hide" type="button" data-id="<?php echo $expired_invoice["id"]; ?>"><i class="fas fa-eye-slash"></i></button>
        </span>
       </div>
       <h6>منشئ الفاتورة: <?php echo $expired_invoice["creator"] ?></h6>
      </div>
      <?php endwhile; ?>
   </div>
 </details>