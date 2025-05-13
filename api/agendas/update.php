<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$id = $_POST['id'];
$startEvent = $_POST['start_event'];
$endEvent = $_POST['end_event'];

try {
    $sqlUpdate = "UPDATE agendas SET 
                user_id     = '$userId',
                start_event  = '$startEvent',
                end_event    = '$endEvent'
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
