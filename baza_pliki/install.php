<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Instalacja bazy</title>
    </head>
    <body>

    <?php
        require 'vendor/autoload.php';

        try{
            $pdo = \Handles\MySQL::getHandle();
            d($pdo);
        } catch(\Exceptions\DatabaseConnection $e) {
            echo $e->getMessage();
            d($e);
            exit();
        }

        //tworzenie tabel
        try	{
            $query = "
                CREATE TABLE `liga` (
                    `id_liga` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL
            )
            ";
            $pdo->exec($query);
            echo 'Dodano tabele liga <br/>';
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try	{
            $query = "
                CREATE TABLE `pozycja` (
                    `id_pozycja` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL
            )
            ";
            $pdo->exec($query);
            echo 'Dodano tabele pozycja <br/>';
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try	{
            $query = "
                CREATE TABLE `druzyna` (
                    `id_druzyna` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `nazwa` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
                    `logo` varchar(200) NULL,
                    `id_liga` int(11) NOT NULL,
                    FOREIGN KEY(id_liga) REFERENCES liga(id_liga)
            )
            ";
            $pdo->exec($query);
            echo 'Dodano tabele druzyna <br/>';
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try	{
            $query = "
                CREATE TABLE `zawodnik` (
                    `id_zawodnik` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `imie` varchar(50) CHARACTER SET latin1 NOT NULL,
                    `nazwisko` varchar(50) CHARACTER SET latin1 NOT NULL,
                    `data_urodzenia` date NOT NULL,
                    `wzrost` int(11) NOT NULL,
                    `narodowosc` varchar(50) CHARACTER SET latin1 NOT NULL,
                    `do_kiedy_kontrakt` date NOT NULL,
                    `id_druzyna` int(11) NOT NULL,
                    `id_pozycja` int(11) NOT NULL,
                    FOREIGN KEY(id_druzyna) REFERENCES druzyna(id_druzyna),
                    FOREIGN KEY(id_pozycja) REFERENCES pozycja(id_pozycja)

            )
            ";
            $pdo->exec($query);
            echo 'Dodano tabele zawodnik <br/>';
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try	{
            $query = "
                CREATE TABLE `mecz` (
                    `id_mecz` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `druzyna_gospodarz` int(11) NOT NULL,
                    `druzyna_gosc` int(11) NOT NULL,
                    `wynik_gospodarz` int(11) DEFAULT NULL,
                    `wynik_gosc` int(11) DEFAULT NULL,
                    `data` date NOT NULL,
                    `godzina` time NOT NULL,
                    `rozegrany` bit(1) NULL,
                    FOREIGN KEY(druzyna_gospodarz) REFERENCES druzyna(id_druzyna),
                    FOREIGN KEY(druzyna_gosc) REFERENCES druzyna(id_druzyna)

            )
            ";
            $pdo->exec($query);
            echo 'Dodano tabele mecz <br/>';
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try	{
            $query = "
                CREATE TABLE `uzytkownik` (
                    `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT,
                    `login` varchar(50) CHARACTER SET latin1 NOT NULL,
                    `haslo` varchar(50) CHARACTER SET latin1 NOT NULL,
                    `email` varchar(50) CHARACTER SET latin1 NOT NULL

            )
            ";
            $pdo->exec($query);
            echo 'Dodano tabele uzytkownik <br/>';
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }


        //dodanie danych do tabel
        try {
            $liczba = $pdo->exec(
                'INSERT INTO `liga` (`nazwa`) VALUES
                (\'Ekstraklasa\'),
                (\'1-Liga\'),
                (\'2-Liga\')'
            );
            if($liczba > 0) {
                echo 'Dodano: '.$liczba.' rekordow w tabeli liga <br/>';
            } else {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try {
            $liczba = $pdo->exec(
                'INSERT INTO `pozycja` (`nazwa`) VALUES
                (\'Bramkarz\'),
                (\'Napastnik\'),
                (\'Obronca\'),
                (\'Pomocnik\'),
                (\'Stoper\')'
            );
            if($liczba > 0) {
                echo 'Dodano: '.$liczba.' rekordow w tabeli pozycja <br/>';
            } else {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try {
            $liczba = $pdo->exec(
                'INSERT INTO `druzyna` (`nazwa`, `logo`, `id_liga`) VALUES
                (\'FC Ulani\', \'\' ,\'1\'),
                (\'FC PoNalewce\', \'\',\'1\'),
                (\'TP Ostrovia\', \'\',\'2\'),
                (\'Calisia Kalisz\', \'\',\'3\'),
                (\'Warta Poznan\', \'\',\'2\')'
            );
            if($liczba > 0) {
                echo 'Dodano: '.$liczba.' rekordow w tabeli druzyna <br/>';
            } else {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try {
            $liczba = $pdo->exec(
                'INSERT INTO `zawodnik` (`imie`, `nazwisko`, `data_urodzenia`, `wzrost`, `narodowosc`, `do_kiedy_kontrakt`, `id_druzyna`, `id_pozycja`) VALUES
                (\'Pawel\', \'Brozek\', \'1980-11-11\', \'178\', \'Polska\', \'2022-03-04\', \'1\', \'1\'),
                (\'Wojciech\', \'Szczesny\', \'1990-10-11\', \'188\', \'Polska\', \'2025-03-04\', \'1\', \'2\'),
                (\'Tymoteusz\', \'Puchacz\', \'1989-03-11\', \'180\', \'Polska\', \'2021-05-04\', \'1\', \'3\'),
                (\'Robert\', \'Gumny\', \'1994-01-03\', \'174\', \'Polska\', \'2026-01-04\', \'1\', \'4\'),
                (\'Darko\', \'Jovetic\', \'1989-11-23\', \'176\', \'Slowenia\', \'2023-06-04\', \'1\', \'5\'),
                (\'Edin\', \'Dzeko\', \'1993-10-11\', \'188\', \'BiH\', \'2021-04-07\', \'2\', \'2\')'
            );
            if($liczba > 0) {
                echo 'Dodano: '.$liczba.' rekordow w tabeli zawodnik <br/>';
            } else {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }
        try {
            $liczba = $pdo->exec(
                'INSERT INTO `mecz` (`druzyna_gospodarz`, `druzyna_gosc`, `wynik_gospodarz`, `wynik_gosc`, `data`, `godzina`, `rozegrany`) VALUES
                (\'1\', \'2\', \'3\', \'4\', \'2019-02-22\', \'14:00:00\', b\'1\'),
                (\'3\', \'5\', \'0\', \'0\', \'2020-01-03\', \'21:00:00\', b\'0\'),
                (\'4\', \'3\', \'0\', \'0\', \'2020-03-11\', \'19:00:00\', b\'0\')'
            );
            if($liczba > 0) {
                echo 'Dodano: '.$liczba.' rekordow w tabeli mecz <br/>';
            } else {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
        } catch(PDOException $e) {
            echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
        }



        ?>

    </body>
</html>
