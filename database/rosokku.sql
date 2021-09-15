-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 11 Sep 2021 pada 13.58
-- Versi server: 5.7.33
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rosokku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_rute`
--

CREATE TABLE `detail_rute` (
  `id_detail_rute` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_rute` int(11) NOT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_rute`
--

INSERT INTO `detail_rute` (`id_detail_rute`, `id_transaksi`, `id_rute`, `urutan`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 1),
(3, 3, 1, 3),
(4, 4, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id_iklan` int(11) NOT NULL,
  `label_iklan` text NOT NULL,
  `link_iklan` text NOT NULL,
  `image_iklan` text,
  `target_usia` varchar(20) DEFAULT NULL COMMENT 'all, child, teen, adult'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `iklan`
--

INSERT INTO `iklan` (`id_iklan`, `label_iklan`, `link_iklan`, `image_iklan`, `target_usia`) VALUES
(1, 'Iklan Testing', 'https://youtube.com', 'THUMB_60D484DBA7FFF.png', 'all');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `start`, `end`, `start_date`, `end_date`) VALUES
(1, 'Senin', '10:00:00', '17:00:00', '2020-09-30', '2020-11-30'),
(2, 'Selasa', '07:00:00', '17:00:00', '2020-09-30', '2020-11-30'),
(3, 'Rabu', '07:00:00', '17:00:00', '2020-09-30', '2020-11-30'),
(4, 'Kamis', '07:00:00', '17:00:00', '2020-09-30', '2020-11-30'),
(5, 'Jumat', '07:00:00', '17:00:00', '2020-09-30', '2020-11-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(80) DEFAULT NULL,
  `harga` decimal(19,2) DEFAULT NULL,
  `stock` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `harga`, `stock`) VALUES
(1, 'Kertas bekas', '10000.00', '0.0'),
(2, 'Plastik Bekas', '25000.00', '0.0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text,
  `nominal` decimal(19,2) DEFAULT NULL,
  `tipe` varchar(6) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL COMMENT 'other, penjualan, request_saldo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `tanggal`, `keterangan`, `nominal`, `tipe`, `kategori`) VALUES
(3, '2021-02-24', 'Penjualan Kertas bekas seberat 500 Kg kepada PT Kertas Minyak', '5000000.00', 'in', ''),
(4, '2021-02-26', 'Penjualan Kertas bekas seberat 50 Kg kepada PT Kertas Minyak', '2000000.00', 'in', ''),
(5, '2021-02-26', 'Pembelian Hosting', '500000.00', 'out', ''),
(6, '2021-07-04', 'Pencairan saldo Imam Nurcholis | (BCA) 754569', '50000.00', 'out', 'request_saldo'),
(7, '2021-07-31', 'Pencairan saldo Imam Nurcholiss | (BCA) 754569', '50000.00', 'out', 'request_saldo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(80) DEFAULT NULL,
  `alamat_kurir` varchar(128) DEFAULT NULL,
  `phone_kurir` varchar(20) DEFAULT NULL,
  `email_kurir` varchar(100) DEFAULT NULL,
  `password_kurir` varchar(128) DEFAULT NULL,
  `status_kurir` varchar(10) DEFAULT NULL COMMENT 'aktif, nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama_kurir`, `alamat_kurir`, `phone_kurir`, `email_kurir`, `password_kurir`, `status_kurir`) VALUES
(1, 'Syahroni Rizky', 'Sidosermo, Surabaya', '+6285735692331', 'kurir@mail.com', '$2y$10$KPcffaom6jhvGByU7.o.g.hXFuAcZR33bmntT/rE0ES/R9Hcz7zxm', 'aktif'),
(2, 'Gamal', 'Pandaan, Jawa Timur', '+6281695887442', 'gamal@mail.id', '$2y$10$vw9lxKFH5pWjydRP/PLnr.xdD/SBdF4E93SSwWe2mluwn.Ujj6n0O', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(80) DEFAULT NULL,
  `alamat_utama` int(11) DEFAULT NULL,
  `rekening_pelanggan` varchar(30) DEFAULT NULL,
  `bank_pelanggan` varchar(20) DEFAULT NULL,
  `phone_pelanggan` varchar(20) DEFAULT NULL,
  `email_pelanggan` varchar(100) DEFAULT NULL,
  `password_pelanggan` varchar(128) DEFAULT NULL,
  `tanggal_join` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_utama`, `rekening_pelanggan`, `bank_pelanggan`, `phone_pelanggan`, `email_pelanggan`, `password_pelanggan`, `tanggal_join`) VALUES
(1, 'Imam Nurcholiss', NULL, '754569', 'BCA', '+6285735692331', 'imamnurcholis589@gmail.com', '$2y$10$M6FpVUNrdaq2jMemuAATlO/zDFvnzvEocZ2r7dYIxoRUog8/2teya', NULL),
(3, 'Achmad Fauzi', NULL, '55489633215', 'BNI', '+6285735692388', 'ojiks@gmail.com', '$2y$10$vCxRIP.FJFBrcG1GDmbpSu1/Q65V4lK2CKawx9Hrgq2nwGOslRa9i', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_saldo`
--

CREATE TABLE `request_saldo` (
  `id_request_saldo` int(11) NOT NULL,
  `id_keuangan` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `saldo` decimal(19,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'pending, paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `request_saldo`
--

INSERT INTO `request_saldo` (`id_request_saldo`, `id_keuangan`, `id_pelanggan`, `tanggal`, `saldo`, `status`) VALUES
(1, 7, 1, '2021-07-29', '50000.00', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `id_start` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_rute` varchar(15) DEFAULT NULL COMMENT 'PENDING, DONE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id_rute`, `id_kurir`, `id_start`, `tanggal`, `status_rute`) VALUES
(1, 1, 1, '2021-09-10', 'PENDING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `start_point`
--

CREATE TABLE `start_point` (
  `id_start` int(11) NOT NULL,
  `nama_start` varchar(50) DEFAULT NULL,
  `keterangan_start` varchar(100) DEFAULT NULL,
  `longitude_start` decimal(11,8) DEFAULT NULL,
  `latitude_start` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `start_point`
--

INSERT INTO `start_point` (`id_start`, `nama_start`, `keterangan_start`, `longitude_start`, `latitude_start`) VALUES
(1, 'Gudang Utamaa', 'Royal Plaza, Surabaya', '112.73220400', '-7.30904280');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_start` int(11) DEFAULT NULL,
  `harga_satuan` decimal(19,2) DEFAULT NULL,
  `berat` decimal(5,2) DEFAULT NULL,
  `klasifikasi` varchar(10) DEFAULT NULL COMMENT 'banyak, sedang, sedikit',
  `foto` varchar(150) DEFAULT NULL,
  `tanggal_ambil` date DEFAULT NULL,
  `tanggal_ambil_alternatif` date DEFAULT NULL,
  `latitude_transaksi` decimal(11,8) DEFAULT NULL,
  `longitude_transaksi` decimal(11,8) DEFAULT NULL,
  `alamat_transaksi` text,
  `tanggal_selesai` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'pending, confirmed, otw, done, cancel'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_kategori`, `id_kurir`, `id_jadwal`, `id_pelanggan`, `id_start`, `harga_satuan`, `berat`, `klasifikasi`, `foto`, `tanggal_ambil`, `tanggal_ambil_alternatif`, `latitude_transaksi`, `longitude_transaksi`, `alamat_transaksi`, `tanggal_selesai`, `status`) VALUES
(1, 2, 1, 4, 1, 1, '50000.00', NULL, NULL, 'https://cdn-cms.pgimgs.com/static/2020/07/Foto-Utama-Barang-Bekas.jpg', '2021-10-11', NULL, '-7.26249080', '112.73698390', 'Plemahan II, Surabaya', NULL, 'confirmed'),
(2, 1, 1, 4, 3, 1, '10000.00', NULL, NULL, 'https://www.wowkeren.com/display/images/photo/2020/04/09/00305585.jpg', '2021-10-11', NULL, '-7.26194380', '112.74784220', 'Keputih, Surabaya', NULL, 'confirmed'),
(3, 2, 1, 4, 1, 1, '50000.00', NULL, NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0eyaktweKDgDAfEdJLY4G7w_ZUydr56wG54Llmn_9BtAkxa8EZ3SpPOXnrGJ23uhNtjY&usqp=CAU', '2021-10-11', NULL, '-7.28913610', '112.67353460', 'Babatan, Surabaya', NULL, 'confirmed'),
(4, 1, 1, 4, 3, 1, '10000.00', NULL, NULL, 'https://static.republika.co.id/uploads/images/inpicture_slide/150804195925-516.JPG', '2021-10-11', NULL, '-7.33397710', '112.78567590', 'Ngaglik, Surabaya', NULL, 'confirmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `role` varchar(15) DEFAULT NULL COMMENT 'admin, staff'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `phone`, `username`, `password`, `role`) VALUES
(1, 'Imam Nurcholis', 'contact.imamnc@gmail.com', '+6285735692331', 'imamnc', '$2y$10$RXVLi3Y.2Jk3UbM0eIpxquFzpegh1cerZEUdUDeEvYtmnyR28X1qi', 'Admin'),
(3, 'Esa', 'esa@yahoo.com', '+628576954223', 'esa', '$2y$10$RXVLi3Y.2Jk3UbM0eIpxquFzpegh1cerZEUdUDeEvYtmnyR28X1qi', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `fk_mempunyai_alamat` (`id_pelanggan`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `FK_Transaksi_chat` (`id_transaksi`),
  ADD KEY `FK_Mempunyai_chat` (`id_pelanggan`);

--
-- Indeks untuk tabel `detail_rute`
--
ALTER TABLE `detail_rute`
  ADD PRIMARY KEY (`id_detail_rute`),
  ADD KEY `fk_mempunyai_urutan_pengambilan` (`id_transaksi`),
  ADD KEY `fk_mempunyai_urutan_rute` (`id_rute`);

--
-- Indeks untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id_iklan`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `request_saldo`
--
ALTER TABLE `request_saldo`
  ADD PRIMARY KEY (`id_request_saldo`),
  ADD KEY `fk_mempunyai_catatan_keuangan` (`id_keuangan`),
  ADD KEY `fk_mencairkan_saldo` (`id_pelanggan`);

--
-- Indeks untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`),
  ADD KEY `fk_menempuh_rute` (`id_kurir`),
  ADD KEY `fk_start_point_rute` (`id_start`) USING BTREE;

--
-- Indeks untuk tabel `start_point`
--
ALTER TABLE `start_point`
  ADD PRIMARY KEY (`id_start`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_mempunyai_jadwal` (`id_jadwal`),
  ADD KEY `fk_mempunyai_kategori` (`id_kategori`),
  ADD KEY `fk_mempunyai_transaksi` (`id_pelanggan`),
  ADD KEY `fk_mengambil_barang` (`id_kurir`),
  ADD KEY `fk_mempunyai_start_point` (`id_start`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_rute`
--
ALTER TABLE `detail_rute`
  MODIFY `id_detail_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id_iklan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `request_saldo`
--
ALTER TABLE `request_saldo`
  MODIFY `id_request_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `start_point`
--
ALTER TABLE `start_point`
  MODIFY `id_start` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `fk_mempunyai_alamat` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_Mempunyai_chat` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `FK_Transaksi_chat` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `detail_rute`
--
ALTER TABLE `detail_rute`
  ADD CONSTRAINT `fk_mempunyai_urutan_pengambilan` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `fk_mempunyai_urutan_rute` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`);

--
-- Ketidakleluasaan untuk tabel `request_saldo`
--
ALTER TABLE `request_saldo`
  ADD CONSTRAINT `fk_mempunyai_catatan_keuangan` FOREIGN KEY (`id_keuangan`) REFERENCES `keuangan` (`id_keuangan`),
  ADD CONSTRAINT `fk_mencairkan_saldo` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `FK_Start_point_rute` FOREIGN KEY (`id_start`) REFERENCES `start_point` (`id_start`),
  ADD CONSTRAINT `fk_menempuh_rute` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_mempunyai_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`),
  ADD CONSTRAINT `fk_mempunyai_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_mempunyai_start_point` FOREIGN KEY (`id_start`) REFERENCES `start_point` (`id_start`),
  ADD CONSTRAINT `fk_mempunyai_transaksi` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `fk_mengambil_barang` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
