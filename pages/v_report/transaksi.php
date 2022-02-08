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
                
                  <h3 class="card-title">Data Transaksi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
            <form method='POST' action='./pages/laporan/transaksi.php'>
              <label for=""> Pilih Tanggal : </label> <br><br>
              <div class="input-group mb-3">
              <input type="date" name="tgl_awal" style="width:12%;"> &nbsp; &nbsp;- &nbsp;&nbsp;<input type="date" name="tgl_akhir" style="width:12%;">
              &nbsp;
                <input type="submit" name="submit" formtarget="_blank" class="btn btn-primary"value="Cetak" />
              </div>
            </form>
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                          <th>No</th>
                          <th>Sampah</th>
                          <th>Nasabah</th>
                          <th>Berat</th>
                          <th>Total</th>
                          <th>Tanggal</th>
                        </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getReportTransaksi();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['nama_sampah']; ?></td>
                  <td><?php echo $data['nama_nasabah']; ?></td>
                  <td><?php echo $data['berat']; ?></td>
                  <td><?php echo $data['total']; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
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