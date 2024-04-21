<?php

namespace PhpExcel\Controller;

use PhpExcel\Database\Connection;
use PhpExcel\Repositories\InvoiceRepository;
use PhpExcel\Repositories\InvoiceRepositoryInterface;

class InvoiceController
{
    private InvoiceRepositoryInterface $repository;
    public function __construct(InvoiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function showAllInvoices(): void
    {
        $invoices = $this->repository->list();
        echo json_encode($invoices);
    }
}
