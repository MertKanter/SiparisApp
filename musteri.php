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
    <title>Sipariş App - Müşteri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
<header>
       <?php 
        include("sidebar.php")
       ?>
        <div id="restoran-isim">
            <h1>Restoran İsmi</h1>
        </div>
    </header>

    <div id="bilgi-box">
        <h3>Hoşgeldiniz...</h3>
        <p>Masa no: <?php echo $_SESSION["masa"]; ?> </p>
    </div>

    <section>
        <div class="row d-flex justify-content-center">
            <div class="col d-flex justify-content-center">
                <div class="container center">
                    <a href="menu.php">
                        <div class="container-items mr-4">
                            <div class="overlay">
                                <div id="container-item-menu">
                                    <p class="menu-baslik">Menü</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="sipariskontrol.php">
                        <div class="container-items">
                            <div class="overlay">
                                <div id="container-item-siparis-kontrol">
                                    <p class="menu-baslik text-settings">Sipariş Kontrol</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div class="container center">
                    <a href="hesapkontrol.php">
                        <div class="container-items mr-4">
                            <div class="overlay">
                                <div id="container-item-hesap-kontrol">
                                    <p class="menu-baslik text-settings">Hesap Kontrol</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="hesap.php">
                        <div class="container-items">
                            <div class="overlay">
                                <div id="container-item-hesap-isteme">
                                    <p class="menu-baslik text-settings">Hesap İsteme</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>