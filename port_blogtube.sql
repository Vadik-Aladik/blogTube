-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 06 2025 г., 14:24
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `port_blogtube`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(14, 4, 'HELLO blogTUBE!', 'HELLO blogTUBE!HELLO blogTUBE!HELLO blogTUBE!HELLO blogTUBE!HELLO blogTUBE!HELLO blogTUBE!HELLO blogTUBE!', '2025-08-06'),
(15, 9, 'blog vadimky', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam itaque, accusamus dicta architecto distinctio ducimus deleniti maiores quasi ullam facilis. Quas reprehenderit, labore deleniti nisi exercitationem ullam. Ducimus, quaerat accusantium.\r\n', '2025-08-06');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1, 'loginTest', 'test@mail.ru', '$2y$10$h5yiKpuV92wilXxKCss7vuJIT4mIVTiWq.2E1hsaIEl0ATL2i7ZAa'),
(2, '^l.ogin=', 'login@mail.ru', '$2y$10$ATLJ1fPTBlT9Ksxu8d0CbuSFpOp.hl2zqSssCD6Xt/5HcgheH/cra'),
(3, 'qwer', 'qwer@mail.ru', '$2y$10$J5x.ndYtm.3d..8fK9.0EOGiVPv9wn9Q7a7Xg8FS5qvki4KxbwYwu'),
(4, 'alek', 'alek@mail.ru', '$2y$10$XPPzovX3bC6Oorghf8jY0e3I2ajk1KW8K3tdf1MpmPs/Nj6BOGXIe'),
(6, 'login', 'qwerty@mail.ru', '$2y$10$kOMpMk31yAO7Gm8uDj6as.GvSPpOp4JgHvvOZaXIHmfWoR.2qXLf6'),
(7, 'zxcv', 'zxcv@mail.ru', '$2y$10$MXHRcrnWoRxvbgqYn5I/ROZKIJXnCL88HV1jYJxeEfogZw2Dm1.2G'),
(8, 'nba', 'nba@nba', '$2y$10$J7atlXoNDs3oNwWnaqLzPOyZjsFKnG.9mDNLo1USgQrBWbLhXXVuK'),
(9, 'vadim', 'vd@mail.ru', '$2y$10$AhX8WgqcVlF6GBwmJK0TceWo5ht6qW9FvBQqoRdcePJAaXN9k.ESa');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
