<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertPembelian();
} elseif (isset($_POST['btnUBAH'])) {
  updatePembelian();
} else {
	if (isset($_GET['kode'])) {
    deletePembelian($_GET['kode']);
	}
}