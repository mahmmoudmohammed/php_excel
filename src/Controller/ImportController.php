<?php

namespace PhpExcel\Controller;

use PDOException;
use PhpExcel\Database\Connection;
use PhpExcel\DTOs\CustomerDTO;
use PhpExcel\DTOs\InvoiceDTO;
use PhpExcel\Repositories\CustomerRepository;
use PhpExcel\Repositories\InvoiceRepository;
use PhpExcel\Validators\InvoiceValidator;

class ImportController
{
    private Connection $connection;
    private $pdo;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->pdo = $connection->getConnection();
    }

    public function store(array $rows): array
    {
        $createdInvoices = [];
        foreach ($rows as $row) {
            try {
                $this->pdo->beginTransaction();
                // Considering that addresses and products already inserted

                // Create customer from name
                $customer_id = (new CustomerRepository($this->connection))
                    ->create(CustomerDTO::create($row[2]));

                // Validate and Create Invoice
                $invoice = (new InvoiceValidator($row))->validate();
                $createdInvoices [] = (new InvoiceRepository($this->connection))->create(
                    InvoiceDTO::create(
                        $invoice['id'],
                        $invoice['date'],
                        $customer_id,
                        $invoice['grand_total']
                    ));
                $this->pdo->commit();
            } catch (PDOException $err) {
                $this->pdo->rollback();
                throw new PDOException($err->getMessage(), 500, $err);
            }
        }
        return $createdInvoices;
    }
}
