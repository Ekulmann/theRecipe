-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Mrz 2024 um 18:33
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `rezept_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezepte`
--

CREATE TABLE `rezepte` (
  `id` int(11) NOT NULL,
  `rezept_name` varchar(255) NOT NULL,
  `kategorie` varchar(50) DEFAULT NULL,
  `portionen` int(11) DEFAULT NULL,
  `laenge_des_gerichts` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rezepte`
--

INSERT INTO `rezepte` (`id`, `rezept_name`, `kategorie`, `portionen`, `laenge_des_gerichts`, `created_at`) VALUES
(16, 'Nudeln', 'hauptspeise', 2, 15, '2024-03-25 18:41:59'),
(17, 'Lasagne', 'hauptspeise', 4, 30, '2024-03-25 18:41:59'),
(18, 'Kuchen', 'hauptspeise', 9, 70, '2024-03-25 18:42:57');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten`
--

CREATE TABLE `zutaten` (
  `id` int(11) NOT NULL,
  `rezept_id` int(11) DEFAULT NULL,
  `zutat_name` varchar(255) NOT NULL,
  `einheit` varchar(20) NOT NULL,
  `menge` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rezept_id` (`rezept_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD CONSTRAINT `zutaten_ibfk_1` FOREIGN KEY (`rezept_id`) REFERENCES `rezepte` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
