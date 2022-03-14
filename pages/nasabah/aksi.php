<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertNasabah(upload_foto('fotoUser', $_POST['nama']));
} elseif (isset($_POST['btnUBAH'])) {
  updateNasabah();
} else {
	if (isset($_GET['kode'])) {
    deleteNasabah($_GET['kode']);
	}
	if(isset($_GET['kirimBc'])) {
		sendBroadcast();
	}
}