-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-12-15 00:31:23
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
-- データベース: `2chan-bbs`
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
(2, 'testuser', 'こんばんは', '2023-12-06 12:34:51', 1),
(3, 'えんじにあ', 'ｓうげー', '2023-12-06 12:35:25', 1),
(31, 'test', 'test', '2023-12-07 12:34:19', 11),
(33, 'test', 'test', '2023-12-07 12:49:24', 1),
(37, 'test', 'test', '2023-12-07 23:08:05', 1),
(38, 'ujicode', 'ujicode', '2023-12-07 23:08:54', 11),
(40, 'test', 'testdayo', '2023-12-09 04:55:24', 11),
(41, 'test', 'test', '2023-12-09 05:08:02', 1),
(42, 'as', 'dsd', '2023-12-09 05:08:14', 14);

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
(1, '掲示板作成中'),
(2, 'PHP勉強中'),
(4, 'testスレッド'),
(11, 'test'),
(14, 'tes');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- テーブルの AUTO_INCREMENT `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
