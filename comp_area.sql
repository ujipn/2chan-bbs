-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-01-05 06:26:51
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `comp_area`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `retreat_locations`
--

CREATE TABLE `retreat_locations` (
  `id` int(11) NOT NULL,
  `area` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `address` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `conference` varchar(100) NOT NULL,
  `stay` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `retreat_locations`
--

INSERT INTO `retreat_locations` (`id`, `area`, `name`, `latitude`, `longitude`, `address`, `capacity`, `conference`, `stay`, `url`) VALUES
(1, 'nara', '信貴山大本山玉蔵院', 34.609677039033, 135.66970375179, '奈良県生駒郡平群町信貴山2280', 100, '有', '可', 'https://gyokuzo.com/'),
(2, 'nara', 'ホテル奈良さくらいの郷', 34.48852224, 135.83987933, '奈良県桜井市大字高家2220-1', 50, '有', '可', 'https://hotelnarasakurai.com/');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `retreat_locations`
--
ALTER TABLE `retreat_locations`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `retreat_locations`
--
ALTER TABLE `retreat_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
