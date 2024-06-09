<?php

global $pdo;
require_once __DIR__ . '/db_connection.php';

try {
    // Check if the donors table exists
    $stmt = $pdo->prepare("SHOW TABLES LIKE 'donors'");
    $stmt->execute();

    // If the table does not exist, create it
    if ($stmt->rowCount() === 0) {
        echo "Creating table..." . '<br>';
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS donors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                first_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone_number VARCHAR(50) NOT NULL,
                sex ENUM('M', 'F', 'O') NOT NULL,
                age INT NOT NULL,
                weight FLOAT NOT NULL,
                temporary_exclusion BOOLEAN NOT NULL,
                reason_temporary_exclusion VARCHAR(255),
                permanent_exclusion BOOLEAN NOT NULL,
                reason_permanent_exclusion VARCHAR(255),
                last_blood_donation_date DATE,
                last_plasma_donation_date DATE
            )
        ");
    } else {
        echo "Table already exists. Skipping table creation." . '<br>';
    }

    // Check if the table is empty
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM donors");
    $stmt->execute();
    $count = $stmt->fetchColumn();

    // If the table is empty, insert some data
    if ($count === 0) {
        echo "Inserting donors..." . '<br>';
        $stmt = $pdo->prepare("
            INSERT INTO donors (name, first_name, email, phone_number, sex, age, weight, temporary_exclusion, reason_temporary_exclusion, permanent_exclusion, reason_permanent_exclusion, last_blood_donation_date, last_plasma_donation_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        // Define donors data
        $donors = [
            // John Doe is a male donor with no exclusions and has not donated before
            ['John', 'Doe', 'john.doe@example.com', '1234567890', 'M', 30, 75.5, 0, null, 0, null, null, null],

            // Scarlet Doe is a female donor with no exclusions and has donated blood before
            ['Scarllet', 'Doe', 'scarlet.doe@example.com', '0987654321', 'F', 28, 65.5, 0, null, 0, null, '2021-01-01', null],

            // Jack Doe is a male donor with no exclusions and has donated plasma before
            ['Jack', 'Doe', 'jack.doe@example.com', '1234567890', 'M', 30, 75.5, 0, null, 0, null, null, '2021-01-01'],

            // Alice Doe is a donor of other gender with no exclusions and has donated both blood and plasma before
            ['Alice', 'Doe', 'alice.doe@example.com', '1122334455', 'O', 25, 70.5, 0, null, 0, null, '2021-01-01', '2021-01-01'],

            // Jane Doe is a female donor with a temporary exclusion for medical reasons
            ['Jane', 'Doe', 'jane.doe@example.com', '0987654321', 'F', 28, 65.5, 1, 'Medical reasons', 0, null, null, null],

            // Alex Doe is a donor of other gender with a permanent exclusion for age reasons
            ['Alex', 'Doe', 'alex.doe@example.com', '1122334455', 'O', 25, 70.5, 0, null, 1, 'Age reasons', null, null],

            // Bob Doe is a donor of other gender with both temporary and permanent exclusions for medical and age reasons respectively
            ['Bob', 'Doe', 'bob.doe@example.com', '5544332211', 'O', 35, 80.5, 1, 'Medical reasons', 1, 'Age reasons', null, null]
        ];

        // Insert each donor into the database
        foreach ($donors as $donor) {
            $stmt->execute($donor);
        }
    } else {
        echo "Table already contains data. Skipping data insertion." . '<br>';
    }

    // Check if the admins table exists
    $stmt = $pdo->prepare("SHOW TABLES LIKE 'admins'");
    $stmt->execute();

    // If the table does not exist, create it
    if ($stmt->rowCount() === 0) {
        echo "Creating admins table..." . '<br>';
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS admins (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )
        ");
    } else {
        echo "Admins table already exists. Skipping table creation." . '<br>';
    }

    // Check if the admins table is empty
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins");
    $stmt->execute();
    $count = $stmt->fetchColumn();

    // If the table is empty, insert some data
    if ($count === 0) {
        echo "Inserting admins..." . '<br>';
        $stmt = $pdo->prepare("
            INSERT INTO admins (username, password)
            VALUES (?, ?)
        ");

        // Define admins data
        $admins = [
            // Admin user with username 'admin' and password 'password'
            ['admin', password_hash('password', PASSWORD_DEFAULT)]
        ];

        // Insert each admin into the database
        foreach ($admins as $admin) {
            $stmt->execute($admin);
        }
    } else {
        echo "Admins table already contains data. Skipping data insertion." . '<br>';
    }
} catch (PDOException $e) {
    // Display error message if any exception occurs
    echo "Error: " . $e->getMessage() . '<br>';
}