-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 jun 2017 om 09:44
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
(1, 1, 1, 1, -10, 'Diefstal', '2017-06-13'),
(2, 3, 1, 1, -10, 'Diefstal', '2017-06-13'),
(3, 1, 1, 1, 12, 'Onderdeel uitgeleend', '2017-06-13'),
(4, 1, 1, 1, -10, 'Onderdeel uitgeleend', '2017-06-13'),
(5, 1, 2, 1, 7, 'Besteld onderdeel aangekomen', '2017-06-13');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `mutations`
--
ALTER TABLE `mutations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `mutations`
--
ALTER TABLE `mutations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
