<?php
namespace Models;

use PDO;

class Mecz extends DatabaseConnection
{
    //$pdo;
    public function __construct()
    {
        parent::__construct('mecz', 'id_mecz');
        //d($this->pdo);
    }

    public function showView($filtr = '')
    {
        $data = array();
        try	{
            $where = $filtr;
            $orderBy = 'ORDER BY Data ASC';

            $query = "SELECT id_mecz AS Id, G.nazwa AS Gospodarz, G.logo AS Glogo, CONCAT(wynik_gospodarz,' : ', wynik_gosc) AS Wynik, S.logo AS Slogo, S.nazwa AS Gosc,
                                CONCAT(data, ' - ', TIME_FORMAT(godzina, '%H:%i')) AS Data, rozegrany AS Rozegrany
                        FROM mecz INNER JOIN druzyna AS G ON mecz.druzyna_gospodarz = G.id_druzyna
			            INNER JOIN druzyna AS S ON mecz.druzyna_gosc = S.id_druzyna
                        $where
                        $orderBy";

            $stmt = $this->pdo->query($query);

            foreach($stmt as $row) {
                $data[] = $row;
            }

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
        //d($data);
        return $data;
    }

    public function updateById($id_mecz, $druzyna_gospodarz, $druzyna_gosc, $wynik_gospodarz, $wynik_gosc, $data, $godzina, $rozegrany)
    {
        try	{

            $query = 'UPDATE mecz SET '
            .'druzyna_gospodarz = :druzyna_gospodarz,'
            .'druzyna_gosc = :druzyna_gosc,'
            .'wynik_gospodarz = :wynik_gospodarz,'
            .'wynik_gosc = :wynik_gosc,'
            .'data = :data,'
            .'godzina = :godzina,'
            .'rozegrany = :rozegrany
            WHERE id_mecz = :id_mecz';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_mecz', $id_mecz, PDO::PARAM_INT);
            $stmt->bindValue(':druzyna_gospodarz', $druzyna_gospodarz, PDO::PARAM_INT);
            $stmt->bindValue(':druzyna_gosc', $druzyna_gosc, PDO::PARAM_INT);
            $stmt->bindValue(':wynik_gospodarz', $wynik_gospodarz, PDO::PARAM_STR);
            $stmt->bindValue(':wynik_gosc', $wynik_gosc, PDO::PARAM_STR);
            $stmt->bindValue(':data', $data, PDO::PARAM_STR);
            $stmt->bindValue(':godzina', $godzina, PDO::PARAM_STR);
            $stmt->bindValue(':rozegrany', $rozegrany, PDO::PARAM_STR);


            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

    public function insertRow($druzyna_gospodarz, $druzyna_gosc, $wynik_gospodarz, $wynik_gosc, $data, $godzina, $rozegrany)
    {
        try	{

            $query = 'INSERT INTO `mecz` (`druzyna_gospodarz`, druzyna_gosc, wynik_gospodarz,
                                            wynik_gosc, `data`, `godzina`, `rozegrany`)
                      VALUES (:druzyna_gospodarz, :druzyna_gosc, :wynik_gospodarz, :wynik_gosc, :data, :godzina, :rozegrany)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':druzyna_gospodarz', $druzyna_gospodarz, PDO::PARAM_INT);
            $stmt->bindValue(':druzyna_gosc', $druzyna_gosc, PDO::PARAM_INT);
            $stmt->bindValue(':wynik_gospodarz', $wynik_gospodarz, PDO::PARAM_STR);
            $stmt->bindValue(':wynik_gosc', $wynik_gosc, PDO::PARAM_STR);
            $stmt->bindValue(':data', $data, PDO::PARAM_STR);
            $stmt->bindValue(':godzina', $godzina, PDO::PARAM_STR);
            $stmt->bindValue(':rozegrany', $rozegrany, PDO::PARAM_STR);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

}
