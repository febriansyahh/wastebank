<?php
ini_set("session.auto_start", 0);
include_once("__DIR__ .  ../../../../koneksi.php");
include_once("__DIR__ .  ../../../../fpdf/fpdf.php");

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(2,2,2,2);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->ln(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Image('logo.png', 10, 1, 2, 'C');
$pdf->Cell(18,0.7,"Laporan Data Nasabah",0,10,'C');
$pdf->Cell(18,0.7,"BANK SAMPAH",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Printed On : ".date("D-d/M/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
//Tidak berpengaruh dengan database hanya sebagai keterangan pada tabel nantinya
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Nasabah', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Alamat Nasabah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tgl. Terdaftar', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($con,"SELECT * FROM nasabah a, user b WHERE a.id_nasabah=b.id_daftar ORDER BY b.tgl_daftar ASC");
while($lihat=mysqli_fetch_array($query)){
$pdf->Cell(1, 0.8, $no, 1, 0, 'L');
$pdf->Cell(5, 0.8, $lihat['nama_nasabah'], 1, 0,'L');
$pdf->Cell(7, 0.8, $lihat['alamat'], 1, 0,'L');
$pdf->Cell(4, 0.8, date('d-m-Y', strtotime($lihat['tgl_daftar'])), 1, 1,'L');

$no++;
}
$date = date('d-m-Y');
$pdf->ln(1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(28,0.7,"Mengetahui,",0,10,'C');

$pdf->ln(1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(28,0.7,"Ketua Bank Sampah",0,10,'C');
//Nama file ketika di print
$pdf->Output("Laporan Nasabah". $date .".pdf","I");
?>