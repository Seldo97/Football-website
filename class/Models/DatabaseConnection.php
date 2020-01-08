<?php

namespace models;
use pdo;

abstract class DatabaseConnection
{

	public $pdo;
    private $table;
    private $id;

	public function __construct($table, $id)
	{
        $this->table = $table;
        $this->id = $id;
        $this->pdo = \Handles\MySQL::getHandle();
        //d($this->pdo);
	}

//    #######Zapytania######

    public function showAll()
    {
        $data = array();
        try	{

            //parent::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = 'SELECT * FROM ' .$this->table;
            $stmt = $this->pdo->query($query);

            // if($stmt->execute()) {
            //     $data = $stmt->fetchAll();
            // }

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

    public function selectOneById($id)
    {
        $data = array();
        try	{

            $query = 'SELECT * FROM ' .$this->table.' WHERE '.$this->id.' = :id';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                $data = $stmt->fetchAll();
            }

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
        //d($data);
        return $data;
    }

    public function selectByName($column, $value)
    {
        $data = array();
        try	{

            $query = 'SELECT * FROM ' .$this->table.' WHERE '.$column.' = :value';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':value', $value, PDO::PARAM_INT);

            if($stmt->execute()) {
                $data = $stmt->fetchAll();
            }

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
        //d($data);
        return $data;
    }

    public function deleteOneById($id)
    {
        try	{

            $query = 'DELETE FROM '.$this->table.' WHERE '.$this->id.' = :id';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
        //d($data);
    }

}
