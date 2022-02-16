<?php	
	 include_once("koneksi.php");
    ?>

<div class="form-group">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h3 style="font-family: Poppins">
      Beranda
    </h3>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <?php
        switch ($data_status) {
          case '1':
            ?>
      <div class="row">
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php // menghitung
                    $sql_hitung = "SELECT COUNT(a.id_nasabah) from nasabah a, user b where b.id_daftar=a.id_nasabah AND b.status ='1'";
                    $q_hit= mysqli_query($con, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]."";
                    }
                    ?></h3>

              <p>Nasabah Aktif</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-alt"></i>
            </div>
            <a href="?pages=nasabah" class="small-box-footer">Lihat selengkapnya <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php
                    $sql_hitung = "SELECT COUNT(id_sampah) from sampah";
                    $q_hit= mysqli_query($con, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]."";
                    }
                    ?></h3>

              <p>Sampah Terdaftar</p>
            </div>
            <div class="icon">
              <i class="fas fa-trash-restore-alt"></i>
            </div>
            <a href="?pages=sampah" class="small-box-footer" style="color:white">Lihat selengkapnya <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php
                    $sql_hitung = "SELECT COUNT(id_barang) from produk";
                    $q_hit= mysqli_query($con, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]."";
                    }
                    ?></h3>
              <p>Produk Daur Ulang</p>
            </div>
            <div class="icon">
              <i class="fas fa-recycle"></i>
            </div>
            <a href="?pages=produk" class="small-box-footer">Lihat selengkapnya <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        
        <!-- <div class="col-lg-3 col-6">
          <div class="small-box" style="background-color: #9CDF51;">
            <div class="inner">
              <h3><?php
                    $sql_hitung = "SELECT COUNT(id_penjualan) from penjualan";
                    $q_hit= mysqli_query($con, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]."";
                    }
                    ?></h3>
              <p>Transaksi Penjualan</p>
            </div>
            <div class="icon">
              <i class="fas fa-wallet"></i>
            </div>
            <a href="?pages=penjualan" class="small-box-footer">Lihat selengkapnya <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
      </div>
      <?php
          break;
          default:
            ?>
      <?php
          break;
        }
          ?>
      <center>
      <div class="card" style="border-radius: 15px; box-shadow: 0 5px 5px 0 rgba(128, 123, 123, 0.43)">
        <div class="text-center my-5">
          <img src="images/logo.png" width="150" height="150"><br>
          <h3 class="display fw-bolder black-white mb-2" style="font-family: Poppins">Bank Sampah Mustika Melati
          </h3>
          <p class="lead text-black-50 mb-4" style="font-family: Poppins"><b>Jual, dan manfaatkan kembali sampah rumah tangga</b></p>
        </div>
      </div>
      </center>
    </div><!-- /.container-fluid -->
  </section>

</div>
