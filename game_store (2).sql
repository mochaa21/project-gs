-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jan 2026 pada 13.49
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
-- Database: `game_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `developers`
--

CREATE TABLE `developers` (
  `id_dev` int(11) NOT NULL,
  `nama_dev` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `developers`
--

INSERT INTO `developers` (`id_dev`, `nama_dev`, `website`) VALUES
(1, 'Mojang', 'minecraft.net'),
(2, 'Riot', 'riot.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `discounts`
--

CREATE TABLE `discounts` (
  `id_diskon` int(11) NOT NULL,
  `nama_event` varchar(100) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `discounts`
--

INSERT INTO `discounts` (`id_diskon`, `nama_event`, `persentase`) VALUES
(1, 'Normal', 0),
(2, 'Winter Sale', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `games`
--

CREATE TABLE `games` (
  `id_game` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `id_genre` int(11) DEFAULT NULL,
  `id_dev` int(11) DEFAULT NULL,
  `id_pub` int(11) DEFAULT NULL,
  `id_req` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `games`
--

INSERT INTO `games` (`id_game`, `judul`, `harga`, `id_genre`, `id_dev`, `id_pub`, `id_req`) VALUES
(1, 'Minecraft', 350000.00, 1, 1, 1, 1),
(2, 'Valorant', 0.00, 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `genres`
--

CREATE TABLE `genres` (
  `id_genre` int(11) NOT NULL,
  `nama_genre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `genres`
--

INSERT INTO `genres` (`id_genre`, `nama_genre`) VALUES
(1, 'RPG'),
(2, 'FPS'),
(3, 'Strategy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id_pm` int(11) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  `biaya_admin` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_methods`
--

INSERT INTO `payment_methods` (`id_pm`, `nama_metode`, `biaya_admin`) VALUES
(1, 'GoPay', 1000.00),
(2, 'Dana', 500.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `publishers`
--

CREATE TABLE `publishers` (
  `id_pub` int(11) NOT NULL,
  `nama_pub` varchar(100) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `publishers`
--

INSERT INTO `publishers` (`id_pub`, `nama_pub`, `negara`) VALUES
(1, 'Xbox', 'USA'),
(2, 'Tencent', 'China');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_reqs`
--

CREATE TABLE `sys_reqs` (
  `id_req` int(11) NOT NULL,
  `os` varchar(50) DEFAULT NULL,
  `processor` varchar(100) DEFAULT NULL,
  `ram_gb` int(11) DEFAULT NULL,
  `gpu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sys_reqs`
--

INSERT INTO `sys_reqs` (`id_req`, `os`, `processor`, `ram_gb`, `gpu`) VALUES
(1, 'Win 10', 'i5', 8, 'GTX 1050'),
(2, 'Win 11', 'i7', 16, 'RTX 3060');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_pembelian`
--

CREATE TABLE `trx_pembelian` (
  `id_beli` int(11) NOT NULL,
  `no_invoice` varchar(20) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total_bayar` decimal(15,2) DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trx_pembelian`
--

INSERT INTO `trx_pembelian` (`id_beli`, `no_invoice`, `id_user`, `total_bayar`, `tanggal_beli`) VALUES
(1, 'INV-001', 1, 350000.00, '2026-01-31 18:01:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_pembelian_detail`
--

CREATE TABLE `trx_pembelian_detail` (
  `id_detail` int(11) NOT NULL,
  `id_beli` int(11) DEFAULT NULL,
  `id_game` int(11) DEFAULT NULL,
  `harga_saat_beli` decimal(15,2) DEFAULT NULL,
  `id_diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trx_pembelian_detail`
--

INSERT INTO `trx_pembelian_detail` (`id_detail`, `id_beli`, `id_game`, `harga_saat_beli`, `id_diskon`) VALUES
(1, 1, 1, 350000.00, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_review`
--

CREATE TABLE `trx_review` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_game` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal_review` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_topup`
--

CREATE TABLE `trx_topup` (
  `id_topup` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pm` int(11) DEFAULT NULL,
  `jumlah_topup` decimal(15,2) DEFAULT NULL,
  `tanggal_topup` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_wishlist`
--

CREATE TABLE `trx_wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_game` int(11) DEFAULT NULL,
  `tanggal_add` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `region` varchar(10) DEFAULT NULL,
  `saldo_wallet` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `region`, `saldo_wallet`) VALUES
(1, 'SyahidGamer', 'syahid@email.com', 'ID', 500000.00),
(2, 'ProPlayer99', 'pro@email.com', 'SG', 1200000.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id_dev`);

--
-- Indeks untuk tabel `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indeks untuk tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id_game`),
  ADD KEY `id_genre` (`id_genre`),
  ADD KEY `id_dev` (`id_dev`),
  ADD KEY `id_pub` (`id_pub`),
  ADD KEY `id_req` (`id_req`);

--
-- Indeks untuk tabel `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indeks untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id_pm`);

--
-- Indeks untuk tabel `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id_pub`);

--
-- Indeks untuk tabel `sys_reqs`
--
ALTER TABLE `sys_reqs`
  ADD PRIMARY KEY (`id_req`);

--
-- Indeks untuk tabel `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  ADD PRIMARY KEY (`id_beli`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `trx_pembelian_detail`
--
ALTER TABLE `trx_pembelian_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_beli` (`id_beli`),
  ADD KEY `id_game` (`id_game`),
  ADD KEY `id_diskon` (`id_diskon`);

--
-- Indeks untuk tabel `trx_review`
--
ALTER TABLE `trx_review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_game` (`id_game`);

--
-- Indeks untuk tabel `trx_topup`
--
ALTER TABLE `trx_topup`
  ADD PRIMARY KEY (`id_topup`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pm` (`id_pm`);

--
-- Indeks untuk tabel `trx_wishlist`
--
ALTER TABLE `trx_wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_game` (`id_game`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `developers`
--
ALTER TABLE `developers`
  MODIFY `id_dev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `games`
--
ALTER TABLE `games`
  MODIFY `id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id_pub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sys_reqs`
--
ALTER TABLE `sys_reqs`
  MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `trx_pembelian_detail`
--
ALTER TABLE `trx_pembelian_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `trx_review`
--
ALTER TABLE `trx_review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `trx_topup`
--
ALTER TABLE `trx_topup`
  MODIFY `id_topup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `trx_wishlist`
--
ALTER TABLE `trx_wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id_genre`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`id_dev`) REFERENCES `developers` (`id_dev`),
  ADD CONSTRAINT `games_ibfk_3` FOREIGN KEY (`id_pub`) REFERENCES `publishers` (`id_pub`),
  ADD CONSTRAINT `games_ibfk_4` FOREIGN KEY (`id_req`) REFERENCES `sys_reqs` (`id_req`);

--
-- Ketidakleluasaan untuk tabel `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  ADD CONSTRAINT `trx_pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `trx_pembelian_detail`
--
ALTER TABLE `trx_pembelian_detail`
  ADD CONSTRAINT `trx_pembelian_detail_ibfk_1` FOREIGN KEY (`id_beli`) REFERENCES `trx_pembelian` (`id_beli`),
  ADD CONSTRAINT `trx_pembelian_detail_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`),
  ADD CONSTRAINT `trx_pembelian_detail_ibfk_3` FOREIGN KEY (`id_diskon`) REFERENCES `discounts` (`id_diskon`);

--
-- Ketidakleluasaan untuk tabel `trx_review`
--
ALTER TABLE `trx_review`
  ADD CONSTRAINT `trx_review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `trx_review_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`);

--
-- Ketidakleluasaan untuk tabel `trx_topup`
--
ALTER TABLE `trx_topup`
  ADD CONSTRAINT `trx_topup_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `trx_topup_ibfk_2` FOREIGN KEY (`id_pm`) REFERENCES `payment_methods` (`id_pm`);

--
-- Ketidakleluasaan untuk tabel `trx_wishlist`
--
ALTER TABLE `trx_wishlist`
  ADD CONSTRAINT `trx_wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `trx_wishlist_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
