<?php
ini_set("session.auto_start", 0);
include_once("__DIR__ .  ../../../../koneksi.php");
include_once("__DIR__ .  ../../../../fpdf/fpdf.php");

if (isset($_POST['submit'])) {
  $a = $_POST['tgl_awal'];
  $b = $_POST['tgl_akhir'];
}
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,2,2,2);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->ln(1);
$pdf->SetFont('Helvetica','B',14);
$pdf->Image('logo.png', 14, 1, 2, 'C');
$pdf->Cell(25.5,0.7,"Laporan Transaksi Pembelian",0,10,'C');
$pdf->Cell(25.5,0.7,"Bank Sampah Mustika Melati",0,10,'C');
$pdf->Cell(25,0.7,"Ds. Getas Pejaten Kecamatan Jati Kabupaten Kudus",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Printed On : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
//Tidak berpengaruh dengan database hanya sebagai keterangan pada tabel nantinya
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Sampah', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Nasabah', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Berat', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Total', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Tanggal', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
if($a == NULL && $b == NULL){
$query=mysqli_query($con,"SELECT a.*, b.nama_sampah, c.* FROM pembelian a, sampah b, nasabah c WHERE a.id_sampah=b.id_sampah AND a.id_nasabah=c.id_nasabah ORDER BY a.tanggal DESC");
}else{
$query=mysqli_query($con,"SELECT a.*, b.nama_sampah, c.* FROM pembelian a, sampah b, nasabah c WHERE a.id_sampah=b.id_sampah AND a.id_nasabah=c.id_nasabah AND a.tanggal BETWEEN '$a' AND '$b' ORDER BY a.tanggal DESC");
}
while($lihat=mysqli_fetch_array($query)){
$pdf->Cell(1, 0.8, $no, 1, 0, 'L');
$pdf->Cell(6, 0.8, $lihat['nama_sampah'], 1, 0,'L');
$pdf->Cell(6, 0.8, $lihat['nama_nasabah'], 1, 0,'L');
$pdf->Cell(3, 0.8, $lihat['berat'],1, 0, 'R');
$pdf->Cell(5, 0.8, "Rp. " . $lihat['total'], 1, 0,'R');
$pdf->Cell(5, 0.8, date('d-m-Y', strtotime($lihat['tanggal'])),1, 1, 'L');

$no++;
}
$pdf->ln(1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(40.5,0.7,"Mengetahui,",0,10,'C');

$pdf->ln(1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40.5,0.7,"Ketua Bank Sampah",0,10,'C');
//Nama file ketika di print
$pdf->Output("Laporan Transaksi.pdf","I");
?>