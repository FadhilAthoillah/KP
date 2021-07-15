-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 07:41 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbpemesanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
`id_pemesanan` int(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `total_belanja` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal_pemesanan`, `total_belanja`, `gambar`, `status`) VALUES
(1, '2021-06-07', 15000, 'ss1.jpg', ''),
(2, '2021-06-09', 27000, '', ''),
(3, '2021-06-09', 15000, '', ''),
(4, '2021-06-09', 37000, '', ''),
(5, '2021-06-10', 15000, 'ss1.jpg', ''),
(6, '2021-06-14', 67000, '', ''),
(7, '2021-06-14', 15000, 'ss1.jpg', ''),
(8, '2021-06-16', 32000, 'ss1.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_di_tempat`
--

CREATE TABLE IF NOT EXISTS `pemesanan_di_tempat` (
`id_pemesanan` int(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `total_belanja` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan_di_tempat`
--

INSERT INTO `pemesanan_di_tempat` (`id_pemesanan`, `tanggal_pemesanan`, `total_belanja`, `gambar`) VALUES
(7, '2021-06-14', 15000, ''),
(8, '2021-06-14', 52000, ''),
(9, '2021-06-14', 20000, ''),
(10, '2021-06-14', 20000, ''),
(11, '2021-06-16', 20000, '');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_produk`
--

CREATE TABLE IF NOT EXISTS `pemesanan_produk` (
`id_pemesanan_produk` int(50) NOT NULL,
  `id_pemesanan` int(50) NOT NULL,
  `id_menu` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan_produk`
--

INSERT INTO `pemesanan_produk` (`id_pemesanan_produk`, `id_pemesanan`, `id_menu`, `jumlah`, `gambar`) VALUES
(1, 1, '19', 1, 'ss1.jpg'),
(2, 2, '18', 1, ''),
(3, 2, '19', 1, ''),
(4, 3, '20', 1, ''),
(5, 4, '19', 1, ''),
(6, 4, '27', 1, ''),
(7, 5, '20', 1, 'ss1.jpg'),
(8, 6, '19', 1, ''),
(9, 6, '24', 2, ''),
(10, 6, '18', 1, ''),
(11, 7, '20', 1, 'ss1.jpg'),
(12, 8, '18', 1, 'ss1.jpg'),
(13, 8, '21', 1, 'ss1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_produk_di_tempat`
--

CREATE TABLE IF NOT EXISTS `pemesanan_produk_di_tempat` (
`id_pemesanan_produk` int(50) NOT NULL,
  `id_pemesanan` int(50) NOT NULL,
  `id_menu` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan_produk_di_tempat`
--

INSERT INTO `pemesanan_produk_di_tempat` (`id_pemesanan_produk`, `id_pemesanan`, `id_menu`, `jumlah`, `gambar`) VALUES
(11, 7, '20', 1, ''),
(12, 8, '21', 2, ''),
(13, 8, '18', 1, ''),
(14, 9, '21', 1, ''),
(15, 10, '21', 1, ''),
(16, 11, '21', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
`id_menu` int(50) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `jenis_menu` varchar(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_menu`, `nama_menu`, `jenis_menu`, `stok`, `harga`, `gambar`) VALUES
(18, 'Amricano', 'Minuman', 20, 12000, 'Americano.jpeg'),
(19, 'Red Valvet', 'Makanan', 30, 15000, 'RedValvet.jpeg'),
(20, 'MilkShake', 'Minuman', 25, 15000, 'MilkShake.jpeg'),
(21, 'Lais Coffe', 'Minuman', 50, 20000, 'LaisCoffe.jpeg'),
(22, 'Vietnam Drip', 'Minuman', 22, 20000, 'VietnamDrip.jpeg'),
(24, 'Taro', 'Minuman', 22, 20000, 'Taro.jpeg'),
(26, 'V60', 'Minuman', 40, 17000, 'V60.jpeg'),
(27, 'FrenchFries', 'Makanan', 20, 22000, 'FrenchFries.jpg'),
(28, 'Roti Bakar', 'Makanan', 30, 25000, 'RotiBakar.jpeg'),
(29, 'Indomie', 'Makanan', 21, 14000, 'indomie.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
`id` int(11) NOT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `penjualan` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `merk`, `penjualan`) VALUES
(1, 'Personal Computer', 1000),
(2, 'Laptop', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `salespermonth`
--

CREATE TABLE IF NOT EXISTS `salespermonth` (
  `produk` varchar(50) DEFAULT NULL,
  `jan` int(11) DEFAULT NULL,
  `feb` int(11) DEFAULT NULL,
  `mar` int(11) DEFAULT NULL,
  `apr` int(11) DEFAULT NULL,
  `may` int(11) DEFAULT NULL,
  `jun` int(11) DEFAULT NULL,
  `jul` int(11) DEFAULT NULL,
  `aug` int(11) DEFAULT NULL,
  `sep` int(11) DEFAULT NULL,
  `oct` int(11) DEFAULT NULL,
  `nov` int(11) DEFAULT NULL,
  `dec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salespermonth`
--

INSERT INTO `salespermonth` (`produk`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`) VALUES
('Americano', 100, 200, 500, 800, 1000, 1200, 1150, 950, 850, 650, 400, 230),
('Indomie', 220, 350, 620, 980, 1150, 1300, 1400, 1200, 1000, 800, 600, 450),
('V60', 50, 90, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210),
('LaisCoffe', 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95),
('RotiBakar', 500, 250, 300, 150, 400, 600, 800, 600, 400, 200, 400, 600);

-- --------------------------------------------------------

--
-- Table structure for table `sales_summary`
--

CREATE TABLE IF NOT EXISTS `sales_summary` (
  `tipe` varchar(50) DEFAULT NULL,
  `jan` int(11) DEFAULT NULL,
  `feb` int(11) DEFAULT NULL,
  `mar` int(11) DEFAULT NULL,
  `apr` int(11) DEFAULT NULL,
  `may` int(11) DEFAULT NULL,
  `jun` int(11) DEFAULT NULL,
  `jul` int(11) DEFAULT NULL,
  `aug` int(11) DEFAULT NULL,
  `sep` int(11) DEFAULT NULL,
  `oct` int(11) DEFAULT NULL,
  `nov` int(11) DEFAULT NULL,
  `dec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_summary`
--

INSERT INTO `sales_summary` (`tipe`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`) VALUES
('Export', 100, 200, 500, 800, 1000, 1200, 1150, 950, 850, 650, 400, 230),
('Local', 220, 350, 620, 980, 1150, 1300, 1400, 1200, 1000, 800, 600, 450);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `hp` varchar(25) NOT NULL,
  `status` enum('admin','user','','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `hp`, `status`) VALUES
(1, 'fadhil', 'fadhil', 'Fadhil Athoillah Gasya', 'Laki-Laki', '2000-09-22', 'Bekasi', '081283054625', 'admin'),
(2, 'rinaldo', 'rinaldo123', 'Rinaldo', 'Laki-Laki', '1999-01-11', 'Tanjung Uma', '085233748222', 'user'),
(3, 'admin', 'admin', 'Alfirdaus Muhammad Farhan', 'Laki-Laki', '1998-05-19', 'Tanjung Piayu', '089123614882', 'admin'),
(7, '', '', '', '', '0000-00-00', '', '', ''),
(9, 'umam', 'umam', 'umam', 'Laki-Laki', '2000-02-22', 'hj naman', '08210391273', 'user'),
(10, 'ilham', 'ilham', 'ilham al', 'Laki-Laki', '1997-05-02', 'jl semangka', '07128378', 'user'),
(11, 'adam', 'adam', 'adam pakboy', 'Laki-Laki', '1992-05-23', 'jl tebet', '0812314126412', 'user'),
(12, '', '', '', '', '0000-00-00', '', '', ''),
(13, 'tio', 'tio', 'tio', 'Laki-Laki', '2021-06-04', 'jl unsada', '081237137', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
 ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pemesanan_di_tempat`
--
ALTER TABLE `pemesanan_di_tempat`
 ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
 ADD PRIMARY KEY (`id_pemesanan_produk`);

--
-- Indexes for table `pemesanan_produk_di_tempat`
--
ALTER TABLE `pemesanan_produk_di_tempat`
 ADD PRIMARY KEY (`id_pemesanan_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
MODIFY `id_pemesanan` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pemesanan_di_tempat`
--
ALTER TABLE `pemesanan_di_tempat`
MODIFY `id_pemesanan` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
MODIFY `id_pemesanan_produk` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pemesanan_produk_di_tempat`
--
ALTER TABLE `pemesanan_produk_di_tempat`
MODIFY `id_pemesanan_produk` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
MODIFY `id_menu` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan_produk` (`id_pemesanan_produk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
