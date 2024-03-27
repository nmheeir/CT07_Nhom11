-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th3 27, 2024 lúc 03:26 AM
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
-- Cơ sở dữ liệu: `db_ct07`
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
(23, 'Công ty vận chuyển đơn hàng của bạn', 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `complain`
--

CREATE TABLE `complain` (
  `id` int NOT NULL,
  `type` int NOT NULL,
  `company_id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `complain_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `complain`
--

INSERT INTO `complain` (`id`, `type`, `company_id`, `username`, `content`, `complain_time`) VALUES
(16, 2, 23, 'giadeptrai', 'giao nham hang roi', '2024-03-11 14:23:06'),
(29, 1, 1, 'giadeptrai', 'Dịch vụ kém chất lượng trên website', '2024-03-21 10:15:59'),
(30, 2, 1, 'giadeptrai', 'Sản phẩm không đúng mẫu mã quảng cáo trong đơn hàng', '2024-03-21 10:15:59'),
(31, 1, 1, 'giadeptrai', 'Giao hàng chậm trễ trên website', '2024-03-21 10:15:59'),
(32, 3, 1, 'giadeptrai', 'Dịch vụ bị hỏng khi nhận', '2024-03-21 10:15:59'),
(33, 2, 1, 'giadeptrai', 'Không có phản hồi từ bộ phận hỗ trợ trong đơn hàng', '2024-03-21 10:15:59'),
(34, 1, 1, 'giadeptrai', 'Đóng gói sản phẩm kém chắc chắn trên website', '2024-03-21 10:15:59'),
(35, 3, 1, 'giadeptrai', 'Giao hàng không đúng địa chỉ', '2024-03-21 10:15:59'),
(36, 2, 1, 'giadeptrai', 'Sản phẩm không tương thích với thiết bị trong đơn hàng', '2024-03-21 10:15:59'),
(37, 1, 1, 'giadeptrai', 'Dịch vụ khách hàng không hài lòng trên website', '2024-03-21 10:15:59'),
(38, 3, 1, 'giadeptrai', 'Sản phẩm không đúng mô tả', '2024-03-21 10:15:59'),
(39, 2, 1, 'giadeptrai', 'kkuhkhkhkhkh', '2024-03-21 11:12:19'),
(41, 1, 1, 'giadeptrai', 'không có vấn đề gì', '2024-03-27 10:12:38');

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
  `is_completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` timestamp NULL DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `company_id`, `shipper_id`, `description`, `latitude`, `longitude`, `address`, `is_completed`, `created_at`, `completed_at`, `deadline`) VALUES
(118, 1, 8, 'Thửu deadline', 10.7773145, 106.6999907, 'Quận 1, Thành phố Hồ Chí Minh, Việt Nam', 1, '2024-03-02 07:17:10', '2024-03-06 11:21:57', '1970-01-01 01:00:00'),
(122, 1, 8, 'Thử dead', 10.7703708, 106.5996353, 'Quận Bình Tân, Thành phố Hồ Chí Minh, 71914, Việt Nam', 1, '2024-03-02 07:21:27', '2024-03-09 17:26:17', '1970-01-01 01:00:00'),
(123, 1, 8, 'Order 90', 20.670071056271038, 105.67800790367463, 'Can Tho, Vietnam', 1, '2024-03-03 13:22:28', '2024-03-09 17:36:30', '1970-01-01 01:00:00'),
(124, 1, 8, 'Order 91', 20.39863876104228, 105.70293681063032, 'Can Tho, Vietnam', 1, '2024-02-14 13:22:28', '2024-03-11 02:13:39', '1970-01-01 01:00:00'),
(125, 1, 8, 'Order 92', 20.29918476128875, 105.42873544658417, 'Can Tho, Vietnam', 1, '2024-02-25 13:22:28', '2024-03-11 02:13:39', '1970-01-01 01:00:00'),
(126, 1, 8, 'Order 93', 21.171536752182558, 105.31954583508852, 'Can Tho, Vietnam', 1, '2024-02-24 13:22:28', '2024-03-11 02:13:40', '1970-01-01 01:00:00'),
(127, 1, 8, 'Order 94', 20.144954017032827, 106.48781374468264, 'Can Tho, Vietnam', 1, '2024-02-12 13:22:28', '2024-03-11 14:07:10', '1970-01-01 01:00:00'),
(128, 1, 8, 'Order 95', 20.964831450921327, 105.39736602259555, 'Can Tho, Vietnam', 1, '2024-02-07 13:22:28', '2024-03-11 14:07:21', '1970-01-01 01:00:00'),
(129, 1, 8, 'Order 96', 21.272760011044106, 106.61831469658605, 'Can Tho, Vietnam', 1, '2024-02-12 13:22:28', '2024-03-11 14:07:27', '1970-01-01 01:00:00'),
(130, 1, 8, 'Order 97', 20.77035410587709, 106.23629711217833, 'Can Tho, Vietnam', 1, '2024-02-05 13:22:28', '2024-03-13 08:24:37', '1970-01-01 01:00:00'),
(131, 1, 8, 'Order 98', 20.263810569200487, 105.20927616181716, 'Can Tho, Vietnam', 0, '2024-02-06 13:22:28', NULL, '2024-03-12 08:24:57'),
(132, 1, 8, 'Order 99', 20.305287074581987, 105.8620749119316, 'Can Tho, Vietnam', 1, '2024-02-29 13:22:28', '2024-03-14 13:26:22', '1970-01-01 01:00:00'),
(133, 1, 8, 'Thử đổi order 1', 10.7563816, 106.5916968, 'Tỉnh lộ 10, Phường Tân Tạo A, Quận Bình Tân, Thành phố Hồ Chí Minh, 73118, Việt Nam', 0, '2024-03-03 13:22:28', NULL, '2024-03-27 00:00:00'),
(134, 1, 8, 'Order 81', 20.263891013119267, 106.96722784029993, 'Can Tho, Vietnam', 0, '2024-02-20 13:22:28', NULL, NULL),
(135, 1, 8, 'Order 82', 21.00904257177286, 105.35863553672903, 'Can Tho, Vietnam', 0, '2024-02-12 13:22:28', NULL, NULL),
(136, 1, 8, 'Order 83', 20.098350784832938, 105.57569524559723, 'Can Tho, Vietnam', 0, '2024-02-04 13:22:28', NULL, NULL),
(137, 1, 8, 'Order 84', 20.123915745992136, 106.37246415146856, 'Can Tho, Vietnam', 0, '2024-02-18 13:22:28', NULL, NULL),
(138, 1, 8, 'Order 85', 21.257790886105774, 106.75336448173351, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(139, 1, 8, 'Order 86', 21.27754814389865, 105.71263044440433, 'Can Tho, Vietnam', 0, '2024-02-06 13:22:28', NULL, NULL),
(140, 1, 8, 'Order 87', 20.743499984260183, 107.1695985409148, 'Can Tho, Vietnam', 0, '2024-02-07 13:22:28', NULL, NULL),
(141, 1, 8, 'Order 88', 20.986201252775455, 106.82686526964126, 'Can Tho, Vietnam', 0, '2024-02-12 13:22:28', NULL, NULL),
(142, 1, 8, 'Order 89', 20.321603044235708, 105.0700649619755, 'Can Tho, Vietnam', 0, '2024-02-18 13:22:28', NULL, NULL),
(143, 1, 8, 'Order 70', 20.600812111143778, 106.27983867309973, 'Can Tho, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(144, 1, 8, 'Order 71', 20.381689094362493, 105.49534387001334, 'Can Tho, Vietnam', 0, '2024-02-26 13:22:28', NULL, NULL),
(145, 1, 8, 'Order 72', 20.813202945341544, 105.07186942274856, 'Can Tho, Vietnam', 0, '2024-02-17 13:22:28', NULL, NULL),
(146, 1, 8, 'Order 73', 20.750632476760664, 107.3752733248987, 'Can Tho, Vietnam', 0, '2024-02-25 13:22:28', NULL, NULL),
(147, 1, 8, 'Order 74', 20.594121013855673, 105.58139557305853, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(148, 1, 8, 'Order 75', 20.26260663314034, 107.37927006779171, 'Can Tho, Vietnam', 0, '2024-02-26 13:22:28', NULL, NULL),
(149, 1, 8, 'Order 76', 20.467265674348237, 107.14392894612992, 'Can Tho, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(150, 1, 8, 'Order 77', 20.290877250294088, 107.27402785539071, 'Can Tho, Vietnam', 0, '2024-02-04 13:22:28', NULL, NULL),
(151, 1, 8, 'Order 78', 20.15400921334886, 106.53615088112294, 'Can Tho, Vietnam', 0, '2024-02-10 13:22:28', NULL, NULL),
(152, 1, 8, 'Order 79', 21.4670537071927, 106.49332238965977, 'Can Tho, Vietnam', 0, '2024-03-02 13:22:28', NULL, NULL),
(153, 1, 8, 'Order 60', 20.706050212221268, 105.48972137783628, 'Can Tho, Vietnam', 0, '2024-02-15 13:22:28', NULL, NULL),
(154, 1, 8, 'Order 61', 20.37356928072271, 106.35800970146248, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(155, 1, 8, 'Order 62', 20.3221891250668, 105.418302910792, 'Can Tho, Vietnam', 0, '2024-02-27 13:22:28', NULL, NULL),
(156, 1, 8, 'Order 63', 20.688761823055113, 106.79797491924649, 'Can Tho, Vietnam', 0, '2024-02-26 13:22:28', NULL, NULL),
(157, 1, 8, 'Order 64', 21.401841864829734, 105.04381894370897, 'Can Tho, Vietnam', 0, '2024-02-24 13:22:28', NULL, NULL),
(158, 1, 8, 'Order 65', 20.550782361115125, 107.46019667243603, 'Can Tho, Vietnam', 0, '2024-02-08 13:22:28', NULL, NULL),
(159, 1, 8, 'Order 66', 20.212860936031547, 105.6326263101144, 'Can Tho, Vietnam', 0, '2024-02-07 13:22:28', NULL, NULL),
(160, 1, 8, 'Order 67', 20.657753529639685, 106.68479864875302, 'Can Tho, Vietnam', 0, '2024-03-02 13:22:28', NULL, NULL),
(161, 1, 8, 'Order 68', 20.37303949554734, 105.2029855225263, 'Can Tho, Vietnam', 0, '2024-02-13 13:22:28', NULL, NULL),
(162, 1, 8, 'Order 69', 20.08381674073992, 105.74928228114665, 'Can Tho, Vietnam', 0, '2024-02-23 13:22:28', NULL, NULL),
(163, 1, 8, 'Order 50', 21.133275276639754, 106.96197737889548, 'Can Tho, Vietnam', 0, '2024-02-13 13:22:28', NULL, NULL),
(164, 1, 8, 'Order 51', 21.39897252842688, 106.72757271605317, 'Can Tho, Vietnam', 0, '2024-02-13 13:22:28', NULL, NULL),
(165, 1, 8, 'Order 52', 20.319372202101512, 105.23243204944994, 'Can Tho, Vietnam', 0, '2024-02-08 13:22:28', NULL, NULL),
(166, 1, 8, 'Order 53', 21.2775202978193, 106.95010461793291, 'Can Tho, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(167, 1, 8, 'Order 54', 20.578576766027673, 107.2327080948583, 'Can Tho, Vietnam', 0, '2024-02-23 13:22:28', NULL, NULL),
(168, 1, 8, 'Order 55', 21.293095638317144, 105.96382689984871, 'Can Tho, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(169, 1, 8, 'Order 56', 20.826080779848695, 106.82303742209733, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(170, 1, 8, 'Order 57', 21.172882550557034, 107.31967146724432, 'Can Tho, Vietnam', 0, '2024-02-24 13:22:28', NULL, NULL),
(171, 1, 8, 'Order 58', 21.026425385872297, 106.35171097829166, 'Can Tho, Vietnam', 0, '2024-02-13 13:22:28', NULL, NULL),
(172, 1, 8, 'Order 59', 20.946204401968238, 105.50575264311, 'Can Tho, Vietnam', 0, '2024-02-29 13:22:28', NULL, NULL),
(173, 1, 8, 'Order 40', 21.482869136131246, 106.46401903029906, 'Can Tho, Vietnam', 0, '2024-02-04 13:22:28', NULL, NULL),
(174, 1, 8, 'Order 41', 20.082014434581637, 105.96620505532827, 'Can Tho, Vietnam', 0, '2024-02-09 13:22:28', NULL, NULL),
(175, 1, 8, 'Order 42', 21.02369048821152, 105.26789460356152, 'Can Tho, Vietnam', 0, '2024-02-18 13:22:28', NULL, NULL),
(176, 1, 8, 'Order 43', 20.180851720441925, 105.34403578643132, 'Can Tho, Vietnam', 0, '2024-02-23 13:22:28', NULL, NULL),
(177, 1, 8, 'Order 44', 20.328496850867285, 105.28971261371832, 'Can Tho, Vietnam', 0, '2024-02-05 13:22:28', NULL, NULL),
(178, 1, 8, 'Order 45', 20.396754014675277, 106.38804685919364, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(179, 1, 8, 'Order 46', 20.370908597829665, 105.72151216047025, 'Can Tho, Vietnam', 0, '2024-02-11 13:22:28', NULL, NULL),
(180, 1, 8, 'Order 47', 20.96033182736517, 105.24371163476604, 'Can Tho, Vietnam', 0, '2024-02-15 13:22:28', NULL, NULL),
(181, 1, 8, 'Order 48', 20.812016445036992, 105.01610644396033, 'Can Tho, Vietnam', 0, '2024-02-20 13:22:28', NULL, NULL),
(182, 1, 8, 'Order 49', 20.03235866132412, 107.20830537351623, 'Can Tho, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(183, 1, 8, 'Order 30', 20.164251287155086, 106.22955988974269, 'Can Tho, Vietnam', 0, '2024-02-29 13:22:28', NULL, NULL),
(184, 1, 8, 'Order 31', 20.266421513880065, 106.24055008985154, 'Can Tho, Vietnam', 0, '2024-02-04 13:22:28', NULL, NULL),
(185, 1, 8, 'Order 32', 20.378938754442093, 106.04589416044382, 'Can Tho, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(186, 1, 8, 'Order 33', 20.621721877829845, 105.1766844048879, 'Can Tho, Vietnam', 0, '2024-02-29 13:22:28', NULL, NULL),
(187, 1, 8, 'Order 34', 20.506406253675376, 105.89561405442247, 'Can Tho, Vietnam', 0, '2024-02-09 13:22:28', NULL, NULL),
(188, 1, 8, 'Order 35', 21.2260119898487, 106.87864941719793, 'Can Tho, Vietnam', 0, '2024-02-23 13:22:28', NULL, NULL),
(189, 1, 8, 'Order 36', 20.407992735885077, 106.1103779018022, 'Can Tho, Vietnam', 0, '2024-02-20 13:22:28', NULL, NULL),
(190, 1, 8, 'Order 37', 21.03709754211558, 105.60670187520488, 'Can Tho, Vietnam', 0, '2024-02-28 13:22:28', NULL, NULL),
(191, 1, 8, 'Order 38', 21.452001897573474, 106.05595066310461, 'Can Tho, Vietnam', 0, '2024-02-26 13:22:28', NULL, NULL),
(192, 1, 8, 'Order 39', 21.15852056598153, 105.59510641321084, 'Can Tho, Vietnam', 0, '2024-02-06 13:22:28', NULL, NULL),
(193, 1, 8, 'Order 20', 20.977596441262957, 106.59784914841676, 'Can Tho, Vietnam', 0, '2024-02-25 13:22:28', NULL, NULL),
(194, 1, 8, 'Order 21', 20.427662416759564, 106.76006271202122, 'Can Tho, Vietnam', 0, '2024-02-13 13:22:28', NULL, NULL),
(195, 1, 8, 'Order 22', 20.317891823889585, 105.16309394982001, 'Can Tho, Vietnam', 0, '2024-02-12 13:22:28', NULL, NULL),
(196, 1, 8, 'Order 23', 20.384463055883035, 105.52582675640083, 'Can Tho, Vietnam', 0, '2024-02-24 13:22:28', NULL, NULL),
(197, 1, 8, 'Order 24', 21.1739676228482, 105.16260786229988, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(198, 1, 8, 'Order 25', 21.036909716238185, 106.31131055654149, 'Can Tho, Vietnam', 0, '2024-02-16 13:22:28', NULL, NULL),
(199, 1, 8, 'Order 26', 20.255653879377668, 105.51443623659614, 'Can Tho, Vietnam', 0, '2024-02-17 13:22:28', NULL, NULL),
(200, 1, 8, 'Order 27', 21.45575040900684, 105.74951789644501, 'Can Tho, Vietnam', 0, '2024-02-15 13:22:28', NULL, NULL),
(201, 1, 8, 'Order 28', 20.057380374574457, 106.07165732287956, 'Can Tho, Vietnam', 0, '2024-03-03 13:22:28', NULL, NULL),
(202, 1, 8, 'Order 29', 21.285171319996167, 105.49560662172325, 'Can Tho, Vietnam', 0, '2024-02-20 13:22:28', NULL, NULL),
(203, 1, 8, 'Order 10', 20.764437883407286, 105.71378601548615, 'Can Tho, Vietnam', 0, '2024-02-06 13:22:28', NULL, NULL),
(204, 1, 8, 'Order 11', 20.955407429910643, 106.22150644773758, 'Can Tho, Vietnam', 0, '2024-02-17 13:22:28', NULL, NULL),
(205, 1, 8, 'Order 12', 20.292773938079154, 105.94829739625408, 'Can Tho, Vietnam', 0, '2024-02-23 13:22:28', NULL, NULL),
(206, 1, 8, 'Order 13', 20.625916835969235, 105.38312160678498, 'Can Tho, Vietnam', 0, '2024-02-17 13:22:28', NULL, NULL),
(207, 1, 8, 'Order 14', 20.168452946626072, 105.0457028393128, 'Can Tho, Vietnam', 0, '2024-02-10 13:22:28', NULL, NULL),
(208, 1, 8, 'Order 15', 21.076483556140666, 105.81194775720309, 'Can Tho, Vietnam', 0, '2024-02-18 13:22:28', NULL, NULL),
(209, 1, 8, 'Order 16', 20.570457329573536, 106.22184791017496, 'Can Tho, Vietnam', 0, '2024-02-23 13:22:28', NULL, NULL),
(210, 1, 8, 'Order 17', 20.07153274730922, 105.82524736488726, 'Can Tho, Vietnam', 0, '2024-02-17 13:22:28', NULL, NULL),
(211, 1, 8, 'Order 18', 20.82027428347643, 105.52989961163132, 'Can Tho, Vietnam', 0, '2024-02-20 13:22:28', NULL, NULL),
(212, 1, 8, 'Order 19', 20.69056089798972, 105.11029407392283, 'Can Tho, Vietnam', 0, '2024-02-07 13:22:28', NULL, NULL),
(213, 1, 8, 'Order 0', 20.097468582538394, 107.01624039515502, '', 0, '2024-02-07 13:22:28', NULL, NULL),
(214, 1, 8, 'Order 1', 21.152344754573278, 105.82129561185957, 'Hanoi, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(215, 1, 8, 'Order 2', 21.055931034550007, 106.26516227495406, 'Ho Chi Minh City, Vietnam', 0, '2024-02-20 13:22:28', NULL, NULL),
(216, 1, 8, 'Order 3', 20.861176787746302, 106.53800447149017, 'Da Nang, Vietnam', 0, '2024-02-22 13:22:28', NULL, NULL),
(217, 1, 8, 'Order 4', 21.384007484078413, 106.38098029082732, 'Hai Phong, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(218, 1, 8, 'Order 5', 20.468827854347253, 106.45230653132526, 'Can Tho, Vietnam', 0, '2024-02-03 13:22:28', NULL, NULL),
(219, 1, 8, 'Order 6', 20.13802867488752, 106.39805864905757, 'Can Tho, Vietnam', 0, '2024-02-17 13:22:28', NULL, NULL),
(220, 1, 8, 'Order 7', 21.383944320850024, 105.13241957419777, 'Can Tho, Vietnam', 0, '2024-02-18 13:22:28', NULL, NULL),
(221, 1, 8, 'Order 8', 20.488773843263065, 105.34598640664107, 'Can Tho, Vietnam', 0, '2024-02-11 13:22:28', NULL, NULL),
(222, 1, 8, 'Order 9', 20.235413195318927, 106.60358802331946, 'Can Tho, Vietnam', 0, '2024-02-10 13:22:28', NULL, NULL),
(223, 1, 8, 'giao hang', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:43:38', NULL, '2024-10-09 17:00:00'),
(224, 1, 8, 'giao hang', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:03', NULL, '2024-10-09 17:00:00'),
(225, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:05', NULL, '2024-10-09 17:00:00'),
(226, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:07', NULL, '2024-10-09 17:00:00'),
(227, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:09', NULL, '2024-10-09 17:00:00'),
(228, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:09', NULL, '2024-10-09 17:00:00'),
(229, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:09', NULL, '2024-10-09 17:00:00'),
(230, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:10', NULL, '2024-10-09 17:00:00'),
(231, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:10', NULL, '2024-10-09 17:00:00'),
(232, 1, 8, 'giao hang afdasdfad', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 07:44:10', NULL, '2024-10-09 17:00:00'),
(233, 1, 8, 'them don hang', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 0, '2024-03-08 08:20:47', NULL, '2000-11-10 17:00:00'),
(236, 1, 8, 'giao hàng đi', 10.7763897, 106.7011391, 'Thành phố Hồ Chí Minh, Việt Nam', 1, '2024-03-27 03:04:13', '2024-03-27 03:07:45', '1970-01-01 01:00:00'),
(237, 1, 56, 'them don hang', 10.8677621, 106.7660348, 'Thủ Đức, Phường Linh Trung, Thành phố Thủ Đức, Thành phố Hồ Chí Minh, 00848, Việt Nam', 1, '2024-03-27 03:11:06', '2024-03-27 03:11:18', '1970-01-01 01:00:00');

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
(1, 'Chủ công ty'),
(2, 'Quản lí'),
(3, 'Nhân viên giao hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL DEFAULT '3',
  `fullname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_id` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `role_id`, `fullname`, `company_id`, `create_at`, `hash_password`, `active`, `avatar`) VALUES
(1, 'Alice', 'alice@gmail.com', '12222', 'Alice123', 1, 'Alice Border', 1, '2024-01-13 00:50:56', '$2y$10$gp9F6WVLydLlFuk61jLIveS9D3bPtHMN7ksHFEBOzlQff0Kc1bD1.', 1, 'avt.jpg'),
(3, 'Cobber', 'cobber@gmail.com', '123456789', 'Cobber123', 2, 'Cobber Stone', 1, '2024-01-13 00:50:56', '$2y$10$tGUA.UzBsnsZhf4NfM7cHOrkuTJLZqXjB0F7qtOkVxR/bM9Pq.j8m', 1, 'avt.jpg'),
(5, 'Emily', 'emily@gmail.com', NULL, 'Emily123', 3, 'Emily Absen', 1, '2024-01-13 00:50:56', '$2y$10$IGBEdUtBZGunI3MBa7RNeeHqi02cShfudc8QJzP6UZoKsTByS.glK', 1, ''),
(8, 'giadeptrai', 'giadeptrai@gmail.com', '188181', 'gia18112004', 3, 'Khưu Thành Gia', 1, '2024-01-17 05:06:47', '$2y$10$wu.rQxGQB49x4Ogvw8Es4.oWmDeGj186LFS1iDBz5X3UQ7juS17ci', 1, 'avt.jpg'),
(50, 'test_company', 'abc@123.1', NULL, '11111111', 1, 'Test Company', 23, '2024-03-09 18:51:23', '$2y$10$Vs4CiPU3vsuxH6y9VvmpFeBNBbycA7jlN8jIyxYpwr4Vvaru5JRVS', 1, NULL),
(51, 'test_user_company', 'accgarena7624@gmail.com', NULL, '11111111', 3, 'test_user_company', 23, '2024-03-11 17:08:58', '$2y$10$NVsmOao9dv8ddkzJpBVAPeTCjrjwgIlAo6GVZ6nRZHYWgdTfq3flq', 1, NULL),
(56, 'haixautinh', 'root@cc.ccc', NULL, '11111111', 3, 'haixautinh', 1, '2024-03-21 02:46:29', '$2y$10$buBr2y3heFnFAVPbenRdAOIIa2iQhH.6hPObbPnJibAWm6e4tpXuy', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `verify`
--

CREATE TABLE `verify` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `expires` datetime NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `verify`
--

INSERT INTO `verify` (`id`, `code`, `expires`, `email`) VALUES
(28, 757803, '2024-03-10 02:00:39', 'accgarena7624@gmail.com'),
(34, 316893, '2024-03-21 10:00:18', 'root@cc.ccc');

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
-- Chỉ mục cho bảng `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_companyid_complain` (`company_id`),
  ADD KEY `fk_username_complain` (`username`);

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
  ADD KEY `fk_user_company` (`company_id`),
  ADD KEY `email` (`email`);

--
-- Chỉ mục cho bảng `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_company_master_user` FOREIGN KEY (`master_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `fk_companyid_complain` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_username_complain` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_order_shipper` FOREIGN KEY (`shipper_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
