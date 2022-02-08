$(document).ready(function () {
  $('#selek2').select2();
  $('.timepicker').wickedpicker(options);
  Datatables();
  setInterval(timestamp, 1000);
  time24hour();
});

$(document).ready( function () {
  $('#myTable').DataTable();
} );

$(function Datatables() {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


  $("#example2").DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

  $("#example3").DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

  $("#nasabah").DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "columns" : [
      { width: "10%" }, { width: "25%" }, { width: "20%" }, { width: "25%" }, { width: "20%" }
    ],
  });

  $("#produk").DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "columns" : [
      { width: "5%" }, 
      { width: "15%" }, 
      { width: "20%" }, 
      { width: "15%" }, 
      { width: "25%" },
      { width: "15%" },
      { width: "5%" },
    ],
  });

});

function editableNasabah(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editNama").val(exp[1]);
  $("#editAlamat").val(exp[2]);
}

function editableHasil(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editidHasil").val(exp[0]);
  $("#editidLok").val(exp[1]);
  $("#editperusahaan").val(exp[2]);
  $("#editberkas").val(exp[3]);
  $("#editketerangan").val(exp[4]);
}

function editableJenis(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editNm").val(exp[1]);
}

function editCek(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editIdBrg").val(exp[0]);
  $("#editKodeBrg").val(exp[1]);
  $("#editNamaBrg").val(exp[2]);
  $("#editHargaBrg").val(exp[3]);
}

function editableSampah(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editKode").val(exp[1]);
  $("#editNama").val(exp[2]);
  $("#editJenis").val(exp[3]);
  $("#editHarga").val(exp[4]);
}

function editablePembelian(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editIdSampah").val(exp[1]);
  $("#editIdNasabah").val(exp[2]);
  $("#editNama").val(exp[3]);
  $("#editTanggal").val(exp[4]);
  $("#editBerat").val(exp[5]);
  $("#editTotal").val(exp[6]);
  $("#editPilihan").val(exp[7]);
}

function editableProduk(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editKode").val(exp[1]);
  $("#editNama").val(exp[2]);
  $("#editHarga").val(exp[3]);
  $("#editKeterangan").val(exp[4]);
  $("#editGambar").val(exp[5]);
}

function editableTabungan(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editIdNasabah").val(exp[1]);
  $("#editNama").val(exp[2]);
  $("#editJumlah").val(exp[3]);
  // $("#editHarga").val(exp[4]);
}

function editableGroup(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editNm").val(exp[1]);
  $("#editKet").val(exp[2]);
}

function editableUser(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  $("#editId").val(exp[0]);
  $("#editNm").val(exp[1]);
  $("#editUsername").val(exp[2]);
  $("#editPassword").val(exp[3]);
  $("#editLevel").val(exp[4]);
  $("#editStatus").val(exp[6]);
}

function daftarLoker(param) {
  let data = $(param).data("id");
  let exp = data.split("~");
  console.log(data);
  console.log(exp[0]);
  console.log('BBB');
  $("#valId").val(exp[0]);
  $("#valnoLok").val(exp[1]);
  $("#valperusahaan").val(exp[2]);
  $("#valnmLoker").val(exp[3]);
}

function getNisn() {
  let kd = $("#postNisn").val();
  let splits = kd[1];
  console.log(splits);
  die();
  console.log(document.getElementById("namaAgenda"));
  
  $('#namaAgenda').val(splits[1]);
}

function getUserName(){
function getUserName(id){
  console.log(id.value);

  die();
  $('#namaAlumni').val(id.value);
  }
}