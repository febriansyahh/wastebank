<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertSampah();
} elseif (isset($_POST['btnUBAH'])) {
  updateSampah();
} else {
	if (isset($_GET['kode'])) {
    deleteSampah($_GET['kode']);
	}
}