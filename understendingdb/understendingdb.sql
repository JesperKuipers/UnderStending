-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 jan 2020 om 15:28
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `understendingdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `currentlywatching`
--

CREATE TABLE `currentlywatching` (
  `videoID` int(8) NOT NULL,
  `userID` int(8) NOT NULL,
  `timestamp` double DEFAULT NULL,
  `finished` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playlist`
--

CREATE TABLE `playlist` (
  `playlistID` int(8) NOT NULL,
  `userID` int(8) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playlistvideo`
--

CREATE TABLE `playlistvideo` (
  `videoID` int(8) NOT NULL,
  `playlistID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rating`
--

CREATE TABLE `rating` (
  `videoID` int(8) NOT NULL,
  `userID` int(8) NOT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tag`
--

CREATE TABLE `tag` (
  `tagID` int(8) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `userID` int(8) NOT NULL,
  `userTypeID` int(8) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`userID`, `userTypeID`, `name`, `email`, `password`, `admin`) VALUES
(1, 1, 'admin', 'admin@admin.com', '$2y$10$LRZ8k.t8ROiYT4/oGydR7OEi42XYLDPw7mjhOHvIQyAyvPnQ9CfIe', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `usertype`
--

CREATE TABLE `usertype` (
  `userTypeID` int(8) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `usertype`
--

INSERT INTO `usertype` (`userTypeID`, `name`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `video`
--

CREATE TABLE `video` (
  `videoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `URL` varchar(36) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `thumbnail` varchar(36) NOT NULL,
  `thumbnailExtension` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videotag`
--

CREATE TABLE `videotag` (
  `videoID` int(8) NOT NULL,
  `tagID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `currentlywatching`
--
ALTER TABLE `currentlywatching`
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlistID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `playlistvideo`
--
ALTER TABLE `playlistvideo`
  ADD KEY `videoID` (`videoID`),
  ADD KEY `playlistID` (`playlistID`);

--
-- Indexen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD KEY `videoID` (`videoID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userTypeID` (`userTypeID`);

--
-- Indexen voor tabel `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`userTypeID`);

--
-- Indexen voor tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`videoID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `videotag`
--
ALTER TABLE `videotag`
  ADD KEY `videoID` (`videoID`),
  ADD KEY `tagID` (`tagID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlistID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `usertype`
--
ALTER TABLE `usertype`
  MODIFY `userTypeID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `video`
--
ALTER TABLE `video`
  MODIFY `videoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `currentlywatching`
--
ALTER TABLE `currentlywatching`
  ADD CONSTRAINT `currentlywatching_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Beperkingen voor tabel `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Beperkingen voor tabel `playlistvideo`
--
ALTER TABLE `playlistvideo`
  ADD CONSTRAINT `playlistvideo_ibfk_1` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`),
  ADD CONSTRAINT `playlistvideo_ibfk_2` FOREIGN KEY (`playlistID`) REFERENCES `playlist` (`playlistID`);

--
-- Beperkingen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Beperkingen voor tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userTypeID`) REFERENCES `usertype` (`userTypeID`);

--
-- Beperkingen voor tabel `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Beperkingen voor tabel `videotag`
--
ALTER TABLE `videotag`
  ADD CONSTRAINT `videotag_ibfk_1` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`),
  ADD CONSTRAINT `videotag_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
