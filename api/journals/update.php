<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$category = $_POST['category'];
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];

try {
    $sqlUpdate = "UPDATE journals SET 
                user_id     = '$userId',
                category     = '$category',
                title     = '$title',
                content    = '$content',
                WHERE id    = '$id'
                ";

    $conn->exec($sqlUpdate);
    $responseBody = array(
        "message" => "Success update journals",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed update journals",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
