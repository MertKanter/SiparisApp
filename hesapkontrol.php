<?php session_start();
if (isset($_GET["unset"])){
    unset($_SESSION["masa"]);
}
if(!isset($_SESSION["masa"])){
    header("Location: index.php");
    die();
}
include("db.php");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş App - Hesap Kontrol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="sepet-alert" style="position: fixed; top:10px;right:10px;display:none;"></div>
    <header>
       <?php 
        include("sidebar.php")
       ?>
        <div id="restoran-isim">
            <h1>Restoran İsmi</h1>
        </div>
    </header>

    <div id="bilgi-box">
        <h3>Menu</h3>
        <p>Masa no: <?php echo $_SESSION["masa"]; ?></p>
    </div>

    <section>
        <div class="row">
            <div class="col">
                <ul>
                    <h5>Siparişlerim</h5>
                    <div class="list-group urun-liste">
                        <?php
                            $toplam_tutar = 0;
                            $sepet_query = mysqli_query($db,"SELECT * FROM sepetler WHERE status = 1 and masaid = ".$_SESSION["masa"]);
                            while($sepet_satir = mysqli_fetch_array($sepet_query)){
                            $urun_query = mysqli_query($db,"SELECT * FROM urunler WHERE  id = ".$sepet_satir["urunid"]);
                            $urun_satir = mysqli_fetch_array($urun_query);
                        ?>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                <li><?php echo $urun_satir["isim"]; ?> | <?php echo $urun_satir["fiyat"]; ?> ₺</li>
                            </a>
                        <?php
                            $toplam_tutar += $urun_satir["fiyat"];
                            }
                        ?>
                        <a href="javascript:void(0);" class="list-group-item list-group-item-action active">
                            <li>Toplam Tutar : <?php echo $toplam_tutar; ?> ₺</li>
                        </a>
                    </div>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>