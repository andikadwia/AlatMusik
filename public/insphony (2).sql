-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 04:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_pemesanan`
--

CREATE TABLE `item_pemesanan` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `hari_sewa` int(11) NOT NULL,
  `harga_per_hari` decimal(10,2) NOT NULL,
  `path_gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_pemesanan`
--

INSERT INTO `item_pemesanan` (`id`, `id_pemesanan`, `id_produk`, `jumlah`, `hari_sewa`, `harga_per_hari`, `path_gambar`) VALUES
(2, 8, 3, 1, 2, 25000.00, 'uploads/67fa57c5b9b9f_Cuplikan layar 2025-03-25 180816.png'),
(3, 9, 3, 1, 1, 25000.00, 'uploads/67fa57c5b9b9f_Cuplikan layar 2025-03-25 180816.png'),
(4, 9, 2, 1, 1, 30000.00, 'uploads/67fa55ae4d533_Drawing 3 (1).png'),
(5, 10, 4, 1, 1, 50000.00, 'uploads/6804943abbc8a_IMG_20241204_105533_035.jpg'),
(6, 11, 4, 1, 1, 50000.00, 'uploads/6804943abbc8a_IMG_20241204_105533_035.jpg'),
(7, 12, 3, 1, 1, 25000.00, 'uploads/67fa57c5b9b9f_Cuplikan layar 2025-03-25 180816.png'),
(8, 12, 2, 1, 2, 30000.00, 'uploads/67fa55ae4d533_Drawing 3 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `hari_sewa` int(11) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_pengguna`, `id_produk`, `jumlah`, `hari_sewa`, `dibuat_pada`) VALUES
(1, 2, 3, 1, 1, '2025-04-27 10:18:33'),
(2, 2, 4, 1, 1, '2025-04-27 10:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_04_28_044347_create_users_table', 1),
(2, '2025_04_28_044548_create_sessions_table', 1),
(3, '2025_04_28_062335_add_email_to_users_table', 1),
(4, '2025_04_29_042423_add_role_to_users_table', 2),
(5, '2025_04_29_052341_add__telepon_to_users_table', 3),
(6, '2025_04_29_053044_add_alamat_to_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `telepon`, `alamat`, `dibuat_pada`, `diperbarui_pada`, `id_pengguna`) VALUES
(2, 'deny', 'denyriansyah24@gmail.com', '08080808', 'batam', '2025-04-15 04:00:41', '2025-05-10 00:42:10', 1),
(3, 'denybtm', 'Denypiupiu@gmail.com', '082279732833', 'bengkong', '2025-04-20 04:59:37', '2025-05-10 00:42:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `catatan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_peminjaman` enum('belum_dipinjam','sedang_dipinjam','sudah_dikembalikan') DEFAULT 'belum_dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pengguna`, `tanggal_pemesanan`, `total_harga`, `status`, `catatan`, `dibuat_pada`, `diperbarui_pada`, `status_peminjaman`) VALUES
(8, 1, '2025-04-15 11:38:23', 50000.00, 'disetujui', '', '2025-04-15 04:38:23', '2025-04-20 04:54:59', 'sudah_dikembalikan'),
(9, 2, '2025-04-20 11:35:46', 55000.00, 'disetujui', '', '2025-04-20 04:35:46', '2025-04-21 12:20:51', 'sudah_dikembalikan'),
(10, 1, '2025-04-20 14:04:50', 50000.00, 'disetujui', '', '2025-04-20 07:04:50', '2025-05-10 02:37:25', 'belum_dipinjam'),
(11, 1, '2025-04-20 14:05:10', 50000.00, 'disetujui', '', '2025-04-20 07:05:10', '2025-04-22 06:21:33', 'sudah_dikembalikan'),
(12, 2, '2025-04-21 14:28:29', 85000.00, 'disetujui', '', '2025-04-21 07:28:29', '2025-04-22 06:25:48', 'sudah_dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `kondisi` enum('sangat_baik','baik','rusak','hilang') NOT NULL,
  `catatan` text DEFAULT NULL,
  `denda` int(15) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_pemesanan`, `tanggal_pengembalian`, `kondisi`, `catatan`, `denda`, `dibuat_pada`) VALUES
(1, 8, '2025-04-20 11:54:59', 'rusak', 'kondisi senar gitar putus 2', 50000, '2025-04-20 04:54:59'),
(2, 9, '2025-04-21 19:20:51', 'sangat_baik', 'alat semuanya dalam kondisi masih baik seperti sebelum di pinjam', 0, '2025-04-21 12:20:51'),
(3, 11, '2025-04-22 13:21:32', 'hilang', 'biolanya hilang', 2000000, '2025-04-22 06:21:32'),
(4, 12, '2025-04-22 13:25:48', 'sangat_baik', 'barang seperti sebelum dipinjam', 0, '2025-04-22 06:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` int(15) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `peran` enum('admin','staf') DEFAULT 'staf',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `email`, `telepon`, `nama_lengkap`, `peran`, `dibuat_pada`, `diperbarui_pada`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@insphony.com', 2147483647, 'Admin Insphony', 'admin', '2025-04-12 04:11:50', '2025-04-14 01:01:33'),
(2, 'farelmeme', '$2y$10$LS.arRsiPNQmNmWtkbWMXOB3LuzbKr/wtbIGS70ayf8kOZRPKuI0O', 'farelmeme12@gmail.com', 2147483647, 'Farel Fahrezi', 'staf', '2025-04-13 10:27:10', '2025-04-14 01:02:08'),
(3, 'denput', '$2y$10$9QxIEGePCdXfQebbSK9tGutdYa.nhG/7x8NWz6Zs1qSioe/L83yMu', 'denput12@gmail.com', 2147483647, 'Deny Riansyah', 'staf', '2025-04-14 01:06:15', '2025-04-14 01:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` enum('Kordofon','Aerofon','Elektrofon','Membranofon','Idiofon') NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `path_gambar` varchar(255) DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rating_rata` decimal(3,2) DEFAULT 0.00,
  `total_ulasan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `kategori`, `stok`, `harga`, `path_gambar`, `dibuat_pada`, `diperbarui_pada`, `rating_rata`, `total_ulasan`) VALUES
(2, 'gitar listrik', 'alat musik ini menggunakan listrik uuntuk menghasilkan suaranya', 'Kordofon', 5, 30000.00, 'uploads/1746257910_U17F0RyLMck68VujyMhpAjfSbuBdg08dLzOCDjXA.png', '2025-04-12 11:59:42', '2025-05-03 07:38:30', 1.50, 2),
(3, 'Flute', 'alat musik ini cocok untuk memainkan musik instrumental', 'Aerofon', 4, 25000.00, 'uploads/1746257857_images.jpg', '2025-04-12 12:08:37', '2025-05-03 07:37:37', 5.00, 2),
(4, 'Biola', 'Biola di layanan kami terjamin kualitasnya dan harganya terjangkau', 'Aerofon', 1, 50000.00, 'uploads/1746257019_6300743_30581f3f-b969-4564-ab4d-f8e157e29288_1001_1001-500x500.jpg', '2025-04-20 06:29:14', '2025-05-06 01:57:41', 0.00, 0),
(6, 'Bass Elektrik', 'Bass elektrik adalah tulang punggung harmoni dalam setiap komposisi musik. Di Insphony, kami menyediakan beragam bass berkualitas tinggi untuk menciptakan dasar ritmis yang powerful.\r\n#Keunggulan Produk:\r\n- Body kokoh dari kayu premium (maple/mahogany)\r\n- Neck ergonomis untuk kenyamanan bermain lama\r\n- Pickup presisi untuk suara low-end yang dalam dan jelas\r\n- Cocok untuk berbagai genre: jazz, rock, funk, hingga metal\r\nBass bukan sekadar alat musik - ia adalah jiwa dari setiap komposisi. Temukan partner bermusik Anda di Insphony!', 'Kordofon', 3, 40000.00, 'uploads/1746234886_GL-TributeL2000Natural-1.jpg', '2025-05-03 01:14:46', '2025-05-03 01:14:46', 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `komentar` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diedit_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bisa_edit` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_pemesanan`, `id_pengguna`, `id_produk`, `rating`, `komentar`, `dibuat_pada`, `diedit_pada`, `bisa_edit`) VALUES
(4, 12, 2, 3, 5, 'mantap alat musiknya', '2025-04-25 10:09:06', '2025-04-28 13:22:33', 1),
(5, 12, 2, 2, 2, 'alat musik nya nyaman banget digunakan', '2025-04-25 10:34:17', '2025-04-25 10:34:17', 1),
(7, 9, 2, 2, 1, 'alat musiknya sangat bagus', '2025-04-25 10:35:13', '2025-04-25 10:35:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL DEFAULT 'Alamat belum diisi',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `telepon`, `alamat`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'deny', 'deny', 'denyriansyah24@gmail.com', '08080808', 'batam', '$2y$12$lauuGAmyZyVMgG2SJ0s0A.5JhFs5pX.8./4cGn6KGVFNFSrKHud2u', NULL, '2025-04-28 22:31:22', '2025-04-28 22:31:22', 'user'),
(2, 'denybtm', 'denybtm', 'Denypiupiu@gmail.com', '082279732833', 'bengkong', '$2y$12$c00qXjhzjjaqzxvFlbJhF.m/JX6W.nXDYlTKkfVKwsl.xEdIgMFbS', NULL, '2025-04-28 22:32:11', '2025-04-28 22:32:11', 'user'),
(3, 'dika', 'dika', 'dikabaeksongming@gmail.com', '01293012903', 'dimana kek', '$2y$12$jvGewsUry26N3sg1dt17cu5Kqhqy3bBcUhysvEMJcJIcbLCkODdne', NULL, '2025-04-28 23:05:21', '2025-04-28 23:05:21', 'user'),
(4, 'dika123', 'dika123', 'dikaxxxxxx@gmail.com', '0908123080', 'bengkong', '$2y$12$dTf9Dv9xlvNTaA00HI/pDOW9vyg9ReIfduGmPwdpk6CFqs/I9uXIS', NULL, '2025-04-28 23:08:39', '2025-04-28 23:08:39', 'user'),
(5, 'dika12', 'dika12', 'dikaxxx123@gmail.com', '08232323232', 'bengkong jauh', '$2y$12$TlxZLeB5Q6Czs0ru6QIkVOi8RUbFoq2ru4q2PwkuG.BiLjk15m.aG', NULL, '2025-04-28 23:09:20', '2025-04-28 23:09:20', 'user'),
(6, 'farel', 'farel', 'farelrimex@gmail.com', '0822222222', 'jauh', '$2y$12$V5lo1iInrFRdBF.NC5yhIeIkVUtGhGbVv8ekKGNlM/rBVopD98Jzy', NULL, '2025-04-28 23:20:39', '2025-04-28 23:20:39', 'user'),
(7, 'zidan', 'zidan', 'denput12@gmail.com', '081295768594', 'bengkong harapan', '$2y$12$8lUFjismQDalvFD6xK9b/u/luA3C0wkjy2q6myBdynz7/3kskvOkG', NULL, '2025-04-30 23:06:24', '2025-04-30 23:06:24', 'admin'),
(8, 'user', 'user', 'farelmeme12@gmail.com', '081295764444', 'alamat dimana saja bole', '$2y$12$UZufY.v96zUcyAHW/EvlMeYn9ehjT7QWP53k54rw4SVXLOAQMZH4q', NULL, '2025-05-01 06:19:11', '2025-05-01 06:19:11', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_pelanggan_pengguna` (`id_pengguna`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengguna_pemesanan` (`id_pengguna`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  ADD CONSTRAINT `item_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_pemesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pengguna_users` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`),
  ADD CONSTRAINT `ulasan_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
