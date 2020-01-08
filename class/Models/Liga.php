<?php
namespace Models;

use PDO;

class Liga extends DatabaseConnection
{
    //$pdo;
    public function __construct()
    {
        parent::__construct('liga','id_liga');
        //d($this->pdo);
    }

    public function updateById($id_liga, $nazwa)
    {
        try	{

            $query = 'UPDATE Liga SET '
            .'nazwa = :nazwa
            WHERE id_liga = :id_liga';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_liga', $id_liga, PDO::PARAM_INT);
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

    public function insertRow($id_liga, $nazwa)
    {
        try	{

            $query = 'INSERT INTO `liga` (`id_liga`, `nazwa`)
            VALUES
            (:id_liga, :nazwa)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_liga', $id_liga, PDO::PARAM_INT);
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

}
