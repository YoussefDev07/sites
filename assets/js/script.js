const colors = {
  main: "#00186d"
}

new WOW().init();

$(window).ready(function(){

// directions

$("#files").click(function(){
  window.location.assign("./files.php");
});

$("#invoices").click(function(){
  window.location.assign("./invoices.php");
});

// search

let searchMode = "customerID";

$("#searchSwitch").click(function(){
  if (searchMode == "customerID") {
    $("#searchInput").attr("name", "site_id");
    $("#searchInput").attr("placeholder", "البحث باستخدام معرف الموقع...");
    $("#searchInput").val(null);
    searchMode = "siteID";
  }
  else if (searchMode == "siteID") {
    $("#searchInput").attr("name", "customer_id");
    $("#searchInput").attr("placeholder", "البحث باستخدام معرف العميل...");
    $("#searchInput").val(null);
    searchMode = "customerID";
  }
});

// expired invoices

$(".renew").click(async function(){
  let invoicesID = $(this).attr("data-id");

  let { value: reNewPeriod } = await Swal.fire({
    title: `تجديد فاتورة #${invoicesID}`,
    input: "select",
    inputOptions: {
      month_1: "شهر",
      month_2: "شهرين",
      month_3: "3 شهور",
      month_6: "6 شهور",
      month_9: "9 شهور",
      year_1: "سنة",
      forever: "للأبد"
    },
    inputPlaceholder: "اختر مدة التجديد...",
    confirmButtonText: "تجديد",
    confirmButtonColor: colors.main,
    showLoaderOnConfirm: true,
    showCancelButton: true,
    cancelButtonText: "إلغاء",
    inputValidator: (value) => {
      return new Promise((resolve) => {
        resolve();
      });
    }
  });

  if (reNewPeriod) {
    axios.get("./hooks/renew_invoice.php", {
      params: {
        invoice_id: invoicesID,
        period: reNewPeriod
      }
    }).then(function(){
      switch (reNewPeriod) {
        case "month_1":
          var newPeriod = "شهر";
          break;
        case "month_2":
          var newPeriod = "شهرين";
          break;
        case "month_3":
          var newPeriod = "3 شهور";
          break;
        case "month_6":
          var newPeriod = "6 شهور";
          break;
        case "month_9":
          var newPeriod = "9 شهور";
          break;
        case "year_1":
          var newPeriod = "سنة";
          break;
        case "forever":
          var newPeriod = "للأبد";
          break;
      }

      Swal.fire({
        title: "تم التجديد!",
        text: `المدة: ${newPeriod}`,
        position: "center",
        icon: "success",
        showConfirmButton: false,
        timer: 1800
      });

      setTimeout(function(){
        window.location.reload();
      }, 2200);
    }).catch(function (error) {
      alert(error);
    });
  }
});

$(".hide").click(function(){
  let invoicesID = $(this).attr("data-id");

  Swal.fire({
    text: `هل أنت متأكد من إخفاء فاتورة #${invoicesID}؟`,
    showCancelButton: true,
    confirmButtonText: "إخفاء",
    cancelButtonText: "إلغاء",
    confirmButtonColor: "#c70000"
  }).then((result) => {
    if (result.isConfirmed) {
      axios.get("./hooks/hide_invoice.php", {
        params: {
          id: invoicesID
        }
      }).then(function(){
          Swal.fire({
            title: "تم إخفاء الفاتورة!",
            position: "center",
            icon: "success",
            showConfirmButton: false,
            timer: 1800
          });
  
          setTimeout(function(){
            window.location.reload();
          }, 2200);
      }).catch(function (error) {
        alert(error);
      });
    }
  });  
});

// upload

if ($(window).width() >= 1024) {
  $(".upload").removeClass("animate__flipInY").addClass("animate__bounceInLeft");
}

new WOW().init();

$("#createFolder").click(async function(){
  let path = $(this).attr("path");
  let folderWebsite = {
    title: "إنشاء مجلد",
    inputLabel: "ادخل اسم المجلد:",
    inputValidator: "يجيب إدخال اسم للمجلد"
  }

  if (path == "/") {
    folderWebsite.title = "إنشاء موقع";
    folderWebsite.inputLabel = "ادخل اسم الموقع:";
    folderWebsite.inputValidator = "يجيب إدخال اسم للموقع";
  }

  let { value: folderName } = await Swal.fire({
    title: folderWebsite.title,
    input: "text",
    inputLabel: folderWebsite.inputLabel,
    inputAttributes: {
      "autocomplete": "off"
    },
    confirmButtonText: "حسناً",
    confirmButtonColor: colors.main,
    showCancelButton: true,
    cancelButtonText: "إلغاء",
    inputValidator: (value) => {
      if (!value) {
        return folderWebsite.inputValidator;
      }
      else if (value.length > 50) {
        return "الاسم طويل للغاية";
      }
      else if (value.includes("`") || value.includes("'") || value.includes("\"") || value.includes(":") || value.includes("/") || value.includes("\\") || value.includes("|") || value.includes("?") || value.includes("*") || value.includes("<") || value.includes(">")) {
        return "لا يمكن إضافة `\"':/\\|?*<> في الاسم";
      }
    }
  });

  if (folderName) {
    axios.get("./hooks/create_folder.php", {
      params: {
        folder_name: folderName,
        path: path
      }
    }).then(function (response) {
      if (response.data == "done") {
        Swal.fire({
          text: "تم الإنشاء بنجاح!",
          icon: "success",
          confirmButtonText: "حسناً",
          confirmButtonColor: colors.main,
          allowOutsideClick: false,
          allowEscapeKey: false
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        });
      }
      else {
        Swal.fire({
          title: "عذراً",
          text: response.data,
          icon: "warning",
          confirmButtonText: "حسناً",
          confirmButtonColor: colors.main
        });
      }
    }).catch(function (error) {
      Swal.fire("خطأ...!", `${error}`, "error");
    });
  }
});

$("#uploadFile").click(function(){
  let path = $(this).attr("path");
 
  // upload-files

  Swal.fire({
    title: "رفع ملف",
    html: `<!--upload-files-->
            <form class="upload-files" action="./hooks/upload_files.php" method="post" enctype="multipart/form-data">
             <input type="file" name="files[]" multiple required>
             <input type="hidden" name="path" required value="${path}">
             <input type="submit" value="رفع">
            </form>`,
    showConfirmButton: false,
    showCancelButton: true,
    cancelButtonText: "إلغاء",
    cancelButtonColor: colors.main
  });
});

// files-list

$("#backFolder").click(function(){
  window.history.back();
});

var delete_ = false;

$(".files-list li .delete").click(function(){
  delete_ = true;

  let data = {
    type: $(this).attr("data-type"),
    name: $(this).attr("data-name"),
    path: $(this).attr("data-path")
  }

  if (data.type == "folder") {
    if (data.path == "/") {
      var text = {
        ask: "هل أنت متأكد من حذف الموقع؟: ",
        done: "تم حذف الموقع بنجاح!"
      }
    } else {
      var text = {
        ask: "هل أنت متأكد من حذف المجلد؟: ",
        done: "تم حذف المجلد بنجاح!"
      }
    }
  } else {
    var text = {
      ask: "هل أنت متأكد من حذف الملف؟: ",
      done: "تم حذف الملف بنجاح!"
    }
  }

  Swal.fire({
    text: text.ask + data.name,
    icon: "question",
    confirmButtonText: "حذف",
    confirmButtonColor: "#c70000",
    showCancelButton: true,
    cancelButtonText: "إلغاء"
  }).then((result) => {
    if (result.isConfirmed) {
      axios.get("./hooks/delete.php", {
        params: {
          type: data.type,
          name: data.name,
          path: data.path
        }
      }).then(function (response) {
        if (response.data == "deleted") {
          Swal.fire({
            text: text.done,
            icon: "success",
            confirmButtonText: "حسناً",
            confirmButtonColor: colors.main,
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
        }
        else {
          Swal.fire({
            title: "عذراً",
            text: response.data,
            icon: "warning",
            confirmButtonText: "حسناً",
            confirmButtonColor: colors.main
          });
        }
      }).catch(function (error) {
        Swal.fire("خطأ...!", `${error}`, "error");
      });
    }
  });
});

$(".files-list li[role='folder']").click(function(){
  if (delete_) return;

  let data = {
    path: $(this).attr("data-path"),
    folderName: $(this).attr("data-folder-name")
  }

  if (data.path == "/") data.path = "";
  window.location.assign("?path=" + data.path + "/" + data.folderName);
});

});