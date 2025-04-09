-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Apr 2025 pada 16.33
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
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `leads`
--

CREATE TABLE `leads` (
  `id_leads` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `id_sales` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `no_wa` varchar(10) NOT NULL,
  `nama_lead` varchar(20) NOT NULL,
  `kota` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `leads`
--

INSERT INTO `leads` (`id_leads`, `tanggal`, `id_sales`, `id_produk`, `no_wa`, `nama_lead`, `kota`) VALUES
(1, '2022-09-01', 1, 6, '089433', 'Ucok', 'Medan'),
(2, '2022-08-31', 2, 2, '0843556667', 'Budi', 'Cirebon'),
(3, '2025-04-10', 3, 3, '0849494', 'Ucok', 'Medan'),
(4, '2025-04-10', 1, 2, '08976555', 'Budi', 'Cirebon'),
(5, '2025-04-11', 2, 3, '098765556', 'Budi', 'Cirebon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `nama_produk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`) VALUES
(1, 'Cipta Residence 2'),
(2, 'The Rich'),
(3, 'Namorambe City'),
(4, 'Grand Banten'),
(5, 'Turi Mansion'),
(6, 'Cipta Residence 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(5) NOT NULL,
  `nama_sales` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id_sales`, `nama_sales`) VALUES
(1, 'sales 1'),
(2, 'sales 2'),
(3, 'sales 3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id_leads`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `leads`
--
ALTER TABLE `leads`
  MODIFY `id_leads` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
