<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$title = $_POST['title'];
$category = $_POST['category'];
$dateExpenses = $_POST['date_expense'];
$expenses = $_POST['expense'];
$description = $_POST['description'];


try {
    $sqlInsert = "INSERT INTO expenses 
                (user_id, title, category, date_expense, expense, description)
                VALUES
                ('$userId', '$title', '$category', '$dateExpenses', '$expenses', '$description')
                ";

    $conn->exec($sqlInsert);
    $responseBody = array(
        "message" => "Success add expenses",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add expenses",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
