<?php

namespace PhpExcel\Excel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as SpreadsheetReaderException;
use RuntimeException;

class ExcelImporter
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Import data from the Excel file.
     *
     * @return array
     *
     * @throws RuntimeException if unable to open the file or read data
     */
    public function importData(): array
    {
        $this->validateFile();

        $data = [];
        try {
            $spreadsheet = IOFactory::load($this->filePath);
            $sheet = $spreadsheet->getActiveSheet();

            $iterator = $sheet->getRowIterator();
            $iterator->next();

            while ($iterator->valid()) {
                $row = $iterator->current();
                $rowData = [];

                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getCalculatedValue();
                }

                $data[] = $rowData;
                $iterator->next();
            }
        } catch (SpreadsheetReaderException $e) {
            throw new RuntimeException('Error reading data from the Excel file', 500, $e);
        }

        return $data;
    }

    /**
     * Validate the file path.
     *
     * @throws RuntimeException if the file path is invalid
     */
    private function validateFile(): void
    {
        if (!file_exists($this->filePath)) {
            throw new RuntimeException('File path does not exist', 400);
        }

        if (!is_readable($this->filePath)) {
            throw new RuntimeException('Failed to read file path', 400);
        }
    }
}