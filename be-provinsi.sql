-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2023 pada 05.19
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be-provinsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('accepted','declined','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `disease_history` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_symptoms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `consultations`
--

INSERT INTO `consultations` (`id`, `society_id`, `doctor_id`, `status`, `disease_history`, `current_symptoms`, `doctor_notes`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'accepted', 'SomeText', 'current_symptoms', NULL, '2023-04-03 06:00:36', '2023-04-03 06:00:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `medicals`
--

CREATE TABLE `medicals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spot_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('officer','doctor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `medicals`
--

INSERT INTO `medicals` (`id`, `spot_id`, `user_id`, `role`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'doctor', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_01_020644_create_regionals_table', 1),
(6, '2023_04_01_020645_create_societies_table', 1),
(7, '2023_04_01_020721_create_spots_table', 1),
(8, '2023_04_01_020722_create_medicals_table', 1),
(9, '2023_04_01_020754_create_vaccines_table', 1),
(10, '2023_04_01_020808_create_consultations_table', 1),
(11, '2023_04_01_020820_create_vaccinations_table', 1),
(12, '2023_04_01_030537_create_roles_table', 1),
(13, '2023_04_01_043654_create_tokens_table', 1),
(14, '2023_04_02_182631_create_spot_vaccines_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `regionals`
--

CREATE TABLE `regionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `regionals`
--

INSERT INTO `regionals` (`id`, `province`, `district`, `created_at`, `updated_at`) VALUES
(1, 'Jawa Barat', 'Karawang', '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(2, 'Jawa Barat', 'Bandung', '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(3, 'Jawa Barat', 'Purwakarta', '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(4, 'Jawa Barat', 'Subang', '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(5, 'Jawa Barat', 'Gatau', '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(6, 'Jawa Barat', 'Karawang', '2023-04-03 05:57:40', '2023-04-03 05:57:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor` tinyint(1) NOT NULL DEFAULT 0,
  `society` tinyint(1) NOT NULL DEFAULT 0,
  `officer` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `doctor`, `society`, `officer`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 0, 1, '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(2, 1, 0, 0, 2, '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(3, 0, 0, 1, 3, '2023-04-03 05:57:41', '2023-04-03 05:57:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `societies`
--

CREATE TABLE `societies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_card_number` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `born_date` date NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `regional_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `login_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `societies`
--

INSERT INTO `societies` (`id`, `id_card_number`, `password`, `born_date`, `gender`, `address`, `regional_id`, `user_id`, `login_token`, `created_at`, `updated_at`) VALUES
(1, '12341234', NULL, '2006-06-19', 'male', 'Cikampek', 1, 1, NULL, '2023-04-03 05:57:41', '2023-04-03 05:57:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spots`
--

CREATE TABLE `spots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regional_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serve` tinyint(4) NOT NULL,
  `capcity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spots`
--

INSERT INTO `spots` (`id`, `regional_id`, `name`, `address`, `serve`, `capcity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Intan Hospital', 'Jl Jakarta No 100', 1, 10, '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(2, 2, 'Barokah Hospital', 'Jl. Bekasi No 123', 1, 10, '2023-04-03 02:39:40', '2023-04-04 02:39:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spot_vaccines`
--

CREATE TABLE `spot_vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spot_id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spot_vaccines`
--

INSERT INTO `spot_vaccines` (`id`, `spot_id`, `vaccine_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(2, 1, 2, '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(3, 1, 3, '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(4, 2, 3, '2023-04-04 14:32:20', '2023-04-04 02:39:40'),
(5, 2, 1, '2023-04-04 02:43:36', '2023-04-04 02:43:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `expired` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`, `expired`, `created_at`, `updated_at`) VALUES
(1, 'a3c0abfca9312a5f2bfb88ef52255469', 1, '1680454818', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(2, '1347e424c1843cb11ed9807d742ccf59', 1, '16804a030', '2023-04-03 16:03:50', '2023-04-03 16:03:50'),
(3, '6cfb83a0abccf85b9a2fb395a4766f40', 1, '1680488989', '2023-04-03 16:29:49', '2023-04-03 16:29:49'),
(4, '2a9687e160bbf1ecb68b82cff167c56e', 1, '1680489317', '2023-04-03 16:30:17', '2023-04-03 16:30:17'),
(5, '530bf01304374ee2e1a3092db582f55f', 1, '1680492995', '2023-04-03 16:36:35', '2023-04-03 16:36:35'),
(6, '4dd5c3c06510de740272339ace11dc3f', 1, '1680494994', '2023-04-03 17:09:54', '2023-04-03 17:09:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card_number` char(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `id_card_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Society', NULL, '12341234', NULL, '$2y$10$ApoA1z8M2suzFyloNQMfp.DMe1QQmlR0VrYtG9EQYyhufAWtepL4K', NULL, '2023-04-03 05:57:40', '2023-04-03 05:57:40'),
(2, 'Dr. Reza', 'doctor', NULL, NULL, '$2y$10$Guz2McVH/u1K/3BKLQchlO/Rg0i5naZc22lPoP2H9WMtViV3gKjyG', NULL, '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(3, 'Officer Man', 'officer', NULL, NULL, '$2y$10$oXZHkdFD4.dX9XbHREa7subku0.yuTW9eT9ZTiCAB8/aQJs3UyfNS', NULL, '2023-04-03 05:57:41', '2023-04-03 05:57:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dose` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `spot_id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `officer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vaccinations`
--

INSERT INTO `vaccinations` (`id`, `dose`, `date`, `society_id`, `spot_id`, `vaccine_id`, `doctor_id`, `officer_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-04-02', 1, 1, 1, 1, NULL, '2023-04-03 16:23:03', '2023-04-03 16:23:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vaccines`
--

CREATE TABLE `vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vaccines`
--

INSERT INTO `vaccines` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sinovac', '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(2, 'AstraZeneca', '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(3, 'Moderna', '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(4, 'Pfizer', '2023-04-03 05:57:41', '2023-04-03 05:57:41'),
(5, 'Sinnopharm', '2023-04-03 05:57:41', '2023-04-03 05:57:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `consultations_society_id_foreign` (`society_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `medicals`
--
ALTER TABLE `medicals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicals_spot_id_foreign` (`spot_id`),
  ADD KEY `medicals_user_id_foreign` (`user_id`);

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
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `regionals`
--
ALTER TABLE `regionals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_user_id_unique` (`user_id`);

--
-- Indeks untuk tabel `societies`
--
ALTER TABLE `societies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `societies_regional_id_foreign` (`regional_id`),
  ADD KEY `societies_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `spots`
--
ALTER TABLE `spots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spots_regional_id_foreign` (`regional_id`);

--
-- Indeks untuk tabel `spot_vaccines`
--
ALTER TABLE `spot_vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spot_vaccines_spot_id_foreign` (`spot_id`),
  ADD KEY `spot_vaccines_vaccine_id_foreign` (`vaccine_id`);

--
-- Indeks untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokens_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_id_card_number_unique` (`id_card_number`);

--
-- Indeks untuk tabel `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccinations_society_id_foreign` (`society_id`),
  ADD KEY `vaccinations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `vaccinations_officer_id_foreign` (`officer_id`),
  ADD KEY `vaccinations_spot_id_foreign` (`spot_id`),
  ADD KEY `vaccinations_vaccine_id_foreign` (`vaccine_id`);

--
-- Indeks untuk tabel `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `medicals`
--
ALTER TABLE `medicals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `regionals`
--
ALTER TABLE `regionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `societies`
--
ALTER TABLE `societies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `spots`
--
ALTER TABLE `spots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `spot_vaccines`
--
ALTER TABLE `spot_vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `medicals` (`id`),
  ADD CONSTRAINT `consultations_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`id`);

--
-- Ketidakleluasaan untuk tabel `medicals`
--
ALTER TABLE `medicals`
  ADD CONSTRAINT `medicals_spot_id_foreign` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`id`),
  ADD CONSTRAINT `medicals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `societies`
--
ALTER TABLE `societies`
  ADD CONSTRAINT `societies_regional_id_foreign` FOREIGN KEY (`regional_id`) REFERENCES `regionals` (`id`),
  ADD CONSTRAINT `societies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `spots`
--
ALTER TABLE `spots`
  ADD CONSTRAINT `spots_regional_id_foreign` FOREIGN KEY (`regional_id`) REFERENCES `regionals` (`id`);

--
-- Ketidakleluasaan untuk tabel `spot_vaccines`
--
ALTER TABLE `spot_vaccines`
  ADD CONSTRAINT `spot_vaccines_spot_id_foreign` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`id`),
  ADD CONSTRAINT `spot_vaccines_vaccine_id_foreign` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`);

--
-- Ketidakleluasaan untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD CONSTRAINT `vaccinations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `medicals` (`id`),
  ADD CONSTRAINT `vaccinations_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `medicals` (`id`),
  ADD CONSTRAINT `vaccinations_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`id`),
  ADD CONSTRAINT `vaccinations_spot_id_foreign` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`id`),
  ADD CONSTRAINT `vaccinations_vaccine_id_foreign` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
