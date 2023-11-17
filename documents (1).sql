-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Nov 2023 pada 03.28
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
-- Struktur dari tabel `alur_persetujuan`
--

CREATE TABLE `alur_persetujuan` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `distribusi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`distribusi`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alur_persetujuan`
--

INSERT INTO `alur_persetujuan` (`id`, `role_id`, `distribusi`) VALUES
(1, 2, '{\"roles\": [2, 5]}'),
(2, 1, '{\"roles\": [2, 5]}');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `alur_persetujuan_id` int(11) DEFAULT NULL,
  `Dari_Unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`ID_Doc`, `Document`, `Deskripsi`, `Status`, `Pengaju_ID`, `Role_Tujuan_ID`, `created_at`, `alur_persetujuan_id`, `Dari_Unit`) VALUES
(33, 'cap13.pdf', 'Pengajuan team baru', 'Disetujui', 19, 2, '2023-11-17 02:04:29', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `ID` int(11) NOT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `Aktivitas` varchar(255) DEFAULT NULL,
  `Pengguna_ID` int(11) DEFAULT NULL,
  `dokumen_id` int(11) DEFAULT NULL,
  `role_review` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`ID`, `Waktu`, `Aktivitas`, `Pengguna_ID`, `dokumen_id`, `role_review`) VALUES
(15, '2023-11-17 02:24:23', 'Persetujuan dokumen disetujui', 18, 33, 2),
(16, '2023-11-17 02:25:16', 'Persetujuan dokumen disetujui', 17, 33, 5);

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
  `Role_ID` int(11) DEFAULT 6,
  `Username` varchar(255) DEFAULT NULL,
  `Image` varchar(125) NOT NULL DEFAULT 'default.jpg',
  `activate` varchar(125) DEFAULT 'Aktif',
  `Unit_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`ID`, `Nama_Depan`, `Nama_Belakang`, `Email`, `Password`, `User_Type`, `Role_ID`, `Username`, `Image`, `activate`, `Unit_ID`) VALUES
(9, 'admin cakep', 'ganteng', 'admin@mail.com', '$2a$12$Tu7BzA3jJqoo6krGdidCwOxjB1RUtdgrBLG0HDYB7JaZqssOKSCsu', 'Admin', 7, 'Admin', 'White_and_Green_Modern_Noodle_Food_Sale_Instagram_Post_(1).png', 'Aktif', 2),
(17, 'soleha', 'infan', 'ahmad@mail.com', '$2y$10$Nw/N4X1/pUl6f/qG8jqUiuvohYC7R9EKjME.eKk/.8i6bmqOXPskC', 'User', 5, 'ahmad', 'default.jpg', 'Aktif', 1),
(18, 'ica', 'komalima', 'ica@gamail.com', '$2y$10$G59JqF9ufqInUw3WtLgMjumLJOgKEfGKqqIGLWBdZnRHXxcrr3GFe', 'User', 2, 'ica', 'default.jpg', 'Aktif', 4),
(19, 'ucok lem', 'konsim', 'ucok@user.com', '$2y$10$OLBmFddIxqrhWY6AyDAf0O/V8PmixXo87Yqw2A5eIq1a8AaAx1eHC', 'User', 6, 'ucok', 'default.jpg', 'Aktif', 1);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `persetujuan`
--

INSERT INTO `persetujuan` (`ID`, `Dokumen_ID`, `Pemberi_Persetujuan_ID`, `Status`, `Catatan`, `created_at`) VALUES
(5, 33, 2, 'Di Setujui', 'ok', '2023-11-17 02:11:42'),
(6, 33, 5, 'Di Setujui', 'saya setuju', '2023-11-17 02:13:20'),
(7, 33, 2, 'Di Setujui', 'setuju', '2023-11-17 02:24:23'),
(8, 33, 5, 'Di Setujui', 'ok bro', '2023-11-17 02:25:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `ID_Role` int(11) NOT NULL,
  `Nama_Role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`ID_Role`, `Nama_Role`) VALUES
(1, 'Manager'),
(2, 'HR'),
(3, 'Manajer-SDM'),
(4, 'Manajer-Keuangan'),
(5, 'kadiv-it'),
(6, 'staff'),
(7, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_description`, `created_at`, `updated_at`) VALUES
(1, 'IT Support', 'Unit It support', '2023-11-15 13:55:00', '2023-11-15 13:55:00'),
(2, 'admin', 'develop all users', '2023-11-15 16:39:28', '2023-11-15 16:39:28'),
(3, 'marketing', 'marketing unit', '2023-11-15 16:39:28', '2023-11-15 16:39:28'),
(4, 'Hr', NULL, '2023-11-16 02:00:50', '2023-11-16 02:00:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alur_persetujuan`
--
ALTER TABLE `alur_persetujuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

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
  ADD KEY `Pengguna_ID` (`Pengguna_ID`),
  ADD KEY `dokumen_id` (`dokumen_id`),
  ADD KEY `role_review` (`role_review`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `Role_ID` (`Role_ID`),
  ADD KEY `Unit_ID` (`Unit_ID`);

--
-- Indeks untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Dokumen_ID` (`Dokumen_ID`),
  ADD KEY `persetujuan_ibfk_2` (`Pemberi_Persetujuan_ID`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Role`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alur_persetujuan`
--
ALTER TABLE `alur_persetujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `ID_Doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `ID_Role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alur_persetujuan`
--
ALTER TABLE `alur_persetujuan`
  ADD CONSTRAINT `alur_persetujuan_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`ID_Role`);

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`Pengaju_ID`) REFERENCES `pengguna` (`ID`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`Role_Tujuan_ID`) REFERENCES `roles` (`ID_Role`);

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`Pengguna_ID`) REFERENCES `pengguna` (`ID`),
  ADD CONSTRAINT `log_aktivitas_ibfk_2` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumen` (`ID_Doc`),
  ADD CONSTRAINT `log_aktivitas_ibfk_3` FOREIGN KEY (`role_review`) REFERENCES `roles` (`ID_Role`);

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`Role_ID`) REFERENCES `roles` (`ID_Role`),
  ADD CONSTRAINT `pengguna_ibfk_2` FOREIGN KEY (`Unit_ID`) REFERENCES `units` (`unit_id`);

--
-- Ketidakleluasaan untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD CONSTRAINT `persetujuan_ibfk_1` FOREIGN KEY (`Dokumen_ID`) REFERENCES `dokumen` (`ID_Doc`),
  ADD CONSTRAINT `persetujuan_ibfk_2` FOREIGN KEY (`Pemberi_Persetujuan_ID`) REFERENCES `roles` (`ID_Role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
