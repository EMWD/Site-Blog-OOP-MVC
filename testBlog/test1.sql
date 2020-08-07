-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 07 2020 г., 20:30
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `name`, `description`, `text`) VALUES
(7, 'gwegewgegeg', 'Первый пост111111111', 'AAAAAAA'),
(3, 'gwegewgegeg', 'Первый пост111111111', 'AAAAAAA'),
(4, 'efweggwegwgeww', 'Чётвёртый', 'пшгрпакцрозпкорпкуолипк'),
(5, 'Такой-то пост', 'Второй пост', 'укащошацурщшкцпуароакуцилоаукц'),
(6, 'ЫЫЫЫЫ', 'Первый пост', 'купропкурололпикуиолдпку'),
(8, 'efweggwegwgeww', 'Чётвёртый', 'пшгрпакцрозпкорпкуолипк'),
(9, 'Такой-то пост', 'Второй пост', 'укащошацурщшкцпуароакуцилоаукц'),
(10, 'ЫЫЫЫЫ', 'Первый пост', 'купропкурололпикуиолдпку'),
(17, 'Такой-то пост', 'Второй пост', 'укащошацурщшкцпуароакуцилоаукц'),
(18, 'ЫЫЫЫЫ', 'Первый пост', 'купропкурололпикуиолдпку');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
