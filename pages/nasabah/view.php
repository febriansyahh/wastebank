<?php	
include_once("koneksi.php");
    ?>
<div class="form-group">
  <br>
  <div class="container-fluid">
    <a href="?pages=nasabah_aksi&&kirimBc" class="btn btn-primary"><i class="fas fa-bullhorn"> </i> Kirim Pesan SMS</a>
        <br>
        <br>
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <a data-toggle="modal" data-target="#jurusan" class="btn btn-primary d-inline" style="float : right;"><i
                  class="fas fa-plus-square"></i> Tambah Data Nasabah</a>
                <h3 class="card-title">Data Nasabah</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="nasabah" class="table table-bordered table-hover">
                <thead>
                        <center>
                        <tr>
                          <th>No</th>
                          <th>Nasabah</th>
                          <th>Alamat</th>
                          <th>No HP</th>
                          <th>Foto</th>
                          <th>Piihan</th>
                        </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getNasabahAll();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['nama_nasabah']; ?></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['no_hp']; ?></td>
                  <?php
                  if($data['foto_user'] != NULL){
                  ?>
                  <td>
                    <img src=<?php echo "./pages/file_data/foto/". $data['foto_user']; ?> style="width: 20%; height: 20%;"
                      alt="" class="center">
                  </td>
                  <?php
                  }else{
                  ?>
                  <td>
                    <img src= "./pages/file_data/foto/default.png" style="width: 20%; height: 20%;"
                      alt="" class="center">
                  </td>
                  <?php
                  }
                  ?>
                  <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editSiswa" onclick="editableNasabah(this)" data-id="<?php echo $data['id_nasabah'] . "~" . $data['nama_nasabah'] . "~" . $data['alamat'] ?>"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="?pages=nasabah_aksi&kode=<?php echo $data['id_nasabah']; ?>"
                      onclick="return confirm('Apakah anda yakin hapus data ini ?')"
                      class='btn btn-danger btn-sm'><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
            $no++;
            }
        ?>
    <!-- /.row -->
  </div>
  </body>
  


  <div id="jurusan" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title">Tambah Data Nasabah</h5>
      </div>
      <div class="modal-body">
        <form action="?pages=nasabah_aksi" method="post" enctype="multipart/form-data">
        <div class="form-group">
              <label>Nama Nasabah</label>
              <input class="form-control" type="text" name="nama" placeholder="Masukkan nama anda" required>
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <input class="form-control " type="text" name="alamat" placeholder="Masukkan alamat anda" required>
            </div>

            <div class="form-group">
              <label>Username</label>
              <input class="form-control " type="text" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control " type="password" name="password" placeholder="Masukkan Username" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input class="form-control " type="password" name="rePassword" placeholder="Masukkan Password" required>
                </div>
              </div>
            </div>
            <div class="form-group">
            <label>Foto Pengguna</label>
            <input class="form-control " type="file" name="fotoUser" required>
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
    <form action="?pages=nasabah_aksi" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <h4 class="text-center"><b>Edit Data Nasabah</b></h4>
          <hr>
          <div class="form-group">
          <label>Nama Nasabah</label>
          <input class="form-control" type="hidden" name="id_nasabah" id="editId" required> <br>
          <input class="form-control " type="text" name="nama" id="editNama" required>
          </div>
          <div class="form-group">
          <label>Alamat </label>
              <input class="form-control" type="text" name="alamat" id="editAlamat" required>
          </div>

        <div class="modal-footer">
          <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
  
  </html>
  <script src="js/main.js"></script>
