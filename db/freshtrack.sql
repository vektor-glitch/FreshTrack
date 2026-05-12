-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Apr 12, 2026 at 07:19 AM
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
-- Database: `freshtrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` varchar(36) NOT NULL,
  `nama_categories` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_categories`, `icon`) VALUES
('9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Sayuran', 'fa-leaf'),
('9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Buah-buahan', 'fa-apple-alt'),
('9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Produk Hewani', 'fa-egg'),
('9b0ee1b5-362c-11f1-a656-fc702eba7aae', 'Susu & Olahannya', 'fa-cheese'),
('9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Bumbu & Saus', 'fa-bottle-droplet');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `category_id` varchar(36) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `category_id`, `nama_bahan`, `tanggal_kadaluarsa`, `created_at`, `updated_at`) VALUES
('b419255a-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Apel Fuji', '2026-04-30', '2026-04-01 01:00:00', '2026-04-10 02:15:00'),
('b4192c78-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Pisang Cavendish', '2026-04-15', '2026-04-08 07:30:00', '2026-04-11 09:00:00'),
('b4192de2-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Jeruk Mandarin', '2026-04-20', '2026-04-05 03:00:00', '2026-04-12 00:30:00'),
('b4192f7e-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Semangka Potong', '2026-04-14', '2026-04-10 11:00:00', '2026-04-11 13:00:00'),
('b41930d1-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Anggur Merah', '2026-04-18', '2026-04-05 02:45:00', '2026-04-10 04:20:00'),
('b419320e-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Mangga Harum Manis', '2026-04-16', '2026-04-07 09:20:00', '2026-04-12 01:10:00'),
('b41932fd-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Pear Century', '2026-04-25', '2026-04-02 00:15:00', '2026-04-09 06:45:00'),
('b419338c-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Telur Ayam Horn (1 Kg)', '2026-05-05', '2026-04-10 02:00:00', '2026-04-11 03:30:00'),
('b4193428-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Daging Sapi Giling', '2026-04-14', '2026-04-11 10:00:00', '2026-04-11 23:00:00'),
('b41934b1-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Dada Ayam Fillet', '2026-04-15', '2026-04-10 09:45:00', '2026-04-12 01:00:00'),
('b419353b-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Ikan Salmon Segar', '2026-04-11', '2026-04-06 04:00:00', '2026-04-12 02:00:00'),
('b41935bf-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Sosis Sapi Bratwurst', '2026-04-25', '2026-04-05 06:00:00', '2026-04-10 08:20:00'),
('b4193649-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Udang Kupas', '2026-04-13', '2026-04-10 12:30:00', '2026-04-11 00:45:00'),
('b41936cb-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Telur Puyuh Rebus', '2026-04-16', '2026-04-09 07:00:00', '2026-04-11 05:00:00'),
('b419374e-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Bayam Hijau', '2026-04-14', '2026-04-11 01:30:00', '2026-04-12 00:00:00'),
('b41937d5-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Wortel Impor', '2026-04-28', '2026-04-05 03:15:00', '2026-04-09 09:30:00'),
('b4193863-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0ee1b5-362c-11f1-a656-fc702eba7aae', 'Susu UHT Full Cream', '2026-05-12', '2026-04-01 08:00:00', '2026-04-10 02:00:00'),
('b419391b-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0ee1b5-362c-11f1-a656-fc702eba7aae', 'Keju Cheddar Olahan', '2026-10-12', '2026-03-20 04:00:00', '2026-04-05 07:00:00'),
('b41939c5-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Kecap Manis', '2027-01-01', '2026-02-15 02:30:00', '2026-04-01 03:15:00'),
('b4193a4f-362c-11f1-a656-fc702eba7aae', '89ecece8-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Saus Sambal Ekstra Pedas', '2026-12-01', '2026-03-10 05:45:00', '2026-04-08 12:20:00'),
('c560b0fe-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Kangkung Cabut', '2026-04-14', '2026-04-09 23:30:00', '2026-04-11 11:00:00'),
('c560b9dd-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Brokoli Hijau', '2026-04-16', '2026-04-08 00:15:00', '2026-04-11 02:00:00'),
('c560bb10-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Sawi Hijau (Caisim)', '2026-04-15', '2026-04-09 09:00:00', '2026-04-11 23:45:00'),
('c560bc25-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Tomat Merah', '2026-04-18', '2026-04-05 03:20:00', '2026-04-10 07:15:00'),
('c560bdc4-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Cabai Rawit Merah', '2026-04-25', '2026-04-08 04:30:00', '2026-04-11 10:00:00'),
('c560becb-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Bawang Merah', '2026-05-10', '2026-03-25 02:00:00', '2026-04-05 05:30:00'),
('c560bfbd-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Bawang Putih', '2026-06-10', '2026-03-25 02:10:00', '2026-04-05 05:35:00'),
('c560c0e5-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Kentang Dieng', '2026-05-05', '2026-04-01 07:45:00', '2026-04-09 03:00:00'),
('c560c2df-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Kubis / Kol', '2026-04-20', '2026-04-05 08:30:00', '2026-04-10 04:20:00'),
('c560c3ce-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Buncis Muda', '2026-04-17', '2026-04-07 01:20:00', '2026-04-11 01:00:00'),
('c560c4ac-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Daun Bawang', '2026-04-15', '2026-04-09 06:15:00', '2026-04-12 00:15:00'),
('c560c60f-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0b9c2a-362c-11f1-a656-fc702eba7aae', 'Jamur Kancing Segar', '2026-04-13', '2026-04-10 09:00:00', '2026-04-11 12:30:00'),
('c560c789-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Saus Tiram Botol', '2026-11-20', '2026-03-10 02:00:00', '2026-04-01 03:00:00'),
('c560c894-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Kecap Asin', '2027-02-15', '2026-02-20 07:15:00', '2026-03-15 04:30:00'),
('c560c9c4-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Minyak Wijen', '2026-09-10', '2026-03-05 03:45:00', '2026-04-05 09:20:00'),
('c560cad3-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Mayonnaise Botol', '2026-06-01', '2026-01-15 01:30:00', '2026-04-02 02:15:00'),
('c560cbda-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Saus Tomat', '2026-12-30', '2026-03-25 04:00:00', '2026-04-10 06:40:00'),
('c560cd3c-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Lada Putih Bubuk', '2027-05-05', '2026-01-10 05:00:00', '2026-03-20 07:50:00'),
('c560ce24-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Ketumbar Bubuk', '2027-04-01', '2026-02-05 06:30:00', '2026-04-01 08:10:00'),
('c560cf07-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Kaldu Jamur / Totoole', '2026-10-10', '2026-03-15 02:20:00', '2026-04-08 10:30:00'),
('c560cff0-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Saus Teriyaki', '2026-08-15', '2026-03-01 09:45:00', '2026-04-05 03:00:00'),
('c560d0d9-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Kecap Inggris', '2027-01-20', '2026-02-28 03:10:00', '2026-04-09 04:45:00'),
('c560d1bf-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Bumbu Kari Instan', '2026-07-07', '2026-03-20 07:00:00', '2026-04-11 06:20:00'),
('c560d297-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0fa6d6-362c-11f1-a656-fc702eba7aae', 'Saus Gochujang', '2026-09-09', '2026-03-12 08:30:00', '2026-04-07 07:40:00'),
('c560d37e-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Alpukat Mentega', '2026-04-15', '2026-04-09 02:00:00', '2026-04-11 09:00:00'),
('c560d485-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0d59cf-362c-11f1-a656-fc702eba7aae', 'Lemon Lokal', '2026-05-01', '2026-04-02 04:30:00', '2026-04-08 03:15:00'),
('c560d5f8-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Telur Bebek Mentah', '2026-04-28', '2026-04-05 06:45:00', '2026-04-10 02:50:00'),
('c560d720-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0e0c97-362c-11f1-a656-fc702eba7aae', 'Ayam Kampung Potong', '2026-04-13', '2026-04-11 01:00:00', '2026-04-11 23:30:00'),
('c560d858-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0ee1b5-362c-11f1-a656-fc702eba7aae', 'Yoghurt Plain Botol', '2026-04-20', '2026-04-06 07:20:00', '2026-04-11 04:10:00'),
('c560d974-362c-11f1-a656-fc702eba7aae', '91ac17d0-362c-11f1-a656-fc702eba7aae', '9b0ee1b5-362c-11f1-a656-fc702eba7aae', 'Mentega / Unsalted Butter', '2026-08-01', '2026-03-18 03:00:00', '2026-04-05 08:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` varchar(36) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi_singkat` varchar(255) NOT NULL,
  `langkah_pembuatan` text NOT NULL,
  `estimasi_waktu` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `judul`, `deskripsi_singkat`, `langkah_pembuatan`, `estimasi_waktu`, `gambar`, `created_at`, `updated_at`) VALUES
('44bc6694-362e-11f1-a656-fc702eba7aae', 'Orak-Arik Sayur Telur', 'Menu sarapan sehat dan super cepat.', '1. Kocok telur dengan sedikit garam.\n2. Tumis bawang merah dan bawang putih hingga harum.\n3. Masukkan wortel dan buncis, tumis hingga agak layu.\n4. Tuang telur kocok, aduk cepat hingga menjadi orak-arik.\n5. Angkat dan sajikan hangat.', 15, 'orak_arik_sayur.jpg', '2026-04-12 05:12:54', '2026-04-12 05:12:54'),
('4ac020c6-362e-11f1-a656-fc702eba7aae', 'Tumis Brokoli Daging Giling ala Resto', 'Sajian kaya protein yang praktis dengan bumbu gurih saus tiram.', '1. Rebus brokoli setengah matang, tiriskan.\n2. Tumis bawang putih hingga harum, masukkan daging giling.\n3. Masak hingga daging berubah warna.\n4. Masukkan brokoli, saus tiram, dan minyak wijen.\n5. Aduk rata, masak sebentar lalu angkat.', 25, 'tumis_brokoli_daging.jpg', '2026-04-12 05:13:04', '2026-04-12 05:13:04'),
('5587e06e-362e-11f1-a656-fc702eba7aae', 'Salad Buah Yoghurt Segar', 'Cemilan sehat tinggi serat. Cocok dinikmati saat cuaca panas.', '1. Potong dadu apel dan mangga.\n2. Belah anggur menjadi dua bagian, buang bijinya.\n3. Campurkan yoghurt dan mayonnaise dalam mangkuk kecil.\n4. Siram saus yoghurt ke atas potongan buah.\n5. Simpan di kulkas sebentar sebelum dinikmati.', 10, 'salad_buah_yoghurt.jpg', '2026-04-12 05:13:22', '2026-04-12 05:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` varchar(36) NOT NULL,
  `recipe_id` varchar(36) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `nama_bahan`) VALUES
('51e81789-362e-11f1-a656-fc702eba7aae', '4ac020c6-362e-11f1-a656-fc702eba7aae', 'Brokoli Hijau'),
('51e81bdb-362e-11f1-a656-fc702eba7aae', '4ac020c6-362e-11f1-a656-fc702eba7aae', 'Daging Sapi Giling'),
('51e81d1d-362e-11f1-a656-fc702eba7aae', '4ac020c6-362e-11f1-a656-fc702eba7aae', 'Bawang Putih'),
('51e81e12-362e-11f1-a656-fc702eba7aae', '4ac020c6-362e-11f1-a656-fc702eba7aae', 'Saus Tiram Botol'),
('51e81eba-362e-11f1-a656-fc702eba7aae', '4ac020c6-362e-11f1-a656-fc702eba7aae', 'Minyak Wijen'),
('5af0399b-362e-11f1-a656-fc702eba7aae', '5587e06e-362e-11f1-a656-fc702eba7aae', 'Apel Fuji'),
('5af04125-362e-11f1-a656-fc702eba7aae', '5587e06e-362e-11f1-a656-fc702eba7aae', 'Anggur Merah'),
('5af0434c-362e-11f1-a656-fc702eba7aae', '5587e06e-362e-11f1-a656-fc702eba7aae', 'Mangga Harum Manis'),
('5af044bf-362e-11f1-a656-fc702eba7aae', '5587e06e-362e-11f1-a656-fc702eba7aae', 'Yoghurt Plain Botol'),
('5af045e6-362e-11f1-a656-fc702eba7aae', '5587e06e-362e-11f1-a656-fc702eba7aae', 'Mayonnaise Botol');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_notif` tinyint(1) NOT NULL DEFAULT 1,
  `reminder_day` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `email_notif`, `reminder_day`, `created_at`, `updated_at`) VALUES
('89ecece8-362c-11f1-a656-fc702eba7aae', 'Vektor', '$2y$10$wWyDZ9v9LGZOtzrYL2V.sOlno4fa0pXy00xoAsFpNNhGSs9N1T2gy', 'vektorino12@gmail.com', 1, 7, '2026-04-12 05:00:36', '2026-04-12 05:00:36'),
('91ac17d0-362c-11f1-a656-fc702eba7aae', 'Lintang', '$2y$10$6PcRiuCKwgrdt4/UF/mmcumvUKmfiODzjjUYEgNdo0qecIivV1wUm', 'lintangkinasih80@gmail.com', 1, 3, '2026-04-12 05:00:44', '2026-04-12 05:00:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventories_user` (`user_id`),
  ADD KEY `fk_inventories_category` (`category_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipe_ingredients` (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `fk_inventories_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_inventories_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `fk_recipe_ingredients` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
