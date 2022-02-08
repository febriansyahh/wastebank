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
              <a data-toggle="modal" data-target="#jurusan" class="btn btn-primary d-inline" style="float : right;"><i
                  class="fas fa-plus-square"></i> Tambah Jenis</a>
                <h3 class="card-title">Data Jenis</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                            <th>No</th>
                            <th>Jenis Sampah</th>
                            <th>Piihan</th>
                          </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getJenis();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $data['jenis_sampah']; ?></td>
                          <td>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editSiswa" onclick="editableJenis(this)" data-id="<?php echo $data['id_jenis'] . "~" . $data['jenis_sampah']  ?>"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?pages=jenis_aksi&kode=<?php echo $data['id_jenis']; ?>"
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title" style="font-family : Poppins">Tambah Jenis Sampah</h5>
      </div>
      <div class="modal-body">
        <form action="?pages=jenis_aksi" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label>Jenis Sampah </label>
            <input class="form-control" type="text" name="jenis" required>
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


<div class="modal fade" id="editSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog pt-5" role="document">
    <div class="modal-content">
    <form action="?pages=jenis_aksi" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <h4 class="text-center"><b>Edit Jenis Sampah</b></h4>
          <hr>
          <div class="form-group">
            <label for=""><b>Jenis Sampah </b></label>
            <input class="form-control" type="hidden" id="editId"  name="id_jenis">
            <input class="form-control" type="text" id="editNm"  name="jenis">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

</html>