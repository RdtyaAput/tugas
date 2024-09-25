<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbnama = "db_stok";
$koneksi = mysqli_connect ("localhost","root","","db_stok");
if(!$koneksi){
    die("koneksi gagal".mysqli_connect.errno().
    mysqli_connect_eror());
}
?>