-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 04 月 25 日 05:48
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
-- 資料表結構 `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL COMMENT '品牌編號',
  `brandName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌名稱',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL COMMENT '流水號',
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別名稱',
  `categoryParentId` int(11) DEFAULT NULL COMMENT '上層編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='類別資料表';

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryParentId`, `created_at`, `updated_at`) VALUES
(4, '身體保養', 0, '2020-04-23 15:20:11', '2020-04-23 15:20:11');

-- --------------------------------------------------------

--
-- 資料表結構 `class`
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
-- 資料表結構 `classcategory`
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
  `couponStart` datetime DEFAULT NULL,
  `couponEnd` datetime DEFAULT NULL,
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
(1, '', 'Maison Margiela_’REPLICA’ Beach Walk', 'item_20200423092036.jpg', '', '', 100, 1532, 10, 4, '', '', '', '2020-04-23 15:20:36', '2020-04-24 23:03:28'),
(6, '', 'aaaa', 'item_20200423120510.png', '', '', 0, 1111, 111, 4, '', '', '', '2020-04-23 18:05:10', '2020-04-23 18:05:10'),
(7, '', '000', 'item_20200424080734.png', '', '', 0, 100, 1, 4, '', '', '', '2020-04-24 14:07:33', '2020-04-24 14:07:33');

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
(10, 'multiple_images_20200424150428_8.jpg', 6, '2020-04-24 23:04:28', '2020-04-24 23:04:28');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL COMMENT '流水號',
  `orderCode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '訂單編號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用者帳號',
  `orderPrice` int(100) DEFAULT NULL,
  `paymentTypeId` int(11) DEFAULT NULL COMMENT '付款方式',
  `couponId` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '優惠券編號',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='結帳資料表';

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderId`, `orderCode`, `username`, `orderPrice`, `paymentTypeId`, `couponId`, `created_at`, `updated_at`) VALUES
(1, '', 'rose123@gmail.com', 0, 1, '1', '2020-04-23 13:13:34', '2020-04-23 16:58:42'),
(2, '', 'abc', 0, 1, NULL, '2020-04-23 17:20:32', '2020-04-23 17:20:32'),
(3, '', 'abc', 0, 1, NULL, '2020-04-23 18:05:42', '2020-04-23 18:05:42'),
(4, '', 'abc', 0, 1, NULL, '2020-04-23 18:08:59', '2020-04-23 18:08:59'),
(5, '', 'rose123@gmail.com', 0, 1, NULL, '2020-04-24 09:56:41', '2020-04-24 09:56:41');

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
(1, 'credit', 'payment_type_20200423071155.jpg', '2020-04-23 13:11:56', '2020-04-23 13:11:56');

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
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
-- 資料表結構 `users`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌編號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `classcategory`
--
ALTER TABLE `classcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `couponId` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `formulation`
--
ALTER TABLE `formulation`
  MODIFY `formulationId` int(11) NOT NULL AUTO_INCREMENT COMMENT '質地編號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fragrance`
--
ALTER TABLE `fragrance`
  MODIFY `fragranceId` int(11) NOT NULL AUTO_INCREMENT COMMENT '香調編號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `item_lists`
--
ALTER TABLE `item_lists`
  MODIFY `itemListId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `item_tracking`
--
ALTER TABLE `item_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `multiple_images`
--
ALTER TABLE `multiple_images`
  MODIFY `multipleImageId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `paymentTypeId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=2;