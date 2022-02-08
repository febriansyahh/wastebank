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
                class="fas fa-plus-square"></i> Beli Sampah</a>
            <h3 class="card-title">Data Pembelian Sampah</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <center>
                  <tr>
                    <th>No</th>
                    <th>Kode Sampah</th>
                    <th>Nama Sampah</th>
                    <th>Nasabah </th>
                    <th>Tgl Pembelian </th>
                    <th>Berat</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Pilihan</th>
                  </tr>
                </center>
              </thead>
              <tbody>
                <?php
            $a = getPembelian();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['kode_sampah']; ?></td>
                  <td><?php echo $data['nama_sampah']; ?></td>
                  <td><?php echo $data['nama_nasabah']; ?></td>
                  <td><?php echo $data['tanggal']; ?></td>
                  <td><?php echo $data['berat']; ?></td>
                  <td><?php echo $data['total']; ?></td>
                  <?php
                      if ($data['pilihan'] == '1') {
                      ?>
                  <td><a href="#" class="btn btn-primary btn-sm">Masuk Tabungan</a></td>
                  <?php
                      }else{
                      ?>
                  <td><a href="#" class="btn btn-success btn-sm">Tunai</a></td>
                  <?php
                      }
                      ?>
                  <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editPerusahaan"
                      onclick="editablePembelian(this)"
                      data-id="<?php echo $data['id_pembelian'] . "~" . $data['id_sampah'] . "~" . $data['id_nasabah'] . "~" . $data['nama_nasabah'] . "~" . $data['tanggal'] . "~" . $data['berat'] . "~" . $data['total'] . "~" . $data['pilihan']   ?>"
                      class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="?pages=pembelian_aksi&kode=<?php echo $data['id_pembelian']; ?>"
                      onclick="return confirm('Apakah anda yakin hapus data ini ?')" class='btn btn-danger btn-sm'><i
                        class="fa fa-trash"></i></a>
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
          <label>Tambah Data Pembelian</label>
        </div>
        <div class="modal-body">
          <form action="?pages=pembelian_aksi" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-6">
                <label>Kode Sampah </label>
                <select name="id_sampah" class="form-control" onchange="showTotal(this.value)">
                  <option value=" ">-Pilih-</option>
                  <?php
                  $dt = getSelectSampah();
                  foreach ($dt as $value) {
                    echo '<option value="'.$value['id_sampah'].'">'.$value['kode_sampah'].' - '.$value['nama_sampah'].'</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="col-6">
                <label>Harga Sampah </label>
                <input class="form-control" type="text" name="total" id="total" required readonly>
              </div>
            </div>
              <div class="row">
                <div class="col-6">
                  <label>Nasabah </label>
                  <select name="id_nasabah" class="form-control">
                    <option value=" ">-Pilih-</option>
                    <?php
                  $dt = getNasabah();
                  foreach ($dt as $value) {
                    echo '<option value="'.$value['id_nasabah'].'">'.$value['nama_nasabah'].'</option>';
                  }
                  ?>
                  </select>
                </div>
              <div class="col-6">
                <label>Tanggal </label>
                <input type="date" class="form-control" name="tanggal" required>
              </div>

            </div>
            <div class="row">
              <div class="col-6">
                <label>Berat / Kg</label>
                <input type="text" class="form-control" name="berat" id="berat" onkeyup="sum()" required>
              </div>

              <div class="col-6">
                <label>Total Harga </label>
                <input class="form-control" type="text" name="harga" id="harga" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="">Masuk Tabungan / Tunai</label> 
              <select name="pilihan" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="1">Masuk Tabungan</option>
                <option value="0">Tunai</option>
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
  </div>
</div>


<div class="modal" id="editPerusahaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="?pages=pembelian_aksi" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <p class="text-center"><b>Edit Data Pembelian</b></p>
          <hr>
          <div class="form-group">
                <label>Kode Sampah </label>
                <input type="hidden" name="id_pembelian" id="editId" class="form-control">
                <select name="id_sampah" class="form-control" id="editIdSampah" onchange="showTotal(this.value)">
                  <option value=" ">-Pilih-</option>
                  <?php
                  $dt = getSelectSampah();
                  foreach ($dt as $value) {
                    echo '<option value="'.$value['id_sampah'].'">'.$value['kode_sampah'].' - '.$value['nama_sampah'].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
              <div class="row">
                <div class="col-6">
                  <label>Nasabah </label>
                  <select name="id_nasabah" id="editIdNasabah" class="form-control" readonly>
                    <option value=" ">-Pilih-</option>
                    <?php
                  $dt = getNasabah();
                  foreach ($dt as $value) {
                    echo '<option value="'.$value['id_nasabah'].'">'.$value['nama_nasabah'].'</option>';
                  }
                  ?>
                  </select>
                </div>
              <div class="col-6">
                <label>Tanggal </label>
                <input type="date" class="form-control" name="tanggal" id="editTanggal" required>
              </div>

            </div>
            <div class="row">
              <div class="col-6">
                <label>Total Harga </label>
                <input class="form-control" type="text" name="harga" id="editTotal" required readonly>
              </div>

              <div class="col-6">
                <label for="">Masuk Tabungan / Tunai</label> 
                  <select name="pilihan" id="editPilihan" class="form-control">
                    <option value="">-Pilih-</option>
                    <option value="1">Masuk Tabungan</option>
                    <option value="0">Tunai</option>
                  </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="">Masuk Tabungan / Tunai</label> 
              <select name="pilihan" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="1">Masuk Tabungan</option>
                <option value="0">Tunai</option>
              </select>
            </div> -->
          <div class="modal-footer">
            <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>

</html>

<script>
  function showTotal(str) {
    console.log(str);
    var berat = document.getElementById('berat').value;
    // console.log(berat);
    if (str == "") {
      document.getElementById("total").innerHTML = "";
      return;
    }
    const xhtp = new XMLHttpRequest();
    xhtp.onload = function () {
      document.getElementById("total").value = this.responseText;
    }
    xhtp.open("GET", "./pages/master/get_harga.php?q=" + str);
    xhtp.send();
  }

  function sum() {
    var berat = document.getElementById('berat').value;
    var harga = document.getElementById('total').value;
    var hasil = parseInt(harga) * parseInt(berat);
    console.log(berat);
    console.log(harga);
    console.log(hasil);
    if (!isNaN(berat) && !isNaN(harga)) {
      document.getElementById('harga').value = hasil;
    }

  }

</script>
