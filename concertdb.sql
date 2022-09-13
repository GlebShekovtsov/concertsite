-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 13 2022 г., 03:15
-- Версия сервера: 8.0.29
-- Версия PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `concertdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `concerti`
--

CREATE TABLE `concerti` (
  `id` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `concerti`
--

INSERT INTO `concerti` (`id`, `img`, `name`, `date`, `group_name`, `genre`, `description`) VALUES
(1, 'zal1.jpg', 'Концерт имени Джорджа Флойда', '2022-09-05', 'Black Floyd', 'Абстрактный Рэп', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione aspernatur nisi debitis atque voluptatum dolores vero eveniet illum dolore, iure quasi nemo doloribus modi laboriosam quo exercitationem perspiciatis deleniti suscipit?\r\n'),
(2, 'zal2.jpg', 'Прощальный концерт Linkin Park в Волгограде', '2022-09-06', 'Linkin Park', 'Альтернативный метал, Рэп-рок, Ню-метал', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione explicabo dolorem magnam adipisci cum quos distinctio excepturi quia corrupti fugiat placeat, enim at est pariatur sequi iste unde sed atque.\r\n'),
(3, 'zal3.jpg', 'Михаил Муромов замораживает зал', '2022-09-07', 'Славяне', 'Поп', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa eos voluptatum voluptates quod sapiente ut, obcaecati consequuntur?');

-- --------------------------------------------------------

--
-- Структура таблицы `concert_zal`
--

CREATE TABLE `concert_zal` (
  `id` int NOT NULL,
  `id_concert` int NOT NULL,
  `sit_num` varchar(255) NOT NULL,
  `sit_status` varchar(255) NOT NULL,
  `sit_price` varchar(255) NOT NULL,
  `sit_direction` varchar(255) NOT NULL,
  `reserved_by_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `concert_zal`
--

INSERT INTO `concert_zal` (`id`, `id_concert`, `sit_num`, `sit_status`, `sit_price`, `sit_direction`, `reserved_by_id`) VALUES
(1, 1, '1', 'занятое', '2000', 'переднее', '123'),
(2, 1, '2', 'свободное', '2000', 'переднее', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `first-name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first-name`, `surname`, `login`, `password`) VALUES
(3, 'Валерий', 'Жмышко', 'jmixo', '$2y$10$TgrN4plXMy7uDDJTMdQAOOTKx6Hug0gsn.9t98Fxr6VGljkoeb9Mu'),
(5, '123', '123', '123', '$2y$10$XLBXSABsms4vPy6a9CmM9ObC6g19YpamgxQUbfAXBsJ/BlQS.Hrma');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `concerti`
--
ALTER TABLE `concerti`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `concert_zal`
--
ALTER TABLE `concert_zal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `concerti`
--
ALTER TABLE `concerti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `concert_zal`
--
ALTER TABLE `concert_zal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
