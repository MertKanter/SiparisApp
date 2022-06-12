<?php session_start();
if ((!isset($_SESSION["admin"])) or ($_SESSION["admin"] != 1)) {
    header("Location: index.php");
    die();
}
include("../db.php");
if(isset($_GET["sepet_sil"])){
    mysqli_query($db,"DELETE FROM sepetler WHERE id = ".$_GET["sepet_sil"]);
}
if(isset($_GET["urunleri_onayla"])){
    mysqli_query($db,"UPDATE sepetler SET status = 2 WHERE masaid = ".$_GET["urunleri_onayla"]." and status = 1");

}
if(isset($_GET["urunleri_serviset"])){
    mysqli_query($db,"UPDATE sepetler SET status = 3 WHERE masaid = ".$_GET["urunleri_serviset"]." and status = 2");

}
if(isset($_GET["odeme_al"])){
    mysqli_query($db,"DELETE FROM sepetler WHERE masaid= ".$_GET["odeme_al"]);
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
            display: none;
        }

        .toggle2 {
            display: inline-block;
        }

        #inserter input,
        #inserter select,
        #inserter textarea {
            line-height: 40px;
            width: 100%;
        }

        #inserter {
            margin-bottom: 20px;
        }
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
                                            <h2>Siparişler</h2>
                                        </div>
                                    </div>
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <div class="row p-4">
                                            <?php
                                                for($i = 1;$i<=$sayfa_ayarlar["masa_sayisi"];$i++){
                                            ?>
                                                    <div class="col-lg-4 border border-info p-4 rounded">
                                                        <div class="heading1 margin_0">
                                                            <h2>Masa <?php echo $i; ?></h2>
                                                            <div id="masaButonlar<?php echo $i; ?>">
                                                                <a href="?urunleri_onayla=<?php echo $i; ?>" class="btn btn-success mr-4">Onayla</a><a href="?urunleri_serviset=<?php echo $i; ?>" class="btn btn-primary mr-4">Servis Et</a><a href="javascript:if(confirm('Masadaki müşteriler kalktı mı?')){window.location.href='siparisler.php?odeme_al=<?php echo $i; ?>';}" class="btn btn-danger">Temizle</a>
                                                            </div>
                                                        </div>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Ürün Adı</th>
                                                                        <th>Masa No</th>
                                                                        <th>Durum</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $query = mysqli_query($db, "SELECT * FROM sepetler WHERE masaid = ".$i);
                                                                    if(mysqli_affected_rows($db) == 0){
                                                                        echo '<script type="text/javascript">document.getElementById(`masaButonlar'.$i.'`).style.display=`none`;</script>';
                                                                    }
                                                                
                                                                    while ($satir = mysqli_fetch_array($query)) {
                                                                        $urunAdiGetir = mysqli_query($db, "SELECT * FROM urunler WHERE id = ".$satir["urunid"]);
                                                                        $urunAdi = mysqli_fetch_array($urunAdiGetir);
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if($satir["status"] == 1){ ?><a href="javascript:if(confirm('Ürünü silmek istiyor musunuz?')){window.location.href='siparisler.php?sepet_sil=<?php echo $satir["id"]; ?>';}" class="btn btn-danger rounded-circle"><i class="fa fa-trash"></i></a><?php } ?> 
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $urunAdi["isim"]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $satir["masaid"]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if($satir["status"] == 1){ ?><img width="36" src="images/yeni.gif"><?php } ?> 
                                                                            <?php if($satir["status"] == 2){ ?><img width="42" src="images/hazirlaniyor.gif"><?php } ?> 
                                                                            <?php if($satir["status"] == 3){ ?><img width="42" src="images/servisedildi.gif"><?php } ?> 
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                            <?php
                                                }
                                            ?>
                                            </div>
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
</body>

</html>