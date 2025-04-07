-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2025 at 04:17 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nguduc9_quanlyrapchieuphim`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdatve`
--

DROP TABLE IF EXISTS `chitietdatve`;
CREATE TABLE IF NOT EXISTS `chitietdatve` (
  `id_chi_tiet_dat_ve` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `so_tien` double DEFAULT NULL,
  `ngay_phat_hanh` varchar(50) DEFAULT NULL,
  `danh_sach_ghes_da_dat` varchar(100) NOT NULL,
  `id_lich_chieu` int NOT NULL,
  `id_don_hang` int NOT NULL,
  PRIMARY KEY (`id_chi_tiet_dat_ve`),
  KEY `id_lich_chieu` (`id_lich_chieu`),
  KEY `fk_id_don_hang` (`id_don_hang`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `chitietdatve`
--

INSERT INTO `chitietdatve` (`id_chi_tiet_dat_ve`, `so_tien`, `ngay_phat_hanh`, `danh_sach_ghes_da_dat`, `id_lich_chieu`, `id_don_hang`) VALUES
(25, 270000, '2025-01-20 12:49:10', 'D9', 25, 16),
(23, 270000, '2025-01-19 16:15:38', 'D4,D5', 25, 14),
(24, 540000, '2025-01-19 22:31:39', 'B6,B7', 25, 15),
(26, 270000, '2025-01-20 12:49:37', 'C9', 25, 17),
(27, 270000, '2025-01-20 12:50:28', 'C7', 25, 18),
(28, 270000, '2025-01-20 12:51:09', 'B9', 25, 19),
(29, 270000, '2025-01-20 12:53:09', 'C6', 25, 20),
(30, 200000, '2025-01-21 09:30:40', 'A7,A8', 25, 21),
(31, 100000, '2025-03-22 16:08:33', 'D5', 58, 22),
(32, 100000, '2025-03-22 16:08:41', 'D5', 58, 23),
(33, 100000, '2025-03-22 16:09:52', 'C6', 58, 24),
(34, 100000, '2025-03-22 16:18:05', 'A4', 58, 25),
(35, 100000, '2025-03-22 16:18:07', 'A4', 58, 26),
(36, 100000, '2025-03-22 16:18:48', 'B8', 58, 27),
(37, 100000, '2025-03-22 16:19:03', 'D8', 58, 28),
(38, 100000, '2025-03-22 16:20:06', 'D7', 58, 29),
(39, 100000, '2025-03-22 16:22:53', 'C9', 58, 30),
(40, 100000, '2025-03-22 16:23:31', 'E5', 58, 31),
(41, 100000, '2025-03-22 16:23:34', 'E5', 58, 32),
(42, 100000, '2025-03-22 16:28:46', 'A10', 58, 33),
(43, 100000, '2025-03-22 16:29:03', 'A9', 58, 34),
(44, 100000, '2025-03-22 16:29:32', 'A8', 58, 35),
(45, 100000, '2025-03-22 16:29:56', 'A7', 58, 36),
(46, 100000, '2025-03-22 16:30:58', 'A6', 58, 37),
(47, 100000, '2025-03-22 16:32:50', 'A5', 58, 38),
(48, 100000, '2025-03-22 16:34:42', 'A3', 58, 39),
(49, 100000, '2025-03-22 16:35:21', 'A2', 58, 40),
(50, 100000, '2025-03-22 16:36:27', 'A1', 58, 41),
(51, 100000, '2025-03-22 16:36:48', 'B1', 58, 42),
(52, 100000, '2025-03-22 16:52:23', 'B2', 58, 43),
(53, 100000, '2025-03-22 16:59:34', 'B3', 58, 44),
(54, 100000, '2025-03-22 17:00:04', 'B4', 58, 45),
(55, 100000, '2025-03-22 17:03:29', 'B5', 58, 46),
(56, 100000, '2025-03-22 17:06:04', 'B6', 58, 47),
(57, 100000, '2025-03-22 17:07:58', 'B7', 58, 48),
(58, 100000, '2025-03-22 17:09:09', 'B9', 58, 49),
(59, 100000, '2025-03-22 17:14:55', 'B10', 58, 50),
(60, 100000, '2025-03-22 17:16:50', 'C10', 58, 51),
(61, 200000, '2025-03-23 15:05:08', 'C7,C8', 58, 52),
(62, 200000, '2025-03-23 15:10:52', 'C5,C4', 58, 53),
(63, 200000, '2025-03-23 15:15:57', 'C3,C2', 58, 54),
(64, 100000, '2025-03-23 15:18:31', 'C1', 58, 55),
(65, 100000, '2025-03-23 15:20:14', 'D10', 58, 56),
(66, 300000, '2025-03-27 15:24:37', 'A8,A9', 61, 57),
(67, 450000, '2025-03-28 06:53:41', 'A10,A11,A12', 61, 58),
(68, 600000, '2025-04-02 14:59:51', 'A8,A9,A10', 87, 59);

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhangonline`
--

DROP TABLE IF EXISTS `chitietdonhangonline`;
CREATE TABLE IF NOT EXISTS `chitietdonhangonline` (
  `maDonHang` int NOT NULL,
  `maSanPham` int NOT NULL,
  `soLuong` int NOT NULL,
  `giaBan` decimal(10,2) NOT NULL,
  PRIMARY KEY (`maDonHang`,`maSanPham`),
  KEY `maSanPham` (`maSanPham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietlichchieu`
--

DROP TABLE IF EXISTS `chitietlichchieu`;
CREATE TABLE IF NOT EXISTS `chitietlichchieu` (
  `id_lich_chieu` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_lich` int UNSIGNED DEFAULT NULL,
  `gia_ve` int NOT NULL,
  PRIMARY KEY (`id_lich_chieu`),
  KEY `fk_id_lich` (`id_lich`)
) ENGINE=MyISAM AUTO_INCREMENT=708 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `chitietlichchieu`
--

INSERT INTO `chitietlichchieu` (`id_lich_chieu`, `id_lich`, `gia_ve`) VALUES
(683, 1, 100000),
(684, 2, 120000),
(685, 3, 150000),
(686, 4, 130000),
(687, 5, 110000),
(688, 6, 125000),
(689, 7, 140000),
(690, 8, 135000),
(691, 9, 145000),
(692, 10, 155000),
(693, 11, 160000),
(694, 12, 170000),
(695, 13, 175000),
(696, 14, 165000),
(697, 15, 180000),
(698, 16, 185000),
(699, 17, 190000),
(700, 18, 200000),
(701, 19, 210000),
(702, 20, 220000),
(703, 21, 230000),
(704, 22, 240000),
(705, 23, 250000),
(706, 24, 260000),
(707, 25, 270000);

-- --------------------------------------------------------

--
-- Table structure for table `chucnang`
--

DROP TABLE IF EXISTS `chucnang`;
CREATE TABLE IF NOT EXISTS `chucnang` (
  `maChucNang` int NOT NULL AUTO_INCREMENT,
  `tenChucNang` varchar(100) NOT NULL,
  `moTa` text,
  PRIMARY KEY (`maChucNang`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chucnang`
--

INSERT INTO `chucnang` (`maChucNang`, `tenChucNang`, `moTa`) VALUES
(1, 'Quản lý phim', 'Quản lý thông tin phim, danh sách phim, sửa thông tin phim'),
(2, 'Quản lý phòng chiếu', 'Quản lý thông tin rạp chiếu, phòng chiếu, số ghế, trạng thái rạp chiếu'),
(3, 'Quản lý lịch chiếu phim', 'Thiết lập lịch chiếu phim, ngày giờ chiếu, rạp chiếu'),
(4, 'Quản lý vé xem phim', 'Xem danh sách vé, kiểm tra trạng thái vé, sửa thông tin vé'),
(5, 'Quản lý khách hàng', 'Quản lý thông tin khách hàng, danh sách khách hàng, điểm tích lũy khách hàng'),
(6, 'Quản lý phân quyền', 'Quản lý tài khoản đăng nhập của nhân viên, quyền hạn, vai trò'),
(7, 'Quản lý nhóm quản lý', 'Tạo, chỉnh sửa, xóa nhóm quản lý, phân quyền nhóm quản lý'),
(8, 'Quản lý khuyến mãi', 'Thiết lập khuyến mãi, mã giảm giá, thời gian áp dụng, quản lý trạng thái khuyến mãi'),
(9, 'Quản lý hóa đơn', 'Quản lý hóa đơn, lịch sử giao dịch, xem chi tiết giao dịch, hoàn tiền');

-- --------------------------------------------------------

--
-- Table structure for table `donhangonline`
--

DROP TABLE IF EXISTS `donhangonline`;
CREATE TABLE IF NOT EXISTS `donhangonline` (
  `maDonHang` int NOT NULL AUTO_INCREMENT,
  `maKH` int DEFAULT NULL,
  `ngayDat` datetime DEFAULT CURRENT_TIMESTAMP,
  `tongTien` decimal(10,2) NOT NULL,
  `trangThai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'Chờ thanh toán',
  `phuongThucThanhToan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`maDonHang`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `donhangonline`
--

INSERT INTO `donhangonline` (`maDonHang`, `maKH`, `ngayDat`, `tongTien`, `trangThai`, `phuongThucThanhToan`) VALUES
(1, 1, '2024-12-30 21:19:02', 50000.00, 'Đã thanh toán', 'Momo'),
(2, 2, '2024-12-30 21:19:02', 300000.00, 'Chờ thanh toán', 'ZaloPay'),
(3, 3, '2024-12-30 21:19:02', 120000.00, 'Đã hủy', 'Thẻ tín dụng'),
(8, 12, '2025-01-19 16:02:55', 270000.00, 'Đã hoàn tất', 'momo'),
(9, 12, '2025-01-19 16:05:31', 540000.00, 'Đã hoàn tất', 'bank'),
(10, 12, '2025-01-19 16:08:18', 270000.00, 'Đã hoàn tất', 'momo'),
(11, 12, '2025-01-19 16:10:04', 270000.00, 'Đã hoàn tất', 'momo'),
(12, 12, '2025-01-19 16:12:28', 540000.00, 'Đã hoàn tất', 'bank'),
(13, 12, '2025-01-19 16:13:24', 540000.00, 'Đã hoàn tất', 'bank'),
(14, 12, '2025-01-19 16:15:38', 270000.00, 'Đã hoàn tất', 'momo'),
(15, 12, '2025-01-19 22:31:39', 540000.00, 'Đã hoàn tất', 'momo'),
(16, 12, '2025-01-20 12:49:10', 270000.00, 'Đã hoàn tất', 'bank'),
(17, 12, '2025-01-20 12:49:37', 270000.00, 'Đã hoàn tất', 'momo'),
(18, 12, '2025-01-20 12:50:28', 270000.00, 'Đã hoàn tất', 'bank'),
(19, 12, '2025-01-20 12:51:09', 270000.00, 'Đã hoàn tất', 'bank'),
(20, 12, '2025-01-20 12:53:09', 270000.00, 'Đã hoàn tất', 'bank'),
(21, 12, '2025-01-21 09:30:40', 200000.00, 'Đã hoàn tất', 'momo'),
(22, 1, '2025-03-22 16:08:33', 100000.00, 'Đã hoàn tất', 'momo'),
(23, 1, '2025-03-22 16:08:41', 100000.00, 'Đã hoàn tất', 'momo'),
(24, 1, '2025-03-22 16:09:52', 100000.00, 'Đã hoàn tất', 'momo'),
(25, 1, '2025-03-22 16:18:05', 100000.00, 'Đã hoàn tất', 'momo'),
(26, 1, '2025-03-22 16:18:07', 100000.00, 'Đã hoàn tất', 'momo'),
(27, 1, '2025-03-22 16:18:48', 100000.00, 'Đã hoàn tất', 'momo'),
(28, 1, '2025-03-22 16:19:03', 100000.00, 'Đã hoàn tất', 'momo'),
(29, 1, '2025-03-22 16:20:06', 100000.00, 'Đã hoàn tất', 'momo'),
(30, 1, '2025-03-22 16:22:53', 100000.00, 'Đã hoàn tất', 'momo'),
(31, 1, '2025-03-22 16:23:31', 100000.00, 'Đã hoàn tất', 'momo'),
(32, 1, '2025-03-22 16:23:34', 100000.00, 'Đã hoàn tất', 'momo'),
(33, 1, '2025-03-22 16:28:46', 100000.00, 'Đã hoàn tất', 'momo'),
(34, 1, '2025-03-22 16:29:03', 100000.00, 'Đã hoàn tất', 'momo'),
(35, 1, '2025-03-22 16:29:32', 100000.00, 'Đã hoàn tất', 'momo'),
(36, 1, '2025-03-22 16:29:56', 100000.00, 'Đã hoàn tất', 'momo'),
(37, 1, '2025-03-22 16:30:58', 100000.00, 'Đã hoàn tất', 'momo'),
(38, 1, '2025-03-22 16:32:50', 100000.00, 'Đã hoàn tất', 'momo'),
(39, 1, '2025-03-22 16:34:42', 100000.00, 'Đã hoàn tất', 'momo'),
(40, 1, '2025-03-22 16:35:21', 100000.00, 'Đã hoàn tất', 'bank'),
(41, 1, '2025-03-22 16:36:27', 100000.00, 'Đã hoàn tất', 'momo'),
(42, 1, '2025-03-22 16:36:48', 100000.00, 'Đã hoàn tất', 'bank'),
(43, 1, '2025-03-22 16:52:23', 100000.00, 'Đã hoàn tất', 'momo'),
(44, 1, '2025-03-22 16:59:34', 100000.00, 'Đã hoàn tất', 'momo'),
(45, 1, '2025-03-22 17:00:04', 100000.00, 'Đã hoàn tất', 'momo'),
(46, 1, '2025-03-22 17:03:29', 100000.00, 'Đã hoàn tất', 'momo'),
(47, 1, '2025-03-22 17:06:04', 100000.00, 'Đã hoàn tất', 'momo'),
(48, 1, '2025-03-22 17:07:58', 100000.00, 'Đã hoàn tất', 'momo'),
(49, 1, '2025-03-22 17:09:09', 100000.00, 'Đã hoàn tất', 'momo'),
(50, 1, '2025-03-22 17:14:55', 100000.00, 'Đã hoàn tất', 'momo'),
(51, 1, '2025-03-22 17:16:50', 100000.00, 'Đã hoàn tất', 'momo'),
(52, 1, '2025-03-23 15:05:08', 200000.00, 'Đã hoàn tất', 'vnpay'),
(53, 1, '2025-03-23 15:10:52', 200000.00, 'Đã hoàn tất', 'vnpay'),
(54, 1, '2025-03-23 15:15:57', 200000.00, 'Đã hoàn tất', 'vnpay'),
(55, 1, '2025-03-23 15:18:31', 100000.00, 'Đã hoàn tất', 'vnpay'),
(56, 1, '2025-03-23 15:20:14', 100000.00, 'Đã hoàn tất', 'vnpay'),
(57, 1, '2025-03-27 15:24:37', 300000.00, 'Đã hoàn tất', 'vnpay'),
(58, 1, '2025-03-28 06:53:41', 450000.00, 'Đã hoàn tất', 'momo'),
(59, 1, '2025-04-02 14:59:51', 600000.00, 'Đã hoàn tất', 'momo');

-- --------------------------------------------------------

--
-- Table structure for table `donhang_veonline`
--

DROP TABLE IF EXISTS `donhang_veonline`;
CREATE TABLE IF NOT EXISTS `donhang_veonline` (
  `maDonHang` int NOT NULL,
  `maVe` int NOT NULL,
  PRIMARY KEY (`maDonHang`,`maVe`),
  KEY `maVe` (`maVe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ghe`
--

DROP TABLE IF EXISTS `ghe`;
CREATE TABLE IF NOT EXISTS `ghe` (
  `maPhongChieu` int NOT NULL,
  `soGhe` varchar(10) NOT NULL,
  `trangThai` varchar(50) DEFAULT 'Trống',
  `soHang` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ghe`
--

INSERT INTO `ghe` (`maPhongChieu`, `soGhe`, `trangThai`, `soHang`) VALUES
(1, '10', 'Trống', 10),
(2, '12', 'Trống', 10),
(3, '10', 'Trống', 13),
(4, '10', 'Trống', 10);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `maKH` int NOT NULL AUTO_INCREMENT,
  `hoTen` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `soDienThoai` varchar(15) NOT NULL,
  `ngaySinh` date DEFAULT NULL,
  `gioiTinh` varchar(10) DEFAULT NULL,
  `ngayTao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`maKH`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `hoTen`, `email`, `soDienThoai`, `ngaySinh`, `gioiTinh`, `ngayTao`) VALUES
(1, 'Nguyen Van A', 'nguyenvana@example.com', '0123456789', '1990-01-01', 'Nam', '2024-12-30 21:15:24'),
(2, 'Tran Thi B', 'tranthib@example.com', '0123456790', '1992-02-02', 'Nu', '2024-12-30 21:15:24'),
(3, 'Le Van C', 'levanc@example.com', '0123456780', '1995-03-03', 'Nam', '2024-12-30 21:15:24'),
(12, 'Đàm Quang Thuận', 'thuanq@gmail.com', '0303030303', '2004-12-08', 'Nam', '2025-01-12 15:53:53'),
(13, '', '', '', NULL, NULL, '2025-01-14 13:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `maKhuyenMai` int NOT NULL AUTO_INCREMENT,
  `tenKhuyenMai` varchar(100) NOT NULL,
  `moTa` text,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `giaTriKhuyenMai` decimal(10,2) NOT NULL,
  `loaiKhuyenMai` varchar(20) DEFAULT NULL,
  `trangThai` varchar(50) DEFAULT 'Hoạt động',
  `maNhanVien` int DEFAULT NULL,
  PRIMARY KEY (`maKhuyenMai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lichchieuphim`
--

DROP TABLE IF EXISTS `lichchieuphim`;
CREATE TABLE IF NOT EXISTS `lichchieuphim` (
  `maLichChieuPhim` int NOT NULL AUTO_INCREMENT,
  `maPhongChieuPhim` int NOT NULL,
  `maPhim` int NOT NULL,
  `ngayChieu` date NOT NULL,
  `suatChieu` time NOT NULL,
  `loaiChieu` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `giave` int DEFAULT '0',
  PRIMARY KEY (`maLichChieuPhim`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lichchieuphim`
--

INSERT INTO `lichchieuphim` (`maLichChieuPhim`, `maPhongChieuPhim`, `maPhim`, `ngayChieu`, `suatChieu`, `loaiChieu`, `giave`) VALUES
(1, 1, 1, '2025-01-17', '09:00:00', '2D', 100000),
(2, 1, 3, '2025-01-17', '12:30:00', '2D', 100000),
(4, 1, 5, '2025-01-17', '14:45:00', '3D', 100000),
(5, 1, 6, '2025-01-17', '16:00:00', '2D', 100000),
(6, 1, 7, '2025-01-17', '17:00:00', '2D', 100000),
(7, 1, 1, '2025-01-17', '18:30:00', '3D', 100000),
(8, 1, 3, '2025-01-17', '19:30:00', '3D', 100000),
(10, 1, 5, '2025-01-17', '20:45:00', '2D', 100000),
(11, 1, 6, '2025-01-17', '22:00:00', '3D', 100000),
(12, 1, 7, '2025-01-17', '23:00:00', '3D', 100000),
(13, 1, 1, '2025-01-18', '09:00:00', '2D', 100000),
(14, 1, 3, '2025-01-18', '12:30:00', '2D', 100000),
(16, 1, 5, '2025-01-18', '14:45:00', '3D', 100000),
(17, 1, 6, '2025-01-18', '16:00:00', '2D', 100000),
(18, 1, 7, '2025-01-18', '17:00:00', '2D', 100000),
(19, 1, 1, '2025-01-18', '18:30:00', '3D', 100000),
(20, 1, 3, '2025-01-18', '19:30:00', '3D', 100000),
(22, 1, 5, '2025-01-18', '20:45:00', '2D', 100000),
(23, 1, 6, '2025-01-18', '22:00:00', '3D', 100000),
(24, 1, 7, '2025-01-18', '23:00:00', '3D', 100000),
(25, 1, 1, '2025-01-19', '09:00:00', '2D', 100000),
(26, 1, 3, '2025-01-19', '12:30:00', '2D', 100000),
(28, 1, 5, '2025-01-19', '14:45:00', '3D', 100000),
(29, 1, 6, '2025-01-19', '16:00:00', '2D', 100000),
(30, 1, 7, '2025-01-19', '17:00:00', '2D', 100000),
(31, 1, 1, '2025-01-19', '18:30:00', '3D', 100000),
(32, 1, 3, '2025-01-19', '19:30:00', '3D', 100000),
(33, 1, 4, '2025-01-19', '20:00:00', '2D', 100000),
(34, 1, 5, '2025-01-19', '20:45:00', '2D', 100000),
(35, 1, 6, '2025-01-19', '22:00:00', '3D', 100000),
(36, 1, 7, '2025-01-19', '23:00:00', '3D', 100000),
(37, 1, 1, '2025-01-20', '09:00:00', '2D', 100000),
(38, 1, 3, '2025-01-20', '12:30:00', '2D', 100000),
(39, 1, 4, '2025-01-20', '13:30:00', '3D', 100000),
(40, 1, 5, '2025-01-20', '14:45:00', '3D', 100000),
(41, 1, 6, '2025-01-20', '16:00:00', '2D', 100000),
(42, 1, 7, '2025-01-20', '17:00:00', '2D', 100000),
(43, 1, 1, '2025-01-20', '18:30:00', '3D', 100000),
(44, 1, 3, '2025-01-20', '19:30:00', '3D', 100000),
(45, 1, 4, '2025-01-20', '20:00:00', '2D', 100000),
(46, 1, 5, '2025-01-20', '20:45:00', '2D', 100000),
(47, 1, 6, '2025-01-20', '22:00:00', '3D', 100000),
(48, 1, 7, '2025-01-20', '23:00:00', '3D', 100000),
(50, 4, 6, '2025-01-29', '09:00:00', '2D', 100000),
(52, 1, 10, '2025-03-25', '10:00:00', '2D', 100000),
(53, 1, 10, '2025-03-25', '14:00:00', '2D', 100000),
(54, 1, 10, '2025-03-25', '18:30:00', '2D', 120000),
(55, 2, 10, '2025-03-26', '12:00:00', '3D', 150000),
(56, 2, 10, '2025-03-26', '16:00:00', '3D', 150000),
(57, 2, 10, '2025-03-26', '20:30:00', 'IMA', 180000),
(58, 1, 10, '2025-04-01', '10:00:00', '2D', 100000),
(59, 1, 10, '2025-04-01', '14:00:00', '2D', 100000),
(60, 1, 10, '2025-04-01', '18:30:00', 'IMA', 180000),
(61, 2, 10, '2025-04-05', '12:00:00', '3D', 150000),
(62, 2, 10, '2025-04-05', '16:00:00', '3D', 150000),
(63, 2, 10, '2025-04-05', '20:30:00', '4DX', 200000),
(64, 3, 10, '2025-04-10', '09:30:00', '2D', 110000),
(65, 3, 10, '2025-04-10', '13:30:00', '2D', 110000),
(66, 3, 10, '2025-04-10', '17:30:00', '3D', 140000),
(67, 4, 10, '2025-04-15', '11:00:00', 'IMA', 180000),
(68, 4, 10, '2025-04-15', '15:00:00', 'IMA', 180000),
(69, 4, 10, '2025-04-15', '19:00:00', '4DX', 200000),
(70, 3, 11, '2025-03-27', '09:30:00', '2D', 110000),
(71, 3, 11, '2025-03-27', '13:30:00', '2D', 110000),
(72, 3, 11, '2025-03-27', '17:30:00', '3D', 140000),
(74, 4, 11, '2025-03-28', '15:00:00', 'IMA', 180000),
(75, 4, 11, '2025-03-28', '19:00:00', '4DX', 200000),
(76, 1, 11, '2025-04-02', '10:00:00', '2D', 100000),
(77, 1, 11, '2025-04-02', '14:00:00', '2D', 100000),
(78, 1, 11, '2025-04-02', '18:30:00', 'IMA', 180000),
(79, 2, 11, '2025-04-06', '12:00:00', '3D', 150000),
(80, 2, 11, '2025-04-06', '16:00:00', '3D', 150000),
(81, 2, 11, '2025-04-06', '20:30:00', '4DX', 200000),
(82, 3, 11, '2025-04-12', '09:30:00', '2D', 110000),
(83, 3, 11, '2025-04-12', '13:30:00', '2D', 110000),
(84, 3, 11, '2025-04-12', '17:30:00', '3D', 140000),
(85, 4, 11, '2025-04-18', '11:00:00', 'IMA', 180000),
(86, 4, 11, '2025-04-18', '15:00:00', 'IMA', 180000),
(87, 4, 11, '2025-04-18', '19:00:00', '4DX', 200000),
(89, 4, 11, '2025-04-01', '09:00:00', '2D', 9),
(90, 3, 11, '2025-04-01', '09:00:00', '2D', 8),
(91, 4, 11, '2025-04-01', '09:00:00', '2D', 9),
(92, 3, 88, '2025-04-01', '09:00:00', '2D', 10),
(93, 4, 89, '2025-04-01', '09:00:00', '2D', 9),
(94, 3, 88, '2025-04-01', '09:00:00', '2D', 10),
(95, 4, 89, '2025-04-01', '09:00:00', '2D', 9),
(96, 3, 88, '2025-04-01', '09:00:00', '2D', 111),
(103, 4, 11, '2025-04-05', '13:30:00', '3D', 10);

-- --------------------------------------------------------

--
-- Table structure for table `lichsugiaodich`
--

DROP TABLE IF EXISTS `lichsugiaodich`;
CREATE TABLE IF NOT EXISTS `lichsugiaodich` (
  `maGiaoDich` int NOT NULL AUTO_INCREMENT,
  `maKH` int NOT NULL,
  `loaiGiaoDich` varchar(50) NOT NULL,
  `ngayGiaoDich` datetime DEFAULT CURRENT_TIMESTAMP,
  `soTien` decimal(10,2) NOT NULL,
  PRIMARY KEY (`maGiaoDich`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaiphim`
--

DROP TABLE IF EXISTS `loaiphim`;
CREATE TABLE IF NOT EXISTS `loaiphim` (
  `maLoaiPhim` int NOT NULL AUTO_INCREMENT,
  `tenLoaiPhim` varchar(100) NOT NULL,
  `moTa` text,
  PRIMARY KEY (`maLoaiPhim`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loaiphim`
--

INSERT INTO `loaiphim` (`maLoaiPhim`, `tenLoaiPhim`, `moTa`) VALUES
(1, 'Hành động', 'Phim có yếu tố hành động, đấu tranh, phiêu lưu'),
(2, 'Hài hước', 'Phim hài hước, giải trí, mang tính chất cười nhiều hơn'),
(3, 'Kinh dị', 'Phim có yếu tố kinh dị, rùng rợn, gây sợ hãi'),
(4, 'Lãng mạn', 'Phim có yếu tố tình cảm, lãng mạn giữa các nhân vật'),
(5, 'Khoa học viễn tưởng', 'Phim thuộc thể loại khoa học viễn tưởng, không gian, công nghệ'),
(6, 'Tâm lý', 'Phim tập trung vào tâm lý nhân vật, nội tâm sâu sắc');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `maNV` int NOT NULL AUTO_INCREMENT,
  `hoTen` varchar(100) NOT NULL,
  `gioiTinh` enum('Nam','Nữ','Khác') NOT NULL,
  `diaChi` varchar(255) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `soDienThoai` varchar(15) DEFAULT NULL,
  `hinhAnh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`maNV`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`maNV`, `hoTen`, `gioiTinh`, `diaChi`, `ngaySinh`, `email`, `soDienThoai`, `hinhAnh`) VALUES
(1, 'Nguyen Van A', 'Nam', '123 Tran Hung Dao, HCM', '1990-01-15', 'nguyenvana@example.com', '0123456789', 'Uploads/AnhDaiDien/677a02f023dd0.png'),
(2, 'Tran Thi B', 'Nam', '456 Le Loi, HCM', '1985-06-20', 'tranthib@example.com', '0987654321', 'Uploads/AnhDaiDien/6785deac2c9b3.png'),
(3, 'Le Thi C', 'Nam', '789 Nguyen Trai, HCM', '1992-08-10', 'lethic@example.com', '0123456788', NULL),
(11, 'Nguyễn Minh Khang', 'Nam', 'kdc 32, xã Đức Phong', '2024-12-11', 'minhduc178a1@gmail.com', '0385203934', 'Nam'),
(14, 'Nguyễn Văn Đức', 'Nam', 'kdc 32, xã Đức Phong', '2024-12-19', 'minhduc171@gmail.com', '0352039347', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien_chucnang`
--

DROP TABLE IF EXISTS `nhanvien_chucnang`;
CREATE TABLE IF NOT EXISTS `nhanvien_chucnang` (
  `maNV` int NOT NULL,
  `maChucNang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhanvien_chucnang`
--

INSERT INTO `nhanvien_chucnang` (`maNV`, `maChucNang`) VALUES
(1, 1),
(2, 2),
(3, 3),
(10, 1),
(10, 2),
(9, 1),
(9, 3),
(9, 2),
(9, 5),
(9, 6),
(9, 4),
(9, 7),
(9, 8),
(9, 9),
(11, 7),
(11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien_nhomquanly`
--

DROP TABLE IF EXISTS `nhanvien_nhomquanly`;
CREATE TABLE IF NOT EXISTS `nhanvien_nhomquanly` (
  `maNV` int NOT NULL,
  `maNhom` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhanvien_nhomquanly`
--

INSERT INTO `nhanvien_nhomquanly` (`maNV`, `maNhom`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nhomquanly`
--

DROP TABLE IF EXISTS `nhomquanly`;
CREATE TABLE IF NOT EXISTS `nhomquanly` (
  `maNhom` int NOT NULL AUTO_INCREMENT,
  `tenNhom` varchar(100) NOT NULL,
  `moTa` text,
  PRIMARY KEY (`maNhom`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhomquanly`
--

INSERT INTO `nhomquanly` (`maNhom`, `tenNhom`, `moTa`) VALUES
(1, 'Admin', NULL),
(2, 'Marketing', NULL),
(3, 'Sales', NULL),
(4, 'IT Support', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nhomquanly_chucnang`
--

DROP TABLE IF EXISTS `nhomquanly_chucnang`;
CREATE TABLE IF NOT EXISTS `nhomquanly_chucnang` (
  `maNhom` int NOT NULL,
  `maChucNang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `maKH` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `maKH` (`maKH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phim`
--

DROP TABLE IF EXISTS `phim`;
CREATE TABLE IF NOT EXISTS `phim` (
  `maPhim` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `thoiLuong` int NOT NULL,
  `tenDaoDien` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `maQuocGia` int DEFAULT NULL,
  `moTa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci,
  `hinhAnh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `namSanXuat` year DEFAULT NULL,
  `ngayTao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `trangThai` enum('Đang chiếu','Sắp chiếu','Đã chiếu') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Đang chiếu',
  `soLuongSuatChieu` int DEFAULT '0',
  PRIMARY KEY (`maPhim`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `phim`
--

INSERT INTO `phim` (`maPhim`, `ten`, `thoiLuong`, `tenDaoDien`, `maQuocGia`, `moTa`, `hinhAnh`, `trailer`, `namSanXuat`, `ngayTao`, `trangThai`, `soLuongSuatChieu`) VALUES
(1, 'Công Tử Bạc Liêu', 113, 'Lý Minh Thắng', 1, 'Lấy cảm hứng từ giai thoại nổi tiếng của nhân vật được mệnh danh là thiên hạ đệ nhất chơi ngông, Công Tử Bạc Liêu là bộ phim tâm lý hài hước, lấy bối cảnh Nam Kỳ Lục Tỉnh xưa của Việt Nam. BA HƠN - Con trai được thương yêu hết mực của ông Hội đồng Lịnh vốn là chủ ngân hàng đầu tiên tại Việt Nam, sau khi du học Pháp về đã sử dụng cả gia sản của mình vào những trò vui tiêu khiển, ăn chơi trác tán – nên được người dân gọi bằng cái tên Công Tử Bạc Liêu.', '/Uploads/Thumbnail/67852f31d47da.jpg', 'https://www.youtube.com/embed/7oVbS8zQxQ0&t=2s', '2021', '2025-01-13 15:20:17', 'Đang chiếu', 2),
(3, 'Chị Dâu', 108, 'Khương Ngọc', 1, 'Chuyện bắt đầu khi bà Nhị - con dâu cả của gia đình quyết định nhân dịp đám giỗ của mẹ chồng, tụ họp cả bốn chị em gái - con ruột trong nhà lại để thông báo chuyện sẽ tự bỏ tiền túi ra sửa sang căn nhà từ đường cũ kỹ trước khi bão về. Vấn đề này khiến cho nội bộ gia đình bắt đầu có những lục đục, chị dâu và các em chồng cũng xảy ra mâu thuẫn, bất hoà. Dần dà những sự thật đằng sau việc \"bằng mặt mà không bằng lòng\" giữa các chị em cũng dần được hé lộ, những bí mật, nỗi đau sâu thẳm nhất trong mỗi cá nhân cũng dần được bóc tách. Liệu sợi dây liên kết vốn đã mong manh giữa các chị em có bị cắt đứt và liệu “căn nhà” vốn đã dột nát ấy có còn nguyên vẹn sau cơn bão lớn?', './Uploads/Thumbnail/67853183b2f1d.jpg', 'https://www.youtube.com/watch?v=XU4oplOtoQo', '2020', '2025-01-13 15:30:11', 'Đang chiếu', 0),
(5, 'MƯA TRÊN CÁNH BƯỚM', 104, 'Dương Diệu Linh', 1, 'MƯA TRÊN CÁNH BƯỚM xoay quanh câu chuyện của bà Tâm (Tú Oanh đóng) , một người phụ nữ trung niên làm công việc điều phối tiệc cưới tại Hà Nội. Một ngày, bà Tâm vô tình phát hiện chồng mình ngoại tình thông qua một trận bóng đá được phát trên sóng truyền hình. Bà quyết định tìm đến một thầy đồng tình cờ bắt gặp trên livestream với niềm tin có thể thay đổi được chồng mình. Thế nhưng, những nghi thức bí ẩn lại vô tình đánh thức một thế lực đen tối trong nhà mà chỉ mình bà Tâm và con gái có thể nhìn thấy.', './Uploads/Thumbnail/678532344a17c.png', '', '2020', '2025-01-13 15:33:08', 'Đang chiếu', 0),
(6, 'VÙNG ĐẤT LINH HỒN', 125, 'Hayao Miyazaki', 4, 'Phát hành tại Nhật Bản vào ngày 20 tháng 7 năm 2001 Ý tưởng, kịch bản và đạo diễn: Hayao Miyazaki Trên đường chuyển đến ngôi nhà mới, Chihiro và bố mẹ tình cờ đi qua một đường hầm bí ẩn. Ở phía bên kia đường hầm, họ tìm thấy một ngọn đồi rộng lớn dẫn lối đến một thị trấn kỳ lạ. Nhưng đây không phải là nơi con người nên đặt chân đến. Khi bố mẹ Chihiro ăn những món ăn không được phép ăn ở trên quầy, họ bị nguyền rủa và biến thành heo. Chỉ còn lại một mình, Chihiro buộc phải tuân theo hai điều kiện để sinh tồn trong thị trấn bí ẩn này: làm việc cho mụ phù thủy Yubaba và từ bỏ tên của mình. Mất tên cũng có nghĩa là mất liên kết với thế giới con người, nhưng Chihiro không từ bỏ hy vọng. Dưới cái tên Sen, cô bắt đầu làm việc tại một nhà tắm, nơi cô được Haku, Lin, Kamaji và những người khác giúp đỡ, từng bước đối mặt với những thử thách và lấy lại sức mạnh để tiếp tục sống.', './Uploads/Thumbnail/67853259b6d5e.jpg', 'https://www.youtube.com/embed/cMaCHa7RDfc', '2012', '2025-01-13 15:33:45', 'Đang chiếu', 1),
(7, 'Ngải Quỷ', 96, 'HYUN Moon-sub', 3, 'Một bác sĩ nghi ngờ rằng cái chết kỳ lạ của cô con gái vừa được cấy ghép tim là do buổi trừ tà quái dị gây ra, những âm thanh rên rỉ bên tai khiến người đàn ông tin rằng con gái của mình chưa hề chết. Sau 3 ngày khâm liệm, vị bác sĩ cùng cha xứ quyết tâm tìm ra uẩn khúc về con quỷ ẩn mình trong cơ thể cô bé và đưa cô trở về từ cõi chết.', './Uploads/Thumbnail/678532c8dc368.jpg', '', '2020', '2025-01-13 15:35:36', 'Đang chiếu', 0),
(9, 'OVERLORD: THÁNH QUỐC', 132, 'Naoyuki Ito', 4, 'Phim là câu chuyện về Thánh Quốc Roble, đứng đầu là Thánh Hậu Calca. Thánh Quốc đã trải qua một kỷ nguyên hòa bình với vùng đất được bảo vệ bởi một bức tường dài. Tuy nhiên, sự xuất hiện bất ngờ của Quỷ Hoàng Jaldabaoth và sự xâm lược của Liên minh Á nhân, hòa bình đã bị phá hủy. Remedios - thủ lĩnh hội Hiệp Sĩ Thánh Quốc Paladin của Vương quốc Thánh Roebel và nữ tư tế cấp cao Kelart, đã tập hợp lực lượng của họ để trả đũa, nhưng không thể vượt qua được sự chênh lệch quá lớn về sức mạnh của Jaldabaoth. Quốc gia của họ đang bên bờ vực sụp đổ. Remedios cùng hội của cô và cấp dưới Neia tìm kiếm sức mạnh từ một quốc gia nào đó để nhờ giúp đỡ chống lại Yaldabaoth. Nơi mà họ tìm sự trợ giúp lại là Vương quốc Phù thủy của Quỷ Vương Ainz Ooal Gown. Đây là một quốc gia kỳ dị do một xác sống cai trị và bị những người của Vương quốc Thánh khinh miệt.', './Uploads/Thumbnail/6785c0ba53ec6.png', 'https://www.youtube.com/embed/cMaCHa7RDfc', '2014', '2025-01-14 01:41:14', 'Sắp chiếu', 0),
(10, 'LOÀI MÈO TRẢ ƠN', 75, 'Hiroyuki Morita', 4, 'Phát hành tại Nhật Bản vào ngày 20 tháng 7 năm 2002 Phát triển bởi Hayao Miyazaki Dựa trên manga của Hiiragi Aoi Kịch bản: Yoshida Reiko Đạo diễn: Morita Hiroyuki Yoshioka Haru là một nữ sinh trung học bình thường, nhưng mọi thứ thay đổi hoàn toàn khi cô cứu một chú mèo khỏi bị xe tông. Chú mèo đó lại là Lune, hoàng tử của Vương quốc Mèo. Để cảm ơn cô, Vua Mèo quyết định mời Haru đến vương quốc của họ. Sau khi Haru nghe theo lời dẫn dắt của một giọng nói bí ẩn, cô đã gặp mèo mập Muta để tìm đến Văn phòng Mèo, nơi cô gặp Baron – quý ông mèo thanh lịch và bức tượng đá sống biết bay - Toto. Cuối cùng, Haru bị cuốn đến Vương quốc Mèo và suýt phải kết hôn với Lune theo kế hoạch của Vua Mèo. Nhưng với sự giúp đỡ của Baron và những người bạn, cô đã thoát khỏi âm mưu và tạo ra một trận náo loạn khó quên tại vương quốc này.', './Uploads/Thumbnail/6785c17231171.jpg', 'https://www.youtube.com/embed/WAAXs7QANo4', '2020', '2025-01-14 01:44:18', 'Đang chiếu', 0),
(11, 'QUỶ NHẬP TRÀNG', 112, 'Pom Nguyễn', 1, 'Lấy cảm hứng từ truyền thuyết kinh dị nhất về “người chết sống dậy”, Quỷ Nhập Tràng là câu chuyện được lấy bối cảnh tại một ngôi làng chuyên nghề mai táng, gắn liền với những hoạt động đào mộ, tẩm liệm và chôn cất người chết.', './Uploads/Thumbnail/6785c1fe26d85.jpg', 'https://www.youtube.com/embed/MAxdSC64BP0', '2023', '2025-01-14 01:46:38', 'Đang chiếu', 10),
(12, 'NGHỀ SIÊU KHÓ NÓI', 102, 'LEE Jong-suk', 3, 'Dan-bi vốn mơ ước trở thành một tác giả truyện thiếu nhi, nhưng trớ trêu thay, cô lại khởi đầu sự nghiệp tại Đội Bảo vệ Thanh thiếu niên, nơi chuyên kiểm duyệt nội dung khiêu dâm bất hợp pháp. Một ngày nọ, Dan-bi vô tình gây ra tai nạn và phải bồi thường một khoản tiền khổng lồ cho CEO Hwang – ông trùm trong ngành văn học mạng 18+. Từ đây, cô buộc phải ký thỏa thuận viết truyện người lớn để trả nợ. Vốn chưa từng viết truyện người lớn, Dan-bi gặp đủ tình huống dở khóc dở cười. Nhưng nhờ sự cổ vũ của đồng nghiệp Jung-seok - người đang vật lộn với chứng khó “lên”, và nhờ vốn sống phong phú từ hội bạn thân mê buôn chuyện giường chiếu, cô bỗng phát hiện ra tài năng sáng tác thiên phú mà chính mình cũng không ngờ tới…', './uploads/thumbnail/pRCZHdhmDsSiKVRAG6yhhHs9eqAyhow3D9trtLLx.webp', 'https://www.youtube.com/embed/1ueI7Lhplbo', '2025', '2025-03-25 03:39:05', 'Đang chiếu', 0),
(13, 'SÁT THỦ VÔ CÙNG CỰC HÀI', 107, 'Choi Won-sub', 3, 'Câu chuyện tiếp nối về cuộc đời làm hoạ sĩ webtoon Jun, người nổi tiếng trong thời gian ngắn với tư cách là tác giả của webtoon Đặc vụ ám sát Jun, nhanh chóng mang danh là \"nhà văn thiếu não\" sau khi Phần 2 bị chỉ trích thảm hại, nhưng mọi thứ thay đổi khi một cuộc tấn công khủng bố ngoài đời thực giống hệt với phần 2 anh vừa xuất bản, khiến Jun bị NIS buộc tội sai là kẻ chủ mưu đằng sau tội ác.', './uploads/thumbnail/CkEJWk3QCBSa7gxjSIy9xjHumTTB3cTLdPBHEnfv.webp', 'https://www.youtube.com/embed/DXNno1pNlyM', '2025', '2025-03-25 03:40:28', 'Đang chiếu', 2),
(14, 'GẤU YÊU CỦA ANH', 99, 'Ping Lumpraploeng', 9, 'San mơ ngày trở lại gây dựng sự nghiệp, ai ngờ lại \"trượt chân\" vào lưới tình với Momo. Dù bị ông cậu khó tính Sanan ra sức cấm cản, anh chàng vẫn quyết tâm giành lấy chân ái đời mình. Hành trình chinh phục tình yêu của San bỗng chốc trở thành một chuỗi tình huống oái oăm, dở khóc dở cười!', './uploads/thumbnail/gau-yeu-cua-anh.webp', 'https://www.youtube.com/embed/INCHfJtLmbU&t=2s', '2025', '2025-03-27 14:40:23', 'Sắp chiếu', 0),
(15, 'ĐÊM THÁNH: ĐỘI SĂN QUỶ', 99, 'Lim Dae-hee', 3, 'Tổ đội săn lùng và tiêu diệt các thế lực tôn thờ quỷ dữ với những sức mạnh siêu nhiên khác nhau gồm “tay đấm” Ma Dong-seok, Seohuyn (SNSD) và David Lee hứa hẹn mở ra cuộc chiến săn quỷ khốc liệt nhất dịp lễ 30/4 này!', './uploads/thumbnail/dem-thanh-doi-san-quy.webp', 'https://www.youtube.com/embed/INCHfJtLmbU&t=2s', '2025', '2025-03-27 14:41:25', 'Sắp chiếu', 0),
(16, 'BÍ KÍP LUYỆN RỒNG', 99, 'Dean DeBlois', 2, 'Câu chuyện về một chàng trai trẻ với ước mơ trở thành thợ săn rồng, nhưng định mệnh lại đưa đẩy anh đến tình bạn bất ngờ với một chú rồng.', './uploads/thumbnail/bi-kip-luyen-rong_1.webp', 'https://www.youtube.com/embed/JD-idNoeiPE', '2025', '2025-03-27 14:42:37', 'Sắp chiếu', 0),
(17, 'MỘT BỘ PHIM MINECRAFT', 99, 'Jared Hess', 5, 'Chào mừng bạn đến với thế giới của Minecraft, nơi sự sáng tạo không chỉ giúp bạn chế tạo mà còn là yếu tố quan trọng để sống sót! Bốn kẻ lạc lõng - Garrett \"The Garbage Man\" Garrison (Momoa), Henry (Hansen), Natalie (Myers) và Dawn (Brooks) - bất ngờ gặp rắc rối khi họ bị kéo qua cánh cửa bí ẩn dẫn đến Overworld: một thế giới kỳ lạ được tạo bởi những khối lập phương và phát triển nhờ vào trí tưởng tượng. Để trở về nhà, họ cần phải làm chủ được thế giới này (và bảo vệ nó khỏi những thực thể tà ác như Piglins và Thây Ma) trong khi dấn thân vào chuyến phiêu lưu màu nhiệm với một thợ chế tạo chuyên nghiệp và khó lường - Steve (Black). Chuyến hành trình này sẽ thách thức sự can đảm của cả năm người, thúc đẩy họ tìm lại với những phẩm chất làm nên sự đặc biệt của riêng mình,... đồng thời là những kỹ năng cần thiết để trở lại với thế giới thật.', './uploads/thumbnail/minecraft-poster.webp', 'https://www.youtube.com/embed/_k0Xu0KqgnQ', '2025', '2025-03-27 14:46:10', 'Sắp chiếu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phim_loaiphim`
--

DROP TABLE IF EXISTS `phim_loaiphim`;
CREATE TABLE IF NOT EXISTS `phim_loaiphim` (
  `maPhim` int NOT NULL,
  `maLoaiPhim` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phim_loaiphim`
--

INSERT INTO `phim_loaiphim` (`maPhim`, `maLoaiPhim`) VALUES
(5, 1),
(6, 1),
(3, 2),
(4, 2),
(9, 2),
(11, 2),
(5, 3),
(10, 3),
(5, 4),
(8, 4),
(6, 5),
(3, 6),
(4, 6),
(6, 6),
(7, 6),
(9, 6),
(11, 6),
(1, 2),
(1, 3),
(1, 1),
(1, 3),
(1, 4),
(1, 6),
(1, 6),
(1, 3),
(1, 3),
(1, 6),
(9, 1),
(9, 5),
(10, 4),
(10, 5),
(10, 6),
(11, 3),
(11, 4),
(12, 2),
(12, 6),
(13, 2),
(14, 2),
(15, 1),
(15, 3),
(16, 1),
(16, 2),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `phongchieuphim`
--

DROP TABLE IF EXISTS `phongchieuphim`;
CREATE TABLE IF NOT EXISTS `phongchieuphim` (
  `maPhongChieu` int NOT NULL AUTO_INCREMENT,
  `tenPhongChieu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `soLuongGhe` int NOT NULL,
  `trangThaiPhongChieu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'available',
  PRIMARY KEY (`maPhongChieu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `phongchieuphim`
--

INSERT INTO `phongchieuphim` (`maPhongChieu`, `tenPhongChieu`, `soLuongGhe`, `trangThaiPhongChieu`) VALUES
(1, 'Phòng chiếu 1', 100, 'available'),
(2, 'Phòng chiếu 2', 120, 'available'),
(3, 'Phòng chiếu 3', 130, 'available'),
(4, 'Phòng chiếu 4', 100, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `quocgia`
--

DROP TABLE IF EXISTS `quocgia`;
CREATE TABLE IF NOT EXISTS `quocgia` (
  `maQuocGia` int NOT NULL AUTO_INCREMENT,
  `tenQuocGia` varchar(100) NOT NULL,
  PRIMARY KEY (`maQuocGia`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quocgia`
--

INSERT INTO `quocgia` (`maQuocGia`, `tenQuocGia`) VALUES
(1, 'Việt Nam'),
(2, 'Mỹ'),
(3, 'Hàn Quốc'),
(4, 'Nhật Bản'),
(5, 'Anh'),
(6, 'Pháp'),
(7, 'Trung Quốc'),
(8, 'Ấn Độ'),
(9, 'Thái Lan'),
(10, 'Úc');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `maSanPham` int NOT NULL AUTO_INCREMENT,
  `tenSanPham` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `loaiSanPham` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `moTa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci,
  `trangThai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'Hoạt động',
  `hinhAnh` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`maSanPham`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`maSanPham`, `tenSanPham`, `loaiSanPham`, `gia`, `moTa`, `trangThai`, `hinhAnh`) VALUES
(1, 'COMBO SOLO', 'Combo', 94000.00, '1 Bắp Ngọt 60oz + 1 Coke 32oz', 'Hoạt động', './Uploads/Thumbnail/combo_solo.png'),
(2, 'COKE ZERO 32OZ', 'Nước Ngọt', 37000.00, '', 'Hoạt động', './Uploads/Thumbnail/coke-zero.png'),
(3, 'NƯỚC SUỐI DASANI', 'Nước Đóng Chai', 20000.00, '500/510ML', 'Hoạt động', './Uploads/Thumbnail/dasani.png'),
(4, 'SNACK THÁI', 'Snacks  Kẹo', 25000.00, '', 'Hoạt động', './Uploads/Thumbnail/snack-thai.png');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoankhachhang`
--

DROP TABLE IF EXISTS `taikhoankhachhang`;
CREATE TABLE IF NOT EXISTS `taikhoankhachhang` (
  `maTaiKhoan` int NOT NULL AUTO_INCREMENT,
  `tenDangNhap` varchar(50) NOT NULL,
  `matKhau` varchar(250) NOT NULL,
  `ngayTao` datetime DEFAULT CURRENT_TIMESTAMP,
  `trangThaiTaiKhoan` varchar(50) DEFAULT 'Hoạt động',
  `maKH` int NOT NULL,
  `diemTichLuy` int DEFAULT '0',
  PRIMARY KEY (`maTaiKhoan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taikhoankhachhang`
--

INSERT INTO `taikhoankhachhang` (`maTaiKhoan`, `tenDangNhap`, `matKhau`, `ngayTao`, `trangThaiTaiKhoan`, `maKH`, `diemTichLuy`) VALUES
(9, 'thuan', '$2y$10$1O1jcT0/HhTtXI6YRz4QcOVeDrOnmZI1xRY6qpP8gBJoSSgJ5E0uu', '2025-01-12 15:53:53', 'Hoạt động', 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoannhanvien`
--

DROP TABLE IF EXISTS `taikhoannhanvien`;
CREATE TABLE IF NOT EXISTS `taikhoannhanvien` (
  `maTaiKhoan` int NOT NULL AUTO_INCREMENT,
  `tenDangNhap` varchar(50) NOT NULL,
  `matKhau` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ngayTao` datetime DEFAULT CURRENT_TIMESTAMP,
  `trangThaiTaiKhoan` varchar(50) DEFAULT 'Hoạt động',
  `maNV` int NOT NULL,
  PRIMARY KEY (`maTaiKhoan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taikhoannhanvien`
--

INSERT INTO `taikhoannhanvien` (`maTaiKhoan`, `tenDangNhap`, `matKhau`, `ngayTao`, `trangThaiTaiKhoan`, `maNV`) VALUES
(1, 'admin', '$2y$10$3GuHsA3ykDm1k68aeNs48ueHYAa5vlgEWbAweX5xJYvYwbtoekv.S', '2024-12-24 00:23:29', 'Hoạt động', 1),
(2, 'marketing_user', 'marketing123', '2024-12-24 00:23:29', 'Hoạt động', 2),
(3, 'sales_user', 'sales123', '2024-12-24 00:23:29', 'Không hoạt động', 3),
(4, 'username123', '1223', '2024-12-24 00:40:48', 'Hoạt động', 11),
(5, '0352039347', '$2y$10$OJ63AIl1OvKKCQdcUmT1juZ2LGtgTe1Ykus0Y/0BGqB', '2024-12-24 09:57:42', 'Hoạt động', 14),
(6, '0372837722', '$2y$10$/uzTw88O8s8NwQG.27YkR.2zz6K4UJ5XlLNrVEFJ5aB', '2024-12-24 10:25:57', 'Không hoạt động', 16),
(7, '0392837722', '$2y$10$3JjqlxRzqctzrlzm5ZSEMe.wXiBTxmRZs/cJJmG6FgG', '2024-12-24 10:28:00', 'Hoạt động', 17),
(8, '032837722', '$2y$10$lok6pY7Ikp9oJWUA4S.Gf.R1ApU4FWkV5Sq0H7R1Qt/', '2024-12-24 10:30:19', 'Hoạt động', 18),
(9, '012333334', '$2y$10$CeIg0zHuVSrD7yNrby07TekTwIk.VcqiibuPLRurZmD', '2024-12-24 10:34:50', 'Hoạt động', 19),
(10, '0324723423', '$2y$10$cO1/4GLtL./NP3nDhJZ42uKnrW7C0p.8JT6kCpGA3x5', '2024-12-24 10:37:06', 'Hoạt động', 20),
(11, '0324723473', '$2y$10$Rn1MYvzftR1qkR.VDil66.VmVJqW.mP.ctJpTy0.f9f', '2024-12-24 16:23:05', 'Hoạt động', 21),
(12, '03247234773', '$2y$10$EArDKeLuZYsZXkv3v1cUZeRSTuIue.CVpYfNrfyjagj', '2024-12-24 16:24:06', 'Hoạt động', 22),
(13, '032417234773', '$2y$10$2fqRR8NxB850A2x4Xckgmeb.qqzgyA//Y.l7SbRN/lp', '2024-12-24 16:25:09', 'Hoạt động', 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `gender`, `address`, `phone`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Minh Đức', 'minhduc8a178@gmail.com', NULL, '$2y$10$VQcAurGOH83MZdp6qCU6TuBsyUuQWegURP33FARm5NrabzBEpmtFi', NULL, 'other', NULL, NULL, 0, 0, 'EeQpwoaXxFgeq6ikbYwvaK7BS0flEfmOjfrHHTbFPrleY6tSUlnZdXWUcfdz', '2025-03-21 10:30:13', '2025-03-22 21:22:46'),
(2, 'Nguyễn Minh Đức', 'minhduc178a1@gmail.com', NULL, '$2y$10$zfUfubuS1Hoj.6HRziMP5eD1xL674BELc8QuKXS92AK0nChaFqt/K', NULL, 'other', NULL, NULL, 0, 0, NULL, '2025-03-21 19:52:31', '2025-03-21 19:52:31'),
(3, 'Nguyễn Minh Đức', 'minhduc17a1@gmail.com', NULL, '$2y$10$cGdAJBJcL47MgaSWqBCdkuWSM5i7KrzB4.vmWdQD0qjYtmJCe0he6', NULL, 'other', NULL, NULL, 0, 0, NULL, '2025-03-21 20:02:10', '2025-03-21 20:02:10'),
(9, 'Nguyễn Minh Đức', '030238220039@st.buh.edu.vn', NULL, '$2y$10$OTbtj79xjHWJ.H9qgBVjzuUHELCwCopLYcVfc/YLYPZGx1OHJqSpC', '9.png', 'male', NULL, '0385203934', 1, 1, NULL, '2025-03-22 20:29:45', '2025-03-22 20:29:45'),
(10, 'Trịnh Trần Phương Tuấn', 'phuongtuan5cu@gmail.com', NULL, '$2y$10$S9TvkG5IMngxb7P2.XypMOJmiDwUaTYNmLtDvkeCgPyDtaMXsjzbe', '10.jpg', 'male', NULL, '0350000000', 1, 1, NULL, '2025-03-25 22:43:03', '2025-03-30 06:45:30'),
(11, 'Nguyễn Thanh Tùng', 'sontungmtp@gmail.com', NULL, '$2y$10$y5FjX1jbEpiiLMchdqpg0ef5dP5usufdagFK0U8wJsUBHf0NROeJu', '11.png', 'male', NULL, '0385193339', 1, 1, NULL, '2025-03-25 22:48:34', '2025-03-26 02:51:46'),
(12, 'Trần Minh Hiếu', 'hieuthuhai@gmail.com', NULL, '$2y$10$q2mmH70phQPtd/tJDEYZ/.gQHXKuyEfEWkt/wlmEUrx5wCZZhwnBK', '12.png', 'male', NULL, '0385203939', 1, 1, NULL, '2025-03-25 22:54:11', '2025-03-25 22:54:11'),
(13, 'Trần Đăng Dương', 'duongdomic@gmail.com', NULL, '$2y$10$dXiRGez5pBMsmWaKlKVQnO6BjB0CHrCCMyLn5wyTJC7.thYQwTkNe', '13.png', 'male', 'Thành phố Hồ Chí Minh', '0385203939', 1, 1, NULL, '2025-03-25 22:58:16', '2025-03-25 22:58:16'),
(14, 'Lê Dương Bảo Lâm', 'duonglam@gmail.com', NULL, '$2y$10$Jsny7RRF5bYFZTruujMduuMjSNaFC1BeztKY6TNKYhYtt/atFfbJ6', '14.jpg', 'male', 'Đồng Nai', '0385203930', 1, 1, NULL, '2025-03-25 23:04:05', '2025-03-25 23:04:05'),
(15, 'Phùng Thanh Độ', 'doly1989@gmail.com', NULL, '$2y$10$pZdCG/BvWocXOyh7BqTc5.jZObeYWIL618TMcC3oMXBJckt4AngQ6', '15.jpg', 'male', 'Cao Bằng', '0352039347', 1, 1, NULL, '2025-03-25 23:07:29', '2025-03-25 23:07:29'),
(16, 'Đặng Tiến Hoàng', 'viruss@gmail.com', NULL, '$2y$10$oUBwwc0EIrwDZl2nKaphE.s50.XDhLj8Q67WBTfLzSdGr1RgbCdwe', '16.png', 'male', 'Thành phố Hồ Chí Minh', '0372837224', 1, 1, NULL, '2025-03-25 23:11:23', '2025-03-30 06:44:52'),
(17, 'Trần Nguyễn Hồng Ngọc', 'ngockem@gmail.com', NULL, '$2y$10$mkaquTEm7SWRjxW4eEDg4eOvDor410fKsY0HUQk8bQlWCNfjXWiEO', '17.jpg', 'female', 'Bắc Ninh', '0385203944', 1, 1, NULL, '2025-03-25 23:16:22', '2025-03-25 23:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `vexemphim`
--

DROP TABLE IF EXISTS `vexemphim`;
CREATE TABLE IF NOT EXISTS `vexemphim` (
  `maVe` int NOT NULL AUTO_INCREMENT,
  `maKH` int DEFAULT NULL,
  `maLichChieuPhim` int NOT NULL,
  `maGhe` int NOT NULL,
  `giaVe` decimal(10,2) NOT NULL,
  `ngayDatVe` datetime DEFAULT CURRENT_TIMESTAMP,
  `trangThaiVe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'Chưa sử dụng',
  PRIMARY KEY (`maVe`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `vexemphim`
--

INSERT INTO `vexemphim` (`maVe`, `maKH`, `maLichChieuPhim`, `maGhe`, `giaVe`, `ngayDatVe`, `trangThaiVe`) VALUES
(10, 1, 5, 1, 100000.00, '2024-12-30 17:30:00', 'Chưa sử dụng'),
(11, 2, 5, 2, 150000.00, '2024-12-30 19:30:00', 'Chưa sử dụng'),
(12, 3, 5, 3, 100000.00, '2024-12-30 17:45:00', 'Chưa sử dụng');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`maKH`) REFERENCES `khachhang` (`maKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
