# PHP Excel Importer

This project is a PHP application that provides a clean and structured solution for importing Excel data and storing it in a database.

## Architecture Overview

The project follows a modular architecture with separation of concerns to ensure maintainability and flexibility. It consists of the following components:

1. **Repositories**: Contains classes responsible for interacting with the database, such as inserting and retrieving invoice data.

2. **Database**: Contains classes related to database connection and configuration.

3. **Excel**: Contains classes for importing data from Excel files.

4. **Controllers**: Contains classes responsible for handling interaction between repositories,Excel importer and returning responses.

5. **Tests**: Contains unit tests for database, Excel, and other components.

## Requirements

- PHP 8.1 or higher
- [Composer](https://getcomposer.org/) for dependency management
- phpoffice/phpspreadsheet 3.3 or higher

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/mahmmoudmohammed/php_excel.git
    ```

2. Navigate to the project directory:

    ```bash
    cd php_excel
    ```

3. Install dependencies using Composer:

    ```bash
    composer install
    ```
4. **Start your project and scale as business requires**

## Configuration

1. Database Configuration:

    - Create a database configuration in `config/connection.php` with the following structure:

        ```php
        <?php

        return [
            'pdo' => [
                'dsn' => 'mysql:host=localhost;dbname=database_name',
                'username' => 'username',
                'password' => 'password'
            ]
        ];
        ```

    - Replace `'mysql:host=localhost;dbname=database_name'` with your database DSN, `'username'` with your database username, and `'password'` with your database password.
    - Or can Create your own database connection class just  implement `config/connection.php` interface

2. Excel File:

    - Place your Excel file in the project root directory or specify its path in the `index.php` file.

## Usage

1. Import Data:

    - Execute the `index.php` file in the command line:

        ```bash
        php index.php
        ```

    - The program will import data from the specified Excel file, store it in the database, and display a success message.

2. Access Invoices:

   - You can access all invoices by Execute the `invoices.php` file in the command line:

     ```bash
     php invoices.php
     ```

  - This will return a JSON response containing all invoices stored in the database.

## Testing

1. Run PHPUnit tests:

    ```bash
    composer test
    ```

    - This will execute all unit tests located in the `tests` directory and display the results.
