-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2019 pada 14.05
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_ktp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `alamat`, `telepon`, `jenis_kelamin`, `no_ktp`) VALUES
('CS001', 'Tengku Iqbal', 'Taman Royal 1, Jl Damar 6 no 38', '081284314407', 'L', '41518010147'),
('CS002', 'Tony Stark', 'Location Unknown', '0812222222', 'L', '41518010300');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pemesanan`
--

CREATE TABLE `dt_pemesanan` (
  `no_booking` varchar(50) NOT NULL,
  `id_customer` varchar(50) NOT NULL,
  `id_mobil` varchar(30) NOT NULL,
  `tgl_pinjam` date DEFAULT current_timestamp(),
  `durasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_pemesanan`
--

INSERT INTO `dt_pemesanan` (`no_booking`, `id_customer`, `id_mobil`, `tgl_pinjam`, `durasi`) VALUES
('BK001', 'CS001', 'MB003', '2019-12-10', '2'),
('BK002', 'CS002', 'MB002', '2019-12-10', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pengembalian`
--

CREATE TABLE `dt_pengembalian` (
  `no_booking` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `keterlambatan` varchar(20) NOT NULL,
  `Biaya_denda` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dt_pengembalian`
--

INSERT INTO `dt_pengembalian` (`no_booking`, `tanggal_kembali`, `keterlambatan`, `Biaya_denda`) VALUES
('BK001', '2019-12-10', '2', '10000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `Id_harga` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_mobil` varchar(20) CHARACTER SET latin1 NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`Id_harga`, `id_mobil`, `harga`) VALUES
('HG001', 'MB003', '1900000.00'),
('HG002', 'MB002', '600000.00'),
('HG003', 'MB001', '550000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `id_merk` varchar(10) NOT NULL,
  `merk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id_merk`, `merk`) VALUES
('M001', 'Honda'),
('M002', 'Daihatsu'),
('M003', 'Toyota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` varchar(10) NOT NULL,
  `id_merk` varchar(10) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL,
  `tipe_mobil` varchar(30) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_merk`, `nama_mobil`, `tipe_mobil`, `kapasitas`, `no_plat`, `tahun`) VALUES
('MB001', 'M001', 'Brio', 'Manual', '4', 'B 3556 YT', '2017'),
('MB002', 'M002', 'Ayla', 'Automatic', '4', 'B 1234 FE', '2016'),
('MB003', 'M003', 'Alphard', 'Manual', '6', 'B 666 EZ', '2019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`Id`, `username`, `password`, `level`) VALUES
(1, 'admin', '12345', 'admin'),
(2, 'user', '12345', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `dt_pemesanan`
--
ALTER TABLE `dt_pemesanan`
  ADD PRIMARY KEY (`no_booking`),
  ADD KEY `fk_pemesanan_mobil` (`id_mobil`),
  ADD KEY `fk_pemesanan_customer` (`id_customer`);

--
-- Indeks untuk tabel `dt_pengembalian`
--
ALTER TABLE `dt_pengembalian`
  ADD KEY `fk_booking` (`no_booking`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`Id_harga`),
  ADD KEY `fk_harga_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `Fk_merk_mobil` (`id_merk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dt_pemesanan`
--
ALTER TABLE `dt_pemesanan`
  ADD CONSTRAINT `fk_pemesanan_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_pemesanan_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);

--
-- Ketidakleluasaan untuk tabel `dt_pengembalian`
--
ALTER TABLE `dt_pengembalian`
  ADD CONSTRAINT `fk_booking` FOREIGN KEY (`no_booking`) REFERENCES `dt_pemesanan` (`no_booking`);

--
-- Ketidakleluasaan untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD CONSTRAINT `fk_harga_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);

--
-- Ketidakleluasaan untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `Fk_merk_mobil` FOREIGN KEY (`id_merk`) REFERENCES `merk` (`id_merk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
