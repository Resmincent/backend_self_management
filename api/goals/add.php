<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$goal = $_POST['goal'];
$targetDate = $_POST['target_date'];
$isDaily = $_POST['is_daily'];
$isDone = $_POST['is_done'];
try {
    $sql = "INSERT INTO goals
                (user_id, goal, target_date, is_daily, is_done)
                VALUES
                ('$userId', '$goal', '$targetDate', '$isDaily', '$isDone')
                ";

    $conn->exec($sql);
    $responseBody = array(
        "message" => "Success add goals",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add goals",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
