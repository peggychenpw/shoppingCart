-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 28, 2020 at 06:55 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shopping_cart`
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
  `couponStart` datetime DEFAULT NULL,
  `couponEnd` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
(1, 'P0001', 'BYREDO詩性既視淡香精	', 'P0001', '50ml', 4900, 9, 7, '1', '3', '2019-11-25 11:11:11', '2020-04-28 14:22:19'),
(2, 'P0002', 'BYREDO 詩性既視淡香精', NULL, '50ml', 4900, 10, 7, '1', '3', '2019-11-25 11:11:12', '2020-04-28 14:23:37'),
(3, 'P0003', 'BYREDO 光合假期淡香精', NULL, '50ml', 4900, 10, 7, '1', '2', '2019-11-25 11:11:13', '2020-04-28 14:25:25'),
(4, 'P0004', 'BYREDO 光合假期淡香精', 'P0004', '50ml', 4900, 9, 7, '1', '2', '2019-11-25 11:11:14', '2020-04-28 14:31:33'),
(5, 'P0005', 'BYREDO 無人之境淡香精', 'P0005', '50ml', 4900, 9, 7, '1', '1', '2019-11-25 11:11:15', '2020-04-28 14:31:57'),
(6, 'P0006', 'BYREDO 無人之境淡香精', 'P0006', '50ml', 4900, 9, 7, '1', '1', '2019-11-25 11:11:16', '2020-04-28 14:32:07'),
(7, 'P0007', 'BYREDO 北國之春淡香精', 'P0007', '50ml', 4900, 9, 7, '1', '4', '2019-11-25 11:11:17', '2020-04-28 14:32:39'),
(8, 'P0008', 'BYREDO 週日之香淡香精', 'P0008', '50ml', 4900, 9, 7, '1', '3', '2019-11-25 11:11:18', '2020-04-28 14:33:03'),
(9, 'P0009', 'BYREDO 吉普賽之水淡香精', 'P0009', '50ml', 4900, 9, 7, '1', '4', '2019-11-25 11:11:19', '2020-04-28 14:33:28'),
(10, 'P0010', 'BYREDO 吉普賽之水淡香精', 'P0010', '50ml', 4900, 9, 7, '1', '4', '2019-11-25 11:11:20', '2020-04-28 14:33:44'),
(11, 'P0011', 'BYREDO 夜幕玫瑰淡香精', 'P0011', '50ml', 4900, 9, 7, '1', '1', '2019-11-25 11:11:21', '2020-04-28 14:34:09'),
(12, 'P0012', 'BYREDO 鬱金香淡香精', 'P0012', '50ml', 4900, 9, 7, '1', '1', '2019-11-25 11:11:22', '2020-04-28 14:34:51'),
(13, 'P0013', 'BYREDO 非凡先生淡香精', 'P0013', '50ml', 4900, 9, 7, '1', '2', '2019-11-25 11:11:23', '2020-04-28 14:36:40'),
(14, 'P0014', 'BYREDO 光合假期髮香噴霧', 'P0014', '50ml', 4900, 9, 7, '1', '2', '2019-11-25 11:11:24', '2020-04-28 14:37:15'),
(15, 'P0015', 'BYREDO 吉普賽之水髮香噴霧', 'P0015', '50ml', 4900, 9, 7, '1', '4', '2019-11-25 11:11:25', '2020-04-28 14:38:11'),
(16, 'P0016', 'BYREDO 鬱金香髮香噴霧', 'P0016', '50ml', 4900, 9, 7, '1', '1', '2019-11-25 11:11:26', '2020-04-28 14:38:48'),
(17, 'P0017', 'BYREDO 旅行組皮套', 'P0017', '50ml', 4900, 9, 7, '1', '', '2019-11-25 11:11:27', '2020-04-28 14:39:10'),
(18, 'P0018', 'BYREDO 淡香精旅行組-城市游牧（熱帶爵士／返樸歸真／吉普賽之水）', 'P0018', '50ml', 4900, 9, 7, NULL, NULL, '2020-04-27 20:38:05', '2020-04-28 14:39:31'),
(19, 'P0019', 'BYREDO 麂皮乾洗手', 'P0019', '50ml', 4900, 9, 7, NULL, NULL, '2020-04-28 10:48:46', '2020-04-28 14:41:37');

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
(15, 'multiple_images_20200428022731_0.png', 'P0017', '2020-04-28 10:27:31', '2020-04-28 10:27:31');

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
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=25;

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
  MODIFY `multipleImageId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=17;

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
