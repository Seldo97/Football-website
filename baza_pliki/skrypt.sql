-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Paź 2019, 15:29
-- Wersja serwera: 10.3.15-MariaDB
-- Wersja PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zpai`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyna`
--

CREATE TABLE `druzyna` (
  `id_druzyna` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `id_liga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `druzyna`
--

INSERT INTO `druzyna` (`id_druzyna`, `nazwa`, `id_liga`) VALUES
(1, 'FC Ulani', 1),
(2, 'FC PoNalewce', 1),
(3, 'TP Ostrovia', 2),
(4, 'Calisia Kalisz', 3),
(5, 'Warta Poznan', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `liga`
--

CREATE TABLE `liga` (
  `id_liga` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `wynik_gospodarz` int(11) DEFAULT NULL,
  `wynik_gosc` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `rozegrany` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `mecz`
--

INSERT INTO `mecz` (`id_mecz`, `druzyna_gospodarz`, `druzyna_gosc`, `wynik_gospodarz`, `wynik_gosc`, `data`, `godzina`, `rozegrany`) VALUES
(1, 1, 2, 3, 4, '2019-02-22', '14:00:00', b'1'),
(2, 3, 5, 0, 0, '2020-01-03', '21:00:00', b'0'),
(3, 4, 3, 0, 0, '2020-03-11', '19:00:00', b'0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycja`
--

CREATE TABLE `pozycja` (
  `id_pozycja` int(11) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pozycja`
--

INSERT INTO `pozycja` (`id_pozycja`, `nazwa`) VALUES
(2, 'Bramkarz'),
(1, 'Napastnik'),
(3, 'Obronca'),
(4, 'Pomocnik'),
(5, 'Stoper');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id_uzytkownik` int(11) NOT NULL,
  `login` varchar(50) CHARACTER SET latin1 NOT NULL,
  `haslo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zawodnik`
--

INSERT INTO `zawodnik` (`id_zawodnik`, `imie`, `nazwisko`, `data_urodzenia`, `wzrost`, `narodowosc`, `do_kiedy_kontrakt`, `id_druzyna`, `id_pozycja`) VALUES
(1, 'Pawel', 'Brozek', '1980-11-11', 178, 'Polska', '2022-03-04', 1, 1),
(2, 'Wojciech', 'Szczesny', '1990-10-11', 188, 'Polska', '2025-03-04', 1, 2),
(3, 'Tymoteusz', 'Puchacz', '1989-03-11', 180, 'Polska', '2021-05-04', 1, 3),
(4, 'Robert', 'Gumny', '1994-01-03', 174, 'Polska', '2026-01-04', 1, 4),
(5, 'Darko', 'Jovetic', '1989-11-23', 176, 'Slowenia', '2023-06-04', 1, 5),
(6, 'Edin', 'Dzeko', '1993-10-11', 188, 'BiH', '2021-04-07', 2, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  ADD PRIMARY KEY (`id_druzyna`),
  ADD KEY `id_liga` (`id_liga`);

--
-- Indeksy dla tabeli `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id_liga`);

--
-- Indeksy dla tabeli `mecz`
--
ALTER TABLE `mecz`
  ADD PRIMARY KEY (`id_mecz`),
  ADD KEY `druzyna_gospodarz` (`druzyna_gospodarz`),
  ADD KEY `druzyna_gosc` (`druzyna_gosc`);

--
-- Indeksy dla tabeli `pozycja`
--
ALTER TABLE `pozycja`
  ADD PRIMARY KEY (`id_pozycja`),
  ADD UNIQUE KEY `nazwa` (`nazwa`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id_uzytkownik`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `zawodnik`
--
ALTER TABLE `zawodnik`
  ADD PRIMARY KEY (`id_zawodnik`),
  ADD KEY `id_druzyna` (`id_druzyna`),
  ADD KEY `id_pozycja` (`id_pozycja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zawodnik`
--
ALTER TABLE `zawodnik`
  MODIFY `id_zawodnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `mecz_ibfk_1` FOREIGN KEY (`druzyna_gospodarz`) REFERENCES `druzyna` (`id_druzyna`),
  ADD CONSTRAINT `mecz_ibfk_2` FOREIGN KEY (`druzyna_gosc`) REFERENCES `druzyna` (`id_druzyna`);

--
-- Ograniczenia dla tabeli `zawodnik`
--
ALTER TABLE `zawodnik`
  ADD CONSTRAINT `zawodnik_ibfk_1` FOREIGN KEY (`id_druzyna`) REFERENCES `druzyna` (`id_druzyna`) ON DELETE CASCADE,
  ADD CONSTRAINT `zawodnik_ibfk_2` FOREIGN KEY (`id_pozycja`) REFERENCES `pozycja` (`id_pozycja`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
