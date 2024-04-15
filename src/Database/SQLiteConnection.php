<?php

namespace PhpExcel\Database;

use SQLite3;

class SQLiteConnection implements Connection
{
    private SQLite3 $connection;

    /**
     * Establishing  new DB connection
     * @param $databaseFilePath :path to SQLite file
     */
    public function __construct($databaseFilePath)
    {
        $this->connection = new SQLite3($databaseFilePath);
    }

    /**
     * Get connection object to interacts with DB
     */
    public function getConnection(): SQLite3
    {
        return $this->connection;
    }

    /**
     * Close Database connection
     */
    public function close(): bool
    {
        return $this->connection->close();
    }
}
