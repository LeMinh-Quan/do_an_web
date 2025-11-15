-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 15, 2025 lúc 10:44 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `my_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `TKadmin` varchar(20) NOT NULL,
  `PASS` varchar(255) DEFAULT NULL,
  `tenadmin` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`TKadmin`, `PASS`, `tenadmin`, `email`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 'QUAN', '0306241143@caothang.edu.vn'),
('admin2', '202cb962ac59075b964b07152d234b70', 'SANG', '0306241144@caothang.edu.vn'),
('admin3', '202cb962ac59075b964b07152d234b70', 'TAI', '0306241145@caothang.edu.vn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `MaCart` char(20) NOT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `ngaytao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`MaCart`, `userid`, `ngaytao`) VALUES
('CART1763178361', 'KH24859', '2025-11-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cpu`
--

CREATE TABLE `cpu` (
  `MaCPU` varchar(20) NOT NULL,
  `TenCPU` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cpu`
--

INSERT INTO `cpu` (`MaCPU`, `TenCPU`, `MoTa`) VALUES
('CPU01', 'Core i5-12500H', '12 nhân, hiệu năng gaming phổ thông'),
('CPU02', 'Ryzen 5 5625U', '6 nhân 12 luồng, tiết kiệm điện'),
('CPU03', 'Core i5-1335U', 'Thế hệ 13, hiệu năng văn phòng'),
('CPU04', 'Core i9-13900HX', 'Hiệu năng cực mạnh, gaming cao cấp'),
('CPU05', 'Core i7-1255U', 'Tiết kiệm điện, hiệu năng tốt'),
('CPU06', 'Apple M1', 'Chip Apple Silicon đầu tiên'),
('CPU07', 'Apple M2', 'Chip thế hệ thứ hai của Apple'),
('CPU08', 'Apple M3', 'Chip thế hệ thứ ba, hiệu năng vượt trội'),
('CPU09', 'Apple M3 Max', 'Chip M3 cao cấp nhất, cho hiệu suất cực cao'),
('CPU10', 'Ryzen 7 6800H', '8 nhân 16 luồng, gaming mượt mà'),
('CPU11', 'Ryzen 9 6900HS', 'Hiệu năng đồ họa cao, tản nhiệt tốt'),
('CPU12', 'Core i5-1240P', 'Cân bằng giữa hiệu năng và pin'),
('CPU13', 'Core i7-1360P', 'CPU thế hệ 13 tối ưu hiệu năng'),
('CPU14', 'Core i7-13700H', 'Đa nhân mạnh mẽ, gaming và đồ họa'),
('CPU15', 'Core i9-13900H', 'CPU cao cấp cho sáng tạo nội dung'),
('CPU16', 'Core i5-1335U', 'Phù hợp laptop mỏng nhẹ'),
('CPU17', 'Ryzen 5 7535HS', 'CPU mới, gaming nhẹ mượt'),
('CPU18', 'Core i7-1355U', 'Hiệu năng ổn định, pin lâu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_cart`
--

CREATE TABLE `ct_cart` (
  `MaCart` char(20) NOT NULL,
  `MaSP` char(10) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` > 0),
  `Gia` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_cart`
--

INSERT INTO `ct_cart` (`MaCart`, `MaSP`, `SoLuong`, `Gia`) VALUES
('CART1763178361', 'MS02', 1, 36990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_donhang`
--

CREATE TABLE `ct_donhang` (
  `MaDH` char(10) NOT NULL,
  `MaSP` char(10) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` > 0),
  `DonGia` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_donhang`
--

INSERT INTO `ct_donhang` (`MaDH`, `MaSP`, `SoLuong`, `DonGia`) VALUES
('DH4138', 'MS02', 1, 36990000),
('DH5352', 'MS02', 1, 36990000),
('DH8973', 'MS02', 1, 36990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `MaKH` varchar(20) NOT NULL,
  `DiaChiGiaoHang` enum('Nha','CongTy','Khac') DEFAULT 'Nha',
  `ChiTietDiaChi` varchar(255) NOT NULL,
  `ThanhPho` varchar(100) DEFAULT NULL,
  `QuanHuyen` varchar(100) DEFAULT NULL,
  `PhuongXa` varchar(100) DEFAULT NULL,
  `GhiChu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` char(10) NOT NULL,
  `MaKH` varchar(20) DEFAULT NULL,
  `NgayDat` date DEFAULT NULL,
  `TongTien` decimal(10,0) DEFAULT NULL,
  `TrangThai` enum('huy','Cho xac nhan','Dang Giao','Da Giao') DEFAULT 'Cho xac nhan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDH`, `MaKH`, `NgayDat`, `TongTien`, `TrangThai`) VALUES
('DH4138', 'KH24859', '2025-11-15', 36990000, 'Cho xac nhan'),
('DH5352', 'KH24859', '2025-11-15', 36990000, 'Cho xac nhan'),
('DH8973', 'KH24859', '2025-11-15', 36990000, 'Cho xac nhan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gpu`
--

CREATE TABLE `gpu` (
  `MaGPU` varchar(20) NOT NULL,
  `TenGPU` varchar(100) NOT NULL,
  `LoaiGPU` varchar(50) DEFAULT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gpu`
--

INSERT INTO `gpu` (`MaGPU`, `TenGPU`, `LoaiGPU`, `MoTa`) VALUES
('GPU01', 'RTX 3050', 'Rời', 'Gaming phổ thông'),
('GPU02', 'RTX 3060', 'Rời', 'Gaming mạnh'),
('GPU03', 'RTX 4070', 'Rời', 'Cao cấp, hỗ trợ Ray Tracing'),
('GPU04', 'RTX 4080', 'Rời', 'Đồ họa cực mạnh'),
('GPU05', 'GTX 1650', 'Rời', 'Phổ thông, chơi game nhẹ'),
('GPU06', 'Iris Xe', 'Tích hợp', 'Phù hợp học tập, văn phòng'),
('GPU07', 'Apple GPU 7 nhân', 'Tích hợp', 'Chip M1'),
('GPU08', 'Apple GPU 10 nhân', 'Tích hợp', 'Chip M2'),
('GPU09', 'Apple GPU 40 nhân', 'Tích hợp', 'Chip M3 Max');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hedieuhanh`
--

CREATE TABLE `hedieuhanh` (
  `MaHDH` varchar(20) NOT NULL,
  `TenHDH` varchar(100) NOT NULL,
  `PhienBan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hedieuhanh`
--

INSERT INTO `hedieuhanh` (`MaHDH`, `TenHDH`, `PhienBan`) VALUES
('HDH01', 'Windows 11', 'Home'),
('HDH02', 'Windows 11', 'Pro'),
('HDH03', 'macOS Sonoma', '14'),
('HDH04', 'macOS Sequoia', '15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manhinh`
--

CREATE TABLE `manhinh` (
  `MaMH` varchar(20) NOT NULL,
  `KichThuoc` varchar(50) DEFAULT NULL,
  `DoPhanGiai` varchar(50) DEFAULT NULL,
  `TanSo` varchar(50) DEFAULT NULL,
  `CongNghe` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manhinh`
--

INSERT INTO `manhinh` (`MaMH`, `KichThuoc`, `DoPhanGiai`, `TanSo`, `CongNghe`) VALUES
('MH01', '13.3 inch', 'Retina', '60Hz', 'IPS'),
('MH02', '14 inch', 'FHD', '60Hz', 'IPS'),
('MH03', '15.6 inch', 'FHD', '144Hz', 'IPS'),
('MH04', '15.6 inch', 'QHD', '165Hz', 'IPS'),
('MH05', '16 inch', 'QHD+', '240Hz', 'IPS'),
('MH06', '16 inch', 'Liquid Retina XDR', '120Hz', 'Mini LED'),
('MH07', '14 inch', 'OLED 2.8K', '60Hz', 'OLED'),
('MH08', '13.6 inch', 'Retina', '60Hz', 'IPS'),
('MH09', '15.6 inch', 'FHD 165Hz', '165Hz', 'IPS');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mausac`
--

CREATE TABLE `mausac` (
  `MaMau` varchar(20) NOT NULL,
  `TenMau` varchar(50) NOT NULL,
  `MaHex` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mausac`
--

INSERT INTO `mausac` (`MaMau`, `TenMau`, `MaHex`) VALUES
('M01', 'Đen', '#000000'),
('M02', 'Xám', '#808080'),
('M03', 'Bạc', '#C0C0C0'),
('M04', 'Trắng', '#FFFFFF'),
('M05', 'Xanh', '#0047AB'),
('M06', 'Vàng', '#FFD700');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mota`
--

CREATE TABLE `mota` (
  `MaSP` char(10) NOT NULL,
  `CPU` varchar(20) DEFAULT NULL,
  `RAM` varchar(20) DEFAULT NULL,
  `ROM` varchar(20) DEFAULT NULL,
  `GPU` varchar(20) DEFAULT NULL,
  `ManHinh` varchar(20) DEFAULT NULL,
  `HeDieuHanh` varchar(20) DEFAULT NULL,
  `MauSac` varchar(20) DEFAULT NULL,
  `ChiTiet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mota`
--

INSERT INTO `mota` (`MaSP`, `CPU`, `RAM`, `ROM`, `GPU`, `ManHinh`, `HeDieuHanh`, `MauSac`, `ChiTiet`) VALUES
('AC01', 'CPU01', 'RAM02', 'ROM02', 'GPU01', 'MH03', 'HDH01', 'M01', 'Gaming phổ thông, tản nhiệt tốt'),
('AC02', 'CPU02', 'RAM02', 'ROM02', 'GPU05', 'MH03', 'HDH01', 'M02', 'Hiệu năng ổn, phù hợp sinh viên'),
('AC03', 'CPU03', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH01', 'M03', 'Nhẹ, pin lâu'),
('AC04', 'CPU04', 'RAM03', 'ROM03', 'GPU04', 'MH05', 'HDH01', 'M01', 'Gaming cao cấp, đồ họa mạnh'),
('AC05', 'CPU05', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH01', 'M03', 'Xoay gập 360 độ, cảm ứng'),
('AP01', 'CPU06', 'RAM01', 'ROM01', 'GPU07', 'MH01', 'HDH03', 'M03', 'Ổn định, tiết kiệm pin'),
('AP02', 'CPU07', 'RAM02', 'ROM02', 'GPU08', 'MH08', 'HDH03', 'M02', 'Hiệu năng cao, sang trọng'),
('AP03', 'CPU07', 'RAM02', 'ROM02', 'GPU08', 'MH08', 'HDH03', 'M06', 'Thiết kế mỏng nhẹ'),
('AP04', 'CPU08', 'RAM02', 'ROM03', 'GPU08', 'MH06', 'HDH04', 'M02', 'Cấu hình mạnh mẽ'),
('AP05', 'CPU09', 'RAM03', 'ROM03', 'GPU09', 'MH06', 'HDH04', 'M03', 'Hiệu năng đỉnh nhất cho sáng tạo'),
('AS01', 'CPU10', 'RAM02', 'ROM02', 'GPU02', 'MH09', 'HDH01', 'M01', 'Gaming hiệu năng cao, thiết kế bền'),
('AS02', 'CPU11', 'RAM03', 'ROM03', 'GPU03', 'MH04', 'HDH02', 'M02', 'Siêu mỏng, mạnh mẽ, phù hợp designer'),
('AS03', 'CPU12', 'RAM01', 'ROM01', 'GPU06', 'MH02', 'HDH01', 'M03', 'Học tập, văn phòng mượt mà'),
('AS04', 'CPU13', 'RAM02', 'ROM02', 'GPU06', 'MH07', 'HDH02', 'M04', 'Màn hình OLED, hiển thị xuất sắc'),
('AS05', 'CPU14', 'RAM03', 'ROM02', 'GPU02', 'MH04', 'HDH02', 'M05', 'Doanh nhân cao cấp, pin trâu'),
('DL01', 'CPU02', 'RAM01', 'ROM01', 'GPU06', 'MH02', 'HDH01', 'M03', 'Phù hợp sinh viên, giá tốt'),
('DL02', 'CPU14', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH02', 'M02', 'Siêu mỏng, cao cấp, hiệu năng ổn định'),
('DL03', 'CPU15', 'RAM03', 'ROM03', 'GPU03', 'MH05', 'HDH02', 'M01', 'Gaming mạnh, tản nhiệt tối ưu'),
('DL04', 'CPU03', 'RAM01', 'ROM01', 'GPU06', 'MH02', 'HDH01', 'M04', 'Laptop doanh nghiệp nhỏ gọn'),
('DL05', 'CPU13', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH02', 'M02', 'Thiết kế doanh nhân, bền bỉ'),
('HP01', 'CPU03', 'RAM01', 'ROM01', 'GPU06', 'MH02', 'HDH01', 'M03', 'Văn phòng, học tập mượt mà'),
('HP02', 'CPU15', 'RAM03', 'ROM03', 'GPU03', 'MH05', 'HDH02', 'M01', 'Gaming cao cấp, tản nhiệt tốt'),
('HP03', 'CPU01', 'RAM02', 'ROM02', 'GPU01', 'MH03', 'HDH01', 'M02', 'Giá tốt, gaming ổn định'),
('HP04', 'CPU05', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH01', 'M04', 'Thiết kế mỏng nhẹ, cao cấp'),
('HP05', 'CPU13', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH02', 'M05', 'Thiết kế sang, pin khỏe'),
('LN01', 'CPU02', 'RAM01', 'ROM01', 'GPU06', 'MH02', 'HDH01', 'M03', 'Giá rẻ, phù hợp sinh viên'),
('LN02', 'CPU10', 'RAM02', 'ROM02', 'GPU02', 'MH03', 'HDH01', 'M01', 'Gaming mát, bền bỉ'),
('LN03', 'CPU05', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH01', 'M03', 'Xoay gập linh hoạt, cảm ứng'),
('LN04', 'CPU13', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH02', 'M02', 'Laptop doanh nhân, độ bền cao'),
('LN05', 'CPU05', 'RAM03', 'ROM03', 'GPU04', 'MH03', 'HDH01', 'M03', 'Lenovo LOQ 15IRH8 i5-13420H, 16GB RAM, 512GB SSD, RTX 4050, 15.6\" 144Hz, Win 11, xám.'),
('MS01', 'CPU01', 'RAM02', 'ROM02', 'GPU01', 'MH03', 'HDH01', 'M01', 'Gaming mỏng nhẹ, tản nhiệt ổn'),
('MS02', 'CPU14', 'RAM03', 'ROM03', 'GPU02', 'MH05', 'HDH02', 'M02', 'Gaming mạnh mẽ, thiết kế ngầu'),
('MS03', 'CPU15', 'RAM03', 'ROM03', 'GPU03', 'MH05', 'HDH02', 'M03', 'Gaming cao cấp, sáng tạo nội dung'),
('MS04', 'CPU15', 'RAM03', 'ROM03', 'GPU04', 'MH05', 'HDH02', 'M04', 'Máy sáng tạo chuyên nghiệp'),
('MS05', 'CPU13', 'RAM02', 'ROM02', 'GPU06', 'MH02', 'HDH01', 'M02', 'Văn phòng, học tập ổn định');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ram`
--

CREATE TABLE `ram` (
  `MaRAM` varchar(20) NOT NULL,
  `DungLuong` varchar(50) NOT NULL,
  `LoaiRAM` varchar(50) DEFAULT NULL,
  `TocDo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ram`
--

INSERT INTO `ram` (`MaRAM`, `DungLuong`, `LoaiRAM`, `TocDo`) VALUES
('RAM01', '8GB', 'DDR4', '3200MHz'),
('RAM02', '16GB', 'DDR4', '3200MHz'),
('RAM03', '32GB', 'DDR5', '4800MHz');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rom`
--

CREATE TABLE `rom` (
  `MaROM` varchar(20) NOT NULL,
  `DungLuong` varchar(50) NOT NULL,
  `LoaiROM` varchar(50) DEFAULT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rom`
--

INSERT INTO `rom` (`MaROM`, `DungLuong`, `LoaiROM`, `MoTa`) VALUES
('ROM01', '256GB', 'SSD NVMe', 'Phù hợp học tập, văn phòng'),
('ROM02', '512GB', 'SSD NVMe', 'Tốc độ cao, dung lượng phổ biến'),
('ROM03', '1TB', 'SSD NVMe', 'Gaming, đồ họa chuyên nghiệp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` char(10) NOT NULL,
  `TenSP` varchar(255) DEFAULT NULL,
  `Loai` varchar(20) DEFAULT NULL,
  `ThuongHieu` varchar(100) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL,
  `GiaBan` decimal(10,0) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` > 0),
  `STT` int(11) NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `Loai`, `ThuongHieu`, `MoTa`, `GiaBan`, `SoLuong`, `STT`) VALUES
('AC01', 'Acer Nitro 5', 'Laptop', 'ACER', '0', 23090000, 15, 1),
('AC02', 'Acer Aspire 7', 'Laptop', 'ACER', 'Học tập và chơi game nhẹ', 17990000, 13, 2),
('AC03', 'Acer Swift 3', 'Laptop', 'ACER', 'Mỏng nhẹ, pin trâu', 19990000, 15, 3),
('AC04', 'Acer Predator Helios 16', 'Laptop', 'ACER', 'Gaming cao cấp', 38990000, 8, 4),
('AC05', 'Acer Spin 5', 'Laptop', 'ACER', 'Cảm ứng xoay gập', 28990000, 6, 5),
('AP01', 'MacBook Air M1', 'Laptop', 'APPLE', 'Hiệu năng cao, pin lâu', 24990000, 8, 6),
('AP02', 'MacBook Pro M2', 'Laptop', 'APPLE', 'Hiệu năng cao', 36990000, 6, 7),
('AP03', 'MacBook Air M2', 'Laptop', 'APPLE', 'Thiết kế mỏng nhẹ', 29990000, 15, 8),
('AP04', 'MacBook Pro 16 M3', 'Laptop', 'APPLE', 'Cấu hình cực mạnh', 48990000, 3, 9),
('AP05', 'MacBook Pro 16 M3 Max', 'Laptop', 'APPLE', 'Cao cấp nhất', 64990000, 2, 10),
('AS01', 'ASUS TUF Gaming A15', 'Laptop', 'ASUS', 'Laptop gaming hiệu năng cao', 23990000, 10, 11),
('AS02', 'ASUS ROG Zephyrus G14', 'Laptop', 'ASUS', 'Mỏng gọn, mạnh mẽ', 32990000, 5, 12),
('AS03', 'ASUS Vivobook 15', 'Laptop', 'ASUS', 'Phù hợp sinh viên, văn phòng', 15990000, 15, 13),
('AS04', 'ASUS Zenbook OLED', 'Laptop', 'ASUS', 'Mỏng nhẹ, sang trọng', 26990000, 9, 14),
('AS05', 'ASUS ExpertBook B5', 'Laptop', 'ASUS', 'Doanh nhân cao cấp', 28990000, 7, 15),
('DL01', 'Dell Inspiron 15', 'Laptop', 'DELL', 'Phổ thông', 18990000, 14, 16),
('DL02', 'Dell XPS 13', 'Laptop', 'DELL', 'Thiết kế thời thượng, cao cấp', 37990000, 6, 17),
('DL03', 'Dell G15 Gaming', 'Laptop', 'DELL', 'Gaming mạnh mẽ', 28990000, 11, 18),
('DL04', 'Dell Vostro 14', 'Laptop', 'DELL', 'Văn phòng, doanh nghiệp nhỏ', 17990000, 9, 19),
('DL05', 'Dell Latitude 7430', 'Laptop', 'DELL', 'Doanh nhân', 31990000, 4, 20),
('HP01', 'HP Pavilion 14', 'Laptop', 'HP', 'Phù hợp sinh viên', 17990000, 14, 21),
('HP02', 'HP Omen 16', 'Laptop', 'HP', 'Gaming mạnh mẽ', 37990000, 5, 22),
('HP03', 'HP Victus 15', 'Laptop', 'HP', 'Laptop gaming giá tốt', 22990000, 10, 23),
('HP04', 'HP Envy 13', 'Laptop', 'HP', 'Thiết kế thời trang', 26990000, 8, 24),
('HP05', 'HP Envy 14', 'Laptop', 'HP', 'Thiết kế thời trang', 28990000, 6, 25),
('LN01', 'Lenovo IdeaPad 3', 'Laptop', 'LENOVO', 'Giá rẻ, phổ thông', 13990000, 15, 26),
('LN02', 'Lenovo Legion 5', 'Laptop', 'LENOVO', 'Mạnh mẽ, mát mẻ', 28990000, 8, 27),
('LN03', 'Lenovo Yoga 7i', 'Laptop', 'LENOVO', 'Xoay gập linh hoạt', 27990000, 5, 28),
('LN04', 'Lenovo ThinkPad E14', 'Laptop', 'LENOVO', 'Doanh nhân bền bỉ', 26990000, 9, 29),
('LN05', 'Lenovo LOQ Gaming 15IRH8', 'Laptop', 'LENOVO', 'Laptop gaming hiệu năng cao với RTX 4050', 25990000, 10, 30),
('MS01', 'MSI GF63', 'Laptop', 'MSI', 'Gaming mỏng nhẹ', 19990000, 12, 31),
('MS02', 'MSI Katana 15', 'Laptop', 'MSI', 'Cảm hứng game thủ', 36990000, 7, 32),
('MS03', 'MSI Stealth 16', 'Laptop', 'MSI', 'Gaming cao cấp', 45990000, 4, 33),
('MS04', 'MSI Creator Z16', 'Laptop', 'MSI', 'Dành cho sáng tạo', 51990000, 3, 34),
('MS05', 'MSI Modern 14', 'Laptop', 'MSI', 'Văn phòng, học tập', 15990000, 10, 35);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `MaTT` char(10) NOT NULL,
  `MaDH` char(10) DEFAULT NULL,
  `PhuongThuc` enum('Chuyen khoan','Tien mat') DEFAULT 'Tien mat',
  `Ngayvagio` datetime DEFAULT NULL,
  `TrangThai` enum('Chua Thanh Toan','Da Thanh Toan') DEFAULT 'Chua Thanh Toan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhtoan`
--

INSERT INTO `thanhtoan` (`MaTT`, `MaDH`, `PhuongThuc`, `Ngayvagio`, `TrangThai`) VALUES
('TT1854', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT1937', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT2243', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT3304', 'DH4138', '', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT4139', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT426', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT5464', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT6906', 'DH4138', 'Tien mat', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT8084', 'DH4138', 'Tien mat', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT8416', 'DH4138', 'Tien mat', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT8998', 'DH4138', '', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT9958', 'DH4138', 'Tien mat', '2025-11-15 05:41:52', 'Chua Thanh Toan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `maKH` varchar(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`maKH`, `username`, `email`, `pass`) VALUES
('KH24859', 'q', 'abc@gmail.com', '202cb962ac59075b964b07152d234b70'),
('KH29820', 'n', 'abf@gmail.com', '202cb962ac59075b964b07152d234b70'),
('KH74616', 'quan', 'leminhquan9a7@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`TKadmin`),
  ADD UNIQUE KEY `u_ad` (`email`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`MaCart`),
  ADD KEY `fk_c_u` (`userid`);

--
-- Chỉ mục cho bảng `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`MaCPU`);

--
-- Chỉ mục cho bảng `ct_cart`
--
ALTER TABLE `ct_cart`
  ADD PRIMARY KEY (`MaCart`,`MaSP`),
  ADD KEY `fk_ct_sp` (`MaSP`);

--
-- Chỉ mục cho bảng `ct_donhang`
--
ALTER TABLE `ct_donhang`
  ADD PRIMARY KEY (`MaDH`,`MaSP`),
  ADD KEY `fk_ctdh_sp` (`MaSP`);

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `fk_dh_kh` (`MaKH`);

--
-- Chỉ mục cho bảng `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`MaGPU`);

--
-- Chỉ mục cho bảng `hedieuhanh`
--
ALTER TABLE `hedieuhanh`
  ADD PRIMARY KEY (`MaHDH`);

--
-- Chỉ mục cho bảng `manhinh`
--
ALTER TABLE `manhinh`
  ADD PRIMARY KEY (`MaMH`);

--
-- Chỉ mục cho bảng `mausac`
--
ALTER TABLE `mausac`
  ADD PRIMARY KEY (`MaMau`);

--
-- Chỉ mục cho bảng `mota`
--
ALTER TABLE `mota`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `fk_cpu` (`CPU`),
  ADD KEY `fk_ram` (`RAM`),
  ADD KEY `fk_rom` (`ROM`),
  ADD KEY `fk_gpu` (`GPU`),
  ADD KEY `fk_mh` (`ManHinh`),
  ADD KEY `fk_hdh` (`HeDieuHanh`),
  ADD KEY `fk_mau` (`MauSac`);

--
-- Chỉ mục cho bảng `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`MaRAM`);

--
-- Chỉ mục cho bảng `rom`
--
ALTER TABLE `rom`
  ADD PRIMARY KEY (`MaROM`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`MaTT`),
  ADD KEY `fk_tt_dh` (`MaDH`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`maKH`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_c_u` FOREIGN KEY (`userid`) REFERENCES `users` (`maKH`);

--
-- Các ràng buộc cho bảng `ct_cart`
--
ALTER TABLE `ct_cart`
  ADD CONSTRAINT `fk_ct_c` FOREIGN KEY (`MaCart`) REFERENCES `cart` (`MaCart`),
  ADD CONSTRAINT `fk_ct_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `ct_donhang`
--
ALTER TABLE `ct_donhang`
  ADD CONSTRAINT `fk_ct_hd` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`),
  ADD CONSTRAINT `fk_ctdh_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `fk_dc` FOREIGN KEY (`MaKH`) REFERENCES `users` (`maKH`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_dh_kh` FOREIGN KEY (`MaKH`) REFERENCES `users` (`maKH`);

--
-- Các ràng buộc cho bảng `mota`
--
ALTER TABLE `mota`
  ADD CONSTRAINT `fk_cpu` FOREIGN KEY (`CPU`) REFERENCES `cpu` (`MaCPU`),
  ADD CONSTRAINT `fk_gpu` FOREIGN KEY (`GPU`) REFERENCES `gpu` (`MaGPU`),
  ADD CONSTRAINT `fk_hdh` FOREIGN KEY (`HeDieuHanh`) REFERENCES `hedieuhanh` (`MaHDH`),
  ADD CONSTRAINT `fk_mau` FOREIGN KEY (`MauSac`) REFERENCES `mausac` (`MaMau`),
  ADD CONSTRAINT `fk_mh` FOREIGN KEY (`ManHinh`) REFERENCES `manhinh` (`MaMH`),
  ADD CONSTRAINT `fk_mt` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `fk_ram` FOREIGN KEY (`RAM`) REFERENCES `ram` (`MaRAM`),
  ADD CONSTRAINT `fk_rom` FOREIGN KEY (`ROM`) REFERENCES `rom` (`MaROM`);

--
-- Các ràng buộc cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `fk_tt_dh` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
