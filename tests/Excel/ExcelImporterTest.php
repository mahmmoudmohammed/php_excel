<?php

namespace Excel;

use PhpExcel\Excel\ExcelImporter;
use PHPUnit\Framework\TestCase;

class ExcelImporterTest extends TestCase
{
    public function testImportData(): void
    {
        // Arrange
        $filePath = 'data.xlsx';
        $expectedData = [1, 43831, 'Idaline Mateuszczyk', '95798 Fieldstone Point', 'Soup - Knorr, Ministrone', 2, 20, 40, 55.5] ;
        $excelImporter = new ExcelImporter($filePath);

        // Act
        $importedData = $excelImporter->importData();

        // Assert
        $this->assertIsArray($importedData);
        $this->assertNotEmpty($importedData);

//        array_shift($expectedData);

        $this->assertEquals($expectedData, $importedData[1]);

        // Assert that the imported data has the correct structure
        foreach ($importedData as $row) {
            $this->assertCount(9, $row);
        }
    }
}
