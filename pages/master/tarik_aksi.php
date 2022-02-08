<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertTarik();
} elseif (isset($_POST['btnUBAH'])) {
  updateTarik();
} else {
	if (isset($_GET['kode'])) {
    deleteTarik($_GET['kode']);
	}
}
