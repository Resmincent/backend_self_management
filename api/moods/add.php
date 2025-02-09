<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$level = $_POST['level'];
$createdAt = $_POST['created_at'];


try {
    $sqlInsert = "INSERT INTO moods 
                (user_id, level, created_at)
                VALUES
                ('$userId', '$level', '$createdAt')
                ";

    $conn->exec($sqlInsert);
    $responseBody = array(
        "message" => "Success add moods",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add moods",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
