<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Rozgrywki Piłkarskie</title>
    </head>
    <body>

    <?php
        require 'vendor/autoload.php';
        

        try{
            $pdo = \Handles\MySQL::getHandle();
            $main = new \Controllers\Main();
            d($pdo);
        } catch(\Exceptions\DatabaseConnection $e) {
            echo $e->getMessage();
            d($e);
            exit();
        }

        //pobranie danych
    	try {
            //obsługa błędów
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //obiekt PDOStatement zwrócony na podstawie zapytania (zapytanie nie kończy się ;)
            $stmt = $pdo->query('SELECT id_mecz AS Id, CONCAT(G.nazwa," ", wynik_gospodarz," - ", wynik_gosc," ", S.nazwa) AS Wynik,
                                CONCAT(data, " - ", godzina) AS Data, rozegrany AS Rozegrany
                                FROM mecz INNER JOIN druzyna AS G ON mecz.druzyna_gospodarz = G.id_druzyna
			                    INNER JOIN druzyna AS S ON mecz.druzyna_gosc = S.id_druzyna
                                ORDER BY id_mecz');


            echo "<h2>Tabela Mecz</h2>";
            echo '<table border = "1">
                <thead>
                    <tr>
                        <td>Id</a></td>
                        <td>Wynik</td>
                        <td>Data</td>
                        <td>Rozegrany</td>
                        </tr>
                        </thead>
                        <tbody>';

                    //pętla pobierania wierszy
                    foreach ($stmt as $indeks => $wiersz){

                        $id = $wiersz["Id"];
                        $wynik = $wiersz["Wynik"];
                        $data = $wiersz["Data"];
                        $rozegrany = $wiersz["Rozegrany"];

                        echo "<tr>
                            <td>$id</td>
                            <td>$wynik</td>
                            <td>$data</td>
                            <td>$rozegrany</td>
                            </tr>";
                        }//foreach

                echo "</tbody>
                    </table>";


            $stmt->closeCursor();
    	} catch(PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
    	}

        ?>

    </body>
</html>
