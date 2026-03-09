-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 01:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_pelanggan`, `id_barang`, `qty`, `harga`, `subtotal`, `created_at`) VALUES
(16, 1, 1, 2, 800000, 1600000, '2026-02-23 16:28:56'),
(19, 1, 5, 1, 5000000, 5000000, '2026-02-28 01:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `deskripsi`, `gambar`, `berat`) VALUES
(1, 'Gitar Akustik Cort', 1, 800000, 'Alasan memilih produk kami :🎵\r\n\r\n🥇Kualitas bahan,onderdil dan finishing kami Berikan sebaik mungkin untuk mencapai performa yang sempurna. \r\n🥇Jarak senar kami buat serendah mungkin untuk kenyamanan pengguna.\r\n🥇Barang kami cek fisik dan fungsi dahulu sebelum dikirim, ada Petugas khusus quality control ( QC )🔧\r\n🥇Finishing kami buat rapi dan Quality Control kami aktif sebelum dikirim.\r\n🥇Pengiriman menggunakan packing Kayu/Box Kayu sehingga Aman dikirim dalam pulau jawa maupun luar jawa\r\n   (Chat  admin untuk info tambahabn paking kayu )\r\n🥇Garansi 💯% Jika barang rusak bisa kami ganti Barang baru maupun pengembalian barang & dana.🎸💵\r\n🥇Barang Kami Fresh (Baru) bukan stok lama/display toko.\r\n\r\n📦 Terdapat Packingan Khusus:\r\n   - Kardus: 2 lapis\r\n   - Bubble Warp: 3 Lapis\r\n     Jaminan Extra Aman', 'gitar_cort.jpg', 2000),
(2, 'Drum Elektrik', 2, 5000000, 'deskripsi', 'drum_roland.jpg', 8000),
(3, 'Keyboard Orgen', 3, 2000000, 'deskripsi', 'piano.jpg', 2000),
(4, 'Gitar Ukulele', 1, 300000, 'deskripsi', 'ukulele.jpg', 800),
(5, 'Piano Besar', 3, 5000000, 'deskripsi', 'pianobesar.jpg', 5000),
(6, 'Ampli Gitar', 1, 1000000, 'deskripsi', 'ampli.jpg', 1000),
(9, 'Pick Gitar', 1, 10000, 'deskrpsi', 'pick_gitar.jpg', 50),
(10, 'Drum Portabel', 2, 300000, 'Tampilannya ringan, stylish, simple dan mudah dibawa.\r\nPengaturan drum pad standar dan antarmuka ekspansi pedal memberi Anda kenikmatan drum kit sesungguhnya.\r\nFungsi perekaman bawaan, nyaman bagi Anda untuk merekam inspirasi musik Anda kapan saja dan di mana saja.\r\nMuncul dengan 2 speaker stereo berkualitas tinggi, yang dapat digunakan kapan saja dan di mana saja.\r\nAntarmuka USB MIDI dapat dihubungkan ke komputer untuk mendukung semua perangkat lunak dan game MIDI.\r\nAntarmuka input/output audio, kemampuan ekspansi yang kuat, bebas memilih lagu musik untuk membuat musik.\r\n9 pads drum, 2 pedal drum (hi-hat, kick drum), memiliki 12 lagu demo, 7 set drum set, 9 set pengiring.\r\nDapat dihubungkan ke headphone eksternal atau speaker eksternal.\r\nCatu daya USB/DC5V atau catu daya bank daya.', 'drumportable.jpg', 500),
(11, 'Gitar Elektrik Ibanez', 1, 4000000, 'Ready Stock Gitar Listrik Ibanez Jem Hitam TERBARU\r\n\r\nSpesifikasi :\r\nBody Mahogani\r\nNeck Maple\r\nFret Baja\r\nDryer Stainless sudah di coating anti karat\r\nPick Up GnB korea\r\n\r\nKualitas dijamin bagus dan jangan di ragukan lagi yah kak\r\n\r\nUkuran gitar kurang lebih (P102 x L32 x T4)\r\n\r\nBonus Tas & Handle', 'ibanez.jpg', 3000),
(12, 'Stick Drum Roland', 2, 50000, 'Deskripsi', 'stick_drum.jpg', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_gambar`
--

INSERT INTO `tb_gambar` (`id_gambar`, `id_barang`, `keterangan`, `gambar`) VALUES
(1, 1, 'gambar 1', 'cort1.jpg'),
(2, 1, 'gambar 2', 'cort2.jpg'),
(3, 1, 'gambar 3', 'cort3.jpg'),
(4, 1, 'gambar 4', 'cort4.jpg'),
(5, 2, 'gambar1', 'drumelektrik1.jpg'),
(6, 2, 'gambar 2', 'drumelektrik2.jpg'),
(7, 3, 'gambar 1', 'keyboardpiano1.jpg'),
(14, 11, 'gambar 1', 'gitarelektrik1.jpg'),
(15, 11, 'gambar 2', 'gitarelektrik2.jpg'),
(16, 11, 'gambar 3', 'gitarelektrik3.jpg'),
(17, 11, 'gambar 4', 'gitarelektrik4.jpg'),
(18, 10, 'gambar 1', 'drumport1.jpg'),
(19, 10, 'gambar 2', 'drumport2.jpg'),
(20, 10, 'gambar 3', 'drumport3.jpg'),
(21, 5, 'gambar 1', 'pianoklasik1.jpg'),
(22, 5, 'gambar 2', 'painoklasik2.jpg'),
(23, 5, 'gambar3', 'pianoklasik3.jpg'),
(24, 5, 'gambar 4', 'pianoklasik4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(6011) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Gitar'),
(2, 'Drum'),
(3, 'Piano');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `foto`) VALUES
(1, 'syafiq', 'mumun@gmail.com', 'abcd', 'profil.jpg'),
(2, 'toni', 'tonini@gmail.com', '12345', ''),
(3, 'zuhri', 'zuhri@gmail.com', 'zuhri', NULL),
(4, 'paemo', 'paemo@gmail.com', 'paemo', NULL),
(5, 'Kolo', 'Kolo@gmail.com', 'kolokolo', NULL),
(6, 'Mona', 'monamoni@gmail.com', 'Mona123', NULL),
(7, 'CI OOO', 'Ceio@gmail.com', '12345678', NULL),
(8, 'Alex', 'Alexx@gmail.com', '00000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(30) DEFAULT NULL,
  `no_rek` varchar(30) DEFAULT NULL,
  `atas_nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rekening`
--

INSERT INTO `tb_rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'BRI', '7764-3421-8975-321', 'Zuhri'),
(2, 'BNI', '3254-7574-8889-0009', 'Zuhri');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rinci_transaksi`
--

CREATE TABLE `tb_rinci_transaksi` (
  `id_rinci` int(11) NOT NULL,
  `no_order` varchar(15) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rinci_transaksi`
--

INSERT INTO `tb_rinci_transaksi` (`id_rinci`, `no_order`, `id_barang`, `qty`) VALUES
(2, '202401040JMNUXW', 1, 4),
(3, '202401040JMNUXW', 11, 3),
(4, '202401040JMNUXW', 10, 2),
(5, '20240104L2OAVBV', 6, 3),
(6, '20240104L2OAVBV', 2, 1),
(7, '20240104L2OAVBV', 9, 4),
(8, '20240104QIKPWTE', 11, 1),
(9, '20240104QIKPWTE', 10, 1),
(10, '20240104QIKPWTE', 6, 1),
(11, '20240104NU3OXTZ', 4, 1),
(12, '20240104NU3OXTZ', 3, 1),
(13, '20240104QJRSEPX', 11, 2),
(14, '20240104QDG15KG', 4, 1),
(15, '202401049R7BTWT', 11, 2),
(16, '20240106S0C7NBW', 4, 3),
(17, '20240106S0C7NBW', 11, 1),
(18, '20240106S0C7NBW', 10, 1),
(19, '20240106S0C7NBW', 6, 1),
(20, '202401070YABTBM', 11, 3),
(21, '20240111UE5TMJS', 10, 1),
(22, '20240111NXEX08F', 11, 2),
(23, '20240114UABWIE9', 10, 2),
(24, '202401140WFV1YP', 11, 2),
(25, '20240405WAGSBDN', 11, 1),
(26, '20250307WWLC1ZZ', 11, 2),
(27, '20251201MQYLBDC', 11, 3),
(28, '20260212X3ICDR7', 10, 1),
(29, '6998367505ca4', 11, 1),
(30, '699949dbd0d4a', 5, 1),
(31, '699949dbd0d4a', 12, 1),
(32, '6999509ee43e9', 11, 1),
(33, '20260222054427', 3, 2),
(34, '20260223091433', 11, 1),
(35, '20260223091433', 10, 1),
(36, '20260223093935', 6, 2),
(37, '20260223175827', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `lokasi` int(11) DEFAULT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_telpon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id`, `nama_toko`, `lokasi`, `alamat_toko`, `no_telpon`) VALUES
(1, 'Zuhri Store', 0, 'ds kendalkemlagi-Karanggeneng', '5456562562564');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(20) DEFAULT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(20) DEFAULT NULL,
  `hp_penerima` varchar(15) DEFAULT NULL,
  `provinsi` varchar(20) DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `ekspedisi` varchar(150) DEFAULT NULL,
  `paket` varchar(150) DEFAULT NULL,
  `estimasi` varchar(150) DEFAULT NULL,
  `ongkir` int(20) DEFAULT NULL,
  `berat` int(15) DEFAULT NULL,
  `grand_total` int(20) DEFAULT NULL,
  `total_bayar` int(20) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` text DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pelanggan`, `no_order`, `tgl_order`, `nama_penerima`, `hp_penerima`, `provinsi`, `kota`, `alamat`, `kode_pos`, `ekspedisi`, `paket`, `estimasi`, `ongkir`, `berat`, `grand_total`, `total_bayar`, `status_bayar`, `bukti_bayar`, `atas_nama`, `nama_bank`, `no_rek`, `status_order`, `no_resi`) VALUES
(5, 1, '202401040JMNUXWF', '2024-01-04', 'zuuh', '5456562562564', 'Jawa Timur', 'Bondowoso', 'ds kendalkemlagi', '234142', 'pos', 'Pos Ekonomi', '3-5 Hari', 280000, 18000, 15800000, 5280000, 1, 'bukti2.jpg', 'budi', 'BRI', '3432-5565-7554-2211', 3, 'FUJ8976518ji9'),
(9, 1, '20240104QJRSEPXD', '2024-01-04', 'Syafiq Zuhri', '085607880511', 'Jawa Timur', 'Lamongan', 'Karanggeneng-lamongan', '234142', 'jne', 'CTC', '2-3 Hari', 36000, 6000, 8000000, 8036000, 1, 'bukti3.jpg', 'syafiq', 'BNI', '1234-1234-134-1234', 3, 'JIKO9898q78q009'),
(10, 1, '20240104QDG15KGL', '2024-01-04', 'susi', '033990011112', 'Jawa Tengah', 'Magelang', 'Bojonegoro', '233342', 'pos', 'Pos Reguler', '3 HARI Hari', 15500, 800, 300000, 315500, 1, 'bukti4.jpg', 'koop', 'BNI', '3232-9898-7676-9865', 3, 'FRDE909877ytg6'),
(11, 1, '202401049R7BTWTH', '2024-01-04', 'syafiq', '087677854323', 'Jawa Timur', 'Lamongan', 'ds kendalkemlagi', '234142', 'jne', 'CTCYES', '1-1 Hari', 60000, 6000, 8000000, 8060000, 1, 'bukti6.jpg', 'yuyu', 'BRI', '6372-4772-223-1122', 2, 'jjuu88988787'),
(12, 1, '20240106S0C7NBWG', '2024-01-06', 'syafiq', '087667588443', 'Jawa Timur', 'Banyuwangi', 'Karanggeneng-lamongan', '223445', 'tiki', 'ECO', '5 Hari', 42000, 6900, 6200000, 6242000, 1, 'bukti5.jpg', 'rere', 'BRI', '6372-4772-223-1122', 3, 'GYGHU453536rrt5'),
(13, 1, '202401070YABTBM4', '2024-01-07', 'azis', '085607880511', 'Jawa Timur', 'Lamongan', 'Karanggeneng-lamongan', '234142', 'jne', 'CTC', '2-3 Hari', 54000, 9000, 12000000, 12054000, 1, 'bukti7.jpg', 'azis', 'BRI', '6372-4772-223-1122', 1, NULL),
(14, 1, '20240111UE5TMJS7', '2024-01-11', 'Syafiq Zuhri', '085607880511', 'Jawa Timur', 'Madiun', 'Karanggeneng-lamongan', '234142', 'jne', 'OKE', '2-3 Hari', 10000, 500, 300000, 310000, 1, 'bukti8.jpg', 'atok', 'BRI', '6372-4772-223-1122', 3, 'GYGDh8364834'),
(15, 1, '20240111NXEX08F1', '2024-01-11', 'Ani', '033990011112', 'Jawa Timur', 'Magetan', 'Bojonegoro', '223345', 'jne', 'REG', '1-2 Hari', 90000, 6000, 8000000, 8090000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(16, 1, '20240114UABWIE9Q', '2024-01-14', 'syafiq', '085731461727', 'Kalimantan Tengah', 'Lamandau', 'KENDALKEMLAGI RT 02 RW 06', '233442', 'jne', 'OKE', '5-7 Hari', 57000, 1000, 600000, 657000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(17, 2, '202401140WFV1YPP', '2024-01-14', 'toni', '08766526611728', 'Jawa Timur', 'Kediri', 'SimoSungelebak-Karanggeneng', '234552', 'pos', 'Pos Reguler', '2 HARI Hari', 42000, 6000, 8000000, 8042000, 1, 'bukti81.jpg', 'toni', 'BRI', '6372-4772-223-1122', 3, 'ASDEF121393984'),
(18, 4, '20240405WAGSBDNJ', '2024-04-05', 'paemo', '090908', 'Jawa Timur', 'Jombang', 'hudhududd', '323244', 'jne', 'REG', '1-2 Hari', 45000, 3000, 4000000, 4045000, 1, 'dfdLevel0.png', 'rereas', 'BNI', '5656577', 3, 'uihjhy878788'),
(19, 5, '20250307WWLC1ZZ7', '2025-03-07', 'Kolo', '0989654567', 'Sumatera Selatan', 'Palembang', 'huhu', '4565', 'jne', 'REG', '2-4 Hari', 360000, 6000, 8000000, 8360000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(20, 6, '20251201MQYLBDCI', '2025-12-01', 'Mona', '085607880511', 'JAWA TIMUR', 'KABUPATEN MALANG', 'Karanggeneng-lamongan', '234142', 'jne', 'REG', '', 0, 9000, 12000000, 0, 1, 'DSC00660.JPG', 'huna', 'BCA1', '9280109022292912', 2, 'rfwdssmkmsef54'),
(21, 7, '20260212X3ICDR7Q', '2026-02-12', 'CI OOO', '085607880511', 'KEPULAUAN RIAU', 'KABUPATEN KARIMUN', 'DESA KENDALKEMLAGI KARANGGENENG LAMONGAN', '234142', 'jne', 'REG', '', 0, 500, 300000, 0, 0, NULL, NULL, NULL, NULL, 0, NULL),
(26, 7, '20260222051327', '2026-02-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL),
(27, 7, '20260222054250', '2026-02-22', 'CI OOO', '097869433', 'LAMPUNG', 'KABUPATEN WAY KANAN', 'rereer', '34355', 'jne', 'REG', '', 0, 4000, 4000000, 4000000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(28, 7, '20260222054427', '2026-02-22', 'CI OOO', '097869433', 'DI YOGYAKARTA', 'KABUPATEN KULON PROG', 'rereer', '34355', 'jne', 'REG', '', 0, 4000, 4000000, 4000000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(29, 7, '20260223091433', '2026-02-23', 'CI OOO', '87929191', 'JAWA TIMUR', 'KABUPATEN JEMBER', 'kulonn', '87878', 'jne', 'REG', '', 0, 3500, 4300000, 4300000, 1, 'Screenshot_(3).png', 'huhu', 'mandiri', '3783787299493', 1, NULL),
(30, 1, '20260223093935', '2026-02-23', 'syafiq', '085607880511', 'PAPUA', 'KABUPATEN MERAUKE', 'Karanggeneng-lamongan', '234142', 'jne', 'REG', '', 0, 2000, 2000000, 2000000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(31, 7, '20260223175827', '2026-02-23', 'CI OOO', '085607880511', 'SULAWESI BARAT', 'KABUPATEN POLEWALI M', 'Karanggeneng-lamongan', '234142', 'jne', 'REG', '', 0, 5000, 5000000, 5000000, 1, 'Screenshot_2026-02-23_210006_imgupscaler_ai_Beta_2K.jpg', 'LOLOLO', 'mandiri', '3783787299493', 3, 'try67688h77');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `level_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(5, 'Zuhri', 'admin', 'admin', 1),
(6, 'syafiq', 'user', 'user', 2),
(7, 'maulana', 'maulana', 'abc', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`,`id_barang`),
  ADD KEY `fk_cart_barang` (`id_barang`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `tb_rinci_transaksi`
--
ALTER TABLE `tb_rinci_transaksi`
  ADD PRIMARY KEY (`id_rinci`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rinci_transaksi`
--
ALTER TABLE `tb_rinci_transaksi`
  MODIFY `id_rinci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_barang` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
