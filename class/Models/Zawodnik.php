<?php
namespace Models;

use PDO;

class Zawodnik extends DatabaseConnection
{
    //$pdo;
    public function __construct()
    {
        parent::__construct('zawodnik', 'id_zawodnik');
        //d($this->pdo);
    }

    public function showView($filtr = '')
    {
        $data = array();
        try	{
            $where = $filtr;
            $orderBy = 'ORDER BY imie, nazwisko';
            $query = "SELECT id_zawodnik, imie, nazwisko, data_urodzenia, wzrost, narodowosc, do_kiedy_kontrakt,
                                D.nazwa AS druzyna, P.nazwa AS pozycja, D.id_druzyna AS IdDruzyna, P.id_pozycja AS IdPozycja
                      FROM zawodnik INNER JOIN druzyna AS D ON zawodnik.id_druzyna = D.id_druzyna
				                    INNER JOIN pozycja AS P ON zawodnik.id_pozycja = P.id_pozycja
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

    public function updateById($id_zawodnik, $imie, $nazwisko, $data_urodzenia, $wzrost, $narodowosc,
                                $do_kiedy_kontrakt, $id_druzyna, $id_pozycja)
    {
        try	{

            $query = 'UPDATE zawodnik SET '
            .'imie = :imie,'
            .'nazwisko = :nazwisko,'
            .'data_urodzenia = :data_urodzenia,'
            .'wzrost = :wzrost,'
            .'narodowosc = :narodowosc,'
            .'do_kiedy_kontrakt = :do_kiedy_kontrakt,'
            .'id_druzyna = :id_druzyna,'
            .'id_pozycja = :id_pozycja
            WHERE id_zawodnik = :id_zawodnik';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_zawodnik', $id_zawodnik, PDO::PARAM_INT);
            $stmt->bindValue(':imie', $imie, PDO::PARAM_STR);
            $stmt->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
            $stmt->bindValue(':data_urodzenia', $data_urodzenia, PDO::PARAM_STR);
            $stmt->bindValue(':wzrost', $wzrost, PDO::PARAM_INT);
            $stmt->bindValue(':narodowosc', $narodowosc, PDO::PARAM_STR);
            $stmt->bindValue(':do_kiedy_kontrakt', $do_kiedy_kontrakt, PDO::PARAM_STR);
            $stmt->bindValue(':id_druzyna', $id_druzyna, PDO::PARAM_INT);
            $stmt->bindValue(':id_pozycja', $id_pozycja, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            //d($e);
        }
    }

    public function insertRow($imie, $nazwisko, $data_urodzenia, $wzrost, $narodowosc,
                                $do_kiedy_kontrakt, $id_druzyna, $id_pozycja)
    {
        try	{

            $query = 'INSERT INTO `zawodnik`
            (`imie`, `nazwisko`, `data_urodzenia`, `wzrost`, `narodowosc`, `do_kiedy_kontrakt`, `id_druzyna`, `id_pozycja`)
            VALUES
            (:imie, :nazwisko, :data_urodzenia, :wzrost, :narodowosc, :do_kiedy_kontrakt, :id_druzyna, :id_pozycja)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':imie', $imie, PDO::PARAM_STR);
            $stmt->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
            $stmt->bindValue(':data_urodzenia', $data_urodzenia, PDO::PARAM_STR);
            $stmt->bindValue(':wzrost', $wzrost, PDO::PARAM_INT);
            $stmt->bindValue(':narodowosc', $narodowosc, PDO::PARAM_STR);
            $stmt->bindValue(':do_kiedy_kontrakt', $do_kiedy_kontrakt, PDO::PARAM_STR);
            $stmt->bindValue(':id_druzyna', $id_druzyna, PDO::PARAM_INT);
            $stmt->bindValue(':id_pozycja', $id_pozycja, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            //d($e);
        }
    }

}
