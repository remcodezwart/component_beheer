-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 sep 2017 om 09:01
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `component_management`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comloc`
--

CREATE TABLE `comloc` (
  `id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comloc`
--

INSERT INTO `comloc` (`id`, `component_id`, `location_id`, `amount`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 5),
(3, 10, 1, 2),
(4, 11, 5, 1),
(5, 12, 9, 1),
(6, 13, 9, 1),
(7, 14, 9, 1),
(8, 15, 9, 1),
(9, 16, 9, 1),
(10, 17, 9, 1),
(11, 18, 9, 1),
(12, 19, 9, 1),
(13, 20, 9, 1),
(14, 21, 9, 1),
(15, 22, 2, 6),
(16, 23, 1, 1),
(17, 24, 1, 9),
(18, 25, 1, 5),
(19, 26, 1, 12),
(20, 28, 1, 12),
(21, 29, 1, 2),
(22, 30, 1, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `specs` text NOT NULL,
  `hyperlink` varchar(1000) NOT NULL,
  `minAmount` int(11) NOT NULL,
  `returns` int(1) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `components`
--

INSERT INTO `components` (`id`, `name`, `description`, `specs`, `hyperlink`, `minAmount`, `returns`, `active`) VALUES
(1, 'Arduino 101 (USA only)& Genuino 101', 'Arduino 101 & Genuino 101 combine the ease-of-use of the classic boards with the latest technologies. The board recognises gestures, and features a six-axis accelerometer and gyroscope. Control your projects with your phone over Bluetooth connectivity!', 'Processor:Intel® Curie\r\nOperating/Input\r\nVoltage:3.3 V/ 7-12V\r\nCPU Speed:32MHz\r\nAnalog In/Out:6/0\r\nDigital IO/PWM:14/4\r\nEEPROM [kB]:-\r\nSRAM [kB]:24\r\nFlash [kB]:196\r\nUSB:Regular\r\nUART:-', 'https://www.arduino.cc/en/uploads/Main/AG101.jpg', 5, 0, 1),
(2, 'aurdino board 2.0', 'verbeterd board tweede uitgaven', 'zie aurdino ', 'blank.jpg', 0, 0, 1),
(3, 'auto', 'een volkswagen kevers\r\ntest', 'zie autos\r\ntest', 'http://3.bp.blogspot.com/-YcOBKGtGh9c/WILLc7M7UAI/AAAAAAAAADg/bpdmBHiQWd4pOy0gxI1PCckJaDSkNAULwCK4B/s1600/w3-schools-logo.jpg', 0, 0, 1),
(4, 'onzin', 'onzin', 'onzin', '.', 0, 0, 1),
(5, 'AruInO 101 (USA only) & Genuino 101', 'ArDuiNo 101 (USA only) & Genuino 101', 'ArdUiNo 101 (USA only) & Genuino 101', 'https://www.arduino.cc/en/uploads/Main/AG101.jpg', 0, 0, 1),
(6, 'test', 'test', 'test', 'o', 5, 0, 1),
(7, 'test', 'test', 'test', 'test', 5, 0, 1),
(8, 'test', 'test', 'test', 'test', 5, 0, 1),
(9, 'test', 'test', 'test', 'test', 5, 0, 1),
(10, 'lol', 'lol', 'lol', 'lol', 3, 0, 1),
(11, 'test', 'test', 'test', 'test', 1, 0, 1),
(12, 'test', 'test', 'test', 'test', 1, 0, 1),
(13, 'test', 'test', 'test', 'test', 1, 0, 1),
(14, 'test', 'test', 'test', 'test', 1, 0, 1),
(15, 'test', 'test', 'test', 'test', 1, 0, 1),
(16, 'test', 'test', 'test', 'test', 1, 0, 1),
(17, 'test', 'test', 'test', 'test', 1, 0, 1),
(18, 'test', 'test', 'test', 'test', 1, 0, 1),
(19, 'test', 'test', 'test', 'test', 1, 0, 1),
(20, 'test', 'test', 'test', 'test', 1, 0, 1),
(21, 'test', 'test', 'test', 'test', 1, 0, 1),
(22, 'laaste test', 'test', 'test', 'test', 13, 0, 1),
(23, 'email test', 'test', 'tset', 'test', 2, 1, 1),
(24, 'test', 'test', 'test', 'test', 8, 1, 1),
(25, 'test', 'test', 'test', 'hyh', 1, 0, 1),
(26, 'test', 'test', 'test', 'test', 8, 0, 1),
(27, 'test', 'test', 'test', 'test', 8, 0, 1),
(28, 'test', 'test', 'test', 'test', 8, 0, 1),
(29, 'test emailz', 'test emailz', 'test emailz', 'test emailz', 4, 0, 1),
(30, 'test', 'test', 'test', 'test', 3, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `location`
--

INSERT INTO `location` (`id`, `address`, `active`) VALUES
(1, 'test', 1),
(2, 'mbw\r\n               \r\n            ', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mutations`
--

CREATE TABLE `mutations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mutations`
--

INSERT INTO `mutations` (`id`, `user_id`, `component_id`, `location_id`, `amount`, `reason`, `date`) VALUES
(1, 1, 1, 5, -10, 'Diefstal', '2017-06-13'),
(2, 3, 1, 1, -10, 'Diefstal', '2017-06-13'),
(3, 1, 1, 1, 12, 'Onderdeel uitgeleend', '2017-06-13'),
(4, 1, 1, 1, -10, 'Onderdeel uitgeleend', '2017-06-13'),
(5, 1, 2, 1, 7, 'Besteld onderdeel aangekomen', '2017-06-13'),
(6, 1, 2, 1, 2, 'Kapot', '2017-06-14'),
(7, 1, 1, 1, 2, 'Kapot', '2017-06-14'),
(8, 1, 1, 1, 1, 'Correctie', '2017-06-14'),
(9, 1, 1, 1, 7, '1', '2017-06-14'),
(10, 1, 1, 1, 10, 'Correctie', '2017-06-14'),
(11, 1, 4, 2, 5, 'Correctie', '2017-06-14'),
(12, 1, 1, 1, -10, 'Onderdeel verwijderd', '2017-06-15'),
(13, 1, 2, 1, -19, 'Onderdeel verwijderd', '2017-06-15'),
(14, 1, 4, 1, 5, 'Onderdeel besteld', '2017-06-15'),
(15, 1, 3, 1, -1, 'Onderdeel verwijderd', '2017-06-15'),
(16, 1, 5, 1, 1, 'Onderdeel toegevoegd', '2017-06-20'),
(17, 1, 6, 1, 2, 'Onderdeel toegevoegd', '2017-06-20'),
(18, 1, 3, 1, 2, 'Onderdeel toegevoegd', '2017-06-22'),
(19, 1, 2, 2, 7, 'Besteld onderdeel aangekomen', '2017-06-22'),
(20, 1, 1, 1, -1, 'Onderdeel uitgeleend', '2017-06-27'),
(21, 1, 15, 2, 6, 'Onderdeel toegevoegd', '2017-06-27'),
(22, 1, 28, 1, 12, 'Onderdeel toegevoegd', '2017-06-27'),
(23, 1, 29, 1, 2, 'Onderdeel toegevoegd', '2017-06-27'),
(24, 1, 30, 1, 2, 'Onderdeel toegevoegd', '2017-06-27'),
(25, 1, 1, 1, 100000, 'Onderdeel besteld', '2017-06-29'),
(26, 1, 5, 2, 5, 'Onderdeel besteld', '2017-06-29'),
(27, 1, 1, 2, 80, 'Onderdeel besteld', '2017-06-29'),
(28, 1, 1, 2, 5, 'Onderdeel besteld', '2017-06-29'),
(29, 1, 5, 2, 9, 'Onderdeel besteld', '2017-06-29'),
(30, 1, 2, 2, 6, 'Onderdeel besteld', '2017-06-29'),
(31, 1, 4, 2, 5, 'Onderdeel besteld', '2017-06-29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `componentId` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  `history` int(1) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `order_history`
--

INSERT INTO `order_history` (`id`, `date`, `amount`, `supplierId`, `componentId`, `locationId`, `history`, `active`) VALUES
(10, '23-12-2015', 7, 3, 2, 2, 1, 1),
(9, '10-12-2016', 2, 2, 1, 0, 1, 1),
(11, '12-12-2016', 5, 3, 1, 0, 1, 1),
(12, '21-12-2015', 5, 3, 4, 0, 0, 1),
(13, '21-12-2015', 100000, 3, 1, 1, 0, 1),
(14, '21-12-2015', 5, 3, 5, 2, 0, 1),
(15, '12-12-2016', 80, 3, 1, 2, 0, 1),
(16, '21-12-2015', 5, 3, 1, 2, 0, 1),
(17, '10-12-2015', 9, 3, 5, 2, 0, 1),
(18, '10-12-1997', 6, 3, 2, 2, 0, 1),
(19, '21-12-2015', 5, 3, 4, 2, 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `active`) VALUES
(1, 'test.com', 0),
(2, '<script> alert("xss") </script>', 1),
(3, 'aliexpress.com', 1),
(4, '99035592', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_account_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user''s account type (basic, premium, etc)',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if user has a local avatar, 0 if not',
  `user_remember_me_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_account_type`, `user_has_avatar`, `user_remember_me_token`, `user_creation_timestamp`, `user_last_login_timestamp`, `user_failed_logins`, `user_last_failed_login`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_provider_type`) VALUES
(1, 'remco', '$2y$10$DcaGpO2nfXN1MXiuFhFQBup7yMJX8WQBsCH/befTzuu2qKO6cU0LS', 'demo@demo.com', 1, 1, 0, NULL, 1422205178, 1504601498, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(3, 'Rick', '$2y$10$Z8bBuVugfmbiJ9DwDif7A.KpJe1eKbTJOSEVzrn1PYzB.PY4YNAom', 'rick@rick.rick', 1, 1, 0, NULL, 1477465555, 1477465588, 0, NULL, 'ad524dbff43dcc9127ca79138a4fd2170f8a4853', NULL, NULL, 'DEFAULT'),
(99030821, 'Sebas', '$2y$10$yvjCLSxp7VcNm.kIe3bpi.s7JJi4lbW..lO4VzHi21eDQ/RlA3s2u', 'sebasbakker8@hotmail.com', 1, 7, 0, '94085915c0c59ee0f7cfb2afed9197b28d76c84f68144efa12d4bdb55c0f455e', 1474361433, 1494408235, 0, NULL, '484234b4db38a54986cc3594a32a8a5263a3ce21', NULL, NULL, 'DEFAULT');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comloc`
--
ALTER TABLE `comloc`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `mutations`
--
ALTER TABLE `mutations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplierId` (`supplierId`),
  ADD KEY `componentId` (`componentId`),
  ADD KEY `locationId` (`locationId`);

--
-- Indexen voor tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comloc`
--
ALTER TABLE `comloc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT voor een tabel `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT voor een tabel `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `mutations`
--
ALTER TABLE `mutations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT voor een tabel `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT voor een tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=99030822;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
