-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2023 pada 12.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `documents`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `ID_Doc` int(11) NOT NULL,
  `Document` varchar(255) NOT NULL,
  `Deskripsi` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Pengajuan Baru',
  `Pengaju_ID` int(11) DEFAULT NULL,
  `Role_Tujuan_ID` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`ID_Doc`, `Document`, `Deskripsi`, `Status`, `Pengaju_ID`, `Role_Tujuan_ID`, `created_at`) VALUES
(13, 'tes', 'tes', 'Pengajuan Baru', 10, 2, '2023-11-15 03:13:50'),
(16, 'cap10.pdf', 'untuk keperluan penting', 'Disetujui', 11, 1, '2023-11-15 04:28:14'),
(17, 'cap12.pdf', 'untuk keperluan penting', 'Pengajuan Baru', 8, 2, '2023-11-15 06:41:17'),
(18, 'cap34.pdf', 'penting b', 'Pengajuan Baru', 11, 1, '2023-11-15 06:46:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `ID` int(11) NOT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `Aktivitas` varchar(255) DEFAULT NULL,
  `Pengguna_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`ID`, `Waktu`, `Aktivitas`, `Pengguna_ID`) VALUES
(1, '2023-11-13 18:04:28', 'Persetujuan dokumen disetujui: ID 2', NULL),
(2, '2023-11-13 18:27:29', 'Persetujuan dokumen disetujui: ID 3', NULL),
(3, '2023-11-15 06:33:15', 'Persetujuan dokumen disetujui: ID 16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `ID` int(11) NOT NULL,
  `Nama_Depan` varchar(50) NOT NULL,
  `Nama_Belakang` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `User_Type` varchar(20) DEFAULT 'User',
  `Role_ID` int(11) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `activate` varchar(125) DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`ID`, `Nama_Depan`, `Nama_Belakang`, `Email`, `Password`, `User_Type`, `Role_ID`, `Username`, `activate`) VALUES
(8, 'test first', 'test last', 'test@mail.com', '$2y$10$em3rlCWNkn3OePf.MNWn6eolja07w.DYpxuG6TEPB4bxC/FMbBCem', 'User', 1, 'test', 'Aktif'),
(9, 'admin', 'admin', 'admin@mail.com', '$2a$12$Tu7BzA3jJqoo6krGdidCwOxjB1RUtdgrBLG0HDYB7JaZqssOKSCsu', 'Admin', NULL, 'Admin', 'Aktif'),
(10, 'ranger', 'h', 'ranger@mail.com', '$2y$10$bG7/CZR5KA3wSra5a2e9Juf64LRFatAS7C9uFsVhpQbd4Z8ImKZ6O', 'User', NULL, 'powe', 'Aktif'),
(11, 'ahmed', 'gore', 'ucok@user.com', '$2y$10$7t00LBQTyC5Zyctj.6zrNOTLlc1rIRmS6plLJ8CjZ2v8R8iSajAxW', 'User', NULL, 'ucok', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `persetujuan`
--

CREATE TABLE `persetujuan` (
  `ID` int(11) NOT NULL,
  `Dokumen_ID` int(11) DEFAULT NULL,
  `Pemberi_Persetujuan_ID` int(11) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Menunggu Persetujuan',
  `Catatan` text DEFAULT NULL,
  `Tanggal_Persetujuan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `Nama_Role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`ID`, `Nama_Role`) VALUES
(1, 'Manager'),
(2, 'HR');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`ID_Doc`),
  ADD KEY `Pengaju_ID` (`Pengaju_ID`),
  ADD KEY `Role_Tujuan_ID` (`Role_Tujuan_ID`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Pengguna_ID` (`Pengguna_ID`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `Role_ID` (`Role_ID`);

--
-- Indeks untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Dokumen_ID` (`Dokumen_ID`),
  ADD KEY `Pemberi_Persetujuan_ID` (`Pemberi_Persetujuan_ID`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `ID_Doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`Pengaju_ID`) REFERENCES `pengguna` (`ID`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`Role_Tujuan_ID`) REFERENCES `roles` (`ID`);

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`Pengguna_ID`) REFERENCES `pengguna` (`ID`);

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`Role_ID`) REFERENCES `roles` (`ID`);

--
-- Ketidakleluasaan untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD CONSTRAINT `persetujuan_ibfk_1` FOREIGN KEY (`Dokumen_ID`) REFERENCES `dokumen` (`ID_Doc`),
  ADD CONSTRAINT `persetujuan_ibfk_2` FOREIGN KEY (`Pemberi_Persetujuan_ID`) REFERENCES `pengguna` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
