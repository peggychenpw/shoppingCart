-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 04 月 28 日 13:30
-- 伺服器版本： 5.7.26
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 資料庫： `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者帳號',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理者姓名',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理者帳號';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `name`, `created_at`, `updated_at`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '我是管理者', '2019-11-25 13:18:46', '2019-12-16 01:34:25'),
(2, '123', '123', '管理員2', '2020-04-24 14:21:01', '2020-04-24 14:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `bookId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '預約編號',
  `classId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程編號',
  `userId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '會員編號',
  `bookStatus` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '預約狀態',
  `bookQty` tinyint(3) DEFAULT NULL COMMENT '預約人數',
  `bookPrice` int(11) DEFAULT NULL COMMENT '單筆價格',
  `bookTotalPrice` int(11) DEFAULT NULL COMMENT '總金額',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL COMMENT '品牌編號',
  `brandName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `brandName`, `created_at`, `updated_at`) VALUES
(1, 'BYREDO', '2020-04-26 09:51:46', '2020-04-26 09:51:46'),
(2, 'BONDI WASH', '2020-04-26 09:52:30', '2020-04-26 09:52:30'),
(3, 'CHANEL', '2020-04-26 09:52:30', '2020-04-26 09:52:30'),
(4, 'CULTI MILANO', '2020-04-26 09:53:13', '2020-04-26 09:53:13'),
(5, 'Chloé', '2020-04-26 09:53:13', '2020-04-26 09:53:13'),
(6, 'DIPTYQUE', '2020-04-26 09:54:13', '2020-04-26 09:54:13'),
(7, 'DIOR', '2020-04-26 09:54:13', '2020-04-26 09:54:13'),
(8, 'GUCCI', '2020-04-26 09:54:54', '2020-04-26 09:54:54'),
(9, 'GROWN ALCHEMIST', '2020-04-26 09:54:54', '2020-04-26 09:54:54'),
(10, 'HERETIC', '2020-04-26 09:56:25', '2020-04-26 09:56:52'),
(11, 'Jo Malone', '2020-04-26 09:56:25', '2020-04-26 09:57:31'),
(12, 'Le Labo', '2020-04-26 09:56:25', '2020-04-26 09:57:45'),
(13, 'Maison Margiela', '2020-04-26 09:56:25', '2020-04-26 09:58:02'),
(14, 'Miller Harris', '2020-04-26 09:56:25', '2020-04-26 14:42:32'),
(15, 'TOM FORD', '2020-04-26 09:58:46', '2020-04-26 14:42:22'),
(16, 'THE LAUNDRESS', '2020-04-26 09:58:46', '2020-04-26 14:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL COMMENT '流水號',
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別名稱',
  `categoryParentId` int(11) NOT NULL DEFAULT '0' COMMENT '上層編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='類別資料表';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryParentId`, `created_at`, `updated_at`) VALUES
(1, '身體保養', 0, '2020-04-25 15:02:20', '2020-04-25 15:02:50'),
(2, '個人香氛', 0, '2020-04-25 15:03:32', '2020-04-25 15:03:53'),
(3, '居家生活', 0, '2020-04-25 15:04:45', '2020-04-25 15:05:08'),
(4, '沐浴清潔', 1, '2020-04-25 15:04:53', '2020-04-25 15:05:13'),
(5, '乳液&保養油', 1, '2020-04-25 15:05:28', '2020-04-25 15:05:39'),
(6, '手部保養', 1, '2020-04-25 15:06:22', '2020-04-27 01:38:47'),
(7, '香水', 2, '2020-04-25 15:06:31', '2020-04-25 15:07:09'),
(8, '髮香噴霧', 2, '2020-04-25 15:06:50', '2020-04-25 15:07:12'),
(9, '隨身香水', 2, '2020-04-25 15:07:40', '2020-04-25 15:08:52'),
(10, '室內香氛', 3, '2020-04-25 15:07:57', '2020-04-25 15:08:58'),
(11, '居家清潔', 3, '2020-04-25 15:08:08', '2020-04-25 15:09:01'),
(12, '衣物清潔', 3, '2020-04-25 15:08:29', '2020-04-25 15:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `classId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '課程編號',
  `className` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程名稱',
  `classImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程圖片',
  `classPeopleLimit` tinyint(3) DEFAULT NULL COMMENT '人數限制',
  `classPrice` int(11) DEFAULT NULL COMMENT '課程價格',
  `classCategoryId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程分類',
  `classTime` date DEFAULT NULL COMMENT '上課日期',
  `shopId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classcategory`
--

CREATE TABLE `classcategory` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `classCategoryId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '課程分類',
  `classCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程索引',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '內容',
  `rating` tinyint(1) DEFAULT NULL COMMENT '評分',
  `parentId` int(11) DEFAULT NULL COMMENT '上(父)層編號',
  `itemId` int(11) DEFAULT NULL COMMENT '商品編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='評論';

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `couponId` int(11) NOT NULL,
  `couponCode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponName` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponDiscount` int(4) DEFAULT NULL,
  `couponStart` date DEFAULT NULL,
  `couponEnd` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fragrance`
--

CREATE TABLE `fragrance` (
  `fragranceId` int(11) NOT NULL COMMENT '香調編號',
  `fragranceName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '香調名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fragrance`
--

INSERT INTO `fragrance` (`fragranceId`, `fragranceName`, `created_at`, `updated_at`) VALUES
(1, '花香調', '2020-04-27 13:49:23', '2020-04-27 13:49:23'),
(2, '清新香調', '2020-04-27 13:49:23', '2020-04-27 13:49:23'),
(3, '溫暖辛辣香調', '2020-04-27 13:50:36', '2020-04-27 14:04:21'),
(4, '木質香調', '2020-04-27 13:50:36', '2020-04-27 13:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `itemId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品編號',
  `itemName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名稱',
  `itemImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品照片路徑',
  `itemSize` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品規格',
  `itemPrice` int(11) DEFAULT NULL COMMENT '商品價格',
  `itemQty` int(5) DEFAULT NULL COMMENT '商品數量',
  `itemCategoryId` int(11) DEFAULT NULL COMMENT '商品種類編號',
  `brandId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌編號',
  `fragranceId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '香調編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品列表';

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemId`, `itemName`, `itemImg`, `itemSize`, `itemPrice`, `itemQty`, `itemCategoryId`, `brandId`, `fragranceId`, `created_at`, `updated_at`) VALUES
(1, 'P0001', 'BYREDO 詩性既視淡香精', 'P0001', '50ml', 4800, 6, 7, '1', '3', '2019-11-25 11:11:11', '2019-11-25 11:11:11'),
(2, 'P0002', 'BYREDO 詩性既視淡香精', 'P0002', '100ml', 7000, 8, 7, '1', '3', '2019-11-25 11:11:12', '2019-11-25 11:11:12'),
(3, 'P0003', 'BYREDO 光合假期淡香精', 'P0003', '50ml', 4800, 10, 7, '1', '2', '2019-11-25 11:11:13', '2019-11-25 11:11:13'),
(4, 'P0004', 'BYREDO 光合假期淡香精', 'P0004', '100ml', 7000, 10, 7, '1', '2', '2019-11-25 11:11:14', '2019-11-25 11:11:14'),
(5, 'P0005', 'BYREDO 無人之境淡香精', 'P0005', '50ml', 4800, 10, 7, '1', '1', '2019-11-25 11:11:15', '2019-11-25 11:11:15'),
(6, 'P0006', 'BYREDO 無人之境淡香精', 'P0006', '100ml', 7000, 10, 7, '1', '1', '2019-11-25 11:11:16', '2019-11-25 11:11:16'),
(7, 'P0007', 'BYREDO 北國之春淡香精', 'P0007', '100ml', 7000, 10, 7, '1', '4', '2019-11-25 11:11:17', '2019-11-25 11:11:17'),
(8, 'P0008', 'BYREDO 週日之香淡香精', 'P0008', '100ml', 7000, 10, 7, '1', '3', '2019-11-25 11:11:18', '2019-11-25 11:11:18'),
(9, 'P0009', 'BYREDO 吉普賽之水淡香精', 'P0009', '50ml', 4800, 10, 7, '1', '4', '2019-11-25 11:11:19', '2019-11-25 11:11:19'),
(10, 'P0010', 'BYREDO 吉普賽之水淡香精', 'P0010', '100ml', 7000, 10, 7, '1', '4', '2019-11-25 11:11:20', '2019-11-25 11:11:20'),
(11, 'P0011', 'BYREDO 夜幕玫瑰淡香精', 'P0011', '100ml', 7000, 10, 7, '1', '1', '2019-11-25 11:11:21', '2019-11-25 11:11:21'),
(12, 'P0012', 'BYREDO 鬱金香淡香精', 'P0012', '100ml', 7000, 10, 7, '1', '1', '2019-11-25 11:11:22', '2019-11-25 11:11:22'),
(13, 'P0013', 'BYREDO 非凡先生淡香精', 'P0013', '100ml', 7000, 10, 7, '1', '2', '2019-11-25 11:11:23', '2019-11-25 11:11:23'),
(14, 'P0014', 'BYREDO 光合假期髮香噴霧', 'P0014', '75ml', 2000, 10, 8, '1', '2', '2019-11-25 11:11:24', '2019-11-25 11:11:24'),
(15, 'P0015', 'BYREDO 吉普賽之水髮香噴霧', 'P0015', '75ml', 2000, 10, 8, '1', '4', '2019-11-25 11:11:25', '2019-11-25 11:11:25'),
(16, 'P0016', 'BYREDO 鬱金香髮香噴霧', 'P0016', '75ml', 2000, 10, 8, '1', '1', '2019-11-25 11:11:26', '2019-11-25 11:11:26'),
(17, 'P0017', 'BYREDO 旅行組皮套', 'P0017', '', 3000, 10, 9, '1', '', '2019-11-25 11:11:27', '2019-11-25 11:11:27'),
(18, 'P0018', 'BYREDO 淡香精旅行組-城市游牧（熱帶爵士／返樸歸真／吉普賽之水）', 'P0018', '30ml', 3300, 10, 9, '1', '4', '2019-11-25 11:11:28', '2019-11-25 11:11:28'),
(19, 'P0019', 'BYREDO 麂皮乾洗手', 'P0019', '30ml', 1000, 10, 6, '1', '4', '2019-12-15 12:12:12', '2019-12-25 10:10:10'),
(20, 'P0020', 'BYREDO 鬱金香乾洗手', 'P0020', '30ml', 1000, 10, 6, '1', '1', '2019-12-15 12:12:13', '2019-12-25 10:10:11'),
(21, 'P0021', 'BYREDO 玫瑰乾洗手', 'P0021', '30ml', 1000, 10, 6, '1', '1', '2019-12-15 12:12:14', '2019-12-25 10:10:12'),
(22, 'P0022', 'BYREDO 玫瑰護手霜', 'P0022', '100ml', 1900, 10, 6, '1', '1', '2019-12-15 12:12:15', '2019-12-25 10:10:13'),
(23, 'P0023', 'BYREDO 鬱金香護手霜', 'P0023', '100ml', 1900, 10, 6, '1', '1', '2019-12-15 12:12:16', '2019-12-25 10:10:14'),
(24, 'P0024', 'BYREDO 熱帶爵士護手霜', 'P0024', '30ml', 1250, 10, 6, '1', '1', '2019-12-15 12:12:17', '2019-12-25 10:10:15'),
(25, 'P0025', 'BYREDO 岩蘭草乾洗手', 'P0025', '30ml', 1000, 10, 6, '1', '2', '2019-12-15 12:12:18', '2019-12-25 10:10:16'),
(26, 'P0026', 'BYREDO 麂皮手部清潔露', 'P0026', '450ml', 1650, 10, 6, '1', '4', '2019-12-15 12:12:19', '2019-12-25 10:10:17'),
(27, 'P0027', 'BYREDO 鬱金香手部清潔露', 'P0027', '450ml', 1650, 10, 6, '1', '1', '2019-12-15 12:12:20', '2019-12-25 10:10:18'),
(28, 'P0028', 'BYREDO 玫瑰手部清潔露', 'P0028', '450ml', 1650, 10, 6, '1', '1', '2019-12-15 12:12:21', '2019-12-25 10:10:19'),
(29, 'P0029', 'BYREDO 鬱金香沐浴膠', 'P0029', '225ml', 1600, 10, 4, '1', '1', '2019-12-15 12:12:22', '2019-12-25 10:10:20'),
(30, 'P0030', 'BYREDO 無人之境沐浴膠', 'P0030', '225ml', 1600, 10, 4, '1', '1', '2019-12-15 12:12:23', '2019-12-25 10:10:21'),
(31, 'P0031', 'BYREDO 莫哈維之影沐浴膠', 'P0031', '225ml', 1600, 10, 4, '1', '4', '2019-12-15 12:12:24', '2019-12-25 10:10:22'),
(32, 'P0032', 'BYREDO 無人之境身體乳', 'P0032', '225ml', 2100, 10, 5, '1', '1', '2019-12-15 12:12:25', '2019-12-25 10:10:23'),
(33, 'P0033', 'BYREDO 逝去之愛香氛蠟燭', 'P0033', '240g', 2600, 10, 10, '1', '4', '2019-12-15 12:12:26', '2019-12-25 10:10:24'),
(34, 'P0034', 'BYREDO 幽香追憶香氛蠟燭', 'P0034', '240g', 2600, 10, 10, '1', '4', '2019-12-15 12:12:27', '2019-12-25 10:10:25'),
(35, 'P0035', 'BYREDO 旋轉木馬香氛蠟燭', 'P0035', '240g', 2600, 10, 10, '1', '3', '2019-12-15 12:12:28', '2019-12-25 10:10:26'),
(36, 'P0036', 'BYREDO 懷舊書香香氛蠟燭', 'P0036', '240g', 2600, 10, 10, '1', '3', '2019-12-15 12:12:29', '2019-12-25 10:10:27'),
(37, 'P0037', 'BONDI WASH 雪梨薄荷 & 迷迭香居家清潔噴霧', 'P0037', '500ml', 600, 10, 11, '2', '2', '2020-01-03 10:10:10', '2020-01-03 11:10:10'),
(38, 'P0038', 'BONDI WASH 檸檬茶樹 & 柑橘居家清潔噴霧', 'P0038', '500ml', 600, 10, 11, '2', '2', '2020-01-03 10:10:11', '2020-01-03 11:10:11'),
(39, 'P0039', 'BONDI WASH 塔斯曼尼亞胡椒 & 薰衣草居家清潔噴霧', 'P0039', '500ml', 600, 10, 11, '2', '4', '2020-01-03 10:10:12', '2020-01-03 11:10:12'),
(40, 'P0040', 'BONDI WASH 雪梨薄荷 & 迷迭香地板清潔液', 'P0040', '500ml', 450, 10, 11, '2', '2', '2020-01-03 10:10:13', '2020-01-03 11:10:13'),
(41, 'P0041', 'BONDI WASH 塔斯曼尼亞胡椒 & 薰衣草地板清潔液', 'P0041', '500ml', 450, 10, 11, '2', '4', '2020-01-03 10:10:14', '2020-01-03 11:10:14'),
(42, 'P0042', 'BONDI WASH 檸檬茶樹 & 柑橘碗盤清潔液', 'P0042', '500ml', 550, 10, 11, '2', '2', '2020-01-03 10:10:15', '2020-01-03 11:10:15'),
(43, 'P0043', 'BONDI WASH 雪梨薄荷 & 迷迭香鏡面清潔液', 'P0043', '500ml', 450, 10, 11, '2', '2', '2020-01-03 10:10:16', '2020-01-03 11:10:16'),
(44, 'P0044', 'BONDI WASH 藍絲柏 & 苦橙葉精緻衣物洗衣精', 'P0044', '500ml', 680, 10, 12, '2', '4', '2020-01-03 10:10:17', '2020-01-03 11:10:17'),
(45, 'P0045', 'BONDI WASH 雪梨薄荷 & 迷迭香沐浴露', 'P0045', '500ml', 900, 10, 4, '2', '2', '2020-01-03 10:10:18', '2020-01-03 11:10:18'),
(46, 'P0046', 'BONDI WASH 塔斯曼尼亞胡椒 & 薰衣草沐浴露', 'P0046', '500ml', 900, 10, 4, '2', '4', '2020-01-03 10:10:19', '2020-01-03 11:10:19'),
(47, 'P0047', 'BONDI WASH 塔斯曼尼亞胡椒及薰衣草防護乾洗手', 'P0047', '30ml', 450, 10, 6, '2', '4', '2020-01-03 10:10:20', '2020-01-03 11:10:20'),
(48, 'P0048', 'BONDI WASH 塔斯曼尼亞胡椒及薰衣草洗手露', 'P0048', '500ml', 950, 10, 6, '2', '4', '2020-01-03 10:10:21', '2020-01-03 11:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `item_lists`
--

CREATE TABLE `item_lists` (
  `itemListId` int(11) NOT NULL COMMENT '流水號',
  `orderId` int(11) DEFAULT NULL COMMENT '訂單編號',
  `itemId` int(11) DEFAULT NULL COMMENT '商品編號',
  `itemSize` int(10) DEFAULT NULL COMMENT '容量',
  `checkPrice` int(11) DEFAULT NULL COMMENT '結帳時單價',
  `checkQty` tinyint(3) DEFAULT NULL COMMENT '結帳時數量',
  `checkSubtotal` int(11) DEFAULT NULL COMMENT '結帳時小計',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='訂單中的商品列表';

--
-- Dumping data for table `item_lists`
--

INSERT INTO `item_lists` (`itemListId`, `orderId`, `itemId`, `itemSize`, `checkPrice`, `checkQty`, `checkSubtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 0, 100, 1, 100, '2020-04-23 13:13:34', '2020-04-23 13:13:34'),
(2, 2, 1, 0, 3950, 1, 3950, '2020-04-23 17:20:32', '2020-04-23 17:20:32'),
(3, 3, 1, 0, 3950, 1, 3950, '2020-04-23 18:05:42', '2020-04-23 18:05:42'),
(4, 3, 1, 0, 3950, 1, 3950, '2020-04-23 18:05:42', '2020-04-23 18:05:42'),
(5, 4, 1, 0, 3950, 1, 3950, '2020-04-23 18:08:59', '2020-04-23 18:08:59'),
(6, 4, 6, 0, 1111, 1, 1111, '2020-04-23 18:08:59', '2020-04-23 18:08:59'),
(7, 5, 6, 0, 1111, 1, 1111, '2020-04-24 09:56:41', '2020-04-24 09:56:41'),
(8, 5, 6, 0, 1111, 1, 1111, '2020-04-24 09:56:41', '2020-04-24 09:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `item_tracking`
--

CREATE TABLE `item_tracking` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者帳號',
  `itemId` int(11) DEFAULT NULL COMMENT '商品編號',
  `msg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '訊息',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品追縱';

-- --------------------------------------------------------

--
-- Table structure for table `multiple_images`
--

CREATE TABLE `multiple_images` (
  `multipleImageId` int(11) NOT NULL COMMENT '流水號',
  `multipleImageImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '圖片名稱',
  `itemId` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品圖片';

--
-- Dumping data for table `multiple_images`
--

INSERT INTO `multiple_images` (`multipleImageId`, `multipleImageImg`, `itemId`, `created_at`, `updated_at`) VALUES
(15, 'multiple_images_20200428022731_0.png', 'P0017', '2020-04-28 10:27:31', '2020-04-28 10:27:31'),
(17, 'multiple_images_20200428084916_0.png', 'P0036', '2020-04-28 16:49:16', '2020-04-28 16:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL COMMENT '流水號',
  `orderCode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '訂單編號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者帳號',
  `orderPrice` int(100) DEFAULT NULL,
  `orderStatus` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '訂單狀態',
  `paymentTypeId` int(11) DEFAULT NULL COMMENT '付款方式',
  `couponId` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '優惠券編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='結帳資料表';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `orderCode`, `username`, `orderPrice`, `orderStatus`, `paymentTypeId`, `couponId`, `created_at`, `updated_at`) VALUES
(1, '', 'rose123@gmail.com', 0, NULL, 1, '1', '2020-04-23 13:13:34', '2020-04-23 16:58:42'),
(2, '', 'abc', 0, NULL, 1, NULL, '2020-04-23 17:20:32', '2020-04-23 17:20:32'),
(3, '', 'abc', 0, NULL, 1, NULL, '2020-04-23 18:05:42', '2020-04-23 18:05:42'),
(4, '', 'abc', 0, NULL, 1, NULL, '2020-04-23 18:08:59', '2020-04-23 18:08:59'),
(5, '', 'rose123@gmail.com', 0, NULL, 1, NULL, '2020-04-24 09:56:41', '2020-04-24 09:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `paymentTypeId` int(11) NOT NULL COMMENT '流水號',
  `paymentTypeName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '付款方式名稱',
  `paymentTypeImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '付款方式圖片名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='付款方式';

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`paymentTypeId`, `paymentTypeName`, `paymentTypeImg`, `created_at`, `updated_at`) VALUES
(1, 'credit', 'payment_type_20200425055340.jpg', '2020-04-23 13:11:56', '2020-04-25 13:53:40'),
(3, 'tttt', 'payment_type_20200425055354.jpg', '2020-04-25 13:53:54', '2020-04-25 13:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `shopId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '廠商編號',
  `shopName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商名稱',
  `shopAddress` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商地址',
  `shopPhone` bigint(10) DEFAULT NULL COMMENT '廠商電話',
  `shopEmail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商email',
  `shopAccount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商帳號',
  `shopPassword` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商密碼',
  `shopBank` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商帳戶',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `userId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者編號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者帳號',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '性別',
  `phoneNumber` int(11) DEFAULT NULL COMMENT '手機號碼',
  `birthday` datetime DEFAULT NULL COMMENT '出生年月日',
  `userEmail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者email',
  `userCity` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '所在地',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `userCreditCard` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '卡號',
  `userPoint` int(100) DEFAULT NULL COMMENT '點數',
  `userLoyalty` tinyint(1) DEFAULT NULL COMMENT 'VIP',
  `isActivated` tinyint(1) DEFAULT '0' COMMENT '開通狀況',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='使用者資料表';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userId`, `username`, `pwd`, `name`, `gender`, `phoneNumber`, `birthday`, `userEmail`, `userCity`, `address`, `userCreditCard`, `userPoint`, `userLoyalty`, `isActivated`, `created_at`, `updated_at`) VALUES
(1, '', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'aabbab', '男', 1111111111, '2011-11-11 01:00:00', '', '', '123123', '', 0, 0, 0, '2020-04-24 14:17:58', '2020-04-24 14:17:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`,`bookId`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`,`classId`);

--
-- Indexes for table `classcategory`
--
ALTER TABLE `classcategory`
  ADD PRIMARY KEY (`id`,`classCategoryId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`couponId`);

--
-- Indexes for table `fragrance`
--
ALTER TABLE `fragrance`
  ADD PRIMARY KEY (`fragranceId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_lists`
--
ALTER TABLE `item_lists`
  ADD PRIMARY KEY (`itemListId`);

--
-- Indexes for table `item_tracking`
--
ALTER TABLE `item_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiple_images`
--
ALTER TABLE `multiple_images`
  ADD PRIMARY KEY (`multipleImageId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`,`orderCode`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`paymentTypeId`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`,`shopId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌編號', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- AUTO_INCREMENT for table `classcategory`
--
ALTER TABLE `classcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `couponId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fragrance`
--
ALTER TABLE `fragrance`
  MODIFY `fragranceId` int(11) NOT NULL AUTO_INCREMENT COMMENT '香調編號', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `item_lists`
--
ALTER TABLE `item_lists`
  MODIFY `itemListId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_tracking`
--
ALTER TABLE `item_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- AUTO_INCREMENT for table `multiple_images`
--
ALTER TABLE `multiple_images`
  MODIFY `multipleImageId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `paymentTypeId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=2;
