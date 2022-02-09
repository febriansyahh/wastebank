<?php
session_start();
include_once("koneksi.php");
include_once("fpdf/fpdf.php");
if (isset($_SESSION['ses_username']) == "") {
  echo "<meta http-equiv='refresh' content='0;url=signin.php'>";
} else {
  $data_username = $_SESSION["ses_username"];
  $data_nama = $_SESSION["ses_nama"];
  $data_id = $_SESSION["ses_idDaftar"];
  $data_idUser = $_SESSION["ses_idUser"];
  $data_status = $_SESSION["ses_idLevel"];
}
// session_destroy();
error_reporting();
error_reporting (E_ALL ^ E_NOTICE); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bank Sampah</title>
  <link href="images/logo.png" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="chartjs/Chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/muh.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color:rgb(47, 107, 219)">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 text-black" style="background-color:rgb(47, 107, 219);">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-family : Poppins">Bank Sampah</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex text-black">
          <!-- <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div> -->
          <div class="info">
            <a href="#"><?php echo $data_nama ?> -
              <?php
                    switch ($data_status) {
                      case '1':
                        ?>
              <a href="#">Admin</a>
              <?php
                        break;
                      case '2':
                        ?>
              <a href="#">Nasabah</a>
              <?php
                        break;
                    }
                      ?>
            </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
        switch ($data_status) {
          case '1':
            ?>
            <li class="nav-item">
              <a href="?pages=beranda" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>
                  Beranda
                </p>
              </a>
            </li>
            <li class="nav-header">Master</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                  Data Sampah
                  <i class="fa fa-plus-circle right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?pages=jenis" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Jenis Sampah
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?pages=sampah" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    Data Sampah
                    </p>
                  </a>
                </li>
              </ul>
          </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                  Data Transaksi
                  <i class="fa fa-plus-circle right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?pages=pembelian" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Pembelian Sampah
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?pages=tabungan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    Tabungan Nasabah
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?pages=tarik" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    Tarik Tabungan
                    </p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="?pages=nasabah" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Data Nasabah</p>
            </a>
          </li>
            <li class="nav-header">Laporan</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                  Data Laporan
                  <i class="right fa fa-plus-circle"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?pages=report_nasabah" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Laporan Data Nasabah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?pages=report_sampah" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Laporan Data Sampah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?pages=report_transaksi" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Laporan Data Transaksi</p>
                  </a>
                </li>
                
              </ul>
            </li>

          <!-- <li class="nav-item">
            <a href="?pages=penjualan" class="nav-link">
              <i class="fa fa-shopping-basket nav-icon"></i>
              <p>Data Penjualan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?pages=produk" class="nav-link">
              <i class="fas fa-recycle nav-icon"></i>
              <p>Produk Daur Ulang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?pages=user" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p>Manajemen User</p>
            </a>
          </li> -->

            <li class="nav-header">Menu Lain</li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#logout"><i class="fas fa-door-open"></i>
                <span>Logout</span></a></li>
            </li>
            <?php
                break;
              case '2':
                ?>
            <li class="nav-item">
              <a href="?pages=beranda" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>
                  Beranda
                </p>
              </a>
            </li>
            <li class="nav-header">Menu</li>
            <li class="nav-item">
              <a href="?pages=saldo" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>
                  Info Saldo
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="?pages=produk" class="nav-link">
                <i class="fas fa-history nav-icon"></i>
                <p>Produk Daur Ulang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?pages=terbeli" class="nav-link">
                <i class="fas fa-shopping-cart nav-icon"></i>
                <p>
                  Riwayat Transaksi
                </p>
              </a>
            </li>
            <li class="nav-header">Menu Lain</li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#logout"><i class="fas fa-door-open"></i>
                <span>Logout</span></a></li>
            </a>
            </li>
            <?php
                    break;
        }
          ?>
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Menjadikan halaman web dinamis, 
                dengan menjadikan halaman lain yang dipanggil sebagai sebuah konten dari index.php-->
        <?php 
                    if(isset($_GET['pages'])){
                        $hal = $_GET['pages'];
                
                        switch ($hal) {
                            case 'beranda':
                                include "pages/dashboard.php";
                                break;
                            case 'jenis' :
                              include "pages/jenis/view.php";
                              break;
                            
                            case 'jenis_aksi' :
                              include "pages/jenis/aksi.php";
                              break;

                            case 'sampah' :
                              include "pages/sampah/view.php";
                              break;
                            
                            case 'sampah_aksi' :
                              include "pages/sampah/aksi.php";
                              break;

                            case 'nasabah' :
                              include "pages/nasabah/view.php";
                              break;
                            
                            case 'nasabah_aksi' :
                              include "pages/nasabah/aksi.php";
                              break;

                            case 'produk' :
                              include "pages/produk/view.php";
                              break;
                            
                            case 'produk_aksi' :
                              include "pages/produk/aksi.php";
                              break;
                              
                            case 'penjualan' :
                              include "pages/penjualan/view.php";
                              break;
                            
                            case 'penjualan_aksi' :
                              include "pages/penjualan/aksi.php";
                              break;

                            case 'pembelian' :
                              include "pages/master/pembelian.php";
                              break;
                            
                            case 'pembelian_aksi' :
                              include "pages/master/pem_aksi.php";
                              break;

                            case 'tabungan' :
                              include "pages/master/tabungan.php";
                              break;
                            
                            case 'tabungan_aksi' :
                              include "pages/master/tab_aksi.php";
                              break;
                              
                            case 'tarik' :
                              include "pages/master/tarik.php";
                              break;
                            
                            case 'tarik_aksi' :
                              include "pages/master/tarik_aksi.php";
                              break;

                            case 'saldo' :
                              include "pages/saldo/view.php";
                              break;

                            case 'terbeli' :
                              include "pages/produk/terbeli.php";
                              break;

                            case 'dibeli' :
                              include "pages/produk/dibeli.php";
                              break;

                            case 'user' :
                              include "pages/user/view.php";
                              break;
                            
                            case 'user_aksi' :
                              include "pages/user/aksi.php";
                              break;

                            case 'report_nasabah' :
                              include "pages/v_report/nasabah.php";
                              break;

                            case 'report_sampah' :
                              include "pages/v_report/sampah.php";
                              break;

                            case 'report_transaksi' :
                              include "pages/v_report/transaksi.php";
                              break;

                            // case 'report_transaksi' :
                            //   include "pages/v_report/coba.php";
                            //   break;

                            default:
                            echo "<center><h3 style='font-family: Poppins'> Maaf Laman yang anda tuju tidak tersedia !</h3></center>";
                                break;    
                        }
                    }else{
                        include "pages/dashboard.php";
                    }
                ?>
      </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- /.control-sidebar -->
  </div>
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih Log Out Jika ingin keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="signin.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)

  </script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html>
