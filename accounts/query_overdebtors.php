<?php

$servername = "localhost";
$username = "root";
$password = "yourpass";
$dbname = "quera_college";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate and execute transactions for n = 100 new accounts
$totalAccounts = 100;
$targetBalance = -1000000000;

for ($i = 0; $i < $totalAccounts; $i++) {
    $accountNo = rand(1, 99999);
    $balance = rand(0, 1000000);

    // Insert the new account into the database
    $sql = "INSERT INTO accounts (ACCOUNT_NO, DATE, WITHDRAWAL, DEPOSIT, BALANCE) VALUES ('$accountNo', NOW(), 0, 0, $balance)";

    if ($conn->query($sql) === TRUE) {
        echo "Created account $accountNo with initial balance $i\n";
    } else {
        echo "Error creating account: " . $conn->error . "\n";
    }

    // Perform transactions until the target balance is reached
    while ($balance >= $targetBalance) {
        $maxDateQuery = "SELECT MAX(DATE) AS MAX_DATE FROM accounts WHERE ACCOUNT_NO = '$accountNo'";
        $maxDateResult = $conn->query($maxDateQuery);
        $maxDateRow = $maxDateResult->fetch_assoc();
        $maxDate = $maxDateRow['MAX_DATE'];

        $date = date("Y-m-d H:i:s", strtotime("-" . rand(1, 365) . " days"));
        $withdrawal = rand(100000000000, 1000000000000) / 100.0; // Larger withdrawals
        $deposit = rand(1, 1000) / 100.0;

        $balance += $deposit - $withdrawal;

        $sql = "INSERT INTO accounts (ACCOUNT_NO, DATE, WITHDRAWAL, DEPOSIT, BALANCE) VALUES ('$accountNo', '$maxDate', $withdrawal, $deposit, $balance)";

        if ($conn->query($sql) !== TRUE) {
            echo "Error performing transaction for account $accountNo: " . $conn->error . "\n";
            break; // Exit the loop if there's an error
        }
    }
}

$conn->close();
