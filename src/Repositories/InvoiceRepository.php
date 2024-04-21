<?php

namespace PhpExcel\Repositories;

use PhpExcel\Database\Connection;
use PhpExcel\DTOs\InvoiceDTO;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    private $pdo;

    public function __construct(Connection $connection)
    {
        $this->pdo = $connection->getConnection();
    }

    /** Insert new invoice record
     * @param InvoiceDTO $invoice :object contains invoice data
     */
    public function create(InvoiceDTO $invoice)
    {
        $stmt = $this->pdo->prepare("INSERT INTO invoices (date, grand_total,customer_id) VALUES (?, ?, ?)");
        $stmt->execute([
            $invoice->date,
            $invoice->grandTotal,
            $invoice->customerId
        ]);
        return $this->pdo->lastInsertId();
    }

    /** Retrieve all invoice records
     * @return array
     */
    public function list(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM invoices LIMIT 15");
        $invoices = [];

        while ($invoiceData = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $invoices[] = [
                'id' => $invoiceData['id'],
                'date' => $invoiceData['date'],
                'customer_id' => $invoiceData['customer_id'],
                'grand_total' => $invoiceData['grand_total']
            ];
        }

        return $invoices;
    }
}
