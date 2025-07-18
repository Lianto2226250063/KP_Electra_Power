-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 08:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electrapower`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama`, `harga`, `created_at`, `updated_at`, `jenis`) VALUES
(1, 'Service Coil Break', 1750000.00, '2025-07-17 07:48:30', '2025-07-17 07:48:30', 'Jasa'),
(2, 'Service Serumbung Gardan', 1500000.00, '2025-07-17 07:52:08', '2025-07-17 07:52:08', 'Jasa'),
(3, 'Service AS Lintang', 3000000.00, '2025-07-17 07:52:40', '2025-07-17 07:52:40', 'Jasa'),
(4, 'Kingpen 1 set ukuran 28mm', 900000.00, '2025-07-17 07:53:51', '2025-07-17 07:53:51', 'Barang'),
(5, 'Botol Dyna drat kiri', 1200000.00, '2025-07-17 07:59:33', '2025-07-17 07:59:33', 'Barang'),
(6, 'Bearing Motor SKF 6203', 78000.00, '2025-07-17 08:02:59', '2025-07-17 08:02:59', 'Barang'),
(7, 'Service Bearing Housing', 2500000.00, '2025-07-17 08:09:51', '2025-07-17 08:09:51', 'Jasa'),
(8, 'Bearing Motor NSK 6205', 200000.00, '2025-07-17 08:09:51', '2025-07-17 08:09:51', 'Barang'),
(9, 'Overhaul Motor 7.5 kW', 3800000.00, '2025-07-17 08:15:38', '2025-07-17 08:15:38', 'Jasa'),
(10, 'Service Panel MCC', 4500000.00, '2025-07-17 08:18:49', '2025-07-17 08:18:49', 'Jasa'),
(11, 'Kabel Power 20m', 750000.00, '2025-07-17 08:18:49', '2025-07-17 08:18:49', 'Barang'),
(12, 'Rewinding Motor 5 kW', 2750000.00, '2025-07-17 08:35:28', '2025-07-17 08:35:28', 'Jasa'),
(13, 'Bearing Motor SKF 6207', 350000.00, '2025-07-17 08:35:28', '2025-07-17 08:35:28', 'Barang'),
(14, 'Fan Pendingin Motor Frame 112', 250000.00, '2025-07-17 08:35:28', '2025-07-17 08:35:28', 'Barang'),
(15, 'Overhaul Motor Seimens 7,5 kW', 3800000.00, '2025-07-17 08:40:03', '2025-07-17 08:40:03', 'Jasa'),
(16, 'Bearing Motor NSK 6305', 280000.00, '2025-07-17 08:40:03', '2025-07-17 08:40:03', 'Barang'),
(17, 'Fan Pendingin Motor Frame 132 OEM Siemens', 750000.00, '2025-07-17 08:40:03', '2025-07-17 08:40:03', 'Barang'),
(18, 'Service Coil Break (Motor merk ABB)', 1950000.00, '2025-07-17 08:46:11', '2025-07-17 08:46:11', 'Jasa'),
(19, 'Bearing SKF 6205-2RS', 200000.00, '2025-07-17 08:46:11', '2025-07-17 08:46:11', 'Barang'),
(20, 'Rewinding Motor WEG 10 kW', 4200000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48', 'Jasa'),
(21, 'Bearing FAG 6210-C3', 450000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48', 'Barang'),
(22, 'Rotor Balancing Dinamis', 1200000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48', 'Barang'),
(23, 'Fan Pendingin Frame 160 OEM WEG', 1500000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48', 'Barang'),
(24, 'Bearing KOYO 6207-2RS', 320000.00, '2025-07-17 08:52:57', '2025-07-17 08:52:57', 'Barang'),
(25, 'Fan Pendingin Motor Frame 100 Universal', 250000.00, '2025-07-17 08:52:57', '2025-07-17 08:52:57', 'Barang'),
(26, 'Overhaul Motor Toshiba 15 kW', 6500000.00, '2025-07-17 08:56:26', '2025-07-17 08:56:26', 'Jasa'),
(27, 'Bearing NTN NU210', 750000.00, '2025-07-17 08:56:26', '2025-07-17 08:56:26', 'Barang'),
(28, 'Bearing SKF 6203-2RS', 180000.00, '2025-07-17 09:02:07', '2025-07-17 09:02:07', 'Barang'),
(29, 'Fan Pendingin Motor Frame 90 Universal', 200000.00, '2025-07-17 09:02:08', '2025-07-17 09:02:08', 'Barang'),
(30, 'Overhaul Motor ABB 11 kW', 4800000.00, '2025-07-17 09:06:26', '2025-07-17 09:06:26', 'Jasa'),
(31, 'Bearing NSK 6210', 400000.00, '2025-07-17 09:06:26', '2025-07-17 09:06:26', 'Barang'),
(32, 'Fan Pendingin Motor Frame 132 OEM ABB', 900000.00, '2025-07-17 09:06:26', '2025-07-17 09:06:26', 'Barang'),
(33, 'Service Coil Break Motor WEG', 1750000.00, '2025-07-17 09:09:37', '2025-07-17 09:09:37', 'Jasa'),
(34, 'Bearing Motor KOYO 6205', 250000.00, '2025-07-17 09:09:37', '2025-07-17 09:09:37', 'Barang'),
(35, 'Bearing Motor FAG NU215', 1200000.00, '2025-07-17 09:12:34', '2025-07-17 09:12:34', 'Barang'),
(36, 'Kabel Power 25m', 1000000.00, '2025-07-17 09:12:34', '2025-07-17 09:12:34', 'Barang'),
(37, 'Rewinding Motor Toshiba 5 kW', 6000000.00, '2025-07-17 09:14:02', '2025-07-17 09:14:02', 'Jasa'),
(38, 'Overhaul Motor WEG Pompa Air 3 kW', 2500000.00, '2025-07-17 09:16:34', '2025-07-17 09:16:34', 'Jasa'),
(39, 'Bearing Motor NSK 6204-2RS', 200000.00, '2025-07-17 09:16:34', '2025-07-17 09:16:34', 'Barang'),
(40, 'Bearing Motor SKF 6202-2RS', 150000.00, '2025-07-17 09:17:30', '2025-07-17 09:17:30', 'Barang');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` char(36) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Belum bayar',
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `nomor`, `kepada`, `tanggal`, `status`, `id_pegawai`, `created_at`, `updated_at`) VALUES
('9f69b8b7-40b9-45e4-aa91-3e5b1af93223', '1/EP/INV/01-25', 'Huesin', '2025-01-07', 'Sudah bayar', 2, '2025-07-17 07:56:34', '2025-07-17 07:56:38'),
('9f69b9c9-8048-4d31-ba25-87fed35f1ad6', '1/EPI/INV/01-25', 'PT Garuda Multi Transport', '2025-01-13', 'Sudah bayar', 2, '2025-07-17 07:59:33', '2025-07-17 07:59:49'),
('9f69bf8a-167f-43dc-bf5e-40916c472762', '2/EPI/INV/02-25', 'PT Bumi Makmur Teknik', '2025-02-17', 'Sudah bayar', 2, '2025-07-17 08:15:38', '2025-07-17 08:16:03'),
('9f69c55a-b81c-4734-b5e1-0d923186606d', '2/EP/INV/02-25', 'Andi Prasetyo', '2025-02-17', 'Sudah bayar', 2, '2025-07-17 08:31:54', '2025-07-17 08:31:58'),
('9f69c6a1-a532-4b2b-ad04-cb619acec0b0', '3/EP/INV/02-25', 'Dewi Lestari', '2025-02-20', 'Sudah bayar', 2, '2025-07-17 08:35:28', '2025-07-17 08:35:31'),
('9f69c716-2c78-4149-ad50-860e29414295', '3/EPI/INV/03-25', 'PT Cahaya Sejahtera', '2025-03-11', 'Sudah bayar', 2, '2025-07-17 08:36:45', '2025-07-17 08:36:47'),
('9f69c844-5cf3-4065-b286-fae7b06bbd86', '4/EPI/INV/03-25', 'PT Mekar Abadi Teknik', '2025-03-17', 'Sudah bayar', 2, '2025-07-17 08:40:03', '2025-07-17 08:40:19'),
('9f69ca76-b6fc-4144-a9a3-fa5dfdbeb8ca', '4/EP/INV/03-25', 'Budi Hartono', '2025-03-05', 'Sudah bayar', 2, '2025-07-17 08:46:11', '2025-07-17 08:46:15'),
('9f69cc1d-16ed-420a-b5e4-365dec95dd78', '5/EPI/INV/03-25', 'PT Sinar Terang Mandiri', '2025-03-27', 'Sudah bayar', 2, '2025-07-17 08:50:48', '2025-07-17 08:50:51'),
('9f69cce1-6656-4b71-9948-a5734b181e8f', '5/EP/INV/04-25', 'Siti Mahmudah', '2025-04-17', 'Sudah bayar', 2, '2025-07-17 08:52:57', '2025-07-17 08:52:59'),
('9f69ce20-5e7d-4e22-8f37-9ba50500a0d0', '6/EPI/INV/04-25', 'PT Garuda Prima Logistik', '2025-04-17', 'Sudah bayar', 3, '2025-07-17 08:56:26', '2025-07-17 08:56:29'),
('9f69d029-fb08-49d3-9c9b-64fa635141a4', '6/EP/INV/05-25', 'Rudi Santoso', '2025-05-01', 'Sudah bayar', 3, '2025-07-17 09:02:07', '2025-07-17 09:02:28'),
('9f69d1b3-ed38-4db9-9350-baaf563f67f6', '7/EPI/INV/05-25', 'PT Nusantara Logam Perkasa', '2025-05-15', 'Sudah bayar', 3, '2025-07-17 09:06:26', '2025-07-17 09:06:29'),
('9f69d2d8-55d8-4c3f-86e0-18906752fef3', '7/EP/INV/05-25', 'Lina Anggraini', '2025-05-17', 'Sudah bayar', 3, '2025-07-17 09:09:37', '2025-07-17 09:09:52'),
('9f69d3e6-7155-4821-9626-f22647c54e01', '8/EPI/INV/06-25', 'PT Prima Jaya Industri', '2025-06-20', 'Sudah bayar', 3, '2025-07-17 09:12:34', '2025-07-17 09:14:05'),
('9f69d46b-c6cb-41e3-8c02-d8bfe0b681f0', '9/EPI/INV/07-25', 'PT Sinar Global Teknik', '2025-07-02', 'Sudah bayar', 3, '2025-07-17 09:14:02', '2025-07-17 09:14:07'),
('9f69d553-c96b-439e-b8dc-5b2d231f6ed3', '8/EP/INV/06-25', 'Wahyu Pratama', '2025-06-10', 'Sudah bayar', 3, '2025-07-17 09:16:34', '2025-07-17 09:16:36'),
('9f69d5a9-621e-4775-8dcd-11fbed179b90', '9/EP/INV/06-25', 'Agus Saputra', '2025-06-20', 'Sudah bayar', 3, '2025-07-17 09:17:30', '2025-07-17 09:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_invoice` char(36) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `id_invoice`, `keterangan`, `jumlah`, `harga_satuan`, `created_at`, `updated_at`) VALUES
(1, '9f69b8b7-40b9-45e4-aa91-3e5b1af93223', 'Service Coil Break', 1, 1750000.00, '2025-07-17 07:56:34', '2025-07-17 07:56:34'),
(2, '9f69b9c9-8048-4d31-ba25-87fed35f1ad6', 'Service Serumbung Gardan', 2, 1500000.00, '2025-07-17 07:59:33', '2025-07-17 07:59:33'),
(3, '9f69b9c9-8048-4d31-ba25-87fed35f1ad6', 'Botol Dyna drat kiri', 1, 1200000.00, '2025-07-17 07:59:33', '2025-07-17 07:59:33'),
(4, '9f69b9c9-8048-4d31-ba25-87fed35f1ad6', 'Service AS Lintang', 1, 3000000.00, '2025-07-17 07:59:33', '2025-07-17 07:59:33'),
(5, '9f69b9c9-8048-4d31-ba25-87fed35f1ad6', 'Kingpen 1 set ukuran 28mm', 1, 900000.00, '2025-07-17 07:59:33', '2025-07-17 07:59:33'),
(9, '9f69bf8a-167f-43dc-bf5e-40916c472762', 'Overhaul Motor 7.5 kW', 1, 3800000.00, '2025-07-17 08:15:38', '2025-07-17 08:15:38'),
(15, '9f69c55a-b81c-4734-b5e1-0d923186606d', 'Service Bearing Housing', 1, 2500000.00, '2025-07-17 08:31:54', '2025-07-17 08:31:54'),
(16, '9f69c55a-b81c-4734-b5e1-0d923186606d', 'Bearing Motor NSK 6205', 1, 200000.00, '2025-07-17 08:31:54', '2025-07-17 08:31:54'),
(17, '9f69c6a1-a532-4b2b-ad04-cb619acec0b0', 'Rewinding Motor 5 kW', 1, 2750000.00, '2025-07-17 08:35:28', '2025-07-17 08:35:28'),
(18, '9f69c6a1-a532-4b2b-ad04-cb619acec0b0', 'Bearing Motor SKF 6207', 1, 350000.00, '2025-07-17 08:35:28', '2025-07-17 08:35:28'),
(19, '9f69c6a1-a532-4b2b-ad04-cb619acec0b0', 'Fan Pendingin Motor Frame 112', 1, 250000.00, '2025-07-17 08:35:28', '2025-07-17 08:35:28'),
(20, '9f69c716-2c78-4149-ad50-860e29414295', 'Service Panel MCC', 1, 4500000.00, '2025-07-17 08:36:45', '2025-07-17 08:36:45'),
(21, '9f69c716-2c78-4149-ad50-860e29414295', 'Kabel Power 20m', 1, 750000.00, '2025-07-17 08:36:45', '2025-07-17 08:36:45'),
(22, '9f69c844-5cf3-4065-b286-fae7b06bbd86', 'Overhaul Motor Seimens 7,5 kW', 1, 3800000.00, '2025-07-17 08:40:03', '2025-07-17 08:40:03'),
(23, '9f69c844-5cf3-4065-b286-fae7b06bbd86', 'Bearing Motor NSK 6305', 1, 280000.00, '2025-07-17 08:40:03', '2025-07-17 08:40:03'),
(24, '9f69c844-5cf3-4065-b286-fae7b06bbd86', 'Fan Pendingin Motor Frame 132 OEM Siemens', 1, 750000.00, '2025-07-17 08:40:03', '2025-07-17 08:40:03'),
(25, '9f69ca76-b6fc-4144-a9a3-fa5dfdbeb8ca', 'Service Coil Break (Motor merk ABB)', 1, 1950000.00, '2025-07-17 08:46:11', '2025-07-17 08:46:11'),
(26, '9f69ca76-b6fc-4144-a9a3-fa5dfdbeb8ca', 'Bearing SKF 6205-2RS', 1, 200000.00, '2025-07-17 08:46:11', '2025-07-17 08:46:11'),
(27, '9f69cc1d-16ed-420a-b5e4-365dec95dd78', 'Rewinding Motor WEG 10 kW', 1, 4200000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48'),
(28, '9f69cc1d-16ed-420a-b5e4-365dec95dd78', 'Bearing FAG 6210-C3', 1, 450000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48'),
(29, '9f69cc1d-16ed-420a-b5e4-365dec95dd78', 'Rotor Balancing Dinamis', 1, 1200000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48'),
(30, '9f69cc1d-16ed-420a-b5e4-365dec95dd78', 'Fan Pendingin Frame 160 OEM WEG', 1, 1500000.00, '2025-07-17 08:50:48', '2025-07-17 08:50:48'),
(31, '9f69cce1-6656-4b71-9948-a5734b181e8f', 'Service Bearing Housing', 1, 2500000.00, '2025-07-17 08:52:57', '2025-07-17 08:52:57'),
(32, '9f69cce1-6656-4b71-9948-a5734b181e8f', 'Bearing KOYO 6207-2RS', 1, 320000.00, '2025-07-17 08:52:57', '2025-07-17 08:52:57'),
(33, '9f69cce1-6656-4b71-9948-a5734b181e8f', 'Fan Pendingin Motor Frame 100 Universal', 1, 250000.00, '2025-07-17 08:52:57', '2025-07-17 08:52:57'),
(34, '9f69ce20-5e7d-4e22-8f37-9ba50500a0d0', 'Overhaul Motor Toshiba 15 kW', 1, 6500000.00, '2025-07-17 08:56:26', '2025-07-17 08:56:26'),
(35, '9f69ce20-5e7d-4e22-8f37-9ba50500a0d0', 'Bearing NTN NU210', 1, 750000.00, '2025-07-17 08:56:26', '2025-07-17 08:56:26'),
(36, '9f69ce20-5e7d-4e22-8f37-9ba50500a0d0', 'Service Panel MCC', 1, 4500000.00, '2025-07-17 08:56:26', '2025-07-17 08:56:26'),
(37, '9f69d029-fb08-49d3-9c9b-64fa635141a4', 'Bearing SKF 6203-2RS', 1, 180000.00, '2025-07-17 09:02:07', '2025-07-17 09:02:07'),
(38, '9f69d029-fb08-49d3-9c9b-64fa635141a4', 'Fan Pendingin Motor Frame 90 Universal', 1, 200000.00, '2025-07-17 09:02:08', '2025-07-17 09:02:08'),
(39, '9f69d1b3-ed38-4db9-9350-baaf563f67f6', 'Overhaul Motor ABB 11 kW', 1, 4800000.00, '2025-07-17 09:06:26', '2025-07-17 09:06:26'),
(40, '9f69d1b3-ed38-4db9-9350-baaf563f67f6', 'Bearing NSK 6210', 1, 400000.00, '2025-07-17 09:06:26', '2025-07-17 09:06:26'),
(41, '9f69d1b3-ed38-4db9-9350-baaf563f67f6', 'Fan Pendingin Motor Frame 132 OEM ABB', 1, 900000.00, '2025-07-17 09:06:26', '2025-07-17 09:06:26'),
(42, '9f69d2d8-55d8-4c3f-86e0-18906752fef3', 'Service Coil Break Motor WEG', 1, 1750000.00, '2025-07-17 09:09:37', '2025-07-17 09:09:37'),
(43, '9f69d2d8-55d8-4c3f-86e0-18906752fef3', 'Bearing Motor KOYO 6205', 1, 250000.00, '2025-07-17 09:09:37', '2025-07-17 09:09:37'),
(44, '9f69d3e6-7155-4821-9626-f22647c54e01', 'Service Panel MCC', 1, 4500000.00, '2025-07-17 09:12:34', '2025-07-17 09:12:34'),
(45, '9f69d3e6-7155-4821-9626-f22647c54e01', 'Bearing Motor FAG NU215', 1, 1200000.00, '2025-07-17 09:12:34', '2025-07-17 09:12:34'),
(46, '9f69d3e6-7155-4821-9626-f22647c54e01', 'Kabel Power 25m', 1, 1000000.00, '2025-07-17 09:12:34', '2025-07-17 09:12:34'),
(47, '9f69d46b-c6cb-41e3-8c02-d8bfe0b681f0', 'Rewinding Motor Toshiba 5 kW', 1, 6000000.00, '2025-07-17 09:14:02', '2025-07-17 09:14:02'),
(48, '9f69d46b-c6cb-41e3-8c02-d8bfe0b681f0', 'Bearing NTN NU210', 1, 750000.00, '2025-07-17 09:14:02', '2025-07-17 09:14:02'),
(49, '9f69d46b-c6cb-41e3-8c02-d8bfe0b681f0', 'Rotor Balancing Dinamis', 1, 1200000.00, '2025-07-17 09:14:02', '2025-07-17 09:14:02'),
(50, '9f69d553-c96b-439e-b8dc-5b2d231f6ed3', 'Overhaul Motor WEG Pompa Air 3 kW', 1, 2500000.00, '2025-07-17 09:16:34', '2025-07-17 09:16:34'),
(51, '9f69d553-c96b-439e-b8dc-5b2d231f6ed3', 'Bearing Motor NSK 6204-2RS', 1, 200000.00, '2025-07-17 09:16:34', '2025-07-17 09:16:34'),
(52, '9f69d5a9-621e-4775-8dcd-11fbed179b90', 'Bearing Motor SKF 6202-2RS', 1, 150000.00, '2025-07-17 09:17:30', '2025-07-17 09:17:30');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_11_29_121332_create_invoices_table', 1),
(4, '2025_02_30_163936_create_invoice_details_table', 1),
(5, '2025_06_19_121224_create_barangs_table', 1),
(6, '2025_07_18_162105_create_password_reset_tokens_table', 2);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `ttd` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `ttd`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$.jvPiHWmg217XEvZdIYDD.SqdtajRtLoDP/l40MbjbBpMCh067f5K', 'ttd/ttd_admin.png', 'admin', 'non-active', NULL, NULL, '2025-07-17 08:47:24'),
(2, 'Lian', 'lianto@gmail.com', NULL, '$2y$12$74xh7eMXs0olFQJDLRLl/eEEVt7c7Jk4FRRpDStT00HE3fTdGPUGy', 'ttd/ttd_lian.png', 'admin', 'active', NULL, '2025-07-17 07:30:09', '2025-07-18 08:55:21'),
(3, 'Kiven', 'kipen@gmail.com', NULL, '$2y$12$umSlg2lLINT4jlQptj9vPukztjcRvdIlEGNfLJqprIJiyRYjXxAM.', 'ttd/ttd_kiven.png', 'user', 'active', NULL, '2025-07-17 08:48:05', '2025-07-17 08:48:05'),
(4, 'Lianto', 'lianto1566@gmail.com', NULL, '$2y$12$sZZRs7FXZk4OwH3vh0pw0O0n3IkqDBpaTfaruL8urwf.vE/o8mi22', 'ttd/ttd_lianto.png', 'user', 'active', NULL, '2025-07-18 09:33:12', '2025-07-18 10:53:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_nama_unique` (`nama`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_id_unique` (`id`),
  ADD UNIQUE KEY `invoices_nomor_unique` (`nomor`),
  ADD KEY `invoices_id_pegawai_foreign` (`id_pegawai`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_id_invoice_foreign` (`id_invoice`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_id_invoice_foreign` FOREIGN KEY (`id_invoice`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
