<?php

namespace PhpExcel\Database;

use PDO;

class PDOConnection implements Connection
{
    private PDO $pdo;

    /**
     * Establishing  new DB connection
     * @param $dsn :Connection String "mysql:host=localhost;dbname=db_name;charset=utf8mb4"
     * @param $username
     * @param $password
     */
    public function __construct($dsn, $username, $password)
    {
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get PDO object to interacts with DB
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
