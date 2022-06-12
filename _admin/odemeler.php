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
                                                    <div class="col-lg-4 border border-info p-4 rounded" id="<?php echo $i; ?>">
                                                        <div class="heading1 margin_0">
                                                            <h2>Masa <?php echo $i; ?></h2>
                                                            <a style="float:right;" href="javascript:printDivContent(<?php echo $i; ?>);" class="btn btn-secondary" id="yazdirbtn<?php echo $i; ?>">Yazdır</a>
                                                        </div>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Ürün Adı</th>
                                                                        <th>Fiyat</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $toplam_tutar = 0;
                                                                    $query = mysqli_query($db, "SELECT * FROM sepetler WHERE masaid = ".$i);                                                                
                                                                    while ($satir = mysqli_fetch_array($query)) {
                                                                        $urunAdiGetir = mysqli_query($db, "SELECT * FROM urunler WHERE id = ".$satir["urunid"]);
                                                                        $urunAdi = mysqli_fetch_array($urunAdiGetir);
                                                                        $toplam_tutar += $urunAdi["fiyat"];
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $urunAdi["isim"]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $urunAdi["fiyat"]; ?> ₺
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td><strong>Toplam:</strong></td>
                                                                        <td><?php echo $toplam_tutar; ?> ₺</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                                $odeme_getir = mysqli_query($db,"SELECT * FROM odemeler WHERE masaid = ".$i);
                                                                $odeme_satir = mysqli_fetch_array($odeme_getir);
                                                            ?>
                                                            <span style="float:right;"><?php echo @$odeme_satir["odemesekli"]; ?></span>
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
    <script type="text/javascript">
        function printDivContent(x) {
            document.getElementById("yazdirbtn"+x).style.display = "none";
            var divElementContents = document.getElementById(x).innerHTML;
            var windows = window.open('', '', 'height=400, width=400');
            windows.document.write('<html>');
            windows.document.write('<body > <h1>Sipariş Fişi<br>');
            windows.document.write(divElementContents);
            windows.document.write('</body></html>');
            windows.document.close();
            windows.print();
            document.getElementById("yazdirbtn"+x).style.display = "block";
        }
    </script>
</body>

</html>