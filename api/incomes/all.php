<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];

try {
    $sql = "SELECT id, title, category, date_income, amount, description FROM incomes 
                    WHERE 
                    user_id = '$userId' 
                    ";

    $statement = $conn->prepare($sql);
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
