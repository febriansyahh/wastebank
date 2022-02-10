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
                <h3 class="card-title">Transaksi Penarikan Saldo Nasabah</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                $cek = cekSaldo($data_id);
                $ceks = cekTarik($data_id);
                while($row = mysqli_fetch_array($cek)){
                  if($row[0] == NULL){
                    ?>
                    <h5 style="font-family: Poppins">Saldo Anda Rp. - </h5>
                    <?php
                  }else{
                    while($tarik = mysqli_fetch_array($ceks)){
                      if($tarik[0] == NULL){
                      ?>
                      <h5 style="font-family: Poppins">Saldo Anda Rp. <?php echo $row[0] ?> </h5>
                      <?php
                      }else{
                      ?>
                      <h5 style="font-family: Poppins">Saldo Anda Rp. <?php echo $row[0] - $tarik[0]?> </h5>
                      <?php
                      }
                      }
                      ?>
                    <?php
                    }
                  }
                    ?>
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                            <th>No</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                          </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getSaldo($data_id);
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td>Rp. <?php echo $data['jumlah']; ?></td>
                          <td><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                          <!-- <td>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editPerusahaan" onclick="editableSampah(this)" data-id="<?php echo $data['id_sampah'] . "~" . $data['kode_sampah'] . "~" . $data['nama_sampah'] . "~" . $data['id_jenis'] . "~" . $data['harga']  ?>"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?pages=sampah_aksi&kode=<?php echo $data['idSampah']; ?>"
                              onclick="return confirm('Apakah anda yakin hapus data ini ?')"
                              class='btn btn-danger btn-sm'><i class="fa fa-trash"></i></a>
                          </td> -->
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