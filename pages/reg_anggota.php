<?php
include_once('../koneksi.php');

if (isset($_POST['btnSimpan'])) {
	registrasiDatas(upload_foto('fotoUser', $_POST['nama']));
}