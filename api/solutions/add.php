<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$summary = $_POST['summary'];
$problem = $_POST['problem'];
$solution = $_POST['solution'];
$reference = $_POST['reference'];



try {
    $sqlInsert = "INSERT INTO solutions 
                (user_id,summary ,problem, solution,reference)
                VALUES
                ('$userId', '$summary', '$problem', '$solution', '$reference')
                ";

    $conn->exec($sqlInsert);
    $responseBody = array(
        "message" => "Success add solutions",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add solutions",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
