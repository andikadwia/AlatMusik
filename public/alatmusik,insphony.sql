-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2025 pada 13.44
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insphonypbl2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_pemesanan`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(15) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `waktu` int(11) NOT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `otps`
--

INSERT INTO `otps` (`id`, `nomor`, `otp`, `waktu`, `device_token`, `created_at`, `updated_at`) VALUES
(28, '085271901194', '315995', 1749004248, '4VomUsrKuVu9S4E65NY9', NULL, NULL),
(29, '089509603739', '931296', 1750481984, '4VomUsrKuVu9S4E65NY9', NULL, NULL),
(33, '082279732844', '381036', 1751974623, '4VomUsrKuVu9S4E65NY9', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pengguna` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status_penyewaan` enum('belum_dipinjam','sedang_dipinjam','sudah_dikembalikan') DEFAULT 'belum_dipinjam',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL DEFAULT 'Alamat belum diisi',
  `password` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `name`, `username`, `email`, `telepon`, `alamat`, `password`, `foto_profil`, `created_at`, `updated_at`, `role`) VALUES
(7, 'zidan123', 'zidan', 'denput12@gmail.com', '081295768594', 'bengkong harapan', '$2y$12$8lUFjismQDalvFD6xK9b/u/luA3C0wkjy2q6myBdynz7/3kskvOkG', 'fotoprofil/1752032713_a15547e6eae106c16358dccf5526c827.jpg', '2025-04-30 23:06:24', '2025-07-08 20:45:13', 'admin'),
(8, 'user', 'user', 'farelnaqi12@gmail.com', '081295764444', 'alamat dimana saja bole', '$2y$12$8g5mMWe8xI2qXFS7KlHwgupy/pk8SnT6UWLDcEi7Q9oAtsIIqmePe', 'fotoprofil/1751342841_1748354530_496926308_1408191933687392_7103012127966728873_n.jpg', '2025-05-01 06:19:11', '2025-06-30 23:13:10', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
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
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `kategori`, `stok`, `harga`, `path_gambar`, `dibuat_pada`, `diperbarui_pada`, `rating_rata`, `total_ulasan`) VALUES
(3, 'Flute', 'alat musik ini cocok untuk memainkan musik instrumental orchestra', 'Aerofon', 1, 25000.00, 'uploads/1751341192_flute.jpg|uploads/1751341192_flute2.jpg|uploads/1751341192_flute3.jpg|uploads/1751341192_flute4.jpg', '2025-04-12 05:08:37', '2025-07-18 09:35:38', 4.50, 2),
(4, 'Biola', 'Biola di layanan kami terjamin kualitasnya dan harganya terjangkau dan paling bersaing', 'Aerofon', 10, 50000.00, 'uploads/1751341212_biola.jpg|uploads/1751341212_biola2.jpg|uploads/1751341212_biola3.jpg|uploads/1751341212_biola4.jpg', '2025-04-19 23:29:14', '2025-07-09 04:55:57', 5.00, 2),
(6, 'Bass Elektrik', 'Bass elektrik adalah tulang punggung harmoni dalam setiap komposisi musik. Di Insphony, kami menyediakan beragam bass berkualitas tinggi untuk menciptakan dasar ritmis yang powerful.\r\n#Keunggulan Produk:\r\n- Body kokoh dari kayu premium (maple/mahogany)\r\n- Neck ergonomis untuk kenyamanan bermain lama\r\n- Pickup presisi untuk suara low-end yang dalam dan jelas\r\n- Cocok untuk berbagai genre: jazz, rock, funk, hingga metal\r\nBass bukan sekadar alat musik - ia adalah jiwa dari setiap komposisi. Temukan partner bermusik Anda di Insphony!', 'Kordofon', 1, 40000.00, 'uploads/1750477756_bass3.jpg|uploads/1750477756_bass4.jpg|uploads/1751341230_bass1.jpg|uploads/1751341230_bass2.jpg', '2025-05-02 18:14:46', '2025-07-08 12:20:43', 0.00, 0),
(14, 'Saxophone', 'Saxophone di toko kami kualitasnya jangan di ragukan lagi', 'Aerofon', 2, 75000.00, 'uploads/1750140187_Saxophone1.jpg|uploads/1750140187_Saxophone2.jpg|uploads/1750140187_Saxophone3.jpg|uploads/1750154416_Saxophone4.jpg', '2025-06-16 23:03:07', '2025-07-10 10:52:46', 0.00, 0),
(15, 'Darbuka', 'Darbuka aluminium dengan motif ukiran khas Timur Tengah. Kualitas suara tajam dan jernih, cocok untuk semua level pemain. Tinggi 43 cm, saat ini baru tersedia 1 stok dan 1 ragam saja.', 'Membranofon', 1, 40000.00, 'uploads/1751341251_darbuka1.jpg|uploads/1751341251_darbuka2.jpg|uploads/1751341251_darbuka3.jpg|uploads/1751341251_darbuka4.jpg', '2025-06-22 16:40:56', '2025-07-01 03:40:51', 0.00, 0),
(16, 'Handpan', 'Temukan pengalaman bermusik yang menenangkan dan spiritual dengan handpan steel drum kami. Dibuat dengan presisi tinggi dan penyetelan nada yang sempurna, alat musik ini menghadirkan resonansi yang kaya dan vibrasi alami. Alat musik ini sangat cocok untuk musisi, terapis suara, pecinta yoga, hingga pemula yang ingin menjelajahi dunia musik etnik modern.', 'Idiofon', 1, 70000.00, 'uploads/1751341299_handpan1.jpg|uploads/1751341299_handpan2.jpg|uploads/1751341299_handpan3.jpg|uploads/1751341299_handpan4.jpg', '2025-06-22 16:41:45', '2025-07-01 03:41:39', 0.00, 0),
(17, 'gitar listrik', 'gitar listrik', 'Kordofon', 1, 1000000.00, 'uploads/1751819770_gitlis4.png|uploads/1751819770_gitlis2 - Copy.png|uploads/1751819770_gitlis2.png|uploads/1751819770_gitlis3 - Copy.png', '2025-07-06 16:36:10', '2025-07-06 16:36:10', 0.00, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `komentar` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diedit_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bisa_edit` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_pembayaran`
--

CREATE TABLE `verifikasi_pembayaran` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL COMMENT 'Path/lokasi file bukti pembayaran',
  `bukti_jaminan` varchar(255) NOT NULL COMMENT 'Path/lokasi file bukti jaminan',
  `status_verifikasi` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `tanggal_pembayaran` datetime DEFAULT NULL COMMENT 'Tanggal ketika pembayaran dilakukan oleh pelanggan',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_nomor_index` (`nomor`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_pelanggan_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengguna_pemesanan` (`id_pengguna`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemesanan_verifikasi` (`id_pemesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item_pemesanan`
--
ALTER TABLE `item_pemesanan`
  ADD CONSTRAINT `item_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_pemesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pengguna_relink` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`);

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk_ulasan_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`),
  ADD CONSTRAINT `ulasan_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `verifikasi_pembayaran`
--
ALTER TABLE `verifikasi_pembayaran`
  ADD CONSTRAINT `fk_pemesanan_verifikasi` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
