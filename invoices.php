<?php
require __DIR__ . '/vendor/autoload.php';

use PhpExcel\Controller\InvoiceController;
use PhpExcel\Database\PDOConnection;
use PhpExcel\Repositories\InvoiceRepository;

$dbConfig = require __DIR__ . '/config/connection.php';
$dsn      = $dbConfig['pdo']['dsn'];
$username = $dbConfig['pdo']['username'];
$password = $dbConfig['pdo']['password'];

$dbConnection = new PDOConnection($dsn, $username, $password);

// list all invoices;
(new InvoiceController(
    new InvoiceRepository($dbConnection)
))->showAllInvoices();

