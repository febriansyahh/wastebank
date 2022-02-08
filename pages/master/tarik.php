<?php	
include_once("koneksi.php");
// error_reporting();
// error_reporting (E_ALL ^ E_NOTICE); 
    ?>
          <div class="form-group">
            <br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <a data-toggle="modal" data-target="#jurusan" class="btn btn-primary d-inline" style="float : right;"><i
                  class="fas fa-minus-square"></i> Tarik Tabungan</a>
                <h3 class="card-title">Data Penarikan Tabungan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <center>
                          <tr>
                            <th>No</th>
                            <th>Nama Nasabah</th>
                            <th>Alamat</th>
                            <th>Jumlah Penarikan</th>
                            <th>Saldo Akhir</th>
                            <th>Tgl. Transaksi</th>
                            <!-- <th>Pilihan</th> -->
                          </tr>
                        </center>
                  </thead>
                  <tbody>
                  <?php
            $a = getTarik();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $data['nama_nasabah']; ?></td>
                          <td><?php echo $data['alamat']; ?></td>
                          <td style="text-align: right;">Rp. <?php echo $data['jumlah']; ?></td>
                          <td style="text-align: right;">Rp. <?php echo $data['saldo_akhir']; ?></td>
                          <td><?php echo date('d-M-Y', strtotime($data['tanggal'])); ?></td>
                          <!-- <td>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editPerusahaan" onclick="editableTabungan(this)" data-id="<?php echo $data['id_penarikan'] . "~" . $data['id_tabungan'] . "~" . $data['nama_nasabah'] . "~" . $data['jumlah'] . "~" . $data['jumlah_tabungan']  ?>"  class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?pages=tarik_aksi&kode=<?php echo $data['id_penarikan']; ?>"
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
<div id="jurusan" class="modal fade">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <label>Penarikan Tabungan</label>
      </div>
      <div class="modal-body">
        <form action="?pages=tarik_aksi" method="post" enctype="multipart/form-data">
      <div class="row" >
        <div class="col-6">
        <label>Nasabah </label>
        <select name="id_nasabah" id="" class="form-control" onchange="showTabungan(this.value)" required>
          <option value="">- Pilih -</option>
          <?php
            $dt = getNasabah();
            foreach ($dt as $value) {
              echo '<option value="'.$value['id_nasabah'].'">'.$value['nama_nasabah'].'</option>';
            }
          ?>
        </select>
      </div>

      <div class="col-6">
        <label>Saldo </label>
        <input class="form-control" type="text" name="tabungan" id="tabungan" required readonly>
      </div>
        
      </div>
      <div class="row">
          <div class="col-6">
            <label>Jumlah Penarikan</label>
            <input type="text" class="form-control" name="penarikan" id="penarikan" onkeyup="sum()" required>
          </div>

          <div class="col-6">
            <label>Saldo Akhir</label>
            <input class="form-control" type="text" name="saldo" id="saldo" required readonly>
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <input class="btn btn-success" type="submit" name="btnSimpan" value="Tarik" />
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
    <form action="?pages=tarik_aksi" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <p class="text-center"><b>Edit Data Tabungan Nasabah</b></p>
          <hr>
        <div class="form-group">
            <label>Nama Nasabah </label>
            <input class="form-control" type="hidden" name="id_tabungan" id="editId" required>
            <input class="form-control" type="hidden" name="id_nasabah" id="editIdNasabah" required>
            <input class="form-control" type="text" name="nama" id="editNama" readonly>
        </div>
        <div class="form-group" >
            <label>Saldo Tabungan</label>
            <input type="text" class="form-control" name="saldo" id="editJumlah">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

</html>
<script>
  function showTabungan(str)
  {
    // console.log(str);
    // var tarik = document.getElementById('penarikan').value;
    if (str == "") {
      document.getElementById("tabungan").value="";
      return;
    }
    const xhtp = new XMLHttpRequest();
    xhtp.onload = function(){
      document.getElementById("tabungan").value = this.responseText;
    }
    xhtp.open("GET", "./pages/master/get_tabungan.php?h=" + str);
    xhtp.send();
  }
  function sum(){
    var tabungan = document.getElementById('tabungan').value;
    var tarik = document.getElementById('penarikan').value;
    var saldo = parseInt(tabungan) - parseInt(tarik);
    console.log(tabungan);
    console.log(tarik);
    console.log(saldo);

    if(!isNaN(tabungan) && !isNaN(tarik)){
      document.getElementById("saldo").value = saldo;
    }
  }
</script>