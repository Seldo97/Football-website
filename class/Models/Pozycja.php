<?php
namespace Models;

use PDO;

class Pozycja extends DatabaseConnection
{
    //$pdo;
    public function __construct()
    {
        parent::__construct('pozycja', 'id_pozycja');
        //d($this->pdo);
    }

    public function updateById($id_pozycja, $nazwa)
    {
        try	{

            $query = 'UPDATE pozycja SET '
            .'nazwa = :nazwa
            WHERE id_pozycja = :id_pozycja';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_pozycja', $id_liga, PDO::PARAM_INT);
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

    public function insertRow($id_pozycja, $nazwa)
    {
        try	{

            $query = 'INSERT INTO `pozycja` (`id_pozycja`, `nazwa`)
            VALUES
            (:id_pozycja, :nazwa)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_pozycja', $id_liga, PDO::PARAM_INT);
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

}
