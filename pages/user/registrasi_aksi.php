<?php
include_once("__DIR__ .  ../../../../koneksi.php");

if (isset($_POST['btnSimpan'])) {
  // echo'<pre>';
  // echo $_POST['nisn'];
  // echo $_POST['no_wa'];
  // echo $_POST['password'];
  // echo $_POST['idGroup'];
  // echo $_POST['idDaftar'];
  // echo'</pre>';
  // die();
	registrasiData();
}