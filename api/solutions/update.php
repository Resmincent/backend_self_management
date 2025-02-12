<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$summary = $_POST['summary'];
$problem = $_POST['problem'];
$solution = $_POST['solution'];
$reference = $_POST['reference'];
$id = $_POST['id'];

try {
    $sqlUpdate = "UPDATE solutions SET 
                user_id     = '$userId',
                summary     = '$summary',
                problem     = '$problem',
                solution    = '$solution',
                reference   = '$reference'
                WHERE id    = '$id'
                ";

    $conn->exec($sqlUpdate);
    $responseBody = array(
        "message" => "Success update solutions",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed update solutions",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
