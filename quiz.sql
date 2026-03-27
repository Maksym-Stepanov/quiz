-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 27 2026 г., 01:42
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `quiz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) DEFAULT 0,
  `label` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `label`) VALUES
(1, 1, 'Londyn', 0, 'A'),
(2, 1, 'Paryż', 1, 'B'),
(3, 1, 'Rzym', 0, 'C'),
(4, 1, 'Madryt', 0, 'D'),
(5, 2, 'Berlin', 1, 'A'),
(6, 2, 'Monachium', 0, 'B'),
(7, 2, 'Wiedeń', 0, 'C'),
(8, 2, 'Praga', 0, 'D'),
(9, 3, 'Wenecja', 0, 'A'),
(10, 3, 'Mediolan', 0, 'B'),
(11, 3, 'Rzym', 1, 'C'),
(12, 3, 'Neapol', 0, 'D'),
(13, 4, 'Kraków', 0, 'A'),
(14, 4, 'Warszawa', 1, 'B'),
(15, 4, 'Gdańsk', 0, 'C'),
(16, 4, 'Wrocław', 0, 'D'),
(17, 5, 'Barcelona', 0, 'A'),
(18, 5, 'Sewilla', 0, 'B'),
(19, 5, 'Madryt', 1, 'C'),
(20, 5, 'Walencja', 0, 'D'),
(21, 6, 'Lizbona', 1, 'A'),
(22, 6, 'Porto', 0, 'B'),
(23, 6, 'Madryt', 0, 'C'),
(24, 6, 'Faro', 0, 'D'),
(25, 7, 'Brno', 0, 'A'),
(26, 7, 'Ostrawa', 0, 'B'),
(27, 7, 'Praga', 1, 'C'),
(28, 7, 'Pilzno', 0, 'D'),
(29, 8, 'Ateny', 1, 'A'),
(30, 8, 'Saloniki', 0, 'B'),
(31, 8, 'Rodos', 0, 'C'),
(32, 8, 'Heraklion', 0, 'D'),
(33, 9, 'Budapeszt', 1, 'A'),
(34, 9, 'Debreczyn', 0, 'B'),
(35, 9, 'Pecz', 0, 'C'),
(36, 9, 'Szeged', 0, 'D'),
(37, 10, 'Salzburg', 0, 'A'),
(38, 10, 'Innsbruck', 0, 'B'),
(39, 10, 'Wiedeń', 1, 'C'),
(40, 10, 'Linz', 0, 'D');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question_text`) VALUES
(1, 'Jakie miasto jest stolicą Francji?'),
(2, 'Jakie miasto jest stolicą Niemiec?'),
(3, 'Jakie miasto jest stolicą Włoch?'),
(4, 'Jakie miasto jest stolicą Polski?'),
(5, 'Jakie miasto jest stolicą Hiszpanii?'),
(6, 'Jakie miasto jest stolicą Portugalii?'),
(7, 'Jakie miasto jest stolicą Czech?'),
(8, 'Jakie miasto jest stolicą Grecji?'),
(9, 'Jakie miasto jest stolicą Węgier?'),
(10, 'Jakie miasto jest stolicą Austrii?');

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `username`, `score`, `created_at`) VALUES
(7, 'xe70c8cf3', 3, '2026-03-26 18:15:48'),
(8, 'x94ae4b73', 2, '2026-03-26 22:35:35'),
(9, 'x181f7400', 2, '2026-03-26 22:36:26');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
