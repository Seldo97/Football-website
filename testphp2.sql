-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Sty 2020, 17:19
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `testphp2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyna`
--

CREATE TABLE `druzyna` (
  `id_druzyna` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `logo` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `id_liga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `druzyna`
--

INSERT INTO `druzyna` (`id_druzyna`, `nazwa`, `logo`, `id_liga`) VALUES
(1, 'FC Ulani', 'images/302340-0ac00115-5ec4-d4d1.png', 2),
(3, 'TP Ostrovia', 'images/Armorial_Bearings_of_the_DENE_family_of_Herefordshire.png', 2),
(4, 'Calisia Kalisz', 'images/Armorial_Bearings_of_the_NOURSE_family_of_Weston_Hall,_Weston-under-Penyard,_Herefordshire.png', 3),
(5, 'Warta Poznan', 'images/Quos_Bergshammar_Armorial.svg', 2),
(6, 'Rangers FC', 'images/St-Peters_College_Oxford_Coat_Of_Arms.png', 2),
(8, 'FCU Spurs', 'images/fafb897ae92ca83deb09c53f2d51eb54.png', 2),
(9, 'Coco Jambo', 'images/Arms-of-George-Washington-254x300.png', 1),
(10, 'FC Team', 'images/53217.svg', 1),
(15, 'Espaniol', 'images/270px-Royal_arms_of_Aragon_(Lozenge-shaped).svg.png', 2),
(16, 'The Black Cats', 'images/LMv317B76aNYp0jMKWlMxGPBE44jXO0an0U0XzZeuOU.png', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `liga`
--

CREATE TABLE `liga` (
  `id_liga` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `liga`
--

INSERT INTO `liga` (`id_liga`, `nazwa`) VALUES
(1, 'Ekstraklasa'),
(2, '1-Liga'),
(3, '2-Liga');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mecz`
--

CREATE TABLE `mecz` (
  `id_mecz` int(11) NOT NULL,
  `druzyna_gospodarz` int(11) NOT NULL,
  `druzyna_gosc` int(11) NOT NULL,
  `wynik_gospodarz` varchar(4) COLLATE utf8_polish_ci DEFAULT NULL,
  `wynik_gosc` varchar(4) COLLATE utf8_polish_ci DEFAULT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `rozegrany` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `mecz`
--

INSERT INTO `mecz` (`id_mecz`, `druzyna_gospodarz`, `druzyna_gosc`, `wynik_gospodarz`, `wynik_gosc`, `data`, `godzina`, `rozegrany`) VALUES
(40, 3, 4, '1', '0', '2019-12-02', '15:50:00', b'1'),
(41, 5, 6, '2', '5', '2019-12-03', '12:00:00', b'1'),
(42, 8, 9, '1', '3', '2019-12-03', '16:30:00', b'1'),
(43, 10, 15, 'NULL', 'NULL', '2019-12-19', '11:45:00', NULL),
(44, 16, 1, 'NULL', 'NULL', '2019-12-20', '16:00:00', NULL),
(47, 6, 9, 'NULL', 'NULL', '2019-12-15', '13:00:00', NULL),
(48, 5, 15, 'NULL', 'NULL', '2019-12-30', '19:00:00', NULL),
(49, 6, 9, '1', '0', '2019-12-11', '16:00:00', b'1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycja`
--

CREATE TABLE `pozycja` (
  `id_pozycja` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pozycja`
--

INSERT INTO `pozycja` (`id_pozycja`, `nazwa`) VALUES
(1, 'Bramkarz'),
(2, 'Napastnik'),
(3, 'Obronca'),
(4, 'Pomocnik'),
(5, 'Stoper'),
(6, 'Bramkarz'),
(7, 'Napastnik'),
(8, 'Obronca'),
(9, 'Pomocnik'),
(10, 'Stoper');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `id_uprawnienia` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uprawnienia`
--

INSERT INTO `uprawnienia` (`id_uprawnienia`, `nazwa`) VALUES
(1, 'administrator'),
(2, 'uzytkownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id_uzytkownik` int(11) NOT NULL,
  `login` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `id_uprawnienia` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id_uzytkownik`, `login`, `haslo`, `email`, `id_uprawnienia`) VALUES
(3, 'admin', '$2y$10$zAgcD2JhMLZVNOIOk20FAOpyhJVcbtBd8UVSD/gyrsYVtUOoJysEK', 'admin@admin.pl', 1),
(4, 'Chlopiec', '$2y$10$KhCtC3VxPipFPyBcfus2T.WYMA0inrnQnVtm1XymbWvNe9fu7Y8HW', 'qaz@qaz.pl', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawodnik`
--

CREATE TABLE `zawodnik` (
  `id_zawodnik` int(11) NOT NULL,
  `imie` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nazwisko` varchar(50) CHARACTER SET latin1 NOT NULL,
  `data_urodzenia` date NOT NULL,
  `wzrost` int(11) NOT NULL,
  `narodowosc` varchar(50) CHARACTER SET latin1 NOT NULL,
  `do_kiedy_kontrakt` date NOT NULL,
  `id_druzyna` int(11) NOT NULL,
  `id_pozycja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zawodnik`
--

INSERT INTO `zawodnik` (`id_zawodnik`, `imie`, `nazwisko`, `data_urodzenia`, `wzrost`, `narodowosc`, `do_kiedy_kontrakt`, `id_druzyna`, `id_pozycja`) VALUES
(7, 'Pawel', 'Brozek', '1980-11-11', 178, 'Polska', '2022-03-04', 5, 1),
(8, 'Wojciech', 'Szczesny', '1990-10-11', 188, 'Polska', '2025-03-04', 1, 2),
(9, 'Tymoteusz', 'Puchacz', '1989-03-11', 180, 'Polska', '2021-05-04', 1, 3),
(11, 'Darko', 'Jovetic', '1989-11-23', 176, 'Slowenia', '2023-06-04', 4, 5),
(16, 'Daniel', 'Cicharski', '2019-12-05', 165, 'Rosja', '2019-12-19', 5, 9),
(19, 'Test1', 'Test2', '2001-12-05', 119, 'Polska', '2024-01-17', 15, 7),
(20, 'dsad', 'asd', '2001-12-11', 122, 'pol', '2020-01-30', 15, 6),
(21, 'dasd', 'asdasd', '2001-12-10', 123, 'rrrrr', '2020-01-30', 9, 8);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `druzyna`
--
ALTER TABLE `druzyna`
  ADD PRIMARY KEY (`id_druzyna`),
  ADD KEY `id_liga` (`id_liga`);

--
-- Indexes for table `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id_liga`);

--
-- Indexes for table `mecz`
--
ALTER TABLE `mecz`
  ADD PRIMARY KEY (`id_mecz`),
  ADD KEY `mecz_ibfk_1` (`druzyna_gospodarz`),
  ADD KEY `mecz_ibfk_2` (`druzyna_gosc`);

--
-- Indexes for table `pozycja`
--
ALTER TABLE `pozycja`
  ADD PRIMARY KEY (`id_pozycja`);

--
-- Indexes for table `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`id_uprawnienia`);

--
-- Indexes for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id_uzytkownik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_uprawnieniaUzytkownik` (`id_uprawnienia`);

--
-- Indexes for table `zawodnik`
--
ALTER TABLE `zawodnik`
  ADD PRIMARY KEY (`id_zawodnik`),
  ADD KEY `zawodnik_ibfk_1` (`id_druzyna`),
  ADD KEY `zawodnik_ibfk_2` (`id_pozycja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  MODIFY `id_druzyna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `liga`
--
ALTER TABLE `liga`
  MODIFY `id_liga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `mecz`
--
ALTER TABLE `mecz`
  MODIFY `id_mecz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT dla tabeli `pozycja`
--
ALTER TABLE `pozycja`
  MODIFY `id_pozycja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `zawodnik`
--
ALTER TABLE `zawodnik`
  MODIFY `id_zawodnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  ADD CONSTRAINT `druzyna_ibfk_1` FOREIGN KEY (`id_liga`) REFERENCES `liga` (`id_liga`);

--
-- Ograniczenia dla tabeli `mecz`
--
ALTER TABLE `mecz`
  ADD CONSTRAINT `mecz_ibfk_1` FOREIGN KEY (`druzyna_gospodarz`) REFERENCES `druzyna` (`id_druzyna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mecz_ibfk_2` FOREIGN KEY (`druzyna_gosc`) REFERENCES `druzyna` (`id_druzyna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `FK_uprawnieniaUzytkownik` FOREIGN KEY (`id_uprawnienia`) REFERENCES `uprawnienia` (`id_uprawnienia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zawodnik`
--
ALTER TABLE `zawodnik`
  ADD CONSTRAINT `zawodnik_ibfk_1` FOREIGN KEY (`id_druzyna`) REFERENCES `druzyna` (`id_druzyna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zawodnik_ibfk_2` FOREIGN KEY (`id_pozycja`) REFERENCES `pozycja` (`id_pozycja`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
