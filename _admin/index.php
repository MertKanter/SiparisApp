<?php session_start();
$_SESSION["admin"] = 0;
include("../db.php");
if (isset($_POST["email"])) {
   $query = mysqli_query($db, "SELECT * FROM users WHERE kadi = '" . $_POST["email"] . "' and sifre = '" . md5($_POST["password"]) . "'");
   if (mysqli_num_rows($query) == 1) {
      $_SESSION["admin"] = "1";
      header("Location: panel.php");
      die();
   } else {
      echo "<script>alert('E-posta adresiniz veya şifreniz yanlış.');</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>siparisAPP - Admin Panel</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="css/custom.css" />
   <!-- calendar file css -->
   <link rel="stylesheet" href="js/semantic.min.css" />
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
   <div class="full_container">
      <div class="container">
         <div class="center verticle_center full_height">
            <div class="login_section">
               <div class="logo_login">
                  <div class="center">
                     <img width="210" src="images/logo/logo.png" alt="#" />
                  </div>
               </div>
               <div class="login_form">
                  <form method="POST">
                     <fieldset>
                        <div class="field">
                           <label class="label_field">Email Adresi</label>
                           <input type="email" name="email" placeholder="E-mail" />
                        </div>
                        <div class="field">
                           <label class="label_field">Şifre</label>
                           <input type="password" name="password" placeholder="Şifre" />
                        </div>
                        <div class="field margin_0">
                           <label class="label_field hidden">hidden label</label>
                           <button class="main_bt">Giriş Yap</button>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
</body>

</html>