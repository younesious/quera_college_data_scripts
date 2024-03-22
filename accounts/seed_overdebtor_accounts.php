<?php

$servername = "localhost";
$username = "root";
$password = "yourpass";
$dbname = "quera_college";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$totalAccounts = 50;
$targetBalance = -1000000000;

for ($i = 0; $i < $totalAccounts; $i++) {
    $accountNo = rand(1, 99999);
    $balance = rand(0, 1000000);

    // Perform transactions until the target balance is reached
    while ($balance >= $targetBalance) {
        // Get the maximum date for this account
        $maxDateQuery = "SELECT MAX(DATE) AS MAX_DATE FROM accounts WHERE ACCOUNT_NO = '$accountNo'";
        $maxDateResult = $conn->query($maxDateQuery);
        $maxDateRow = $maxDateResult->fetch_assoc();
        $maxDate = $maxDateRow['MAX_DATE'];

        $newDate = date("Y-m-d H:i:s", strtotime($maxDate) + rand(1, 60));

        $withdrawal = rand(100000000000, 1000000000000) / 100.0;
        $deposit = rand(1, 1000) / 100.0;
        $balance += $deposit - $withdrawal;

        $sql = "INSERT INTO accounts (ACCOUNT_NO, DATE, WITHDRAWAL, DEPOSIT, BALANCE) VALUES ('$accountNo', '$newDate', $withdrawal, $deposit, $balance)";
        echo "$i\n";
        if ($conn->query($sql) !== TRUE) {
            echo "Error performing transaction for account $accountNo: " . $conn->error . "\n";
            break;
        }
    }
}

$conn->close();
