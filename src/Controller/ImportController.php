<?php

namespace PhpExcel\Controller;

use PDOException;
use PhpExcel\Database\Connection;
use PhpExcel\DTOs\CustomerDTO;
use PhpExcel\DTOs\InvoiceDTO;
use PhpExcel\Repositories\CustomerRepository;
use PhpExcel\Repositories\CustomerRepositoryInterface;
use PhpExcel\Repositories\InvoiceRepository;
use PhpExcel\Repositories\InvoiceRepositoryInterface;
use PhpExcel\Validators\Validator;

class ImportController
{
    private \PDO $pdo;
    private Validator $invoiceValidator;
    private CustomerRepositoryInterface $customerRepository;
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(
        Connection         $connection,
        Validator          $invoiceValidator,
        CustomerRepository $customerRepository,
        InvoiceRepository  $invoiceRepository
    )
    {
        $this->pdo = $connection->getConnection();
        $this->customerRepository = $customerRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceValidator = $invoiceValidator;
    }

    public function store(array $rows): array
    {
        $createdInvoices = [];
        foreach ($rows as $row) {
            try {
                $this->pdo->beginTransaction();
                // Considering that addresses and products already inserted

                // Create customer from name
                $customer_id = $this->customerRepository->create(
                    CustomerDTO::create($row[2])
                );

                // Validate and Create Invoice
                $invoice = $this->invoiceValidator->validate($row);
                $createdInvoices [] = $this->invoiceRepository->create(
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
