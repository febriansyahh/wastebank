<?php
include_once("__DIR__ .  ../../../../koneksi.php");

// if (isset($_POST['btnSimpan'])) {
// 	insertTabungan();
// } elseif (isset($_POST['btnUBAH'])) {
//   updateTabungan();
// } else {
// 	if (isset($_GET['kode'])) {
//     deleteTabungan($_GET['kode']);
// 	}
// }

if(isset($_POST['btnUBAH'])){
   updateTabungan();
}else{
  if (isset($_GET['kode'])) {
        deleteTabungan($_GET['kode']);
    	}
}
