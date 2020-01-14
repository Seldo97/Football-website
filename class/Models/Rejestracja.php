<?php
namespace Models;
use PDO;

class Rejestracja extends DatabaseConnection
{
    public function __construct()
    {
        parent::__construct('uzytkownik', 'login');
    }

    public function registerParticipant()
    {
        try
        {
            // Tabela Uzytkownik
            $data_1 = [
                'id_uzytkownik' => NULL,
                'login' => $_POST['login'],
                'haslo' => password_hash($_POST['haslo'], PASSWORD_DEFAULT),
                'email' => $_POST['email'],
                'id_uprawnienia' => 2
            ];

            $query_1 = "
                INSERT INTO uzytkownik
                (id_uzytkownik, login, haslo, email, id_uprawnienia)
                VALUES (:id_uzytkownik, :login, :haslo, :email, :id_uprawnienia);
            ";

            $pdo = \Handles\MySQL::getHandle();
            $pdo->query("SET autocommit = 0");
            $pdo->beginTransaction();

            $stmt = $pdo->prepare($query_1);
            $stmt->execute($data_1);

            $pdo->commit();
            // $stmt->closeCursor();
            return 1;
        }
        catch(\PDOException $e)
        {
            $pdo->rollback();
            echo 'Błąd zapytania: ' . $e->getMessage();
            d($e);
        }
    }
}
