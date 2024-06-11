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
            // Donors who can donate blood and plasma
            ['John', 'Doe', 'john.doe@example.com', '1234567890', 'M', 30, 75.5, 0, null, 0, null, null, null],
            ['Scarllet', 'Doe', 'scarlet.doe@example.com', '0987654321', 'F', 28, 65.5, 0, null, 0, null, '2021-01-01', null],
            ['Jack', 'Doe', 'jack.doe@example.com', '1234567890', 'M', 30, 75.5, 0, null, 0, null, null, '2021-01-01'],
            ['Alice', 'Doe', 'alice.doe@example.com', '1122334455', 'O', 25, 70.5, 0, null, 0, null, '2021-01-01', '2021-01-01'],
            ['Emma', 'Smith', 'emma.smith@example.com', '1223344556', 'F', 35, 68.0, 0, null, 0, null, '2021-03-15', '2021-03-15'],
            ['Liam', 'Johnson', 'liam.johnson@example.com', '2233445566', 'M', 40, 80.0, 0, null, 0, null, null, null],
            ['Olivia', 'Williams', 'olivia.williams@example.com', '3344556677', 'F', 32, 62.5, 0, null, 0, null, '2021-05-10', null],
            ['Noah', 'Brown', 'noah.brown@example.com', '4455667788', 'M', 27, 77.0, 0, null, 0, null, null, '2021-07-01'],
            ['Ava', 'Jones', 'ava.jones@example.com', '5566778899', 'F', 29, 66.5, 0, null, 0, null, '2021-08-20', null],
            ['William', 'Garcia', 'william.garcia@example.com', '6677889900', 'M', 37, 85.5, 0, null, 0, null, null, null],
            ['Sophia', 'Martinez', 'sophia.martinez@example.com', '7788990011', 'F', 34, 70.0, 0, null, 0, null, '2021-09-15', '2021-09-15'],
            ['James', 'Hernandez', 'james.hernandez@example.com', '8899001122', 'M', 31, 78.0, 0, null, 0, null, null, null],
            ['Isabella', 'Lopez', 'isabella.lopez@example.com', '9900112233', 'F', 26, 64.0, 0, null, 0, null, '2021-11-10', null],
            ['Benjamin', 'Gonzalez', 'benjamin.gonzalez@example.com', '0112233444', 'M', 28, 82.0, 0, null, 0, null, null, '2021-12-01'],
            ['Mia', 'Wilson', 'mia.wilson@example.com', '1223344556', 'F', 33, 67.5, 0, null, 0, null, '2022-01-15', null],
            ['Lucas', 'Anderson', 'lucas.anderson@example.com', '2233445566', 'M', 36, 81.0, 0, null, 0, null, null, null],
            ['Amelia', 'Thomas', 'amelia.thomas@example.com', '3344556677', 'F', 30, 68.5, 0, null, 0, null, '2022-02-10', '2022-02-10'],
            ['Mason', 'Taylor', 'mason.taylor@example.com', '4455667788', 'M', 29, 76.0, 0, null, 0, null, null, null],
            ['Harper', 'Moore', 'harper.moore@example.com', '5566778899', 'F', 31, 65.0, 0, null, 0, null, '2022-03-20', null],
            ['Ethan', 'Jackson', 'ethan.jackson@example.com', '6677889900', 'M', 33, 79.5, 0, null, 0, null, null, '2022-04-01'],
            ['Evelyn', 'Martin', 'evelyn.martin@example.com', '7788990011', 'F', 28, 63.0, 0, null, 0, null, '2022-05-15', null],
            ['Alexander', 'Lee', 'alexander.lee@example.com', '8899001122', 'M', 34, 80.0, 0, null, 0, null, null, null],
            ['Abigail', 'Perez', 'abigail.perez@example.com', '9900112233', 'F', 27, 61.5, 0, null, 0, null, '2022-06-10', '2022-06-10'],
            ['Jacob', 'Thompson', 'jacob.thompson@example.com', '0112233444', 'M', 32, 77.5, 0, null, 0, null, null, '2022-07-01'],
            ['Charlotte', 'White', 'charlotte.white@example.com', '1223344556', 'F', 35, 69.0, 0, null, 0, null, '2022-08-15', null],
            ['Michael', 'Harris', 'michael.harris@example.com', '2233445566', 'M', 39, 84.0, 0, null, 0, null, null, null],
            ['Emily', 'Sanchez', 'emily.sanchez@example.com', '3344556677', 'F', 32, 66.0, 0, null, 0, null, '2022-09-10', '2022-09-10'],
            ['Daniel', 'Clark', 'daniel.clark@example.com', '4455667788', 'M', 30, 74.5, 0, null, 0, null, null, null],
            ['Elizabeth', 'Ramirez', 'elizabeth.ramirez@example.com', '5566778899', 'F', 33, 65.0, 0, null, 0, null, '2022-10-20', null],
            ['Matthew', 'Lewis', 'matthew.lewis@example.com', '6677889900', 'M', 37, 82.0, 0, null, 0, null, null, '2022-11-01'],
            ['Avery', 'Robinson', 'avery.robinson@example.com', '7788990011', 'O', 26, 70.0, 0, null, 0, null, '2022-12-15', null],
            ['Henry', 'Walker', 'henry.walker@example.com', '8899001122', 'M', 35, 83.5, 0, null, 0, null, null, null],
            ['Ella', 'Young', 'ella.young@example.com', '9900112233', 'F', 31, 62.0, 0, null, 0, null, '2023-01-10', '2023-01-10'],
            ['Sebastian', 'Allen', 'sebastian.allen@example.com', '0112233444', 'M', 28, 78.5, 0, null, 0, null, null, '2023-02-01'],
            ['Madison', 'King', 'madison.king@example.com', '1223344556', 'F', 34, 64.5, 0, null, 0, null, '2023-03-15', null],
            ['David', 'Wright', 'david.wright@example.com', '2233445566', 'M', 31, 75.0, 0, null, 0, null, null, null],
            ['Scarlett', 'Lopez', 'scarlett.lopez@example.com', '3344556677', 'F', 29, 67.5, 0, null, 0, null, '2023-04-10', '2023-04-10'],
            ['Joseph', 'Hill', 'joseph.hill@example.com', '4455667788', 'M', 38, 85.0, 0, null, 0, null, null, null],
            ['Grace', 'Scott', 'grace.scott@example.com', '5566778899', 'F', 27, 63.0, 0, null, 0, null, '2023-05-20', null],
            ['Carter', 'Green', 'carter.green@example.com', '6677889900', 'M', 29, 79.0, 0, null, 0, null, null, '2023-06-01'],
            ['Lily', 'Adams', 'lily.adams@example.com', '7788990011', 'F', 33, 68.0, 0, null, 0, null, '2023-07-15', null],
            ['Gabriel', 'Baker', 'gabriel.baker@example.com', '8899001122', 'M', 32, 81.5, 0, null, 0, null, null, null],
            ['Zoey', 'Gonzalez', 'zoey.gonzalez@example.com', '9900112233', 'F', 28, 62.5, 0, null, 0, null, '2023-08-10', '2023-08-10'],
            ['Logan', 'Nelson', 'logan.nelson@example.com', '0112233444', 'M', 34, 76.0, 0, null, 0, null, null, null],
            ['Victoria', 'Carter', 'victoria.carter@example.com', '1223344556', 'F', 26, 65.0, 0, null, 0, null, '2023-09-15', null],
            ['Jackson', 'Mitchell', 'jackson.mitchell@example.com', '2233445566', 'M', 39, 84.5, 0, null, 0, null, null, '2023-10-01'],
            ['Aria', 'Perez', 'aria.perez@example.com', '3344556677', 'F', 30, 64.0, 0, null, 0, null, '2023-11-10', '2023-11-10'],
            ['Jayden', 'Roberts', 'jayden.roberts@example.com', '4455667788', 'M', 29, 80.5, 0, null, 0, null, null, null],
            ['Chloe', 'Turner', 'chloe.turner@example.com', '5566778899', 'F', 27, 62.0, 0, null, 0, null, '2023-12-20', null],
            ['Luke', 'Phillips', 'luke.phillips@example.com', '6677889900', 'M', 37, 79.0, 0, null, 0, null, null, '2024-01-01'],
            ['Penelope', 'Campbell', 'penelope.campbell@example.com', '7788990011', 'F', 32, 63.5, 0, null, 0, null, '2024-02-15', null],
            ['Isaac', 'Parker', 'isaac.parker@example.com', '8899001122', 'M', 36, 82.0, 0, null, 0, null, null, null],
            ['Layla', 'Evans', 'layla.evans@example.com', '9900112233', 'F', 29, 66.0, 0, null, 0, null, '2024-03-10', '2024-03-10'],
            ['Ryan', 'Edwards', 'ryan.edwards@example.com', '0112233444', 'M', 33, 78.5, 0, null, 0, null, null, null],
            ['Riley', 'Collins', 'riley.collins@example.com', '1223344556', 'F', 34, 68.5, 0, null, 0, null, '2024-04-15', null],
            ['Nathan', 'Stewart', 'nathan.stewart@example.com', '2233445566', 'M', 35, 83.0, 0, null, 0, null, null, '2024-05-01'],
            ['Nora', 'Sanchez', 'nora.sanchez@example.com', '3344556677', 'F', 30, 65.0, 0, null, 0, null, '2024-06-10', '2024-06-10'],

            // Donors who cannot donate blood and plasma
            ['Jane', 'Doe', 'jane.doe@example.com', '0987654321', 'F', 28, 65.5, 1, 'anemia', 0, null, null, null],
            ['Alex', 'Doe', 'alex.doe@example.com', '1122334455', 'O', 17, 70.5, 0, null, 1, 'Under age', null, null],
            ['Bob', 'Doe', 'bob.doe@example.com', '5544332211', 'O', 80, 70.5, 1, 'High Blood Pressure', 1, 'Age reasons', null, null],
            ['Ella', 'Brown', 'ella.brown@example.com', '1234567890', 'F', 29, 64.5, 1, 'Pregnancy', 0, null, null, null],
            ['Sam', 'Wilson', 'sam.wilson@example.com', '0987654321', 'M', 52, 95.0, 1, 'Diabetes', 0, null, null, null],
            ['Anna', 'Taylor', 'anna.taylor@example.com', '1122334455', 'F', 24, 60.0, 1, 'Low Iron', 0, null, null, null],
            ['Tom', 'Anderson', 'tom.anderson@example.com', '6677889900', 'M', 50, 90.5, 1, 'Heart Condition', 0, null, null, null],
            ['Grace', 'Martinez', 'grace.martinez@example.com', '3344556677', 'F', 40, 75.0, 1, 'Cancer', 0, null, null, null],
            ['Lucas', 'Roberts', 'lucas.roberts@example.com', '4455667788', 'M', 45, 85.0, 1, 'Kidney Disease', 0, null, null, null],
            ['Chloe', 'Lewis', 'chloe.lewis@example.com', '5566778899', 'F', 55, 70.0, 1, 'Medication', 0, null, null, null],
            ['Henry', 'Clark', 'henry.clark@example.com', '6677889900', 'M', 70, 78.0, 1, 'Age reasons', 1, 'Over age', null, null],
            ['Sophie', 'Walker', 'sophie.walker@example.com', '7788990011', 'F', 25, 65.0, 1, 'Recent Tattoo', 0, null, null, null],
            ['Jack', 'Hall', 'jack.hall@example.com', '8899001122', 'M', 35, 82.0, 1, 'Hepatitis', 0, null, null, null],
            ['Zoe', 'Allen', 'zoe.allen@example.com', '9900112233', 'F', 30, 68.0, 1, 'Surgery', 0, null, null, null],
            ['Liam', 'Young', 'liam.young@example.com', '0112233444', 'M', 33, 77.0, 1, 'Epilepsy', 0, null, null, null],
            ['Ava', 'King', 'ava.king@example.com', '1223344556', 'F', 29, 66.0, 1, 'Malaria', 0, null, null, null],
            ['David', 'Wright', 'david.wright@example.com', '2233445566', 'M', 48, 80.5, 1, 'Stroke', 0, null, null, null],
            ['Emily', 'Green', 'emily.green@example.com', '3344556677', 'F', 38, 72.0, 1, 'Blood Disorder', 0, null, null, null],
            ['James', 'Baker', 'james.baker@example.com', '4455667788', 'M', 51, 85.5, 1, 'Tuberculosis', 0, null, null, null],
            ['Sophia', 'Adams', 'sophia.adams@example.com', '5566778899', 'F', 27, 62.0, 1, 'Thyroid Disease', 0, null, null, null],
            ['Noah', 'Nelson', 'noah.nelson@example.com', '6677889900', 'M', 42, 78.0, 1, 'Leukemia', 0, null, null, null],
            ['Isabella', 'Carter', 'isabella.carter@example.com', '7788990011', 'F', 35, 69.0, 1, 'Recent Travel', 0, null, null, null],
            ['Ethan', 'Mitchell', 'ethan.mitchell@example.com', '8899001122', 'M', 40, 85.0, 1, 'Chronic Fatigue', 0, null, null, null],
            ['Mia', 'Perez', 'mia.perez@example.com', '9900112233', 'F', 28, 61.0, 1, 'Blood Pressure Issues', 0, null, null, null],
            ['Michael', 'Robinson', 'michael.robinson@example.com', '0112233444', 'M', 39, 80.0, 1, 'Infection', 0, null, null, null],
            ['Emma', 'Garcia', 'emma.garcia@example.com', '1223344556', 'F', 29, 63.0, 1, 'Autoimmune Disease', 0, null, null, null],
            ['Oliver', 'Thompson', 'oliver.thompson@example.com', '2233445566', 'M', 55, 82.0, 1, 'Medication for Life', 0, null, null, null],
            ['Charlotte', 'White', 'charlotte.white@example.com', '3344556677', 'F', 33, 70.0, 1, 'Chronic Pain', 0, null, null, null],
            ['Elijah', 'Martinez', 'elijah.martinez@example.com', '4455667788', 'M', 45, 87.0, 1, 'Liver Disease', 0, null, null, null],
            ['Avery', 'Hernandez', 'avery.hernandez@example.com', '5566778899', 'F', 31, 66.0, 1, 'Recent Transfusion', 0, null, null, null],
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