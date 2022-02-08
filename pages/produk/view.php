<?php	
include_once("koneksi.php");
$maxID = MaxIdProduk();
error_reporting();
error_reporting (E_ALL ^ E_NOTICE); 
    ?>
<?php
    switch ($data_status) {
      case '1':
    ?>
<div class="form-group">
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a data-toggle="modal" data-target="#jurusan" class="btn btn-primary d-inline" style="float : right;"><i
                class="fas fa-plus-square"></i> Tambah Data Produk</a>
            <h3 class="card-title">Data Produk Daur Ulang</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="produk" class="table table-bordered table-hover">
              <thead>
                <center>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Harga </th>
                    <th>Gambar Barang</th>
                    <th>Keterangan</th>
                    <th>Pilihan</th>
                  </tr>
                </center>
              </thead>
              <tbody>
                <?php
            $a = getProduk();
            $no = 1;
            foreach ($a as $key => $data) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['kode_barang']; ?></td>
                  <td><?php echo $data['nama_barang']; ?></td>
                  <td><?php echo $data['harga']; ?></td>
                  <td>
                    <img src=<?php echo "./file_data/barang/". $data['gambar']; ?> style="width: 50%; height: 50%;"
                      alt="">
                  </td>
                  <td><?php echo $data['keterangan']; ?></td>
                  <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editPerusahaan"
                      onclick="editableProduk(this)"
                      data-id="<?php echo $data['id_barang'] . "~" . $data['kode_barang'] . "~" . $data['nama_barang'] . "~" . $data['harga'] . "~" . $data['keterangan'] . "~" . $data['gambar']  ?>"
                      class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="?pages=produk_aksi&kode=<?php echo $data['id_barang']; ?>"
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
  <?php
        break;
        case '2':
    ?>
  <div class="form-group">
    <br>
    <div class="container">
      <div class="row">
        <?php
          $dt = getProduk();
          foreach ($dt as $key => $data) {
            ?>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0"
          style="padding-top: 25px; padding-left: 10-px;" data-toggle="modal" data-target="#beli"
          data-id="<?php echo $data['id_barang'] . "~" . $data['kode_barang'] . "~" . $data['nama_barang'] ."~" . $data['harga'] ?>"
          onclick="editCek(this)" style="padding-top: 25px;">
          <div class="card" style="border-radius: 10px;">
            <div class="" style="padding-left: 7px;"><i class="fas fa-recycle"></i>
              <h5 class="title"><?php echo $data['kode_barang'] ."-". $data['nama_barang'] ?></h5><br>
              <center>
              <img src=<?php echo "./file_data/barang/". $data['gambar']; ?> style="width: 40%; height: 40%;"
                      alt=""><br>
              </center>
              <p class="description" style="text-align: justify; padding-right: 5px;">
                <?php echo $data['keterangan'] .". Harga produk ini, Rp. " .$data['harga']?></p>
            </div>
          </div>
        </div>
        <?php
              }
            ?>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

    </body>
    <?php
        break;
    }
  ?>
    <div id="jurusan" class="modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <label>Tambah Data Barang</label>
          </div>
          <div class="modal-body">
            <form action="?pages=produk_aksi" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-6">
                  <label>Kode Barang </label>
                  <input class="form-control" type="text" name="kode" value="<?php echo $maxID ?>" readonly>
                </div>

                <div class="col-6">
                  <label>Nama Barang </label>
                  <input class="form-control" type="text" name="nama" required>
                </div>

              </div>
              <div class="row">
                <div class="col-6">
                  <label>Harga Barang </label>
                  <input type="text" class="form-control" name="harga" required>
                </div>

                <div class="col-6">
                  <label>Gambar Barang </label>
                  <input class="form-control" type="file" name="gambar" required>
                </div>
              </div>
              <div class="form-group">
                <label for="">Keterangan Produk</label>
                <textarea name="keterangan" class="form-control" cols="30" rows="2"></textarea>
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
        <form action="?pages=produk_aksi" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <p class="text-center"><b>Edit Data Barang</b></p>
            <hr>
            <div class="form-group">
              <label>Nama Barang </label>
              <input class="form-control" type="hidden" name="id_barang" id="editId">
              <input class="form-control" type="hidden" name="kode" id="editKode">
              <input class="form-control" type="text" name="nama" id="editNama">
            </div>
            <div class="row">
              <div class="col-6">
                <label>Harga Barang </label>
                <input type="text" class="form-control" name="harga" id="editHarga">
              </div>
              <div class="col-6">
                <label>Gambar </label> <span>*) Pilih gambar untuk mengubah</span>
                <input type="file" class="form-control" name="gambar" id="editGambar">
              </div>
            </div>
            <div class="form-group">
              <label for="">Keterangan Produk</label><br>
              <textarea name="keterangan" id="editKeterangan" class="form-control" cols="30" rows="2"></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" name="btnUBAH" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="beli" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
  <div class="modal-dialog" style="font-family: Poppins">
    <div class="modal-content">
    <form action="?pages=dibeli" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <p class="text-center"><b>Beli Barang</b></p>
            <hr>
            <div class="row">
                <div class="col-6">
                  <label>Kode Barang </label>
                  <input class="form-control" type="hidden" name="id_barang" id="editIdBrg">
                  <input class="form-control" type="hidden" name="id_nasabah" value="<?php echo $data_id ?>" >
                  <input class="form-control" type="text" name="nama" id="editKodeBrg" readonly>
                </div>
                <div class="col-6">
                  <label>Nama Barang </label>
                  <input class="form-control" type="text" name="nama" id="editNamaBrg" readonly>
                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-6">
                <label>Harga Barang </label>
                <input type="text" class="form-control" name="harga" id="editHargaBrg" readonly>
              </div>
              <div class="col-6">
                <label>Jumlah </label>
                <input type="text" class="form-control" name="jumlah" id="jumlah" onkeyup="sum()">
              </div>
            </div>
          <div>
          <br>
          <div class="row">
            <div class="col-6">
              <label>Total Bayar </label>
                <input type="text" class="form-control" name="total" id="total" readonly>
              </div>
              <div class="col-6">
                <label for="">Pilihan Pembayaran</label>
                <select name="pilihan" id="" class="form-control">
                  <option value="">Pilih</option>
                  <option value="1">Potong Tabungan</option>
                  <option value="0">Tunai</option>
                </select>
              </div>
          </div>
            <div class="modal-footer">
              <button type="submit" name="btnBeli" class="btn btn-primary">Beli</button>
            </div>
        </form>
    </div>
  </div>
</div>

</html>
<script>
  function sum()
  {
    var harga = document.getElementById('editHargaBrg').value;
    var jumlah = document.getElementById('jumlah').value;

    var total = parseInt(harga) * parseInt(jumlah);
    console.log(harga);
    console.log(jumlah);
    console.log(total);

    if(!isNaN(harga) & !isNaN(jumlah)){
      document.getElementById('total').value = total;
    }
  }
</script>
