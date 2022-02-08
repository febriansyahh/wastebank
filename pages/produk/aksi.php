<?php
include_once("__DIR__ .  ../../../../koneksi.php");

// switch ($data_status) {
// 	case '1':
// 		if (isset($_POST['btnSimpan'])) {
// 			insertProduk(upload_gambar('gambar', $_POST['kode']));
// 		} elseif (isset($_POST['btnUBAH'])) {
// 			updateProduk(upload_gambar('gambar', $_POST['kode']));
// 		} else {
// 			if (isset($_GET['kode'])) {
// 				deleteProduk($_GET['kode']);
// 			}
// 		}
// 		break;
	
// 	case 
// 		# code...
// 		break;
// }
if (isset($_POST['btnBeli'])) {
	insertPenjualan();
} elseif (isset($_POST['btnUBAH'])) {
  // updatePenjualan();
} else {
	if (isset($_GET['kode'])) {
    // deletePenjualan($_GET['kode']);
	}
}