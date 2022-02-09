<?php
include_once("__DIR__ .  ../../../../koneksi.php");

$s = $_GET['h'];
// var_dump($s);
  $harga = mysqli_query($con, "SELECT SUM(a.jumlah_tabungan) as jumlah_tabungan FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah AND a.id_nasabah = '$s' GROUP BY b.id_nasabah");
  $row = mysqli_fetch_row($harga);

  $sql_tarik = mysqli_query($con,"SELECT SUM(jumlah) FROM `penarikan` WHERE id_nasabah ='$s' GROUP BY id_nasabah");
  $query_tarik = mysqli_fetch_row($sql_tarik);

  $saldo = $row[0] - $query_tarik[0];
  echo $saldo;
  // var_dump($row[0]);
?>