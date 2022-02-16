<?php
include_once("__DIR__ .  ../../../../koneksi.php");

// $q = $_GET['q'];
// $harga = mysqli_query($con, "SELECT harga FROM sampah WHERE id_sampah = '$q'");
// $row = mysqli_fetch_row($harga);
// echo $row[0];

  if(isset($_GET['q'])) {
  $q = $_GET['q'];

    $harga = mysqli_query($con, "SELECT harga FROM sampah WHERE id_sampah = '$q'");
    $row = mysqli_fetch_row($harga);
    echo $row[0];
  } elseif (isset($_GET['h'])) {
  $h = $_GET['h'];

    $harga = mysqli_query($con, "SELECT jumlah_tabungan FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah AND a.id_nasabah = '$h'");
    $row = mysqli_fetch_row($harga);
    echo $row[0];
  }

?>