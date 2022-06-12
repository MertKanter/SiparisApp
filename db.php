<?php
// New Connection
$db = new mysqli('localhost','root','','u0078194_mrtkntr');
$db -> set_charset("utf8");
$sayfa_ayar_getir = mysqli_query($db,"SELECT * FROM users WHERE id = 1");
$sayfa_ayarlar = mysqli_fetch_array($sayfa_ayar_getir);
// Check for errors
if(mysqli_connect_errno()){
echo mysqli_connect_error();
}
?>