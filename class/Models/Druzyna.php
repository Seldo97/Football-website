<?php
namespace Models;

use PDO;

class Druzyna extends DatabaseConnection
{
    //$pdo;
    public function __construct()
    {
        parent::__construct('druzyna', 'id_druzyna');
        //d($this->pdo);
    }

    public function showView()
    {
        $data = array();
        try	{

            $query = 'SELECT id_druzyna, druzyna.nazwa AS nazwa, druzyna.logo AS logo, L.nazwa AS liga
                        FROM druzyna INNER JOIN liga AS L ON druzyna.id_liga = L.id_liga
                        ORDER BY liga DESC, nazwa ASC';

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

    public function updateById($id_druzyna, $logo, $nazwa, $id_liga)
    {
        try	{

            $query = 'UPDATE druzyna SET '
            .'nazwa = :nazwa,'
            .'id_liga = :id_liga,'
            .'logo = :logo
            WHERE id_druzyna = :id_druzyna';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_druzyna', $id_druzyna, PDO::PARAM_INT);
            $stmt->bindValue(':id_liga', $id_liga, PDO::PARAM_INT);
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
            $stmt->bindValue(':logo', $logo, PDO::PARAM_STR);


            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

    public function insertRow($nazwa, $logo, $id_liga)
    {
        try	{

            $query = 'INSERT INTO `druzyna` (`nazwa`, `logo`, `id_liga`)
            VALUES
            (:nazwa, :logo, :id_liga)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_liga', $id_liga, PDO::PARAM_INT);
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
            $stmt->bindValue(':logo', $logo, PDO::PARAM_STR);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

}
