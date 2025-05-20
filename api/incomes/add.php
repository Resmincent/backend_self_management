<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$title = $_POST['title'];
$category = $_POST['category'];
$dateIncome = $_POST['date_income'];
$amount = $_POST['amount'];
$description = $_POST['description'];

try {
    $sqlInsert = "INSERT INTO incomes 
                (user_id, title, category, date_income, amount, description)
                VALUES
                ('$userId', '$title', '$category', '$dateIncome', '$amount', '$description')
                ";

    $conn->exec($sqlInsert);
    $responseBody = array(
        "message" => "Success add income",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add income",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
