-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2023 lúc 01:28 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `yamedb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authenticationusr`
--

CREATE TABLE `authenticationusr` (
  `Authentication` varchar(20) NOT NULL,
  `AuthenticationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `authenticationusr`
--

INSERT INTO `authenticationusr` (`Authentication`, `AuthenticationName`) VALUES
('Admin', 'Sửa quyền user'),
('Invoice', 'Quản lý hóa đơn'),
('Store', 'Quản lý kho hàng'),
('Usr', 'User thường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceID` int(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `UsrName` varchar(255) NOT NULL,
  `PhoneNo` varchar(12) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `SubTotal` int(10) NOT NULL,
  `Ship` int(6) NOT NULL,
  `Total` int(10) NOT NULL,
  `DateInvoice` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`InvoiceID`, `Email`, `UsrName`, `PhoneNo`, `Address`, `SubTotal`, `Ship`, `Total`, `DateInvoice`) VALUES
(10, 'minhkhachhang@gmail.com', 'Minh Minh', '0793000000', 'Âu cơ, Tân Phú, Thành phố Hồ Chí Minh', 1050000, 50000, 1100000, '2023-05-23 16:53:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `InvoiceID` int(10) NOT NULL,
  `ProductID` int(5) NOT NULL,
  `Quantities` int(2) NOT NULL,
  `Price` int(10) NOT NULL,
  `SubTotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoicedetails`
--

INSERT INTO `invoicedetails` (`InvoiceID`, `ProductID`, `Quantities`, `Price`, `SubTotal`) VALUES
(9, 29, 1, 80000, 80000),
(10, 33, 1, 1050000, 1050000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ProductID` int(5) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductTypeID` int(3) NOT NULL,
  `UnitPrice` int(10) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Size` varchar(20) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `imgsrc` varchar(50) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductTypeID`, `UnitPrice`, `Quantity`, `Size`, `Description`, `imgsrc`, `Date`) VALUES
(30, 'Sữa Rửa Mặt Đất Sét Kiehls Rare Earth Deep Pore Daily Cleanser', 15, 900000, 10, '', '', 'SP30.jpg', '2023-05-22 11:17:46'),
(31, 'Gel Rửa Mặt Cho Nam Kiehls Facial Fuel Energizing Face Wash', 14, 800000, 5, '', '', 'SP31.jpg', '2023-05-22 11:18:45'),
(32, 'Sữa rửa mặt SHISEIDO MEN Face Cleanser', 14, 650000, 10, '', '', 'SP32.jpg', '2023-05-22 15:16:33'),
(33, 'Sữa rửa mặt SHISEIDO Extra Rich Cleansing Milk', 15, 1050000, 10, '', '', 'SP33.jpg', '2023-05-22 15:18:00'),
(34, 'Sữa Rửa Mặt Kiehls Oil Eliminator Deep Cleansing Exfoliating Face Wash For Men', 14, 750000, 10, '', '', 'SP34.jpg', '2023-05-22 15:24:29'),
(35, 'Sữa Rửa Mặt Kiehls Clearly Corrective™ Brightening & Exfoliating Cleanser', 15, 1050000, 10, '', '', 'SP35.jpg', '2023-05-22 15:25:50'),
(36, 'Kem Cạo Râu Ultimate Brushless Shave Cream - White', 17, 700000, 8, '', '', 'SP36.jpg', '2023-05-23 17:13:31'),
(37, 'Kem Cạo Râu Ultimate Brushless Shave Cream - Blue ', 17, 700000, 10, '', '', 'SP37.jpg', '2023-05-23 17:14:00'),
(41, 'Serum Kiehls Clearly Corrective Dark Spot Solution Giúp Mờ Thâm Mụn & Đều Màu', 16, 1750000, 10, '', '', 'SP41.jpg', '2023-05-23 17:55:27'),
(42, 'Serum Thảo Dược Kiehls Vital Skin-Strengthening Super Serum', 16, 1750000, 10, '', '', 'SP42.jpg', '2023-05-23 17:56:08'),
(43, 'Serum Kiehls Retinol Micro-Dose Tinh Chất Tái Tạo Da', 16, 1750000, 10, '', '', 'SP43.jpg', '2023-05-23 17:56:34'),
(44, 'Serum Vitamin C đậm đặc Kiehls Powerful-Strength Line-Reducing Concentrate', 16, 2250000, 10, '', '', 'SP44.jpg', '2023-05-23 17:57:15'),
(45, 'ESTÉE LAUDER Perfectionist Pro Rapid Brightening Treatment with Ferment3 + Vitamin C', 16, 3870000, 10, '', '', 'SP45.jpg', '2023-05-23 18:05:24'),
(46, 'ESTÉE LAUDER Advanced Night Repair Synchronized Multi-Recovery Complex', 16, 4600000, 10, '', '', 'SP46.jpg', '2023-05-23 18:09:22'),
(47, 'Tinh chất trị mụn The Ordinary Salicylic Acid 2% Solution (BHA)', 16, 320000, 10, '', '', 'SP47.jpg', '2023-05-23 18:12:08'),
(48, 'Serum tẩy tế bào chết, cải thiện mụn The Ordinary AHA 30% BHA 2% Peeling Solution', 16, 390000, 10, '', '', 'SP48.jpg', '2023-05-23 18:13:08'),
(49, 'Tinh chất tẩy tế bào chết & cấp nước The Ordinary Lactic Acid + HA', 16, 400000, 10, '', '', 'SP49.jpg', '2023-05-23 18:13:47'),
(50, 'Tinh chất dưỡng da ULTIMUNE Power Infusing Concentrate', 16, 3000000, 10, '', '', 'SP50.jpg', '2023-05-23 18:15:53'),
(51, 'Tinh chất dưỡng da Future Solution LX Intensive Firming Contour Serum', 16, 6900000, 10, '', '', 'SP51.jpg', '2023-05-23 18:16:30'),
(52, 'Tinh chất dưỡng da Legendary Enmei Ultimate Luminance Serum', 16, 12500000, 10, '', '', 'SP52.jpg', '2023-05-23 18:17:04'),
(53, 'Tinh chất vùng mắt Benefiance NutriPerfect Eye Serum', 18, 1250000, 10, '', '', 'SP53.jpg', '2023-05-23 18:19:13'),
(54, 'Kem Dưỡng Mắt Kiehls Super Multi-Corrective Eye Zone Treatment', 18, 1500000, 10, '', '', 'SP54.jpg', '2023-05-23 18:19:52'),
(55, 'Kem Dưỡng Mắt Ban Đêm Kiehls Midnight Recovery Eye', 18, 1350000, 10, '', '', 'SP55.jpg', '2023-05-23 18:20:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `producttype`
--

CREATE TABLE `producttype` (
  `ProductTypeID` int(5) NOT NULL,
  `ProductTypeName` varchar(30) NOT NULL,
  `Gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `producttype`
--

INSERT INTO `producttype` (`ProductTypeID`, `ProductTypeName`, `Gender`) VALUES
(14, 'Cleansers', 'Nam'),
(15, 'Cleansers', 'Nữ'),
(16, 'Serum', 'Nữ'),
(17, 'Cạo râu', 'Nam'),
(18, 'Eye and Lips', 'Nữ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `usr`
--

CREATE TABLE `usr` (
  `Email` varchar(255) NOT NULL,
  `Passwd` varchar(40) NOT NULL,
  `UsrName` varchar(255) NOT NULL,
  `PhoneNo` varchar(12) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Blocked` tinyint(1) NOT NULL,
  `Authentication` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `usr`
--

INSERT INTO `usr` (`Email`, `Passwd`, `UsrName`, `PhoneNo`, `Address`, `Blocked`, `Authentication`) VALUES
('hippokhohang@gmail.com', 'bfe54caa6d483cc3887dce9d1b8eb91408f1ea7a', 'Ninh Mai Ly', '0862789222', 'Quận 7, Thành phố Hồ Chí Minh', 0, 'Store'),
('minhkhachhang@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'Minh Minh', '0793000000', 'Âu cơ, Tân Phú, Thành phố Hồ Chí Minh', 0, 'Usr'),
('minminhoadon@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Alex', '0862789111', 'Tân Phú, Thành phố Hồ Chí Minh', 0, 'Invoice'),
('quynh.hng15@gmail.com', 'fade521a079b41dd7e52bf5157697cdf749e2d6c', 'Hoàng Thụy Quỳnh Hương', '0862789000', 'Bình Chánh, Thành phố Hồ Chí Minh', 0, 'Admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `authenticationusr`
--
ALTER TABLE `authenticationusr`
  ADD PRIMARY KEY (`Authentication`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceID`);

--
-- Chỉ mục cho bảng `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`InvoiceID`,`ProductID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Chỉ mục cho bảng `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`ProductTypeID`);

--
-- Chỉ mục cho bảng `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ProductTypeID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
