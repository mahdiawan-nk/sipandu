-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Des 2023 pada 12.51
-- Versi server: 8.0.30
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-posyandu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `check_up_imunisasis`
--

CREATE TABLE `check_up_imunisasis` (
  `id` int UNSIGNED NOT NULL,
  `id_checkup` int NOT NULL,
  `id_imunisasi` int NOT NULL,
  `dosis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_beri` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `check_up_vitamins`
--

CREATE TABLE `check_up_vitamins` (
  `id` int UNSIGNED NOT NULL,
  `id_checkup` int NOT NULL,
  `id_vitamin` int NOT NULL,
  `dosis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_beri` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_anaks`
--

CREATE TABLE `data_anaks` (
  `id` int UNSIGNED NOT NULL,
  `id_ibu` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riwayat_kesehatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_check_ups`
--

CREATE TABLE `data_check_ups` (
  `id` int UNSIGNED NOT NULL,
  `id_posyandu` int NOT NULL,
  `id_anak` int NOT NULL,
  `usia_saat_periksa` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pemeriksaan` date NOT NULL,
  `berat_badan_pemeriksaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi_badan_pemeriksaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_gizi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_imunisasi` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_vitamin` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ibus`
--

CREATE TABLE `data_ibus` (
  `id` int UNSIGNED NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gol_darah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riwayat_kesehatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jadwal_posyandus`
--

CREATE TABLE `data_jadwal_posyandus` (
  `id` int UNSIGNED NOT NULL,
  `id_posyandu` int NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jenis_imunisasis`
--

CREATE TABLE `data_jenis_imunisasis` (
  `id` int UNSIGNED NOT NULL,
  `jenis_imunisasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jenis_vitamins`
--

CREATE TABLE `data_jenis_vitamins` (
  `id` int UNSIGNED NOT NULL,
  `kode_vitamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_vitamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_posyandus`
--

CREATE TABLE `data_posyandus` (
  `id` int UNSIGNED NOT NULL,
  `nama_posyandu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_posyandu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kader_posyandu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `informasi_posyandu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_12_09_223703_create_penggunas_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2023_12_10_104746_create_data_ibus_table', 3),
(6, '2023_12_10_105820_create_data_anaks_table', 4),
(7, '2023_12_12_194804_create_data_posyandus_table', 5),
(8, '2023_12_13_143350_create_data_jadwal_posyandus_table', 6),
(9, '2023_12_13_164235_create_data_jenis_vitamins_table', 7),
(10, '2023_12_13_193327_create_data_jenis_imunisasis_table', 8),
(11, '2023_12_13_202746_create_data_check_ups_table', 9),
(12, '2023_12_15_211545_create_check_up_imunisasis_table', 10),
(13, '2023_12_15_211527_create_check_up_vitamins_table', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunas`
--

CREATE TABLE `penggunas` (
  `id` int UNSIGNED NOT NULL,
  `nama_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('A','P') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A : Admin P : Petugas',
  `status_akun` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Y : aktif N : tidak aktif',
  `id_posyandu` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penggunas`
--

INSERT INTO `penggunas` (`id`, `nama_pengguna`, `email_pengguna`, `password_pengguna`, `role`, `status_akun`, `id_posyandu`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'admins@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'A', 'Y', 0, '2023-12-09 15:54:39', '2023-12-09 15:54:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `check_up_imunisasis`
--
ALTER TABLE `check_up_imunisasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `check_up_vitamins`
--
ALTER TABLE `check_up_vitamins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_anaks`
--
ALTER TABLE `data_anaks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_check_ups`
--
ALTER TABLE `data_check_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_ibus`
--
ALTER TABLE `data_ibus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_jadwal_posyandus`
--
ALTER TABLE `data_jadwal_posyandus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_jenis_imunisasis`
--
ALTER TABLE `data_jenis_imunisasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_jenis_vitamins`
--
ALTER TABLE `data_jenis_vitamins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_posyandus`
--
ALTER TABLE `data_posyandus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penggunas`
--
ALTER TABLE `penggunas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `check_up_imunisasis`
--
ALTER TABLE `check_up_imunisasis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `check_up_vitamins`
--
ALTER TABLE `check_up_vitamins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_anaks`
--
ALTER TABLE `data_anaks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_check_ups`
--
ALTER TABLE `data_check_ups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_ibus`
--
ALTER TABLE `data_ibus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_jadwal_posyandus`
--
ALTER TABLE `data_jadwal_posyandus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_jenis_imunisasis`
--
ALTER TABLE `data_jenis_imunisasis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_jenis_vitamins`
--
ALTER TABLE `data_jenis_vitamins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_posyandus`
--
ALTER TABLE `data_posyandus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `penggunas`
--
ALTER TABLE `penggunas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
