-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Jan 2022 um 22:32
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
(1, 'Sven Kamm', 'sven0815@gmx.ch', '$2y$10$t9c9iyMmp.vJzaefy9RF5.Ic9Xec0globisorxwChWkrCG9bkDEXi', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blogpost`
--

CREATE TABLE `blogpost` (
  `IDblogpost` int(11) NOT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_author` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_longtext` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `blogpost`
--

INSERT INTO `blogpost` (`IDblogpost`, `post_title`, `post_created`, `post_author`, `post_longtext`, `post_image`) VALUES
(50, 'Who wants to Photoshop Mount Fuji for the perfect Scene?', '2022-01-13 20:40:42', 'Oli_Supra', 'Actually the Scene is already perfect! I mean...Look at these two Supras :D The other stuff is secondary. Well...It was such a fun to meet Danny with his black Supra. Such a big pleasure! Hope to see you again!', 'postimage_1641850554.jpg'),
(51, 'Can not wait for our first meet with Svendolin!', '2022-01-13 20:37:01', 'Sillest', 'Okay well...I have to wait for my Skyline, you same as you. But still: Hope for a good summer so we can finally meet us when it is getting warmer with our own cars. I am excited. Hope you as well, Svendolin ;)', 'postimage_1641930853.jpg'),
(52, 'Such a legendary view!', '2022-01-13 20:52:56', 'Svendolin', 'Mount Fuji together with...no, not ONE...There are TWO of these holy grails! Of course its directly in Japan, and addtionally the picture is not taken by myself, but still: I simply had to share this. It\'s too epic not to share it with you here! *sobber*', 'postimage_1642107176.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersUid` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersCar` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersImage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersState` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersEmail` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersPwd` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userState` tinyint(1) NOT NULL DEFAULT 1,
  `userCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `memberType` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersUid`, `usersCar`, `usersImage`, `usersState`, `usersEmail`, `usersPwd`, `userState`, `userCreated`, `memberType`) VALUES
(14, 'Sven Kamm', 'Svendolin', 'Nissan Skyline R33', 'profileimage_1641481670.jpg', 'Aargau', 'sven0815@gmx.ch', '$2y$10$6GMtfrN3GGKdX6iG/nmP2eWzyztc9WHU5VczXBBOPRgT6Q23vl3g6', 0, '2022-01-06 15:07:50', 0),
(15, 'Silvan Schmid', 'Sillest', 'Nissan 200sx S13', 'profileimage_1641482392.jpg', 'Nidwalden', 'supersilvi@jdm.ch', '$2y$10$e/EpmIdWV.p3AkptpyKifO.hgkLBoMG25OvIryDdy7jmn4YUexr.G', 1, '2022-01-06 15:19:52', 1),
(21, 'Oliver Stumpf', 'Oli_Supra', 'Toyota Supra MK4', 'profileimage_1641499037.jpg', 'Aargau', 'OliSupra@gmx.ch', '$2y$10$jon8atk8enH87PtxW69o9.VogSYdgiH4yah34t78loI5Li7uu3Q.q', 1, '2022-01-06 19:57:17', 1),
(22, 'Mike Schallenberger', 'swiss__rx7', 'Mazda RX7', 'profileimage_1641499488.jpg', 'Aargau', 'Mischal@gmx.ch', '$2y$10$vyX5il8tph4SeNRYxd5KnOSURPs7nAGm.NSMJ6subudxF1DgyqiAG', 1, '2022-01-06 20:04:48', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDadmin`);

--
-- Indizes für die Tabelle `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`IDblogpost`);

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
-- AUTO_INCREMENT für Tabelle `blogpost`
--
ALTER TABLE `blogpost`
  MODIFY `IDblogpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
