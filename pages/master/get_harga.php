<?php
include_once("__DIR__ .  ../../../../koneksi.php");

$q = $_GET['q'];
$harga = mysqli_query($con, "SELECT harga FROM sampah WHERE id_sampah = '$q'");
$row = mysqli_fetch_row($harga);
echo $row[0];

?>