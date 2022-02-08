<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertJenis();
} elseif (isset($_POST['btnUBAH'])) {
  updateJenis();
} else {
	if (isset($_GET['kode'])) {
    deleteJenis($_GET['kode']);
	}
}