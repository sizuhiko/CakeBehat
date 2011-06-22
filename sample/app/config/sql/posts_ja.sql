-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2011 年 6 月 20 日 23:25
-- サーバのバージョン: 5.5.9
-- PHP のバージョン: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- データベース: `cakebehat_test`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- テーブルのデータをダンプしています `posts`
--

INSERT INTO `posts` VALUES(1, 'タイトル', 'これは、記事の本文です。', '2011-06-20 23:10:57', '2011-06-20 23:10:57');
INSERT INTO `posts` VALUES(2, 'またタイトル', 'そこに本文が続きます。', '2011-06-20 23:10:57', '2011-06-20 23:10:57');
INSERT INTO `posts` VALUES(3, 'Title strikes back', 'こりゃ本当にわくわくする！うそ。', '2011-06-20 23:10:57', '2011-06-20 23:10:57');
