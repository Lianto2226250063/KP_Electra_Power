-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 06:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kessoku`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` char(36) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `nama`, `created_at`, `updated_at`) VALUES
('9b1033c5-1be3-406c-a9c8-e2918848423a', 'Comedy', '2024-01-10 19:08:23', '2024-01-10 19:08:23'),
('9b103eec-fcbf-42a3-9101-fb10cb342255', 'Horror', '2024-01-10 19:39:35', '2024-01-10 19:39:35'),
('9b103ef8-21fa-4c10-a66f-2a878b7b58d0', 'Romance', '2024-01-10 19:39:42', '2024-01-10 19:39:42'),
('9b103f01-6f02-48dc-af01-e87f796ddcdb', 'Slice of Life', '2024-01-10 19:39:48', '2024-01-10 19:39:48'),
('9b10423e-eb9f-4bd9-9b33-fe177d60a62b', 'Action', '2024-01-10 19:48:52', '2024-01-10 19:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` char(36) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
('9b1033b5-667a-481b-9ddd-edc352cdb54d', 'Anime Series', '2024-01-10 19:08:13', '2024-01-10 19:08:13'),
('9b103ec6-753d-4ec6-8680-c734e8c9f938', 'Series', '2024-01-10 19:39:09', '2024-01-10 19:39:09'),
('9b103ecd-6d72-407a-8202-b8cd8d1da1e5', 'Movie', '2024-01-10 19:39:14', '2024-01-10 19:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `listfilms`
--

CREATE TABLE `listfilms` (
  `id` char(36) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `produser` varchar(50) NOT NULL,
  `foto` varchar(55) DEFAULT NULL,
  `skor` double NOT NULL,
  `genre_id` char(36) NOT NULL,
  `studio_id` char(36) NOT NULL,
  `rating_id` char(36) NOT NULL,
  `jenis_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listfilms`
--

INSERT INTO `listfilms` (`id`, `nama`, `deskripsi`, `produser`, `foto`, `skor`, `genre_id`, `studio_id`, `rating_id`, `jenis_id`, `created_at`, `updated_at`) VALUES
('9b103fe7-0a16-45c7-86f5-3e157421b8d3', 'Silent Voice', 'A grade-school student with a hearing impairment is bullied and transfers to another school. Years later, the former bully is tormented by his behaviour and sets out to make amends.', 'Kyoani', 'Silent Voice.jpg', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103389-9d55-46f1-8813-a781aefef64f', '9b103ecd-6d72-407a-8202-b8cd8d1da1e5', '2024-01-10 19:42:18', '2024-01-10 19:42:18'),
('9b10427b-2a98-438f-899a-d313e55b3a96', 'Avenger', 'When Thor\'s evil brother, Loki (Tom Hiddleston), gains access to the unlimited power of the energy cube called the Tesseract, Nick Fury (Samuel L. Jackson), director of S.H.I.E.L.D., initiates a superhero recruitment effort to defeat the unprecedented threat to Earth. Joining Fury\'s \"dream team\" are Iron Man (Robert Downey Jr.), Captain America (Chris Evans), the Hulk (Mark Ruffalo), Thor (Chris Hemsworth), the Black Widow (Scarlett Johansson) and Hawkeye (Jeremy Renner).', 'Robert Downey Jr', 'Avenger.jpg', 5, '9b10423e-eb9f-4bd9-9b33-fe177d60a62b', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103ed7-47a7-492f-b689-2d595fc97280', '9b103ecd-6d72-407a-8202-b8cd8d1da1e5', '2024-01-10 19:49:31', '2024-01-10 19:49:31'),
('9b104336-3610-4c2d-8fa8-14fcc469ef21', 'Five Night at Freddy\'s', 'Hurr Hurr hur hur hur hur hur hur hur hurr Freddy Fazbear comes into your house!', 'Scott Cawthon', 'Five Night at Freddy\'s.png', 5, '9b103eec-fcbf-42a3-9101-fb10cb342255', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103ed7-47a7-492f-b689-2d595fc97280', '9b103ecd-6d72-407a-8202-b8cd8d1da1e5', '2024-01-10 19:51:34', '2024-01-10 19:51:34'),
('9b1043ce-6f37-434c-a2bd-929965e27b15', 'Kaguya Sama Wa Kokurasetai', 'Kaguya is the daughter of a wealthy conglomerate family, and Miyuki is the top student at the school and well known across the prefecture. Although they like each other, they are too proud to confess their love, as they believe whoever does so first would \"lose\" in their relationship.', 'Kyoani', 'Kaguya Sama Wa Kokurasetai.jpg', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 19:53:13', '2024-01-10 19:53:13'),
('9b104455-3ea7-4323-b7a5-dcde78ea8da8', 'Black Clover', 'Black Clover: Sword of the Wizard King menceritakan Asta, seorang anak laki-laki yang lahir tanpa memiliki kemampuan sihir. Namun dia berusaha keras menjadi Raja Penyihir dan menggagalkan rencana jahat Raja Penyihir sebelumnya yang mengancam Kerajaan Clover', 'Bones', 'Black Clover.jpg', 5, '9b10423e-eb9f-4bd9-9b33-fe177d60a62b', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 19:54:42', '2024-01-10 19:54:42'),
('9b1044cb-3d5a-4497-b9e2-f4dd3cd08d52', 'Steins Gate', 'Sinopsis. Steins;Gate mengikuti kisah Rintarou Okabe, seorang mahasiswa eksentrik yang menjalankan sebuah laboratorium di Akihabara, Tokyo. Bersama dengan teman-temannya, Mayuri Shiina dan Hashida Itaru, Okabe menemukan sesuatu yang tak terduga: sebuah mesin waktu yang dapat mengirim pesan ke masa lalu', 'MADHOUSE', 'Steins Gate.jpg', 5, '9b103f01-6f02-48dc-af01-e87f796ddcdb', '9b104348-a16e-4e9e-b337-0b7918e1e835', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 19:55:59', '2024-01-10 19:56:08'),
('9b104593-97b3-441d-ac0b-f7ac31c9376f', 'Uma Musume', 'Famous racehorses that have left behind worthy legacies, unique as they can be, are reincarnated as horse girls in a parallel world. In this life, they start their journey anew as they continue to race and perhaps relive the success they once lived through.  Aspiring to become the best racehorse in Japan, a horse girl named Special Week moves to Tokyo to enroll in the Tracen Academy—an institution that nurtures horse girls like her to become better racers. There, Special Week witnesses the sophisticated running style of Silence Suzuka and is inspired to become a racer like her. Shortly after, Special Week finds herself recruited into Silence Suzuka\'s team, Spica. From there, she begins her path to the top—one lap at a time.', 'MADHOUSE', 'Uma Musume.jpg', 1, '9b1033c5-1be3-406c-a9c8-e2918848423a', '9b104348-a16e-4e9e-b337-0b7918e1e835', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 19:58:10', '2024-01-10 19:58:10'),
('9b1046f3-3bb1-4b57-bc0f-c00a51cf84c1', 'Jujutsu Kaisen', 'Nah I\'d win, Stand proud you\'re strong', 'MAPPA', 'Jujutsu Kaisen.jpg', 5, '9b10423e-eb9f-4bd9-9b33-fe177d60a62b', '9b104348-a16e-4e9e-b337-0b7918e1e835', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 20:02:01', '2024-01-10 20:02:01'),
('9b1047d2-e21f-45b7-80e5-69e1107e1079', 'Dangers In My Heart', 'Yamada is a popular and fashionable young woman with an outwardly bright personality, though this can sometimes be a front for her insecurities. She is thirteen years old at the start of the series, and attends school alongside her classmates in Daijuni Middle School in Meguro, Tokyo, Class 2-3 (later 3-1).', 'Robert Downey Jr', 'Dangers In My Heart.jpg', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 20:04:27', '2024-01-10 20:04:27'),
('9b10487d-4f7e-4518-a075-ec828adab6ae', 'Seven Deadly Sins', 'Meliodas adalah seorang raja iblis yang sangat kuat.', 'PowerPoint', 'Seven Deadly Sins.jpg', 5, '9b10423e-eb9f-4bd9-9b33-fe177d60a62b', '9b10440b-a117-435d-9f8d-7b08532144d7', '9b103ed7-47a7-492f-b689-2d595fc97280', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 20:06:19', '2024-01-10 20:06:19'),
('9b10491f-4aec-4c17-9acc-8f92f6d9532a', 'My Charms Are Wasted On Kuroiwa Medaka', 'Mona is the cutest girl in school, and she knows it. In fact, she\'s worked hard to make her high school debut successful. But no matter what she does, she can\'t seem to catch the eye of stone-cold stoic Kuroiwa Medaka —but she\'s not about to give up that easy. Medaka, on the other hand, has been raised at a temple and was told to never become close to women. Who will win in this heated battle of wills?  ADVERTISEMENT Volumes & Chapters Main article: Volumes and Chapters', 'Medaka', 'My Charms Are Wasted On Kuroiwa Medaka.jpeg', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b104348-a16e-4e9e-b337-0b7918e1e835', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 20:08:05', '2024-01-10 20:08:05'),
('9b1049f1-e388-49c9-9db9-b9864821eae6', 'Kimi No Nawa', 'Anime ini menceritakan siswa sekolah menengah Taki Tachibana dan Mitsuha Miyamizu. Tiba-tiba tubuh keduanya tertukar meski terpisah jarak yang jauh. Suatu hari, Mitsuha terbangun di sebuah ruangan yang bukan ruangannya. Ia mendapati dirinya di Tokyo dengan tubuh lelaki.', 'Aki Hamaji', 'Kimi No Nawa.png', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 20:10:23', '2024-01-10 20:10:23'),
('9b104b4c-2d4b-4264-a058-1e0665b5f704', 'Tenki No Ko', 'Adalah Penceritaan Tentang Pawang Hujan', 'Kyoani', 'Tenki No Ko.jpg', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b103378-5fa3-48cf-96e5-6f8c4e713c63', '9b103389-9d55-46f1-8813-a781aefef64f', '9b103ecd-6d72-407a-8202-b8cd8d1da1e5', '2024-01-10 20:14:10', '2024-01-10 20:14:10'),
('9b104bcb-cb9a-4151-b71e-cf397529f6c7', 'Ambatukaaaaaaam', 'Film Jawa yang sangat mengerikan dan menghebohkan', 'Wiliams', 'Ambatukaaaaaaam.jpg', 5, '9b103eec-fcbf-42a3-9101-fb10cb342255', '9b104348-a16e-4e9e-b337-0b7918e1e835', '9b103ee1-47d0-41a3-b724-f4ea3e84b7d1', '9b103ecd-6d72-407a-8202-b8cd8d1da1e5', '2024-01-10 20:15:34', '2024-01-10 20:15:34'),
('9b104c68-06ae-4d52-a64a-54a1c71aa58b', 'Plastic Memory', 'Film yang sangat menyedihkan', 'Aki Hamaji', 'Plastic Memory.jpg', 5, '9b103ef8-21fa-4c10-a66f-2a878b7b58d0', '9b103eb9-020a-4322-a46e-00c05c403a5e', '9b103389-9d55-46f1-8813-a781aefef64f', '9b1033b5-667a-481b-9ddd-edc352cdb54d', '2024-01-10 20:17:16', '2024-01-10 20:17:16');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_29_121100_create_genres_table', 1),
(6, '2023_11_29_121250_create_studios_table', 1),
(7, '2023_11_29_121306_create_jenis_table', 1),
(8, '2023_11_29_121320_create_ratings_table', 1),
(9, '2023_11_29_121332_create_listfilms_table', 1),
(10, '2024_01_10_130340_alter_role_to_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` char(36) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `rating`, `created_at`, `updated_at`) VALUES
('9b103389-9d55-46f1-8813-a781aefef64f', 'PG-13', '2024-01-10 19:07:44', '2024-01-10 19:07:44'),
('9b103ed7-47a7-492f-b689-2d595fc97280', '18+', '2024-01-10 19:39:20', '2024-01-10 19:39:20'),
('9b103ee1-47d0-41a3-b724-f4ea3e84b7d1', '21+', '2024-01-10 19:39:27', '2024-01-10 19:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE `studios` (
  `id` char(36) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`id`, `nama`, `created_at`, `updated_at`) VALUES
('9b103378-5fa3-48cf-96e5-6f8c4e713c63', 'Kessoku Band', '2024-01-10 19:07:33', '2024-01-10 19:07:33'),
('9b103eb9-020a-4322-a46e-00c05c403a5e', 'Clover Studio', '2024-01-10 19:39:00', '2024-01-10 19:39:00'),
('9b104348-a16e-4e9e-b337-0b7918e1e835', 'Fuad Studio', '2024-01-10 19:51:46', '2024-01-10 19:51:46'),
('9b10440b-a117-435d-9f8d-7b08532144d7', 'Bones Studio', '2024-01-10 19:53:53', '2024-01-10 19:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('A','U') NOT NULL DEFAULT 'U',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Roberto Alessandro', 'roberto1@gmail.com', NULL, '$2y$12$hzx7iqQyTqwa7D7SvoJ6U.eyxz16DJ0e8TDJAx/jzUfSKZmxx75zS', 'U', NULL, '2024-01-10 06:14:36', '2024-01-10 06:14:36'),
(2, 'Roberto', 'roberto2@gmail.com', NULL, '$2y$12$nsb1KSK0jjYIxXuVJMLP9uTEk2uS/9QbGFr8.uy0tRigO8n/C1Hwe', 'A', NULL, '2024-01-10 19:18:22', '2024-01-10 19:18:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listfilms`
--
ALTER TABLE `listfilms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listfilms_genre_id_foreign` (`genre_id`),
  ADD KEY `listfilms_studio_id_foreign` (`studio_id`),
  ADD KEY `listfilms_jenis_id_foreign` (`jenis_id`),
  ADD KEY `listfilms_rating_id_foreign` (`rating_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listfilms`
--
ALTER TABLE `listfilms`
  ADD CONSTRAINT `listfilms_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `listfilms_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`),
  ADD CONSTRAINT `listfilms_rating_id_foreign` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`),
  ADD CONSTRAINT `listfilms_studio_id_foreign` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
