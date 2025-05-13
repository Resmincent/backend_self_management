<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$id = $_POST['id'];
$title = $_POST['title'];
$category = $_POST['category'];
$startEvent = $_POST['start_event'];
$endEvent = $_POST['end_event'];
$description = $_POST['description'];

try {
    $sqlUpdate = "UPDATE agendas SET 
                user_id     = '$userId',
                title     = '$title',
                category     = '$category',
                start_event  = '$startEvent',
                end_event    = '$endEvent',
                description  = '$description'
                WHERE id    = '$id'
                ";

    $conn->exec($sqlUpdate);
    $responseBody = array(
        "message" => "Success update agendas",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $th) {
    $responseBody =  array(
        "message" => "Failed update agendas",
        "error" =>  $th->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
