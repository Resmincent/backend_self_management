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

    $dsn = "mysql:host=$host; dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // migrateUsers($conn);
    // migrateMoods($conn);
    // migrateSolutions($conn);
    // migrateAgendas($conn);

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
                id INT(11) UNSIGNED AUTO_INCREMENT,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(30) NOT NULL,
                password VARCHAR(50) NOT NULL,
                created_at VARCHAR(30) DEFAULT CURRENT_TIMESTAMP,
                updated_at VARCHAR(30) DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
                )";

        $conn->exec($sql);
        echo "Table users created successfully";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    echo "\n";
}


function migrateMoods($conn)
{
    try {
        $sql = "CREATE TABLE moods (
                id INT(11) UNSIGNED AUTO_INCREMENT,
                userId INT(11) UNSIGNED,
                level INT(1) NOT NULL,
                created_at VARCHAR(30) DEFAULT CURRENT_TIMESTAMP,
                updated_at VARCHAR(30) DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                FOREIGN KEY (userId) REFERENCES users(),
                )";

        $conn->exec($sql);
        echo "Table users created successfully";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    echo "\n";
}
