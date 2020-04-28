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
-- 資料表結構 `admin`
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
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `name`, `created_at`, `updated_at`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '我是管理者', '2019-11-25 13:18:46', '2019-12-16 01:34:25'),
(2, '123', '123', '管理員2', '2020-04-24 14:21:01', '2020-04-24 14:21:01');

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `bookId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '預約編號',
  `classId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程編號',
  `userId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '會員編號',
  `bookStatus` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '預約狀態',
  `bookQty` tinyint(3) DEFAULT NULL COMMENT '預約人數',
  `bookPrice` int(11) DEFAULT NULL COMMENT '單筆價格',
  `bookTotalPrice` int(11) DEFAULT NULL COMMENT '總金額',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`id`, `bookId`, `classId`, `userId`, `bookStatus`, `bookQty`, `bookPrice`, `bookTotalPrice`, `created_at`, `updated_at`) VALUES
(1, '1', '123', '123', '123', 10, 1111, 1111, '2020-04-28 17:39:12', '2020-04-28 17:39:12'),
(2, '2', '234', '1234', '1234', 111, 1234, 1234, '2020-04-28 17:39:12', '2020-04-28 17:39:12'),
(3, '3', '5555', '5555', '1234', 12, 1000, 1000, '2020-04-28 17:39:52', '2020-04-28 17:39:52'),
(4, '4', '1234', '1234', '111', 22, 1111, 1111, '2020-04-28 17:39:52', '2020-04-28 17:39:52'),
(5, '5', '1111', '1111', '4555', 123, 1111, 1111, '2020-04-28 17:40:25', '2020-04-28 17:40:25'),
(6, '6', '12345', '12345', '1111', 44, 11111, 11111, '2020-04-28 17:40:25', '2020-04-28 17:40:25');

-- --------------------------------------------------------

--
-- 資料表結構 `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL COMMENT '品牌編號',
  `brandName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `brand`
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
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL COMMENT '流水號',
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '類別名稱',
  `categoryParentId` int(11) NOT NULL DEFAULT '0' COMMENT '上層編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='類別資料表';

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryParentId`, `created_at`, `updated_at`) VALUES
(4, '身體保養', 0, '2020-04-23 15:20:11', '2020-04-23 15:20:11'),
(6, 'jhhh', 0, '2020-04-25 13:54:10', '2020-04-25 13:54:10'),
(7, 'hhjh', 0, '2020-04-25 13:54:18', '2020-04-25 13:54:18'),
(8, 'hhhhh', 0, '2020-04-25 13:54:29', '2020-04-25 13:54:29'),
(9, 'saaa', 4, '2020-04-25 13:57:10', '2020-04-25 13:57:10'),
(10, 'gfgff', 0, '2020-04-25 13:57:19', '2020-04-25 13:57:19');

-- --------------------------------------------------------

--
-- 資料表結構 `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `classId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '課程編號',
  `className` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程名稱',
  `classImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程圖片',
  `classPeopleLimit` tinyint(3) DEFAULT NULL COMMENT '人數限制',
  `classPrice` int(11) DEFAULT NULL COMMENT '課程價格',
  `classCategoryId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程分類',
  `classDate` date DEFAULT NULL COMMENT '上課日期',
  `classTime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上課時間',
  `shopId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `class`
--

INSERT INTO `class` (`id`, `classId`, `className`, `classImg`, `classPeopleLimit`, `classPrice`, `classCategoryId`, `classDate`, `classTime`, `shopId`, `created_at`, `updated_at`) VALUES
(35, 'C_35', '香皂教室7', NULL, 35, 1500, 'c_perfume', '2020-04-30', '13:00', 'S_001', '2020-04-27 19:50:52', '2020-04-28 15:03:18'),
(36, 'C_36', '香水教室9', NULL, 30, 1500, 'c_perfume', '2020-04-30', '15:00', 'S_001', '2020-04-28 01:42:45', '2020-04-28 01:42:58'),
(37, 'C_37', '香皂教室7', NULL, 40, 1500, 'c_soap', '2020-04-23', '13:00', 'S_001', '2020-04-28 12:20:35', '2020-04-28 12:20:51'),
(45, 'C_45', '香皂教室5', NULL, 20, 1111, 'c_perfume', '2020-04-23', '15:00', 'S_002', '2020-04-28 13:12:34', '2020-04-28 14:10:58');

-- --------------------------------------------------------

--
-- 資料表結構 `classcategory`
--

CREATE TABLE `classcategory` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `classCategoryId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '課程分類',
  `classCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程索引',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `classcategory`
--

INSERT INTO `classcategory` (`id`, `classCategoryId`, `classCategoryName`, `created_at`, `updated_at`) VALUES
(1, 'c_perfume', '香水體驗', '2020-04-26 12:46:48', '2020-04-26 12:46:48'),
(2, 'c_soap', '香皂體驗', '2020-04-26 12:47:21', '2020-04-26 12:47:21');

-- --------------------------------------------------------

--
-- 資料表結構 `comments`
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
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `couponId` int(11) NOT NULL,
  `couponCode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponName` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponDiscount` int(4) DEFAULT NULL,
  `couponStart` date DEFAULT NULL,
  `couponEnd` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `formulation`
--

CREATE TABLE `formulation` (
  `formulationId` int(11) NOT NULL COMMENT '質地編號',
  `formulationName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '質地名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `fragrance`
--

CREATE TABLE `fragrance` (
  `fragranceId` int(11) NOT NULL COMMENT '香調編號',
  `fragranceName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '香調名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `fragrance`
--

INSERT INTO `fragrance` (`fragranceId`, `fragranceName`, `created_at`, `updated_at`) VALUES
(1, '花香調', '2020-04-27 13:49:23', '2020-04-27 13:49:23'),
(2, '清新香調', '2020-04-27 13:49:23', '2020-04-27 13:49:23'),
(3, '溫暖辛辣香調', '2020-04-27 13:50:36', '2020-04-27 14:04:21'),
(4, '木質香調', '2020-04-27 13:50:36', '2020-04-27 13:50:36');

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL COMMENT '流水號',
  `itemNumber` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品編號',
  `itemName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名稱',
  `itemImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品照片路徑',
  `itemImg2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemImg3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemSize` int(6) DEFAULT NULL COMMENT '商品規格',
  `itemPrice` int(11) DEFAULT NULL COMMENT '商品價格',
  `itemQty` int(5) DEFAULT NULL COMMENT '商品數量',
  `itemCategoryId` int(11) DEFAULT NULL COMMENT '商品種類編號',
  `brandId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌編號',
  `formulationId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '質地編號',
  `fragranceId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '香調編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品列表';

--
-- 傾印資料表的資料 `items`
--

INSERT INTO `items` (`itemId`, `itemNumber`, `itemName`, `itemImg`, `itemImg2`, `itemImg3`, `itemSize`, `itemPrice`, `itemQty`, `itemCategoryId`, `brandId`, `formulationId`, `fragranceId`, `created_at`, `updated_at`) VALUES
(11, NULL, 'tttt', 'item_20200425055246.jpg', NULL, NULL, NULL, 11111, 111, 4, NULL, NULL, NULL, '2020-04-25 13:52:46', '2020-04-25 13:52:46'),
(12, NULL, '1111', 'item_20200425055300.jpg', NULL, NULL, NULL, 111, 111, 4, NULL, NULL, NULL, '2020-04-25 13:53:00', '2020-04-25 13:53:00'),
(13, NULL, '55555', 'item_20200425055324.jpg', NULL, NULL, NULL, 111, 111, 4, NULL, NULL, NULL, '2020-04-25 13:53:24', '2020-04-25 13:53:24'),
(14, NULL, 'uuuu', 'item_20200427021918.jpg', NULL, NULL, NULL, 111, 111, 4, NULL, NULL, NULL, '2020-04-27 10:19:18', '2020-04-27 10:19:18'),
(15, NULL, 'ytt', 'item_20200427022128.jpg', NULL, NULL, NULL, 11, 111, 4, NULL, NULL, NULL, '2020-04-27 10:21:28', '2020-04-27 10:21:28'),
(16, NULL, '1111', 'item_20200427022845.jpg', NULL, NULL, NULL, 11111, 111, 4, NULL, NULL, NULL, '2020-04-27 10:28:45', '2020-04-27 10:28:45');

-- --------------------------------------------------------

--
-- 資料表結構 `item_lists`
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
-- 傾印資料表的資料 `item_lists`
--

INSERT INTO `item_lists` (`itemListId`, `orderId`, `itemId`, `itemSize`, `checkPrice`, `checkQty`, `checkSubtotal`, `created_at`, `updated_at`) VALUES
(18, 1, 11, NULL, 1555, 12, 1555, '2020-04-28 21:19:27', '2020-04-28 21:23:11'),
(19, 7, 12, NULL, 1000, 10, 10000, '2020-04-28 21:28:52', '2020-04-28 21:28:52'),
(20, 7, 14, NULL, 500, 20, 10000, '2020-04-28 21:28:52', '2020-04-28 21:28:52');

-- --------------------------------------------------------

--
-- 資料表結構 `item_tracking`
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
-- 資料表結構 `multiple_images`
--

CREATE TABLE `multiple_images` (
  `multipleImageId` int(11) NOT NULL COMMENT '流水號',
  `multipleImageImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '圖片名稱',
  `itemId` int(11) DEFAULT NULL COMMENT '商品編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品圖片';

--
-- 傾印資料表的資料 `multiple_images`
--

INSERT INTO `multiple_images` (`multipleImageId`, `multipleImageImg`, `itemId`, `created_at`, `updated_at`) VALUES
(1, 'multiple_images_20200423095040_0.jpg', 1, '2020-04-23 15:50:40', '2020-04-23 15:50:40'),
(2, 'multiple_images_20200424150428_0.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(3, 'multiple_images_20200424150428_1.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(4, 'multiple_images_20200424150428_2.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(5, 'multiple_images_20200424150428_3.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(6, 'multiple_images_20200424150428_4.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(7, 'multiple_images_20200424150428_5.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(8, 'multiple_images_20200424150428_6.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(9, 'multiple_images_20200424150428_7.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(10, 'multiple_images_20200424150428_8.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28'),
(15, 'multiple_images_20200428022731_0.png', 0, '2020-04-28 10:27:31', '2020-04-28 10:27:31');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL COMMENT '流水號',
  `orderCode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '訂單編號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者帳號',
  `orderPrice` int(100) DEFAULT NULL,
  `orderStatus` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '訂單狀態',
  `paymentTypeId` int(11) DEFAULT NULL COMMENT '付款方式',
  `couponId` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '優惠券編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='結帳資料表';

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderId`, `orderCode`, `username`, `orderPrice`, `orderStatus`, `paymentTypeId`, `couponId`, `created_at`, `updated_at`) VALUES
(1, '', 'rose123@gmail.com', 0, NULL, 1, '1', '2020-04-23 13:13:34', '2020-04-23 16:58:42'),
(7, '0', 'xxx@gmail.com', NULL, NULL, 1, '1', '2020-04-28 21:24:50', '2020-04-28 21:24:50');

-- --------------------------------------------------------

--
-- 資料表結構 `payment_types`
--

CREATE TABLE `payment_types` (
  `paymentTypeId` int(11) NOT NULL COMMENT '流水號',
  `paymentTypeName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '付款方式名稱',
  `paymentTypeImg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '付款方式圖片名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='付款方式';

--
-- 傾印資料表的資料 `payment_types`
--

INSERT INTO `payment_types` (`paymentTypeId`, `paymentTypeName`, `paymentTypeImg`, `created_at`, `updated_at`) VALUES
(1, 'credit', 'payment_type_20200425055340.jpg', '2020-04-23 13:11:56', '2020-04-25 13:53:40'),
(3, 'tttt', 'payment_type_20200425055354.jpg', '2020-04-25 13:53:54', '2020-04-25 13:53:54');

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `shopId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '廠商編號',
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

--
-- 傾印資料表的資料 `shop`
--

INSERT INTO `shop` (`id`, `shopId`, `shopName`, `shopAddress`, `shopPhone`, `shopEmail`, `shopAccount`, `shopPassword`, `shopBank`, `created_at`, `updated_at`) VALUES
(1, 'S_001', '隨便', '台北', 911333444, 'xxxxx@gmail.com', 'test', 'test', '123456789', '2020-04-26 16:54:39', '2020-04-26 16:54:39'),
(2, 'S_002', '青菜', '地球', 911333555, 'ggggg@gmail.com', 'qqqqqq', 'qqqqqq', 'xxxxxxxxxxxx', '2020-04-28 13:09:03', '2020-04-28 13:09:03');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `userId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '使用者編號',
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
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `userId`, `username`, `pwd`, `name`, `gender`, `phoneNumber`, `birthday`, `userEmail`, `userCity`, `address`, `userCreditCard`, `userPoint`, `userLoyalty`, `isActivated`, `created_at`, `updated_at`) VALUES
(1, '', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'aabbab', '男', 1111111111, '2011-11-11 01:00:00', '', '', '123123', '', 0, 0, 0, '2020-04-24 14:17:58', '2020-04-24 14:17:58');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`,`bookId`);

--
-- 資料表索引 `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`,`classId`);

--
-- 資料表索引 `classcategory`
--
ALTER TABLE `classcategory`
  ADD PRIMARY KEY (`id`,`classCategoryId`);

--
-- 資料表索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`couponId`);

--
-- 資料表索引 `formulation`
--
ALTER TABLE `formulation`
  ADD PRIMARY KEY (`formulationId`);

--
-- 資料表索引 `fragrance`
--
ALTER TABLE `fragrance`
  ADD PRIMARY KEY (`fragranceId`);

--
-- 資料表索引 `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- 資料表索引 `item_lists`
--
ALTER TABLE `item_lists`
  ADD PRIMARY KEY (`itemListId`);

--
-- 資料表索引 `item_tracking`
--
ALTER TABLE `item_tracking`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `multiple_images`
--
ALTER TABLE `multiple_images`
  ADD PRIMARY KEY (`multipleImageId`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`,`orderCode`);

--
-- 資料表索引 `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`paymentTypeId`);

--
-- 資料表索引 `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`,`shopId`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`userId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌編號', AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=46;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `classcategory`
--
ALTER TABLE `classcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `couponId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `formulation`
--
ALTER TABLE `formulation`
  MODIFY `formulationId` int(11) NOT NULL AUTO_INCREMENT COMMENT '質地編號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fragrance`
--
ALTER TABLE `fragrance`
  MODIFY `fragranceId` int(11) NOT NULL AUTO_INCREMENT COMMENT '香調編號', AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `item_lists`
--
ALTER TABLE `item_lists`
  MODIFY `itemListId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `item_tracking`
--
ALTER TABLE `item_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `multiple_images`
--
ALTER TABLE `multiple_images`
  MODIFY `multipleImageId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `paymentTypeId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=2;
