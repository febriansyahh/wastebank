<?php
include_once("__DIR__ .  ../../../../koneksi.php");

$q = $_GET['q'];
$harga = mysqli_query($con, "SELECT harga FROM sampah WHERE id_sampah = '$q'");
$row = mysqli_fetch_row($harga);
echo $row[0];

  // $q = $_GET['q'];
  // $h = $_GET['h'];

  // $harga = mysqli_query($con, "SELECT harga FROM sampah WHERE id_sampah = '$q'");
  // $row = mysqli_fetch_row($harga);
  // echo $row[0];

  // $tabungan = mysqli_query($con, "SELECT jumlah_tabungan FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah AND a.id_nasabah = '$h'");
  // $rows = mysqli_fetch_row($tabungan);
  // echo $rows[0];

// if (isset($q) !=NULL) {
//   $harga = mysqli_query($con, "SELECT harga FROM sampah WHERE id_sampah = '$q'");
//   $row = mysqli_fetch_row($harga);
//   echo $row[0];

// }elseif(isset($h) !=NULL){
//   $harga = mysqli_query($con, "SELECT jumlah_tabungan FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah AND a.id_nasabah = '$h'");
//   $row = mysqli_fetch_row($harga);
//   echo $row[0];
//   var_dump($row[0]);
// }
?>