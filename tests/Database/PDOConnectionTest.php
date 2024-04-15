<?php

namespace Database;

use PhpExcel\Database\PDOConnection;
use PHPUnit\Framework\TestCase;
use PDO;

class PDOConnectionTest extends TestCase
{
    public function testConnection(): void
    {
        // Arrange
        $dsn = 'mysql:host=localhost;dbname=php_excel;charset=utf8mb4';
        $username = 'mahmoud';
        $password = 'Mm@119988';

        // Act
        $connection = new PDOConnection($dsn, $username, $password);
        $pdo = $connection->getConnection();

        // Assert
        $this->assertInstanceOf(PDO::class, $pdo);
        $this->assertTrue($pdo->getAttribute(PDO::ATTR_ERRMODE) === PDO::ERRMODE_EXCEPTION);
    }
}
