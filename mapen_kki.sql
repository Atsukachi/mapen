-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2022 at 02:08 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapen_kki`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL,
  `nama_bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `extension` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `extension`) VALUES
(1, 'Photo'),
(2, 'Video'),
(3, 'Word'),
(4, 'Excel'),
(5, 'Powerpoint'),
(6, 'PDF'),
(7, 'Library');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `kegiatan_id` varchar(50) NOT NULL,
  `unitkerja` int(11) NOT NULL,
  `uraian` text NOT NULL,
  `skp` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `file` varchar(128) DEFAULT NULL,
  `file_categories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `kegiatan_id`, `unitkerja`, `uraian`, `skp`, `user`, `tanggal`, `file`, `file_categories`) VALUES
(2, 'MPNP231121001', 2, '<p>Dibuat oleh Yusuf</p>\r\n', 0, 4, '2021-11-23 01:02:03', 'Crooz.jpg', 1),
(3, 'MPNP151221001', 3, '<p>Qwerty</p>\r\n', 0, 4, '2021-12-15 06:12:56', 'A22_2018_02652_Proposal_Kartasemar.pdf', 6),
(4, 'MPNP211221002', 1, '<p>Ini dibuat oleh Yusuf yang magang di BPMPK Semarang bersama teman-teman nya</p>\r\n', 0, 2, '2022-01-12 20:12:32', 'Persetujuan_Orang_Tua.doc', 3),
(5, 'MPNP2212210001', 2, '<p>Ini laptop pak</p>\r\n', 0, 5, '2021-12-22 09:10:00', 'Laptop.mp4', 2),
(6, 'MPN2312210001', 3, '<p>Berikut adalah hasil laporan kerja saya</p>\r\n', 0, 1, '2021-12-24 14:22:41', 'Keamanan_Sistem_Industri.pdf', 6),
(7, 'MPNA2612210001', 1, '<p>Sekian dan terimakasih</p>\r\n', 0, 2, '2021-12-26 15:30:55', 'Rincian_Biaya_Aplikasi_KKI.xlsx', 4),
(9, 'MPN0801220001', 3, '<p>Lampiran Tata Usaha &quot;Balai Pengembangan Multimedia Pendidikan dan Kebudayaan&quot;</p>\r\n', 4, 1, '2022-01-08 18:02:41', 'Log_Aktifitas.docx', 3),
(10, 'MPNA1001220001', 3, '<p>Berkenalan dengan lingkungan di sekitar BPMPK</p>\r\n', 7, 2, '2022-01-10 19:26:07', 'bpmpk_gedung.jpg', 1),
(12, 'MPNP1601220001', 1, '<p>Berikut adalah proposal pembuatan aplikasi mobile</p>\r\n', 10, 9, '2022-01-16 18:49:30', 'A22_2019_02777_-_Proposal_KKI_1.pdf', 6),
(13, 'MPNP2201220001', 1, '<p>Proposal aplikasi MTK untuk SD</p>\r\n', 17, 6, '2022-01-22 21:41:42', 'A22_2018_02720_-_KKI.pdf', 6),
(14, 'MPNP2301220001', 2, '<p>Kunjungan ke Kemendikbud</p>\r\n', 0, 6, '2022-01-23 08:39:30', 'Fomat_LOG_KKI_1.docx', 3),
(15, 'MPNP2301220002', 1, '<p>Contoh aplikasi</p>\r\n', 18, 6, '2022-01-23 08:43:53', 'Thumbnail_(1).png', 1),
(59, 'MPNP1102220001', 1, '<p>Asdsdasdad</p>\r\n', 22, 6, '2022-02-11 11:31:39', 'ClipartKey_2023265.png', 1),
(60, 'MPNP1102220001', 1, '<p>Asdsdasdad</p>\r\n', 22, 6, '2022-02-11 11:31:39', 'Penilaian_Mapen_Didan_Hafiz_Putra_Pratama.pdf', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatancode`
--

CREATE TABLE `kegiatancode` (
  `id` int(11) NOT NULL,
  `kegiatan_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatancode`
--

INSERT INTO `kegiatancode` (`id`, `kegiatan_code`) VALUES
(1, 'MPN'),
(2, 'MPNA'),
(3, 'MPNP');

-- --------------------------------------------------------

--
-- Table structure for table `kerja`
--

CREATE TABLE `kerja` (
  `id_kerja` int(11) NOT NULL,
  `metode` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kerja`
--

INSERT INTO `kerja` (`id_kerja`, `metode`) VALUES
(1, 'Work From Office (WFO)'),
(2, 'Work From Home (WFH)');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `date` date NOT NULL,
  `riwayat` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `kerja` int(11) NOT NULL,
  `lat` varchar(128) NOT NULL,
  `lng` varchar(128) NOT NULL,
  `cek_presensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `user_id`, `tanggal`, `date`, `riwayat`, `status`, `foto`, `kerja`, `lat`, `lng`, `cek_presensi`) VALUES
(1, 2, 1644977626, '2022-02-16', 1, 1, 'image_1644977626.png', 1, '-7.0958201093578275', '110.38973069673418', 2),
(2, 6, 1645063301, '2022-02-17', 1, 1, 'image_1645063301.png', 2, '-7.095802461804785', '110.38971252583057', 2),
(3, 5, 1645065621, '2022-02-17', 1, 1, 'image_1645065621.png', 1, '-7.095827215458017', '110.38972594126378', 2),
(4, 3, 1645068443, '2022-02-17', 2, 2, 'image_1645068443.png', 1, '-7.095833588042734', '110.38971815046784', 1),
(5, 2, 1645053373, '2022-02-17', 2, 2, '', 1, '-7.095807826402603', '110.38971937655971', 1),
(7, 4, 1645053856, '2022-02-17', 2, 2, '', 2, '-7.095807826402603', '110.38971937655971', 2),
(8, 9, 1645072622, '2022-02-17', 2, 3, '', 2, '-7.095819961690347', '110.38972365570582', 1),
(9, 8, 1645187295, '2022-02-17', 2, 4, '', 2, '-7.095805997857124', '110.38972238503801', 2);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `riwayat` varchar(128) NOT NULL,
  `status_id` int(11) NOT NULL,
  `cek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `riwayat`, `status_id`, `cek`) VALUES
(1, 'Jam Datang', 1, 0),
(2, 'Jam Datang', 2, 0),
(3, 'Jam Pulang', 2, 0),
(4, 'Jam Datang', 3, 0),
(5, 'Jam Pulang', 3, 0),
(6, 'Jam Datang', 4, 0),
(7, 'Jam Pulang', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `skp`
--

CREATE TABLE `skp` (
  `id_skp` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nama_skp` varchar(128) NOT NULL,
  `nilai` int(11) NOT NULL,
  `cek_validasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skp`
--

INSERT INTO `skp` (`id_skp`, `user`, `bulan`, `tahun`, `nama_skp`, `nilai`, `cek_validasi`) VALUES
(1, 2, 1, 2021, 'Merencanakan atau Merancang Orientasi', 0, 0),
(2, 3, 1, 2022, 'Membuat Aplikasi', 0, 0),
(3, 3, 2, 2022, 'Revisi Aplikasi Mobile', 0, 0),
(4, 1, 1, 2022, 'Proposal Magang', 74, 1),
(6, 1, 1, 2022, 'Laporan Magang', 0, 0),
(7, 2, 1, 2022, 'Pengenalan Kantor BPMPK', 0, 0),
(10, 9, 1, 2022, 'Membuat Aplikasi Mobile Edukasi SMA', 0, 0),
(11, 10, 1, 2022, 'Membuat Website Edustore', 0, 0),
(17, 6, 1, 2022, 'Membuat Aplikasi Matematika SD', 79, 2),
(18, 6, 1, 2022, 'Membuat Aplikasi Bahasa Inggris SD', 85, 2),
(19, 6, 1, 2022, 'Membuat Aplikasi IPA SD', 0, 0),
(20, 10, 1, 2022, 'Membuat  Aplikasi', 0, 0),
(21, 6, 2, 2022, 'Membuat Aplikasi Fisika SMP', 0, 0),
(22, 6, 2, 2022, 'Membuat Aplikasi Kimia SMP', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(128) NOT NULL,
  `jam_datang` time NOT NULL,
  `jam_pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`, `jam_datang`, `jam_pulang`) VALUES
(1, 'Pagi', '07:00:00', '10:00:00'),
(2, 'Siang', '10:00:00', '15:00:00'),
(3, 'Sore', '15:00:00', '18:00:00'),
(4, 'Malam', '18:00:00', '07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL,
  `nama_unit_kerja` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`) VALUES
(1, 'Rancangan Model'),
(2, 'Produksi Model'),
(3, 'Subbag Tata Usaha');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `keahlian` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `alamat`, `telephone`, `image`, `password`, `keahlian`, `role_id`) VALUES
(1, 'Admin Mapen', 'admin@mapen.com', 'Jl. Mr. Koessoebiyono Tjondro Wibowo Kel. Pakintelan, Kec Gunung Pati, Kodya Semarang 50227', '62812312312312', 'default1.jpeg', '$2y$10$bBinogrIRSJRsYamVGZJJO5ro41ohtehWpMhRut.VLi8qtLR7TJj2', 'A22_2019_02777_(revisi).pdf', 1),
(2, 'Tama', 'didan.hafizpp16@gmail.com', 'Jl. Badak IV No. 36', '6281319263062', 'default4.jpeg', '$2y$10$oup1Jo/uz0vmzsdt2CmovuObb7AJ31eey7wIuDdKWkpjDeWV0nUm2', 'KRS_Semester_4.pdf', 2),
(3, 'Bagus Chalil Akbar', 'bagus.chalil@gmail.com', '', '6287825814146', 'default7.jpeg', '$2y$10$k1GqU.UOJrizqxUhEOQnHO20cCP1v0ZsQGUQ4VkBt0Uuq.9z96ifC', '', 2),
(4, 'Rizki Shafara Adiyatma', 'rizki.shafara@gmail.com', '', '62895360622007', 'default2.jpeg', '$2y$10$9lKbdX5rwPc7Wr0mP6hhfe4KjbtoeHh2Uo3Og85JteYMBTrFqlG3K', '', 2),
(5, 'Alfandi Okta', 'alfandi.okta@gmail.com', '', '6285800481838', 'default6.jpeg', '$2y$10$bp5JsybDvteEsoXNo/wHLOQ4I1JUIBpRQIE4FD0fp/zW.HaZPXcPG', '', 3),
(6, 'Yusuf Faisal', 'yusuf.faisal@gmail.com', '', '6285712293166', 'default5.jpeg', '$2y$10$19u2iux3.cMIQ5Bz4x2yLewrJolMWZZwEDkGsi1eYUvaxZzQlaMai', '', 3),
(7, 'Ferisa Putri', 'ferisa.putri@gmail.com', '', '6281548717628', 'default3.jpeg', '$2y$10$uNXecavCbgY2rq9GOC7FQ.y2sVShDqbVnAmXN0ErH4BYVfCZ.KVNO', '', 3),
(8, 'Rian Eko', 'rianeko.saputro@gmail.com', 'Jalan Pahlawan No. 3 Jakarta', '6282135689278', 'default.jpeg', '$2y$10$7DcWciF77TY/wpCi9xHO1OCGeAYJWB4bJkWuJoF5tn5pSSBTBDgaS', 'A22_2018_02652_Proposal_Kartasemar.pdf', 3),
(9, 'Diki Syahrizal', 'diki@gmail.com', 'Jalan Merdeka No. 7, Bandung', '6282142786858', 'Builden_Home.png', '$2y$10$q1D56/2EiVSvQwldiqaY5OGT1Yq/oVLwc6JxPRcjBAgwQ71eXpyTK', '', 3),
(10, 'Slamet', 'slamet@gmail.com', 'Jalan Merdeka No. 17', '628123123123', 'emoji.png', '$2y$10$mlyZfR72bti12UzvEbVe8Ohqdb32ZCFUyg5suBNqzf8jJvLjZ5LU6', 'Keamanan_Sistem_Industri.pdf', 3),
(11, 'Bhakti Dwi', 'bhakti.dwi@gmail.com', 'JALAN POI', '620987651', 'user.jpg', '$2y$10$sQWQBEigL3qydiFdMgpJsegxh97k9nEcs9DsfGL9zZZHInQPspoL.', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 2, 6),
(8, 1, 4),
(9, 1, 2),
(11, 1, 8),
(13, 1, 6),
(14, 1, 3),
(16, 2, 8),
(19, 3, 8),
(20, 2, 4),
(21, 3, 4),
(22, 3, 6),
(23, 2, 1),
(24, 1, 7),
(25, 2, 7),
(26, 3, 7),
(28, 4, 8),
(29, 1, 5),
(30, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Tools'),
(3, 'Table'),
(4, 'SKP'),
(5, 'Confrimation'),
(6, 'Pegawai'),
(7, 'Kegiatan'),
(8, 'Users');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Developer'),
(2, 'Atasan'),
(3, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 6, 'Presensi', 'pegawai/presensi', 'fas fa-fw fa-id-badge', 1),
(5, 7, 'Log Harian', 'kegiatan/tambah_kegiatan', 'fas fa-fw fa-upload', 1),
(6, 8, 'Profil', 'profil', 'fas fa-fw fa-user', 1),
(17, 2, 'Menu Management', 'tools', 'fas fa-fw fa-tag', 1),
(18, 2, 'Sub Menu', 'tools/submenu', 'fas fa-fw fa-tags', 1),
(19, 8, 'Change Password', 'profil/changepassword', 'fas fa-fw fa-key', 1),
(20, 8, 'Edit Profil', 'profil/edit_profil', 'fas fa-fw fa-edit', 1),
(22, 1, 'Role User', 'admin/role', 'fas fa-fw fa-user-plus', 1),
(23, 6, 'Tabel Presensi', 'pegawai', 'fas fa-fw fa-th-list', 1),
(26, 1, 'Data Pengguna', 'admin/DataPengguna', 'fas fa-fw fa-users', 1),
(27, 3, 'Riwayat', 'table/riwayat', 'fas fa-fw fa-archive', 1),
(28, 7, 'Tabel Kegiatan', 'kegiatan', 'fas fa-fw fa-list-alt', 1),
(29, 3, 'Status', 'table/status', 'fas fa-fw fa-file-alt', 1),
(57, 3, 'Kode', 'table/kode', 'fas fa-fw fa-hashtag', 1),
(58, 3, 'File', 'table/file', 'fas fa-fw fa-file', 1),
(59, 4, 'Pengajuan SKP', 'skp/pengajuan', 'fas fa-fw fa-file-upload', 1),
(61, 4, 'Tabel SKP', 'skp', 'fas fa-fw fa-table', 1),
(62, 3, 'Unit Kerja', 'table/unit_kerja', 'fas fa-fw fa-folder', 1),
(63, 5, 'Nilai SKP', 'confrimation/nilai_skp', 'fas fa-fw fa-tasks', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatancode`
--
ALTER TABLE `kegiatancode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerja`
--
ALTER TABLE `kerja`
  ADD PRIMARY KEY (`id_kerja`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `skp`
--
ALTER TABLE `skp`
  ADD PRIMARY KEY (`id_skp`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kegiatancode`
--
ALTER TABLE `kegiatancode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kerja`
--
ALTER TABLE `kerja`
  MODIFY `id_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `skp`
--
ALTER TABLE `skp`
  MODIFY `id_skp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
