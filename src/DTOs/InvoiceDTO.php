<?php
namespace PhpExcel\DTOs;
class InvoiceDTO
{

    /**
     * Create instance of invoice
     * @param int $id
     * @param string $date
     * @param int $customerId
     * @param float $grandTotal
     */
    private function __construct(
        public readonly int    $id,
        public readonly string $date,
        public readonly int    $customerId,
        public readonly float  $grandTotal
    )
    {
    }

    public static function create(int $id, string $date, int $customerId, float $grandTotal): InvoiceDTO
    {
        return new self($id, $date, $customerId, $grandTotal);
    }
}