<?php	
include_once("koneksi.php");
$maxID = MaxIdProgram();
error_reporting();
error_reporting (E_ALL ^ E_NOTICE); 
    ?>
    <div class="form-group">
      <br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pembelian Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                            <th>No</th>
                            <th>Tgl. Pembelian</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Metode</th>
                            <th>Pembayaran</th>
                          </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getTerbeli($data_id);
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d M Y', strtotime($data['tanggal'])); ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td><?php echo $data['jumlah']; ?></td>
                      <?php 
                      if($data['pembayaran'] == '1'){
                        ?>
                          <td><a href="#" class="btn btn-primary btn-sm">Potong Tabungan</a></td>
                      <?php
                      }else{
                      ?>
                          <td><a href="#" class="btn btn-success btn-sm">Tunai</a></td>
                      <?php
                      }
                      ?>
                    <td>Rp. <?php echo $data['total']; ?></td>
                  </tr>
                  <?php
                  $no++;
                  }
              ?>
                      </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

</body>



</html>