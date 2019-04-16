-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 16 2019 г., 03:16
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dzen`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `user_ip` varchar(16) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `home_page` varchar(128) DEFAULT NULL,
  `text` text NOT NULL,
  `file_name` varchar(256) DEFAULT NULL,
  `file_type` varchar(10) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_name`, `user_ip`, `user_agent`, `email`, `home_page`, `text`, `file_name`, `file_type`, `parent`, `created_at`) VALUES
(1, 'gw1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', 'http://sumtsow.ho.ua', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'flag_uk.png', 'image.png', 0, '2019-04-09 23:19:27'),
(2, 'user', '10.24.33.109', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'user@gmail.com', 'http://irss.zzz.com.ua', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href=\"#\">Duis aute irure</a> dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 1, '2019-04-10 12:56:57'),
(3, 'nobody', '192.198.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'anonymous@server.net', '', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 2, '2019-04-10 15:34:11'),
(4, 'admin', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'admin@gmail.com', '', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href=\"#\">Duis aute irure</a> dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 15:34:11'),
(5, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'Hello World!', '', '', 0, '2019-04-11 01:07:15'),
(6, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'Some assumptions\r\nThis tutorial assumes that you are running at least PHP 5.3.23 with the Apache web server and MySQL, accessible via the PDO extension. Your Apache installation must have the mod_rewrite extension installed and configured.', '', '', 0, '2019-04-11 20:04:18'),
(7, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, '<a href=\"#\">The application that we are going to build</a> is a simple inventory system to display which albums we own. The main page will list our collection and allow us to add, edit and delete CDs. We are going to need four pages in our website:', '', '', 0, '2019-04-11 20:19:29'),
(8, 'guest', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, 'Page \\t Description\r\nList of albums \\t This will display the list of albums and provide links to edit and delete them. Also, a link to enable adding new albums will be provided.', '', '', 7, '2019-04-11 20:26:05'),
(9, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/73.0.3683.86 Chrome/73.0.3683.86 Safari/537.36', 'admin@meta.ua', NULL, 'Add new album 	This page will provide a form for adding a new album.', '', '', 7, '2019-04-11 20:28:11'),
(10, 'rew2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'В режиме UTF-8, символы со значениями, превышающими 128, не совпадут ни с одним из символьных классов POSIX. Начиная с PHP 5.3.0 и libpcre 8.10 некоторые символьные классы изменены, чтобы использовать свойства символов Unicode, в этом случае упомянутое ограничение не применяется. &lt;code&gt;Читайте » руководство PCRE(3) для подробностей&lt;/code&gt;.', '', '', 3, '2019-04-13 20:07:16'),
(11, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'dmytro.sumtsow@nure.ua', 'http://irzz.zzz.com.ua', 'Zend\\Form\\Element\\Captcha can be used with forms where authenticated users are not necessary, but you want to prevent spam submissions. It is paired with one of the Zend\\Form\\View\\Helper\\Captcha\\* view helpers that matches the type of CAPTCHA adapter in use.', '', '', 0, '2019-04-13 20:20:26'),
(12, 'gw1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', 'http://sumtsow.ho.ua', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-09 23:19:27'),
(13, 'user', '10.24.33.109', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'user@gmail.com', 'http://irss.zzz.com.ua', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 12:56:57'),
(14, 'nobody', '192.198.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'anonymous@server.net', '', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 15:34:11'),
(15, 'admin', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'admin@gmail.com', '', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 15:34:11'),
(16, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'Hello World!', '', '', 0, '2019-04-11 01:07:15'),
(17, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'Some assumptions\r\nThis tutorial assumes that you are running at least PHP 5.3.23 with the Apache web server and MySQL, accessible via the PDO extension. Your Apache installation must have the mod_rewrite extension installed and configured.', '', '', 0, '2019-04-11 20:04:18'),
(18, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'The application that we are going to build is a simple inventory system to display which albums we own. The main page will list our collection and allow us to add, edit and delete CDs. We are going to need four pages in our website:', '', '', 0, '2019-04-11 20:19:29'),
(19, 'guest', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, 'Page \\t Description\r\nList of albums \\t This will display the list of albums and provide links to edit and delete them. Also, a link to enable adding new albums will be provided.', '', '', 0, '2019-04-11 20:26:05'),
(20, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/73.0.3683.86 Chrome/73.0.3683.86 Safari/537.36', 'admin@meta.ua', NULL, '<code>Add new album 	This page will provide a form for adding a new album.</code>', '', '', 0, '2019-04-11 20:28:11'),
(21, 'rew2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'В режиме UTF-8, символы со значениями, превышающими 128, не совпадут ни с одним из символьных классов POSIX. Начиная с PHP 5.3.0 и libpcre 8.10 некоторые символьные классы изменены, чтобы использовать свойства символов Unicode, в этом случае упомянутое ограничение не применяется. Читайте » руководство PCRE(3) для подробностей.', '', '', 0, '2019-04-13 20:07:16'),
(22, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'dmytro.sumtsow@nure.ua', 'http://irzz.zzz.com.ua', '&lt;a href=&quot;#&quot;&gt;Zend\\Form\\Element\\Captcha&lt;/a&gt; can be used with forms where authenticated users are not necessary, but you want to prevent spam submissions. It is paired with one of the Zend\\Form\\View\\Helper\\Captcha\\* view helpers that matches the type of CAPTCHA adapter in use.', '', '', 0, '2019-04-13 20:20:26'),
(23, 'gw1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', 'http://sumtsow.ho.ua', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-09 23:19:27'),
(24, 'user', '10.24.33.109', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'user@gmail.com', 'http://irss.zzz.com.ua', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 12:56:57'),
(25, 'nobody', '192.198.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'anonymous@server.net', '', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 15:34:11'),
(26, 'admin', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'admin@gmail.com', '', '&lt;strong&gt;Lorem ipsum&lt;/strong&gt; dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', 0, '2019-04-10 15:34:11'),
(27, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'Hello World!', '', '', 0, '2019-04-11 01:07:15'),
(28, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'Some assumptions\r\nThis tutorial assumes that you are running at least PHP 5.3.23 with the Apache web server and MySQL, accessible via the PDO extension. Your Apache installation must have the mod_rewrite extension installed and configured.', '', '', 0, '2019-04-11 20:04:18'),
(29, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'The application that we are going to build is a simple inventory system to display which albums we own. The main page will list our collection and allow us to add, edit and delete CDs. We are going to need four pages in our website:', '', '', 0, '2019-04-11 20:19:29'),
(30, 'guest', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, 'Page \\t Description\r\nList of albums \\t This will display the list of albums and provide links to edit and delete them. Also, a link to enable adding new albums will be provided.', '', '', 0, '2019-04-11 20:26:05'),
(31, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/73.0.3683.86 Chrome/73.0.3683.86 Safari/537.36', 'admin@meta.ua', NULL, 'Add new album 	This page will provide a form for adding a new album.', '', '', 0, '2019-04-11 20:28:11'),
(32, 'rew2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'В режиме UTF-8, символы со значениями, превышающими 128, не совпадут ни с одним из символьных классов POSIX. Начиная с PHP 5.3.0 и libpcre 8.10 некоторые символьные классы изменены, чтобы использовать свойства символов Unicode, в этом случае упомянутое ограничение не применяется. Читайте » руководство PCRE(3) для подробностей.', '', '', 0, '2019-04-13 20:07:16'),
(33, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'dmytro.sumtsow@nure.ua', 'http://irzz.zzz.com.ua', 'Zend\\Form\\Element\\Captcha can be used with forms where authenticated users are not necessary, but you want to prevent spam submissions. It is paired with one of the Zend\\Form\\View\\Helper\\Captcha\\* view helpers that matches the type of CAPTCHA adapter in use.', '', '', 0, '2019-04-13 20:20:26'),
(34, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', 'http://irzz.zzz.com.ua', 'Zend\\Captcha\\AbstractWord is an abstract adapter that serves as the base class for most other CAPTCHA adapters. It provides mutators for specifying word length, session TTL and the session container object to use; it also encapsulates validation logic.', '', '', 0, '2019-04-14 14:29:51'),
(35, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, '\'dom.co1\' is not a valid &lt;i&gt;hostname&lt;/i&gt; for the email address\r\n    The input appears to be a DNS &lt;i&gt;hostname&lt;/i&gt; but cannot match TLD against known list\r\n    The input appears to be a local network name but local network names are not allowed', '', '', 4, '2019-04-14 14:31:45'),
(36, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'dmytro.sumtsow@nure.ua', NULL, 'I migrated from ZF2 to ZF3. Now I have a problem. My view script is in the right place, the configuration seems ok, but I get the following error:\r\n\r\n    Zend\\View\\Renderer\\PhpRenderer::render: Unable to render template \"parties/controllers/write-party/add\"; resolver could not resolve to a file\r\n\r\nwhich is a fairly common error to solve, but the problem is that for some reason, I get controllers folder in the template path. The template path should be parties/write-party/add.', '', '', 0, '2019-04-14 15:30:40'),
(37, 'sumtsow', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, '\" \" (ASCII 32 (0x20)), обычный пробел.\r\n    \"\\t\" (ASCII 9 (0x09)), символ табуляции.\r\n    \"\\n\" (ASCII 10 (0x0A)), символ перевода строки.\r\n    \"\\r\" (ASCII 13 (0x0D)), символ возврата каретки.\r\n    \"\\0\" (ASCII 0 (0x00)), NUL-байт.\r\n    \"\\x0B\" (ASCII 11 (0x0B)), вертикальная табуляция.', '', '', 0, '2019-04-14 16:54:01'),
(38, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'any@dom.com', NULL, 'trim\r\n(PHP 4, PHP 5, PHP 7)\r\ntrim — Удаляет пробелы (или другие символы) из начала и конца строки', '', '', 0, '2019-04-14 17:27:07'),
(39, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, 'Prompts and default values\r\n\r\n    All prompts emitted by the installer provide the list of options available, and will specify the default option via a capital letter. Default values are used if the user presses \"Enter\" with no value. In the previous example, \"Y\" is the default.', '', '', 9, '2019-04-14 18:03:19'),
(40, 'rew5', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'artliceum@ukr.net', NULL, 'The developer toolbar provides an in-browser toolbar with timing and profiling information, and can be useful when debugging an application. For the purposes of the tutorial, however, we will not be using it; hit either \"Enter\", or \"n\" followed by \"Enter\".', '', '', 9, '2019-04-14 18:04:57'),
(41, 'sumtsow', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'dmytro.sumtsow@nure.ua', NULL, 'CommonMark\\Node\\Document &mdash; Document concrete CommonMark\\Node\r\nCommonMark\\Node\\Heading &mdash; Heading concrete CommonMark\\Node\r\nCommonMark\\Node\\Paragraph &mdash; Paragraph concrete CommonMark\\Node\r\nCommonMark\\Node\\BlockQuote &mdash; BlockQuote concrete CommonMark\\Node\r\nCommonMark\\Node\\BulletList &mdash; BulletList concrete CommonMark\\Node\r\nCommonMark\\Node\\OrderedList &mdash; OrderedList concrete CommonMark\\Node', '', '', 38, '2019-04-14 19:42:24'),
(42, 'guest', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'dmytro.sumtsow@nure.ua', NULL, 'Это обычный текстЭто кодЖирныйКурсив &lt;a href=\"https://github.com/sumtsow/dzen\"&lt;Ссылка&gt;/a&gt;', '', '', 38, '2019-04-14 20:10:33'),
(43, 'user', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/73.0.3683.86 Chrome/73.0.3683.86 Safari/537.36', 'admin@meta.ua', NULL, 'The gateway to the MVC is the Zend\\Mvc\\Application object (referred to as Application henceforth). Its primary responsibilities are to bootstrap resources, to route the request, and to retrieve and dispatch the controller matched during routing. Once accomplished, it will render the view, and finish the request, returning and sending the response.', '', '', 0, '2019-04-15 09:22:41'),
(44, 'sumtsow', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'Shared File', 'flag_uk.png', 'image/png', 0, '2019-04-15 12:43:25'),
(45, 'guest', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, 'new image', 'flag_us.png', 'image/png', 2, '2019-04-15 14:18:25'),
(46, 'sumtsow', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'Текстовый файл', 'dzen.txt', 'text/plain', 2, '2019-04-15 15:01:06'),
(47, 'sumtsow', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'One more text file', 'links.txt', 'text/plain', 0, '2019-04-16 01:01:23'),
(48, 'sumtsow', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'sumtsow@gmail.com', NULL, 'One more file', 'links.txt', 'text/plain', 0, '2019-04-16 01:10:44'),
(49, 'anonymous', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0', 'guest.localhost@ukr.net', NULL, '<i>The competent programmer is fully aware of the strictly limited size of his own skull; therefore he approaches the programming task in full humility, and among other things he avoids clever tricks like the plague.</i> – <strong>Edsger W. Dijkstra</strong>', 'Windows Programming_ Supplemental Volume.txt', 'text/plain', 1, '2019-04-16 01:26:13');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
