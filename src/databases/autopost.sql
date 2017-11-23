-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 23 2017 г., 18:31
-- Версия сервера: 10.1.24-MariaDB
-- Версия PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2-autopost`
--

-- --------------------------------------------------------

--
-- Структура таблицы `api_settings`
--

CREATE TABLE `api_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `default_post` int(1) DEFAULT '2',
  `bottom_text` varchar(100) DEFAULT NULL,
  `bot_token` varchar(45) DEFAULT NULL,
  `channel_id` varchar(50) DEFAULT NULL,
  `app_id` varchar(16) DEFAULT NULL,
  `page_id` varchar(16) DEFAULT NULL,
  `api_key` varchar(25) DEFAULT NULL,
  `api_secret` varchar(50) DEFAULT NULL,
  `api_ver` varchar(5) DEFAULT NULL,
  `access_token` varchar(250) DEFAULT NULL,
  `token_secret` varchar(50) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `api_settings`
--

INSERT INTO `api_settings` (`id`, `type`, `default_post`, `bottom_text`, `bot_token`, `channel_id`, `app_id`, `page_id`, `api_key`, `api_secret`, `api_ver`, `access_token`, `token_secret`, `updated_at`, `status`) VALUES
(1, 'telegram', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'facebook', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'twitter', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);


--
-- Структура таблицы `autopost_history`
--

CREATE TABLE `autopost_history` (
  `id` int(11) NOT NULL,
  `tg_msg_id` varchar(35) DEFAULT NULL,
  `fb_msg_id` varchar(35) DEFAULT NULL,
  `tw_msg_id` varchar(35) DEFAULT NULL,
  `type` int(1) DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `link` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `soft_delete` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `api_settings`
--
ALTER TABLE `api_settings`
  ADD PRIMARY KEY (`id`);


--
-- Индексы таблицы `autopost_history`
--
ALTER TABLE `autopost_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `api_settings`
--
ALTER TABLE `api_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;



--
-- AUTO_INCREMENT для таблицы `autopost_history`
--
ALTER TABLE `autopost_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
