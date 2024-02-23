-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th2 23, 2024 lúc 07:55 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `projectphp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company`
--

CREATE TABLE `company` (
  `id` int NOT NULL,
  `company_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `master_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `company`
--

INSERT INTO `company` (`id`, `company_name`, `master_user_id`) VALUES
(1, 'Công ty Giao hàng xuyên quốc gia', 1),
(22, 'TESTCOMPANY', 46);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `shipper_id` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `company_id`, `shipper_id`, `description`, `latitude`, `longitude`, `address`, `is_completed`, `created_at`, `completed_at`) VALUES
(12, 1, 8, 'Chuyển hàng đến Đà Nẵng Beach', 16.0479, 108.2062, 'Bãi biển Mỹ Khê, Đà Nẵng, Việt Nam', 1, '2024-01-22 00:08:29', '2022-01-01 12:00:00'),
(13, 1, 8, 'Giao hàng đến Tháp Po Nagar, Nha Trang', 12.2631, 109.2029, 'Tháp Po Nagar, Nha Trang, Việt Nam', 1, '2024-01-22 00:08:29', NULL),
(14, 1, 8, 'Chuyển hàng đến Phố Cổ Hội An', 15.8801, 108.338, 'Phố Cổ Hội An, Quảng Nam, Việt Nam', 1, '2024-01-22 00:08:29', NULL),
(15, 1, 8, 'Giao hàng tới Vịnh Hạ Long', 20.9101, 107.1839, 'Vịnh Hạ Long, Quảng Ninh, Việt Nam', 1, '2024-01-22 00:08:29', '2024-02-21 19:22:27'),
(16, 1, 8, 'Chuyển hàng đến Sài Gòn Notre-Dame Basilica', 10.7799, 106.7009, 'Nhà thờ Đức Bà, TP.Hồ Chí Minh, Việt Nam', 1, '2024-01-22 00:08:29', '2024-02-21 19:23:29'),
(17, 1, 4, 'Thử chỉnh sửa', 22.3352, 103.7758, 'Đỉnh Fansipan, Sa Pa, Lào Cai, Việt Nam', 1, '2024-01-22 00:08:29', '2024-02-21 19:25:16'),
(18, 1, 8, 'Chuyển hàng đến Mũi Né Sand Dunes', 10.9782, 108.371, 'Cồn cát Mũi Né, Phan Thiết, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(19, 1, 8, 'Giao hàng đến Đồng Hới Citadel', 17.4724, 106.6041, 'Quảng Trị, Đồng Hới, Quảng Bình, Việt Nam', 1, '2024-01-22 00:08:29', '2024-02-21 19:31:02'),
(20, 1, 8, 'Chuyển hàng tới Cầu Rồng, Đà Nẵng', 16.0678, 108.2218, 'Cầu Rồng, Đà Nẵng, Việt Nam', 1, '2024-01-22 00:08:29', '2024-02-21 19:31:04'),
(21, 1, 5, 'Giao hàng tới Hồ Gươm, Hà Nội', 21.0285, 105.8542, 'Hồ Gươm, Hoàn Kiếm, Hà Nội, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(22, 1, 5, 'Chuyển hàng đến Đà Nẵng Beach', 16.0479, 108.2062, 'Bãi biển Mỹ Khê, Đà Nẵng, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(23, 1, 5, 'Giao hàng đến Tháp Po Nagar, Nha Trang', 12.2631, 109.2029, 'Tháp Po Nagar, Nha Trang, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(24, 1, 5, 'Chuyển hàng đến Phố Cổ Hội An', 15.8801, 108.338, 'Phố Cổ Hội An, Quảng Nam, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(25, 1, 5, 'Giao hàng tới Vịnh Hạ Long', 20.9101, 107.1839, 'Vịnh Hạ Long, Quảng Ninh, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(26, 1, 5, 'Chuyển hàng đến Sài Gòn Notre-Dame Basilica', 10.7799, 106.7009, 'Nhà thờ Đức Bà, TP.Hồ Chí Minh, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(27, 1, 5, 'Giao hàng tới Đỉnh Fansipan, Lào Cai', 22.3352, 103.7758, 'Đỉnh Fansipan, Sa Pa, Lào Cai, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(28, 1, 5, 'Chuyển hàng đến Mũi Né Sand Dunes', 10.9782, 108.371, 'Cồn cát Mũi Né, Phan Thiết, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(29, 1, 5, 'Giao hàng đến Đồng Hới Citadel', 17.4724, 106.6041, 'Quảng Trị, Đồng Hới, Quảng Bình, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(30, 1, 5, 'Chuyển hàng tới Cầu Rồng, Đà Nẵng', 16.0678, 108.2218, 'Cầu Rồng, Đà Nẵng, Việt Nam', 0, '2024-01-22 00:08:29', NULL),
(31, 1, 8, 'Giao hàng tới bệnh viện rồi đi nhậu', 20.9603507, 106.5041432, 'bệnh viện, Quốc lộ 17B, Phú Thái, Kim Thành, Hải Dương, Việt Nam', 0, '2024-02-02 04:03:39', NULL),
(32, 1, 8, 'Giao tới bệnh viện vô khám luôn, clm mệt quá', 10.764475950000001, 106.60320512261713, 'Bệnh viện Bình Tân, 809, Hương Lộ 2, Phường Bình Trị Đông A, Quận Bình Tân, Thành phố Hồ Chí Minh, 30000, Việt Nam', 0, '2024-02-02 04:21:00', NULL),
(98, 1, 4, 'con cặc', 10.8036941, 106.6358587, 'Trường Chinh, Phường 13, Quận Tân Bình, Thành phố Hồ Chí Minh, 72011, Việt Nam', 0, '2024-02-22 02:29:31', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'master'),
(2, 'manager'),
(3, 'shipper');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL DEFAULT '3',
  `fullname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_id` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `fullname`, `company_id`, `create_at`, `hash_password`, `active`) VALUES
(1, 'Alice', 'alice@gmail.com', 'Alice123', 1, 'Alice Border', 1, '2024-01-13 00:50:56', '$2y$10$gp9F6WVLydLlFuk61jLIveS9D3bPtHMN7ksHFEBOzlQff0Kc1bD1.', 1),
(2, 'Bob', 'bob@gmail.com\r\n', 'Bob123', 2, 'Bob Twena', 1, '2024-01-13 00:50:56', '$2y$10$X7wunNTArun1dBMelPLr3eVXpvLu7HCvJGPyxKqOJtZdH1QhsFima', 1),
(3, 'Cobber', 'cobber@gmail.com', 'Cobber123', 2, 'Cobber Stone', 1, '2024-01-13 00:50:56', '$2y$10$tGUA.UzBsnsZhf4NfM7cHOrkuTJLZqXjB0F7qtOkVxR/bM9Pq.j8m', 1),
(4, 'Dyan', 'dyan@gmail.com', 'Dyan123', 3, 'Dyan Lain', 1, '2024-01-13 00:50:56', '$2y$10$A5oXXrh77KxqXJSMXMpz6u5J.dxEejLe2fAu1rEAdxZkOg5vVVX4u', 0),
(5, 'Emily', 'emily@gmail.com', 'Emily123', 3, 'Emily Absen', 1, '2024-01-13 00:50:56', '$2y$10$IGBEdUtBZGunI3MBa7RNeeHqi02cShfudc8QJzP6UZoKsTByS.glK', 1),
(8, 'giadeptrai', 'giadeptrai@gmail.com', 'gia18112004', 3, 'Khưu Thành Gia', 1, '2024-01-17 05:06:47', '$2y$10$wu.rQxGQB49x4Ogvw8Es4.oWmDeGj186LFS1iDBz5X3UQ7juS17ci', 1),
(30, 'testmvc', NULL, 'echo \"<br>\";', 3, 'testmvc', 1, '2024-01-27 06:23:02', '$2y$10$K9BhD0qnjYOVvi6J65hCXOpdo2U5bbfCFCndhHYpOi8efTw26FnIS', 1),
(43, 'testmvc2', NULL, '12345678', 3, 'testmvc', 1, '2024-02-21 04:18:30', '$2y$10$HU1Sy1We9H8ZP9lWjqSmz.jTENuanou/XPIxTCb.W.lDq2wzzjMFW', 1),
(46, 'TESTCOMPANY', NULL, 'newUserId', 1, 'TESTCOMPANY', 22, '2024-02-21 05:30:22', '$2y$10$KJgBxFWt.f8Kr.LWPx0jtu6pkXa5NeiTS7if2WhnHT4mliqei3GTq', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `verify`
--

CREATE TABLE `verify` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `expires` datetime NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_master_user` (`master_user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_shipper` (`shipper_id`),
  ADD KEY `fk_order_company` (`company_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_user_role` (`role_id`),
  ADD KEY `fk_user_company` (`company_id`);

--
-- Chỉ mục cho bảng `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_company_master_user` FOREIGN KEY (`master_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_order_shipper` FOREIGN KEY (`shipper_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
