-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2025 pada 13.42
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
-- Database: `db_pegawai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$jniBTuUtRZBco//TgPOmEOty5XWjmaOfz0H79/wdW.pKZleHeNyHG', '2025-02-08 05:54:16', '2025-02-08 05:54:16');

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
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_departemen` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `nama_departemen`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Pengembangan Perangkat Lunak', 'Pusat inovasi dan pengembangan solusi teknologi', '2025-02-08 06:22:10', '2025-02-08 06:22:10'),
(2, 'Infrastruktur & Jaringan', 'Mengelola dan memelihara infrastruktur teknologi', '2025-02-08 06:22:27', '2025-02-08 06:22:27'),
(3, 'Keamanan Informasi', 'Menjaga keamanan aset digital perusahaan', '2025-02-08 06:22:39', '2025-02-08 06:22:39'),
(4, 'Dukungan Teknis', 'Memberikan dukungan teknis kepada pengguna internal', '2025-02-08 06:22:50', '2025-02-08 06:22:50'),
(5, 'Manajemen Produk', 'Mengembangkan dan mengarahkan strategi produk', '2025-02-08 06:23:04', '2025-02-08 06:23:04'),
(6, 'Penelitian & Pengembangan', 'Memastikan inovasi yang dikembangkan dapat diterapkan secara efektif.', '2025-02-08 06:23:16', '2025-02-12 22:57:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(255) NOT NULL,
  `gaji` decimal(10,2) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `nama_lengkap`, `nip`, `jenis_kelamin`, `email`, `gaji`, `department_id`, `position_id`, `created_at`, `updated_at`) VALUES
(9, 'Andi', '3748291047562938', 'Laki-laki', 'andi@email.com', 8000000.00, 1, 1, '2025-02-08 10:29:06', '2025-02-08 10:29:06'),
(11, 'Angel', '5647382910475629', 'Perempuan', 'angel@gmail.com', 10000000.00, 4, 8, '2025-02-08 10:31:54', '2025-02-08 10:31:54'),
(12, 'Tine', '5628394710293847', 'Perempuan', 'Tine@gamil.com', 15000000.00, 6, 11, '2025-02-08 10:33:23', '2025-02-08 10:33:23'),
(13, 'Aldo', '1092837465129384', 'Laki-laki', 'Aldo@gmail.com', 14000000.00, 5, 9, '2025-02-08 10:34:41', '2025-02-08 10:34:41'),
(14, 'Evan', '8374629102837465', 'Laki-laki', 'evan@gmail.com', 13000000.00, 3, 6, '2025-02-08 10:36:20', '2025-02-08 10:36:20'),
(15, 'Dinda', '2938475601928374', 'Perempuan', 'dinda@gmail.com', 12000000.00, 1, 2, '2025-02-08 10:37:15', '2025-02-08 10:37:15'),
(16, 'Sarah Kartika', '7482910374659182', 'Perempuan', 'sarah@gmail.com', 15000000.00, 5, 10, '2025-02-08 10:38:24', '2025-02-12 22:44:23'),
(17, 'Amanda', '9203847561928374', 'Perempuan', 'Amanda@gmail.com', 10000000.00, 2, 3, '2025-02-08 10:40:54', '2025-02-08 10:40:54'),
(18, 'Herryani', '7382910465738291', 'Perempuan', 'Herryani@gmail.com', 8000000.00, 4, 7, '2025-02-08 10:42:59', '2025-02-08 10:59:13'),
(37, 'Dimas', '9182736450918273', 'Laki-laki', 'dimas@gmail.com', 12000000.00, 3, 5, '2025-02-13 05:34:35', '2025-02-13 05:34:35'),
(38, 'Shani', '4567382910465738', 'Perempuan', 'shani@gmail.com', 15000000.00, 5, 10, '2025-02-13 05:35:26', '2025-02-13 05:35:26'),
(39, 'Dandi', '8291047562938475', 'Laki-laki', 'dandi21@gmail.com', 8000000.00, 1, 1, '2025-02-13 05:36:08', '2025-02-13 05:36:08'),
(40, 'Feni', '4738291047562938', 'Perempuan', 'Feni99@gmail.com', 11000000.00, 2, 4, '2025-02-13 05:36:48', '2025-02-13 05:36:48'),
(41, 'mariam', '1837465928374651', 'Perempuan', 'mariam@gmail.com', 10000000.00, 4, 8, '2025-02-13 05:37:27', '2025-02-13 05:37:27'),
(42, 'Satria', '9273645091827364', 'Laki-laki', 'satria347@gmail.com', 15000000.00, 6, 12, '2025-02-13 05:38:07', '2025-02-13 05:38:07'),
(43, 'Yunita', '8374659182736450', 'Perempuan', 'yunita@gmail.com', 13000000.00, 3, 6, '2025-02-13 05:38:40', '2025-02-13 05:38:40'),
(44, 'Nina', '8374659203847561', 'Perempuan', 'nina@gmail.com', 10000000.00, 2, 3, '2025-02-13 05:39:20', '2025-02-13 05:39:20'),
(45, 'Herdinda', '2910384756192837', 'Perempuan', 'Herdinda@gmail.com', 15000000.00, 6, 12, '2025-02-13 05:39:59', '2025-02-13 05:39:59'),
(46, 'Maudy', '4536782311547809', 'Perempuan', 'maudy@gmail.com', 8000000.00, 1, 1, '2025-02-13 05:40:31', '2025-02-13 05:40:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_08_112903_create_admin_table', 1),
(5, '2025_02_08_112912_create_departments_table', 1),
(6, '2025_02_08_112914_create_positions_table', 1),
(7, '2025_02_08_112915_create_employees_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`id`, `nama_jabatan`, `gaji_pokok`, `deskripsi`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Software Engineer', 8000000.00, 'Merancang, mengembangkan, dan memelihara aplikasi perangkat lunak berkualitas tinggi', 1, '2025-02-08 06:43:30', '2025-02-08 06:43:57'),
(2, 'Senior Software Engineer', 12000000.00, 'Memimpin tim pengembangan, merancang arsitektur, dan menyelesaikan permasalahan teknis kompleks', 1, '2025-02-08 06:44:32', '2025-02-08 06:44:32'),
(3, 'Network Administrator', 10000000.00, 'Mengelola, mengkonfigurasi, dan memelihara infrastruktur jaringan perusahaan', 2, '2025-02-08 06:45:15', '2025-02-08 06:45:15'),
(4, 'System Administrator', 11000000.00, 'Mengelola, mengamankan, dan mengoptimalkan sistem komputer dan server', 2, '2025-02-08 06:46:06', '2025-02-08 06:46:06'),
(5, 'Cybersecurity Analyst', 12000000.00, 'Mengidentifikasi, menganalisis, dan mengurangi risiko keamanan siber', 3, '2025-02-08 06:46:32', '2025-02-08 06:46:32'),
(6, 'Security Engineer', 13000000.00, 'Merancang dan mengimplementasikan solusi keamanan informasi yang komprehensif', 3, '2025-02-08 06:47:06', '2025-02-08 06:47:06'),
(7, 'IT Support Specialist', 8000000.00, 'Memberikan dukungan teknis dan menyelesaikan masalah teknologi untuk pengguna internal', 4, '2025-02-08 06:47:40', '2025-02-08 06:47:40'),
(8, 'Technical Support Engineer', 10000000.00, 'Mendiagnosis dan menyelesaikan permasalahan teknis kompleks', 4, '2025-02-08 06:48:19', '2025-02-08 06:48:19'),
(9, 'Product Manager', 14000000.00, 'Mengembangkan strategi produk, menentukan roadmap, dan menghubungkan kebutuhan bisnis dengan solusi teknologi', 5, '2025-02-08 06:48:49', '2025-02-08 06:48:49'),
(10, 'Product Owner', 15000000.00, 'Mengelola backlog produk, mengoptimalkan nilai produk, dan berkolaborasi dengan tim pengembangan', 5, '2025-02-08 06:49:32', '2025-02-08 06:49:32'),
(11, 'Research Scientist', 16000000.00, 'Melakukan riset mendalam, mengembangkan konsep inovatif, dan mengeksplorasi teknologi baru', 6, '2025-02-08 06:49:56', '2025-02-08 06:49:56'),
(12, 'Data Scientist', 15000000.00, 'Menganalisis data kompleks, mengembangkan model machine learning, dan memberikan wawasan strategis', 6, '2025-02-08 06:50:16', '2025-02-08 06:50:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QRaKAmSH90rE3H4HVQ6xckT2xXRkMxwezU9fEiuc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiejVmNnpiQm0zZXBrcjh3cW10U2VqaDBVOGVBY3N0UE1SSmpjR282UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjE1OiJhZG1pbl9sb2dnZWRfaW4iO2I6MTtzOjg6ImFkbWluX2lkIjtpOjE7fQ==', 1739450495);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_nip_unique` (`nip`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_position_id_foreign` (`position_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positions_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
