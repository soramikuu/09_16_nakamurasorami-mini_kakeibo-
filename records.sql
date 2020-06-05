-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 6 月 05 日 16:31
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `mini_kakeibo`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `records`
--

INSERT INTO `records` (`id`, `title`, `type`, `amount`, `date`, `created_at`, `updated_at`) VALUES
(5, 'あさごはん', 1, 2000, '2020-06-24', '2020-06-05 09:25:03', '2020-06-05 09:25:03'),
(6, 'ごはん', 1, 1000, '2020-06-26', '2020-06-05 14:47:51', '2020-06-05 14:47:51'),
(7, 'VRゴーグル', 1, 30000, '2020-06-05', '2020-06-05 13:28:31', '2020-06-05 13:28:31'),
(9, 'あさごはん', 1, 6000, '2020-06-05', '2020-06-05 14:11:11', '2020-06-05 14:11:11'),
(11, 'ばんごはん', 1, 900, '2020-06-05', '2020-06-05 14:52:29', '2020-06-05 14:52:29');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
