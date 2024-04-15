<?php

namespace PhpExcel\DTOs;
class CustomerDTO
{
    /**
     * Create instance of invoice
     * @param int $id
     * @param string $name
     */
    private function __construct(public readonly string $name, public readonly int $id)
    {
    }

    public static function create(string $name, int $id = 0): CustomerDTO
    {
        return new self($name, $id);
    }
}