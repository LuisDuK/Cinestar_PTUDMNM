-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 10.123.0.163:3306
-- Generation Time: Jan 14, 2025 at 03:34 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.26

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
-- Table structure for table `chitietdonhangonline`
--

CREATE TABLE `chitietdonhangonline` (
  `maDonHang` int  NOT NULL,
  `maSanPham` int NOT NULL,
  `soLuong` int NOT NULL,
  `giaBan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chucnang`
--

CREATE TABLE `chucnang` (
  `maChucNang` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenChucNang` varchar(100) NOT NULL,
  `moTa` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chucnang`
--

INSERT INTO `chucnang` (`maChucNang`, `tenChucNang`, `moTa`) VALUES
(1, 'Quản lý phim', 'Quản lý thông tin phim, danh sách phim, sửa thông tin phim'),
(2, 'Quản lý rạp chiếu', 'Quản lý thông tin rạp chiếu, phòng chiếu, số ghế, trạng thái rạp chiếu'),
(3, 'Quản lý lịch chiếu phim', 'Thiết lập lịch chiếu phim, ngày giờ chiếu, rạp chiếu'),
(4, 'Quản lý vé xem phim', 'Xem danh sách vé, kiểm tra trạng thái vé, sửa thông tin vé'),
(5, 'Quản lý khách hàng', 'Quản lý thông tin khách hàng, danh sách khách hàng, điểm tích lũy khách hàng'),
(6, 'Quản lý tài khoản nhân viên', 'Quản lý tài khoản đăng nhập của nhân viên, quyền hạn, vai trò'),
(7, 'Quản lý nhóm quản lý', 'Tạo, chỉnh sửa, xóa nhóm quản lý, phân quyền nhóm quản lý'),
(8, 'Quản lý khuyến mãi', 'Thiết lập khuyến mãi, mã giảm giá, thời gian áp dụng, quản lý trạng thái khuyến mãi'),
(9, 'Quản lý hóa đơn', 'Quản lý hóa đơn, lịch sử giao dịch, xem chi tiết giao dịch, hoàn tiền'),
(10, 'Quản lý sản phẩm', 'Quản lý các sản phẩm như bắp, nước, combo, giá cả, tình trạng sản phẩm');

-- --------------------------------------------------------

--
-- Table structure for table `donhangonline`
--

CREATE TABLE `donhangonline` (
  `maDonHang` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `maKH` int DEFAULT NULL,
  `ngayDat` datetime DEFAULT CURRENT_TIMESTAMP,
  `tongTien` decimal(10,2) NOT NULL,
  `trangThai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'Chờ thanh toán',
  `phuongThucThanhToan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `donhangonline`
--

INSERT INTO `donhangonline` (`maDonHang`, `maKH`, `ngayDat`, `tongTien`, `trangThai`, `phuongThucThanhToan`) VALUES
(1, 1, '2024-12-30 21:19:02', 50000.00, 'Đã thanh toán', 'Momo'),
(2, 2, '2024-12-30 21:19:02', 300000.00, 'Chờ thanh toán', 'ZaloPay'),
(3, 3, '2024-12-30 21:19:02', 120000.00, 'Đã hủy', 'Thẻ tín dụng');

-- --------------------------------------------------------

--
-- Table structure for table `donhang_veonline`
--

CREATE TABLE `donhang_veonline` (
  `maDonHang` int NOT NULL,
  `maVe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ghe`
--

CREATE TABLE `ghe` (
  `maGhe` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `maPhongChieu` int NOT NULL,
  `soGhe` varchar(10) NOT NULL,
  `trangThai` varchar(50) DEFAULT 'Trống'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ghe`
--

INSERT INTO `ghe` (`maGhe`, `maPhongChieu`, `soGhe`, `trangThai`) VALUES
(1, 1, 'A1', 'Trống'),
(2, 1, 'A2', 'Trống'),
(3, 1, 'A3', 'Trống'),
(4, 1, 'A4', 'Trống'),
(5, 1, 'A5', 'Trống'),
(6, 1, 'A6', 'Trống'),
(7, 1, 'A7', 'Trống'),
(8, 1, 'A8', 'Trống'),
(9, 1, 'A9', 'Trống'),
(10, 1, 'A10', 'Trống'),
(11, 2, 'B1', 'Trống'),
(12, 2, 'B2', 'Trống'),
(13, 2, 'B3', 'Trống'),
(14, 2, 'B4', 'Trống'),
(15, 2, 'B5', 'Trống'),
(16, 2, 'B6', 'Trống'),
(17, 2, 'B7', 'Trống'),
(18, 2, 'B8', 'Trống'),
(19, 2, 'B9', 'Trống'),
(20, 2, 'B10', 'Trống');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `maKH` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `hoTen` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `soDienThoai` varchar(15) NOT NULL,
  `ngaySinh` date DEFAULT NULL,
  `gioiTinh` varchar(10) DEFAULT NULL,
  `ngayTao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `hoTen`, `email`, `soDienThoai`, `ngaySinh`, `gioiTinh`, `ngayTao`) VALUES
(1, 'Nguyen Van A', 'nguyenvana@example.com', '0123456789', '1990-01-01', 'Nam', '2024-12-30 21:15:24'),
(2, 'Tran Thi B', 'tranthib@example.com', '0123456790', '1992-02-02', 'Nu', '2024-12-30 21:15:24'),
(3, 'Le Van C', 'levanc@example.com', '0123456780', '1995-03-03', 'Nam', '2024-12-30 21:15:24'),
(12, 'Đàm Quang Thuận', 'thuanq@gmail.com', '0303030303', '2004-12-08', 'Nam', '2025-01-12 15:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `maKhuyenMai` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenKhuyenMai` varchar(100) NOT NULL,
  `moTa` text,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `giaTriKhuyenMai` decimal(10,2) NOT NULL,
  `loaiKhuyenMai` varchar(20) DEFAULT NULL,
  `trangThai` varchar(50) DEFAULT 'Hoạt động',
  `maNhanVien` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lichchieuphim`
--

CREATE TABLE `lichchieuphim` (
  `maLichChieuPhim` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `maPhongChieuPhim` int NOT NULL,
  `maPhim` int NOT NULL,
  `ngayChieu` date NOT NULL,
  `gioBatDau` time NOT NULL,
  `thoiLuong` int NOT NULL,
  `loaiHinhChieu` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lichsugiaodich`
--

CREATE TABLE `lichsugiaodich` (
  `maGiaoDich` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `maKH` int NOT NULL,
  `loaiGiaoDich` varchar(50) NOT NULL,
  `ngayGiaoDich` datetime DEFAULT CURRENT_TIMESTAMP,
  `soTien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaiphim`
--

CREATE TABLE `loaiphim` (
  `maLoaiPhim` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenLoaiPhim` varchar(100) NOT NULL,
  `moTa` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNV` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `hoTen` varchar(100) NOT NULL,
  `gioiTinh` enum('Nam','Nữ','Khác') NOT NULL,
  `diaChi` varchar(255) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `soDienThoai` varchar(15) DEFAULT NULL,
  `hinhAnh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`maNV`, `hoTen`, `gioiTinh`, `diaChi`, `ngaySinh`, `email`, `soDienThoai`, `hinhAnh`) VALUES
(1, 'Nguyen Van A', 'Nam', '123 Tran Hung Dao, HCM', '1990-01-15', 'nguyenvana@example.com', '0123456789', 'Uploads/AnhDaiDien/677a02f023dd0.png'),
(2, 'Tran Thi B', 'Nam', '456 Le Loi, HCM', '1985-06-20', 'tranthib@example.com', '0987654321', NULL),
(3, 'Le Thi C', 'Nam', '789 Nguyen Trai, HCM', '1992-08-10', 'lethic@example.com', '0123456788', NULL),
(11, 'Nguyễn Văn Đức', 'Nam', 'kdc 32, xã Đức Phong', '2024-12-11', 'minhduc178a1@gmail.com', '0385203934', NULL),
(14, 'Nguyễn Văn Đức', 'Nam', 'kdc 32, xã Đức Phong', '2024-12-19', 'minhduc171@gmail.com', '0352039347', NULL),
(0, 'Nguyễn Minh Đức', 'Nam', 'Đức phong', '2025-01-11', 'minhduc@gmail.com', '017820004', './Uploads/AnhDaiDien/6785d9482b519.png');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien_chucnang`
--

CREATE TABLE `nhanvien_chucnang` (
  `maNV` int NOT NULL,
  `maChucNang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhanvien_chucnang`
--

INSERT INTO `nhanvien_chucnang` (`maNV`, `maChucNang`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien_nhomquanly`
--

CREATE TABLE `nhanvien_nhomquanly` (
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

CREATE TABLE `nhomquanly` (
  `maNhom` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenNhom` varchar(100) NOT NULL,
  `moTa` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

CREATE TABLE `nhomquanly_chucnang` (
  `maNhom` int NOT NULL,
  `maChucNang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phim`
--

CREATE TABLE `phim` (
  `maPhim` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
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
  `soLuongSuatChieu` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `phim`
--

INSERT INTO `phim` (`maPhim`, `ten`, `thoiLuong`, `tenDaoDien`, `maQuocGia`, `moTa`, `hinhAnh`, `trailer`, `namSanXuat`, `ngayTao`, `trangThai`, `soLuongSuatChieu`) VALUES
(1, 'Công Tử Bạc Liêu', 113, 'Lý Minh Thắng', 1, 'Lấy cảm hứng từ giai thoại nổi tiếng của nhân vật được mệnh danh là thiên hạ đệ nhất chơi ngông, Công Tử Bạc Liêu là bộ phim tâm lý hài hước, lấy bối cảnh Nam Kỳ Lục Tỉnh xưa của Việt Nam. BA HƠN - Con trai được thương yêu hết mực của ông Hội đồng Lịnh vốn là chủ ngân hàng đầu tiên tại Việt Nam, sau khi du học Pháp về đã sử dụng cả gia sản của mình vào những trò vui tiêu khiển, ăn chơi trác tán – nên được người dân gọi bằng cái tên Công Tử Bạc Liêu.', '/Uploads/Thumbnail/67852f31d47da.jpg', 'https://www.youtube.com/embed/7oVbS8zQxQ0&t=2s', '2021', '2025-01-13 15:20:17', 'Đang chiếu', 0),
(3, 'Chị Dâu', 104, 'Khương Ngọc', 1, 'Chuyện bắt đầu khi bà Nhị - con dâu cả của gia đình quyết định nhân dịp đám giỗ của mẹ chồng, tụ họp cả bốn chị em gái - con ruột trong nhà lại để thông báo chuyện sẽ tự bỏ tiền túi ra sửa sang căn nhà từ đường cũ kỹ trước khi bão về. Vấn đề này khiến cho nội bộ gia đình bắt đầu có những lục đục, chị dâu và các em chồng cũng xảy ra mâu thuẫn, bất hoà. Dần dà những sự thật đằng sau việc \"bằng mặt mà không bằng lòng\" giữa các chị em cũng dần được hé lộ, những bí mật, nỗi đau sâu thẳm nhất trong mỗi cá nhân cũng dần được bóc tách. Liệu sợi dây liên kết vốn đã mong manh giữa các chị em có bị cắt đứt và liệu “căn nhà” vốn đã dột nát ấy có còn nguyên vẹn sau cơn bão lớn?', './Uploads/Thumbnail/67853183b2f1d.jpg', '', '2020', '2025-01-13 15:30:11', 'Đang chiếu', 0),
(4, 'QUỶ MÔN QUAN: PHONG ẤN', 100, 'Joe Chien', 9, 'Gắn liền với nhiều lời đồn kinh hoàng, những vụ tự sát và chết người bí ẩn, toà nhà Hồ Điệp trở thành địa điểm gây ám ảnh nhất tại thành phố Đài Bắc. Phức tạp là vậy, nhưng nơi này vẫn thu hút nhiều người lao động tới sinh sống vì giá thuê rẻ mạt, trong đó có Trần Vi - người phụ nữ khốn khổ đang phải tìm nơi ẩn nấp cho mình và con gái khỏi người chồng bạo lực. Câu chuyện về cánh cửa phòng 613 bị niêm phong, hành động kì lạ của cô con gái Nhã Nhã khi liên tục nói chuyện một mình với những bức tường, cùng lời cảnh báo “hãy rời đi càng sớm càng tốt” của quản lý tòa nhà và người trông coi đền thờ khiến Trần Vi ngày càng sợ hãi. Những sự kiện kinh hoàng liên tiếp ập đến kéo theo hàng loạt bí mật đáng sợ dần lộ tẩy, liệu cô có thể bảo vệ được con gái của mình và chiến thắng các linh hồn oán hận đang cuồng nộ?', './Uploads/Thumbnail/6785321785dcd.png', '', '2021', '2025-01-13 15:32:39', 'Đang chiếu', 0),
(5, 'MƯA TRÊN CÁNH BƯỚM', 104, 'Dương Diệu Linh', 1, 'MƯA TRÊN CÁNH BƯỚM xoay quanh câu chuyện của bà Tâm (Tú Oanh đóng) , một người phụ nữ trung niên làm công việc điều phối tiệc cưới tại Hà Nội. Một ngày, bà Tâm vô tình phát hiện chồng mình ngoại tình thông qua một trận bóng đá được phát trên sóng truyền hình. Bà quyết định tìm đến một thầy đồng tình cờ bắt gặp trên livestream với niềm tin có thể thay đổi được chồng mình. Thế nhưng, những nghi thức bí ẩn lại vô tình đánh thức một thế lực đen tối trong nhà mà chỉ mình bà Tâm và con gái có thể nhìn thấy.', './Uploads/Thumbnail/678532344a17c.png', '', '2020', '2025-01-13 15:33:08', 'Đang chiếu', 0),
(6, 'VÙNG ĐẤT LINH HỒN', 125, 'Hayao Miyazaki', 4, 'Phát hành tại Nhật Bản vào ngày 20 tháng 7 năm 2001 Ý tưởng, kịch bản và đạo diễn: Hayao Miyazaki Trên đường chuyển đến ngôi nhà mới, Chihiro và bố mẹ tình cờ đi qua một đường hầm bí ẩn. Ở phía bên kia đường hầm, họ tìm thấy một ngọn đồi rộng lớn dẫn lối đến một thị trấn kỳ lạ. Nhưng đây không phải là nơi con người nên đặt chân đến. Khi bố mẹ Chihiro ăn những món ăn không được phép ăn ở trên quầy, họ bị nguyền rủa và biến thành heo. Chỉ còn lại một mình, Chihiro buộc phải tuân theo hai điều kiện để sinh tồn trong thị trấn bí ẩn này: làm việc cho mụ phù thủy Yubaba và từ bỏ tên của mình. Mất tên cũng có nghĩa là mất liên kết với thế giới con người, nhưng Chihiro không từ bỏ hy vọng. Dưới cái tên Sen, cô bắt đầu làm việc tại một nhà tắm, nơi cô được Haku, Lin, Kamaji và những người khác giúp đỡ, từng bước đối mặt với những thử thách và lấy lại sức mạnh để tiếp tục sống.', './Uploads/Thumbnail/67853259b6d5e.jpg', 'https://www.youtube.com/embed/cMaCHa7RDfc', '2012', '2025-01-13 15:33:45', 'Đang chiếu', 0),
(7, 'Ngải Quỷ', 96, 'HYUN Moon-sub', 3, 'Một bác sĩ nghi ngờ rằng cái chết kỳ lạ của cô con gái vừa được cấy ghép tim là do buổi trừ tà quái dị gây ra, những âm thanh rên rỉ bên tai khiến người đàn ông tin rằng con gái của mình chưa hề chết. Sau 3 ngày khâm liệm, vị bác sĩ cùng cha xứ quyết tâm tìm ra uẩn khúc về con quỷ ẩn mình trong cơ thể cô bé và đưa cô trở về từ cõi chết.', './Uploads/Thumbnail/678532c8dc368.jpg', '', '2020', '2025-01-13 15:35:36', 'Đang chiếu', 0),
(9, 'OVERLORD: THÁNH QUỐC', 132, 'Naoyuki Ito', 4, 'Phim là câu chuyện về Thánh Quốc Roble, đứng đầu là Thánh Hậu Calca. Thánh Quốc đã trải qua một kỷ nguyên hòa bình với vùng đất được bảo vệ bởi một bức tường dài. Tuy nhiên, sự xuất hiện bất ngờ của Quỷ Hoàng Jaldabaoth và sự xâm lược của Liên minh Á nhân, hòa bình đã bị phá hủy. Remedios - thủ lĩnh hội Hiệp Sĩ Thánh Quốc Paladin của Vương quốc Thánh Roebel và nữ tư tế cấp cao Kelart, đã tập hợp lực lượng của họ để trả đũa, nhưng không thể vượt qua được sự chênh lệch quá lớn về sức mạnh của Jaldabaoth. Quốc gia của họ đang bên bờ vực sụp đổ. Remedios cùng hội của cô và cấp dưới Neia tìm kiếm sức mạnh từ một quốc gia nào đó để nhờ giúp đỡ chống lại Yaldabaoth. Nơi mà họ tìm sự trợ giúp lại là Vương quốc Phù thủy của Quỷ Vương Ainz Ooal Gown. Đây là một quốc gia kỳ dị do một xác sống cai trị và bị những người của Vương quốc Thánh khinh miệt.', './Uploads/Thumbnail/6785c0ba53ec6.png', 'https://www.youtube.com/embed/cMaCHa7RDfc', '2014', '2025-01-14 01:41:14', 'Sắp chiếu', 0),
(10, 'LOÀI MÈO TRẢ ƠN', 75, 'Hiroyuki Morita', 4, 'Phát hành tại Nhật Bản vào ngày 20 tháng 7 năm 2002 Phát triển bởi Hayao Miyazaki Dựa trên manga của Hiiragi Aoi Kịch bản: Yoshida Reiko Đạo diễn: Morita Hiroyuki Yoshioka Haru là một nữ sinh trung học bình thường, nhưng mọi thứ thay đổi hoàn toàn khi cô cứu một chú mèo khỏi bị xe tông. Chú mèo đó lại là Lune, hoàng tử của Vương quốc Mèo. Để cảm ơn cô, Vua Mèo quyết định mời Haru đến vương quốc của họ. Sau khi Haru nghe theo lời dẫn dắt của một giọng nói bí ẩn, cô đã gặp mèo mập Muta để tìm đến Văn phòng Mèo, nơi cô gặp Baron – quý ông mèo thanh lịch và bức tượng đá sống biết bay - Toto. Cuối cùng, Haru bị cuốn đến Vương quốc Mèo và suýt phải kết hôn với Lune theo kế hoạch của Vua Mèo. Nhưng với sự giúp đỡ của Baron và những người bạn, cô đã thoát khỏi âm mưu và tạo ra một trận náo loạn khó quên tại vương quốc này.', './Uploads/Thumbnail/6785c17231171.jpg', 'https://www.youtube.com/embed/WAAXs7QANo4', '2020', '2025-01-14 01:44:18', 'Sắp chiếu', 0),
(11, 'QUỶ NHẬP TRÀNG', 112, 'Pom Nguyễn', 1, 'Lấy cảm hứng từ truyền thuyết kinh dị nhất về “người chết sống dậy”, Quỷ Nhập Tràng là câu chuyện được lấy bối cảnh tại một ngôi làng chuyên nghề mai táng, gắn liền với những hoạt động đào mộ, tẩm liệm và chôn cất người chết.', './Uploads/Thumbnail/6785c1fe26d85.jpg', 'https://www.youtube.com/embed/MAxdSC64BP0', '2023', '2025-01-14 01:46:38', 'Sắp chiếu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phim_loaiphim`
--

CREATE TABLE `phim_loaiphim` (
  `maPhim` int  NOT NULL,
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
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `phongchieuphim`
--

CREATE TABLE `phongchieuphim` (
  `maPhongChieu` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenPhongChieu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `soLuongGhe` int NOT NULL,
  `trangThaiPhongChieu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `phongchieuphim`
--

INSERT INTO `phongchieuphim` (`maPhongChieu`, `tenPhongChieu`, `soLuongGhe`, `trangThaiPhongChieu`) VALUES
(1, 'Phòng chiếu 1', 100, 'available'),
(2, 'Phòng chiếu 2', 150, 'maintenance'),
(3, 'Phòng chiếu 3', 120, 'available'),
(4, 'Phòng chiếu 4', 200, 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `quocgia`
--

CREATE TABLE `quocgia` (
  `maQuocGia` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenQuocGia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

CREATE TABLE `sanpham` (
  `maSanPham` int AUTO_INCREMENT PRIMARY KEY,
  `tenSanPham` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `loaiSanPham` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `moTa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci,
  `trangThai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'Hoạt động',
  `hinhAnh` varchar(50) COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`maSanPham`, `tenSanPham`, `loaiSanPham`, `gia`, `moTa`, `trangThai`, `hinhAnh`) VALUES
(1, 'COMBO SOLO', 'Combo', 94000.00, '1 Bắp Ngọt 60oz + 1 Coke 32oz', 'Hoạt động', './Uploads/Thumbnail/combo_solo.png'),
(2, 'COKE ZERO 32OZ', 'Nước Ngọt', 37000.00, '', 'Hoạt động', './Uploads/Thumbnail/coke-zero.png'),
(3, 'NƯỚC SUỐI DASANI', 'Nước Đóng Chai', 20000.00, '500/510ML', 'Hoạt động', './Uploads/Thumbnail/dasani.png'),
(4, 'SNACK THÁI', 'Snacks - Kẹo', 25000.00, '', 'Hoạt động', './Uploads/Thumbnail/snack_thai.png');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoankhachhang`
--

CREATE TABLE `taikhoankhachhang` (
  `maTaiKhoan` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tenDangNhap` varchar(50) NOT NULL,
  `matKhau` varchar(250) NOT NULL,
  `ngayTao` datetime DEFAULT CURRENT_TIMESTAMP,
  `trangThaiTaiKhoan` varchar(50) DEFAULT 'Hoạt động',
  `maKH` int NOT NULL,
  `diemTichLuy` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taikhoankhachhang`
--

INSERT INTO `taikhoankhachhang` (`maTaiKhoan`, `tenDangNhap`, `matKhau`, `ngayTao`, `trangThaiTaiKhoan`, `maKH`, `diemTichLuy`) VALUES
(9, 'thuan', '$2y$10$1O1jcT0/HhTtXI6YRz4QcOVeDrOnmZI1xRY6qpP8gBJoSSgJ5E0uu', '2025-01-12 15:53:53', 'Hoạt động', 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoannhanvien`
--

CREATE TABLE `taikhoannhanvien` (
  `maTaiKhoan` int AUTO_INCREMENT PRIMARY KEY,
  `tenDangNhap` varchar(50) NOT NULL,
  `matKhau` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ngayTao` datetime DEFAULT CURRENT_TIMESTAMP,
  `trangThaiTaiKhoan` varchar(50) DEFAULT 'Hoạt động',
  `maNV` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taikhoannhanvien`
--

INSERT INTO `taikhoannhanvien` (`maTaiKhoan`, `tenDangNhap`, `matKhau`, `ngayTao`, `trangThaiTaiKhoan`, `maNV`) VALUES
(1, 'admin', '$2y$10$.lyka81dKjx2eZ9tfxsueeNag75qr05VMQcMuAYgwIZgtQRzcXkQ.', '2024-12-24 00:23:29', 'Hoạt động', 1),
(2, 'marketing_user', 'marketing123', '2024-12-24 00:23:29', 'Không hoạt động', 2),
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
-- Table structure for table `vexemphim`
--

CREATE TABLE `vexemphim` (
  `maVe` int AUTO_INCREMENT PRIMARY KEY,
  `maKH` int DEFAULT NULL,
  `maLichChieuPhim` int NOT NULL,
  `maGhe` int NOT NULL,
  `giaVe` decimal(10,2) NOT NULL,
  `ngayDatVe` datetime DEFAULT CURRENT_TIMESTAMP,
  `trangThaiVe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT 'Chưa sử dụng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;

--
-- Dumping data for table `vexemphim`
--

INSERT INTO `vexemphim` (`maVe`, `maKH`, `maLichChieuPhim`, `maGhe`, `giaVe`, `ngayDatVe`, `trangThaiVe`) VALUES
(10, 1, 5, 1, 100000.00, '2024-12-30 17:30:00', 'Chưa sử dụng'),
(11, 2, 5, 2, 150000.00, '2024-12-30 19:30:00', 'Chưa sử dụng'),
(12, 3, 5, 3, 100000.00, '2024-12-30 17:45:00', 'Chưa sử dụng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhangonline`
--
ALTER TABLE `chitietdonhangonline`
  ADD PRIMARY KEY (`maDonHang`,`maSanPham`),
  ADD KEY `maSanPham` (`maSanPham`);

--
-- Indexes for table `chucnang`
--

--
-- Indexes for table `donhangonline`
--
ALTER TABLE `donhangonline`
  ADD PRIMARY KEY (`maDonHang`),
  ADD KEY `maKH` (`maKH`);

--
-- Indexes for table `donhang_veonline`
--
ALTER TABLE `donhang_veonline`
  ADD PRIMARY KEY (`maDonHang`,`maVe`),
  ADD KEY `maVe` (`maVe`);

--
-- Indexes for table `ghe`
--
ALTER TABLE `ghe`
  ADD PRIMARY KEY (`maGhe`),
  ADD KEY `maPhongChieu` (`maPhongChieu`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`maKH`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `soDienThoai` (`soDienThoai`);

--
-- Indexes for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`maKhuyenMai`),
  ADD KEY `maNhanVien` (`maNhanVien`);

--
-- Indexes for table `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`maPhim`);

--
-- Indexes for table `taikhoankhachhang`
--
ALTER TABLE `taikhoankhachhang`
  ADD PRIMARY KEY (`maTaiKhoan`),
  ADD UNIQUE KEY `tenDangNhap` (`tenDangNhap`),
  ADD KEY `maKH` (`maKH`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `phim`
--
ALTER TABLE `phim`
  MODIFY `maPhim` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `taikhoankhachhang`
--
ALTER TABLE `taikhoankhachhang`
  MODIFY `maTaiKhoan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
