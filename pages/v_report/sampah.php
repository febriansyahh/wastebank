<?php	
include_once("koneksi.php");
    ?>
          <div class="form-group">
            <br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <!-- <a data-toggle="modal" data-target="#user" class="btn btn-primary d-inline" style="float : right;"><i
                  class="fas fa-plus-square"></i> Tambah User</a> -->
                
                  <h3 class="card-title">Data Sampah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <a href="./pages/laporan/sampah.php" class="btn btn-primary" style="border-radius : 8px" target="_blank">Cetak Laporan</a>
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                          <th>No</th>
                          <th>Kode Sampah</th>
                          <th>Nama Sampah</th>
                          <th>Jenis Sampah</th>
                          <th>Harga</th>
                          </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getsampah();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['kode_sampah']; ?></td>
                  <td><?php echo $data['nama_sampah']; ?></td>
                  <td><?php echo $data['jenis_sampah']; ?></td>
                  <td><?php echo $data['harga']; ?></td>
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