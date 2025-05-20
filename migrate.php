<?php

$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'db_self_management';

try {
    $connUser = new PDO("mysql:host=$host", $username, $password);
    $connUser->exec("DROP DATABASE IF EXISTS $dbname");
    echo "Database Dropped \n";
    $connUser->exec("CREATE DATABASE $dbname");
    echo "Created Database \n";
    $connUser = null;

    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    migrateUsers($conn);
    migrateMoods($conn);
    migrateSolutions($conn);
    migrateAgendas($conn);
    migrateExpenses($conn);
    migrateJournal($conn);
    migrateGoals($conn);
    migrateIncomes($conn);

    echo "All Tables Created Successfully\n";

    $conn = null;
} catch (PDOException $e) {
    echo json_encode(array(
        "error" => "Connection Failed: " . $e->getMessage(),
    ));
    $connUser = null;
    $conn = null;
}

function migrateUsers($conn)
{
    try {
        $sql = "CREATE TABLE users (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(30) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";

        $conn->exec($sql);
        echo "Table users created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}

function migrateMoods($conn)
{
    try {
        $sql = "CREATE TABLE moods (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                level INT(1) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";

        $conn->exec($sql);
        echo "Table moods created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}

function migrateSolutions($conn)
{
    try {
        $sql = "CREATE TABLE solutions (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                summary TEXT NOT NULL,
                problem TEXT NOT NULL,
                solution TEXT NOT NULL,
                reference TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";

        $conn->exec($sql);
        echo "Table solutions created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}

function migrateAgendas($conn)
{
    try {
        $sql = "CREATE TABLE agendas (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                title VARCHAR(100) NOT NULL,
                category VARCHAR(20) NOT NULL,
                start_event DATETIME NOT NULL,
                end_event DATETIME NOT NULL,
                description TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";

        $conn->exec($sql);
        echo "Table agendas created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}

function migrateExpenses($conn)
{
    try {
        $sql = "CREATE TABLE expenses (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                title VARCHAR(100) NOT NULL,
                category VARCHAR(20) NOT NULL,
                date_expense DATE NOT NULL,
                expense DOUBLE(10,3) NOT NULL,
                description TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";

        $conn->exec($sql);
        echo "Table expenses created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}

function migrateJournal($conn)
{
    try {
        $sql = "CREATE TABLE journals (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                category VARCHAR(20) NOT NULL,
                title VARCHAR(255) DEFAULT NULL,
                content TEXT DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";

        $conn->exec($sql);
        echo "Table journals created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}


function migrateGoals($conn)

{
    try {
        $sql = "CREATE TABLE goals (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                goal VARCHAR(100) NOT NULL,
                is_daily boolean NOT NULL,
                is_done boolean NOT NULL,
                target_date DATETIME NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";
        $conn->exec($sql);
        echo "Table goals created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}

function migrateIncomes($conn)
{
    try {
        $sql = "CREATE TABLE incomes (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) UNSIGNED,
                title VARCHAR(100) NOT NULL,
                category VARCHAR(20) NOT NULL,
                date_income DATE NOT NULL,
                amount DOUBLE(10,3) NOT NULL,
                description TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )";

        $conn->exec($sql);
        echo "Table insomes created successfully\n";
    } catch (PDOException $e) {
        echo $e->getMessage() . "\n";
    }
}
