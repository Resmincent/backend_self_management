<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$category = $_POST['category'];
$title = $_POST['title'];
$content = $_POST['content'];


try {
    $sql = "INSERT INTO journals
                (user_id, category, title, content)
                VALUES
                ('$userId', '$category', '$title', '$content')
                ";

    $conn->exec($sql);
    $responseBody = array(
        "message" => "Success add journals",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add journals",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
