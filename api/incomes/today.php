<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$dateIncomes = $_POST['date_income'];


try {
    $sql = "SELECT id, title, category, date_income, amount FROM incomes 
    WHERE 
    user_id = :userId AND date_income >= :dateIncomes
    ";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':dateIncomes', $dateIncomes, PDO::PARAM_STR);
    $statement->execute();

    $incomes = $statement->fetchAll(PDO::FETCH_ASSOC);

    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => array(
            "incomes" => $incomes,
        )
    );

    sendResponse(200, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Something went wrong",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
