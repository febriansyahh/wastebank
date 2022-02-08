<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
	insertUser();
} elseif (isset($_POST['btnUBAH'])) {
  updateUser();
} else {
	if (isset($_GET['kode'])) {
    deleteUser($_GET['kode']);
	}
}