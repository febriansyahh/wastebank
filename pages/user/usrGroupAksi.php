<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertUsrGroup();
} elseif (isset($_POST['btnUBAH'])) {
  updateUsrGroup();
} else {
	if (isset($_GET['kode'])) {
    deleteUsrGroup($_GET['kode']);
	}
}