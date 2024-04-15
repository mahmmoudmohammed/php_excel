<?php

namespace PhpExcel\Controller;

use PhpExcel\Database\Connection;
use PhpExcel\Repositories\InvoiceRepository;

class InvoiceController
{
    private Connection $connection;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    public function showAllInvoices(): void
    {
        $invoices = (new InvoiceRepository($this->connection))->list();
        echo json_encode($invoices);
    }
}
