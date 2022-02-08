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
                <h3 class="card-title">Data User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Terdaftar</th>
                            <th>Status</th>
                            <th>Piihan</th>
                          </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = selectUser();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $data['nama_user']; ?></td>
                          <td><?php echo $data['username']; ?></td>
                          <td><?php echo date('d-m-Y', strtotime($data['tgl_daftar'])); ?></td>
                          <?php
                          if ($data['status'] == '1') {
                          ?>
                          <td><a href="#" class="btn btn-primary btn-sm">Aktif</a></td>
                          <?php
                          }else{
                          ?>
                          <td><a href="#" class="btn btn-warning btn-sm">Tidak Aktif</a></td>
                          <?php
                          }
                          ?>
                          <td>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editSiswa" onclick="editableUser(this)" data-id="<?php echo $data['id_user'] . "~" . $data['nama_user'] . "~" . $data['username'] . "~" . $data['password'] . "~" . $data['idLevel'] . "~" . $data['nmGroup'] . "~" . $data['status'] ?>"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?pages=user_aksi&kode=<?php echo $data['id_user']; ?>"
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
<!-- <div id="user" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p class="modal-title">Tambah Data User</p>
      </div>
      <div class="modal-body">
        <form action="?pages=userAksi" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label>Nama Pengguna </label>
            <input class="form-control" type="text" name="nmUser" placeholder="Masukkan nama pengguna" required>
          </div>

          <div class="form-group">
            <label>Username </label>
            <input class="form-control" type="text" name="username" placeholder="Masukkan username" required>
          </div>
          
          <div class="form-group">
            <label>Password </label>
            <input class="form-control" type="password" name="password" placeholder="Masukkan password" required>
          </div>

          <div class="form-group">
            <label>Ulangi Password </label>
            <input class="form-control" type="password" name="rePassword" placeholder="Masukkan ulang password" required>
          </div>

          <div class="form-group">
            <label>Level Pengguna </label>
            <select name="idGroup" class="form-control" required>
              <option value="">- Pilih -</option>
              <option value="1">Admin</option>
              <option value="3">Ketua BKK</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input class="btn btn-success" type="submit" name="btnSimpan" value="Simpan" />
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>  -->


<div class="modal fade" id="editSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog pt-5" role="document">
    <div class="modal-content">
    <form action="?pages=user_aksi" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label class="text-center"><b>Edit User Pengguna</b></label>
          <hr>
          <div class="form-group">
            <label for=""><b>Nama Pengguna </b></label>
            <input class="form-control" type="hidden" id="editId" name="id_user">
            <input class="form-control" type="text" id="editNm" name="nama">
          </div>
          <div class="form-group">
            <label for=""><b>Username </b></label>
            <input type="text" name="username" id="editUsername" class="form-control">
          </div>
          <div class="form-group">
            <label for=""><b>Password </b></label>
            <input type="text" name="password" id="editPassword" class="form-control">
          </div>
          <div class="form-group">
            <label for=""><b>Status User </b></label>
            <select name="status" id="editStatus" class="form-control">
              <option value="">Pilih</option>
              <option value="1">Aktif</option>
              <option value="0">Nonaktif</option>
            </select>
          </div>
        <div class="modal-footer">
          <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

</html>