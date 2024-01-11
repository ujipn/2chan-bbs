-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-01-12 00:23:53
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
-- データベース: `bbs_test`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `body` varchar(200) NOT NULL,
  `post_date` datetime NOT NULL,
  `thread_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `comment`
--

INSERT INTO `comment` (`id`, `username`, `body`, `post_date`, `thread_id`) VALUES
(1, 'ujicode\r\n', 'こんにちは', '2023-12-06 12:33:41', 1),
(63, 'nara', 'rebe東吉野で合宿しました', '2024-01-11 14:07:28', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `thread`
--

INSERT INTO `thread` (`id`, `title`) VALUES
(1, '奈良スレ'),
(15, 'kakunin');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- テーブルのインデックス `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- テーブルの AUTO_INCREMENT `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
