<?php

namespace PhpExcel\Repositories;

use PhpExcel\Database\Connection;
use PhpExcel\DTOs\CustomerDTO;

class CustomerRepository implements CustomerRepositoryInterface
{
    private $pdo;

    public function __construct(Connection $connection)
    {
        $this->pdo = $connection->getConnection();
    }

    /** Insert new customer record and return id
     * @param CustomerDTO $invoice :object contains customer data
     */
    public function create(CustomerDTO $invoice)
    {
        $stmt = $this->pdo->prepare("INSERT INTO customers (name) VALUES (?)");
        $stmt->execute([
            $invoice->name,
        ]);
        return $this->pdo->lastInsertId();
    }


    public function list(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM customers LIMIT 15");
        $customers = [];

        while ($customerData = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = [
                'reference_number' => $customerData['reference_number'],
                'date' => $customerData['date'],
                'customer_id' => $customerData['customer_id'],
                'grand_total' => $customerData['grand_total']
            ];
        }

        return $customers;
    }
}
