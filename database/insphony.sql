-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2026 at 01:50 PM
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
-- Database: `insphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_pemesanan`
--

CREATE TABLE `item_pemesanan` (
  `id` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `hari_sewa` int NOT NULL,
  `harga_per_hari` decimal(10,2) NOT NULL,
  `path_gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` int NOT NULL,
  `device_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_pengguna` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int NOT NULL,
  `id_pengguna` bigint UNSIGNED DEFAULT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status_penyewaan` enum('belum_dipinjam','sedang_dipinjam','sudah_dikembalikan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'belum_dipinjam',
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `kondisi` enum('sangat_baik','baik','rusak','hilang') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `denda` int NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `name`, `username`, `email`, `telepon`, `alamat`, `password`, `foto_profil`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', 'admin@insphony.com', '081234567890', 'Insphony HQ', '$2y$10$czRfw5V3JuHso1YZB0HSneayhD3rBkaEka4ds0lcxgf00.5ynjQvO', NULL, 'admin', '2026-08-20 00:00:00', NULL, '2026-08-20 00:00:00', '2026-08-20 00:00:00'),
(2, 'andika', 'andika', 'andika@gmail.com', '089524003130', 'bengkong', '$2y$12$.fUuwrht.WMA0ES09CYGKuHjH/.5hqAg1W.Tk22dRClCZ0oWIKxnO', NULL, 'user', NULL, NULL, '2026-08-19 16:49:23', '2026-08-19 16:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kategori` enum('Kordofon','Aerofon','Elektrofon','Membranofon','Idiofon') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `path_gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rating_rata` decimal(3,2) DEFAULT '0.00',
  `total_ulasan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `kategori`, `stok`, `harga`, `path_gambar`, `dibuat_pada`, `diperbarui_pada`, `rating_rata`, `total_ulasan`) VALUES
(1, 'Gitar Listrik', 'Gitar yang suaranya tidak diperkuat oleh badan, melainkan oleh pickup elektronik yang mengubah getaran senar menjadi sinyal listrik. Membutuhkan amplifier dan menjadi ikon musik rock.', 'Elektrofon', 20, '150000.00', 'uploads/1751442451_gitlis1.png|uploads/1751442852_gitlis4.png|uploads/1751442852_gitlis2.png|uploads/1751442852_gitlis3.png', '2025-04-12 04:59:42', '2025-07-19 00:39:59', '5.00', 1),
(2, 'Biola Akustik', 'Alat musik gesek dengan empat senar yang menjadi tulang punggung orkestra klasik. Dikenal dengan suaranya yang melengking dan ekspresif, dimainkan dengan busur (bow).', 'Aerofon', 20, '35000.00', 'uploads/1752572855_Biola.jpg|uploads/1752572925_biola3.jpeg|uploads/1752573024_biola7.jpeg|uploads/1752573083_biola8.jpeg', '2025-04-19 23:29:14', '2025-07-19 04:19:21', '0.00', 0),
(3, 'Saksofon', 'Alat musik gesek dengan empat senar yang menjadi tulang punggung orkestra klasik. Dikenal dengan suaranya yang melengking dan ekspresif, dimainkan dengan busur (bow).', 'Aerofon', 20, '150000.00', 'uploads/1750140187_Saxophone1.jpg|uploads/1750140187_Saxophone2.jpg|uploads/1750140187_Saxophone3.jpg|uploads/1750154416_Saxophone4.jpg', '2025-06-16 23:03:07', '2025-07-18 02:45:58', '0.00', 0),
(4, 'Piano', 'Instrumen papan tuts yang menghasilkan suara saat tutsnya ditekan dan memicu palu untuk memukul senar di dalamnya. Mampu memainkan melodi dan harmoni yang kompleks secara bersamaan.', 'Kordofon', 20, '250000.00', 'uploads/1751706290_piano.jpeg|uploads/1752572331_piano2.jpeg|uploads/1752572340_piano3.jpeg|uploads/1752572348_piano4.jpeg', '2025-07-05 09:04:50', '2025-07-18 02:52:39', '0.00', 0),
(5, 'Keyboard Elektronik', 'Instrumen papan tuts serbaguna yang dapat meniru ratusan suara alat musik, serta dilengkapi dengan iringan ritmis otomatis. Sangat populer untuk pemula dan musisi tunggal.', 'Elektrofon', 0, '100000.00', 'uploads/1751710577_keyboardelektronik.jpeg|uploads/1752572357_keyboardelektronik2.jpeg|uploads/1752572365_keyboardelektronik3.jpeg|uploads/1752572788_keyboardelektronik4.jpeg', '2025-07-05 10:16:17', '2025-07-18 02:45:35', '0.00', 0),
(6, 'Gitar Akustik', 'Instrumen dawai populer yang dimainkan dengan cara dipetik atau digenjreng. Suaranya dihasilkan secara alami melalui getaran senar yang diperkuat oleh badan gitar yang berongga.', 'Kordofon', 20, '50000.00', 'uploads/1752572714_gitarakustik.jpeg|uploads/1752572722_gitarakustik2.jpeg|uploads/1752572729_gitarakustik3.jpeg|uploads/1752572736_gitarakustik4.jpeg', '2025-07-15 09:45:14', '2025-07-18 02:52:25', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `id_pengguna` bigint UNSIGNED DEFAULT NULL,
  `id_produk` int NOT NULL,
  `rating` tinyint NOT NULL,
  `komentar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diedit_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bisa_edit` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_pembayaran`
--

CREATE TABLE `verifikasi_pembayaran` (
  `id` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `bukti_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Path/lokasi file bukti pembayaran',
  `bukti_jaminan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Path/lokasi file bukti jaminan',
  `status_verifikasi` enum('menunggu','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'menunggu',
  `tanggal_pembayaran` datetime DEFAULT NULL COMMENT 'Tanggal ketika pembayaran dilakukan oleh pelanggan',
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
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
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_nomor_index` (`nomor`);

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
  ADD UNIQUE KEY `pengguna_email_unique` (`email`),
  ADD UNIQUE KEY `pengguna_username_unique` (`username`);

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
-- Indexes for table `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemesanan_verifikasi` (`id_pemesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
