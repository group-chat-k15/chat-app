-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 21, 2019 lúc 10:32 CH
-- Phiên bản máy phục vụ: 5.7.14
-- Phiên bản PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chat_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `add_friend`
--

CREATE TABLE `add_friend` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friends_id` int(11) DEFAULT NULL,
  `count_notifi` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `add_friend`
--

INSERT INTO `add_friend` (`id`, `user_id`, `friends_id`, `count_notifi`, `status`) VALUES
(26, 103, 102, NULL, 1),
(28, 102, 103, NULL, 1),
(33, 102, 105, 1, 1),
(35, 105, 102, 2, 1),
(36, 105, 104, NULL, 1),
(37, 105, 103, NULL, 0),
(38, 104, 105, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `vn_detail` longtext,
  `to_id` int(11) DEFAULT NULL,
  `from_id` int(11) NOT NULL,
  `image_list` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `tid` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `tid`, `username`, `password`, `name`, `birthday`, `sex`, `phone`, `address`, `image_link`, `status`, `created`) VALUES
(102, NULL, 'user1', '123', 'Nguyễn Văn A', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, NULL, 'user2', '123', 'Nguyễn Văn B', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, NULL, 'user3', '123', 'Nguyễn Văn D', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, NULL, 'user4', '123', 'Nguyễn Văn C', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `add_friend`
--
ALTER TABLE `add_friend`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `add_friend`
--
ALTER TABLE `add_friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
