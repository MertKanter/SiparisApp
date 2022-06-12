<?php session_start();
if (isset($_GET["unset"])){
    unset($_SESSION["masa"]);
}
if(!isset($_SESSION["masa"])){
    header("Location: index.php");
    die();
}
include("db.php");
if(isset($_GET["sil"])){
    mysqli_query($db,"DELETE FROM sepetler WHERE id = ".$_GET["sil"]);
    echo "<script type='text/javascript'>alert('Ürün Silindi');</script>";
}
else if (isset($_GET["status"]) and $_GET["status"] == 1){
    $sepetler_getir = mysqli_query($db,"SELECT * FROM sepetler WHERE status= 0 and masaid = ".$_SESSION["masa"]);
    while($sepetler_satir = mysqli_fetch_array($sepetler_getir)){
        mysqli_query($db,"UPDATE sepetler SET status = 1 WHERE status = 0 and  id =".$sepetler_satir["id"]);
    }
    echo "<script type='text/javascript'>alert('Sipariş İletildi.');</script>";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş App - Menu</title>
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
                            $sepet_query = mysqli_query($db,"SELECT * FROM sepetler WHERE status= 0 and masaid = ".$_SESSION["masa"]);
                            while($sepet_satir = mysqli_fetch_array($sepet_query)){
                            $urun_query = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$sepet_satir["urunid"]);
                            $urun_satir = mysqli_fetch_array($urun_query);
                        ?>
                            <a href="javascript:if(confirm('Ürünü silmek istediğinize emin misiniz?')){window.location.href='sipariskontrol.php?sil=<?php echo $sepet_satir["id"] ?>';}" class="list-group-item list-group-item-action">
                                <li><?php echo $urun_satir["isim"]; ?> | <?php echo $urun_satir["fiyat"]; ?> ₺</li>
                            </a>
                        <?php
                            }
                            if(mysqli_affected_rows($db) > 0){
                                ?>
                                <a href="javascript:if(confirm('Sepeti onaylıyor musunuz?')){window.location.href='sipariskontrol.php?status=1';}" class="btn btn-success">Sepeti Onayla</a>
                                <?php
                            }
                            else { ?>
                                <a href="javascript:void(0);" class="btn btn-success disabled">Sepete ürün ekleyin!</a>
                            <?php }
                        ?>
                            
                    </div>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>