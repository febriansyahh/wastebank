<?php
include_once("__DIR__ .  ../../../../koneksi.php");

$s = $_GET['h'];
// var_dump($s);
  $harga = mysqli_query($con, "SELECT jumlah_tabungan FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah AND a.id_nasabah = '$s'");
  $row = mysqli_fetch_row($harga);
  echo $row[0];
  // var_dump($row[0]);
?>