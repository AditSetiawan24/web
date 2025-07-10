-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2025 at 03:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int NOT NULL,
  `id_user` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `id_user`, `email`, `alamat`, `no_telp`) VALUES
(4, 12, 'dudung@gmail.com', 'djhbv dsnjncx vjnhdb', '098765453');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `id_payment` int NOT NULL,
  `id_customer` int NOT NULL,
  `total_bayar` decimal(12,2) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `metode_pembayaran` enum('debit/credit','VA','e-wallet') NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`id_payment`, `id_customer`, `total_bayar`, `tanggal_pembayaran`, `metode_pembayaran`, `status`) VALUES
(1, 4, '35000.00', '2025-07-09', 'e-wallet', 'paid'),
(2, 4, '32000.00', '2025-07-09', 'debit/credit', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `tb_shipment`
--

CREATE TABLE `tb_shipment` (
  `id_shipment` int NOT NULL,
  `id_customer` int NOT NULL,
  `id_payment` int NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `no_telp_penerima` varchar(255) NOT NULL,
  `tipe` enum('udara','darat','laut','kereta') NOT NULL,
  `status` enum('pending','process','selesai','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_shipment`
--

INSERT INTO `tb_shipment` (`id_shipment`, `id_customer`, `id_payment`, `tanggal_kirim`, `asal`, `tujuan`, `nama_penerima`, `no_telp_penerima`, `tipe`, `status`) VALUES
(1, 4, 1, '2025-07-09', 'purwokerto', 'london', 'kane', '6546787986565678', 'udara', 'selesai'),
(2, 4, 2, '2025-07-09', 'kebumen', 'jakarta', 'hernanda', '56678768844534', 'laut', 'process');

-- --------------------------------------------------------

--
-- Table structure for table `tb_shipment_detail`
--

CREATE TABLE `tb_shipment_detail` (
  `id_shipment_detail` int NOT NULL,
  `id_shipment` int NOT NULL,
  `quantity` int NOT NULL,
  `total_berat` decimal(10,2) NOT NULL,
  `total_volume` decimal(10,2) NOT NULL,
  `total_biaya` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_shipment_detail`
--

INSERT INTO `tb_shipment_detail` (`id_shipment_detail`, `id_shipment`, `quantity`, `total_berat`, `total_volume`, `total_biaya`) VALUES
(1, 1, 1, '5.00', '5.00', '35000.00'),
(2, 2, 3, '4.00', '4.00', '32000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_team`
--

CREATE TABLE `tb_team` (
  `id_member` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `x` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_team`
--

INSERT INTO `tb_team` (`id_member`, `nama`, `posisi`, `photo_url`, `fb`, `x`, `ig`) VALUES
(1, 'Andi Prasetyo', 'Operations Manager', '1752063877_20d322e1ca1bae259011.jpeg', 'http://facebook.com/andiprasetyo', 'http://x.com/andiprasetyo', 'http://instagram.com/andiprasetyo'),
(2, 'Putri Marlina', 'Logistics Coordinator', '1752064098_d550e57de6e3a5437024.webp', 'http://facebook.com/putrimarlina', 'http://x.com/putrimarlina', 'http://instagram.com/putrimarlina'),
(3, 'Budi Santoso', 'Warehouse Supervisor', '1752064149_4e259170ad2ad3bda92d.jpeg', 'http://facebook.com/budisantoso', 'http://x.com/budisantoso', 'http://instagram.com/budisantoso'),
(4, 'Rina Oktaviani', 'Customer Service Staff', '1752064207_586d330c848be6cba4f7.jpg', 'http://facebook.com/rinaoktaviani', 'http://x.com/rinaoktaviani', 'http://instagram.com/rinaoktaviani'),
(5, 'Dedi Kurniawan', 'Delivery Driver', '1752064258_7e98b0173fcca26f34ad.jpeg', 'http://facebook.com/dedikurniawan', 'http://x.com/dedikurniawan', 'http://instagram.com/dedikurniawan'),
(6, 'Lestari Widya', 'Inventory Analyst', '1752064308_faa0fa0eba732e64773d.jpg', 'http://facebook.com/lestariwidya', 'http://x.com/lestariwidya', 'http://instagram.com/lestariwidya'),
(7, 'Arif Nugroho', 'Route Planner', '1752064359_2d2512c055d1f6b2a865.jpeg', 'http://facebook.com/arifnugroho', 'http://x.com/arifnugroho', 'http://instagram.com/arifnugroho'),
(8, 'Maria Yuliani', 'Quality Control Inspector', '1752064399_7ea595d8c278a81e5aac.jpg', 'http://facebook.com/mariayuliani', 'http://x.com/mariayuliani', 'http://instagram.com/mariayuliani');

-- --------------------------------------------------------

--
-- Table structure for table `tb_testimoni`
--

CREATE TABLE `tb_testimoni` (
  `id_testimoni` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `profesi` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('customer','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL COMMENT '0=nonaktif, 1=aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `level`, `status`) VALUES
(10, 'Admin 1', 'admin1', '$2y$10$LJ6IqNM5ni62oOi/Xo0Yre5WDz/a.eT4hz1VBMr2ls49oWzYk3uGa', 'admin', 1),
(11, 'Admin 2', 'admin2', '$2y$10$9qOUS7sq/jrgnYhNM7qate7KnSkZnndsLzhq4ZeEkhL65hY6PFOeu', 'admin', 1),
(12, 'Pelanggan', 'pelanggan1', '$2y$10$wscDCrqmi4z0tO5..Nt0wezUgfid9JT/nx4S/dCjlqadIp1BRh0C.', 'customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_warehouse`
--

CREATE TABLE `tb_warehouse` (
  `id_warehouse` int NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kapasitas` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_warehouse`
--

INSERT INTO `tb_warehouse` (`id_warehouse`, `lokasi`, `kapasitas`) VALUES
(1, 'Purwokerto', '12.36'),
(2, 'test', '100.00'),
(4, 'test2', '45.70');

-- --------------------------------------------------------

--
-- Table structure for table `tb_warehouse_storage`
--

CREATE TABLE `tb_warehouse_storage` (
  `id_warehouse_storage` int NOT NULL,
  `id_warehouse` int NOT NULL,
  `id_customer` int NOT NULL,
  `id_payment` int NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `volume_tersimpan` decimal(10,2) NOT NULL,
  `tipe` enum('basic','standard','advance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `tb_shipment`
--
ALTER TABLE `tb_shipment`
  ADD PRIMARY KEY (`id_shipment`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_payment` (`id_payment`);

--
-- Indexes for table `tb_shipment_detail`
--
ALTER TABLE `tb_shipment_detail`
  ADD PRIMARY KEY (`id_shipment_detail`),
  ADD KEY `id_shipment` (`id_shipment`);

--
-- Indexes for table `tb_team`
--
ALTER TABLE `tb_team`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  ADD PRIMARY KEY (`id_warehouse`);

--
-- Indexes for table `tb_warehouse_storage`
--
ALTER TABLE `tb_warehouse_storage`
  ADD PRIMARY KEY (`id_warehouse_storage`),
  ADD KEY `id_warehouse` (`id_warehouse`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_payment` (`id_payment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id_payment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_shipment`
--
ALTER TABLE `tb_shipment`
  MODIFY `id_shipment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_shipment_detail`
--
ALTER TABLE `tb_shipment_detail`
  MODIFY `id_shipment_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_team`
--
ALTER TABLE `tb_team`
  MODIFY `id_member` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  MODIFY `id_testimoni` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  MODIFY `id_warehouse` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_warehouse_storage`
--
ALTER TABLE `tb_warehouse_storage`
  MODIFY `id_warehouse_storage` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD CONSTRAINT `tb_customer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD CONSTRAINT `tb_payment_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_shipment`
--
ALTER TABLE `tb_shipment`
  ADD CONSTRAINT `tb_shipment_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_shipment_ibfk_2` FOREIGN KEY (`id_payment`) REFERENCES `tb_payment` (`id_payment`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_shipment_detail`
--
ALTER TABLE `tb_shipment_detail`
  ADD CONSTRAINT `tb_shipment_detail_ibfk_1` FOREIGN KEY (`id_shipment`) REFERENCES `tb_shipment` (`id_shipment`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_warehouse_storage`
--
ALTER TABLE `tb_warehouse_storage`
  ADD CONSTRAINT `tb_warehouse_storage_ibfk_1` FOREIGN KEY (`id_warehouse`) REFERENCES `tb_warehouse` (`id_warehouse`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_warehouse_storage_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_warehouse_storage_ibfk_3` FOREIGN KEY (`id_payment`) REFERENCES `tb_payment` (`id_payment`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
