-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 jan 2020 om 15:23
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.1

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

--
-- Gegevens worden geëxporteerd voor tabel `playlist`
--

INSERT INTO `playlist` (`playlistID`, `userID`, `name`) VALUES
(1, 1, 'PHP'),
(2, 1, 'Databases');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playlistvideo`
--

CREATE TABLE `playlistvideo` (
  `videoID` int(8) NOT NULL,
  `playlistID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `playlistvideo`
--

INSERT INTO `playlistvideo` (`videoID`, `playlistID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2);

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

--
-- Gegevens worden geëxporteerd voor tabel `tag`
--

INSERT INTO `tag` (`tagID`, `name`) VALUES
(1, 'PHP'),
(2, 'leerzaam'),
(3, 'functie'),
(4, 'xampp'),
(5, 'server'),
(6, 'databases'),
(7, 'normaliseren');

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
(1, 1, 'admin', 'admin@admin.com', '$2y$10$LRZ8k.t8ROiYT4/oGydR7OEi42XYLDPw7mjhOHvIQyAyvPnQ9CfIe', 1),
(2, 1, 'Lars', 'lars.kuizenga@student.nhlstenden.com', '$2y$10$tk5PJlmTabJ7PyGzOm68tuRC1niWbuu74nTs7fuDPY0duaTV0NVri', 0);

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
(1, 'user');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `video`
--

CREATE TABLE `video` (
  `videoID` int(11) NOT NULL,
  `uploader` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `URL` varchar(36) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `thumbnail` varchar(36) NOT NULL,
  `thumbnailExtension` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `video`
--

INSERT INTO `video` (`videoID`, `uploader`, `title`, `releaseDate`, `description`, `URL`, `approved`, `thumbnail`, `thumbnailExtension`) VALUES
(1, 1, 'Introduction to PHP', '2020-01-30', 'Een introductie van het PHP vak. In deze video wordt een korte uitleg gegeven van wat PHP precies inhoud en waar je het voor kunt gebruiken.', '263245F6-F411-D286-48B8-C36EAD4C1E16', 1, '24E8BC56-6466-0C0F-9AD7-EDC9B50890FA', 'png'),
(2, 1, 'PHP - PHPinfo', '2020-01-30', 'Een demonstratie van hoe de phpinfo functie werkt en wat het teruggeeft.', '4E053687-E754-8CD4-10B1-D815C2FB4F7F', 1, 'FE4B9ADE-8464-E72C-54BD-94CAA76BA291', 'png'),
(3, 1, 'PHP installing XAMPP', '2020-01-30', 'Een uitleg van hoe XAMPP te installeren om de PHP code die je gebruikt uit te voeren op je eigen laptop.', 'FC06C3C5-4A33-17E1-E99D-32143408151A', 1, '5CEDBDA9-791D-99A4-0261-9DBF01A5CB9C', 'png'),
(4, 1, 'Databases normaliseren', '2020-01-30', 'In deze les wordt de basis uitgelegd van hoe je bijvoorbeeld een factuur met normaliseren.', '646D8899-6C56-F9A1-16C0-0095292011DF', 1, '0F6C50B1-4B95-7BDD-43B1-49D542E2ACCF', 'png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videotag`
--

CREATE TABLE `videotag` (
  `videoID` int(8) NOT NULL,
  `tagID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `videotag`
--

INSERT INTO `videotag` (`videoID`, `tagID`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(3, 1),
(3, 4),
(3, 5),
(4, 6),
(4, 7),
(4, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `currentlywatching`
--
ALTER TABLE `currentlywatching`
  ADD KEY `userID` (`userID`),
  ADD KEY `currentlywatching_ibfk_1` (`videoID`);

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
  ADD KEY `uploader` (`uploader`);

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
  MODIFY `playlistID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `usertype`
--
ALTER TABLE `usertype`
  MODIFY `userTypeID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `video`
--
ALTER TABLE `video`
  MODIFY `videoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `currentlywatching`
--
ALTER TABLE `currentlywatching`
  ADD CONSTRAINT `currentlywatching_ibfk_1` FOREIGN KEY (`videoID`) REFERENCES `video` (`videoID`),
  ADD CONSTRAINT `currentlywatching_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

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
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`uploader`) REFERENCES `user` (`userID`);

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
