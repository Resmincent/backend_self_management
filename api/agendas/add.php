<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$title = $_POST['title'];
$category = $_POST['category'];
$startEvent = $_POST['start_event'];
$endEvent = $_POST['end_event'];
$description = $_POST['description'];


try {
    $sqlInsert = "INSERT INTO agendas 
                (user_id, title, category, start_event, end_event, description)
                VALUES
                ('$userId', '$title', '$category', '$startEvent', '$endEvent', '$description')
                ";

    $conn->exec($sqlInsert);
    $responseBody = array(
        "message" => "Success add agendas",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add agendas",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
