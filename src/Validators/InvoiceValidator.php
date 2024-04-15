<?php

namespace PhpExcel\Validators;

use DateTime;

class InvoiceValidator implements Validator
{
    private array $row;
    private array $validated = [];

    public function __construct(array $row)
    {
        $this->row = $row;
    }

    public function validate(): array
    {
        $keys = [0 => 'invoice', 1 => 'invoice date', 8 => 'grand total'];

        foreach ($keys as $index => $fieldName) {
            if (!isset($this->row[$index])) {
                throw new \InvalidArgumentException("Missing field '$fieldName' in the row.");
            }

            switch ($fieldName) {
                case 'invoice':
                    if (!is_numeric($this->row[$index])) {
                        throw new \InvalidArgumentException("Invalid invoice number format.");
                    }
                    $this->validated['id'] = (int)$this->row[$index];
                    break;
                case 'invoice date':
                    $invoiceDate = $this->daysToDate($this->row[$index]);
//                    var_dump($this->row,$invoiceDate);die;
                    $this->validated['date'] = $invoiceDate;
                    break;
                case 'grand total':
                    if (!is_numeric($this->row[$index])) {
                        throw new \InvalidArgumentException("Invalid grand total format.");
                    }
                    $this->validated['grand_total'] = (float)$this->row[$index];
                    break;
            }
        }

        return $this->validated;
    }

    private function daysToDate($days): string
    {
        $date = new DateTime('1900-01-01');
        $date->modify('+' . $days . ' days');
        return $date->format('Y-m-d H:i:s');
    }
}