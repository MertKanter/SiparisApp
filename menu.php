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
                <?php
                    $query = mysqli_query($db,"SELECT * FROM urun_turleri");
                    while($satir = mysqli_fetch_array($query)){
                ?>
                <ul>
                    <h5><?php echo $satir["tur_adi"]; ?></h5>
                    <div class="list-group urun-liste">
                        <?php
                        $urun_query = mysqli_query($db,"SELECT * FROM urunler WHERE tur = ".$satir["id"]);
                        while($urun_satir = mysqli_fetch_array($urun_query)){
                            ?>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action" id="<?php echo $urun_satir["id"]; ?>">
                                <li><?php echo $urun_satir["isim"]; echo "\t"; echo $urun_satir["fiyat"] ?> tl</li>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $(".urun-liste > a").click(function(){
                var id = $(this).attr("id");
                $.ajax({
                    url : "sepet.php",
                    type: "POST",
                    data : {"id":id},
                    success: function(data, textStatus, jqXHR)
                    {
                        $(".sepet-alert").css("display","none");
                        $(".sepet-alert").fadeToggle();
                        $(".sepet-alert").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>