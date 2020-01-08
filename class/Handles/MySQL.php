<?php
    namespace Handles;

    use Config\Database\MySQL as sql;
    use PDO;

    class MySQL extends Handle
    {
        protected function __clone() {}
        protected function __construct()
        {
            try{
                $this->pdo = new PDO(
                    sql::$tab['type'].
                    ':host='.sql::$tab['host'].
                    ';dbname='.sql::$tab['database'].
                    ';charset=utf8' .
                    ';port='.sql::$tab['port'],
                    sql::$tab['user'],
                    sql::$tab['password']
                    );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(\PDOException $e) {
                $this->pdo = null;
                throw new \Exceptions\DatabaseConnection($e);
            }
        }
    }
