-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 18 2022 г., 23:23
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
-- База данных: `concertdb_new`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE `booking` (
  `id_booking` int NOT NULL,
  `id_raspisanie` int NOT NULL,
  `id_user` int NOT NULL,
  `id_sits` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`id_booking`, `id_raspisanie`, `id_user`, `id_sits`) VALUES
(3, 1, 1234, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `concerti`
--

CREATE TABLE `concerti` (
  `id` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `concerti`
--

INSERT INTO `concerti` (`id`, `img`, `name`, `group_name`, `genre`, `description`) VALUES
(1, 'zal1.jpg\r\n', 'Концерт имени Джорджа Флойда', 'Black Floyd', 'Black nigga rap', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione aspernatur nisi debitis atque voluptatum dolores vero eveniet illum dolore, iure quasi nemo doloribus modi laboriosam quo exercitationem perspiciatis deleniti suscipit?'),
(2, 'zal2.jpg', 'Прощальный концерт Linkin Park в Волгограде', 'Linkin Park', 'Альтернативный метал, Рэп-рок, Ню-метал', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione explicabo dolorem magnam adipisci cum quos distinctio excepturi quia corrupti fugiat placeat, enim at est pariatur sequi iste unde sed atque.\r\n'),
(3, 'zal3.jpg', 'Михаил Муромов замораживает зал', 'Славяне', 'Поп', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa eos voluptatum voluptates quod sapiente ut, obcaecati consequuntur?');

-- --------------------------------------------------------

--
-- Структура таблицы `direction`
--

CREATE TABLE `direction` (
  `id` int NOT NULL,
  `direction_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `direction`
--

INSERT INTO `direction` (`id`, `direction_name`) VALUES
(1, 'танцпол'),
(2, 'балкон');

-- --------------------------------------------------------

--
-- Структура таблицы `raspisanie`
--

CREATE TABLE `raspisanie` (
  `id_raspisanie` int NOT NULL,
  `id_concert` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `raspisanie`
--

INSERT INTO `raspisanie` (`id_raspisanie`, `id_concert`, `date`, `time`) VALUES
(1, 1, '2022-10-18', '19:00'),
(2, 2, '2022-09-06', '17:35'),
(3, 3, '2022-10-18', '13:50'),
(4, 1, '2022-10-19', '21:00');

-- --------------------------------------------------------

--
-- Структура таблицы `row`
--

CREATE TABLE `row` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `row`
--

INSERT INTO `row` (`id`, `name`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8');

-- --------------------------------------------------------

--
-- Структура таблицы `sits`
--

CREATE TABLE `sits` (
  `id_sit` int NOT NULL,
  `id_raspisanie` int NOT NULL,
  `sit_status` varchar(255) NOT NULL,
  `sit_price` varchar(255) NOT NULL,
  `id_direction` int NOT NULL,
  `id_row` int NOT NULL,
  `sit_num` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sits`
--

INSERT INTO `sits` (`id_sit`, `id_raspisanie`, `sit_status`, `sit_price`, `id_direction`, `id_row`, `sit_num`) VALUES
(1, 1, 'занятое', '2000', 2, 3, '1'),
(2, 1, 'занятое', '3000', 2, 6, '4'),
(3, 1, 'занятое', '3000', 2, 5, '4'),
(4, 4, 'занятое', '1500', 2, 8, '1'),
(5, 1, 'занятое', '1337', 2, 1, '1');

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
(1, '', '', 'wormiks', ''),
(2, 'Джордж', 'Вормикс', 'wormix', '$2y$10$egOswUDdTXaTv6k072phSOeRXjWVxiZSOEpczjrrgBuYAD.H2f9jW'),
(3, 'Джордж', 'Вормикс', 'wormix', '$2y$10$Y3bAfKOzXJMugaRIdsXZfuCNDlpqq0cDzUAIn4QiDUeoaEHgX.jYi'),
(4, 'Джордж', 'Вормикс', 'wormix', '$2y$10$vsffo9LfGcpsiznSXe3gtOnrmye4Grvq24TQVbblQ3XqBQSzozkzy'),
(5, '1234', '1234', '1234', '$2y$10$o05bR2ZaY3gkjTrmd6Gbb.yRsh1GN5Y3PLUKYnpWOYWpBU4ijmwdi');

-- --------------------------------------------------------

--
-- Структура таблицы `user_history`
--

CREATE TABLE `user_history` (
  `id` int NOT NULL,
  `action` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `id_concert` int NOT NULL,
  `id_sit` int NOT NULL,
  `action_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_history`
--

INSERT INTO `user_history` (`id`, `action`, `date`, `id_concert`, `id_sit`, `action_by`) VALUES
(1, 'бронь', '2022-10-18 20:14:38', 1, 2, '1234'),
(2, 'бронь', '2022-10-18 20:14:39', 1, 2, '1234'),
(3, 'бронь', '2022-10-18 20:15:12', 1, 3, '1234'),
(6, 'бронь', '2022-10-18 21:26:09', 4, 4, '1234'),
(7, 'бронь', '2022-10-18 22:04:46', 4, 4, '1234'),
(8, 'бронь', '2022-10-18 22:05:53', 4, 4, '1234'),
(9, 'снятие брони', '2022-10-18 23:18:49', 1, 4, '1234'),
(10, 'бронь', '2022-10-18 23:20:31', 1, 5, '1234');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `order_ibfk_1` (`id_raspisanie`),
  ADD KEY `id_sits` (`id_sits`);

--
-- Индексы таблицы `concerti`
--
ALTER TABLE `concerti`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `raspisanie`
--
ALTER TABLE `raspisanie`
  ADD PRIMARY KEY (`id_raspisanie`),
  ADD KEY `id_concert` (`id_concert`);

--
-- Индексы таблицы `row`
--
ALTER TABLE `row`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sits`
--
ALTER TABLE `sits`
  ADD PRIMARY KEY (`id_sit`),
  ADD KEY `id_concert` (`id_raspisanie`),
  ADD KEY `id_direction` (`id_direction`),
  ADD KEY `id_row` (`id_row`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_concert` (`id_concert`),
  ADD KEY `id_sit` (`id_sit`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `concerti`
--
ALTER TABLE `concerti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `raspisanie`
--
ALTER TABLE `raspisanie`
  MODIFY `id_raspisanie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `row`
--
ALTER TABLE `row`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `sits`
--
ALTER TABLE `sits`
  MODIFY `id_sit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `raspisanie`
--
ALTER TABLE `raspisanie`
  ADD CONSTRAINT `raspisanie_ibfk_1` FOREIGN KEY (`id_concert`) REFERENCES `concerti` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `sits`
--
ALTER TABLE `sits`
  ADD CONSTRAINT `sits_ibfk_1` FOREIGN KEY (`id_raspisanie`) REFERENCES `raspisanie` (`id_raspisanie`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sits_ibfk_2` FOREIGN KEY (`id_direction`) REFERENCES `direction` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sits_ibfk_3` FOREIGN KEY (`id_row`) REFERENCES `row` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
