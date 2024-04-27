<?php
require __DIR__ . '/vendor/autoload.php';

use PhpExcel\Controller\ImportController;
use PhpExcel\Database\PDOConnection;
use PhpExcel\Excel\ExcelImporter;
use PhpExcel\Repositories\CustomerRepository;
use PhpExcel\Repositories\InvoiceRepository;
use PhpExcel\Validators\InvoiceValidator;

$dbConfig = require __DIR__ . '/config/connection.php';
$dsn      = $dbConfig['pdo']['dsn'];
$username = $dbConfig['pdo']['username'];
$password = $dbConfig['pdo']['password'];

$dbConnection = new PDOConnection($dsn, $username, $password);

// TODO::Should implement routing service
$excelFilePath    = 'data.xlsx';
$importedData    = (new ExcelImporter($excelFilePath))->importData();
//echo '<pre>' , var_dump($importedData) , '</pre>';

$invoices = (
new ImportController(
    $dbConnection,
    new InvoiceValidator(),
    new CustomerRepository($dbConnection),
    new InvoiceRepository($dbConnection)
))->store($importedData);

//echo '<pre>' , var_dump($invoices) , '</pre>';

echo "Data imported successfully.\n";

