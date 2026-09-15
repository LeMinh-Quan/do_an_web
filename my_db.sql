-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 15, 2026 lúc 05:06 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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
-- Cấu trúc bảng cho bảng `chatbot_training`
--

CREATE TABLE `chatbot_training` (
  `id` int(11) NOT NULL,
  `intent` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `reply` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chatbot_training`
--

INSERT INTO `chatbot_training` (`id`, `intent`, `question`, `reply`, `status`, `created_at`) VALUES
(1, 'greeting', 'xin chào', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(2, 'greeting', 'chào shop', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(3, 'greeting', 'chào bạn', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(4, 'greeting', 'hello', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(5, 'greeting', 'hi shop', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(6, 'greeting', 'shop ơi', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(7, 'greeting', 'xin chào shop', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(8, 'greeting', 'chào ad', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(9, 'greeting', 'hello shop', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(10, 'greeting', 'alo shop', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(11, 'greeting', 'cho mình hỏi', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(12, 'greeting', 'mình muốn hỏi', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(13, 'greeting', 'mình cần tư vấn', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(14, 'greeting', 'hỗ trợ mình với', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(15, 'greeting', 'shop có ai hỗ trợ không', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(16, 'greeting', 'cho hỏi chút', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(17, 'greeting', 'tư vấn giúp mình', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(18, 'greeting', 'chào tqs store', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(19, 'greeting', 'xin chào tqs store', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(20, 'greeting', 'có ai online không', 'Xin chào! Mình có thể hỗ trợ bạn tìm laptop, giá, hãng, tồn kho, giỏ hàng, thanh toán, giao hàng và đơn hàng.', 1, '2026-09-15 14:53:41'),
(21, 'thanks', 'cảm ơn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(22, 'thanks', 'cảm ơn shop', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(23, 'thanks', 'cảm ơn bạn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(24, 'thanks', 'thanks', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(25, 'thanks', 'thank you', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(26, 'thanks', 'ok cảm ơn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(27, 'thanks', 'được rồi cảm ơn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(28, 'thanks', 'cảm ơn nhiều', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(29, 'thanks', 'cảm ơn shop nhiều', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(30, 'thanks', 'mình hiểu rồi', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(31, 'thanks', 'ok shop', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(32, 'thanks', 'rất cảm ơn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(33, 'thanks', 'cảm ơn đã tư vấn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(34, 'thanks', 'cảm ơn bạn nhé', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(35, 'thanks', 'thanks shop', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(36, 'thanks', 'thank shop', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(37, 'thanks', 'được rồi nhé', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(38, 'thanks', 'ổn rồi cảm ơn', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(39, 'thanks', 'mình biết rồi', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(40, 'thanks', 'cảm ơn vì đã hỗ trợ', 'Không có gì! Mình rất vui được hỗ trợ bạn.', 1, '2026-09-15 14:53:41'),
(41, 'brand', 'shop có acer không', NULL, 1, '2026-09-15 14:53:41'),
(42, 'brand', 'shop có asus không', NULL, 1, '2026-09-15 14:53:41'),
(43, 'brand', 'shop có dell không', NULL, 1, '2026-09-15 14:53:41'),
(44, 'brand', 'shop có hp không', NULL, 1, '2026-09-15 14:53:41'),
(45, 'brand', 'shop có lenovo không', NULL, 1, '2026-09-15 14:53:41'),
(46, 'brand', 'shop có msi không', NULL, 1, '2026-09-15 14:53:41'),
(47, 'brand', 'shop có macbook không', NULL, 1, '2026-09-15 14:53:41'),
(48, 'brand', 'shop bán hãng nào', NULL, 1, '2026-09-15 14:53:41'),
(49, 'brand', 'shop có những thương hiệu nào', NULL, 1, '2026-09-15 14:53:41'),
(50, 'brand', 'có những hãng laptop nào', NULL, 1, '2026-09-15 14:53:41'),
(51, 'brand', 'shop đang bán hãng gì', NULL, 1, '2026-09-15 14:53:41'),
(52, 'brand', 'cho mình xem các hãng laptop', NULL, 1, '2026-09-15 14:53:41'),
(53, 'brand', 'các thương hiệu đang có', NULL, 1, '2026-09-15 14:53:41'),
(54, 'brand', 'acer có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(55, 'brand', 'asus có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(56, 'brand', 'dell có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(57, 'brand', 'hp có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(58, 'brand', 'lenovo có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(59, 'brand', 'msi có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(60, 'brand', 'macbook có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(61, 'product', 'shop có laptop không', NULL, 1, '2026-09-15 14:53:41'),
(62, 'product', 'shop đang bán những máy nào', NULL, 1, '2026-09-15 14:53:41'),
(63, 'product', 'shop có những sản phẩm gì', NULL, 1, '2026-09-15 14:53:41'),
(64, 'product', 'cho mình xem laptop', NULL, 1, '2026-09-15 14:53:41'),
(65, 'product', 'cho mình xem sản phẩm', NULL, 1, '2026-09-15 14:53:41'),
(66, 'product', 'có máy tính nào', NULL, 1, '2026-09-15 14:53:41'),
(67, 'product', 'có laptop nào', NULL, 1, '2026-09-15 14:53:41'),
(68, 'product', 'shop còn laptop không', NULL, 1, '2026-09-15 14:53:41'),
(69, 'product', 'còn máy nào không', NULL, 1, '2026-09-15 14:53:41'),
(70, 'product', 'có sản phẩm nào đang bán', NULL, 1, '2026-09-15 14:53:41'),
(71, 'product', 'danh sách laptop', NULL, 1, '2026-09-15 14:53:41'),
(72, 'product', 'danh sách sản phẩm', NULL, 1, '2026-09-15 14:53:41'),
(73, 'product', 'xem sản phẩm', NULL, 1, '2026-09-15 14:53:41'),
(74, 'product', 'xem laptop', NULL, 1, '2026-09-15 14:53:41'),
(75, 'product', 'tìm laptop', NULL, 1, '2026-09-15 14:53:41'),
(76, 'product', 'tìm máy tính', NULL, 1, '2026-09-15 14:53:41'),
(77, 'product', 'tìm sản phẩm', NULL, 1, '2026-09-15 14:53:41'),
(78, 'product', 'mình cần mua laptop', NULL, 1, '2026-09-15 14:53:41'),
(79, 'product', 'mình muốn mua máy tính', NULL, 1, '2026-09-15 14:53:41'),
(80, 'product', 'cần tìm một chiếc laptop', NULL, 1, '2026-09-15 14:53:41'),
(81, 'price', 'giá laptop bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(82, 'price', 'giá máy bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(83, 'price', 'laptop giá bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(84, 'price', 'máy tính giá bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(85, 'price', 'giá sản phẩm', NULL, 1, '2026-09-15 14:53:41'),
(86, 'price', 'cho mình xem giá', NULL, 1, '2026-09-15 14:53:41'),
(87, 'price', 'giá laptop', NULL, 1, '2026-09-15 14:53:41'),
(88, 'price', 'giá máy tính', NULL, 1, '2026-09-15 14:53:41'),
(89, 'price', 'bao nhiêu tiền', NULL, 1, '2026-09-15 14:53:41'),
(90, 'price', 'máy này bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(91, 'price', 'laptop này bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(92, 'price', 'giá con này', NULL, 1, '2026-09-15 14:53:41'),
(93, 'price', 'giá sản phẩm này', NULL, 1, '2026-09-15 14:53:41'),
(94, 'price', 'giá bao nhiêu vậy', NULL, 1, '2026-09-15 14:53:41'),
(95, 'price', 'cho hỏi giá', NULL, 1, '2026-09-15 14:53:41'),
(96, 'price', 'xin giá', NULL, 1, '2026-09-15 14:53:41'),
(97, 'price', 'shop báo giá giúp', NULL, 1, '2026-09-15 14:53:41'),
(98, 'price', 'giá bán bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(99, 'price', 'mức giá laptop', NULL, 1, '2026-09-15 14:53:41'),
(100, 'price', 'tầm giá bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(101, 'price_under', 'laptop dưới 10 triệu', NULL, 1, '2026-09-15 14:53:41'),
(102, 'price_under', 'laptop dưới 15 triệu', NULL, 1, '2026-09-15 14:53:41'),
(103, 'price_under', 'laptop dưới 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(104, 'price_under', 'laptop dưới 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(105, 'price_under', 'laptop dưới 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(106, 'price_under', 'máy dưới 10 triệu', NULL, 1, '2026-09-15 14:53:41'),
(107, 'price_under', 'máy dưới 15 triệu', NULL, 1, '2026-09-15 14:53:41'),
(108, 'price_under', 'máy dưới 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(109, 'price_under', 'máy dưới 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(110, 'price_under', 'máy dưới 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(111, 'price_under', 'có laptop nào dưới 20 triệu không', NULL, 1, '2026-09-15 14:53:41'),
(112, 'price_under', 'tìm máy dưới 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(113, 'price_under', 'cho mình máy dưới 15 triệu', NULL, 1, '2026-09-15 14:53:41'),
(114, 'price_under', 'gợi ý laptop dưới 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(115, 'price_under', 'tìm laptop giá dưới 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(116, 'price_under', 'mình có 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(117, 'price_under', 'mình có 15 triệu', NULL, 1, '2026-09-15 14:53:41'),
(118, 'price_under', 'ngân sách 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(119, 'price_under', 'ngân sách 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(120, 'price_under', 'tầm 20 triệu nên mua máy nào', NULL, 1, '2026-09-15 14:53:41'),
(121, 'price_under', 'khoảng 15 triệu mua được laptop nào', NULL, 1, '2026-09-15 14:53:41'),
(122, 'price_under', 'tầm dưới 20 triệu có máy gì', NULL, 1, '2026-09-15 14:53:41'),
(123, 'price_under', 'laptop khoảng 10 triệu', NULL, 1, '2026-09-15 14:53:41'),
(124, 'price_under', 'máy tính dưới 18 triệu', NULL, 1, '2026-09-15 14:53:41'),
(125, 'price_under', 'laptop không quá 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(126, 'price_range', 'laptop từ 10 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(127, 'price_range', 'laptop từ 15 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(128, 'price_range', 'laptop từ 20 đến 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(129, 'price_range', 'máy từ 15 đến 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(130, 'price_range', 'máy từ 20 đến 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(131, 'price_range', 'tìm laptop trong khoảng 10 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(132, 'price_range', 'tìm máy khoảng 15 đến 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(133, 'price_range', 'laptop tầm 20 đến 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(134, 'price_range', 'máy khoảng 20 triệu đến 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(135, 'price_range', 'cho mình laptop từ 20 đến 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(136, 'price_range', 'tìm máy giá từ 15 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(137, 'price_range', 'ngân sách từ 15 đến 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(138, 'price_range', 'có laptop nào khoảng 20 đến 30 triệu không', NULL, 1, '2026-09-15 14:53:41'),
(139, 'price_range', 'máy từ 10 đến 15 triệu', NULL, 1, '2026-09-15 14:53:41'),
(140, 'price_range', 'laptop khoảng 15 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(141, 'price_range', 'từ 20 tới 25 triệu có máy nào', NULL, 1, '2026-09-15 14:53:41'),
(142, 'price_range', 'máy trong tầm 15 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(143, 'price_range', 'laptop từ 18 đến 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(144, 'price_range', 'máy giá từ 25 đến 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(145, 'price_range', 'tìm máy trong khoảng 20 tới 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(146, 'price_range', 'có máy nào từ 10 đến 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(147, 'price_range', 'tầm 12 đến 18 triệu có laptop nào', NULL, 1, '2026-09-15 14:53:41'),
(148, 'price_range', 'laptop trong khoảng 15 triệu đến 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(149, 'price_range', 'từ 20 đến 28 triệu', NULL, 1, '2026-09-15 14:53:41'),
(150, 'price_range', 'máy tầm 25 đến 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(151, 'price_over', 'laptop trên 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(152, 'price_over', 'laptop trên 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(153, 'price_over', 'máy trên 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(154, 'price_over', 'máy trên 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(155, 'price_over', 'tìm laptop trên 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(156, 'price_over', 'có máy nào hơn 20 triệu không', NULL, 1, '2026-09-15 14:53:41'),
(157, 'price_over', 'máy cao cấp trên 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(158, 'price_over', 'laptop từ 25 triệu trở lên', NULL, 1, '2026-09-15 14:53:41'),
(159, 'price_over', 'máy trên 30 triệu có những loại nào', NULL, 1, '2026-09-15 14:53:41'),
(160, 'price_over', 'tìm laptop giá cao', NULL, 1, '2026-09-15 14:53:41'),
(161, 'price_over', 'có máy nào trên 25 triệu không', NULL, 1, '2026-09-15 14:53:41'),
(162, 'price_over', 'laptop hơn 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(163, 'price_over', 'máy từ 30 triệu trở lên', NULL, 1, '2026-09-15 14:53:41'),
(164, 'price_over', 'laptop trên 15 triệu', NULL, 1, '2026-09-15 14:53:41'),
(165, 'price_over', 'máy trên 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(166, 'price_over', 'có laptop cao cấp không', NULL, 1, '2026-09-15 14:53:41'),
(167, 'price_over', 'máy giá trên 20 triệu', NULL, 1, '2026-09-15 14:53:41'),
(168, 'price_over', 'laptop tầm trên 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(169, 'price_over', 'máy vượt 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(170, 'price_over', 'laptop trên 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(171, 'price_over', 'có máy nào hơn 25 triệu', NULL, 1, '2026-09-15 14:53:41'),
(172, 'price_over', 'tìm laptop từ 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(173, 'price_over', 'máy cao cấp giá trên 30 triệu', NULL, 1, '2026-09-15 14:53:41'),
(174, 'price_over', 'laptop từ 20 triệu trở lên', NULL, 1, '2026-09-15 14:53:41'),
(175, 'price_over', 'máy trên 28 triệu', NULL, 1, '2026-09-15 14:53:41'),
(176, 'stock', 'còn hàng không', NULL, 1, '2026-09-15 14:53:41'),
(177, 'stock', 'sản phẩm còn hàng không', NULL, 1, '2026-09-15 14:53:41'),
(178, 'stock', 'laptop này còn hàng không', NULL, 1, '2026-09-15 14:53:41'),
(179, 'stock', 'máy này còn không', NULL, 1, '2026-09-15 14:53:41'),
(180, 'stock', 'còn máy không', NULL, 1, '2026-09-15 14:53:41'),
(181, 'stock', 'shop còn hàng không', NULL, 1, '2026-09-15 14:53:41'),
(182, 'stock', 'kiểm tra tồn kho', NULL, 1, '2026-09-15 14:53:41'),
(183, 'stock', 'xem tồn kho', NULL, 1, '2026-09-15 14:53:41'),
(184, 'stock', 'sản phẩm còn bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(185, 'stock', 'còn bao nhiêu máy', NULL, 1, '2026-09-15 14:53:41'),
(186, 'stock', 'còn bao nhiêu sản phẩm', NULL, 1, '2026-09-15 14:53:41'),
(187, 'stock', 'có sẵn không', NULL, 1, '2026-09-15 14:53:41'),
(188, 'stock', 'hàng có sẵn không', NULL, 1, '2026-09-15 14:53:41'),
(189, 'stock', 'shop còn máy này không', NULL, 1, '2026-09-15 14:53:41'),
(190, 'stock', 'máy này hết hàng chưa', NULL, 1, '2026-09-15 14:53:41'),
(191, 'stock', 'sản phẩm này hết hàng chưa', NULL, 1, '2026-09-15 14:53:41'),
(192, 'stock', 'có hàng sẵn không', NULL, 1, '2026-09-15 14:53:41'),
(193, 'stock', 'tình trạng tồn kho', NULL, 1, '2026-09-15 14:53:41'),
(194, 'stock', 'kiểm tra hàng', NULL, 1, '2026-09-15 14:53:41'),
(195, 'stock', 'kiểm tra số lượng', NULL, 1, '2026-09-15 14:53:41'),
(196, 'stock', 'còn sản phẩm không', NULL, 1, '2026-09-15 14:53:41'),
(197, 'stock', 'có sẵn hàng không', NULL, 1, '2026-09-15 14:53:41'),
(198, 'stock', 'còn hàng trong kho không', NULL, 1, '2026-09-15 14:53:41'),
(199, 'stock', 'số lượng còn lại', NULL, 1, '2026-09-15 14:53:41'),
(200, 'stock', 'xem số lượng hàng', NULL, 1, '2026-09-15 14:53:41'),
(201, 'cart', 'giỏ hàng ở đâu', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(202, 'cart', 'mở giỏ hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(203, 'cart', 'xem giỏ hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(204, 'cart', 'thêm vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(205, 'cart', 'thêm sản phẩm vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(206, 'cart', 'thêm laptop vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(207, 'cart', 'cách thêm sản phẩm vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(208, 'cart', 'làm sao thêm vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(209, 'cart', 'làm sao mua hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(210, 'cart', 'cách mua hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(211, 'cart', 'mua laptop thế nào', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(212, 'cart', 'đặt sản phẩm vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(213, 'cart', 'cho sản phẩm vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(214, 'cart', 'thêm máy vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(215, 'cart', 'giỏ hàng của tôi', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(216, 'cart', 'kiểm tra giỏ hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(217, 'cart', 'sửa số lượng trong giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(218, 'cart', 'xóa sản phẩm khỏi giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(219, 'cart', 'thay đổi số lượng sản phẩm', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(220, 'cart', 'muốn mua sản phẩm', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(221, 'cart', 'cách bỏ hàng vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(222, 'cart', 'thêm máy tính vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(223, 'cart', 'mua hàng như thế nào', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(224, 'cart', 'xem các sản phẩm trong giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(225, 'cart', 'xóa hàng trong giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó mở biểu tượng giỏ hàng để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:41'),
(226, 'payment', 'thanh toán thế nào', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(227, 'payment', 'shop thanh toán bằng gì', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(228, 'payment', 'có những hình thức thanh toán nào', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(229, 'payment', 'có cod không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(230, 'payment', 'có thanh toán khi nhận hàng không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(231, 'payment', 'có trả tiền khi nhận hàng không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(232, 'payment', 'có chuyển khoản không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(233, 'payment', 'thanh toán chuyển khoản', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(234, 'payment', 'thanh toán online', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(235, 'payment', 'shop có hỗ trợ cod không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(236, 'payment', 'mình muốn chuyển khoản', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(237, 'payment', 'cách thanh toán', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(238, 'payment', 'hướng dẫn thanh toán', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(239, 'payment', 'thanh toán đơn hàng', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(240, 'payment', 'shop nhận tiền mặt không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(241, 'payment', 'có thể trả tiền mặt không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(242, 'payment', 'thanh toán tại nhà', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(243, 'payment', 'có hỗ trợ tiền mặt không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(244, 'payment', 'shop có nhận chuyển khoản không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(245, 'payment', 'phương thức thanh toán', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(246, 'payment', 'shop có nhận cod không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(247, 'payment', 'trả tiền lúc nhận hàng', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(248, 'payment', 'thanh toán bằng tiền mặt', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(249, 'payment', 'thanh toán qua ngân hàng', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(250, 'payment', 'cách trả tiền cho đơn hàng', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền.', 1, '2026-09-15 14:53:41'),
(251, 'shipping', 'shop có giao hàng không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(252, 'shipping', 'giao hàng thế nào', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(253, 'shipping', 'bao lâu nhận được hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(254, 'shipping', 'bao lâu thì giao', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(255, 'shipping', 'khi nào giao', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(256, 'shipping', 'khi nào nhận hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(257, 'shipping', 'thời gian giao hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(258, 'shipping', 'thời gian vận chuyển', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(259, 'shipping', 'ship bao lâu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(260, 'shipping', 'shop có ship không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(261, 'shipping', 'có hỗ trợ giao hàng không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(262, 'shipping', 'phí giao hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(263, 'shipping', 'phí ship bao nhiêu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(264, 'shipping', 'ship hàng như thế nào', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(265, 'shipping', 'đơn bao lâu tới', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(266, 'shipping', 'mấy ngày nhận được', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(267, 'shipping', 'giao hàng mất mấy ngày', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(268, 'shipping', 'shop gửi hàng bằng gì', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(269, 'shipping', 'có giao tận nơi không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(270, 'shipping', 'có giao về tỉnh không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(271, 'shipping', 'có giao tận nhà không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(272, 'shipping', 'bao giờ hàng tới', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(273, 'shipping', 'thời gian ship hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(274, 'shipping', 'phí vận chuyển bao nhiêu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(275, 'shipping', 'shop giao hàng tận nơi không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:41'),
(276, 'warranty', 'sản phẩm có bảo hành không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(277, 'warranty', 'bảo hành bao lâu', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(278, 'warranty', 'chính sách bảo hành', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(279, 'warranty', 'bảo hành laptop', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(280, 'warranty', 'bảo hành máy tính', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(281, 'warranty', 'đổi trả thế nào', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(282, 'warranty', 'chính sách đổi trả', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(283, 'warranty', 'có được đổi hàng không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(284, 'warranty', 'có được trả hàng không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(285, 'warranty', 'có hoàn tiền không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(286, 'warranty', 'sản phẩm lỗi thì sao', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(287, 'warranty', 'máy bị lỗi thì sao', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(288, 'warranty', 'laptop lỗi có đổi được không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(289, 'warranty', 'máy hỏng có được bảo hành không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(290, 'warranty', 'bảo hành ở đâu', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(291, 'warranty', 'cách bảo hành', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(292, 'warranty', 'thủ tục bảo hành', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(293, 'warranty', 'hậu mãi thế nào', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(294, 'warranty', 'chính sách hậu mãi', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(295, 'warranty', 'điều kiện đổi trả', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(296, 'warranty', 'đổi máy bị lỗi', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(297, 'warranty', 'đổi sản phẩm lỗi', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(298, 'warranty', 'bảo hành sản phẩm như thế nào', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(299, 'warranty', 'nếu máy lỗi thì xử lý ra sao', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(300, 'warranty', 'có hỗ trợ bảo hành không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:41'),
(301, 'contact', 'shop ở đâu', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(302, 'contact', 'địa chỉ shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(303, 'contact', 'địa chỉ cửa hàng', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(304, 'contact', 'shop nằm ở đâu', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(305, 'contact', 'cửa hàng ở đâu', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(306, 'contact', 'cho xin địa chỉ', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(307, 'contact', 'địa chỉ tqs store', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(308, 'contact', 'liên hệ shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(309, 'contact', 'cách liên hệ', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(310, 'contact', 'số điện thoại shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(311, 'contact', 'hotline shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(312, 'contact', 'cho xin số điện thoại', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(313, 'contact', 'email shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(314, 'contact', 'cho xin email', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(315, 'contact', 'email cửa hàng', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(316, 'contact', 'shop mở cửa lúc mấy giờ', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(317, 'contact', 'giờ làm việc', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(318, 'contact', 'giờ mở cửa', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(319, 'contact', 'shop hoạt động lúc nào', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(320, 'contact', 'liên hệ tqs store', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(321, 'contact', 'địa chỉ cụ thể của shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(322, 'contact', 'shop có số điện thoại không', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(323, 'contact', 'xin hotline', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(324, 'contact', 'shop làm việc giờ nào', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(325, 'contact', 'cửa hàng mở tới mấy giờ', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:41'),
(326, 'order', 'đơn hàng của tôi đâu', NULL, 1, '2026-09-15 14:53:41'),
(327, 'order', 'kiểm tra đơn hàng', NULL, 1, '2026-09-15 14:53:41'),
(328, 'order', 'xem đơn hàng', NULL, 1, '2026-09-15 14:53:41'),
(329, 'order', 'đơn hàng của tôi', NULL, 1, '2026-09-15 14:53:41'),
(330, 'order', 'tình trạng đơn hàng', NULL, 1, '2026-09-15 14:53:41'),
(331, 'order', 'trạng thái đơn hàng', NULL, 1, '2026-09-15 14:53:41'),
(332, 'order', 'đơn đang ở đâu', NULL, 1, '2026-09-15 14:53:41'),
(333, 'order', 'đơn của tôi đang ở đâu', NULL, 1, '2026-09-15 14:53:41'),
(334, 'order', 'theo dõi đơn hàng', NULL, 1, '2026-09-15 14:53:41'),
(335, 'order', 'theo dõi đơn', NULL, 1, '2026-09-15 14:53:41'),
(336, 'order', 'kiểm tra trạng thái đơn', NULL, 1, '2026-09-15 14:53:41'),
(337, 'order', 'đơn đã được xác nhận chưa', NULL, 1, '2026-09-15 14:53:41'),
(338, 'order', 'đơn đã giao chưa', NULL, 1, '2026-09-15 14:53:41'),
(339, 'order', 'đơn đang giao phải không', NULL, 1, '2026-09-15 14:53:41'),
(340, 'order', 'đơn hàng khi nào giao', NULL, 1, '2026-09-15 14:53:41'),
(341, 'order', 'đơn hàng bị gì vậy', NULL, 1, '2026-09-15 14:53:41'),
(342, 'order', 'đơn hàng của mình', NULL, 1, '2026-09-15 14:53:41'),
(343, 'order', 'xem lịch sử đơn hàng', NULL, 1, '2026-09-15 14:53:41'),
(344, 'order', 'lịch sử mua hàng', NULL, 1, '2026-09-15 14:53:41'),
(345, 'order', 'tôi đã đặt đơn nào', NULL, 1, '2026-09-15 14:53:41'),
(346, 'order', 'kiểm tra đơn tôi đã mua', NULL, 1, '2026-09-15 14:53:41'),
(347, 'order', 'đơn của tôi đang xử lý à', NULL, 1, '2026-09-15 14:53:41'),
(348, 'order', 'đơn đã xác nhận chưa', NULL, 1, '2026-09-15 14:53:41'),
(349, 'order', 'xem các đơn đã đặt', NULL, 1, '2026-09-15 14:53:41'),
(350, 'order', 'tình trạng đơn tôi', NULL, 1, '2026-09-15 14:53:41'),
(351, 'cancel_order', 'hủy đơn hàng', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(352, 'cancel_order', 'muốn hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(353, 'cancel_order', 'hủy đơn của tôi', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(354, 'cancel_order', 'làm sao hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(355, 'cancel_order', 'có hủy đơn được không', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(356, 'cancel_order', 'tôi muốn hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(357, 'cancel_order', 'hủy đơn đã đặt', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(358, 'cancel_order', 'đơn chưa giao có hủy được không', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(359, 'cancel_order', 'hủy sản phẩm đã đặt', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(360, 'cancel_order', 'cách hủy đơn hàng', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(361, 'cancel_order', 'xin hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(362, 'cancel_order', 'mình muốn hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(363, 'cancel_order', 'đơn này hủy được không', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(364, 'cancel_order', 'hủy đơn giúp mình', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(365, 'cancel_order', 'tôi cần hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(366, 'cancel_order', 'có thể hủy đơn không', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(367, 'cancel_order', 'làm sao để hủy đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(368, 'cancel_order', 'hủy đơn vừa đặt', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(369, 'cancel_order', 'hủy đơn chưa xác nhận', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(370, 'cancel_order', 'hủy đơn chưa giao', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(371, 'cancel_order', 'muốn bỏ đơn', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(372, 'cancel_order', 'xóa đơn hàng', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(373, 'cancel_order', 'không muốn nhận đơn nữa', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(374, 'cancel_order', 'hủy đơn đã mua', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(375, 'cancel_order', 'cách bỏ đơn hàng', 'Bạn vui lòng kiểm tra trạng thái đơn. Các đơn đã chuyển sang trạng thái giao hàng có thể không còn hủy được.', 1, '2026-09-15 14:53:41'),
(376, 'account', 'đăng nhập thế nào', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(377, 'account', 'không đăng nhập được', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(378, 'account', 'tôi không đăng nhập được', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(379, 'account', 'quên mật khẩu', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(380, 'account', 'đổi mật khẩu', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(381, 'account', 'tạo tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(382, 'account', 'đăng ký tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(383, 'account', 'đăng ký như thế nào', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(384, 'account', 'tài khoản của tôi', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(385, 'account', 'thông tin tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(386, 'account', 'chỉnh sửa tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(387, 'account', 'đổi thông tin cá nhân', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(388, 'account', 'đổi email', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(389, 'account', 'đổi số điện thoại', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(390, 'account', 'đăng xuất', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(391, 'account', 'tôi muốn đăng xuất', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(392, 'account', 'không vào được tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(393, 'account', 'cách đăng ký', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41');
INSERT INTO `chatbot_training` (`id`, `intent`, `question`, `reply`, `status`, `created_at`) VALUES
(394, 'account', 'cách đăng nhập', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(395, 'account', 'làm sao đổi mật khẩu', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(396, 'account', 'khôi phục tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(397, 'account', 'quên password', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(398, 'account', 'tài khoản bị khóa', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(399, 'account', 'sửa thông tin tài khoản', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(400, 'account', 'đăng ký thành viên', 'Bạn có thể đăng nhập, đăng ký và quản lý thông tin tài khoản tại khu vực tài khoản của TQS Store.', 1, '2026-09-15 14:53:41'),
(401, 'recommend', 'tư vấn laptop cho tôi', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(402, 'recommend', 'nên mua laptop nào', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(403, 'recommend', 'nên mua máy nào', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(404, 'recommend', 'tư vấn máy tính', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(405, 'recommend', 'gợi ý laptop cho mình', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(406, 'recommend', 'gợi ý máy cho mình', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(407, 'recommend', 'chọn laptop giúp mình', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(408, 'recommend', 'chọn máy giúp mình', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(409, 'recommend', 'máy nào đáng mua', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(410, 'recommend', 'laptop nào tốt', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(411, 'recommend', 'máy nào phù hợp', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(412, 'recommend', 'nên chọn máy nào', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(413, 'recommend', 'mình không biết chọn máy nào', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(414, 'recommend', 'tư vấn sản phẩm', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(415, 'recommend', 'gợi ý sản phẩm', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(416, 'recommend', 'giúp mình chọn laptop', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(417, 'recommend', 'cho mình lời khuyên', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(418, 'recommend', 'nên mua máy nào trong tầm giá', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(419, 'recommend', 'máy nào phù hợp với mình', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(420, 'recommend', 'gợi ý cho mình một laptop', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(421, 'recommend', 'tư vấn giúp mình một chiếc máy', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(422, 'recommend', 'máy nào đáng tiền', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(423, 'recommend', 'nên chọn hãng nào', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(424, 'recommend', 'gợi ý mẫu tốt', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(425, 'recommend', 'tư vấn máy phù hợp nhu cầu', 'Bạn cho mình biết ngân sách và nhu cầu như học tập, lập trình hoặc gaming, mình sẽ giúp bạn chọn sản phẩm phù hợp.', 1, '2026-09-15 14:53:41'),
(426, 'study', 'laptop học tập', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(427, 'study', 'laptop cho sinh viên', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(428, 'study', 'máy cho sinh viên', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(429, 'study', 'laptop để học', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(430, 'study', 'máy tính phục vụ học tập', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(431, 'study', 'laptop học lập trình', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(432, 'study', 'máy học lập trình', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(433, 'study', 'laptop cho công nghệ thông tin', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(434, 'study', 'máy cho ngành cntt', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(435, 'study', 'laptop code', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(436, 'study', 'máy chạy visual studio', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(437, 'study', 'máy chạy vscode', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(438, 'study', 'laptop học php', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(439, 'study', 'laptop học react', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(440, 'study', 'laptop cho sinh viên công nghệ thông tin', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(441, 'study', 'máy cho sinh viên cntt', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(442, 'study', 'laptop học web', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(443, 'study', 'máy để lập trình', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(444, 'study', 'laptop làm đồ án', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(445, 'study', 'máy học lập trình web', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(446, 'study', 'laptop cho sinh viên kỹ thuật', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(447, 'study', 'máy chạy visual studio code', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(448, 'study', 'laptop học javascript', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(449, 'study', 'máy học backend', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(450, 'study', 'laptop phục vụ học tập và lập trình', 'Với nhu cầu học tập/lập trình, bạn nên ưu tiên RAM, SSD và CPU phù hợp với ngân sách. Mình có thể lọc sản phẩm trực tiếp từ kho.', 1, '2026-09-15 14:53:41'),
(451, 'gaming', 'laptop gaming', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(452, 'gaming', 'máy gaming', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(453, 'gaming', 'laptop chơi game', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(454, 'gaming', 'máy chơi game', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(455, 'gaming', 'laptop game', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(456, 'gaming', 'máy chơi game tốt', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(457, 'gaming', 'laptop chơi valorant', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(458, 'gaming', 'laptop chơi pubg', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(459, 'gaming', 'laptop chơi gta', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(460, 'gaming', 'laptop chơi game tầm trung', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(461, 'gaming', 'laptop gaming giá rẻ', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(462, 'gaming', 'máy gaming dưới 20 triệu', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(463, 'gaming', 'laptop gaming dưới 25 triệu', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(464, 'gaming', 'tư vấn laptop gaming', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(465, 'gaming', 'gợi ý máy chơi game', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(466, 'gaming', 'laptop chiến game', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(467, 'gaming', 'máy gaming mạnh', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(468, 'gaming', 'laptop đồ họa và gaming', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(469, 'gaming', 'laptop chơi game online', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(470, 'gaming', 'máy chơi game fps', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(471, 'gaming', 'laptop gaming cho sinh viên', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(472, 'gaming', 'máy gaming tầm 20 triệu', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(473, 'gaming', 'laptop chơi game mượt', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(474, 'gaming', 'laptop card rời để chơi game', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(475, 'gaming', 'máy tính gaming', 'Với nhu cầu gaming, nên ưu tiên GPU, CPU, RAM và màn hình. Mình có thể lọc các mẫu gaming đang có trong kho.', 1, '2026-09-15 14:53:41'),
(476, 'performance', 'máy mạnh không', NULL, 1, '2026-09-15 14:53:41'),
(477, 'performance', 'laptop này mạnh không', NULL, 1, '2026-09-15 14:53:41'),
(478, 'performance', 'máy này chạy được không', NULL, 1, '2026-09-15 14:53:41'),
(479, 'performance', 'máy có mạnh không', NULL, 1, '2026-09-15 14:53:41'),
(480, 'performance', 'hiệu năng thế nào', NULL, 1, '2026-09-15 14:53:41'),
(481, 'performance', 'máy chạy nhanh không', NULL, 1, '2026-09-15 14:53:41'),
(482, 'performance', 'cấu hình có tốt không', NULL, 1, '2026-09-15 14:53:41'),
(483, 'performance', 'cấu hình máy', NULL, 1, '2026-09-15 14:53:41'),
(484, 'performance', 'thông số máy', NULL, 1, '2026-09-15 14:53:41'),
(485, 'performance', 'máy dùng chip gì', NULL, 1, '2026-09-15 14:53:41'),
(486, 'performance', 'ram bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(487, 'performance', 'ssd bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(488, 'performance', 'card màn hình gì', NULL, 1, '2026-09-15 14:53:41'),
(489, 'performance', 'gpu gì', NULL, 1, '2026-09-15 14:53:41'),
(490, 'performance', 'cpu gì', NULL, 1, '2026-09-15 14:53:41'),
(491, 'performance', 'màn hình bao nhiêu inch', NULL, 1, '2026-09-15 14:53:41'),
(492, 'performance', 'máy này dùng cpu nào', NULL, 1, '2026-09-15 14:53:41'),
(493, 'performance', 'máy có card rời không', NULL, 1, '2026-09-15 14:53:41'),
(494, 'performance', 'laptop có gpu rời không', NULL, 1, '2026-09-15 14:53:41'),
(495, 'performance', 'máy này bao nhiêu ram', NULL, 1, '2026-09-15 14:53:41'),
(496, 'performance', 'ổ cứng bao nhiêu', NULL, 1, '2026-09-15 14:53:41'),
(497, 'performance', 'hiệu năng laptop', NULL, 1, '2026-09-15 14:53:41'),
(498, 'performance', 'thông số kỹ thuật', NULL, 1, '2026-09-15 14:53:41'),
(499, 'performance', 'cấu hình laptop thế nào', NULL, 1, '2026-09-15 14:53:41'),
(500, 'performance', 'máy có mạnh để làm việc không', NULL, 1, '2026-09-15 14:53:41'),
(501, 'greeting', 'mình muốn hỏi một chút', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(502, 'greeting', 'bạn có online không', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(503, 'greeting', 'shop tư vấn giúp mình', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(504, 'greeting', 'xin chào chatbot', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(505, 'greeting', 'rất vui được gặp shop', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(506, 'greeting', 'cảm ơn bạn', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(507, 'greeting', 'thanks shop', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(508, 'greeting', 'ok cảm ơn', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(509, 'greeting', 'cảm ơn shop nhiều', 'Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.', 1, '2026-09-15 14:53:57'),
(510, 'cart', 'cách thêm vào giỏ hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(511, 'cart', 'mua sản phẩm', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(512, 'cart', 'cách đặt mua laptop', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(513, 'cart', 'làm sao thêm laptop vào giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(514, 'cart', 'bấm đâu để mua hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(515, 'cart', 'muốn mua máy thì làm gì', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(516, 'cart', 'đặt laptop như thế nào', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(517, 'cart', 'quy trình mua hàng', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(518, 'cart', 'cách chọn số lượng sản phẩm', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(519, 'cart', 'xem giỏ hàng ở đâu', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(520, 'cart', 'cập nhật số lượng trong giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(521, 'cart', 'làm sao bỏ sản phẩm trong giỏ', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(522, 'cart', 'đặt hàng online ra sao', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(523, 'cart', 'mua ngay sản phẩm', 'Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.', 1, '2026-09-15 14:53:57'),
(524, 'payment', 'shop thanh toán thế nào', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(525, 'payment', 'thanh toán bằng gì', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(526, 'payment', 'shop có hỗ trợ thanh toán online không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(527, 'payment', 'có thể chuyển khoản ngân hàng không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(528, 'payment', 'phương thức thanh toán gồm những gì', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(529, 'payment', 'thanh toán đơn hàng bằng cách nào', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(530, 'payment', 'mua hàng có được trả sau không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(531, 'payment', 'thông tin chuyển khoản ở đâu', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(532, 'payment', 'đơn chuyển khoản bao lâu được xác nhận', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(533, 'payment', 'thanh toán online như thế nào', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(534, 'payment', 'có trả góp không', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(535, 'payment', 'phí thanh toán là bao nhiêu', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(536, 'payment', 'thanh toán lúc nhận máy', 'Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.', 1, '2026-09-15 14:53:57'),
(537, 'shipping', 'phí ship', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(538, 'shipping', 'khi nào nhận được hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(539, 'shipping', 'shop giao hàng ở đâu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(540, 'shipping', 'shop có ship toàn quốc không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(541, 'shipping', 'mất bao lâu để giao laptop', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(542, 'shipping', 'bao giờ đơn hàng tới', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(543, 'shipping', 'đơn của tôi khi nào giao', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(544, 'shipping', 'phí giao hàng bao nhiêu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(545, 'shipping', 'cách theo dõi giao hàng', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(546, 'shipping', 'shop dùng đơn vị vận chuyển nào', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(547, 'shipping', 'có giao trong ngày không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(548, 'shipping', 'giao máy về tỉnh mất bao lâu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(549, 'shipping', 'thời gian nhận được laptop', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(550, 'shipping', 'sau khi đặt hàng bao lâu có máy', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(551, 'shipping', 'shop giao tận nhà không', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(552, 'shipping', 'đơn đang giao đến đâu', 'Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.', 1, '2026-09-15 14:53:57'),
(553, 'warranty', 'muốn đổi hàng', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(554, 'warranty', 'hoàn tiền như thế nào', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(555, 'warranty', 'hậu mãi của shop', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(556, 'warranty', 'laptop được bảo hành bao lâu', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(557, 'warranty', 'máy bị lỗi có được đổi không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(558, 'warranty', 'sản phẩm lỗi xử lý thế nào', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(559, 'warranty', 'điều kiện đổi trả là gì', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(560, 'warranty', 'muốn trả lại sản phẩm', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(561, 'warranty', 'làm sao yêu cầu bảo hành', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(562, 'warranty', 'shop có hỗ trợ sau khi mua không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(563, 'warranty', 'laptop hỏng thì liên hệ ai', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(564, 'warranty', 'có được hoàn tiền không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(565, 'warranty', 'chính sách bảo hành của cửa hàng', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(566, 'warranty', 'đổi máy mới như thế nào', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(567, 'warranty', 'bảo hành có mất phí không', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(568, 'warranty', 'sản phẩm không đúng mô tả thì sao', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(569, 'warranty', 'hỗ trợ kỹ thuật laptop', 'Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.', 1, '2026-09-15 14:53:57'),
(570, 'contact', 'email của shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(571, 'contact', 'liên hệ với shop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(572, 'contact', 'cửa hàng nằm ở đâu', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(573, 'contact', 'cho xin hotline', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(574, 'contact', 'số điện thoại tư vấn', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(575, 'contact', 'email liên hệ', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(576, 'contact', 'làm sao liên hệ cửa hàng', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(577, 'contact', 'shop làm việc ngày nào', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(578, 'contact', 'có thể đến mua trực tiếp không', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(579, 'contact', 'địa chỉ mua laptop', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(580, 'contact', 'liên hệ hỗ trợ khách hàng', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(581, 'contact', 'cho mình xin thông tin cửa hàng', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(582, 'contact', 'tqs store ở tỉnh nào', 'TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.', 1, '2026-09-15 14:53:57'),
(583, 'installment', 'shop có hỗ trợ trả góp không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(584, 'installment', 'có trả góp laptop không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(585, 'installment', 'mua laptop trả góp được không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(586, 'installment', 'shop có trả góp 0 phần trăm không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(587, 'installment', 'có hỗ trợ trả góp 0% không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(588, 'installment', 'thủ tục trả góp cần gì', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(589, 'installment', 'trả góp cần giấy tờ gì', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(590, 'installment', 'mua máy trả góp cần những gì', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(591, 'installment', 'trả góp laptop cần hồ sơ gì', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(592, 'installment', 'trả góp trong bao lâu', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(593, 'installment', 'có thể trả góp trong 6 tháng không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(594, 'installment', 'có trả góp 12 tháng không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(595, 'installment', 'trả góp qua ngân hàng nào', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(596, 'installment', 'shop hỗ trợ trả góp ngân hàng nào', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(597, 'installment', 'có trả trước bao nhiêu phần trăm', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(598, 'installment', 'mua laptop trả góp cần trả trước bao nhiêu', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(599, 'installment', 'phí trả góp là bao nhiêu', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(600, 'installment', 'lãi suất trả góp thế nào', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(601, 'installment', 'trả góp có lãi không', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(602, 'installment', 'trả góp 0% áp dụng cho máy nào', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(603, 'installment', 'laptop nào được trả góp', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(604, 'installment', 'sản phẩm nào hỗ trợ trả góp', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(605, 'installment', 'mình muốn mua máy theo hình thức trả góp', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(606, 'installment', 'tư vấn trả góp laptop', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(607, 'installment', 'điều kiện để mua laptop trả góp', 'Shop có thể tư vấn hình thức trả góp theo sản phẩm và điều kiện hiện hành. Bạn cho mình biết mẫu laptop hoặc ngân sách để kiểm tra thêm.', 1, '2026-09-15 15:04:50'),
(608, 'promotion', 'shop có khuyến mãi gì không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(609, 'promotion', 'hiện tại shop có khuyến mãi không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(610, 'promotion', 'có chương trình giảm giá không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(611, 'promotion', 'có mã giảm giá không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(612, 'promotion', 'shop có voucher không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(613, 'promotion', 'mua laptop có được giảm giá không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(614, 'promotion', 'mua máy được tặng gì', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(615, 'promotion', 'mua laptop có quà tặng không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(616, 'promotion', 'shop đang có ưu đãi gì', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(617, 'promotion', 'có deal laptop nào không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(618, 'promotion', 'có chương trình ưu đãi nào', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(619, 'promotion', 'mua máy có được tặng phụ kiện không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(620, 'promotion', 'có khuyến mãi cho sinh viên không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(621, 'promotion', 'shop có sale không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(622, 'promotion', 'laptop nào đang giảm giá', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(623, 'promotion', 'có mã voucher cho laptop không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(624, 'promotion', 'có coupon giảm giá không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(625, 'promotion', 'đợt này có sale máy tính không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(626, 'promotion', 'shop có quà khi mua laptop không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(627, 'promotion', 'mua máy được tặng chuột không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(628, 'promotion', 'mua laptop có tặng balo không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(629, 'promotion', 'có ưu đãi đặc biệt không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(630, 'promotion', 'giá khuyến mãi hiện tại là bao nhiêu', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(631, 'promotion', 'shop đang chạy chương trình gì', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(632, 'promotion', 'có ưu đãi khi mua nhiều sản phẩm không', 'Bạn có thể hỏi tên sản phẩm hoặc mẫu laptop cụ thể để mình kiểm tra ưu đãi, voucher hoặc quà tặng đang áp dụng.', 1, '2026-09-15 15:04:50'),
(633, 'service_upgrade', 'shop có nâng cấp ram không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(634, 'service_upgrade', 'shop có nâng cấp ssd không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(635, 'service_upgrade', 'có hỗ trợ nâng cấp ram tại chỗ không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(636, 'service_upgrade', 'có hỗ trợ nâng cấp ssd tại chỗ không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(637, 'service_upgrade', 'shop có lắp ram cho laptop không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(638, 'service_upgrade', 'shop có thay ssd không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(639, 'service_upgrade', 'nâng cấp ram bao nhiêu tiền', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(640, 'service_upgrade', 'nâng cấp ssd bao nhiêu tiền', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(641, 'service_upgrade', 'có cài win không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(642, 'service_upgrade', 'shop có cài windows không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(643, 'service_upgrade', 'có cài office không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(644, 'service_upgrade', 'có hỗ trợ cài phần mềm không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(645, 'service_upgrade', 'shop có cài driver không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(646, 'service_upgrade', 'có vệ sinh laptop không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(647, 'service_upgrade', 'shop có vệ sinh máy không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(648, 'service_upgrade', 'có thay keo tản nhiệt không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(649, 'service_upgrade', 'shop có nâng cấp laptop không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(650, 'service_upgrade', 'mua máy có hỗ trợ cài win không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(651, 'service_upgrade', 'mua laptop có được cài office không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(652, 'service_upgrade', 'có hỗ trợ chuyển dữ liệu sang ssd mới không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(653, 'service_upgrade', 'shop có thay ổ cứng không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(654, 'service_upgrade', 'có nâng ram lên 16gb được không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(655, 'service_upgrade', 'có nâng ssd lên 1tb được không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(656, 'service_upgrade', 'dịch vụ nâng cấp máy tính có những gì', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(657, 'service_upgrade', 'shop có hỗ trợ kỹ thuật tại cửa hàng không', 'Shop có thể hỗ trợ tư vấn nâng cấp RAM, SSD và một số dịch vụ phần mềm. Bạn cho mình biết mẫu máy hoặc hạng mục cần nâng cấp.', 1, '2026-09-15 15:04:50'),
(658, 'showroom', 'có thể đến cửa hàng xem máy trực tiếp không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(659, 'showroom', 'shop có showroom không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(660, 'showroom', 'có được xem laptop trực tiếp không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(661, 'showroom', 'mình muốn xem máy tại cửa hàng', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50');
INSERT INTO `chatbot_training` (`id`, `intent`, `question`, `reply`, `status`, `created_at`) VALUES
(662, 'showroom', 'có thể trải nghiệm máy tại shop không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(663, 'showroom', 'shop có cho test laptop không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(664, 'showroom', 'đến cửa hàng có được test máy không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(665, 'showroom', 'có thể xem nhiều mẫu laptop trực tiếp không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(666, 'showroom', 'địa điểm nào để xem máy', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(667, 'showroom', 'mình muốn đến shop xem máy', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(668, 'showroom', 'có phòng trưng bày laptop không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(669, 'showroom', 'shop có máy mẫu để xem không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(670, 'showroom', 'có thể trải nghiệm laptop trước khi mua không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(671, 'showroom', 'đến cửa hàng có nhân viên tư vấn không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(672, 'showroom', 'shop có cho kiểm tra máy trực tiếp không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(673, 'showroom', 'có được mở máy kiểm tra trước khi mua không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(674, 'showroom', 'mình muốn xem cấu hình trực tiếp tại shop', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(675, 'showroom', 'cửa hàng có trưng bày máy không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(676, 'showroom', 'có thể tới shop để chọn máy không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(677, 'showroom', 'shop có chỗ trải nghiệm laptop không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(678, 'showroom', 'có thể xem máy ngoài đời không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(679, 'showroom', 'muốn xem máy thật thì đến đâu', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(680, 'showroom', 'cửa hàng có cho khách test máy không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(681, 'showroom', 'mình có thể ghé shop xem laptop không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(682, 'showroom', 'shop có cho xem sản phẩm trực tiếp không', 'Bạn có thể đến cửa hàng để xem và kiểm tra sản phẩm trực tiếp. Mình có thể cung cấp thông tin địa chỉ cửa hàng.', 1, '2026-09-15 15:04:50'),
(683, 'fallback', 'hôm nay trời đẹp không', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(684, 'fallback', 'thời tiết hôm nay thế nào', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(685, 'fallback', 'hôm nay là thứ mấy', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(686, 'fallback', 'bạn ăn cơm chưa', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(687, 'fallback', 'shop ăn cơm chưa', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(688, 'fallback', 'bạn đang làm gì', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(689, 'fallback', 'kể cho tôi một câu chuyện', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(690, 'fallback', 'hãy kể chuyện cười', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(691, 'fallback', 'ai là người giàu nhất thế giới', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(692, 'fallback', 'cho tôi một bài hát', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(693, 'fallback', 'bạn thích màu gì', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(694, 'fallback', 'bạn bao nhiêu tuổi', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(695, 'fallback', 'mai có mưa không', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(696, 'fallback', 'thời tiết ở hà nội hôm nay', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(697, 'fallback', 'thời tiết sài gòn hôm nay', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(698, 'fallback', 'chúc bạn ngủ ngon', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(699, 'fallback', 'chúc shop một ngày tốt lành', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(700, 'fallback', 'bạn có người yêu chưa', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(701, 'fallback', 'kể chuyện vui đi', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(702, 'fallback', 'nói một câu đùa', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(703, 'fallback', 'cho tôi công thức nấu ăn', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(704, 'fallback', 'giúp tôi làm bài toán', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(705, 'fallback', 'viết một bài thơ', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(706, 'fallback', 'dịch câu này sang tiếng anh', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50'),
(707, 'fallback', 'ai phát minh ra internet', 'Mình chuyên hỗ trợ các vấn đề liên quan đến TQS Store như laptop, giá, sản phẩm, thanh toán, giao hàng, bảo hành và đơn hàng. Bạn hỏi mình về sản phẩm nhé.', 1, '2026-09-15 15:04:50');

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
('CART1763178361', 'AC02', 2, 17990000),
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
('DH1551', 'AC02', 1, 17990000),
('DH2076', 'MS02', 7, 36990000),
('DH3343', 'AC02', 1, 17990000),
('DH4138', 'MS02', 7, 36990000),
('DH5352', 'MS02', 1, 36990000),
('DH6982', 'MS02', 1, 36990000),
('DH7173', 'AC02', 1, 17990000),
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
  `GhiChu` varchar(255) DEFAULT NULL,
  `LoaiDiaChi` char(20) NOT NULL DEFAULT 'Khac'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diachi`
--

INSERT INTO `diachi` (`MaKH`, `DiaChiGiaoHang`, `ChiTietDiaChi`, `ThanhPho`, `QuanHuyen`, `PhuongXa`, `GhiChu`, `LoaiDiaChi`) VALUES
('KH24859', 'Nha', 'nqwgal;', 'ằnlfjna', 'fanwlfn', 'ằl;jna', NULL, 'Khac'),
('KH24859', 'Nha', 'anglaj', 'àblasjbf', 'fnlasbjf', 'flajbf', NULL, 'Nha rieng');

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
('DH1551', 'KH24859', '2026-09-14', 17990000, 'Cho xac nhan'),
('DH2076', 'KH24859', '2026-09-14', 258930000, 'huy'),
('DH3343', 'KH24859', '2026-09-14', 17990000, 'Cho xac nhan'),
('DH4138', 'KH24859', '2025-11-15', 258930000, 'Cho xac nhan'),
('DH5352', 'KH24859', '2025-11-15', 36990000, 'Cho xac nhan'),
('DH6982', 'KH24859', '2026-09-14', 36990000, 'Cho xac nhan'),
('DH7173', 'KH24859', '2026-09-14', 17990000, 'Cho xac nhan'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('TT1248', 'DH6982', 'Tien mat', '2026-09-14 12:23:51', 'Chua Thanh Toan'),
('TT1723', 'DH7173', 'Chuyen khoan', '2026-09-14 12:34:35', 'Chua Thanh Toan'),
('TT1854', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT1937', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT2243', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT3304', 'DH4138', '', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT4139', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT426', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT427', 'DH1551', 'Tien mat', '2026-09-14 12:13:25', 'Chua Thanh Toan'),
('TT5064', 'DH3343', 'Tien mat', '2026-09-14 12:37:58', 'Chua Thanh Toan'),
('TT5464', 'DH4138', 'Chuyen khoan', '2025-11-15 05:41:52', 'Chua Thanh Toan'),
('TT6844', 'DH2076', 'Tien mat', '2026-09-14 12:04:48', 'Chua Thanh Toan'),
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
('KH74616', 'quan', 'leminhquan9a7@gmail.com', '202cb962ac59075b964b07152d234b70'),
('KH9747', 'Quan Le', 'abc@gmail.com', '202cb962ac59075b964b07152d234b70');

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
-- Chỉ mục cho bảng `chatbot_training`
--
ALTER TABLE `chatbot_training`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`MaKH`,`LoaiDiaChi`);

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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chatbot_training`
--
CREATE TABLE IF NOT EXISTS `chatbot_conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(128) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `chat_mode` enum('bot','pending_admin','human_active') NOT NULL DEFAULT 'bot',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_chat_session` (`session_id`),
  KEY `idx_chat_mode` (`chat_mode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `chatbot_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `sender` enum('customer','bot','admin') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_chat_messages_conversation` (`conversation_id`,`id`),
  CONSTRAINT `fk_chat_messages_conversation` FOREIGN KEY (`conversation_id`)
    REFERENCES `chatbot_conversations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

UPDATE `chatbot_training` SET `reply` = 'TQS Store đang có các thương hiệu Acer, ASUS, Dell, HP, Lenovo, MSI và MacBook. Bạn muốn xem sản phẩm theo hãng nào?' WHERE `intent` = 'brand' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'TQS Store hiện có nhiều mẫu laptop. Bạn hãy cho biết hãng, tên máy hoặc mức giá để mình tìm sản phẩm phù hợp.' WHERE `intent` = 'product' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Bạn hãy gửi tên sản phẩm hoặc khoảng giá cần tìm, ví dụ: laptop dưới 20 triệu. Mình sẽ kiểm tra giá trong danh sách sản phẩm.' WHERE `intent` = 'price' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Mình sẽ tìm các laptop có giá không vượt quá mức ngân sách bạn nêu. Bạn có thể hỏi cụ thể như laptop dưới 20 triệu.' WHERE `intent` = 'price_under' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Mình sẽ tìm laptop trong khoảng giá bạn yêu cầu. Bạn có thể nêu rõ mức thấp và mức cao, ví dụ từ 15 đến 25 triệu.' WHERE `intent` = 'price_range' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Mình sẽ tìm các laptop có giá từ mức bạn yêu cầu trở lên. Bạn có thể hỏi theo mẫu laptop trên 20 triệu.' WHERE `intent` = 'price_over' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Mình sẽ kiểm tra số lượng tồn kho trong danh sách sản phẩm. Bạn hãy gửi tên hoặc mã sản phẩm cần kiểm tra.' WHERE `intent` = 'stock' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Bạn cần đăng nhập để xem trạng thái và lịch sử đơn hàng. Sau khi đăng nhập, mở mục Đơn hàng để theo dõi.' WHERE `intent` = 'order' AND `reply` IS NULL;
UPDATE `chatbot_training` SET `reply` = 'Bạn hãy gửi tên hoặc mã laptop cần tư vấn. Mình sẽ giúp bạn đánh giá hiệu năng theo nhu cầu học tập, văn phòng hoặc gaming.' WHERE `intent` = 'performance' AND `reply` IS NULL;
ALTER TABLE `chatbot_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=708;

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
