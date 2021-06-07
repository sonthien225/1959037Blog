-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 07, 2021 lúc 03:32 AM
-- Phiên bản máy phục vụ: 5.7.31
-- Phiên bản PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `blog`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `comment_author` int(11) NOT NULL,
  `comment_post` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_comment` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`ID`, `comment`, `comment_author`, `comment_post`, `date_created`, `parent_comment`) VALUES
(19, 'hello\n', 9, 27, '2021-06-07 09:36:08', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Image` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`ID`, `Title`, `Content`, `Post_ID`, `Author`, `Date_time`, `Image`) VALUES
(27, 'Ã¡Ä‘áº¥', 'gdfwÃ¨', 9, 'sonthien', '2021-06-07 09:35:53', 'images/2_60bd860987dd6.png'),
(26, 'Ã¡Ä‘Ã¢s', 'Ã adfÃ¡dfdsf', 10, 'sonthien', '2021-06-07 09:31:37', 'images/1_60bd85094c857.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `pw1` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `test`
--

INSERT INTO `test` (`ID`, `Name`, `Email`, `pw1`, `Gender`, `date_time`) VALUES
(13, 'admin', 'admin@gmail.com', '$2y$10$pGsDz.fhWk6IrIVYZ5Fr5OcGKAEVENFan3viXu8fgIqy8Spl6.2i.', '', '2021-06-07 10:20:38'),
(9, 'sonthien', 'sonthien225@gmail.com', '$2y$10$hGd6Ui0XLcjBXRE69fSKUuFxWQa15A1Mtm1tSooL4YKOfoHSfkciy', '', '2021-06-07 09:35:26'),
(10, 'thuylinh', 'thuylinh@gmail.com', '$2y$10$dKx6aJZ93opSgbFe.KZbEuvEJnSNFNEzOp9gpCG7FepoYjundVMZi', '', '2021-06-07 09:39:04'),
(11, 'bbbbbbb', 'bbbbbbb@gmail.com', '$2y$10$K4KK/eZum1UpRvv2W4Pnje27aZzU9yGXNP5mnrCsukBgo.brzq6rS', '', '2021-06-07 09:41:16'),
(12, 'thuylinh111', 'thuylinh111@gmail.com', '$2y$10$DY2Ckk2.HmnEQNCq/..qVOZvk6YCN7awl8kl44um64nsEfnaTAHCS', '', '2021-06-07 09:47:52');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
