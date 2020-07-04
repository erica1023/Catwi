-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 6 月 25 日 02:00
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `catwi`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `sex` varchar(64) NOT NULL,
  `age` varchar(64) NOT NULL,
  `profile` text NOT NULL,
  `img` varchar(256) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `cats`
--

INSERT INTO `cats` (`id`, `name`, `sex`, `age`, `profile`, `img`, `users_id`, `created`) VALUES
(8, 'ブン太', 'オス', '3才', '立ち耳のスコティッシュフォールド。目がとにかく大きくて丸い。いつも驚いたような顔。ビビり。', 'post_images/e5fcf42e63d2b3721178e7f4a548da6b.jpeg', 3, '2020-06-23 12:54:00'),
(9, 'にゃろ', 'オス', '推定6才', '保護猫。食べることが大好き。爪切りが嫌い。尻尾の先がちょっとだけカギ。', 'post_images/b9da85cfb55282e01a74fb75024a748d.jpeg', 3, '2020-06-23 13:03:12'),
(10, 'みーちゃん', 'メス', '3才', 'ひたすらに人懐っこい。マンチカン。間違えてベランダに閉じ込めちゃった時はめちゃくちゃ怒ってた。', 'post_images/05847f29dbbfec725c3aedc085d042b6.jpeg', 2, '2020-06-23 16:17:23'),
(11, 'しらゆき', 'メス', '1才', 'ペルシャ。気が強くておてんば。感情表現が人間らしくてとてもいい。顔にすぐ出る。真菌だったためケージで過ごしていたせいで小さい。', 'post_images/ea9a12c94a20aaa17d590c296a415699.jpeg', 4, '2020-06-23 18:10:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `catwis`
--

CREATE TABLE `catwis` (
  `id` int(11) NOT NULL,
  `catwi_text` text NOT NULL,
  `img` varchar(256) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `catwis`
--

INSERT INTO `catwis` (`id`, `catwi_text`, `img`, `users_id`, `created`) VALUES
(15, 'ねむたいのかい', 'post_images/b9da85cfb55282e01a74fb75024a748d.jpeg', 3, '2020-06-23 12:01:07'),
(16, 'みてるねえ', 'post_images/e5fcf42e63d2b3721178e7f4a548da6b.jpeg', 3, '2020-06-23 13:10:47'),
(17, 'はいはいわかったよあそぼうね', 'post_images/05847f29dbbfec725c3aedc085d042b6.jpeg', 2, '2020-06-23 16:08:49'),
(18, 'ごきげんななめ', 'post_images/ea9a12c94a20aaa17d590c296a415699.jpeg', 4, '2020-06-23 18:23:11'),
(19, 'だっこいやだねごめんね', 'post_images/f528ca4a085205bacc8b937dfcd16b0d.jpeg', 4, '2020-06-23 19:17:16'),
(20, 'ねてばっかり', 'post_images/4eecda5ec5e76ecd66c015b3f8d20635.jpeg', 3, '2020-06-23 19:56:38'),
(21, 'なんではしるの', 'post_images/e879f928ad925fe294e8f69b0689c415.jpeg', 2, '2020-06-23 20:25:38'),
(24, 'ぬいぐるみ', 'post_images/c79d7368ce01f0cefe664b8cea419390.jpeg', 3, '2020-06-24 07:01:08');

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `catwis_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_name` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `comment`, `catwis_id`, `users_id`, `users_name`, `created`) VALUES
(1, 'ちなみに、大嫌いなブラッシングの直後の顔です。', 18, 4, 'えりか', '2020-06-23 18:34:41'),
(2, 'かわいい〜♡', 18, 2, 'erica', '2020-06-23 19:06:41'),
(5, '出入り口に寝ちゃってるのね笑', 15, 4, 'えりか', '2020-06-23 19:52:21'),
(6, 'お仕事してると視線を感じる…', 17, 2, 'erica', '2020-06-23 20:18:16'),
(8, 'トイレ後の謎ダッシュ', 21, 2, 'erica', '2020-06-23 20:28:16'),
(10, 'かわいい', 21, 3, '絵梨花', '2020-06-24 10:18:23');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `catwis_id` int(11) NOT NULL,
  `catwi_like` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `users_id`, `catwis_id`, `catwi_like`) VALUES
(1, 2, 20, 0),
(2, 2, 21, 1),
(3, 3, 18, 0),
(4, 3, 24, 1),
(5, 2, 24, 1),
(6, 3, 21, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `profile` text NOT NULL,
  `icon` varchar(256) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile`, `icon`, `created`) VALUES
(1, '管理人', 'kanri@gmail.com', 'kanri123', '管理人です', '', '2020-06-20 09:37:48'),
(2, 'erica', 'nekonekoneko@gmail.com', 'neko1023', 'ねこがすきです', 'post_images/IMG_6186.JPG', '2020-06-23 11:13:11'),
(3, '絵梨花', 'test@gmail.com', 'test123', 'ねこになりたいです', 'post_images/ae53e71638d50363751110fbef57e028.png', '2020-06-23 11:55:39'),
(4, 'えりか', 'test2@gmail.com', 'test123', 'ねことくらしています', 'post_images/IMG_5959.JPG', '2020-06-23 14:09:27'),
(5, 'test3', 'test3@gmail.com', 'test123', 'テスト', '', '2020-06-23 14:18:34');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `catwis`
--
ALTER TABLE `catwis`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id` (`users_id`,`catwis_id`) USING BTREE;

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルのAUTO_INCREMENT `catwis`
--
ALTER TABLE `catwis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルのAUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルのAUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
