-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 03 2025 г., 12:22
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
  `content` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `content`) VALUES
(1, 6, 'first blog user', 'Hello, это первый блог юзера login, если вы это читаете, то функционал создания блога не вывел ошибку'),
(2, 6, '12312313113113', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi ullam sint itaque qui numquam officiis dignissimos exercitationem totam impedit aliquid cumque nam repudiandae, quaerat fugiat fugit excepturi et quisquam voluptates.'),
(3, 4, 'first alek blog', 'Немедленное удаление сессии иногда даёт нежелательные результаты. При одновременных запросах другие соединения сталкиваются с внезапной потерей данных сессии. К таким запросам, например, относятся JavaScript-запросы и (или) запросы, которые отправляет браузер при переходе по ссылкам на URL-адреса.\n\nТекущий модуль сессии хотя и не принимает блок данных cookie с пустым идентификатором сессии, немедленное удаление сессии из-за состояния гонки на стороне клиента (браузера) иногда создаёт cookie с пустым идентификатором сессии, из-за чего клиент создаёт серию ненужных идентификаторов сессии.\n\nНа клиенте не появятся условия гонки и клиент не создаст ненужные идентификаторы сессии, если установить в массиве $_SESSION временну́ю метку удаления сессии, а позже отклонить доступ к старому идентификатору сессии, или убедиться, что приложение не создаёт параллельные запросы. Это предупреждение также относится к функции session_regenerate_id().'),
(4, 6, 'xss atack', '&lt;script&gt;alert(&#039;Вы были взломаны!&#039;);&lt;/script&gt;'),
(7, 4, 'test delete blog', 'test delete blogtest delete blogtest delete blogtest delete blogtest delete blogtest delete blogtest delete blogtest delete blogtest delete blogtest delete blog'),
(8, 4, 'new blog usert test ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, consequatur. Asperiores distinctio ab pariatur blanditiis voluptas vel totam quas, facere, consectetur exercitationem architecto suscipit animi porro officiis dolorem corrupti tempora.\r\n'),
(9, 4, 'edit test', 'Lor edit blog m ipsum dolor sit amet consectetur adipisicing elit. Incidunt, consequatur. Asperiores distinctio ab pariatur blanditiis voluptas vel totam quas, facere, consectetur exercitationem architecto suscipit animi porro officiis dolorem corrupti tempora.\r\n');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
