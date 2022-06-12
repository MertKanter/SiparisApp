<?php
session_start();
include("db.php");
if(isset($_POST["id"])){
	mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$_POST["id"]);
	if(mysqli_affected_rows($db) == 1){
		mysqli_query($db,"INSERT INTO sepetler(urunid,masaid,status) VALUES(".$_POST["id"].",".$_SESSION["masa"].",0)");
		echo "<div class='btn btn-success'>Ürün Sepetinize Eklendi</div>";
	}
	else {
		echo "<div class='btn btn-danger'>Ürün Sepete Eklenirken Bir Hata Oluştu.</div>";
	}
}
?>