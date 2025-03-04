<?php

$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'db_self_management';

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(array(
        "error" => "Connection Failed: " . $e->getMessage(),
    ));
    $connUser = null;
    $conn = null;
}
