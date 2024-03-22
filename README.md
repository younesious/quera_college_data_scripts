# Data Processing Project

This repository contains Python scripts for data manipulation and a PHP script for database seeding and querying.

## Python Scripts in `advertisements` directory
- `load_categories_to_db.py`: Python script to manipulate data from an Excel file and insert it into a MySQL database.
- `convert_categories_to_csv.py`: Python script for simpler way, We can convert Excel file into CSV file and then We can import CSV file with Datagrip IDE.

## PHP Scripts in `accounts` directory
- `query_overdebtors.php`: PHP script to seed the database with transactional data and perform queries.
- `seed_overdebtor_accounts.php`: PHP script to seed the database with overdebtor accounts data.
This script generates random overdebtor accounts and simulates transactions until a target balance is reached, inserting the data into the accounts table in the MySQL database.

## Tables Overview

### Categories Table
| Column Name | Data Type    | Description             |
|-------------|--------------|-------------------------|
| `ID`        | BIGINT       | Category ID             |
| `Name`      | TEXT         | Category Name           |
| `IDParent`  | DOUBLE       | Parent Category ID      |

This table represents categories with their IDs, names, and parent category IDs.

### Advertisements Table
| Column Name | Data Type    | Description                           |
|-------------|--------------|---------------------------------------|
| `ID`        | INT          | Advertisement ID                      |
| `IDUser`    | INT          | User ID who posted the advertisement  |
| `DateAdded` | DATETIME     | Date and time when the ad was posted  |
| `IDCategory`| INT          | Category ID of the advertisement      |
| `Price`     | DOUBLE       | Price of the advertisement            |

This table stores information about advertisements, including their IDs, posting dates, user IDs, category IDs, and prices.

### Accounts Table
| Column Name | Data Type    | Description                               |
|-------------|--------------|-------------------------------------------|
| `ACCOUNT_NO`| VARCHAR(20)  | Account number                            |
| `DATE`      | DATETIME     | Transaction date and time                 |
| `WITHDRAWAL`| DECIMAL(15,4)| Withdrawal amount from the account        |
| `DEPOSIT`   | DECIMAL(15,4)| Deposit amount into the account           |
| `BALANCE`   | DECIMAL(15,4)| Current balance of the account            |

This table represents accounts with their account numbers, transaction dates, withdrawal and deposit amounts, and current balances.

## Usage
1. Ensure you have Python and PHP installed on your system.
2. Run `python3 advertisements/load_categories_to_db.py` to execute the Python script for data manipulation.
3. Run `php accounts/query_overdebtors.php` to seed the database and perform queries.

Feel free to modify and extend these scripts as needed for your project.

## Requirements
- Python 3.x
- PHP
- MySQL database
