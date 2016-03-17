-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Inang: localhost:3306
-- Waktu pembuatan: 17 Mar 2016 pada 02.00
-- Versi Server: 5.5.48-cll
-- Versi PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `k0455101_portal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `_id` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `companies`
--

INSERT INTO `companies` (`id`, `name`, `_id`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'PT BDO Konsultan Indonesia', 'BKI', 1, 1, '2016-01-18 09:00:52', 0, '0000-00-00 00:00:00'),
(2, 'PT BDO Entertainment Indonesia', 'BEI', 1, 1, '2016-01-18 09:01:53', 0, '0000-00-00 00:00:00'),
(3, 'PT BDO Film Indonesia', 'BFI', 1, 1, '2016-01-18 09:05:24', 1, '2016-01-18 09:06:08'),
(4, 'PT BDO Indonesia Raya', 'BIR', 1, 5, '2016-01-19 09:02:46', 0, '0000-00-00 00:00:00'),
(5, 'Twitter Asia Pacific', 'TTWRID01', 1, 5, '2016-01-19 09:45:24', 5, '2016-01-20 10:25:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_access` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `files`
--

INSERT INTO `files` (`id`, `name`, `mime`, `company_id`, `description`, `user_access`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(12, 'Adi Payslip Feb 16.pdf', 'application/pdf', 5, 'Payslip February 2016', 'Adi ', 1, 5, '2016-03-08 02:16:42', 5, '2016-03-15 10:27:44'),
(13, 'Agung Payslip Feb 16.pdf', 'application/pdf', 5, 'Payslip February 2016', 'Agung', 1, 5, '2016-03-08 02:19:20', 5, '2016-03-15 10:27:51'),
(14, 'Dwi Payslip Feb 16.pdf', 'application/pdf', 5, 'Payslip February 2016', 'Dwi', 1, 5, '2016-03-08 02:20:26', 5, '2016-03-15 10:27:57'),
(15, 'Priscila Payslip Feb 16.pdf', 'application/pdf', 5, 'Payslip February 2016', 'Priscila', 1, 5, '2016-03-08 02:21:18', 5, '2016-03-15 10:28:03'),
(16, 'Roy Payslip Feb 16.pdf', 'application/pdf', 5, 'Payslip February 2016', 'Roy', 1, 5, '2016-03-08 02:22:16', 5, '2016-03-15 10:28:14'),
(17, 'Teguh Payslip Feb 16.pdf', 'application/pdf', 5, 'Payslip February 2016', 'Yohanes Teguh', 1, 5, '2016-03-08 02:23:07', 5, '2016-03-15 10:28:22'),
(18, 'KETENTUAN BATASAN UPAH DAN MANFAAT JAMINAN PENSIUN TAHUN 2016.PDF', 'application/pdf', 5, 'Information on the change of regulation in wages limitation and pension benefits year 2016', 'Adi ,Agung,Dwi,Priscila,Roy,Yohanes Teguh', 1, 5, '2016-03-15 10:17:42', 5, '2016-03-16 02:22:43'),
(24, 'Agung Payslip Jan 16.pdf', 'application/pdf', 5, 'Payslip Jan 16', 'Agung', 1, 5, '2016-03-15 10:41:04', 0, '0000-00-00 00:00:00'),
(25, 'Adi Payslip Jan 16.pdf', 'application/pdf', 5, 'Payslip Jan 16', 'Adi ', 1, 5, '2016-03-15 10:41:34', 0, '0000-00-00 00:00:00'),
(26, 'Dwi Payslip Jan 16.pdf', 'application/pdf', 5, 'Payslip Jan 16', 'Dwi', 1, 5, '2016-03-15 10:41:51', 0, '0000-00-00 00:00:00'),
(27, 'Priscila Payslip Jan 16.pdf', 'application/pdf', 5, 'Payslip Jan 16', 'Priscila', 1, 5, '2016-03-15 10:42:17', 0, '0000-00-00 00:00:00'),
(28, 'Roy Payslip Jan 16.pdf', 'application/pdf', 5, 'Payslip Jan 16', 'Roy', 1, 5, '2016-03-15 10:42:40', 0, '0000-00-00 00:00:00'),
(29, 'Teguh Payslip Jan 16.pdf', 'application/pdf', 5, 'Payslip Jan 16', 'Yohanes Teguh', 1, 5, '2016-03-15 10:42:58', 0, '0000-00-00 00:00:00'),
(30, 'Agung Payslip Year 2015.zip', 'application/x-zip-compressed', 5, 'Payslip Year 2015', 'Agung', 1, 5, '2016-03-16 02:20:07', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_users`
--

CREATE TABLE IF NOT EXISTS `file_users` (
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_users`
--

INSERT INTO `file_users` (`file_id`, `user_id`) VALUES
(12, 14),
(13, 16),
(14, 18),
(15, 15),
(16, 13),
(17, 17),
(24, 16),
(25, 14),
(26, 18),
(27, 15),
(28, 13),
(29, 17),
(30, 16),
(18, 14),
(18, 16),
(18, 18),
(18, 15),
(18, 13),
(18, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `authorize` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `authorize`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 1, 1, 0, '2016-01-14 20:32:05', 0, '0000-00-00 00:00:00'),
(2, 'user', 'User BDO', 0, 1, 1, '2016-01-15 10:44:54', 5, '2016-01-18 04:27:46'),
(3, 'superuser', 'Super User ', 2, 1, 5, '2016-01-18 04:28:07', 5, '2016-03-15 09:41:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `information` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `company_id`, `first_name`, `role_id`, `last_name`, `email`, `password`, `remember_token`, `information`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Hendarsyah', 1, 'Suhendar', 'hendarsyahss@gmail.com', '$2y$10$vOkvPAfONeAOrbP0NEVBnOC8BQDOGUA6sxzWKmT88YBxOBbPcF44O', 'NgMGzj2GJbHBkRoPtI6P0AbTDU2RVW8igxzRxnjAveRYakgDDNeWGzgZnOik', 'Sisa Cuti 12', 1, 0, '2016-01-14 20:33:32', 1, 2016),
(2, 1, 'Thano', 1, 'Tanubratha', 'atanubrata@bdo.co.id', '$2y$10$HBbBsWzlIA4ohMighY2Mz.gOaa5gL2YaRUb59pGik8Y284ZDDVYHC', 'Zkl7XI8vn0VQ31XeF3bbVMcJin7miw2tZcC8mOhzOjVvy7ZfGQfF6oWkIrEL', 'Sisa Cuti 16', 1, 1, '2016-01-15 10:45:31', 2, 2016),
(3, 4, 'Rangga', 2, 'Widodo', 'rangga@bdo.co.id', '$2y$10$yNO0nskJYt9Al0Uievj5YubWC5RJrXfup2KUxx6fzm7HYwr/UB8b.', 'ZIP0tccRGJPmnKJtkOrq4t3RgJNw39NCBnmqbMYmVVtlojryYK8CABIQ6oXA', '12 days (as per Nov 2015)', 1, 1, '2016-01-15 10:46:11', 5, 2016),
(5, 1, 'Admin', 1, 'BDo', 'admin@bdo.co.id', '$2y$10$5J9tIv1ECu182ICA1ahkdOSsObyZR1IKfoBxNgJWH4M1Fo2gb7Yc6', '2cVMBwRg1QpAUcOJ58OX0jOGqVJxUeneXweosEAxvsiXLu0mlKo8g5tSPDrp', 'Cuti', 1, 1, '2016-01-18 02:16:18', 0, 0),
(7, 4, 'Henni', 2, 'Joe Taslim', 'htaslim@bdo.co.id', '$2y$10$TySgfKWk2oPlrdgJcSyVQex.EJ84kfYp6qTn/nz1L5JUYYkxXsmX6', '', '7 days (as per Apr 2015)', 1, 5, '2016-01-18 04:31:37', 5, 2016),
(9, 1, 'Super', 3, 'User', 'superuser@bdo.co.id', '$2y$10$IGDHOLAn3HXqiOOeKvhMf..WrSgEmSL.7.hWE/b2TD2Oa92KrWrMa', 'poEfkpyqbkQyRcz6YdM5yy8kqmSfw2iCava8mISW84w3kts764CqysGrX3G7', '8', 1, 5, '2016-01-18 04:55:12', 0, 0),
(12, 1, 'Mahardika', 3, 'Iman', 'iman@bdo.co.id', '$2y$10$S2lticdzmEGd4/l5QO.CS.gCUwT3PPHzsVWXEvysJEPUhJGMa7ZuG', 'nwQ4acM0DgrrsrmVqdBpTDX3kPZV4cUvyoTeZfehyJATd7l9TlV9YIdZ2GnS', '-', 1, 5, '2016-01-19 09:05:50', 5, 2016),
(13, 5, 'Roy', 2, 'Simangunsong', 'rsimangunsong@twitter.com', '$2y$10$B53MWGTjBeBFkvO/RA328.kaCyfF.PuMxM4P2EY9G4GgpNyJn7dQm', 'fNwOEsZKKIxjqfjJP50PfNjUtcbUGAYzKsR9YJmDEylCZHr7tpGUNT6iH5Xj', 'TBC', 1, 5, '2016-01-19 09:47:39', 5, 2016),
(14, 5, 'Adi ', 2, 'Samsudin', 'asamsudin@twitter.com', '$2y$10$5ie031X1wxJLG52YM96AB.aDu9zQ/36mm8uZ.i82qhvh1eq4WEfvO', 'EzAiuZhWT8bIj6C1o56mGbO5LdYitoXZ8DnNl73hCQTAWxUYj2BBCPZeKvvU', 'TBC', 1, 5, '2016-01-22 02:52:06', 5, 2016),
(15, 5, 'Priscila', 2, 'Carlita', 'pcarlita@twitter.com', '$2y$10$XumRkInpO/YcACmdNqxHvu/TaOcK7WKCaDz/o4u6VBgD1OW/y7NUG', 'VgwQgZkot6fElX3DVkfH1QCYgzqLduLqGXv0EaHQ2jYsRjmLcmkJ4lvXIjog', 'TBC', 1, 5, '2016-01-22 03:04:58', 5, 2016),
(16, 5, 'Agung', 2, 'Yudhawiranata', 'agungyudha@twitter.com', '$2y$10$WVZ15il/xiWhrPjXYYGpHeFOgz82w8xksCre/nOA.dXyICSL1qh6W', 'kEX1wF0BltgdiNnXwGxEp0P83Zcas6mcYJPeBXfsKF6ORXpbGyimlTXAA794', 'TBC', 1, 5, '2016-01-22 08:22:39', 5, 2016),
(17, 5, 'Yohanes Teguh', 2, 'Wicaksono', 'twicaksono@twitter.com', '$2y$10$CvMk6NGwc4ltO9AC5/e6DujokHpitmlHIJkeyeW8Tb11oQb2aDX6O', 't2UZNekXmB5wtFVzxU1rYFzMMrfvrkdaSM32AK4Z4yVSAjJMyptTKWITWc0J', 'TBD', 1, 5, '2016-03-08 02:10:36', 0, 0),
(18, 5, 'Dwi', 2, 'Adriansah', 'dadriansah@twitter.com', '$2y$10$yzEXMeedA82N3FC6doSOHOEhSdKc.D7qlGV.8IBZfbCekg6SAH45K', 'bzb1BTzifq9WWhWuYsvGHmQ1OcE4rWSnRD3TyFFJ6nm9b3cCl0vPZepJttjz', 'TBD', 1, 5, '2016-03-08 02:12:26', 0, 0),
(19, 5, 'Alyssa', 3, 'Tan', 'atan@twitter.com', '$2y$10$BAGMzr0IE1jbEbFxPEuIsOyq4.DcwYv8cJ3.oUV3RryJFGVffjj1a', 'j1qJcrHhxotHp9DiH3BUfIMML4iDfY1tYWUQOktCdBkxpfJtw1cgcRn7Svm2', '-', 1, 5, '2016-03-15 09:57:19', 5, 2016);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
