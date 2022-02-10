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
              <a data-toggle="modal" data-target="#jurusan" class="btn btn-primary d-inline" style="float : right;"><i
                  class="fas fa-plus-square"></i> Tambah Data Sampah</a>
                <h3 class="card-title">Data Sampah</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Sampah</th>
                            <th>Jenis Sampah </th>
                            <!-- <th>Pemilahan </th> -->
                            <th>Harga/kg</th>
                            <th>Pilihan</th>
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
                          <!-- <?php
                          if ($data['id_jenis'] == '1') {
                          ?>
                          <td>Produk Daur Ulang</td>
                          <?php
                          }else{
                          ?>
                          <td>Produk Tidak Daur Ulang</td>
                          <?php
                          }
                          ?> -->
                          <td><?php echo $data['harga']; ?></td>
                          <td>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editPerusahaan" onclick="editableSampah(this)" data-id="<?php echo $data['id_sampah'] . "~" . $data['kode_sampah'] . "~" . $data['nama_sampah'] . "~" . $data['id_jenis'] . "~" . $data['harga']  ?>"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?pages=sampah_aksi&kode=<?php echo $data['id_sampah']; ?>"
                              onclick="return confirm('Apakah anda yakin hapus data ini ?')"
                              class='btn btn-danger btn-sm'><i class="fa fa-trash"></i></a>
                          </td>
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
<div id="jurusan" class="modal fade">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <label>Tambah Data Sampah</label>
      </div>
      <div class="modal-body">
        <form action="?pages=sampah_aksi" method="post" enctype="multipart/form-data">
      <div class="row" >
        <div class="col-6">
        <label>Kode Sampah </label>
        <input class="form-control" type="text" name="kode" value="<?php echo $maxID ?>" readonly>
      </div>

      <div class="col-6">
        <label>Nama Sampah </label>
        <input class="form-control" type="text" name="nama" required>
      </div>
        
      </div>
      <div class="row">
          
          <div class="col-6">
            <label>Jenis Sampah </label>
              <select name="jenis" id="" class="form-control">
                <option value=" ">-Pilih-</option>
                <?php
                  $dt = getJenis();
                  foreach ($dt as $value) {
                    echo '<option value="'.$value['id_jenis'].'">'.$value['jenis_sampah'].'</option>';
                  }
                  ?>
              </select>
          </div>

          <div class="col-6">
            <label>Harga Sampah / Kg </label>
            <input class="form-control" type="text" name="harga" required>
          </div>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input class="btn btn-success" type="submit" name="btnSimpan" value="Simpan" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal" id="editPerusahaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form action="?pages=sampah_aksi" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <p class="text-center"><b>Edit Data Sampah</b></p>
          <hr>
          <div class="form-group">
        <label>Nama Sampah </label>
        <input class="form-control" type="hidden" name="id_sampah" id="editId">
        <input class="form-control" type="text" name="nama" id="editNama">
      </div>
        <div class="row" >
          <div class="col-6">
            <label>Jenis Sampah </label>
            <select name="jenis" id="editJenis" class="form-control">
            <option value="">-Pilih-</option>
                <?php
                  $dt = getJenis();
                  foreach ($dt as $value) {
                    echo '<option value="'.$value['id_jenis'].'">'.$value['jenis_sampah'].'</option>';
                  }
                  ?>
            </select>
          </div>
          <div class="col-6">
            <label>Harga </label>
            <input class="form-control" type="text" name="harga" id="editHarga">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

</html>