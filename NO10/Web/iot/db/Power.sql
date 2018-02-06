-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2017 年 12 月 17 日 16:44
-- 伺服器版本: 5.5.57-MariaDB
-- PHP 版本： 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `Power`
--

-- --------------------------------------------------------

--
-- 資料表結構 `DeviceType`
--

CREATE TABLE `DeviceType` (
  `s_id` int(11) NOT NULL COMMENT '主鍵',
  `s_name` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '裝置型態',
  `s_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '資料更新時間'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `DeviceType`
--

INSERT INTO `DeviceType` (`s_id`, `s_name`, `s_update`) VALUES
(11, 'æ©Ÿæˆ¿', '2017-12-17 07:29:14'),
(10, 'é›»è…¦æ•™å®¤', '2017-12-17 07:29:07'),
(7, 'é¤å»³', '2017-12-17 07:40:33'),
(8, 'æ³³æ± ', '2017-12-17 07:40:27'),
(9, 'å¥èº«æˆ¿', '2017-12-17 07:40:21'),
(12, 'å¯¦é©—å®¤', '2017-12-17 07:29:24');

-- --------------------------------------------------------

--
-- 資料表結構 `Node`
--

CREATE TABLE `Node` (
  `s_id` int(11) NOT NULL COMMENT '主鍵',
  `site_id` int(11) NOT NULL COMMENT '客戶主鍵',
  `s_mac` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'DEVICE_MAC',
  `s_name` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '裝置名稱',
  `s_type` int(11) NOT NULL COMMENT '裝置型態',
  `s_start` datetime DEFAULT NULL COMMENT '開始時間',
  `s_end` datetime DEFAULT NULL COMMENT '結束時間',
  `s_used` int(11) NOT NULL COMMENT '是否還在使用',
  `s_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新資料時間'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `Node`
--

INSERT INTO `Node` (`s_id`, `site_id`, `s_mac`, `s_name`, `s_type`, `s_start`, `s_end`, `s_used`, `s_update`) VALUES
(1, 3, 'aaaaaaaaaaaa', '教室監控01', 10, NULL, NULL, 1, '2017-12-17 07:52:48'),
(2, 3, 'bbbbbbbbbbbb', '電腦教室310', 10, NULL, NULL, 1, '2017-12-17 07:52:56'),
(3, 3, '111111111111', '310', 10, NULL, NULL, 1, '2017-12-17 07:53:04'),
(4, 3, '333333333333', '23.955417', 12, NULL, NULL, 1, '2017-12-17 07:52:13');

-- --------------------------------------------------------

--
-- 資料表結構 `Site`
--

CREATE TABLE `Site` (
  `s_id` int(11) NOT NULL COMMENT '主鍵',
  `s_name` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '實施點 名字',
  `s_lat` double NOT NULL COMMENT '緯度',
  `s_lon` double NOT NULL COMMENT '經度',
  `s_addr1` char(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登記住址',
  `s_addr2` char(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '實際住址',
  `s_tel1` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話一',
  `s_tel2` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話二',
  `s_fax` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '傳真',
  `s_contact` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '聯絡人',
  `s_mobile` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '聯絡人手機',
  `s_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `Site`
--

INSERT INTO `Site` (`s_id`, `s_name`, `s_lat`, `s_lon`, `s_addr1`, `s_addr2`, `s_tel1`, `s_tel2`, `s_fax`, `s_contact`, `s_mobile`, `s_update`) VALUES
(4, '0', 1, 1, '1', '1', '1', '1', '1', '1', '1', '2017-12-17 07:00:44'),
(3, 'åœ‹ç«‹æš¨å—å¤§å­¸', 23.955417, 120.927204, '545å—æŠ•ç¸£åŸ”é‡ŒéŽ®å¤§å­¸è·¯1è™Ÿ', '545å—æŠ•ç¸£åŸ”é‡ŒéŽ®å¤§å­¸è·¯1è™Ÿ', '049-291 0960', '049-291 0960', '049-291 0960', 'éƒ­è€€æ–‡', '0985-05666', '2017-12-17 07:00:30');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `DeviceType`
--
ALTER TABLE `DeviceType`
  ADD PRIMARY KEY (`s_id`);

--
-- 資料表索引 `Node`
--
ALTER TABLE `Node`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `site` (`site_id`),
  ADD KEY `MAC` (`s_mac`);

--
-- 資料表索引 `Site`
--
ALTER TABLE `Site`
  ADD PRIMARY KEY (`s_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `DeviceType`
--
ALTER TABLE `DeviceType`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主鍵', AUTO_INCREMENT=13;

--
-- 使用資料表 AUTO_INCREMENT `Node`
--
ALTER TABLE `Node`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主鍵', AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `Site`
--
ALTER TABLE `Site`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主鍵', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
