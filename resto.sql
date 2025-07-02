-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 02:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id_cart` bigint(20) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id_cart`, `id_menu`, `id_order`, `jumlah`, `created_at`, `updated_at`) VALUES
(101, 1, 201, 2, '2025-06-23 02:08:41', '2025-06-23 02:08:41'),
(102, 2, 202, 1, '2025-06-23 02:08:41', '2025-06-23 02:08:41'),
(103, 3, 203, 3, '2025-06-23 02:08:41', '2025-06-23 02:08:41'),
(104, 4, 204, 1, '2025-06-23 02:08:41', '2025-06-23 02:08:41'),
(105, 5, 205, 5, '2025-06-23 02:08:41', '2025-06-23 02:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `detail__orders`
--

CREATE TABLE `detail__orders` (
  `id_detail_order` bigint(20) NOT NULL,
  `id_menu` varchar(50) DEFAULT NULL,
  `id_order` bigint(20) DEFAULT NULL,
  `jenis_menu` varchar(100) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `subtotal` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail__transaksis`
--

CREATE TABLE `detail__transaksis` (
  `id_detail` bigint(20) NOT NULL,
  `id_transaksi` bigint(20) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tunai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dumps`
--

CREATE TABLE `dumps` (
  `id` bigint(20) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `jenis_menu` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menues`
--

CREATE TABLE `menues` (
  `id_menu` bigint(20) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `jenis_menu` varchar(100) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menues`
--

INSERT INTO `menues` (`id_menu`, `harga`, `image`, `jenis_menu`, `nama_menu`, `stok`, `created_at`, `updated_at`) VALUES
(2, 15000, 'Menu-images/PObrosp412r275lB0W9pmmGkLHbMRJJZ9UdjRHSS.jpg', 'makanan', 'Nasi Goreng', 19, '2025-06-29 04:32:14', '2025-06-29 05:22:56'),
(3, 15000, 'Menu-images/4J0AajOWMkyKLU7bSpkfLfphgiWiks9Y3yGgBaWz.webp', 'minuman', 'Chocolate', 30, '2025-06-29 04:51:04', '2025-06-29 05:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint(20) NOT NULL,
  `no_meja` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id_meja` bigint(20) NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `Nomor_Meja` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id_meja`, `Keterangan`, `Nomor_Meja`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dekat jendela', 'A1', 'Kosong', '2025-06-23 02:08:41', '2025-06-29 05:25:02'),
(2, 'Dekat pintu', 'A2', 'dipakai', '2025-06-23 02:08:41', '2025-06-23 02:08:41'),
(3, 'Pojok', 'A3', 'tersedia', '2025-06-23 02:08:41', '2025-06-23 02:08:41'),
(4, 'VIPP', 'A4', 'dipakai', '2025-06-23 02:08:41', '2025-06-29 05:27:44'),
(5, 'Outdoor', 'A5', 'Kosong', '2025-06-29 05:28:23', '2025-06-29 05:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id_transaksi` bigint(20) NOT NULL,
  `id_order` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `level`, `password`, `telepon`, `username`, `created_at`, `updated_at`) VALUES
(1, 'kelorK', 'kelor@gmail.com', 'admin', '$2y$10$3QPG7Gtq.RewgVtExy/VPue9DX0PSaLCUo3SgJ3m/hnVNFtF0984i', '009876543567', 'kelor', '2025-06-22 19:10:03', '2025-06-22 19:10:03'),
(2, 'kasir', 'kasir@gmail.com', 'kasir', '$2y$10$UIhlVw5sMTndDAjSL3lPRe1jFmkc.qn60PBjzsMA3yZJG5LzzVMhe', '043545453543543', 'kasir', '2025-06-22 19:11:42', '2025-06-22 19:11:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `detail__orders`
--
ALTER TABLE `detail__orders`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indexes for table `detail__transaksis`
--
ALTER TABLE `detail__transaksis`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `dumps`
--
ALTER TABLE `dumps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menues`
--
ALTER TABLE `menues`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `detail__orders`
--
ALTER TABLE `detail__orders`
  MODIFY `id_detail_order` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail__transaksis`
--
ALTER TABLE `detail__transaksis`
  MODIFY `id_detail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dumps`
--
ALTER TABLE `dumps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menues`
--
ALTER TABLE `menues`
  MODIFY `id_menu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id_meja` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id_transaksi` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
