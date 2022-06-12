<?php session_start();
if((!isset($_SESSION["admin"])) or ($_SESSION["admin"] != 1)){
    header("Location: index.php");
    die();
}
include("../db.php");
if(isset($_POST["update_id"])){
    mysqli_query($db,"UPDATE urunler SET isim = '".$_POST["isim"]."', aciklama = '".$_POST["aciklama"]."', resim = 1, fiyat = ".$_POST["fiyat"].", tur = ".$_POST["tur_adi"]." WHERE id = ".$_POST["update_id"]);
    echo "<script type='text/javascript'>alert('Ürün güncellendi.');</script>";
}
if(isset($_POST["insert_isim"])){
    mysqli_query($db,"INSERT INTO urunler(isim,aciklama,resim,fiyat,tur) VALUES('".$_POST["insert_isim"]."','".$_POST["aciklama"]."',1,".$_POST["fiyat"].",".$_POST["tur_adi"].")");
    echo "<script type='text/javascript'>alert('".$_POST["insert_isim"]." eklendi.');</script>";    
}
if(isset($_GET["urun_sil"])){
    mysqli_query($db,"DELETE FROM urunler WHERE id = ".$_GET["urun_sil"]);
    echo "<script>Ürün silindi.</script>";
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
                                    <h2>Ürünler</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                     <div class="heading1 margin_0">
                                        <h2>Yeni Ürün Ekle</h2>
                                     </div>
                                       <form method="POST" id="updater" style="display:none;">
                                           <input type="hidden" name="update_id">
                                           <input type="hidden" name="isim">
                                           <input type="hidden" name="aciklama">
                                           <input type="hidden" name="fiyat">
                                           <input type="hidden" name="tur_adi">
                                        </form>
                                        <form method="POST" id="inserter">
                                           <input type="text" name="insert_isim" placeholder="Ürün adı">
                                           <textarea name="aciklama" placeholder="Ürün açıklaması"></textarea>
                                           <input type="number" name="fiyat" placeholder="Fiyat (₺)">
                                           <select name="tur_adi">
                                                 <?php
                                                 $tur_getir = mysqli_query($db,"select * from urun_turleri");
                                                while($tur_satir = mysqli_fetch_array($tur_getir)){
                                                ?>
                                                <option value="<?php echo $tur_satir["id"]; ?>"><?php echo $tur_satir["tur_adi"]; ?></option>
                                                <?php
                                                }
                                                 ?>
                                             </select>
                                           <input type="submit" value="Yeni Ekle">
                                        </form>
                                        
                                        <div class="heading1 margin_0">
                                            <h2>Mevcut Ürünler</h2>
                                         </div>
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Ürün adı</th>
                                             <th>Açıklama</th>
                                             <th>Fiyat</th>
                                             <th>Tür</th>
                                             <th>İşlem</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          $query = mysqli_query($db,"SELECT * FROM urunler");
                                          while($satir = mysqli_fetch_array($query)){
                                          ?>
                                          <tr id="form<?php echo $satir["id"]; ?>">
                                             <td><span class="toggle2"><?php echo $satir["id"]; ?></span><input type="hidden" class="toggle" name="id" value="<?php echo $satir["id"]; ?>"><input class="toggle" type="submit" data-id="<?php echo $satir["id"]; ?>" value="Güncelle"></td>
                                             <td><span class="toggle2"><?php echo $satir["isim"]; ?></span><input type="text" class="toggle" name="isim" value="<?php echo $satir["isim"]; ?>"></td>
                                             <td><span class="toggle2"><?php echo $satir["aciklama"]; ?></span><textarea  class="toggle" style="width:100%;" name="aciklama"><?php echo $satir["aciklama"]; ?></textarea></td>
                                             <td><span class="toggle2"><?php echo $satir["fiyat"]; ?> ₺</span><input type="number" class="toggle" name="fiyat" value="<?php echo $satir["fiyat"]; ?>"></td>
                                             <td><span class="toggle2"><?php
                                                $tur_getir = mysqli_query($db,"select * from urun_turleri where id = ".$satir["tur"]);
                                                $tur_satir = mysqli_fetch_array($tur_getir);
                                                echo $tur_satir["tur_adi"];
                                             ?></span><select class="toggle" name="tur_adi">
                                                 <?php
                                                 $tur_getir = mysqli_query($db,"select * from urun_turleri");
                                                while($tur_satir = mysqli_fetch_array($tur_getir)){
                                                ?>
                                                <option value="<?php echo $tur_satir["id"]; ?>"><?php echo $tur_satir["tur_adi"]; ?></option>
                                                <?php
                                                }
                                                 ?>
                                             </select></td>
                                             <td><a class="toggle2" href="urunler.php?urun_sil=<?php echo $satir["id"]; ?>"><i class="fa fa-trash"></i></a> &nbsp;<a style="cursor:pointer;" class="formToggle" data-id="<?php echo $satir["id"]; ?>"><i class="fa fa-pencil"></i></a>
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
                  var isim = $("#form"+x+" .toggle[name='isim']").val();
                  var aciklama = $("#form"+x+" .toggle[name='aciklama']").val();
                  var fiyat = $("#form"+x+" .toggle[name='fiyat']").val();
                  var tur_adi = $("#form"+x+" .toggle[name='tur_adi']").val();
                  $("#updater input[name='update_id']").val(id);
                  $("#updater input[name='isim']").val(isim);
                  $("#updater input[name='aciklama']").val(aciklama);
                  $("#updater input[name='fiyat']").val(fiyat);
                  $("#updater input[name='tur_adi']").val(tur_adi);
                  $("#updater").submit();
              });
          });
      </script>
   </body>
</html>