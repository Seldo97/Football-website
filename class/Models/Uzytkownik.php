<?php
namespace Models;

use PDO;

class Uzytkownik extends DatabaseConnection
{
    //$pdo;
    public function __construct()
    {
        parent::__construct('uzytkownik', 'id_uzytkownik');
        //d($this->pdo);
    }

}
