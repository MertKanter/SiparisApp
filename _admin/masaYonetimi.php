<?php session_start();
if((!isset($_SESSION["admin"])) or ($_SESSION["admin"] != 1)){
    header("Location: index.php");
    die();
}
include("../db.php");
if(isset($_POST["masa_sayisi_duzenleme"])){
    mysqli_query($db,"UPDATE users SET masa_sayisi = ".$_POST["masa_sayisi_duzenleme"]." WHERE id = 1;");
    echo "<script type='text/javascript'>alert('Masa Sayısı ".$_POST["masa_sayisi_duzenleme"]." Olarak Düzenlendi.');</script>";    
}
if(isset($_POST["masa_ekleme"])){
   mysqli_query($db,"INSERT INTO masalar(masa_no,masa_bolum,masa_status) VALUES(".$_POST["masa_no"].",".$_POST["masa_bolum"].",".$_POST["masa_status"].")");
   echo "<script type='text/javascript'>alert('Masa Sayısı ".$_POST["masa_ekleme"]." eklendi.');</script>";    
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
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
          .toggle {
              display:none;
          }
          .toggle2 {
              display:inline-block;
          }
          #inserter input, #inserter select, #inserter textarea{
              line-height:40px;
              width:100%;
          }
          #inserter {margin-bottom:20px;}
          </style>
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
           <?php include("menu.php"); ?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <?php include("topbar.php"); ?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Hoşgeldiniz</h2>
                           </div>
                        </div>
                        <!-- table section -->
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Masalar</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                     <div class="heading1 margin_0">
                                        <h2>Masa Sayısı Düzenle</h2>
                                     </div>
                                       <form method="POST" id="updater" style="display:none;">
                                           <input type="hidden" name="update_id">
                                           <input type="hidden" name="isim">
                                           <input type="hidden" name="aciklama">
                                           <input type="hidden" name="fiyat">
                                           <input type="hidden" name="tur_adi">
                                        </form>
                                        <form method="POST" id="inserter">
                                          <?php
                                            $query = mysqli_query($db,"SELECT * FROM users");
                                            while($satir = mysqli_fetch_array($query)){
                                          ?>
                                           <input type="text" name="masa_sayisi_duzenleme" value="<?php echo $satir["masa_sayisi"]; ?>" placeholder="Yeni Masa Sayısı">
                                           <input type="submit" value="Düzenle">
                                           <?php } ?>
                                        </form>
                                        
                                        <div class="heading1 margin_0" style="display:none;">
                                            <h2>Mevcut Masa Sayısı</h2>
                                         </div>
                                    <table class="table" style="display:none;">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Masa No</th>
                                             <th>İşlem</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          $query = mysqli_query($db,"SELECT * FROM users");
                                          while($satir = mysqli_fetch_array($query)){
                                          ?>
                                          <tr id="form<?php echo $satir["id"]; ?>">
                                             <td><span class="toggle2"><?php echo $satir["id"]; ?></span><input type="hidden" class="toggle" name="id" value="<?php echo $satir["id"]; ?>"><input class="toggle" type="submit" data-id="<?php echo $satir["id"]; ?>" value="Güncelle"></td>
                                             <td><span class="toggle2"><?php echo $satir["masa_sayisi"]; ?></span><input type="text" class="toggle" name="isim" value="<?php echo $satir["masa_sayisi"]; ?>"></td>
                                             <td><a class="toggle2" href="turler.php?tur_sil=<?php echo $satir["id"]; ?>"><i class="fa fa-trash"></i></a> &nbsp;<a style="cursor:pointer;" class="formToggle" data-id="<?php echo $satir["id"]; ?>"><i class="fa fa-pencil"></i></a>
                                             </td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- table section -->
                     </div>
                  </div>
                  <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                     <div class="heading1 margin_0">
                                        <h2>Masa Ekle</h2>
                                     </div>
                                       <form method="POST" id="updater" style="display:none;">
                                           <input type="hidden" name="update_id">
                                           <input type="hidden" name="masa_no">
                                           <input type="hidden" name="masa_bolum">
                                           <input type="hidden" name="masa_status">
                                        </form>
                                        <form method="POST" id="inserter">
                                           <input type="text" name="masa_no" placeholder="Masa No">
                                           <select name="masa_bolum">
                                                <option value="bahce">Bahçe</option>
                                                <option value="icKisim">İç Kısım</option>
                                                <option value="kat2">2. Kat</option>
                                             </select>
                                             <input type="radio" name=" masa_status" value="0" id="masapasif"> <label for="masapasif">Masa Pasif</label>
                                             <input type="radio" name=" masa_status" value="1" id="masaaktif"> <label for="masaaktif">Masa Aktif</label>
                                           <input type="submit" value="Yeni Ekle">
                                        </form>
                                        
                                        <div class="heading1 margin_0">
                                            <h2>Masalar</h2>
                                         </div>
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Masa No</th>
                                             <th>Masa Bölümü</th>
                                             <th>Masa Durumu</th>
                                             <th>İşlem</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          $query = mysqli_query($db,"SELECT * FROM masalar");
                                          while($satir = mysqli_fetch_array($query)){
                                          ?>
                                          <tr id="form<?php echo $satir["id"]; ?>">
                                             <td><span class="toggle2"><?php echo $satir["id"]; ?></span><input type="hidden" class="toggle" name="id" value="<?php echo $satir["id"]; ?>"><input class="toggle" type="submit" data-id="<?php echo $satir["id"]; ?>" value="Güncelle"></td>
                                             <td><span class="toggle2"><?php echo $satir["masa_no"]; ?></span><input type="text" class="toggle" name="masa_no" value="<?php echo $satir["masa_no"]; ?>"></td>
                                             <td><span class="toggle2"><?php echo $satir["masa_bolum"]; ?></span>
                                             <select name="masa_bolum" class="toggle">
                                                <option value="<?php echo $satir["masa_bolum"]; ?>"><?php echo $satir["masa_bolum"]; ?></option>
                                                <option value="bahce">Bahçe</option>
                                                <option value="icKisim">İç Kısım</option>
                                                <option value="kat2">2. Kat</option>
                                             </select></td>
                                             <td><span class="toggle2"><?php if($satir["masa_status"] == 1){ echo "<i class='fa fa-check'></i>"; } else { echo "<i class='fa fa-close'></i>"; } ?></span><select name="masa_status" class="toggle"><option value="0">Pasif</option><option value="1">Aktif</option></select></td>
                                             
                                             <td><a style="cursor:pointer;" class="formToggle" data-id="<?php echo $satir["id"]; ?>"><i class="fa fa-pencil"></i></a>
                                             </td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                  <!-- footer -->
                  <div class="container-fluid">
                     <div class="footer">
                        <p>Copyright © 2022 Designed by Mert Kanter All rights reserved.<br>
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
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
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <script src="js/chart_custom_style1.js"></script>
      <script type="text/javascript">
          $(document).ready(function(){
              $(".formToggle").click(function(){
                  var x = $(this).attr("data-id");
                  $("#form"+x+" .toggle").toggle();
                  $("#form"+x+" .toggle2").toggle();
              });
              $(".toggle[type='submit']").click(function(){
                  var x = $(this).attr("data-id");
                  var id = $("#form"+x+" .toggle[name='id']").val();
                  var isim = $("#form"+x+" .toggle[name='masa_no']").val();
                  var aciklama = $("#form"+x+" .toggle[name='masa_bolum']").val();
                  var fiyat = $("#form"+x+" .toggle[name='masa_status']").val();
                  $("#updater input[name='update_id']").val(id);
                  $("#updater input[name='masa_no']").val(masa_no);
                  $("#updater input[name='masa_bolum']").val(masa_bolum);
                  $("#updater input[name='masa_status']").val(masa_status);
                  $("#updater").submit();
              });
          });
      </script>
   </body>
</html>