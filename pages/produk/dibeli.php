<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnBeli'])) {
	insertPenjualan();
} elseif (isset($_POST['btnUBAH'])) {
  // updatePenjualan();
} else {
	if (isset($_GET['kode'])) {
    // deletePenjualan($_GET['kode']);
	}
}