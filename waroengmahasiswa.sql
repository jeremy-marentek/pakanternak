-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jul 2020 pada 01.25
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waroengmahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(256) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `foto_admin` varchar(100) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `email_admin`, `nama_admin`, `foto_admin`, `id_level`) VALUES
(1, 'bkmcic', '$2y$10$CeTzMI6JdzSTDwVYepC7JOk7m/iINKtVYAPd1F/yxm3Xe/qpkuTfa', 'bkmcic.official@gmail.com', 'BKM CIC', 'BKM_CIC.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_mahasiswa`
--

CREATE TABLE `akun_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `email_mahasiswa` varchar(50) NOT NULL,
  `password_mahasiswa` varchar(256) NOT NULL,
  `alamat_mahasiswa` varchar(100) NOT NULL,
  `telepon_mahasiswa` varchar(20) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `foto_mahasiswa` varchar(100) NOT NULL,
  `status_aktif` int(11) NOT NULL,
  `tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun_mahasiswa`
--

INSERT INTO `akun_mahasiswa` (`id_mahasiswa`, `nim`, `email_mahasiswa`, `password_mahasiswa`, `alamat_mahasiswa`, `telepon_mahasiswa`, `tanggal_daftar`, `foto_mahasiswa`, `status_aktif`, `tipe`) VALUES
(1, '2016102037', 'alfianrenz25@gmail.com', '$2y$10$s23cVqcyHuuqkf4xQ6kqzO1HP7YNEtYETXbx34NlYl0aXQ1Q6wDRy', 'Karangwareng, Kabupaten Cirebon', '6281214674264', '2020-07-21 20:24:48', 'default.png', 1, 1),
(2, '2016102036', 'pujalibra@gmail.com', '$2y$10$LbZdKRUrblgQTktih/oFzeoBLELAgid3ZDbt30gU4Afu1xwHKfjz6', 'Depok, Kabupaten Cirebon', '6289689009867', '2020-07-21 21:08:18', 'default.png', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_umum`
--

CREATE TABLE `akun_umum` (
  `id_umum` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `status_aktif` int(11) NOT NULL,
  `tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bantuan`
--

CREATE TABLE `bantuan` (
  `id` int(11) NOT NULL,
  `bantuan1` text NOT NULL,
  `bantuan2` text NOT NULL,
  `bantuan3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bantuan`
--

INSERT INTO `bantuan` (`id`, `bantuan1`, `bantuan2`, `bantuan3`) VALUES
(1, '<p><strong>Langkah-langkah berbelanja di Waroeng mahasiswa</strong></p>\r\n\r\n<ol>\r\n	<li><strong>Login, </strong>masukkan&nbsp;nim bagi mahasiswa dan username/email&nbsp;bagi pengguna umum serta password. Apabila belum mempunyai akun dapat membuat akun terlebih dahulu.</li>\r\n	<li><strong>Pilih Produk</strong>, cari dan pilih produk yang diinginkan.</li>\r\n	<li><strong>Masukkan ke Keranjang</strong>, masukkan produk yang telah&nbsp;dipilih tersebut&nbsp;kedalam keranjang belanja dengan&nbsp;meneakan tombol &quot;tambahkan keranjang&quot;.</li>\r\n	<li><strong>Kelola Keranjang</strong>, atur kuantitas atau jumlah produk yang&nbsp;akan dibeli.</li>\r\n	<li><strong>Checkout</strong>, pada halaman checkout&nbsp;pembeli wajib mengisi&nbsp;identitas, alamat lengkap pengiriman serta jasa kurir.</li>\r\n	<li><strong>Pembayaran</strong>, setelah mengisi&nbsp;data diri serta alamat&nbsp;pengiriman, pembeli dapat memilih metode pembayaran&nbsp;yang&nbsp;telah di sediakan.</li>\r\n	<li><strong>Konfirmasi Terima Barang</strong>, setelah barang diterima lakukan konfirmasi terima barang pada halaman pesanan. Transaksi akan dianggap selesai setelah pembeli memberikan&nbsp;konfirmasi kepada mahasiswa yang bersangkutan.</li>\r\n</ol>', '<p><strong>Jenis-jenis pembayaran di Waroeng mahasiswa</strong></p>\r\n\r\n<ol>\r\n	<li><strong>Payment Gateway</strong>, pembeli dapat melakukan pembayaran dengan menggunakan kartu kredit, melalui alfamart, indomaret dan GoPay</li>\r\n	<li><strong>Cash on Delivery</strong>, apabila ingin melakukan pembayaran cash kepada mahasiswa, pembeli dapat memilih metode Cash on Delivery kemudian atur jadwal transaksi dan lokasi transaksi.&nbsp;</li>\r\n</ol>', '<p>Berjualan di Waroeng mahasiswa itu mudah dan nyaman. Yuk simak caranya menjadi mahasiswa di Waroeng mahasiswa</p>\r\n\r\n<ol>\r\n	<li><strong>mahasiswa UCIC</strong>, syarat pertama yaitu mahasiswa merupakan mahasiswa Universitas Catur Insan Cendekia.</li>\r\n	<li><strong>Daftar,&nbsp;</strong>buat akun sebagai mahasiswa. Akun ini dapat juga digunakan sebagai akun pembeli.</li>\r\n	<li><strong>Login</strong>, sebelum masuk ke halaman mahasiswa harus melakukan login terlebih dahulu.</li>\r\n	<li><strong>Kelola Produk</strong>, jual produk yang diinginkan dan lengkapi deskripsi data produk.</li>\r\n	<li><strong>Kelola Transaksi</strong>, mahasiswa dapat mengelola transaksi di lapakmu.</li>\r\n	<li><strong>Kirim Barang</strong>, mahasiswa wajib mengirim barang kepada pembeli apabila produk yang dipesan telah dibayar lunas.</li>\r\n	<li><strong>Terima Uang</strong>, terima uangmu setelah pembeli melakukan konfirmasi terima barang.</li>\r\n</ol>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_keranjang`
--

CREATE TABLE `detail_keranjang` (
  `id_detail` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_keranjang`
--

INSERT INTO `detail_keranjang` (`id_detail`, `id_keranjang`, `id_produk`, `kuantitas`) VALUES
(1, 1, 5, 1),
(2, 1, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Teknologi dan Informasi'),
(2, 'Ekonomi dan Bisnis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Aksesoris'),
(2, 'Fashion Pria'),
(3, 'Fashion Wanita'),
(4, 'Handphone'),
(5, 'Jasa'),
(6, 'Kesehatan'),
(7, 'Makanan'),
(8, 'Minuman'),
(9, 'Produk Seni'),
(10, 'Produk Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `tipe_pembeli` int(11) NOT NULL,
  `status_keranjang` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pembeli`, `tipe_pembeli`, `status_keranjang`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `status_mahasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mahasiswa`, `id_fakultas`, `id_prodi`, `status_mahasiswa`) VALUES
('2016102001', 'Kristianto', 1, 1, 1),
('2016102002', 'Syifa Ulkarim', 1, 1, 1),
('2016102003', 'Mohamad Rully', 1, 1, 1),
('2016102005', 'Irfan Riyadi', 1, 1, 1),
('2016102006', 'Wahyu Septiawan', 1, 1, 1),
('2016102007', 'Leilly Indahsari', 1, 1, 1),
('2016102009', 'Sri Apriyani', 1, 1, 1),
('2016102011', 'Arif Maulana', 1, 1, 1),
('2016102013', 'Farida Trie Agustiany', 1, 1, 1),
('2016102014', 'Mochamad Rizky Alvin Fernanda', 1, 1, 1),
('2016102017', 'Chad Torres', 1, 1, 1),
('2016102019', 'Miawati', 1, 1, 1),
('2016102020', 'Sakti Wibawa', 1, 1, 1),
('2016102021', 'Nurfiki', 1, 1, 1),
('2016102022', 'Subhan Saeful Islami', 1, 1, 1),
('2016102023', 'Melly Amalia', 1, 1, 1),
('2016102024', 'Rizky Arbilah', 1, 1, 1),
('2016102025', 'Humam Muhadzdzab', 1, 1, 1),
('2016102026', 'Habillah Abbas', 1, 1, 1),
('2016102028', 'Andreas Oktafian', 1, 1, 1),
('2016102029', 'Moh. Yahya', 1, 1, 1),
('2016102032', 'Indra Romadon', 1, 1, 1),
('2016102033', 'Devi Nurjannah', 1, 1, 1),
('2016102036', 'Puja Irawan', 1, 1, 1),
('2016102037', 'Alfian', 1, 1, 1),
('2016102038', 'Haevah Reza Amri', 1, 1, 1),
('2016102041', 'Rizky Maulana', 1, 1, 1),
('2016102042', 'Vega Pramudia Sukma', 1, 1, 1),
('2016102043', 'Nadila Khabiru', 1, 1, 1),
('2016102044', 'M. Faqih Hasan', 1, 1, 1),
('2016102049', 'Dimas Aulia', 1, 1, 1),
('2016102050', 'Kresna Adi Pratama', 1, 1, 1),
('2016102051', 'Surandi', 1, 1, 1),
('2016102052', 'Ridwanto', 1, 1, 1),
('2016102057', 'Muhammad Fajar Ramadhan', 1, 1, 1),
('2016102059', 'Jodi Fathurrohman', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_fakultas`, `nama_prodi`) VALUES
(1, 1, 'Teknik Informatika'),
(2, 1, 'Sistem Informasi'),
(3, 1, 'Desain Komunikasi Visual '),
(4, 1, 'Komputerisasi Akuntansi'),
(5, 1, 'Manajemen Informatika'),
(6, 2, 'Akuntansi'),
(7, 2, 'Manajemen'),
(8, 2, 'Manajemen Bisnis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga_produk` int(20) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `status_produk` int(11) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_mahasiswa`, `nama_produk`, `id_kategori`, `harga_produk`, `stok_produk`, `deskripsi_produk`, `foto_produk`, `status_produk`, `tanggal_input`) VALUES
(1, 1, 'Kue Kering Lebaran', 7, 15000, 10, '<p>Deskripsi Kue Kering Lebaran</p>\r\n\r\n<p>Kue Kering Lebaran Cirebon <br>\r\nSeblak Bandung - Seblak Super Pedas<br>\r\nMakanan khas saat lebaran, kapan saja dan dimana saja tinggal kunyah saja.<br>\r\nSelalu ready ya tinggal chat saja<br>\r\nCocok buat bekal di perjalanan atau di rumah saja<br>\r\nCepat dan praktis!</p>', 'Kue_Kering_Lebaran.jpg', 1, '2020-07-21 21:05:55'),
(2, 1, 'Seblak Instan Bandung', 7, 10000, 5, '<p>Deskripsi Seblak Instan Bandung</p>\r\n\r\n<p>Kue Kering Lebaran Cirebon <br>\r\nSeblak Bandung - Seblak Super Pedas<br>\r\nMakanan khas saat lebaran, kapan saja dan dimana saja tinggal kunyah saja.<br>\r\nSelalu ready ya tinggal chat saja<br>\r\nCocok buat bekal di perjalanan atau di rumah saja<br>\r\nCepat dan praktis!</p>', 'Seblak_Instan_Bandung.jpg', 1, '2020-07-22 05:07:38'),
(3, 1, 'Jersey Barcelona', 2, 50000, 3, '<p>Deskripsi Jersey Barcelona</p>\r\n\r\n<p>Kue Kering Lebaran Cirebon <br>\r\nSeblak Bandung - Seblak Super Pedas<br>\r\nMakanan khas saat lebaran, kapan saja dan dimana saja tinggal kunyah saja.<br>\r\nSelalu ready ya tinggal chat saja<br>\r\nCocok buat bekal di perjalanan atau di rumah saja<br>\r\nCepat dan praktis!</p>', 'Jersey_Barcelona.jpg', 1, '2020-07-22 05:09:07'),
(4, 2, 'Hijab Motif', 3, 10000, 2, '<p>Deskripsi Hijab Motif</p>\r\n\r\n<p>Kue Kering Lebaran Cirebon <br>\r\nSeblak Bandung - Seblak Super Pedas<br>\r\nMakanan khas saat lebaran, kapan saja dan dimana saja tinggal kunyah saja.<br>\r\nSelalu ready ya tinggal chat saja<br>\r\nCocok buat bekal di perjalanan atau di rumah saja<br>\r\nCepat dan praktis!</p>', 'Hijab_Motif.jpg', 1, '2020-07-22 05:10:41'),
(5, 2, 'Sepatu High Heels', 1, 35000, 2, '<p>Deskripsi Sepatu High Heels</p>\r\n\r\n<p>Kue Kering Lebaran Cirebon <br>\r\nSeblak Bandung - Seblak Super Pedas<br>\r\nMakanan khas saat lebaran, kapan saja dan dimana saja tinggal kunyah saja.<br>\r\nSelalu ready ya tinggal chat saja<br>\r\nCocok buat bekal di perjalanan atau di rumah saja<br>\r\nCepat dan praktis!</p>', 'Sepatu_High_Heels.jpg', 1, '2020-07-22 05:11:26'),
(6, 2, 'Jam Tangan Casio', 1, 45000, 1, '<p>Deskripsi Jam Tangan</p>\r\n\r\n<p>Kue Kering Lebaran Cirebon <br>\r\nSeblak Bandung - Seblak Super Pedas<br>\r\nMakanan khas saat lebaran, kapan saja dan dimana saja tinggal kunyah saja.<br>\r\nSelalu ready ya tinggal chat saja<br>\r\nCocok buat bekal di perjalanan atau di rumah saja<br>\r\nCepat dan praktis!</p>', 'Jam_Tangan_Casio.jpg', 1, '2020-07-22 05:12:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_website`
--

CREATE TABLE `profile_website` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `instagram` varchar(20) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profile_website`
--

INSERT INTO `profile_website` (`id`, `nama_website`, `alamat`, `email`, `telepon`, `instagram`, `logo`) VALUES
(1, 'Waroeng mahasiswa UCIC', 'Jalan Kesambi, No.202 Kota Cirebon', 'bkmcic.official@gmail.com', '6289660979061', '@warmacic', 'Waroeng_mahasiswa_CIC.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `foto_slider` varchar(100) NOT NULL,
  `headline1` varchar(100) NOT NULL,
  `headline2` varchar(100) NOT NULL,
  `headline3` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `foto_slider`, `headline1`, `headline2`, `headline3`, `status`) VALUES
(1, 'Waroeng_mahasiswa.png', 'Selamat Datang di', 'Waroeng mahasiswa', 'Pasarnya mahasiswa Universitas Catur Insan Cendekia', 1),
(2, 'Seorang_Entrepeneur.png', 'Saatnya Menjadi', 'Seorang Entrepeneur', 'Daftarkan Dirimu dan Jadilah Pengusaha Muda', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang_warma`
--

CREATE TABLE `tentang_warma` (
  `id` int(11) NOT NULL,
  `tentang` text NOT NULL,
  `tujuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tentang_warma`
--

INSERT INTO `tentang_warma` (`id`, `tentang`, `tujuan`) VALUES
(1, '<p>Warma atau Waroeng mahasiswa adalah sebuah wadah bagi mahasiswa UCIC yang memiliki usaha di bidang jasa atau produk yang dijual dan dapat dipasarkan melalui internal kampus ataupun eksternal kampus melalui media berbasis website. Warma merupakan salah satu bentuk produk yang dihasilkan oleh BKM CIC yang dikontribusikan melalui pelayanan BKM CIC kepada mahasiswa yang memiliki usaha. Dengan adanya warma diharapkan mahasiswa UCIC dapat menunjukan eksistensi dan prestasinya sebagai seorang enterpreneur</p>', '<ol>\r\n	<li>Untuk mengembangkan minat bagi mahasiswa yang memiliki usaha di bidang jasa atau produk.</li>\r\n	<li>Untuk menghargai bentuk karya mahasiswa yang ingin berkesempatan menjadi seorang <em>entrepreneur</em>.</li>\r\n	<li>Untuk menunjukkan prestasi dan eksistensi sebagai seorang <em>entreprenenur</em></li>\r\n	<li>Untuk memasarkan produk atau jasa yang dijual oleh mahasiswa untuk dapat di perluas didalam atau luar kampus Universitas Catur Insan Cendekia.</li>\r\n</ol>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `order_id` int(30) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(50) NOT NULL,
  `kota_pelanggan` varchar(50) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `tipe_pembayaran` varchar(30) NOT NULL,
  `store` varchar(30) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `kode_pembayaran` varchar(30) NOT NULL,
  `total_bayar` int(20) NOT NULL,
  `jasa_kurir` varchar(50) NOT NULL,
  `status_bayar` varchar(50) NOT NULL,
  `status_pesanan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `token` varchar(150) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `akun_mahasiswa`
--
ALTER TABLE `akun_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `akun_umum`
--
ALTER TABLE `akun_umum`
  ADD PRIMARY KEY (`id_umum`);

--
-- Indeks untuk tabel `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `profile_website`
--
ALTER TABLE `profile_website`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `tentang_warma`
--
ALTER TABLE `tentang_warma`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `akun_mahasiswa`
--
ALTER TABLE `akun_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `akun_umum`
--
ALTER TABLE `akun_umum`
  MODIFY `id_umum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `profile_website`
--
ALTER TABLE `profile_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tentang_warma`
--
ALTER TABLE `tentang_warma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
