<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'banksampah');
// define('DB','sosial');
define ('SITE_ROOT', realpath(dirname(__FILE__)));

$con = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');

function LoginUser()
{
  global $con;

  $sql_login = "SELECT * FROM `user` WHERE status='1' AND `username`='" . $_POST['txtusm'] . "' AND `password`='" . $_POST['txtpassword'] . "'";
  $query_login = mysqli_query($con, $sql_login);
  $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
  $jumlah_login = mysqli_num_rows($query_login);

  if ($jumlah_login >= 1) {
    session_start();
    $_SESSION["ses_username"] = $data_login["username"];
    $_SESSION["ses_nama"] = $data_login["nama_user"];
    $_SESSION["ses_idLevel"] = $data_login["id_level"];
    $_SESSION["ses_idDaftar"] = $data_login['id_daftar'];
    $_SESSION["ses_idUser"] = $data_login['id_user'];

    echo "<script>alert('Login Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
  } else {
    echo "<script>alert('Login Gagal!!')</script>";
    echo "<meta http-equiv='refresh' content='0; url=signin.php'>";

  }
}

function upload_foto($namePost, $codePost)
{
  $ekstensi_diperbolehkan  = array('jpg', 'png', 'jpeg');
  $date = date('Y-m-d');
  $named = str_replace(' ', '_', $codePost);
  $nama = $_FILES[$namePost]['name'];
  $x = explode('.', $nama);
  $ekstensi = strtolower(end($x));
  $namas = 'Foto_' . $named . "_" . $date ."." . $ekstensi;
  $ukuran = $_FILES[$namePost]['size'];
  $file_tmp = $_FILES[$namePost]['tmp_name'];
  
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    if ($ukuran < 41943040) {
      $destination_path = getcwd().DIRECTORY_SEPARATOR . 'file_data\foto' . '/';
      $target_path = $destination_path . $namas;
      @move_uploaded_file($file_tmp, $target_path);
      return $namas;
    } else {
      return;
    }
  } else {
    return;
  }
}

function registrasiDatas($upload)
{
  global $con;
  $cekIdDaftar = "SELECT `AUTO_INCREMENT` as id_nasabah FROM INFORMATION_SCHEMA.TABLES
  WHERE TABLE_SCHEMA = 'banksampah' AND TABLE_NAME = 'nasabah' ";
  $query = mysqli_query($con, $cekIdDaftar);
  $row = mysqli_fetch_row($query);
  $idDaftar = $row[0];
  $pass = $_POST['password'];
  $repass = $_POST['rePassword'];
  $tgl = date('Y-m-d H:i:s');
  // die();
        if($pass != $repass){
          echo "<script>alert('Password tidak sama, Simpan Gagal !!')</script>";
          echo "<meta http-equiv='refresh' content='0; url=signin.php>";
        }else
            {
              // $sql_insert = "INSERT INTO nasabah (id_nasabah, nama_asabah, alamat, no_hp) VALUES (
              $sql_insert = "INSERT INTO nasabah (nama_nasabah, alamat, no_hp) VALUES (
                '" . $_POST['nama'] . "',
                '" . $_POST['alamat'] . "',
                '" . $_POST['no_hp'] . "')";

                $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

              $sql_insertUser = "INSERT INTO user (nama_user, username, password, foto_user, id_level, id_daftar, status, tgl_daftar) VALUES (
                '". $_POST['nama'] ."',
                '" . $_POST['username'] . "',
                '" . $_POST['password'] . "',
                '". $upload ."',
                '2',
                '" . $idDaftar . "',
                '1',
                '".$tgl."')";
          
                $query_insertUser = mysqli_query($con, $sql_insertUser) or die(mysqli_connect_error());
                
                if ($query_insert && $query_insertUser) {
                  echo "<script>alert('Registrasi Nasabah Berhasil')</script>";
                  echo "<meta http-equiv='refresh' content='0; url=../signin.php'>";
                } else {
                  echo "<script>alert('Registrasi Nasabah Gagal')</script>";
                  echo "<meta http-equiv='refresh' content='0; url=../signin.php'>";
                }
            }
}


function getJenis()
{
  global $con;
  $sql = "SELECT * FROM `jenis_sampah`";
  $query = mysqli_query($con, $sql);
  return $query;
}

function insertJenis()
{
  global $con;
  $sql_insert = "INSERT INTO jenis_sampah (jenis_sampah) VALUES (
					'" . $_POST['jenis'] . "')";

  $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

  if ($query_insert) {
    echo "<script>alert('Simpan Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=jenis'>";
  } else {
    echo "<script>alert('Simpan Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=jenis'>";
  }
}

function updateJenis()
{
  global $con;

  $sql_ubah = "UPDATE jenis_sampah SET
        jenis_sampah='" . $_POST['jenis'] . "'
        WHERE id_jenis='" . $_POST['id_jenis'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=jenis'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=jenis'>";
  }
}

function deleteJenis($id)
{
  global $con;

  $sql_hapus = "DELETE FROM jenis_sampah WHERE id_jenis='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);

  if ($query_hapus) {
    echo "<script>alert('Hapus Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=jenis''>";
  } else {
    echo "<script>alert('Hapus Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=jenis''>";
  }
}

function getsampah()
{
  global $con;
  $sql = "SELECT * FROM sampah a, jenis_sampah b WHERE a.id_jenis=b.id_jenis";
  $query = mysqli_query($con, $sql);
  return $query;
}

function getSelectSampah()
{
  global $con;
  $sql = "SELECT * FROM sampah";
  $query = mysqli_query($con, $sql);
  return $query;
}

function MaxIdProgram()
{
  global $con;

  $carikode = mysqli_query($con, "SELECT MAX(kode_sampah) FROM sampah");
  $datakode = mysqli_fetch_array($carikode);
  $tahun = date ('Y');
  if ($datakode) {
    // $nilaikode = substr($datakode[0], 3);
    $nilaikode = substr($datakode[0],9);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;

    // $hasilkode = "PLDN" . str_pad($kode, 2, "0", STR_PAD_LEFT);
    $hasilkode = "JNS-". $tahun . "-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
  } else {
    $hasilkode = "JNS-". $tahun . "-001";
  }

  return $hasilkode;
}

function MaxIdProduk()
{
  global $con;

  $carikode = mysqli_query($con, "SELECT MAX(kode_barang) FROM produk");
  $datakode = mysqli_fetch_array($carikode);
  $tahun = date ('Y');
  if ($datakode) {
    // $nilaikode = substr($datakode[0], 3);
    $nilaikode = substr($datakode[0],9);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;

    // $hasilkode = "PLDN" . str_pad($kode, 2, "0", STR_PAD_LEFT);
    $hasilkode = "PDU-". $tahun . "-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
  } else {
    $hasilkode = "PDU-". $tahun . "-001";
  }

  return $hasilkode;
}

function insertSampah()
{
  global $con;
  $sql_insert = "INSERT INTO sampah (kode_sampah, nama_sampah, id_jenis, harga) VALUES (
					'" . $_POST['kode'] . "',
					'" . $_POST['nama'] . "',
					'" . $_POST['jenis'] . "',
					'" . $_POST['harga'] . "')";

  $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

  if ($query_insert) {
    echo "<script>alert('Simpan Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=sampah'>";
  } else {
    echo "<script>alert('Simpan Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=sampah'>";
  }
}

function updateSampah()
{
  global $con;

  $sql_ubah = "UPDATE sampah SET
        nama_sampah = '". $_POST['nama'] ."',
        id_jenis='" . $_POST['jenis'] . "',
        harga='" . $_POST['harga'] . "'
        WHERE id_sampah='" . $_POST['id_sampah'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=sampah'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=sampah'>";
  }
}

function deleteSampah($id)
{
  global $con;

  $sql_hapus = "DELETE FROM sampah WHERE id_sampah='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);

  if ($query_hapus) {
    echo "<script>alert('Hapus Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=sampah''>";
  } else {
    echo "<script>alert('Hapus Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=sampah''>";
  }
}


function getReportNasabah()
{
  global $con;
  $sql = "SELECT * FROM nasabah a, user b WHERE a.id_nasabah=b.id_daftar";
  $query = mysqli_query($con, $sql);
  return $query;
}

function insertNasabah($upload)
{
  global $con;
  $cekIdDaftar = "SELECT `AUTO_INCREMENT` as id_nasabah FROM INFORMATION_SCHEMA.TABLES
  WHERE TABLE_SCHEMA = 'banksampah' AND TABLE_NAME = 'nasabah' ";
  $query = mysqli_query($con, $cekIdDaftar);
  $row = mysqli_fetch_row($query);
  $idDaftar = $row[0];
  $pass = $_POST['password'];
  $repass = $_POST['rePassword'];
  
  
  $tgl = date('Y-m-d H:i:s');
  if($pass != $repass){
          echo "<script>alert('Password tidak sama, Simpan Gagal !!')</script>";
          echo "<meta http-equiv='refresh' content='0; url=signin.php>";
        }else
            {
              // $sql_insert = "INSERT INTO nasabah (id_nasabah, nama_asabah, alamat, no_hp) VALUES (
              $sql_insert = "INSERT INTO nasabah (nama_nasabah, alamat) VALUES (
                '" . $_POST['nama'] . "',
                '" . $_POST['alamat'] . "')";

                $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

              $sql_insertUser = "INSERT INTO user (nama_user, username, password, foto_user, id_level, id_daftar, status, tgl_daftar) VALUES (
                '". $_POST['nama'] ."',
                '" . $_POST['username'] . "',
                '" . $_POST['password'] . "',
                '". $upload ."',
                '2',
                '" . $idDaftar . "',
                '1',
                '".$tgl."')";
                
                $query_insertUser = mysqli_query($con, $sql_insertUser) or die(mysqli_connect_error());
                
                if ($query_insert && $query_insertUser) {
                  echo "<script>alert('Registrasi Nasabah Berhasil')</script>";
                  echo "<meta http-equiv='refresh' content='0; url=index.php?pages=nasabah'>";
                } else {
                  echo "<script>alert('Registrasi Nasabah Gagal')</script>";
                  echo "<meta http-equiv='refresh' content='0; url=index.php?pages=nasabah'>";
                }
              }
            }

function updateNasabah()
{
  global $con;

  $sql_ubah = "UPDATE nasabah SET
        nama_nasabah = '". $_POST['nama'] ."',
        alamat='" . $_POST['alamat'] . "'
        WHERE id_nasabah='" . $_POST['id_nasabah'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=nasabah'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=nasabah'>";
  }
}

function deleteNasabah($id)
{
  global $con;
  
  $sql_hapus = "DELETE FROM nasabah WHERE id_nasabah ='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);
  
  $sql_user = "DELETE FROM user WHERE id_daftar ='$id' ";
  $query_hps = mysqli_query($con, $sql_user);
  
  if ($query_hapus && $query_hps) {
    echo "<script>alert('Hapus Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=nasabah'>";
  } else {
    echo "<script>alert('Hapus Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=nasabah'>";
  }
}

function selectUser()
{
  global $con;
  $sql ="SELECT * FROM `user` `a` JOIN `nasabah` `b` ON a.id_daftar=b.id_nasabah";
  $query = mysqli_query($con, $sql);
  return $query;
}

function insertUser()
{
  global $con;
  

  $pass = $_POST['password'];
  $repass = $_POST['rePassword'];
  
  $tgl = date('Y-m-d H:i:s');
  if($pass != $repass){
    echo "<script>alert('Password tidak sama, Simpan Gagal !!')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user'>";
    
  }else
      {
        $sql_insert = "INSERT INTO user (nama, username, password, idLevel, idDaftar, status, tglDaftar) VALUES (
          '" . $_POST['nmUser'] . "',
          '" . $_POST['username'] . "',
          '" . $_POST['password'] . "',
          '" . $_POST['idGroup'] . "',
          '0',
          '1',
          '" . $tgl . "')";
    
          $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());
          if ($query_insert) {
            echo "<script>alert('Simpan Berhasil')</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user'>";
          } else {
            echo "<script>alert('Simpan Gagal')</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user'>";
          }
      }
}

function updateUser()
{
  global $con;

  $sql_ubah = "UPDATE user SET
        nama_user='" . $_POST['nama'] . "',
        username='" . $_POST['username'] . "',
        password='" . $_POST['password'] . "',
        status='" . $_POST['status'] . "'
        WHERE id_user='" . $_POST['id_user'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user'>";
  }
}


function deleteUser($id)
{
  global $con;

  $sql_hapus = "DELETE FROM user WHERE id_user='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);

  if ($query_hapus) {
    echo "<script>alert('Hapus Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user''>";
  } else {
    echo "<script>alert('Hapus Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=user''>";
  }
}


function getNasabah()
{
  global $con;
  $sql = "SELECT * FROM nasabah";
  $query = mysqli_query($con, $sql);
  return $query;
}

function getNasabahAll()
{
  global $con;
  $sql = "SELECT * FROM nasabah a, user b WHERE b.id_daftar=a.id_nasabah AND id_level ='2'";
  $query = mysqli_query($con, $sql);
  return $query;
}

function getReportTransaksi()
{
  global $con;
  $sql = "SELECT a.*, b.nama_sampah, c.* FROM pembelian a, sampah b, nasabah c WHERE a.id_sampah=b.id_sampah AND a.id_nasabah=c.id_nasabah ORDER BY a.tanggal DESC";
  $query = mysqli_query($con, $sql);
  return $query;
}


function getProduk()
{
  global $con;
  $sql = "SELECT * FROM produk";
  $query = mysqli_query($con, $sql);
  return $query;
}

function upload_gambar($namePost, $codePost)
{
  $ekstensi_diperbolehkan  = array('jpg', 'png', 'jpeg');
  $date = date('Y-m-d');
  $named = str_replace(' ', '_', $codePost);
  $nama = $_FILES[$namePost]['name'];
  $x = explode('.', $nama);
  $ekstensi = strtolower(end($x));
  $namas = 'Produk_' . $named . "_" . $date ."." . $ekstensi;
  $ukuran = $_FILES[$namePost]['size'];
  $file_tmp = $_FILES[$namePost]['tmp_name'];

  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    if ($ukuran < 41943040) {
      $destination_path = getcwd().DIRECTORY_SEPARATOR . 'file_data\barang' . '/';

      $target_path = $destination_path . $namas;

      @move_uploaded_file($file_tmp, $target_path);
      return $namas;
    } else {
      return;
    }
  } else {
    return;
  }
}

function insertProduk($upload)
{
  global $con;
  $sql_insert = "INSERT INTO produk (kode_barang, nama_barang, harga, gambar, keterangan) VALUES (
					'" . $_POST['kode'] . "',
					'" . $_POST['nama'] . "',
					'" . $_POST['harga'] . "',
					'" . $upload . "',
					'" . $_POST['keterangan'] . "')";

  $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

  if ($query_insert) {
    echo "<script>alert('Simpan Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk'>";
  } else {
    echo "<script>alert('Simpan Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk'>";
  }
}

function updateProduk($upload)
{
  global $con;
  $cekNisn = "SELECT gambar FROM produk WHERE id_barang = '" . $_POST['id_barang'] . "' ";
  $query = mysqli_query($con, $cekNisn);
  $row = mysqli_fetch_row($query);
  $gambar = $row[0];
  unlink('file_data/produk/' . $gambar);
  $sql_ubah = "UPDATE produk SET
        nama_barang = '". $_POST['nama'] ."',
        harga ='" . $_POST['harga'] . "',
        gambar ='" . $upload . "',
        keterangan='" . $_POST['keterangan'] . "'
        WHERE id_barang='" . $_POST['id_barang'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk'>";
  }
}

function deleteProduk($id)
{
  global $con;

  $cek_gambar = "SELECT gambar FROM produk WHERE id_barang='$id'";
  $query = mysqli_query($con, $cek_gambar);
  $row = mysqli_fetch_row($query);
  $berkas = $row[0];
  
  unlink('file_data/barang/' . $berkas);

  $sql_hapus = "DELETE FROM produk WHERE id_barang ='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);

  if ($query_hapus) {
    echo "<script>alert('Hapus Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk''>";
  } else {
    echo "<script>alert('Hapus Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk''>";
  }
}

function getPembelian()
{
  global $con;
  $sql = "SELECT a.*, b.*, c.nama_nasabah FROM pembelian a, sampah b, nasabah c WHERE a.id_sampah=b.id_sampah AND a.id_nasabah=c.id_nasabah";
  $query = mysqli_query($con, $sql);
  return $query;
}

function insertPembelian()
{
  global $con;
  $pilihan = $_POST['pilihan'];
  $id_nasabah = $_POST['id_nasabah'];
  $total = $_POST['harga'];
  if($pilihan == '1'){

    // $cek_nasabah = "SELECT id_nasabah, jumlah_tabungan FROM tabungan WHERE id_nasabah='$id_nasabah'";
    // $query = mysqli_query($con, $cek_nasabah);
    // $row = mysqli_fetch_row($query);
    // $nasabah = $row[0];
    // $tabungan = $row[1];

    // $total = $tabungan + $total;
    $date = date('Y-m-d H:i:s');

    // if($nasabah != NULL){
    //   $sql_ubah = "UPDATE tabungan SET
    //       jumlah_tabungan ='" . $total . "',
    //       update_terakhir = '$date'
    //       WHERE id_nasabah = '$nasabah'";
    //   $query_tabungan= mysqli_query($con, $sql_ubah);
    // }else{
    //   $sql_insert = "INSERT INTO tabungan (id_nasabah, jumlah_tabungan, update_terakhir) VALUES (
    //     '" . $_POST['id_nasabah'] . "',
    //     '" . $total . "',
    //     '" . $date . "')";
  
    //   $query_tabungan = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());
    // }

    $sql_insert = "INSERT INTO tabungan (id_nasabah, jumlah_tabungan, update_terakhir) VALUES (
      '" . $_POST['id_nasabah'] . "',
      '" . $total . "',
      '" . $date . "')";

    $query_tabungan = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

    $sql_insert = "INSERT INTO pembelian (id_sampah, id_nasabah, tanggal, berat, total, pilihan, tgl_proses) VALUES (
      '" . $_POST['id_sampah'] . "',
      '" . $_POST['id_nasabah'] . "',
      '" . $_POST['tanggal'] . "',
      '" . $_POST['berat'] . "',
      '" . $_POST['harga'] . "',
      '" . $_POST['pilihan'] . "',
      '" . $date . "')";

    $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

    if ($query_insert && $query_tabungan) {
    echo "<script>alert('Simpan Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
    } else {
    echo "<script>alert('Simpan Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
    }
  }else{
  $sql_insert = "INSERT INTO pembelian (id_sampah, id_nasabah, tanggal, berat, total, pilihan) VALUES (
					'" . $_POST['id_sampah'] . "',
					'" . $_POST['id_nasabah'] . "',
					'" . $_POST['tanggal'] . "',
					'" . $_POST['berat'] . "',
					'" . $_POST['harga'] . "',
					'" . $_POST['pilihan'] . "')";

  $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

  if ($query_insert) {
    echo "<script>alert('Pembelian Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
  } else {
    echo "<script>alert('Pembelian Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
  }
  }
}

function updatePembelian()
{
  global $con;
  $nasabah = $_POST['id_nasabah'];
  $pilihan = $_POST['pilihan'];
  $total = $_POST['harga'];

  $date = date('Y-m-d H:i:s');
  if($pilihan == '0'){

    $sql_tabung = "DELETE FROM tabungan WHERE id_nasabah ='$nasabah' AND jumlah_tabungan = '$total' ";
    $query_tabungan= mysqli_query($con, $sql_tabung);

    $sql_ubah = "UPDATE pembelian SET
        id_sampah = '". $_POST['id_sampah'] ."',
        id_nasabah = '" . $_POST['id_nasabah'] . "',
        tanggal = '" . $_POST['tanggal'] . "',
        total = '" . $_POST['harga'] . "',
        pilihan = '" . $_POST['pilihan'] . "',
        tgl_proses = '" . $date . "'
        WHERE id_pembelian = '" . $_POST['id_pembelian'] . "'";

    $query_ubah = mysqli_query($con, $sql_ubah);

    if ($query_ubah && $query_tabungan) {
      echo "<script>alert('Ubah Berhasil')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
    } else {
      echo "<script>alert('Ubah Gagal')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
    }
    
  }else{
    $sql_insert = "INSERT INTO tabungan (id_nasabah, jumlah_tabungan, update_terakhir) VALUES (
      '" . $_POST['id_nasabah'] . "',
      '" . $total . "',
      '" . $date . "')";

    $query_tabungan = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

  $sql_ubah = "UPDATE pembelian SET
        id_sampah = '". $_POST['id_sampah'] ."',
        id_nasabah = '" . $_POST['id_nasabah'] . "',
        tanggal = '" . $_POST['tanggal'] . "',
        total = '" . $_POST['harga'] . "',
        pilihan = '" . $_POST['pilihan'] . "',
        tgl_proses = '" . $date . "'
        WHERE id_pembelian = '" . $_POST['id_pembelian'] . "'";

  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah && $query_tabungan) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian'>";
  }
}
}

function deletePembelian($id)
{
  global $con;

  $cek_pilihan = "SELECT id_nasabah, pilihan, total FROM pembelian WHERE id_pembelian='$id'";
  $query = mysqli_query($con, $cek_pilihan);
  $row = mysqli_fetch_row($query);
  $nasabah = $row[0];
  $pilihan = $row[1];
  $total = $row[2];

  $date = date('Y-m-d H:i:s');

  if($pilihan == '1'){
    $sql_ubah = "DELETE FROM tabungan WHERE id_nasabah ='$nasabah' AND jumlah_tabungan = '$total' ";
    $query_ubah = mysqli_query($con, $sql_ubah);

    $sql_hapus = "DELETE FROM pembelian WHERE id_pembelian ='$id' ";
    $query_hapus = mysqli_query($con, $sql_hapus);

    if ($query_hapus && $query_ubah) {
      echo "<script>alert('Hapus Berhasil')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian''>";
    } else {
      echo "<script>alert('Hapus Gagal')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian''>";
    }

  }else{
    $sql_hapus = "DELETE FROM pembelian WHERE id_pembelian ='$id' ";
    $query_hapus = mysqli_query($con, $sql_hapus);

    if ($query_hapus) {
      echo "<script>alert('Hapus Berhasil')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian''>";
    } else {
      echo "<script>alert('Hapus Gagal')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=pembelian''>";
    }
  }

}

function getTabungan()
{
  global $con;
  $sql = "SELECT a.id_tabungan, a.id_nasabah, b.nama_nasabah, b.alamat, SUM(a.jumlah_tabungan) as total FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah GROUP BY b.id_nasabah";
  $query = mysqli_query($con, $sql);
  return $query;
}

function insertTabungan()
{
  global $con;
  
  $tgl = date('Y-m-d H:i:s');
  $sql_insert = "INSERT INTO tabungan (id_nasabah, jumlah_tabungan, update_terakhir) VALUES (
    '" . $_POST['id_nasabah'] . "',
    '" . $_POST['jumlah'] . "',
    '" . $tgl . "')";

    $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());
    if ($query_insert) {
      echo "<script>alert('Simpan Berhasil')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tabungan'>";
    } else {
      echo "<script>alert('Simpan Gagal')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tabungan'>";
    }
      
}

function updateTabungan()
{
  global $con;

  $sql_ubah = "UPDATE tabungan SET
        id_nasabah='" . $_POST['id_nasabah'] . "',
        jumlah_tabungan='" . $_POST['saldo'] . "'
        WHERE id_tabungan='" . $_POST['id_tabungan'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tabungan'>";
  } else {
    echo "<script>alert('Ubah Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tabungan'>";
  }
}

function deleteTabungan($id)
{
  global $con;

  $sql_hapus = "DELETE FROM tabungan WHERE id_tabungan='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);

  if ($query_hapus) {
    echo "<script>alert('Hapus Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tabungan''>";
  } else {
    echo "<script>alert('Hapus Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tabungan''>";
  }
}

function getTarik()
{
  global $con;
  // $sql = "SELECT a.*, b.jumlah_tabungan, c.* FROM penarikan a, tabungan b, nasabah c WHERE a.id_tabungan=b.id_tabungan AND b.id_nasabah=c.id_nasabah ORDER BY a.tanggal DESC";
  $sql = "SELECT * FROM penarikan a, nasabah b WHERE a.id_nasabah=b.id_nasabah ORDER BY a.tanggal DESC";
  $query = mysqli_query($con, $sql);
  return $query;
}
function insertTarik()
{
  global $con;
  
  $tgl = date('Y-m-d H:i:s');
  $nasabah = $_POST['id_nasabah'];
  $penarikan = $_POST['penarikan'];

  $cek = "SELECT a.id_tabungan, a.jumlah_tabungan FROM tabungan a, nasabah b WHERE a.id_nasabah=b.id_nasabah AND a.id_nasabah = '$nasabah'";
  $query = mysqli_query($con, $cek);
  $rows = mysqli_fetch_row($query);
  $id_tabungan = $rows[0];
  // $tabungan = $rows[1];
  
  // $saldo_akhir = $tabungan - $penarikan;

  // $sql_ubah = "UPDATE tabungan SET
  //       jumlah_tabungan='" . $saldo_akhir . "'
  //       WHERE id_tabungan='" . $id_tabungan . "'";
  // $query_ubah = mysqli_query($con, $sql_ubah);

  $sql_insert = "INSERT INTO penarikan (id_nasabah, jumlah, saldo_akhir, tanggal) VALUES (
    '" . $nasabah . "',
    '" . $_POST['penarikan'] . "',
    '" . $_POST['saldo'] . "',
    '" . $tgl . "')";

  $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

    if ($query_insert) {
      echo "<script>alert('Penarikan Berhasil')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tarik'>";
    } else {
      echo "<script>alert('Penarikan Gagal')</script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tarik'>";
    }
}

function updateTarik()
{
  global $con;
  $tgl = date('Y-m-d H:i:s');

  // $id = $_POST['id_penarikan'];
  // $penarikan = $_POST['penarikan'];

  // $cek_tarik = "SELECT jumlah FROM penarikan WHERE id_penarikan = '$id'";
  // $query = mysqli_query($con, $cek_tarik);
  // $row = mysqli_fetch_row($query);
  // $jumlah_tarik = $row[0];
  // if($jumlah_tarik != $penarikan){}
  $sql_ubah = "UPDATE penarikan SET
        jumlah ='" . $_POST['penarikan'] . "',
        tangal='" . $tgl . "'
        WHERE id_penarikan='" . $_POST['id_penarikan'] . "'";
  $query_ubah = mysqli_query($con, $sql_ubah);

  if ($query_ubah) {
    echo "<script>alert('Ubah Penarikan Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tarik'>";
  } else {
    echo "<script>alert('Ubah Penarikan Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tarik'>";
  }
}

function deleteTarik($id)
{
  global $con;

  $sql_hapus = "DELETE FROM penarikan WHERE id_penarikan='$id' ";
  $query_hapus = mysqli_query($con, $sql_hapus);

  if ($query_hapus) {
    echo "<script>alert('Hapus Penarikan Berhasil')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tarik''>";
  } else {
    echo "<script>alert('Hapus Penarikan Gagal')</script>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?pages=tarik''>";
  }
}

function getPenjualan()
  {
    global $con;
    $sql = "SELECT * FROM penjualan a, nasabah b WHERE a.id_nasabah=b.id_nasabah";
    $query = mysqli_query($con, $sql);
    return $query;
  }
  

function getSaldo($id)
{
  global $con;
  $sql = "SELECT * FROM penarikan a, tabungan b, nasabah c WHERE a.id_nasabah=c.id_nasabah AND b.id_nasabah=c.id_nasabah AND c.id_nasabah='$id' GROUP BY a.id_penarikan";
  $query = mysqli_query($con, $sql);
  return $query;
}

function cekSaldo($id)
{
  global $con;

  $sql = "SELECT SUM(jumlah_tabungan) as jumlah_tabungan from tabungan where id_nasabah ='$id' GROUP BY id_nasabah";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_row($query);
  $tabungan = $row[0];

  $sql_tarik = "SELECT SUM(jumlah) FROM `penarikan` WHERE id_nasabah ='$id' GROUP BY id_nasabah";
  $query_tarik = mysqli_query($con, $sql_tarik);
  $rows = mysqli_fetch_row($query_tarik);
  $tarik = $rows[0];

  $result = $tabungan - $tarik;
  return $result;
}

function cekTarik($id){
  global $con;
  $sql_tarik = "SELECT SUM(jumlah) FROM `penarikan` WHERE id_nasabah ='$id' GROUP BY id_nasabah";
  $query_tarik = mysqli_query($con, $sql_tarik);
  // $rows = mysqli_fetch_row($query_tarik);
  // $tarik = $rows[0];
  return $query_tarik;
}

function getPembeli($id)
{
  global $con;
  $sql = "SELECT * FROM nasabah a, pembelian b, sampah c WHERE b.id_nasabah=a.id_nasabah AND b.id_sampah=c.id_sampah AND a.id_nasabah='$id' ORDER BY b.tgl_proses DESC";
  $query = mysqli_query($con, $sql);
  return $query;
}

function insertPenjualan()
  {
    global $con;
    $tgl = date('Y-m-d H:i:s');
    $tgls = date('Y-m-d');
    $nasabah = $_POST['id_nasabah'];
    $pembayaran = $_POST['total'];
    $metode = $_POST['pilihan'];

    if($metode == '1'){
      $cek_tabungan = "SELECT id_tabungan,jumlah_tabungan FROM tabungan WHERE id_nasabah = '$nasabah'";
      $query = mysqli_query($con, $cek_tabungan);
      $row = mysqli_fetch_row($query);
      $id_tabungan = $row[0];
      $jumlah_tabungan = $row[1];
      $saldo = $jumlah_tabungan - $pembayaran;
        if($jumlah_tabungan < $pembayaran){
          echo "<script>alert('Maaf saldo anda kurang, Silahkan ubah metode pembayaran')</script>";
        }else{
          $sql_ubah = "UPDATE tabungan SET
          jumlah_tabungan='" . $saldo . "'
          WHERE id_tabungan='" . $id_tabungan . "'";
          $query_ubah = mysqli_query($con, $sql_ubah);

          $sql_insert = "INSERT INTO penjualan (id_barang, id_nasabah, tanggal, jumlah, total, pembayaran, tgl_proses) VALUES (
            '" . $_POST['id_barang'] . "',
            '" . $_POST['id_nasabah'] . "',
            '$tgls',
            '" . $_POST['jumlah'] . "',
            '" . $_POST['total'] . "',
            '" . $_POST['pilihan'] . "',
            '" . $tgl . "')";
          $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());

            if ($query_insert && $query_ubah) {
              echo "<script>alert('Pembelian Berhasil')</script>";
              echo "<meta http-equiv='refresh' content='0; url=index.php?pages=saldo'>";
            } else {
              echo "<script>alert('Pembelian Gagal')</script>";
              echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk'>";
            }
        }
    }else{
      $sql_insert = "INSERT INTO penjualan (id_barang, id_nasabah, tanggal, jumlah, total, pembayaran, tgl_proses) VALUES (
        '" . $_POST['id_barang'] . "',
        '" . $_POST['id_nasabah'] . "',
        '$tgls',
        '" . $_POST['jumlah'] . "',
        '" . $_POST['total'] . "',
        '" . $_POST['pilihan'] . "',
        '" . $tgl . "')";
      $query_insert = mysqli_query($con, $sql_insert) or die(mysqli_connect_error());
  
        if ($query_insert) {
          echo "<script>alert('Pembelian Berhasil')</script>";
          echo "<meta http-equiv='refresh' content='0; url=index.php?pages=saldo'>";
        } else {
          echo "<script>alert('Pembelian Gagal')</script>";
          echo "<meta http-equiv='refresh' content='0; url=index.php?pages=produk'>";
        }
      }
    }

function getTerbeli($id)
  {
    global $con;
    $sql = "SELECT * FROM penjualan a, produk b WHERE a.id_barang=b.id_barang AND a.id_nasabah = '$id' ";
    $query = mysqli_query($con, $sql);
    return $query;
  }

function sendBroadcast()
{
  global $con;

  $query = mysqli_query($con, "SELECT tb.id_nasabah , ns.nama_nasabah, ns.no_hp, (sum(tb.jumlah_tabungan) - (SELECT sum(pn.jumlah) from penarikan pn, nasabah nsb where pn.id_nasabah = nsb.id_nasabah)) from nasabah ns, tabungan tb where tb.id_nasabah = ns.id_nasabah");

  while($x = mysqli_fetch_array($query)) {
    $ray = [
      'nama' => (string)$x[1],
      'no_hp' => (string)$x[2],
      'saldo' => (string)$x[3]
    ];

    $smsText = "Kepada Saudara $ray[nama] Nasabah Bank Sampah Mustika Melati, Minggu akhir bulan akan diadakan kegiatan. Mohon Kedatangan nya. Terimakasih";
    $sms = urlencode($smsText);
    // var_dump($sms);
    $url = 'https://websms.co.id/api/smsgateway?token=b42ee6e6e22ec64df97c11c59a20c915&to='.$ray['no_hp'].'&msg='.$sms.'';
  
    $header = array(
    'Accept: application/json',
    );
  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($ch);
  
    echo $result;
  }

}
// function uploadBerkas($namePost, $nmLoker)
// {
//   $name = $_SESSION["ses_nama"];
//   $namaPengirim = str_replace(' ', '_', $name);
//   $namaLowongan = str_replace(' ', '_', $nmLoker);
  
//   $date = date('Y-m-d');
//   $ekstensi_diperbolehkan  = array('jpg', 'png', 'jpeg', 'pdf');
//   $nama = $_FILES[$namePost]['name'];
  
//   $x = explode('.', $nama);
//   $ekstensi = strtolower(end($x));
//   $namas = 'Daftar_' . $namaLowongan . "_" . $namaPengirim . "_" . $date ."." . $ekstensi;
//   $ukuran  = $_FILES[$namePost]['size'];
//   $file_tmp = $_FILES[$namePost]['tmp_name'];
  

//   if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
//     if ($ukuran < 41943040) {
//       $destination_path = getcwd().DIRECTORY_SEPARATOR . 'file_data\pendaftaran' . '/';

//       $target_path = $destination_path . $namas;

//       @move_uploaded_file($file_tmp, $target_path);
//       return $namas;
//     } else {
//       return;
//     }
//   } else {
//     return;
//   }
// }
