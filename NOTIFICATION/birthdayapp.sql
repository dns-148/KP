-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jul 2017 pada 12.21
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `birthdayapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `Nama_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `Nama_divisi`) VALUES
(1, 'IT'),
(2, 'Marketing'),
(3, 'Production'),
(4, 'Event');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Jenis_kelamin` varchar(20) NOT NULL,
  `Alamat` varchar(50) DEFAULT NULL,
  `Tanggal_lahir` date NOT NULL,
  `NoTelp` int(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `Password` varchar(20) NOT NULL,
  `id_divisi` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `Nama`, `Jenis_kelamin`, `Alamat`, `Tanggal_lahir`, `NoTelp`, `email`, `Password`, `id_divisi`) VALUES
(1, 'Puji Astuti', 'Perempuan', 'Surabaya', '1981-07-09', NULL, NULL, 'M001', 1),
(2, 'Dhimas Dwijo Rahminto', 'Laki-laki', 'Jakarta', '1996-05-05', 858676141, '', 'M05', 1),
(3, 'Fata Hirzi Abi Karami', 'Laki-laki', 'Surabaya', '1997-03-11', 858676141, '', 'M07', 3),
(4, 'Ahmad Afiif Naufal', 'Laki-laki', 'Surabaya', '1997-03-12', 858676141, '', 'M08', 4),
(5, 'Nody Risky Pratomo', 'Laki-laki', 'Surabaya', '1997-03-13', 858676141, '', 'M09', 1),
(6, 'Mustika Kurnia Mayangsari', 'Perempuan', 'Surabaya', '1997-03-14', 858676141, '', 'M10', 2),
(7, 'Faiz Nur Fitrah Insani', 'Laki-laki', 'Surabaya', '1997-03-15', 858676141, '', 'M11', 3),
(8, 'Nur Maulidiah El Fajr', 'Perempuan', 'Surabaya', '1997-03-16', 858676141, '', 'M12', 4),
(9, 'Anugrah Dwiatmaja Putra', 'Laki-laki', 'Surabaya', '1997-03-17', 858676141, '', 'M13', 1),
(10, 'Delia Risti Nareswar', 'Perempuan', 'Surabaya', '1997-03-18', 858676141, '', 'M14', 2),
(11, 'Miftakhul Akhyar', 'Laki-laki', 'Surabaya', '1997-03-19', 858676141, '', 'M15', 3),
(12, 'Isyana Rosita Arroyyani', 'Perempuan', 'Surabaya', '1997-12-06', 858676141, '', 'M16', 4),
(13, 'Gradiyanto Nugroho', 'Laki-laki', 'Surabaya', '1997-12-07', 858676141, '', 'M17', 1),
(14, 'Silfia Rahmawati', 'Perempuan', 'Surabaya', '1997-12-08', 858676141, '', 'M18', 2),
(15, 'Aisyah Khoiril Ulfah', 'Perempuan', 'Surabaya', '1997-12-09', 858676141, '', 'M19', 3),
(16, 'Sirria Panah Alam', 'Perempuan', 'Surabaya', '1997-12-10', 858676141, '', 'M20', 4),
(17, 'M. Azka Yasin', 'Laki-laki', 'Surabaya', '1997-12-11', 858676141, '', 'M21', 1),
(18, 'Fatimatus Zulfa', 'Perempuan', 'Surabaya', '1997-12-12', 858676141, '', 'M22', 2),
(19, 'William Albertus Dembo', 'Laki-laki', 'Surabaya', '1997-12-13', 858676141, '', 'M23', 3),
(20, 'M. Illham Hanafi', 'Laki-laki', 'Surabaya', '1997-12-14', 858676141, '', 'M24', 4),
(21, 'Weny Kinanti Putri', 'Perempuan', 'Surabaya', '1997-12-15', 858676141, '', 'M25', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
