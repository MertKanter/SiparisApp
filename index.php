<?php session_start();
include("db.php");
if(isset($_POST["masano"])){
    if($_POST["masano"] == "" or $_POST["masano"] == " " or $_POST["masano"] == null){
        echo "<scrpit>alert('Lütfen geçerli bir masa numarası girin.');</script>";
    }
    else {
        $_SESSION["masa"] = $_POST["masano"];   
    }
}
if(!(isset($_SESSION["masa"]))){
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sipariş App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    </script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-index d-flex justify-content-center">
        <div id="entry-box">
            <div class="row">
                <div class="col">
                    <form method="POST">
                        <h2 id="baslik">Hoşgeldiniz</h2>
                       <div><input type="number" name="masano" max="<?php echo $sayfa_ayarlar["masa_sayisi"]; ?>" id="masano" placeholder="Masa No"></div>
                        <div><input type="submit" value="Tamam" id="tamam"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}
else {
    header("Location: musteri.php");
    die();
}
?>