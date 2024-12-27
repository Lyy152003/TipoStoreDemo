-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 27, 2024 lúc 03:03 PM
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
  `Discount` int(11) NOT NULL,
  `Total` int(10) NOT NULL,
  `DateInvoice` datetime NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`InvoiceID`, `Email`, `UsrName`, `PhoneNo`, `Address`, `SubTotal`, `Ship`, `Discount`, `Total`, `DateInvoice`, `Status`) VALUES
(26, 'minhkhachhang@gmail.com', 'Hoàng Nhật Minh', '0937264559', '176 đường Lữ Gia, Quận Tân Phú, TPHCM', 2050000, 0, 205000, 1845000, '2024-12-27 00:24:53', 'Hoàn tất đơn hàng'),
(27, 'minhkhachhang@gmail.com', 'Quỳnh Hương', '0793000000', '13 Tên Lửa, Bình Trị Đông', 1800000, 50000, 0, 1850000, '2024-12-27 19:09:46', 'Chờ xác nhận');

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
(26, 70, 1, 900000, 900000),
(26, 71, 1, 1150000, 1150000),
(27, 69, 1, 1800000, 1800000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ProductID` int(5) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProductTypeID` int(3) NOT NULL,
  `UnitPrice` int(10) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Size` varchar(20) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `imgsrc` varchar(50) NOT NULL,
  `Date` datetime NOT NULL,
  `Note` text NOT NULL,
  `isTrending` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Brand`, `ProductTypeID`, `UnitPrice`, `Quantity`, `Size`, `Description`, `imgsrc`, `Date`, `Note`, `isTrending`) VALUES
(69, 'Sữa Rửa Mặt Hoa Cúc Kiehls Calendula', 'Kiehls', 91, 1800000, 4, '', 'Sữa Rửa Mặt Hoa Cúc Kiehls Calendula Deep Cleansing Foaming Face Wash 500ml tạo bọt làm sạch sâu và giúp cân bằng cho da thường và da dầu, đồng thời nhẹ nhàng loại bỏ tạp chất mà không làm mất đi độ ẩm cần thiết của da. Với thành phần chiết xuất Hoa Cúc (Calendula) với nguồn cung bền vững, chứa năm hợp chất giúp làm dịu mẩn đỏ và kích ứng trên da, công thức dạng gel nhanh chóng tạo bọt mịn khi kết hợp với nước, dễ dàng làm sạch và làm dịu da sau khi sử dụng.', 'SP69.jpg', '2024-12-26 23:46:06', '', 1),
(70, 'Sữa Rửa Mặt Đất Sét Kiehls Rare Earth Deep Pore Daily Cleanser', 'Kiehls', 91, 900000, 4, '', 'Được bào chế từ Đất sét trắng Amazon, sữa rửa mặt Kiehls Rare Earth Deep Pore Daily Cleanser giúp loại bỏ bụi bẩn và dầu thừa tối ưu, đồng thời se khít lỗ chân lông một cách rõ rệt, giúp làm sạch tế bào da chết cho da bằng sữa rửa mặt làm sạch chuyên sâu lỗ chân lông của Kiehls. Sản phẩm có tác dụng nhẹ nhàng làm sạch sâu lỗ chân lông, đem lại cho bạn làn da mềm mại, tươi tắn và khỏe mạnh.', 'SP70.jpg', '2024-12-26 23:49:36', '', 0),
(71, 'Sữa Rửa Mặt Kiehls Clearly Corrective Brightening & Exfoliating Cleanser', 'Kiehls', 91, 1150000, 4, '', 'Cleanser giúp thanh lọc làn da, nhẹ nhàng lấy đi tế bào da chết, loại bỏ bụi bẩn và các chất ô nhiễm từ môi trường, đồng thời giúp da sáng trong rõ rệt. Với thành phần chứa Chiết xuất Bạch Dương Trắng và Hoa Mẫu Đơn, sản phẩm nhẹ nhàng loại bỏ bụi bẩn, dầu thừa và các chất ô nhiễm. Ngoài ra, thành phần Đá Ngọc Trai từ núi lửa hoạt động như một chất làm sạch tế bào da chết tự nhiên trong sữa rửa mặt làm sáng da, đem lại làn da mịn màng và tươi trẻ hơn.', 'SP71.jpg', '2024-12-26 23:50:42', '', 0),
(72, 'Gel Rửa Mặt Cho Nam Kiehls Facial Fuel Energizing Face Wash', 'Kiehls', 93, 990000, 5, '', 'Gel Rửa Mặt Cho Nam Kiehls Facial Fuel Energizing Face Wash tươi mát dành cho nam giới giúp loại bỏ cặn bã, bụi bẩn và dầu thừa một cách hiệu quả. Bắt đầu ngày mới tràn đầy năng lượng với sữa rửa mặt có chứa Caffeine, tinh dầu Bạc Hà và Vitamin E.', 'SP72.jpg', '2024-12-26 23:52:51', '', 0),
(73, 'Sữa Rửa Mặt Kiehls Dạng Gel Blue Herbal Blemish Cleanser Treatment', 'Kiehls', 93, 980000, 5, '', 'Sữa Rửa Mặt Kiehls Dạng Gel Blue Herbal Blemish Cleanser Treatment hiệu quả sẽ giúp bạn làm mờ thâm mụn và ngăn ngừa mụn mới hình thành, đồng thời làm sạch sâu lỗ chân lông, loại bỏ bụi bẩn và dầu thừa trên da. Lấy cảm hứng từ Toner Blue Astringent Herbal Lotion kiểm soát dầu đình đám của Kiehls, sữa rửa mặt tạo bọt có chứa Salicylic Acid này sẽ là bước đầu lý tưởng trong chu trình chăm sóc da mụn của bạn.', 'SP73.jpg', '2024-12-26 23:55:16', '', 1),
(74, 'Sữa Rửa Mặt Cho Da Nhạy Cảm Kiehls Centella Sensitive Facial Cleanser', 'Kiehls', 93, 1100000, 5, '', 'Sữa Rửa Mặt Cho Da Nhạy Cảm Kiehls Centella Sensitive Facial Cleanser là dòng sữa rửa mặt dịu nhẹ nhất trong các công thức của Kiehls dành cho da nhạy cảm giúp loại bỏ bụi bẩn, dầu thừa và các tạp chất mà không gây kích ứng cho da hoặc bít tắc lỗ chân lông. Công thức có chứa Rau Má – được biết đến với đặc tính làm dịu da, sữa rửa mặt cân bằng độ pH giúp da sạch sâu, làm dịu và thư giãn cho làn da.', 'SP74.jpg', '2024-12-26 23:56:38', '', 0),
(75, 'Nước Dưỡng Ẩm Cao Cấp SK-II Facial Treatment Essence', 'SK-II', 96, 4590000, 5, '', 'Nước Dưỡng Ẩm Cao Cấp SK-II Facial Treatment Essence 160ml Nước dưỡng ẩm cao cấp SK-II với 90% thành phần độc quyền PITERA™, chứa hơn 50 loại vi dưỡng chất và công thức hơn 40 năm không đổi giúp mang đến Làn Da Trong Trẻo Như Pha Lê', 'SP75.jpg', '2024-12-26 23:59:52', '', 0),
(76, 'Nước Hoa Hồng Làm Sạch Tế Bào Da Chết SK-II Facial Treatment Clear Lotion', 'SK-II', 96, 2080000, 5, '', 'Nước Hoa Hồng Làm Sạch Tế Bào Da Chết SK-II Facial Treatment Clear Lotion 160ml Sản phẩm Toner làm sạch hàng đầu của SK-II. Chứa công thức làm sạch dịu nhẹ giúp nhẹ nhàng loại bỏ các tế bào xỉn màu để giúp mang đến làn da sạch mịn tươi tắn và chuẩn bị cho làn da trước các bước dưỡng tiếp theo', 'SP76.jpg', '2024-12-27 00:01:21', '', 0),
(77, 'Nước Cấp Ẩm Chăm Sóc Da Toàn Diện SK-II LXP Ultimate Perfecting Essence', 'SK-II', 96, 9190000, 5, '', 'Nước Cấp Ẩm Chăm Sóc Da Toàn Diện SK-II Lxp Ultimate Perfecting Essence 150ml Nước dưỡng ẩm cao cấp chăm sóc da toàn diện của SK-II, với thành phần độc quyền PITERA™ được chiết xuất với hàm lượng cao nhằm giúp tăng cường nuôi dưỡng chuyên sâu và chăm sóc da toàn diện. Đem đến hiệu quả rõ rệt cho làn da sau khi sử dụng', 'SP77.jpg', '2024-12-27 00:02:30', '', 1),
(78, 'Serum PDRN tế bào gốc trà xanh cho da căng bóng, đàn hồi INNISFREE Retinol Green Tea PDRN Ampoule 25 mL', 'INNISFREE', 97, 990000, 5, '', 'Serum Retinol PDRN Trà Xanh giúp tái tạo cho da căng bóng & giảm dấu hiệu lão hóa từ bên trong với PDRN và phức hợp Retinol 1%', 'SP78.jpg', '2024-12-27 00:06:00', '', 0),
(79, 'Tinh Dầu Dưỡng Chống Lão Hoá Từ Trà Đen INNISFREE Black Tea Youth Enhancing Oil', 'INNISFREE', 97, 748000, 5, '', 'Dành cho làn da bị khô do căng thẳng, chăm sóc con cái và những giờ làm việc tăng ca. Dưỡng ẩm, mờ nếp nhăn, làm sáng và thêm rạng rỡ cho làn da trông khỏe mạnh như vừa thức dậy sau một giấc ngủ ngon. Tinh dầu dưỡng da 3 trong 1: Dưỡng ẩm, Chống lão hóa & Làm sáng. Kết cấu mỏng nhẹ như nước và cấp ẩm sâu như dầu, tinh dầu trà đen làm đầy làn da từ bên trong giúp tạo nên làn da khỏe mạnh, rạng rỡ. Dùng được cho mọi loại da (trừ da mụn)', 'SP79.jpg', '2024-12-27 00:06:54', '<p dir=\"ltr\"><strong>Serum innisfree Dưỡng S&aacute;ng Da Tr&ocirc;ng Căng Mướt 30ml&nbsp;</strong>l&agrave; sản phẩm&nbsp;<a href=\"https://hasaki.vn/danh-muc/serum-tinh-chat-c75.html\" target=\"_blank\" rel=\"noopener\">serum</a>&nbsp;đến từ thương hiệu&nbsp;<a href=\"https://hasaki.vn/thuong-hieu/innisfree.html\">innisfree</a>. Th&agrave;nh phần cải tiến với vi&ecirc;n nang vitamin c k&eacute;p v&agrave; enzyme tr&agrave; xanh sinh học gi&uacute;p l&agrave;m đều m&agrave;u da, cải thiện th&acirc;m sạm v&agrave; mang lại l&agrave;n da trắng s&aacute;ng, mịn m&agrave;ng, rạng ngời.&nbsp;</p>\r\n<p dir=\"ltr\"><strong>Serum innisfree Vitamin C Green Tea Enzyme Brightening 30ml&nbsp;</strong>hiện đ&atilde; c&oacute; tại</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<p dir=\"ltr\"><img class=\"loading\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"Mua Serum innisfree Dưỡng S&aacute;ng Da Tr&ocirc;ng Căng Mướt tại Hasaki \" src=\"https://media.hcdn.vn/wysiwyg/Chau/serum-innisfree-tra-xanh-duong-am-80ml-moi-2023-3_2.jpg\" alt=\"Mua Serum innisfree Dưỡng S&aacute;ng Da Tr&ocirc;ng Căng Mướt 30ml tại Hasaki \" width=\"381\" height=\"381\" data-was-processed=\"true\"></p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h2 dir=\"ltr\">Loại da ph&ugrave; hợp:</h2>\r\n<ul>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">Ph&ugrave; hợp mọi loại da, đặc biệt&nbsp;<a href=\"https://hasaki.vn/danh-muc/mun-c1877.html\">da mụn</a>, nhạy cảm.</p>\r\n</li>\r\n</ul>\r\n<h2>Giải ph&aacute;p cho t&igrave;nh trạng da:&nbsp;</h2>\r\n<ul>\r\n<li>\r\n<p><a href=\"https://hasaki.vn/danh-muc/xin-mau-tham-sam-c1887.html\" target=\"_blank\" rel=\"noopener\">Da xỉn m&agrave;u</a>&nbsp;v&agrave; th&acirc;m sạm</p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">Ưu thế nổi bật:</h2>\r\n<ul>\r\n<li>\r\n<p><strong>Vi&ecirc;n nang vitamin C k&eacute;p</strong>&nbsp;l&agrave;m mờ vết th&acirc;m, l&agrave;m đều m&agrave;u da cho l&agrave;n da s&aacute;ng trong căng mướt.</p>\r\n</li>\r\n<li>\r\n<p><strong>Enzyme tr&agrave; xanh sinh học</strong>&nbsp;tẩy tế b&agrave;o chết nhẹ nh&agrave;ng, l&agrave;m mịn da, kh&ocirc;ng g&acirc;y k&iacute;ch ứng.</p>\r\n</li>\r\n<li>\r\n<p>C&ocirc;ng nghệ thẩm thấu nhanh đưa hoạt chất v&agrave;o da hiệu quả.</p>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"padding-left: 160px;\"><img class=\"loading\" title=\"Serum innisfree Vitamin C Green Tea Enzyme Brightening \" src=\"https://media.hcdn.vn/wysiwyg/Chau/serum-innisfree-tra-xanh-duong-am-80ml-moi-2023-2_2.jpg\" alt=\"Serum innisfree Vitamin C Green Tea Enzyme Brightening 30ml\" width=\"449\" height=\"449\" data-was-processed=\"true\"><img class=\"loading\" title=\"Serum innisfree Vitamin C Green Tea Enzyme Brightening 30ml đ&atilde; c&oacute; tại Hasaki\" src=\"https://media.hcdn.vn/wysiwyg/Chau/serum-innisfree-tra-xanh-duong-am-80ml-moi-2023-1_1.jpg\" alt=\"Serum innisfree Vitamin C Green Tea Enzyme Brightening  \" width=\"451\" height=\"451\" data-was-processed=\"true\"></p>\r\n<p>&nbsp;</p>\r\n<h2>Độ hiệu quả:</h2>\r\n<ul>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">Cải thiện 48% về số lượng nhược điểm, cải thiện 101%&nbsp; kết cấu da, 112% cải thiện t&iacute;nh minh bạch sau 4 tuần về cải thiện vết th&acirc;m, cấu tr&uacute;c da sau 4 tuần sử dụng v&agrave; trong suốt ngay sau khi sử dụng.</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">Hiệu ứng l&agrave;m s&aacute;ng mạnh hơn gấp 4 lần, tinh chất l&agrave;m săn chắc, chăm s&oacute;c vết th&acirc;m v&agrave; bong tr&oacute;c c&ugrave;ng một l&uacute;c, chăm s&oacute;c cho l&agrave;n da s&aacute;ng hơn v&agrave; kết cấu da mịn m&agrave;ng.</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">L&agrave;n da trong suốt với khả năng chăm s&oacute;c mụn gấp 4 lần. Cải thiện diện t&iacute;ch hắc tố bề mặt v&agrave; cải thiện t&ocirc;ng m&agrave;u da.</p>\r\n</li>\r\n</ul>\r\n<h2>Độ an to&agrave;n:&nbsp;</h2>\r\n<ul>\r\n<li>\r\n<p>C&ocirc;ng thức l&agrave;nh t&iacute;nh</p>\r\n</li>\r\n<li>\r\n<p>C&ocirc;ng thức 9 kh&ocirc;ng th&agrave;nh phần c&oacute; hại</p>\r\n</li>\r\n<li>\r\n<p>C&ocirc;ng thức đạt 0.00 kh&ocirc;ng g&acirc;y k&iacute;ch ứng da&nbsp;</p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">Bảo quản:&nbsp;</h2>\r\n<ul>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">Tr&aacute;nh &aacute;nh nắng trực tiếp.</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t.</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\">Đậy nắp k&iacute;n sau khi sử dụng.</p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">Th&ocirc;ng số sản phẩm:</h2>\r\n<ul>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\"><strong>Dung t&iacute;ch:</strong>&nbsp;30ml</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\"><strong>Thương hiệu:</strong>&nbsp;innisfree</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\"><strong>Xuất xứ thương hiệu:</strong>&nbsp;H&agrave;n Quốc</p>\r\n</li>\r\n<li dir=\"ltr\">\r\n<p dir=\"ltr\"><strong>Sản xuất tại:</strong> H&agrave;n Quốc</p>\r\n</li>\r\n</ul>', 0),
(80, 'Tinh chất dưỡng da từ hoa lan Innisfree Jeju Orchid Enriched Essence 50ml', 'INNISFREE', 97, 756000, 5, '', 'Tinh chất dưỡng da đa năng giúp dưỡng da khỏe, săn chắc, mềm mại cũng như nuôi dưỡng và làm sáng da Innisfree Jeju Orchid Enriched Essence', 'SP80.jpg', '2024-12-27 00:07:30', '', 1),
(81, 'Advanced Night Repair Synchronized Multi-Recovery Complex', 'ESTEE LAUDER', 99, 1650000, 5, '', '7 Tinh chất trong 1: Chống lại các dấu hiệu lão hóa', 'SP81.jpg', '2024-12-27 00:11:22', '', 0),
(83, 'Advanced Night Repair Rescue Solution with 15% Bifidus Ferment', 'ESTEE LAUDER', 99, 2750000, 5, '', 'Kết cấu serum lỏng, thẩm thấu nhanh, lý tưởng cho làn da mỏng, dễ nhạy cảm', 'SP83.jpg', '2024-12-27 00:13:31', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `producttype`
--

CREATE TABLE `producttype` (
  `ProductTypeID` int(5) NOT NULL,
  `ProductTypeName` varchar(30) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `producttype`
--

INSERT INTO `producttype` (`ProductTypeID`, `ProductTypeName`, `Gender`, `Category`) VALUES
(91, 'Sửa rửa mặt', 'Nữ', 'Chăm sóc da mặt'),
(93, 'Sửa rửa mặt', 'Nam', 'Chăm sóc da mặt'),
(96, 'Toner', 'Nữ', 'Chăm sóc da mặt'),
(97, 'Serum', 'Nữ', 'Chăm sóc da mặt'),
(99, 'Serum', 'Nam', 'Chăm sóc da mặt'),
(100, 'Dưỡng Thể', 'Nam', 'Chăm sóc cơ thể'),
(101, 'Tẩy Tế Bào Chết Body', 'Nữ', 'Chăm sóc cơ thể'),
(102, 'Trang Điểm Mặt', 'Nữ', 'Trang Điểm'),
(103, 'Trang Điểm Môi', 'Nữ', 'Trang Điểm'),
(104, 'Nước Hoa Nữ', 'Nữ', 'Nước Hoa'),
(105, 'Nước Hoa Nam', 'Nam', 'Nước Hoa'),
(106, 'Hỗ Trợ Làm Đẹp', 'Nữ', 'Thực Phẩm Chức Năng');

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
('admin@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'Quỳnh Hương', '0862700000', 'Âu cơ, Tân Phú, TPHCM', 0, 'Admin'),
('Invoice@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'Quỳnh Hương', '09809090909', '54/32 , Ngô Quyền, Phường 5, Quận 10', 0, 'Invoice'),
('minhkhachhang@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'Hoàng Nhật Minh', '0937264559', '176 đường Lữ Gia, Quận Tân Phú, TPHCM', 0, 'Usr'),
('store@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'Quỳnh Hương ', '0862232323', '112/5 , Ngô Gia Tự, Phường 9, Quận 10', 0, 'Store');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `VoucherID` varchar(10) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `DiscountPercent` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`VoucherID`, `StartDate`, `EndDate`, `DiscountPercent`) VALUES
('KM01', '2024-12-15', '2024-12-21', 10),
('KMGS', '2024-12-26', '2024-12-31', 10);

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
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`VoucherID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ProductTypeID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
