-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th3 21, 2022 lúc 12:45 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nongsansach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `MaAM` int(5) UNSIGNED NOT NULL,
  `EmailAM` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`MaAM`, `EmailAM`, `Password`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaCTDH` int(10) UNSIGNED NOT NULL,
  `MaDH` int(10) UNSIGNED DEFAULT NULL,
  `MaSP` int(10) UNSIGNED DEFAULT NULL,
  `SoLuong` double DEFAULT NULL,
  `GiaSP` double DEFAULT NULL,
  `ThanhTien` double NOT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `code_cart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaCTDH`, `MaDH`, `MaSP`, `SoLuong`, `GiaSP`, `ThanhTien`, `NgayTao`, `code_cart`) VALUES
(213, 212, 114, 1, 65555, 65555, '2022-03-21 01:09:47', 6578),
(214, 213, 114, 1, 65555, 465555, '2022-03-21 12:39:57', 7905),
(215, 213, 117, 2, 200000, 465555, '2022-03-21 12:39:57', 7905);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` int(10) UNSIGNED NOT NULL,
  `TenDM` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `HinhDD` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDM`, `HinhDD`) VALUES
(16, 'Thực vật1', 'cac-loai-trai-cay-nhap-khau.jpg'),
(19, 'Sữa1', 'category-2.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SDT` double DEFAULT NULL,
  `DiaChi` varchar(100) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL,
  `Payment` varchar(50) NOT NULL,
  `code_cart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDH`, `TenKH`, `SDT`, `DiaChi`, `TrangThai`, `Payment`, `code_cart`) VALUES
(212, 'hai', 987994431, 'An Giang, Huyện An Phú, Thị Trấn Long Bình', 1, 'paypal', 6578),
(213, 'hai', 987994431, 'An Giang, Huyện An Phú, Thị Trấn Long Bình', 1, 'paypal', 7905);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvitinh`
--

CREATE TABLE `donvitinh` (
  `MaDV` int(5) UNSIGNED NOT NULL,
  `TenDV` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donvitinh`
--

INSERT INTO `donvitinh` (`MaDV`, `TenDV`) VALUES
(1, 'Kg'),
(4, 'Nải'),
(10, 'Thực vật'),
(11, 'Hộp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(10) UNSIGNED NOT NULL,
  `TenKH` int(50) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `SDT` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `TrangThai` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(10) UNSIGNED NOT NULL,
  `TenSP` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `AnhSP` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `SoLuong` double DEFAULT NULL,
  `GiaSP` double DEFAULT NULL,
  `MoTa` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `MaDM` int(10) UNSIGNED NOT NULL,
  `MaDV` int(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `AnhSP`, `SoLuong`, `GiaSP`, `MoTa`, `MaDM`, `MaDV`) VALUES
(101, 'Chuối', 'product-1.png', 4, 200000, 'chuối', 16, 4),
(103, 'Cheri', 'product-5.png', 11, 65555, 'cheri', 16, 1),
(114, 'Thịt', 'cac-loai-trai-cay-nhap-khau.jpg', 8, 65555, 'aaa', 19, 1),
(117, 'Bơ thực vật', 'product-8.png', 98, 200000, 'Bơ thực vật', 16, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` int(10) UNSIGNED NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Pass` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `TenKH` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Avatar` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `TypeTK` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `SDT` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `TrangThai` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `GioiTinh` varchar(5) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `Email`, `Pass`, `TenKH`, `Avatar`, `TypeTK`, `NgaySinh`, `SDT`, `NgayTao`, `TrangThai`, `GioiTinh`) VALUES
(42, 'ngochai777890@gmail.com', 'be8a6e19c968ff48e71b4e19c7d5ac98', 'hai tran12', 'https://lh3.googleusercontent.com/a/AATXAJz398l6CB6Gs_lRGfI5nKufHd3vquWkg-XnSSIg=s96-c', 'Google', '2022-03-17', '09879944311', NULL, NULL, 'Nam'),
(43, 'Hai@gmail.com', 'be8a6e19c968ff48e71b4e19c7d5ac98', 'hai123', NULL, NULL, '2022-03-17', '0987994431', NULL, NULL, 'Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinnguoinhan`
--

CREATE TABLE `thongtinnguoinhan` (
  `MaNN` int(10) UNSIGNED NOT NULL,
  `TenNN` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SDTNN` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `SoNha` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `DiaChi` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `MaTK` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thongtinnguoinhan`
--

INSERT INTO `thongtinnguoinhan` (`MaNN`, `TenNN`, `SDTNN`, `SoNha`, `DiaChi`, `MaTK`) VALUES
(65, 'hai', '0987994431', '123 thanh khy', 'An Giang, Huyện An Phú, Thị Trấn Long Bình', 43);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuvienanh`
--

CREATE TABLE `thuvienanh` (
  `MaTV` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thuvienanh`
--

INSERT INTO `thuvienanh` (`MaTV`, `MaSP`, `path`) VALUES
(39, 101, 'product-1.2.png'),
(40, 101, 'product-1.3.png'),
(41, 101, 'product-1.4.png'),
(42, 101, 'product-1.png'),
(43, 103, 'product-2.png'),
(44, 103, 'product-3.png'),
(45, 115, 'product-4.png'),
(46, 115, 'product-5.png'),
(47, 115, 'product-6.png'),
(48, 116, 'banner-account.png'),
(49, 116, 'cac-loai-trai-cay-nhap-khau.jpg'),
(50, 117, 'product-7.png'),
(51, 117, 'product-9.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vnpay`
--

CREATE TABLE `vnpay` (
  `id_vnpay` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `bankcode` varchar(50) NOT NULL,
  `banktranno` varchar(50) NOT NULL,
  `cardtype` varchar(50) NOT NULL,
  `orderinfo` varchar(100) NOT NULL,
  `paydate` varchar(50) NOT NULL,
  `tmncode` varchar(50) NOT NULL,
  `transactionno` varchar(50) NOT NULL,
  `code_cart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MaAM`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaCTDH`),
  ADD KEY `chitietdonhang_ibfk_1` (`MaDH`),
  ADD KEY `chitietdonhang_ibfk_2` (`MaSP`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`);

--
-- Chỉ mục cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`MaDV`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaDM` (`MaDM`),
  ADD KEY `MaDV` (`MaDV`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`);

--
-- Chỉ mục cho bảng `thongtinnguoinhan`
--
ALTER TABLE `thongtinnguoinhan`
  ADD PRIMARY KEY (`MaNN`),
  ADD KEY `MaTK` (`MaTK`);

--
-- Chỉ mục cho bảng `thuvienanh`
--
ALTER TABLE `thuvienanh`
  ADD PRIMARY KEY (`MaTV`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`id_vnpay`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `MaAM` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `MaCTDH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  MODIFY `MaDV` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTK` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `thongtinnguoinhan`
--
ALTER TABLE `thongtinnguoinhan`
  MODIFY `MaNN` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `thuvienanh`
--
ALTER TABLE `thuvienanh`
  MODIFY `MaTV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `vnpay`
--
ALTER TABLE `vnpay`
  MODIFY `id_vnpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `MaDV` FOREIGN KEY (`MaDV`) REFERENCES `donvitinh` (`MaDV`),
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`);

--
-- Các ràng buộc cho bảng `thongtinnguoinhan`
--
ALTER TABLE `thongtinnguoinhan`
  ADD CONSTRAINT `thongtinnguoinhan_ibfk_1` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
