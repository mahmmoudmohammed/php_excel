<?php

namespace PhpExcel\Validators;

use DateTime;

class InvoiceValidator implements Validator
{
    private array $validated = [];

    public function validate(array $row): array
    {
        $keys = [0 => 'invoice', 1 => 'invoice date', 8 => 'grand total'];

        foreach ($keys as $index => $fieldName) {
            if (!isset($row[$index])) {
                throw new \InvalidArgumentException("Missing field '$fieldName' in the row.");
            }

            switch ($fieldName) {
                case 'invoice':
                    if (!is_numeric($row[$index])) {
                        throw new \InvalidArgumentException("Invalid invoice number format.");
                    }
                    $this->validated['id'] = (int)$row[$index];
                    break;
                case 'invoice date':
                    $invoiceDate = $this->daysToDate($row[$index]);
//                    var_dump($this->row,$invoiceDate);die;
                    $this->validated['date'] = $invoiceDate;
                    break;
                case 'grand total':
                    if (!is_numeric($row[$index])) {
                        throw new \InvalidArgumentException("Invalid grand total format.");
                    }
                    $this->validated['grand_total'] = (float)$row[$index];
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