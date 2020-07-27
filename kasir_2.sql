-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jul 2020 pada 17.51
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(7, 'ASUS'),
(8, 'SAMSUNG'),
(9, 'XIAOMI'),
(10, 'IPHONE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `color` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `color`
--

INSERT INTO `color` (`id`, `type_id`, `color`) VALUES
(28, 6, 'pink'),
(29, 6, 'black'),
(30, 6, 'green'),
(31, 7, 'black'),
(32, 7, 'blue'),
(33, 7, 'white'),
(34, 8, 'black'),
(35, 8, 'blue'),
(36, 8, 'red'),
(37, 8, 'green'),
(38, 9, 'red'),
(39, 9, 'green'),
(40, 9, 'black'),
(41, 10, 'red'),
(42, 10, 'black'),
(43, 11, 'hitam'),
(44, 12, 'black'),
(45, 12, 'pink'),
(46, 12, 'white'),
(49, 14, 'black'),
(50, 15, 'blue'),
(51, 15, 'white'),
(52, 16, 'black'),
(53, 16, 'blue'),
(54, 16, 'green'),
(55, 13, 'blue'),
(56, 13, 'red'),
(62, 17, 'white pink'),
(63, 17, 'black'),
(64, 17, 'dark blue'),
(67, 18, 'black'),
(68, 18, 'white'),
(69, 18, 'pink'),
(70, 19, 'black');

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_detail`
--

CREATE TABLE `input_detail` (
  `id` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `input_detail`
--

INSERT INTO `input_detail` (`id`, `username`, `description`, `date_create`) VALUES
('069eb08e4277474383c434a22f9d240f', 'labbaika', '', 1595681909),
('7de0a20190bd190e2ce57d613fda3e19', 'labbaika', '', 1595670362),
('e0fcc4d483cef3f2d5efafd1601e4db7', 'ika', '', 1595781280);

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_stock`
--

CREATE TABLE `input_stock` (
  `id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `brand` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `color` varchar(128) NOT NULL,
  `memory` varchar(128) NOT NULL,
  `purchase_price` varchar(128) NOT NULL,
  `selling_price` varchar(128) NOT NULL,
  `input_detail_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `input_stock`
--

INSERT INTO `input_stock` (`id`, `serial_number`, `brand`, `type`, `color`, `memory`, `purchase_price`, `selling_price`, `input_detail_id`) VALUES
(54, '15956703599040', 'XIAOMI', 'NOTE 7', 'white pink', '4/64', '2999000', '3200000', '7de0a20190bd190e2ce57d613fda3e19'),
(55, '15956703599041', 'XIAOMI', 'NOTE 7', 'white pink', '4/64', '2999000', '3200000', '7de0a20190bd190e2ce57d613fda3e19'),
(56, '15956703599052', 'XIAOMI', 'NOTE 7', 'black', '4/64', '2999000', '3200000', '7de0a20190bd190e2ce57d613fda3e19'),
(57, '15956703599053', 'XIAOMI', 'NOTE 7', 'dark blue', '4/64', '2999000', '3200000', '7de0a20190bd190e2ce57d613fda3e19'),
(58, '15956703599054', 'XIAOMI', 'NOTE 7', 'white pink', '8/64', '3300000', '3500000', '7de0a20190bd190e2ce57d613fda3e19'),
(59, '15956703599055', 'XIAOMI', 'NOTE 7', 'black', '8/64', '3300000', '3500000', '7de0a20190bd190e2ce57d613fda3e19'),
(60, '15956703599056', 'XIAOMI', 'NOTE 7', 'dark blue', '8/64', '3300000', '3500000', '7de0a20190bd190e2ce57d613fda3e19'),
(61, '15956703599067', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000', '7de0a20190bd190e2ce57d613fda3e19'),
(62, '15956703599068', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000', '7de0a20190bd190e2ce57d613fda3e19'),
(63, '15956703599069', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000', '7de0a20190bd190e2ce57d613fda3e19'),
(64, '159567035990610', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000', '7de0a20190bd190e2ce57d613fda3e19'),
(65, '159567035990711', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'black', '3/32', '2799000', '2900000', '7de0a20190bd190e2ce57d613fda3e19'),
(66, '159567035990712', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'black', '4/64', '3199000', '3300000', '7de0a20190bd190e2ce57d613fda3e19'),
(67, '159567035990713', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'black', '6/64', '3699000', '3800000', '7de0a20190bd190e2ce57d613fda3e19'),
(68, '159567035990714', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'pink', '3/32', '2799000', '2900000', '7de0a20190bd190e2ce57d613fda3e19'),
(69, '159567035990815', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'pink', '4/64', '3199000', '3300000', '7de0a20190bd190e2ce57d613fda3e19'),
(70, '159567035990816', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'pink', '6/64', '3699000', '3800000', '7de0a20190bd190e2ce57d613fda3e19'),
(71, '159567035990817', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'white', '3/32', '2799000', '2900000', '7de0a20190bd190e2ce57d613fda3e19'),
(72, '159567035990818', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'white', '4/64', '3199000', '3300000', '7de0a20190bd190e2ce57d613fda3e19'),
(74, '159567035990920', 'IPHONE', '7 PRO', 'black', '8/32', '8100000', '8300000', '7de0a20190bd190e2ce57d613fda3e19'),
(75, '159567035990921', 'IPHONE', '7 PRO', 'white', '8/32', '8100000', '8300000', '7de0a20190bd190e2ce57d613fda3e19'),
(76, '159567035990922', 'IPHONE', '7 PRO', 'pink', '8/32', '8100000', '8300000', '7de0a20190bd190e2ce57d613fda3e19'),
(77, '159567035991023', 'SAMSUNG', 'GALAXY A30S', 'hitam', '3/32', '3000000', '3100000', '7de0a20190bd190e2ce57d613fda3e19'),
(78, '159567035991024', 'SAMSUNG', 'GALAXY A30S', 'hitam', '3/32', '3000000', '3100000', '7de0a20190bd190e2ce57d613fda3e19'),
(79, '159567035991025', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/32', '3300000', '3400000', '7de0a20190bd190e2ce57d613fda3e19'),
(80, '159567035991026', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/32', '3300000', '3400000', '7de0a20190bd190e2ce57d613fda3e19'),
(81, '159567035991127', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000', '7de0a20190bd190e2ce57d613fda3e19'),
(82, '159567035991128', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000', '7de0a20190bd190e2ce57d613fda3e19'),
(83, '159567035991129', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000', '7de0a20190bd190e2ce57d613fda3e19'),
(84, '159567035991130', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000', '7de0a20190bd190e2ce57d613fda3e19'),
(85, '159567035991231', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000', '7de0a20190bd190e2ce57d613fda3e19'),
(86, '15956818971490', 'ASUS', 'ZENFONE 5Z (ZS620KL)', 'blue', '6/128', '6699000', '7000000', '069eb08e4277474383c434a22f9d240f'),
(87, '15956818971491', 'ASUS', 'ZENFONE 5Z (ZS620KL)', 'blue', '6/128', '6699000', '7000000', '069eb08e4277474383c434a22f9d240f'),
(88, '15957812778830', 'SAMSUNG', 'GALAXY A20S', 'blue', '4/64', '2700000', '2800000', 'e0fcc4d483cef3f2d5efafd1601e4db7'),
(89, '15957812778841', 'SAMSUNG', 'GALAXY A20S', 'blue', '4/64', '2700000', '2800000', 'e0fcc4d483cef3f2d5efafd1601e4db7'),
(90, '15957812778842', 'SAMSUNG', 'GALAXY A20S', 'blue', '4/64', '2700000', '2800000', 'e0fcc4d483cef3f2d5efafd1601e4db7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `memory_price`
--

CREATE TABLE `memory_price` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `memory` varchar(128) NOT NULL,
  `purchase_price` varchar(128) NOT NULL,
  `selling_price` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `memory_price`
--

INSERT INTO `memory_price` (`id`, `type_id`, `memory`, `purchase_price`, `selling_price`) VALUES
(47, 6, '4/64', '1500000', '1550000'),
(48, 6, '3/32', '2500000', '2550000'),
(49, 6, '8/128', '4500000', '4550000'),
(50, 7, '4/64', '3299000', '3400000'),
(51, 8, '3/32', '2400000', '2450000'),
(52, 8, '4/64', '2700000', '2800000'),
(53, 9, '2/32', '1899000', '2000000'),
(54, 10, '4/64', '4099000', '5200000'),
(55, 10, '6/128', '5500000', '5600000'),
(56, 11, '3/32', '3000000', '3100000'),
(57, 11, '4/32', '3300000', '3400000'),
(58, 11, '4/64', '3600000', '3700000'),
(59, 12, '3/32', '2799000', '2900000'),
(60, 12, '4/64', '3199000', '3300000'),
(61, 12, '6/64', '3699000', '3800000'),
(62, 14, '8/128', '12999000', '13300000'),
(63, 14, '8/512', '14499000', '14800000'),
(64, 15, '6/128', '6699000', '7000000'),
(65, 15, '8/256', '7990000', '8200000'),
(66, 16, '4/64', '3599000', '3800000'),
(67, 16, '6/64', '4000000', '4200000'),
(68, 13, '3/32', '1999000', '2200000'),
(69, 13, '4/64', '2399000', '2500000'),
(72, 17, '4/64', '2999000', '3200000'),
(73, 17, '8/64', '3300000', '3500000'),
(75, 18, '8/32', '8100000', '8300000'),
(76, 19, '4/64', '2000000', '2200000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `output_detail`
--

CREATE TABLE `output_detail` (
  `id` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `customor_name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `output_detail`
--

INSERT INTO `output_detail` (`id`, `username`, `customor_name`, `description`, `date_create`) VALUES
('32be2863c64b84ecd8976cb3b966bca3', 'labbaika', '', '', 1595666596),
('488323cf500927d7dfaf5220abcacc44', 'labbaika', 'Bambang', 'matapbek', 1595670522),
('fee8dbf22d742212bcb75608eeb7ced7', 'ika', '', '', 1595781253);

-- --------------------------------------------------------

--
-- Struktur dari tabel `output_stock`
--

CREATE TABLE `output_stock` (
  `id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `brand` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `color` varchar(128) NOT NULL,
  `memory` varchar(128) NOT NULL,
  `purchase_price` varchar(128) NOT NULL,
  `selling_price` varchar(128) NOT NULL,
  `output_detail_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `output_stock`
--

INSERT INTO `output_stock` (`id`, `serial_number`, `brand`, `type`, `color`, `memory`, `purchase_price`, `selling_price`, `output_detail_id`) VALUES
(4, '15956627473150', 'ASUS', 'ZENPHONE 2', 'pink', '4/64', '1500000', '1550000', '32be2863c64b84ecd8976cb3b966bca3'),
(5, '15956627473161', 'ASUS', 'ZENPHONE 2', 'pink', '4/64', '1500000', '1550000', '32be2863c64b84ecd8976cb3b966bca3'),
(6, '159567035990919', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'white', '6/64', '3699000', '3800000', '488323cf500927d7dfaf5220abcacc44'),
(7, '159567035991023', 'SAMSUNG', 'GALAXY A30S', 'hitam', '3/32', '3000000', '3100000', 'fee8dbf22d742212bcb75608eeb7ced7'),
(8, '159567035991024', 'SAMSUNG', 'GALAXY A30S', 'hitam', '3/32', '3000000', '3100000', 'fee8dbf22d742212bcb75608eeb7ced7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `brand` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `color` varchar(128) NOT NULL,
  `memory` varchar(128) NOT NULL,
  `purchase_price` varchar(128) NOT NULL,
  `selling_price` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id`, `serial_number`, `brand`, `type`, `color`, `memory`, `purchase_price`, `selling_price`) VALUES
(1, '15956703599040', 'XIAOMI', 'NOTE 7', 'white pink', '4/64', '2999000', '3200000'),
(2, '15956703599041', 'XIAOMI', 'NOTE 7', 'white pink', '4/64', '2999000', '3200000'),
(3, '15956703599052', 'XIAOMI', 'NOTE 7', 'black', '4/64', '2999000', '3200000'),
(4, '15956703599053', 'XIAOMI', 'NOTE 7', 'dark blue', '4/64', '2999000', '3200000'),
(5, '15956703599054', 'XIAOMI', 'NOTE 7', 'white pink', '8/64', '3300000', '3500000'),
(6, '15956703599055', 'XIAOMI', 'NOTE 7', 'black', '8/64', '3300000', '3500000'),
(7, '15956703599056', 'XIAOMI', 'NOTE 7', 'dark blue', '8/64', '3300000', '3500000'),
(8, '15956703599067', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000'),
(9, '15956703599068', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000'),
(10, '15956703599069', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000'),
(11, '159567035990610', 'XIAOMI', 'NOTE 8', 'black', '4/64', '2000000', '2200000'),
(12, '159567035990711', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'black', '3/32', '2799000', '2900000'),
(13, '159567035990712', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'black', '4/64', '3199000', '3300000'),
(14, '159567035990713', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'black', '6/64', '3699000', '3800000'),
(15, '159567035990714', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'pink', '3/32', '2799000', '2900000'),
(16, '159567035990815', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'pink', '4/64', '3199000', '3300000'),
(17, '159567035990816', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'pink', '6/64', '3699000', '3800000'),
(18, '159567035990817', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'white', '3/32', '2799000', '2900000'),
(19, '159567035990818', 'ASUS', 'ZENFONE MAX PRO (M2) (ZB631KL)', 'white', '4/64', '3199000', '3300000'),
(20, '159567035990920', 'IPHONE', '7 PRO', 'black', '8/32', '8100000', '8300000'),
(21, '159567035990921', 'IPHONE', '7 PRO', 'white', '8/32', '8100000', '8300000'),
(22, '159567035990922', 'IPHONE', '7 PRO', 'pink', '8/32', '8100000', '8300000'),
(25, '159567035991025', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/32', '3300000', '3400000'),
(26, '159567035991026', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/32', '3300000', '3400000'),
(27, '159567035991127', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000'),
(28, '159567035991128', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000'),
(29, '159567035991129', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000'),
(30, '159567035991130', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000'),
(31, '159567035991231', 'SAMSUNG', 'GALAXY A30S', 'hitam', '4/64', '3600000', '3700000'),
(32, '15956818971490', 'ASUS', 'ZENFONE 5Z (ZS620KL)', 'blue', '6/128', '6699000', '7000000'),
(33, '15956818971491', 'ASUS', 'ZENFONE 5Z (ZS620KL)', 'blue', '6/128', '6699000', '7000000'),
(34, '15957812778830', 'SAMSUNG', 'GALAXY A20S', 'blue', '4/64', '2700000', '2800000'),
(35, '15957812778841', 'SAMSUNG', 'GALAXY A20S', 'blue', '4/64', '2700000', '2800000'),
(36, '15957812778842', 'SAMSUNG', 'GALAXY A20S', 'blue', '4/64', '2700000', '2800000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `type`
--

INSERT INTO `type` (`id`, `brand_id`, `type`) VALUES
(6, 7, 'ZENPHONE 2'),
(7, 8, 'GALAXY M30S'),
(8, 8, 'GALAXY A20S'),
(9, 8, 'GALAXY A10S'),
(10, 8, 'GALAXY A50S'),
(11, 8, 'GALAXY A30S'),
(12, 7, 'ZENFONE MAX PRO (M2) (ZB631KL)'),
(13, 7, 'ZENFONE MAX (M2) (ZB633KL)'),
(14, 7, 'ROG PHONE'),
(15, 7, 'ZENFONE 5Z (ZS620KL)'),
(16, 7, 'ZENFONE 5'),
(17, 9, 'NOTE 7'),
(18, 10, '7 PRO'),
(19, 9, 'NOTE 8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone_number` varchar(128) NOT NULL,
  `profile` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `date_create` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `phone_number`, `profile`, `date_create`, `role_id`) VALUES
(1, 'labbaika', '$2y$10$kVU2VD0p.ksYR0E4Gfo8ne.8pPiaQJyYJQGGrZ8l24DpUkgW8m5re', 'Labbaika Asri', '08956187011180', '5f1db23a1bbeb.jpg', 962496000, 1),
(19, 'baika', '$2y$10$3S/XbcbYKy0dyxLS0JxfYulYIz1MHsTeFrIe8nPB6lmM3l0lAS50.', 'Baika', '0895618701180', 'default.jpg', 1595781557, 2),
(20, 'ika', '$2y$10$EdH9zoab.TK6I.Ny4IeHHuro47rmSEB/kcBGxS20wZC2CTTxWukz2', '', '', 'default.jpg', 1595836651, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Employe');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indeks untuk tabel `input_detail`
--
ALTER TABLE `input_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `input_stock`
--
ALTER TABLE `input_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `input_detail_id` (`input_detail_id`);

--
-- Indeks untuk tabel `memory_price`
--
ALTER TABLE `memory_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indeks untuk tabel `output_detail`
--
ALTER TABLE `output_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `output_stock`
--
ALTER TABLE `output_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `output_detail_id` (`output_detail_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `input_stock`
--
ALTER TABLE `input_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `memory_price`
--
ALTER TABLE `memory_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `output_stock`
--
ALTER TABLE `output_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `color`
--
ALTER TABLE `color`
  ADD CONSTRAINT `color_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `input_stock`
--
ALTER TABLE `input_stock`
  ADD CONSTRAINT `input_stock_ibfk_1` FOREIGN KEY (`input_detail_id`) REFERENCES `input_detail` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `memory_price`
--
ALTER TABLE `memory_price`
  ADD CONSTRAINT `memory_price_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `output_detail`
--
ALTER TABLE `output_detail`
  ADD CONSTRAINT `output_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `output_stock` (`output_detail_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `type_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
