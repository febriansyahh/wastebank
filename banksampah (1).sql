-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 04:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banksampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sampah`
--

CREATE TABLE `jenis_sampah` (
  `id_jenis` int(11) NOT NULL,
  `jenis_sampah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_sampah`
--

INSERT INTO `jenis_sampah` (`id_jenis`, `jenis_sampah`) VALUES
(1, 'Sampah Organik'),
(2, 'Sampah Non Organik');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nama_nasabah` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nama_nasabah`, `alamat`, `no_hp`) VALUES
(1, 'Febrian', 'Golantepus', '088225270726'),
(2, 'higan', 'undaan', '0895396291491');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_sampah` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `berat` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `pilihan` int(11) NOT NULL,
  `tgl_proses` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `saldo_akhir` bigint(20) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `tgl_proses` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_barang`, `kode_barang`, `nama_barang`, `harga`, `gambar`, `keterangan`) VALUES
(1, 'PDU-2022-001', 'Kardus Sepatu 45', 2000, 'Produk_PDU-2022-001_2022-02-06.jpg', 'Kardus luar sepatu ketebalan 3mm');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id_sampah` int(11) NOT NULL,
  `kode_sampah` varchar(30) NOT NULL,
  `nama_sampah` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id_sampah`, `kode_sampah`, `nama_sampah`, `id_jenis`, `harga`) VALUES
(1, 'JNS-2022-001', 'Kardus Tebal', 1, 2200),
(2, 'JNS-2022-002', 'Kertas', 1, 1200),
(3, 'JNS-2022-003', 'Botol Plastik 100ml', 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `jumlah_tabungan` bigint(20) NOT NULL,
  `update_terakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto_user` varchar(100) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_daftar` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl_daftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `foto_user`, `id_level`, `id_daftar`, `status`, `tgl_daftar`) VALUES
(1, 'admin', 'admin', 'admin', '', 1, 0, 1, '2022-02-05 07:57:21'),
(2, 'Febrian', 'febrian', '123', '', 2, 1, 1, '2022-02-05 08:17:22'),
(3, 'higan', 'higan', '123', '', 2, 2, 1, '2022-02-05 08:31:09'),
(4, 'yudhas', 'yudha', '123', 'Foto_yudha_2022-02-05.png', 2, 3, 1, '2022-02-05 12:32:42'),
(5, 'bayu', 'bayu', '123', 'Foto_bayu_2022-02-09.png', 2, 4, 1, '2022-02-09 02:14:29'),
(6, 'rais', 'rais', '123', 'Foto_rais_2022-02-09.png', 2, 5, 1, '2022-02-09 02:15:36'),
(7, 'ardi', 'ardi', '123', 'Img_ardi_2022-02-16.jpg', 2, 6, 1, '2022-02-16 07:35:39'),
(8, 'qwerty', 'qwerty', '123', 'Produk_qwerty_2022-02-16.jpg', 2, 7, 1, '2022-02-16 07:39:00'),
(9, 'imam', 'imam', '123', 'Produk_imam_2022-02-16.png', 2, 8, 1, '2022-02-16 07:40:13'),
(10, 'rais', 'rais', '123', 'Fotorais_2022-02-16.png', 2, 9, 1, '2022-02-16 08:03:31'),
(11, 'rias', 'rias', '123', 'Foto_rias_2022-02-16.png', 2, 10, 1, '2022-02-16 08:11:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_sampah` (`id_sampah`),
  ADD KEY `pembelian_ibfk_2` (`id_nasabah`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`),
  ADD KEY `id_tabungan` (`id_nasabah`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_nasabah` (`id_nasabah`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id_sampah`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`),
  ADD KEY `tabungan_ibfk_1` (`id_nasabah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id_sampah`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`);

--
-- Constraints for table `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `sampah_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_sampah` (`id_jenis`);

--
-- Constraints for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
