-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Dez 2021 um 12:10
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `swiss_jdm_blog`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `IDadmin` int(11) NOT NULL,
  `admin_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_usertype` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`IDadmin`, `admin_name`, `admin_email`, `admin_password`, `admin_usertype`) VALUES
(1, 'Sven Kamm', 'sven0815@gmx.ch', '$2y$10$t9c9iyMmp.vJzaefy9RF5.Ic9Xec0globisorxwChWkrCG9bkDEXi', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersUid` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersCar` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersState` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersEmail` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersPwd` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_state` tinyint(1) DEFAULT 1,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersUid`, `usersCar`, `usersState`, `usersEmail`, `usersPwd`, `user_state`, `user_created`) VALUES
(1, 'Sven Kamm', 'Svendolin', 'Nissan Skyline R33', 'Aargau', 'sven0815@gmx.ch', '$2y$10$iNoQRI/kyBnyqXM8UZ/7AOwKBKc8KADIAFf41./pXsDebmig8ILx6', 1, '2021-12-27 00:39:34');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDadmin`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `IDadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
